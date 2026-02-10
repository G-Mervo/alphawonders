<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">
            <a href="<?= base_url('aw-cp/github'); ?>" class="text-decoration-none text-muted">GitHub</a>
            <i class="fa-solid fa-chevron-right mx-2 small"></i>
            <?= esc($owner); ?>/<?= esc($repoName); ?>
        </h3>
        <?php if (!empty($repo['description'])): ?>
            <p class="text-muted mb-0"><?= esc($repo['description']); ?></p>
        <?php endif; ?>
    </div>
    <a href="<?= base_url('aw-cp/github'); ?>" class="btn btn-outline-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Back
    </a>
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

<div class="row g-4">
    <!-- Main Column -->
    <div class="col-lg-8">
        <!-- Repo Info -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-circle-info me-2"></i>Repository Info
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <strong>Visibility:</strong>
                        <span class="badge bg-<?= ($repo['private'] ?? false) ? 'warning text-dark' : 'success'; ?> ms-1">
                            <?= ($repo['private'] ?? false) ? 'Private' : 'Public'; ?>
                        </span>
                    </div>
                    <div class="col-sm-6"><strong>Default Branch:</strong> <?= esc($repo['default_branch'] ?? 'main'); ?></div>
                    <div class="col-sm-6"><strong>Created:</strong> <?= !empty($repo['created_at']) ? date('M d, Y', strtotime($repo['created_at'])) : '-'; ?></div>
                    <div class="col-sm-6"><strong>Last Push:</strong> <?= !empty($repo['pushed_at']) ? date('M d, Y H:i', strtotime($repo['pushed_at'])) : '-'; ?></div>
                    <?php if (!empty($repo['homepage'])): ?>
                        <div class="col-12"><strong>Homepage:</strong> <a href="<?= esc($repo['homepage']); ?>" target="_blank"><?= esc($repo['homepage']); ?></a></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Language Breakdown -->
        <?php if (!empty($languages)): ?>
        <?php $totalBytes = array_sum($languages); ?>
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-code me-2"></i>Languages
            </div>
            <div class="card-body">
                <div class="progress mb-3" style="height: 10px;">
                    <?php
                    $langColors = [
                        'PHP' => '#4F5D95', 'JavaScript' => '#f1e05a', 'TypeScript' => '#3178c6',
                        'Python' => '#3572A5', 'HTML' => '#e34c26', 'CSS' => '#563d7c',
                        'Java' => '#b07219', 'Go' => '#00ADD8', 'Ruby' => '#701516',
                        'Rust' => '#dea584', 'C' => '#555555', 'C++' => '#f34b7d',
                        'Shell' => '#89e051', 'Blade' => '#f7523f', 'Dockerfile' => '#384d54',
                    ];
                    foreach ($languages as $lang => $bytes):
                        $pct = $totalBytes > 0 ? round(($bytes / $totalBytes) * 100, 1) : 0;
                        $color = $langColors[$lang] ?? '#6c757d';
                    ?>
                        <div class="progress-bar" style="width: <?= $pct; ?>%; background-color: <?= $color; ?>;" title="<?= esc($lang); ?> <?= $pct; ?>%"></div>
                    <?php endforeach; ?>
                </div>
                <div class="d-flex flex-wrap gap-3 small">
                    <?php foreach ($languages as $lang => $bytes):
                        $pct = $totalBytes > 0 ? round(($bytes / $totalBytes) * 100, 1) : 0;
                        $color = $langColors[$lang] ?? '#6c757d';
                    ?>
                        <span><i class="fa-solid fa-circle fa-xs me-1" style="color: <?= $color; ?>;"></i><?= esc($lang); ?> <span class="text-muted"><?= $pct; ?>%</span></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Recent Commits -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-code-commit me-2"></i>Recent Commits
            </div>
            <div class="card-body p-0">
                <?php if (!empty($commits)): ?>
                <div class="list-group list-group-flush">
                    <?php foreach ($commits as $commit): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 fw-semibold"><?= esc(mb_strimwidth($commit['commit']['message'] ?? '', 0, 100, '...')); ?></p>
                                <small class="text-muted">
                                    <?= esc($commit['commit']['author']['name'] ?? 'Unknown'); ?>
                                    &bull;
                                    <?= !empty($commit['commit']['author']['date']) ? date('M d, Y H:i', strtotime($commit['commit']['author']['date'])) : ''; ?>
                                </small>
                            </div>
                            <code class="small text-muted"><?= substr($commit['sha'] ?? '', 0, 7); ?></code>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                    <div class="text-center py-4 text-muted">No commits found.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Sidebar Column -->
    <div class="col-lg-4">
        <!-- Stats -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-chart-bar me-2"></i>Stats
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span><i class="fa-regular fa-star me-2 text-warning"></i>Stars</span>
                    <strong><?= $repo['stargazers_count'] ?? 0; ?></strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span><i class="fa-solid fa-code-fork me-2 text-primary"></i>Forks</span>
                    <strong><?= $repo['forks_count'] ?? 0; ?></strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span><i class="fa-solid fa-circle-dot me-2 text-success"></i>Open Issues</span>
                    <strong><?= $repo['open_issues_count'] ?? 0; ?></strong>
                </div>
                <div class="d-flex justify-content-between mb-0">
                    <span><i class="fa-solid fa-eye me-2 text-info"></i>Watchers</span>
                    <strong><?= $repo['watchers_count'] ?? 0; ?></strong>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-bolt me-2"></i>Actions
            </div>
            <div class="card-body d-grid gap-2">
                <a href="<?= base_url("aw-cp/github/repo/{$owner}/{$repoName}/issues/create"); ?>" class="btn btn-outline-primary">
                    <i class="fa-solid fa-circle-dot me-2"></i>Create Issue
                </a>
                <a href="<?= base_url("aw-cp/github/repo/{$owner}/{$repoName}/releases/create"); ?>" class="btn btn-outline-success">
                    <i class="fa-solid fa-tag me-2"></i>Create Release
                </a>
                <a href="<?= esc($repo['html_url'] ?? '#'); ?>" class="btn btn-outline-dark" target="_blank">
                    <i class="fa-brands fa-github me-2"></i>View on GitHub
                </a>
            </div>
        </div>

        <!-- Open Issues -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-circle-dot me-2 text-success"></i>Open Issues
            </div>
            <div class="card-body p-0">
                <?php if (!empty($issues)): ?>
                <div class="list-group list-group-flush">
                    <?php foreach ($issues as $issue): ?>
                        <?php if (!empty($issue['pull_request'])) continue; ?>
                        <a href="<?= esc($issue['html_url'] ?? '#'); ?>" class="list-group-item list-group-item-action" target="_blank">
                            <div class="d-flex justify-content-between">
                                <span class="text-truncate" style="max-width: 200px;"><?= esc($issue['title'] ?? ''); ?></span>
                                <small class="text-muted">#<?= $issue['number'] ?? ''; ?></small>
                            </div>
                            <?php if (!empty($issue['labels'])): ?>
                                <div class="mt-1">
                                    <?php foreach ($issue['labels'] as $label): ?>
                                        <span class="badge rounded-pill" style="background-color: #<?= esc($label['color'] ?? '6c757d'); ?>; font-size: 0.7rem;"><?= esc($label['name'] ?? ''); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                    <div class="text-center py-3 text-muted small">No open issues.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
