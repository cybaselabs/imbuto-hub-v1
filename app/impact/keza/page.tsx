import type { Metadata } from "next";
import Image from "next/image";
import Link from "next/link";
import { ArrowLeft, ArrowRight, Quote } from "lucide-react";
import { Header } from "../../../components/imbuto/Header";
import { Footer } from "../../../components/imbuto/Footer";
import { Container } from "../../../components/imbuto/Container";

export const metadata: Metadata = {
  title: "The Journey of Keza",
  description:
    "A story of how Imbuto Hubs can support a young person from childhood to adulthood.",
};

const storyParagraphs = [
  "Before I tell you Keza's story, let's start with yours.",
  "You may sit in different departments, handling reports, budgets, programme plans, and schedules. But you are more than just a title.",
  "You are architects of possibility. Builders of dreams. You are the reason the Kezas and the Cyusas of Rwanda will rise and thrive.",
  "Whether you are in education, laying the foundation for brighter futures; in health, ensuring young bodies and minds grow strong; in mental health, creating safe spaces; or in finance, making sure every resource counts, every single one of you is essential.",
  "You don't just work behind desks. You help craft lives. It is through your dedication that Imbuto Hubs will soon stand as spaces of transformation.",
  "Now let me introduce you to Keza. Her story belongs to all of you.",
  "Keza was born in Musanze, one of those children with big eyes, bigger dreams, and a laugh that could light up the hills. Her life changed the day she toddled into an ECD center: bright walls, playful songs, and stories that made her believe she could be anything, even a doctor.",
  "But dreams, as we all know, need structure. Education. Zealous Keza was selected as an Edified Generation, an education programme that taught Keza more than math and science. It taught her excellence.",
  "As Keza entered her teens, she had questions. Why was Cyusa suddenly texting her so much? Why did her mother raise an eyebrow every time she talked about group projects? Health and ASRH, Adolescent Sexual Reproductive Health, stepped in through workshops where Keza learned to navigate her new age confidently. And no, she never replied to Cyusa's texts during study time.",
  "Yet life isn't just about physical health. It is also about the mind. Keza struggled some days, feeling unsure of herself and overwhelmed by expectations. That is when mental health programmes stepped in. She met counsellors who reminded her that self-love is part of success and equipped her with coping mechanisms.",
  "As she grew, Keza began asking deeper questions about our motherland. That is when Friday evenings at the hubs became her favourite: elders gathering to share stories through intergenerational dialogues. Their tales, rich with history and wisdom, would answer her questions and teach her about the giants whose shoulders we stand on.",
  "These elders will pass on lessons of resilience, strength, and unity, ensuring that as the youth rise, they do so with deep roots in their heritage.",
  "The Imbuto Hubs, a game-changer, will not be just a space. They will be home for every service Keza needs. Youth empowerment will help her discover her knack for hairstyling, a side hustle that will make her the unofficial braid boss of her district. Sports programmes will teach her teamwork. And knowledge development? Well, let's just say Keza can now write a budget that would make our finance department weep tears of joy.",
  "All of this, education, health, empowerment, and mental wellness, will be under one roof, guiding our youth from childhood to adulthood.",
  "Behind the scenes, HR found the people who mentored her. Procurement ensured every chalkboard, ball, and counselling tool made it to the right place. PMER, monitoring and evaluation, tracked her progress, making sure every effort counted. And communication made sure the world knew what Rwanda is doing for its youth.",
  "Today, Keza is a medical student. She still comes back to the hubs, this time as a mentor, telling kids: once upon a time I was you, and one day you will be me.",
  "To everyone, this is the power of us. Every Keza out there, every child who dares to dream, is a testament to what you do.",
  "Imbuto Hubs are where potential meets opportunity, where Keza's story isn't just a story. It is the future. And that future? It is in your hands.",
  "So let's build it. One hub at a time. One child at a time. One dream at a time.",
];

