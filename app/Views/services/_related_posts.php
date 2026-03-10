<?php if (!empty($relatedPosts)): ?>
<section class="py-5 bg-white">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<h3 class="fw-bold mb-1">Related Reading</h3>
				<p class="text-muted mb-4">Explore our latest insights related to this service.</p>
				<div class="row g-4">
					<?php foreach ($relatedPosts as $rPost): ?>
						<div class="col-md-4">
							<a href="<?= base_url('blog/' . esc($rPost['blog_url'] ?? '')); ?>" class="text-decoration-none">
								<div class="card border-0 shadow-sm h-100 hover-lift">
									<?php if (!empty($rPost['blog_image'])): ?>
										<img src="<?= base_url($rPost['blog_image']); ?>" class="card-img-top" alt="<?= esc($rPost['blog_title'] ?? ''); ?>" style="height: 160px; object-fit: cover;" loading="lazy" onerror="this.onerror=null; this.src='<?= base_url('assets/img/qtmcomp.jpg'); ?>';">
									<?php else: ?>
										<div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 160px;">
											<i class="fas fa-newspaper fa-3x text-muted"></i>
										</div>
									<?php endif; ?>
									<div class="card-body">
										<h6 class="fw-bold text-dark mb-2"><?= esc($rPost['blog_title'] ?? ''); ?></h6>
										<?php if (!empty($rPost['blog_description'])): ?>
											<p class="text-muted small mb-0"><?= esc(substr(strip_tags($rPost['blog_description']), 0, 100)); ?><?= strlen(strip_tags($rPost['blog_description'])) > 100 ? '...' : ''; ?></p>
										<?php endif; ?>
									</div>
								</div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
				<?php if (!empty($relatedCategorySlug)): ?>
					<div class="text-center mt-4">
						<a href="<?= base_url('blog/category/' . esc($relatedCategorySlug)); ?>" class="btn btn-outline-primary rounded-pill px-4">
							<i class="fas fa-arrow-right me-2"></i>View All Posts in This Category
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
