"use client";

import { ArrowRight } from "lucide-react";
import { pillarBackgrounds, pillars } from "./data";
import { Reveal } from "./motion";

export function PillarsSection() {
  return (
    <section className="bg-[#053e52] overflow-hidden py-24">
      <Reveal className="mx-auto max-w-7xl px-6">
        <div className="overflow-hidden rounded-[40px] bg-[#2b6274]/20 px-6 py-8 text-white shadow-[0_30px_90px_rgba(15,23,42,0.12)] md:px-10 md:py-10">
          <div className="flex flex-col gap-6 border-b border-white/10 pb-8 lg:flex-row lg:items-end lg:justify-between">
            <div>
              <div className="text-sm font-medium uppercase tracking-[0.26em] text-[#FFA45D]">
                Programme pillars
              </div>
              <h2 className="mt-4 max-w-3xl text-4xl font-semibold tracking-[-0.04em] text-white md:text-5xl">
                Designed for the whole person, across every stage of
                development.
              </h2>
            </div>
            <button className="inline-flex w-fit items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-[#043E52] shadow-sm transition hover:-translate-y-0.5">
              Explore All Programs
              <ArrowRight className="h-4 w-4" />
            </button>
          </div>

          <div className="mt-8 overflow-hidden rounded-[32px] bg-white/5 ring-1 ring-white/10">
            <div className="flex snap-x  snap-mandatory gap-4 overflow-x-auto px-2 py-2 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
              {pillars.map((pillar, idx) => {
                const Icon = pillar.icon;
                return (
                  <Reveal key={pillar.title} delay={idx * 0.04} y={20}>
                    <div className="group min-w-[300px] max-w-[300px] snap-start overflow-hidden rounded-[28px] bg-white shadow-2xl shadow-black/10 transition duration-300 hover:-translate-y-2 md:min-w-[340px] md:max-w-[340px]">
                      <div
                        className="relative h-60 p-6 text-white bg-cover bg-center overflow-hidden"
                        style={{
                          backgroundImage: `url(${pillar.image})`,
                        }}
                      >
                        <div className="absolute inset-0 bg-gradient-to-t from-black/70 via-black/70 to-transparent" />
                        <div className="relative z-10 flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15 backdrop-blur-md">
                          <Icon className="h-6 w-6" />
                        </div>
                        <div className="relative z-10 mt-12 max-w-[230px] text-2xl font-semibold leading-tight tracking-[-0.03em]">
                          {pillar.title}
                        </div>
                      </div>
                      <div className="p-6 text-slate-900">
                        <p className="text-sm leading-7 text-slate-600">
                          {pillar.blurb}
                        </p>
                        <div className="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-[#043E52]">
                          Learn more
                          <ArrowRight className="h-4 w-4" />
                        </div>
                      </div>
                    </div>
                  </Reveal>
                );
              })}
            </div>
          </div>
        </div>
      </Reveal>
    </section>
  );
}
