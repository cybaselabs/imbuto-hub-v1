// Retained compatibility entry point: never auto-load credentials or bind publicly.
import("./scripts/start-local.mjs").then(({ runLocal }) => runLocal("start", process.argv.slice(2)));
