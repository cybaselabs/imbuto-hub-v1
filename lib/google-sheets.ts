import { createSign } from "node:crypto";

const GOOGLE_TOKEN_URL = "https://oauth2.googleapis.com/token";
const GOOGLE_SHEETS_SCOPE = "https://www.googleapis.com/auth/spreadsheets";
const DEFAULT_SPREADSHEET_ID =
  "1_bW_2UZcd-f5AgR5sS6fZdVk7GDbxOAgmiuLLYM90qA";
const DEFAULT_SHEET_NAME = "Applications";
const APPLICATION_HEADERS = [
  "Reference",
  "Submitted at",
  "Status",
  "Full name",
  "Age",
  "Gender",
  "Phone number",
  "National ID number",
  "Education status",
  "School name",
  "Current class/level",
  "Last school year completed",
  "Hub of interest",
  "Training interest",
  "Preferred training schedule",
  "Parent/guardian name",
  "Parent/guardian phone",
  "Emergency contact name",
  "Emergency contact phone",
  "Accuracy confirmed",
  "Participant signature",
  "Declaration timestamp",
  "Media consent",
  "Media consent signature",
  "Media consent timestamp",
  "Submission source",
  "Parent/guardian relationship",
  "Guardian consent confirmed",
  "Guardian signature",
  "Declaration version",
  "Media consent version",
  "Media consent signer role",
];

type GoogleTokenResponse = {
  access_token?: string;
  expires_in?: number;
  error?: string;
  error_description?: string;
};

type CachedToken = {
  accessToken: string;
  expiresAt: number;
};

export type ApplicationRow = {
  reference: string;
  submittedAt: string;
  status: string;
  fullName: string;
  age: string;
  gender: string;
  phoneNumber: string;
  nationalIdNumber: string;
  educationStatus: string;
  schoolName: string;
  currentClassLevel: string;
  lastSchoolYearCompleted: string;
  hubOfInterest: string;
  trainingInterest: string[];
  preferredTrainingSchedule: string;
  parentGuardianName: string;
  parentGuardianRelationship: string;
  parentGuardianPhone: string;
  emergencyContactName: string;
  emergencyContactPhone: string;
  accuracyConfirmed: boolean;
  participantSignature: string;
  declarationDate: string;
  mediaConsent: string;
  consentSignature: string;
  consentDate: string;
  guardianConsentConfirmed: boolean;
  guardianSignature: string;
  declarationVersion: string;
  mediaConsentVersion: string;
  mediaConsentSignerRole: string;
  submissionSource: string;
};

let cachedToken: CachedToken | null = null;
const ensuredHeaderKeys = new Set<string>();

function encodeBase64Url(value: string) {
  return Buffer.from(value).toString("base64url");
}

function getGoogleCredentials() {
  const credentialsBase64 = process.env.GOOGLE_SERVICE_ACCOUNT_JSON_BASE64;

  if (!credentialsBase64) {
    throw new Error("Google service account credentials are missing.");
  }

  let credentials: { client_email?: string; private_key?: string };

  try {
    credentials = JSON.parse(
      Buffer.from(credentialsBase64, "base64").toString("utf8"),
    ) as { client_email?: string; private_key?: string };
  } catch {
    throw new Error("Google service account credentials are invalid.");
  }

  const clientEmail = credentials.client_email;
  const privateKey = credentials.private_key;

  if (
    !clientEmail ||
    !privateKey ||
    !privateKey.includes("BEGIN PRIVATE KEY")
  ) {
    throw new Error("Google service account credentials are incomplete.");
  }

  return { clientEmail, privateKey };
}

