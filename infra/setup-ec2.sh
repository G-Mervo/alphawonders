#!/bin/bash
# ──────────────────────────────────────────────────────────────
# EC2 First-Time Setup Script
# Run once on a fresh EC2 instance to bootstrap the full stack.
#
# Prerequisites:
#   - Docker + Docker Compose installed
#   - ~/infra/.env created from infra/.env.example
#   - ~/alphawonders/.env created from .env.example
#
# Usage:
#   chmod +x setup-ec2.sh
#   ./setup-ec2.sh
# ──────────────────────────────────────────────────────────────
set -euo pipefail

echo "=== Alphawonders EC2 Setup ==="

# ── 1. Start independent PostgreSQL stack ──
echo ""
echo "── Step 1: Starting PostgreSQL stack ──"

if [ ! -f "$HOME/infra/.env" ]; then
    echo "ERROR: ~/infra/.env not found."
    echo "Copy infra/.env.example to ~/infra/.env and fill in your credentials."
    exit 1
fi

cd ~/infra

# Create the shared network + start postgres & pgadmin
docker compose -f docker-compose.postgres.yml up -d

echo "Waiting for PostgreSQL to become healthy..."
for i in $(seq 1 30); do
    if docker inspect --format='{{.State.Health.Status}}' postgres 2>/dev/null | grep -q "healthy"; then
        echo "PostgreSQL is healthy!"
        break
    fi
    if [ "$i" -eq 30 ]; then
        echo "ERROR: PostgreSQL failed to become healthy within 90 seconds."
        docker logs --tail 20 postgres
        exit 1
    fi
    echo "  attempt $i/30..."
    sleep 3
done

# ── 2. Start application ──
echo ""
echo "── Step 2: Starting Alphawonders app ──"

if [ ! -f "$HOME/alphawonders/.env" ]; then
    echo "ERROR: ~/alphawonders/.env not found."
    echo "Copy .env.example to ~/alphawonders/.env and fill in your credentials."
    exit 1
fi

cd ~/alphawonders

# Pull and start (entrypoint.sh will run migrations automatically)
docker compose up -d

echo "Waiting for app to become healthy..."
for i in $(seq 1 30); do
    if docker inspect --format='{{.State.Health.Status}}' alphawonders-app 2>/dev/null | grep -q "healthy"; then
        echo "App is healthy!"
        break
    fi
    if [ "$i" -eq 30 ]; then
        echo "WARNING: App did not become healthy within timeout."
        docker logs --tail 30 alphawonders-app
    fi
    echo "  attempt $i/30..."
    sleep 5
done

# ── 3. Verify ──
echo ""
echo "── Step 3: Verification ──"
echo ""
docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"
echo ""
echo "=== Setup complete! ==="
echo ""
echo "Services:"
echo "  App:     http://$(curl -s ifconfig.me):8080"
echo "  pgAdmin: http://localhost:5050 (SSH tunnel required)"
echo ""
echo "Next steps:"
echo "  1. Point your domain DNS to this server's IP"
echo "  2. Set up a reverse proxy (Nginx/Caddy) with SSL for port 443 -> 8080"
echo "  3. Configure GitHub Actions secrets: EC2_HOST, EC2_USER, EC2_SSH_KEY, GHCR_PAT"
