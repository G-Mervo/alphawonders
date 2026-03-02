<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h3 class="fw-bold mb-0">Generate Social Posts from Blog</h3>
	<a href="<?= base_url('aw-cp/social'); ?>" class="btn btn-outline-secondary">
		<i class="fa-solid fa-arrow-left me-1"></i> Back to Hub
	</a>
</div>

<!-- Blog Summary -->
<div class="card border-0 shadow-sm mb-4">
	<div class="card-body">
		<h5 class="fw-bold"><?= esc($blog['blog_title']); ?></h5>
		<p class="text-muted mb-1"><?= esc(mb_substr(strip_tags($blog['blog_description']), 0, 200)); ?>...</p>
		<small class="text-muted">By <?= esc($blog['blog_author']); ?> &mdash; <?= date('M d, Y', strtotime($blog['date_created'])); ?></small>
	</div>
</div>

<?php if (!empty($existingPosts)): ?>
	<div class="alert alert-info">
		<i class="fa-solid fa-circle-info me-1"></i>
		This blog post already has <?= count($existingPosts); ?> social post(s). Generating new ones will create additional drafts.
	</div>
<?php endif; ?>

<!-- Generate Panel -->
<div class="card border-0 shadow-sm mb-4">
	<div class="card-header bg-white fw-semibold">
		<i class="fa-solid fa-robot me-2 text-success"></i>AI Generate for All Platforms
	</div>
	<div class="card-body text-center">
		<p class="text-muted">Click below to generate social media posts for all 5 platforms using AI. Each will be saved as a draft for you to review and edit.</p>
		<button type="button" class="btn btn-success btn-lg" id="generateAllBtn">
			<span class="spinner-border spinner-border-sm d-none me-1" id="genSpinner"></span>
			<i class="fa-solid fa-wand-magic-sparkles me-1" id="genIcon"></i> Generate All Platforms
		</button>
		<div id="genError" class="alert alert-danger mt-3 d-none"></div>
	</div>
</div>

<!-- Results (populated after generation) -->
<div id="resultsSection" class="d-none">
	<h5 class="fw-bold mb-3">Generated Posts</h5>
	<ul class="nav nav-tabs mb-3" id="platformTabs">
		<li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-twitter"><i class="fa-brands fa-x-twitter me-1"></i>Twitter</a></li>
		<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-facebook"><i class="fa-brands fa-facebook me-1"></i>Facebook</a></li>
		<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-linkedin"><i class="fa-brands fa-linkedin me-1"></i>LinkedIn</a></li>
		<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-instagram"><i class="fa-brands fa-instagram me-1"></i>Instagram</a></li>
		<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-tiktok"><i class="fa-brands fa-tiktok me-1"></i>TikTok</a></li>
	</ul>
	<div class="tab-content">
		<?php foreach (['twitter', 'facebook', 'linkedin', 'instagram', 'tiktok'] as $p): ?>
		<div class="tab-pane fade <?= $p === 'twitter' ? 'show active' : ''; ?>" id="tab-<?= $p; ?>">
			<div class="card border-0 shadow-sm">
				<div class="card-body">
					<div class="mb-2">
						<label class="form-label fw-semibold">Content</label>
						<textarea class="form-control" id="result-content-<?= $p; ?>" rows="4" readonly></textarea>
					</div>
					<div class="mb-2">
						<label class="form-label fw-semibold">Hashtags</label>
						<input type="text" class="form-control" id="result-hashtags-<?= $p; ?>" readonly>
					</div>
					<?php if ($p === 'tiktok'): ?>
					<div class="mb-2">
						<label class="form-label fw-semibold">Video Script</label>
						<textarea class="form-control font-monospace" id="result-script-tiktok" rows="6" readonly></textarea>
					</div>
					<?php endif; ?>
					<div class="d-flex gap-2">
						<a href="<?= base_url('aw-cp/social'); ?>" class="btn btn-sm btn-outline-primary">
							<i class="fa-solid fa-pen me-1"></i> Edit in Hub
						</a>
						<span class="badge bg-success align-self-center">Saved as Draft</span>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>

<script>
document.getElementById('generateAllBtn')?.addEventListener('click', function() {
	const btn = this;
	const spinner = document.getElementById('genSpinner');
	const icon = document.getElementById('genIcon');
	const errorEl = document.getElementById('genError');

	spinner.classList.remove('d-none');
	icon.classList.add('d-none');
	btn.disabled = true;
	errorEl.classList.add('d-none');

	fetch('<?= base_url('aw-cp/social/bulk-generate'); ?>', {
		method: 'POST',
		headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest'},
		body: 'blog_id=<?= $blog['id']; ?>'
	})
	.then(r => r.json())
	.then(data => {
		if (data.success && data.generated) {
			document.getElementById('resultsSection').classList.remove('d-none');

			for (const [platform, pData] of Object.entries(data.generated)) {
				const contentEl = document.getElementById('result-content-' + platform);
				const hashtagsEl = document.getElementById('result-hashtags-' + platform);
				if (contentEl) contentEl.value = pData.content || '';
				if (hashtagsEl) hashtagsEl.value = pData.hashtags || '';
				if (platform === 'tiktok' && pData.video_script) {
					const scriptEl = document.getElementById('result-script-tiktok');
					if (scriptEl) scriptEl.value = pData.video_script;
				}
			}

			btn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Generated ' + data.count + ' Posts!';
			btn.classList.replace('btn-success', 'btn-outline-success');
		} else {
			errorEl.textContent = data.error || 'Generation failed.';
			errorEl.classList.remove('d-none');
		}
	})
	.catch(() => {
		errorEl.textContent = 'Network error. Please try again.';
		errorEl.classList.remove('d-none');
	})
	.finally(() => {
		spinner.classList.add('d-none');
		icon.classList.remove('d-none');
		btn.disabled = false;
	});
});
</script>
