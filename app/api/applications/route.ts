import { NextResponse } from "next/server";
import { appendApplicationToGoogleSheet } from "../../../lib/google-sheets";
import { checkRateLimit } from "../../../lib/rate-limit";
import { verifyTurnstileToken } from "../../../lib/turnstile";

export const runtime = "nodejs";

const MAX_REQUESTS_PER_WINDOW = 5;
const RATE_LIMIT_WINDOW_MS = 10 * 60 * 1000;
const VALID_GENDERS = new Set(["Female", "Male"]);
const VALID_EDUCATION_STATUSES = new Set(["In school", "Not in School"]);
const VALID_SCHOOL_YEARS = new Set([
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
  "S6",
]);
const VALID_HUBS = new Set(["Imbuto Hub Bugesera"]);
const VALID_TRAINING_INTERESTS = new Set([
  "Hairdressing and Beauty",
  "Tailoring and Fashion",
  "IT and Computer Applications",
  "Childcare and Playground Activities",
]);
const VALID_TRAINING_SCHEDULES = new Set(["Morning", "Afternoon"]);
const VALID_MEDIA_CONSENT = new Set(["I consent", "I do not consent"]);
const DECLARATION_VERSION = "youth-registration-declaration-v1";
const MEDIA_CONSENT_VERSION = "photo-video-consent-v1";

