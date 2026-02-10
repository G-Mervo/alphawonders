<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="mb-4">
	<h3 class="fw-bold mb-1">Messages</h3>
	<p class="text-muted">Contact form submissions from visitors.</p>
</div>

<div class="card border-0 shadow-sm">
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-striped table-hover mb-0">
				<thead class="table-light">
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Subject</th>
						<th>Message</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($messages)): ?>
						<?php foreach ($messages as $i => $msg): ?>
							<tr>
								<td><?= $i + 1; ?></td>
								<td><?= esc($msg['name'] ?? '-'); ?></td>
								<td><?= esc($msg['email'] ?? '-'); ?></td>
								<td><?= esc($msg['subject'] ?? '-'); ?></td>
								<td><?= esc(mb_strimwidth($msg['message'] ?? '', 0, 80, '...')); ?></td>
								<td><?= isset($msg['created_at']) ? date('M d, Y', strtotime($msg['created_at'])) : '-'; ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="6" class="text-center py-4 text-muted">No messages yet.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
