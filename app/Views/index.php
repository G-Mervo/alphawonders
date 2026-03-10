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
						<i class="fas fa-star me-1"></i>ICT Partner for Kenyan & East African Businesses
					</span>
					<h1 class="display-3 fw-bold mb-4 wow fadeInUp" style="color: #ffffff; text-shadow: 0 4px 6px rgba(0,0,0,0.3); line-height: 1.2; font-size: clamp(2rem, 5vw, 3.5rem);">
						Build Secure, Modern Systems that Help Your Business Grow
					</h1>
					<p class="lead mb-4 wow fadeInUp" data-wow-delay="0.2s" style="color: #e0e0e0; font-size: 1.1rem; text-shadow: 0 2px 4px rgba(0,0,0,0.2); line-height: 1.7;">
						We design, build, and manage software, infrastructure, and digital campaigns for SMEs, startups, and organisations across Kenya and East Africa — so you can focus on running the business while the technology just works.
					</p>
					<div class="d-flex flex-column flex-sm-row gap-3 mb-4 wow fadeInUp" data-wow-delay="0.4s">
						<a href="<?php echo base_url('/hire'); ?>" class="btn btn-warning btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg hover-lift" style="background: linear-gradient(135deg, #ffb000 0%, #ffc733 100%); border: none; transition: all 0.3s;">
							<i class="fas fa-rocket me-2"></i>Book a Free Consultation
						</a>
						<a href="<?php echo base_url('/contact-us'); ?>" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg hover-lift" style="border: 2px solid rgba(255,255,255,0.8); transition: all 0.3s;">
							<i class="fas fa-envelope me-2"></i>Talk to Our Team
						</a>
					</div>
					<div class="d-flex flex-wrap gap-4 mt-4 wow fadeInUp" data-wow-delay="0.6s">
						<div class="stat-item">
							<div class="h3 fw-bold text-warning mb-1">150+</div>
							<div class="small text-white-50">Projects Delivered</div>
						</div>
						<div class="stat-item">
							<div class="h3 fw-bold text-warning mb-1">50+</div>
							<div class="small text-white-50">Happy Clients</div>
						</div>
						<div class="stat-item">
							<div class="h3 fw-bold text-warning mb-1">7+</div>
							<div class="small text-white-50">Years Experience</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 d-none d-lg-block">
				<div class="hero-visual position-relative">
					<!-- Terminal-style card -->
					<div class="position-relative" style="background: #0d1117; border-radius: 16px; padding: 0; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 24px 64px rgba(0,0,0,0.4); overflow: hidden;">
						<!-- Terminal header -->
						<div class="d-flex align-items-center gap-2 px-3 py-2" style="background: #161b22; border-bottom: 1px solid rgba(255,255,255,0.06);">
							<div class="d-flex gap-1">
								<span style="width: 10px; height: 10px; border-radius: 50%; background: #ff5f57;"></span>
								<span style="width: 10px; height: 10px; border-radius: 50%; background: #febc2e;"></span>
								<span style="width: 10px; height: 10px; border-radius: 50%; background: #28c840;"></span>
							</div>
							<span class="text-white-50 ms-2" style="font-size: 0.7rem; font-family: monospace;">alphawonders ~ project</span>
						</div>
						<!-- Terminal content -->
						<div class="p-3" style="font-family: 'Fira Code', 'Consolas', monospace; font-size: 0.78rem; line-height: 1.7;">
							<div><span style="color: #7ee787;">$</span> <span style="color: #e6edf3;">alphawonders</span> <span style="color: #79c0ff;">--services</span></div>
							<div class="mt-1" style="color: #8b949e;">Loading services...</div>
							<div class="mt-2">
								<span style="color: #7ee787;">&#10004;</span> <span style="color: #e6edf3;">Software Development</span> <span style="color: #8b949e;">- Web, Mobile, APIs</span>
							</div>
							<div><span style="color: #7ee787;">&#10004;</span> <span style="color: #e6edf3;">System Administration</span> <span style="color: #8b949e;">- Linux, Cloud, DevOps</span></div>
							<div><span style="color: #7ee787;">&#10004;</span> <span style="color: #e6edf3;">AI Solutions</span> <span style="color: #8b949e;">- ML, Automation, Data</span></div>
							<div><span style="color: #7ee787;">&#10004;</span> <span style="color: #e6edf3;">Design</span> <span style="color: #8b949e;">- UI/UX, Web, Branding</span></div>
							<div><span style="color: #7ee787;">&#10004;</span> <span style="color: #e6edf3;">SEO</span> <span style="color: #8b949e;">- Google ranking, Traffic</span></div>
							<div><span style="color: #7ee787;">&#10004;</span> <span style="color: #e6edf3;">IT Consultancy</span> <span style="color: #8b949e;">- Strategy, Advisory</span></div>
							<div><span style="color: #7ee787;">&#10004;</span> <span style="color: #e6edf3;">IT Support</span> <span style="color: #8b949e;">- Remote &amp; Onsite</span></div>
							<div class="mt-2"><span style="color: #7ee787;">$</span> <span id="termTyping" style="color: #e6edf3;"></span><span class="terminal-cursor">|</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Trust Bar -->
