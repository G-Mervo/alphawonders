<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="mb-4">
    <h3 class="fw-bold mb-1">Settings</h3>
    <p class="text-muted">Configure your site, analytics, and integrations.</p>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<form method="post" action="<?= base_url('aw-cp/settings'); ?>">
    <div class="row g-4">
        <!-- Google Analytics / Search Console -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold">
                    <i class="fa-brands fa-google me-2 text-danger"></i>Google Integrations
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="google_analytics_id" class="form-label">Google Analytics Measurement ID</label>
                        <input type="text" class="form-control" name="google_analytics_id" id="google_analytics_id"
                               value="<?= esc($settings['google_analytics_id'] ?? ''); ?>"
                               placeholder="G-XXXXXXXXXX">
                        <div class="form-text">Find this in Google Analytics > Admin > Data Streams. The tracking code will be automatically added to your site.</div>
                    </div>
                    <div class="mb-3">
                        <label for="google_search_console_meta" class="form-label">Google Search Console Verification</label>
                        <input type="text" class="form-control" name="google_search_console_meta" id="google_search_console_meta"
                               value="<?= esc($settings['google_search_console_meta'] ?? ''); ?>"
                               placeholder="content value from meta tag">
                        <div class="form-text">Go to <a href="https://search.google.com/search-console" target="_blank">Search Console</a> > Settings > Ownership verification > HTML tag. Paste only the <code>content</code> value.</div>
                    </div>
                    <div class="alert alert-info small mb-0">
                        <i class="fa-solid fa-circle-info me-1"></i>
                        <strong>Setup Guide:</strong>
                        <ol class="mb-0 mt-1">
                            <li>Create a <a href="https://analytics.google.com" target="_blank">Google Analytics 4</a> property</li>
                            <li>Copy the Measurement ID (starts with G-)</li>
                            <li>Paste it above and save</li>
                            <li>For Search Console, <a href="https://search.google.com/search-console/about" target="_blank">verify your site</a> using the HTML tag method</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Site Settings -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-semibold">
                    <i class="fa-solid fa-globe me-2 text-primary"></i>Site Information
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="site_name" class="form-label">Site Name</label>
                        <input type="text" class="form-control" name="site_name" id="site_name"
                               value="<?= esc($settings['site_name'] ?? 'Alphawonders'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="site_description" class="form-label">Site Description</label>
                        <input type="text" class="form-control" name="site_description" id="site_description"
                               value="<?= esc($settings['site_description'] ?? ''); ?>">
                    </div>
                    <div class="mb-0">
                        <label for="contact_email" class="form-label">Contact Email</label>
                        <input type="email" class="form-control" name="contact_email" id="contact_email"
                               value="<?= esc($settings['contact_email'] ?? ''); ?>">
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold">
                    <i class="fa-solid fa-share-nodes me-2 text-info"></i>Social Media
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label"><i class="fa-brands fa-facebook me-1"></i>Facebook</label>
                        <input type="url" class="form-control" name="social_facebook"
                               value="<?= esc($settings['social_facebook'] ?? ''); ?>" placeholder="https://facebook.com/...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fa-brands fa-twitter me-1"></i>Twitter / X</label>
                        <input type="url" class="form-control" name="social_twitter"
                               value="<?= esc($settings['social_twitter'] ?? ''); ?>" placeholder="https://twitter.com/...">
                    </div>
                    <div class="mb-0">
                        <label class="form-label"><i class="fa-brands fa-linkedin me-1"></i>LinkedIn</label>
                        <input type="url" class="form-control" name="social_linkedin"
                               value="<?= esc($settings['social_linkedin'] ?? ''); ?>" placeholder="https://linkedin.com/...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary btn-lg px-5">
            <i class="fa-solid fa-check me-2"></i>Save Settings
        </button>
    </div>
</form>
