import type { Metadata } from "next";
import Image from "next/image";
import Link from "next/link";
import {
  ArrowRight,
  BookOpen,
  Briefcase,
  CheckCircle2,
  Compass,
  Flag,
  Handshake,
  HeartPulse,
  Leaf,
  Lightbulb,
  ShieldCheck,
  Sparkles,
  Users,
} from "lucide-react";
import { Header } from "../../components/imbuto/Header";
import { Footer } from "../../components/imbuto/Footer";
import { Container } from "../../components/imbuto/Container";
import { aboutImage, ctaImage } from "../../components/imbuto/data";

export const metadata: Metadata = {
  title: "About Imbuto Hubs",
  description:
    "Learn about the Imbuto Hubs model, founding philosophy, values, and national relevance across Rwanda.",
};

const modelItems = [
  {
    text: "Provides a mixed portfolio of programmes and spaces aligned with the needs of its community.",
    icon: Compass,
    tone: "bg-[#fff1e3] text-[#c05d24]",
  },
  {
    text: "Supports participants across four life stages, from early childhood through adulthood.",
    icon: Users,
    tone: "bg-[#dff5f2] text-[#2b6274]",
  },
  {
    text: "Connects participants to mentors, partners, and practical opportunities.",
    icon: Sparkles,
    tone: "bg-[#fde4dc] text-[#c05d24]",
  },
  {
    text: "Delivers programmes primarily through partnerships with registered associations, NGOs, and institutions.",
    icon: Handshake,
    tone: "bg-[#dde9ee] text-[#2b6274]",
  },
  {
    text: "Expands as new hubs are established across Rwanda.",
    icon: Flag,
    tone: "bg-[#f8e7a8] text-[#8f5217]",
  },
];

const values = [
  {
    title: "Excellence",
    text: "We hold ourselves to the highest standards in what we deliver, how we operate, and who we are.",
    icon: ShieldCheck,
  },
  {
    title: "Integrity",
    text: "We are transparent, honest, and accountable in everything we do.",
    icon: CheckCircle2,
  },
  {
    title: "Innovation",
    text: "We embrace new ideas and creative approaches to deliver greater impact.",
    icon: Lightbulb,
  },
  {
    title: "Solidarity",
    text: "We believe in the power of community, we grow stronger together than apart.",
    icon: Handshake,
  },
  {
    title: "Commitment",
    text: "We show up, every day, for every young person we serve.",
    icon: Sparkles,
  },
];

const lifeStages = [
  {
    age: "Ages 1-6",
    title: "Early Childhood",
    text: "Integrated ECD package, life skills, family concept, play-based learning, caregiver support, intergenerational exchange, and green growth.",
    icon: Leaf,
  },
  {
    age: "Ages 7-12",
    title: "Discovery",
    text: "Digital literacy, recreational activities, adapted ASRH introduction, life skills, sports, science of money, environmental education, and intergenerational exchange.",
    icon: BookOpen,
  },
  {
    age: "Ages 13-18",
    title: "Growth",
    text: "Non-formal education, history and identity, adapted ASRH&R, financial literacy, science of money, life skills, sports, leadership and active citizenship, and intergenerational exchange.",
    icon: Flag,
  },
  {
    age: "Ages 18+",
    title: "Purpose",
    text: "Entrepreneurship and innovation, decent and productive job creation, family planning, sports, leadership and active citizenship, and intergenerational exchange.",
    icon: Briefcase,
  },
];

function SectionEyebrow({ children }: { children: React.ReactNode }) {
  return (
    <div className="text-sm uppercase tracking-[0.28em] text-[#c05d24]">
      {children}
    </div>
  );
}

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

