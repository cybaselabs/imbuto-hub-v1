import type { NextConfig } from "next";
import { isLocalOnly, localPreviewCsp } from "./lib/local-preview-policy.cjs";

const nextConfig: NextConfig = {
  output: "standalone",
  async headers() {
    return isLocalOnly() ? [{ source: "/:path*", headers: [
      { key: "Content-Security-Policy", value: localPreviewCsp() },
      { key: "X-Content-Type-Options", value: "nosniff" },
      { key: "Referrer-Policy", value: "no-referrer" },
    ] }] : [];
  },
  images: {
    unoptimized: true,
  },
};

export default nextConfig;
