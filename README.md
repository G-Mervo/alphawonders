# 🌟 AlphaWonders Solution Limited

> *Transforming Ideas into Digital Excellence*

**AlphaWonders Solution Limited** is a leading IT and software development company based in **Nairobi, Kenya**. We specialize in delivering innovative technology solutions that empower businesses to thrive in the digital age.

---

## 🚀 About Us

Welcome to the official website repository of AlphaWonders Solution Limited! We are passionate about creating cutting-edge software solutions, web applications, and IT services that drive business growth and digital transformation across Africa and beyond.

**Location:** Nairobi, Kenya 🇰🇪  
**Industry:** IT & Software Development  
**Mission:** Delivering world-class technology solutions with African excellence

---

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Getting Started](#-getting-started)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Project Structure](#-project-structure)
- [Development](#-development)
- [Contributing](#-contributing)
- [Support](#-support)

---

## ✨ Features

Our company website showcases:

- 🎨 **Modern & Responsive Design** - Beautiful UI/UX that works seamlessly across all devices
- 📱 **Mobile-First Approach** - Optimized for mobile users in Kenya and beyond
- 🛍️ **E-commerce Integration** - Showcasing our products and services
- 📝 **Blog & Content Management** - Sharing insights and company updates
- 🔐 **Secure Admin Panel** - Robust backend management system
- 📊 **Analytics & Reporting** - Data-driven insights for business growth
- 🌐 **Multi-language Support** - Serving diverse markets across Africa

---

## 🛠️ Tech Stack

This website is built with modern, reliable technologies:

### Backend
- **PHP** - Server-side scripting
- **CodeIgniter** - Powerful MVC framework
- **MySQL/MariaDB** - Robust database management
- **Composer** - Dependency management

### Frontend
- **Bootstrap 4** - Responsive CSS framework
- **jQuery** - JavaScript library
- **Font Awesome** - Icon library
- **Custom CSS/JS** - Tailored user experience

### Additional Tools
- **mPDF** - PDF generation
- **PHPMailer** - Email functionality
- **Monolog** - Advanced logging
- **TinyMCE** - Rich text editor

---

## 🚀 Getting Started

### Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** 7.0 or higher
- **MySQL/MariaDB** database server
- **Apache/Nginx** web server
- **Composer** - [Install Composer](https://getcomposer.org/download/)
- **Git** - [Install Git](https://git-scm.com/downloads)

### Clone the Repository

```bash
git clone https://github.com/G-Mervo/alphawonders.git
cd alphawonders
```

---

## 📦 Installation

### Step 1: Install Dependencies

Install all PHP dependencies using Composer:

```bash
composer install
```

This will install all required packages including CodeIgniter, mPDF, PHPMailer, and other dependencies.

### Step 2: Database Setup

1. Create a MySQL database for the project:
   ```sql
   CREATE DATABASE alphawonders CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Import the database schema:
   ```bash
   mysql -u your_username -p alphawonders < assets/alphawonders.sql
   ```

### Step 3: Configure Environment

1. Update database configuration in `application/config/database.php`:
   ```php
   $db['default'] = array(
       'hostname' => 'localhost',
       'username' => 'your_db_username',
       'password' => 'your_db_password',
       'database' => 'alphawonders',
       'dbdriver' => 'mysqli',
       'dbprefix' => '',
       'pconnect' => FALSE,
       'db_debug' => (ENVIRONMENT !== 'production'),
       'cache_on' => FALSE,
       'cachedir' => '',
       'char_set' => 'utf8mb4',
       'dbcollat' => 'utf8mb4_unicode_ci',
       'swap_pre' => '',
       'encrypt' => FALSE,
       'compress' => FALSE,
       'stricton' => FALSE,
       'failover' => array(),
       'save_queries' => TRUE
   );
   ```

2. Configure application settings in `application/config/config.php`:
   ```php
   $config['base_url'] = 'http://localhost/alphawonders/'; // Update for production
   $config['index_page'] = '';
   ```

### Step 4: Set Permissions

Ensure the following directories are writable:

```bash
chmod -R 755 application/cache
chmod -R 755 application/logs
chmod -R 755 attachments
```

### Step 5: Web Server Configuration

#### Apache (.htaccess)
The project includes `.htaccess` files for URL rewriting. Ensure `mod_rewrite` is enabled.

#### Nginx
Configure your Nginx server block to point to the project root and handle URL rewriting.

---

## 📁 Project Structure

```
alphawonders/
├── application/              # CodeIgniter application core
│   ├── cache/               # Cache files (auto-generated)
│   ├── config/              # Configuration files
│   │   ├── config.php      # Main config
│   │   ├── database.php    # Database config
│   │   └── ...
│   ├── controllers/        # Application controllers
│   │   ├── Administrator.php
│   │   ├── Blog.php
│   │   └── ...
│   ├── models/             # Data models
│   ├── views/              # View templates
│   │   ├── blog/
│   │   ├── dashboard/
│   │   └── ...
│   └── logs/               # Application logs
├── system/                 # CodeIgniter system files
├── assets/                 # Frontend assets
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   ├── img/               # Images
│   └── ...
├── attachments/            # User uploads
│   ├── blog_images/
│   ├── shop_images/
│   └── ...
├── vendor/                 # Composer dependencies
├── index.php              # Application entry point
├── .gitignore             # Git ignore rules
└── README.md              # This file
```

---

## 💻 Development

### Development Workflow

1. **Create a feature branch:**
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make your changes** and test thoroughly

3. **Commit your changes:**
   ```bash
   git add .
   git commit -m "Add: Description of your changes"
   ```

4. **Push to remote:**
   ```bash
   git push origin feature/your-feature-name
   ```

5. **Create a Pull Request** on GitHub

### CodeIgniter Best Practices

- Follow CodeIgniter's MVC architecture
- Use proper naming conventions
- Write clean, commented code
- Follow PSR coding standards where applicable
- Test your code before committing

### Environment Modes

The application supports different environments:
- **Development** - Debug mode enabled
- **Testing** - Test environment settings
- **Production** - Optimized for live deployment

Set the environment in `index.php`:
```php
define('ENVIRONMENT', 'development'); // or 'production'
```

---

## 🤝 Contributing

We welcome contributions from the team! Here's how you can help:

1. **Fork the repository**
2. **Create your feature branch** (`git checkout -b feature/AmazingFeature`)
3. **Commit your changes** (`git commit -m 'Add some AmazingFeature'`)
4. **Push to the branch** (`git push origin feature/AmazingFeature`)
5. **Open a Pull Request**

### Commit Message Guidelines

- Use clear, descriptive commit messages
- Prefix with type: `Add:`, `Fix:`, `Update:`, `Remove:`, `Refactor:`
- Example: `Add: User authentication system`

---

## 🔒 Security

- Never commit sensitive information (passwords, API keys)
- Keep `application/config/database.php` out of version control
- Use environment variables for sensitive data
- Regularly update dependencies
- Follow security best practices

---

## 📝 Git Workflow

### Repository Information

- **GitHub:** https://github.com/G-Mervo/alphawonders.git
- **Remote:** `origin` → https://github.com/G-Mervo/alphawonders.git
- **Default Branch:** `master`

### Ignored Files

The following are automatically ignored (see `.gitignore`):
- `vendor/` - Composer dependencies
- `application/cache/` - Cache files
- `application/logs/` - Log files
- `attachments/` - User uploads
- Environment/config files with sensitive data
- IDE and OS-specific files

---

## 📞 Support & Contact

**AlphaWonders Solution Limited**  
📍 Nairobi, Kenya

- **Website:** [alphawonders.com](https://alphawonders.com)
- **GitHub Issues:** [Create an issue](https://github.com/G-Mervo/alphawonders/issues)
- **Email:** Contact through the website contact form

For technical support or questions about this repository, please:
1. Check existing issues on GitHub
2. Create a new issue with detailed information
3. Contact the development team

---

## 📄 License

[Specify your license here]

---

## 🙏 Acknowledgments

- CodeIgniter Framework
- All open-source contributors
- The AlphaWonders team in Nairobi

---

<div align="center">

**Built with ❤️ in Nairobi, Kenya**

*AlphaWonders Solution Limited - Transforming Ideas into Digital Excellence*

[⬆ Back to Top](#-alphawonders-solution-limited)

</div>
