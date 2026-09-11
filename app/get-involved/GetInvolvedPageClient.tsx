"use client";

import { useEffect, useRef, useState, type ChangeEventHandler } from "react";
import Image from "next/image";
import { ArrowRight, CheckCircle2, HandHeart, Sparkles, X } from "lucide-react";
import { Header } from "../../components/imbuto/Header";
import { Footer } from "../../components/imbuto/Footer";
import { Container } from "../../components/imbuto/Container";
import { TurnstileWidget } from "../../components/imbuto/TurnstileWidget";
import { heroImage, hubs, pillars } from "../../components/imbuto/data";

type FormType = "volunteer" | "partner" | "support" | "registration";

const hubOptions = hubs.map((hub) => hub.name);
const registrationHubOptions = ["Imbuto Hub Bugesera"];
const registrationTrainingByHub: Record<string, string[]> = {
  "Imbuto Hub Bugesera": [
    "Hairdressing and Beauty",
    "Tailoring and Fashion",
    "IT and Computer Applications",
    "Childcare and Playground Activities",
  ],
};
const programmeOptions = pillars.map((pillar) => pillar.title);
const turnstileSiteKey = process.env.NEXT_PUBLIC_TURNSTILE_SITE_KEY || "";

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

function fieldName(label: string) {
  return label
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, "-")
    .replace(/^-|-$/g, "");
}

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
  name,
  value,
  onChange,
  autoComplete,
}: {
  label: string;
  type?: string;
  optional?: boolean;
  name?: string;
  value?: string;
  onChange?: ChangeEventHandler<HTMLInputElement>;
  autoComplete?: string;
}) {
  return (
    <label className="block">
      <FieldLabel>
        {label}
        {optional ? " (optional)" : <span aria-hidden="true"> *</span>}
      </FieldLabel>
      <input
        type={type}
        name={name ?? fieldName(label)}
        value={value}
        onChange={onChange}
        autoComplete={autoComplete}
        required={!optional}
        min={type === "number" ? 1 : undefined}
        max={type === "number" ? 120 : undefined}
        className={inputClass}
      />
    </label>
  );
}

function SelectField({
  label,
  options,
  optional = false,
  name,
  placeholder,
  value,
  onChange,
}: {
  label: string;
  options: string[];
  optional?: boolean;
  name?: string;
  placeholder?: string;
  value?: string;
  onChange?: ChangeEventHandler<HTMLSelectElement>;
}) {
  return (
    <label className="block">
      <FieldLabel>
        {label}
        {optional ? " (optional)" : <span aria-hidden="true"> *</span>}
      </FieldLabel>
      <select
        name={name ?? fieldName(label)}
        value={value}
        onChange={onChange}
        required={!optional}
        className={inputClass}
      >
        {placeholder ? <option value="">{placeholder}</option> : null}
        {options.map((option) => (
          <option key={option}>{option}</option>
        ))}
      </select>
    </label>
  );
}

function TextAreaField({
  label,
  rows = 5,
  optional = false,
  name,
}: {
  label: string;
  rows?: number;
  optional?: boolean;
  name?: string;
}) {
  return (
    <label className="block">
      <FieldLabel>
        {label}
        {optional ? " (optional)" : <span aria-hidden="true"> *</span>}
      </FieldLabel>
      <textarea
        rows={rows}
        name={name ?? fieldName(label)}
        required={!optional}
        className={textAreaClass}
      />
    </label>
  );
}

function CheckboxGroup({
  label,
  options,
  name,
  singleChoice = false,
  required = false,
  value,
  onChange,
}: {
  label: string;
  options: string[];
  name?: string;
  singleChoice?: boolean;
  required?: boolean;
  value?: string;
  onChange?: ChangeEventHandler<HTMLInputElement>;
}) {
  const groupName = name ?? fieldName(label);

  return (
    <fieldset
      className="block"
      data-required-group={required ? "true" : undefined}
      data-group-label={label}
      aria-required={required}
    >
      <FieldLabel>
        {label}
        {required ? <span aria-hidden="true"> *</span> : null}
      </FieldLabel>
      <div className="mt-3 grid gap-3 rounded-[24px] border border-slate-200 bg-white p-4 sm:grid-cols-2">
        {options.map((option) => (
          <label
            key={option}
            className="flex items-center gap-3 text-sm text-slate-700"
          >
            <input
              type={singleChoice ? "radio" : "checkbox"}
              name={groupName}
              value={option}
              checked={singleChoice && value !== undefined ? value === option : undefined}
              onChange={onChange}
              className="h-4 w-4 shrink-0"
            />
            <span>{option}</span>
          </label>
        ))}
      </div>
    </fieldset>
  );
}

