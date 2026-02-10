#!/bin/bash
# ──────────────────────────────────────────────────────────────
# EC2 First-Time Setup Script
# Bootstraps the full multi-domain stack:
#   1. Shared PostgreSQL + pgAdmin + Nginx reverse proxy
#   2. Alphawonders app
#
# SSL is handled by AWS ALB + ACM (not on this instance).
#
# Prerequisites:
#   - Docker + Docker Compose v2 installed
#   - ~/infra/.env     created from infra/.env.example
#   - ~/infra/nginx/   copied from repo's infra/nginx/
#   - ~/infra/docker-compose.postgres.yml from repo
#   - ~/alphawonders/.env  created from .env.example
#   - ~/alphawonders/docker-compose.yml from repo
#   - AWS ALB pointing to this instance on port 80
#   - ACM certificate attached to the ALB listener (443)
#
# Usage:
#   chmod +x setup-ec2.sh && ./setup-ec2.sh
# ──────────────────────────────────────────────────────────────
set -euo pipefail

INFRA_DIR="$HOME/infra"

echo "=== EC2 Multi-Domain Stack Setup ==="
echo ""

# ── Pre-flight checks ──
for f in "$INFRA_DIR/.env" "$INFRA_DIR/docker-compose.postgres.yml" "$INFRA_DIR/nginx/nginx.conf"; do
    if [ ! -f "$f" ]; then
        echo "ERROR: $f not found. Copy the infra/ directory from the repo first."
        exit 1
    fi
done

if [ ! -f "$HOME/alphawonders/.env" ]; then
    echo "ERROR: ~/alphawonders/.env not found."
    echo "Copy .env.example to ~/alphawonders/.env and fill in your credentials."
    exit 1
fi

# ── Step 1: Start infrastructure (PostgreSQL + Nginx) ──
echo "── Step 1: Starting infrastructure stack ──"
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

# ── Step 2: Start Alphawonders app ──
echo ""
echo "── Step 2: Starting Alphawonders app ──"
cd "$HOME/alphawonders"
docker compose up -d

echo "Waiting for app health check..."
for i in $(seq 1 30); do
    if docker inspect --format='{{.State.Health.Status}}' alphawonders-app 2>/dev/null | grep -q "healthy"; then
        echo "App is healthy!"
        break
    fi
    [ "$i" -eq 30 ] && { echo "WARNING: App health check timeout."; docker logs --tail 20 alphawonders-app; }
    sleep 5
done

# ── Step 3: Verify ──
echo ""
echo "── Step 3: Verification ──"
echo ""
docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"
echo ""
echo "=== Setup complete! ==="
echo ""
echo "Architecture:"
echo "  Internet -> ALB (443/SSL via ACM) -> EC2:80 -> nginx-proxy -> app containers"
echo ""
echo "AWS setup needed:"
echo "  1. Request ACM certificate for your domain(s)"
echo "  2. Create ALB with HTTPS:443 listener using the ACM cert"
echo "  3. ALB target group -> this EC2 instance on port 80"
echo "  4. ALB HTTP:80 listener -> redirect to HTTPS:443"
echo "  5. Security group: ALB allows 80+443 from internet, EC2 allows 80 from ALB only"
echo "  6. Point DNS (Route 53 or registrar) to the ALB DNS name"
echo ""
echo "To add another domain/site:"
echo "  1. Copy infra/nginx/conf.d/_template.conf.example to newsite.conf"
echo "  2. Edit the domain, container name, and port"
echo "  3. Add domain to ALB + ACM cert (or request new cert)"
echo "  4. Reload: docker exec nginx-proxy nginx -s reload"
echo ""
echo "GitHub Actions secrets:"
echo "  EC2_HOST, EC2_USER, EC2_SSH_KEY, GHCR_PAT"
