# Alphawonders - Product Roadmap & Plans

## Priority: Content Creation (Current Focus)

### Blog & Content Pipeline
- [x] Blog CRUD with TinyMCE editor
- [x] AI-powered blog generation (Groq/Llama)
- [x] AI title, slug, category, meta description suggestions
- [x] Blog categories and tags
- [x] Content scheduling (draft → scheduled → published)
- [x] Social media post generation from blog posts
- [x] Content calendar
- [x] Content repurposing (newsletter, thread, carousel, infographic)
- [ ] Auto-generate social posts when blog is published (trigger on publish)
- [ ] Newsletter/email campaigns to subscribers (bulk send UI)
- [ ] RSS feed generation for blog
- [ ] Blog post series/collections (group related posts)
- [ ] Reading time estimation on blog posts
- [ ] Related posts suggestions (AI-powered)

### Social Media Hub
- [x] Create/edit/delete social posts
- [x] Generate posts for all platforms (X, LinkedIn, Facebook, Instagram, TikTok)
- [x] Video script generation
- [x] Hashtag suggestions
- [ ] Direct publishing to social platforms via APIs (X API, LinkedIn API, etc.)
- [ ] Social media analytics dashboard (engagement tracking)
- [ ] Auto-schedule social posts at optimal times

---

## Phase 2: Admin & Operations Improvements

### Security & Audit
- [x] Login attempt logging with brute force protection
- [x] Login audit log dashboard
- [x] Bot/scanner blocking at nginx level
- [x] Rate limiting
- [ ] Activity log - track all admin actions (who edited what, when)
- [ ] Two-factor authentication (2FA) for admin login
- [ ] Session management (view/revoke active sessions)
- [ ] IP allowlist/blocklist management from admin

### Subscribers Management
- [x] Subscriber list with detail view
- [x] Spam marking for subscribers
- [ ] Export subscribers to CSV
- [ ] Subscriber segmentation (by source, country, date range)
- [ ] Unsubscribe link in emails + manage preferences page

### Comments Management
- [x] View all blog comments from backend
- [x] Mark comments as spam (hidden from frontend)
- [x] Delete comments
- [x] Admin reply from backend (visible on frontend)
- [ ] Comment moderation queue (hold new comments for approval)
- [ ] Email notification when new comment is posted
- [ ] Comment reply notifications to commenters

### Missing Admin Features
- [ ] **Media library** - central place to manage uploaded images
- [ ] **SEO dashboard** - sitemap management, meta tag audit, broken link checker
- [ ] **Site health monitor** - uptime ping for alphawonders.com and other sites
- [ ] **Backup management** - trigger/download DB backups from admin
- [ ] **Contact form spam protection** - reCAPTCHA or honeypot on public forms
- [ ] **Dashboard analytics** - charts for traffic trends, popular posts, subscriber growth
- [ ] **Multi-user admin** - role-based access (editor, author, admin)
- [ ] **Testimonials manager** - CRUD for client testimonials and social proof
- [ ] **Case studies manager** - CRUD for portfolio/case study pages
- [ ] **Homepage content manager** - manage popular topics, featured blog posts from admin

---

## Phase 3: Product Ideas

### Chama Voting Platform
A voting/progress tracking system for chamas (investment groups). Previously prototyped as "Valiants" — files removed but concept retained.
- Member registration and login
- Create and manage voting sessions
- Track contributions and progress
- Results dashboard with analytics
- Could be offered as a standalone SaaS product

### Careers Page
A public-facing careers/jobs page for prospective team members.
- Job listings with requirements and descriptions
- Application form (name, email, CV upload, cover letter)
- Admin view to manage applications (view, shortlist, reject)
- Route: /careers or /join-us

### Client Testimonials & Social Proof (Target: April 2026)
Add a social proof section to the homepage and key service pages:
- [ ] 3-5 short testimonials with name, role, and company
- [ ] Client logos section (even small/local clients)
- [ ] Outcome metrics: "45% traffic increase for [client]", "12+ fintech apps delivered", etc.
- [ ] Admin UI to manage testimonials (CRUD from dashboard)
- [ ] Database table: `testimonials` (id, client_name, client_role, company, quote, rating, image, is_featured, display_order, created_at)
- [ ] Display on: homepage, relevant service pages
- [ ] Consider: star ratings, video testimonials

### Case Studies & Portfolio (Target: after mvacant + somanai pilot)
Add a portfolio/case studies page showcasing completed projects:
- [ ] Route: `/portfolio` or `/case-studies`
- [ ] Individual case study pages: challenge, solution, results, technologies used
- [ ] Admin UI to manage case studies (CRUD from dashboard)
- [ ] Database table: `case_studies` (id, title, slug, client_name, industry, challenge, solution, results, technologies, images, is_featured, display_order, created_at)
- [ ] First case studies: mvacant (real estate), somanai (AI platform)
- [ ] Link from service pages to relevant case studies
- [ ] Before/after metrics where possible
- [ ] Add to nav: Services, **Portfolio**, Blog, Contact

### Lead Magnets & Downloadable Resources (Target: May 2026)
Create gated content for email capture and lead nurturing:
- [ ] "Digital Transformation Guide for Kenyan SMEs (2026)" — PDF download
- [ ] "Checklist: Is Your Business Ready for E-commerce?" — PDF download
- [ ] Admin UI to manage downloadable resources
- [ ] Email gate: capture email before download
- [ ] 3-5 email nurture sequence after download (about services and case studies)
- [ ] Inline CTAs in blog posts: "Download our free guide on [topic]"