function Consent({
  children,
  name,
  required = false,
}: {
  children: React.ReactNode;
  name?: string;
  required?: boolean;
}) {
  return (
    <label className="flex gap-3 text-sm leading-6 text-slate-700">
      <input
        type="checkbox"
        name={name}
        value="yes"
        required={required}
        className="mt-1 h-4 w-4 shrink-0"
      />
      <span>{children}</span>
    </label>
  );
}

function SubmitButton({
  children,
  disabled = false,
}: {
  children: React.ReactNode;
  disabled?: boolean;
}) {
  return (
    <button
      type="submit"
      disabled={disabled}
      className="inline-flex items-center gap-2 rounded-full bg-[#ed9b37] px-6 py-3.5 text-sm text-white shadow-lg shadow-[#ed9b37]/25 transition hover:-translate-y-0.5 hover:bg-[#c05d24] disabled:cursor-not-allowed disabled:opacity-60 disabled:hover:translate-y-0"
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
        <TextAreaField
          label="Brief motivation (100–200 words)"
          name="motivation"
        />
      </div>
      <div className="md:col-span-2">
        <Consent name="contact-consent" required>
          I agree that my information may be used by Imbuto Foundation to
          contact me about volunteering opportunities.
        </Consent>
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
        <Consent name="contact-consent" required>
          I agree that my information may be used by Imbuto Foundation to
          contact me about partnership opportunities.
        </Consent>
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
      <CheckboxGroup
        label="Contribution type"
        name="contribution-type"
        options={[
          "Equipment",
          "Programme funding",
          "Volunteer time",
          "Training",
          "Services",
          "Other",
        ]}
        required
      />
      <CheckboxGroup
        label="Programme or area to support"
        name="programme-or-area-to-support"
        options={programmeOptions}
        required
      />
      <SelectField label="Preferred hub" options={hubOptions} />
      <div className="md:col-span-2">
        <TextAreaField label="Message" />
      </div>
      <div className="md:col-span-2">
        <Consent name="contact-consent" required>
          I agree that my information may be used by Imbuto Foundation to
          contact me about supporting Imbuto Hubs.
        </Consent>
      </div>
    </FormGrid>
  );
}

type ConnectedFormType = Exclude<FormType, "registration">;

const connectedFormLabels: Record<
  ConnectedFormType,
  { button: string; confirmation: string }
> = {
  volunteer: {
    button: "Submit Volunteer Application",
    confirmation: "Your volunteer application has been received.",
  },
  partner: {
    button: "Submit Partnership Inquiry",
    confirmation: "Your partnership inquiry has been received.",
  },
  support: {
    button: "Support Imbuto Hubs",
    confirmation: "Your support interest has been received.",
  },
};

