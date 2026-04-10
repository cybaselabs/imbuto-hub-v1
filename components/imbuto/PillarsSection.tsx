
"use client";

import { ArrowRight } from "lucide-react";
import { Container } from "./Container";
import { pillars } from "./data";

export function PillarsSection() {
  const playfulAccents = [
    {
      chip: "bg-[#ed9b37] text-white",
      glow: "bg-[#ed9b37]/18",
      iconBg: "bg-[#ed9b37]/20",
      iconText: "text-[#f5c346]",
      border: "border-[#ed9b37]/20",
    },
    {
      chip: "bg-[#52b3a9] text-white",
      glow: "bg-[#52b3a9]/18",
      iconBg: "bg-[#52b3a9]/20",
      iconText: "text-[#dffaf6]",
      border: "border-[#52b3a9]/20",
    },
    {
      chip: "bg-[#E16A3D] text-white",
      glow: "bg-[#E16A3D]/18",
      iconBg: "bg-[#E16A3D]/20",
      iconText: "text-[#ffe3d7]",
      border: "border-[#E16A3D]/20",
    },
    {
      chip: "bg-[#f5c346] text-[#102c35]",
      glow: "bg-[#f5c346]/18",
      iconBg: "bg-[#f5c346]/18",
      iconText: "text-[#f5c346]",
      border: "border-[#f5c346]/18",
    },
  ];

  return (
    <section className="relative overflow-hidden bg-[#053e52] py-20 md:py-24 lg:py-28">
      <div className="pointer-events-none absolute -top-16 right-0 h-56 w-56 rounded-full bg-[#ed9b37]/20 blur-3xl" />
      <div className="pointer-events-none absolute bottom-0 left-0 h-72 w-72 rounded-full bg-[#52b3a9]/16 blur-3xl" />
      <div className="pointer-events-none absolute left-1/3 top-1/2 h-40 w-40 rounded-full bg-[#f5c346]/12 blur-3xl" />

      <Container className="relative">
        <div className="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
          <div className="max-w-3xl">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-4 py-2 text-[11px] uppercase tracking-[0.24em] text-[#f5c346] backdrop-blur-sm">
              Programme pillars
            </div>
            <h2 className="mt-5 max-w-3xl text-4xl leading-[1.02] tracking-[-0.04em] text-white md:text-5xl">
              Explore programmes designed to spark growth, confidence, and joy.
            </h2>
            <p className="mt-4 max-w-2xl text-base leading-8 text-white/70 md:text-lg">
              A brighter, more energetic way to browse the Imbuto Hubs experience — still structured, but more expressive and youth-centred.
            </p>
          </div>

          <button className="inline-flex w-fit items-center gap-2 rounded-full bg-white px-5 py-3 text-sm text-[#043E52] shadow-lg transition hover:-translate-y-0.5 hover:bg-[#f8f4e7]">
            Explore All Programs
            <ArrowRight className="h-4 w-4" />
          </button>
        </div>

        <div className="mt-10 overflow-visible">
          <div className="flex snap-x snap-mandatory gap-5 overflow-x-auto px-1 py-3 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            {pillars.map((pillar, idx) => {
              const Icon = pillar.icon;
              const accent = playfulAccents[idx % playfulAccents.length];

              return (
                <div
                  key={pillar.title}
                  className={`group relative min-w-[300px] max-w-[300px] snap-start overflow-hidden rounded-[32px] border ${accent.border} bg-white/10 shadow-[0_26px_80px_rgba(0,0,0,0.18)] backdrop-blur-sm transition duration-300 hover:-translate-y-2 hover:rotate-[0.4deg] hover:shadow-[0_34px_100px_rgba(0,0,0,0.26)] md:min-w-[340px] md:max-w-[340px]`}
                >
                  <div className={`pointer-events-none absolute inset-0 opacity-0 transition duration-300 group-hover:opacity-100 ${accent.glow}`} />
                  <div className="pointer-events-none absolute -right-8 -top-8 h-24 w-24 rounded-full bg-white/10 blur-2xl" />

                  <div className="relative h-64 overflow-hidden p-6 text-white">
                    <div
                      className="absolute inset-0 bg-cover bg-center transition duration-700 group-hover:scale-[1.06]"
                      style={{ backgroundImage: `url(${pillar.image})` }}
                    />
                    <div className="absolute inset-0 bg-[linear-gradient(180deg,rgba(4,31,39,0.20),rgba(4,31,39,0.18),rgba(4,31,39,0.88))]" />
                    <div className="absolute inset-x-0 top-0 h-24 bg-[linear-gradient(180deg,rgba(255,255,255,0.08),transparent)]" />

                    <div className="relative z-10 flex items-start justify-between gap-3">
                      <div className={`inline-flex items-center rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.22em] shadow-sm ${accent.chip}`}>
                        Programme
                      </div>
                      <div className={`flex h-12 w-12 items-center justify-center rounded-2xl border border-white/10 backdrop-blur-md ${accent.iconBg} ${accent.iconText}`}>
                        <Icon className="h-5 w-5" />
                      </div>
                    </div>

                    <div className="relative z-10 mt-16 max-w-[250px] text-[30px] leading-[1.02] tracking-[-0.03em] text-white">
                      {pillar.title}
                    </div>
                  </div>

                  <div className="relative p-6 text-white">
                    <p className="max-w-[28ch] text-sm leading-7 text-white/72">{pillar.blurb}</p>
                    <div className="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[#f5c346]">
                      Learn more
                      <ArrowRight className="h-4 w-4 transition group-hover:translate-x-0.5" />
                    </div>
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
