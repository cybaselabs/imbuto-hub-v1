"use client";

import { ArrowRight, ChevronRight, Sparkles } from "lucide-react";
import { heroImage, quickActions } from "./data";
import { Reveal, StaggerGrid, StaggerItem } from "./motion";

function HeroStats() {
  return (
    <div className="hidden lg:block lg:justify-self-end">
      <div className="grid max-w-[520px] grid-cols-2 gap-4">
        <div className="row-span-2 rounded-[32px] border border-white/10 bg-[linear-gradient(180deg,rgba(10,122,138,0.28),rgba(25,80,92,0.18))] p-6 shadow-2xl backdrop-blur-md min-h-[345px]">
          <div className="text-5xl font-black leading-none text-[#FFA45D]">
            35K+
          </div>
          <div className="mt-3 text-2xl font-bold leading-tight text-white ![font-family:'Ruchill']">
            Youth Reached
          </div>
          <div className="mt-5 h-px w-14 bg-white/20" />
          <p className="mt-5 max-w-[220px] text-lg leading-8 text-white/65">
            Young people across Rwanda gaining access to learning, skills, and
            opportunity.
          </p>
        </div>

        <div className="rounded-[30px] border border-white/10 bg-[linear-gradient(180deg,rgba(255,255,255,0.10),rgba(255,255,255,0.06))] p-6 shadow-2xl backdrop-blur-md min-h-[160px]">
          <div className="text-center text-5xl font-black leading-none text-white">
            12
          </div>
          <div className="mt-2 text-center text-base text-white/75 ![font-family:'Ruchill']">
            Hubs Nationwide
          </div>
        </div>

        <div className="rounded-[30px] border border-white/10 bg-[linear-gradient(180deg,rgba(255,255,255,0.10),rgba(255,255,255,0.06))] p-6 shadow-2xl backdrop-blur-md min-h-[180px]">
          <div className="text-5xl font-black leading-none text-[#ED7A3B]">
            8
          </div>
          <div className="mt-2 text-2xl font-bold leading-tight text-white ![font-family:'Ruchill']">
            Programmes
          </div>
          <div className="mt-4 h-px w-10 bg-white/20" />
          <p className="mt-4 max-w-[190px] text-base leading-7 text-white/62">
            From early childhood through adulthood — every stage, every need.
          </p>
        </div>

        <div className="rounded-[28px] border border-white/10 bg-[linear-gradient(180deg,rgba(6,164,173,0.16),rgba(255,255,255,0.04))] p-5 shadow-2xl backdrop-blur-md min-h-[116px] flex flex-col justify-center">
          <div className="text-center text-4xl font-black leading-none text-[#2FD1C5] ">
            150+
          </div>
          <div className="mt-2 text-center text-base text-white/72 ![font-family:'Ruchill']">
            Community Events
          </div>
        </div>        

        <button className="col-span-1 rounded-[28px] bg-[#E56E3C] px-6 py-6 text-left shadow-xl shadow-[#E56E3C]/30 transition hover:bg-[#C05D24] min-h-[110px]">
          <div className="flex items-center justify-between gap-4">
            <div>
              <div className="max-w-[150px] text-3xl font-black leading-[1.05] text-white">
                Your future starts here.
              </div>
            </div>
            <div className="flex h-14 w-14 items-center justify-center rounded-full bg-white/15 text-white">
              <ArrowRight className="h-5 w-5" />
            </div>
          </div>
        </button>
      </div>
    </div>
  );
}

function QuickActionsSection({
  items,
}: {
  items: {
    title: string;
    subtitle: string;
    icon: React.ElementType;
  }[];
}) {
  return (
    <div className="mt-10">
      <StaggerGrid
        className="grid gap-4 sm:grid-cols-2 xl:grid-cols-4"
        delay={0.18}
      >
        {items.map((item) => {
          const Icon = item.icon;

          return (
            <StaggerItem key={item.title}>
              <div className="group rounded-[28px] border border-white/15 bg-[linear-gradient(145deg,rgba(43,98,116,0.85),rgba(16,44,53,0.85))] p-5 text-white shadow-2xl backdrop-blur-xl transition duration-300 hover:-translate-y-1 hover:bg-[linear-gradient(145deg,rgba(82,179,169,0.9),rgba(43,98,116,0.9))] min-h-[228px]">
                <div className="flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--color-orange)]/20 text-[var(--color-yellow)] ring-1 ring-white/20">
                  <Icon className="h-5 w-5" />
                </div>

                <h3 className="mt-5 text-[28px] font-black leading-[1.05] tracking-[-0.03em]">
                  {item.title}
                </h3>

                <p className="mt-3 text-sm leading-7 text-white/72">
                  {item.subtitle}
                </p>

                <div className="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-white/90">
                  Explore
                  <ChevronRight className="h-4 w-4 transition group-hover:translate-x-0.5" />
                </div>
              </div>
            </StaggerItem>
          );
        })}
      </StaggerGrid>
    </div>
  );
}

export function HeroSection() {
  return (
    <section className="relative isolate overflow-hidden bg-[#043E52] pb-4 pt-8 text-white md:pb-24 md:pt-28">
      <div className="absolute inset-0">
        <div
          className="absolute inset-0 bg-cover bg-center"
          style={{ backgroundImage: `url('${heroImage}')` }}
        />
        <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,164,93,0.35),transparent_30%),radial-gradient(circle_at_left_center,rgba(1,106,109,0.5),transparent_35%),linear-gradient(90deg,rgba(4,62,82,0.94)_0%,rgba(4,62,82,0.72)_45%,rgba(4,62,82,0.38)_100%)]" />
        <div className="absolute -left-28 top-24 h-72 w-72 rounded-full bg-[#E16A3D]/20 blur-3xl" />
        <div className="absolute bottom-0 right-0 h-80 w-80 rounded-full bg-[#016A6D]/30 blur-3xl" />
      </div>

      <div className="relative mx-auto max-w-7xl px-6 pb-4 pt-8 md:pb-4 md:pt-8">
        <div className="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
          <Reveal className="max-w-3xl" delay={0.05} y={24}>
            <div className="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md">
              <Sparkles className="h-4 w-4" />
              Community spaces for learning, wellbeing, creativity, and
              leadership
            </div>

            <h1 className="mt-4 max-w-2xl text-4xl font-semibold leading-[1.02] tracking-[-0.03em] md:text-6xl text-[var(--color-yellow)]/85">
              A safe space to learn, grow, and lead.
            </h1>

            <p className="mt-4 max-w-xl text-sm leading-7 text-white/80 md:text-base">
              Imbuto Hubs are inclusive community spaces across Rwanda where
              children, youth, and families access learning, skills
              development, wellbeing support, sports, creativity, and
              leadership opportunities, all under one roof and embedded in the
              life of their community.
            </p>

            <div className="mt-6 flex flex-wrap gap-3">
              <button className="group inline-flex items-center gap-2 rounded-full bg-[#E16A3D] px-6 py-3.5 text-sm font-semibold text-white shadow-xl shadow-[#E16A3D]/30 transition hover:-translate-y-0.5 hover:bg-[#cf5d34] ![font-family:'Ruchill']">
                Find a Hub
                <ArrowRight className="h-4 w-4 transition group-hover:translate-x-0.5" />
              </button>

              <button className="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-6 py-3.5 text-sm font-semibold text-white backdrop-blur-md transition hover:bg-white/15 ![font-family:'Ruchill']">
                Explore Programs
              </button>
            </div>
          </Reveal>

          <HeroStats />
        </div>

        <QuickActionsSection items={quickActions} />
      </div>
    </section>
  );
}