function ConnectedGetInvolvedForm({
  formType,
}: {
  formType: ConnectedFormType;
}) {
  const formRef = useRef<HTMLFormElement>(null);
  const [submitting, setSubmitting] = useState(false);
  const [submitted, setSubmitted] = useState(false);
  const [savedReference, setSavedReference] = useState("");
  const [submissionError, setSubmissionError] = useState("");
  const [turnstileToken, setTurnstileToken] = useState("");
  const [turnstileResetSignal, setTurnstileResetSignal] = useState(0);
  const labels = connectedFormLabels[formType];

  if (submitted) {
    return (
      <section className="mt-7 rounded-[28px] bg-[#dff5f2] p-8 text-center ring-1 ring-[#52b3a9]/25">
        <CheckCircle2
          className="mx-auto h-12 w-12 text-[#0f5b58]"
          aria-hidden="true"
        />
        <h3 className="mt-4 text-2xl tracking-[-0.03em] text-[#102c35]">
          Submission received
        </h3>
        <p className="mt-3 text-sm leading-7 text-slate-700">
          {labels.confirmation} The Imbuto Hubs team will follow up using the
          contact details provided.
        </p>
        <div className="mx-auto mt-5 max-w-sm rounded-2xl bg-white px-4 py-4 ring-1 ring-[#52b3a9]/25">
          <div className="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
            Reference
          </div>
          <div className="mt-2 break-all font-sans text-lg font-black tracking-[0.06em] text-[#0f5b58]">
            {savedReference}
          </div>
        </div>
        <button
          type="button"
          onClick={() => {
            setSubmitted(false);
            setSavedReference("");
            setSubmissionError("");
            setTurnstileToken("");
            setTurnstileResetSignal(0);
          }}
          className="mt-6 rounded-full border border-[#0f5b58]/20 bg-white px-5 py-3 text-sm text-[#0f5b58]"
        >
          Submit another response
        </button>
      </section>
    );
  }

  return (
    <form
      ref={formRef}
      className="mt-7"
      noValidate
      onSubmit={async (event) => {
        event.preventDefault();
        const form = event.currentTarget;
        const requiredGroups = form.querySelectorAll<HTMLFieldSetElement>(
          '[data-required-group="true"]',
        );

        for (const group of requiredGroups) {
          if (!group.querySelector('input[type="checkbox"]:checked')) {
            setSubmissionError(
              `Please select an option for ${group.dataset.groupLabel?.toLowerCase() || "this field"}.`,
            );
            group.querySelector<HTMLInputElement>("input")?.focus();
            return;
          }
        }

        if (!form.checkValidity()) {
          setSubmissionError("Please complete all required fields before submitting.");
          form.reportValidity();
          return;
        }

        const formData = new FormData(form);
        const value = (name: string) => String(formData.get(name) ?? "");
        const values = (name: string) =>
          formData.getAll(name).map((entry) => String(entry));

        if (formType === "volunteer") {
          const motivationWords = value("motivation")
            .split(/\s+/)
            .filter(Boolean).length;

          if (motivationWords < 100 || motivationWords > 200) {
            setSubmissionError(
              "Please provide a motivation between 100 and 200 words.",
            );
            form.querySelector<HTMLTextAreaElement>('[name="motivation"]')?.focus();
            return;
          }
        }

        if (turnstileSiteKey && !turnstileToken) {
          setSubmissionError(
            "Please complete the security verification before submitting.",
          );
          return;
        }

        const common = {
          website: value("website"),
          turnstileToken,
          formType,
          email: value("email"),
          contactConsent: value("contact-consent") === "yes",
        };
        const payload =
          formType === "volunteer"
            ? {
                ...common,
                name: value("name"),
                phone: value("phone"),
                areaOfExpertise: value("area-of-expertise"),
                preferredHub: value("preferred-hub-s"),
                availability: value("availability"),
                motivation: value("motivation"),
              }
            : formType === "partner"
              ? {
                  ...common,
                  organisation: value("organisation"),
                  contactName: value("contact-name"),
                  partnershipInterest: value("partnership-interest"),
                  message: value("message"),
                }
              : {
                  ...common,
                  name: value("name"),
                  phone: value("phone"),
                  contributionTypes: values("contribution-type"),
                  programmes: values("programme-or-area-to-support"),
                  preferredHub: value("preferred-hub"),
                  message: value("message"),
                };

        setSubmitting(true);
        setSubmissionError("");

        try {
          const response = await fetch("/api/get-involved", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(payload),
          });
          const result = (await response.json()) as {
            error?: string;
            reference?: string;
          };

          if (!response.ok || !result.reference) {
            throw new Error(result.error || "We could not save your submission.");
          }

          setSavedReference(result.reference);
          setSubmitted(true);
        } catch (error) {
          setTurnstileToken("");
          setTurnstileResetSignal((signal) => signal + 1);
          setSubmissionError(
            error instanceof Error
              ? error.message
              : "We could not save your submission. Please try again.",
          );
        } finally {
          setSubmitting(false);
        }
      }}
    >
      <label className="absolute -left-[10000px] top-auto h-px w-px overflow-hidden">
        Website
        <input name="website" tabIndex={-1} autoComplete="off" />
      </label>
      {formType === "volunteer" ? <VolunteerForm /> : null}
      {formType === "partner" ? <PartnerForm /> : null}
      {formType === "support" ? <SupportForm /> : null}
      {turnstileSiteKey ? (
        <div className="mt-5 rounded-[24px] border border-slate-200 bg-white p-4">
          <div className="mb-3 text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
            Security verification <span aria-hidden="true">*</span>
          </div>
          <TurnstileWidget
            siteKey={turnstileSiteKey}
            resetSignal={turnstileResetSignal}
            onToken={setTurnstileToken}
          />
        </div>
      ) : null}
      <div className="mt-5">
        <SubmitButton
          disabled={submitting || Boolean(turnstileSiteKey && !turnstileToken)}
        >
          {submitting ? "Submitting…" : labels.button}
        </SubmitButton>
      </div>
      {submissionError ? (
        <div
          className="mt-5 rounded-[24px] bg-red-50 p-4 text-sm leading-6 text-red-700 ring-1 ring-red-200"
          role="alert"
        >
          {submissionError}
        </div>
      ) : null}
    </form>
  );
}

