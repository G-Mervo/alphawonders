# Testing Checklist - Before Removing CI3

## 🧪 Quick Test Guide

Test these items before deleting CI3 files:

### 1. Basic Functionality
- [ ] Homepage loads: https://alphawonders.com/
- [ ] No PHP errors displayed
- [ ] No 404 errors
- [ ] Check browser console for JavaScript errors

### 2. Navigation
- [ ] Header menu displays correctly
- [ ] Mobile menu works (hamburger icon)
- [ ] All navigation links work:
  - [ ] Software Development
  - [ ] System Administration
  - [ ] Digital Marketing
  - [ ] Design
  - [ ] IT Consultancy
  - [ ] IT Support
  - [ ] Blog
  - [ ] Contact Us
  - [ ] Hire Us button

### 3. Hero Section
- [ ] Text is visible (white on dark blue background)
- [ ] Buttons are clickable
- [ ] Image displays correctly
- [ ] Responsive on mobile

### 4. Forms
- [ ] Contact form submits: `/contact-us`
- [ ] Newsletter subscription works: Footer form
- [ ] Hire form works: `/hire`
- [ ] Form validation works
- [ ] Success/error messages display

### 5. Pages
- [ ] All service pages load
- [ ] Blog page loads: `/blog`
- [ ] Contact page loads: `/contact-us`
- [ ] Hire page loads: `/hire`

### 6. Database
- [ ] Contact submissions save to database
- [ ] Newsletter subscriptions save
- [ ] Blog posts display from database

### 7. Responsive Design
- [ ] Mobile view (< 768px)
- [ ] Tablet view (768px - 992px)
- [ ] Desktop view (> 992px)
- [ ] Menu collapses on mobile

### 8. Performance
- [ ] Page loads quickly
- [ ] Images load properly
- [ ] CSS/JS files load
- [ ] No broken asset links

### 9. Logs
- [ ] Check `writable/logs/` for errors
- [ ] No critical errors in logs
- [ ] Warnings are acceptable

## ✅ If All Tests Pass

Once everything works:
1. Review `CLEANUP_CI3.md`
2. Remove CI3 files as instructed
3. Keep `backup_ci3/` until confident

## ❌ If Issues Found

1. Check `writable/logs/log-*.php` for errors
2. Verify `.env` configuration
3. Check file permissions: `chmod -R 775 writable/`
4. Verify web server points to `public/` directory
5. Check database connection in `.env`

## 🆘 Quick Fixes

**404 Errors:**
- Verify web server DocumentRoot = `/var/www/alphawonders.com/html/public/`
- Check `.htaccess` exists in `public/` directory

**Database Errors:**
- Verify credentials in `.env`
- Test connection: `mysql -u mervo -p alphaw`

**Permission Errors:**
```bash
chmod -R 775 writable/
chown -R www-data:www-data writable/
```

**View Not Found:**
- Check views are in `app/Views/`
- Verify view paths in controllers

