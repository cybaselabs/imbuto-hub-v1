"use client";

import { ctaImage } from "./data";
import { Reveal } from "./motion";

export function CtaSection() {
  return (
    <section className="relative overflow-hidden py-24">
      <div className="absolute inset-0 bg-[linear-gradient(135deg,#E16A3D_0%,#FFA45D_48%,#043E52_130%)]" />
      <div className="absolute inset-0 bg-cover bg-center opacity-25 mix-blend-overlay" style={{ backgroundImage: `url('${ctaImage}')` }} />
      <Reveal className="relative mx-auto max-w-6xl px-6 text-center text-white">
        <div className="text-sm font-medium uppercase tracking-[0.28em] text-white/75">Get involved</div>
        <h2 className="mx-auto mt-4 max-w-3xl text-5xl font-semibold tracking-[-0.05em] md:text-6xl">Your place in this story starts here.</h2>
        <p className="mx-auto mt-6 max-w-2xl text-lg leading-8 text-white/85">
          Whether you are a young person looking for opportunity, a professional ready to mentor, or an organisation that wants to invest in Rwanda&apos;s future, there is a role for you in Imbuto Hubs.
        </p>
        <div className="mt-10 flex flex-wrap justify-center gap-4">
          <button className="rounded-full bg-white px-6 py-3.5 text-sm font-semibold text-[#043E52] shadow-2xl transition hover:-translate-y-0.5">Join a Hub</button>
          <button className="rounded-full border border-white/35 bg-white/10 px-6 py-3.5 text-sm font-semibold text-white backdrop-blur-md transition hover:bg-white/15">Volunteer or Mentor</button>
          <button className="rounded-full border border-white/35 bg-white/10 px-6 py-3.5 text-sm font-semibold text-white backdrop-blur-md transition hover:bg-white/15">Partner With Us</button>
        </div>
      </Reveal>
    </section>
  );
}
