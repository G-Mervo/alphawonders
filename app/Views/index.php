<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<!-- Hero Section -->
<section class="hero-section py-5" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%); margin-top: 0; min-height: 85vh; display: flex; align-items: center; position: relative; overflow: hidden;">
	<!-- Animated Background -->
	<div class="hero-bg-pattern" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1; background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.3) 1px, transparent 0); background-size: 40px 40px; animation: patternMove 20s linear infinite;"></div>
	<div class="hero-gradient-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 30% 50%, rgba(255,176,0,0.15) 0%, transparent 50%);"></div>
	
	<div class="container py-5 position-relative" style="z-index: 1;">
		<div class="row align-items-center min-vh-75">
			<div class="col-lg-6 mb-5 mb-lg-0">
				<div class="hero-content">
					<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold" style="font-size: 0.85rem; letter-spacing: 0.5px;">
						<i class="fas fa-star me-1"></i>Leading ICT Solutions Provider
					</span>
					<h1 class="display-3 fw-bold mb-4 wow fadeInUp" style="color: #ffffff; text-shadow: 0 4px 6px rgba(0,0,0,0.3); line-height: 1.2; font-size: clamp(2rem, 5vw, 3.5rem);">
						Transform Your Business with <span class="text-warning">Cutting-Edge</span> Technology
					</h1>
					<p class="lead mb-4 wow fadeInUp" data-wow-delay="0.2s" style="color: #e0e0e0; font-size: 1.25rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2); line-height: 1.6;">
						We deliver innovative software solutions, system administration, digital marketing, and IT consultancy services that drive growth and efficiency.
					</p>
					<div class="d-flex flex-column flex-sm-row gap-3 mb-4 wow fadeInUp" data-wow-delay="0.4s">
						<a href="<?php echo base_url('/hire'); ?>" class="btn btn-warning btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg hover-lift" style="background: linear-gradient(135deg, #ffb000 0%, #ffc733 100%); border: none; transition: all 0.3s;">
							<i class="fas fa-rocket me-2"></i>Get Started Today
						</a>
						<a href="<?php echo base_url('/contact-us'); ?>" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg hover-lift" style="border: 2px solid rgba(255,255,255,0.8); transition: all 0.3s;">
							<i class="fas fa-envelope me-2"></i>Contact Us
						</a>
					</div>
					<div class="d-flex flex-wrap gap-4 mt-4 wow fadeInUp" data-wow-delay="0.6s">
						<div class="stat-item">
							<div class="h3 fw-bold text-warning mb-1">500+</div>
							<div class="small text-white-50">Projects Delivered</div>
						</div>
						<div class="stat-item">
							<div class="h3 fw-bold text-warning mb-1">98%</div>
							<div class="small text-white-50">Client Satisfaction</div>
						</div>
						<div class="stat-item">
							<div class="h3 fw-bold text-warning mb-1">10+</div>
							<div class="small text-white-50">Years Experience</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 text-center">
				<div class="hero-image-wrapper position-relative">
					<div class="floating-shapes">
						<div class="shape shape-1"></div>
						<div class="shape shape-2"></div>
						<div class="shape shape-3"></div>
					</div>
					<div class="code-window position-relative" style="background: rgba(0,0,0,0.4); backdrop-filter: blur(10px); border-radius: 15px; padding: 2rem; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
						<div class="code-header mb-3 d-flex align-items-center gap-2">
							<span class="dot" style="width: 12px; height: 12px; border-radius: 50%; background: #ff5f56; display: inline-block;"></span>
							<span class="dot" style="width: 12px; height: 12px; border-radius: 50%; background: #ffbd2e; display: inline-block;"></span>
							<span class="dot" style="width: 12px; height: 12px; border-radius: 50%; background: #27c93f; display: inline-block;"></span>
							<span class="ms-3 text-white-50 small">code.php</span>
						</div>
						<div class="code-content text-start" style="font-family: 'Courier New', monospace; font-size: 0.9rem; line-height: 1.8;">
							<div class="text-success"><span class="text-warning">class</span> <span class="text-info">Solution</span> {</div>
							<div class="ms-3 text-white"><span class="text-warning">public</span> <span class="text-warning">function</span> <span class="text-info">transform</span>() {</div>
							<div class="ms-5 text-white-50">return <span class="text-success">'Success'</span>;</div>
							<div class="ms-3 text-white">}</div>
							<div class="text-success">}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Introduction Section -->
<section class="py-5 bg-white">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10 text-center">
				<p class="fs-4 text-muted mb-0" style="line-height: 1.8;">
					Whether it's <strong>social media</strong>, <strong>e-commerce</strong>, <strong>websites</strong>, search engines like <a href="https://google.com" target="_blank" class="text-decoration-none fw-bold">Google</a>, <strong>games</strong>, <strong>payment gateways</strong>, or any other <strong>mobile application</strong> - software is at the heart of it all.
				</p>
			</div>
		</div>
	</div>
