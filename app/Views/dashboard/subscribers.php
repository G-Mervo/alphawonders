<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="mb-4">
    <h3 class="fw-bold mb-1">Newsletter Subscribers</h3>
    <p class="text-muted">Email subscribers from the website.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Device</th>
                        <th>Platform</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($subscribers)): ?>
                        <?php foreach ($subscribers as $i => $sub): ?>
                            <tr>
                                <td><?= $i + 1; ?></td>
                                <td><strong><?= esc($sub['email']); ?></strong></td>
                                <td><span class="badge bg-light text-dark"><?= esc($sub['device'] ?? '-'); ?></span></td>
                                <td class="small"><?= esc($sub['platform'] ?? '-'); ?></td>
                                <td class="small text-muted"><?= isset($sub['created_at']) ? date('M d, Y', strtotime($sub['created_at'])) : '-'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No subscribers yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
