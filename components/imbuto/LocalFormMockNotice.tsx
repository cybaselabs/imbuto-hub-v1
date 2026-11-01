"use client";

import { localFormMocks, developmentSheetForms, productionSiteOnlyForms, type MockScenario } from "../../lib/form-submission";

export function LocalFormMockNotice({ scenario, onChange }: {
  scenario: MockScenario;
  onChange: (scenario: MockScenario) => void;
}) {
  if (productionSiteOnlyForms) return (
    <aside className="mb-6 rounded-[24px] border border-[#52b3a9]/25 bg-[#dff5f2] p-4 text-sm leading-6 text-[#102c35]" role="status">
      <strong>Submissions are temporarily unavailable.</strong> Please do not enter personal information. Nothing will be sent or saved.
    </aside>
  );
  if (developmentSheetForms) return (
    <aside className="mb-6 rounded-[24px] border border-[#52b3a9]/25 bg-[#dff5f2] p-4 text-sm leading-6 text-[#102c35]" aria-label="Development Google Sheet test">
      <strong>Development Google Sheet only.</strong> Synthetic test submissions will be saved to the separate development Sheet. Use names beginning with LOCAL TEST, emails at example.invalid, phone numbers made of zeros and no national ID. No real applicant data or production services. No follow-up will occur.
    </aside>
  );
  if (!localFormMocks) return null;
  return (
    <aside className="mb-6 rounded-[24px] border border-[#52b3a9]/25 bg-[#dff5f2] p-4 text-sm leading-6 text-[#102c35]" aria-label="Local form test controls">
      <p><strong>Local mock only.</strong> Nothing is sent or saved. Use names beginning with LOCAL TEST, emails at example.invalid, phone numbers made of zeros, and leave national ID empty. Use synthetic text only.</p>
      <label className="mt-3 block">
        Local mock response
        <select className="ml-3 rounded-lg border border-slate-200 bg-white p-2" value={scenario} onChange={(event) => onChange(event.target.value as MockScenario)}>
          <option value="success">Success</option>
          <option value="error">Service error</option>
          <option value="network-error">Network error (simulated)</option>
        </select>
      </label>
    </aside>
  );
}