</section>

<!-- Services Section -->
<section class="py-5 bg-light" id="services">
	<div class="container">
		<div class="text-center mb-5">
			<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold">Our Services</span>
			<h2 class="display-5 fw-bold mb-3">What We Do at Alphawonders</h2>
			<p class="lead text-muted col-lg-8 mx-auto">A team dedicated to quality and standards in the industry; using, implementing and creating amazing software solutions</p>
		</div>

		<div class="row g-4">
			<div class="col-lg-4 col-md-6">
				<div class="service-card card h-100 border-0 shadow-sm hover-lift">
					<div class="card-body p-4">
						<div class="service-icon mb-3">
							<div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
								<i class="fas fa-code fa-2x text-primary"></i>
							</div>
						</div>
						<h5 class="card-title fw-bold mb-3">Software</h5>
						<p class="card-text text-muted mb-3">Custom applications, E-commerce platforms, Enterprise systems tailored to your business needs.</p>
						<a href="<?php echo base_url('/softwares'); ?>" class="btn btn-sm btn-outline-primary rounded-pill">
							Learn More <i class="fas fa-arrow-right ms-1"></i>
						</a>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6">
				<div class="service-card card h-100 border-0 shadow-sm hover-lift">
					<div class="card-body p-4">
						<div class="service-icon mb-3">
							<div class="icon-wrapper bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
								<i class="fas fa-server fa-2x text-success"></i>
							</div>
						</div>
						<h5 class="card-title fw-bold mb-3">Systems</h5>
						<p class="card-text text-muted mb-3">Linux, Unix and Windows administration including setup, monitoring and system security.</p>
						<a href="<?php echo base_url('/system-administration'); ?>" class="btn btn-sm btn-outline-success rounded-pill">
							Learn More <i class="fas fa-arrow-right ms-1"></i>
						</a>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6">
				<div class="service-card card h-100 border-0 shadow-sm hover-lift">
					<div class="card-body p-4">
						<div class="service-icon mb-3">
							<div class="icon-wrapper bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
								<i class="fas fa-bullhorn fa-2x text-info"></i>
							</div>
						</div>
						<h5 class="card-title fw-bold mb-3">Marketing</h5>
						<p class="card-text text-muted mb-3">SEO Optimization, Social media marketing, content marketing, Online Marketing strategies.</p>
						<a href="<?php echo base_url('/digital-marketing'); ?>" class="btn btn-sm btn-outline-info rounded-pill">
							Learn More <i class="fas fa-arrow-right ms-1"></i>
						</a>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6">
				<div class="service-card card h-100 border-0 shadow-sm hover-lift">
					<div class="card-body p-4">
						<div class="service-icon mb-3">
							<div class="icon-wrapper bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
								<i class="fas fa-palette fa-2x text-danger"></i>
							</div>
						</div>
						<h5 class="card-title fw-bold mb-3">Design</h5>
						<p class="card-text text-muted mb-3">Web Design, graphic design, prototyping, sketching, wireframing for modern interfaces.</p>
						<a href="<?php echo base_url('/design'); ?>" class="btn btn-sm btn-outline-danger rounded-pill">
							Learn More <i class="fas fa-arrow-right ms-1"></i>
						</a>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6">
				<div class="service-card card h-100 border-0 shadow-sm hover-lift">
					<div class="card-body p-4">
						<div class="service-icon mb-3">
							<div class="icon-wrapper bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
								<i class="fas fa-lightbulb fa-2x text-warning"></i>
							</div>
						</div>
						<h5 class="card-title fw-bold mb-3">Consultancy</h5>
						<p class="card-text text-muted mb-3">Expert consulting in any related IT field and technology to guide your digital transformation.</p>
						<a href="<?php echo base_url('/ict-consultancy'); ?>" class="btn btn-sm btn-outline-warning rounded-pill">
							Learn More <i class="fas fa-arrow-right ms-1"></i>
						</a>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6">
				<div class="service-card card h-100 border-0 shadow-sm hover-lift">
					<div class="card-body p-4">
						<div class="service-icon mb-3">
							<div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
								<i class="fas fa-headset fa-2x text-primary"></i>
							</div>
						</div>
						<h5 class="card-title fw-bold mb-3">Support</h5>
						<p class="card-text text-muted mb-3">Remote, onsite, technical, hardware and software support for your business operations.</p>
						<a href="<?php echo base_url('/it-support'); ?>" class="btn btn-sm btn-outline-primary rounded-pill">
							Learn More <i class="fas fa-arrow-right ms-1"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5 bg-white">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 mb-5 mb-lg-0">
				<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold">Why Choose Us</span>
				<h2 class="display-5 fw-bold mb-4">Excellence in Every Project</h2>
				<div class="feature-list">
					<div class="feature-item d-flex mb-4">
						<div class="feature-icon me-3">
							<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
								<i class="fas fa-check-circle fa-lg text-primary"></i>
							</div>
						</div>
						<div>
							<h5 class="fw-bold mb-2">Proven Track Record</h5>
							<p class="text-muted mb-0">500+ successful projects delivered with 98% client satisfaction rate.</p>
						</div>
					</div>
					<div class="feature-item d-flex mb-4">
						<div class="feature-icon me-3">
							<div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
								<i class="fas fa-users fa-lg text-success"></i>
							</div>
						</div>
						<div>
							<h5 class="fw-bold mb-2">Expert Team</h5>
							<p class="text-muted mb-0">Skilled professionals with years of experience in cutting-edge technologies.</p>
						</div>
					</div>
					<div class="feature-item d-flex mb-4">
						<div class="feature-icon me-3">
							<div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
								<i class="fas fa-clock fa-lg text-warning"></i>
							</div>
						</div>
						<div>
							<h5 class="fw-bold mb-2">Timely Delivery</h5>
							<p class="text-muted mb-0">We respect deadlines and deliver projects on time without compromising quality.</p>
						</div>
					</div>
					<div class="feature-item d-flex">
						<div class="feature-icon me-3">
							<div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
								<i class="fas fa-shield-alt fa-lg text-info"></i>
							</div>
						</div>
						<div>
							<h5 class="fw-bold mb-2">Secure & Reliable</h5>
							<p class="text-muted mb-0">Enterprise-grade security and reliability for all our solutions.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="stats-grid">
					<div class="stat-card text-center p-4 bg-light rounded-4 mb-3">
						<div class="display-4 fw-bold text-primary mb-2">500+</div>
						<div class="text-muted">Projects Completed</div>
					</div>
					<div class="row g-3">
						<div class="col-6">
							<div class="stat-card text-center p-4 bg-primary bg-opacity-10 rounded-4">
								<div class="h2 fw-bold text-primary mb-2">98%</div>
								<div class="small text-muted">Satisfaction Rate</div>
							</div>
						</div>
						<div class="col-6">
							<div class="stat-card text-center p-4 bg-warning bg-opacity-10 rounded-4">
								<div class="h2 fw-bold text-warning mb-2">10+</div>
								<div class="small text-muted">Years Experience</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Blog Section -->
