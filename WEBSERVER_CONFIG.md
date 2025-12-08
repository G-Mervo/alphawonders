# Web Server Configuration - Remove /public/ from URL

## The Problem
Your website shows `/public/` in the URL because the web server DocumentRoot is pointing to the wrong directory.

## The Solution
Update your web server configuration to point DocumentRoot to `/var/www/alphawonders.com/html/public/`

## Apache Configuration

### Step 1: Find your current Apache config
```bash
# Usually located at:
/etc/apache2/sites-available/alphawonders.com.conf
# or
/etc/apache2/sites-available/000-default.conf
```

### Step 2: Update DocumentRoot
Change this line:
```apache
DocumentRoot /var/www/alphawonders.com/html
```

To this:
```apache
DocumentRoot /var/www/alphawonders.com/html/public
```

### Step 3: Update Directory block
```apache
<Directory /var/www/alphawonders.com/html/public>
    Options -Indexes +FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```

### Step 4: Enable mod_rewrite (if not already)
```bash
sudo a2enmod rewrite
```

### Step 5: Restart Apache
```bash
sudo systemctl restart apache2
```

## Nginx Configuration

### Update your Nginx config:
```nginx
server {
    listen 80;
    server_name alphawonders.com www.alphawonders.com;
    
    root /var/www/alphawonders.com/html/public;
    index index.php index.html;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### Restart Nginx:
```bash
sudo systemctl restart nginx
```

## Quick Test

After updating configuration:
1. Visit: https://alphawonders.com/ (should NOT show /public/)
2. Check that homepage loads
3. Test navigation links

## Troubleshooting

**If you get 403 Forbidden:**
```bash
chmod -R 755 /var/www/alphawonders.com/html/public
```

**If you get 500 Error:**
- Check Apache/Nginx error logs
- Verify `.htaccess` exists in `public/` directory
- Check file permissions

**If mod_rewrite not working:**
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

