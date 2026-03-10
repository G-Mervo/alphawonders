# Alphawonders Website

Company website for [Alphawonders Solutions](https://alphawonders.com) — a Nairobi-based ICT company serving SMEs, startups, and organisations across Kenya and East Africa.

## Stack

- **Backend**: CodeIgniter 4 (PHP 8.4), PostgreSQL
- **Frontend**: Bootstrap 5.3, Font Awesome 6, jQuery
- **Infrastructure**: Docker (PHP-FPM + nginx + Supervisor), AWS EC2 behind CloudFront

## Services Offered

Software Development (web, mobile, APIs) | System Administration | AI Solutions | Design | SEO | IT Consultancy | IT Support

## Project Structure

```
app/
├── Config/Routes.php           # Route definitions
├── Controllers/                # Alphawonders (public), Dashboard (admin), Auth, SocialMedia
├── Models/                     # AlphaWModel, AlphaBlogModel, BlogCategoryModel, BlogTagModel
├── Views/
│   ├── layout/                 # header.php, footer.php (global)
│   ├── index.php               # Homepage
│   ├── hires.php               # Hire form
│   ├── services/               # 13 service views (7 active, 6 disabled)
│   ├── dashboard/              # Admin panel
│   ├── blog/                   # Blog views
│   └── legal/                  # Privacy policy, terms
├── Libraries/GroqService.php   # AI content generation
└── Database/Migrations/        # Database migrations
docker/                         # nginx, php-fpm, supervisor configs
infra/                          # Production deployment configs
docs/                           # Legacy migration docs
```

## Quick Start

See [SETUP.md](SETUP.md) for full setup instructions.

```bash
# Development
docker compose -f docker-compose.dev.yml up --build

# Production
docker compose up -d
```

## License

Proprietary. All rights reserved.
