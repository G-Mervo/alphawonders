<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

	</div>

	<!-- Footer -->
	<footer class="mt-5" style="font-family: 'Inter', sans-serif;">
		<!-- Gold accent bar -->
		<div style="height: 3px; background: linear-gradient(90deg, #ffb000, #ff8c00, #ffb000);"></div>

		<!-- Main footer -->
		<div style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 50%, #041640 100%);">
			<!-- CTA Strip -->
			<div class="py-4" style="background: rgba(255, 176, 0, 0.06); border-bottom: 1px solid rgba(255, 255, 255, 0.06);">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-7 text-white mb-3 mb-lg-0">
							<h4 class="fw-bold mb-1" style="font-family: 'Montserrat', sans-serif;">Ready to bring your project to life?</h4>
							<p class="mb-0 opacity-75 small">Let's discuss how we can help you achieve your technology goals.</p>
						</div>
						<div class="col-lg-5 text-lg-end">
							<a href="<?php echo base_url('/hire'); ?>" class="btn px-4 py-2 fw-semibold rounded-pill me-2" style="background: #ffb000; color: #041640; transition: all 0.3s;" onmouseover="this.style.background='#ffc233';this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 15px rgba(255,176,0,0.3)'" onmouseout="this.style.background='#ffb000';this.style.transform='none';this.style.boxShadow='none'">
								<i class="fas fa-briefcase me-2"></i>Hire Us
							</a>
							<a href="<?php echo base_url('/contact-us'); ?>" class="btn btn-outline-light px-4 py-2 fw-semibold rounded-pill" style="transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='transparent'">
								<i class="fas fa-envelope me-2"></i>Contact Us
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- Footer columns -->
			<div class="container py-5">
				<div class="row g-4 g-lg-5">
					<!-- Brand column -->
					<div class="col-lg-4 col-md-6">
						<div class="d-flex align-items-center mb-3">
							<img src="<?php echo base_url('assets/icon/logo.png'); ?>" alt="Alphawonders" style="width: 42px; height: 42px; filter: drop-shadow(0 2px 6px rgba(0,0,0,0.3));" onerror="this.onerror=null; this.src='<?php echo base_url('assets/icon/awlogo.png'); ?>';">
							<span class="ms-2 fw-bold text-white fs-5" style="font-family: 'Montserrat', sans-serif; letter-spacing: 0.5px;">Alphawonders</span>
						</div>
						<p class="text-white-50 small mb-4" style="line-height: 1.7;">Providing ICT expertise and services to help businesses leverage technology. From software development to system administration, we deliver solutions that drive growth.</p>

						<!-- Social icons -->
						<div class="d-flex gap-2 mb-4">
							<a href="https://facebook.com/alphawonders" target="_blank" rel="noopener" class="d-flex align-items-center justify-content-center rounded-circle text-white text-decoration-none" style="width: 38px; height: 38px; background: rgba(255,255,255,0.08); transition: all 0.3s;" onmouseover="this.style.background='#1877F2';this.style.transform='translateY(-3px)'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.transform='none'" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
							<a href="https://x.com/alphawondersltd" target="_blank" rel="noopener" class="d-flex align-items-center justify-content-center rounded-circle text-white text-decoration-none" style="width: 38px; height: 38px; background: rgba(255,255,255,0.08); transition: all 0.3s;" onmouseover="this.style.background='#000';this.style.transform='translateY(-3px)'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.transform='none'" aria-label="X"><i class="fab fa-x-twitter"></i></a>
							<a href="https://ke.linkedin.com/company/alphawonders" target="_blank" rel="noopener" class="d-flex align-items-center justify-content-center rounded-circle text-white text-decoration-none" style="width: 38px; height: 38px; background: rgba(255,255,255,0.08); transition: all 0.3s;" onmouseover="this.style.background='#0A66C2';this.style.transform='translateY(-3px)'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.transform='none'" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
							<a href="https://instagram.com/alphawonders" target="_blank" rel="noopener" class="d-flex align-items-center justify-content-center rounded-circle text-white text-decoration-none" style="width: 38px; height: 38px; background: rgba(255,255,255,0.08); transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888)';this.style.transform='translateY(-3px)'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.transform='none'" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
							<a href="https://tiktok.com/@alphawonders" target="_blank" rel="noopener" class="d-flex align-items-center justify-content-center rounded-circle text-white text-decoration-none" style="width: 38px; height: 38px; background: rgba(255,255,255,0.08); transition: all 0.3s;" onmouseover="this.style.background='#000';this.style.transform='translateY(-3px)'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.transform='none'" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
						</div>
					</div>

					<!-- Services column -->
					<div class="col-lg-2 col-md-6 col-6">
						<h6 class="text-white fw-bold text-uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 1.5px;">Services</h6>
						<ul class="list-unstyled mb-0">
							<li class="mb-2"><a href="<?php echo base_url('/softwares'); ?>" class="text-white-50 text-decoration-none small footer-link">Software Development</a></li>
							<li class="mb-2"><a href="<?php echo base_url('/system-administration'); ?>" class="text-white-50 text-decoration-none small footer-link">System Administration</a></li>
							<li class="mb-2"><a href="<?php echo base_url('/seo'); ?>" class="text-white-50 text-decoration-none small footer-link">SEO</a></li>
							<li class="mb-2"><a href="<?php echo base_url('/design'); ?>" class="text-white-50 text-decoration-none small footer-link">Design</a></li>
							<li class="mb-2"><a href="<?php echo base_url('/ict-consultancy'); ?>" class="text-white-50 text-decoration-none small footer-link">IT Consultancy</a></li>
							<li class="mb-2"><a href="<?php echo base_url('/it-support'); ?>" class="text-white-50 text-decoration-none small footer-link">IT Support</a></li>
							<li class="mb-2"><a href="<?php echo base_url('/ai-services'); ?>" class="text-white-50 text-decoration-none small footer-link">AI Services</a></li>
						</ul>
					</div>

					<!-- Quick Links column -->
					<div class="col-lg-2 col-md-6 col-6">
						<h6 class="text-white fw-bold text-uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 1.5px;">Company</h6>
						<ul class="list-unstyled mb-0">
							<li class="mb-2"><a href="<?php echo base_url('/'); ?>" class="text-white-50 text-decoration-none small footer-link">Home</a></li>
							<li class="mb-2"><a href="<?php echo base_url('/blog'); ?>" class="text-white-50 text-decoration-none small footer-link">Blog</a></li>
							<li class="mb-2"><a href="<?php echo base_url('/hire'); ?>" class="text-white-50 text-decoration-none small footer-link">Hire Us</a></li>
							<li class="mb-2"><a href="<?php echo base_url('/contact-us'); ?>" class="text-white-50 text-decoration-none small footer-link">Contact Us</a></li>
						</ul>

						<h6 class="text-white fw-bold text-uppercase mt-4 mb-3" style="font-size: 0.75rem; letter-spacing: 1.5px;">Expertise</h6>
						<div class="d-flex flex-wrap gap-1">
							<span class="badge rounded-pill small" style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-weight: 400;">PHP</span>
							<span class="badge rounded-pill small" style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-weight: 400;">Python</span>
							<span class="badge rounded-pill small" style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-weight: 400;">JavaScript</span>
							<span class="badge rounded-pill small" style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-weight: 400;">Linux</span>
							<span class="badge rounded-pill small" style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-weight: 400;">SEO</span>
							<span class="badge rounded-pill small" style="background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); font-weight: 400;">AI</span>
						</div>
					</div>

					<!-- Contact + Newsletter column -->
					<div class="col-lg-4 col-md-6">
						<h6 class="text-white fw-bold text-uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 1.5px;">Get In Touch</h6>
						<div class="mb-4">
							<a href="tel:+254736099643" class="d-flex align-items-center text-decoration-none mb-2 footer-link">
								<span class="d-flex align-items-center justify-content-center rounded me-3 flex-shrink-0" style="width: 34px; height: 34px; background: rgba(255, 176, 0, 0.12);">
									<i class="fas fa-phone small" style="color: #ffb000;"></i>
								</span>
								<span class="text-white-50 small">+254 736 099 643</span>
							</a>
							<a href="mailto:info@alphawonders.com" class="d-flex align-items-center text-decoration-none mb-2 footer-link">
								<span class="d-flex align-items-center justify-content-center rounded me-3 flex-shrink-0" style="width: 34px; height: 34px; background: rgba(255, 176, 0, 0.12);">
									<i class="fas fa-envelope small" style="color: #ffb000;"></i>
								</span>
								<span class="text-white-50 small">info@alphawonders.com</span>
							</a>
							<div class="d-flex align-items-center">
								<span class="d-flex align-items-center justify-content-center rounded me-3 flex-shrink-0" style="width: 34px; height: 34px; background: rgba(255, 176, 0, 0.12);">
									<i class="fas fa-map-marker-alt small" style="color: #ffb000;"></i>
								</span>
								<span class="text-white-50 small">Nairobi, Kenya</span>
							</div>
						</div>

						<!-- Newsletter -->
						<div class="rounded-3 p-3" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);">
							<h6 class="text-white fw-semibold mb-1" style="font-size: 0.85rem;">Stay Updated</h6>
							<p class="text-white-50 mb-2" style="font-size: 0.75rem;">Get the latest tech insights delivered to your inbox.</p>
							<form method="post" action="<?php echo base_url('/subscribe'); ?>" id="newsletterForm">
								<div class="input-group">
									<label for="email_sub" class="visually-hidden">Email address</label>
									<input type="email" class="form-control form-control-sm border-0" name="email_sub" id="sub" placeholder="Your email address" required style="background: rgba(255,255,255,0.08); color: #fff; font-size: 0.8rem;">
									<button type="submit" class="btn btn-sm px-3 fw-semibold" id="subscr" style="background: #ffb000; color: #041640; transition: all 0.3s;" onmouseover="this.style.background='#ffc233'" onmouseout="this.style.background='#ffb000'">
										<i class="fas fa-paper-plane"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Bottom bar -->
			<div style="border-top: 1px solid rgba(255,255,255,0.08);">
				<div class="container py-3">
					<div class="row align-items-center">
						<div class="col-md-6 text-center text-md-start">
							<p class="mb-0 text-white-50" style="font-size: 0.75rem;">&copy; <?php echo "2017 - ".date('Y'); ?> Alphawonders Solutions. All rights reserved.</p>
						</div>
						<div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
							<a href="<?php echo base_url('/blog'); ?>" class="text-white-50 text-decoration-none me-3 footer-link" style="font-size: 0.75rem;">Blog</a>
							<a href="<?php echo base_url('/hire'); ?>" class="text-white-50 text-decoration-none me-3 footer-link" style="font-size: 0.75rem;">Hire Us</a>
							<a href="<?php echo base_url('/privacy-policy'); ?>" class="text-white-50 text-decoration-none me-3 footer-link" style="font-size: 0.75rem;">Privacy Policy</a>
							<a href="<?php echo base_url('/terms-of-service'); ?>" class="text-white-50 text-decoration-none me-3 footer-link" style="font-size: 0.75rem;">Terms of Service</a>
							<a href="<?php echo base_url('/contact-us'); ?>" class="text-white-50 text-decoration-none footer-link" style="font-size: 0.75rem;">Contact</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- Back to top button -->
	<a href="#" id="backToTop" class="d-none align-items-center justify-content-center text-decoration-none rounded-circle shadow-lg" style="position: fixed; bottom: 24px; right: 24px; width: 44px; height: 44px; background: linear-gradient(135deg, #041640, #0a2a5a); color: #ffb000; z-index: 1020; transition: all 0.3s; border: 1px solid rgba(255,176,0,0.3);" aria-label="Back to top">
		<i class="fas fa-chevron-up"></i>
	</a>

	<style>
		.footer-link { transition: color 0.25s ease; }
		.footer-link:hover, .footer-link:hover span { color: #ffb000 !important; }
		#sub::placeholder { color: rgba(255,255,255,0.35); }
		#sub:focus { background: rgba(255,255,255,0.12) !important; box-shadow: none; }
		#backToTop:hover { transform: translateY(-3px); background: #ffb000 !important; color: #041640 !important; }
	</style>

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
		// Back to top button
		(function() {
			var btn = document.getElementById('backToTop');
			if (btn) {
				window.addEventListener('scroll', function() {
					if (window.scrollY > 400) {
						btn.classList.remove('d-none');
						btn.classList.add('d-flex');
					} else {
						btn.classList.remove('d-flex');
						btn.classList.add('d-none');
					}
				});
				btn.addEventListener('click', function(e) {
					e.preventDefault();
					window.scrollTo({ top: 0, behavior: 'smooth' });
				});
			}
		})();
	</script>
	<script>
		$(document).ready(function(){
			// Footer newsletter form
			$("#newsletterForm").on('submit', function(e){
				e.preventDefault();
				var form = $(this);
				var email = $("#sub").val();
				submitNewsletter(email, form);
			});
			// Homepage blog sidebar newsletter form
			$("#homepageNewsletterForm").on('submit', function(e){
				e.preventDefault();
				var form = $(this);
				var email = form.find("input[name='email_sub']").val();
				submitNewsletter(email, form);
			});
			function submitNewsletter(email, form) {
				$.post("<?php echo base_url("/subscribe"); ?>", { email_sub: email })
					.done(function() { alert("Thank you for subscribing!"); if (form && form[0]) form[0].reset(); })
					.fail(function() { alert("Unable to subscribe. Please try again later."); });
			}
		});
	</script>

	<!-- JSON-LD Structured Data: Organization -->
	<script type="application/ld+json">
	{
	  "@context": "https://schema.org",
	  "@type": "LocalBusiness",
	  "name": "Alphawonders Solutions",
	  "alternateName": "Alphawonders",
	  "image": "https://alphawonders.com/assets/icon/logo.png",
	  "logo": "https://alphawonders.com/assets/icon/logo.png",
	  "telephone": "+254736099643",
	  "email": "info@alphawonders.com",
	  "url": "https://alphawonders.com",
	  "description": "Nairobi-based ICT company providing software development, system administration, SEO, design, AI solutions, IT consultancy, and IT support for businesses across Kenya and East Africa.",
	  "address": {
	    "@type": "PostalAddress",
	    "addressLocality": "Nairobi",
	    "addressCountry": "KE"
	  },
	  "geo": {
	    "@type": "GeoCoordinates",
	    "latitude": "-1.2921",
	    "longitude": "36.8219"
	  },
	  "openingHoursSpecification": [
	    {
	      "@type": "OpeningHoursSpecification",
	      "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
	      "opens": "09:00",
	      "closes": "18:00"
	    },
	    {
	      "@type": "OpeningHoursSpecification",
	      "dayOfWeek": "Saturday",
	      "opens": "10:00",
	      "closes": "14:00"
	    }
	  ],
	  "sameAs": [
	    "https://facebook.com/alphawonders",
	    "https://x.com/alphawondersltd",
	    "https://ke.linkedin.com/company/alphawonders",
	    "https://instagram.com/alphawonders",
	    "https://tiktok.com/@alphawonders"
	  ],
	  "priceRange": "$$",
	  "areaServed": {
	    "@type": "GeoCircle",
	    "geoMidpoint": {
	      "@type": "GeoCoordinates",
	      "latitude": "-1.2921",
	      "longitude": "36.8219"
	    },
	    "geoRadius": "2000 km"
	  },
	  "hasOfferCatalog": {
	    "@type": "OfferCatalog",
	    "name": "ICT Services",
	    "itemListElement": [
	      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Software Development", "url": "https://alphawonders.com/softwares"}},
	      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "System Administration", "url": "https://alphawonders.com/system-administration"}},
	      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "SEO", "url": "https://alphawonders.com/seo"}},
	      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Web & Graphic Design", "url": "https://alphawonders.com/design"}},
	      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "IT Consultancy", "url": "https://alphawonders.com/ict-consultancy"}},
	      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "IT Support", "url": "https://alphawonders.com/it-support"}},
	      {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "AI & Machine Learning", "url": "https://alphawonders.com/ai-services"}}
	    ]
	  }
	}
	</script>

</body>
</html>