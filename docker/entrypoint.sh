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

exec "$@"
