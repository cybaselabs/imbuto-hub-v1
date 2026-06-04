"use client";

import { ArrowRight } from "lucide-react";
import Link from "next/link";
import { Container } from "./Container";
import { pillars } from "./data";
import { ProgrammeCard, programmeCardAccents } from "./ProgrammeCard";

export function PillarsSection() {
  return (
    <section className="relative overflow-hidden bg-[#053e52] py-20 md:py-24 lg:py-28">
      <div className="pointer-events-none absolute -top-16 right-0 h-56 w-56 rounded-full bg-[#ed9b37]/20 blur-3xl" />
      <div className="pointer-events-none absolute bottom-0 left-0 h-72 w-72 rounded-full bg-[#52b3a9]/16 blur-3xl" />
      <div className="pointer-events-none absolute left-1/3 top-1/2 h-40 w-40 rounded-full bg-[#f5c346]/12 blur-3xl" />

      <Container className="relative">
        <div className="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
          <div className="max-w-3xl">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-4 py-2 text-[11px] uppercase tracking-[0.24em] text-[#f5c346] backdrop-blur-sm">
              Programmes
            </div>
            <h2 className="mt-5 max-w-3xl text-4xl leading-[1.02] tracking-[-0.04em] text-white md:text-5xl">
              What we offer
            </h2>
            <p className="mt-4 max-w-2xl text-base leading-8 text-white/70 md:text-lg">
              A brighter, more energetic way to browse the Imbuto Hubs
              experience — still structured, but more expressive and
              youth-centred.
            </p>
          </div>

          <Link
            href="/programs"
            className="inline-flex w-fit items-center gap-2 rounded-full bg-white px-5 py-3 text-sm text-[#043E52] shadow-lg transition hover:-translate-y-0.5 hover:bg-[#f8f4e7]"
          >
            Explore All Programs
            <ArrowRight className="h-4 w-4" />
          </Link>
        </div>

        <div className="mt-10 overflow-visible">
          <div className="flex snap-x snap-mandatory gap-5 overflow-x-auto px-1 py-3 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            {pillars.map((pillar, idx) => {
              return (
                <ProgrammeCard
                  key={pillar.title}
                  title={pillar.title}
                  description={pillar.blurb}
                  image={pillar.image}
                  icon={pillar.icon}
                  accent={programmeCardAccents[idx % programmeCardAccents.length]}
                />
              );
            })}
          </div>
        </div>
      </Container>
    </section>
  );
}
