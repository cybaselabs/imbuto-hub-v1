import type { Metadata } from "next";
import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata = {
  title: {
    default: "Imbuto Hubs",
    template: "%s | Imbuto Hubs",
  },
  description:
    "Inclusive community spaces across Rwanda for learning, wellbeing, creativity, and leadership development.",

  openGraph: {
    title: "Imbuto Hubs",
    description:
      "A safe space to learn, grow, and lead across Rwanda.",
    url: "https://imbutofoundation.org/", // update later
    siteName: "Imbuto Hubs",
    images: [
      {
        url: "https://webtesting.co.rw/obproperties/wp-content/uploads/2026/03/205.jpg", // 👈 important
        width: 1200,
        height: 630,
        alt: "Imbuto Hubs",
      },
    ],
    locale: "en_US",
    type: "website",
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html
      lang="en"
      className={`${geistSans.variable} ${geistMono.variable} h-full antialiased`}
    >
      <body className="min-h-full flex flex-col">{children}</body>
    </html>
  );
}