<section class="py-5 bg-light" id="blog">
	<div class="container">
		<div class="text-center mb-5">
			<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold">Latest Insights</span>
			<h2 class="display-5 fw-bold mb-3">Recent News and Events</h2>
			<p class="lead text-muted col-lg-8 mx-auto">Stay updated with the latest insights from our blog</p>
		</div>

		<div class="row g-4">
			<div class="col-lg-9">
				<div class="row g-4">
					<?php if(isset($blogs) && !empty($blogs)): ?>
						<?php foreach(array_slice($blogs, 0, 4) as $blog): ?>
							<div class="col-md-6">
								<div class="card h-100 border-0 shadow-sm hover-lift">
									<div class="row g-0">
										<div class="col-4">
											<img src="<?php echo base_url('assets/img/qtmcomp.jpg'); ?>" class="img-fluid rounded-start h-100" alt="<?php echo htmlspecialchars($blog['title'] ?? 'Blog Post'); ?>" style="object-fit: cover;">
										</div>
										<div class="col-8">
											<div class="card-body d-flex flex-column">
												<h6 class="card-title mb-2">
													<a href="<?php echo base_url('blog/post'); ?>" class="text-decoration-none text-dark fw-bold">
														<?php echo htmlspecialchars($blog['title'] ?? 'Blog Post'); ?>
													</a>
												</h6>
												<p class="card-text small text-muted mb-2 flex-grow-1">
													<?php echo htmlspecialchars(substr($blog['content'] ?? 'Read more about this topic...', 0, 80)) . '...'; ?>
												</p>
												<a href="<?php echo base_url('blog/post'); ?>" class="btn btn-sm btn-outline-primary align-self-start">
													Read More <i class="fas fa-arrow-right ms-1"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php else: ?>
						<!-- Default Blog Posts -->
						<div class="col-md-6">
							<div class="card h-100 border-0 shadow-sm hover-lift">
								<div class="row g-0">
									<div class="col-4">
										<img src="<?php echo base_url('assets/img/qtmcomp.jpg'); ?>" class="img-fluid rounded-start h-100" alt="Quantum Computing" style="object-fit: cover;">
									</div>
									<div class="col-8">
										<div class="card-body d-flex flex-column">
											<h6 class="card-title mb-2">
												<a href="<?php echo base_url('blog/introduction-to-quantum-computers'); ?>" class="text-decoration-none text-dark fw-bold">Quantum Computers</a>
											</h6>
											<p class="card-text small text-muted mb-2 flex-grow-1">Quantum Computers are now being produced for commercial and personal usage...</p>
											<a href="<?php echo base_url('blog/introduction-to-quantum-computers'); ?>" class="btn btn-sm btn-outline-primary align-self-start">
												Read More <i class="fas fa-arrow-right ms-1"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card h-100 border-0 shadow-sm hover-lift">
								<div class="row g-0">
									<div class="col-4">
										<img src="<?php echo base_url('assets/img/datasci.jpg'); ?>" class="img-fluid rounded-start h-100" alt="Data Science" style="object-fit: cover;">
									</div>
									<div class="col-8">
										<div class="card-body d-flex flex-column">
											<h6 class="card-title mb-2">
												<a href="<?php echo base_url('blog/data-science-building-a-career-in-data-analytics'); ?>" class="text-decoration-none text-dark fw-bold">Data Science</a>
											</h6>
											<p class="card-text small text-muted mb-2 flex-grow-1">Data Science has brought a revolution in the way data is being handled...</p>
											<a href="<?php echo base_url('blog/data-science-building-a-career-in-data-analytics'); ?>" class="btn btn-sm btn-outline-primary align-self-start">
												Read More <i class="fas fa-arrow-right ms-1"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="card border-0 shadow-sm sticky-top" style="top: 90px;">
					<div class="card-body">
						<h5 class="card-title mb-3 fw-bold">Follow Us</h5>
						<div class="social-links mb-3">
							<a href="https://www.facebook.com/pg/alphawonders" target="_blank" class="btn btn-outline-primary btn-sm w-100 mb-2">
								<i class="fab fa-facebook me-2"></i>Facebook
							</a>
							<a href="https://twitter.com/Alphawondersltd" target="_blank" class="btn btn-outline-info btn-sm w-100 mb-2">
								<i class="fab fa-twitter me-2"></i>Twitter
							</a>
							<a href="https://ke.linkedin.com/company/alphawonders" target="_blank" class="btn btn-outline-primary btn-sm w-100">
								<i class="fab fa-linkedin me-2"></i>LinkedIn
							</a>
						</div>
						<div class="fb-page" data-href="https://www.facebook.com/pg/alphawonders" data-tabs="timeline" data-width="280" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
							<blockquote cite="https://www.facebook.com/pg/alphawonders" class="fb-xfbml-parse-ignore">
								<a href="https://www.facebook.com/pg/alphawonders">AlphaWonders</a>
							</blockquote>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%);">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-8 mb-4 mb-lg-0">
				<h2 class="display-6 fw-bold mb-3">Ready to Transform Your Business?</h2>
				<p class="lead mb-0">Let's discuss how we can help you achieve your goals with innovative technology solutions.</p>
			</div>
			<div class="col-lg-4 text-lg-end">
				<a href="<?php echo base_url('/hire'); ?>" class="btn btn-warning btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg hover-lift">
					<i class="fas fa-rocket me-2"></i>Get Started Now
				</a>
			</div>
		</div>
	</div>
