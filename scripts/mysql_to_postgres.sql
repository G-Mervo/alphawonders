-- ============================================================
-- Alphawonders - PostgreSQL Schema
-- Converted from MySQL (public/assets/alphawonders.sql)
-- ============================================================
-- Key conversions applied:
--   AUTO_INCREMENT      -> GENERATED ALWAYS AS IDENTITY
--   int(N) UNSIGNED     -> INTEGER
--   int(N)              -> INTEGER
--   tinyint(1)          -> BOOLEAN
--   tinyint(N)          -> SMALLINT
--   longtext / text     -> TEXT
--   datetime            -> TIMESTAMP
--   float(M,D)          -> REAL
--   char(N)             -> CHAR(N)
--   varchar(N)          -> VARCHAR(N)
--   ON UPDATE CURRENT_TIMESTAMP -> trigger function
--   ENGINE / COLLATE / backticks -> removed
-- ============================================================

BEGIN;

-- ============================================================
-- Trigger function for auto-updating modified timestamps
-- (replaces MySQL ON UPDATE CURRENT_TIMESTAMP)
-- ============================================================
CREATE OR REPLACE FUNCTION update_modified_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.date_modified = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_modified_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.modified_at = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_modified_on_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW."modifiedOn" = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION update_created_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.created = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- ============================================================
-- 1. active_pages
-- ============================================================
DROP TABLE IF EXISTS active_pages CASCADE;
CREATE TABLE active_pages (
    id       INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name     VARCHAR(50) NOT NULL,
    enabled  BOOLEAN NOT NULL
);

-- ============================================================
-- 2. bank_accounts
-- ============================================================
DROP TABLE IF EXISTS bank_accounts CASCADE;
CREATE TABLE bank_accounts (
    id   INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    iban VARCHAR(255) NOT NULL,
    bank VARCHAR(255) NOT NULL,
    bic  VARCHAR(255) NOT NULL
);