<section class="py-4 bg-white border-bottom">
	<div class="container">
		<div class="row align-items-center justify-content-center text-center g-3">
			<div class="col-6 col-md-3">
				<div class="text-muted small fw-semibold"><i class="fas fa-laptop-code text-primary me-2"></i>Custom Software</div>
			</div>
			<div class="col-6 col-md-3">
				<div class="text-muted small fw-semibold"><i class="fas fa-cloud text-primary me-2"></i>Cloud & DevOps</div>
			</div>
			<div class="col-6 col-md-3">
				<div class="text-muted small fw-semibold"><i class="fas fa-robot text-primary me-2"></i>AI Solutions</div>
			</div>
			<div class="col-6 col-md-3">
				<div class="text-muted small fw-semibold"><i class="fas fa-search text-primary me-2"></i>SEO</div>
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
						<h5 class="card-title fw-bold mb-3">Software Development</h5>
						<p class="card-text text-muted mb-3">Web apps, mobile apps, APIs, e-commerce platforms, and custom systems tailored to your business.</p>
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
								<i class="fas fa-search fa-2x text-info"></i>
							</div>
						</div>
						<h5 class="card-title fw-bold mb-3">SEO</h5>
						<p class="card-text text-muted mb-3">Search engine optimisation, Google ranking, keyword strategy, and organic traffic growth.</p>
						<a href="<?php echo base_url('/seo'); ?>" class="btn btn-sm btn-outline-info rounded-pill">
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

			<div class="col-lg-4 col-md-6">
				<div class="service-card card h-100 border-0 shadow-sm hover-lift">
					<div class="card-body p-4">
						<div class="service-icon mb-3">
							<div class="icon-wrapper bg-purple bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background: rgba(138, 43, 226, 0.1);">
								<i class="fas fa-robot fa-2x" style="color: #8a2be2;"></i>
							</div>
						</div>
						<h5 class="card-title fw-bold mb-3">AI Solutions</h5>
						<p class="card-text text-muted mb-3">AI integration, machine learning, chatbots, automation, and intelligent systems to streamline your business.</p>
						<a href="<?php echo base_url('/ai-services'); ?>" class="btn btn-sm rounded-pill" style="border-color: #8a2be2; color: #8a2be2;">
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
							<p class="text-muted mb-0">150+ successful projects delivered across diverse industries with proven results.</p>
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
						<div class="display-4 fw-bold text-primary mb-2">150+</div>
						<div class="text-muted">Projects Completed</div>
					</div>
					<div class="row g-3">
						<div class="col-6">
							<div class="stat-card text-center p-4 bg-primary bg-opacity-10 rounded-4">
								<div class="h2 fw-bold text-primary mb-2">50+</div>
								<div class="small text-muted">Happy Clients</div>
							</div>
						</div>
						<div class="col-6">
							<div class="stat-card text-center p-4 bg-warning bg-opacity-10 rounded-4">
								<div class="h2 fw-bold text-warning mb-2">7+</div>
								<div class="small text-muted">Years Experience</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- How We Work Section -->