export default function AboutPage() {
  return (
    <main className="bg-[#f7f7f2] text-[#102c35]">
      <Header />

      <section className="relative isolate overflow-hidden bg-[#043E52] pb-20 pt-32 text-white md:pb-45 md:pt-60">
        <div className="absolute inset-0">
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url('${aboutImage}')` }}
          />
          <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(4,62,82,0.96)_0%,rgba(4,62,82,0.82)_48%,rgba(4,62,82,0.52)_100%)]" />
        </div>

        <Container className="relative">
          <div className="max-w-4xl">
            <h1 className="mt-6 max-w-4xl text-5xl leading-[0.98] tracking-[-0.04em] text-[#f5c346]/95 md:text-7xl lg:text-[84px]">
              About Imbuto Hubs
            </h1>
            <p className="mt-7 max-w-3xl text-base leading-8 text-white/82 md:text-lg md:leading-9">
              Imbuto Hubs are inclusive, accessible community spaces that
              connect education, wellbeing, skills, creativity, sport, and
              leadership, designed to support children, youth, and families at
              every stage of life in a single trusted space embedded within
              their community.
            </p>
          </div>
        </Container>
      </section>

      <section className="py-20 md:py-24">
        <Container>
          <div className="grid gap-10 lg:grid-cols-[0.92fr_1.08fr] lg:items-center">
            <div className="overflow-hidden rounded-[32px] border border-[#102c35]/10 bg-white shadow-[0_24px_80px_rgba(16,44,53,0.10)]">
              <div className="relative aspect-[3/2] bg-[#102c35]">
                <Image
                  src="/images/about/54542336239_4fffa8e888_k.jpg"
                  alt="H.E. Mrs Jeannette Kagame"
                  fill
                  sizes="(min-width: 1440px) 560px, (min-width: 1024px) 42vw, 100vw"
                  quality={100}
                  className="object-cover object-center"
                  priority
                />
                <div className="absolute inset-0 bg-[linear-gradient(180deg,transparent_65%,rgba(16,44,53,0.32))]" />
              </div>
            </div>

            <div>
              <SectionEyebrow>Founding Philosophy</SectionEyebrow>
              <h2 className="mt-4 max-w-2xl font-sans text-4xl font-semibold leading-tight tracking-normal md:text-5xl">
                Imbuto means seed.
              </h2>
              <p className="mt-6 max-w-2xl text-lg leading-9 text-slate-700">
                In Kinyarwanda, this word means seed, and like a seed given the
                right conditions, every young Rwandan has the potential to grow
                into something extraordinary.
              </p>
              <blockquote className="mt-8 border-l-4 border-[#ed9b37] pl-6 font-sans text-xl font-medium leading-9 text-[#102c35] md:text-2xl md:leading-10">
                &quot;A seed well planted, watered, nurtured, and given all the
                necessary support successfully grows into a healthy plant, one
                that reaches high and stands tall.&quot;
              </blockquote>
              <p className="mt-6 max-w-xl text-sm font-semibold leading-7 tracking-normal text-[#2b6274]">
                H.E. Mrs Jeannette Kagame, First Lady of Rwanda & Chairperson,
                Imbuto Foundation
              </p>
            </div>
          </div>
        </Container>
      </section>

      <section className="bg-white py-20 md:py-24">
        <Container>
          <div className="grid gap-6 lg:grid-cols-3">
            <div className="rounded-[28px] border border-slate-200/80 bg-[#102c35] p-8 text-white md:p-10">
              <SectionEyebrow>Motto</SectionEyebrow>
              <h2 className="mt-4 text-4xl tracking-[-0.04em] text-[#f5c346]">
                Rooted in community.
              </h2>
              <p className="mt-5 text-base leading-8 text-white/78">
                Imbuto Hubs are grounded in the people, families, and local
                partnerships that shape each community&apos;s growth.
              </p>
            </div>
            <div className="rounded-[28px] border border-slate-200/80 bg-[#f7f7f2] p-8 md:p-10">
              <SectionEyebrow>Vision</SectionEyebrow>
              <h2 className="mt-4 text-4xl tracking-[-0.04em]">
                A thriving, empowered, and inclusive Rwanda.
              </h2>
              <p className="mt-5 text-base leading-8 text-slate-700">
                A Rwanda where every individual, from childhood to adulthood, is
                healthy, educated, and equipped to contribute meaningfully to
                their community and the nation&apos;s sustainable development.
              </p>
            </div>
            <div className="rounded-[28px] border border-slate-200/80 bg-[#dff5f2] p-8 md:p-10">
              <SectionEyebrow>Mission</SectionEyebrow>
              <h2 className="mt-4 text-4xl tracking-[-0.04em] text-[#102c35]">
                Safe spaces for full potential.
              </h2>
              <p className="mt-5 text-base leading-8 text-slate-700">
                To support the development of a healthy, educated, and
                prosperous society by providing safe, inclusive community spaces
                where young Rwandans can access the programmes, skills,
                connections, and support they need to reach their full
                potential.
              </p>
            </div>
          </div>

          <div className="mt-16 md:mt-20">
            <div className="grid gap-8 lg:grid-cols-[minmax(0,720px)_1fr] lg:items-end">
              <h2 className="max-w-xl text-4xl tracking-[-0.04em] md:text-5xl">
                Values
              </h2>
            </div>

            <div className="mt-8 grid items-stretch gap-5 md:grid-cols-2 xl:grid-cols-5">
              {values.map((value) => {
                const Icon = value.icon;

                return (
                  <div
                    key={value.title}
                    className="flex min-h-[272px] flex-col rounded-[28px] border border-slate-200/80 bg-[#f7f7f2] p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
                  >
                    <div className="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#52b3a9]/18 text-[#2b6274]">
                      <Icon className="h-5 w-5" />
                    </div>
                    <h3 className="mt-6 text-2xl tracking-[-0.03em] text-[#102c35]">
                      {value.title}
                    </h3>
                    <p className="mt-3 text-sm leading-7 text-slate-600">
                      {value.text}
                    </p>
                  </div>
                );
              })}
            </div>
          </div>
        </Container>
      </section>

      <section className="relative overflow-hidden bg-[#fff1e3] py-20 md:py-24">
        <div className="pointer-events-none absolute -left-20 top-10 h-64 w-64 rounded-full bg-[#ed9b37]/24 blur-3xl" />
        <div className="pointer-events-none absolute bottom-0 right-0 h-80 w-80 rounded-full bg-[#52b3a9]/24 blur-3xl" />
        <Container className="max-w-[1392px]">
          <div className="relative space-y-16 md:space-y-20">
            <div className="grid gap-8 rounded-[36px] border border-white/70 bg-white/70 p-6 shadow-[0_28px_90px_rgba(16,44,53,0.10)] backdrop-blur-sm md:p-8 lg:grid-cols-[0.88fr_1.12fr] lg:items-stretch lg:p-10">
              <div className="flex min-h-[320px] flex-col justify-between rounded-[28px] bg-[#102c35] p-7 text-white md:p-8">
                <div>
                  <div className="inline-flex rounded-full bg-[#f5c346]/18 px-4 py-2 text-xs uppercase tracking-[0.22em] text-[#f5c346]">
                    Why Imbuto Hubs Exist
                  </div>
                  <h2 className="mt-6 max-w-xl text-4xl tracking-[-0.04em] text-white md:text-5xl">
                    A brighter answer to connected challenges.
                  </h2>
                </div>
                <div className="mt-8 grid grid-cols-2 gap-3 text-sm">
                  <div className="rounded-2xl bg-white/10 p-4">
                    Health
                    <span className="mt-1 block text-white/60">Support</span>
                  </div>
                  <div className="rounded-2xl bg-white/10 p-4">
                    Skills
                    <span className="mt-1 block text-white/60">Pathways</span>
                  </div>
                  <div className="rounded-2xl bg-white/10 p-4">
                    Safe spaces
                    <span className="mt-1 block text-white/60">Access</span>
                  </div>
                  <div className="rounded-2xl bg-white/10 p-4">
                    Community
                    <span className="mt-1 block text-white/60">Trust</span>
                  </div>
                </div>
              </div>

              <div className="grid gap-5 md:grid-cols-2">
                <div className="rounded-[28px] bg-[#f7f7f2] p-6 shadow-sm ring-1 ring-white/80 md:p-7">
                  <div className="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#fde4dc] text-[#c05d24]">
                    <Lightbulb className="h-5 w-5" />
                  </div>
                  <h3 className="mt-5 text-2xl tracking-[-0.03em] text-[#102c35]">
                    The challenge
                  </h3>
                  <p className="mt-4 text-base leading-8 text-slate-700">
                    Across Rwanda, young people and families face challenges
                    that stand between them and their potential. These include
                    limited access to health education and mental health
                    support, youth unemployment and skills mismatches,
                    fragmented services that rarely connect education with
                    opportunity, and too few safe spaces for out-of-school
                    youth.
                  </p>
                </div>
                <div className="rounded-[28px] bg-[#dff5f2] p-6 shadow-sm ring-1 ring-white/80 md:p-7">
                  <div className="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[#2b6274]">
                    <Handshake className="h-5 w-5" />
                  </div>
                  <h3 className="mt-5 text-2xl tracking-[-0.03em] text-[#102c35]">
                    The response
                  </h3>
                  <p className="mt-4 text-base leading-8 text-slate-700">
                    Imbuto Hubs respond to these challenges not by addressing
                    them in isolation, but by bringing them together in one
                    trusted, community-centred space.
                  </p>
                </div>
              </div>
            </div>

            {/* <div className="grid gap-12 lg:grid-cols-[0.88fr_1.12fr] lg:items-start">
              <div>
                <h2 className="max-w-xl text-4xl tracking-[-0.04em] md:text-5xl">
                  Why Imbuto Hubs Exist
                </h2>
              </div>
              <div className="space-y-8">
                <p className="text-lg leading-9 text-slate-700">
                  Across Rwanda, young people and families face challenges that
                  stand between them and their potential. These include limited
                  access to health education and mental health support, youth
                  unemployment and skills mismatches, fragmented services that
                  rarely connect education with opportunity, and too few safe
                  spaces for out-of-school youth.
                </p>
                <p className="text-lg leading-9 text-slate-700">
                  Imbuto Hubs respond to these challenges not by addressing them
                  in isolation, but by bringing them together in one trusted,
                  community-centred space.
                </p>
              </div>
            </div> */}
          </div>
        </Container>
      </section>

      <section className="bg-[#e9f0ec] py-20 md:py-24">
        <Container>
          <div className="mx-auto max-w-3xl text-center">
            {/* <SectionEyebrow>Life-Stage Approach</SectionEyebrow> */}
            <h2 className="text-4xl tracking-[-0.04em] text-[#102c35] md:text-5xl">
              Life-Stage Approach
            </h2>
            <p className="mt-5 text-lg leading-9 text-[#2b4b56]">
              Imbuto Hubs follow a life-cycle approach, meaning support does not
              stop at one age group. From the earliest years to full adulthood,
              there is always a programme designed for each stage.
            </p>
          </div>

          <div className="mt-12 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            {lifeStages.map((stage) => {
              const Icon = stage.icon;

              return (
                <div
                  key={stage.title}
                  className="rounded-[26px] border border-white/80 bg-white/90 p-6 shadow-sm"
                >
                  <div className="flex items-center justify-between gap-4">
                    <div className="rounded-full bg-[#f5c346]/25 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-[#8f5217]">
                      {stage.age}
                    </div>
                    <Icon className="h-5 w-5 text-[#2b6274]" />
                  </div>
                  <h3 className="mt-5 text-3xl tracking-[-0.04em]">
                    {stage.title}
                  </h3>
                  <p className="mt-4 text-sm leading-7 text-slate-700">
                    {stage.text}
                  </p>
                </div>
              );
            })}
          </div>
        </Container>
      </section>

      <section className="bg-[#102c35] py-20 text-white md:py-24">
        <Container>
          <div className="grid gap-10 lg:grid-cols-[0.86fr_1fr] lg:items-center">
            <div className="relative overflow-hidden rounded-[32px] border border-white/10 bg-white/5 shadow-2xl">
              <div className="relative aspect-[4/3]">
                <Image
                  src="/images/about/54542383848_b26b6d6743_k.jpg"
                  alt="Imbuto Foundation leadership and governance"
                  fill
                  sizes="(min-width: 1440px) 560px, (min-width: 1024px) 42vw, 100vw"
                  quality={100}
                  className="object-cover"
                />
                <div className="absolute inset-0 bg-[linear-gradient(180deg,transparent_58%,rgba(16,44,53,0.38))]" />
                <div className="absolute left-4 top-4 flex items-center gap-2 rounded-full bg-white/90 px-3 py-1 text-xs text-[#043E52] shadow">
                  <HeartPulse className="h-3.5 w-3.5" />
                  Governance
                </div>
              </div>
            </div>
            <div>
              <SectionEyebrow>Leadership & Governance</SectionEyebrow>
              <h2 className="mt-4 max-w-4xl text-4xl tracking-[-0.04em] text-[#f5c346] md:text-5xl">
                Guided by Imbuto Foundation&apos;s commitment to national
                progress.
              </h2>
              <p className="mt-6 max-w-4xl text-lg leading-9 text-white/78">
                Imbuto Hubs operate under the leadership of Imbuto Foundation,
                guided by its commitment to youth development, community
                wellbeing, and national progress.
              </p>
            </div>
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
            Take the next step
          </div>
          <h2 className="mx-auto mt-4 max-w-3xl text-5xl tracking-[-0.05em] text-white md:text-6xl">
            Discover, participate, or partner with Imbuto Hubs.
          </h2>
          <div className="mt-10 flex flex-wrap justify-center gap-4">
            <CtaLink href="#" variant="light">
              Explore Programmes
            </CtaLink>

            <CtaLink href="#" variant="outline">
              Partner With Us
            </CtaLink>
          </div>
        </Container>
      </section>

      <Footer />
    </main>
  );
}
