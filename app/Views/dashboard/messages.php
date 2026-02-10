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
                                    <button type="button" class="btn btn-sm btn-outline-success ai-reply-btn"
                                            data-name="<?= esc($msg['full_name'] ?? ''); ?>"
                                            data-email="<?= esc($msg['email_addr'] ?? ''); ?>"
                                            data-message="<?= esc($msg['message'] ?? ''); ?>"
                                            data-subject="<?= esc($msg['subject'] ?? ''); ?>"
                                            title="AI Draft Reply">
                                        <i class="fa-solid fa-robot"></i>
                                    </button>
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

<!-- AI Reply Draft Modal -->
<div class="modal fade" id="aiReplyModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-robot me-2"></i>AI Draft Reply</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Replying to: <span id="replyToName" class="text-primary"></span></label>
                </div>
                <div id="aiReplyLoading" class="text-center py-4">
                    <div class="spinner-border text-success" role="status"></div>
                    <p class="text-muted mt-2">Generating draft reply...</p>
                </div>
                <div id="aiReplyContent" class="d-none">
                    <textarea class="form-control" id="aiReplyText" rows="8" readonly></textarea>
                </div>
                <div id="aiReplyError" class="alert alert-danger d-none"></div>
            </div>
            <div class="modal-footer" id="aiReplyFooter" style="display:none;">
                <button type="button" class="btn btn-outline-secondary" id="copyReplyBtn">
                    <i class="fa-solid fa-copy me-1"></i> Copy to Clipboard
                </button>
                <a href="#" class="btn btn-primary" id="mailtoReplyBtn" target="_blank">
                    <i class="fa-solid fa-envelope me-1"></i> Open in Email
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const baseUrl = '<?= base_url(); ?>';
    const modal = new bootstrap.Modal(document.getElementById('aiReplyModal'));

    document.querySelectorAll('.ai-reply-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const name = this.dataset.name;
            const email = this.dataset.email;
            const message = this.dataset.message;
            const subject = this.dataset.subject;

            document.getElementById('replyToName').textContent = name || 'Unknown';
            document.getElementById('aiReplyLoading').classList.remove('d-none');
            document.getElementById('aiReplyContent').classList.add('d-none');
            document.getElementById('aiReplyError').classList.add('d-none');
            document.getElementById('aiReplyFooter').style.display = 'none';

            modal.show();

            fetch(baseUrl + '/aw-cp/ai/draft-reply', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest'},
                body: 'sender_name=' + encodeURIComponent(name) + '&message=' + encodeURIComponent(message) + '&subject=' + encodeURIComponent(subject)
            })
            .then(r => r.json())
            .then(data => {
                document.getElementById('aiReplyLoading').classList.add('d-none');
                if (data.success) {
                    document.getElementById('aiReplyText').value = data.content;
                    document.getElementById('aiReplyContent').classList.remove('d-none');
                    document.getElementById('aiReplyFooter').style.display = 'flex';

                    const subjectLine = subject ? 'Re: ' + subject : 'Re: Your message to Alphawonders';
                    document.getElementById('mailtoReplyBtn').href = 'mailto:' + encodeURIComponent(email) + '?subject=' + encodeURIComponent(subjectLine) + '&body=' + encodeURIComponent(data.content);
                } else {
                    document.getElementById('aiReplyError').textContent = data.error || 'Failed to generate reply.';
                    document.getElementById('aiReplyError').classList.remove('d-none');
                }
            })
            .catch(() => {
                document.getElementById('aiReplyLoading').classList.add('d-none');
                document.getElementById('aiReplyError').textContent = 'Network error. Please try again.';
                document.getElementById('aiReplyError').classList.remove('d-none');
            });
        });
    });

    document.getElementById('copyReplyBtn')?.addEventListener('click', function() {
        const text = document.getElementById('aiReplyText').value;
        navigator.clipboard.writeText(text).then(() => {
            this.innerHTML = '<i class="fa-solid fa-check me-1"></i> Copied!';
            setTimeout(() => { this.innerHTML = '<i class="fa-solid fa-copy me-1"></i> Copy to Clipboard'; }, 2000);
        });
    });
});
</script>
