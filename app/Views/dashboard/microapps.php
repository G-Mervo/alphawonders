<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Microapps</h3>
        <p class="text-muted mb-0">Prototype and preview standalone product ideas.</p>
    </div>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (!empty($microapps)): ?>
<div class="row g-3">
    <?php foreach ($microapps as $app): ?>
    <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle bg-<?= esc($app['color']); ?> bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <i class="fa-solid <?= esc($app['icon']); ?> text-<?= esc($app['color']); ?> fa-lg"></i>
                    </div>
                    <h5 class="card-title mb-0 ms-3"><?= esc($app['name']); ?></h5>
                </div>
                <p class="card-text text-muted small flex-grow-1"><?= esc($app['description']); ?></p>
                <a href="<?= base_url('aw-cp/microapps/' . esc($app['slug'])); ?>" class="btn btn-outline-<?= esc($app['color']); ?> mt-2">
                    <i class="fa-solid fa-eye me-1"></i> Preview
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5 text-muted">
            <i class="fa-solid fa-flask fa-3x mb-3"></i>
            <p>No microapps available yet.</p>
        </div>
    </div>
<?php endif; ?>
