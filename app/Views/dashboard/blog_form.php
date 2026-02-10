<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h3 class="fw-bold mb-0"><?= $post ? 'Edit Blog Post' : 'Create New Blog Post'; ?></h3>
	<div>
		<?php if (!$post): ?>
		<button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#aiGenerateModal">
			<i class="fa-solid fa-robot me-1"></i> AI Generate Post
		</button>
		<?php endif; ?>
		<a href="<?= base_url('aw-cp/blog'); ?>" class="btn btn-outline-secondary">
			<i class="fa-solid fa-arrow-left me-1"></i> Back to Blog
		</a>
	</div>
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
					<label for="blog_title" class="form-label">
						Title
						<button type="button" class="btn btn-sm btn-outline-success ms-2 ai-suggest-btn" data-action="title" title="AI Suggest Title">
							<i class="fa-solid fa-wand-magic-sparkles"></i>
						</button>
					</label>
					<input type="text" class="form-control" name="blog_title" id="blog_title"
						   value="<?= esc($post['blog_title'] ?? old('blog_title', '')); ?>" required>
				</div>
				<div class="col-lg-4">
					<label for="blog_url" class="form-label">
						Slug (URL)
						<button type="button" class="btn btn-sm btn-outline-success ms-2 ai-suggest-btn" data-action="slug" title="AI Suggest Slug">
							<i class="fa-solid fa-wand-magic-sparkles"></i>
						</button>
					</label>
					<input type="text" class="form-control" name="blog_url" id="blog_url"
						   value="<?= esc($post['blog_url'] ?? old('blog_url', '')); ?>" required
						   placeholder="e.g. introduction-to-quantum-computers">
				</div>
			</div>
			<div class="row g-3 mt-1">
				<div class="col-lg-4">
					<label for="blog_category" class="form-label">
						Category
						<button type="button" class="btn btn-sm btn-outline-success ms-2 ai-suggest-btn" data-action="category" title="AI Suggest Category">
							<i class="fa-solid fa-wand-magic-sparkles"></i>
						</button>
					</label>
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

<!-- AI Generate Blog Post Modal -->
<div class="modal fade" id="aiGenerateModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fa-solid fa-robot me-2"></i>AI Generate Blog Post</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<label for="ai_topic" class="form-label">Topic <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="ai_topic" placeholder="e.g. The Future of Quantum Computing in 2026">
				</div>
				<div class="mb-3">
					<label for="ai_outline" class="form-label">Outline (optional)</label>
					<textarea class="form-control" id="ai_outline" rows="3" placeholder="Optional: provide a brief outline or key points to cover..."></textarea>
				</div>
				<div id="ai_generate_error" class="alert alert-danger d-none"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-success" id="aiGenerateBtn">
					<span class="spinner-border spinner-border-sm d-none me-1" id="aiGenerateSpinner"></span>
					<i class="fa-solid fa-wand-magic-sparkles me-1" id="aiGenerateIcon"></i> Generate
				</button>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const baseUrl = '<?= base_url(); ?>';

	// AI Generate Blog Post
	document.getElementById('aiGenerateBtn')?.addEventListener('click', function() {
		const topic = document.getElementById('ai_topic').value.trim();
		const outline = document.getElementById('ai_outline').value.trim();
		const errorEl = document.getElementById('ai_generate_error');
		const spinner = document.getElementById('aiGenerateSpinner');
		const icon = document.getElementById('aiGenerateIcon');

		if (!topic) {
			errorEl.textContent = 'Please enter a topic.';
			errorEl.classList.remove('d-none');
			return;
		}

		errorEl.classList.add('d-none');
		spinner.classList.remove('d-none');
		icon.classList.add('d-none');
		this.disabled = true;

		fetch(baseUrl + '/aw-cp/ai/generate-blog', {
			method: 'POST',
			headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest'},
			body: 'topic=' + encodeURIComponent(topic) + '&outline=' + encodeURIComponent(outline)
		})
		.then(r => r.json())
		.then(data => {
			if (data.success) {
				if (typeof tinymce !== 'undefined' && tinymce.get('blogtxtarea')) {
					tinymce.get('blogtxtarea').setContent(data.content);
				} else {
					document.getElementById('blogtxtarea').value = data.content;
				}
				if (data.title) document.getElementById('blog_title').value = data.title;
				if (data.slug) document.getElementById('blog_url').value = data.slug;
				bootstrap.Modal.getInstance(document.getElementById('aiGenerateModal')).hide();
			} else {
				errorEl.textContent = data.error || 'Generation failed.';
				errorEl.classList.remove('d-none');
			}
		})
		.catch(err => {
			errorEl.textContent = 'Network error. Please try again.';
			errorEl.classList.remove('d-none');
		})
		.finally(() => {
			spinner.classList.add('d-none');
			icon.classList.remove('d-none');
			this.disabled = false;
		});
	});

	// AI Suggest buttons
	document.querySelectorAll('.ai-suggest-btn').forEach(btn => {
		btn.addEventListener('click', function() {
			const action = this.dataset.action;
			const icon = this.querySelector('i');
			const origClass = icon.className;
			icon.className = 'fa-solid fa-spinner fa-spin';
			this.disabled = true;

			let url, body;
			if (action === 'title') {
				let content = '';
				if (typeof tinymce !== 'undefined' && tinymce.get('blogtxtarea')) {
					content = tinymce.get('blogtxtarea').getContent();
				} else {
					content = document.getElementById('blogtxtarea').value;
				}
				if (!content) { alert('Add some content first.'); icon.className = origClass; this.disabled = false; return; }
				url = baseUrl + '/aw-cp/ai/suggest-title';
				body = 'content=' + encodeURIComponent(content);
			} else if (action === 'slug') {
				const title = document.getElementById('blog_title').value;
				if (!title) { alert('Add a title first.'); icon.className = origClass; this.disabled = false; return; }
				url = baseUrl + '/aw-cp/ai/suggest-slug';
				body = 'title=' + encodeURIComponent(title);
			} else if (action === 'category') {
				let content = '';
				if (typeof tinymce !== 'undefined' && tinymce.get('blogtxtarea')) {
					content = tinymce.get('blogtxtarea').getContent();
				} else {
					content = document.getElementById('blogtxtarea').value;
				}
				if (!content) { alert('Add some content first.'); icon.className = origClass; this.disabled = false; return; }
				url = baseUrl + '/aw-cp/ai/suggest-category';
				body = 'content=' + encodeURIComponent(content);
			}

			fetch(url, {
				method: 'POST',
				headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest'},
				body: body
			})
			.then(r => r.json())
			.then(data => {
				if (data.success) {
					if (action === 'title') {
						document.getElementById('blog_title').value = data.content;
					} else if (action === 'slug') {
						document.getElementById('blog_url').value = data.content;
					} else if (action === 'category') {
						const sel = document.getElementById('blog_category');
						const val = data.content.trim();
						for (let opt of sel.options) {
							if (opt.value === val) { opt.selected = true; break; }
						}
					}
				} else {
					alert(data.error || 'Suggestion failed.');
				}
			})
			.catch(() => alert('Network error.'))
			.finally(() => {
				icon.className = origClass;
				this.disabled = false;
			});
		});
	});
});
</script>
