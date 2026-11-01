FROM node:22.23.2-bookworm-slim@sha256:48e4b67d85f87bd551df43704e24d252f56cc5f8e9718841aace50f19948f0f9 AS builder
WORKDIR /app
ENV HUSKY=0 npm_config_ignore_scripts=true NEXT_TELEMETRY_DISABLED=1
COPY package.json package-lock.json .npmrc ./
COPY vendor ./vendor
RUN npm ci --ignore-scripts --no-audit --no-fund --strict-ssl=true
COPY . .
ENV IMBUTO_RUNTIME=production-site IMBUTO_EXTERNAL_SERVICES=false IMBUTO_ENABLE_SUBMISSIONS=false
ENV NEXT_PUBLIC_IMBUTO_SITE_ONLY=true NEXT_PUBLIC_IMBUTO_LOCAL_ONLY=false NEXT_PUBLIC_IMBUTO_DEV_SHEETS=false
RUN node node_modules/next/dist/bin/next build --webpack
RUN node -e 'require("fs").writeFileSync("production-site-build.json", JSON.stringify({mode:"production-site",submissions:false}))'

FROM node:22.23.2-bookworm-slim@sha256:48e4b67d85f87bd551df43704e24d252f56cc5f8e9718841aace50f19948f0f9 AS runner
WORKDIR /app
ENV NODE_ENV=production NEXT_TELEMETRY_DISABLED=1 PORT=3000 HOSTNAME=0.0.0.0
COPY --from=builder --chown=node:node /app/public ./public
COPY --from=builder --chown=node:node /app/.next/standalone ./
COPY --from=builder --chown=node:node /app/.next/static ./.next/static
COPY --from=builder --chown=node:node /app/scripts/start-production-site.mjs ./scripts/start-production-site.mjs
COPY --from=builder --chown=node:node /app/production-site-build.json ./production-site-build.json
USER node
EXPOSE 3000
HEALTHCHECK --interval=30s --timeout=5s --start-period=20s --retries=3 CMD ["node", "-e", "fetch('http://127.0.0.1:3000/healthz').then(r=>process.exit(r.ok?0:1)).catch(()=>process.exit(1))"]
CMD ["node", "scripts/start-production-site.mjs"]
