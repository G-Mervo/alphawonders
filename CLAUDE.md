# Alphawonders Website

## Project Overview
Company website for Alphawonders Solutions — a Nairobi-based ICT company serving SMEs, startups, and organisations across Kenya and East Africa.

## Stack
- **Backend**: CodeIgniter 4 (PHP 8.4), PostgreSQL
- **Frontend**: Bootstrap 5.3, Font Awesome 6, jQuery
- **Infrastructure**: Docker (nginx reverse proxy), AWS EC2 behind CloudFront
- **Domain**: alphawonders.com

## Project Structure
```
app/
├── Config/Routes.php          # All route definitions
├── Controllers/
│   ├── Alphawonders.php       # Public-facing pages (services, blog, hire, contact, sitemap)
│   ├── Dashboard.php          # Admin panel (services, blog, hires, messages, analytics)
│   ├── Auth.php               # Login/logout
│   ├── SocialMedia.php        # Social media hub
│   └── ContentCalendar.php    # Content calendar
├── Models/
│   ├── AlphaWModel.php        # Core model (hires, contacts, subscribers)
│   ├── AlphaBlogModel.php     # Blog posts
│   ├── BlogCategoryModel.php  # Blog categories
│   └── BlogTagModel.php       # Blog tags
├── Views/
│   ├── layout/header.php      # Global header, nav, meta tags
│   ├── layout/footer.php      # Global footer, schema markup, scripts
│   ├── index.php              # Homepage
│   ├── hires.php              # Hire form (searchable country, cascading fields)
│   ├── services/alpha*.php    # 13 service view files (7 active, 6 disabled)
│   ├── services/_related_posts.php  # Shared partial for related blog posts
│   ├── dashboard/             # Admin panel views
│   ├── blog/                  # Blog views
│   └── legal/                 # Privacy policy, terms of service
└── Libraries/GroqService.php  # AI content generation via Groq API
```

## Active Services (7)
These have public routes and appear in navigation:
1. **Software Development** (`/softwares`) — web apps, mobile apps, APIs, e-commerce, custom systems
2. **System Administration** (`/system-administration`) — Linux, cloud, DevOps
3. **AI Solutions** (`/ai-services`) — AI integration, automation, chatbots (leverages existing models, not training)
4. **Design** (`/design`) — UI/UX, web design, branding
5. **SEO** (`/seo`) — search engine optimisation, Google ranking
6. **IT Consultancy** (`/ict-consultancy`) — strategy, advisory
7. **IT Support** (`/it-support`) — remote, onsite

## Disabled Services
View files exist in `app/Views/services/` but have no public routes. Listed in dashboard under "Disabled". Examples: Cyber Security, E-commerce Integration, Data Analytics, Prototyping, Web Development.

## Key Architecture Patterns
- **Dashboard services array**: `Dashboard.php` `services()` method has the master list with `status: active|disabled`
- **Service preview**: `Dashboard::servicePreview()` uses category slug mapping for related blog posts
- **Related posts partial**: All 13 service views include `services/_related_posts.php` — renders up to 6 blog posts by category
- **Hire form cascade**: Country selection drives phone code (read-only), city suggestions (datalist), and currency — one-directional data flow
- **Country search**: Custom autocomplete (text input + filtered dropdown), not a native `<select>`. 188 countries grouped by region.
- **Nature of Work**: Grouped `<optgroup>` categories. "Other" shows a required text input.

## Conventions
- Use `esc()` for output escaping in views (CI4 helper)
- Use `base_url()` for all internal links
- Admin routes use an obscured prefix (not `/admin/`) — do not expose the path in docs or READMEs
- British English spelling in user-facing copy (optimisation, organisation, etc.)
- Services that can't be delivered today should stay disabled, not be publicly offered

## Important Notes
- Owner/founder is a software engineer — services reflect what can actually be delivered
- AI services = integrating existing models into solutions, NOT training models
- SEO was renamed from "Digital Marketing" — the full digital marketing scope (influencer, social media management) is not currently offered
- Don't add cyber security or services that can't be backed up with real delivery
