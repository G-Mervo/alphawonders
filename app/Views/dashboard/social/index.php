<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h3 class="fw-bold mb-0">Social Media Hub</h3>
	<a href="<?= base_url('aw-cp/social/create'); ?>" class="btn btn-primary">
		<i class="fa-solid fa-plus me-1"></i> Create Post
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

<!-- Platform Stat Cards -->
<div class="row g-3 mb-4">
	<?php
	$platformConfig = [
		'twitter'   => ['icon' => 'fa-brands fa-x-twitter',   'color' => 'dark',    'label' => 'X'],
		'facebook'  => ['icon' => 'fa-brands fa-facebook',    'color' => 'primary',  'label' => 'Facebook'],
		'linkedin'  => ['icon' => 'fa-brands fa-linkedin',    'color' => 'info',     'label' => 'LinkedIn'],
		'instagram' => ['icon' => 'fa-brands fa-instagram',   'color' => 'danger',   'label' => 'Instagram'],
		'tiktok'    => ['icon' => 'fa-brands fa-tiktok',      'color' => 'secondary','label' => 'TikTok'],
	];
	foreach ($platformConfig as $pKey => $pConf):
		$counts = $platformCounts[$pKey] ?? ['draft' => 0, 'scheduled' => 0, 'posted' => 0, 'total' => 0];
	?>
	<div class="col">
		<div class="card border-0 shadow-sm h-100">
			<div class="card-body text-center py-3">
				<div class="rounded-circle bg-<?= $pConf['color']; ?> bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-2" style="width:42px;height:42px">
					<i class="<?= $pConf['icon']; ?> text-<?= $pConf['color']; ?> fs-5"></i>
				</div>
				<div class="fs-5 fw-bold"><?= $counts['total']; ?></div>
				<div class="text-muted small"><?= $pConf['label']; ?></div>
				<div class="mt-1">
					<span class="badge bg-warning text-dark"><?= $counts['draft']; ?> draft</span>
					<span class="badge bg-info"><?= $counts['scheduled']; ?> sched</span>
					<span class="badge bg-success"><?= $counts['posted']; ?> posted</span>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>

