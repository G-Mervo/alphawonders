<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?= $post ? 'Edit Blog Post' : 'Create New Blog Post'; ?></h1>
	</div>
</div>

<?php if (session()->getFlashdata('errors')): ?>
	<div class="alert alert-danger">
		<ul style="margin-bottom: 0;">
			<?php foreach (session()->getFlashdata('errors') as $err): ?>
				<li><?= esc($err); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
	<div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><?= $post ? 'Edit Post' : 'New Post'; ?></div>
			<div class="panel-body">
				<form method="post" action="<?= $post ? base_url('aw-cp/blog/update/' . $post['id']) : base_url('aw-cp/blog/save'); ?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="blog_author">Author:</label>
								<input type="text" class="form-control" name="blog_author" id="blog_author"
									   value="<?= esc($post['blog_author'] ?? old('blog_author', 'Mervin Gaitho')); ?>" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="blog_title">Title:</label>
								<input type="text" class="form-control" name="blog_title" id="blog_title"
									   value="<?= esc($post['blog_title'] ?? old('blog_title', '')); ?>" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="blog_url">Slug (URL):</label>
								<input type="text" class="form-control" name="blog_url" id="blog_url"
									   value="<?= esc($post['blog_url'] ?? old('blog_url', '')); ?>" required
									   placeholder="e.g. introduction-to-quantum-computers">
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 15px;">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="blog_category">Category:</label>
								<select class="form-control" name="blog_category" id="blog_category">
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
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="blog_image">Featured Image:</label>
								<input type="file" class="form-control" name="blog_image" id="blog_image" accept="image/*">
								<?php if ($post && !empty($post['blog_image'])): ?>
									<small class="text-muted">Current: <?= esc($post['blog_image']); ?></small>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 15px;">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="blogtxtarea">Content:</label>
								<textarea class="form-control" id="blogtxtarea" name="blogtxtarea"><?= $post['blog_description'] ?? old('blogtxtarea', ''); ?></textarea>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 20px;">
						<div class="col-lg-12 text-center">
							<a href="<?= base_url('aw-cp/blog'); ?>" class="btn btn-default">Cancel</a>
							<button type="submit" class="btn btn-primary btn-lg" style="border-radius: 7px;">
								<?= $post ? 'Update Post' : 'Save Post'; ?>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