export function RegistrationForm() {
  const formRef = useRef<HTMLFormElement>(null);
  const [submitted, setSubmitted] = useState(false);
  const [savedReference, setSavedReference] = useState("");
  const [submitting, setSubmitting] = useState(false);
  const [submissionError, setSubmissionError] = useState("");
  const [selectedHub, setSelectedHub] = useState(registrationHubOptions[0]);
  const [participantName, setParticipantName] = useState("");
  const [participantAge, setParticipantAge] = useState("");
  const [participantSignature, setParticipantSignature] = useState("");
  const [guardianName, setGuardianName] = useState("");
  const [guardianSignature, setGuardianSignature] = useState("");
  const [mediaConsent, setMediaConsent] = useState("");
  const [educationStatus, setEducationStatus] = useState("");
  const [senior6Completion, setSenior6Completion] = useState("");
  const [turnstileToken, setTurnstileToken] = useState("");
  const [turnstileResetSignal, setTurnstileResetSignal] = useState(0);
  const selectedHubTrainingOptions =
    registrationTrainingByHub[selectedHub] ?? [];
  const numericAge = Number(participantAge);
  const isUnder16 =
    participantAge !== "" && Number.isInteger(numericAge) && numericAge < 16;
  const steps = [
    {
      title: "Personal details",
      description: "Start with the participant's basic information.",
      content: (
        <>
          <TextField
            label="Full name"
            value={participantName}
            autoComplete="name"
            onChange={(event) => {
              const nextName = event.target.value;
              setParticipantSignature((signature) =>
                !signature || signature === participantName
                  ? nextName
                  : signature,
              );
              setParticipantName(nextName);
            }}
          />
          <TextField
            label="Age"
            type="number"
            value={participantAge}
            onChange={(event) => setParticipantAge(event.target.value)}
          />
          <SelectField
            label="Gender"
            options={["Female", "Male"]}
            placeholder="Select gender"
          />
          <TextField label="Phone number" />
          <TextField label="National ID number" optional />
        </>
      ),
    },
    {
      title: "Education",
      description: "Share the current education status.",
      content: (
        <>
          <CheckboxGroup
            label="Tick one"
            name="education-status"
            options={["In school", "Not in School"]}
            singleChoice
            value={educationStatus}
            required
            onChange={(event) => {
              setEducationStatus(event.target.value);
              setSenior6Completion("");
            }}
          />
          {educationStatus === "In school" ? (
            <>
              <TextField label="Name of school" />
              <TextField label="Current class/level" />
            </>
          ) : null}
          {educationStatus === "Not in School" ? (
            <div className="md:col-span-2">
              <CheckboxGroup
                label="Did you complete Senior 6?"
                name="senior-6-completion"
                options={[
                  "Yes, I completed Senior 6",
                  "No, I did not complete Senior 6",
                ]}
                singleChoice
                value={senior6Completion}
                required
                onChange={(event) =>
                  setSenior6Completion(event.target.value)
                }
              />
            </div>
          ) : null}
          {senior6Completion === "No, I did not complete Senior 6" ? (
            <div className="md:col-span-2">
              <SelectField
                label="What was the last year of school completed?"
                name="last-school-year-completed"
                placeholder="Select the last year completed"
                options={[
                  "P1",
                  "P2",
                  "P3",
                  "P4",
                  "P5",
                  "P6",
                  "S1",
                  "S2",
                  "S3",
                  "S4",
                  "S5",
                ]}
              />
            </div>
          ) : null}
        </>
      ),
    },
    {
      title: "Hub selection",
      description: "Choose the hub where the participant wants to register.",
      content: (
        <>
          <SelectField
            label="Hub of interest"
            name="hub-of-interest"
            options={registrationHubOptions}
            value={selectedHub}
            onChange={(event) => setSelectedHub(event.target.value)}
          />
          <div className="rounded-[24px] bg-white p-4 text-sm leading-7 text-slate-700 ring-1 ring-slate-200">
            Training options in the next step will be filtered to programmes
            currently available at this hub.
          </div>
        </>
      ),
    },
    {
      title: "Training interest",
      description: `Choose from opportunities currently available at ${selectedHub}.`,
      content: (
        <>
          <CheckboxGroup
            label="Training or activity interest"
            name="training-interest"
            options={selectedHubTrainingOptions}
            required
          />
          <CheckboxGroup
            label="Preferred training schedule"
            name="preferred-training-schedule"
            options={["Morning", "Afternoon"]}
            singleChoice
            required
          />
        </>
      ),
    },
    {
      title: "Contacts",
      description: "Add essential guardian and emergency contact details.",
      content: (
        <>
          <TextField
            label="Parent/guardian name"
            optional={!isUnder16}
            value={guardianName}
            autoComplete="name"
            onChange={(event) => {
              const nextName = event.target.value;
              setGuardianSignature((signature) =>
                !signature || signature === guardianName
                  ? nextName
                  : signature,
              );
              setGuardianName(nextName);
            }}
          />
          <TextField
            label="Parent/guardian relationship"
            optional={!isUnder16}
          />
          <TextField
            label="Parent/guardian phone number"
            optional={!isUnder16}
            autoComplete="tel"
          />
          <TextField label="Emergency contact name" />
          <TextField label="Emergency contact phone number" autoComplete="tel" />
          {isUnder16 ? (
            <div className="md:col-span-2 rounded-[24px] bg-[#fff7e8] p-4 text-sm leading-6 text-slate-700 ring-1 ring-[#ed9b37]/30">
              Because the participant is under 16, their parent or guardian must
              complete the guardian consent in the final step.
            </div>
          ) : null}
        </>
      ),
    },
    {
      title: "Consent & declaration",
      description: "Confirm accuracy and photography or videography consent.",
      content: (
        <>
          <div className="md:col-span-2">
            <Consent name="accuracy-confirmed" required>
              I, {participantName || "the participant"}, confirm that the
              information provided above is accurate and that typing my name
              below represents my acknowledgement.
            </Consent>
          </div>
          <TextField
            label="Type your full name as your signature"
            name="participant-signature"
            value={participantSignature}
            onChange={(event) => setParticipantSignature(event.target.value)}
            autoComplete="name"
          />
          <div className="rounded-[24px] bg-white p-4 text-sm leading-6 text-slate-600 ring-1 ring-slate-200">
            The declaration date and time will be recorded automatically when
            this registration is submitted.
          </div>
          {isUnder16 ? (
            <>
              <div className="md:col-span-2 rounded-[24px] bg-white p-4 ring-1 ring-slate-200">
                <Consent name="guardian-consent-confirmed" required>
                  I confirm that I am the parent or guardian named above and
                  consent to the collection and processing of this child&apos;s
                  information for their Imbuto Hub registration.
                </Consent>
              </div>
              <TextField
                label="Parent/guardian typed signature"
                name="guardian-signature"
                value={guardianSignature}
                onChange={(event) => setGuardianSignature(event.target.value)}
                autoComplete="name"
              />
            </>
          ) : null}
          <div className="md:col-span-2 rounded-[24px] bg-white p-4 text-sm leading-7 text-slate-700 ring-1 ring-slate-200">
            I consent to being photographed, filmed, and/or recorded during
            Imbuto Hub activities, programmes, and events. I understand that
            these images, videos, and recordings may be used by Imbuto Hubs for
            communication, educational, promotional, reporting, and
            documentation purposes across print, digital, and social media
            platforms. I understand that no compensation will be provided for
            such use.
          </div>
          <CheckboxGroup
            label="Consent choice"
            name="media-consent"
            options={["I consent", "I do not consent"]}
            singleChoice
            value={mediaConsent}
            required
            onChange={(event) => setMediaConsent(event.target.value)}
          />
          {mediaConsent === "I consent" ? (
            <TextField
              label={
                isUnder16
                  ? "Parent/guardian media consent signature"
                  : "Participant media consent signature"
              }
              name="consent-signature"
              value={isUnder16 ? guardianSignature : participantSignature}
              onChange={(event) => {
                if (isUnder16) {
                  setGuardianSignature(event.target.value);
                } else {
                  setParticipantSignature(event.target.value);
                }
              }}
              autoComplete="name"
            />
          ) : null}
          {mediaConsent ? (
            <div className="rounded-[24px] bg-white p-4 text-sm leading-6 text-slate-600 ring-1 ring-slate-200">
              {mediaConsent === "I consent"
                ? "The media consent date and time will be recorded automatically on submission."
                : "No media signature is needed. Declining media consent does not prevent registration."}
            </div>
          ) : null}
        </>
      ),
    },
  ];
  const [currentStep, setCurrentStep] = useState(0);
  const activeStep = steps[currentStep];
  const isFirstStep = currentStep === 0;
  const isLastStep = currentStep === steps.length - 1;

  const validateStep = (stepIndex: number, reportValidity = true) => {
    const panel = formRef.current?.querySelector<HTMLElement>(
      `[data-registration-step="${stepIndex}"]`,
    );

    if (!panel) return false;

    const requiredGroups = panel.querySelectorAll<HTMLFieldSetElement>(
      '[data-required-group="true"]',
    );

    for (const group of requiredGroups) {
      const checkedChoice = group.querySelector<HTMLInputElement>(
        'input[type="radio"]:checked, input[type="checkbox"]:checked',
      );

      if (!checkedChoice) {
        setSubmissionError(
          `Please select an option for ${group.dataset.groupLabel?.toLowerCase() || "this field"}.`,
        );

        if (reportValidity) {
          group.querySelector<HTMLInputElement>("input")?.focus();
        }

        return false;
      }
    }

    const requiredFields = panel.querySelectorAll<
      HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement
    >("input[required], select[required], textarea[required]");

    for (const field of requiredFields) {
      if (!field.checkValidity()) {
        setSubmissionError("Please complete all required fields before continuing.");

        if (reportValidity) {
          field.reportValidity();
          field.focus();
        }

        return false;
      }
    }

    setSubmissionError("");
    return true;
  };

  if (submitted) {
    return (
      <section
        className="mt-7 overflow-hidden rounded-[30px] bg-[#f7f7f2] text-center ring-1 ring-slate-200"
        aria-labelledby="registration-confirmation-title"
        role="status"
      >
        <div className="bg-[#dff5f2] px-6 py-12 sm:px-10 sm:py-16">
          <span className="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-white text-[#0f5b58] shadow-sm">
            <CheckCircle2 className="h-9 w-9" aria-hidden="true" />
          </span>
          <div className="mt-6 text-xs font-semibold uppercase tracking-[0.22em] text-[#c05d24]">
            Registration received
          </div>
          <h3
            id="registration-confirmation-title"
            className="mt-3 text-3xl tracking-[-0.04em] text-[#102c35] sm:text-4xl"
          >
            Thank you for registering
          </h3>
          <p className="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-700 sm:text-base">
            Your youth registration has been received. The hub team will review
            it and follow up with the participant.
          </p>
          <div className="mx-auto mt-7 max-w-md rounded-[24px] bg-white px-5 py-5 ring-1 ring-[#52b3a9]/30">
            <div className="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
              Reference
            </div>
            <div className="mt-2 break-all font-sans text-xl font-black tracking-[0.08em] text-[#0f5b58] sm:text-2xl">
              {savedReference}
            </div>
          </div>
          <p className="mx-auto mt-4 max-w-xl text-xs leading-6 text-slate-600">
            Please save this reference for any follow-up about the application.
          </p>
          <button
            type="button"
            onClick={() => {
              setSubmitted(false);
              setSavedReference("");
              setSubmissionError("");
              setCurrentStep(0);
              setParticipantName("");
              setParticipantAge("");
              setParticipantSignature("");
              setGuardianName("");
              setGuardianSignature("");
              setMediaConsent("");
              setEducationStatus("");
              setSenior6Completion("");
              setTurnstileToken("");
              setTurnstileResetSignal(0);
              setSelectedHub(registrationHubOptions[0]);
            }}
            className="mt-8 inline-flex items-center justify-center rounded-full border border-[#0f5b58]/20 bg-white px-6 py-3 text-sm text-[#0f5b58] transition hover:bg-white/70"
          >
            Submit another registration
          </button>
        </div>
      </section>
    );
  }

  return (
    <form
      ref={formRef}
      className="mt-7"
      noValidate
      onSubmit={async (event) => {
        event.preventDefault();

        for (let stepIndex = 0; stepIndex < steps.length; stepIndex += 1) {
          if (!validateStep(stepIndex, false)) {
            setCurrentStep(stepIndex);
            requestAnimationFrame(() => validateStep(stepIndex));
            return;
          }
        }

        if (turnstileSiteKey && !turnstileToken) {
          setCurrentStep(steps.length - 1);
          setSubmissionError(
            "Please complete the security verification before submitting.",
          );
          return;
        }

        setSubmitting(true);
        setSubmissionError("");
        setSubmitted(false);

        const formData = new FormData(event.currentTarget);
        const value = (name: string) => String(formData.get(name) ?? "");
        const values = (name: string) =>
          formData.getAll(name).map((entry) => String(entry));
        const payload = {
          website: value("website"),
          turnstileToken,
          fullName: value("full-name"),
          age: value("age"),
          gender: value("gender"),
          phoneNumber: value("phone-number"),
          nationalIdNumber: value("national-id-number"),
          educationStatus: values("education-status")[0] ?? "",
          schoolName: value("name-of-school"),
          currentClassLevel: value("current-class-level"),
          lastSchoolYearCompleted:
            value("senior-6-completion") === "Yes, I completed Senior 6"
              ? "S6"
              : value("last-school-year-completed"),
          hubOfInterest: value("hub-of-interest"),
          trainingInterest: values("training-interest"),
          preferredTrainingSchedule:
            values("preferred-training-schedule")[0] ?? "",
          parentGuardianName: value("parent-guardian-name"),
          parentGuardianRelationship: value("parent-guardian-relationship"),
          parentGuardianPhone: value("parent-guardian-phone-number"),
          emergencyContactName: value("emergency-contact-name"),
          emergencyContactPhone: value("emergency-contact-phone-number"),
          accuracyConfirmed: value("accuracy-confirmed") === "yes",
          participantSignature: value("participant-signature"),
          mediaConsent: values("media-consent")[0] ?? "",
          consentSignature: value("consent-signature"),
          guardianConsentConfirmed:
            value("guardian-consent-confirmed") === "yes",
          guardianSignature: value("guardian-signature"),
        };

        try {
          const response = await fetch("/api/applications", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(payload),
          });
          const result = (await response.json()) as {
            error?: string;
            reference?: string;
          };

          if (!response.ok || !result.reference) {
            throw new Error(
              result.error || "We could not save your application.",
            );
          }

          setSavedReference(result.reference);
          setSubmitted(true);
        } catch (error) {
          setTurnstileToken("");
          setTurnstileResetSignal((signal) => signal + 1);
          setSubmissionError(
            error instanceof Error
              ? error.message
              : "We could not save your application. Please try again.",
          );
        } finally {
          setSubmitting(false);
        }
      }}
    >
      <label className="absolute -left-[10000px] top-auto h-px w-px overflow-hidden">
        Website
        <input name="website" tabIndex={-1} autoComplete="off" />
      </label>
      <div className="grid gap-3 sm:grid-cols-2 lg:grid-cols-6">
        {steps.map((step, index) => {
          const isActive = index === currentStep;
          const isComplete = index < currentStep;

          return (
            <button
              key={step.title}
              type="button"
              onClick={() => {
                if (index <= currentStep) {
                  setCurrentStep(index);
                  setSubmissionError("");
                  return;
                }

                if (index === currentStep + 1 && validateStep(currentStep)) {
                  setCurrentStep(index);
                }
              }}
              aria-disabled={index > currentStep + 1}
              className={`rounded-[18px] px-3 py-3 text-left text-xs transition ${
                isActive
                  ? "bg-[#102c35] text-white"
                  : isComplete
                    ? "bg-[#dff5f2] text-[#0f5b58]"
                    : "bg-[#f7f7f2] text-slate-500 ring-1 ring-slate-200"
              }`}
            >
              <span className="block font-sans font-black uppercase tracking-[0.16em]">
                Step {index + 1}
              </span>
              <span className="mt-1 block leading-5">{step.title}</span>
            </button>
          );
        })}
      </div>

      <div className="mt-8 rounded-[30px] bg-[#f7f7f2] p-5 ring-1 ring-slate-200 md:p-7">
        <div className="flex flex-col gap-3 border-b border-slate-200 pb-5 sm:flex-row sm:items-end sm:justify-between">
          <div>
            <div className="text-xs font-semibold uppercase tracking-[0.2em] text-[#c05d24]">
              Step {currentStep + 1} of {steps.length}
            </div>
            <h3 className="mt-2 text-3xl tracking-[-0.04em] text-[#102c35]">
              {activeStep.title}
            </h3>
            <p className="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
              {activeStep.description}
            </p>
          </div>
          <div className="h-2 w-full overflow-hidden rounded-full bg-white sm:w-44">
            <div
              className="h-full rounded-full bg-[#ed9b37] transition-all"
              style={{
                width: `${((currentStep + 1) / steps.length) * 100}%`,
              }}
            />
          </div>
        </div>

        {steps.map((step, index) => (
          <div
            key={step.title}
            data-registration-step={index}
            className={`mt-6 gap-4 md:grid-cols-2 ${
              index === currentStep ? "grid" : "hidden"
            }`}
          >
            {step.content}
          </div>
        ))}
      </div>

      {isLastStep && turnstileSiteKey ? (
        <div className="mt-6 rounded-[24px] border border-slate-200 bg-white p-4">
          <div className="mb-3 text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
            Security verification <span aria-hidden="true">*</span>
          </div>
          <TurnstileWidget
            siteKey={turnstileSiteKey}
            resetSignal={turnstileResetSignal}
            onToken={setTurnstileToken}
          />
        </div>
      ) : null}

      <div
        className={`mt-6 flex flex-wrap items-center gap-3 ${
          isFirstStep ? "justify-end" : "justify-between"
        }`}
      >
        {!isFirstStep ? (
          <button
            type="button"
            onClick={() => setCurrentStep((step) => Math.max(step - 1, 0))}
            className="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm text-[#102c35] transition hover:bg-slate-50"
          >
            Back
          </button>
        ) : null}
        {isLastStep ? (
          <SubmitButton
            disabled={submitting || Boolean(turnstileSiteKey && !turnstileToken)}
          >
            {submitting ? "Submitting…" : "Submit Youth Registration"}
          </SubmitButton>
        ) : (
          <button
            type="button"
            onClick={() => {
              if (validateStep(currentStep)) {
                setCurrentStep((step) =>
                  Math.min(step + 1, steps.length - 1),
                );
              }
            }}
            className="inline-flex items-center gap-2 rounded-full bg-[#ed9b37] px-6 py-3.5 text-sm text-white shadow-lg shadow-[#ed9b37]/25 transition hover:-translate-y-0.5 hover:bg-[#c05d24]"
          >
            Next
            <ArrowRight className="h-4 w-4" />
          </button>
        )}
      </div>
      {submissionError ? (
        <div
          className="mt-5 rounded-[24px] bg-red-50 p-4 text-sm leading-6 text-red-700 ring-1 ring-red-200"
          role="alert"
        >
          {submissionError}
        </div>
      ) : null}
    </form>
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

        {activeForm === "registration" ? (
          <RegistrationForm />
        ) : (
          <ConnectedGetInvolvedForm formType={activeForm} />
        )}
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
                    <h3 className="text-base font-semibold">{option.title}</h3>
                    <p className="mt-2 text-sm leading-6 text-white/72">
                      {option.text}
                    </p>
                  </div>
                ))}
              </div>
              <div className="mt-6 rounded-2xl border border-white/15 bg-white/10 p-5 text-sm leading-7 text-white/76">
                Donation processing platform and payment gateway to be confirmed
                by Imbuto Foundation before this section goes live.
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
