import { createHash, randomBytes } from "node:crypto";
import { readFileSync, realpathSync, statSync, existsSync, readdirSync, mkdirSync } from "node:fs";
import { dirname, join, resolve } from "node:path";
import { fileURLToPath } from "node:url";
import { spawn } from "node:child_process";
import { startGoogleDevRelay } from "./google-dev-relay.mjs";

const root = resolve(dirname(fileURLToPath(import.meta.url)), "..");
const config = JSON.parse(readFileSync(join(root, "development-sheet.json"), "utf8"));
const profile = '(version 1) (allow default) (deny network*) (allow network-inbound (local ip "localhost:*")) (allow network-outbound (remote ip "localhost:*")) (allow network* (local unix-socket))';
const checksum = createHash("sha256").update(readFileSync(process.execPath)).digest("hex");
if (checksum !== "18e387c90ab8a8400183e8bdd396376e1e875b91b4c874b894dcade7b35bf572" || !existsSync("/usr/bin/sandbox-exec")) throw new Error("Verified macOS Node runtime required.");
const mode = process.argv[2];
if (!["build", "start"].includes(mode)) throw new Error("Use build, or start with --config <private-development-config.json>.");
const expectedEnv = "IMBUTO_LOCAL_ONLY=true\nIMBUTO_EXTERNAL_SERVICES=false\nIMBUTO_ENABLE_SUBMISSIONS=false\nNEXT_PUBLIC_IMBUTO_LOCAL_ONLY=true\n";
for (const name of readdirSync(root)) {
  if (name.startsWith(".env") && name !== ".env.example" && (name !== ".env.local" || readFileSync(join(root, name), "utf8") !== expectedEnv)) throw new Error("Unreviewed environment file; nothing loaded.");
  if (/^imbuto-web-applications-.*\.json$/.test(name)) throw new Error("Credential auto-loading is prohibited.");
}
for (const name of ["NODE_OPTIONS", "NODE_EXTRA_CA_CERTS", "NODE_TLS_REJECT_UNAUTHORIZED", "HTTP_PROXY", "HTTPS_PROXY", "ALL_PROXY"]) if (process.env[name]) throw new Error("Use the documented clean-environment command.");
mkdirSync(join(root, ".local-dev/home"), { recursive: true, mode: 0o700 });
const env = {
  HOME: join(root, ".local-dev/home"), PATH: "/usr/bin:/bin:/usr/sbin:/sbin", TMPDIR: "/private/tmp", NODE_ENV: "production",
  NEXT_TELEMETRY_DISABLED: "1", HUSKY: "0", npm_config_ignore_scripts: "true",
  IMBUTO_LOCAL_ONLY: "true", IMBUTO_EXTERNAL_SERVICES: "false", IMBUTO_ENABLE_SUBMISSIONS: "false",
  NEXT_PUBLIC_IMBUTO_LOCAL_ONLY: "false", NEXT_PUBLIC_IMBUTO_DEV_SHEETS: "true",
};
function child(args, environment) {
  return spawn("/usr/bin/sandbox-exec", ["-p", profile, process.execPath, ...args], { cwd: root, env: environment, stdio: "inherit" });
}
async function wait(process) { return new Promise((resolve, reject) => { process.once("error", reject); process.once("exit", (code) => resolve(code ?? 1)); }); }
if (mode === "build") {
  if (process.argv.length !== 3) throw new Error("Build accepts no credential/config arguments.");
  process.exitCode = await wait(child([join(root, "node_modules/next/dist/bin/next"), "build", "--webpack"], env));
} else {
  if (process.argv.length !== 5 || process.argv[3] !== "--config") throw new Error("Explicit private development configuration is required; no credentials are auto-discovered.");
  const configPath = realpathSync(process.argv[4]);
  if ((statSync(configPath).mode & 0o077) !== 0) throw new Error("Development configuration must be private (0600).");
  const privateConfig = JSON.parse(readFileSync(configPath, "utf8"));
  if (!privateConfig.projectId || !privateConfig.serviceAccountEmail || !privateConfig.credentialsFile || privateConfig.spreadsheetId !== config.spreadsheetId || privateConfig.developmentOnly !== true) throw new Error("Missing or mismatched development-only configuration.");
  const keyPath = realpathSync(privateConfig.credentialsFile);
  if (keyPath.startsWith(root + "/") || /CloudStorage|Dropbox/.test(keyPath) || (statSync(keyPath).mode & 0o077) !== 0) throw new Error("Use a private development key outside source/cloud folders.");
  const keyBytes = readFileSync(keyPath);
  const key = JSON.parse(keyBytes.toString("utf8"));
  if (key.type !== "service_account" || key.project_id !== privateConfig.projectId || key.client_email !== privateConfig.serviceAccountEmail || !key.client_email.endsWith(`@${key.project_id}.iam.gserviceaccount.com`) || !key.private_key?.includes("BEGIN PRIVATE KEY")) throw new Error("Explicit development service-account identity mismatch.");
  // Session is retained privately in memory; no token/key appears in argv/logs/files.
  const session = randomBytes(32).toString("hex");
  const activeRelay = await startGoogleDevRelay(config.spreadsheetId, session);
  Object.assign(env, {
    IMBUTO_DEV_SHEETS: "true", IMBUTO_DEV_SHEET_VERIFIED: config.marker,
    IMBUTO_ENABLE_SUBMISSIONS: "true", GOOGLE_SHEETS_SPREADSHEET_ID: config.spreadsheetId,
    GOOGLE_SERVICE_ACCOUNT_JSON_BASE64: keyBytes.toString("base64"),
    IMBUTO_GOOGLE_RELAY_URL: activeRelay.url, IMBUTO_GOOGLE_RELAY_SESSION: session,
  });
  keyBytes.fill(0);
  const preflight = child(["--experimental-strip-types", join(root, "scripts/preflight-dev-sheet.mjs")], env);
  if (await wait(preflight) !== 0) { activeRelay.server.close(); throw new Error("Development Sheet preflight failed; application was not started."); }
  const app = child(["--require", join(root, "scripts/dev-sheets-http-guard.cjs"), join(root, "node_modules/next/dist/bin/next"), "start", "--hostname", "127.0.0.1", "--port", String(config.port)], env);
  for (const signal of ["SIGINT", "SIGTERM"]) process.once(signal, () => { app.kill(signal); activeRelay.server.close(); });
  process.exitCode = await wait(app); activeRelay.server.close();
}
