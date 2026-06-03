"use client";

import Image from "next/image";
import { useEffect, useState } from "react";
import { ChevronLeft, ChevronRight, X } from "lucide-react";
import { Container } from "./Container";

const galleryItems = [
  {
    title: "Learning in community",
    image: "/images/54945400951_90ba3d130b_k.jpg",
  },
  {
    title: "Skills for the future",
    image: "/images/52552727843_776ae789f1_k.jpg",
  },
  {
    title: "Sports and confidence",
    image: "/images/52548376321_dda8370097_k.jpg",
  },
  {
    title: "Creative expression",
    image: "/images/55137656258_b872b35591_k.jpg",
  },
  {
    title: "Mentorship moments",
    image: "/images/54513896658_550ab2509d_k.jpg",
  },
  {
    title: "A place to belong",
    image: "/images/55137473511_81bbe538ab_k.jpg",
  },
  {
    title: "Youth dialogue",
    image: "/images/55137475546_055ffa64da_k.jpg",
  },
  {
    title: "Community exchange",
    image: "/images/55137476261_97dc06c8bf_k.jpg",
  },
  {
    title: "Future ready skills",
    image: "/images/54513810799_7d0c00742c_k.jpg",
  },
];

const overlayItems: Record<number, { title: string; label: string }> = {
  3: { title: "Story 04", label: "Mentorship" },
  6: { title: "Story 07", label: "Community" },
};

function SectionEyebrow({ children }: { children: React.ReactNode }) {
  return (
    <div className="text-sm uppercase tracking-[0.28em] text-[#c05d24]">
      {children}
    </div>
  );
}

export function ImpactGallery() {
  const [activeIndex, setActiveIndex] = useState<number | null>(null);
  const activeItem =
    activeIndex === null ? null : (galleryItems[activeIndex] ?? null);

  useEffect(() => {
    if (activeIndex === null) return;

    function handleKeyDown(event: KeyboardEvent) {
      if (event.key === "Escape") {
        setActiveIndex(null);
      }

      if (event.key === "ArrowRight") {
        setActiveIndex((current) =>
          current === null ? current : (current + 1) % galleryItems.length,
        );
      }

      if (event.key === "ArrowLeft") {
        setActiveIndex((current) =>
          current === null
            ? current
            : (current - 1 + galleryItems.length) % galleryItems.length,
        );
      }
    }

    document.addEventListener("keydown", handleKeyDown);
    document.body.style.overflow = "hidden";

    return () => {
      document.removeEventListener("keydown", handleKeyDown);
      document.body.style.overflow = "";
    };
  }, [activeIndex]);

  function showPrevious() {
    setActiveIndex((current) =>
      current === null
        ? current
        : (current - 1 + galleryItems.length) % galleryItems.length,
    );
  }

  function showNext() {
    setActiveIndex((current) =>
      current === null ? current : (current + 1) % galleryItems.length,
    );
  }

  return (
    <section id="gallery" className="bg-white py-20 md:py-24">
      <Container>
        <div className="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
          <div>
            <h2 className="mt-4 max-w-3xl text-4xl tracking-[-0.04em] md:text-5xl">
              Gallery
            </h2>
          </div>
          <p className="max-w-xl text-sm leading-7 text-slate-700 md:text-base">
            Moments from learning, mentorship, wellbeing, creativity, sport, and
            community life across the Imbuto Hubs network.
          </p>
        </div>

        <div className="mt-10 grid grid-cols-1 overflow-hidden rounded-[28px] sm:grid-cols-2 lg:grid-cols-3">
          {galleryItems.map((item, index) => {
            const overlay = overlayItems[index];

            return (
              <button
                key={item.title}
                type="button"
                onClick={() => setActiveIndex(index)}
                className="group relative aspect-[1.62/1] overflow-hidden bg-[#102c35] text-left"
                aria-label={`Open ${item.title}`}
              >
                <Image
                  src={item.image}
                  alt={item.title}
                  fill
                  sizes="(min-width: 1440px) 480px, (min-width: 1024px) 31vw, (min-width: 640px) 50vw, 100vw"
                  className="object-cover transition duration-500 group-hover:scale-105"
                />
                <div className="absolute inset-0 bg-black/0 transition group-hover:bg-black/20" />
                {overlay ? (
                  <div className="absolute inset-0 flex flex-col items-center justify-center bg-black/62 text-center text-white">
                    <div className="text-2xl font-semibold tracking-[-0.03em]">
                      {overlay.title}
                    </div>
                    <div className="mt-5 text-sm uppercase tracking-[0.24em] text-white/82">
                      {overlay.label}
                    </div>
                  </div>
                ) : null}
              </button>
            );
          })}
        </div>
      </Container>

      {activeItem ? (
        <div
          className="fixed inset-0 z-[80] bg-[#041f29]/95 px-4 py-5 text-white"
          role="dialog"
          aria-modal="true"
          aria-label={activeItem.title}
        >
          <div className="mx-auto flex h-full max-w-7xl flex-col">
            <div className="flex items-center justify-between gap-4">
              <div>
                <div className="text-xs uppercase tracking-[0.22em] text-white/55">
                  Gallery
                </div>
                <h3 className="mt-1 text-xl tracking-[-0.03em]">
                  {activeItem.title}
                </h3>
              </div>
              <button
                type="button"
                onClick={() => setActiveIndex(null)}
                className="flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20"
                aria-label="Close gallery image"
              >
                <X className="h-5 w-5" />
              </button>
            </div>

            <div className="relative mt-5 min-h-0 flex-1">
              <Image
                src={activeItem.image}
                alt={activeItem.title}
                fill
                sizes="100vw"
                className="object-contain"
                priority
              />
            </div>

            <div className="mt-5 flex items-center justify-between">
              <button
                type="button"
                onClick={showPrevious}
                className="inline-flex items-center gap-2 rounded-full bg-white/10 px-5 py-3 text-sm text-white transition hover:bg-white/20"
              >
                <ChevronLeft className="h-4 w-4" />
                Previous
              </button>
              <div className="text-sm text-white/60">
                {(activeIndex ?? 0) + 1} / {galleryItems.length}
              </div>
              <button
                type="button"
                onClick={showNext}
                className="inline-flex items-center gap-2 rounded-full bg-white/10 px-5 py-3 text-sm text-white transition hover:bg-white/20"
              >
                Next
                <ChevronRight className="h-4 w-4" />
              </button>
            </div>
          </div>
        </div>
      ) : null}
    </section>
  );
}
