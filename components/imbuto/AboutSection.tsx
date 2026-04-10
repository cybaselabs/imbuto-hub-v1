
"use client";

import { ArrowRight, ChevronRight, Sparkles, Users } from "lucide-react";
import { Container } from "./Container";
import { aboutImage } from "./data";

export function AboutSection() {
  const bullets = [
    "Learning & mentorship",
    "Digital skills & innovation",
    "Wellbeing & counselling",
    "Sports, arts & culture",
  ];

  return (
    <section className="relative pb-20 pt-5 md:pb-24 md:pt-12 lg:pb-28 lg:pt-5">
      <Container>
        <div className="relative rounded-[40px] border border-slate-200/70 bg-[#f7f7f2] px-6 py-8 shadow-[0_30px_90px_rgba(16,44,53,0.08)] md:px-8 md:py-10 lg:px-10 lg:py-12">
          <div className="pointer-events-none absolute -top-10 right-10 h-32 w-32 rounded-full bg-[#ed9b37]/20 blur-3xl" />
          <div className="pointer-events-none absolute bottom-0 left-6 h-40 w-40 rounded-full bg-[#52b3a9]/20 blur-3xl" />

          <div className="relative grid gap-12 lg:grid-cols-[0.92fr_1.08fr] lg:items-center lg:gap-16">
            <div className="relative">
              <div className="group relative aspect-[4/5] overflow-hidden rounded-[36px] shadow-2xl">
                <div className="absolute inset-0 bg-[linear-gradient(145deg,#043E52,#016A6D)]" />
                <div
                  className="absolute inset-0 bg-cover bg-center transition duration-700 group-hover:scale-[1.04]"
                  style={{ backgroundImage: `url('${aboutImage}')` }}
                />
                <div className="absolute inset-0 bg-[linear-gradient(180deg,transparent,rgba(4,62,82,0.35))]" />
                <div className="absolute left-4 top-4 flex items-center gap-2 rounded-full bg-white/90 px-3 py-1 text-xs text-[#043E52] shadow">
                  <Sparkles className="h-3.5 w-3.5" /> Community
                </div>
                <div className="absolute right-4 top-4 flex items-center gap-2 rounded-full bg-white/90 px-3 py-1 text-xs text-[#043E52] shadow">
                  <Users className="h-3.5 w-3.5" /> Youth-first
                </div>
              </div>
            </div>

            <div className="lg:pl-8">
              <div className="inline-flex items-center gap-2 rounded-full border border-[#2b6274]/10 bg-white px-4 py-2 text-[11px] uppercase tracking-[0.24em] text-[#2b6274] shadow-sm">
                What Imbuto Hubs are
              </div>
              <h2 className="mt-5 text-4xl tracking-[-0.04em] text-[#102c35] md:text-5xl">
                One place. Every opportunity.
              </h2>

              <div className="mt-6 grid gap-3 sm:grid-cols-2">
                {bullets.map((item) => (
                  <div key={item} className="flex items-center gap-3 rounded-xl bg-white px-4 py-3 shadow-sm ring-1 ring-slate-200/70">
                    <div className="flex h-8 w-8 items-center justify-center rounded-lg bg-[rgba(237,155,55,0.15)] text-[#c05d24]">
                      <ChevronRight className="h-4 w-4" />
                    </div>
                    <div className="text-sm text-slate-700">{item}</div>
                  </div>
                ))}
              </div>

              <p className="mt-6 max-w-2xl text-lg leading-9 text-slate-600">
                Imbuto Hubs are community-centred spaces designed to support individuals from early childhood through adulthood. Each hub brings together learning, digital skills, wellbeing support, sports, creativity, and pathways to jobs and entrepreneurship, in a safe and welcoming environment embedded in the heart of the community.
              </p>

              <div className="mt-8 flex flex-wrap items-center gap-5">
                <button className="group inline-flex items-center gap-2 rounded-full bg-[#043E52] px-6 py-3.5 text-sm text-white shadow-lg transition hover:bg-[#032c3b]">
                  Learn More About Imbuto Hubs
                  <ArrowRight className="h-4 w-4 transition group-hover:translate-x-0.5" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </Container>
    </section>
  );
}
