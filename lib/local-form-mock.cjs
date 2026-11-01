"use strict";

// Pure, stateless local fixtures: no fetch, storage, logging or service imports.
const has = (value) => typeof value === "string" && value.trim().length > 0;
const oneOf = (value, values) => values.includes(value);
const choices = (value, values) => Array.isArray(value) && value.length > 0 && value.every((item) => values.includes(item));
const sameName = (a, b) => has(a) && has(b) && a.trim().replace(/\s+/g, " ").toLowerCase() === b.trim().replace(/\s+/g, " ").toLowerCase();
const required = "Please complete all required fields before submitting.";
const hubs = ["Imbuto Hub Bugesera", "Kimisagara Maison de Jeunes by Imbuto Hubs", "Imbuto Hub Kicukiro", "Imbuto Hub Muhanga", "Imbuto Hub Rwamagana", "Imbuto Hub Gasabo"];

function validateLocalMock(endpoint, p) {
  if (!p || typeof p !== "object" || Array.isArray(p)) return "Invalid submission.";
  if (p.website) return "Leave the hidden website field empty for local tests.";
  if (endpoint === "/api/applications") {
    const age = Number(p.age);
    const minor = Number.isInteger(age) && age < 16;
    const education = p.educationStatus === "In school"
      ? has(p.schoolName) && has(p.currentClassLevel)
      : p.educationStatus === "Not in School" && oneOf(p.lastSchoolYearCompleted, ["P1", "P2", "P3", "P4", "P5", "P6", "S1", "S2", "S3", "S4", "S5", "S6"]);
    if (!has(p.fullName) || !Number.isInteger(age) || age < 1 || age > 120 || !oneOf(p.gender, ["Female", "Male"]) || !has(p.phoneNumber) || !education || p.hubOfInterest !== hubs[0] || !choices(p.trainingInterest, ["Hairdressing and Beauty", "Tailoring and Fashion", "IT and Computer Applications", "Childcare and Playground Activities"]) || !oneOf(p.preferredTrainingSchedule, ["Morning", "Afternoon"]) || !has(p.emergencyContactName) || !has(p.emergencyContactPhone) || p.accuracyConfirmed !== true || !sameName(p.participantSignature, p.fullName) || !oneOf(p.mediaConsent, ["I consent", "I do not consent"])) return required;
    if (minor && (!has(p.parentGuardianName) || !has(p.parentGuardianRelationship) || !has(p.parentGuardianPhone) || p.guardianConsentConfirmed !== true || !sameName(p.guardianSignature, p.parentGuardianName))) return "Please complete the parent/guardian details and matching guardian signature.";
    if (p.mediaConsent === "I consent" && !sameName(p.consentSignature, minor ? p.parentGuardianName : p.fullName)) return "Please provide the matching media consent signature.";
  } else if (endpoint === "/api/get-involved") {
    if (!oneOf(p.formType, ["volunteer", "partner", "support"])) return "Invalid form type.";
    if (typeof p.email !== "string" || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(p.email) || p.contactConsent !== true) return required;
    if (p.formType === "volunteer") {
      const words = typeof p.motivation === "string" ? p.motivation.trim().split(/\s+/).filter(Boolean).length : 0;
      if (words < 100 || words > 200) return "Please provide a motivation between 100 and 200 words.";
      if (!has(p.name) || !oneOf(p.areaOfExpertise, ["Education", "Health", "Sports", "Arts", "Digital", "Business", "Agriculture", "Other"]) || !oneOf(p.preferredHub, hubs) || !oneOf(p.availability, ["Weekdays", "Weekends", "School holidays", "Flexible"])) return required;
    } else if (p.formType === "partner") {
      if (!has(p.organisation) || !has(p.contactName) || !oneOf(p.partnershipInterest, ["Infrastructure", "Programme", "Corporate", "Technical", "Employment", "Other"]) || !has(p.message)) return required;
    } else if (!has(p.name) || !choices(p.contributionTypes, ["Equipment", "Programme funding", "Volunteer time", "Training", "Services", "Other"]) || !choices(p.programmes, ["Early Childhood Development & Family", "Sports & Recreation", "Digital Literacy & Innovation", "Health & Wellbeing"]) || !oneOf(p.preferredHub, hubs) || !has(p.message)) return required;
  } else return "Unknown local form.";

  // Refuse likely real contact details even though nothing leaves browser memory.
  for (const key of ["fullName", "name", "contactName", "organisation", "parentGuardianName", "emergencyContactName"]) {
    if (has(p[key]) && !/^LOCAL TEST\b/.test(p[key])) return "Local mock only: start test names and organisations with LOCAL TEST.";
  }
  if (p.email && !/^[^@]+@example\.invalid$/.test(p.email)) return "Local mock only: use an email at example.invalid.";
  for (const key of ["phone", "phoneNumber", "parentGuardianPhone", "emergencyContactPhone"]) {
    if (has(p[key]) && !/^0+$/.test(p[key])) return "Local mock only: use zeros for test phone numbers.";
  }
  if (has(p.nationalIdNumber)) return "Local mock only: leave the optional national ID empty.";
  return null;
}

async function submitLocalMock(endpoint, payload, scenario = "success") {
  const error = validateLocalMock(endpoint, payload);
  if (error) throw new Error(error);
  await new Promise((resolve) => setTimeout(resolve, 800));
  if (scenario === "error") throw new Error("Local mock: simulated service error. Nothing was saved. Please try again.");
  if (scenario === "network-error") throw new Error("Local mock: simulated network failure. Nothing was sent. Please try again.");
  if (scenario !== "success") throw new Error("Unknown local mock response.");
  const prefix = endpoint === "/api/applications" ? "YTH" : { volunteer: "VOL", partner: "PAR", support: "SUP" }[payload.formType];
  return { reference: `MOCK-${prefix}-LOCAL-ONLY`, mock: true };
}

module.exports = { validateLocalMock, submitLocalMock };
