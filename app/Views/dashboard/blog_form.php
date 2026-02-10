<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h3 class="fw-bold mb-0"><?= $post ? 'Edit Blog Post' : 'Create New Blog Post'; ?></h3>
	<a href="<?= base_url('aw-cp/blog'); ?>" class="btn btn-outline-secondary">
		<i class="fa-solid fa-arrow-left me-1"></i> Back to Blog
	</a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<ul class="mb-0">
			<?php foreach (session()->getFlashdata('errors') as $err): ?>
				<li><?= esc($err); ?></li>
			<?php endforeach; ?>
		</ul>
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
	<div class="card-header bg-white fw-semibold"><?= $post ? 'Edit Post' : 'New Post'; ?></div>
	<div class="card-body">
		<form method="post" action="<?= $post ? base_url('aw-cp/blog/update/' . $post['id']) : base_url('aw-cp/blog/save'); ?>" enctype="multipart/form-data">
			<div class="row g-3">
				<div class="col-lg-4">
					<label for="blog_author" class="form-label">Author</label>
					<input type="text" class="form-control" name="blog_author" id="blog_author"
						   value="<?= esc($post['blog_author'] ?? old('blog_author', 'Mervin Gaitho')); ?>" required>
				</div>
				<div class="col-lg-4">
					<label for="blog_title" class="form-label">Title</label>
					<input type="text" class="form-control" name="blog_title" id="blog_title"
						   value="<?= esc($post['blog_title'] ?? old('blog_title', '')); ?>" required>
				</div>
				<div class="col-lg-4">
					<label for="blog_url" class="form-label">Slug (URL)</label>
					<input type="text" class="form-control" name="blog_url" id="blog_url"
						   value="<?= esc($post['blog_url'] ?? old('blog_url', '')); ?>" required
						   placeholder="e.g. introduction-to-quantum-computers">
				</div>
			</div>
			<div class="row g-3 mt-1">
				<div class="col-lg-4">
					<label for="blog_category" class="form-label">Category</label>
					<select class="form-select" name="blog_category" id="blog_category">
						<option value="">-- Select Category --</option>
						<?php
						$categories = [
							'machine-learning', 'artificial-intelligence', 'robotics',
							'quantum-computing', 'digital-marketing', 'blockchain',
							'iot', 'cyber-security', 'data-science', 'trends-technology'
						];
						$selected = $post['blog_category'] ?? old('blog_category', '');
						foreach ($categories as $cat): ?>
							<option value="<?= $cat; ?>" <?= $selected === $cat ? 'selected' : ''; ?>><?= ucwords(str_replace('-', ' ', $cat)); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-lg-4">
					<label for="blog_image" class="form-label">Featured Image</label>
					<input type="file" class="form-control" name="blog_image" id="blog_image" accept="image/*">
					<?php if ($post && !empty($post['blog_image'])): ?>
						<small class="text-muted">Current: <?= esc($post['blog_image']); ?></small>
					<?php endif; ?>
				</div>
			</div>
			<div class="mt-3">
				<label for="blogtxtarea" class="form-label">Content</label>
				<textarea class="form-control" id="blogtxtarea" name="blogtxtarea"><?= $post['blog_description'] ?? old('blogtxtarea', ''); ?></textarea>
			</div>
			<div class="text-center mt-4">
				<a href="<?= base_url('aw-cp/blog'); ?>" class="btn btn-secondary me-2">Cancel</a>
				<button type="submit" class="btn btn-primary btn-lg">
					<?= $post ? 'Update Post' : 'Save Post'; ?>
				</button>
			</div>
		</form>
	</div>
</div>
