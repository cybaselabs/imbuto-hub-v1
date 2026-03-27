export function Header() {
  return (
    <header className="fixed inset-x-0 top-0 z-50">
      <div className="mx-auto mt-4 flex max-w-7xl items-center justify-between rounded-full border border-white/20 bg-[#043E52]/80 px-4 py-3 text-white shadow-2xl backdrop-blur-xl md:px-6">
        <div className="flex items-center gap-3">
          <div className="flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-sm font-bold ring-1 ring-white/20">
            IH
          </div>
          <div>
            <div className="text-[10px] uppercase tracking-[0.32em] text-white/60">Imbuto Foundation</div>
            <div className="text-sm font-semibold md:text-base">Imbuto Hubs</div>
          </div>
        </div>

        <nav className="hidden items-center gap-7 text-sm font-medium text-white/85 lg:flex">
          <span className="cursor-pointer transition hover:text-white">Home</span>
          <span className="cursor-pointer transition hover:text-white">About</span>
          <span className="cursor-pointer transition hover:text-white">Programs</span>
          <span className="cursor-pointer transition hover:text-white">Hubs</span>
          <span className="cursor-pointer transition hover:text-white">Impact</span>
          <span className="cursor-pointer transition hover:text-white">Events</span>
          <span className="cursor-pointer transition hover:text-white">Get Involved</span>
        </nav>

        <div className="flex items-center gap-3">
          <button className="hidden rounded-full border border-white/20 px-4 py-2 text-sm font-medium text-white/85 transition hover:bg-white/10 md:block">
            EN / RW
          </button>
          <button className="rounded-full bg-[#E16A3D] px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-[#E16A3D]/25 transition hover:-translate-y-0.5 hover:bg-[#cf5d34]">
            Find a Hub
          </button>
        </div>
      </div>
    </header>
  );
}
