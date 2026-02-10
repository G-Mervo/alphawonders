FROM php:8.1-fpm AS base

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    && docker-php-ext-install \
        pdo_pgsql \
        pgsql \
        intl \
        mbstring \
        zip \
        opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first for better layer caching
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev)
RUN composer install --no-dev --no-scripts --no-interaction --optimize-autoloader

# Copy application code
COPY . .

# Re-run composer scripts after full copy
RUN composer dump-autoload --optimize --no-dev

# Set permissions for writable directory
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 775 /var/www/html/writable

# Ensure attachments directory exists with correct permissions
RUN mkdir -p /var/www/html/attachments \
    && chown -R www-data:www-data /var/www/html/attachments \
    && chmod -R 775 /var/www/html/attachments

# Copy Nginx configuration
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Copy Supervisor configuration
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy PHP-FPM configuration
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Copy PHP configuration
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Copy and set entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Install curl for healthcheck
RUN apt-get update && apt-get install -y curl && apt-get clean && rm -rf /var/lib/apt/lists/*

EXPOSE 8080

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
