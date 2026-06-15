"use client";

import { DivideCircleIcon } from "lucide-react";
import { Container } from "./Container";
import { stats } from "./data";

export function StatsSection({
  variant = "dark",
}: {
  variant?: "dark" | "light";
}) {
  const isLight = variant === "light";

  return (
    <section
      className={`relative overflow-hidden py-20 md:py-24 lg:py-28 ${
        isLight ? "bg-[#f7f7f2] text-[#102c35]" : "bg-[#043E52] text-white"
      }`}
    >
      <div
        className={`absolute inset-0 ${
          isLight
            ? "bg-[radial-gradient(circle_at_top_left,rgba(237,155,55,0.14),transparent_24%),radial-gradient(circle_at_bottom_right,rgba(82,179,169,0.16),transparent_28%)]"
            : "bg-[radial-gradient(circle_at_top_left,rgba(255,164,93,0.22),transparent_22%),radial-gradient(circle_at_bottom_right,rgba(1,106,109,0.42),transparent_28%)]"
        }`}
      />
      <Container className="relative">
        <div className="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
          <div>
            <div
              className={`text-sm uppercase tracking-[0.26em] ${
                isLight ? "text-[#c05d24]" : "text-[#FFA45D]"
              }`}
            >
              Projected facts & figures
            </div>
            <h2
              className={`mt-4 text-4xl tracking-[-0.04em] md:text-5xl ${
                isLight ? "text-[#102c35]" : "text-white"
              }`}
            >
              Planned reach. Human impact.
            </h2>
          </div>
          <p
            className={`max-w-xl text-sm leading-7 md:text-base ${
              isLight ? "text-slate-700" : "text-white/72"
            }`}
          >
            Every number is a story in motion: a child learning, an artist
            creating, an athlete growing, a dream taking shape, a family finding
            support, and a community moving forward together.
          </p>
        </div>

        <div className="mt-16 grid gap-5 md:grid-cols-2 xl:grid-cols-4 xl:gap-6">
          {stats.map((stat) => (
            <div
              key={stat.label}
              className={`rounded-[28px] border p-7 backdrop-blur-md ${
                isLight
                  ? "border-slate-200/80 bg-white shadow-sm"
                  : "border-white/10 bg-white/5"
              }`}
            >
              <div
                className={`text-5xl tracking-[-0.05em] md:text-6xl ${
                  isLight ? "text-[#043E52]" : "text-white"
                }`}
              >
                {stat.value}
              </div>
              <div
                className={`mt-4 text-sm uppercase tracking-[0.22em] ${
                  isLight ? "text-slate-500" : "text-white/65"
                }`}
              >
                {stat.label}
              </div>
            </div>
          ))}
        </div>
      </Container>
    </section>
  );
}
