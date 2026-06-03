import type { Metadata } from "next";
import Link from "next/link";
import {
  ArrowRight,
  CalendarDays,
  MapPinned,
  MessageCircle,
  Sparkles,
  Users,
} from "lucide-react";
import { Header } from "../../components/imbuto/Header";
import { Footer } from "../../components/imbuto/Footer";
import { Container } from "../../components/imbuto/Container";
import { ImpactStories } from "../../components/imbuto/ImpactStories";
import { ImpactGallery } from "../../components/imbuto/ImpactGallery";
import { ctaImage, hubsImage2 } from "../../components/imbuto/data";

export const metadata: Metadata = {
  title: "Impact",
  description:
    "Explore human impact, stories, facts, figures, and media from the Imbuto Hubs network across Rwanda.",
};

const impactFacts = [
  {
    value: "12",
    label: "Hubs Nationwide",
    icon: MapPinned,
    tone: "bg-[#fff1e3] text-[#c05d24]",
  },
  {
    value: "926,824",
    label: "Youth Empowered Through Youth Forums",
    icon: Users,
    tone: "bg-[#dff5f2] text-[#0f5b58]",
  },
];

function CtaLink({
  href,
  children,
  variant = "solid",
}: {
  href: string;
  children: React.ReactNode;
  variant?: "solid" | "light" | "outline";
}) {
  const classes =
    variant === "light"
      ? "bg-white text-[#043E52] shadow-2xl hover:-translate-y-0.5"
      : variant === "outline"
        ? "border border-white/35 bg-white/10 text-white backdrop-blur-md hover:bg-white/15"
        : "bg-[#ed9b37] text-white shadow-lg shadow-[#ed9b37]/25 hover:-translate-y-0.5 hover:bg-[#c05d24]";

  return (
    <Link
      href={href}
      className={`inline-flex items-center justify-center gap-2 rounded-full px-6 py-3.5 text-sm transition ${classes}`}
    >
      {children}
      <ArrowRight className="h-4 w-4" />
    </Link>
  );
}

function SectionEyebrow({ children }: { children: React.ReactNode }) {
  return (
    <div className="text-sm uppercase tracking-[0.28em] text-[#c05d24]">
      {children}
    </div>
  );
}

export default function ImpactPage() {
  return (
    <main className="bg-[#f7f7f2] text-[#102c35]">
      <Header />

      <section className="relative isolate overflow-hidden bg-[#043E52] pb-20 pt-32 text-white md:pb-28 md:pt-40">
        <div className="absolute inset-0">
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url('${hubsImage2}')` }}
          />
          <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(4,62,82,0.96)_0%,rgba(4,62,82,0.82)_48%,rgba(4,62,82,0.48)_100%)]" />
        </div>

        <Container className="relative">
          <div className="max-w-4xl">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md">
              <Sparkles className="h-4 w-4" />
              Impact & Media
            </div>
            <h1 className="mt-6 max-w-4xl text-5xl leading-[0.98] tracking-[-0.04em] text-[#f5c346]/95 md:text-7xl lg:text-[84px]">
              Impact from the Imbuto Hubs network.
            </h1>
            <p className="mt-7 max-w-3xl text-base leading-8 text-white/82 md:text-lg md:leading-9">
              Every number has a name. Every name has a story. Behind every
              statistic is a young person who showed up, took a chance, and
              discovered what they were capable of.
            </p>
            <div className="mt-9 flex flex-wrap gap-4">
              <CtaLink href="#stories" variant="light">
                Read Impact
              </CtaLink>
              <CtaLink href="#share-story" variant="outline">
                Share Your Story
              </CtaLink>
            </div>
          </div>
        </Container>
      </section>

      <section className="relative z-10 -mt-20 bg-transparent md:-mt-10">
        <Container>
          <div className="rounded-[36px] border border-white/70 bg-[#f7f7f2] p-6 text-[#102c35] shadow-[0_28px_90px_rgba(3,31,41,0.16)] md:p-8 lg:p-10">
            <div className="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
              <div>
                <div className="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-[11px] uppercase tracking-[0.26em] text-[#2b6274] shadow-sm">
                  <Sparkles className="h-3.5 w-3.5" />
                  Facts & Figures
                </div>
                <h2 className="mt-5 max-w-2xl text-4xl tracking-[-0.04em] md:text-5xl">
                  National reach. Human impact.
                </h2>
              </div>
              <p className="max-w-xl text-sm leading-7 text-slate-700 md:text-base">
                Behind every number is a person, a family, and a community
                moving forward with greater access, confidence, and opportunity.
              </p>
            </div>

            <div className="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
              {impactFacts.map((fact) => {
                const Icon = fact.icon;

                return (
                  <div
                    key={fact.label}
                    className="rounded-[26px] border border-slate-200/80 bg-white p-6 shadow-sm"
                  >
                    <div
                      className={`flex h-12 w-12 items-center justify-center rounded-2xl ${fact.tone}`}
                    >
                      <Icon className="h-5 w-5" />
                    </div>
                    <div className="mt-6 text-5xl tracking-[-0.05em] text-[#043E52]">
                      {fact.value}
                    </div>
                    <div className="mt-4 text-sm uppercase tracking-[0.2em] text-slate-500">
                      {fact.label}
                    </div>
                  </div>
                );
              })}
            </div>
          </div>
        </Container>
      </section>

      <ImpactStories />

      <ImpactGallery />

      <section className="relative overflow-hidden py-24">
        <div className="absolute inset-0 bg-[linear-gradient(135deg,rgba(225,106,61,0.94)_0%,rgba(255,164,93,0.84)_48%,rgba(4,62,82,0.64)_130%)]" />
        <div
          className="absolute inset-0 bg-cover bg-center opacity-35 mix-blend-overlay"
          style={{ backgroundImage: `url('${ctaImage}')` }}
        />
        <Container className="relative max-w-6xl text-center text-white">
          <h2 className="mx-auto max-w-3xl text-5xl tracking-[-0.05em] md:text-6xl">
            A place to belong and build.
          </h2>
          <p className="mx-auto mt-6 max-w-3xl text-base leading-8 text-white/85 md:text-lg">
            Imbuto Hubs create more than access. They create belonging. Through
            safe spaces, mentorship, practical learning, and community support,
            participants gain the confidence and direction needed to move
            forward, in school, in work, and in life.
          </p>
          <div className="mt-10 flex flex-wrap justify-center gap-4">
            <CtaLink href="#" variant="outline">
              Get Involved
            </CtaLink>
            <CtaLink href="/hubs" variant="light">
              Find Your Nearest Hub
            </CtaLink>
          </div>
        </Container>
      </section>
      <Footer />
    </main>
  );
}
