<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<?php
$platformLimits = [
	'twitter'   => 280,
	'facebook'  => 63206,
	'linkedin'  => 3000,
	'instagram' => 2200,
	'tiktok'    => 150,
];
$currentPlatform = $post['platform'] ?? $platform ?? 'twitter';
$currentLimit = $platformLimits[$currentPlatform] ?? 280;
$isVideoPlatform = in_array($currentPlatform, ['tiktok', 'instagram']);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h3 class="fw-bold mb-0"><?= $post ? 'Edit Social Post' : 'Create Social Post'; ?></h3>
	<a href="<?= base_url('aw-cp/social'); ?>" class="btn btn-outline-secondary">
		<i class="fa-solid fa-arrow-left me-1"></i> Back to Hub
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

<div class="card border-0 shadow-sm">
	<div class="card-body">
		<form id="socialForm" method="post" action="<?= $post ? base_url('aw-cp/social/update/' . $post['id']) : base_url('aw-cp/social/save'); ?>" enctype="multipart/form-data">
			<input type="hidden" name="action" id="social_action" value="draft">
			<input type="hidden" name="scheduled_at" id="social_scheduled_at" value="<?= esc($post['scheduled_at'] ?? ''); ?>">
			<input type="hidden" name="ai_generated" value="<?= $post['ai_generated'] ?? '0'; ?>">

			<div class="row g-3">
				<div class="col-lg-4">
					<label for="platform" class="form-label">Platform</label>
					<select class="form-select" name="platform" id="platform">
						<option value="twitter" <?= $currentPlatform === 'twitter' ? 'selected' : ''; ?>>Twitter / X</option>
						<option value="facebook" <?= $currentPlatform === 'facebook' ? 'selected' : ''; ?>>Facebook</option>
						<option value="linkedin" <?= $currentPlatform === 'linkedin' ? 'selected' : ''; ?>>LinkedIn</option>
						<option value="instagram" <?= $currentPlatform === 'instagram' ? 'selected' : ''; ?>>Instagram</option>
						<option value="tiktok" <?= $currentPlatform === 'tiktok' ? 'selected' : ''; ?>>TikTok</option>
					</select>
				</div>
				<div class="col-lg-4">
					<label for="blog_id" class="form-label">Linked Blog Post (optional)</label>
					<select class="form-select" name="blog_id" id="blog_id">
						<option value="">-- None --</option>
						<?php foreach ($blogPosts as $bp): ?>
							<option value="<?= $bp['id']; ?>" <?= ($post['blog_id'] ?? '') == $bp['id'] ? 'selected' : ''; ?>><?= esc($bp['blog_title']); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-lg-4">
					<label for="link_url" class="form-label">Link URL</label>
					<input type="url" class="form-control" name="link_url" id="link_url"
						   value="<?= esc($post['link_url'] ?? old('link_url', '')); ?>" placeholder="https://...">
				</div>
			</div>

			<!-- Content -->
			<div class="mt-3">
				<label for="social_content" class="form-label">
					Content
					<button type="button" class="btn btn-sm btn-outline-success ms-2" id="aiContentBtn" title="AI Generate Content">
						<i class="fa-solid fa-wand-magic-sparkles"></i> Generate
					</button>
				</label>
				<textarea class="form-control" name="content" id="social_content" rows="5"><?= esc($post['content'] ?? old('content', '')); ?></textarea>
				<small class="text-muted"><span id="charCount">0</span> / <span id="charLimit"><?= $currentLimit; ?></span> characters</small>
			</div>

			<!-- Hashtags -->
			<div class="mt-3">
				<label for="hashtags" class="form-label">
					Hashtags
					<button type="button" class="btn btn-sm btn-outline-success ms-2" id="aiHashtagsBtn" title="AI Suggest Hashtags">
						<i class="fa-solid fa-wand-magic-sparkles"></i> Suggest
					</button>
				</label>
				<input type="text" class="form-control" name="hashtags" id="hashtags"
					   value="<?= esc($post['hashtags'] ?? old('hashtags', '')); ?>"
					   placeholder="#tech #ai #innovation">
			</div>

			<div class="row g-3 mt-1">
				<div class="col-lg-6">
					<label for="media_file" class="form-label">Media Upload</label>
					<input type="file" class="form-control" name="media_file" id="media_file" accept="image/*,video/*">
					<?php if (!empty($post['media_url'])): ?>
						<small class="text-muted">Current: <?= esc($post['media_url']); ?></small>
					<?php endif; ?>
				</div>
				<div class="col-lg-6">
					<label for="notes" class="form-label">Notes (internal)</label>
					<input type="text" class="form-control" name="notes" id="notes"
						   value="<?= esc($post['notes'] ?? old('notes', '')); ?>" placeholder="Internal notes...">
				</div>
			</div>

			<!-- Video Script Section (TikTok/Reels) -->
			<div class="mt-3" id="videoScriptSection" style="<?= $isVideoPlatform ? '' : 'display:none'; ?>">
				<label for="video_script" class="form-label">
					Video Script
					<button type="button" class="btn btn-sm btn-outline-success ms-2" id="aiVideoScriptBtn" title="AI Generate Video Script">
						<i class="fa-solid fa-wand-magic-sparkles"></i> Generate Script
					</button>
				</label>
				<textarea class="form-control font-monospace" name="video_script" id="video_script" rows="8"
						  placeholder="[VISUAL] Opening shot...&#10;[VOICEOVER] Did you know...&#10;[TEXT OVERLAY] Key fact here"><?= esc($post['video_script'] ?? old('video_script', '')); ?></textarea>
				<small class="text-muted">Use [VISUAL], [VOICEOVER], and [TEXT OVERLAY] cues for your video script.</small>
			</div>

			<!-- Action Buttons -->
			<div class="d-flex justify-content-center align-items-center gap-2 mt-4 flex-wrap">
				<a href="<?= base_url('aw-cp/social'); ?>" class="btn btn-secondary">Cancel</a>
				<button type="button" class="btn btn-outline-secondary" id="btnSocialDraft">
					<i class="fa-solid fa-file me-1"></i> Save Draft
				</button>
				<button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#socialScheduleModal">
					<i class="fa-solid fa-clock me-1"></i> Schedule
				</button>
				<button type="button" class="btn btn-success" id="btnSocialPosted">
					<i class="fa-solid fa-check me-1"></i> Mark as Posted
				</button>
				<button type="button" class="btn btn-outline-primary" id="btnCopyContent">
					<i class="fa-solid fa-copy me-1"></i> Copy to Clipboard
				</button>
			</div>
		</form>
	</div>
