import type { Metadata } from "next";
import Link from "next/link";
import { ArrowLeft, ArrowRight } from "lucide-react";
import { notFound } from "next/navigation";
import { Header } from "@/components/imbuto/Header";
import { Footer } from "@/components/imbuto/Footer";
import { Container } from "@/components/imbuto/Container";
import {
  getProgrammeBySlug,
  programmes,
} from "@/components/imbuto/programmes";

type ProgrammePageProps = {
  params: Promise<{ slug: string }>;
};

export function generateStaticParams() {
  return programmes.map((programme) => ({
    slug: programme.slug,
  }));
}

export async function generateMetadata({
  params,
}: ProgrammePageProps): Promise<Metadata> {
  const { slug } = await params;
  const programme = getProgrammeBySlug(slug);

  if (!programme) {
    return {
      title: "Programme not found",
    };
  }

  return {
    title: programme.title,
    description: programme.summary,
  };
}

function CtaLink({
  href,
  children,
  variant = "solid",
}: {
  href: string;
  children: React.ReactNode;
  variant?: "solid" | "outline";
}) {
  const classes =
    variant === "outline"
      ? "border border-[#102c35]/15 bg-white text-[#102c35] hover:bg-[#f7f7f2]"
      : "bg-[#ed9b37] text-white shadow-lg shadow-[#ed9b37]/25 hover:bg-[#c05d24]";

  return (
    <Link
      href={href}
      className={`inline-flex items-center justify-center gap-2 rounded-full px-6 py-3.5 text-sm transition hover:-translate-y-0.5 ${classes}`}
    >
      {children}
      <ArrowRight className="h-4 w-4" />
    </Link>
  );
}

export default async function ProgrammeDetailPage({
  params,
}: ProgrammePageProps) {
  const { slug } = await params;
  const programme = getProgrammeBySlug(slug);

  if (!programme) {
    notFound();
  }

  const Icon = programme.icon;

  return (
    <main className="bg-white text-[#102c35]">
      <Header />

      <section className="relative isolate overflow-hidden bg-[#043E52] pb-16 pt-32 text-white md:pb-20 md:pt-40">
        <div className="absolute inset-0">
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url('${programme.image}')` }}
          />
          <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(4,62,82,0.96)_0%,rgba(4,62,82,0.82)_54%,rgba(4,62,82,0.48)_100%)]" />
        </div>

        <Container className="relative">
          <Link
            href="/Programmes"
            className="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md transition hover:bg-white/15"
          >
            <ArrowLeft className="h-4 w-4" />
            Back to programmes
          </Link>

          <div className="mt-10 max-w-4xl">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-[#f5c346] backdrop-blur-md">
              <Icon className="h-4 w-4" />
              Programme
            </div>
            <h1 className="mt-6 max-w-4xl text-5xl leading-[0.98] tracking-[-0.04em] text-white md:text-7xl lg:text-[82px]">
              {programme.title}
            </h1>
            <p className="mt-7 max-w-3xl text-xl leading-9 text-white/82 md:text-2xl md:leading-10">
              {programme.tagline}
            </p>
          </div>
        </Container>
      </section>

      <section className="bg-white py-16 md:py-24">
        <Container>
          <div className="grid gap-10 lg:grid-cols-[0.72fr_1.28fr] lg:items-start">
            <div>
              <div className="inline-flex rounded-full border border-[#ed9b37]/20 bg-[#fff7ea] px-4 py-2 text-[11px] uppercase tracking-[0.28em] text-[#c05d24] shadow-sm">
                Programme overview
              </div>
              <h2 className="mt-6 max-w-lg text-4xl tracking-[-0.04em] md:text-5xl">
                What this programme offers.
              </h2>
            </div>

            <div className="rounded-[32px] bg-[#f7f7f2] p-7 shadow-sm ring-1 ring-slate-200/80 md:p-9">
              <p className="text-lg leading-9 text-slate-700">
                {programme.body}
              </p>
              <div className="mt-8 flex flex-wrap gap-4">
                <CtaLink href="/apply">Register Interest</CtaLink>
                <CtaLink href="/hubs#hub-map" variant="outline">
                  Find a Hub
                </CtaLink>
              </div>
            </div>
          </div>
        </Container>
      </section>

      <Footer />
    </main>
  );
}
