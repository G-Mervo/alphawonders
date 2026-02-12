# Deployment Guide

## Architecture

```
User → CloudFront (ACM SSL) → EC2:80 → nginx-proxy → app containers
                                                    → postgres (shared DB)
```

- **EC2** runs all sites on one instance (cost-saving)
- **Nginx** reverse proxy routes domains to the correct app container
- **CloudFront + ACM** handles SSL (no certs on the server)
- **PostgreSQL** runs as a shared container (independent of any app)
- **CI/CD** deploys via AWS SSM (no SSH keys in GitHub)

### Domains hosted

| Domain | Container | CloudFront | ACM Cert |
|--------|-----------|------------|----------|
| alphawonders.com | alphawonders-app:8080 | Own distribution | Own cert |
| mvacant.com | mvacant-app:8080 | Own distribution | Own cert |
| keenile.com | keenile-app:8080 | Own distribution | Own cert |
| somasmart.site | somasmart-app:8080 | Own distribution | Own cert |
| keenile.ai | keenile-ai-app:8080 | Own distribution | Own cert |

---

## What you need before starting

You should already have:
- [x] AWS account
- [x] IAM user `mervodeploy` with access key + secret key
- [x] GitHub Personal Access Token (PAT) with `read:packages` scope (for pulling Docker images from GHCR)

---

## Step 1: Create the EC2 instance

> The scripts do NOT create the EC2 — you create it manually in the AWS Console.

