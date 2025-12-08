<?php defined('FCPATH') OR exit('No direct script allowed'); ?>

<!-- Contact Hero Section -->
<section class="py-5 bg-primary text-white" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%); margin-top: 0; padding: 5rem 0;">
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-lg-8">
				<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold">Get In Touch</span>
				<h1 class="display-4 fw-bold mb-3">Contact Us</h1>
				<p class="lead mb-0">Send us a message today and let's discuss how we can help your business grow</p>
			</div>
		</div>
	</div>
</section>

<!-- Contact Section -->
<section class="py-5" id="contacts">
	<div class="container">
		<div class="row g-5">
			<!-- Contact Form -->
			<div class="col-lg-8">
				<div class="card border-0 shadow-lg rounded-4 p-4 p-md-5">
					<h2 class="fw-bold mb-4">Send Us a Message</h2>
					<form action="<?php echo base_url('/send'); ?>" method="POST" class="row g-4">
						<div class="col-md-6">
							<label for="fullname" class="form-label fw-bold">
								<i class="fas fa-user text-primary me-2"></i>Full Name <span class="text-danger">*</span>
							</label>
							<input type="text" class="form-control form-control-lg" id="fullname" name="fullname" placeholder="Your full name" required style="border-radius: 10px;">
						</div>

						<div class="col-md-6">
							<label for="email" class="form-label fw-bold">
								<i class="fas fa-envelope text-primary me-2"></i>Email Address <span class="text-danger">*</span>
							</label>
							<input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="your.email@example.com" required style="border-radius: 10px;">
						</div>

						<div class="col-12">
							<label for="phone_number" class="form-label fw-bold">
								<i class="fas fa-phone text-primary me-2"></i>Phone Number <span class="text-danger">*</span>
							</label>
							<input type="tel" class="form-control form-control-lg" id="phone_number" name="phone_number" placeholder="+254 700 000 000" required style="border-radius: 10px;">
						</div>

						<div class="col-12">
							<label for="message" class="form-label fw-bold">
								<i class="fas fa-comment text-primary me-2"></i>Message <span class="text-danger">*</span>
							</label>
							<textarea class="form-control form-control-lg" id="message" name="message" rows="6" placeholder="Tell us about your project or inquiry..." required style="border-radius: 10px; resize: vertical;"></textarea>
						</div>

						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg hover-lift w-100 w-md-auto">
								<i class="fas fa-paper-plane me-2"></i>Send Message
							</button>
						</div>
					</form>
				</div>
			</div>

			<!-- Contact Info -->
			<div class="col-lg-4">
				<div class="contact-info-card">
					<div class="card border-0 shadow-lg rounded-4 p-4 mb-4">
						<h3 class="fw-bold mb-4">Contact Information</h3>
						
						<div class="contact-item d-flex mb-4">
							<div class="contact-icon me-3">
								<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
									<i class="fas fa-phone fa-lg text-primary"></i>
								</div>
							</div>
							<div>
								<h6 class="fw-bold mb-1">Phone</h6>
								<a href="tel:+254736099643" class="text-decoration-none text-muted">+254 736 099 643</a>
							</div>
						</div>

						<div class="contact-item d-flex mb-4">
							<div class="contact-icon me-3">
								<div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
									<i class="fas fa-envelope fa-lg text-success"></i>
								</div>
							</div>
							<div>
								<h6 class="fw-bold mb-1">Email</h6>
								<a href="mailto:info@alphawonders.com" class="text-decoration-none text-muted">info@alphawonders.com</a>
							</div>
						</div>

						<div class="contact-item d-flex">
							<div class="contact-icon me-3">
								<div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
									<i class="fas fa-clock fa-lg text-warning"></i>
								</div>
							</div>
							<div>
								<h6 class="fw-bold mb-1">Business Hours</h6>
								<p class="text-muted mb-0 small">Mon - Fri: 9:00 AM - 6:00 PM<br>Sat: 10:00 AM - 2:00 PM</p>
							</div>
						</div>
					</div>

					<div class="card border-0 shadow-lg rounded-4 p-4">
						<h3 class="fw-bold mb-4">Follow Us</h3>
						<div class="social-links">
							<a href="https://www.facebook.com/pg/alphawonders" target="_blank" class="btn btn-outline-primary btn-lg w-100 mb-3 rounded-pill">
								<i class="fab fa-facebook me-2"></i>Facebook
							</a>
							<a href="https://twitter.com/Alphawondersltd" target="_blank" class="btn btn-outline-info btn-lg w-100 mb-3 rounded-pill">
								<i class="fab fa-twitter me-2"></i>Twitter
							</a>
							<a href="https://ke.linkedin.com/company/alphawonders" target="_blank" class="btn btn-outline-primary btn-lg w-100 rounded-pill">
								<i class="fab fa-linkedin me-2"></i>LinkedIn
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Map Section (Optional) -->
<section class="py-5 bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="card border-0 shadow-lg rounded-4 overflow-hidden">
					<div class="card-body p-0">
						<div class="bg-primary text-white p-4 text-center">
							<h4 class="fw-bold mb-0">
								<i class="fas fa-map-marker-alt me-2"></i>Located in Kenya
							</h4>
							<p class="mb-0 mt-2">Serving clients worldwide with remote and on-site services</p>
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
	transform: translateY(-3px);
	box-shadow: 0 12px 30px rgba(0,0,0,0.15) !important;
}

.contact-item {
	transition: all 0.3s ease;
}

.contact-item:hover {
	transform: translateX(5px);
}

.contact-item a:hover {
	color: var(--primary-color) !important;
}

.form-control:focus {
	border-color: var(--primary-color);
	box-shadow: 0 0 0 0.2rem rgba(4, 22, 64, 0.25);
}

@media (max-width: 767.98px) {
	.contact-info-card {
		margin-top: 2rem;
	}
}
</style>
