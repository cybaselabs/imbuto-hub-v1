import Image from "next/image";
export function Header() {
  return (
    <header className="fixed inset-x-0 top-0 z-50">
      <div className="mx-auto mt-4 flex max-w-7xl items-center justify-between rounded-full border border-white/20 bg-[var(--color-dark)]/80 px-4 py-3 text-white shadow-2xl backdrop-blur-xl md:px-6">
        <div className="flex items-center">
          <Image
            src="/images/Logo-07.png"
            alt="Imbuto Hub Logo"
            width={100}
            height={40}
            className="w-auto"
            priority
          />
        </div>

        <nav className="nav-font hidden items-center gap-7 text-[15px] font-normal text-[var(--color-yellow)]/85 lg:flex">
          <span className="cursor-pointer transition hover:text-white">
            Home
          </span>
          <span className="cursor-pointer transition hover:text-white">
            About
          </span>
          <span className="cursor-pointer transition hover:text-white">
            Programs
          </span>
          <span className="cursor-pointer transition hover:text-white">
            Hubs
          </span>
          <span className="cursor-pointer transition hover:text-white">
            Impact
          </span>
          <span className="cursor-pointer transition hover:text-white">
            Events
          </span>
          <span className="cursor-pointer transition hover:text-white">
            Get Involved
          </span>
        </nav>

        <div className="flex items-center gap-3">
          <button className="hidden rounded-full border border-white/20 px-4 py-2 text-sm font-medium text-white/85 transition hover:bg-white/10 md:block ![font-family:'Ruchill']">
            EN / RW
          </button>
          <button className="rounded-full bg-[var(--color-orange)] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-[var(--color-orange)]/25 transition hover:-translate-y-0.5 hover:bg-[var(--color-orange-dark)] ![font-family:'Ruchill']">
            Find a Hub
          </button>
        </div>
      </div>
    </header>
  );
}