type ApplicationPayload = {
  website?: unknown;
  turnstileToken?: unknown;
  fullName?: unknown;
  age?: unknown;
  gender?: unknown;
  phoneNumber?: unknown;
  nationalIdNumber?: unknown;
  educationStatus?: unknown;
  schoolName?: unknown;
  currentClassLevel?: unknown;
  lastSchoolYearCompleted?: unknown;
  hubOfInterest?: unknown;
  trainingInterest?: unknown;
  preferredTrainingSchedule?: unknown;
  parentGuardianName?: unknown;
  parentGuardianRelationship?: unknown;
  parentGuardianPhone?: unknown;
  emergencyContactName?: unknown;
  emergencyContactPhone?: unknown;
  accuracyConfirmed?: unknown;
  participantSignature?: unknown;
  mediaConsent?: unknown;
  consentSignature?: unknown;
  guardianConsentConfirmed?: unknown;
  guardianSignature?: unknown;
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

function normalizedName(value: string) {
  return value.trim().replace(/\s+/g, " ").toLocaleLowerCase("en");
}

function namesMatch(signature: string, expectedName: string) {
  return Boolean(signature) && normalizedName(signature) === normalizedName(expectedName);
}

export async function POST(request: Request) {
  const clientIp = getClientIp(request);
  const rateLimit = await checkRateLimit(clientIp, {
    limit: MAX_REQUESTS_PER_WINDOW,
    windowMs: RATE_LIMIT_WINDOW_MS,
    prefix: "youth-applications",
  });

  if (!rateLimit.allowed) {
    const retryAfter = Math.max(
      Math.ceil((rateLimit.resetAt - Date.now()) / 1000),
      1,
    );

    return NextResponse.json(
      {
        error: "Too many submissions. Please try again in a few minutes.",
        retryAfter,
      },
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

  let payload: ApplicationPayload;

  try {
    payload = (await request.json()) as ApplicationPayload;
  } catch {
    return NextResponse.json({ error: "Invalid submission." }, { status: 400 });
  }

  // Hidden honeypot field. Real applicants never see or fill this value.
  if (getText(payload.website, 200)) {
    return NextResponse.json({ ok: true });
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

  const application = {
    fullName: getText(payload.fullName, 120),
    age: getText(payload.age, 3),
    gender: getText(payload.gender, 30),
    phoneNumber: getText(payload.phoneNumber, 40),
    nationalIdNumber: getText(payload.nationalIdNumber, 40),
    educationStatus: getText(payload.educationStatus, 40),
    schoolName: getText(payload.schoolName, 160),
    currentClassLevel: getText(payload.currentClassLevel, 60),
    lastSchoolYearCompleted: getText(payload.lastSchoolYearCompleted, 30),
    hubOfInterest: getText(payload.hubOfInterest, 120),
    trainingInterest: getTextList(payload.trainingInterest, 10, 120),
    preferredTrainingSchedule: getText(
      payload.preferredTrainingSchedule,
      40,
    ),
    parentGuardianName: getText(payload.parentGuardianName, 120),
    parentGuardianRelationship: getText(
      payload.parentGuardianRelationship,
      80,
    ),
    parentGuardianPhone: getText(payload.parentGuardianPhone, 40),
    emergencyContactName: getText(payload.emergencyContactName, 120),
    emergencyContactPhone: getText(payload.emergencyContactPhone, 40),
    accuracyConfirmed: payload.accuracyConfirmed === true,
    participantSignature: getText(payload.participantSignature, 120),
    mediaConsent: getText(payload.mediaConsent, 40),
    consentSignature: getText(payload.consentSignature, 120),
    guardianConsentConfirmed: payload.guardianConsentConfirmed === true,
    guardianSignature: getText(payload.guardianSignature, 120),
  };

  const age = Number(application.age);
  const isUnder16 = Number.isInteger(age) && age < 16;
  const educationDetailsValid =
    (application.educationStatus === "In school" &&
      application.schoolName &&
      application.currentClassLevel) ||
    (application.educationStatus === "Not in School" &&
      VALID_SCHOOL_YEARS.has(application.lastSchoolYearCompleted));
  const requiredFieldsPresent =
    application.fullName &&
    Number.isInteger(age) &&
    age > 0 &&
    age <= 120 &&
    VALID_GENDERS.has(application.gender) &&
    application.phoneNumber &&
    VALID_EDUCATION_STATUSES.has(application.educationStatus) &&
    educationDetailsValid &&
    VALID_HUBS.has(application.hubOfInterest) &&
    application.trainingInterest.length > 0 &&
    application.trainingInterest.every((interest) =>
      VALID_TRAINING_INTERESTS.has(interest),
    ) &&
    VALID_TRAINING_SCHEDULES.has(application.preferredTrainingSchedule) &&
    (!isUnder16 ||
      (application.parentGuardianName &&
        application.parentGuardianRelationship &&
        application.parentGuardianPhone &&
        application.guardianConsentConfirmed &&
        namesMatch(
          application.guardianSignature,
          application.parentGuardianName,
        ))) &&
    application.emergencyContactName &&
    application.emergencyContactPhone &&
    application.accuracyConfirmed &&
    namesMatch(application.participantSignature, application.fullName) &&
    VALID_MEDIA_CONSENT.has(application.mediaConsent) &&
    (application.mediaConsent === "I do not consent" ||
      namesMatch(
        application.consentSignature,
        isUnder16
          ? application.parentGuardianName
          : application.fullName,
      ));

  if (!requiredFieldsPresent) {
    return NextResponse.json(
      { error: "Please complete all required fields before submitting." },
      { status: 400 },
    );
  }

  const reference = `YTH-${Date.now().toString(36).toUpperCase()}-${crypto
    .randomUUID()
    .slice(0, 6)
    .toUpperCase()}`;
  const submittedAt = new Date().toISOString();

  try {
    await appendApplicationToGoogleSheet({
      reference,
      submittedAt,
      status: "New",
      submissionSource: "imbutohub.com/apply",
      ...application,
      declarationDate: submittedAt,
      consentDate:
        application.mediaConsent === "I consent" ? submittedAt : "",
      declarationVersion: DECLARATION_VERSION,
      mediaConsentVersion: MEDIA_CONSENT_VERSION,
      mediaConsentSignerRole:
        application.mediaConsent === "I consent"
          ? isUnder16
            ? "Parent/guardian"
            : "Participant"
          : "",
    });

    return NextResponse.json({ ok: true, reference });
  } catch (error) {
    console.error("Application submission failed:", error);
    return NextResponse.json(
      { error: "We could not save your application. Please try again." },
      { status: 502 },
    );
  }
}
