# Deployment

Pushes to `main` build a Docker image, publish it to GitHub Container Registry,
and deploy it to the VPS at `147.182.164.106`.

## GitHub Secrets

Add these repository secrets in GitHub:

- `VPS_USER`: SSH user on the VPS, for example `root` or `deploy`
- `VPS_SSH_KEY`: private SSH key that can log in to the VPS

The workflow uses the built-in `GITHUB_TOKEN` to publish and pull the image from
GHCR during deployment.

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
