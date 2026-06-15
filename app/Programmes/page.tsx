import type { Metadata } from "next";
import Link from "next/link";
import { ArrowRight, Sparkles } from "lucide-react";
import { Header } from "../../components/imbuto/Header";
import { Footer } from "../../components/imbuto/Footer";
import { Container } from "../../components/imbuto/Container";
import { ctaImage, programmeImage } from "../../components/imbuto/data";
import { ProgrammeCardsGrid } from "../../components/imbuto/ProgrammeCardsGrid";

export const metadata: Metadata = {
  title: "Programmes",
  description:
    "Explore Imbuto Hubs programmes across early childhood and family, sports and recreation, digital literacy and innovation, and health and wellbeing.",
};

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

export default function ProgrammesPage() {
  return (
    <main className="bg-[#f7f7f2] text-[#102c35]">
      <Header />

      <section className="relative isolate overflow-hidden bg-[#043E52] pb-20 pt-32 text-white md:pb-24 md:pt-40">
        <div className="absolute inset-0">
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url('${programmeImage}')` }}
          />
          <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(4,62,82,0.96)_0%,rgba(4,62,82,0.82)_48%,rgba(4,62,82,0.52)_100%)]" />
        </div>

        <Container className="relative">
          <div className="max-w-4xl">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md">
              <Sparkles className="h-4 w-4" />
              Programmes
            </div>
            <h1 className="mt-6 max-w-4xl text-5xl leading-[0.98] tracking-[-0.04em] text-[#f5c346]/95 md:text-7xl lg:text-[84px]">
              Explore Imbuto Hubs programmes.
            </h1>
            <p className="mt-7 max-w-3xl text-base leading-8 text-white/82 md:text-lg md:leading-9">
              Every Imbuto Hub is a space of opportunity where young people and
              families can learn, create, grow, and connect. Our programmes are
              designed to support the whole person, at every stage of life,
              across every area of human development.
            </p>
            <div className="mt-9 flex flex-wrap gap-4">
              <CtaLink href="/apply">Register for a programme</CtaLink>
            </div>
          </div>
        </Container>
      </section>

    
      <section className="relative overflow-hidden bg-white py-20 text-[#102c35] md:py-24">
        <div className="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(82,179,169,0.12),transparent_34%),radial-gradient(circle_at_top_right,rgba(237,155,55,0.14),transparent_32%)]" />
        <Container>
          <div className="relative grid gap-8 lg:grid-cols-[0.72fr_1.28fr] lg:items-end">
            <div>
              <div className="inline-flex rounded-full border border-[#ed9b37]/20 bg-[#fff7ea] px-4 py-2 text-[11px] uppercase tracking-[0.28em] text-[#c05d24] shadow-sm">
                Programme pillars
              </div>
              <h2 className="mt-6 text-4xl tracking-[-0.04em] text-[#102c35] md:text-5xl">
                Support across every area of growth.
              </h2>
            </div>
            <p className="max-w-3xl text-lg leading-9 text-slate-700 lg:justify-self-end">
              Programmes are designed to meet young people and families where
              they are, with opportunities that combine learning, wellbeing,
              practical skills, creativity, and leadership.
            </p>
          </div>

          <div className="relative mt-12">
            <ProgrammeCardsGrid tone="light" />
          </div>
        </Container>
      </section>

      <section className="relative isolate overflow-hidden bg-[#043E52] py-24">
        <div
          className="absolute inset-0 bg-cover bg-center"
          style={{ backgroundImage: `url('${ctaImage}')` }}
        />
        <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(4,62,82,0.94)_0%,rgba(4,62,82,0.78)_48%,rgba(4,62,82,0.56)_100%)]" />
        <div className="absolute inset-x-0 bottom-0 h-1/2 bg-[linear-gradient(0deg,rgba(225,106,61,0.42)_0%,rgba(225,106,61,0)_100%)]" />
        <Container className="relative max-w-6xl text-center text-white">
          <div className="text-sm uppercase tracking-[0.28em] text-[#f5c346]">
            Ready to begin
          </div>
          <h2 className="mx-auto mt-4 max-w-3xl text-5xl tracking-[-0.05em] text-white md:text-6xl">
            Find the programme that fits your next step.
          </h2>
          <div className="mt-10 flex flex-wrap justify-center gap-4">
            <CtaLink href="/apply" variant="light">
              Register Interest
            </CtaLink>
            <CtaLink href="/hubs#hub-map" variant="outline">
              Find a Hub
            </CtaLink>
          </div>
        </Container>
      </section>

      <Footer />
    </main>
  );
}
