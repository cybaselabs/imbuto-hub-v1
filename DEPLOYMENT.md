# Deployment

Pushes to `main` build a Docker image, publish it to GitHub Container Registry,
and deploy it to the VPS at `147.182.164.106`.

## GitHub Secrets

Add these repository secrets in GitHub:

- `VPS_USER`: SSH user on the VPS, for example `root` or `deploy`
- `VPS_SSH_KEY`: private SSH key that can log in to the VPS
- `GOOGLE_SERVICE_ACCOUNT_JSON_BASE64`: the complete Google service account JSON
  key encoded as base64
- `TURNSTILE_SECRET_KEY`: the private secret for the Cloudflare Turnstile widget
- `UPSTASH_REDIS_REST_URL`: the REST URL for the Upstash Redis database
- `UPSTASH_REDIS_REST_TOKEN`: the REST token for the Upstash Redis database

Add this repository variable under **Settings → Secrets and variables → Actions
→ Variables**:

- `TURNSTILE_SITE_KEY`: the public Cloudflare Turnstile site key

The workflow uses the built-in `GITHUB_TOKEN` to publish and pull the image from
GHCR during deployment.

## Google Sheets application storage

The `/apply` form sends registrations to the local server-side
`/api/applications` route. The route authenticates directly with the Google
Sheets API and appends each application to the `Applications` tab of the
`Imbuto Youth Registration` workbook. No Apps Script or public webhook is used.

The forms on `/get-involved` use the same private service-account connection
and write to separate tabs in that workbook:

- Volunteer applications → `Volunteers`
- Partnership inquiries → `Partnerships`
- Support interests → `Support Requests`

The server creates a missing tab and its headers before writing the first row.
All four public forms use server-side validation, the shared persistent rate
limit, a honeypot, and Turnstile verification.

To activate the connection:

1. In Google Cloud, enable the Google Sheets API and create a service account.
2. Create a JSON key for that service account. Keep the key private.
3. Share the Google Sheet with the service account email as an **Editor**.
4. Encode the complete JSON key file as base64 and add it as the GitHub Actions
   secret listed above.
5. Deploy the `main` branch.

For local development, `npm run dev` automatically reads the ignored
`imbuto-web-applications-308f8189cec8.json` key from the project root and passes
it to the server process. Set `GOOGLE_SERVICE_ACCOUNT_JSON_PATH` to use a
different local filename. The key file must never be committed.

## Application abuse protection

The application endpoint permits five requests per visitor IP in each ten-minute
window. When the Upstash variables are configured, counters persist across
container restarts and work across multiple app instances. If Redis is
temporarily unavailable, the server logs the failure and retains an in-memory
fallback limit for availability.

The final registration step renders Cloudflare Turnstile when
`TURNSTILE_SITE_KEY` is present. The server independently validates every token
using `TURNSTILE_SECRET_KEY` before writing to Google Sheets. Create the widget
for `imbutohub.com` and `www.imbutohub.com` in the Cloudflare dashboard. Add the
site key and secret together: the endpoint deliberately rejects submissions if
only one of the two Turnstile values is configured.

## Nginx Proxy Manager

The deployed app container is named `imbuto-site` and listens on port `3000`
inside the Docker network `npm_proxy`.

If Nginx Proxy Manager is running in Docker, attach it to the same network:

```bash
docker network connect npm_proxy nginx-proxy-manager
```

Then create a Proxy Host:

- Forward Hostname / IP: `imbuto-site`
- Forward Port: `3000`
- Scheme: `http`
- Enable Websockets Support
- Request an SSL certificate in the SSL tab

The workflow also binds the app to `127.0.0.1:1014` on the VPS. If Nginx Proxy
Manager is installed directly on the same VPS, proxy to `127.0.0.1` on port
`1014`.
