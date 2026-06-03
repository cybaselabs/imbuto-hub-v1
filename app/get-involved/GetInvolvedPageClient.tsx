"use client";

import { useEffect, useState } from "react";
import Image from "next/image";
import {
  ArrowRight,
  CheckCircle2,
  HandHeart,
  Sparkles,
  X,
} from "lucide-react";
import { Header } from "../../components/imbuto/Header";
import { Footer } from "../../components/imbuto/Footer";
import { Container } from "../../components/imbuto/Container";
import {
  heroImage,
  hubs,
  pillars,
} from "../../components/imbuto/data";

type FormType = "volunteer" | "partner" | "support" | "registration";

const hubOptions = hubs.map((hub) => hub.name);
const programmeOptions = pillars.map((pillar) => pillar.title);

const volunteerWays = [
  {
    title: "Programme Delivery",
    text: "Lead or support learning sessions in your area of expertise.",
  },
  {
    title: "Mentorship",
    text: "Guide a young person through education, career decisions, and personal growth.",
  },
  {
    title: "Skills Facilitation",
    text: "Teach practical skills such as coding, fashion, agriculture, sports coaching, health education, or financial literacy.",
  },
  {
    title: "Community Activation",
    text: "Help organise events and bring more people into the hub community.",
  },
];

const volunteerGains = [
  "A meaningful connection to Rwanda's youth development story",
  "Recognition and reference letters for formal volunteer service",
  "Training and orientation from Imbuto Foundation staff",
  "A community of like-minded changemakers",
];

const partnerTypes = [
  {
    title: "Infrastructure partner",
    text: "Support the construction or equipping of a hub facility.",
  },
  {
    title: "Programme partner",
    text: "Deliver or co-fund a specific programme in partnership with Imbuto Foundation.",
  },
  {
    title: "Corporate sponsor",
    text: "Brand visibility through a hub naming partnership, event, or programme sponsorship.",
  },
  {
    title: "Technical partner",
    text: "Contribute expertise, equipment, or technology such as ICT, health tools, or agricultural resources.",
  },
  {
    title: "Employment pathway",
    text: "Create internship, apprenticeship, or employment pathways for hub graduates.",
  },
];

const supportPartnerOptions = [
  {
    title: "Infrastructure Partner",
    text: "Support the construction or equipping of hub facilities.",
  },
  {
    title: "Programme Partner",
    text: "Co-deliver or co-fund programmes.",
  },
  {
    title: "Corporate Sponsor",
    text: "Support hubs through sponsorship and brand partnerships.",
  },
  {
    title: "Technical Partner",
    text: "Provide expertise, equipment, or technology.",
  },
  {
    title: "Employment Pathway Partner",
    text: "Offer internships, apprenticeships, or job opportunities.",
  },
];

const impactPartnershipImage = "/images/54513896658_550ab2509d_k.jpg";

const modalLabels: Record<FormType, string> = {
  volunteer: "Volunteer form",
  partner: "Partner form",
  support: "Support interest form",
  registration: "Registration form",
};

const inputClass =
  "mt-2 h-12 w-full rounded-full border border-slate-200 bg-white px-4 text-sm text-[#102c35] outline-none transition focus:border-[#52b3a9]";
const textAreaClass =
  "mt-2 w-full rounded-[24px] border border-slate-200 bg-white px-4 py-3 text-sm text-[#102c35] outline-none transition focus:border-[#52b3a9]";

function SectionEyebrow({ children }: { children: React.ReactNode }) {
  return (
    <div className="text-sm uppercase tracking-[0.28em] text-[#c05d24]">
      {children}
    </div>
  );
}

