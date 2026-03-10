<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h3 class="fw-bold mb-0">Login Attempts Audit Log</h3>
</div>

<!-- Summary Cards -->
<div class="row g-3 mb-4">
	<div class="col-md-4">
		<div class="card border-0 shadow-sm text-center">
			<div class="card-body">
				<div class="fs-3 fw-bold"><?= number_format($totalAll); ?></div>
				<div class="text-muted small">Total Attempts</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card border-0 shadow-sm text-center">
			<div class="card-body">
				<div class="fs-3 fw-bold text-success"><?= number_format($totalSuccess); ?></div>
				<div class="text-muted small">Successful Logins</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card border-0 shadow-sm text-center">
			<div class="card-body">
				<div class="fs-3 fw-bold text-danger"><?= number_format($totalFailed); ?></div>
				<div class="text-muted small">Failed Attempts</div>
			</div>
		</div>
	</div>
</div>

<!-- Top Offending IPs (last 30 days) -->
<?php if (!empty($topIPs)): ?>
<div class="card border-0 shadow-sm mb-4">
	<div class="card-header bg-white fw-semibold">
		<i class="fa-solid fa-triangle-exclamation text-warning me-2"></i>Top Offending IPs (Last 30 Days)
	</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-sm table-hover mb-0">
				<thead class="table-light">
					<tr>
						<th>IP Address</th>
						<th>Failed Attempts</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($topIPs as $entry): ?>
					<tr>
						<td><code><?= esc($entry['ip_address']); ?></code></td>
						<td><span class="badge bg-danger"><?= $entry['failures']; ?></span></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php endif; ?>

<!-- Filter Tabs -->
<ul class="nav nav-pills mb-3">
	<li class="nav-item">
		<a class="nav-link <?= $currentFilter === 'all' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/login-attempts'); ?>">
			All <span class="badge bg-secondary ms-1"><?= $totalAll; ?></span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= $currentFilter === 'failed' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/login-attempts?filter=failed'); ?>">
			Failed <span class="badge bg-danger ms-1"><?= $totalFailed; ?></span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= $currentFilter === 'success' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/login-attempts?filter=success'); ?>">
			Successful <span class="badge bg-success ms-1"><?= $totalSuccess; ?></span>
		</a>
	</li>
</ul>

<!-- Attempts Table -->
<div class="card border-0 shadow-sm">
	<div class="card-header bg-white fw-semibold">Login Attempts</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-striped table-hover mb-0">
				<thead class="table-light">
					<tr>
						<th>#</th>
						<th>Date & Time</th>
						<th>Username</th>
						<th>IP Address</th>
						<th>Status</th>
						<th>Reason</th>
						<th>User Agent</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($attempts)): ?>
						<?php foreach ($attempts as $i => $attempt): ?>
						<tr>
							<td><?= ($currentPage - 1) * 50 + $i + 1; ?></td>
							<td class="text-nowrap"><?= date('M d, Y H:i:s', strtotime($attempt['attempted_at'])); ?></td>
							<td><code><?= esc($attempt['username']); ?></code></td>
							<td><code><?= esc($attempt['ip_address']); ?></code></td>
							<td>
								<?php if ($attempt['success']): ?>
									<span class="badge bg-success">Success</span>
								<?php else: ?>
									<span class="badge bg-danger">Failed</span>
								<?php endif; ?>
							</td>
							<td><?= esc($attempt['failure_reason'] ?? '-'); ?></td>
							<td>
								<span class="d-inline-block text-truncate" style="max-width: 250px;" title="<?= esc($attempt['user_agent'] ?? ''); ?>">
									<?= esc($attempt['user_agent'] ?? '-'); ?>
								</span>
							</td>
						</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="7" class="text-center py-4 text-muted">No login attempts recorded yet.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Pagination -->
	<?php if ($totalPages > 1): ?>
	<div class="card-footer bg-white">
		<nav>
			<ul class="pagination pagination-sm justify-content-center mb-0">
				<li class="page-item <?= $currentPage <= 1 ? 'disabled' : ''; ?>">
					<a class="page-link" href="<?= base_url('aw-cp/login-attempts?filter=' . $currentFilter . '&page=' . ($currentPage - 1)); ?>">Previous</a>
				</li>
				<?php
				$start = max(1, $currentPage - 2);
				$end = min($totalPages, $currentPage + 2);
				for ($p = $start; $p <= $end; $p++): ?>
					<li class="page-item <?= $p === $currentPage ? 'active' : ''; ?>">
						<a class="page-link" href="<?= base_url('aw-cp/login-attempts?filter=' . $currentFilter . '&page=' . $p); ?>"><?= $p; ?></a>
					</li>
				<?php endfor; ?>
				<li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : ''; ?>">
					<a class="page-link" href="<?= base_url('aw-cp/login-attempts?filter=' . $currentFilter . '&page=' . ($currentPage + 1)); ?>">Next</a>
				</li>
			</ul>
		</nav>
	</div>
	<?php endif; ?>
</div>
