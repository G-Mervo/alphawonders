<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h3 class="fw-bold mb-0">Blog Management</h3>
	<a href="<?= base_url('aw-cp/blog/create'); ?>" class="btn btn-primary">
		<i class="fa-solid fa-plus me-1"></i> Create New Post
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

<!-- Status Filter Tabs -->
<ul class="nav nav-pills mb-3">
	<li class="nav-item">
		<a class="nav-link <?= ($currentStatus ?? 'all') === 'all' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/blog'); ?>">
			All <span class="badge bg-secondary ms-1"><?= $allCount ?? 0; ?></span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= ($currentStatus ?? '') === 'published' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/blog?status=published'); ?>">
			Published <span class="badge bg-success ms-1"><?= $publishedCount ?? 0; ?></span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= ($currentStatus ?? '') === 'draft' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/blog?status=draft'); ?>">
			Drafts <span class="badge bg-warning text-dark ms-1"><?= $draftCount ?? 0; ?></span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= ($currentStatus ?? '') === 'scheduled' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/blog?status=scheduled'); ?>">
			Scheduled <span class="badge bg-info ms-1"><?= $scheduledCount ?? 0; ?></span>
		</a>
	</li>
</ul>

<div class="card border-0 shadow-sm">
	<div class="card-header bg-white fw-semibold">
		<?php
		$headerText = match($currentStatus ?? 'all') {
			'published' => 'Published Posts',
			'draft'     => 'Draft Posts',
			'scheduled' => 'Scheduled Posts',
			default     => 'All Blog Posts',
		};
		?>
		<?= $headerText; ?>
	</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-striped table-hover mb-0">
				<thead class="table-light">
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Status</th>
						<th>Author</th>
						<th>Category</th>
						<th>Tags</th>
						<th>Social</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($posts)): ?>
						<?php foreach ($posts as $i => $post): ?>
							<tr>
								<td><?= $i + 1; ?></td>
								<td><?= esc($post['blog_title']); ?></td>
								<td>
									<?php
									$statusColors = ['published' => 'success', 'draft' => 'warning', 'scheduled' => 'info'];
									$s = $post['status'] ?? 'published';
									?>
									<span class="badge bg-<?= $statusColors[$s] ?? 'secondary'; ?>">
										<?= ucfirst($s); ?>
									</span>
									<?php if ($s === 'scheduled' && !empty($post['scheduled_at'])): ?>
										<br><small class="text-muted"><?= date('M d, Y H:i', strtotime($post['scheduled_at'])); ?></small>
									<?php endif; ?>
								</td>
								<td><?= esc($post['blog_author']); ?></td>
								<td><?= esc($post['blog_category'] ?? '-'); ?></td>
								<td>
									<?php if (!empty($postTagsMap[$post['id']])): ?>
										<?php foreach ($postTagsMap[$post['id']] as $tag): ?>
											<span class="badge bg-secondary bg-opacity-75 me-1"><?= esc($tag['name']); ?></span>
										<?php endforeach; ?>
									<?php else: ?>
										<span class="text-muted">-</span>
									<?php endif; ?>
								</td>
								<td>
									<?php $score = $socialScoreMap[$post['id']] ?? 0; ?>
									<?php if ($score > 0): ?>
										<span class="badge bg-primary"><?= $score; ?></span>
									<?php else: ?>
										<span class="text-muted">-</span>
									<?php endif; ?>
								</td>
								<td><?= date('M d, Y', strtotime($post['date_created'])); ?></td>
								<td class="text-nowrap">
									<a href="<?= base_url('aw-cp/blog/preview/' . $post['id']); ?>" target="_blank" class="btn btn-sm btn-outline-info" title="Preview">
										<i class="fa-solid fa-eye"></i>
									</a>
									<a href="<?= base_url('aw-cp/blog/edit/' . $post['id']); ?>" class="btn btn-sm btn-outline-warning" title="Edit">
										<i class="fa-solid fa-pen"></i>
									</a>
									<a href="<?= base_url('aw-cp/social/from-blog/' . $post['id']); ?>" class="btn btn-sm btn-outline-success" title="Generate Social Posts">
										<i class="fa-solid fa-share-nodes"></i>
									</a>
									<a href="<?= base_url('aw-cp/blog/delete/' . $post['id']); ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this post?');">
										<i class="fa-solid fa-trash"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="9" class="text-center py-4 text-muted">No blog posts found. <a href="<?= base_url('aw-cp/blog/create'); ?>">Create one now</a>.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
