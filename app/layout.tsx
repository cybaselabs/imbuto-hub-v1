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

export const metadata: Metadata = {
  metadataBase: new URL("https://imbutohub.com"),
  title: {
    default: "Imbuto Hubs",
    template: "%s | Imbuto Hubs",
  },
  description:
    "Inclusive community spaces across Rwanda for learning, wellbeing, creativity, and leadership development.",
  alternates: {
    canonical: "/",
  },
  openGraph: {
    title: "Imbuto Hubs",
    description: "A safe space to learn, grow, and thrive across Rwanda.",
    url: "/",
    siteName: "Imbuto Hubs",
    images: [
      {
        url: "/images/55271563510_75dc1f389e_k.jpg",
        width: 2048,
        height: 1152,
        alt: "An aerial view of an Imbuto Hub in Rwanda",
      },
    ],
    locale: "en_US",
    type: "website",
  },
  twitter: {
    card: "summary_large_image",
    title: "Imbuto Hubs",
    description: "A safe space to learn, grow, and thrive across Rwanda.",
    images: ["/images/55271563510_75dc1f389e_k.jpg"],
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
      <body className="min-h-full flex flex-col" suppressHydrationWarning>
        {children}
      </body>
    </html>
  );
}
