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

<div class="card border-0 shadow-sm">
	<div class="card-header bg-white fw-semibold">All Blog Posts</div>
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-striped table-hover mb-0">
				<thead class="table-light">
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>Slug</th>
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
								<td><?= esc($post['blog_author']); ?></td>
								<td><?= esc($post['blog_category'] ?? '-'); ?></td>
								<td><code><?= esc($post['blog_url']); ?></code></td>
								<td><?= date('M d, Y', strtotime($post['date_created'])); ?></td>
								<td>
									<a href="<?= base_url('blog/' . esc($post['blog_url'])); ?>" target="_blank" class="btn btn-sm btn-outline-info" title="View">
										<i class="fa-solid fa-eye"></i>
									</a>
									<a href="<?= base_url('aw-cp/blog/edit/' . $post['id']); ?>" class="btn btn-sm btn-outline-warning" title="Edit">
										<i class="fa-solid fa-pen"></i>
									</a>
									<a href="<?= base_url('aw-cp/blog/delete/' . $post['id']); ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this post?');">
										<i class="fa-solid fa-trash"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="7" class="text-center py-4 text-muted">No blog posts found. <a href="<?= base_url('aw-cp/blog/create'); ?>">Create one now</a>.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
