<?php defined('FCPATH') OR exit('No direct script access is allowed'); ?>

<!-- Categories Widget -->
<div class="card border-0 shadow-sm mb-4">
	<div class="card-body">
		<h4 class="fw-bold mb-4">
			<i class="fas fa-folder-open text-primary me-2"></i>Blog Categories
		</h4>
		<ul class="list-unstyled">
			<?php
			$categories = [
				'machine-learning' => 'Machine Learning',
				'artificial-intelligence' => 'Artificial Intelligence',
				'robotics' => 'Robotics',
				'quantum-computing' => 'Quantum Computing',
				'digital-marketing' => 'Digital Marketing',
				'blockchain' => 'Blockchain Technology',
				'iot' => 'Internet of Things',
				'cyber-security' => 'Cyber Security',
				'data-science' => 'Data Science',
				'trends-technology' => 'Trends in Technology',
			];
			foreach ($categories as $slug => $name): ?>
				<li class="mb-2">
					<a href="<?= base_url('blog/category/' . $slug); ?>" class="text-decoration-none d-flex align-items-center">
						<i class="fas fa-chevron-right text-primary me-2 small"></i><?= esc($name); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<!-- Popular Articles Widget -->
<?php if (!empty($recentPosts)): ?>
<div class="card border-0 shadow-sm mb-4">
	<div class="card-body">
		<h4 class="fw-bold mb-4">
			<i class="fas fa-fire text-warning me-2"></i>Popular Articles
		</h4>
		<?php foreach (array_slice($recentPosts, 0, 4) as $i => $rPost): ?>
			<div class="popular-article mb-3 pb-3 <?= $i < min(3, count($recentPosts) - 1) ? 'border-bottom' : ''; ?>">
				<h6 class="fw-bold mb-1">
					<a href="<?= base_url('blog/' . esc($rPost['blog_url'])); ?>" class="text-decoration-none"><?= esc($rPost['blog_title']); ?></a>
				</h6>
				<p class="text-muted small mb-0"><?= esc(substr(strip_tags($rPost['blog_description']), 0, 60)); ?>...</p>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>

<!-- Follow Us Widget -->
<div class="card border-0 shadow-sm">
	<div class="card-body">
		<h4 class="fw-bold mb-3">
			<i class="fas fa-share-alt text-info me-2"></i>Follow Us
		</h4>
		<div class="social-links">
			<a href="https://www.facebook.com/pg/alphawonders" target="_blank" class="btn btn-outline-primary btn-sm w-100 mb-2 rounded-pill">
				<i class="fab fa-facebook me-2"></i>Facebook
			</a>
			<a href="https://twitter.com/Alphawondersltd" target="_blank" class="btn btn-outline-info btn-sm w-100 mb-2 rounded-pill">
				<i class="fab fa-twitter me-2"></i>Twitter
			</a>
			<a href="https://ke.linkedin.com/company/alphawonders" target="_blank" class="btn btn-outline-primary btn-sm w-100 rounded-pill">
				<i class="fab fa-linkedin me-2"></i>LinkedIn
			</a>
		</div>
	</div>
</div>
