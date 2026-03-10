<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
	<div>
		<h3 class="fw-bold mb-1">Newsletter Subscribers</h3>
		<p class="text-muted mb-0">Manage email subscribers from the website.</p>
	</div>
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

<!-- Filter Tabs -->
<ul class="nav nav-pills mb-3">
	<li class="nav-item">
		<a class="nav-link <?= ($currentFilter ?? 'all') === 'all' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/subscribers'); ?>">
			All <span class="badge bg-secondary ms-1"><?= $totalAll ?? 0; ?></span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= ($currentFilter ?? '') === 'active' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/subscribers?filter=active'); ?>">
			Active <span class="badge bg-success ms-1"><?= $totalActive ?? 0; ?></span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= ($currentFilter ?? '') === 'spam' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/subscribers?filter=spam'); ?>">
			Spam <span class="badge bg-danger ms-1"><?= $totalSpam ?? 0; ?></span>
		</a>
	</li>
</ul>

<div class="card border-0 shadow-sm">
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-hover mb-0">
				<thead class="table-light">
					<tr>
						<th>#</th>
						<th>Email</th>
						<th>Status</th>
						<th>Device</th>
						<th>Platform</th>
						<th>IP / Country</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($subscribers)): ?>
						<?php foreach ($subscribers as $i => $sub): ?>
							<tr class="<?= !empty($sub['is_spam']) ? 'table-danger bg-opacity-10' : ''; ?>">
								<td><?= $i + 1; ?></td>
								<td>
									<a href="<?= base_url('aw-cp/subscribers/view/' . $sub['id']); ?>" class="fw-semibold text-decoration-none">
										<?= esc($sub['email']); ?>
									</a>
								</td>
								<td>
									<?php if (!empty($sub['is_spam'])): ?>
										<span class="badge bg-danger">Spam</span>
									<?php else: ?>
										<span class="badge bg-success">Active</span>
									<?php endif; ?>
								</td>
								<td><span class="badge bg-light text-dark"><?= esc($sub['device'] ?? '-'); ?></span></td>
								<td class="small"><?= esc($sub['platform'] ?? '-'); ?></td>
								<td class="small">
									<code><?= esc($sub['ip_address'] ?? '-'); ?></code>
									<?php if (!empty($sub['country'])): ?>
										<br><span class="text-muted"><?= esc($sub['country']); ?></span>
									<?php endif; ?>
								</td>
								<td class="small text-muted text-nowrap"><?= isset($sub['created_at']) ? date('M d, Y', strtotime($sub['created_at'])) : '-'; ?></td>
								<td class="text-nowrap">
									<a href="<?= base_url('aw-cp/subscribers/view/' . $sub['id']); ?>" class="btn btn-sm btn-outline-info" title="View Details">
										<i class="fa-solid fa-eye"></i>
									</a>
									<a href="<?= base_url('aw-cp/subscribers/spam/' . $sub['id']); ?>" class="btn btn-sm btn-outline-warning" title="<?= !empty($sub['is_spam']) ? 'Remove from Spam' : 'Mark as Spam'; ?>">
										<i class="fa-solid fa-<?= !empty($sub['is_spam']) ? 'check' : 'ban'; ?>"></i>
									</a>
									<a href="<?= base_url('aw-cp/subscribers/delete/' . $sub['id']); ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Delete this subscriber?');">
										<i class="fa-solid fa-trash"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="8" class="text-center py-4 text-muted">No subscribers found.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
