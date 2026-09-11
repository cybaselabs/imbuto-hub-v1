import { NextResponse } from "next/server";
import { appendRowToGoogleSheet } from "../../../lib/google-sheets";
import { checkRateLimit } from "../../../lib/rate-limit";
import { verifyTurnstileToken } from "../../../lib/turnstile";

export const runtime = "nodejs";

const MAX_REQUESTS_PER_WINDOW = 5;
const RATE_LIMIT_WINDOW_MS = 10 * 60 * 1000;
const VALID_FORM_TYPES = new Set(["volunteer", "partner", "support"]);
const VALID_EXPERTISE = new Set([
  "Education",
  "Health",
  "Sports",
  "Arts",
  "Digital",
  "Business",
  "Agriculture",
  "Other",
]);
const VALID_AVAILABILITY = new Set([
  "Weekdays",
  "Weekends",
  "School holidays",
  "Flexible",
]);
const VALID_PARTNERSHIP_INTERESTS = new Set([
  "Infrastructure",
  "Programme",
  "Corporate",
  "Technical",
  "Employment",
  "Other",
]);
const VALID_CONTRIBUTION_TYPES = new Set([
  "Equipment",
  "Programme funding",
  "Volunteer time",
  "Training",
  "Services",
  "Other",
]);
const VALID_PROGRAMMES = new Set([
  "Early Childhood Development & Family",
  "Sports & Recreation",
  "Digital Literacy & Innovation",
  "Health & Wellbeing",
]);
const VALID_HUBS = new Set([
  "Imbuto Hub Bugesera",
  "Kimisagara Maison de Jeunes by Imbuto Hubs",
  "Imbuto Hub Kicukiro",
  "Imbuto Hub Muhanga",
  "Imbuto Hub Rwamagana",
  "Imbuto Hub Gasabo",
]);
const FORM_CONFIGURATION = {
  volunteer: { prefix: "VOL", sheetName: "Volunteers" },
  partner: { prefix: "PAR", sheetName: "Partnerships" },
  support: { prefix: "SUP", sheetName: "Support Requests" },
} as const;

type FormType = keyof typeof FORM_CONFIGURATION;

type GetInvolvedPayload = {
  website?: unknown;
  turnstileToken?: unknown;
  formType?: unknown;
  name?: unknown;
  email?: unknown;
  phone?: unknown;
  areaOfExpertise?: unknown;
  preferredHub?: unknown;
  availability?: unknown;
  motivation?: unknown;
  organisation?: unknown;
  contactName?: unknown;
  partnershipInterest?: unknown;
  message?: unknown;
  contributionTypes?: unknown;
  programmes?: unknown;
  contactConsent?: unknown;
};

function getText(value: unknown, maxLength: number) {
  return typeof value === "string" ? value.trim().slice(0, maxLength) : "";
}

function getTextList(value: unknown, maxItems: number, maxLength: number) {
  if (!Array.isArray(value)) return [];

  return value
    .filter((item): item is string => typeof item === "string")
    .map((item) => item.trim().slice(0, maxLength))
    .filter(Boolean)
    .slice(0, maxItems);
}

function getClientIp(request: Request) {
  return (
    request.headers.get("cf-connecting-ip") ??
    request.headers.get("x-real-ip") ??
    request.headers.get("x-forwarded-for")?.split(",")[0]?.trim() ??
    "unknown"
  );
}

function isValidEmail(email: string) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function wordCount(value: string) {
  return value.split(/\s+/).filter(Boolean).length;
}

function createReference(prefix: string) {
  return `${prefix}-${Date.now().toString(36).toUpperCase()}-${crypto
    .randomUUID()
    .slice(0, 6)
    .toUpperCase()}`;
}

