<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Messages</h3>
        <p class="text-muted mb-0">Contact form submissions from visitors.</p>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($messages)): ?>
                        <?php foreach ($messages as $msg): ?>
                            <tr class="<?= empty($msg['is_read']) ? 'fw-semibold' : ''; ?>">
                                <td class="text-center">
                                    <?php if (empty($msg['is_read'])): ?>
                                        <span class="badge bg-primary rounded-circle p-1">&nbsp;</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($msg['full_name'] ?? '-'); ?></td>
                                <td><a href="mailto:<?= esc($msg['email_addr'] ?? ''); ?>"><?= esc($msg['email_addr'] ?? '-'); ?></a></td>
                                <td><?= esc($msg['phoneno'] ?? '-'); ?></td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 250px;" title="<?= esc($msg['message'] ?? ''); ?>">
                                        <?= esc($msg['message'] ?? ''); ?>
                                    </span>
                                </td>
                                <td class="text-nowrap small"><?= isset($msg['created_at']) ? date('M d, Y', strtotime($msg['created_at'])) : '-'; ?></td>
                                <td class="text-nowrap">
                                    <a href="<?= base_url('aw-cp/messages/toggle/' . $msg['id']); ?>" class="btn btn-sm btn-outline-<?= empty($msg['is_read']) ? 'success' : 'secondary'; ?>" title="<?= empty($msg['is_read']) ? 'Mark read' : 'Mark unread'; ?>">
                                        <i class="fa-solid fa-<?= empty($msg['is_read']) ? 'check' : 'envelope'; ?>"></i>
                                    </a>
                                    <a href="<?= base_url('aw-cp/messages/delete/' . $msg['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this message?');">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No messages yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
