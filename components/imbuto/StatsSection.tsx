"use client";

import { Container } from "./Container";
import { stats } from "./data";

export function StatsSection() {
  return (
    <section className="relative overflow-hidden bg-[#043E52] py-20 text-white md:py-24 lg:py-28">
      <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,164,93,0.22),transparent_22%),radial-gradient(circle_at_bottom_right,rgba(1,106,109,0.42),transparent_28%)]" />
      <Container className="relative">
        <div className="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
          <div>
            <div className="text-sm uppercase tracking-[0.26em] text-[#FFA45D]">
              Facts & figures
            </div>
            <h2 className="mt-4 text-4xl tracking-[-0.04em] text-white md:text-5xl">
              National reach. Human impact.
            </h2>
          </div>
          <p className="max-w-xl text-sm leading-7 text-white/72 md:text-base">
            Behind every number is a person, a family, and a community moving
            forward with greater access, confidence, and opportunity.
          </p>
        </div>

        <div className="mt-16 grid gap-5 md:grid-cols-2 xl:grid-cols-4 xl:gap-6">
          {stats.map((stat) => (
            <div
              key={stat.label}
              className="rounded-[28px] border border-white/10 bg-white/5 p-7 backdrop-blur-md"
            >
              <div className="text-5xl tracking-[-0.05em] text-white md:text-6xl">
                {stat.value}
              </div>
              <div className="mt-4 text-sm uppercase tracking-[0.22em] text-white/65">
                {stat.label}
              </div>
            </div>
          ))}
        </div>
      </Container>
    </section>
  );
}
