import { Container } from "./Container";
import Image from "next/image";
export function Header() {
  const navItems = [
    "Home",
    "About",
    "Programs",
    "Hubs",
    "Impact",
    "Events",
    "Get Involved",
  ];

  return (
    <header className="fixed inset-x-0 top-0 z-50">
      <Container className="mt-4">
        <div className="flex items-center justify-between rounded-full border border-white/20 bg-[#102c35]/80 px-4 py-3 text-white shadow-2xl backdrop-blur-xl md:px-6">
          <Image
            src="/images/Imbutohublogo_v2.png"
            alt="Imbuto Hub Logo"
            width={100}
            height={100}
            className="w-auto"
            priority
          />

          <nav className="hidden items-center gap-7 text-[15px] text-[#f5c346]/85 lg:flex">
            {navItems.map((item) => (
              <span
                key={item}
                className="cursor-pointer transition hover:text-white"
              >
                {item}
              </span>
            ))}
          </nav>

          <div className="flex items-center gap-3">
            <button className="hidden rounded-full border border-white/20 px-4 py-2 text-sm text-white/85 md:block">
              EN / RW
            </button>
            <button className="rounded-full bg-[#ed9b37] px-5 py-2.5 text-sm text-white shadow-lg shadow-[#ed9b37]/25 transition hover:-translate-y-0.5 hover:bg-[#c05d24]">
              Find a Hub
            </button>
          </div>
        </div>
      </Container>
    </header>
  );
}
