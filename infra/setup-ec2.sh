#!/bin/bash
# ──────────────────────────────────────────────────────────────
# EC2 Setup — DEPRECATED
#
# Use the GitHub Actions workflow instead:
#   Actions → "Setup New EC2 Server" → Run workflow
#
# That workflow handles everything:
#   1. Stores secrets in SSM Parameter Store
#   2. Installs Docker
#   3. Transfers infra files (nginx, docker-compose)
#   4. Starts PostgreSQL + Nginx + App
#
# No SSH, no SCP, no manual .env files needed.
# ──────────────────────────────────────────────────────────────
echo "This script is deprecated."
echo "Use: GitHub Actions → 'Setup New EC2 Server' → Run workflow"
exit 1
