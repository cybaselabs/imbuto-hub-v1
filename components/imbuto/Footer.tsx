"use client";

import Image from "next/image";
import { Container } from "./Container";

const socialLinks = [
  {
    label: "Facebook",
    icon: (
      <svg viewBox="0 0 24 24" aria-hidden="true" className="h-5 w-5">
        <path
          fill="currentColor"
          d="M14.2 8.3V6.8c0-.7.5-.9.9-.9h2.2V2.3L14.2 2c-3.4 0-4.1 2.5-4.1 4.1v2.2H7.4v3.9h2.7V22h4.1v-9.8h3.1l.5-3.9h-3.6Z"
        />
      </svg>
    ),
  },
  {
    label: "Instagram",
    icon: (
      <svg viewBox="0 0 24 24" aria-hidden="true" className="h-5 w-5">
        <path
          fill="currentColor"
          d="M7.8 2h8.4A5.8 5.8 0 0 1 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8A5.8 5.8 0 0 1 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2Zm0 2A3.8 3.8 0 0 0 4 7.8v8.4A3.8 3.8 0 0 0 7.8 20h8.4a3.8 3.8 0 0 0 3.8-3.8V7.8A3.8 3.8 0 0 0 16.2 4H7.8Zm4.2 3.3A4.7 4.7 0 1 1 12 16.7a4.7 4.7 0 0 1 0-9.4Zm0 2A2.7 2.7 0 1 0 12 14.7a2.7 2.7 0 0 0 0-5.4Zm5-2.4a1.1 1.1 0 1 1 0 2.2 1.1 1.1 0 0 1 0-2.2Z"
        />
      </svg>
    ),
  },
  {
    label: "YouTube",
    icon: (
      <svg viewBox="0 0 24 24" aria-hidden="true" className="h-5 w-5">
        <path
          fill="currentColor"
          d="M21.6 7.2s-.2-1.6-.9-2.3c-.9-.9-1.9-.9-2.3-1C15.2 3.7 12 3.7 12 3.7s-3.2 0-6.4.2c-.5.1-1.5.1-2.3 1-.7.7-.9 2.3-.9 2.3S2.2 9.1 2.2 11v1.8c0 1.9.2 3.8.2 3.8s.2 1.6.9 2.3c.9.9 2 .9 2.5 1 1.8.2 6.2.2 6.2.2s3.2 0 6.4-.3c.5 0 1.5-.1 2.3-1 .7-.7.9-2.3.9-2.3s.2-1.9.2-3.8V11c0-1.9-.2-3.8-.2-3.8ZM10.1 14.9V8.4l5.8 3.3-5.8 3.2Z"
        />
      </svg>
    ),
  },
  {
    label: "LinkedIn",
    icon: (
      <svg viewBox="0 0 24 24" aria-hidden="true" className="h-5 w-5">
        <path
          fill="currentColor"
          d="M6.7 8.9H3V21h3.7V8.9ZM4.9 3A2.1 2.1 0 1 0 5 7.2 2.1 2.1 0 0 0 4.9 3Zm16 11.1c0-3.6-1.9-5.3-4.5-5.3a3.9 3.9 0 0 0-3.6 2h-.1V8.9H9.2V21h3.7v-6c0-1.6.3-3.1 2.2-3.1s2 1.8 2 3.2V21h3.8v-6.9Z"
        />
      </svg>
    ),
  },
  {
    label: "X",
    icon: (
      <svg viewBox="0 0 24 24" aria-hidden="true" className="h-5 w-5">
        <path
          fill="currentColor"
          d="M14.4 10.6 22.1 2h-1.8l-6.7 7.4L8.3 2H2.1l8.1 11.3L2.1 22h1.8l7.1-7.6 5.7 7.6h6.2l-8.5-11.4Zm-2.5 2.7-.8-1.1L4.6 3.3h2.8l5.2 7.2.8 1.1 6.9 9.2h-2.8l-5.6-7.5Z"
        />
      </svg>
    ),
  },
];

export function Footer() {
  return (
    <footer className="relative overflow-hidden bg-[#062f3c] text-white">
      <div className="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,164,93,0.16),transparent_24%),radial-gradient(circle_at_bottom_right,rgba(1,106,109,0.34),transparent_28%)]" />
      <div className="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent" />

      <Container className="relative pb-10 pt-20">
        <div className="grid gap-8 lg:grid-cols-[1fr_0.9fr] lg:items-stretch">
          <div className="rounded-[32px] border border-white/10 bg-white/5 p-8 backdrop-blur-sm md:p-10">
            <div className="inline-flex items-center rounded-full border border-white/10 bg-white/10 px-4 py-2">
              <Image
                src="/images/updated-IMBUTO LOGO-03.png"
                alt="Imbuto Hub Logo"
                width={130}
                height={52}
                className="h-10 w-auto"
              />
            </div>
            <h3 className="mt-6 max-w-md text-4xl leading-tight tracking-[-0.04em] text-white md:text-5xl">
              Growing futures, one hub at a time.
            </h3>
            <p className="mt-5 max-w-lg text-base leading-8 text-white/72">
              Imbuto Hubs create safe, inspiring spaces where children, youth,
              and families access learning, sports, wellbeing, and opportunity
              across Rwanda.
            </p>
          </div>

          <div className="rounded-[32px] border border-white/10 bg-white/5 p-8 backdrop-blur-sm md:p-10">
            <div className="text-sm uppercase tracking-[0.28em] text-[#FFA45D]">
              Connect
            </div>
            <div className="mt-6 space-y-2 text-base leading-8 text-white/78">
              <a
                href="mailto:Info@imbutohubs.com"
                className="inline-flex text-white transition hover:text-[#FFA45D]"
              >
                Info@imbutohubs.com
              </a>
            </div>

            <div className="mt-8 flex flex-wrap gap-3">
              {socialLinks.map((item) => (
                <span
                  key={item.label}
                  aria-label={item.label}
                  className="flex h-12 w-12 items-center justify-center rounded-full border border-white/10 bg-white/10 text-white transition hover:-translate-y-0.5 hover:bg-[#E16A3D]"
                >
                  {item.icon}
                </span>
              ))}
            </div>
          </div>
        </div>

        <div className="mt-10 text-center text-sm text-white/68">
          © 2026 Imbuto Hubs. All Rights Reserved.
        </div>
      </Container>
    </footer>
  );
}
