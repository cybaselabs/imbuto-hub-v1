"use client";

import { ArrowRight, ChevronRight, Compass } from "lucide-react";
import { Container } from "./Container";
import { quickActions } from "./data";

export function ActionSection() {
  const accents = [
    {
      ring: "ring-[#ed9b37]/25",
      bg: "bg-[rgba(237,155,55,0.16)]",
      text: "text-[#c05d24]",
      hover: "group-hover:bg-[#ed9b37] group-hover:text-white",
    },
    {
      ring: "ring-[#52b3a9]/25",
      bg: "bg-[rgba(82,179,169,0.16)]",
      text: "text-[#016A6D]",
      hover: "group-hover:bg-[#52b3a9] group-hover:text-white",
    },
    {
      ring: "ring-[#E16A3D]/25",
      bg: "bg-[rgba(225,106,61,0.16)]",
      text: "text-[#E16A3D]",
      hover: "group-hover:bg-[#E16A3D] group-hover:text-white",
    },
    {
      ring: "ring-[#043E52]/25",
      bg: "bg-[rgba(4,62,82,0.16)]",
      text: "text-[#043E52]",
      hover: "group-hover:bg-[#043E52] group-hover:text-white",
    },
  ];

  return (
    <section className="relative z-10 -mt-4 pb-10 md:-mt-6 md:pb-12 lg:-mt-8 lg:pb-14">
      <Container>
        <div className="relative rounded-[40px] border border-slate-200/70 bg-[#f7f7f2] px-6 py-8 shadow-[0_30px_90px_rgba(16,44,53,0.10)] md:px-8 md:py-10 lg:px-10 lg:py-12">
          <div className="pointer-events-none absolute -top-10 right-10 h-32 w-32 rounded-full bg-[#ed9b37]/20 blur-3xl" />
          <div className="pointer-events-none absolute bottom-0 left-6 h-40 w-40 rounded-full bg-[#52b3a9]/20 blur-3xl" />

          <div className="relative flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div className="max-w-3xl">
              <div className="inline-flex items-center gap-2 rounded-full border border-[#2b6274]/10 bg-white px-4 py-2 text-[11px] uppercase tracking-[0.24em] text-[#2b6274] shadow-sm">
                <Compass className="h-4 w-4" />
                Your journey starts here
              </div>
              <h2 className="mt-5 max-w-2xl text-4xl leading-[1.02] tracking-[-0.04em] text-[#102c35] md:text-5xl">
                Choose the next step that fits you best.
              </h2>
              <p className="mt-4 max-w-2xl text-base leading-8 text-slate-600 md:text-lg">
                Ready to discover a Hub, explore programmes, or join the
                journey? Start here.
              </p>
            </div>

            <div className="flex flex-wrap gap-3">
              <button className="group inline-flex items-center gap-2 rounded-full bg-[#E16A3D] px-6 py-3.5 text-sm text-white shadow-xl shadow-[#E16A3D]/20 transition hover:-translate-y-0.5 hover:bg-[#cf5d34]">
                Find a Hub
                <ArrowRight className="h-4 w-4 transition group-hover:translate-x-0.5" />
              </button>
              <button className="inline-flex items-center gap-2 rounded-full border border-[#102c35]/10 bg-white px-6 py-3.5 text-sm text-[#102c35] shadow-sm transition hover:bg-slate-50">
                Explore Programs
              </button>
            </div>
          </div>

          <div className="mt-12 grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
            {quickActions.map((item, idx) => {
              const Icon = item.icon;
              const a = accents[idx % accents.length];
              return (
                <div
                  key={item.title}
                  className="group relative overflow-hidden rounded-[32px] border border-slate-200/80 bg-white p-6 text-[#102c35] shadow-[0_18px_60px_rgba(16,44,53,0.06)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_30px_90px_rgba(16,44,53,0.12)]"
                >
                  <div className="pointer-events-none absolute inset-0 opacity-0 transition duration-300 group-hover:opacity-100 bg-[radial-gradient(circle_at_top_left,rgba(255,164,93,0.12),transparent_40%),radial-gradient(circle_at_bottom_right,rgba(82,179,169,0.12),transparent_40%)]" />
                  <div
                    className={`relative flex h-12 w-12 items-center justify-center rounded-2xl ${a.bg} ${a.text} ring-1 ${a.ring} transition ${a.hover}`}
                  >
                    <Icon className="h-5 w-5" />
                  </div>
                  {/* <h3 className="relative mt-6 text-[30px] leading-[1.02] tracking-[-0.03em] text-[#102c35]">
                    {item.title}
                  </h3> */}
                  <div className="relative z-10 mt-6 max-w-[250px] text-[23px] leading-[1.02] tracking-[-0.03em] text-[#102c35] font-semibold">
                    {item.title}
                  </div>
                  <p className="relative mt-3 max-w-[26ch] text-sm leading-7 text-slate-600">
                    {item.subtitle}
                  </p>
                  <div className="relative mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[#2b6274]">
                    Explore
                    <ChevronRight className="h-4 w-4 transition group-hover:translate-x-0.5" />
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      </Container>
    </section>
  );
}