<!-- Quick Generate Panel -->
<div class="card border-0 shadow-sm mb-4">
	<div class="card-header bg-white fw-semibold">
		<i class="fa-solid fa-wand-magic-sparkles me-2 text-success"></i>Quick Generate from Blog Post
	</div>
	<div class="card-body">
		<div class="row align-items-end">
			<div class="col-md-8">
				<label class="form-label">Select Blog Post</label>
				<select class="form-select" id="quickBlogSelect">
					<option value="">-- Select a blog post --</option>
					<?php foreach ($blogPosts as $bp): ?>
						<option value="<?= $bp['id']; ?>"><?= esc($bp['blog_title']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-md-4">
				<button type="button" class="btn btn-success w-100" id="quickGenerateBtn">
					<i class="fa-solid fa-robot me-1"></i> Generate All Platforms
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Filters -->
<div class="d-flex gap-2 mb-3 flex-wrap">
	<div>
		<strong class="me-2">Platform:</strong>
		<a href="<?= base_url('aw-cp/social'); ?>" class="btn btn-sm <?= ($currentPlatform ?? 'all') === 'all' ? 'btn-dark' : 'btn-outline-dark'; ?>">All</a>
		<?php foreach ($platformConfig as $pKey => $pConf): ?>
			<a href="<?= base_url('aw-cp/social?platform=' . $pKey); ?>" class="btn btn-sm <?= ($currentPlatform ?? '') === $pKey ? 'btn-' . $pConf['color'] : 'btn-outline-' . $pConf['color']; ?>">
				<i class="<?= $pConf['icon']; ?> me-1"></i><?= $pConf['label']; ?>
			</a>
		<?php endforeach; ?>
	</div>
	<div>
		<strong class="me-2">Status:</strong>
		<?php
		$statuses = ['all' => 'All', 'draft' => 'Draft', 'scheduled' => 'Scheduled', 'posted' => 'Posted'];
		foreach ($statuses as $sKey => $sLabel):
			$isActive = ($currentStatus ?? 'all') === $sKey;
			$href = $sKey === 'all' ? base_url('aw-cp/social' . (($currentPlatform ?? 'all') !== 'all' ? '?platform=' . $currentPlatform : '')) : base_url('aw-cp/social?status=' . $sKey . (($currentPlatform ?? 'all') !== 'all' ? '&platform=' . $currentPlatform : ''));
		?>
			<a href="<?= $href; ?>" class="btn btn-sm <?= $isActive ? 'btn-secondary' : 'btn-outline-secondary'; ?>"><?= $sLabel; ?></a>
		<?php endforeach; ?>
	</div>
</div>

<!-- Posts Table -->
<div class="card border-0 shadow-sm">
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-striped table-hover mb-0">
				<thead class="table-light">
					<tr>
						<th>#</th>
						<th>Platform</th>
						<th>Content</th>
						<th>Status</th>
						<th>Blog</th>
						<th>Created</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($posts)): ?>
						<?php foreach ($posts as $i => $sp): ?>
							<tr>
								<td><?= $i + 1; ?></td>
								<td>
									<?php $pc = $platformConfig[$sp['platform']] ?? ['icon' => 'fa-solid fa-globe', 'color' => 'secondary', 'label' => $sp['platform']]; ?>
									<i class="<?= $pc['icon']; ?> text-<?= $pc['color']; ?> fs-5" title="<?= $pc['label']; ?>"></i>
								</td>
								<td>
									<div class="text-truncate" style="max-width:300px"><?= esc(mb_substr(strip_tags($sp['content']), 0, 100)); ?></div>
									<?php if ($sp['ai_generated']): ?>
										<span class="badge bg-success bg-opacity-75 small">AI</span>
									<?php endif; ?>
								</td>
								<td>
									<?php
									$sc = ['draft' => 'warning', 'scheduled' => 'info', 'posted' => 'success', 'failed' => 'danger'];
									?>
									<span class="badge bg-<?= $sc[$sp['status']] ?? 'secondary'; ?>"><?= ucfirst($sp['status']); ?></span>
									<?php if ($sp['status'] === 'scheduled' && !empty($sp['scheduled_at'])): ?>
										<br><small class="text-muted"><?= date('M d H:i', strtotime($sp['scheduled_at'])); ?></small>
									<?php endif; ?>
								</td>
								<td>
									<?php if ($sp['blog_id']): ?>
										<a href="<?= base_url('aw-cp/blog/edit/' . $sp['blog_id']); ?>" class="text-primary" title="View blog post">
											<i class="fa-solid fa-link"></i>
										</a>
									<?php else: ?>
										<span class="text-muted">-</span>
									<?php endif; ?>
								</td>
								<td><?= date('M d, Y', strtotime($sp['created_at'])); ?></td>
								<td class="text-nowrap">
									<a href="<?= base_url('aw-cp/social/edit/' . $sp['id']); ?>" class="btn btn-sm btn-outline-warning" title="Edit">
										<i class="fa-solid fa-pen"></i>
									</a>
									<a href="<?= base_url('aw-cp/social/delete/' . $sp['id']); ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Delete this social post?');">
										<i class="fa-solid fa-trash"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="7" class="text-center py-4 text-muted">No social media posts found. <a href="<?= base_url('aw-cp/social/create'); ?>">Create one now</a>.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
document.getElementById('quickGenerateBtn')?.addEventListener('click', function() {
	const blogId = document.getElementById('quickBlogSelect').value;
	if (!blogId) { alert('Please select a blog post.'); return; }
	window.location.href = '<?= base_url('aw-cp/social/from-blog/'); ?>' + blogId;
});
</script>
