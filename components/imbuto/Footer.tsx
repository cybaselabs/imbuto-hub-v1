
"use client";

import { Container } from "./Container";

export function Footer() {
  const groups = [
    {
      title: "About",
      items: ["About Imbuto Hubs", "Our Model", "Vision & Mission", "Impact Stories"],
    },
    {
      title: "Programs",
      items: [
        "Early Childhood Development",
        "Education & Personal Development",
        "Digital Literacy & Innovation",
        "Health & Wellbeing",
        "Sports & Recreation",
        "Creative Arts & Culture",
      ],
    },
    {
      title: "Explore",
      items: [
        "Kigali Imbuto Hub",
        "Musanze Imbuto Hub",
        "Huye Imbuto Hub",
        "Rubavu Imbuto Hub",
        "Nyagatare Imbuto Hub",
        "Rwamagana Imbuto Hub",
      ],
    },
  ];

  return (
    <footer className="relative overflow-hidden bg-[#062f3c] text-white">
      <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,164,93,0.16),transparent_24%),radial-gradient(circle_at_bottom_right,rgba(1,106,109,0.34),transparent_28%)]" />
      <div className="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent" />

      <Container className="relative pb-10 pt-20">
        <div className="grid gap-8 xl:grid-cols-[1.2fr_1.8fr]">
          <div className="rounded-[32px] border border-white/10 bg-white/5 p-8 backdrop-blur-sm">
            <div className="inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/10 px-4 py-2 text-sm text-white/80">
              <div className="flex h-9 w-9 items-center justify-center rounded-full bg-[#E16A3D] text-sm text-white">
                IH
              </div>
              Imbuto Foundation
            </div>
            <h3 className="mt-6 max-w-md text-4xl leading-tight tracking-[-0.04em] text-white">
              Growing futures, one hub at a time.
            </h3>
            <p className="mt-5 max-w-lg text-base leading-8 text-white/72">
              Imbuto Hubs create safe, inspiring spaces where children, youth, and families access learning, wellbeing, creativity, mentorship, and opportunity across Rwanda.
            </p>
            <div className="mt-8 flex flex-wrap gap-3">
              <button className="rounded-full bg-[#E16A3D] px-5 py-3 text-sm text-white shadow-lg shadow-[#E16A3D]/25 transition hover:-translate-y-0.5 hover:bg-[#cf5d34]">
                Find a Hub
              </button>
              <button className="rounded-full border border-white/15 bg-white/10 px-5 py-3 text-sm text-white backdrop-blur-md transition hover:bg-white/15">
                Get Involved
              </button>
            </div>
          </div>

          <div>
            <div className="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
              {groups.map((group) => (
                <div key={group.title} className="rounded-[28px] border border-white/10 bg-white/5 p-7 backdrop-blur-sm">
                  <div className="text-sm uppercase tracking-[0.28em] text-[#FFA45D]">
                    {group.title}
                  </div>
                  <ul className="mt-6 space-y-4 text-sm leading-7 text-white/80">
                    {group.items.map((item) => (
                      <li key={item}>{item}</li>
                    ))}
                  </ul>
                </div>
              ))}
            </div>

            <div className="mt-6 rounded-[32px] border border-white/10 bg-white/5 p-6 backdrop-blur-sm md:flex md:items-center md:justify-between">
              <div>
                <div className="text-sm uppercase tracking-[0.28em] text-[#FFA45D]">
                  Connect
                </div>
                <div className="mt-3 space-y-1 text-sm text-white/80">
                  <p>Imbuto Foundation</p>
                  <p>Kigali, Rwanda</p>
                  <p>info@imbutofoundation.org</p>
                  <p>+250 XXX XXX XXX</p>
                </div>
              </div>

              <div className="mt-6 flex flex-wrap gap-3 md:mt-0">
                {["F", "I", "Y", "L", "X"].map((item) => (
                  <div
                    key={item}
                    className="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/10 text-white transition hover:-translate-y-0.5 hover:bg-[#E16A3D]"
                  >
                    {item}
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>

        <div className="mt-10 overflow-hidden rounded-[28px] border border-white/10 bg-white/5 px-5 py-4 backdrop-blur-sm">
          <div className="flex flex-col gap-4 text-sm text-white/68 md:flex-row md:items-center md:justify-between">
            <div className="flex flex-wrap gap-5">
              <span>Privacy Policy</span>
              <span>Terms of Use</span>
              <span>Accessibility Statement</span>
            </div>
            <div>© 2026 Imbuto Hubs. All Rights Reserved.</div>
          </div>
        </div>
      </Container>
    </footer>
  );
}
