// Run inside the candidate container with --network none, never against production.
const assert = require("node:assert/strict");
const { request: httpRequest } = require("node:http");
const { spawn } = require("node:child_process");
const { setTimeout: delay } = require("node:timers/promises");

async function main() {
  let log = "";
  const root = process.env.IMBUTO_SMOKE_ROOT || "/app";
  const port = process.env.IMBUTO_SMOKE_PORT || "3000";
  const app = spawn(process.execPath, ["scripts/start-production-site.mjs"], {
    cwd: root, env: { ...process.env, HOSTNAME: "127.0.0.1", PORT: port }, stdio: ["ignore", "pipe", "pipe"],
  });
  for (const stream of [app.stdout, app.stderr]) stream.on("data", (data) => { log = (log + data.toString()).slice(-3000); });
  const request = (path, host = "imbutohub.com", method = "GET") => new Promise((resolve, reject) => {
    const req = httpRequest({ hostname: "127.0.0.1", port, path, method, timeout: 5000,
      headers: { Host: host, ...(method === "POST" ? { "Content-Type": "application/json", Origin: "https://imbutohub.com" } : {}) },
    }, (res) => {
      const chunks = []; let bytes = 0;
      res.on("data", (chunk) => { bytes += chunk.length; if (bytes > 4 * 1024 * 1024) res.destroy(new Error("Response too large")); else chunks.push(chunk); });
      res.on("error", reject);
      res.on("end", () => resolve({ status: res.statusCode, headers: { get: (name) => res.headers[name.toLowerCase()] || null }, text: async () => Buffer.concat(chunks).toString("utf8") }));
    });
    req.on("error", reject); req.on("timeout", () => req.destroy(new Error("HTTP check timed out")));
    req.end(method === "POST" ? "{}" : undefined);
  });
  try {
    let ready = false;
    for (let attempt = 0; attempt < 120; attempt++) {
      if (app.exitCode !== null) throw new Error(`Application exited before readiness: ${log}`);
      try { if ((await request("/healthz", `127.0.0.1:${port}`)).status === 200) { ready = true; break; } } catch { /* Server may still be starting. */ }
      await delay(500);
    }
    assert.ok(ready, `Readiness failed: ${log}`);
    for (const host of ["imbutohub.com", "www.imbutohub.com"]) {
      for (const path of ["/", "/apply", "/get-involved", "/programmes"]) {
        const response = await request(path, host);
        assert.equal(response.status, 200, `${host}${path}: ${await response.text()}`);
        assert.match(response.headers.get("content-security-policy") || "", /form-action none/);
        if (path === "/apply") {
          const body = await response.text();
          assert.match(body, /Submissions are temporarily unavailable/);
          assert.match(body, /<fieldset[^>]*disabled/);
          assert.doesNotMatch(body, /Development Google Sheet only\./);
        }
      }
      const redirect = await request("/Programmes", host);
      assert.equal(redirect.status, 308);
      assert.equal(redirect.headers.get("location"), `https://${host}/programmes`);
      for (const endpoint of ["/api/applications", "/api/get-involved"]) {
        assert.equal((await request(endpoint, host, "POST")).status, 403);
        assert.equal((await request(endpoint, host)).status, 403);
      }
    }
    for (const host of ["attacker.invalid", "imbutohub.com.attacker.invalid", `127.0.0.1:${port}`]) {
      assert.equal((await request("/", host)).status, 403);
    }
    assert.equal((await request("/", "imbutohub.com", "POST")).status, 403);
    console.log("PASS: website pages, disabled forms/APIs, CSP, canonical redirect, health check and host rejection; isolated runtime.");
  } finally {
    app.kill("SIGTERM");
    await Promise.race([new Promise((resolve) => app.once("exit", resolve)), delay(5000)]);
  }
}
main().catch((error) => { console.error(error); process.exitCode = 1; });
