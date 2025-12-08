# CI3 Cleanup Instructions

## ⚠️ IMPORTANT: Test CI4 First!

**DO NOT DELETE CI3 FILES UNTIL YOU HAVE VERIFIED CI4 IS WORKING CORRECTLY!**

## Testing Checklist

Before deleting CI3 files, verify:

- [ ] Website loads correctly at https://alphawonders.com/
- [ ] Navigation menu works
- [ ] All pages load (Services, Blog, Contact, etc.)
- [ ] Contact form submits successfully
- [ ] Blog posts display correctly
- [ ] Database connections work
- [ ] No errors in `writable/logs/`
- [ ] Mobile responsive design works
- [ ] All links function properly

## Files/Folders Safe to Remove (After Testing)

Once CI4 is confirmed working:

```bash
cd /var/www/alphawonders.com/html

# Remove old CI3 application directory
rm -rf application/

# Remove old CI3 system directory  
rm -rf system/

# Remove old CI3 index.php (CI4 uses public/index.php)
rm -f index.php

# Remove old CI3 .htaccess (CI4 uses public/.htaccess)
rm -f .htaccess

# Optional: Remove backup after confirming everything works
# rm -rf backup_ci3/
```

## What to Keep

- ✅ `app/` - CI4 application code
- ✅ `public/` - CI4 public directory
- ✅ `writable/` - CI4 logs, cache, sessions
- ✅ `vendor/` - Composer dependencies including CI4
- ✅ `assets/` - Frontend assets
- ✅ `attachments/` - Uploaded files
- ✅ `.env` - Environment configuration
- ✅ `composer.json` & `composer.lock` - Dependencies

## Rollback Plan

If you need to rollback:
1. Restore from `backup_ci3/` directory
2. Point web server back to root directory
3. Restore original `index.php` and `.htaccess`

## Cleanup Script (Run After Testing)

```bash
#!/bin/bash
# Only run this AFTER confirming CI4 works perfectly!

cd /var/www/alphawonders.com/html

echo "Removing CI3 files..."
rm -rf application/
rm -rf system/
rm -f index.php
rm -f .htaccess

echo "✅ CI3 files removed!"
echo "⚠️  Backup available in backup_ci3/ if needed"
```