<section class="py-5 bg-light" id="how-we-work">
	<div class="container">
		<div class="text-center mb-5">
			<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold">Our Process</span>
			<h2 class="display-5 fw-bold mb-3">How We Work</h2>
			<p class="lead text-muted col-lg-8 mx-auto">A clear, transparent process from first conversation to delivery — so you always know what to expect.</p>
		</div>
		<div class="row g-4 justify-content-center">
			<div class="col-lg-2 col-md-4 col-6 text-center">
				<div class="bg-white rounded-4 p-4 shadow-sm h-100">
					<div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
						<i class="fas fa-comments fa-2x text-primary"></i>
					</div>
					<div class="small fw-bold text-primary mb-1">1. Discovery</div>
					<p class="small text-muted mb-0">We listen to your goals, challenges, and budget to understand what you need.</p>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 text-center">
				<div class="bg-white rounded-4 p-4 shadow-sm h-100">
					<div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
						<i class="fas fa-file-alt fa-2x text-success"></i>
					</div>
					<div class="small fw-bold text-success mb-1">2. Proposal</div>
					<p class="small text-muted mb-0">We send a clear scope, timeline, and quote — no hidden costs.</p>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 text-center">
				<div class="bg-white rounded-4 p-4 shadow-sm h-100">
					<div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
						<i class="fas fa-cogs fa-2x text-warning"></i>
					</div>
					<div class="small fw-bold text-warning mb-1">3. Build</div>
					<p class="small text-muted mb-0">We design and develop your solution with regular check-ins.</p>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 text-center">
				<div class="bg-white rounded-4 p-4 shadow-sm h-100">
					<div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
						<i class="fas fa-rocket fa-2x text-info"></i>
					</div>
					<div class="small fw-bold text-info mb-1">4. Launch</div>
					<p class="small text-muted mb-0">We deploy, train your team, and hand over documentation.</p>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 text-center">
				<div class="bg-white rounded-4 p-4 shadow-sm h-100">
					<div class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
						<i class="fas fa-headset fa-2x text-secondary"></i>
					</div>
					<div class="small fw-bold text-secondary mb-1">5. Support</div>
					<p class="small text-muted mb-0">Ongoing support and maintenance so your system keeps running smoothly.</p>
				</div>
			</div>
		</div>
		<div class="text-center mt-4">
			<a href="<?php echo base_url('/hire'); ?>" class="btn btn-warning rounded-pill px-4 py-2 fw-bold">
				<i class="fas fa-calendar-check me-2"></i>Book a Free 30-Min Discovery Call
			</a>
		</div>
	</div>
</section>