async function getGoogleAccessToken() {
  const now = Date.now();

  if (cachedToken && cachedToken.expiresAt > now + 60_000) {
    return cachedToken.accessToken;
  }

  const { clientEmail, privateKey } = getGoogleCredentials();
  const issuedAt = Math.floor(now / 1000);
  const header = encodeBase64Url(JSON.stringify({ alg: "RS256", typ: "JWT" }));
  const claim = encodeBase64Url(
    JSON.stringify({
      iss: clientEmail,
      scope: GOOGLE_SHEETS_SCOPE,
      aud: GOOGLE_TOKEN_URL,
      iat: issuedAt,
      exp: issuedAt + 3600,
    }),
  );
  const unsignedToken = `${header}.${claim}`;
  const signature = createSign("RSA-SHA256")
    .update(unsignedToken)
    .end()
    .sign(privateKey, "base64url");
  const assertion = `${unsignedToken}.${signature}`;

  const response = await fetch(GOOGLE_TOKEN_URL, {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({
      grant_type: "urn:ietf:params:oauth:grant-type:jwt-bearer",
      assertion,
    }),
    cache: "no-store",
    signal: AbortSignal.timeout(10_000),
  });
  const result = (await response.json()) as GoogleTokenResponse;

  if (!response.ok || !result.access_token) {
    throw new Error(
      result.error_description || result.error || "Google authentication failed.",
    );
  }

  cachedToken = {
    accessToken: result.access_token,
    expiresAt: now + (result.expires_in ?? 3600) * 1000,
  };

  return cachedToken.accessToken;
}

function columnName(columnCount: number) {
  let value = columnCount;
  let result = "";

  while (value > 0) {
    value -= 1;
    result = String.fromCharCode(65 + (value % 26)) + result;
    value = Math.floor(value / 26);
  }

  return result;
}

function quotedSheetName(sheetName: string) {
  return `'${sheetName.replace(/'/g, "''")}'`;
}

async function ensureSheetAndHeaders(
  accessToken: string,
  spreadsheetId: string,
  sheetName: string,
  headers: string[],
) {
  const headerKey = `${spreadsheetId}:${sheetName}:${headers.join("|")}`;

  if (ensuredHeaderKeys.has(headerKey)) return;

  const spreadsheetUrl = `https://sheets.googleapis.com/v4/spreadsheets/${encodeURIComponent(
    spreadsheetId,
  )}`;
  const metadataUrl = new URL(spreadsheetUrl);
  metadataUrl.searchParams.set(
    "fields",
    "sheets.properties(sheetId,title,gridProperties(columnCount))",
  );
  const metadataResponse = await fetch(metadataUrl, {
    headers: { Authorization: `Bearer ${accessToken}` },
    cache: "no-store",
    signal: AbortSignal.timeout(15_000),
  });

  if (!metadataResponse.ok) {
    throw new Error(
      `Google Sheets metadata request failed (${metadataResponse.status}).`,
    );
  }

  const metadata = (await metadataResponse.json()) as {
    sheets?: Array<{
      properties?: {
        sheetId?: number;
        title?: string;
        gridProperties?: { columnCount?: number };
      };
    }>;
  };
  const sheet = metadata.sheets?.find(
    (sheet) => sheet.properties?.title === sheetName,
  );

  if (!sheet) {
    const createResponse = await fetch(`${spreadsheetUrl}:batchUpdate`, {
      method: "POST",
      headers: {
        Authorization: `Bearer ${accessToken}`,
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        requests: [
          {
            addSheet: {
              properties: {
                title: sheetName,
                gridProperties: {
                  columnCount: Math.max(26, headers.length),
                },
              },
            },
          },
        ],
      }),
      cache: "no-store",
      signal: AbortSignal.timeout(15_000),
    });

    if (!createResponse.ok) {
      const message = await createResponse.text();
      throw new Error(
        `Google Sheets tab creation failed (${createResponse.status}): ${message}`,
      );
    }
  } else {
    const sheetId = sheet.properties?.sheetId;
    const columnCount = sheet.properties?.gridProperties?.columnCount ?? 0;

    if (sheetId !== undefined && columnCount < headers.length) {
      const expandResponse = await fetch(`${spreadsheetUrl}:batchUpdate`, {
        method: "POST",
        headers: {
          Authorization: `Bearer ${accessToken}`,
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          requests: [
            {
              appendDimension: {
                sheetId,
                dimension: "COLUMNS",
                length: headers.length - columnCount,
              },
            },
          ],
        }),
        cache: "no-store",
        signal: AbortSignal.timeout(15_000),
      });

      if (!expandResponse.ok) {
        throw new Error(
          `Google Sheets column expansion failed (${expandResponse.status}).`,
        );
      }
    }
  }

  const lastColumn = columnName(headers.length);
  const range = encodeURIComponent(
    `${quotedSheetName(sheetName)}!A1:${lastColumn}1`,
  );
  const url = new URL(
    `${spreadsheetUrl}/values/${range}`,
  );
  url.searchParams.set("valueInputOption", "RAW");

  const response = await fetch(url, {
    method: "PUT",
    headers: {
      Authorization: `Bearer ${accessToken}`,
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ values: [headers] }),
    cache: "no-store",
    signal: AbortSignal.timeout(15_000),
  });

  if (!response.ok) {
    const message = await response.text();
    throw new Error(`Google Sheets header update failed (${response.status}): ${message}`);
  }

  ensuredHeaderKeys.add(headerKey);
}

