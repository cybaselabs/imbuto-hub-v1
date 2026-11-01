"use strict";
const http = require("node:http");
const { localPreviewCsp } = require("../lib/local-preview-policy.cjs");
const emit = http.Server.prototype.emit;

http.Server.prototype.emit = function (event, ...args) {
  if (event === "upgrade") {
    const [request, socket] = args;
    let localOrigin = true;
    try {
      if (request.headers.origin) localOrigin = ["127.0.0.1", "localhost", "[::1]"].includes(new URL(request.headers.origin).hostname);
    } catch { localOrigin = false; }
    if (process.env.NODE_ENV !== "development" || !localOrigin ||
        !/^(127\.0\.0\.1|localhost|\[::1\])(?::\d+)?$/i.test(request.headers.host || "") ||
        !request.url?.startsWith("/_next/")) {
      socket.destroy();
      return false;
    }
  }
  if (event === "request") {
    const [request, response] = args;
    if (!/^(127\.0\.0\.1|localhost|\[::1\])(?::\d+)?$/i.test(request.headers.host || "")) {
      response.writeHead(403); response.end("Local preview host required"); return true;
    }
    response.setHeader("Content-Security-Policy", localPreviewCsp());
    response.setHeader("X-Imbuto-Local-Preview", "submissions-disabled");
    response.setHeader("X-Content-Type-Options", "nosniff");
    let pathname;
    try { pathname = decodeURIComponent(new URL(request.url, "http://127.0.0.1").pathname); }
    catch { response.writeHead(400); response.end("Invalid request"); return true; }
    if (!["GET", "HEAD"].includes(request.method) || /^\/api(?:\/|$)/i.test(pathname)) {
      response.writeHead(403, { "Content-Type": "application/json", "Cache-Control": "no-store" });
      response.end(JSON.stringify({ error: "Submissions are disabled in local preview.", preview: true }));
      request.resume();
      return true;
    }
  }
  return Reflect.apply(emit, this, [event, ...args]);
};
