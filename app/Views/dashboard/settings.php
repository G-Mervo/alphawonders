<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="mb-4">
	<h3 class="fw-bold mb-1">Settings</h3>
	<p class="text-muted">Configure your site, analytics, and integrations. Changes save automatically.</p>
</div>

<!-- Toast notification -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1080;">
	<div id="settingsToast" class="toast align-items-center border-0" role="alert">
		<div class="d-flex">
			<div class="toast-body" id="settingsToastBody"></div>
			<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
		</div>
	</div>
</div>

<?php if (session()->getFlashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<?= session()->getFlashdata('success'); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>

<div class="row g-4">
	<!-- Google Analytics / Search Console -->
	<div class="col-lg-6">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white fw-semibold">
				<i class="fa-brands fa-google me-2 text-danger"></i>Google Integrations
			</div>
			<div class="card-body">
				<div class="mb-3">
					<label for="google_analytics_id" class="form-label">Google Analytics Measurement ID</label>
					<input type="text" class="form-control autosave-field" name="google_analytics_id" id="google_analytics_id"
						   data-key="google_analytics_id"
						   value="<?= esc($settings['google_analytics_id'] ?? ''); ?>"
						   placeholder="G-XXXXXXXXXX">
					<div class="form-text">Find this in Google Analytics > Admin > Data Streams.</div>
				</div>
				<div class="mb-3">
					<label for="google_search_console_meta" class="form-label">Google Search Console Verification</label>
					<input type="text" class="form-control autosave-field" name="google_search_console_meta" id="google_search_console_meta"
						   data-key="google_search_console_meta"
						   value="<?= esc($settings['google_search_console_meta'] ?? ''); ?>"
						   placeholder="content value from meta tag">
					<div class="form-text">Paste only the <code>content</code> value from the HTML verification tag.</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Site Settings -->
	<div class="col-lg-6">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white fw-semibold">
				<i class="fa-solid fa-globe me-2 text-primary"></i>Site Information
			</div>
			<div class="card-body">
				<div class="mb-3">
					<label for="site_name" class="form-label">Site Name</label>
					<input type="text" class="form-control autosave-field" name="site_name" id="site_name"
						   data-key="site_name"
						   value="<?= esc($settings['site_name'] ?? 'Alphawonders'); ?>">
				</div>
				<div class="mb-3">
					<label for="site_description" class="form-label">Site Description</label>
					<input type="text" class="form-control autosave-field" name="site_description" id="site_description"
						   data-key="site_description"
						   value="<?= esc($settings['site_description'] ?? ''); ?>">
				</div>
				<div class="mb-0">
					<label for="contact_email" class="form-label">Contact Email</label>
					<input type="email" class="form-control autosave-field" name="contact_email" id="contact_email"
						   data-key="contact_email"
						   value="<?= esc($settings['contact_email'] ?? ''); ?>">
				</div>
			</div>
		</div>
	</div>

	<!-- Social Media Links -->
	<div class="col-lg-6">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white fw-semibold">
				<i class="fa-solid fa-share-nodes me-2 text-info"></i>Social Media
			</div>
			<div class="card-body">
				<div class="mb-3">
					<label class="form-label"><i class="fa-brands fa-facebook me-1"></i>Facebook</label>
					<input type="url" class="form-control autosave-field" data-key="social_facebook"
						   value="<?= esc($settings['social_facebook'] ?? ''); ?>" placeholder="https://facebook.com/...">
				</div>
				<div class="mb-3">
					<label class="form-label"><i class="fa-brands fa-x-twitter me-1"></i>X</label>
					<input type="url" class="form-control autosave-field" data-key="social_twitter"
						   value="<?= esc($settings['social_twitter'] ?? ''); ?>" placeholder="https://x.com/...">
				</div>
				<div class="mb-3">
					<label class="form-label"><i class="fa-brands fa-linkedin me-1"></i>LinkedIn</label>
					<input type="url" class="form-control autosave-field" data-key="social_linkedin"
						   value="<?= esc($settings['social_linkedin'] ?? ''); ?>" placeholder="https://linkedin.com/...">
				</div>
				<div class="mb-3">
					<label class="form-label"><i class="fa-brands fa-instagram me-1"></i>Instagram</label>
					<input type="url" class="form-control autosave-field" data-key="social_instagram"
						   value="<?= esc($settings['social_instagram'] ?? ''); ?>" placeholder="https://instagram.com/...">
				</div>
				<div class="mb-0">
					<label class="form-label"><i class="fa-brands fa-tiktok me-1"></i>TikTok</label>
					<input type="url" class="form-control autosave-field" data-key="social_tiktok"
						   value="<?= esc($settings['social_tiktok'] ?? ''); ?>" placeholder="https://tiktok.com/@...">
				</div>
			</div>
		</div>
	</div>

	<!-- AI Integration (Groq) -->
	<div class="col-lg-6">
		<div class="card border-0 shadow-sm mb-4">
			<div class="card-header bg-white fw-semibold">
				<i class="fa-solid fa-robot me-2 text-success"></i>AI Integration (Groq)
			</div>
			<div class="card-body">
				<div class="mb-3">
					<label for="groq_api_key" class="form-label">Groq API Key</label>
					<input type="password" class="form-control autosave-field" id="groq_api_key"
						   data-key="groq_api_key"
						   value="<?= esc($settings['groq_api_key'] ?? ''); ?>"
						   placeholder="gsk_...">
					<div class="form-text">Get a free API key from <a href="https://console.groq.com/keys" target="_blank">console.groq.com</a></div>
				</div>
				<div class="mb-0">
					<label for="groq_model" class="form-label">Model</label>
					<select class="form-select autosave-field" id="groq_model" data-key="groq_model">
						<?php
						$models = ['llama-3.3-70b-versatile' => 'Llama 3.3 70B (Recommended)', 'llama-3.1-8b-instant' => 'Llama 3.1 8B (Faster)'];
						$currentModel = $settings['groq_model'] ?? 'llama-3.3-70b-versatile';
						foreach ($models as $val => $label): ?>
							<option value="<?= $val; ?>" <?= $currentModel === $val ? 'selected' : ''; ?>><?= $label; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>

		<!-- GitHub Integration -->
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white fw-semibold">
				<i class="fa-brands fa-github me-2"></i>GitHub Integration
			</div>
			<div class="card-body">
				<div class="mb-0">
					<label for="github_pat" class="form-label">Personal Access Token</label>
					<input type="password" class="form-control autosave-field" id="github_pat"
						   data-key="github_pat"
						   value="<?= esc($settings['github_pat'] ?? ''); ?>"
						   placeholder="ghp_...">
					<div class="form-text">Create a token at <a href="https://github.com/settings/tokens?type=beta" target="_blank">GitHub Settings</a>. Grant <code>repo</code> scope.</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Change Password -->
	<div class="col-lg-6">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white fw-semibold">
				<i class="fa-solid fa-lock me-2 text-warning"></i>Change Password
			</div>
			<div class="card-body">
				<?php if (session()->getFlashdata('pw_error')): ?>
					<div class="alert alert-danger py-2 small">
						<?= session()->getFlashdata('pw_error'); ?>
					</div>
				<?php endif; ?>
				<?php if (session()->getFlashdata('pw_success')): ?>
					<div class="alert alert-success py-2 small">
						<?= session()->getFlashdata('pw_success'); ?>
					</div>
				<?php endif; ?>
				<form method="post" action="<?= base_url('aw-cp/change-password'); ?>">
					<div class="mb-3">
						<label for="current_password" class="form-label">Current Password</label>
						<input type="password" class="form-control" name="current_password" id="current_password" required>
					</div>
					<div class="mb-3">
						<label for="new_password" class="form-label">New Password</label>
						<input type="password" class="form-control" name="new_password" id="new_password" required minlength="8">
						<div class="form-text">Minimum 8 characters.</div>
					</div>
					<div class="mb-3">
						<label for="confirm_password" class="form-label">Confirm New Password</label>
						<input type="password" class="form-control" name="confirm_password" id="confirm_password" required minlength="8">
					</div>
					<button type="submit" class="btn btn-warning w-100">
						<i class="fa-solid fa-key me-2"></i>Change Password
					</button>
				</form>
			</div>
		</div>
	</div>

	<!-- Social Media API Keys (Coming Soon) -->
	<div class="col-lg-6">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white fw-semibold d-flex align-items-center">
				<i class="fa-solid fa-key me-2 text-secondary"></i>Social Media API Keys
				<span class="badge bg-secondary ms-auto">Coming Soon</span>
			</div>
			<div class="card-body">
				<div class="mb-3">
					<label class="form-label text-muted">X API Key</label>
					<input type="text" class="form-control" disabled placeholder="Will enable auto-posting to X">
				</div>
				<div class="mb-3">
					<label class="form-label text-muted">Facebook Page Token</label>
					<input type="text" class="form-control" disabled placeholder="Will enable auto-posting to Facebook">
				</div>
				<div class="mb-0">
					<label class="form-label text-muted">LinkedIn Access Token</label>
					<input type="text" class="form-control" disabled placeholder="Will enable auto-posting to LinkedIn">
				</div>
				<div class="alert alert-info small mt-3 mb-0">
					<i class="fa-solid fa-circle-info me-1"></i>
					API integration for auto-posting to social platforms is coming in a future update.
				</div>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const baseUrl = '<?= base_url(); ?>';
	const toastEl = document.getElementById('settingsToast');
	const toastBody = document.getElementById('settingsToastBody');
	const toast = new bootstrap.Toast(toastEl, { delay: 2500 });

	function showToast(message, success) {
		toastEl.className = 'toast align-items-center border-0 text-white ' + (success ? 'bg-success' : 'bg-danger');
		toastBody.textContent = message;
		toast.show();
	}

	let saveTimers = {};

	function saveField(field) {
		const key = field.dataset.key;
		const value = field.value;

		// Brief visual feedback
		field.classList.add('border-warning');

		fetch(baseUrl + '/aw-cp/settings/save-field', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
				'X-Requested-With': 'XMLHttpRequest'
			},
			body: 'key=' + encodeURIComponent(key) + '&value=' + encodeURIComponent(value)
		})
		.then(r => r.json())
		.then(data => {
			field.classList.remove('border-warning');
			if (data.success) {
				field.classList.add('border-success');
				setTimeout(() => field.classList.remove('border-success'), 1500);
				showToast('Setting saved', true);
			} else {
				field.classList.add('border-danger');
				setTimeout(() => field.classList.remove('border-danger'), 2000);
				showToast(data.error || 'Failed to save', false);
			}
		})
		.catch(() => {
			field.classList.remove('border-warning');
			field.classList.add('border-danger');
			setTimeout(() => field.classList.remove('border-danger'), 2000);
			showToast('Network error. Please try again.', false);
		});
	}

	// Auto-save on change with debounce for text inputs
	document.querySelectorAll('.autosave-field').forEach(field => {
		if (field.tagName === 'SELECT') {
			field.addEventListener('change', () => saveField(field));
		} else {
			field.addEventListener('change', () => saveField(field));
			field.addEventListener('input', () => {
				const key = field.dataset.key;
				clearTimeout(saveTimers[key]);
				saveTimers[key] = setTimeout(() => saveField(field), 1200);
			});
		}
	});
});
</script>
