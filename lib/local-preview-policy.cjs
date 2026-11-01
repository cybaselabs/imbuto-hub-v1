"use strict";
const { devSheetsReady } = require("./google-dev-fetch.cjs");

function productionSiteOnly() {
  return process.env.IMBUTO_RUNTIME === "production-site";
}
function externalServicesEnabled() { return !productionSiteOnly() && devSheetsReady(); }
function isLocalOnly() { return !productionSiteOnly(); }
function submissionsAllowed() {
  return !productionSiteOnly() && devSheetsReady() && process.env.IMBUTO_ENABLE_SUBMISSIONS === "true";
}
function allowedRequestHost(host, pathname) {
  if (!productionSiteOnly()) return /^(127\.0\.0\.1|localhost|\[::1\])(?::\d+)?$/i.test(host);
  if (["imbutohub.com", "www.imbutohub.com"].includes(host.toLowerCase())) return true;
  return pathname === "/healthz" && /^(127\.0\.0\.1|localhost)(?::\d+)?$/i.test(host);
}
function localPreviewCsp() {
  return "default-src 'self'; script-src 'self' 'unsafe-inline'" +
    (process.env.NODE_ENV === "development" ? " 'unsafe-eval'" : "") +
    "; style-src 'self' 'unsafe-inline'; img-src 'self' data: blob:; font-src 'self' data:; media-src 'self' blob:; connect-src 'self'" +
    (process.env.NODE_ENV === "development" ? " ws://127.0.0.1:*" : "") +
    "; frame-src 'none'; object-src 'none'; base-uri 'self'; form-action none; frame-ancestors 'none'";
}
module.exports = { externalServicesEnabled, isLocalOnly, submissionsAllowed, localPreviewCsp, productionSiteOnly, allowedRequestHost };
