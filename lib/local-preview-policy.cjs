const { devSheetsReady } = require("./google-dev-fetch.cjs");
function externalServicesEnabled() { return devSheetsReady(); }
function isLocalOnly() { return true; }
function submissionsAllowed() { return devSheetsReady() && process.env.IMBUTO_ENABLE_SUBMISSIONS === "true"; }
function localPreviewCsp() {
  return "default-src 'self'; script-src 'self' 'unsafe-inline'" +
    (process.env.NODE_ENV === "development" ? " 'unsafe-eval'" : "") +
    "; style-src 'self' 'unsafe-inline'; img-src 'self' data: blob:; font-src 'self' data:; media-src 'self' blob:; connect-src 'self'" +
    (process.env.NODE_ENV === "development" ? " ws://127.0.0.1:*" : "") +
    "; frame-src 'none'; object-src 'none'; base-uri 'self'; form-action none; frame-ancestors 'none'";
}
module.exports = { externalServicesEnabled, isLocalOnly, submissionsAllowed, localPreviewCsp };
