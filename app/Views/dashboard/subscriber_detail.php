<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h3 class="fw-bold mb-0">Subscriber Details</h3>
	<a href="<?= base_url('aw-cp/subscribers'); ?>" class="btn btn-outline-secondary">
		<i class="fa-solid fa-arrow-left me-1"></i> Back to Subscribers
	</a>
</div>

<div class="row g-4">
	<div class="col-lg-6">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white fw-semibold">Contact Information</div>
			<div class="card-body">
				<table class="table table-borderless mb-0">
					<tr>
						<th class="text-muted" style="width: 35%;">Email</th>
						<td><strong><?= esc($subscriber['email']); ?></strong></td>
					</tr>
					<tr>
						<th class="text-muted">Status</th>
						<td>
							<?php if (!empty($subscriber['is_spam'])): ?>
								<span class="badge bg-danger">Spam</span>
							<?php else: ?>
								<span class="badge bg-success">Active</span>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<th class="text-muted">Subscribed On</th>
						<td><?= isset($subscriber['created_at']) ? date('F d, Y \a\t h:i A', strtotime($subscriber['created_at'])) : '-'; ?></td>
					</tr>
					<tr>
						<th class="text-muted">Referral Source</th>
						<td><?= esc($subscriber['referral'] ?? '-'); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white fw-semibold">Technical Details</div>
			<div class="card-body">
				<table class="table table-borderless mb-0">
					<tr>
						<th class="text-muted" style="width: 35%;">IP Address</th>
						<td><code><?= esc($subscriber['ip_address'] ?? '-'); ?></code></td>
					</tr>
					<tr>
						<th class="text-muted">Country</th>
						<td><?= esc($subscriber['country'] ?? '-'); ?></td>
					</tr>
					<tr>
						<th class="text-muted">Device</th>
						<td><?= esc($subscriber['device'] ?? '-'); ?></td>
					</tr>
					<tr>
						<th class="text-muted">Platform</th>
						<td><?= esc($subscriber['platform'] ?? '-'); ?></td>
					</tr>
					<tr>
						<th class="text-muted">Browser</th>
						<td><?= esc($subscriber['browser_name'] ?? '-'); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Actions -->
<div class="mt-4 d-flex gap-2">
	<a href="mailto:<?= esc($subscriber['email']); ?>" class="btn btn-primary">
		<i class="fa-solid fa-envelope me-1"></i> Send Email
	</a>
	<a href="<?= base_url('aw-cp/subscribers/spam/' . $subscriber['id']); ?>" class="btn btn-<?= !empty($subscriber['is_spam']) ? 'success' : 'warning'; ?>">
		<i class="fa-solid fa-<?= !empty($subscriber['is_spam']) ? 'check' : 'ban'; ?> me-1"></i>
		<?= !empty($subscriber['is_spam']) ? 'Remove from Spam' : 'Mark as Spam'; ?>
	</a>
	<a href="<?= base_url('aw-cp/subscribers/delete/' . $subscriber['id']); ?>" class="btn btn-danger" onclick="return confirm('Permanently delete this subscriber?');">
		<i class="fa-solid fa-trash me-1"></i> Delete
	</a>
</div>
