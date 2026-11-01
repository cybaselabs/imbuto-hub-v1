"use strict";
const assert = require("node:assert/strict");
const test = require("node:test");
const { createRequire } = require("node:module");
const { join } = require("node:path");
const { readFileSync } = require("node:fs");
const { spawnSync } = require("node:child_process");
const root = join(__dirname, "..");
const legacy = createRequire(join(root, "node_modules/eslint/package.json"))("minimatch");

if (process.argv[2] === "--bounded-amplification-check") {
  const modern = createRequire(join(root, "node_modules/@typescript-eslint/typescript-estree/package.json"))("minimatch");
  const matcher = new modern.Minimatch("a/**/../".repeat(32) + "target", { optimizationLevel: 2 });
  assert.equal(typeof matcher.match("a/target"), "boolean");
  process.stdout.write("bounded matcher completed\n");
} else {
  test("all existing legacy consumers resolve the adapter, not vulnerable minimatch", () => {
    const consumers = ["@eslint/config-array", "@eslint/eslintrc", "eslint", "eslint-plugin-import", "eslint-plugin-jsx-a11y", "eslint-plugin-react"];
    for (const name of consumers) {
      const req = createRequire(join(root, "node_modules", name, "package.json"));
      assert.equal(typeof req("minimatch"), "function", name);
      assert.equal(req("minimatch")("app/page.tsx", "**/*.tsx"), true, name);
      assert.equal(req("minimatch/package.json").name, "@imbuto/minimatch-legacy-compat", name);
    }
    const req = createRequire(join(root, "node_modules/@typescript-eslint/typescript-estree/package.json"));
    assert.equal(req("minimatch/package.json").version, "11.0.3");
    const adapterReq = createRequire(createRequire(join(root, "node_modules/eslint/package.json")).resolve("minimatch"));
    assert.equal(adapterReq("minimatch-modern/package.json").version, "11.0.3");
  });

  test("glob matching retains the patterns/options used by this lint stack", () => {
    const cases = [
      ["app/page.tsx", "**/*.tsx", {}, true],
      ["app/page.ts", "**/*.tsx", {}, false],
      [".next/server/app.js", ".next/**", {}, true],
      ["components/imbuto/SiteHeader.tsx", "components/**", {}, true],
      ["vendor/index.cjs", "**/*.{js,cjs,mjs}", {}, true],
      ["foo/bar", "foo/{bar,baz}", {}, true],
      ["foo/qux", "foo/{bar,baz}", {}, false],
      ["foofoo", "+(foo|bar)", {}, true],
      ["IconButton", "*Button", {}, true],
      ["legacy_button", "legacy_*", { noglobstar: true }, true],
      [".hidden.ts", "*.ts", {}, false],
      [".hidden.ts", "*.ts", { dot: true }, true],
      ["src/app/file.js", "*.js", { matchBase: true }, true],
      ["src/app/file.js", "*.js", {}, false],
      ["foo", "!bar", {}, true],
      ["bar", "!bar", {}, false],
      ["#note", "#*", {}, false],
      ["#note", "#*", { nocomment: true }, true],
      ["README.md", "readme.*", { nocase: true }, true],
      ["/src/a.ts", "/src/**", { dot: true, matchBase: true }, true],
    ];
    for (const [path, pattern, options, expected] of cases) {
      assert.equal(legacy(path, pattern, options), expected, `${path}: ${pattern}`);
      assert.equal(new legacy.Minimatch(pattern, options).match(path), expected);
      assert.equal(legacy.makeRe(pattern, options).test(path), expected);
    }
    assert.deepEqual(legacy.braceExpand("a{b,c}"), ["ab", "ac"]);
    assert.deepEqual(legacy.match(["a.js", "b.ts"], "*.js"), ["a.js"]);
    assert.deepEqual(["a.js", "b.ts"].filter(legacy.filter("*.ts")), ["b.ts"]);
    assert.equal(legacy.defaults({ dot: true })(".a", "*"), true);
    assert.equal(legacy.defaults({ dot: true }).makeRe("*").test(".a"), true);
  });

  test("amplification regression is bounded in an isolated timed child", () => {
    const result = spawnSync(process.execPath, ["--max-old-space-size=128", __filename, "--bounded-amplification-check"], {
      cwd: root, env: process.env, timeout: 5000, maxBuffer: 65536, encoding: "utf8",
    });
    assert.ifError(result.error);
    assert.equal(result.status, 0, result.stderr);
    assert.match(result.stdout, /bounded matcher completed/);
  });

  test("actual Next ESLint config resolves and selects application rules", async () => {
    const { ESLint } = require("eslint");
    const eslint = new ESLint({ cwd: root });
    const config = await eslint.calculateConfigForFile(join(root, "app/page.tsx"));
    assert.ok(config.rules["@next/next/no-html-link-for-pages"]);
    assert.ok(config.rules["react/jsx-key"]);
    assert.equal(await eslint.isPathIgnored(join(root, ".next/server/app.js")), true);
    assert.equal(await eslint.isPathIgnored(join(root, "app/page.tsx")), false);
  });

  test("legacy callable and makeRe APIs work inside real ESLint plugin rules", async () => {
    const { ESLint } = require("eslint");
    const eslint = new ESLint({ cwd: root, overrideConfigFile: true, overrideConfig: {
      files: ["**/*.jsx"],
      plugins: { import: require("eslint-plugin-import"), react: require("eslint-plugin-react") },
      languageOptions: { ecmaVersion: 2022, sourceType: "module", parserOptions: { ecmaFeatures: { jsx: true } } },
      rules: {
        "import/no-internal-modules": ["error", { forbid: ["blocked/**"] }],
        "react/jsx-pascal-case": ["error", { ignore: ["legacy_*"] }],
      },
    } });
    const [allowed] = await eslint.lintText('import x from "allowed/lib"; const y = <legacy_button />;', { filePath: "compat-fixture.jsx" });
    assert.equal(allowed.messages.length, 0, JSON.stringify(allowed.messages));
    const [blocked] = await eslint.lintText('import x from "blocked/private";', { filePath: "compat-fixture.jsx" });
    assert.ok(blocked.messages.some((m) => m.ruleId === "import/no-internal-modules"), JSON.stringify(blocked.messages));
  });

  test("lockfile contains no v3/v10 minimatch and uses the exact local adapter", () => {
    const lock = JSON.parse(readFileSync(join(root, "package-lock.json"), "utf8"));
    for (const [name, entry] of Object.entries(lock.packages)) {
      if (/\/minimatch(?:-modern)?$/.test(name)) {
        if (entry.name === "@imbuto/minimatch-legacy-compat") assert.equal(entry.version, "1.0.0");
        else assert.equal(entry.version, "11.0.3", name);
        assert.ok(entry.integrity, name);
      }
    }
  });
}
