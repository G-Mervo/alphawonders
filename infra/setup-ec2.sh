#!/bin/bash
# ──────────────────────────────────────────────────────────────
# EC2 First-Time Setup Script
#
# Architecture:
#   CloudFront (ACM SSL) → EC2:80 → nginx-proxy → app containers
#                                  → postgres (shared DB)
#
# All secrets stored in AWS SSM Parameter Store (SecureString).
# No .env files needed — secrets are fetched at runtime.
#
# Deploy via: GitHub Actions → AWS SSM (no SSH keys needed)
# Auth:       IAM user (mervodeploy) access key + secret key
#
# Prerequisites:
#   - Docker + Docker Compose v2 installed
#   - SSM Agent running (pre-installed on Amazon Linux 2023)
#   - EC2 instance role with AmazonSSMManagedInstanceCore + /deploy/* read
#   - ~/infra/nginx/   (from repo's infra/nginx/)
#   - ~/infra/docker-compose.postgres.yml
#   - ~/alphawonders/docker-compose.yml
#
# Usage:
#   chmod +x setup-ec2.sh && ./setup-ec2.sh
# ──────────────────────────────────────────────────────────────
set -euo pipefail

INFRA_DIR="$HOME/infra"
REGION=$(curl -s http://169.254.169.254/latest/meta-data/placement/region)

echo "=== EC2 Setup (region: $REGION) ==="
echo ""

# ── Pre-flight checks ──
for f in "$INFRA_DIR/docker-compose.postgres.yml" "$INFRA_DIR/nginx/nginx.conf"; do
    if [ ! -f "$f" ]; then
        echo "ERROR: $f not found."
        exit 1
    fi
done

if [ ! -f "$HOME/alphawonders/docker-compose.yml" ]; then
    echo "ERROR: ~/alphawonders/docker-compose.yml not found."
    exit 1
fi

# ── Helper: store a parameter if not already set ──
store_param() {
    local name="$1"
    local description="$2"
    local default="$3"
    local is_secret="${4:-true}"

    if aws ssm get-parameter --name "$name" --region "$REGION" >/dev/null 2>&1; then
        echo "  $name — already set"
    else
        if [ "$is_secret" = "true" ]; then
            echo -n "  Enter value for $name ($description): "
            read -rs value
            echo ""
        else
            echo -n "  Enter value for $name ($description) [${default}]: "
            read -r value
        fi
        value="${value:-$default}"

        if [ -z "$value" ]; then
            echo "  WARNING: skipped $name (empty)"
            return
        fi

        local param_type="SecureString"
        [ "$is_secret" = "false" ] && param_type="String"

        aws ssm put-parameter \
            --name "$name" \
            --type "$param_type" \
            --value "$value" \
            --description "$description" \
            --region "$REGION" \
            --overwrite
        echo "  $name — stored"
    fi
}

# ── Helper: fetch a parameter ──
get_param() {
    aws ssm get-parameter \
        --name "$1" \
        --with-decryption \
        --query Parameter.Value \
        --output text \
        --region "$REGION" 2>/dev/null || echo "${2:-}"
}

# ── Step 1: Store secrets in Parameter Store ──
echo "── Step 1: Configuring secrets in SSM Parameter Store ──"
echo ""
echo "  (Press Enter to keep defaults. Secrets are typed blind.)"
echo ""

store_param "/deploy/ghcr-pat"         "GHCR PAT (read:packages scope)"    ""            true
store_param "/deploy/pg-user"          "PostgreSQL username"                "alphawonders" false
store_param "/deploy/pg-password"      "PostgreSQL password"                ""            true
store_param "/deploy/pg-db"            "PostgreSQL database name"           "alphaw"      false
store_param "/deploy/pgadmin-email"    "pgAdmin admin email"                "mervin@alphawonders.com" false
store_param "/deploy/pgadmin-password" "pgAdmin admin password"             ""            true

echo ""

# ── Step 2: Fetch secrets and start infra ──
echo "── Step 2: Starting infrastructure ──"

export PG_USER=$(get_param "/deploy/pg-user" "alphawonders")
export PG_PASSWORD=$(get_param "/deploy/pg-password")
export PG_DB=$(get_param "/deploy/pg-db" "alphaw")
export PGADMIN_EMAIL=$(get_param "/deploy/pgadmin-email" "admin@alphawonders.com")
export PGADMIN_PASSWORD=$(get_param "/deploy/pgadmin-password" "changeme")

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

# Login to GHCR
GHCR_PAT=$(get_param "/deploy/ghcr-pat")
if [ -n "$GHCR_PAT" ]; then
    echo "$GHCR_PAT" | docker login ghcr.io -u deploy --password-stdin
fi

# Export app env vars from Parameter Store
export DB_USERNAME="$PG_USER"
export DB_PASSWORD="$PG_PASSWORD"
export DB_DATABASE="$PG_DB"

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
