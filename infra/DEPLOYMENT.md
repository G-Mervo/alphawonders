# Deployment Guide

## Architecture

```
User → CloudFront (ACM SSL) → EC2:80 → nginx-proxy → app containers
                                                    → postgres (shared DB)
```

- **EC2** runs all sites on one instance
- **Nginx** reverse proxy routes domains to app containers
- **CloudFront + ACM** handles SSL
- **PostgreSQL** shared container (independent of any app)
- **SSM Parameter Store** holds all secrets
- **CI/CD** via AWS SSM (no SSH keys)

### Domains

| Domain | Container |
|--------|-----------|
| alphawonders.com | alphawonders-app:8080 |
| mvacant.com | mvacant-app:8080 |
| keenile.com | keenile-app:8080 |
| somasmart.site | somasmart-app:8080 |
| keenile.ai | keenile-ai-app:8080 |

---

## GitHub Secrets to Set

Go to **repo → Settings → Secrets and variables → Actions → New repository secret**

### AWS

| Secret | Value |
|--------|-------|
| `AWS_ACCESS_KEY_ID` | mervodeploy access key |
| `AWS_SECRET_ACCESS_KEY` | mervodeploy secret key |
| `AWS_REGION` | `us-west-2` |
| `EC2_INSTANCE_ID` | `i-0be89c6434191eeba` |
| `EC2_DEPLOY_HOME` | `/home/ec2-user` |

### App

| Secret | Value |
|--------|-------|
| `GHCR_PAT` | GitHub PAT with `read:packages` scope |
| `PG_USER` | PostgreSQL username |
| `PG_PASSWORD` | PostgreSQL password |
| `PG_DB` | PostgreSQL database name |

---

## Step-by-Step

### 1. Prerequisites (already done)

- [x] EC2 instance launched (t4g.large, Amazon Linux 2023 ARM)
- [x] IAM role `ec2-alphawonders-role` attached to EC2 (AmazonSSMManagedInstanceCore + /deploy/* read)
- [x] IAM user `mervodeploy` has SSMDeploy + SSMParameterStore policies
- [x] SSH key pair created

### 2. Add GitHub Secrets

Add all 9 secrets listed above to your repo.

### 3. Run Setup Workflow (one-time per server)

1. Go to **repo → Actions → "Setup New EC2 Server"**
2. Click **"Run workflow"**
3. Fill in:
   - Instance ID: `i-0be89c6434191eeba`
   - Deploy home: `/home/ec2-user`
4. Click **"Run workflow"**

This will automatically:
- Store secrets in SSM Parameter Store
- Install Docker + Docker Compose on EC2
- Transfer nginx configs + docker-compose files
- Start PostgreSQL + Nginx + App

### 4. Set Up ACM Certificates (us-east-1)

> ACM certs for CloudFront MUST be in **us-east-1**.

For each domain: **ACM → Request certificate → DNS validation**

| Certificate | Domain names |
|-------------|-------------|
| Cert 1 | `alphawonders.com`, `*.alphawonders.com` |
| Cert 2 | `mvacant.com`, `*.mvacant.com` |
| Cert 3 | `keenile.com`, `*.keenile.com` |
| Cert 4 | `somasmart.site`, `*.somasmart.site` |
| Cert 5 | `keenile.ai`, `*.keenile.ai` |

Add the CNAME validation records to your DNS provider. Wait for status: **Issued**.

### 5. Create CloudFront Distributions

One per domain. For each:

- **Origin:** `35.92.241.82` (HTTP only, port 80)
- **Viewer protocol:** Redirect HTTP to HTTPS
- **Allowed methods:** GET, HEAD, OPTIONS, PUT, POST, PATCH, DELETE
- **Cache policy:** CachingDisabled
- **Origin request policy:** AllViewer
- **CNAMEs:** `example.com`, `www.example.com`
- **SSL cert:** matching ACM cert

### 6. Update DNS

Point each domain to its CloudFront distribution:

```
alphawonders.com      CNAME → d1234abcdef.cloudfront.net
www.alphawonders.com  CNAME → d1234abcdef.cloudfront.net
mvacant.com           CNAME → d5678ghijkl.cloudfront.net
...etc
```

### 7. Lock Down Security Group

**EC2 → Security Groups → Edit inbound rules:**

- **HTTP (80):** Source → `com.amazonaws.global.cloudfront.origin-facing` (prefix list)
- **SSH (22):** Remove or restrict to your IP
- Remove any "Anywhere" HTTP rules

---

## Deploying Code Updates

Just push to `master`. GitHub Actions will:
1. Build ARM Docker image
2. Push to GHCR
3. Fetch secrets from Parameter Store via SSM
4. Pull + restart app on EC2
5. Health check

---

## New Server in the Future

1. Launch EC2 (t4g, Amazon Linux 2023 ARM, 30 GiB)
2. Attach `ec2-alphawonders-role`
3. Update `EC2_INSTANCE_ID` secret in GitHub
4. **Actions → Setup New EC2 Server → Run workflow**
5. Set up ACM + CloudFront + DNS for the new IP

---

## Connecting pgAdmin Locally

PostgreSQL is bound to `127.0.0.1:5432` on the EC2. To connect your local pgAdmin:

```bash
ssh -L 5432:localhost:5432 alphawonders
```

Then connect pgAdmin to `localhost:5432` with your PG credentials.

---

## Troubleshooting

**502 Bad Gateway:** App container not running or not on `shared-services` network
```bash
ssh alphawonders
docker ps
docker network inspect shared-services
```

**CloudFront 503:** Security group not allowing CloudFront prefix list, or EC2/nginx not on port 80

**SSM command fails:** Check EC2 IAM role has `AmazonSSMManagedInstanceCore`, SSM Agent running

**Database connection refused:** Check postgres container healthy: `docker inspect postgres --format='{{.State.Health.Status}}'`