### Interactive Engagement Tools (Target: May-June 2026)
Add small interactive tools for lead capture:
- [ ] "Project Budget Estimator" — multi-step form that calculates estimated cost
- [ ] "Website/SEO Audit Checker" — simple form that captures lead info
- [ ] Live chat / chatbot widget for quick questions (initially manual)

### Disabled Service Pages
The following service pages exist in views but are not currently routed. Can be re-enabled from admin when ready:
- `services/alphacommerce.php` — E-commerce solutions
- `services/alphadata.php` — Data analytics
- `services/alphapplications.php` — Application development
- `services/alphaprototyping.php` — Prototyping
- `services/alphasecurity.php` — Cyber security
- `services/alphaweb.php` — Web development

---

## Phase 4: Tech Events Scraper

### Concept
Build a web scraper for tech events (conferences, meetups, hackathons) and display on alphawonders.com to drive organic traffic.

### Implementation Plan
1. Create `tech_events` table (name, date, location, url, description, source, category)
2. Build scraper service that pulls from event listing sites
3. Run as a cron job (daily/weekly)
4. Create `/tech-events` public page with filterable event listings
5. Add search and category filters (AI, Web Dev, Cloud, Security, etc.)
6. Add "Submit an Event" form for community contributions
7. Generate blog posts summarising upcoming events (AI-assisted)

### Benefits
- Drives organic SEO traffic
- Positions Alphawonders as a tech resource hub
- Content generation on autopilot
- Potential for sponsored event listings (revenue)

---

## Phase 5: Shop / Ecommerce (Future Revenue)

### Concept
Sell software products, code templates, and services through alphawonders.com.

### Products to Sell
- **mvacant** - real estate platform (SaaS subscription or license)
- **somanaai** - AI platform (API credits or subscription)
- **Code templates/boilerplates** - CI4 admin dashboard starter kit, etc.
- **White-label solutions** - let agencies rebrand products
- **API access** - sell API credits for AI services
- **Consulting packages** - bundled hours of IT consulting

### Implementation Plan (Incremental)

#### Step 1: Product Showcase
- [ ] Create `/products` public page showcasing all products
- [ ] Individual product landing pages with features, screenshots, pricing
- [ ] "Request Demo" or "Contact for Pricing" CTAs

#### Step 2: Payment Integration
- [ ] Stripe integration for one-time purchases
- [ ] Stripe subscriptions for SaaS products
- [ ] PayPal as alternative payment method
- [ ] Invoice generation (PDF)

#### Step 3: Digital Delivery
- [ ] License key generation and management
- [ ] Account creation on purchase (for SaaS products)
- [ ] Download links for code templates (time-limited, secure)
- [ ] Purchase history for customers

#### Step 4: Full Storefront
- [ ] Product categories and search
- [ ] Customer reviews and ratings
- [ ] Discount codes / promo system
- [ ] Analytics: revenue dashboard, conversion tracking
- [ ] Customer support portal

### Revenue Model
| Product | Model | Estimated Price |
|---------|-------|----------------|
| mvacant | SaaS monthly | $29-99/mo |
| somanaai | API credits | Pay-per-use |
| CI4 Starter Kit | One-time | $49-149 |
| White-label | License + support | $499-2000 |
| Consulting | Hourly/package | $50-150/hr |

### Strategy
1. Start with product showcase pages (zero dev cost, immediate visibility)
2. Add Stripe checkout for the simplest product first
3. Validate demand before building full ecommerce
4. Content (blog + events) drives traffic → shop converts visitors to customers

---

## Infrastructure & DevOps

- [x] Docker containerisation
- [x] Nginx reverse proxy with SSL (CloudFront + ACM)
- [x] PostgreSQL database
- [x] SMTP email configuration
- [x] CI/CD pipeline (GitHub Actions for auto-deploy)
- [ ] Automated database backups (daily to S3)
- [ ] Staging environment for testing
- [ ] Log aggregation and monitoring (CloudWatch or similar)
- [ ] CDN for static assets (currently through CloudFront)

---

## API Keys & Configuration

### Current Setup (Smart - DB-driven)
The following keys are managed from the admin settings page (`/aw-cp/settings`), stored in the database, and do NOT require a rebuild to change:
- Groq API key (AI features)
- Groq model selection
- GitHub PAT (GitHub integration)
- Google Analytics ID
- Google Search Console meta tag

### Future Keys to Add to Settings
- [ ] Stripe API keys (publishable + secret)
- [ ] Social media API keys (X, LinkedIn, etc.)
- [ ] SMTP credentials (currently in .env - should move to DB)
- [ ] reCAPTCHA keys
- [ ] Any third-party API keys

### Principle
**All API keys that may change should be stored in the database and managed from the admin UI.** Only infrastructure-level config (database host, app URL) stays in .env.

---

### SEO & Content Improvements (Completed March 2026)
- [x] Per-page meta descriptions and canonical URLs
- [x] Dynamic Open Graph and X (Twitter) Card meta tags
- [x] Enhanced JSON-LD structured data (LocalBusiness with services, hours, geo)
- [x] Removed harmful meta refresh tag
- [x] Localized all service page titles and descriptions for Kenya/East Africa SEO
- [x] Dynamic "Related Reading" sections on service pages (CMS-managed via blog categories)
- [x] "How We Work" process section on homepage
- [x] "Industries We Serve" section on homepage
- [x] Newsletter signup on homepage blog sidebar
- [x] Consistent CTAs across all pages ("Book a Free 30-Min Call")
- [x] Simplified hire form (removed Skype field, added assurance copy)
- [x] Fixed contact form action URL
- [x] Redesigned hero section (dashboard preview instead of code snippet)

*Last updated: March 10, 2026*

