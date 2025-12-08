# AlphaWonders

A CodeIgniter-based web application for AlphaWonders.

## Repository

- **GitHub**: https://github.com/G-Mervo/alphawonders.git
- **Remote**: `origin` → https://github.com/G-Mervo/alphawonders.git

## Requirements

- PHP 7.0 or higher
- MySQL/MariaDB database
- Apache/Nginx web server
- Composer (for dependency management)

## Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/G-Mervo/alphawonders.git
cd alphawonders
```

### 2. Install Dependencies

Install PHP dependencies using Composer:

```bash
composer install
```

### 3. Configure Database

1. Copy the database configuration file:
   ```bash
   cp application/config/database.php.example application/config/database.php
   ```

2. Update `application/config/database.php` with your database credentials:
   ```php
   $db['default'] = array(
       'hostname' => 'your_hostname',
       'username' => 'your_username',
       'password' => 'your_password',
       'database' => 'your_database',
       // ... other settings
   );
   ```

### 4. Configure Application

Update `application/config/config.php` with your base URL and other settings:

```php
$config['base_url'] = 'http://your-domain.com/';
```

### 5. Set Permissions

Ensure the following directories are writable:

```bash
chmod -R 755 application/cache
chmod -R 755 application/logs
chmod -R 755 attachments
```

### 6. Database Setup

Import the database schema if provided:

```bash
mysql -u your_username -p your_database < assets/alphawonders.sql
```

## Project Structure

```
alphawonders/
├── application/          # CodeIgniter application files
│   ├── cache/           # Cache files (ignored in git)
│   ├── config/          # Configuration files
│   ├── controllers/     # Controllers
│   ├── models/          # Models
│   ├── views/           # Views
│   └── logs/            # Log files (ignored in git)
├── system/              # CodeIgniter system files
├── assets/              # Frontend assets (CSS, JS, images)
├── attachments/         # User uploads (ignored in git)
├── vendor/              # Composer dependencies (ignored in git)
├── index.php           # Entry point
└── .gitignore          # Git ignore rules
```

## Git Workflow

### Initial Setup

The repository has been initialized with:
- Git repository initialized
- Remote origin configured
- `.gitignore` file added

### Making Changes

1. Make your changes
2. Stage files: `git add .`
3. Commit: `git commit -m "Your commit message"`
4. Push: `git push origin master`

### Ignored Files

The following are ignored by git (see `.gitignore`):
- `vendor/` - Composer dependencies
- `application/cache/` - Cache files
- `application/logs/` - Log files
- `attachments/` - User uploads
- Environment/config files with sensitive data
- IDE and OS-specific files

## Dependencies

Main dependencies (managed via Composer):
- CodeIgniter framework
- mPDF (PDF generation)
- PHPMailer (Email functionality)
- Monolog (Logging)
- Other PHP libraries

## Development

### CodeIgniter Version

This project uses CodeIgniter framework. Refer to the [CodeIgniter documentation](https://codeigniter.com/user_guide/) for framework-specific guidelines.

### Contributing

1. Create a feature branch
2. Make your changes
3. Commit with descriptive messages
4. Push to your branch
5. Create a pull request

## License

[Add your license information here]

## Support

For issues and questions, please contact the repository owner or create an issue on GitHub.
