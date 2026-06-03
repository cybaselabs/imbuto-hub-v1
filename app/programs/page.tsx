import type { Metadata } from "next";
import Link from "next/link";
import {
  ArrowRight,
  BookOpen,
  Briefcase,
  CheckCircle2,
  Compass,
  Flag,
  HeartPulse,
  MapPinned,
  Palette,
  Sparkles,
  Trophy,
  Users,
} from "lucide-react";
import { Header } from "../../components/imbuto/Header";
import { Footer } from "../../components/imbuto/Footer";
import { Container } from "../../components/imbuto/Container";
import {
  ProgrammeCard,
  programmeCardAccents,
} from "../../components/imbuto/ProgrammeCard";
import { ctaImage, heroImage } from "../../components/imbuto/data";

export const metadata: Metadata = {
  title: "Programs",
  description:
    "Explore Imbuto Hubs programmes across early childhood, education, digital skills, wellbeing, sports, creativity, entrepreneurship, and leadership.",
};

const joinSteps = [
  {
    title: "Find your nearest hub",
    text: "Find your nearest hub using the Hubs page.",
    icon: MapPinned,
  },
  {
    title: "Check availability",
    text: "Check which programmes are available at that location.",
    icon: Compass,
  },
  {
    title: "Register interest",
    text: "Register Interest or contact the hub team directly for next steps.",
    icon: CheckCircle2,
  },
];

const programmes = [
  {
    title: "Early Childhood Development",
    tagline: "Every child deserves the best possible start.",
    body: "Safe, nurturing early learning environments that support children through play, care, and early stimulation, while also supporting the caregivers and families around them. Our ECD spaces provide structured early childhood programming, parenting education, and a safe supervised environment that enables caregivers, particularly women, to access skills training and economic opportunities.",
    icon: BookOpen,
    image: "/images/EarlyChildhood.jpg",
    tone: "bg-[#fff1e3] text-[#c05d24]",
  },
  {
    title: "Education & Personal Development",
    tagline: "Learning that goes far beyond the classroom.",
    body: "Our education programmes combine non-formal learning with life skills, financial literacy, and a deep exploration of Rwandan history and identity. Supported by well-stocked libraries, digital tools, and trained facilitators, programming runs after school, on weekends, and during school holidays, meeting young people wherever they are in their learning journey.",
    icon: Users,
    image: "/images/54945400951_90ba3d130b_k.jpg",
    tone: "bg-[#dff5f2] text-[#2b6274]",
  },
  {
    title: "Digital Literacy & Innovation",
    tagline: "The future is digital. You belong in it.",
    body: "From basic digital literacy to coding and emerging technologies, our ICT programmes are designed for young people at every level, whether they are using a computer for the first time or building their first application. We show young people that innovation belongs in every field, from health to agriculture to fashion.",
    icon: Sparkles,
    image: "/images/52552727843_776ae789f1_k.jpg",
    tone: "bg-[#fde4dc] text-[#c05d24]",
  },
  {
    title: "Health & Wellbeing",
    tagline: "Your health is not a luxury. It is a right.",
    body: "Imbuto Hubs are trusted, non-stigmatising spaces where young people and community members can access health education, mental health support, and preventive services, without fear or judgment. All health programmes are delivered in partnership with qualified health providers in dedicated spaces designed for privacy and dignity.",
    icon: HeartPulse,
    image: "/images/ecadfe9f73f23947.jpeg",
    tone: "bg-[#dde9ee] text-[#2b6274]",
  },
  {
    title: "Sports & Recreation",
    tagline: "Stronger bodies. Stronger minds. Stronger communities.",
    body: "Sport at Imbuto Hubs goes beyond physical fitness. Our community-class facilities for football, basketball, volleyball, handball, karate, and an outdoor gym provide structured coaching that builds discipline, teamwork, resilience, and leadership skills, helping participants thrive both on and off the field.",
    icon: Trophy,
    image: "/images/52548376321_dda8370097_k.jpg",
    tone: "bg-[#f8e7a8] text-[#8f5217]",
  },
  {
    title: "Creative Arts & Culture",
    tagline: "Your creativity is your power. Use it.",
    body: "From the audio-visual studio to the exhibition area, our creative spaces are alive with music, fashion, photography, storytelling, and more. Young people discover talents they did not know they had, and learn to share them with the world. Creative programmes are integrated with economic empowerment, helping turn passion into livelihood.",
    icon: Palette,
    image: "/images/55137656258_b872b35591_k.jpg",
    tone: "bg-[#fff1e3] text-[#c05d24]",
  },
  {
    title: "Skills, Entrepreneurship & Job Readiness",
    tagline: "Your skills. Your future. Built here.",
    body: "Rwanda's economy is changing fast. Imbuto Hubs prepare young people for it, with practical, market-relevant skills training, entrepreneurship education, and clear pathways to decent and productive work. Programmes are delivered by qualified practitioners and aligned with real labour market needs.",
    icon: Briefcase,
    image: "/images/54513896658_550ab2509d_k.jpg",
    tone: "bg-[#dff5f2] text-[#2b6274]",
  },
  {
    title: "Leadership & Civic Engagement",
    tagline: "Change does not happen to communities. It happens with them.",
    body: "The strongest communities are those where young people are not just recipients of support, but active architects of change. Our civic and leadership programmes give youth the platforms, tools, and confidence to lead. Intergenerational exchange programmes bridge experience and energy, connecting wisdom and ambition across generations.",
    icon: Flag,
    image: "/images/leadership.jpg",
    tone: "bg-[#fde4dc] text-[#c05d24]",
  },
];

