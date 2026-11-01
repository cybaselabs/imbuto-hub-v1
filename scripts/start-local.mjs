import { spawn } from "node:child_process";
import { createHash } from "node:crypto";
import { existsSync, mkdirSync, readFileSync, readdirSync } from "node:fs";
import { dirname, join, resolve } from "node:path";
import { fileURLToPath } from "node:url";

const root = resolve(dirname(fileURLToPath(import.meta.url)), "..");
const safeEnvironment = "IMBUTO_LOCAL_ONLY=true\nIMBUTO_EXTERNAL_SERVICES=false\nIMBUTO_ENABLE_SUBMISSIONS=false\nNEXT_PUBLIC_IMBUTO_LOCAL_ONLY=true\n";

export function runLocal(mode = "dev", args = []) {
  if (!["dev", "start", "build", "typecheck", "lint", "dependencycheck", "formcheck"].includes(mode)) throw new Error("Unsupported local command");
  if (process.platform !== "darwin" || !existsSync("/usr/bin/sandbox-exec")) throw new Error("This local launcher requires the reviewed macOS network sandbox.");
  const runtimeHash = createHash("sha256").update(readFileSync(process.execPath)).digest("hex");
  if (runtimeHash !== "18e387c90ab8a8400183e8bdd396376e1e875b91b4c874b894dcade7b35bf572") throw new Error("Use the checksum-verified Node 22.23.2 executable.");
  for (const name of readdirSync(root)) {
    if (name.startsWith(".env") && name !== ".env.example") {
      if (name !== ".env.local" || readFileSync(join(root, name), "utf8") !== safeEnvironment) throw new Error("Unreviewed environment file present; no credentials were loaded.");
    }
    if (/^imbuto-web-applications-.*\.json$/.test(name)) throw new Error("Remove credential files from this local-only workspace before starting.");
  }
  let port = "3015";
  if (args.length) {
    if (!["dev", "start"].includes(mode) || args.length !== 2 || args[0] !== "--port" || !/^\d+$/.test(args[1]) || Number(args[1]) < 1024 || Number(args[1]) > 65535) throw new Error("Only --port <1024..65535> is supported; binding is always loopback.");
    port = args[1];
  }
  const home = join(root, ".local-dev", "home");
  mkdirSync(home, { recursive: true, mode: 0o700 });
  const environment = {
    HOME: home, PATH: "/usr/bin:/bin:/usr/sbin:/sbin", TMPDIR: "/private/tmp",
    NODE_ENV: mode === "dev" ? "development" : "production",
    NEXT_TELEMETRY_DISABLED: "1", HUSKY: "0", npm_config_ignore_scripts: "true",
    IMBUTO_LOCAL_ONLY: "true", IMBUTO_EXTERNAL_SERVICES: "false",
    IMBUTO_ENABLE_SUBMISSIONS: "false", NEXT_PUBLIC_IMBUTO_LOCAL_ONLY: "true",
  };
  const cli = mode === "formcheck" ? join(root, "tests/local-forms.test.cjs") : mode === "dependencycheck" ? join(root, "tests/minimatch-compat.test.cjs") : mode === "typecheck" ? join(root, "node_modules/typescript/bin/tsc") : mode === "lint" ? join(root, "node_modules/eslint/bin/eslint.js") : join(root, "node_modules/next/dist/bin/next");
  const cliArgs = ["dependencycheck", "formcheck"].includes(mode) ? [] : mode === "typecheck" ? ["--noEmit", "--incremental", "false"] : mode === "lint" ? ["."] : mode === "build" ? ["build", "--webpack"] : [mode, ...(mode === "dev" ? ["--webpack"] : []), "--hostname", "127.0.0.1", "--port", port];
  const guard = ["dev", "start"].includes(mode) ? ["--require", join(root, "scripts/local-preview-guard.cjs")] : [];
  const profile = '(version 1) (allow default) (deny network*) (allow network-inbound (local ip "localhost:*")) (allow network-outbound (remote ip "localhost:*")) (allow network* (local unix-socket))';
  const child = spawn("/usr/bin/sandbox-exec", ["-p", profile, process.execPath, ...guard, cli, ...cliArgs], { cwd: root, env: environment, stdio: "inherit" });
  for (const signal of ["SIGINT", "SIGTERM"]) process.once(signal, () => child.kill(signal));
  child.once("error", () => { console.error("Local tool startup failed."); process.exitCode = 1; });
  child.once("exit", (code) => { process.exitCode = code ?? 1; });
  return child;
}

if (process.argv[1] && resolve(process.argv[1]) === fileURLToPath(import.meta.url)) runLocal(process.argv[2], process.argv.slice(3));
