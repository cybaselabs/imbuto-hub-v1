# Separate development Google Sheets integration

This copy is isolated from `Imbuto-Hub-Sanitized`, whose existing mock preview
remains on port 3015. No production credential has been loaded. This integration
must not start until a newly designated development service account is supplied.

The new Sheet ID/title/marker are pinned in `development-sheet.json`. It has
Applications, Volunteers, Partnerships and Support Requests tabs, plus a
Development Only marker tab. Share only this Sheet with the new development
service account as Editor. Enable Sheets API in its dedicated development Cloud
project; no project-wide roles are needed for Sheet access. Do not reuse a key
from the compromise or a production project. Key creation is a user action.

Store the newly created JSON key privately outside source and cloud-sync folders,
mode 0600. Prepare a separate private config file (also 0600) with these fields:

```json
{
  "developmentOnly": true,
  "spreadsheetId": "CONFIGURE_SEPARATE_DEVELOPMENT_SHEET",
  "projectId": "YOUR-NEW-DEVELOPMENT-PROJECT-ID",
  "serviceAccountEmail": "YOUR-NEW-DEVELOPMENT-SERVICE-ACCOUNT-EMAIL",
  "credentialsFile": "/ABSOLUTE/PATH/TO/NEW-DEVELOPMENT-KEY.json"
}
```

No key, token or base64 credential belongs in source, .env files, reports, command
arguments or chat. The launcher reads only the explicitly supplied key after
matching the designated project/account. It passes credentials to the isolated
process in memory, not on the command line. It never searches for credentials.

Build without credentials or external access:

```sh
cd /ABSOLUTE/PATH/TO/WORKSPACE
env -i PATH=/usr/bin:/bin TMPDIR=/private/tmp /ABSOLUTE/PATH/TO/VERIFIED_NODE scripts/start-dev-sheets.mjs build
```

After the development credential and Sheet sharing are verified, start with:

```sh
env -i PATH=/usr/bin:/bin TMPDIR=/private/tmp /ABSOLUTE/PATH/TO/VERIFIED_NODE scripts/start-dev-sheets.mjs start --config /ABSOLUTE/PATH/TO/PRIVATE-DEVELOPMENT-CONFIG.json
```

The application stays at 127.0.0.1:3016 inside the existing network-denying macOS
sandbox. A small loopback relay forwards only TLS-validated requests to Google's
token endpoint and the exact pinned Sheet, without redirects or credential
logging. Startup verifies the live Sheet title, marker and expected tabs before
starting the app. No Redis or production infrastructure configuration is loaded.

The HTTP guard permits only the two JSON form POSTs with the exact local Origin
and a custom development-test header. Existing payload validation and local
memory rate limits remain; synthetic-only checks also run on the server. All
names begin LOCAL TEST, email uses example.invalid, phone numbers are zeros and
national ID is empty. References/status/source are labelled DEV/development.
CAPTCHA uses a fixed local test verifier only in this isolated runtime, with no
Cloudflare request. This does not test production CAPTCHA.

Do not claim delivery based on a browser success message alone. After submitting
synthetic registration plus volunteer/partner/support forms, verify exact DEV
references and columns in this Sheet, and confirm the original preview still
returns 403 for real API POSTs. No seeds, emails, deployment or remote changes.

## Published recovery branch

The checked-in Sheet configuration contains inert placeholders, not a live destination. Set all three target fields only for a separately created development Sheet before building the integration preview. Never use the production Sheet. Private credentials/configuration stay outside the repository. The published dependency override paths were made relative; verify a fresh script-disabled installation before adopting this branch on another machine.
