"use client";

import { Container } from "./Container";
import { ages, lifeStageImage } from "./data";

export function LifeStageSection() {
  return (
    <section className="mx-auto max-w-[1440px] px-6 py-20 md:px-8 md:py-24 lg:px-10 lg:py-28 xl:px-14 2xl:px-20">
      <div className="relative overflow-hidden rounded-[40px] bg-[#f7f7f2] py-10 md:py-12 lg:py-14">
        <div className="pointer-events-none absolute -top-10 right-10 h-32 w-32 rounded-full bg-[#ed9b37]/16 blur-3xl" />
        <div className="pointer-events-none absolute bottom-0 left-6 h-40 w-40 rounded-full bg-[#52b3a9]/16 blur-3xl" />

        <div className="relative grid gap-8">
          <div className="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div className="rounded-[28px] bg-white p-8 shadow-sm ring-1 ring-slate-200/60">
              <div className="text-sm uppercase tracking-[0.24em] text-[#E16A3D]">
                Programmes by life stage
              </div>

              <h3 className="mt-4 text-4xl leading-tight tracking-[-0.04em] text-[#043E52] md:text-5xl">
                From early learning to purpose and leadership.
              </h3>

              <p className="mt-5 max-w-2xl text-base leading-8 text-slate-600">
                Imbuto Hubs support children, youth, and families through a
                connected journey of learning, wellbeing, creativity, sport,
                mentorship, and opportunity.
              </p>

              <div className="mt-6 flex flex-wrap gap-3">
                <button className="rounded-full bg-[#016A6D] px-5 py-3 text-sm text-white shadow-sm transition hover:bg-[#01585a]">
                  Explore age groups
                </button>
                <button className="rounded-full border border-[#016A6D]/20 bg-white px-5 py-3 text-sm text-[#016A6D] shadow-sm transition hover:bg-[#f8fffd]">
                  Find a Hub
                </button>
              </div>
            </div>

            <div className="overflow-hidden rounded-[28px]">
              <div
                className="min-h-[320px] h-full bg-cover bg-center"
                style={{ backgroundImage: `url('${lifeStageImage}')` }}
              />
            </div>
          </div>

          <div className="mt-2 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            {ages.map((item) => (
              <div
                key={item.age}
                className={`rounded-[28px] p-6 shadow-sm transition hover:-translate-y-1 ${item.tone}`}
              >
                <div className="flex items-start justify-between gap-4">
                  <div className="text-sm uppercase tracking-[0.22em] opacity-70">
                    {item.age}
                  </div>
                  <span className="text-xl opacity-70">→</span>
                </div>

                <h4 className="mt-6 text-[2rem] leading-none tracking-[-0.04em]">
                  {item.title}
                </h4>

                <p className="mt-6 max-w-xs text-base leading-7 opacity-80">
                  {item.desc}
                </p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}