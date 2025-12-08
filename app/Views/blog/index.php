<?php defined('FCPATH') OR exit('No direct script access is allowed'); ?>

<!-- Blog Hero Section -->
<section class="py-5 bg-primary text-white" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%); margin-top: 0; padding: 5rem 0;">
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-lg-8">
				<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold">Latest Insights</span>
				<h1 class="display-4 fw-bold mb-3">Alphawonders Blog</h1>
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
				<?php if(isset($blogs) && !empty($blogs) && is_array($blogs)): ?>
					<?php foreach($blogs as $blog): ?>
						<?php 
							$blogTitle = isset($blog['title']) ? $blog['title'] : (is_object($blog) && isset($blog->title) ? $blog->title : 'Blog Post');
							$blogDesc = isset($blog['description']) ? $blog['description'] : (is_object($blog) && isset($blog->description) ? $blog->description : '');
							$blogImage = isset($blog['image']) ? $blog['image'] : (is_object($blog) && isset($blog->image) ? $blog->image : 'assets/img/qtmcomp.jpg');
							$blogUrl = isset($blog['url']) ? $blog['url'] : (is_object($blog) && isset($blog->url) ? $blog->url : 'blog/post');
							$blogDate = isset($blog['time']) ? $blog['time'] : (is_object($blog) && isset($blog->time) ? $blog->time : date('F d, Y'));
						?>
						<article class="card border-0 shadow-sm mb-4 hover-lift">
							<div class="row g-0">
								<div class="col-md-4">
									<img src="<?php echo base_url($blogImage); ?>" class="img-fluid rounded-start h-100" alt="<?php echo htmlspecialchars($blogTitle); ?>" style="object-fit: cover; min-height: 200px; width: 100%; height: 100%;" loading="lazy" onerror="this.onerror=null; this.src='<?php echo base_url('assets/img/qtmcomp.jpg'); ?>';">
								</div>
								<div class="col-md-8">
									<div class="card-body p-4">
										<h2 class="card-title fw-bold mb-2">
											<a href="<?php echo base_url($blogUrl); ?>" class="text-decoration-none text-dark">
												<?php echo htmlspecialchars($blogTitle); ?>
											</a>
										</h2>
										<p class="text-muted small mb-2">
											<i class="fas fa-user me-1"></i> by <a href="#" class="text-decoration-none">Mervin Gaitho</a>
											<span class="ms-3"><i class="fas fa-clock me-1"></i> <?php echo date('F d, Y', strtotime($blogDate)); ?></span>
										</p>
										<hr>
										<p class="card-text">
											<?php echo htmlspecialchars(substr($blogDesc, 0, 150)) . (strlen($blogDesc) > 150 ? '...' : ''); ?>
										</p>
										<a href="<?php echo base_url($blogUrl); ?>" class="btn btn-primary rounded-pill mt-2">
											Read More <i class="fas fa-arrow-right ms-2"></i>
										</a>
									</div>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				<?php else: ?>
					<!-- Default Blog Posts -->
					<article class="card border-0 shadow-sm mb-4 hover-lift">
						<div class="row g-0">
							<div class="col-md-4">
								<img src="<?php echo base_url('assets/img/qtmcomp.jpg'); ?>" class="img-fluid rounded-start h-100" alt="Quantum Computing" style="object-fit: cover; min-height: 200px;">
							</div>
							<div class="col-md-8">
								<div class="card-body p-4">
									<h2 class="card-title fw-bold mb-2">
										<a href="<?php echo base_url('blog/introduction-to-quantum-computers'); ?>" class="text-decoration-none text-dark">Quantum Technology</a>
									</h2>
									<p class="text-muted small mb-2">
										<i class="fas fa-user me-1"></i> by <a href="#" class="text-decoration-none">Mervin Gaitho</a>
										<span class="ms-3"><i class="fas fa-clock me-1"></i> August 30, 2018</span>
									</p>
									<hr>
									<p class="card-text">Quantum Computers are now being produced for commercial and personal usage. This will see the rate of invention and information processing rapidly increase. Their specifications are just amazing and we all love faster smarter machines.</p>
									<a href="<?php echo base_url('blog/introduction-to-quantum-computers'); ?>" class="btn btn-primary rounded-pill mt-2">
										Read More <i class="fas fa-arrow-right ms-2"></i>
									</a>
								</div>
							</div>
						</div>
					</article>

					<article class="card border-0 shadow-sm mb-4 hover-lift">
						<div class="row g-0">
							<div class="col-md-4">
								<img src="<?php echo base_url('assets/img/datasci.jpg'); ?>" class="img-fluid rounded-start h-100" alt="Data Science" style="object-fit: cover; min-height: 200px;">
							</div>
							<div class="col-md-8">
								<div class="card-body p-4">
									<h2 class="card-title fw-bold mb-2">
										<a href="<?php echo base_url('blog/data-science-building-a-career-in-data-analytics'); ?>" class="text-decoration-none text-dark">Data Science</a>
									</h2>
									<p class="text-muted small mb-2">
										<i class="fas fa-user me-1"></i> by <a href="#" class="text-decoration-none">Mervin Gaitho</a>
										<span class="ms-3"><i class="fas fa-clock me-1"></i> August 15, 2019</span>
									</p>
									<hr>
									<p class="card-text">Data Science has brought a revolution in the way data is being handled, collected, recorded, analysed and presented. This has led to many contrasting views and change of policies by many Companies.</p>
									<a href="<?php echo base_url('blog/data-science-building-a-career-in-data-analytics'); ?>" class="btn btn-primary rounded-pill mt-2">
										Read More <i class="fas fa-arrow-right ms-2"></i>
									</a>
								</div>
							</div>
						</div>
					</article>

					<article class="card border-0 shadow-sm mb-4 hover-lift">
						<div class="row g-0">
							<div class="col-md-4">
								<img src="<?php echo base_url('assets/img/robotics.jpg'); ?>" class="img-fluid rounded-start h-100" alt="Robotics" style="object-fit: cover; min-height: 200px;">
							</div>
							<div class="col-md-8">
								<div class="card-body p-4">
									<h2 class="card-title fw-bold mb-2">
										<a href="<?php echo base_url('blog/what-is-robotics'); ?>" class="text-decoration-none text-dark">Robotics</a>
									</h2>
									<p class="text-muted small mb-2">
										<i class="fas fa-user me-1"></i> by <a href="#" class="text-decoration-none">Mervin Gaitho</a>
										<span class="ms-3"><i class="fas fa-clock me-1"></i> August 29, 2019</span>
									</p>
									<hr>
									<p class="card-text">Robotics deals with the design, construction, operation, and use of robots, as well as computer systems for their control, sensory feedback, and information processing.</p>
									<a href="<?php echo base_url('blog/what-is-robotics'); ?>" class="btn btn-primary rounded-pill mt-2">
										Read More <i class="fas fa-arrow-right ms-2"></i>
									</a>
								</div>
							</div>
						</div>
					</article>
				<?php endif; ?>

				<!-- Pagination -->
				<nav aria-label="Blog pagination">
					<ul class="pagination justify-content-center">
						<li class="page-item">
							<a class="page-link rounded-pill me-2" href="#" aria-label="Previous">
								<span aria-hidden="true">&laquo; Older</span>
							</a>
						</li>
						<li class="page-item">
							<a class="page-link rounded-pill" href="#" aria-label="Next">
								<span aria-hidden="true">Newer &raquo;</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>

			<!-- Blog Sidebar -->
			<div class="col-lg-4">
				<!-- Categories Widget -->
				<div class="card border-0 shadow-sm mb-4">
					<div class="card-body">
						<h4 class="fw-bold mb-4">
							<i class="fas fa-folder-open text-primary me-2"></i>Blog Categories
						</h4>
						<ul class="list-unstyled">
							<li class="mb-2">
								<a href="<?php echo base_url('blog/category/machine-learning'); ?>" class="text-decoration-none d-flex align-items-center">
									<i class="fas fa-chevron-right text-primary me-2 small"></i>Machine Learning
								</a>
							</li>
							<li class="mb-2">
								<a href="<?php echo base_url('blog/category/artificial-intelligence'); ?>" class="text-decoration-none d-flex align-items-center">
									<i class="fas fa-chevron-right text-primary me-2 small"></i>Artificial Intelligence
								</a>
							</li>
							<li class="mb-2">
								<a href="<?php echo base_url('blog/category/robotics'); ?>" class="text-decoration-none d-flex align-items-center">
									<i class="fas fa-chevron-right text-primary me-2 small"></i>Robotics
								</a>
							</li>
							<li class="mb-2">
								<a href="<?php echo base_url('blog/category/quantum-computing'); ?>" class="text-decoration-none d-flex align-items-center">
									<i class="fas fa-chevron-right text-primary me-2 small"></i>Quantum Computing
								</a>
							</li>
							<li class="mb-2">
								<a href="<?php echo base_url('blog/category/digital-marketing'); ?>" class="text-decoration-none d-flex align-items-center">
									<i class="fas fa-chevron-right text-primary me-2 small"></i>Digital Marketing
								</a>
							</li>
							<li class="mb-2">
								<a href="<?php echo base_url('blog/category/blockchain'); ?>" class="text-decoration-none d-flex align-items-center">
									<i class="fas fa-chevron-right text-primary me-2 small"></i>Blockchain Technology
								</a>
							</li>
							<li class="mb-2">
								<a href="<?php echo base_url('blog/category/iot'); ?>" class="text-decoration-none d-flex align-items-center">
									<i class="fas fa-chevron-right text-primary me-2 small"></i>Internet of Things
								</a>
							</li>
							<li class="mb-2">
								<a href="<?php echo base_url('blog/category/cyber-security'); ?>" class="text-decoration-none d-flex align-items-center">
									<i class="fas fa-chevron-right text-primary me-2 small"></i>Cyber Security
								</a>
							</li>
							<li class="mb-2">
								<a href="<?php echo base_url('blog/category/data-science'); ?>" class="text-decoration-none d-flex align-items-center">
									<i class="fas fa-chevron-right text-primary me-2 small"></i>Data Science
								</a>
							</li>
							<li class="mb-2">
								<a href="<?php echo base_url('blog/category/trends-technology'); ?>" class="text-decoration-none d-flex align-items-center">
									<i class="fas fa-chevron-right text-primary me-2 small"></i>Trends in Technology
								</a>
							</li>
						</ul>
					</div>
				</div>

				<!-- Popular Articles Widget -->
				<div class="card border-0 shadow-sm mb-4">
					<div class="card-body">
						<h4 class="fw-bold mb-4">
							<i class="fas fa-fire text-warning me-2"></i>Popular Articles
						</h4>
						<div class="popular-article mb-3 pb-3 border-bottom">
							<h6 class="fw-bold mb-1">
								<a href="<?php echo base_url('blog/introduction-to-quantum-computers'); ?>" class="text-decoration-none">Quantum Technology</a>
							</h6>
							<p class="text-muted small mb-0">Quantum Computers are now being produced for commercial...</p>
						</div>
						<div class="popular-article mb-3 pb-3 border-bottom">
							<h6 class="fw-bold mb-1">
								<a href="#" class="text-decoration-none">Artificial Intelligence</a>
							</h6>
							<p class="text-muted small mb-0">Artificial Intelligence is proving that machines can be as smart...</p>
						</div>
						<div class="popular-article mb-3 pb-3 border-bottom">
							<h6 class="fw-bold mb-1">
								<a href="<?php echo base_url('blog/what-is-robotics'); ?>" class="text-decoration-none">Robotics</a>
							</h6>
							<p class="text-muted small mb-0">Robotics deals with the design, construction, operation...</p>
						</div>
						<div class="popular-article">
							<h6 class="fw-bold mb-1">
								<a href="<?php echo base_url('blog/data-science-building-a-career-in-data-analytics'); ?>" class="text-decoration-none">Data Science</a>
							</h6>
							<p class="text-muted small mb-0">Data Science has brought a revolution in the way data...</p>
						</div>
					</div>
				</div>

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
