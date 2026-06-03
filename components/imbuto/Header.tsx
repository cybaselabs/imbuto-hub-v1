import { Container } from "./Container";
import Image from "next/image";
import Link from "next/link";

export function Header() {
  const navItems = [
    { label: "Home", href: "/" },
    { label: "About", href: "/about" },
    { label: "Programs", href: "/programs" },
    { label: "Hubs", href: "/hubs" },
    { label: "Impact", href: "/impact" },
    { label: "Events", href: "/events" },
    { label: "Get Involved", href: "/get-involved" },
  ];

  return (
    <header className="fixed inset-x-0 top-0 z-50">
      <Container className="mt-4">
        <div className="flex items-center justify-between rounded-full border border-white/20 bg-[#102c35]/80 px-4 py-3 text-white shadow-2xl backdrop-blur-xl md:px-6">
          <Link href="/" aria-label="Imbuto Hubs home">
            <Image
              src="/images/Imbutohublogo_v2.png"
              alt="Imbuto Hub Logo"
              width={100}
              height={40}
              className="w-auto"
              priority
            />
          </Link>

          <nav className="hidden items-center gap-7 text-[15px] text-[#f5c346]/85 lg:flex">
            {navItems.map((item) => (
              <Link
                key={item.label}
                href={item.href}
                className="transition hover:text-white"
              >
                {item.label}
              </Link>
            ))}
          </nav>

          <div className="flex items-center gap-3">
            <button className="hidden rounded-full border border-white/20 px-4 py-2 text-sm text-white/85 md:block">
              EN / RW
            </button>
            <Link
              href="/hubs"
              className="rounded-full bg-[#ed9b37] px-5 py-2.5 text-sm text-white shadow-lg shadow-[#ed9b37]/25 transition hover:-translate-y-0.5 hover:bg-[#c05d24]"
            >
              Find a Hub
            </Link>
          </div>
        </div>
      </Container>
    </header>
  );
}
