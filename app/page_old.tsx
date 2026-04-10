import { AboutSection } from "../components/imbuto/AboutSection";
import { CtaSection } from "../components/imbuto/CtaSection";
import { Footer } from "../components/imbuto/Footer";
import { Header } from "../components/imbuto/Header";
import { HeroSection } from "../components/imbuto/HeroSection";
import { HubsSection } from "../components/imbuto/HubsSection";
import { LifeStageSection } from "../components/imbuto/LifeStageSection";
import { PartnersSection } from "../components/imbuto/PartnersSection";
import { PillarsSection } from "../components/imbuto/PillarsSection";
import { StatsSection } from "../components/imbuto/StatsSection";

export default function Page() {
  return (
    <main className="bg-[#f7f7f2]">
      <Header />
      <HeroSection />
      <AboutSection />
      <PillarsSection />
      <LifeStageSection />
      <StatsSection />
      <HubsSection />
      <PartnersSection />
      <CtaSection />
      <Footer />
    </main>
  );
}
