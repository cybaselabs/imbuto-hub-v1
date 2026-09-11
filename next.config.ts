import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  output: "standalone",
  async redirects() {
    return [
      {
        source: "/Programmes",
        destination: "/programmes",
        permanent: true,
      },
      {
        source: "/Programmes/:path*",
        destination: "/programmes/:path*",
        permanent: true,
      },
    ];
  },
  images: {
    unoptimized: true,
  },
};

export default nextConfig;
