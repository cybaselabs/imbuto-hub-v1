"use strict";
const assert = require("node:assert/strict");
const test = require("node:test");
const { validateLocalMock, submitLocalMock } = require("../lib/local-form-mock.cjs");

const youth = {
  fullName: "LOCAL TEST Participant", age: "20", gender: "Female", phoneNumber: "0000000000",
  nationalIdNumber: "", educationStatus: "Not in School", lastSchoolYearCompleted: "S6",
  hubOfInterest: "Imbuto Hub Bugesera", trainingInterest: ["IT and Computer Applications"],
  preferredTrainingSchedule: "Morning", emergencyContactName: "LOCAL TEST Contact", emergencyContactPhone: "0000000000",
  accuracyConfirmed: true, participantSignature: "LOCAL TEST Participant", mediaConsent: "I do not consent",
};
const volunteer = {
  formType: "volunteer", name: "LOCAL TEST Volunteer", email: "volunteer@example.invalid", phone: "0000000000",
  contactConsent: true, areaOfExpertise: "Digital", preferredHub: "Imbuto Hub Bugesera", availability: "Flexible",
  motivation: Array(110).fill("synthetic").join(" "),
};
const partner = { formType: "partner", organisation: "LOCAL TEST Organisation", contactName: "LOCAL TEST Contact", email: "partner@example.invalid", contactConsent: true, partnershipInterest: "Technical", message: "Synthetic local test only." };
const support = { formType: "support", name: "LOCAL TEST Support", email: "support@example.invalid", contactConsent: true, contributionTypes: ["Equipment"], programmes: ["Digital Literacy & Innovation"], preferredHub: "Imbuto Hub Bugesera", message: "Synthetic local test only." };

test("valid synthetic youth and all Get Involved variants", async () => {
  for (const [endpoint, payload, prefix] of [["/api/applications", youth, "YTH"], ...[[volunteer, "VOL"], [partner, "PAR"], [support, "SUP"]].map(([p, prefix]) => ["/api/get-involved", p, prefix])]) {
    const original = JSON.stringify(payload);
    assert.equal(validateLocalMock(endpoint, payload), null);
    assert.deepEqual(await submitLocalMock(endpoint, payload), { reference: `MOCK-${prefix}-LOCAL-ONLY`, mock: true });
    assert.equal(JSON.stringify(payload), original, "no mutation/retention field added");
  }
});

test("required fields, invalid ages, options and declarations reject", () => {
  for (const change of [{ fullName: "" }, { age: "0" }, { age: "121" }, { age: "2.5" }, { gender: "invalid" }, { trainingInterest: [] }, { trainingInterest: ["invalid"] }, { accuracyConfirmed: false }, { participantSignature: "does not match" }, { mediaConsent: "" }]) {
    assert.ok(validateLocalMock("/api/applications", { ...youth, ...change }));
  }
  assert.ok(validateLocalMock("/api/applications", { ...youth, educationStatus: "In school", schoolName: "" }));
  assert.ok(validateLocalMock("/api/get-involved", { ...partner, email: "invalid" }));
  assert.ok(validateLocalMock("/api/get-involved", { ...partner, contactConsent: false }));
  assert.ok(validateLocalMock("/api/get-involved", { ...support, contributionTypes: [] }));
  assert.ok(validateLocalMock("/api/get-involved", { ...support, programmes: ["invalid"] }));
});

test("minor and media consent require matching guardian signatures", () => {
  const minor = { ...youth, age: "15", parentGuardianName: "LOCAL TEST Guardian", parentGuardianRelationship: "Guardian", parentGuardianPhone: "0000000000", guardianConsentConfirmed: true, guardianSignature: "LOCAL TEST Guardian", mediaConsent: "I consent", consentSignature: "LOCAL TEST Guardian" };
  assert.equal(validateLocalMock("/api/applications", minor), null);
  for (const change of [{ guardianConsentConfirmed: false }, { guardianSignature: "mismatch" }, { consentSignature: "mismatch" }, { parentGuardianRelationship: "" }]) assert.ok(validateLocalMock("/api/applications", { ...minor, ...change }));
  assert.ok(validateLocalMock("/api/applications", { ...youth, mediaConsent: "I consent", consentSignature: "" }));
});

test("volunteer motivation boundaries match the reviewed form contract", () => {
  for (const n of [99, 201]) assert.match(validateLocalMock("/api/get-involved", { ...volunteer, motivation: Array(n).fill("synthetic").join(" ") }), /100 and 200/);
  for (const n of [100, 200]) assert.equal(validateLocalMock("/api/get-involved", { ...volunteer, motivation: Array(n).fill("synthetic").join(" ") }), null);
});

test("likely real identities, contact details and national IDs are refused", () => {
  for (const change of [{ fullName: "A non-test name", participantSignature: "A non-test name" }, { phoneNumber: "1234567890" }, { nationalIdNumber: "synthetic-but-forbidden" }]) assert.match(validateLocalMock("/api/applications", { ...youth, ...change }), /Local mock only/);
  assert.match(validateLocalMock("/api/get-involved", { ...partner, email: "not-test@example.com" }), /example.invalid/);
});

test("service/network errors are simulated locally and retry succeeds", async () => {
  for (const endpoint of ["/api/applications", "/api/get-involved"]) {
    const payload = endpoint.endsWith("applications") ? youth : partner;
    await assert.rejects(submitLocalMock(endpoint, payload, "error"), /simulated service error/);
    await assert.rejects(submitLocalMock(endpoint, payload, "network-error"), /simulated network failure/);
    assert.equal((await submitLocalMock(endpoint, payload, "success")).mock, true);
  }
});

test("unknown endpoints, malformed payloads and honeypot data reject", () => {
  assert.ok(validateLocalMock("/api/applications", null));
  assert.ok(validateLocalMock("/api/get-involved", []));
  assert.ok(validateLocalMock("/api/unknown", partner));
  assert.ok(validateLocalMock("/api/get-involved", { ...partner, formType: "unknown" }));
  assert.ok(validateLocalMock("/api/get-involved", { ...partner, website: "synthetic" }));
});
