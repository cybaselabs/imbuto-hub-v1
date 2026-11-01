"use strict";
const http = require("node:http");
const config = require("../development-sheet.json");
const { submissionsAllowed, localPreviewCsp } = require("../lib/local-preview-policy.cjs");
const original = http.Server.prototype.emit;
http.Server.prototype.emit = function (event, ...args) {
  if (event === "upgrade") { args[1].destroy(); return false; }
  if (event === "request") {
    const [req, res] = args;
    if (req.headers.host !== `127.0.0.1:${config.port}`) { res.writeHead(403); res.end("Development loopback host required"); req.resume(); return true; }
    res.setHeader("Content-Security-Policy", localPreviewCsp());
    res.setHeader("X-Imbuto-Development-Sheets", "synthetic-only");
    res.setHeader("X-Content-Type-Options", "nosniff");
    let path;
    try { path = decodeURIComponent(new URL(req.url, "http://127.0.0.1").pathname); } catch { res.writeHead(400); res.end(); return true; }
    const allowedPost = ["/api/applications", "/api/get-involved"].includes(path) && req.method === "POST" && submissionsAllowed() && req.headers.origin === `http://127.0.0.1:${config.port}` && req.headers["x-imbuto-dev-test"] === "1" && (req.headers["content-type"] || "").startsWith("application/json");
    if ((!["GET", "HEAD"].includes(req.method) || /^\/api(?:\/|$)/i.test(path)) && !allowedPost) {
      res.writeHead(403, { "Content-Type": "application/json", "Cache-Control": "no-store" });
      res.end(JSON.stringify({ error: "Only explicit same-origin synthetic development submissions are allowed." })); req.resume(); return true;
    }
  }
  return Reflect.apply(original, this, [event, ...args]);
};
