const test = require("node:test");
const assert = require("node:assert/strict");
const { spawnSync } = require("node:child_process");
const { resolve } = require("node:path");
const root = resolve(__dirname, "..");

function policy(environment) {
  const result = spawnSync(process.execPath, ["-e", `
    const p = require('./lib/local-preview-policy.cjs');
    console.log(JSON.stringify({
      local:p.isLocalOnly(), external:p.externalServicesEnabled(), submit:p.submissionsAllowed(),
      public:p.allowedRequestHost('imbutohub.com','/'), www:p.allowedRequestHost('www.imbutohub.com','/'),
      hostile:p.allowedRequestHost('imbutohub.com.attacker.invalid','/'),
      port:p.allowedRequestHost('imbutohub.com:444','/'),
      forwarded:p.allowedRequestHost('attacker.invalid','/'),
      loopbackPage:p.allowedRequestHost('127.0.0.1:3000','/'),
      loopbackHealth:p.allowedRequestHost('127.0.0.1:3000','/healthz'), csp:p.localPreviewCsp()
    }));
  `], { cwd: root, env: { PATH: "/usr/bin:/bin", ...environment }, encoding: "utf8" });
  assert.equal(result.status, 0, result.stderr);
  return JSON.parse(result.stdout);
}

test("default runtime remains loopback-only with submissions and external services disabled", () => {
  const p = policy({});
  assert.equal(p.local, true);
  assert.equal(p.public, false);
  assert.equal(p.www, false);
  assert.equal(p.loopbackPage, true);
  assert.equal(p.submit, false);
  assert.equal(p.external, false);
});

test("explicit website mode accepts only approved public hosts and loopback health checks", () => {
  const p = policy({ IMBUTO_RUNTIME: "production-site", IMBUTO_ENABLE_SUBMISSIONS: "true", IMBUTO_DEV_SHEETS: "true" });
  assert.equal(p.local, false);
  assert.equal(p.public, true);
  assert.equal(p.www, true);
  for (const key of ["hostile", "port", "forwarded", "loopbackPage", "submit", "external"]) assert.equal(p[key], false, key);
  assert.equal(p.loopbackHealth, true);
  assert.match(p.csp, /connect-src 'self'/);
  assert.match(p.csp, /form-action none/);
});

test("production form client refuses before fetch, even with development flags set", () => {
  const result = spawnSync(process.execPath, ["--experimental-strip-types", "--input-type=module", "-e", `
    globalThis.fetch = () => { throw new Error('Unexpected fetch'); };
    const { submitForm } = await import('./lib/form-submission.ts');
    for (const endpoint of ['/api/applications', '/api/get-involved']) {
      await import('node:assert/strict').then(({default:a}) => a.rejects(submitForm(endpoint, {}, 'success'), /Submissions are temporarily unavailable/));
    }
  `], { cwd: root, env: { PATH: "/usr/bin:/bin", NEXT_PUBLIC_IMBUTO_SITE_ONLY: "true", NEXT_PUBLIC_IMBUTO_LOCAL_ONLY: "false", NEXT_PUBLIC_IMBUTO_DEV_SHEETS: "true" }, encoding: "utf8" });
  assert.equal(result.status, 0, result.stderr);
});

test("production launcher refuses injected service credentials before opening the application", () => {
  const result = spawnSync(process.execPath, ["scripts/start-production-site.mjs"], {
    cwd: root, env: { PATH: "/usr/bin:/bin", GOOGLE_SERVICE_ACCOUNT_JSON_BASE64: "synthetic-test-only" }, encoding: "utf8",
  });
  assert.notEqual(result.status, 0);
  assert.match(result.stderr, /Website-only runtime rejects service credentials/);
  assert.doesNotMatch(result.stderr, /synthetic-test-only/);
});
