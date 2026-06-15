"use client";

import dynamic from "next/dynamic";
import Link from "next/link";
import { useMemo, useState } from "react";
import {
  ArrowRight,
  CheckCircle2,
  Clock3,
  Filter,
  MapPinned,
  Search,
} from "lucide-react";
import { Header } from "../../components/imbuto/Header";
import { Footer } from "../../components/imbuto/Footer";
import { Container } from "../../components/imbuto/Container";
import { ctaImage, hubs, hubsImage } from "../../components/imbuto/data";

const HubsMap = dynamic(
  () => import("../../components/imbuto/HubsMap").then((mod) => mod.HubsMap),
  {
    ssr: false,
    loading: () => (
      <div className="h-[520px] w-full animate-pulse overflow-hidden rounded-[26px] bg-[#eaf3ef]" />
    ),
  },
);

const statusMeta = {
  Operational: {
    icon: CheckCircle2,
    className: "bg-[#dff5f2] text-[#0f5b58]",
    description: "Hub is open and programmes are running.",
  },
  "In Development": {
    icon: Clock3,
    className: "bg-[#fff1e3] text-[#a6511f]",
    description: "Hub is being built or programmes are being set up.",
  },
};

const provinceOptions = [
  "All provinces",
  "Kigali City",
  "Northern Province",
  "Southern Province",
  "Western Province",
  "Eastern Province",
];
const statusOptions = [
  "All statuses",
  "Operational",
  "In Development",
];
const programmeOptions = [
  "All programmes",
  "Early Childhood Development & Family",
  "Digital Literacy & Innovation",
  "Health & Wellbeing",
  "Sports & Recreation",
];

const facilitiesPool = [
  "Learning rooms",
  "ICT access",
  "Counselling space",
  "Sports facilities",
  "Creative studio",
  "Library",
  "Training rooms",
  "Community hall",
];

const programmePool = [
  "Early Childhood Development & Family",
  "Digital Literacy & Innovation",
  "Health & Wellbeing",
  "Sports & Recreation",
];

const hubDetails = hubs.map((hub, index) => {
  const facilities = facilitiesPool.slice(index % 3, (index % 3) + 5);
  const programmes = programmePool;

  return {
    ...hub,
    district: hub.name
      .replace("Imbuto Hub ", "")
      .replace(" (Maison de Jeunes)", ""),
    province: hub.location,
    facilities,
    programmes,
  };
});

type HubStatus = keyof typeof statusMeta;

function StatusBadge({ status }: { status: HubStatus }) {
  const meta = statusMeta[status];
  const Icon = meta.icon;

  return (
    <span
      className={`inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold ${meta.className}`}
    >
      <Icon className="h-3.5 w-3.5" />
      {status}
    </span>
  );
}

