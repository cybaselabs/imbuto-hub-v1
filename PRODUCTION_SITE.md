# Website-only production candidate — 2026-11-02

Intended server: `201.79.35.46`; public domains: `imbutohub.com` and
`www.imbutohub.com`. No production server configuration has been applied by this
change. The existing mock and development Sheets previews remain separate.

## Behavior

The root Dockerfile builds a website-only image. It preserves the page designs,
accepts only the two approved public Host values, rejects API/write requests,
and offers a loopback health endpoint at `/healthz`. Form controls and submit
buttons are disabled, with an explicit unavailable notice. The browser refuses
submission before fetch. No mock success or real registration is claimed.

Production is an explicit `IMBUTO_RUNTIME=production-site` mode. With that mode
absent, existing loopback-only development protections remain the default. The
production launcher uses a fresh allowlisted environment, rejects service-key
and Node preload/TLS configuration, refuses dotenv files and checks the build
mode marker. Production mode always disables external services and submissions,
even if a submission/development flag is set. Google Sheets, Redis, Turnstile
and development test verification are not used in this runtime.

The Linux image uses an official Node 22.23.2 Debian base pinned by digest,
script-disabled lockfile installation and the Next CLI directly. It runs as
the non-root node user. No credentials or service endpoints are build arguments.
The standalone generated server is started through the reviewed production
launcher, not ordinary npm/npx or the macOS-only development launcher.

## Validation and workflow

The build workflow can be started manually and automatically validates pushes
to `security/sanitized-dev-sheets-20261101` only. It has read-only repository
permissions and performs installation, type/lint/regression checks, a bundled-font
build and Linux image checks. It never pushes an image, SSHs to a server,
uses production credentials or deploys. It does not run on pushes to main.

The container smoke test starts only inside an isolated test runtime. In CI the
container has no network, a read-only root and bounded temporary storage. Checks
cover page responses for both domains, disabled registration controls, API/write
rejection, unknown-host rejection, health readiness, CSP and the legacy Programmes
redirect without a loop. Local HTTP checks are distinct from Linux verification.

Local Linux image verification was blocked by Docker BuildKit storage reporting
an input/output error in its metadata database after dependency installation.
No Docker reset, pruning, existing-container restart or repair was performed.
Do not deploy until the Linux build and container smoke test succeed in CI or
another isolated build environment. Native macOS checks do not establish Linux
image compatibility.

## Inactive deployment candidates

`deployment-reference/compose.production-site.yml` expects a reviewed immutable
image digest. It binds only `127.0.0.1:1014`, uses a non-root image, a read-only
root, restricted tmpfs/capabilities and an internal network without internet
egress. Its networking and health behavior still require Linux validation.

`deployment-reference/Caddyfile.candidate` serves both public domains over HTTPS
and proxies to that loopback port. It has not replaced the server's default
Caddyfile. Back up the existing configuration, validate the candidate with Caddy,
and approve activation only after the image and container checks succeed.

No SSH secrets, registry publishing or automatic main-branch deployment are
restored. Real form submissions need a future separate review of production
storage, CAPTCHA, privacy and rate limits. Do not put the development key or
production applicant Sheet into this website-only runtime.
