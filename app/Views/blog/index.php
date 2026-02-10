<?php defined('FCPATH') OR exit('No direct script access is allowed'); ?>

<!-- Blog Hero Section -->
<section class="py-5 bg-primary text-white" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%); margin-top: 0; padding: 5rem 0;">
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-lg-8">
				<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold">Latest Insights</span>
				<h1 class="display-4 fw-bold mb-3">
					<?php if (!empty($category)): ?>
						<?= esc(ucwords(str_replace('-', ' ', $category))); ?>
					<?php else: ?>
						Alphawonders Blog
					<?php endif; ?>
				</h1>
				<p class="lead mb-0">The Alpha Technology - Stay updated with the latest insights, trends, and innovations in technology</p>
			</div>
		</div>
	</div>
</section>

<!-- Blog Section -->
<section class="py-5">
	<div class="container">
		<div class="row g-4">
			<!-- Blog Entries Column -->
			<div class="col-lg-8">
				<?php if (!empty($category)): ?>
					<div class="mb-4">
						<a href="<?= base_url('blog'); ?>" class="btn btn-outline-primary rounded-pill btn-sm">
							<i class="fas fa-arrow-left me-1"></i> All Posts
						</a>
					</div>
				<?php endif; ?>

				<?php if(isset($blogs) && !empty($blogs) && is_array($blogs)): ?>
					<?php foreach($blogs as $blog): ?>
						<article class="card border-0 shadow-sm mb-4 hover-lift">
							<div class="row g-0">
								<div class="col-md-4">
									<img src="<?= base_url($blog['blog_image']); ?>" class="img-fluid rounded-start h-100" alt="<?= esc($blog['blog_title']); ?>" style="object-fit: cover; min-height: 200px; width: 100%; height: 100%;" loading="lazy" onerror="this.onerror=null; this.src='<?= base_url('assets/img/qtmcomp.jpg'); ?>';">
								</div>
								<div class="col-md-8">
									<div class="card-body p-4">
										<?php if (!empty($blog['blog_category'])): ?>
											<span class="badge bg-primary bg-opacity-10 text-primary mb-2"><?= esc($blog['blog_category']); ?></span>
										<?php endif; ?>
										<h2 class="card-title fw-bold mb-2">
											<a href="<?= base_url('blog/' . esc($blog['blog_url'])); ?>" class="text-decoration-none text-dark">
												<?= esc($blog['blog_title']); ?>
											</a>
										</h2>
										<p class="text-muted small mb-2">
											<i class="fas fa-user me-1"></i> by <?= esc($blog['blog_author']); ?>
											<span class="ms-3"><i class="fas fa-clock me-1"></i> <?= date('F d, Y', strtotime($blog['date_created'])); ?></span>
										</p>
										<hr>
										<p class="card-text">
											<?= esc(substr(strip_tags($blog['blog_description']), 0, 150)) . (strlen(strip_tags($blog['blog_description'])) > 150 ? '...' : ''); ?>
										</p>
										<a href="<?= base_url('blog/' . esc($blog['blog_url'])); ?>" class="btn btn-primary rounded-pill mt-2">
											Read More <i class="fas fa-arrow-right ms-2"></i>
										</a>
									</div>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="text-center py-5">
						<i class="fas fa-blog fa-3x text-muted mb-3"></i>
						<h4 class="text-muted">No blog posts found</h4>
						<p class="text-muted">Check back soon for new content!</p>
						<?php if (!empty($category)): ?>
							<a href="<?= base_url('blog'); ?>" class="btn btn-primary rounded-pill mt-2">View All Posts</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<!-- Pagination -->
				<?php if (isset($pager) && $pager): ?>
					<div class="mt-4">
						<?= $pager->links(); ?>
					</div>
				<?php endif; ?>
			</div>

			<!-- Blog Sidebar -->
			<div class="col-lg-4">
				<?= view('blog/_sidebar'); ?>
			</div>
		</div>
	</div>
</section>

<style>
.hover-lift {
	transition: all 0.3s ease;
}

.hover-lift:hover {
	transform: translateY(-5px);
	box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.popular-article a:hover {
	color: var(--primary-color) !important;
}

.page-link {
	border-radius: 50px !important;
	padding: 0.5rem 1.5rem;
}

.page-link:hover {
	background-color: var(--primary-color);
	color: white;
	border-color: var(--primary-color);
}
</style>
