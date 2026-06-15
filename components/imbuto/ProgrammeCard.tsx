import type { LucideIcon } from "lucide-react";
import { ArrowRight } from "lucide-react";
import Link from "next/link";

export const programmeCardAccents = [
  {
    chip: "bg-[#ed9b37] text-white",
    glow: "bg-[#ed9b37]/18",
    iconBg: "bg-[#ed9b37]/20",
    iconText: "text-[#f5c346]",
    border: "border-[#ed9b37]/20",
  },
  {
    chip: "bg-[#52b3a9] text-white",
    glow: "bg-[#52b3a9]/18",
    iconBg: "bg-[#52b3a9]/20",
    iconText: "text-[#dffaf6]",
    border: "border-[#52b3a9]/20",
  },
  {
    chip: "bg-[#E16A3D] text-white",
    glow: "bg-[#E16A3D]/18",
    iconBg: "bg-[#E16A3D]/20",
    iconText: "text-[#ffe3d7]",
    border: "border-[#E16A3D]/20",
  },
  {
    chip: "bg-[#f5c346] text-[#102c35]",
    glow: "bg-[#f5c346]/18",
    iconBg: "bg-[#f5c346]/18",
    iconText: "text-[#f5c346]",
    border: "border-[#f5c346]/18",
  },
];

type ProgrammeCardProps = {
  title: string;
  description: React.ReactNode;
  image: string;
  icon: LucideIcon;
  accent?: (typeof programmeCardAccents)[number];
  layout?: "carousel" | "grid";
  href?: string;
  tone?: "dark" | "light";
};

export function ProgrammeCard({
  title,
  description,
  image,
  icon: Icon,
  accent = programmeCardAccents[0],
  layout = "carousel",
  href = "/Programmes",
  tone = "dark",
}: ProgrammeCardProps) {
  const sizeClass =
    layout === "carousel"
      ? "min-w-[300px] max-w-[300px] snap-start md:min-w-[340px] md:max-w-[340px]"
      : "w-full";
  const isLight = tone === "light";
  const cardClass = isLight
    ? "bg-[#285d6a] shadow-[0_24px_70px_rgba(16,44,53,0.12)] hover:shadow-[0_32px_90px_rgba(16,44,53,0.18)]"
    : "bg-white/10 shadow-[0_26px_80px_rgba(0,0,0,0.18)] backdrop-blur-sm hover:shadow-[0_34px_100px_rgba(0,0,0,0.26)]";
  const bodyTextClass = "text-white";
  const descriptionTextClass = "text-white/72";
  const linkTextClass = "text-[#f5c346]";

  return (
    <Link
      href={href}
      className={`group relative overflow-hidden rounded-[32px] border ${accent.border} ${sizeClass} ${cardClass} transition duration-300 hover:-translate-y-2 hover:rotate-[0.4deg]`}
    >
      <div
        className={`pointer-events-none absolute inset-0 opacity-0 transition duration-300 group-hover:opacity-100 ${accent.glow}`}
      />
      <div className="pointer-events-none absolute -right-8 -top-8 h-24 w-24 rounded-full bg-white/10 blur-2xl" />

      <div className="relative h-64 overflow-hidden p-6 text-white">
        <div
          className="absolute inset-0 bg-cover bg-center transition duration-700 group-hover:scale-[1.06]"
          style={{ backgroundImage: `url(${image})` }}
        />
        <div className="absolute inset-0 bg-[linear-gradient(180deg,rgba(4,31,39,0.20),rgba(4,31,39,0.18),rgba(4,31,39,0.88))]" />
        <div className="absolute inset-x-0 top-0 h-24 bg-[linear-gradient(180deg,rgba(255,255,255,0.08),transparent)]" />

        <div className="relative z-10 flex items-start justify-between gap-3">
          <div
            className={`inline-flex items-center rounded-full px-3 py-1 text-[10px] uppercase tracking-[0.22em] shadow-sm ${accent.chip}`}
          >
            Programme
          </div>
          <div
            className={`flex h-12 w-12 items-center justify-center rounded-2xl border border-white/10 backdrop-blur-md ${accent.iconBg} ${accent.iconText}`}
          >
            <Icon className="h-5 w-5" />
          </div>
        </div>

        <div className="relative z-10 mt-16 max-w-[250px] text-[30px] leading-[1.02] tracking-[-0.03em] text-white">
          {title}
        </div>
      </div>

      <div className={`relative flex min-h-[210px] flex-col p-6 ${bodyTextClass}`}>
        <div className={`max-w-[28ch] text-sm leading-7 ${descriptionTextClass}`}>
          {description}
        </div>
        <div className={`mt-auto inline-flex items-center gap-2 pt-6 text-sm font-semibold ${linkTextClass}`}>
          Learn more
          <ArrowRight className="h-4 w-4 transition group-hover:translate-x-0.5" />
        </div>
      </div>
    </Link>
  );
}