export async function appendRowToGoogleSheet({
  sheetName,
  headers,
  values,
}: {
  sheetName: string;
  headers: string[];
  values: Array<string | number | boolean>;
}) {
  if (headers.length !== values.length) {
    throw new Error("Google Sheets headers and row values do not match.");
  }

  const spreadsheetId =
    process.env.GOOGLE_SHEETS_SPREADSHEET_ID || DEFAULT_SPREADSHEET_ID;
  const accessToken = await getGoogleAccessToken();
  await ensureSheetAndHeaders(
    accessToken,
    spreadsheetId,
    sheetName,
    headers,
  );

  const lastColumn = columnName(headers.length);
  const range = encodeURIComponent(
    `${quotedSheetName(sheetName)}!A:${lastColumn}`,
  );
  const url = new URL(
    `https://sheets.googleapis.com/v4/spreadsheets/${encodeURIComponent(
      spreadsheetId,
    )}/values/${range}:append`,
  );
  url.searchParams.set("valueInputOption", "RAW");
  url.searchParams.set("insertDataOption", "OVERWRITE");

  const response = await fetch(url, {
    method: "POST",
    headers: {
      Authorization: `Bearer ${accessToken}`,
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ majorDimension: "ROWS", values: [values] }),
    cache: "no-store",
    signal: AbortSignal.timeout(15_000),
  });

  if (!response.ok) {
    const message = await response.text();
    throw new Error(`Google Sheets append failed (${response.status}): ${message}`);
  }
}

export async function appendApplicationToGoogleSheet(
  application: ApplicationRow,
) {
  const sheetName = process.env.GOOGLE_SHEETS_SHEET_NAME || DEFAULT_SHEET_NAME;
  await appendRowToGoogleSheet({
    sheetName,
    headers: APPLICATION_HEADERS,
    values: [
          application.reference,
          application.submittedAt,
          application.status,
          application.fullName,
          application.age,
          application.gender,
          application.phoneNumber,
          application.nationalIdNumber,
          application.educationStatus,
          application.schoolName,
          application.currentClassLevel,
          application.lastSchoolYearCompleted,
          application.hubOfInterest,
          application.trainingInterest.join(", "),
          application.preferredTrainingSchedule,
          application.parentGuardianName,
          application.parentGuardianPhone,
          application.emergencyContactName,
          application.emergencyContactPhone,
          application.accuracyConfirmed ? "Yes" : "No",
          application.participantSignature,
          application.declarationDate,
          application.mediaConsent,
          application.consentSignature,
          application.consentDate,
          application.submissionSource,
          application.parentGuardianRelationship,
          application.guardianConsentConfirmed ? "Yes" : "No",
          application.guardianSignature,
          application.declarationVersion,
          application.mediaConsentVersion,
          application.mediaConsentSignerRole,
    ],
  });
}
