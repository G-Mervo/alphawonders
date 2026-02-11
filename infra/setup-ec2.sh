#!/bin/bash
# ──────────────────────────────────────────────────────────────
# EC2 First-Time Setup Script
#
# Architecture:
#   CloudFront (ACM SSL) → EC2:80 → nginx-proxy → app containers
#                                  → postgres (shared DB)
#
# Deploy via: GitHub Actions → AWS SSM (no SSH keys needed)
# Auth:       IAM user (mervodeploy) access key + secret key
#
# Prerequisites:
#   - Docker + Docker Compose v2 installed
#   - SSM Agent running (pre-installed on Amazon Linux 2 / Ubuntu 20.04+)
#   - EC2 instance role with AmazonSSMManagedInstanceCore policy
#   - ~/infra/.env     (from infra/.env.example)
#   - ~/infra/nginx/   (from repo's infra/nginx/)
#   - ~/infra/docker-compose.postgres.yml
#   - ~/alphawonders/.env (from .env.example)
#   - ~/alphawonders/docker-compose.yml
#
# Usage:
#   chmod +x setup-ec2.sh && ./setup-ec2.sh
# ──────────────────────────────────────────────────────────────
set -euo pipefail

INFRA_DIR="$HOME/infra"

echo "=== EC2 Setup ==="
echo ""

# ── Pre-flight checks ──
for f in "$INFRA_DIR/.env" "$INFRA_DIR/docker-compose.postgres.yml" "$INFRA_DIR/nginx/nginx.conf"; do
    if [ ! -f "$f" ]; then
        echo "ERROR: $f not found."
        exit 1
    fi
done

if [ ! -f "$HOME/alphawonders/.env" ]; then
    echo "ERROR: ~/alphawonders/.env not found."
    exit 1
fi

# ── Step 1: Store GHCR PAT in SSM Parameter Store ──
echo "── Step 1: GHCR authentication ──"
if aws ssm get-parameter --name /deploy/ghcr-pat --with-decryption >/dev/null 2>&1; then
    echo "GHCR PAT already stored in SSM Parameter Store."
else
    echo "Enter your GitHub Personal Access Token (needs read:packages scope):"
    read -rs GHCR_PAT
    if [ -z "$GHCR_PAT" ]; then
        echo "WARNING: No GHCR PAT provided. Docker pulls from private GHCR repos will fail."
    else
        aws ssm put-parameter \
            --name /deploy/ghcr-pat \
            --type SecureString \
            --value "$GHCR_PAT" \
            --description "GitHub Container Registry PAT for docker pull" \
            --overwrite
        echo "GHCR PAT stored in SSM Parameter Store (/deploy/ghcr-pat)"
    fi
fi

# ── Step 2: Start infra (PostgreSQL + Nginx) ──
echo ""
echo "── Step 2: Starting infrastructure ──"
cd "$INFRA_DIR"
docker compose -f docker-compose.postgres.yml up -d

echo "Waiting for PostgreSQL..."
for i in $(seq 1 30); do
    if docker inspect --format='{{.State.Health.Status}}' postgres 2>/dev/null | grep -q "healthy"; then
        echo "PostgreSQL is healthy!"
        break
    fi
    [ "$i" -eq 30 ] && { echo "ERROR: PostgreSQL timeout"; docker logs --tail 10 postgres; exit 1; }
    sleep 3
done

echo "Nginx proxy started."

# ── Step 3: Start app ──
echo ""
echo "── Step 3: Starting Alphawonders ──"

# Login to GHCR for the initial pull
GHCR_PAT=$(aws ssm get-parameter --name /deploy/ghcr-pat --with-decryption --query Parameter.Value --output text 2>/dev/null || echo "")
if [ -n "$GHCR_PAT" ]; then
    echo "$GHCR_PAT" | docker login ghcr.io -u deploy --password-stdin
fi

cd "$HOME/alphawonders"
docker compose up -d

echo "Waiting for app..."
for i in $(seq 1 30); do
    if docker inspect --format='{{.State.Health.Status}}' alphawonders-app 2>/dev/null | grep -q "healthy"; then
        echo "App is healthy!"
        break
    fi
    [ "$i" -eq 30 ] && { echo "WARNING: timeout"; docker logs --tail 20 alphawonders-app; }
    sleep 5
done

# ── Verify ──
echo ""
docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"
echo ""
echo "=== EC2 setup done! ==="
echo ""
echo "AWS setup checklist:"
echo ""
echo "  1. IAM (mervodeploy user):"
echo "     - Create access key → store as GitHub Actions secrets"
echo "     - Policy: ssm:SendCommand, ssm:GetCommandInvocation on this instance"
echo "     - Policy: ssm:GetParameter on /deploy/* (for GHCR PAT)"
echo ""
echo "  2. EC2 instance role:"
echo "     - Attach AmazonSSMManagedInstanceCore policy (for SSM agent)"
echo "     - Attach policy allowing ssm:GetParameter on /deploy/*"
echo ""
echo "  3. ACM (must be in us-east-1 for CloudFront):"
echo "     - Request certificate: alphawonders.com + *.alphawonders.com"
echo "     - Validate via DNS"
echo ""
echo "  4. CloudFront distribution:"
echo "     - Origin: http://<EC2-public-IP> (HTTP only, port 80)"
echo "     - Viewer protocol: Redirect HTTP to HTTPS"
echo "     - Allowed methods: GET, HEAD, OPTIONS, PUT, POST, PATCH, DELETE"
echo "     - Cache policy: CachingDisabled (dynamic site)"
echo "     - Origin request policy: AllViewer"
echo "     - Alternate domains: alphawonders.com, www.alphawonders.com"
echo "     - SSL certificate: select ACM cert"
echo ""
echo "  5. DNS:"
echo "     - alphawonders.com     → CNAME → <dist-id>.cloudfront.net"
echo "     - www.alphawonders.com → CNAME → <dist-id>.cloudfront.net"
echo ""
echo "  6. EC2 Security Group:"
echo "     - Inbound 80: CloudFront prefix list (com.amazonaws.global.cloudfront.origin-facing)"
echo "     - Inbound 22: your IP only (or remove if using SSM exclusively)"
echo ""
echo "  7. GitHub Actions secrets (repo > Settings > Secrets):"
echo "     - AWS_ACCESS_KEY_ID      (mervodeploy access key)"
echo "     - AWS_SECRET_ACCESS_KEY  (mervodeploy secret key)"
echo "     - AWS_REGION             (e.g. us-east-1)"
echo "     - EC2_INSTANCE_ID        (e.g. i-0abc123def456)"
echo "     - EC2_DEPLOY_HOME        (e.g. /home/ubuntu)"
