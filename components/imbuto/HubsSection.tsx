"use client";

import { ArrowRight } from "lucide-react";
import { featureImage, hubCards } from "./data";
import { Reveal, StaggerGrid, StaggerItem } from "./motion";

export function HubsSection() {
  return (
    <section className="bg-[#c05d24] overflow-hidden py-24">
      <Reveal className="mx-auto max-w-7xl px-6">
        <div className="overflow-hidden rounded-[40px] bg-[#120f52] px-5 py-6 text-white shadow-[0_30px_90px_rgba(15,23,42,0.16)] md:px-7 md:py-7">
          <div className="grid gap-4 xl:grid-cols-[1.6fr_0.95fr]">
            <Reveal className="grid gap-4 rounded-[34px] bg-white/6 p-6 md:grid-cols-[0.95fr_1.05fr] md:p-8" delay={0.04}>
              <div className="flex flex-col justify-between">
                <div>
                  <div className="text-sm font-medium uppercase tracking-[0.26em] text-[#FFA45D]">Hub network</div>
                  <h2 className="mt-4 max-w-md text-4xl font-semibold tracking-[-0.04em] text-white md:text-5xl">Hubs. One national vision.</h2>
                  <p className="mt-5 max-w-md text-base leading-8 text-white/72">Explore Imbuto Hubs across Rwanda and quickly scan hub names and locations in a more visual, editorial layout.</p>
                </div>
                <div className="mt-8 flex flex-wrap gap-3">
                  <button className="rounded-full bg-[#E16A3D] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-[#E16A3D]/20 transition hover:bg-[#cf5d34]">View All Hubs</button>
                  <button className="rounded-full border border-white/15 bg-white/10 px-5 py-3 text-sm font-semibold text-white/90 backdrop-blur-md transition hover:bg-white/15">Find a Hub</button>
                </div>
              </div>

              <div className="relative min-h-[340px] overflow-hidden rounded-[30px] bg-[#dceef8]">
                <div className="absolute inset-0 bg-cover bg-center" style={{ backgroundImage: `url('${featureImage}')` }} />
                <div className="absolute inset-0 bg-gradient-to-r from-[#120f52]/20 via-transparent to-transparent" />
              </div>
            </Reveal>

            <Reveal className="grid gap-4" delay={0.1}>
              <div className="rounded-[30px] bg-white p-4 text-slate-900 shadow-sm ring-1 ring-black/5">
                <div className="overflow-hidden rounded-[22px] bg-[#dceef8]">
                  <div className="h-40 bg-cover bg-center" style={{ backgroundImage: `url('${featureImage}')` }} />
                </div>
                <div className="px-1 pb-1 pt-4">
                  <div className="text-2xl font-semibold text-[#111827]">Featured hub network</div>
                  <p className="mt-2 text-sm leading-6 text-slate-600">A growing national footprint connecting local communities to opportunity, learning, and wellbeing.</p>
                </div>
              </div>

              <div className="rounded-[30px] bg-[#016A6D] p-6 text-white shadow-sm">
                <div className="text-sm uppercase tracking-[0.24em] text-white/70">Hub locations</div>
                <div className="mt-3 text-3xl font-semibold leading-tight">Browse hubs by name and district.</div>
                <div className="mt-4 text-sm leading-7 text-white/80">This section can later link each card directly to its hub detail page.</div>
              </div>
            </Reveal>
          </div>

          <StaggerGrid className="mt-4 grid gap-4 md:grid-cols-2 xl:grid-cols-3" delay={0.14}>
            {hubCards.map((hub) => (
              <StaggerItem key={hub.name}>
                <div className={`rounded-[30px] p-6 shadow-sm transition hover:-translate-y-1 ${hub.tone}`}>
                  <div className="flex items-start justify-between gap-4">
                    <div className="max-w-[220px] text-3xl font-semibold leading-none tracking-[-0.04em]">{hub.name}</div>
                    <ArrowRight className="mt-1 h-7 w-7 opacity-70" />
                  </div>
                  <p className="mt-8 max-w-xs text-base leading-7 opacity-80">{hub.location}</p>
                </div>
              </StaggerItem>
            ))}
          </StaggerGrid>
        </div>
      </Reveal>
    </section>
  );
}
