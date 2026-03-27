"use client";

import { partners } from "./data";
import { Reveal, StaggerGrid, StaggerItem } from "./motion";

export function PartnersSection() {
  return (
    <section className="bg-[#f5f5f2] py-24">
      <Reveal className="mx-auto max-w-7xl px-6">
        <div className="overflow-hidden rounded-[40px] bg-[#f3f3ef] p-5 shadow-[0_24px_70px_rgba(15,23,42,0.08)] md:p-8">
          <div className="text-center">
            <div className="text-sm font-medium uppercase tracking-[0.28em] text-[#E16A3D]">Partners</div>
            <h2 className="mx-auto mt-4 max-w-4xl text-4xl font-semibold tracking-[-0.04em] text-[#043E52] md:text-5xl">
              Organisations working with Imbuto Hubs
            </h2>
          </div>

          <div className="mt-10 flex items-center gap-4 md:gap-6">
            <button className="flex h-12 w-12 shrink-0 items-center justify-center rounded-full border border-slate-300 bg-white text-[#043E52] shadow-sm transition hover:-translate-y-0.5 hover:border-[#016A6D]">
              <span aria-hidden="true">←</span>
            </button>

            <StaggerGrid className="grid flex-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-7" delay={0.08}>
              {partners.map((partner) => (
                <StaggerItem key={partner.name}>
                  <div className="flex min-h-[120px] items-center justify-center rounded-[26px] bg-white p-5 shadow-sm ring-1 ring-slate-200/80 transition hover:-translate-y-1 hover:shadow-md" title={partner.name}>
                    <img src={partner.logo} alt={partner.name} className="max-h-14 w-auto max-w-full object-contain" />
                  </div>
                </StaggerItem>
              ))}
            </StaggerGrid>

            <button className="flex h-12 w-12 shrink-0 items-center justify-center rounded-full border border-slate-300 bg-white text-[#043E52] shadow-sm transition hover:-translate-y-0.5 hover:border-[#016A6D]">
              <span aria-hidden="true">→</span>
            </button>
          </div>
        </div>
      </Reveal>
    </section>
  );
}
