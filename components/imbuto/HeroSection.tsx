"use client";

import { ArrowRight, ChevronRight, Sparkles } from "lucide-react";
import { heroImage, quickActions } from "./data";
import { Reveal, StaggerGrid, StaggerItem } from "./motion";

export function HeroSection() {
  return (
    <section className="relative isolate overflow-hidden bg-[#043E52] pb-4 pt-8 text-white md:pb-24 md:pt-28">
      <div className="absolute inset-0">
        <div className="absolute inset-0 bg-cover bg-center" style={{ backgroundImage: `url('${heroImage}')` }} />
        <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,164,93,0.35),transparent_30%),radial-gradient(circle_at_left_center,rgba(1,106,109,0.5),transparent_35%),linear-gradient(90deg,rgba(4,62,82,0.94)_0%,rgba(4,62,82,0.72)_45%,rgba(4,62,82,0.38)_100%)]" />
        <div className="absolute -left-28 top-24 h-72 w-72 rounded-full bg-[#E16A3D]/20 blur-3xl" />
        <div className="absolute bottom-0 right-0 h-80 w-80 rounded-full bg-[#016A6D]/30 blur-3xl" />
      </div>

      <div className="relative mx-auto max-w-7xl px-6 pb-4 pt-8 md:pb-4 md:pt-8">
        <Reveal className="max-w-3xl" delay={0.05} y={24}>
          <div className="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md ">
            <Sparkles className="h-4 w-4" />
            Community spaces for learning, wellbeing, creativity, and leadership
          </div>

          <h1 className="mt-4 max-w-2xl text-4xl font-semibold leading-[1.02] tracking-[-0.03em] md:text-6xl text-[var(--color-yellow)]/85">
            A safe space to learn, grow, and lead.
          </h1>

          <p className="mt-4 max-w-xl text-sm leading-7 text-white/80 md:text-base">
            Imbuto Hubs are inclusive community spaces across Rwanda where children, youth, and families access learning, skills development, wellbeing support, sports, creativity, and leadership opportunities, all under one roof and embedded in the life of their community.
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

        <StaggerGrid className="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4" delay={0.18}>
          {quickActions.map((item) => {
            const Icon = item.icon;
            return (
              <StaggerItem key={item.title}>
                <div className="group rounded-[28px] border border-white/15 bg-white/10 p-5 text-white shadow-2xl backdrop-blur-xl transition duration-300 hover:-translate-y-1 hover:bg-white/15">
                  <div className="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/12 ring-1 ring-white/15">
                    <Icon className="h-5 w-5" />
                  </div>
                  <h3 className="mt-5 text-xl font-semibold">{item.title}</h3>
                  <p className="mt-2 text-sm leading-7 text-white/70">{item.subtitle}</p>
                  <div className="mt-5 inline-flex items-center gap-2 text-sm font-medium text-white/85">
                    Explore
                    <ChevronRight className="h-4 w-4 transition group-hover:translate-x-0.5" />
                  </div>
                </div>
              </StaggerItem>
            );
          })}
        </StaggerGrid>
      </div>
    </section>
  );
}
