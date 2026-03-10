<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<?php
    $activeServices = array_filter($services, fn($s) => $s['status'] === 'active');
    $disabledServices = array_filter($services, fn($s) => $s['status'] === 'disabled');
?>

<div class="mb-4">
    <h3 class="fw-bold mb-1">Services Overview</h3>
    <p class="text-muted">Your service offerings and their hire activity.</p>
</div>

<!-- CMS Tip: Related Blog Posts on Service Pages -->
<div class="alert alert-info border-0 shadow-sm mb-4" role="alert">
    <div class="d-flex align-items-start">
        <i class="fa-solid fa-lightbulb text-info me-3 mt-1"></i>
        <div>
            <strong>How "Related Reading" works on service pages</strong>
            <p class="mb-1 small">Each service page automatically displays up to <strong>6 related blog posts</strong> as cards (with image, title, excerpt) based on blog categories. A "View All" link directs visitors to the full category archive. To control which posts appear:</p>
            <ol class="small mb-0">
                <li>Go to <strong>Blog &rarr; Create/Edit Post</strong></li>
                <li>Assign the post to a relevant category (e.g. "Software Development", "SEO", "AI")</li>
                <li>The post will automatically appear in the "Related Reading" section of the matching service page</li>
            </ol>
            <p class="mb-0 small text-muted mt-1"><em>Category slug mapping: software/web-development &rarr; Software page, seo/digital-marketing &rarr; SEO page, ai/machine-learning &rarr; AI page, etc. Use the Preview button to verify.</em></p>
        </div>
    </div>
</div>

<div class="row g-4">
    <?php foreach ($activeServices as $service): ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-<?= $service['color']; ?> bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width:56px;height:56px">
                        <i class="fa-solid <?= $service['icon']; ?> fa-lg text-<?= $service['color']; ?>"></i>
                    </div>
                    <h6 class="fw-bold"><?= esc($service['name']); ?></h6>
                    <p class="text-muted small mb-3"><?= esc($service['desc']); ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-dark"><?= $service['hire_count']; ?> hires</span>
                        <div>
                            <a href="<?= base_url('aw-cp/services/preview/' . $service['view']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary me-1" title="Preview">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="<?= base_url($service['route']); ?>" target="_blank" class="btn btn-sm btn-outline-<?= $service['color']; ?>" title="View live page">
                                <i class="fa-solid fa-external-link"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php if (!empty($disabledServices)): ?>
<div class="mt-5 mb-4">
    <h5 class="fw-bold mb-1 text-muted"><i class="fa-solid fa-eye-slash me-2"></i>Disabled Services</h5>
    <p class="text-muted small">These services have view files but are not publicly routed.</p>
</div>

<div class="row g-4">
    <?php foreach ($disabledServices as $service): ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100" style="opacity: 0.65;">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <span class="badge bg-warning text-dark"><i class="fa-solid fa-ban me-1"></i>Disabled</span>
                    </div>
                    <div class="rounded-circle bg-<?= $service['color']; ?> bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width:56px;height:56px">
                        <i class="fa-solid <?= $service['icon']; ?> fa-lg text-<?= $service['color']; ?>"></i>
                    </div>
                    <h6 class="fw-bold"><?= esc($service['name']); ?></h6>
                    <p class="text-muted small mb-3"><?= esc($service['desc']); ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-dark"><?= $service['hire_count']; ?> hires</span>
                        <a href="<?= base_url('aw-cp/services/preview/' . $service['view']); ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Preview">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