function CtaButton({
  children,
  onClick,
  variant = "solid",
}: {
  children: React.ReactNode;
  onClick: () => void;
  variant?: "solid" | "light" | "outline";
}) {
  const classes =
    variant === "light"
      ? "bg-white text-[#043E52] shadow-2xl hover:-translate-y-0.5"
      : variant === "outline"
        ? "border border-white/35 bg-white/10 text-white backdrop-blur-md hover:bg-white/15"
        : "bg-[#ed9b37] text-white shadow-lg shadow-[#ed9b37]/25 hover:-translate-y-0.5 hover:bg-[#c05d24]";

  return (
    <button
      type="button"
      onClick={onClick}
      className={`inline-flex items-center justify-center gap-2 rounded-full px-6 py-3.5 text-sm transition ${classes}`}
    >
      {children}
      <ArrowRight className="h-4 w-4" />
    </button>
  );
}

function FieldLabel({ children }: { children: React.ReactNode }) {
  return (
    <span className="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
      {children}
    </span>
  );
}

function TextField({
  label,
  type = "text",
  optional = false,
}: {
  label: string;
  type?: string;
  optional?: boolean;
}) {
  return (
    <label className="block">
      <FieldLabel>
        {label}
        {optional ? " (optional)" : ""}
      </FieldLabel>
      <input type={type} className={inputClass} />
    </label>
  );
}

function SelectField({ label, options }: { label: string; options: string[] }) {
  return (
    <label className="block">
      <FieldLabel>{label}</FieldLabel>
      <select className={inputClass}>
        {options.map((option) => (
          <option key={option}>{option}</option>
        ))}
      </select>
    </label>
  );
}

function TextAreaField({ label, rows = 5 }: { label: string; rows?: number }) {
  return (
    <label className="block">
      <FieldLabel>{label}</FieldLabel>
      <textarea rows={rows} className={textAreaClass} />
    </label>
  );
}

function Consent({ children }: { children: React.ReactNode }) {
  return (
    <label className="flex gap-3 text-sm leading-6 text-slate-700">
      <input type="checkbox" className="mt-1 h-4 w-4 shrink-0" />
      <span>{children}</span>
    </label>
  );
}

function SubmitButton({ children }: { children: React.ReactNode }) {
  return (
    <button
      type="submit"
      className="inline-flex items-center gap-2 rounded-full bg-[#ed9b37] px-6 py-3.5 text-sm text-white shadow-lg shadow-[#ed9b37]/25 transition hover:-translate-y-0.5 hover:bg-[#c05d24]"
    >
      {children}
      <ArrowRight className="h-4 w-4" />
    </button>
  );
}

function FormGrid({ children }: { children: React.ReactNode }) {
  return <div className="grid gap-4 md:grid-cols-2">{children}</div>;
}

function VolunteerForm() {
  return (
    <FormGrid>
      <TextField label="Name" />
      <TextField label="Email" type="email" />
      <TextField label="Phone" optional />
      <SelectField
        label="Area of expertise"
        options={[
          "Education",
          "Health",
          "Sports",
          "Arts",
          "Digital",
          "Business",
          "Agriculture",
          "Other",
        ]}
      />
      <SelectField label="Preferred hub(s)" options={hubOptions} />
      <SelectField
        label="Availability"
        options={["Weekdays", "Weekends", "School holidays", "Flexible"]}
      />
      <div className="md:col-span-2">
        <TextAreaField label="Brief motivation, 100-200 words" />
      </div>
      <div className="md:col-span-2">
        <Consent>
          I agree that my information may be used by Imbuto Foundation to
          contact me about volunteering opportunities.
        </Consent>
      </div>
      <div className="md:col-span-2">
        <SubmitButton>Submit Volunteer Application</SubmitButton>
      </div>
    </FormGrid>
  );
}

function PartnerForm() {
  return (
    <FormGrid>
      <TextField label="Organisation" />
      <TextField label="Contact name" />
      <TextField label="Email" type="email" />
      <SelectField
        label="Partnership interest"
        options={[
          "Infrastructure",
          "Programme",
          "Corporate",
          "Technical",
          "Employment",
          "Other",
        ]}
      />
      <div className="md:col-span-2">
        <TextAreaField label="Message" />
      </div>
      <div className="md:col-span-2">
        <Consent>
          I agree that my information may be used by Imbuto Foundation to
          contact me about partnership opportunities.
        </Consent>
      </div>
      <div className="md:col-span-2">
        <SubmitButton>Submit Partnership Inquiry</SubmitButton>
      </div>
    </FormGrid>
  );
}

