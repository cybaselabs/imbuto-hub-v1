"use client";

import { ArrowRight, ChevronRight, Sparkles, Users } from "lucide-react";
import { featureImage, aboutImage } from "./data";
import { Reveal, StaggerGrid, StaggerItem } from "./motion";

const featureBullets = [
  "Learning & mentorship",
  "Digital skills & innovation",
  "Wellbeing & counselling",
  "Sports, arts & culture",
];

export function AboutSection() {
  return (
    <section className="relative bg-[var(--color-yellow)] pb-10">
      <div className="pointer-events-none absolute -top-10 right-0 h-40 w-40 rounded-full bg-[#FFA45D]/20 blur-3xl" />
      <div className="pointer-events-none absolute bottom-0 left-0 h-56 w-56 rounded-full bg-[#016A6D]/15 blur-3xl" />

      <div className="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:grid lg:grid-cols-[0.9fr_1.1fr] lg:items-center lg:gap-14 lg:px-8 lg:py-24">
        <Reveal className="relative" delay={0.04}>
          <div className="group relative aspect-[4/5] overflow-hidden rounded-[36px] shadow-2xl">
            <div className="absolute inset-0 bg-[linear-gradient(145deg,#043E52,#016A6D)]" />
            <div
              className="absolute inset-0 bg-cover bg-center transition duration-700 group-hover:scale-[1.04]"
              style={{ backgroundImage: `url('${aboutImage}')` }}
            />
            <div className="absolute inset-0 bg-[linear-gradient(180deg,transparent,rgba(4,62,82,0.35))]" />

            <div className="absolute left-4 top-4 flex items-center gap-2 rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-[#043E52] shadow">
              <Sparkles className="h-3.5 w-3.5" />
              Community
            </div>

            <div className="absolute right-4 top-4 flex items-center gap-2 rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-[#043E52] shadow">
              <Users className="h-3.5 w-3.5" />
              Youth-first
            </div>
          </div>

          <div className="absolute -bottom-10 left-4 right-4 grid grid-cols-2 gap-3 md:left-6 md:right-auto md:w-[420px]">
            <Reveal delay={0.18}>
              <div className="rounded-2xl border border-[#E6E2D9] bg-white p-4 shadow-xl">
                <div className="text-2xl font-semibold text-[#043E52]">12+</div>
                <div className="text-xs uppercase tracking-[0.22em] text-slate-500">
                  Hubs
                </div>
              </div>
            </Reveal>

            <Reveal delay={0.24}>
              <div className="rounded-2xl border border-[#E6E2D9] bg-white p-4 shadow-xl">
                <div className="text-2xl font-semibold text-[#043E52]">
                  35k+
                </div>
                <div className="text-xs uppercase tracking-[0.22em] text-slate-500">
                  Youth reached
                </div>
              </div>
            </Reveal>
          </div>
        </Reveal>

        <Reveal className="lg:pl-8" delay={0.08}>
          <div className="inline-flex items-center gap-2 rounded-full border border-[#52b3a9]/20 bg-[#52b3a9] px-4 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-[#fff]">
            What Imbuto Hubs are
          </div>

          <h2 className="mt-5 text-4xl font-semibold tracking-[-0.04em] text-[#043E52] md:text-5xl">
            One place. Every opportunity.
          </h2>

          <StaggerGrid className="mt-6 grid gap-3 sm:grid-cols-2" delay={0.12}>
            {featureBullets.map((item) => (
              <StaggerItem key={item}>
                <div className="flex items-center gap-3 rounded-xl bg-[var(--color-dark)] px-4 py-3 shadow-sm ring-1 ring-slate-200/70">
                  <div className="flex h-8 w-8 items-center justify-center rounded-lg bg-[#ed9b37]/10 text-white">
                    <ChevronRight className="h-4 w-4" />
                  </div>
                  <div className="text-sm font-medium text-white">{item}</div>
                </div>
              </StaggerItem>
            ))}
          </StaggerGrid>

          <p className="mt-6 max-w-2xl text-lg leading-9 text-slate-600">
            Imbuto Hubs are community-centred spaces designed to support
            individuals from early childhood through adulthood. Each hub brings
            together learning, digital skills, wellbeing support, sports,
            creativity, and pathways to jobs and entrepreneurship, in a safe and
            welcoming environment embedded in the heart of the community.
          </p>

          <div className="mt-8 flex flex-wrap items-center gap-5">
            <button className="group inline-flex items-center gap-2 rounded-full bg-[#043E52] px-6 py-3.5 text-sm font-semibold text-white shadow-lg transition hover:bg-[#032c3b]">
              Learn More About Imbuto Hubs
              <ArrowRight className="h-4 w-4 transition group-hover:translate-x-0.5" />
            </button>
          </div>
        </Reveal>
      </div>
    </section>
  );
}
