import type { Metadata } from "next";
import Image from "next/image";
import Link from "next/link";
import {
  ArrowRight,
  Bell,
  CalendarDays,
  Clock3,
  Mail,
  MapPinned,
  Newspaper,
  Sparkles,
} from "lucide-react";
import { Header } from "../../components/imbuto/Header";
import { Footer } from "../../components/imbuto/Footer";
import { Container } from "../../components/imbuto/Container";
import { ctaImage, hubsImage, hubsImage2 } from "../../components/imbuto/data";

export const metadata: Metadata = {
  title: "News & Events",
  description:
    "Follow Imbuto Hubs news, upcoming events, community activities, programme updates, and announcements across Rwanda.",
};

const events = [
  {
    name: "Imbuto Hub Kigali Open Day",
    month: "Jul",
    day: "18",
    date: "18 July 2026 · 10:00 - 15:00",
    location: "Imbuto Hub Kigali",
    image: "/images/55136596177_ae05fc0d97_k.jpg",
    description:
      "A community open day for young people, parents, partners, and local leaders to explore programmes, facilities, and registration pathways.",
    registration: "Registration required",
  },
  {
    name: "Digital Skills Intro Session",
    month: "Jul",
    day: "25",
    date: "25 July 2026 · 09:00 - 12:00",
    location: "Imbuto Hub Musanze",
    image: "/images/52552727843_776ae789f1_k.jpg",
    description:
      "A beginner-friendly session introducing computer basics, online safety, and practical digital tools for learning and opportunity.",
    registration: "Walk-in welcome",
  },
  {
    name: "Youth Wellness & Mentorship Circle",
    month: "Aug",
    day: "02",
    date: "2 August 2026 · 14:00 - 16:30",
    location: "Imbuto Hub Huye",
    image: "/images/ecadfe9f73f23947.jpeg",
    description:
      "A guided mentorship and wellbeing conversation for teenagers and young adults focused on confidence, stress, and planning next steps.",
    registration: "Registration required",
  },
];

