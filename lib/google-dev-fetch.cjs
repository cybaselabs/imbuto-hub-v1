"use strict";
const config = require("../development-sheet.json");

function devSheetsReady() {
  return process.env.IMBUTO_DEV_SHEETS === "true" &&
    process.env.IMBUTO_DEV_SHEET_VERIFIED === config.marker &&
    process.env.GOOGLE_SHEETS_SPREADSHEET_ID === config.spreadsheetId &&
    /^http:\/\/127\.0\.0\.1:\d+$/.test(process.env.IMBUTO_GOOGLE_RELAY_URL || "") &&
    /^[a-f0-9]{64}$/.test(process.env.IMBUTO_GOOGLE_RELAY_SESSION || "");
}

async function googleDevFetch(input, options = {}) {
  if (!devSheetsReady()) throw new Error("Verified development Google relay required.");
  const url = new URL(input);
  if (url.protocol !== "https:" || url.port || url.username || url.password || url.hash) throw new Error("Google destination denied.");
  let path;
  if (url.hostname === "oauth2.googleapis.com" && url.pathname === "/token" && !url.search) path = "/token";
  else if (url.hostname === "sheets.googleapis.com" && (url.pathname === `/v4/spreadsheets/${config.spreadsheetId}` || url.pathname.startsWith(`/v4/spreadsheets/${config.spreadsheetId}/values/`) || url.pathname === `/v4/spreadsheets/${config.spreadsheetId}:batchUpdate`)) path = url.pathname + url.search;
  else throw new Error("Development Sheet destination denied.");
  const headers = new Headers(options.headers);
  headers.set("X-Imbuto-Relay-Session", process.env.IMBUTO_GOOGLE_RELAY_SESSION);
  return fetch(process.env.IMBUTO_GOOGLE_RELAY_URL + path, { ...options, headers, redirect: "error" });
}

module.exports = { devSheetsReady, googleDevFetch };
