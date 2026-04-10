"use client";

import { useMemo, useState } from "react";
import dynamic from "next/dynamic";
import { Container } from "./Container";
import { hubs } from "./data";

const HubsMap = dynamic(() => import("./HubsMap").then((mod) => mod.HubsMap), {
  ssr: false,
  loading: () => (
    <div className="h-[520px] w-full overflow-hidden rounded-[26px] bg-[#eaf3ef] animate-pulse" />
  ),
});

export function HubsSection() {
  const [activeHubId, setActiveHubId] = useState(hubs[0]?.id ?? "");

  const activeHub = useMemo(
    () => hubs.find((hub) => hub.id === activeHubId) ?? hubs[0],
    [activeHubId],
  );

  if (!activeHub) return null;

  return (
    <section className="bg-[#f7f7f2] py-20 md:py-24 lg:py-28">
      <Container>
        <div className="relative overflow-hidden rounded-[40px] bg-white px-6 py-8 shadow-[0_24px_70px_rgba(16,44,53,0.08)] ring-1 ring-slate-200/70 md:px-8 md:py-10 lg:px-10 lg:py-12">
          <div className="pointer-events-none absolute -top-10 right-10 h-32 w-32 rounded-full bg-[#ed9b37]/16 blur-3xl" />
          <div className="pointer-events-none absolute bottom-0 left-6 h-40 w-40 rounded-full bg-[#52b3a9]/16 blur-3xl" />

          <div className="relative grid gap-8 xl:grid-cols-[0.85fr_1.15fr] xl:items-center xl:gap-10">
            <div className="max-w-xl">
              <div className="text-sm uppercase tracking-[0.24em] text-[#E16A3D]">
                Hub network
              </div>

              <h2 className="mt-4 text-4xl leading-tight tracking-[-0.04em] text-[#102c35] md:text-5xl">
                Find an Imbuto Hub near you.
              </h2>

              <p className="mt-5 text-base leading-8 text-slate-600 md:text-lg">
                Explore the growing Imbuto Hub network across Rwanda and
                discover where learning, wellbeing, creativity, and opportunity
                are taking root.
              </p>

              <div className="mt-8 flex flex-wrap gap-3">
                <button className="rounded-full bg-[#016A6D] px-5 py-3 text-sm text-white shadow-sm transition hover:bg-[#01585a]">
                  Explore all hubs
                </button>
                <button className="rounded-full border border-[#016A6D]/20 bg-white px-5 py-3 text-sm text-[#016A6D] shadow-sm transition hover:bg-[#f8fffd]">
                  Find a Hub
                </button>
              </div>

              <div className="mt-8 grid gap-3 sm:grid-cols-2">
                {hubs.map((hub) => {
                  const isActive = hub.id === activeHubId;

                  return (
                    <button
                      key={hub.id}
                      type="button"
                      onMouseEnter={() => setActiveHubId(hub.id)}
                      onFocus={() => setActiveHubId(hub.id)}
                      className={`rounded-[20px] px-4 py-4 text-left ring-1 transition ${
                        isActive
                          ? "bg-[#102c35] text-white ring-[#102c35]"
                          : "bg-[#f7f7f2] text-[#102c35] ring-slate-200/70 hover:bg-[#f1f6f4]"
                      }`}
                    >
                      <div className="text-base">{hub.name}</div>
                      <div
                        className={`mt-1 text-sm ${
                          isActive ? "text-white/70" : "text-slate-500"
                        }`}
                      >
                        {hub.location}
                      </div>
                    </button>
                  );
                })}
              </div>
            </div>

            <div className="relative">
              <div className="mt-5 relative overflow-hidden rounded-[32px] bg-[#eaf3ef] p-4 shadow-sm ring-1 ring-slate-200/70">
                <HubsMap
                  hubs={hubs}
                  activeHubId={activeHubId}
                  onActiveHubChange={setActiveHubId}
                />
              </div>
            </div>
          </div>
        </div>
      </Container>
    </section>
  );
}
