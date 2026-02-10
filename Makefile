.PHONY: dev dev-build dev-up dev-down dev-logs dev-ps dev-shell \
       prod prod-down prod-logs prod-ps \
       db-init db-shell db-tables \
       build clean help

# ---------------------------------------------------------------------------
# Development
# ---------------------------------------------------------------------------

dev: dev-build dev-up ## Build and start local dev environment

dev-build: ## Build dev Docker image
	docker compose -f docker-compose.dev.yml build

dev-up: ## Start dev containers
	docker compose -f docker-compose.dev.yml up -d

dev-down: ## Stop dev containers
	docker compose -f docker-compose.dev.yml down

dev-logs: ## Tail dev container logs
	docker compose -f docker-compose.dev.yml logs -f

dev-ps: ## Show dev container status
	docker compose -f docker-compose.dev.yml ps

dev-shell: ## Open a shell inside the app container
	docker exec -it alphawonders-app bash

dev-restart: ## Restart the app container (no rebuild)
	docker compose -f docker-compose.dev.yml restart app

dev-rebuild: dev-down dev-build dev-up ## Full rebuild and restart

# ---------------------------------------------------------------------------
# Production (EC2 — pulls pre-built image from GHCR)
# ---------------------------------------------------------------------------

prod: ## Start production containers (requires GHCR image)
	docker compose up -d

prod-down: ## Stop production containers
	docker compose down

prod-logs: ## Tail production container logs
	docker compose logs -f

prod-ps: ## Show production container status
	docker compose ps

# ---------------------------------------------------------------------------
# Database
# ---------------------------------------------------------------------------

db-init: ## Load PostgreSQL schema into the database
	docker exec -i postgres psql -U mervo -d alphaw < scripts/mysql_to_postgres.sql

db-shell: ## Open psql shell
	docker exec -it postgres psql -U mervo -d alphaw

db-tables: ## List all tables in the database
	docker exec postgres psql -U mervo -d alphaw -c "\dt"

# ---------------------------------------------------------------------------
# Docker utilities
# ---------------------------------------------------------------------------

build: ## Build the Docker image (no cache)
	docker compose -f docker-compose.dev.yml build --no-cache

clean: ## Remove containers, volumes, and images
	docker compose -f docker-compose.dev.yml down -v --rmi local
	docker compose down -v --rmi local

# ---------------------------------------------------------------------------
# Help
# ---------------------------------------------------------------------------

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | \
		awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

.DEFAULT_GOAL := help