const newsArticles = [
  {
    title: "New hub activities expand access to youth opportunity",
    date: "12 June 2026",
    category: "Programme Update",
    image: "/images/55136596177_ae05fc0d97_k.jpg",
    preview:
      "Imbuto Hubs are expanding community programming through new learning, wellbeing, and mentorship activities designed around local needs.",
  },
  {
    title: "Partners join Imbuto Hubs to strengthen digital learning",
    date: "28 June 2026",
    category: "Partner News",
    image: "/images/52552727843_776ae789f1_k.jpg",
    preview:
      "New collaboration across the network is helping equip young people with practical digital skills, ICT access, and future-ready confidence.",
  },
  {
    title: "Community event brings families into the hub experience",
    date: "5 July 2026",
    category: "Event Recap",
    image: "/images/55137473511_81bbe538ab_k.jpg",
    preview:
      "Families, youth, mentors, and community leaders came together to learn about hub programmes and celebrate local participation.",
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

export default function EventsPage() {
  return (
    <main className="bg-[#f7f7f2] text-[#102c35]">
      <Header />

      <section className="relative isolate overflow-hidden bg-[#043E52] pb-20 pt-32 text-white md:pb-24 md:pt-40">
        <div className="absolute inset-0">
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url('${hubsImage}')` }}
          />
          <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(4,62,82,0.96)_0%,rgba(4,62,82,0.82)_48%,rgba(4,62,82,0.50)_100%)]" />
        </div>

        <Container className="relative">
          <div className="max-w-4xl">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md">
              <Newspaper className="h-4 w-4" />
              News & Events
            </div>
            <h1 className="mt-6 max-w-4xl text-5xl leading-[0.98] tracking-[-0.04em] text-[#f5c346]/95 md:text-7xl lg:text-[84px]">
              Latest updates from Imbuto Hubs.
            </h1>
            <p className="mt-7 max-w-3xl text-base leading-8 text-white/82 md:text-lg md:leading-9">
              Follow new hub developments, upcoming events, community
              activities, and important announcements across the Imbuto Hubs
              network.
            </p>
            <div className="mt-9 flex flex-wrap gap-4">
              <CtaLink href="#updates" variant="light">
                View Updates
              </CtaLink>
              <CtaLink href="#newsletter" variant="outline">
                Subscribe to Newsletter
              </CtaLink>
            </div>
          </div>
        </Container>
      </section>

      <section id="events" className="bg-white py-20 md:py-24">
        <Container>
          <div className="grid gap-8 lg:grid-cols-[0.76fr_1.24fr] lg:items-end">
            <div>
              <SectionEyebrow>Events</SectionEyebrow>
              <h2 className="mt-4 max-w-2xl text-4xl tracking-[-0.04em] md:text-5xl">
                Join upcoming activities across the network.
              </h2>
            </div>
            <p className="max-w-3xl text-base leading-8 text-slate-700 lg:justify-self-end">
              Join upcoming activities, open days, training sessions, and
              community events connected to Imbuto Hubs in different parts of
              Rwanda.
            </p>
          </div>

          <div className="mt-10 grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
            <article className="overflow-hidden rounded-[32px] border border-slate-200/80 bg-[#f7f7f2] shadow-sm">
              <div className="relative min-h-[360px] bg-[#102c35]">
                <Image
                  src={events[0].image}
                  alt={events[0].name}
                  fill
                  sizes="(min-width: 1024px) 58vw, 100vw"
                  className="object-cover"
                />
                <div className="absolute inset-0 bg-[linear-gradient(180deg,rgba(16,44,53,0.10)_0%,rgba(16,44,53,0.82)_100%)]" />
                <div className="absolute left-6 top-6 rounded-2xl bg-white px-4 py-3 text-center text-[#043E52] shadow-sm">
                  <div className="text-xs font-semibold uppercase tracking-[0.18em] text-[#c05d24]">
                    {events[0].month}
                  </div>
                  <div className="text-4xl tracking-[-0.05em]">
                    {events[0].day}
                  </div>
                </div>
                <div className="absolute inset-x-0 bottom-0 p-6 text-white md:p-8">
                  <div className="inline-flex rounded-full bg-white/14 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-white backdrop-blur-md">
                    Featured Event
                  </div>
                  <h3 className="mt-4 max-w-2xl text-4xl tracking-[-0.04em] md:text-5xl">
                    {events[0].name}
                  </h3>
                </div>
              </div>
              <div className="grid gap-6 p-6 md:grid-cols-[1fr_auto] md:items-end md:p-8">
                <div>
                  <div className="flex flex-wrap gap-4 text-sm leading-6 text-slate-700">
                    <div className="flex gap-2">
                      <Clock3 className="mt-0.5 h-4 w-4 shrink-0 text-[#c05d24]" />
                      {events[0].date}
                    </div>
                    <div className="flex gap-2">
                      <MapPinned className="mt-0.5 h-4 w-4 shrink-0 text-[#c05d24]" />
                      {events[0].location}
                    </div>
                  </div>
                  <p className="mt-5 max-w-3xl text-sm leading-7 text-slate-700">
                    {events[0].description}
                  </p>
                </div>
                <CtaLink href="#">Register</CtaLink>
              </div>
            </article>

            <div className="grid gap-4">
              {events.slice(1).map((event) => (
                <article
                  key={event.name}
                  className="rounded-[28px] border border-slate-200/80 bg-[#f7f7f2] p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-xl"
                >
                  <div className="flex gap-5">
                    <div className="flex h-20 w-20 shrink-0 flex-col items-center justify-center rounded-2xl bg-white text-center text-[#043E52] shadow-sm">
                      <div className="text-xs font-semibold uppercase tracking-[0.18em] text-[#c05d24]">
                        {event.month}
                      </div>
                      <div className="text-3xl tracking-[-0.05em]">
                        {event.day}
                      </div>
                    </div>
                    <div>
                      <div className="inline-flex rounded-full bg-white px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.16em] text-[#2b6274]">
                        {event.registration}
                      </div>
                      <h3 className="mt-3 text-2xl tracking-[-0.03em]">
                        {event.name}
                      </h3>
                    </div>
                  </div>

                  <div className="mt-5 space-y-3 text-sm leading-6 text-slate-700">
                    <div className="flex gap-2">
                      <Clock3 className="mt-0.5 h-4 w-4 shrink-0 text-[#c05d24]" />
                      {event.date}
                    </div>
                    <div className="flex gap-2">
                      <MapPinned className="mt-0.5 h-4 w-4 shrink-0 text-[#c05d24]" />
                      {event.location}
                    </div>
                  </div>
                  <p className="mt-4 text-sm leading-7 text-slate-700">
                    {event.description}
                  </p>
                </article>
              ))}
            </div>
          </div>

          <div className="mt-10">
            <CtaLink href="#">See All Events</CtaLink>
          </div>
        </Container>
      </section>

      <section id="updates" className="py-20 md:py-24">
        <Container>
          <div className="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
            <div>
              <SectionEyebrow>News</SectionEyebrow>
              <h2 className="mt-4 max-w-3xl text-4xl tracking-[-0.04em] md:text-5xl">
                Updates, announcements, and community stories.
              </h2>
            </div>
            <CtaLink href="#">View Updates</CtaLink>
          </div>

          <div className="mt-10 grid gap-5 lg:grid-cols-3">
            {newsArticles.map((article) => (
              <article
                key={article.title}
                className="overflow-hidden rounded-[28px] border border-slate-200/80 bg-white shadow-sm"
              >
                <div className="relative aspect-[4/3] bg-[#102c35]">
                  <Image
                    src={article.image}
                    alt={article.title}
                    fill
                    sizes="(min-width: 1024px) 31vw, 100vw"
                    className="object-cover"
                  />
                  <div className="absolute left-4 top-4 rounded-full bg-white px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-[#043E52] shadow-sm">
                    {article.category}
                  </div>
                </div>
                <div className="p-6">
                  <div className="text-xs uppercase tracking-[0.18em] text-slate-500">
                    {article.date}
                  </div>
                  <h3 className="mt-4 text-2xl tracking-[-0.03em]">
                    {article.title}
                  </h3>
                  <p className="mt-4 text-sm leading-7 text-slate-700">
                    {article.preview}
                  </p>
                  <Link
                    href="#"
                    className="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[#0b4f63]"
                  >
                    Read Article
                    <ArrowRight className="h-4 w-4" />
                  </Link>
                </div>
              </article>
            ))}
          </div>
        </Container>
      </section>

      <section id="newsletter" className="relative overflow-hidden py-24">
        <div className="absolute inset-0 bg-[linear-gradient(135deg,rgba(225,106,61,0.94)_0%,rgba(255,164,93,0.84)_48%,rgba(4,62,82,0.72)_130%)]" />
        <div
          className="absolute inset-0 bg-cover bg-center opacity-30 mix-blend-overlay"
          style={{ backgroundImage: `url('${ctaImage}')` }}
        />
        <Container className="relative">
          <div className="grid gap-8 text-white lg:grid-cols-[0.8fr_1.2fr] lg:items-center">
            <div>
              <div className="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md">
                <Bell className="h-4 w-4" />
                Newsletter
              </div>
              <h2 className="mt-5 max-w-2xl text-5xl tracking-[-0.05em] md:text-6xl">
                Stay connected to the Imbuto Hubs story.
              </h2>
              <p className="mt-6 max-w-2xl text-base leading-8 text-white/82 md:text-lg">
                Get the latest news, programme updates, and youth impact
                delivered directly to your inbox.
              </p>
            </div>

            <form className="rounded-[32px] border border-white/18 bg-white/12 p-6 shadow-2xl backdrop-blur-md md:p-8">
              <div className="grid gap-4 md:grid-cols-2">
                <label className="block">
                  <span className="text-xs font-semibold uppercase tracking-[0.18em] text-white/70">
                    Email address
                  </span>
                  <input
                    type="email"
                    required
                    placeholder="you@example.com"
                    className="mt-2 h-12 w-full rounded-full border border-white/20 bg-white px-4 text-sm text-[#102c35] outline-none transition focus:border-[#f5c346]"
                  />
                </label>
                <label className="block">
                  <span className="text-xs font-semibold uppercase tracking-[0.18em] text-white/70">
                    First name
                  </span>
                  <input
                    type="text"
                    placeholder="Optional"
                    className="mt-2 h-12 w-full rounded-full border border-white/20 bg-white px-4 text-sm text-[#102c35] outline-none transition focus:border-[#f5c346]"
                  />
                </label>
              </div>
              <button
                type="submit"
                className="mt-5 inline-flex items-center gap-2 rounded-full bg-white px-6 py-3.5 text-sm text-[#043E52] shadow-2xl transition hover:-translate-y-0.5"
              >
                Subscribe
                <Mail className="h-4 w-4" />
              </button>
              <p className="mt-5 text-xs leading-6 text-white/68">
                We will only send you content related to Imbuto Hubs. You can
                unsubscribe at any time.
              </p>
            </form>
          </div>
        </Container>
      </section>

      <Footer />
    </main>
  );
}
