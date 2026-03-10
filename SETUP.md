# Setup Instructions

## Prerequisites

- Docker & Docker Compose
- Git

## Development Setup

### 1. Clone the repository

```bash
git clone git@github.com:G-Mervo/alphawonders.git
cd alphawonders
```

### 2. Start the dev environment

```bash
docker compose -f docker-compose.dev.yml up --build
```

This starts three containers:
- **alphawonders-app** — PHP 8.4-FPM + nginx on port `8080`
- **postgres** — PostgreSQL 18 on port `5432`
- **pgadmin** — pgAdmin on port `5050` (admin@alphawonders.com / admin)

### 3. Access the site

- Website: http://localhost:8080
- pgAdmin: http://localhost:5050

### 4. Run database migrations

```bash
docker exec -it alphawonders-app php spark migrate
```

## Production Setup

### 1. Configure environment

```bash
cp .env.example .env
# Edit .env with production values:
#   - Database credentials
#   - SMTP settings
#   - APP_BASE_URL
```

### 2. Ensure the shared Docker network exists

```bash
docker network create shared-services
```

The production compose file expects a PostgreSQL container and an nginx-proxy already running on the `shared-services` network.

### 3. Deploy

```bash
docker compose up -d
```

The production image is pulled from `ghcr.io/g-mervo/alphawonders:latest`.

### 4. Run migrations

```bash
docker exec -it alphawonders-app php spark migrate
```

## Environment Variables

| Variable | Description | Example |
|----------|-------------|---------|
| `APP_BASE_URL` | Full site URL | `https://alphawonders.com/` |
| `DB_DATABASE` | PostgreSQL database name | `alphaw` |
| `DB_USERNAME` | PostgreSQL username | `alphaw_user` |
| `DB_PASSWORD` | PostgreSQL password | (set a strong password) |
| `SMTP_HOST` | SMTP server | `smtp.gmail.com` |
| `SMTP_USER` | SMTP username/email | `noreply@alphawonders.com` |
| `SMTP_PASS` | SMTP password | (app password) |
| `SMTP_PORT` | SMTP port | `587` |
| `SMTP_CRYPTO` | SMTP encryption | `tls` |
| `SMTP_FROM_EMAIL` | Sender email address | `noreply@alphawonders.com` |
| `SMTP_FROM_NAME` | Sender display name | `Alphawonders` |

## Useful Commands

```bash
# View logs
docker logs -f alphawonders-app

# Run a spark command
docker exec -it alphawonders-app php spark <command>

# Clear cache
docker exec -it alphawonders-app php spark cache:clear

# Check migration status
docker exec -it alphawonders-app php spark migrate:status

# Enter the container shell
docker exec -it alphawonders-app bash
```

## Directory Permissions

Inside the container, the `writable/` directory must be writable by `www-data`. This is handled automatically by the Dockerfile and entrypoint script. If you encounter permission issues:

```bash
docker exec -it alphawonders-app chown -R www-data:www-data /var/www/html/writable
docker exec -it alphawonders-app chmod -R 775 /var/www/html/writable
```
