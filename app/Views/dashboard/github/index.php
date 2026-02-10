<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">GitHub Projects</h3>
        <p class="text-muted mb-0">Manage your repositories, issues, and releases.</p>
    </div>
    <?php if (!empty($configured) && !empty($ghUser)): ?>
    <a href="<?= base_url('aw-cp/github/create'); ?>" class="btn btn-success">
        <i class="fa-solid fa-plus me-1"></i> New Repository
    </a>
    <?php endif; ?>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (empty($configured)): ?>
    <!-- Not Configured -->
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <i class="fa-brands fa-github fa-4x text-muted mb-3"></i>
            <h4>Connect Your GitHub Account</h4>
            <p class="text-muted mb-4">Add your GitHub Personal Access Token in Settings to manage your repositories from this dashboard.</p>
            <a href="<?= base_url('aw-cp/settings'); ?>" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-gear me-2"></i>Go to Settings
            </a>
        </div>
    </div>
<?php elseif (!empty($error)): ?>
    <div class="alert alert-danger">
        <i class="fa-solid fa-triangle-exclamation me-2"></i>
        GitHub API Error: <?= esc($error); ?>
        <br><small>Check your token in <a href="<?= base_url('aw-cp/settings'); ?>">Settings</a>.</small>
    </div>
<?php else: ?>
    <!-- GitHub User Info -->
    <?php if (!empty($ghUser)): ?>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex align-items-center">
            <img src="<?= esc($ghUser['avatar_url'] ?? ''); ?>" class="rounded-circle me-3" width="48" height="48" alt="avatar">
            <div>
                <h5 class="mb-0"><?= esc($ghUser['name'] ?? $ghUser['login'] ?? ''); ?></h5>
                <span class="text-muted">@<?= esc($ghUser['login'] ?? ''); ?></span>
                <?php if (!empty($ghUser['bio'])): ?>
                    <span class="text-muted ms-2">&mdash; <?= esc($ghUser['bio']); ?></span>
                <?php endif; ?>
            </div>
            <div class="ms-auto text-end">
                <span class="badge bg-light text-dark me-2"><i class="fa-solid fa-book me-1"></i><?= $ghUser['public_repos'] ?? 0; ?> repos</span>
                <span class="badge bg-light text-dark"><i class="fa-solid fa-users me-1"></i><?= $ghUser['followers'] ?? 0; ?> followers</span>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Repos Grid -->
    <?php if (!empty($repos)): ?>
    <div class="row g-3">
        <?php foreach ($repos as $repo): ?>
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="card-title mb-0">
                            <a href="<?= base_url('aw-cp/github/repo/' . esc($repo['owner']['login']) . '/' . esc($repo['name'])); ?>" class="text-decoration-none">
                                <?= esc($repo['name']); ?>
                            </a>
                        </h6>
                        <span class="badge bg-<?= ($repo['private'] ?? false) ? 'warning text-dark' : 'success'; ?> small">
                            <?= ($repo['private'] ?? false) ? 'Private' : 'Public'; ?>
                        </span>
                    </div>
                    <?php if (!empty($repo['description'])): ?>
                        <p class="card-text text-muted small mb-2"><?= esc(mb_strimwidth($repo['description'], 0, 100, '...')); ?></p>
                    <?php else: ?>
                        <p class="card-text text-muted small fst-italic mb-2">No description</p>
                    <?php endif; ?>
                    <div class="d-flex flex-wrap gap-2 small text-muted">
                        <?php if (!empty($repo['language'])): ?>
                            <span><i class="fa-solid fa-circle fa-xs me-1" style="color: #3178c6;"></i><?= esc($repo['language']); ?></span>
                        <?php endif; ?>
                        <span><i class="fa-regular fa-star me-1"></i><?= $repo['stargazers_count'] ?? 0; ?></span>
                        <span><i class="fa-solid fa-code-fork me-1"></i><?= $repo['forks_count'] ?? 0; ?></span>
                        <?php if (!empty($repo['pushed_at'])): ?>
                            <span class="ms-auto"><i class="fa-regular fa-clock me-1"></i><?= date('M d', strtotime($repo['pushed_at'])); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5 text-muted">
                <i class="fa-solid fa-folder-open fa-3x mb-3"></i>
                <p>No repositories found.</p>
                <a href="<?= base_url('aw-cp/github/create'); ?>" class="btn btn-primary">Create Your First Repository</a>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
