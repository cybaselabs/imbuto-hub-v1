const TURNSTILE_VERIFY_URL =
  "https://challenges.cloudflare.com/turnstile/v0/siteverify";

type TurnstileResponse = {
  success?: boolean;
  "error-codes"?: string[];
};

export async function verifyTurnstileToken(token: string, remoteIp: string) {
  const siteKey = process.env.NEXT_PUBLIC_TURNSTILE_SITE_KEY;
  const secret = process.env.TURNSTILE_SECRET_KEY;

  // Keep local development frictionless when Turnstile is intentionally unused,
  // but fail closed if only half of the production configuration is present.
  if (!siteKey && !secret) return true;
  if (!siteKey || !secret) {
    throw new Error("Turnstile configuration is incomplete.");
  }
  if (!token || token.length > 2_048) return false;

  const body = new URLSearchParams({
    secret,
    response: token,
    idempotency_key: crypto.randomUUID(),
  });

  if (remoteIp && remoteIp !== "unknown") {
    body.set("remoteip", remoteIp);
  }

  const response = await fetch(TURNSTILE_VERIFY_URL, {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body,
    cache: "no-store",
    signal: AbortSignal.timeout(8_000),
  });

  if (!response.ok) {
    throw new Error(`Turnstile verification failed (${response.status}).`);
  }

  const result = (await response.json()) as TurnstileResponse;

  if (!result.success) {
    console.warn("Turnstile rejected an application:", result["error-codes"]);
  }

  return result.success === true;
}
