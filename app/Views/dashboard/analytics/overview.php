<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="mb-4">
    <h3 class="fw-bold mb-1">Analytics Overview</h3>
    <p class="text-muted">Visitor insights from form submissions, comments, and interactions.</p>
</div>

<!-- Google Analytics Status -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <?php if (!empty($googleAnalyticsId)): ?>
            <div class="d-flex align-items-center">
                <span class="badge bg-success rounded-circle p-2 me-3">&nbsp;</span>
                <div>
                    <strong>Google Analytics Connected</strong>
                    <div class="text-muted small">Measurement ID: <code><?= esc($googleAnalyticsId); ?></code></div>
                </div>
                <a href="https://analytics.google.com" target="_blank" class="btn btn-sm btn-outline-primary ms-auto">
                    <i class="fa-solid fa-external-link me-1"></i>Open Google Analytics
                </a>
            </div>
        <?php else: ?>
            <div class="d-flex align-items-center">
                <span class="badge bg-warning rounded-circle p-2 me-3">&nbsp;</span>
                <div>
                    <strong>Google Analytics Not Configured</strong>
                    <div class="text-muted small">Add your Measurement ID in <a href="<?= base_url('aw-cp/settings'); ?>">Settings</a> to enable full analytics.</div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Monthly Activity Chart (HTML/CSS based) -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white fw-semibold">
        <i class="fa-solid fa-chart-bar me-2"></i>Monthly Interactions (Last 6 Months)
    </div>
    <div class="card-body">
        <?php $maxTotal = max(array_column($monthlyActivity, 'total') ?: [1]); ?>
        <div class="row g-2 align-items-end" style="min-height: 200px;">
            <?php foreach ($monthlyActivity as $month): ?>
                <div class="col text-center">
                    <?php $height = $maxTotal > 0 ? max(($month['total'] / $maxTotal) * 160, 4) : 4; ?>
                    <div class="fw-bold small mb-1"><?= $month['total']; ?></div>
                    <div class="mx-auto rounded-top" style="width: 40px; height: <?= $height; ?>px; background: linear-gradient(180deg, #0f3460, #1a1a2e);"></div>
                    <div class="small text-muted mt-2"><?= $month['month']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-3 d-flex gap-3 small text-muted">
            <span><i class="fa-solid fa-square text-primary me-1"></i>Comments</span>
            <span><i class="fa-solid fa-square text-success me-1"></i>Messages</span>
            <span><i class="fa-solid fa-square text-warning me-1"></i>Subscriptions</span>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Device Breakdown -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white fw-semibold"><i class="fa-solid fa-mobile-screen me-2"></i>Devices</div>
            <div class="card-body">
                <?php $deviceTotal = array_sum($devices) ?: 1; ?>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span><i class="fa-solid fa-desktop me-1"></i> Desktop</span>
                        <strong><?= $devices['Desktop']; ?></strong>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: <?= round($devices['Desktop'] / $deviceTotal * 100); ?>%"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between mb-1">
                        <span><i class="fa-solid fa-mobile me-1"></i> Mobile</span>
                        <strong><?= $devices['Mobile']; ?></strong>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: <?= round($devices['Mobile'] / $deviceTotal * 100); ?>%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Browser Breakdown -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white fw-semibold"><i class="fa-solid fa-globe me-2"></i>Browsers</div>
            <div class="card-body">
                <?php if (!empty($browsers)): ?>
                    <?php foreach ($browsers as $browser): ?>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small"><?= esc($browser['browser_name']); ?></span>
                            <span class="badge bg-light text-dark"><?= $browser['count']; ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted small mb-0">No browser data yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Platform Breakdown -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white fw-semibold"><i class="fa-solid fa-laptop me-2"></i>Platforms</div>
            <div class="card-body">
                <?php if (!empty($platforms)): ?>
                    <?php foreach ($platforms as $platform): ?>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small"><?= esc($platform['platform']); ?></span>
                            <span class="badge bg-light text-dark"><?= $platform['count']; ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted small mb-0">No platform data yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
