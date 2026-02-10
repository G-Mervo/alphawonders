<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Projects & Hires</h3>
        <p class="text-muted mb-0">Manage client project requests and track their progress.</p>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Status Filter Pills -->
<div class="mb-4">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link <?= ($currentStatus ?? 'all') === 'all' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/hires'); ?>">
                All <span class="badge bg-light text-dark ms-1"><?= $allCount ?? 0; ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($currentStatus ?? '') === 'pending' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/hires?status=pending'); ?>">
                Pending <span class="badge bg-warning text-dark ms-1"><?= $pendingCount ?? 0; ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($currentStatus ?? '') === 'ongoing' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/hires?status=ongoing'); ?>">
                Ongoing <span class="badge bg-primary ms-1"><?= $ongoingCount ?? 0; ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($currentStatus ?? '') === 'completed' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/hires?status=completed'); ?>">
                Completed <span class="badge bg-success ms-1"><?= $completedCount ?? 0; ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($currentStatus ?? '') === 'cancelled' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/hires?status=cancelled'); ?>">
                Cancelled <span class="badge bg-secondary ms-1"><?= $cancelledCount ?? 0; ?></span>
            </a>
        </li>
    </ul>
</div>

<!-- Hires Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Client</th>
                        <th>Project</th>
                        <th>Type</th>
                        <th>Budget</th>
                        <th>Timeline</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($hires)): ?>
                        <?php
                        $statusColors = ['pending' => 'warning', 'ongoing' => 'primary', 'completed' => 'success', 'cancelled' => 'secondary'];
                        foreach ($hires as $hire):
                            $s = $hire['status'] ?? 'pending';
                        ?>
                            <tr>
                                <td>
                                    <strong><?= esc($hire['name']); ?></strong>
                                    <div class="text-muted small"><?= esc($hire['email']); ?></div>
                                    <?php if (!empty($hire['company_name'])): ?>
                                        <div class="text-muted small"><i class="fa-solid fa-building me-1"></i><?= esc($hire['company_name']); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width:200px" title="<?= esc($hire['description']); ?>">
                                        <?= esc(mb_strimwidth($hire['description'], 0, 60, '...')); ?>
                                    </span>
                                </td>
                                <td><span class="badge bg-light text-dark"><?= esc($hire['work']); ?></span></td>
                                <td class="fw-semibold"><?= esc($hire['budget']); ?></td>
                                <td class="small"><?= esc($hire['timeline'] ?? '-'); ?></td>
                                <td><span class="badge bg-<?= $statusColors[$s] ?? 'secondary'; ?> <?= $s === 'pending' ? 'text-dark' : ''; ?>"><?= ucfirst($s); ?></span></td>
                                <td class="small text-muted"><?= date('M d, Y', strtotime($hire['date_created'])); ?></td>
                                <td>
                                    <a href="<?= base_url('aw-cp/hires/view/' . $hire['id']); ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No hire requests found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