function SupportForm() {
  return (
    <FormGrid>
      <TextField label="Name" />
      <TextField label="Email" type="email" />
      <TextField label="Phone" optional />
      <SelectField
        label="Contribution type"
        options={[
          "Equipment",
          "Programme funding",
          "Volunteer time",
          "Training",
          "Services",
          "Other",
        ]}
      />
      <SelectField
        label="Programme or area to support"
        options={programmeOptions}
      />
      <SelectField label="Preferred hub" options={hubOptions} />
      <div className="md:col-span-2">
        <TextAreaField label="Message" />
      </div>
      <div className="md:col-span-2">
        <Consent>
          I agree that my information may be used by Imbuto Foundation to
          contact me about supporting Imbuto Hubs.
        </Consent>
      </div>
      <div className="md:col-span-2">
        <SubmitButton>Support Imbuto Hubs</SubmitButton>
      </div>
    </FormGrid>
  );
}

function RegistrationForm() {
  return (
    <FormGrid>
      <TextField label="First name" />
      <TextField label="Last name" />
      <SelectField
        label="Age band"
        options={["Under 12", "12-17", "18-24", "25 and above"]}
      />
      <SelectField
        label="Province"
        options={["Kigali City", "Northern", "Southern", "Eastern", "Western"]}
      />
      <SelectField
        label="District"
        options={[
          "Kigali",
          "Musanze",
          "Huye",
          "Rubavu",
          "Nyagatare",
          "Bugesera",
        ]}
      />
      <TextField label="Phone number" optional />
      <TextField label="Email" type="email" optional />
      <SelectField label="Hub of interest" options={hubOptions} />
      <SelectField label="Programme of interest" options={programmeOptions} />
      <div className="md:col-span-2">
        <TextAreaField label="For a child under 12, parent or guardian name and contact details" />
      </div>
      <SelectField
        label="Preferred language"
        options={["English", "Kinyarwanda"]}
      />
      <div className="md:col-span-2">
        <Consent>
          I agree that my information may be used to connect me to Imbuto Hub
          services.
        </Consent>
      </div>
      <div className="md:col-span-2">
        <SubmitButton>Submit Registration</SubmitButton>
      </div>
    </FormGrid>
  );
}

function FormModal({
  activeForm,
  onClose,
}: {
  activeForm: FormType | null;
  onClose: () => void;
}) {
  useEffect(() => {
    if (!activeForm) return;

    const onKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Escape") onClose();
    };

    document.body.style.overflow = "hidden";
    window.addEventListener("keydown", onKeyDown);

    return () => {
      document.body.style.overflow = "";
      window.removeEventListener("keydown", onKeyDown);
    };
  }, [activeForm, onClose]);

  if (!activeForm) return null;

  return (
    <div
      className="fixed inset-0 z-[80] grid place-items-center overflow-y-auto bg-[#031f29]/70 px-4 py-6 backdrop-blur-sm md:py-10"
      role="dialog"
      aria-modal="true"
      aria-labelledby="get-involved-form-title"
    >
      <button
        type="button"
        aria-label="Close form"
        className="fixed inset-0 h-full w-full cursor-default"
        onClick={onClose}
      />
      <div className="relative max-h-[calc(100vh-3rem)] w-full max-w-4xl overflow-y-auto rounded-[28px] bg-[#f7f7f2] p-5 shadow-2xl md:max-h-[calc(100vh-5rem)] md:p-8">
        <div className="flex items-start justify-between gap-4">
          <div>
            <SectionEyebrow>Get Involved</SectionEyebrow>
            <h2
              id="get-involved-form-title"
              className="mt-3 text-3xl tracking-[-0.04em] md:text-5xl"
            >
              {modalLabels[activeForm]}
            </h2>
          </div>
          <button
            type="button"
            aria-label="Close form"
            onClick={onClose}
            className="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-slate-200 bg-white text-[#102c35] transition hover:bg-slate-100"
          >
            <X className="h-5 w-5" />
          </button>
        </div>

        <form className="mt-7">
          {activeForm === "volunteer" ? <VolunteerForm /> : null}
          {activeForm === "partner" ? <PartnerForm /> : null}
          {activeForm === "support" ? <SupportForm /> : null}
          {activeForm === "registration" ? <RegistrationForm /> : null}
        </form>
      </div>
    </div>
  );
}

