import { spawn } from "node:child_process";
import { existsSync, readFileSync } from "node:fs";
import { resolve } from "node:path";

const defaultCredentialsFile =
  "imbuto-web-applications-308f8189cec8.json";
const credentialsPath = resolve(
  process.cwd(),
  process.env.GOOGLE_SERVICE_ACCOUNT_JSON_PATH || defaultCredentialsFile,
);
const childEnvironment = { ...process.env };

if (!childEnvironment.GOOGLE_SERVICE_ACCOUNT_JSON_BASE64) {
  if (existsSync(credentialsPath)) {
    childEnvironment.GOOGLE_SERVICE_ACCOUNT_JSON_BASE64 = readFileSync(
      credentialsPath,
    ).toString("base64");
    console.log("Google Sheets credentials loaded for local development.");
  } else {
    console.warn(
      "Google Sheets credentials were not found; application submissions will fail.",
    );
  }
}

const nextProcess = spawn(
  process.execPath,
  ["node_modules/next/dist/bin/next", "dev", ...process.argv.slice(2)],
  {
    env: childEnvironment,
    stdio: "inherit",
  },
);

nextProcess.on("exit", (code, signal) => {
  if (signal) {
    process.kill(process.pid, signal);
    return;
  }

  process.exit(code ?? 1);
});
