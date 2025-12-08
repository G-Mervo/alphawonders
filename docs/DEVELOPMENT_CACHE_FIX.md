# CI4 Development Cache Fix

## Issue: Changes Not Showing After Refresh

CI4 doesn't have built-in hot reload. If you're not seeing changes, it's likely due to caching.

## Solutions

### 1. Clear CI4 Cache

```bash
cd /var/www/alphawonders.com/html
rm -rf writable/cache/*
rm -rf writable/session/*
```

### 2. Disable OPcache (PHP Opcode Cache)

OPcache caches compiled PHP files. To disable it for development:

**Option A: Create a `.user.ini` file in public directory:**
```ini
opcache.enable=0
opcache.enable_cli=0
```

**Option B: Restart PHP-FPM:**
```bash
sudo systemctl restart php8.1-fpm
# or
sudo service php8.1-fpm restart
```

### 3. Set Environment to Development

Create or update `.env` file in root directory:

```env
CI_ENVIRONMENT = development
```

### 4. Browser Cache

- **Hard Refresh:** `Ctrl+Shift+R` (Linux/Windows) or `Cmd+Shift+R` (Mac)
- **Clear Browser Cache:** Clear cached images and files
- **Disable Cache in DevTools:** 
  - Open DevTools (F12)
  - Go to Network tab
  - Check "Disable cache"
  - Keep DevTools open while developing

### 5. Add Cache-Busting Headers (Development Only)

Add this to `public/index.php` before `$app->run()`:

```php
// Development: Disable caching
if (ENVIRONMENT === 'development') {
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
}
```

### 6. Quick Cache Clear Script

Create `clear_cache.php` in root:

```php
<?php
$cacheDir = __DIR__ . '/writable/cache';
$sessionDir = __DIR__ . '/writable/session';

function deleteDir($dir) {
    if (!is_dir($dir)) return;
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        is_dir($path) ? deleteDir($path) : unlink($path);
    }
    rmdir($dir);
}

deleteDir($cacheDir);
deleteDir($sessionDir);

mkdir($cacheDir, 0777, true);
mkdir($sessionDir, 0777, true);
file_put_contents($cacheDir . '/index.html', '');
file_put_contents($sessionDir . '/index.html', '');

echo "Cache cleared!\n";
```

Run: `php clear_cache.php`

## Recommended Development Workflow

1. Set environment to `development` in `.env`
2. Disable OPcache for development
3. Use browser DevTools with cache disabled
4. Clear CI4 cache regularly: `rm -rf writable/cache/*`
5. Hard refresh browser: `Ctrl+Shift+R`

## Note

CI4 doesn't have hot reload like frontend frameworks. You need to:
- Save your file
- Clear cache (if needed)
- Refresh browser manually

For true hot reload, you'd need to set up a frontend build tool (Vite, Webpack) for your CSS/JS assets.