export function HubsPageClient() {
  const [activeHubId, setActiveHubId] = useState(hubs[0]?.id ?? "");
  const [query, setQuery] = useState("");
  const [province, setProvince] = useState("All provinces");
  const [status, setStatus] = useState("All statuses");
  const [programme, setProgramme] = useState("All programmes");

  const filteredHubs = useMemo(() => {
    const normalizedQuery = query.trim().toLowerCase();

    return hubDetails.filter((hub) => {
      const matchesQuery =
        !normalizedQuery ||
        [hub.name, hub.district, hub.province, hub.summary]
          .join(" ")
          .toLowerCase()
          .includes(normalizedQuery);
      const matchesProvince =
        province === "All provinces" || hub.province === province;
      const matchesStatus = status === "All statuses" || hub.status === status;
      const matchesProgramme =
        programme === "All programmes" || hub.programmes.includes(programme);

      return (
        matchesQuery && matchesProvince && matchesStatus && matchesProgramme
      );
    });
  }, [programme, province, query, status]);

  const mapHubs = filteredHubs.length > 0 ? filteredHubs : hubDetails;
  const activeHub =
    mapHubs.find((hub) => hub.id === activeHubId) ??
    mapHubs[0] ??
    hubDetails[0];

  return (
    <main className="bg-[#f7f7f2] text-[#102c35]">
      <Header />

      <section className="relative isolate overflow-hidden bg-[#043E52] pb-20 pt-32 text-white md:pb-24 md:pt-40">
        <div className="absolute inset-0">
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url('${hubsImage}')` }}
          />
          <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(4,62,82,0.96)_0%,rgba(4,62,82,0.82)_48%,rgba(4,62,82,0.52)_100%)]" />
        </div>

        <Container className="relative">
          <div className="max-w-4xl">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md">
              <MapPinned className="h-4 w-4" />
              Hub map
            </div>
            <h1 className="mt-6 max-w-4xl text-5xl leading-[0.98] tracking-[-0.04em] text-[#f5c346]/95 md:text-7xl lg:text-[84px]">
              Find an Imbuto Hub.
            </h1>
            <p className="mt-7 max-w-3xl text-base leading-8 text-white/82 md:text-lg md:leading-9">
              Find the nearest Imbuto Hub and explore what is available. Filter
              by province, district, hub status, and programme type.
            </p>
            
          </div>
        </Container>
      </section>
      <section id="hub-map" className="py-20 md:py-24">
        <Container>
          <div className="grid gap-8 lg:grid-cols-[0.78fr_1.22fr] lg:items-end">
            <div>
              <div className="text-sm uppercase tracking-[0.28em] text-[#c05d24]">
                Search and filter
              </div>
              <h2 className="mt-4 max-w-2xl text-4xl tracking-[-0.04em] md:text-5xl">
                Explore hubs by location, status, and programme.
              </h2>
            </div>
            <p className="max-w-3xl text-lg leading-9 text-slate-700 lg:justify-self-end">
              Each hub shows its current status, key facilities, available
              programmes, and how to visit or register.
            </p>
          </div>

          <div className="mt-10 grid gap-4 rounded-[30px] border border-slate-200/80 bg-white p-5 shadow-sm lg:grid-cols-[1.2fr_repeat(3,0.9fr)]">
            <label className="relative block">
              <Search className="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" />
              <input
                value={query}
                onChange={(event) => setQuery(event.target.value)}
                placeholder="Search by hub, district, or province"
                className="h-12 w-full rounded-full border border-slate-200 bg-[#f7f7f2] pl-11 pr-4 text-sm text-[#102c35] outline-none transition focus:border-[#52b3a9]"
              />
            </label>
            {[
              [province, setProvince, provinceOptions],
              [status, setStatus, statusOptions],
              [programme, setProgramme, programmeOptions],
            ].map(([value, setter, options], index) => (
              <label key={index} className="relative block">
                <Filter className="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" />
                <select
                  value={value as string}
                  onChange={(event) =>
                    (setter as (nextValue: string) => void)(event.target.value)
                  }
                  className="h-12 w-full appearance-none rounded-full border border-slate-200 bg-[#f7f7f2] pl-11 pr-4 text-sm text-[#102c35] outline-none transition focus:border-[#52b3a9]"
                >
                  {(options as string[]).map((option) => (
                    <option key={option}>{option}</option>
                  ))}
                </select>
              </label>
            ))}
          </div>

          <div className="mt-8 grid gap-8 xl:grid-cols-[0.92fr_1.08fr]">
            <div className="h-full overflow-hidden rounded-[32px] bg-[#eaf3ef] p-4 shadow-sm ring-1 ring-slate-200/70">
              <HubsMap
                hubs={mapHubs}
                activeHubId={activeHub?.id ?? ""}
                onActiveHubChange={setActiveHubId}
              />
            </div>

            <div id="hub-list" className="grid gap-4 md:grid-cols-2">
              {filteredHubs.length === 0 ? (
                <div className="rounded-[28px] border border-slate-200/80 bg-white p-8 text-slate-700 shadow-sm md:col-span-2">
                  No hubs match those filters yet. Try removing one filter or
                  search term.
                </div>
              ) : (
                filteredHubs.map((hub) => (
                  <article
                    key={hub.id}
                    onMouseEnter={() => setActiveHubId(hub.id)}
                    className={`rounded-[24px] border p-5 shadow-sm transition ${
                      activeHub?.id === hub.id
                        ? "border-[#102c35] bg-[#102c35] text-white"
                        : "border-slate-200/80 bg-white text-[#102c35] hover:-translate-y-1 hover:shadow-xl"
                    }`}
                  >
                    <div className="flex flex-wrap items-start justify-between gap-3">
                      <div>
                        <h3 className="text-2xl tracking-[-0.04em]">
                          {hub.name}
                        </h3>
                        <p
                          className={`mt-1.5 text-xs ${
                            activeHub?.id === hub.id
                              ? "text-white/70"
                              : "text-slate-500"
                          }`}
                        >
                          {hub.district} · {hub.province}
                        </p>
                      </div>
                      <StatusBadge status={hub.status as HubStatus} />
                    </div>

                    <p
                      className={`mt-4 text-sm leading-6 ${
                        activeHub?.id === hub.id
                          ? "text-white/78"
                          : "text-slate-700"
                      }`}
                    >
                      {hub.summary}
                    </p>

                    <Link
                      href="#"
                      className={`mt-4 inline-flex items-center gap-2 text-sm font-semibold ${
                        activeHub?.id === hub.id
                          ? "text-[#f5c346]"
                          : "text-[#0b4f63]"
                      }`}
                    >
                      View Hub
                      <ArrowRight className="h-4 w-4" />
                    </Link>
                  </article>
                ))
              )}
            </div>
          </div>
        </Container>
      </section>

      <Footer />
    </main>
  );
}