export async function POST(request: Request) {
  const clientIp = getClientIp(request);
  const rateLimit = await checkRateLimit(clientIp, {
    limit: MAX_REQUESTS_PER_WINDOW,
    windowMs: RATE_LIMIT_WINDOW_MS,
    prefix: "get-involved-forms",
  });

  if (!rateLimit.allowed) {
    const retryAfter = Math.max(
      Math.ceil((rateLimit.resetAt - Date.now()) / 1000),
      1,
    );

    return NextResponse.json(
      { error: "Too many submissions. Please try again in a few minutes." },
      {
        status: 429,
        headers: {
          "Retry-After": String(retryAfter),
          "X-RateLimit-Limit": String(rateLimit.limit),
          "X-RateLimit-Remaining": String(rateLimit.remaining),
          "X-RateLimit-Reset": String(Math.ceil(rateLimit.resetAt / 1000)),
        },
      },
    );
  }

  let payload: GetInvolvedPayload;

  try {
    payload = (await request.json()) as GetInvolvedPayload;
  } catch {
    return NextResponse.json({ error: "Invalid submission." }, { status: 400 });
  }

  const formType = getText(payload.formType, 20);

  if (!VALID_FORM_TYPES.has(formType)) {
    return NextResponse.json({ error: "Invalid form type." }, { status: 400 });
  }

  if (getText(payload.website, 200)) {
    return NextResponse.json({ ok: true, reference: createReference("WEB") });
  }

  try {
    const turnstileValid = await verifyTurnstileToken(
      getText(payload.turnstileToken, 2_048),
      clientIp,
    );

    if (!turnstileValid) {
      return NextResponse.json(
        { error: "Please complete the security verification and try again." },
        { status: 400 },
      );
    }
  } catch (error) {
    console.error("Turnstile verification unavailable:", error);
    return NextResponse.json(
      { error: "Security verification is temporarily unavailable. Please try again." },
      { status: 503 },
    );
  }

  const type = formType as FormType;
  const configuration = FORM_CONFIGURATION[type];
  const submittedAt = new Date().toISOString();
  const reference = createReference(configuration.prefix);
  const contactConsent = payload.contactConsent === true;
  const email = getText(payload.email, 160);
  const phone = getText(payload.phone, 40);

  if (!isValidEmail(email) || !contactConsent) {
    return NextResponse.json(
      { error: "Please complete all required fields before submitting." },
      { status: 400 },
    );
  }

  let headers: string[];
  let values: Array<string | boolean>;

  if (type === "volunteer") {
    const name = getText(payload.name, 120);
    const expertise = getText(payload.areaOfExpertise, 80);
    const preferredHub = getText(payload.preferredHub, 160);
    const availability = getText(payload.availability, 60);
    const motivation = getText(payload.motivation, 3_000);
    const motivationWords = wordCount(motivation);

    if (
      !name ||
      !VALID_EXPERTISE.has(expertise) ||
      !VALID_HUBS.has(preferredHub) ||
      !VALID_AVAILABILITY.has(availability) ||
      motivationWords < 100 ||
      motivationWords > 200
    ) {
      return NextResponse.json(
        {
          error:
            motivationWords < 100 || motivationWords > 200
              ? "Please provide a motivation between 100 and 200 words."
              : "Please complete all required fields before submitting.",
        },
        { status: 400 },
      );
    }

    headers = [
      "Reference",
      "Submitted at",
      "Status",
      "Name",
      "Email",
      "Phone",
      "Area of expertise",
      "Preferred hub",
      "Availability",
      "Motivation",
      "Contact consent",
      "Submission source",
    ];
    values = [
      reference,
      submittedAt,
      "New",
      name,
      email,
      phone,
      expertise,
      preferredHub,
      availability,
      motivation,
      contactConsent,
      "imbutohub.com/get-involved",
    ];
  } else if (type === "partner") {
    const organisation = getText(payload.organisation, 160);
    const contactName = getText(payload.contactName, 120);
    const interest = getText(payload.partnershipInterest, 80);
    const message = getText(payload.message, 4_000);

    if (
      !organisation ||
      !contactName ||
      !VALID_PARTNERSHIP_INTERESTS.has(interest) ||
      !message
    ) {
      return NextResponse.json(
        { error: "Please complete all required fields before submitting." },
        { status: 400 },
      );
    }

    headers = [
      "Reference",
      "Submitted at",
      "Status",
      "Organisation",
      "Contact name",
      "Email",
      "Partnership interest",
      "Message",
      "Contact consent",
      "Submission source",
    ];
    values = [
      reference,
      submittedAt,
      "New",
      organisation,
      contactName,
      email,
      interest,
      message,
      contactConsent,
      "imbutohub.com/get-involved",
    ];
  } else {
    const name = getText(payload.name, 120);
    const contributionTypes = getTextList(payload.contributionTypes, 6, 80);
    const programmes = getTextList(payload.programmes, 10, 120);
    const preferredHub = getText(payload.preferredHub, 160);
    const message = getText(payload.message, 4_000);

    if (
      !name ||
      contributionTypes.length === 0 ||
      !contributionTypes.every((item) => VALID_CONTRIBUTION_TYPES.has(item)) ||
      programmes.length === 0 ||
      !programmes.every((item) => VALID_PROGRAMMES.has(item)) ||
      !VALID_HUBS.has(preferredHub) ||
      !message
    ) {
      return NextResponse.json(
        { error: "Please complete all required fields before submitting." },
        { status: 400 },
      );
    }

    headers = [
      "Reference",
      "Submitted at",
      "Status",
      "Name",
      "Email",
      "Phone",
      "Contribution types",
      "Programmes or areas to support",
      "Preferred hub",
      "Message",
      "Contact consent",
      "Submission source",
    ];
    values = [
      reference,
      submittedAt,
      "New",
      name,
      email,
      phone,
      contributionTypes.join(", "),
      programmes.join(", "),
      preferredHub,
      message,
      contactConsent,
      "imbutohub.com/get-involved",
    ];
  }

  try {
    await appendRowToGoogleSheet({
      sheetName: configuration.sheetName,
      headers,
      values,
    });

    return NextResponse.json({ ok: true, reference });
  } catch (error) {
    console.error(`${formType} form submission failed:`, error);
    return NextResponse.json(
      { error: "We could not save your submission. Please try again." },
      { status: 502 },
    );
  }
}
