import http from "node:http";
import https from "node:https";
import { timingSafeEqual } from "node:crypto";

export function allowedGoogleTarget(path, sheetId, method) {
  let url;
  try { url = new URL(path, "http://127.0.0.1"); } catch { return null; }
  if (url.pathname === "/token" && method === "POST" && !url.search) return "https://oauth2.googleapis.com/token";
  const prefix = `/v4/spreadsheets/${sheetId}`;
  if (url.pathname === prefix && method === "GET") return `https://sheets.googleapis.com${url.pathname}${url.search}`;
  if (url.pathname.startsWith(`${prefix}/values/`) && ["GET", "PUT", "POST"].includes(method)) return `https://sheets.googleapis.com${url.pathname}${url.search}`;
  if (url.pathname === `${prefix}:batchUpdate` && method === "POST") return `https://sheets.googleapis.com${url.pathname}`;
  return null;
}

export async function startGoogleDevRelay(sheetId, session) {
  const server = http.createServer(async (req, res) => {
    const provided = String(req.headers["x-imbuto-relay-session"] || "");
    const suppliedBytes = Buffer.from(provided), expectedBytes = Buffer.from(session);
    const authorized = suppliedBytes.length === expectedBytes.length && timingSafeEqual(suppliedBytes, expectedBytes);
    const target = allowedGoogleTarget(req.url, sheetId, req.method);
    if (req.socket.remoteAddress !== "127.0.0.1" || req.headers.origin || !authorized || !target) {
      res.writeHead(403); res.end("Development relay denied"); req.resume(); return;
    }
    const chunks = []; let size = 0;
    try {
      for await (const chunk of req) {
        size += chunk.length;
        if (size > 262144) { res.writeHead(413); res.end(); return; }
        chunks.push(chunk);
      }
      const body = Buffer.concat(chunks);
      const headers = {};
      for (const name of ["authorization", "content-type"]) if (req.headers[name]) headers[name] = req.headers[name];
      const upstream = https.request(target, { method: req.method, headers, rejectUnauthorized: true, timeout: 15000, agent: false }, (reply) => {
        if ((reply.statusCode || 500) >= 300 && (reply.statusCode || 500) < 400) { reply.resume(); res.writeHead(502); res.end(); return; }
        res.writeHead(reply.statusCode || 502, { "Content-Type": reply.headers["content-type"] || "application/json", "Cache-Control": "no-store" });
        let received = 0;
        reply.on("data", (chunk) => { received += chunk.length; if (received > 2097152) { reply.destroy(); res.destroy(); } else res.write(chunk); });
        reply.on("end", () => res.end()); reply.on("error", () => res.destroy());
      });
      upstream.on("timeout", () => upstream.destroy());
      upstream.on("error", () => { if (!res.headersSent) res.writeHead(502); res.end("Development Google request failed"); });
      upstream.end(body);
    } catch { if (!res.headersSent) res.writeHead(400); res.end("Invalid development relay request"); }
  });
  await new Promise((resolve, reject) => { server.once("error", reject); server.listen(0, "127.0.0.1", resolve); });
  return { server, url: `http://127.0.0.1:${server.address().port}` };
}
