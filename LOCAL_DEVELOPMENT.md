# Protected local development

This is a sanitized source copy, not a clean upstream branch or a Git clone.
Use the checksum-verified Node executable directly, not ordinary npm/npx:

```sh
cd /ABSOLUTE/PATH/TO/WORKSPACE
env -i PATH=/usr/bin:/bin TMPDIR=/private/tmp /ABSOLUTE/PATH/TO/VERIFIED_NODE scripts/start-local.mjs typecheck
env -i PATH=/usr/bin:/bin TMPDIR=/private/tmp /ABSOLUTE/PATH/TO/VERIFIED_NODE scripts/start-local.mjs build
env -i PATH=/usr/bin:/bin TMPDIR=/private/tmp /ABSOLUTE/PATH/TO/VERIFIED_NODE scripts/start-local.mjs dev --port 3015
```

For an already built preview use `start` instead of `dev`. Both bind only to
127.0.0.1. The clean outer environment also prevents inherited Node preload options.
Stop a running preview before building or switching between dev and start because
they share Next.js output files. Both modes bind only to
127.0.0.1. Only a validated `--port` argument is accepted. The launcher verifies
the Node checksum, rejects unreviewed .env/service-account files, supplies a fresh
credential-free environment/HOME, and enforces the reviewed macOS network sandbox.
It fails closed on unsupported platforms. No credentials are auto-loaded.

Submission handlers, Google Sheets and Redis integration fail closed by default.
Local HTTP guards reject API/write requests; CSP blocks external resources and
native form submissions. Dev mode permits local HMR only. Forms and map layouts
remain present, but real submissions, captcha calls and external map tiles are
intentionally unavailable. Fonts are bundled locally with identical font bytes,
Unicode ranges and fallback metrics. No Google font request is needed to build.

`.npmrc` disables dependency lifecycle scripts. Installation must still use the
separately verified isolated npm CLI with `ci --ignore-scripts --no-audit --no-fund`.
Do not enable postinstall/prepare or blanket rebuilds automatically. VS Code
automatic tasks remain off; review extensions before granting workspace trust.

`.env.local` contains only the exact local safety flags. Unknown environment
files cause the launcher to stop rather than loading secrets. Environment files
and `.local-dev/` are ignored. Do not add service-account files, real applicant
data, production keys, tokens or browser credentials.

Integration code is retained for a separately reviewed integration environment:
it requires explicit local-only opt-out, external-service enablement and
submission enablement, plus disposable service configuration. The local launcher
never enables those settings. Turnstile fails closed without both keys, and
Sheets requires an explicit spreadsheet ID; no production destination defaults.
SiteGate is only a cosmetic client-side gate, not authentication; no default
password is shipped.

Deployment files are preserved under `deployment-reference/` and are inactive.
Do not reactivate them, connect/push to the contaminated remote, or deploy without
a separate review. These project controls do not certify the Mac or make deliberate
manual bypasses safe.

## Reviewed minimatch dependency fix

The lint stack uses patched upstream minimatch 11.0.3. Older ESLint plugins
receive the private adapter in `vendor/minimatch-legacy-compat/`, which delegates
matching to that release while preserving the specific callable APIs they use.
It is not an upstream package or a universal v3 replacement. Its `makeRe`
helper supports the reviewed plugin's `.test()` usage, not general RegExp APIs.
No old vulnerable matcher is embedded and no lifecycle patch script is used.

The overrides reference the reviewed local tarball under vendor/ using a relative path. Fresh installation portability has not yet been runtime verified. If the workspace
moves, review/update those paths before installation. Keep adapter source and
tarball identical; changes require regeneration, script-disabled lockfile update
and the compatibility tests. Do not replace the tarball silently.

Run the persistent offline dependency regression checks with:

```sh
env -i PATH=/usr/bin:/bin TMPDIR=/private/tmp /ABSOLUTE/PATH/TO/VERIFIED_NODE scripts/start-local.mjs dependencycheck
```

Review the adapter again when updating ESLint/plugins. Remove it once upstream
consumers support the patched API directly. Registry advisory checks do not audit
this private adapter or certify the host.

## Local form testing

Both submission flows use browser-memory-only mocks in this local-only build:
`/apply` youth registration and the volunteer/partner/support forms on
`/get-involved`. The real API routes remain blocked with HTTP 403; no captcha,
Google Sheets or other external service is called. No submission is persisted,
logged, emailed or placed in browser storage. Reloading discards input.

Use synthetic names/organisations beginning with `LOCAL TEST`, an email ending
in `@example.invalid`, phone numbers containing only zeros, and no national ID.
Use synthetic free text only. Autofill is disabled for local test forms. The
local-only notice lets you select Success, Service error or Network error; the
last two are simulations without a network request. Existing field/step
validation still runs. Success screens display `MOCK-...-LOCAL-ONLY` references
and explicitly say nothing was sent/saved and no follow-up will occur.

Run the offline validation/response regression tests with:

```sh
env -i PATH=/usr/bin:/bin TMPDIR=/private/tmp /ABSOLUTE/PATH/TO/VERIFIED_NODE scripts/start-local.mjs formcheck
```

These mocks exercise the reviewed local contract, not production persistence,
captcha, rate limits or delivery. Keep live API access and external services
disabled until a separately reviewed integration environment is authorized.