function shortenText(text: string, maxLength = 60) {
  if (text.length <= maxLength) return text;

  return `${text.slice(0, maxLength).trimEnd()}...`;
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

export default function ProgramsPage() {
  return (
    <main className="bg-[#f7f7f2] text-[#102c35]">
      <Header />

      <section className="relative isolate overflow-hidden bg-[#043E52] pb-20 pt-32 text-white md:pb-24 md:pt-40">
        <div className="absolute inset-0">
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url('${heroImage}')` }}
          />
          <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(4,62,82,0.96)_0%,rgba(4,62,82,0.82)_48%,rgba(4,62,82,0.52)_100%)]" />
        </div>

        <Container className="relative">
          <div className="max-w-4xl">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md">
              <Sparkles className="h-4 w-4" />
              Programs
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
            <p className="mt-4 max-w-3xl text-sm leading-7 text-white/68 md:text-base">
              Programme availability varies by hub. Use the Hubs page to find
              what is available near you.
            </p>
            <div className="mt-9 flex flex-wrap gap-4">
              <CtaLink href="#">Register Interest</CtaLink>
              <CtaLink href="#" variant="outline">
                Find a Hub
              </CtaLink>
            </div>
          </div>
        </Container>
      </section>

      <section className="bg-white py-20 md:py-24">
        <Container>
          <div className="grid gap-10 lg:grid-cols-[0.74fr_1.26fr] lg:items-start">
            <div>
              {/* <div className="text-sm uppercase tracking-[0.28em] text-[#c05d24]">
                How to join
              </div> */}
              <h2 className="mt-4 max-w-xl text-4xl tracking-[-0.04em] md:text-5xl">
                How to join? Start with the hub nearest you.
              </h2>
            </div>
            <div className="grid gap-4 md:grid-cols-3">
              {joinSteps.map((step, index) => {
                const Icon = step.icon;

                return (
                  <div
                    key={step.title}
                    className="rounded-[26px] border border-slate-200/80 bg-[#f7f7f2] p-6 shadow-sm"
                  >
                    <div className="flex items-center justify-between gap-4">
                      <div className="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#52b3a9]/18 text-[#2b6274]">
                        <Icon className="h-5 w-5" />
                      </div>
                      <div className="text-sm font-semibold text-[#2b6274]/60">
                        Step {index + 1}
                      </div>
                    </div>
                    <h3 className="mt-5 text-2xl tracking-[-0.03em]">
                      {step.title}
                    </h3>
                    <p className="mt-3 text-sm leading-7 text-slate-700">
                      {step.text}
                    </p>
                  </div>
                );
              })}
            </div>
          </div>
        </Container>
      </section>

      <section className="relative overflow-hidden bg-[#043E52] py-20 text-white md:py-24">
        <div className="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(82,179,169,0.22),transparent_32%),radial-gradient(circle_at_top_right,rgba(255,255,255,0.14),transparent_30%)]" />
        <Container>
          <div className="relative grid gap-8 lg:grid-cols-[0.72fr_1.28fr] lg:items-end">
            <div>
              <div className="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-2 text-[11px] uppercase tracking-[0.28em] text-[#f5c346] shadow-sm backdrop-blur-md">
                Programme pillars
              </div>
              <h2 className="mt-6 text-4xl tracking-[-0.04em] text-white md:text-5xl">
                Support across every area of growth.
              </h2>
            </div>
            <p className="max-w-3xl text-lg leading-9 text-white/72 lg:justify-self-end">
              Programmes are designed to meet young people and families where
              they are, with opportunities that combine learning, wellbeing,
              practical skills, creativity, and leadership.
            </p>
          </div>

          <div className="relative mt-12 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            {programmes.map((program, index) => (
              <ProgrammeCard
                key={program.title}
                title={program.title}
                image={program.image}
                icon={program.icon}
                layout="grid"
                accent={
                  programmeCardAccents[index % programmeCardAccents.length]
                }
                description={
                  <>
                    <span className="block text-base font-semibold leading-7 text-white">
                      {program.tagline}
                    </span>
                    <span className="mt-4 block text-sm leading-7 text-white/72">
                      {shortenText(program.body)}
                    </span>
                  </>
                }
              />
            ))}
          </div>
        </Container>
      </section>

      <section className="relative overflow-hidden py-24">
        <div className="absolute inset-0 bg-[linear-gradient(135deg,#E16A3D_0%,#FFA45D_48%,#043E52_130%)]" />
        <div
          className="absolute inset-0 bg-cover bg-center opacity-25 mix-blend-overlay"
          style={{ backgroundImage: `url('${ctaImage}')` }}
        />
        <Container className="relative max-w-6xl text-center text-white">
          <div className="text-sm uppercase tracking-[0.28em] text-white/75">
            Ready to begin
          </div>
          <h2 className="mx-auto mt-4 max-w-3xl text-5xl tracking-[-0.05em] md:text-6xl">
            Find the programme that fits your next step.
          </h2>
          <div className="mt-10 flex flex-wrap justify-center gap-4">
            <CtaLink href="#" variant="light">
              Register Interest
            </CtaLink>
            <CtaLink href="#" variant="outline">
              Find a Hub
            </CtaLink>
          </div>
        </Container>
      </section>

      <Footer />
    </main>
  );
}