<!-- Industries We Serve -->
<section class="py-5 bg-white">
	<div class="container">
		<div class="text-center mb-4">
			<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold">Who We Serve</span>
			<h2 class="display-6 fw-bold mb-3">Industries We Work With</h2>
			<p class="text-muted col-lg-7 mx-auto">From SMEs and startups to NGOs and enterprises — we help businesses across Kenya and East Africa leverage technology.</p>
		</div>
		<div class="row g-3 justify-content-center">
			<div class="col-6 col-md-4 col-lg-2">
				<div class="border rounded-3 p-3 text-center h-100">
					<i class="fas fa-briefcase text-primary mb-2"></i>
					<div class="small fw-semibold text-dark">SMEs</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-2">
				<div class="border rounded-3 p-3 text-center h-100">
					<i class="fas fa-store text-primary mb-2"></i>
					<div class="small fw-semibold text-dark">Retail & E-commerce</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-2">
				<div class="border rounded-3 p-3 text-center h-100">
					<i class="fas fa-university text-primary mb-2"></i>
					<div class="small fw-semibold text-dark">Finance & Fintech</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-2">
				<div class="border rounded-3 p-3 text-center h-100">
					<i class="fas fa-hand-holding-heart text-primary mb-2"></i>
					<div class="small fw-semibold text-dark">NGOs & Non-profits</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-2">
				<div class="border rounded-3 p-3 text-center h-100">
					<i class="fas fa-graduation-cap text-primary mb-2"></i>
					<div class="small fw-semibold text-dark">Education</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-2">
				<div class="border rounded-3 p-3 text-center h-100">
					<i class="fas fa-rocket text-primary mb-2"></i>
					<div class="small fw-semibold text-dark">Tech & Startups</div>
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
			<p class="lead text-muted col-lg-8 mx-auto">Stay updated with the latest insights on tech, digital transformation, and ICT for Kenyan businesses.</p>
		</div>

		<div class="row g-4">
			<div class="col-lg-9">
				<div class="row g-4">
					<?php if(isset($blogs) && !empty($blogs) && is_array($blogs)): ?>
						<?php foreach(array_slice($blogs, 0, 4) as $blog): ?>
							<?php 
								$blogTitle = $blog['blog_title'] ?? 'Blog Post';
								$blogDesc = strip_tags($blog['blog_description'] ?? 'Read more about this topic...');
								$blogImage = $blog['blog_image'] ?? 'assets/img/qtmcomp.jpg';
								$blogUrl = 'blog/' . ($blog['blog_url'] ?? 'post');
							?>
							<div class="col-md-6">
								<div class="card h-100 border-0 shadow-sm hover-lift">
									<div class="row g-0">
										<div class="col-4">
											<img src="<?php echo base_url($blogImage); ?>" class="img-fluid rounded-start h-100" alt="<?php echo htmlspecialchars($blogTitle); ?>" style="object-fit: cover; width: 100%; height: 100%; min-height: 120px;" loading="lazy" onerror="this.onerror=null; this.src='<?php echo base_url('assets/img/qtmcomp.jpg'); ?>';">
										</div>
										<div class="col-8">
											<div class="card-body d-flex flex-column">
												<h6 class="card-title mb-2">
													<a href="<?php echo base_url($blogUrl); ?>" class="text-decoration-none text-dark fw-bold">
														<?php echo htmlspecialchars($blogTitle); ?>
													</a>
												</h6>
												<p class="card-text small text-muted mb-2 flex-grow-1">
													<?php echo htmlspecialchars(substr($blogDesc, 0, 80)) . '...'; ?>
												</p>
												<a href="<?php echo base_url($blogUrl); ?>" class="btn btn-sm btn-outline-primary align-self-start">
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
										<img src="<?php echo base_url('assets/img/qtmcomp.jpg'); ?>" class="img-fluid rounded-start h-100" alt="Quantum Computing" style="object-fit: cover; width: 100%; height: 100%; min-height: 120px;" loading="lazy">
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
										<img src="<?php echo base_url('assets/img/datasci.jpg'); ?>" class="img-fluid rounded-start h-100" alt="Data Science" style="object-fit: cover; width: 100%; height: 100%; min-height: 120px;" loading="lazy">
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
				<div class="mt-4 text-center">
					<a href="<?php echo base_url('/blog'); ?>" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
						<i class="fas fa-book-open me-2"></i>View All Blog Posts
					</a>
				</div>
				<?php if (!empty($popularTags)): ?>
				<div class="mt-4">
					<h6 class="fw-bold mb-3">Popular Topics</h6>
					<div class="d-flex flex-wrap gap-2">
						<?php foreach (array_slice($popularTags, 0, 8) as $tag): ?>
							<a href="<?php echo base_url('blog/tag/' . ($tag['slug'] ?? '')); ?>" class="badge bg-light text-dark text-decoration-none px-3 py-2"><?php echo esc($tag['name'] ?? ''); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
				<?php elseif (!empty($categories)): ?>
				<div class="mt-4">
					<h6 class="fw-bold mb-3">Browse by Category</h6>
					<div class="d-flex flex-wrap gap-2">
						<?php foreach (array_slice($categories, 0, 8) as $cat): ?>
							<a href="<?php echo base_url('blog/category/' . ($cat['slug'] ?? '')); ?>" class="badge bg-light text-dark text-decoration-none px-3 py-2"><?php echo esc($cat['name'] ?? ''); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="col-lg-3">
				<div class="card border-0 shadow-sm sticky-top mb-3" style="top: 90px;">
					<div class="card-body">
						<h5 class="card-title mb-2 fw-bold">Get Free Tech Insights</h5>
						<p class="small text-muted mb-3">Monthly tips on software, SEO, and digital growth for Kenyan businesses. No spam.</p>
						<form method="post" action="<?php echo base_url('/subscribe'); ?>" id="homepageNewsletterForm">
							<div class="input-group input-group-sm">
								<input type="email" class="form-control" name="email_sub" placeholder="Your email" required>
								<button type="submit" class="btn btn-warning">
									<i class="fas fa-paper-plane"></i>
								</button>
							</div>
						</form>
					</div>
				</div>
				<div class="card border-0 shadow-sm sticky-top" style="top: 90px;">
					<div class="card-body">
						<h5 class="card-title mb-3 fw-bold">Follow Us</h5>
						<div class="social-links mb-3">
							<a href="https://www.facebook.com/pg/alphawonders" target="_blank" class="btn btn-outline-primary btn-sm w-100 mb-2">
								<i class="fab fa-facebook me-2"></i>Facebook
							</a>
							<a href="https://x.com/Alphawondersltd" target="_blank" class="btn btn-outline-dark btn-sm w-100 mb-2">
								<i class="fab fa-x-twitter me-2"></i>X
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
				<p class="lead mb-0">Book a free 30-minute discovery call. We respond within 24 hours — no spam, no obligation.</p>
			</div>
			<div class="col-lg-4 text-lg-end">
				<a href="<?php echo base_url('/hire'); ?>" class="btn btn-warning btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg hover-lift">
					<i class="fas fa-calendar-check me-2"></i>Book a Free 30-Min Call
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

