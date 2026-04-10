"use client";

import { ArrowRight, Sparkles } from "lucide-react";
import { Container } from "./Container";
import { heroImage } from "./data";

function HeroStats() {
  return (
    <div className="hidden lg:block lg:justify-self-end">
      <div className="grid max-w-[500px] grid-cols-2 gap-5">
        <div className="row-span-2 min-h-[360px] rounded-[34px] border border-white/10 bg-[linear-gradient(180deg,rgba(10,122,138,0.28),rgba(25,80,92,0.18))] p-7 shadow-2xl backdrop-blur-md">
          <div className="text-5xl font-black leading-none text-[#FFA45D]">
            35K+
          </div>
          <div className="mt-4 text-[30px] leading-[1.02] text-white">
            Youth Reached
          </div>
          <div className="mt-6 h-px w-14 bg-white/20" />
          <p className="mt-6 max-w-[220px] text-lg leading-8 text-white/65">
            Young people across Rwanda gaining access to learning, skills, and
            opportunity.
          </p>
        </div>

        <div className="min-h-[165px] rounded-[30px] border border-white/10 bg-[linear-gradient(180deg,rgba(255,255,255,0.10),rgba(255,255,255,0.06))] p-6 shadow-2xl backdrop-blur-md">
          <div className="text-center text-5xl font-black leading-none text-white">
            12
          </div>
          <div className="mt-3 text-center text-base text-white/75">
            Hubs Nationwide
          </div>
        </div>

        <div className="min-h-[190px] rounded-[30px] border border-white/10 bg-[linear-gradient(180deg,rgba(255,255,255,0.10),rgba(255,255,255,0.06))] p-6 shadow-2xl backdrop-blur-md">
          <div className="text-5xl font-black leading-none text-[#ED7A3B]">
            8
          </div>
          <div className="mt-3 text-[28px] leading-[1.02] text-white">
            Programmes
          </div>
          <div className="mt-5 h-px w-10 bg-white/20" />
          <p className="mt-5 max-w-[190px] text-base leading-7 text-white/62">
            From early childhood through adulthood — every stage, every need.
          </p>
        </div>

        <div className="flex min-h-[120px] flex-col justify-center rounded-[28px] border border-white/10 bg-[linear-gradient(180deg,rgba(6,164,173,0.16),rgba(255,255,255,0.04))] p-5 shadow-2xl backdrop-blur-md">
          <div className="text-center text-4xl font-black leading-none text-[#2FD1C5]">
            150+
          </div>
          <div className="mt-2 text-center text-base text-white/72">
            Community Events
          </div>
        </div>

        <button className="col-span-1 rounded-[28px] bg-[#E56E3C] px-4 py-1 text-left shadow-xl shadow-[#E56E3C]/30 transition hover:bg-[#C05D24]">
          <div className="flex items-center justify-between gap-4">
            <div className="text-[30px] leading-[1.02] text-white">
              Your future starts here.
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

export function HeroSection() {
  return (
    <section className="relative isolate overflow-hidden bg-[#043E52] pb-16 pt-10 text-white md:pb-24 md:pt-32 lg:pb-28">
      <div className="absolute inset-0">
        <div
          className="absolute inset-0 bg-cover bg-center"
          style={{ backgroundImage: `url('${heroImage}')` }}
        />
        <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,164,93,0.28),transparent_30%),radial-gradient(circle_at_left_center,rgba(1,106,109,0.42),transparent_34%),linear-gradient(90deg,rgba(4,62,82,0.95)_0%,rgba(4,62,82,0.78)_44%,rgba(4,62,82,0.42)_100%)]" />
        <div className="absolute -left-28 top-24 h-72 w-72 rounded-full bg-[#E16A3D]/20 blur-3xl" />
        <div className="absolute bottom-0 right-0 h-80 w-80 rounded-full bg-[#016A6D]/30 blur-3xl" />
      </div>

      <Container className="relative pb-10 pt-14 md:pb-12 md:pt-16">
        <div className="grid gap-14 lg:grid-cols-[1fr_0.9fr] lg:items-center xl:gap-20">
          <div className="max-w-3xl">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md">
              <Sparkles className="h-4 w-4" />
              Community spaces for learning, wellbeing, creativity, and
              leadership
            </div>
            <h1 className="mt-6 max-w-[11ch] text-5xl leading-[0.96] tracking-[-0.04em] text-[#f5c346]/90 md:text-7xl lg:text-[82px]">
              A safe space to learn, grow, and lead.
            </h1>
            <p className="mt-6 max-w-[640px] text-base leading-8 text-white/80 md:text-lg md:leading-9">
              Imbuto Hubs are inclusive community spaces across Rwanda where
              children, youth, and families access learning, skills development,
              wellbeing support, sports, creativity, and leadership
              opportunities, all under one roof and embedded in the life of
              their community.
            </p>
          </div>

          <HeroStats />
        </div>
      </Container>
    </section>
  );
}