1. Go to **AWS Console → EC2 → Launch Instance**
2. Settings:
   - **Name:** `alphawonders-host` (or whatever you prefer)
   - **AMI:** Ubuntu 22.04 LTS (or Amazon Linux 2023)
   - **Instance type:** `t3.small` or `t3.medium` (depending on how many sites)
   - **Key pair:** Create one (you'll need it for initial SSH setup only)
   - **Storage:** 30 GB gp3 (minimum)
   - **Security Group:** Create new, allow:
     - SSH (port 22) from **your IP only** (temporary, for setup)
     - HTTP (port 80) from **anywhere** (CloudFront will connect here)
3. Click **Launch Instance**
4. Note the **Instance ID** (e.g. `i-0abc123def456`) — you'll need it later

---

## Step 2: Attach IAM role to EC2 (for SSM)

The EC2 needs an IAM role so the SSM Agent can register and so deploy commands can run.

1. Go to **IAM → Roles → Create Role**
2. **Trusted entity:** AWS Service → EC2
3. **Attach policies:**
   - `AmazonSSMManagedInstanceCore` (lets SSM Agent connect)
   - Create an inline policy:
     ```json
     {
       "Version": "2012-10-17",
       "Statement": [
         {
           "Effect": "Allow",
           "Action": "ssm:GetParameter",
           "Resource": "arn:aws:ssm:*:*:parameter/deploy/*"
         }
       ]
     }
     ```
     (This lets the EC2 read the GHCR PAT from Parameter Store during deploys)
4. **Name:** `ec2-alphawonders-role`
5. Go to **EC2 → Instances → Select your instance → Actions → Security → Modify IAM role**
6. Attach `ec2-alphawonders-role`

---

## Step 3: Grant `mervodeploy` IAM user permissions

This is the IAM user whose access key GitHub Actions uses.

1. Go to **IAM → Users → mervodeploy → Add permissions → Create inline policy**
2. JSON:
   ```json
   {
     "Version": "2012-10-17",
     "Statement": [
       {
         "Sid": "SSMDeploy",
         "Effect": "Allow",
         "Action": [
           "ssm:SendCommand",
           "ssm:GetCommandInvocation"
         ],
         "Resource": "*"
       },
       {
         "Sid": "SSMParameterStore",
         "Effect": "Allow",
         "Action": [
           "ssm:GetParameter",
           "ssm:PutParameter"
         ],
         "Resource": "arn:aws:ssm:*:*:parameter/deploy/*"
       }
     ]
   }
   ```
3. **Name:** `deploy-policy`

> You should already have the access key + secret key for this user. If not: IAM → mervodeploy → Security credentials → Create access key.

---

## Step 4: SSH into EC2 and install Docker

SSH in using the key pair from Step 1:

```bash
ssh -i your-key.pem ubuntu@<EC2-PUBLIC-IP>
```

Then run:

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install Docker
curl -fsSL https://get.docker.com | sudo sh
sudo usermod -aG docker $USER

# Install Docker Compose plugin
sudo apt install -y docker-compose-plugin

# Install AWS CLI (if not pre-installed)
sudo apt install -y awscli

# Verify SSM Agent is running (pre-installed on Ubuntu 20.04+)
sudo systemctl status snap.amazon-ssm-agent.amazon-ssm-agent

# Log out and back in (so docker group takes effect)
exit
```

SSH back in:

```bash
ssh -i your-key.pem ubuntu@<EC2-PUBLIC-IP>

# Verify docker works without sudo
docker ps
```

---

## Step 5: Copy infrastructure files to EC2

From your local machine (where the repo is), copy the infra files:

```bash
# Copy infra directory
scp -i your-key.pem -r infra/ ubuntu@<EC2-PUBLIC-IP>:~/infra/

# Copy the app's docker-compose.yml
scp -i your-key.pem docker-compose.yml ubuntu@<EC2-PUBLIC-IP>:~/alphawonders/docker-compose.yml
```

---

## Step 6: Create environment files on EC2

SSH into the EC2 and create the `.env` files:

### Infra .env

```bash
nano ~/infra/.env
```

```env
PG_USER=alphawonders
PG_PASSWORD=<choose-a-strong-password>
PG_DB=alphaw
PGADMIN_EMAIL=mervin@alphawonders.com
PGADMIN_PASSWORD=<choose-a-password>
```

### App .env

```bash
mkdir -p ~/alphawonders
nano ~/alphawonders/.env
```

Copy your app's `.env` file contents here. Key values to set:

```env
CI_ENVIRONMENT = production

database.default.hostname = postgres
database.default.database = alphaw
database.default.username = alphawonders
database.default.password = <same-password-as-PG_PASSWORD-above>
database.default.DBDriver = Postgre
database.default.port = 5432
```

> The hostname is `postgres` (the container name), NOT `localhost`.

---

## Step 7: Run the setup script

Still SSH'd into the EC2:

```bash
chmod +x ~/infra/setup-ec2.sh
~/infra/setup-ec2.sh
```

The script will:
1. **Ask for your GHCR PAT** → stores it encrypted in AWS SSM Parameter Store (`/deploy/ghcr-pat`)
2. **Start PostgreSQL + Nginx proxy** (`docker compose -f docker-compose.postgres.yml up -d`)
3. **Pull and start the app** (`docker compose up -d` in ~/alphawonders)
4. **Health check** both containers
5. **Print a status table** of running containers

If everything is green, your app is running on port 80.

Quick test:

```bash
curl -H "Host: alphawonders.com" http://localhost
```

You should see HTML output.

---

## Step 8: Create ACM certificates (must be in us-east-1)

> ACM certs for CloudFront MUST be in the **us-east-1** region.

For each domain, request a certificate:

1. Go to **AWS Console → switch to us-east-1 → ACM → Request certificate**
2. **Domain names:** add both the bare domain and www:
   - `alphawonders.com` + `*.alphawonders.com`
3. **Validation:** DNS
4. Click **Request**
5. ACM gives you CNAME records for validation — add them to your DNS provider
6. Wait for status to change to **Issued** (usually 5-30 minutes)

Repeat for all 5 domains:

| Certificate | Domain names |
|-------------|-------------|
| Cert 1 | `alphawonders.com`, `*.alphawonders.com` |
| Cert 2 | `mvacant.com`, `*.mvacant.com` |
| Cert 3 | `keenile.com`, `*.keenile.com` |
| Cert 4 | `somasmart.site`, `*.somasmart.site` |
| Cert 5 | `keenile.ai`, `*.keenile.ai` |

---

## Step 9: Create CloudFront distributions

Create one CloudFront distribution per domain. For each:

1. Go to **CloudFront → Create distribution**
2. **Origin:**
   - Origin domain: `<EC2-PUBLIC-IP>` (enter as custom origin)
   - Protocol: **HTTP only**
   - Port: **80**
3. **Default cache behavior:**
   - Viewer protocol policy: **Redirect HTTP to HTTPS**
   - Allowed HTTP methods: **GET, HEAD, OPTIONS, PUT, POST, PATCH, DELETE**
   - Cache policy: **CachingDisabled**
   - Origin request policy: **AllViewer**
4. **Settings:**
   - Alternate domain names (CNAMEs): `example.com`, `www.example.com`
   - Custom SSL certificate: select the matching ACM cert from Step 8
5. Click **Create distribution**
6. Note the distribution domain (e.g. `d1234abcdef.cloudfront.net`)

Repeat for all 5 domains:

| Distribution | CNAMEs | ACM Cert |
|-------------|--------|----------|
| dist-1 | alphawonders.com, www.alphawonders.com | Cert 1 |
| dist-2 | mvacant.com, www.mvacant.com | Cert 2 |
| dist-3 | keenile.com, www.keenile.com | Cert 3 |
| dist-4 | somasmart.site, www.somasmart.site | Cert 4 |
| dist-5 | keenile.ai, www.keenile.ai | Cert 5 |

---

## Step 10: Update DNS

At your DNS provider (Namecheap, Cloudflare, Route 53, etc.), point each domain to its CloudFront distribution:

```
alphawonders.com      CNAME  →  d1234abcdef.cloudfront.net
www.alphawonders.com  CNAME  →  d1234abcdef.cloudfront.net

mvacant.com           CNAME  →  d5678ghijkl.cloudfront.net
www.mvacant.com       CNAME  →  d5678ghijkl.cloudfront.net

keenile.com           CNAME  →  d9012mnopqr.cloudfront.net
www.keenile.com       CNAME  →  d9012mnopqr.cloudfront.net

somasmart.site        CNAME  →  d3456stuvwx.cloudfront.net
www.somasmart.site    CNAME  →  d3456stuvwx.cloudfront.net

keenile.ai            CNAME  →  d7890yzabcd.cloudfront.net
www.keenile.ai        CNAME  →  d7890yzabcd.cloudfront.net
```

> If using a root/apex domain (no www), some DNS providers need an ALIAS or ANAME record instead of CNAME. Route 53 supports ALIAS records natively.

---

## Step 11: Lock down the Security Group

Now that CloudFront is in front, restrict EC2 to only accept traffic from CloudFront:

1. Go to **EC2 → Security Groups → your instance's SG → Edit inbound rules**
2. **Remove** the "HTTP from anywhere" rule
3. **Add:** HTTP (port 80) → Source: **Custom** → `com.amazonaws.global.cloudfront.origin-facing` (AWS managed prefix list)
4. **Keep or remove SSH:**
   - If you want SSH access: keep port 22 restricted to your IP
   - If using SSM exclusively: remove the SSH rule entirely
5. Save

This ensures only CloudFront can reach your EC2 on port 80. Direct IP access is blocked.

---

## Step 12: Add GitHub Actions secrets

Go to your GitHub repo → **Settings → Secrets and variables → Actions → New repository secret**

Add these 5 secrets:

| Secret name | Value | Where to get it |
|-------------|-------|-----------------|
| `AWS_ACCESS_KEY_ID` | mervodeploy's access key | IAM → mervodeploy → Security credentials |
| `AWS_SECRET_ACCESS_KEY` | mervodeploy's secret key | Same as above |
| `AWS_REGION` | e.g. `us-east-1` | The region your EC2 is in |
| `EC2_INSTANCE_ID` | e.g. `i-0abc123def456` | EC2 Console → Instances |
| `EC2_DEPLOY_HOME` | e.g. `/home/ubuntu` | Home directory of the user on EC2 |

---

## You're done!

Push to `master` and GitHub Actions will:
1. Build the Docker image
2. Push it to GHCR
3. SSM into the EC2
4. Pull the new image
5. Restart the app container
6. Health check

---

## Adding a new site later

1. **Create the nginx conf:**
   ```bash
   cp infra/nginx/conf.d/_template.conf.example infra/nginx/conf.d/newsite.conf
   # Edit: replace DOMAIN, CONTAINER, PORT
   ```

2. **Create the app's docker-compose.yml** on EC2 at `~/newsite/docker-compose.yml`
   - Container must join `shared-services` network
   - Use `expose` not `ports`

3. **Create ACM cert** in us-east-1 for the new domain

4. **Create CloudFront distribution** pointing to EC2:80

5. **Update DNS** to point to the new CloudFront distribution

6. **Copy the new nginx conf to EC2** and reload:
   ```bash
   scp newsite.conf ubuntu@<EC2-IP>:~/infra/nginx/conf.d/
   ssh ubuntu@<EC2-IP> "docker exec nginx-proxy nginx -s reload"
   ```

---

## Troubleshooting

**App not reachable via domain:**
```bash
# Check nginx is routing correctly
docker exec nginx-proxy nginx -t
docker logs nginx-proxy

# Check app is running
docker ps
docker logs alphawonders-app
```

**502 Bad Gateway:**
- The app container isn't running or isn't on the `shared-services` network
```bash
docker network inspect shared-services
```

**CloudFront returns 503:**
- EC2 security group isn't allowing CloudFront prefix list
- Or the EC2/nginx isn't listening on port 80

**SSM command fails:**
- Check EC2 instance role has `AmazonSSMManagedInstanceCore`
- Check SSM Agent is running: `sudo systemctl status snap.amazon-ssm-agent.amazon-ssm-agent`
- Check mervodeploy has `ssm:SendCommand` permission

**Database connection refused:**
- App `.env` hostname should be `postgres` (container name), not `localhost`
- Check postgres container is healthy: `docker inspect postgres --format='{{.State.Health.Status}}'`
