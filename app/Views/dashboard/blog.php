<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Blog Management</h1>
	</div>
</div>

<?php if (session()->getFlashdata('success')): ?>
	<div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
	<div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<div class="row" style="margin-bottom: 20px;">
	<div class="col-lg-12">
		<a href="<?= base_url('aw-cp/blog/create'); ?>" class="btn btn-primary">
			<i class="fa fa-plus"></i> Create New Post
		</a>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">All Blog Posts</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead>
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
											<a href="<?= base_url('blog/' . esc($post['blog_url'])); ?>" target="_blank" class="btn btn-info btn-xs" title="View">
												<i class="fa fa-eye"></i>
											</a>
											<a href="<?= base_url('aw-cp/blog/edit/' . $post['id']); ?>" class="btn btn-warning btn-xs" title="Edit">
												<i class="fa fa-pencil"></i>
											</a>
											<a href="<?= base_url('aw-cp/blog/delete/' . $post['id']); ?>" class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('Are you sure you want to delete this post?');">
												<i class="fa fa-trash"></i>
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="7" class="text-center">No blog posts found. <a href="<?= base_url('aw-cp/blog/create'); ?>">Create one now</a>.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
