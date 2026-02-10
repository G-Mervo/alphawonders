#!/bin/bash
# ──────────────────────────────────────────────────────────────
# EC2 First-Time Setup Script
#
# Architecture:
#   CloudFront (ACM SSL) → EC2:80 → nginx-proxy → app containers
#                                  → postgres (shared DB)
#
# Prerequisites:
#   - Docker + Docker Compose v2 installed
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

# ── Step 1: Start infra (PostgreSQL + Nginx) ──
echo "── Step 1: Starting infrastructure ──"
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

# ── Step 2: Start app ──
echo ""
echo "── Step 2: Starting Alphawonders ──"
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
echo "AWS setup (one-time):"
echo ""
echo "  1. ACM (must be in us-east-1 for CloudFront):"
echo "     - Request public certificate for alphawonders.com + *.alphawonders.com"
echo "     - Validate via DNS (add the CNAME records ACM gives you)"
echo ""
echo "  2. CloudFront distribution:"
echo "     - Origin: http://<EC2-public-IP>  (HTTP only, port 80)"
echo "     - Origin protocol: HTTP only"
echo "     - Viewer protocol: Redirect HTTP to HTTPS"
echo "     - Allowed HTTP methods: GET, HEAD, OPTIONS, PUT, POST, PATCH, DELETE"
echo "     - Cache policy: CachingDisabled (or custom — dynamic site)"
echo "     - Origin request policy: AllViewer (forwards Host, cookies, query strings)"
echo "     - Alternate domain names (CNAMEs): alphawonders.com, www.alphawonders.com"
echo "     - Custom SSL certificate: select the ACM cert from step 1"
echo ""
echo "  3. DNS (Route 53 or registrar):"
echo "     - alphawonders.com     → ALIAS/CNAME → <cloudfront-distribution>.cloudfront.net"
echo "     - www.alphawonders.com → ALIAS/CNAME → <cloudfront-distribution>.cloudfront.net"
echo ""
echo "  4. EC2 Security Group:"
echo "     - Allow inbound port 80 from CloudFront managed prefix list"
echo "       (com.amazonaws.global.cloudfront.origin-facing)"
echo "     - Allow inbound port 22 from your IP only"
echo ""
echo "  5. GitHub Actions secrets (repo Settings > Secrets):"
echo "     - EC2_HOST, EC2_USER, EC2_SSH_KEY, GHCR_PAT"
echo ""
echo "To add another domain:"
echo "  1. cp ~/infra/nginx/conf.d/_template.conf.example ~/infra/nginx/conf.d/newdomain.conf"
echo "  2. Edit domain, container, port"
echo "  3. Add domain to CloudFront alt names + ACM cert (or new cert + distribution)"
echo "  4. docker exec nginx-proxy nginx -s reload"
