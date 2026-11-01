// Website-only runtime. No service credentials, real submissions or dotenv loading.
import { readdirSync, readFileSync } from "node:fs";
import { spawn } from "node:child_process";
import { dirname, join } from "node:path";
import { fileURLToPath } from "node:url";

const root = dirname(dirname(fileURLToPath(import.meta.url)));
for (const name of Object.keys(process.env)) {
  if (/^(GOOGLE_|TURNSTILE_|UPSTASH_|IMBUTO_GOOGLE_|NODE_OPTIONS$|NODE_EXTRA_CA_CERTS$|NODE_TLS_REJECT_UNAUTHORIZED$)/.test(name)) {
    throw new Error("Website-only runtime rejects service credentials and Node preload/TLS overrides.");
  }
}
if (readdirSync(root).some((name) => name.startsWith(".env"))) throw new Error("Website-only runtime does not load environment files.");
const build = JSON.parse(readFileSync(join(root, "production-site-build.json"), "utf8"));
if (build.mode !== "production-site" || build.submissions !== false) throw new Error("Reviewed website-only build required.");
const port = process.env.PORT || "3000";
const hostname = process.env.HOSTNAME || "0.0.0.0";
if (!/^\d+$/.test(port) || Number(port) < 1024 || Number(port) > 65535 || !["127.0.0.1", "0.0.0.0"].includes(hostname)) throw new Error("Invalid server binding.");
const child = spawn(process.execPath, [join(root, "server.js")], {
  cwd: root, stdio: "inherit",
  env: {
    PATH: "/usr/local/bin:/usr/bin:/bin", HOME: "/tmp", TMPDIR: "/tmp",
    NODE_ENV: "production", NEXT_TELEMETRY_DISABLED: "1", HUSKY: "0", npm_config_ignore_scripts: "true",
    IMBUTO_RUNTIME: "production-site", IMBUTO_EXTERNAL_SERVICES: "false", IMBUTO_ENABLE_SUBMISSIONS: "false",
    NEXT_PUBLIC_IMBUTO_SITE_ONLY: "true", NEXT_PUBLIC_IMBUTO_LOCAL_ONLY: "false", NEXT_PUBLIC_IMBUTO_DEV_SHEETS: "false",
    HOSTNAME: hostname, PORT: port,
  },
});
for (const signal of ["SIGINT", "SIGTERM"]) process.once(signal, () => child.kill(signal));
child.once("error", () => { console.error("Website startup failed."); process.exitCode = 1; });
child.once("exit", (code) => { process.exitCode = code ?? 1; });
