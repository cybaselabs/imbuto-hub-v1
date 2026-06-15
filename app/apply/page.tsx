import type { Metadata } from "next";
import { Header } from "../../components/imbuto/Header";
import { Footer } from "../../components/imbuto/Footer";
import { Container } from "../../components/imbuto/Container";
import { RegistrationForm } from "../get-involved/GetInvolvedPageClient";

export const metadata: Metadata = {
  title: "Apply",
  description: "Apply for an Imbuto Hub programme through the youth registration form.",
};

export default function ApplyPage() {
  return (
    <main className="bg-[#f7f7f2] text-[#102c35]">
      <Header />

      <section className="bg-[#043E52] pb-16 pt-32 text-white md:pb-20 md:pt-40">
        <Container>
          <div className="max-w-4xl">
            <div className="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md">
              Youth registration
            </div>
            <h1 className="mt-6 max-w-4xl text-5xl leading-[0.98] tracking-[-0.04em] text-[#f5c346]/95 md:text-7xl lg:text-[84px]">
              Apply for an Imbuto Hub programme.
            </h1>
            <p className="mt-7 max-w-3xl text-base leading-8 text-white/82 md:text-lg md:leading-9">
              Please complete all applicable sections of this form. The hub
              team will use your information to guide registration and next
              steps.
            </p>
          </div>
        </Container>
      </section>

      <section className="py-16 md:py-20">
        <Container>
          <div className="rounded-[36px] bg-white p-6 shadow-[0_24px_70px_rgba(16,44,53,0.08)] ring-1 ring-slate-200/80 md:p-8 lg:p-10">
            <RegistrationForm />
          </div>
        </Container>
      </section>

      <Footer />
    </main>
  );
}
