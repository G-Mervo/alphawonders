# Final Setup Instructions

## Quick Start Guide

Follow these steps to complete the CodeIgniter 4 migration:

### Step 1: Install CodeIgniter 4 Framework

You have two options:

#### Option A: Using Composer (Recommended)
```bash
cd /var/www/alphawonders.com/html
composer install
```

If composer is not installed:
```bash
# Install composer first
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

#### Option B: Manual Download
1. Download CI4 from: https://github.com/codeigniter4/framework/archive/refs/tags/v4.4.7.zip
2. Extract and copy `system/` folder to `vendor/codeigniter4/framework/system/`
3. Copy `app/Config/Paths.php` from CI4 to `vendor/codeigniter4/framework/app/Config/Paths.php`

### Step 2: Set File Permissions

```bash
cd /var/www/alphawonders.com/html
chmod -R 775 writable/
chown -R www-data:www-data writable/
```

### Step 3: Create Environment File

```bash
cp .env.example .env
```

Edit `.env` and update:
- Database credentials
- Base URL
- Environment (production/development)

### Step 4: Update Web Server Configuration

#### Apache Configuration

Update your VirtualHost to point to the `public/` directory:

```apache
<VirtualHost *:80>
    ServerName alphawonders.com
    ServerAlias www.alphawonders.com
    DocumentRoot /var/www/alphawonders.com/html/public
    
    <Directory /var/www/alphawonders.com/html/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    # Redirect to HTTPS (recommended)
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</VirtualHost>

<VirtualHost *:443>
    ServerName alphawonders.com
    ServerAlias www.alphawonders.com
    DocumentRoot /var/www/alphawonders.com/html/public
    
    <Directory /var/www/alphawonders.com/html/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    # SSL Configuration
    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key
</VirtualHost>
```

#### Nginx Configuration

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name alphawonders.com www.alphawonders.com;
    
    # Redirect to HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name alphawonders.com www.alphawonders.com;
    
    root /var/www/alphawonders.com/html/public;
    index index.php index.html;
    
    # SSL Configuration
    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\. {
        deny all;
    }
}
```

### Step 5: Restart Web Server

```bash
# Apache
sudo systemctl restart apache2

# Nginx
sudo systemctl restart nginx
```

### Step 6: Test the Application

1. Visit https://alphawonders.com/
2. Check that the homepage loads correctly
3. Test navigation links
4. Test contact form submission
5. Test blog functionality
6. Check error logs: `tail -f writable/logs/log-*.log`

### Step 7: Verify Database Connection

Create a test script or check logs to ensure database connectivity is working.

## Troubleshooting

### Issue: 404 Errors
- Check that `.htaccess` is in `public/` directory
- Verify mod_rewrite is enabled: `sudo a2enmod rewrite`
- Check web server points to `public/` directory

### Issue: Permission Denied
```bash
chmod -R 775 writable/
chown -R www-data:www-data writable/
```

### Issue: Database Connection Failed
- Verify credentials in `.env` file
- Check database server is running
- Test connection: `mysql -u mervo -p alphaw`

### Issue: Views Not Found
- Ensure views are in `app/Views/` directory
- Check view paths in `app/Config/Paths.php`

### Issue: Assets Not Loading
- Verify `base_url()` helper is working
- Check asset paths in views
- Ensure assets directory is accessible

## Migration Checklist

- [ ] CI4 framework installed
- [ ] File permissions set
- [ ] `.env` file created and configured
- [ ] Web server configured to point to `public/`
- [ ] `.htaccess` file in place
- [ ] Views copied to `app/Views/`
- [ ] Database connection tested
- [ ] All routes working
- [ ] Forms submitting correctly
- [ ] Error logging working

## Rollback Plan

If you need to rollback to CI3:

1. Point web server back to root directory
2. Original CI3 code is in `application/` directory
3. Original `index.php` should still work
4. All original functionality preserved

## Support

- CodeIgniter 4 Documentation: https://codeigniter.com/user_guide/
- Migration Guide: https://codeigniter.com/user_guide/installation/upgrade_400.html
- Community Forum: https://forum.codeigniter.com/