</section>

<style>
@keyframes patternMove {
	0% { background-position: 0 0; }
	100% { background-position: 40px 40px; }
}

.hover-lift {
	transition: all 0.3s ease;
}

.hover-lift:hover {
	transform: translateY(-8px);
	box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
}

.service-card {
	transition: all 0.3s ease;
}

.service-card:hover {
	transform: translateY(-5px);
	box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.floating-shapes {
	position: absolute;
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	pointer-events: none;
}

.shape {
	position: absolute;
	border-radius: 50%;
	background: rgba(255, 176, 0, 0.1);
	animation: float 6s ease-in-out infinite;
}

.shape-1 {
	width: 100px;
	height: 100px;
	top: 10%;
	left: 10%;
	animation-delay: 0s;
}

.shape-2 {
	width: 150px;
	height: 150px;
	top: 60%;
	right: 10%;
	animation-delay: 2s;
}

.shape-3 {
	width: 80px;
	height: 80px;
	bottom: 20%;
	left: 20%;
	animation-delay: 4s;
}

@keyframes float {
	0%, 100% { transform: translateY(0) rotate(0deg); }
	50% { transform: translateY(-20px) rotate(180deg); }
}

.min-vh-75 {
	min-height: 75vh;
}

@media (max-width: 991.98px) {
	.hero-section {
		min-height: auto;
		padding: 4rem 0;
	}
	
	.min-vh-75 {
		min-height: auto;
	}
}
</style>
