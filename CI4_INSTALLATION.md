# CodeIgniter 4 Installation Instructions

## Current Status
✅ Frontend modernized (Bootstrap 5, Font Awesome 6)
✅ CI4-compatible controllers created in `app/Controllers/`
✅ CI4-compatible models created in `app/Models/`
✅ Routes configured in `app/Config/Routes.php`
✅ Database config created in `app/Config/Database.php`

## Next Steps to Complete CI4 Migration

### 1. Install CodeIgniter 4 Framework

You need to download and install the CodeIgniter 4 framework. Choose one method:

#### Option A: Using Composer (Recommended)
```bash
cd /var/www/alphawonders.com/html
composer require codeigniter4/framework:^4.4
```

#### Option B: Manual Download
1. Download CI4 from: https://github.com/codeigniter4/framework/releases
2. Extract the framework files
3. Copy `system/` folder to `vendor/codeigniter4/framework/system/`

### 2. Create Public Directory Structure

```bash
# Move index.php to public/
cp index.php public/index.php

# Update public/index.php to point to CI4 paths
# Update paths in public/index.php:
# - $pathsPath = FCPATH . '../vendor/codeigniter4/framework/app/Config/Paths.php';
# - $systemDirectory = FCPATH . '../vendor/codeigniter4/framework/system';
```

### 3. Update .htaccess

Create/update `.htaccess` in public directory:
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```

### 4. Set Permissions

```bash
chmod -R 775 writable/
chown -R www-data:www-data writable/
```

### 5. Environment Configuration

Create `.env` file in root:
```ini
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------
CI_ENVIRONMENT = production

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------
app.baseURL = 'https://alphawonders.com/'
app.forceGlobalSecureRequests = true

#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------
database.default.hostname = localhost
database.default.database = alphaw
database.default.username = mervo
database.default.password = '$Tpr09!dKQ-2.0/4(UwZC*7'
database.default.DBDriver = MySQLi
```

### 6. Update Web Server Configuration

Point your web server document root to `/var/www/alphawonders.com/html/public/`

For Apache, update VirtualHost:
```apache
<VirtualHost *:80>
    ServerName alphawonders.com
    DocumentRoot /var/www/alphawonders.com/html/public
    
    <Directory /var/www/alphawonders.com/html/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 7. Migrate Views

Views are already in `application/views/` - they should work with CI4.
You may want to copy them to `app/Views/` for consistency:
```bash
cp -r application/views/* app/Views/
```

### 8. Test the Application

1. Visit https://alphawonders.com/
2. Test all routes
3. Check form submissions
4. Verify database connections

## Migration Checklist

- [x] Create CI4 directory structure
- [x] Migrate controllers to CI4 format
- [x] Migrate models to CI4 format
- [x] Create Routes.php
- [x] Create Database.php config
- [ ] Install CI4 framework files
- [ ] Update public/index.php
- [ ] Configure .htaccess
- [ ] Set file permissions
- [ ] Create .env file
- [ ] Update web server config
- [ ] Test all functionality
- [ ] Update composer.json dependencies

## Rollback Plan

If issues occur, the original CI3 codebase is still intact in:
- `application/` directory (original CI3 code)
- `system/` directory (CI3 framework)

Simply point web server back to root directory and revert index.php if needed.

## Support

For CI4 migration issues, refer to:
- Official Guide: https://codeigniter.com/user_guide/
- Migration Guide: https://codeigniter.com/user_guide/installation/upgrade_400.html


