import { Header } from "../components/imbuto/Header";
import { HeroSection } from "../components/imbuto/HeroSection";
import { ActionSection } from "../components/imbuto/ActionSection";
import { AboutSection } from "../components/imbuto/AboutSection";
import { PillarsSection } from "../components/imbuto/PillarsSection";
import { LifeStageSection } from "../components/imbuto/LifeStageSection";
import { StatsSection } from "../components/imbuto/StatsSection";
import { HubsSection } from "../components/imbuto/HubsSection";
import { PartnersSection } from "../components/imbuto/PartnersSection";
import { CtaSection } from "../components/imbuto/CtaSection";
import { Footer } from "../components/imbuto/Footer";

export default function Page() {
  return (
    <main className="bg-[#f7f7f2]">
      <Header />
      <HeroSection />
      <PillarsSection />
      <ActionSection />
      <AboutSection />
      <LifeStageSection />
      <StatsSection />
      <HubsSection />
      <PartnersSection />
      <CtaSection />
      <Footer />
    </main>
  );
}