.terminal-cursor {
	animation: blink 1s step-end infinite;
}

@keyframes blink {
	50% { opacity: 0; }
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

/* Wide devices (1400px and up) */
@media (min-width: 1400px) {
	.hero-section {
		padding: 6rem 0;
	}
	
	.hero-content h1 {
		font-size: clamp(2.5rem, 6vw, 4rem) !important;
	}
	
	.service-card .card-body {
		padding: 2rem !important;
	}
	
	/* Ensure all images load properly */
	img {
		max-width: 100%;
		height: auto;
		display: block;
	}
	
	.card img,
	.blog-section img {
		width: 100%;
		height: auto;
		object-fit: cover;
	}
}

/* Extra wide devices (1920px and up) */
@media (min-width: 1920px) {
	.container {
		max-width: 1600px;
	}
	
	.hero-section {
		padding: 8rem 0;
	}
	
	/* Prevent content from stretching too wide */
	.row {
		max-width: 100%;
	}
	
	/* Blog images responsive on ultra-wide */
	.blog-section .card img {
		width: 100%;
		height: auto;
		max-width: 100%;
		object-fit: cover;
		min-height: 150px;
	}
	
	/* Service cards spacing */
	.service-card {
		margin-bottom: 2rem;
	}
}
</style>

<script>
(function() {
	var el = document.getElementById('termTyping');
	if (!el) return;
	var lines = [
		{ cmd: 'alphawonders --deploy webapp', out: '\u2713 Deployed to production \u2014 0 downtime' },
		{ cmd: 'alphawonders --build mobile-app', out: '\u2713 iOS & Android builds ready' },
		{ cmd: 'alphawonders --seo audit site.co.ke', out: '\u2713 Score: 94/100 \u2014 3 fixes suggested' },
		{ cmd: 'alphawonders --ai train model', out: '\u2713 Model accuracy: 97.2% \u2014 deployed' },
		{ cmd: 'alphawonders --server health', out: '\u2713 All systems operational \u2014 99.9% uptime' }
	];
	var cursor = el.nextElementSibling;
	var lineIdx = 0;
	var phase = 'cmd'; // cmd -> pause -> out -> wait -> erase
	var charIdx = 0;
	var currentText = '';

	function tick() {
		var line = lines[lineIdx];
		if (phase === 'cmd') {
			charIdx++;
			currentText = line.cmd.substring(0, charIdx);
			el.innerHTML = '<span style="color:#e6edf3">' + currentText + '</span>';
			if (charIdx >= line.cmd.length) {
				phase = 'pause';
				setTimeout(tick, 400);
				return;
			}
			setTimeout(tick, 45 + Math.random() * 35);
		} else if (phase === 'pause') {
			phase = 'out';
			charIdx = 0;
			setTimeout(tick, 100);
		} else if (phase === 'out') {
			el.innerHTML = '<span style="color:#e6edf3">' + line.cmd + '</span><br><span style="color:#7ee787">' + line.out + '</span>';
			phase = 'wait';
			setTimeout(tick, 2500);
		} else if (phase === 'wait') {
			phase = 'erase';
			charIdx = line.cmd.length + line.out.length;
			setTimeout(tick, 30);
		} else if (phase === 'erase') {
			el.textContent = '';
			lineIdx = (lineIdx + 1) % lines.length;
			phase = 'cmd';
			charIdx = 0;
			setTimeout(tick, 600);
		}
	}

	setTimeout(tick, 1500);
})();
</script>
