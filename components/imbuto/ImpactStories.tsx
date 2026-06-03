import Image from "next/image";
import Link from "next/link";
import { ArrowRight, BookOpen, HeartPulse, Quote } from "lucide-react";
import { Container } from "./Container";

const buttonClass =
  "inline-flex w-fit items-center gap-2 rounded-full bg-[#E16A3D] px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#ed9b37]/25 transition hover:-translate-y-0.5 hover:bg-[#c05d24]";

const featuredStory = {
  title: "A Life Shaped by Imbuto",
  person: "Keza",
  role: "Doctor & Imbuto Hub Mentor",
  image: "/images/54945400951_90ba3d130b_k.jpg",
  summary:
    "Keza first entered the hub library as a child with a quiet dream of becoming a doctor. Through reading, ICT access, wellness support, sports, and mentorship, that dream became a plan. Today, she returns to the hub as a mentor for the next generation.",
  quote:
    "The hub did not just give me knowledge. It gave me the belief that my future was worth building.",
};

const additionalStories = [
  {
    title: "Reading Into Confidence",
    category: "Education",
    hub: "Imbuto Hub Kigali",
    image: "/images/54513984590_0fcde5be3d_k.jpg",
    icon: BookOpen,
    text: "A young learner builds a reading routine in the hub library and gains the confidence to participate more fully at school.",
  },
  {
    title: "A Safer Space to Breathe",
    category: "Wellbeing",
    hub: "Imbuto Hub Huye",
    image: "/images/ecadfe9f73f23947.jpeg",
    icon: HeartPulse,
    text: "Through wellness sessions and trusted support, a participant learns how to manage stress and ask for help early.",
  },
];

function SectionEyebrow({ children }: { children: React.ReactNode }) {
  return (
    <div className="text-sm uppercase tracking-[0.28em] text-[#c05d24]">
      {children}
    </div>
  );
}

export function ImpactStories() {
  return (
    <section id="stories" className="py-20 md:py-24">
      <Container>
        <div className="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
          <div className="max-w-3xl">
            <h2 className="mt-4 text-4xl tracking-[-0.04em] md:text-5xl">
              Impact Stories
            </h2>
          </div>
          <Link
            href="#"
            className={buttonClass}
          >
            Browse All Stories
            <ArrowRight className="h-4 w-4" />
          </Link>
        </div>

        <div className="mt-12 overflow-hidden rounded-[32px] border border-slate-200/80 bg-white shadow-sm">
          <div className="grid lg:grid-cols-[1.04fr_0.96fr]">
            <div className="relative min-h-[340px] bg-[#102c35]">
              <Image
                src={featuredStory.image}
                alt="Young people taking part in an Imbuto Hub programme"
                fill
                sizes="(min-width: 1024px) 44vw, 100vw"
                className="object-cover"
              />
              <div className="absolute left-6 top-6 rounded-full bg-white px-4 py-2 text-xs font-semibold uppercase tracking-[0.18em] text-[#043E52] shadow-sm">
                Featured Story, {featuredStory.person}
              </div>
            </div>

            <div className="p-7 md:p-8">
              <div className="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#fff1e3] text-[#c05d24]">
                <Quote className="h-5 w-5" />
              </div>
              <h2 className="mt-5 max-w-2xl text-3xl tracking-[-0.04em] md:text-4xl">
                {featuredStory.title}
              </h2>

              <p className="mt-4 text-base leading-8 text-slate-700">
                {featuredStory.summary}
              </p>

              <blockquote className="mt-6 border-l-4 border-[#ed9b37] pl-5 text-lg leading-8 text-[#102c35]">
                &quot;{featuredStory.quote}&quot;
              </blockquote>
              <p className="mt-4 text-xs uppercase tracking-[0.18em] text-[#2b6274]">
                {featuredStory.person}, {featuredStory.role}
              </p>
              <Link
                href="#"
                className={`mt-6 ${buttonClass}`}
              >
                Read Story
                <ArrowRight className="h-4 w-4" />
              </Link>
            </div>
          </div>
        </div>

        <div className="mt-6 grid gap-5 md:grid-cols-2">
          {additionalStories.map((story) => {
            const Icon = story.icon;

            return (
              <article
                key={story.title}
                className="grid overflow-hidden rounded-[28px] border border-slate-200/80 bg-white shadow-sm sm:grid-cols-[0.8fr_1.2fr]"
              >
                <div className="relative min-h-[220px] bg-[#102c35]">
                  <Image
                    src={story.image}
                    alt={story.title}
                    fill
                    sizes="(min-width: 768px) 24vw, 100vw"
                    className="object-cover"
                  />
                </div>
                <div className="p-6">
                  <div className="flex items-center justify-between gap-4">
                    <div className="text-xs font-semibold uppercase tracking-[0.2em] text-[#c05d24]">
                      {story.category}
                    </div>
                    <div className="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-[#dff5f2] text-[#0f5b58]">
                      <Icon className="h-4 w-4" />
                    </div>
                  </div>
                  <h3 className="mt-5 text-2xl tracking-[-0.03em]">
                    {story.title}
                  </h3>
                  <p className="mt-2 text-xs uppercase tracking-[0.18em] text-slate-500">
                    {story.hub}
                  </p>
                  <p className="mt-4 text-sm leading-7 text-slate-700">
                    {story.text}
                  </p>
                  <Link
                    href="#"
                    className={`mt-5 ${buttonClass}`}
                  >
                    Read Story
                    <ArrowRight className="h-4 w-4" />
                  </Link>
                </div>
              </article>
            );
          })}
        </div>
      </Container>
    </section>
  );
}
