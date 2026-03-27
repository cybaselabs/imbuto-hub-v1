"use client";

import { ArrowRight } from "lucide-react";
import { ages, featureImage } from "./data";
import { Reveal, StaggerGrid, StaggerItem } from "./motion";

export function LifeStageSection() {
  return (
    <section className="mx-auto max-w-7xl px-6 py-24">
      <Reveal className="rounded-[36px] bg-[#eef4f1] p-4 md:p-5">
        <div className="grid gap-4 xl:grid-cols-[1.65fr_0.9fr]">
          <Reveal className="grid gap-4 overflow-hidden rounded-[32px] bg-[#d9ebe7] p-8 md:grid-cols-[1.05fr_0.95fr]" delay={0.04}>
            <div className="flex flex-col justify-between">
              <div>
                <div className="text-sm font-medium uppercase tracking-[0.24em] text-[#E16A3D]">Programmes by life stage</div>
                <h3 className="mt-4 max-w-md text-4xl font-semibold leading-tight tracking-[-0.04em] text-[#043E52] md:text-5xl">
                  From early learning to purpose and leadership.
                </h3>
                <p className="mt-5 max-w-md text-base leading-8 text-slate-600">
                  Imbuto Hubs support children, youth, and families through a connected journey of learning, wellbeing, creativity, sport, mentorship, and opportunity.
                </p>
              </div>
              <div className="mt-8 flex flex-wrap gap-3">
                <button className="rounded-full bg-[#016A6D] px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#01585a]">Explore age groups</button>
                <button className="rounded-full border border-[#016A6D]/25 bg-transparent px-5 py-3 text-sm font-semibold text-[#016A6D] hover:bg-white/50">Find a Hub</button>
              </div>
            </div>

            <div className="relative min-h-[320px] overflow-hidden rounded-[28px] bg-white/40">
              <div className="absolute inset-0 bg-cover bg-center" style={{ backgroundImage: `url('${featureImage}')` }} />
              <div className="absolute inset-0 bg-gradient-to-t from-[#043E52]/15 via-transparent to-transparent" />
            </div>
          </Reveal>

          <Reveal className="grid gap-4" delay={0.1}>
            <div className="rounded-[28px] bg-white p-4 shadow-sm ring-1 ring-slate-200/70">
              <div className="overflow-hidden rounded-[22px] bg-[#dff0eb]">
                <div className="h-44 bg-cover bg-center" style={{ backgroundImage: `url('${featureImage}')` }} />
              </div>
              <div className="px-1 pb-1 pt-4">
                <div className="text-2xl font-semibold text-[#043E52]">Whole-person growth</div>
                <p className="mt-2 text-sm leading-6 text-slate-600">Programmes connect education, wellbeing, skills, creativity, and leadership in one trusted space.</p>
              </div>
            </div>

            <div className="rounded-[28px] bg-[#016A6D] p-6 text-white shadow-sm">
              <div className="text-sm uppercase tracking-[0.24em] text-white/70">Across all stages</div>
              <div className="mt-3 text-3xl font-semibold leading-tight">A connected journey, not isolated programmes.</div>
              <div className="mt-4 text-sm leading-7 text-white/80">From ages 1–6, 7–12, 13–18, and 18+, every step opens the next one.</div>
            </div>
          </Reveal>
        </div>

        <StaggerGrid className="mt-4 grid gap-4 md:grid-cols-2 xl:grid-cols-4" delay={0.14}>
          {ages.map((item, index) => (
            <StaggerItem key={`${item.age}-feature`}>
              <div className={`rounded-[28px] p-6 shadow-sm ${
                index === 0 ? "bg-[#d9ea52] text-[#0b2f3b]" :
                index === 1 ? "bg-white text-[#0b2f3b]" :
                index === 2 ? "bg-[#d6a7f4] text-[#161616]" :
                "bg-[#e9f0ec] text-[#0b2f3b]"
              }`}>
                <div className="flex items-start justify-between gap-4">
                  <div className="text-sm font-medium uppercase tracking-[0.22em] opacity-70">{item.age}</div>
                  <ArrowRight className="h-6 w-6 opacity-70" />
                </div>
                <h4 className="mt-6 text-[2rem] font-semibold leading-none tracking-[-0.04em]">{item.title}</h4>
                <p className="mt-6 max-w-xs text-base leading-7 opacity-80">{item.desc}</p>
              </div>
            </StaggerItem>
          ))}
        </StaggerGrid>
      </Reveal>
    </section>
  );
}
