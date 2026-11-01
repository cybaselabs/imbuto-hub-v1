import config from "../development-sheet.json" with { type: "json" };
import { verifyDevelopmentSheet } from "../lib/google-sheets.ts";
await verifyDevelopmentSheet(config);
console.log("Verified the pinned development Sheet identity and marker.");
