<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

	</div>
	
	<footer class="bg-dark text-light py-5 mt-5">
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-3 col-md-6">
					<h5 class="fw-bold mb-4">Quick Links</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="<?php echo base_url('/softwares'); ?>" class="text-light text-decoration-none"><i class="fas fa-chevron-right me-2 small"></i>Software Development</a></li>
						<li class="mb-2"><a href="<?php echo base_url('/system-administration'); ?>" class="text-light text-decoration-none"><i class="fas fa-chevron-right me-2 small"></i>System Administration</a></li>
						<li class="mb-2"><a href="<?php echo base_url('/digital-marketing'); ?>" class="text-light text-decoration-none"><i class="fas fa-chevron-right me-2 small"></i>Digital Marketing</a></li>
						<li class="mb-2"><a href="<?php echo base_url('/design'); ?>" class="text-light text-decoration-none"><i class="fas fa-chevron-right me-2 small"></i>Design</a></li>
						<li class="mb-2"><a href="<?php echo base_url('/ict-consultancy'); ?>" class="text-light text-decoration-none"><i class="fas fa-chevron-right me-2 small"></i>IT Consultancy</a></li>
						<li class="mb-2"><a href="<?php echo base_url('/it-support'); ?>" class="text-light text-decoration-none"><i class="fas fa-chevron-right me-2 small"></i>IT Support</a></li>
						<li class="mb-2"><a href="<?php echo base_url('contact-us'); ?>" class="text-light text-decoration-none"><i class="fas fa-chevron-right me-2 small"></i>Contact Us</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-6">
					<h5 class="fw-bold mb-4">Our Expertise</h5>
					<div class="row">
						<div class="col-6">
							<ul class="list-unstyled small">
								<li class="mb-2">PHP</li>
								<li class="mb-2">HTML & CSS</li>
								<li class="mb-2">JavaScript</li>
								<li class="mb-2">CodeIgniter</li>
								<li class="mb-2">Laravel</li>
								<li class="mb-2">WordPress</li>
								<li class="mb-2">E-commerce</li>
							</ul>
						</div>
						<div class="col-6">
							<ul class="list-unstyled small">
								<li class="mb-2">SEO Optimization</li>
								<li class="mb-2">Social Media</li>
								<li class="mb-2">Linux/Unix Admin</li>
								<li class="mb-2">Python</li>
								<li class="mb-2">Web Design</li>
								<li class="mb-2">Graphic Design</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<h5 class="fw-bold mb-4">Connect With Us</h5>
					<div class="d-flex gap-3 mb-4">
						<a href="https://facebook.com/alphawonders" target="_blank" class="text-light fs-4"><i class="fab fa-facebook"></i></a>
						<a href="https://twitter.com/alphawondersltd" target="_blank" class="text-light fs-4"><i class="fab fa-twitter"></i></a>
						<a href="https://ke.linkedin.com/company/alphawonders" target="_blank" class="text-light fs-4"><i class="fab fa-linkedin"></i></a>
					</div>
					<div class="mb-3">
						<p class="mb-2"><i class="fas fa-phone me-2"></i><a href="tel:+254736099643" class="text-light text-decoration-none">+254 736 099 643</a></p>
						<p class="mb-0"><i class="fas fa-envelope me-2"></i><a href="mailto:info@alphawonders.com" class="text-light text-decoration-none">info@alphawonders.com</a></p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<h5 class="fw-bold mb-4">Newsletter</h5>
					<p class="small mb-3">Subscribe to get updates on our latest services and tech insights.</p>
					<form method="post" action="<?php echo base_url('/subscribe'); ?>" id="newsletterForm">
						<div class="mb-3">
							<label for="email_sub" class="visually-hidden">Email address</label>
							<input type="email" class="form-control form-control-sm" name="email_sub" id="sub" placeholder="Enter your email" required>
						</div>
						<button type="submit" class="btn btn-primary btn-sm w-100" id="subscr">
							<i class="fas fa-paper-plane me-2"></i>Subscribe
						</button>
					</form>
				</div>
			</div>
			<hr class="my-4 bg-secondary">
			<div class="row">
				<div class="col-md-6">
					<p class="mb-0 small">&copy; <?php echo "2017 - ".date('Y'); ?> Alphawonders. All rights reserved.</p>
				</div>
				<div class="col-md-6 text-md-end">
					<p class="mb-0 small">
						<a href="<?php echo base_url('/blog'); ?>" class="text-light text-decoration-none me-3">Blog</a>
						<a href="<?php echo base_url('contact-us'); ?>" class="text-light text-decoration-none">Contact</a>
					</p>
				</div>
			</div>
		</div>
	</footer>

	<!-- jQuery (load before Bootstrap) -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<!-- Bootstrap 5.3 JS Bundle -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<!-- Custom Scripts -->
	<script src="<?php echo base_url("assets/js/custom.js") ?>"></script>
	<script src="<?php echo base_url("assets/js/owl.carousel.min.js") ?>"></script>
	<script src="<?php echo base_url("assets/js/main.js") ?>"></script>
	<script src="<?php echo base_url("assets/js/wow.min.js") ?>"></script>
	<script>
		if (typeof WOW !== 'undefined') {
			new WOW().init();
		}
	</script>
	<script>
		$(document).ready(function(){
			$("#newsletterForm").on('submit', function(e){
				e.preventDefault();
				var form = $(this);
				var email = $("#sub").val();
				
				$.post("<?php echo base_url("/subscribe"); ?>",
				{
					email_sub: email
				},
				function(data, status){
					if(status === "success") {
						alert("Thank you for subscribing!");
						form[0].reset();
					} else {
						alert("Something went wrong. Please try again.");
					}
				}).fail(function(){
					alert("Unable to subscribe. Please try again later.");
				});
			});
		});
	</script>

	<!-- JSON-LD Structured Data -->
	<script type="application/ld+json">
	{
	  "@context" : "https://schema.org",
	  "@type" : "LocalBusiness",
	  "name" : "Alphawonders Solutions",
	  "image" : "https://alphawonders.com/assets/icon/logo.png",
	  "telephone" : "+254 736 099 643",
	  "email" : "info@alphawonders.com",
	  "address" : {
	    "@type" : "PostalAddress",
	    "addressCountry" : "KE"
	  },
	  "url" : "https://alphawonders.com",
	  "description" : "Alphawonders Solutions provides ICT expertise and services such as software development, system administration, design, marketing, IT consultancy, and IT support."
	}
	</script>

</body>
</html>