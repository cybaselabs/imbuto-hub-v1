import { defineConfig, globalIgnores } from "eslint/config";
import nextVitals from "eslint-config-next/core-web-vitals";
import nextTs from "eslint-config-next/typescript";

const eslintConfig = defineConfig([
  ...nextVitals,
  ...nextTs,
  {
    // These files intentionally expose Node's CommonJS API, including the
    // compatibility adapter. Keep TypeScript's import rule on other files.
    files: ["**/*.cjs"],
    rules: { "@typescript-eslint/no-require-imports": "off" },
  },
  globalIgnores([".local-dev/**", ".next/**", "out/**", "build/**", "next-env.d.ts"]),
]);

export default eslintConfig;
