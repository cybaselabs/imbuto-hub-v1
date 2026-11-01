import { submitLocalMock } from "./local-form-mock.cjs";

export const localFormMocks = process.env.NEXT_PUBLIC_IMBUTO_LOCAL_ONLY !== "false";
export const developmentSheetForms = process.env.NEXT_PUBLIC_IMBUTO_DEV_SHEETS === "true";
export type MockScenario = "success" | "error" | "network-error";

export async function submitForm(
  endpoint: "/api/applications" | "/api/get-involved",
  payload: Record<string, unknown>,
  scenario: MockScenario,
): Promise<{ reference: string; mock: boolean }> {
  if (localFormMocks) {
    if (typeof window === "undefined" || !["127.0.0.1", "localhost", "[::1]"].includes(window.location.hostname)) {
      throw new Error("Local form mocks require a loopback preview.");
    }
    return submitLocalMock(endpoint, payload, scenario);
  }
  const response = await fetch(endpoint, {
    method: "POST",
    headers: { "Content-Type": "application/json", ...(developmentSheetForms ? { "X-Imbuto-Dev-Test": "1" } : {}) },
    body: JSON.stringify(developmentSheetForms ? { ...payload, turnstileToken: "imbuto-development-test" } : payload),
  });
  const result = (await response.json()) as { error?: string; reference?: string };
  if (!response.ok || !result.reference) throw new Error(result.error || "We could not save your submission. Please try again.");
  return { reference: result.reference, mock: false };
}
