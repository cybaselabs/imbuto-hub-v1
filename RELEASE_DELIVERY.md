# Website-only release delivery

The release workflow does not deploy. It exports the exact image that passed
its Linux container checks, then publishes a downloadable GitHub Actions artifact
named `imbuto-website-release-<full-source-commit>`. Retention is three days. No
new registry permissions, passwords, production keys or SSH configuration are used.

## Release gate

Require a successful run for the intended full commit. The workflow checks the
application, then the read-only/network-isolated container, then the Compose
candidate (private container address, internal network, fixed non-root runtime). Only
after those succeed is the image exported. GitHub's artifact upload also supplies
an archive digest. Match the run and source commit before trusting the download.
Checksums establish integrity against the trusted run, not host-wide cleanliness.

The artifact contains:

- `imbuto-site.tar.gz`: Docker-save archive, not source code.
- `image-id.txt`: exact local Docker image content ID.
- `source-commit.txt`: full source commit from the workflow run.
- `SHA256SUMS`: SHA-256 hashes of the six release files.
- `compose.production-site.yml`: reviewed container configuration.
- `render-production-caddy.py`: renders a proxy candidate for a validated private IP.
- `production-container-smoke.cjs`: the network-isolated container check.

## Transfer and activation sequence

1. Download the artifact from the matching successful GitHub run. Extract only
   this release into a new private directory; preserve the original download.
2. Verify every file using `shasum -a 256 -c SHA256SUMS` on macOS, then compare
   `source-commit.txt` against the verified GitHub run. Never copy credential files.
3. Transfer only the release files to a new private directory on the intended
   server `201.79.35.46`, using the new designated SSH key. Do not overwrite
   existing releases, application containers or `/etc/caddy/Caddyfile`.
4. On Ubuntu, verify `sha256sum -c SHA256SUMS`, load the image archive and compare
   its inspected image ID to `image-id.txt`. Do not rebuild or pull a replacement.
5. Confirm container name `imbuto-site` remains unused. Launch the
   candidate with its exact local image ID and pull policy never. Verify health
   and public Host handling through its inspected private address before changing
   the reverse proxy.
6. Preserve the current Caddyfile, validate the candidate with Caddy and activate
   HTTPS only after container readiness passes. If proxy verification fails,
   restore that saved Caddyfile and leave the preserved release for investigation.

Actual transfer and server commands are issued only after the artifact and its
full source commit are known. The current server is a fresh Ubuntu/Caddy/Docker
installation; no application has been deployed by these preparation changes.
Real submissions and external services remain disabled. Production applicant
Sheets and local previews are not part of this release.

## Internal-network correction

The previous Compose check reached container health but failed on a silent
host-port HTTP assertion. Docker can omit published ports on internal-only bridge
networks. The corrected candidate publishes no host ports and retains its internal
network and egress isolation. Host Caddy connects directly to the inspected
private container IPv4 address on port 3000. No second internet-connected network
or host networking is added.

After container creation, inspect its single network address, run
`python3 -B render-production-caddy.py PRIVATE_CONTAINER_IP > Caddyfile.rendered`,
validate that generated candidate with Caddy and preserve the existing server
Caddyfile before activation. The renderer accepts only RFC1918 IPv4 addresses
and fixed Imbuto hostnames. Regenerate/revalidate/reload the proxy whenever the
container is recreated and its private address changes. Do not apply an old
loopback-port Caddyfile. CI now prints each private-upstream HTTP result.