export default function KezaStoryPage() {
  return (
    <main className="bg-[#f7f7f2] text-[#102c35]">
      <Header />

      <article>
        <header className="bg-[#f7f7f2] pb-12 pt-32 md:pb-16 md:pt-40">
          <Container>
            <Link
              href="/impact#stories"
              className="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-[#102c35] shadow-sm transition hover:bg-[#f7f7f2]"
            >
              <ArrowLeft className="h-4 w-4" />
              Back to impact stories
            </Link>

            <div className="mt-8 overflow-hidden rounded-[38px] bg-white shadow-[0_24px_80px_rgba(16,44,53,0.10)] ring-1 ring-slate-200/80">
              <div className="grid lg:grid-cols-[0.9fr_1.1fr]">
                <div className="flex flex-col justify-center p-7 md:p-10 lg:p-12">
                  <div className="w-fit rounded-full bg-[#fff1e3] px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-[#c05d24]">
                    Impact story
                  </div>
                  <h1 className="mt-6 max-w-3xl text-5xl leading-[0.98] tracking-[-0.05em] text-[#102c35] md:text-7xl">
                    The Journey of Keza
                  </h1>
                  <p className="mt-6 max-w-2xl text-xl leading-9 text-slate-700 md:text-2xl md:leading-10">
                    A life shaped by learning, health, confidence, culture, and
                    opportunity.
                  </p>
                  <div className="mt-7 flex flex-wrap gap-3 text-sm text-slate-500">
                    <span className="rounded-full bg-[#f7f7f2] px-3 py-1 ring-1 ring-slate-200">
                      Featured story
                    </span>
                    <span className="rounded-full bg-[#f7f7f2] px-3 py-1 ring-1 ring-slate-200">
                      Imbuto Hubs
                    </span>
                    <span className="rounded-full bg-[#f7f7f2] px-3 py-1 ring-1 ring-slate-200">
                      5 min read
                    </span>
                  </div>
                </div>

                <div className="relative min-h-[360px] bg-[#043E52] lg:min-h-[560px]">
                  <Image
                    src="/images/gallery/55271389639_c61707ed44_k.jpg"
                    alt="Aerial view of an Imbuto Hub campus"
                    fill
                    priority
                    sizes="(min-width: 1024px) 50vw, 100vw"
                    className="object-cover"
                  />
                  <div className="absolute inset-0 bg-[linear-gradient(180deg,rgba(4,62,82,0.04),rgba(4,62,82,0.42))]" />
                  <div className="absolute bottom-5 left-5 right-5 rounded-[24px] border border-white/15 bg-[#043E52]/78 p-5 text-white backdrop-blur-md">
                    <p className="text-sm uppercase tracking-[0.22em] text-[#f5c346]">
                      Keza's path
                    </p>
                    <p className="mt-2 text-lg leading-7 text-white/86">
                      From early learning to mentorship, her story follows what
                      becomes possible when services meet a young person at each
                      stage of life.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </Container>
        </header>

        <section className="py-10 md:py-10">
          <Container>
            <div className="mx-auto max-w-5xl">
              <div className="rounded-[34px] bg-white p-7 shadow-sm ring-1 ring-slate-200/80 md:p-10">
                <div className="space-y-6 text-lg leading-9 text-slate-700">
                  {storyParagraphs.map((paragraph, index) => (
                    <div key={paragraph}>
                      <p
                        className={
                          index === 0
                            ? "text-xl leading-10 text-[#102c35]"
                            : ""
                        }
                      >
                        {paragraph}
                      </p>
                      {index === 15 ? (
                        <aside className="my-8 rounded-[28px] bg-[#f7f7f2] p-6 ring-1 ring-slate-200/80 md:p-8">
                          <div className="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#fff1e3] text-[#c05d24]">
                            <Quote className="h-5 w-5" />
                          </div>
                          <blockquote className="mt-5 text-3xl leading-10 tracking-[-0.04em] text-[#102c35]">
                            "Once upon a time I was you, and one day you will be me."
                          </blockquote>
                          <p className="mt-4 text-xs uppercase tracking-[0.18em] text-[#2b6274]">
                            Keza, medical student & mentor
                          </p>
                        </aside>
                      ) : null}
                    </div>
                  ))}
                </div>

                <div className="mt-10 border-t border-slate-200 pt-8">
                  <h2 className="text-3xl tracking-[-0.04em] text-[#102c35]">
                    Where potential meets opportunity.
                  </h2>
                  <p className="mt-4 text-base leading-8 text-slate-700">
                    Keza's story is a reminder that transformation rarely comes
                    from one moment alone. It is built through care, structure,
                    mentorship, and spaces that allow young people to grow.
                  </p>
                  <div className="mt-7 flex flex-wrap gap-4">
                    <Link
                      href="/apply"
                      className="inline-flex items-center gap-2 rounded-full bg-[#ed9b37] px-6 py-3.5 text-sm text-white shadow-lg shadow-[#ed9b37]/25 transition hover:-translate-y-0.5 hover:bg-[#c05d24]"
                    >
                      Register for a programme
                      <ArrowRight className="h-4 w-4" />
                    </Link>
                    <Link
                      href="/impact#gallery"
                      className="inline-flex items-center gap-2 rounded-full border border-[#102c35]/10 bg-white px-6 py-3.5 text-sm text-[#102c35] shadow-sm transition hover:bg-slate-50"
                    >
                      View gallery
                      <ArrowRight className="h-4 w-4" />
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          </Container>
        </section>
      </article>

      <Footer />
    </main>
  );
}
