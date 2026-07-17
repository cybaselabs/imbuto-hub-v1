"use client";

import Image from "next/image";
import Link from "next/link";
import { ArrowRight } from "lucide-react";
import { Container } from "./Container";
import { heroImage } from "./data";

function HubsImpactCard() {
  return (
    <div className="w-full max-w-[580px] justify-self-center rounded-[16px] border border-white/12 bg-[#082f3b17] p-6 shadow-2xl shadow-black/25 backdrop-blur-md md:p-8 lg:justify-self-end">
      <div className="grid gap-6 sm:grid-cols-[0.9fr_1fr] sm:items-center">
        <div>
          <div className="flex flex-wrap items-end gap-x-3 gap-y-1">
            <span className="font-sans text-[92px] font-black leading-[0.82] tracking-normal text-[#f5c346] md:text-[112px]">
              30+
            </span>

            <h1 className="max-w-[11ch] text-5xl leading-none tracking-normal text-[#f5c346] md:text-7xl lg:text-[86px]">
              Hubs
            </h1>
          </div>
          <p className="mt-5 text-sm font-black uppercase tracking-[0.14em] text-[#2fd1c5]">
            Across Rwanda
          </p>
          <p className="mt-4 max-w-[270px] text-sm leading-6 text-white/78 md:text-base md:leading-7">
            Building a nationwide network of opportunity.
          </p>
        </div>
        <div className="relative mx-auto w-full max-w-[300px]">
          <Image
            src="/images/rw-04.png"
            alt=""
            width={1000}
            height={468}
            aria-hidden="true"
            className="h-auto w-full object-contain"
          />
        </div>
      </div>
    </div>
  );
}

export function HeroSection() {
  return (
    <section className="relative isolate overflow-hidden bg-[#043E52] pb-16 pt-24 text-white md:pb-24 md:pt-32 lg:pb-28">
      <div className="absolute inset-0">
        <div
          className="absolute inset-0 bg-cover bg-center"
          style={{ backgroundImage: `url('${heroImage}')` }}
        />
        <div
          className="absolute inset-0"
          style={{
            backgroundImage:
              "radial-gradient(circle at 12% 8%, #ffa45d38, #0000 18%), linear-gradient(90deg, #043e52f5 0%, #043e52dc 48%, #043e5288 100%)",
          }}
        />
        <div className="absolute -left-28 top-24 h-72 w-72 rounded-full bg-[#E16A3D]/20 blur-3xl" />
        <div className="absolute bottom-0 right-0 h-80 w-80 rounded-full bg-[#016A6D]/30 blur-3xl" />
      </div>

      <Container className="relative pb-10 pt-6 md:pb-12 md:pt-16">
        <div className="grid gap-12 lg:grid-cols-[1fr_0.82fr] lg:items-center xl:gap-20">
          <div className="max-w-3xl">
            <h1 className="max-w-[11ch] text-5xl leading-none tracking-normal text-[#f5c346] md:text-7xl lg:text-[86px]">
              Rooted in Community
            </h1>
            <p className="mt-5 max-w-[620px] text-2xl font-semibold leading-8 text-white md:text-3xl md:leading-10">
              Spaces of opportunity for every generation.
            </p>
            <p className="mt-6 max-w-[640px] text-base leading-8 text-white/80 md:text-lg md:leading-9">
              Imbuto Hubs are vibrant community spaces across Rwanda where
              children, youth, and families come together to learn, grow,
              create, play, and thrive.
            </p>

            <div className="mt-8 flex flex-col gap-4 sm:flex-row sm:items-center">
              <Link
                href="/hubs"
                className="inline-flex items-center justify-center rounded-full bg-[#ed9b37] px-7 py-3.5 text-base font-semibold text-white shadow-lg shadow-[#ed9b37]/25 transition hover:-translate-y-0.5 hover:bg-[#c05d24] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#f5c346] motion-reduce:transform-none motion-reduce:transition-none"
              >
                Find a Hub
              </Link>
              <Link
                href="/impact/keza"
                className="inline-flex items-center justify-center gap-2 rounded-full border border-white/25 bg-white/10 px-7 py-3.5 text-base font-semibold text-white backdrop-blur-sm transition hover:-translate-y-0.5 hover:border-[#f5c346]/70 hover:bg-white/16 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-[#f5c346] motion-reduce:transform-none motion-reduce:transition-none"
              >
                Meet Keza
                <ArrowRight className="h-4 w-4" aria-hidden="true" />
              </Link>
            </div>
          </div>

          <HubsImpactCard />
        </div>
      </Container>
    </section>
  );
}
