<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="mb-4">
    <h3 class="fw-bold mb-1">Services Overview</h3>
    <p class="text-muted">Your service offerings and their hire activity.</p>
</div>

<div class="row g-4">
    <?php foreach ($services as $service): ?>
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
                        <a href="<?= base_url($service['route']); ?>" target="_blank" class="btn btn-sm btn-outline-<?= $service['color']; ?>">
                            <i class="fa-solid fa-external-link"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
