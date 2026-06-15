import type { Metadata } from "next";
import Link from "next/link";
import {
  ArrowRight,
  Sparkles,
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
            {/* <div className="mt-9 flex flex-wrap gap-4">
              <CtaLink href="#stories" variant="light">
                Read Impact
              </CtaLink>
              <CtaLink href="#share-story" variant="outline">
                Share Your Story
              </CtaLink>
            </div> */}
          </div>
        </Container>
      </section>

      <ImpactStories />

      <ImpactGallery />

      <section className="relative isolate overflow-hidden bg-[#043E52] py-24">
        <div
          className="absolute inset-0 bg-cover bg-center"
          style={{ backgroundImage: `url('${ctaImage}')` }}
        />
        <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(4,62,82,0.94)_0%,rgba(4,62,82,0.78)_48%,rgba(4,62,82,0.56)_100%)]" />
        <div className="absolute inset-x-0 bottom-0 h-1/2 bg-[linear-gradient(0deg,rgba(225,106,61,0.42)_0%,rgba(225,106,61,0)_100%)]" />
        <Container className="relative max-w-6xl text-center text-white">
          <h2 className="mx-auto max-w-3xl text-5xl tracking-[-0.05em] text-white md:text-6xl">
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
