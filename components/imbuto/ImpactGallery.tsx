"use client";

import Image from "next/image";
import { useEffect, useState } from "react";
import { ChevronLeft, ChevronRight, X } from "lucide-react";
import { Container } from "./Container";

const galleryItems = [
  {
    title: "Gallery 01",
    image: "/images/gallery/55270242117_a0626afba8_k.jpg",
  },
  {
    title: "Gallery 02",
    image: "/images/gallery/55270243822_a464e83a11_k.jpg",
  },
  {
    title: "Gallery 03",
    image: "/images/gallery/55270243927_c03172e4db_k.jpg",
  },
  {
    title: "Gallery 04",
    image: "/images/gallery/55270244022_af6d12cfa8_k.jpg",
  },
  {
    title: "Gallery 05",
    image: "/images/gallery/55270247032_959f5cdf93_k.jpg",
  },
  {
    title: "Gallery 06",
    image: "/images/gallery/55271155091_6d4af2592d_k.jpg",
  },
  {
    title: "Gallery 07",
    image: "/images/gallery/55271155416_4f2ced31ee_k.jpg",
  },
  {
    title: "Gallery 08",
    image: "/images/gallery/55271156911_4b28732802_6k.jpg",
  },
  {
    title: "Gallery 09",
    image: "/images/gallery/55271161021_b50277f8b3_k.jpg",
  },
  {
    title: "Gallery 10",
    image: "/images/gallery/55271161526_942df49b81_k.jpg",
  },
  {
    title: "Gallery 11",
    image: "/images/gallery/55271288843_036382434d_k.jpg",
  },
  {
    title: "Gallery 12",
    image: "/images/gallery/55271290113_2c0970d501_k.jpg",
  },
  {
    title: "Gallery 13",
    image: "/images/gallery/55271290738_148fbbb5cb_k.jpg",
  },
  {
    title: "Gallery 14",
    image: "/images/gallery/55271291243_45ec2e250e_k.jpg",
  },
  {
    title: "Gallery 15",
    image: "/images/gallery/55271386409_9ea9f85483_k.jpg",
  },
  {
    title: "Gallery 16",
    image: "/images/gallery/55271386784_668efc3eb6_k.jpg",
  },
  {
    title: "Gallery 17",
    image: "/images/gallery/55271386979_b31ba24b7e_k.jpg",
  },
  {
    title: "Gallery 18",
    image: "/images/gallery/55271387454_2049631a0c_k.jpg",
  },
  {
    title: "Gallery 19",
    image: "/images/gallery/55271387884_4de4c887a3_k.jpg",
  },
  {
    title: "Gallery 20",
    image: "/images/gallery/55271389639_c61707ed44_k.jpg",
  },
  {
    title: "Gallery 21",
    image: "/images/gallery/55271391719_b0b65dbf4c_k.jpg",
  },
  {
    title: "Gallery 22",
    image: "/images/gallery/55271392754_cff5c5bf22_k.jpg",
  },
  {
    title: "Gallery 23",
    image: "/images/gallery/55271392924_a1247a06ed_k.jpg",
  },
  {
    title: "Gallery 24",
    image: "/images/gallery/55271554100_90f68fe6ac_k.jpg",
  },
  {
    title: "Gallery 25",
    image: "/images/gallery/55271554820_65e5db3ed7_k.jpg",
  },
  {
    title: "Gallery 26",
    image: "/images/gallery/55271563510_75dc1f389e_k%20(1).jpg",
  },
];

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
          {galleryItems.map((item, index) => (
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
              </button>
          ))}
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