export function GetInvolvedPageClient() {
  const [activeForm, setActiveForm] = useState<FormType | null>(null);

  return (
    <main className="bg-[#f7f7f2] text-[#102c35]">
      <Header />

      <section className="relative isolate overflow-hidden bg-[#043E52] pb-20 pt-32 text-white md:pb-24 md:pt-40">
        <div className="absolute inset-0">
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url('${heroImage}')` }}
          />
          <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(4,62,82,0.96)_0%,rgba(4,62,82,0.82)_48%,rgba(4,62,82,0.50)_100%)]" />
        </div>

        <Container className="relative">
          <div className="max-w-4xl">
            <div className="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-white/85 backdrop-blur-md">
              <HandHeart className="h-4 w-4" />
              Get Involved
            </div>
            <h1 className="mt-6 max-w-4xl text-5xl leading-[0.98] tracking-[-0.04em] text-[#f5c346]/95 md:text-7xl lg:text-[84px]">
              Support growth through Imbuto Hubs.
            </h1>
            <p className="mt-7 max-w-3xl text-base leading-8 text-white/82 md:text-lg md:leading-9">
              Imbuto Hubs grow through community action and strong partnerships.
              Whether you want to volunteer, mentor, partner, or support a
              programme, your contribution helps expand opportunity for
              Rwanda&apos;s young people.
            </p>
            <div className="mt-9 flex flex-wrap gap-4">
              <CtaButton
                onClick={() => setActiveForm("registration")}
                variant="light"
              >
                Submit Interest
              </CtaButton>
              <CtaButton
                onClick={() => setActiveForm("volunteer")}
                variant="outline"
              >
                Apply Now
              </CtaButton>
            </div>
          </div>
        </Container>
      </section>

      <section id="volunteer" className="bg-white py-20 md:py-24">
        <Container>
          <div className="grid gap-10 lg:grid-cols-[0.88fr_1.12fr]">
            <div>
              <SectionEyebrow>Volunteer & Mentor</SectionEyebrow>
              <h2 className="mt-4 max-w-2xl text-3xl tracking-[-0.04em] md:text-5xl">
                Your experience is someone else&apos;s opportunity.
              </h2>
              <p className="mt-5 max-w-2xl text-base leading-8 text-slate-700">
                Support young people through mentorship, coaching, training
                sessions, or community activities. Share your knowledge and help
                others build confidence and direction.
              </p>
              <div className="mt-8">
                <CtaButton onClick={() => setActiveForm("volunteer")}>
                  Submit Volunteer Application
                </CtaButton>
              </div>
            </div>

            <div>
              <div className="grid gap-4 sm:grid-cols-2">
                {volunteerWays.map((way) => (
                  <div
                    key={way.title}
                    className="rounded-[26px] border border-slate-200/80 bg-[#f7f7f2] p-6 shadow-sm"
                  >
                    <div className="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#fff1e3] text-[#c05d24]">
                      <Sparkles className="h-5 w-5" />
                    </div>
                    <h3 className="mt-5 text-xl tracking-[-0.03em]">
                      {way.title}
                    </h3>
                    <p className="mt-3 text-sm leading-7 text-slate-700">
                      {way.text}
                    </p>
                  </div>
                ))}
              </div>

              <div className="mt-6 rounded-[28px] border border-slate-200/80 bg-[#f7f7f2] p-6 shadow-sm">
                <h3 className="text-2xl tracking-[-0.03em]">
                  What volunteers gain
                </h3>
                <div className="mt-5 grid gap-3">
                  {volunteerGains.map((gain) => (
                    <div key={gain} className="flex gap-3 text-sm leading-7">
                      <CheckCircle2 className="mt-1 h-4 w-4 shrink-0 text-[#0f5b58]" />
                      {gain}
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </Container>
      </section>

      <section id="partner" className="py-20 md:py-24">
        <Container>
          <div className="grid gap-10 lg:grid-cols-[0.78fr_1.22fr]">
            <div>
              <SectionEyebrow>Partner With Us</SectionEyebrow>
              <h2 className="mt-4 max-w-2xl text-3xl tracking-[-0.04em] md:text-5xl">
                Rwanda&apos;s future is built through partnership.
              </h2>
              <p className="mt-5 max-w-2xl text-base leading-8 text-slate-700">
                Organisations and institutions can partner with Imbuto Hubs to
                deliver programmes, sponsor activities, provide resources, or
                co-create opportunities for youth and communities.
              </p>
              <div className="mt-8">
                <CtaButton onClick={() => setActiveForm("partner")}>
                  Submit Partnership Inquiry
                </CtaButton>
              </div>
            </div>

            <div className="grid gap-3 sm:grid-cols-2">
              {partnerTypes.map((partner) => (
                <div
                  key={partner.title}
                  className="rounded-2xl border border-slate-200/80 bg-white px-5 py-4 text-[#102c35] shadow-sm"
                >
                  <h3 className="text-base font-semibold">{partner.title}</h3>
                  <p className="mt-2 text-sm leading-6 text-slate-700">
                    {partner.text}
                  </p>
                </div>
              ))}
            </div>
          </div>
        </Container>
      </section>

      <section id="support" className="bg-white py-20 md:py-24">
        <Container>
          <div className="overflow-hidden rounded-[36px] bg-[#043E52] text-white shadow-[0_28px_90px_rgba(3,31,41,0.18)]">
            <div className="p-8 md:p-10">
              <div className="text-sm uppercase tracking-[0.28em] text-[#f5c346]">
                  Support a Programme / Donate
                </div>
                <h2 className="mt-4 max-w-2xl text-3xl tracking-[-0.04em] md:text-5xl">
                  Every contribution grows something.
                </h2>
                <p className="mt-5 max-w-2xl text-base leading-8 text-white/78">
                  Support can include equipment, programme funding, volunteer
                  time, training, or services that strengthen hub delivery and
                  reach. Your contribution helps keep core programmes accessible
                  and free for participants.
                </p>
                <div className="mt-7 grid gap-3 sm:grid-cols-5">
                  {supportPartnerOptions.map((option) => (
                    <div
                      key={option.title}
                      className="rounded-2xl border border-white/15 bg-white/10 p-4 text-white"
                    >
                      <h3 className="text-base font-semibold">
                        {option.title}
                      </h3>
                      <p className="mt-2 text-sm leading-6 text-white/72">
                        {option.text}
                      </p>
                    </div>
                  ))}
                </div>
                <div className="mt-6 rounded-2xl border border-white/15 bg-white/10 p-5 text-sm leading-7 text-white/76">
                  Donation processing platform and payment gateway to be
                  confirmed by Imbuto Foundation before this section goes live.
                </div>
                <div className="mt-8">
                  <CtaButton
                    onClick={() => setActiveForm("support")}
                    variant="light"
                  >
                    Support Imbuto Hubs
                  </CtaButton>
                </div>
            </div>
          </div>
        </Container>
      </section>

      <section id="impact-partnerships" className="py-20 md:py-24">
        <Container>
          <div className="grid gap-10 lg:grid-cols-[0.75fr_1.25fr] lg:items-center">
            <div>
              <SectionEyebrow>Partnerships That Create Impact</SectionEyebrow>
              <h2 className="mt-4 max-w-2xl text-3xl tracking-[-0.04em] md:text-5xl">
                Partnerships expand opportunity across Rwanda.
              </h2>
              <p className="mt-5 max-w-2xl text-base leading-8 text-slate-700">
                Imbuto Hubs work with government institutions, NGOs, businesses,
                and community organisations to expand opportunities for youth
                across Rwanda.
              </p>
              <p className="mt-5 max-w-2xl text-base leading-8 text-slate-700">
                Our partners support programmes in areas such as education,
                health, digital skills, entrepreneurship, and sports.
              </p>
              <div className="mt-8">
                <CtaButton onClick={() => setActiveForm("partner")}>
                  Partner With Us
                </CtaButton>
              </div>
            </div>

            <div className="relative min-h-[360px] overflow-hidden rounded-[32px] bg-slate-200 shadow-[0_28px_90px_rgba(3,31,41,0.16)] md:min-h-[460px]">
              <Image
                src={impactPartnershipImage}
                alt="Partners seated together at an Imbuto Hubs gathering"
                fill
                sizes="(max-width: 1024px) 100vw, 58vw"
                className="object-cover"
              />
              <div className="absolute inset-x-0 bottom-0 bg-[linear-gradient(0deg,rgba(3,31,41,0.82),rgba(3,31,41,0))] px-6 pb-6 pt-28 text-white md:px-8 md:pb-8">
                <p className="max-w-xl text-base leading-7 text-white/88">
                  Partnership brings institutions, businesses, and communities
                  together around practical opportunities for young people.
                </p>
              </div>
            </div>
          </div>
        </Container>
      </section>

      <section id="story" className="bg-white py-20 md:py-24">
        <Container>
          <div className="grid gap-10 lg:grid-cols-[0.78fr_1.22fr]">
            <div>
              <SectionEyebrow>Be Part of the Imbuto Hubs Story</SectionEyebrow>
              <h2 className="mt-4 max-w-2xl text-3xl tracking-[-0.04em] md:text-5xl">
                Register your interest.
              </h2>
              <p className="mt-5 max-w-2xl text-base leading-8 text-slate-700">
                Tell us who you are, what you are looking for, and where you are
                located so we can connect you to the right hub or programme. A
                coordinator will follow up within 48 hours.
              </p>
              <div className="mt-8 flex flex-wrap gap-4">
                <CtaButton onClick={() => setActiveForm("registration")}>
                  Submit Registration
                </CtaButton>
                <CtaButton onClick={() => setActiveForm("volunteer")}>
                  Volunteer or Mentor
                </CtaButton>
                <CtaButton onClick={() => setActiveForm("partner")}>
                  Partner With Us
                </CtaButton>
                <CtaButton onClick={() => setActiveForm("support")}>
                  Support a Programme
                </CtaButton>
              </div>
            </div>

            <div className="rounded-[28px] border border-slate-200/80 bg-[#f7f7f2] p-6 shadow-sm md:p-8">
              <h3 className="text-2xl tracking-[-0.03em]">Privacy note</h3>
              <div className="mt-5 grid gap-3 text-sm leading-7 text-slate-700">
                <div className="flex gap-3">
                  <CheckCircle2 className="mt-1 h-4 w-4 shrink-0 text-[#0f5b58]" />
                  We collect this information to support your request and
                  connect you to the right hub or programme.
                </div>
                <div className="flex gap-3">
                  <CheckCircle2 className="mt-1 h-4 w-4 shrink-0 text-[#0f5b58]" />
                  We will not share your personal information outside the
                  approved Imbuto Hubs management process without your consent.
                </div>
              </div>
            </div>
          </div>
        </Container>
      </section>

      <Footer />
      <FormModal activeForm={activeForm} onClose={() => setActiveForm(null)} />
    </main>
  );
}
