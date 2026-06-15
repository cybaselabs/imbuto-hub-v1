
"use client";

import Link from "next/link";
import { Container } from "./Container";
import { ctaImage } from "./data";

export function CtaSection() {
  return (
    <section className="relative isolate overflow-hidden bg-[#043E52] py-24">
      <div
        className="absolute inset-0 bg-cover bg-center"
        style={{ backgroundImage: `url('${ctaImage}')` }}
      />
      <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(4,62,82,0.94)_0%,rgba(4,62,82,0.78)_48%,rgba(4,62,82,0.56)_100%)]" />
      <div className="absolute inset-x-0 bottom-0 h-1/2 bg-[linear-gradient(0deg,rgba(225,106,61,0.42)_0%,rgba(225,106,61,0)_100%)]" />
      <Container className="relative max-w-6xl text-center text-white">
        <div className="text-sm uppercase tracking-[0.28em] text-[#f5c346]">
          Get involved
        </div>
        <h2 className="mx-auto mt-4 max-w-3xl text-5xl tracking-[-0.05em] text-white md:text-6xl">
          Your place in this story starts here.
        </h2>
        <p className="mx-auto mt-6 max-w-2xl text-lg leading-8 text-white/85">
          Whether you are a young person looking for opportunity, a professional ready to mentor, or an organisation that wants to invest in Rwanda&apos;s future, there is a role for you in Imbuto Hubs.
        </p>
        <div className="mt-10 flex flex-wrap justify-center gap-4">
          <Link
            href="/apply"
            className="rounded-full bg-white px-6 py-3.5 text-sm text-[#043E52] shadow-2xl transition hover:-translate-y-0.5"
          >
            Join a Hub
          </Link>
          <Link
            href="/get-involved#volunteer"
            className="rounded-full border border-white/35 bg-white/10 px-6 py-3.5 text-sm text-white backdrop-blur-md transition hover:bg-white/15"
          >
            Volunteer or Mentor
          </Link>
          <Link
            href="/get-involved#partner"
            className="rounded-full border border-white/35 bg-white/10 px-6 py-3.5 text-sm text-white backdrop-blur-md transition hover:bg-white/15"
          >
            Partner With Us
          </Link>
        </div>
      </Container>
    </section>
  );
}
