import test from "node:test";
import assert from "node:assert/strict";
import { allowedGoogleTarget, startGoogleDevRelay } from "../scripts/google-dev-relay.mjs";
import config from "../development-sheet.json" with { type: "json" };
import boundary from "../lib/google-dev-fetch.cjs";

test("relay permits only token exchange and the exact development Sheet", () => {
  assert.equal(allowedGoogleTarget("/token", config.spreadsheetId, "POST"), "https://oauth2.googleapis.com/token");
  assert.equal(allowedGoogleTarget(`/v4/spreadsheets/${config.spreadsheetId}?fields=properties`, config.spreadsheetId, "GET"), `https://sheets.googleapis.com/v4/spreadsheets/${config.spreadsheetId}?fields=properties`);
  assert.ok(allowedGoogleTarget(`/v4/spreadsheets/${config.spreadsheetId}/values/Applications!A1:append`, config.spreadsheetId, "POST"));
  for (const path of ["/token?redirect=1", "/other", "/v4/spreadsheets/not-the-dev-sheet", `/v4/spreadsheets/${config.spreadsheetId}-suffix/values/A1`, `/v4/spreadsheets/${config.spreadsheetId}/export`]) assert.equal(allowedGoogleTarget(path, config.spreadsheetId, "POST"), null);
  assert.equal(allowedGoogleTarget(`/v4/spreadsheets/${config.spreadsheetId}`, config.spreadsheetId, "DELETE"), null);
});

test("missing integration flags fail closed before any request", async () => {
  assert.equal(boundary.devSheetsReady(), false);
  await assert.rejects(boundary.googleDevFetch("https://oauth2.googleapis.com/token"), /Verified development Google relay required/);
});

test("unauthorized relay requests cannot trigger external calls", async () => {
  const { server, url } = await startGoogleDevRelay(config.spreadsheetId, "a".repeat(64));
  try {
    for (const options of [
      { method: "POST" },
      { method: "POST", headers: { "X-Imbuto-Relay-Session": "wrong" } },
      { method: "POST", headers: { "X-Imbuto-Relay-Session": "a".repeat(64), Origin: "https://example.invalid" } },
    ]) assert.equal((await fetch(url + "/token", options)).status, 403);
    assert.equal((await fetch(url + "/v4/spreadsheets/not-the-dev-sheet", { method: "GET", headers: { "X-Imbuto-Relay-Session": "a".repeat(64) } })).status, 403);
  } finally { await new Promise((resolve) => server.close(resolve)); }
});
