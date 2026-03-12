#!/bin/bash
set -e

# Install dependencies if vendor/ is missing (e.g. source code volume mount)
if [ ! -d "/var/www/html/vendor" ] || [ ! -f "/var/www/html/vendor/autoload.php" ]; then
    echo "vendor/ not found, running composer install..."
    cd /var/www/html && composer install --no-interaction --no-dev --optimize-autoloader
fi

# Ensure writable subdirectories exist (volume mount may start empty)
mkdir -p /var/www/html/writable/cache
mkdir -p /var/www/html/writable/logs
mkdir -p /var/www/html/writable/session
mkdir -p /var/www/html/writable/uploads
mkdir -p /var/www/html/writable/debugbar

chown -R www-data:www-data /var/www/html/writable 2>/dev/null || true
chmod -R 775 /var/www/html/writable 2>/dev/null || true

# Ensure uploads directory exists (persisted via Docker volume)
mkdir -p /var/www/html/public/uploads/blog
chown -R www-data:www-data /var/www/html/public/uploads 2>/dev/null || true
chmod -R 775 /var/www/html/public/uploads 2>/dev/null || true

# Run database migrations (idempotent — safe on every boot)
echo "Running database migrations..."
echo "── Migration files in image ──"
ls -1 /var/www/html/app/Database/Migrations/ 2>/dev/null || echo "WARNING: Migrations directory not found!"
echo "── Running migrate --all ──"
cd /var/www/html && php spark migrate --all 2>&1 || echo "Warning: migration failed (DB may not be ready yet)"
echo "── Migration status ──"
cd /var/www/html && php spark migrate:status 2>&1 || echo "Warning: migrate:status failed"

exec "$@"