</div>

<!-- Schedule Modal -->
<div class="modal fade" id="socialScheduleModal" tabindex="-1">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fa-solid fa-clock me-2"></i>Schedule Post</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<label for="social_schedule_dt" class="form-label">Date & Time</label>
				<input type="datetime-local" class="form-control" id="social_schedule_dt"
					   value="<?= !empty($post['scheduled_at']) ? date('Y-m-d\TH:i', strtotime($post['scheduled_at'])) : ''; ?>"
					   min="<?= date('Y-m-d\TH:i'); ?>">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-info btn-sm text-white" id="btnConfirmSocialSchedule">Schedule</button>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const baseUrl = '<?= base_url(); ?>';
	const form = document.getElementById('socialForm');
	const actionInput = document.getElementById('social_action');
	const scheduledAtInput = document.getElementById('social_scheduled_at');
	const contentArea = document.getElementById('social_content');
	const charCount = document.getElementById('charCount');
	const charLimit = document.getElementById('charLimit');
	const platformSelect = document.getElementById('platform');
	const videoSection = document.getElementById('videoScriptSection');

	const limits = <?= json_encode($platformLimits); ?>;

	function updateCharCount() {
		charCount.textContent = contentArea.value.length;
		const limit = parseInt(charLimit.textContent);
		charCount.style.color = contentArea.value.length > limit ? 'red' : '';
	}

	contentArea.addEventListener('input', updateCharCount);
	updateCharCount();

	platformSelect.addEventListener('change', function() {
		charLimit.textContent = limits[this.value] || 280;
		videoSection.style.display = ['tiktok', 'instagram'].includes(this.value) ? '' : 'none';
		updateCharCount();
	});

	// Action buttons
	document.getElementById('btnSocialDraft')?.addEventListener('click', function() {
		actionInput.value = 'draft'; form.submit();
	});
	document.getElementById('btnSocialPosted')?.addEventListener('click', function() {
		actionInput.value = 'posted'; form.submit();
	});
	document.getElementById('btnConfirmSocialSchedule')?.addEventListener('click', function() {
		const dt = document.getElementById('social_schedule_dt').value;
		if (!dt) { alert('Select a date and time.'); return; }
		actionInput.value = 'schedule';
		scheduledAtInput.value = dt.replace('T', ' ') + ':00';
		bootstrap.Modal.getInstance(document.getElementById('socialScheduleModal')).hide();
		form.submit();
	});

	// Copy to clipboard
	document.getElementById('btnCopyContent')?.addEventListener('click', function() {
		const text = contentArea.value + '\n\n' + (document.getElementById('hashtags').value || '');
		navigator.clipboard.writeText(text).then(() => {
			this.innerHTML = '<i class="fa-solid fa-check me-1"></i> Copied!';
			setTimeout(() => this.innerHTML = '<i class="fa-solid fa-copy me-1"></i> Copy to Clipboard', 2000);
		});
	});

	// AI Generate Content
	document.getElementById('aiContentBtn')?.addEventListener('click', function() {
		const blogId = document.getElementById('blog_id').value;
		const platform = platformSelect.value;
		const icon = this.querySelector('i');
		const origHTML = this.innerHTML;
		this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Generating...';
		this.disabled = true;

		let body = 'platform=' + encodeURIComponent(platform);

		if (blogId) {
			// Get blog details from the select option text
			const blogSelect = document.getElementById('blog_id');
			const title = blogSelect.options[blogSelect.selectedIndex].text;
			body += '&title=' + encodeURIComponent(title) + '&content=' + encodeURIComponent(title);
		} else {
			body += '&title=' + encodeURIComponent(contentArea.value.substring(0, 100)) + '&content=' + encodeURIComponent(contentArea.value);
		}

		fetch(baseUrl + '/aw-cp/ai/generate-social', {
			method: 'POST',
			headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest'},
			body: body
		})
		.then(r => r.json())
		.then(data => {
			if (data.success) {
				const c = data.content;
				if (typeof c === 'object') {
					contentArea.value = c.content || '';
					if (c.hashtags) document.getElementById('hashtags').value = c.hashtags;
				} else {
					contentArea.value = c;
				}
				updateCharCount();
			} else {
				alert(data.error || 'Generation failed.');
			}
		})
		.catch(() => alert('Network error.'))
		.finally(() => { this.innerHTML = origHTML; this.disabled = false; });
	});

	// AI Suggest Hashtags
	document.getElementById('aiHashtagsBtn')?.addEventListener('click', function() {
		const content = contentArea.value;
		if (!content) { alert('Add content first.'); return; }
		const origHTML = this.innerHTML;
		this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
		this.disabled = true;

		fetch(baseUrl + '/aw-cp/ai/suggest-hashtags', {
			method: 'POST',
			headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest'},
			body: 'content=' + encodeURIComponent(content) + '&platform=' + encodeURIComponent(platformSelect.value)
		})
		.then(r => r.json())
		.then(data => {
			if (data.success) {
				document.getElementById('hashtags').value = data.content;
			} else {
				alert(data.error || 'Failed.');
			}
		})
		.catch(() => alert('Network error.'))
		.finally(() => { this.innerHTML = origHTML; this.disabled = false; });
	});

	// AI Generate Video Script
	document.getElementById('aiVideoScriptBtn')?.addEventListener('click', function() {
		const content = contentArea.value;
		if (!content) { alert('Add content first.'); return; }
		const origHTML = this.innerHTML;
		this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Generating...';
		this.disabled = true;

		fetch(baseUrl + '/aw-cp/ai/generate-video-script', {
			method: 'POST',
			headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest'},
			body: 'title=' + encodeURIComponent(content.substring(0, 100)) + '&content=' + encodeURIComponent(content) + '&platform=' + encodeURIComponent(platformSelect.value)
		})
		.then(r => r.json())
		.then(data => {
			if (data.success) {
				document.getElementById('video_script').value = data.content;
			} else {
				alert(data.error || 'Failed.');
			}
		})
		.catch(() => alert('Network error.'))
		.finally(() => { this.innerHTML = origHTML; this.disabled = false; });
	});
});
</script>
