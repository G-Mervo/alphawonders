# Multi-Site Deployment Guide

> **Purpose:** This document captures the complete, battle-tested process for deploying new sites on the shared EC2 infrastructure. It is designed to be injected into future AI/LLM prompts as context so that every deployment follows the exact same proven pattern. Everything here was learned from the alphawonders.com production deployment.

---

## Table of Contents

1. [Architecture Overview](#architecture-overview)
2. [Current Infrastructure State](#current-infrastructure-state)
3. [Sites to Deploy](#sites-to-deploy)
4. [Critical Lessons Learned](#critical-lessons-learned)
5. [Prerequisites](#prerequisites)
6. [Step 1: GitHub Repository Setup](#step-1-github-repository-setup)
7. [Step 2: AWS Parameter Store](#step-2-aws-parameter-store)
8. [Step 3: Docker Compose for the App](#step-3-docker-compose-for-the-app)
9. [Step 4: ACM Certificate (us-east-1)](#step-4-acm-certificate-us-east-1)
10. [Step 5: CloudFront Distribution](#step-5-cloudfront-distribution)
11. [Step 6: Route 53 DNS](#step-6-route-53-dns)
12. [Step 7: Deploy](#step-7-deploy)
13. [Step 8: Verification Checklist](#step-8-verification-checklist)
14. [Appendix: Templates](#appendix-templates)
15. [Appendix: Troubleshooting](#appendix-troubleshooting)

---

## Architecture Overview

```
User
  |
  v
CloudFront (ACM SSL, us-east-1 cert)
  |  Viewer protocol: Redirect HTTP -> HTTPS
  |  Origin protocol: HTTP ONLY, port 80
  v
EC2 t4g.large (ARM/Graviton)
  |  Amazon Linux 2023, us-west-2
  |  IP: 35.92.241.82
  |  Instance ID: i-0be89c6434191eeba
  |  Security group: HTTP from CloudFront prefix list only
  v
nginx-proxy (nginx:1.27-alpine, port 80)
  |  Routes by Host header to app containers
  |  Uses Docker DNS resolver (127.0.0.11)
  |  Variable-based upstream (prevents crash if container missing)
  v
App Containers (each site in its own container)
  |  All on 'shared-services' Docker bridge network
  |  Each exposes port 8080 internally (no host port mapping)
  v
PostgreSQL 18-alpine (shared, port 5432 on 127.0.0.1 only)
  |  Container name: postgres
  |  On 'shared-services' network
```

### Key Design Decisions

- **No SSL on EC2.** CloudFront + ACM handles all HTTPS. Nginx serves HTTP only on port 80.
- **No SSH keys in CI/CD.** All deployment commands run via AWS SSM (Systems Manager).
- **No .env files on EC2.** All secrets live in AWS SSM Parameter Store and are fetched at deploy time.
- **No host port mapping for apps.** Containers use `expose: ["8080"]`, not `ports`. Nginx routes by hostname.
- **One Docker network.** All containers (postgres, nginx, apps) are on the `shared-services` bridge network.
- **IMDSv2 enforced.** Amazon Linux 2023 requires token-based metadata service (IMDSv1 returns empty).

---

## Current Infrastructure State

### What Is Already Running

| Component | Container | Status | Notes |
|-----------|-----------|--------|-------|
| PostgreSQL 18 | `postgres` | Running, healthy | Shared across all sites, data in `pgdata` volume |
| Nginx reverse proxy | `nginx-proxy` | Running, healthy | Configs for all 5 domains already loaded |
| alphawonders.com | `alphawonders-app` | LIVE | First site deployed, fully working |

### Shared Infrastructure Files (on EC2 at `~/infra/`)

```
~/infra/
  docker-compose.postgres.yml   # PostgreSQL + Nginx
  .env                          # PG_USER, PG_PASSWORD, PG_DB (only file with secrets on EC2)
  nginx/
    nginx.conf                  # Main nginx config
    conf.d/
      00-default.conf           # Default server (444 for unknown hosts, /health returns 200)
      alphawonders.conf          # alphawonders.com -> alphawonders-app:8080
      mvacant.conf               # mvacant.com -> mvacant-app:8080
      keenile.conf               # keenile.com -> keenile-app:8080
      somasmart.conf             # somasmart.site -> somasmart-app:8080
      keenile-ai.conf            # keenile.ai -> keenile-ai-app:8080
      _template.conf.example     # Template for adding new domains
```

### Per-App Files (on EC2 at `~/sitename/`)

```
~/alphawonders/
  docker-compose.yml            # References ghcr.io/g-mervo/alphawonders:latest
```

### Security Group Rules

| Type | Port | Source | Purpose |
|------|------|--------|---------|
| HTTP | 80 | `pl-82a045eb` (com.amazonaws.global.cloudfront.origin-facing) | CloudFront IPv4 prefix list |
| SSH | 22 | Your IP (or removed entirely) | Admin access |

**WARNING:** Use the IPv4 prefix list `pl-82a045eb`, NOT the IPv6 version `pl-07f8c64944f5dc195`.

### IAM Setup

- **EC2 role:** `ec2-alphawonders-role` — has `AmazonSSMManagedInstanceCore` + read access to `/deploy/*` parameters
- **Deploy user:** `mervodeploy` — has SSMDeploy + SSMParameterStore policies
- Deploy user credentials are stored as GitHub Secrets

---

## Sites to Deploy

| # | Domain | Container Name | GHCR Image | Port | Status |
|---|--------|---------------|------------|------|--------|
| 1 | alphawonders.com | alphawonders-app | ghcr.io/g-mervo/alphawonders:latest | 8080 | LIVE |
| 2 | mvacant.com | mvacant-app | ghcr.io/g-mervo/mvacant:latest | 8080 | Pending |
| 3 | keenile.com | keenile-app | ghcr.io/g-mervo/keenile:latest | 8080 | Pending |
| 4 | somasmart.site | somasmart-app | ghcr.io/g-mervo/somasmart:latest | 8080 | Pending |
| 5 | keenile.ai | keenile-ai-app | ghcr.io/g-mervo/keenile-ai:latest | 8080 | Pending |

**IMPORTANT:** GitHub username `G-Mervo` must be lowercased to `g-mervo` in all GHCR image paths. Docker/GHCR rejects uppercase.

---

## Critical Lessons Learned

### What Worked

1. **SSM-based deployment** — No SSH keys stored in GitHub. Deploy workflow sends commands via `aws ssm send-command`. Eliminates an entire class of security risks.

2. **Parameter Store for all secrets** — No .env files on EC2 (except infra/.env for PostgreSQL). App secrets are fetched from Parameter Store at deploy time and injected as environment variables.

3. **IMDSv2 token-based metadata retrieval** — Amazon Linux 2023 enforces IMDSv2. This is the correct pattern:
   ```bash
   TOKEN=$(curl -sX PUT "http://169.254.169.254/latest/api/token" \
     -H "X-aws-ec2-metadata-token-ttl-seconds: 60")
   REGION=$(curl -s -H "X-aws-ec2-metadata-token: $TOKEN" \
     "http://169.254.169.254/latest/meta-data/placement/region")
   ```

4. **SSM command polling loops** — `aws ssm wait command-executed` times out on longer operations. Use polling instead:
   ```bash
   for i in $(seq 1 60); do
     STATUS=$(aws ssm get-command-invocation \
       --command-id "$CMD_ID" \
       --instance-id "$INSTANCE_ID" \
       --query "Status" --output text 2>/dev/null || echo "Pending")
     if [ "$STATUS" = "Success" ]; then break; fi
     if [ "$STATUS" = "Failed" ] || [ "$STATUS" = "Cancelled" ]; then exit 1; fi
     sleep 5
   done
   ```

5. **Docker DNS resolver + variable upstream in nginx** — Prevents nginx from crashing when upstream containers do not exist yet:
   ```nginx
   resolver 127.0.0.11 valid=30s ipv6=off;
   location / {
       set $upstream container-name:8080;
       proxy_pass http://$upstream;
   }
   ```

6. **Docker build cache** with GitHub Actions cache:
   ```yaml
   cache-from: type=gha
   cache-to: type=gha,mode=max
   ```

7. **`forceGlobalSecureRequests=false`** in CodeIgniter 4 — CloudFront handles the HTTPS redirect. If CI4 also tries to force HTTPS, it creates redirect loops.

8. **Passing sensitive values through `env:` block** in GitHub Actions — Prevents shell interpretation of special characters in passwords:
   ```yaml
   env:
     DB_PASSWORD: ${{ secrets.DB_PASSWORD }}
   run: |
     echo "password=$DB_PASSWORD"   # Safe - no shell expansion
   ```

### What DID NOT Work / Gotchas

1. **IMDSv1 fails silently on Amazon Linux 2023.** A bare `curl http://169.254.169.254/latest/meta-data/...` returns empty string with no error. You MUST use IMDSv2 with token. This will waste hours if you do not know.

2. **GitHub Variables vs Secrets mismatch.** `${{ secrets.MY_VAR }}` returns empty string if the value is stored in Variables (not Secrets), and vice versa. There is no error message. Always verify values are stored in the correct store.

3. **`aws ssm wait command-executed` times out.** For any SSM command that takes more than a few seconds, `wait` will time out and fail the workflow. Always use a polling loop (see pattern above).

4. **CloudFront origin protocol MUST be "HTTP only."** When creating a CloudFront distribution with an EC2 origin, the console defaults to "HTTPS only" for the origin protocol. This causes 504 Gateway Timeout because EC2/nginx only serves HTTP. You must explicitly select "HTTP only" in the origin settings.

5. **CloudFront prefix list: use IPv4, not IPv6.** The correct prefix list for the EC2 security group is `pl-82a045eb` (com.amazonaws.global.cloudfront.origin-facing). The IPv6 version `pl-07f8c64944f5dc195` does NOT work for standard CloudFront-to-origin traffic.

6. **`docker compose up -d` does NOT recreate containers when only env vars change.** If you change environment variables and just run `up -d`, the existing container keeps the old values. You must use `docker compose up -d --force-recreate` or do `docker compose down && docker compose up -d`.

7. **Uppercase in Docker image names breaks GHCR.** GitHub username `G-Mervo` must be lowercased to `g-mervo` in image paths: `ghcr.io/g-mervo/repo:tag`. GHCR will reject the push/pull if any uppercase letters exist.

8. **Docker Compose plugin for root user.** SSM runs commands as root. The Docker Compose plugin must be installed to BOTH locations:
   ```bash
   # For the ec2-user
   /usr/local/lib/docker/cli-plugins/docker-compose
   # For root (SSM runs as root)
   /root/.docker/cli-plugins/docker-compose
   ```
   If only installed for ec2-user, `docker compose` works over SSH but fails via SSM.

9. **Passwords with special characters ($, !, *, parentheses) get shell-expanded.** Never inline `${{ vars.PASSWORD }}` or `${{ secrets.PASSWORD }}` directly in a `run:` script. Always assign to an env var first:
   ```yaml
   # WRONG - shell interprets special chars
   run: echo "${{ secrets.DB_PASS }}" > something

   # RIGHT - env block protects the value
   env:
     DB_PASS: ${{ secrets.DB_PASS }}
   run: echo "$DB_PASS" > something
   ```

10. **ACM certificates for CloudFront MUST be in us-east-1.** Even though the EC2 instance is in us-west-2, CloudFront is a global service and only reads certificates from us-east-1. If you create the cert in us-west-2, it will not appear in the CloudFront certificate dropdown.

11. **CI4 `app.baseURL` cannot be empty or "/".** It must be a full URL like `https://domain.com`. Setting it to empty string or "/" crashes the entire CodeIgniter 4 application with no useful error message.

12. **`writable/` directory needed for PHPUnit.** CI test jobs must create the writable subdirectories before running tests:
    ```bash
    mkdir -p writable/{cache,logs,session,uploads,debugbar}
    ```

---

## Prerequisites

Before starting deployment of a new site, ensure the following exist:

- [ ] **GitHub repository** with the site's source code
- [ ] **Dockerfile** in the repo root (see [Dockerfile Template](#dockerfile-template) in appendix)
- [ ] **Working Docker build** — test locally with `docker build .` before proceeding
- [ ] **PostgreSQL database created** for the new site (connect via SSH tunnel to postgres container)
- [ ] **GitHub PAT** with `read:packages` and `write:packages` scope for GHCR (can reuse existing one)
- [ ] **AWS credentials** for the `mervodeploy` IAM user (already in GitHub Secrets for alphawonders)
- [ ] **Nginx config** already exists in `infra/nginx/conf.d/` (all 5 domain configs are already created)
- [ ] **Shared infrastructure running** — PostgreSQL and nginx-proxy containers are healthy

### Create the Database

Connect to PostgreSQL via SSH tunnel and create the database:

```bash
# From your local machine
ssh -L 5432:localhost:5432 alphawonders

# In another terminal, connect to postgres
psql -h localhost -U mervo -d alphaw

# Create the new database
CREATE DATABASE sitename_db;
```

Or via SSM/docker exec on EC2:

```bash
docker exec -it postgres psql -U mervo -d alphaw -c "CREATE DATABASE sitename_db;"
```

---

## Step 1: GitHub Repository Setup

### 1.1 GitHub Secrets (repo-level)

Go to **repo > Settings > Secrets and variables > Actions** and add these **Secrets**:

| Secret Name | Value | Notes |
|-------------|-------|-------|
| `AWS_ACCESS_KEY_ID` | mervodeploy access key | Same across all repos |
| `AWS_SECRET_ACCESS_KEY` | mervodeploy secret key | Same across all repos |
| `GHCR_PAT` | GitHub PAT with packages scope | Same across all repos |
| `PG_PASSWORD` | PostgreSQL password | Same password, same shared DB server |

### 1.2 GitHub Variables (repo-level)

Go to **repo > Settings > Secrets and variables > Actions > Variables** and add these **Variables**:

| Variable Name | Value | Notes |
|---------------|-------|-------|
| `AWS_REGION` | `us-west-2` | Same across all repos |
| `EC2_INSTANCE_ID` | `i-0be89c6434191eeba` | Same instance for all sites |
| `EC2_DEPLOY_HOME` | `/home/ec2-user` | Same across all repos |
| `DOCKER_IMAGE` | `ghcr.io/g-mervo/SITENAME` | Lowercase! |
| `CONTAINER_NAME` | `SITENAME-app` | Must match nginx upstream config |
| `APP_BASE_URL` | `https://domain.com` | Full URL, not empty, not "/" |
| `PG_USER` | `mervo` | Same across all repos |
| `PG_DB` | `sitename_db` | Site-specific database |
| `SSM_PARAM_PREFIX` | `/deploy/sitename` | Site-specific parameter path |

**CRITICAL:** Do not mix up Secrets and Variables. `${{ secrets.AWS_REGION }}` returns empty if AWS_REGION is stored as a Variable. `${{ vars.PG_PASSWORD }}` returns empty if PG_PASSWORD is stored as a Secret. There is no error message for this mismatch.

### 1.3 CI/CD Workflow File

Create `.github/workflows/deploy.yml` in the site's repository. The workflow has three stages: test, build, deploy.

```yaml
name: Test, Build & Deploy

on:
  push:
    branches: [master, main]
  workflow_dispatch:

permissions:
  contents: read
  packages: write

env:
  REGISTRY: ghcr.io
  IMAGE_NAME: ghcr.io/g-mervo/SITENAME  # <-- CHANGE THIS (lowercase!)

jobs:
  # ── Stage 1: Test ──────────────────────────────────────────────
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.1'
          extensions: pgsql, pdo_pgsql, intl, mbstring, zip
          coverage: none

      - name: Install dependencies
        run: composer install --prefer-dist --no-progress

      - name: Create writable directories
        run: mkdir -p writable/{cache,logs,session,uploads,debugbar}

      - name: Run tests
        run: vendor/bin/phpunit --no-coverage
        # If no tests yet, replace with: echo "No tests configured"

  # ── Stage 2: Build & Push Docker Image ─────────────────────────
  build:
    needs: test
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4

      - name: Set up QEMU (for ARM builds)
        uses: docker/setup-qemu-action@v3

      - name: Set up Docker Buildx
        uses: docker/setup-buildx-action@v3

      - name: Login to GHCR
        uses: docker/login-action@v3
        with:
          registry: ghcr.io
          username: ${{ github.actor }}
          password: ${{ secrets.GHCR_PAT }}

      - name: Build and push
        uses: docker/build-push-action@v6
        with:
          context: .
          platforms: linux/arm64
          push: true
          tags: |
            ${{ env.IMAGE_NAME }}:latest
            ${{ env.IMAGE_NAME }}:${{ github.sha }}
          cache-from: type=gha
          cache-to: type=gha,mode=max

  # ── Stage 3: Deploy to EC2 via SSM ─────────────────────────────
  deploy:
    needs: build
    runs-on: ubuntu-latest
    steps:
      - name: Configure AWS credentials
        uses: aws-actions/configure-aws-credentials@v4
        with:
          aws-access-key-id: ${{ secrets.AWS_ACCESS_KEY_ID }}
          aws-secret-access-key: ${{ secrets.AWS_SECRET_ACCESS_KEY }}
          aws-region: ${{ vars.AWS_REGION }}

      - name: Deploy via SSM
        env:
          INSTANCE_ID: ${{ vars.EC2_INSTANCE_ID }}
          DEPLOY_HOME: ${{ vars.EC2_DEPLOY_HOME }}
          CONTAINER_NAME: SITENAME-app   # <-- CHANGE THIS
          COMPOSE_DIR: SITENAME          # <-- CHANGE THIS (directory name on EC2)
          IMAGE: ${{ env.IMAGE_NAME }}:latest
          # Secrets passed through env block for safe shell escaping
          PG_PASSWORD: ${{ secrets.PG_PASSWORD }}
        run: |
          CMD_ID=$(aws ssm send-command \
            --instance-ids "$INSTANCE_ID" \
            --document-name "AWS-RunShellScript" \
            --timeout-seconds 300 \
            --parameters commands='[
              "set -e",

              "# ── IMDSv2: get region ──",
              "TOKEN=$(curl -sX PUT http://169.254.169.254/latest/api/token -H \"X-aws-ec2-metadata-token-ttl-seconds: 60\")",
              "REGION=$(curl -s -H \"X-aws-ec2-metadata-token: $TOKEN\" http://169.254.169.254/latest/meta-data/placement/region)",

              "# ── Fetch secrets from Parameter Store ──",
              "APP_BASE_URL=$(aws ssm get-parameter --name /deploy/SITENAME/app-base-url --with-decryption --query Parameter.Value --output text --region $REGION)",
              "DB_DATABASE=$(aws ssm get-parameter --name /deploy/SITENAME/db-database --with-decryption --query Parameter.Value --output text --region $REGION)",
              "DB_USERNAME=$(aws ssm get-parameter --name /deploy/SITENAME/db-username --with-decryption --query Parameter.Value --output text --region $REGION)",
              "DB_PASSWORD=$(aws ssm get-parameter --name /deploy/SITENAME/db-password --with-decryption --query Parameter.Value --output text --region $REGION)",
              "SMTP_HOST=$(aws ssm get-parameter --name /deploy/SITENAME/smtp-host --with-decryption --query Parameter.Value --output text --region $REGION || echo '')",
              "SMTP_USER=$(aws ssm get-parameter --name /deploy/SITENAME/smtp-user --with-decryption --query Parameter.Value --output text --region $REGION || echo '')",
              "SMTP_PASS=$(aws ssm get-parameter --name /deploy/SITENAME/smtp-pass --with-decryption --query Parameter.Value --output text --region $REGION || echo '')",
              "SMTP_PORT=$(aws ssm get-parameter --name /deploy/SITENAME/smtp-port --with-decryption --query Parameter.Value --output text --region $REGION || echo '587')",
              "SMTP_CRYPTO=$(aws ssm get-parameter --name /deploy/SITENAME/smtp-crypto --with-decryption --query Parameter.Value --output text --region $REGION || echo 'tls')",
              "SMTP_FROM_EMAIL=$(aws ssm get-parameter --name /deploy/SITENAME/smtp-from-email --with-decryption --query Parameter.Value --output text --region $REGION || echo '')",
              "SMTP_FROM_NAME=$(aws ssm get-parameter --name /deploy/SITENAME/smtp-from-name --with-decryption --query Parameter.Value --output text --region $REGION || echo '')",
              "GHCR_PAT=$(aws ssm get-parameter --name /deploy/ghcr-pat --with-decryption --query Parameter.Value --output text --region $REGION)",

              "# ── Login to GHCR ──",
              "echo $GHCR_PAT | docker login ghcr.io -u g-mervo --password-stdin",

              "# ── Pull latest image ──",
              "docker pull ghcr.io/g-mervo/SITENAME:latest",

              "# ── Write env vars and restart ──",
              "cd /home/ec2-user/SITENAME",
              "export APP_BASE_URL DB_DATABASE DB_USERNAME DB_PASSWORD",
              "export SMTP_HOST SMTP_USER SMTP_PASS SMTP_PORT SMTP_CRYPTO SMTP_FROM_EMAIL SMTP_FROM_NAME",
              "docker compose down || true",
              "docker compose up -d --force-recreate",

              "# ── Health check ──",
              "sleep 10",
              "docker ps --filter name=SITENAME-app --format \"{{.Status}}\""
            ]' \
            --query "Command.CommandId" --output text)

          echo "SSM Command ID: $CMD_ID"

          # ── Poll for completion (do NOT use 'aws ssm wait') ──
          for i in $(seq 1 60); do
            STATUS=$(aws ssm get-command-invocation \
              --command-id "$CMD_ID" \
              --instance-id "$INSTANCE_ID" \
              --query "Status" --output text 2>/dev/null || echo "Pending")

            echo "Attempt $i/60: $STATUS"

            if [ "$STATUS" = "Success" ]; then
              echo "Deploy successful!"
              aws ssm get-command-invocation \
                --command-id "$CMD_ID" \
                --instance-id "$INSTANCE_ID" \
                --query "StandardOutputContent" --output text
              exit 0
            fi

            if [ "$STATUS" = "Failed" ] || [ "$STATUS" = "Cancelled" ] || [ "$STATUS" = "TimedOut" ]; then
              echo "Deploy FAILED with status: $STATUS"
              aws ssm get-command-invocation \
                --command-id "$CMD_ID" \
                --instance-id "$INSTANCE_ID" \
                --query "StandardErrorContent" --output text
              exit 1
            fi

            sleep 5
          done

          echo "Timed out waiting for SSM command"
          exit 1
```

**Replace all occurrences of `SITENAME` with the actual site name** (e.g., `mvacant`, `keenile`, `somasmart`, `keenile-ai`).

---

## Step 2: AWS Parameter Store

### 2.1 Naming Convention

All parameters follow the pattern: `/deploy/sitename/key`

The shared GHCR PAT uses: `/deploy/ghcr-pat` (already exists from alphawonders deployment).

### 2.2 Parameters to Create Per Site

Using the AWS CLI (or Console > Systems Manager > Parameter Store):

```bash
AWS_REGION=us-west-2

# App URL (MUST be full URL, not empty, not "/")
aws ssm put-parameter \
  --name "/deploy/SITENAME/app-base-url" \
  --value "https://domain.com" \
  --type "SecureString" \
  --region $AWS_REGION

# Database
aws ssm put-parameter \
  --name "/deploy/SITENAME/db-database" \
  --value "sitename_db" \
  --type "SecureString" \
  --region $AWS_REGION

aws ssm put-parameter \
  --name "/deploy/SITENAME/db-username" \
  --value "mervo" \
  --type "SecureString" \
  --region $AWS_REGION

aws ssm put-parameter \
  --name "/deploy/SITENAME/db-password" \
  --value "THE_ACTUAL_PASSWORD" \
  --type "SecureString" \
  --region $AWS_REGION

# SMTP (optional — skip if site doesn't send email)
aws ssm put-parameter --name "/deploy/SITENAME/smtp-host" --value "smtp.example.com" --type "SecureString" --region $AWS_REGION
aws ssm put-parameter --name "/deploy/SITENAME/smtp-user" --value "user@example.com" --type "SecureString" --region $AWS_REGION
aws ssm put-parameter --name "/deploy/SITENAME/smtp-pass" --value "password" --type "SecureString" --region $AWS_REGION
aws ssm put-parameter --name "/deploy/SITENAME/smtp-port" --value "587" --type "SecureString" --region $AWS_REGION
aws ssm put-parameter --name "/deploy/SITENAME/smtp-crypto" --value "tls" --type "SecureString" --region $AWS_REGION
aws ssm put-parameter --name "/deploy/SITENAME/smtp-from-email" --value "noreply@domain.com" --type "SecureString" --region $AWS_REGION
aws ssm put-parameter --name "/deploy/SITENAME/smtp-from-name" --value "Site Name" --type "SecureString" --region $AWS_REGION
```

### 2.3 Shared Parameters (already exist)

These were created during alphawonders deployment and are reused:

| Parameter | Purpose |
|-----------|---------|
| `/deploy/ghcr-pat` | GitHub PAT for pulling images from GHCR |

---

## Step 3: Docker Compose for the App

### 3.1 Create Directory on EC2

The deploy workflow handles this, but if doing manually:

```bash
# On EC2 (via SSH or SSM)
mkdir -p ~/SITENAME
```

### 3.2 docker-compose.yml Template

Create `docker-compose.yml` in the site's repository root. This file will also be placed at `~/SITENAME/docker-compose.yml` on EC2.

```yaml
services:
  app:
    image: ghcr.io/g-mervo/SITENAME:latest
    container_name: SITENAME-app
    restart: unless-stopped
    expose:
      - "8080"                          # internal only - nginx-proxy routes traffic here
    environment:
      - CI_ENVIRONMENT=production
      # App
      - app.baseURL=${APP_BASE_URL}
      - app.forceGlobalSecureRequests=false  # CloudFront handles HTTPS redirect
      - app.defaultLocale=en
      - app.negotiateLocale=false
      - app.supportedLocales=[en]
      - app.appTimezone=Africa/Nairobi
      - app.charset=UTF-8
      # Database
      - database.default.hostname=postgres   # Container name on shared-services network
      - database.default.database=${DB_DATABASE}
      - database.default.username=${DB_USERNAME}
      - database.default.password=${DB_PASSWORD}
      - database.default.DBDriver=Postgre
      - database.default.port=5432
      - database.default.DBPrefix=
      - database.default.charset=utf8
      # Email (SMTP)
      - email.fromEmail=${SMTP_FROM_EMAIL}
      - email.fromName=${SMTP_FROM_NAME}
      - email.protocol=smtp
      - email.SMTPHost=${SMTP_HOST}
      - email.SMTPUser=${SMTP_USER}
      - email.SMTPPass=${SMTP_PASS}
      - email.SMTPPort=${SMTP_PORT}
      - email.SMTPCrypto=${SMTP_CRYPTO}
    volumes:
      - app-writable:/var/www/html/writable
      - app-attachments:/var/www/html/attachments
    networks:
      - shared-services
    healthcheck:
      test: ["CMD-SHELL", "curl -so /dev/null http://localhost:8080/ || exit 1"]
      interval: 30s
      timeout: 10s
      retries: 3
      start_period: 40s

volumes:
  app-writable:
  app-attachments:

networks:
  shared-services:
    external: true
```

### 3.3 Critical Rules for docker-compose.yml

1. **Use `expose`, NOT `ports`.** Apps do not publish ports to the host. Nginx handles all routing.
2. **Network MUST be `shared-services` with `external: true`.** This network is created by the infra stack.
3. **Container name MUST match the nginx upstream config.** E.g., `mvacant-app` matches `set $upstream mvacant-app:8080;` in `mvacant.conf`.
4. **Database hostname is `postgres`** (the container name), NOT `localhost` or an IP.
5. **`forceGlobalSecureRequests` MUST be `false`** for CI4 apps behind CloudFront.
6. **`app.baseURL` MUST be a full URL** like `https://mvacant.com`. Never empty, never "/".

---

## Step 4: ACM Certificate (us-east-1)

**CRITICAL: Certificates for CloudFront MUST be created in us-east-1, regardless of where your EC2 lives.**

### 4.1 Request Certificate

1. Go to **AWS Console > ACM** (make sure you are in **us-east-1 / N. Virginia**)
2. Click **Request a certificate**
3. Select **Request a public certificate**
4. Add domain names:
   - `domain.com`
   - `*.domain.com` (wildcard for www and any subdomains)
5. Validation method: **DNS validation**
6. Click **Request**

### 4.2 Validate via DNS

1. ACM shows CNAME records needed for validation
2. If domain is in Route 53: click **Create records in Route 53** (automatic)
3. If domain is elsewhere: add the CNAME records manually at your DNS provider
4. Wait for status to change to **Issued** (usually 5-30 minutes)

### 4.3 Certificates Needed

| Domain | Certificate Domain Names | Region |
|--------|-------------------------|--------|
| mvacant.com | `mvacant.com`, `*.mvacant.com` | us-east-1 |
| keenile.com | `keenile.com`, `*.keenile.com` | us-east-1 |
| somasmart.site | `somasmart.site`, `*.somasmart.site` | us-east-1 |
| keenile.ai | `keenile.ai`, `*.keenile.ai` | us-east-1 |

---

## Step 5: CloudFront Distribution

Create one CloudFront distribution per domain. **Follow these settings exactly** -- deviating from them (especially the origin protocol) will cause failures.

### 5.1 Create Distribution (Console)

1. Go to **AWS Console > CloudFront > Create distribution**

2. **Origin settings:**
   - Origin domain: `35.92.241.82` (or EC2 public DNS)
   - Protocol: **HTTP only** (NOT "HTTPS only" -- this is the #1 cause of 504 errors)
   - HTTP port: `80`
   - Origin path: (leave empty)
   - Name: `SITENAME-ec2-origin`

3. **Default cache behavior:**
   - Viewer protocol policy: **Redirect HTTP to HTTPS**
   - Allowed HTTP methods: **GET, HEAD, OPTIONS, PUT, POST, PATCH, DELETE**
   - Cache policy: **CachingDisabled** (or a custom policy if you want caching)
   - Origin request policy: **AllViewer** (passes Host header to origin -- required for nginx routing)

4. **Settings:**
   - Alternate domain names (CNAMEs): `domain.com`, `www.domain.com`
   - Custom SSL certificate: Select the ACM cert from us-east-1
   - Supported HTTP versions: HTTP/2, HTTP/3
   - Default root object: (leave empty)
   - Standard logging: optional

5. Click **Create distribution**

### 5.2 Critical CloudFront Settings Checklist

| Setting | Correct Value | Why |
|---------|--------------|-----|
| Origin protocol | **HTTP only** | EC2 only serves HTTP. "HTTPS only" causes 504. |
| Origin request policy | **AllViewer** | Must pass `Host` header so nginx routes to correct container. |
| Viewer protocol | **Redirect HTTP to HTTPS** | Users get HTTPS, origin gets HTTP. |
| Allowed methods | **All (including POST)** | Sites have forms, APIs, etc. |
| ACM cert region | **us-east-1** | CloudFront only reads certs from us-east-1. |
| Cache policy | **CachingDisabled** | For dynamic sites. Adjust later if needed. |

### 5.3 Wait for Deployment

CloudFront distributions take 5-15 minutes to deploy. Status changes from "Deploying" to "Deployed" + "Enabled".

---

## Step 6: Route 53 DNS

### 6.1 For Domains in Route 53

1. Go to **Route 53 > Hosted zones > domain.com**
2. Create records:

**Apex domain (domain.com):**
- Record type: **A**
- Alias: **Yes**
- Route traffic to: **Alias to CloudFront distribution**
- Select the CloudFront distribution for this domain

**WWW subdomain (www.domain.com):**
- Record type: **A**
- Alias: **Yes**
- Route traffic to: **Alias to CloudFront distribution**
- Select the same CloudFront distribution

### 6.2 For Domains NOT in Route 53

If the domain is registered elsewhere, add CNAME records:

```
www.domain.com  CNAME  d1234abcdef.cloudfront.net
```

For the apex domain (domain.com), you cannot use CNAME. Options:
- Transfer to Route 53 (recommended for Alias record support)
- Use your registrar's ANAME/ALIAS record if supported
- Use a redirect from the registrar to www.domain.com

### 6.3 DNS Records Summary

| Domain | Record Type | Value |
|--------|------------|-------|
| mvacant.com | A (Alias) | CloudFront distribution |
| www.mvacant.com | A (Alias) | CloudFront distribution |
| keenile.com | A (Alias) | CloudFront distribution |
| www.keenile.com | A (Alias) | CloudFront distribution |
| somasmart.site | A (Alias) | CloudFront distribution |
| www.somasmart.site | A (Alias) | CloudFront distribution |
| keenile.ai | A (Alias) | CloudFront distribution |
| www.keenile.ai | A (Alias) | CloudFront distribution |

---

## Step 7: Deploy

### 7.1 First Deployment

For the very first deployment of a new site:

1. **Ensure the docker-compose.yml exists on EC2:**
   ```bash
   # Via SSM or SSH
   mkdir -p /home/ec2-user/SITENAME
   # Copy or create docker-compose.yml there
   ```

2. **Push to the `master` or `main` branch** of the GitHub repo. The CI/CD workflow will:
   - Run tests
   - Build ARM Docker image
   - Push to GHCR
   - Send SSM command to EC2 that:
     - Fetches secrets from Parameter Store
     - Logs into GHCR
     - Pulls the image
     - Runs `docker compose up -d --force-recreate`
     - Health checks

3. **Verify** the container is running:
   ```bash
   docker ps --filter name=SITENAME-app
   ```

### 7.2 Subsequent Deployments

Just push to `master`/`main`. The workflow handles everything automatically.

### 7.3 Manual Deployment (if CI/CD is not ready)

```bash
# On EC2 (via SSH)
cd ~/SITENAME

# Login to GHCR
echo "YOUR_GHCR_PAT" | docker login ghcr.io -u g-mervo --password-stdin

# Pull latest image
docker pull ghcr.io/g-mervo/SITENAME:latest

# Set environment variables
export APP_BASE_URL="https://domain.com"
export DB_DATABASE="sitename_db"
export DB_USERNAME="mervo"
export DB_PASSWORD="your_password"
# ... set all other env vars

# Start/restart
docker compose down
docker compose up -d
```

### 7.4 SSM Deploy Command Pattern

The core SSM deploy command follows this exact pattern. This is what the CI/CD workflow sends:

```bash
# 1. Get region via IMDSv2 (MUST use token)
TOKEN=$(curl -sX PUT "http://169.254.169.254/latest/api/token" \
  -H "X-aws-ec2-metadata-token-ttl-seconds: 60")
REGION=$(curl -s -H "X-aws-ec2-metadata-token: $TOKEN" \
  "http://169.254.169.254/latest/meta-data/placement/region")

# 2. Fetch all secrets from Parameter Store
APP_BASE_URL=$(aws ssm get-parameter --name "/deploy/SITENAME/app-base-url" \
  --with-decryption --query "Parameter.Value" --output text --region "$REGION")
DB_DATABASE=$(aws ssm get-parameter --name "/deploy/SITENAME/db-database" \
  --with-decryption --query "Parameter.Value" --output text --region "$REGION")
DB_USERNAME=$(aws ssm get-parameter --name "/deploy/SITENAME/db-username" \
  --with-decryption --query "Parameter.Value" --output text --region "$REGION")
DB_PASSWORD=$(aws ssm get-parameter --name "/deploy/SITENAME/db-password" \
  --with-decryption --query "Parameter.Value" --output text --region "$REGION")
GHCR_PAT=$(aws ssm get-parameter --name "/deploy/ghcr-pat" \
  --with-decryption --query "Parameter.Value" --output text --region "$REGION")

# 3. Login to GHCR and pull
echo "$GHCR_PAT" | docker login ghcr.io -u g-mervo --password-stdin
docker pull ghcr.io/g-mervo/SITENAME:latest

# 4. Deploy
cd /home/ec2-user/SITENAME
export APP_BASE_URL DB_DATABASE DB_USERNAME DB_PASSWORD
docker compose down || true
docker compose up -d --force-recreate

# 5. Health check
sleep 10
docker ps --filter "name=SITENAME-app" --format "{{.Status}}"
```

---

## Step 8: Verification Checklist

After deploying each site, verify every step in order:

### Container Level

- [ ] Container is running: `docker ps --filter name=SITENAME-app`
- [ ] Container is on shared-services network: `docker network inspect shared-services | grep SITENAME`
- [ ] Container logs show no errors: `docker logs SITENAME-app --tail 50`
- [ ] Container health check passes: `docker inspect SITENAME-app --format='{{.State.Health.Status}}'`
- [ ] App responds internally: `docker exec nginx-proxy curl -s -o /dev/null -w "%{http_code}" -H "Host: domain.com" http://SITENAME-app:8080/`

### Nginx Level

- [ ] Nginx config is valid: `docker exec nginx-proxy nginx -t`
- [ ] Nginx routes to app: `curl -s -o /dev/null -w "%{http_code}" -H "Host: domain.com" http://localhost/` (from EC2)

### CloudFront Level

- [ ] Distribution status is "Deployed" + "Enabled"
- [ ] Origin protocol is "HTTP only" (NOT "HTTPS only")
- [ ] CNAMEs include both `domain.com` and `www.domain.com`
- [ ] ACM cert is attached and valid
- [ ] Test via CloudFront URL: `curl -I https://d1234abcdef.cloudfront.net`

### DNS Level

- [ ] `dig domain.com` resolves to CloudFront IPs
- [ ] `dig www.domain.com` resolves to CloudFront IPs
- [ ] `curl -I https://domain.com` returns 200
- [ ] `curl -I https://www.domain.com` redirects to `https://domain.com` (nginx www redirect)
- [ ] `curl -I http://domain.com` redirects to `https://domain.com` (CloudFront HTTP->HTTPS)

### Database Level

- [ ] Database exists: `docker exec postgres psql -U mervo -l | grep sitename_db`
- [ ] App can connect: check container logs for database connection errors
- [ ] Migrations run successfully (if applicable)

### End-to-End

- [ ] Site loads in browser at `https://domain.com`
- [ ] Forms submit correctly (POST requests work through CloudFront)
- [ ] No mixed content warnings (all assets served over HTTPS)
- [ ] No redirect loops (forceGlobalSecureRequests is false)

---

## Appendix: Templates

### Dockerfile Template (CI4 App)

```dockerfile
FROM php:8.1-fpm AS base

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    && docker-php-ext-install \
        pdo_pgsql \
        pgsql \
        intl \
        mbstring \
        zip \
        opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better layer caching
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev)
RUN composer install --no-dev --no-scripts --no-interaction --optimize-autoloader

# Copy application code
COPY . .

# Re-run composer scripts after full copy
RUN composer dump-autoload --optimize --no-dev

# Set permissions for writable directory
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 775 /var/www/html/writable

# Ensure attachments directory exists with correct permissions
RUN mkdir -p /var/www/html/attachments \
    && chown -R www-data:www-data /var/www/html/attachments \
    && chmod -R 775 /var/www/html/attachments

# Copy Nginx configuration
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Copy Supervisor configuration
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy PHP-FPM configuration
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Copy PHP configuration
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Copy and set entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Install curl for healthcheck
RUN apt-get update && apt-get install -y curl && apt-get clean && rm -rf /var/lib/apt/lists/*

EXPOSE 8080

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
```

### Nginx Reverse Proxy Config Template (already created for all 5 domains)

```nginx
# -- SITENAME.com --
server {
    listen 80;
    listen [::]:80;
    server_name DOMAIN www.DOMAIN;

    if ($host = www.DOMAIN) {
        return 301 https://DOMAIN$request_uri;
    }

    resolver 127.0.0.11 valid=30s ipv6=off;

    location / {
        set $upstream CONTAINER:8080;
        proxy_pass http://$upstream;
        proxy_set_header Host              $host;
        proxy_set_header X-Real-IP         $remote_addr;
        proxy_set_header X-Forwarded-For   $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $http_x_forwarded_proto;
        proxy_read_timeout 300;
        proxy_connect_timeout 10;
    }
}
```

### Site-Specific Values Quick Reference

| Field | mvacant | keenile | somasmart | keenile-ai |
|-------|---------|---------|-----------|------------|
| Domain | mvacant.com | keenile.com | somasmart.site | keenile.ai |
| Container | mvacant-app | keenile-app | somasmart-app | keenile-ai-app |
| Image | ghcr.io/g-mervo/mvacant | ghcr.io/g-mervo/keenile | ghcr.io/g-mervo/somasmart | ghcr.io/g-mervo/keenile-ai |
| Compose dir | ~/mvacant | ~/keenile | ~/somasmart | ~/keenile-ai |
| DB name | mvacant_db | keenile_db | somasmart_db | keenile_ai_db |
| SSM prefix | /deploy/mvacant | /deploy/keenile | /deploy/somasmart | /deploy/keenile-ai |
| Base URL | https://mvacant.com | https://keenile.com | https://somasmart.site | https://keenile.ai |
| Nginx conf | mvacant.conf | keenile.conf | somasmart.conf | keenile-ai.conf |

---

## Appendix: Troubleshooting

### 504 Gateway Timeout from CloudFront

**Cause:** CloudFront origin protocol is set to "HTTPS only" but EC2 only serves HTTP.
**Fix:** Edit CloudFront distribution > Origins > Edit origin > Change protocol to "HTTP only".

### 502 Bad Gateway from Nginx

**Cause:** App container is not running or not on the `shared-services` network.
**Fix:**
```bash
# Check container is running
docker ps --filter name=SITENAME-app

# Check it's on the right network
docker network inspect shared-services | grep SITENAME

# If not on network, recreate
cd ~/SITENAME && docker compose down && docker compose up -d
```

### Container starts but immediately exits

**Cause:** Usually `app.baseURL` is empty or "/" which crashes CI4.
**Fix:** Ensure `APP_BASE_URL` env var is set to full URL like `https://domain.com`.
```bash
docker logs SITENAME-app --tail 100
```

### SSM command fails / times out

**Causes:**
- EC2 IAM role missing `AmazonSSMManagedInstanceCore` policy
- SSM Agent not running on EC2
- Docker Compose plugin not installed for root user

**Fix:**
```bash
# Check SSM Agent
sudo systemctl status amazon-ssm-agent

# Install Compose for root
mkdir -p /root/.docker/cli-plugins
cp /usr/local/lib/docker/cli-plugins/docker-compose /root/.docker/cli-plugins/
```

### Database connection refused

**Cause:** PostgreSQL container not running or not on shared-services network.
**Fix:**
```bash
docker inspect postgres --format='{{.State.Health.Status}}'
docker network inspect shared-services | grep postgres
```

### GHCR image pull fails

**Causes:**
- PAT expired or lacks `read:packages` scope
- Image name has uppercase letters (must be all lowercase)
- Image does not exist yet (first build hasn't run)

**Fix:**
```bash
# Test login
echo "PAT_HERE" | docker login ghcr.io -u g-mervo --password-stdin

# Verify image exists (lowercase!)
docker pull ghcr.io/g-mervo/sitename:latest
```

### Redirect loop (ERR_TOO_MANY_REDIRECTS)

**Cause:** CI4 `forceGlobalSecureRequests` is `true`, creating a redirect loop with CloudFront.
**Fix:** Set `app.forceGlobalSecureRequests=false` in docker-compose.yml environment.

### CloudFront returns 503

**Causes:**
- EC2 security group does not allow CloudFront prefix list
- Nginx or EC2 is down

**Fix:** Check security group has inbound HTTP (80) from `pl-82a045eb` prefix list.

### DNS not resolving

**Cause:** Route 53 records not created or still propagating.
**Fix:**
```bash
dig domain.com
dig www.domain.com
```
If no records, create A Alias records pointing to CloudFront distribution. Propagation takes up to 48 hours but usually minutes.

### GitHub Actions `${{ secrets.X }}` returns empty

**Cause:** Value is stored in Variables, not Secrets (or vice versa). No error is shown.
**Fix:** Go to repo > Settings > Secrets and variables > Actions. Check if the value is under "Secrets" or "Variables". Use `${{ secrets.X }}` for Secrets, `${{ vars.X }}` for Variables.

---

## Appendix: Quick Deploy Sequence (Condensed)

For experienced operators, here is the minimal sequence to deploy a new site:

```
1. Create DB:           docker exec postgres psql -U mervo -c "CREATE DATABASE sitename_db;"
2. SSM Parameters:      aws ssm put-parameter --name /deploy/sitename/... (all keys)
3. GitHub Secrets/Vars: Add AWS creds + app-specific vars to new repo
4. docker-compose.yml:  Copy template, replace SITENAME
5. deploy.yml:          Copy workflow template, replace SITENAME
6. ACM cert:            Request in us-east-1, DNS validate
7. CloudFront:          Create distribution (HTTP only origin!), attach cert
8. Route 53:            A Alias records for apex + www -> CloudFront
9. EC2 setup:           mkdir ~/sitename, copy docker-compose.yml
10. Push to master:     CI/CD handles build + deploy
11. Verify:             curl https://domain.com
```

Total time per site: ~30-45 minutes (mostly waiting for ACM validation and CloudFront deployment).
