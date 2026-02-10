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

chown -R www-data:www-data /var/www/html/writable
chmod -R 775 /var/www/html/writable

# Ensure attachments directory exists
mkdir -p /var/www/html/attachments
chown -R www-data:www-data /var/www/html/attachments

# Run database migrations (idempotent — safe on every boot)
echo "Running database migrations..."
cd /var/www/html && php spark migrate --all 2>&1 || echo "Warning: migration failed (DB may not be ready yet)"

exec "$@"
