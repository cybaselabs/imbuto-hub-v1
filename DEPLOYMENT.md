# Deployment recovery

Intended live server: `201.79.35.46`; domains: `imbutohub.com` and `www.imbutohub.com`.
See `PRODUCTION_SITE.md` for the reviewed website-only candidate and its checks.
No server configuration, deployment, production credentials or applicant Sheet
was accessed by this change.

The root Dockerfile produces a non-root website-only image with submissions and
external services disabled. It preserves the interface while explicitly showing
that form submission is unavailable. Development mock/Sheets runtimes remain
separate and protected by their existing launchers.

The build workflow validates this security branch only (or can be dispatched
manually once available); it has no image publishing, SSH or deployment steps.
`main` is not a push trigger. The old push-to-main workflow remains inactive
under `deployment-reference/deploy.yml.disabled` as historical evidence.

Before any live deployment:

1. Obtain a passing Linux image build and container smoke check. Local Docker
   verification was blocked by a BuildKit metadata input/output error; do not
   reset or prune unrelated Docker data to bypass it.
2. Publish or transfer the reviewed immutable image without embedding credentials.
3. Review the inactive Compose/Caddy candidates. Proposed binding is
   `127.0.0.1:1014` forwarding to container port 3000, with the app named `imbuto-site`.
4. Validate the server-side configuration, start the isolated candidate, verify
   readiness, then separately approve HTTPS proxy activation with a rollback path.

Real submissions are intentionally not part of this website-only release. They
require a separately approved production service identity/Sheet, CAPTCHA and
abuse-protection implementation and tests. Do not supply those secrets to the
current image: its launcher rejects service credentials. No credential defaults
or automatic local key discovery are restored.
