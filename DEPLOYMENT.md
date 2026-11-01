# Deployment recovery — preparation only

The confirmed replacement server is `201.79.35.46` (live production), with intended domain `imbutohub.com` shown in the supplied dashboard. DNS/proxy routing has not been independently verified. No server
access or deployment has been performed. The old server address, production
Sheet destination and secret-loading instructions are not current configuration.

## Implemented validation

`.github/workflows/build-validation.yml` is a manual, read-only-permission build
workflow. It installs with a frozen npm lockfile and lifecycle scripts disabled,
runs type/lint/regression checks, and builds directly with the local Next CLI.
It does not publish images, use production secrets, SSH, or deploy. There are no
push, pull-request or schedule triggers. Referenced GitHub actions use commit SHAs.

`deployment-reference/Dockerfile.validation` is a Linux build candidate. It copies
the reviewed vendor tarball before installation, disables lifecycle scripts,
bypasses the macOS-only development launcher for compilation, uses matching
Debian builder/runtime bases, and runs the standalone output as a non-root user.
It is not the root Dockerfile and is not automatically built or deployed.

## Confirmed remaining production blockers

- Confirm the public HTTPS domain and reverse-proxy arrangement, app container
  name and unused host port on the new server. Do not assume the old settings.
- Implement and test a separate explicit production runtime policy. The current
  recovered source intentionally requires local hosts and verified development
  Sheets flags. Simply shipping it to production will reject public requests.
- Production submission mode must use real Turnstile verification, origin and
  hostname checks, production-appropriate rate limits and separately provisioned
  Sheet credentials. It must never use the local test verifier or development
  credentials. No existing production secrets were read or changed.
- Select the intended production Sheet privately; no live Sheet ID is embedded
  as a default. Keep development and production destinations separate.
- Validate the Linux container, including required native prebuilt modules;
  fresh macOS installation success does not prove Linux compatibility.
- Pin the final container image digest after the chosen image is reviewed.
- Use a protected production environment and manually approved deployment of an
  immutable image with health checks and a rollback path. Do not restore automatic
  push-to-main SSH deployment or destructive container replacement/pruning.

Keep `main`, production, local mock preview and development Sheets preview
unchanged until the production candidate and deployment action are reviewed.
The original disabled workflow/Dockerfile remain historical reference only.

## Credential handling

Never place private keys or base64 credentials in source, image build arguments,
Docker build context, command history, or logs. Supply new designated runtime
credentials through the deployment platform's secret mechanism only after the
production configuration is approved. No local credential auto-discovery exists.
