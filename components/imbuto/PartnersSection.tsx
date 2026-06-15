"use client";

import { partners } from "./data";
import { Reveal, StaggerGrid, StaggerItem } from "./motion";

export function PartnersSection() {
  return (
    <section className="relative overflow-hidden bg-[#043E52] py-20 text-white md:py-24 lg:py-28">
      <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,164,93,0.22),transparent_22%),radial-gradient(circle_at_bottom_right,rgba(1,106,109,0.42),transparent_28%)]" />
      <Reveal className="mx-auto max-w-7xl px-6">
        <div className="overflow-hidden rounded-[40px] bg-[#f3f3ef] p-5 shadow-[0_24px_70px_rgba(15,23,42,0.08)] md:p-8 md:pb-16 pb-20 lg:pb-20">
          <div className="text-center">
            {/* <div className="text-sm font-medium uppercase tracking-[0.28em] text-[#E16A3D]">
              Partners
            </div> */}
            <h2 className="mx-auto mt-4 max-w-4xl text-4xl font-semibold tracking-[-0.04em] text-[#043E52] md:text-5xl">
              Our Partners
            </h2>
          </div>

          <div className="mt-10 flex justify-center">
            <StaggerGrid
              className="flex w-full flex-wrap justify-center gap-4"
              delay={0.08}
            >
              {partners.map((partner) => (
                <StaggerItem
                  key={partner.name}
                  className="w-full max-w-[240px] flex-none"
                >
                  <div
                    className="flex min-h-[150px] items-center justify-center rounded-[26px] bg-white p-6 shadow-sm ring-1 ring-slate-200/80 transition hover:-translate-y-1 hover:shadow-md"
                    title={partner.name}
                  >
                    <img
                      src={partner.logo}
                      alt={partner.name}
                      className="max-h-20 w-auto max-w-full object-contain"
                    />
                  </div>
                </StaggerItem>
              ))}
            </StaggerGrid>
          </div>
        </div>
      </Reveal>
    </section>
  );
}
