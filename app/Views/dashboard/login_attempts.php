<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<style>
	/* Expandable row styles */
	.expandable-row {
		cursor: pointer;
		transition: background-color 0.15s ease;
	}
	.expandable-row:hover {
		background-color: rgba(var(--bs-primary-rgb, 13, 110, 253), 0.04) !important;
	}
	.expandable-row .chevron-icon {
		transition: transform 0.25s ease;
		font-size: 0.75rem;
		color: #6c757d;
	}
	.expandable-row.expanded .chevron-icon {
		transform: rotate(180deg);
	}
	.detail-row {
		display: none;
	}
	.detail-row.show {
		display: table-row;
	}
	.detail-row td {
		padding: 0 !important;
		border-top: none !important;
	}
	.detail-content {
		max-height: 0;
		overflow: hidden;
		transition: max-height 0.35s ease, padding 0.35s ease;
		padding: 0 1.25rem;
	}
	.detail-row.show .detail-content {
		max-height: 500px;
		padding: 1rem 1.25rem;
	}
	.detail-card {
		background-color: #f8f9fa;
		border-radius: 0.5rem;
		padding: 1rem 1.25rem;
		border: 1px solid #e9ecef;
	}
	.detail-card .detail-label {
		font-weight: 600;
		font-size: 0.8rem;
		color: #6c757d;
		text-transform: uppercase;
		letter-spacing: 0.03em;
		margin-bottom: 0.15rem;
	}
	.detail-card .detail-value {
		font-size: 0.9rem;
		word-break: break-all;
	}
</style>

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
			<table class="table table-sm table-hover mb-0" id="topIPsTable">
				<thead class="table-light">
					<tr>
						<th>IP Address</th>
						<th>Failed Attempts</th>
						<th class="text-end" style="width: 40px;"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($topIPs as $idx => $entry): ?>
					<tr class="expandable-row" data-target="ip-detail-<?= $idx; ?>">
						<td><code><?= esc($entry['ip_address']); ?></code></td>
						<td><span class="badge bg-danger"><?= $entry['failures']; ?></span></td>
						<td class="text-end"><i class="fa-solid fa-chevron-down chevron-icon"></i></td>
					</tr>
					<tr class="detail-row" id="ip-detail-<?= $idx; ?>">
						<td colspan="3">
							<div class="detail-content">
								<div class="detail-card">
									<div class="row g-3">
										<div class="col-md-4">
											<div class="detail-label">IP Address</div>
											<div class="detail-value">
												<code><?= esc($entry['ip_address']); ?></code>
												<a href="https://ipinfo.io/<?= esc($entry['ip_address']); ?>" target="_blank" rel="noopener noreferrer" class="ms-2 small" title="Lookup IP on ipinfo.io">
													<i class="fa-solid fa-arrow-up-right-from-square"></i> Lookup
												</a>
											</div>
										</div>
										<div class="col-md-4">
											<div class="detail-label">Failed Attempts</div>
											<div class="detail-value">
												<span class="text-danger fw-semibold"><?= $entry['failures']; ?></span> failures
												<?php if (!empty($entry['attempts'])): ?>
													out of <?= $entry['attempts']; ?> total attempts
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="detail-label">Actions</div>
											<div class="detail-value">
												<a href="<?= base_url('aw-cp/login-attempts?filter=failed'); ?>" class="btn btn-outline-secondary btn-sm">
													<i class="fa-solid fa-filter me-1"></i>View Failed Attempts
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</td>
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
			<table class="table table-striped table-hover mb-0" id="attemptsTable">
				<thead class="table-light">
					<tr>
						<th>#</th>
						<th>Date & Time</th>
						<th>Username</th>
						<th>IP Address</th>
						<th>Status</th>
						<th>Reason</th>
						<th>User Agent</th>
						<th class="text-end" style="width: 40px;"></th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($attempts)): ?>
						<?php foreach ($attempts as $i => $attempt): ?>
						<tr class="expandable-row" data-target="attempt-detail-<?= $i; ?>">
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
							<td class="text-end"><i class="fa-solid fa-chevron-down chevron-icon"></i></td>
						</tr>
						<tr class="detail-row" id="attempt-detail-<?= $i; ?>">
							<td colspan="8">
								<div class="detail-content">
									<div class="detail-card">
										<div class="row g-3">
											<div class="col-md-6">
												<div class="detail-label">Full User Agent</div>
												<div class="detail-value"><code class="text-wrap"><?= esc($attempt['user_agent'] ?? '-'); ?></code></div>
											</div>
											<div class="col-md-3">
												<div class="detail-label">IP Address</div>
												<div class="detail-value">
													<code><?= esc($attempt['ip_address']); ?></code>
													<a href="https://ipinfo.io/<?= esc($attempt['ip_address']); ?>" target="_blank" rel="noopener noreferrer" class="ms-2 small" title="Lookup IP on ipinfo.io">
														<i class="fa-solid fa-arrow-up-right-from-square"></i> Lookup
													</a>
												</div>
											</div>
											<div class="col-md-3">
												<div class="detail-label">Exact Timestamp</div>
												<div class="detail-value"><?= esc($attempt['attempted_at']); ?></div>
											</div>
											<div class="col-md-3">
												<div class="detail-label">Username</div>
												<div class="detail-value"><code><?= esc($attempt['username']); ?></code></div>
											</div>
											<div class="col-md-3">
												<div class="detail-label">Status</div>
												<div class="detail-value">
													<?php if ($attempt['success']): ?>
														<span class="badge bg-success">Success</span>
													<?php else: ?>
														<span class="badge bg-danger">Failed</span>
													<?php endif; ?>
												</div>
											</div>
											<?php if (!$attempt['success'] && !empty($attempt['failure_reason'])): ?>
											<div class="col-md-6">
												<div class="detail-label">Failure Reason</div>
												<div class="detail-value text-danger"><?= esc($attempt['failure_reason']); ?></div>
											</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="8" class="text-center py-4 text-muted">No login attempts recorded yet.</td>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
	// Handle all expandable rows
	document.querySelectorAll('.expandable-row').forEach(function(row) {
		row.addEventListener('click', function(e) {
			// Don't toggle if clicking a link inside the row
			if (e.target.closest('a')) return;

			var targetId = this.getAttribute('data-target');
			var detailRow = document.getElementById(targetId);
			if (!detailRow) return;

			var isExpanded = this.classList.contains('expanded');

			if (isExpanded) {
				// Collapse
				this.classList.remove('expanded');
				detailRow.classList.remove('show');
			} else {
				// Expand
				this.classList.add('expanded');
				detailRow.classList.add('show');
			}
		});
	});
});
</script>