-- ============================================================
-- 3. blog
-- ============================================================
DROP TABLE IF EXISTS blog CASCADE;
CREATE TABLE blog (
    id               INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    blog_author      VARCHAR(70)  NOT NULL,
    blog_description TEXT         NOT NULL,
    blog_id          INTEGER      NOT NULL,
    blog_image       VARCHAR(100) NOT NULL,
    blog_title       VARCHAR(100) NOT NULL,
    blog_url         VARCHAR(100) NOT NULL,
    date_created     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_modified    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TRIGGER blog_update_modified
    BEFORE UPDATE ON blog
    FOR EACH ROW
    EXECUTE FUNCTION update_modified_column();

-- ============================================================
-- 4. blog_posts
-- ============================================================
DROP TABLE IF EXISTS blog_posts CASCADE;
CREATE TABLE blog_posts (
    id    INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    url   VARCHAR(255) NOT NULL,
    time  INTEGER      NOT NULL
);

-- Note: Original MySQL had UNIQUE KEY `id` (`id`) which is redundant with PRIMARY KEY

-- ============================================================
-- 5. blog_translations
-- ============================================================
DROP TABLE IF EXISTS blog_translations CASCADE;
CREATE TABLE blog_translations (
    id          INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    title       VARCHAR(255) NOT NULL,
    description TEXT         NOT NULL,
    abbr        VARCHAR(5)   NOT NULL,
    for_id      INTEGER      NOT NULL
);

-- ============================================================
-- 6. confirm_links
-- ============================================================
DROP TABLE IF EXISTS confirm_links CASCADE;
CREATE TABLE confirm_links (
    id        INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    link      CHAR(32) NOT NULL,
    for_order INTEGER  NOT NULL
);

-- ============================================================
-- 7. cookie_law
-- ============================================================
DROP TABLE IF EXISTS cookie_law CASCADE;
CREATE TABLE cookie_law (
    id         INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    link       VARCHAR(255) NOT NULL,
    theme      VARCHAR(20)  NOT NULL,
    visibility BOOLEAN      NOT NULL DEFAULT FALSE
);

-- ============================================================
-- 8. cookie_law_translations
-- ============================================================
DROP TABLE IF EXISTS cookie_law_translations CASCADE;
CREATE TABLE cookie_law_translations (
    id          INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    message     VARCHAR(255) NOT NULL,
    button_text VARCHAR(50)  NOT NULL,
    learn_more  VARCHAR(50)  NOT NULL,
    abbr        VARCHAR(5)   NOT NULL,
    for_id      INTEGER      NOT NULL,
    UNIQUE (abbr, for_id)
);

-- ============================================================
-- 9. hires
-- ============================================================
DROP TABLE IF EXISTS hires CASCADE;
CREATE TABLE hires (
    id            INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name          VARCHAR(100) NOT NULL,
    tel           VARCHAR(20)  NOT NULL,
    email         VARCHAR(100) NOT NULL,
    skype         VARCHAR(70)  DEFAULT NULL,
    whatsapp      VARCHAR(20)  DEFAULT NULL,
    location      VARCHAR(100) NOT NULL,
    client        VARCHAR(100) NOT NULL,
    work          VARCHAR(100) NOT NULL,
    nature        VARCHAR(100) NOT NULL,   -- permanent, contract, internship, attachment
    description   VARCHAR(255) NOT NULL,
    budget        VARCHAR(50)  NOT NULL,
    company_name  VARCHAR(150) DEFAULT NULL,
    industry      VARCHAR(100) DEFAULT NULL,
    timeline      VARCHAR(100) DEFAULT NULL,
    activity_name VARCHAR(50)  DEFAULT NULL,
    browser_name  VARCHAR(100) DEFAULT NULL,
    ip_address    VARCHAR(100) DEFAULT NULL,
    platform      VARCHAR(100) DEFAULT NULL,
    referral      VARCHAR(100) DEFAULT NULL,
    time          TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    device        VARCHAR(40)  DEFAULT NULL,
    date_created  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_modified TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TRIGGER hires_update_modified
    BEFORE UPDATE ON hires
    FOR EACH ROW
    EXECUTE FUNCTION update_modified_column();

-- ============================================================
-- 10. history
-- ============================================================
DROP TABLE IF EXISTS history CASCADE;
CREATE TABLE history (
    id       INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    activity VARCHAR(255) NOT NULL,
    username VARCHAR(50)  DEFAULT NULL,
    time     INTEGER      NOT NULL
);

-- ============================================================
-- 11. keys
-- ============================================================
DROP TABLE IF EXISTS keys CASCADE;
CREATE TABLE keys (
    id            INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    key           VARCHAR(40) NOT NULL,
    level         INTEGER     NOT NULL,
    ignore_limits BOOLEAN     NOT NULL DEFAULT FALSE,
    date_created  INTEGER     NOT NULL
);

-- ============================================================
-- 12. languages
-- ============================================================
DROP TABLE IF EXISTS languages CASCADE;
CREATE TABLE languages (
    id          INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    abbr        VARCHAR(5)   NOT NULL,
    name        VARCHAR(30)  NOT NULL,
    currency    VARCHAR(10)  NOT NULL,
    "currencyKey" VARCHAR(5) NOT NULL,
    flag        VARCHAR(255) NOT NULL
);

-- ============================================================
-- 13. messages
-- ============================================================
DROP TABLE IF EXISTS messages CASCADE;
CREATE TABLE messages (
    id          INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    full_name   VARCHAR(100)  NOT NULL,
    email_addr  VARCHAR(100)  NOT NULL,
    phoneno     VARCHAR(20)   NOT NULL,
    message     VARCHAR(1000) NOT NULL,
    created_at  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TRIGGER messages_update_modified
    BEFORE UPDATE ON messages
    FOR EACH ROW
    EXECUTE FUNCTION update_modified_at_column();

-- ============================================================
-- 14. orders
-- ============================================================
DROP TABLE IF EXISTS orders CASCADE;
CREATE TABLE orders (
    id             INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    order_id       INTEGER      NOT NULL,
    user_id        INTEGER      DEFAULT NULL,  -- points to users_public.id
    products       TEXT         NOT NULL,
    date           INTEGER      NOT NULL,
    referrer       VARCHAR(255) NOT NULL,
    clean_referrer VARCHAR(255) NOT NULL,
    payment_type   VARCHAR(255) NOT NULL,
    paypal_status  VARCHAR(10)  DEFAULT NULL,
    processed      BOOLEAN      NOT NULL DEFAULT FALSE,
    viewed         BOOLEAN      NOT NULL DEFAULT FALSE,  -- changed when processed status changes
    confirmed      BOOLEAN      NOT NULL DEFAULT FALSE,
    discount_code  VARCHAR(20)  DEFAULT NULL
);

-- ============================================================
-- 15. orders_clients
-- ============================================================
DROP TABLE IF EXISTS orders_clients CASCADE;
CREATE TABLE orders_clients (
    id         INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name  VARCHAR(100) NOT NULL,
    email      VARCHAR(100) NOT NULL,
    phone      VARCHAR(30)  NOT NULL,
    address    TEXT         NOT NULL,
    city       VARCHAR(20)  NOT NULL,
    post_code  VARCHAR(10)  NOT NULL,
    notes      TEXT         NOT NULL,
    for_id     INTEGER      NOT NULL
);

-- ============================================================
-- 16. posts_comments
-- ============================================================
DROP TABLE IF EXISTS posts_comments CASCADE;
CREATE TABLE posts_comments (
    comment_id    INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    post_id       INTEGER      NOT NULL,
    commentee     VARCHAR(100) NOT NULL DEFAULT 'guest',
    comment       VARCHAR(255) NOT NULL,
    email_addr    VARCHAR(100) DEFAULT NULL,
    phoneno       VARCHAR(20)  DEFAULT NULL,
    activity_name VARCHAR(50)  DEFAULT NULL,
    browser_name  VARCHAR(100) DEFAULT NULL,
    ip_address    VARCHAR(100) DEFAULT NULL,
    platform      VARCHAR(100) DEFAULT NULL,
    referral      VARCHAR(100) DEFAULT NULL,
    time          TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    device        VARCHAR(40)  DEFAULT NULL,
    created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TRIGGER posts_comments_update_modified
    BEFORE UPDATE ON posts_comments
    FOR EACH ROW
    EXECUTE FUNCTION update_updated_at_column();

-- ============================================================
-- 17. products
-- ============================================================
DROP TABLE IF EXISTS products CASCADE;
CREATE TABLE products (
    id               INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    folder           INTEGER      DEFAULT NULL,  -- folder with images
    image            VARCHAR(255) NOT NULL,
    time             INTEGER      NOT NULL,       -- time created
    time_update      INTEGER      NOT NULL,       -- time updated
    visibility       BOOLEAN      NOT NULL DEFAULT TRUE,
    shop_categorie   INTEGER      NOT NULL,
    quantity         INTEGER      NOT NULL DEFAULT 0,
    procurement      INTEGER      NOT NULL,
    in_slider        BOOLEAN      NOT NULL DEFAULT FALSE,
    url              VARCHAR(255) NOT NULL,
    virtual_products VARCHAR(500) DEFAULT NULL,
    brand_id         INTEGER      DEFAULT NULL,
    position         INTEGER      NOT NULL,
    vendor_id        INTEGER      NOT NULL DEFAULT 0
);

-- ============================================================
-- 18. products_translations
-- ============================================================
DROP TABLE IF EXISTS products_translations CASCADE;
CREATE TABLE products_translations (
    id                INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    title             VARCHAR(255) NOT NULL,
    description       TEXT         NOT NULL,
    basic_description TEXT         NOT NULL,
    price             VARCHAR(20)  NOT NULL,
    old_price         VARCHAR(20)  NOT NULL,
    abbr              VARCHAR(5)   NOT NULL,
    for_id            INTEGER      NOT NULL
);

-- ============================================================
-- 19. seo_pages
-- ============================================================
DROP TABLE IF EXISTS seo_pages CASCADE;
CREATE TABLE seo_pages (
    id   INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name VARCHAR(20) NOT NULL
);

-- ============================================================
-- 20. seo_pages_translations
-- ============================================================
DROP TABLE IF EXISTS seo_pages_translations CASCADE;
CREATE TABLE seo_pages_translations (
    id          INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    title       VARCHAR(200) NOT NULL,
    description VARCHAR(200) NOT NULL,
    abbr        VARCHAR(5)   NOT NULL,
    page_type   VARCHAR(20)  NOT NULL
);

-- ============================================================
-- 21. shop_categories
-- ============================================================
DROP TABLE IF EXISTS shop_categories CASCADE;
CREATE TABLE shop_categories (
    id       INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    sub_for  INTEGER NOT NULL,
    position INTEGER NOT NULL
);

-- ============================================================
-- 22. shop_categories_translations
-- ============================================================
DROP TABLE IF EXISTS shop_categories_translations CASCADE;
CREATE TABLE shop_categories_translations (
    id     INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name   VARCHAR(50) NOT NULL,
    abbr   VARCHAR(5)  NOT NULL,
    for_id INTEGER     NOT NULL
);

-- ============================================================
-- 23. subscribed
-- ============================================================
DROP TABLE IF EXISTS subscribed CASCADE;
CREATE TABLE subscribed (
    id      INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    email   VARCHAR(255) NOT NULL,
    browser VARCHAR(255) NOT NULL,
    ip      VARCHAR(255) NOT NULL,
    time    VARCHAR(255) NOT NULL
);

-- ============================================================
-- 24. subscriptions
-- ============================================================
DROP TABLE IF EXISTS subscriptions CASCADE;
CREATE TABLE subscriptions (
    id            INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    email         VARCHAR(255) NOT NULL,
    activity_name VARCHAR(100) DEFAULT NULL,
    browser_name  VARCHAR(100) DEFAULT NULL,
    ip_address    VARCHAR(100) DEFAULT NULL,
    platform      VARCHAR(100) DEFAULT NULL,
    referral      VARCHAR(100) DEFAULT NULL,
    time          TIMESTAMP    DEFAULT NULL,
    device        VARCHAR(40)  DEFAULT NULL,
    created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TRIGGER subscriptions_update_modified
    BEFORE UPDATE ON subscriptions
    FOR EACH ROW
    EXECUTE FUNCTION update_modified_at_column();

-- ============================================================
-- 25. textual_pages_tanslations (note: original table name has typo)
-- ============================================================
DROP TABLE IF EXISTS textual_pages_tanslations CASCADE;
CREATE TABLE textual_pages_tanslations (
    id          INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name        VARCHAR(255) NOT NULL,
    description TEXT         NOT NULL,
    abbr        VARCHAR(5)   NOT NULL,
    for_id      INTEGER      NOT NULL
);

-- ============================================================
-- 26. transactions
-- ============================================================
DROP TABLE IF EXISTS transactions CASCADE;
CREATE TABLE transactions (
    id               INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    user_id          INTEGER      NOT NULL,
    mpesa_id         INTEGER      DEFAULT NULL,
    transaction_no   VARCHAR(60)  NOT NULL,
    transaction_date TIMESTAMP    NOT NULL,
    mode_payment     VARCHAR(55)  NOT NULL,
    amount           REAL         NOT NULL,
    "createdOn"      TIMESTAMP    NOT NULL,
    "modifiedOn"     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_transactions_user_id ON transactions (user_id);
CREATE INDEX idx_transactions_mpesa_id ON transactions (mpesa_id);

CREATE TRIGGER transactions_update_modified
    BEFORE UPDATE ON transactions
    FOR EACH ROW
    EXECUTE FUNCTION update_modified_on_column();

-- ============================================================
-- 27. travel
-- ============================================================
DROP TABLE IF EXISTS travel CASCADE;
CREATE TABLE travel (
    id INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY
);

-- ============================================================
-- 28. users
-- ============================================================
DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE users (
    id         INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    username   VARCHAR(50)  NOT NULL,
    password   VARCHAR(32)  NOT NULL,
    email      VARCHAR(100) NOT NULL,
    notify     BOOLEAN      NOT NULL DEFAULT FALSE,  -- email notifications
    last_login INTEGER      DEFAULT NULL
);

-- ============================================================
-- 29. users_prev
-- ============================================================
DROP TABLE IF EXISTS users_prev CASCADE;
CREATE TABLE users_prev (
    id                      INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    fname                   VARCHAR(255) NOT NULL,
    lname                   VARCHAR(255) NOT NULL,
    email                   VARCHAR(90)  NOT NULL,
    password                VARCHAR(255) NOT NULL,
    activationcode          VARCHAR(255) NOT NULL,
    phoneno                 INTEGER      NOT NULL,
    type                    SMALLINT     NOT NULL DEFAULT 1,  -- 1=user, 2=mechanic, 3=insurer, 4=vendor
    username                VARCHAR(60)  NOT NULL,
    location                VARCHAR(65)  NOT NULL,
    last_login              TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    createdon               TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    forgotten_password_code VARCHAR(255) DEFAULT NULL,
    forgotten_password_time TIMESTAMP    DEFAULT NULL,
    active                  SMALLINT     NOT NULL DEFAULT 0,
    status                  SMALLINT     NOT NULL DEFAULT 0,
    role                    VARCHAR(55)  NOT NULL,
    ip_address              VARCHAR(55)  NOT NULL
);

CREATE TRIGGER users_prev_update_last_login
    BEFORE UPDATE ON users_prev
    FOR EACH ROW
    EXECUTE FUNCTION update_modified_column();

-- ============================================================
-- 30. users_public
-- ============================================================
DROP TABLE IF EXISTS users_public CASCADE;
CREATE TABLE users_public (
    id       INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name     VARCHAR(255) NOT NULL,
    email    VARCHAR(255) NOT NULL,
    phone    VARCHAR(100) NOT NULL,
    password VARCHAR(40)  NOT NULL,
    created  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TRIGGER users_public_update_created
    BEFORE UPDATE ON users_public
    FOR EACH ROW
    EXECUTE FUNCTION update_created_column();

-- ============================================================
-- 31. value_store
-- ============================================================
DROP TABLE IF EXISTS value_store CASCADE;
CREATE TABLE value_store (
    id     INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    thekey VARCHAR(50) NOT NULL,
    value  TEXT        NOT NULL
);

CREATE INDEX idx_value_store_thekey ON value_store (thekey);

-- ============================================================
-- Seed data: active_pages
-- ============================================================
INSERT INTO active_pages (id, name, enabled) OVERRIDING SYSTEM VALUE VALUES
(1, 'blog', TRUE);
SELECT setval(pg_get_serial_sequence('active_pages', 'id'), (SELECT MAX(id) FROM active_pages));

-- ============================================================
-- Seed data: cookie_law
-- ============================================================
INSERT INTO cookie_law (id, link, theme, visibility) OVERRIDING SYSTEM VALUE VALUES
(1, '/cookie-policy', 'dark', FALSE);
SELECT setval(pg_get_serial_sequence('cookie_law', 'id'), (SELECT MAX(id) FROM cookie_law));

-- ============================================================
-- Seed data: languages
-- ============================================================
INSERT INTO languages (id, abbr, name, currency, "currencyKey", flag) OVERRIDING SYSTEM VALUE VALUES
(1, 'en', 'English', '$', 'USD', 'us'),
(2, 'bg', 'Bulgarian', 'лв.', 'BGN', 'bg');
SELECT setval(pg_get_serial_sequence('languages', 'id'), (SELECT MAX(id) FROM languages));

-- ============================================================
-- Seed data: seo_pages
-- ============================================================
INSERT INTO seo_pages (id, name) OVERRIDING SYSTEM VALUE VALUES
(1, 'home'),
(2, 'contacts'),
(3, 'blog'),
(4, 'product');
SELECT setval(pg_get_serial_sequence('seo_pages', 'id'), (SELECT MAX(id) FROM seo_pages));

-- ============================================================
-- Seed data: users (admin accounts)
-- ============================================================
INSERT INTO users (id, username, password, email, notify, last_login) OVERRIDING SYSTEM VALUE VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'info@alphawonders.com', FALSE, 1568711629),
(2, 'Mervo', '21232f297a57a5a743894a0e4a801fc3', 'info@alphawonders.com', FALSE, NULL);
SELECT setval(pg_get_serial_sequence('users', 'id'), (SELECT MAX(id) FROM users));

-- ============================================================
-- NOTE: Additional seed data (blog posts, products, translations,
-- subscriptions, messages, etc.) should be migrated from MySQL
-- using a data export tool like pgloader or manually adapted
-- INSERT statements from public/assets/alphawonders.sql
-- ============================================================

COMMIT;
