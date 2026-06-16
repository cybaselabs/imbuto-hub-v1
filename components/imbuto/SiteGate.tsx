"use client";

import Image from "next/image";
import { FormEvent, useEffect, useState } from "react";

const storageKey = "imbuto-site-access";
const sitePassword = process.env.NEXT_PUBLIC_SITE_PASSWORD || "imbuto@2026";

export function SiteGate({ children }: { children: React.ReactNode }) {
  const [isReady, setIsReady] = useState(false);
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");

  useEffect(() => {
    setIsAuthenticated(window.localStorage.getItem(storageKey) === "granted");
    setIsReady(true);
  }, []);

  function handleSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();

    if (password.trim() === sitePassword) {
      window.localStorage.setItem(storageKey, "granted");
      setIsAuthenticated(true);
      setError("");
      return;
    }

    setError("Please enter the correct access password.");
  }

  if (!isReady) {
    return (
      <div className="min-h-screen bg-[#043E52]" aria-hidden="true" />
    );
  }

  if (isAuthenticated) {
    return <>{children}</>;
  }

  return (
    <main className="relative flex min-h-screen items-center justify-center overflow-hidden bg-[#043E52] px-6 py-10 text-white">
      <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(237,155,55,0.28),transparent_28%),radial-gradient(circle_at_bottom_right,rgba(82,179,169,0.22),transparent_32%)]" />
      <div className="relative w-full max-w-md rounded-[34px] border border-white/12 bg-white/10 p-7 shadow-2xl backdrop-blur-xl md:p-8">
        <Image
          src="/images/updated-IMBUTO LOGO-03.png"
          alt="Imbuto Hub Logo"
          width={150}
          height={60}
          className="h-12 w-auto"
          priority
        />
        <h1 className="mt-8 text-4xl leading-tight tracking-[-0.04em] text-white">
          Preview access
        </h1>
        <p className="mt-4 text-sm leading-7 text-white/74">
          This site is currently private while the Imbuto Hubs pages are being
          reviewed.
        </p>

        <form onSubmit={handleSubmit} className="mt-8">
          <label className="block">
            <span className="text-xs font-semibold uppercase tracking-[0.2em] text-[#f5c346]">
              Password
            </span>
            <input
              type="password"
              value={password}
              onChange={(event) => setPassword(event.target.value)}
              className="mt-3 h-12 w-full rounded-full border border-white/18 bg-white px-5 text-sm text-[#102c35] outline-none transition focus:border-[#f5c346]"
              autoFocus
            />
          </label>
          {error ? (
            <p className="mt-3 text-sm text-[#ffd1c0]">{error}</p>
          ) : null}
          <button
            type="submit"
            className="mt-6 w-full rounded-full bg-[#ed9b37] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#ed9b37]/25 transition hover:-translate-y-0.5 hover:bg-[#c05d24]"
          >
            Enter site
          </button>
        </form>
      </div>
    </main>
  );
}
