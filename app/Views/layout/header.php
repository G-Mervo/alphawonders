<?php defined('FCPATH') OR exit('No direct script allowed'); ?>

<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset = "utf-8" >
	<meta http-equiv = "X-UA-Compatible" content = "IE-Edge">
	<title><?= $title ?> - Providing ICT Expertise & Services </title>
	<meta name = "description" content = "Alphawonders Solutions provides ICT expertise and services such as software development, system administration, design(web & graphic), marketing, IT consultancy, IT support, cyber security to help businesses and individuals in different industries and sectors to leverage ICT in their day-to-day activities.">
	<meta name = "keywords" content= "software development, system administration, digital marketing, IT consultancy, IT support, alphawonders, alpha, wonders, technology, web design, website development, web applications, mobile applications, data analytics, cyber security">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<meta name = "robots" content = "Index, Follow">
	<meta name = "author" content = "alphawonders">
	<meta http-equiv="refresh" content="1800">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- disable local google analytics and track now real online traffic -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135474915-2"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-135474915-2');
	</script> -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-TCBNWBQX9K"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-TCBNWBQX9K');
	</script>
	
	<!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://alphawonders.com/">
    <meta property="og:title" content="Alphawonders Solutions - Providing ICT Expertise & Services">
    <meta property="og:description" content="Alphawonders Solutions provides ICT expertise and services such as software development, system administration, design(web & graphic), marketing, IT consultancy, IT support, cyber security to help businesses and individuals in different industries and sectors to leverage ICT in their day-to-day activities.">
    <meta property="og:image" content="https://alphawonders.com/assets/icons/logo.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://alphawonders.com/">
    <meta property="twitter:title" content="Alphawonders Solutions - Providing ICT Expertise & Services">
    <meta property="twitter:description" content="Alphawonders Solutions provides ICT expertise and services such as software development, system administration, design(web & graphic), marketing, IT consultancy, IT support, cyber security to help businesses and individuals in different industries and sectors to leverage ICT in their day-to-day activities.">
    <meta property="twitter:image" content="https://alphawonders.com/assets/icons/logo.png">

	<!-- Stylesheets -->
	<link rel="icon" type="image/png" href="<?php echo base_url('/assets/icon/awlogo.png'); ?>">
	<!-- Bootstrap 5.3 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<!-- Font Awesome 6 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Fallback Font Awesome if CDN fails -->
	<noscript><link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.1/css/all.css"></noscript>
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- Custom Stylesheets -->
	<link rel = "stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
	<link rel = "stylesheet" href="<?php echo base_url('assets/css/responsive.css'); ?>">
	<link href="<?php echo base_url('assets/css/blog.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/animate.min.css'); ?>">
	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/owl.theme.css'); ?>"/> 
    <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.css'); ?>"/> 
	<!-- Header Fixes -->
	<style>
		/* Ensure Font Awesome icons display */
		.fas, .far, .fab, .fa {
			font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands", "Font Awesome 6 Pro" !important;
			font-weight: 900;
			display: inline-block;
			font-style: normal;
			font-variant: normal;
			text-rendering: auto;
			line-height: 1;
		}
		.fab {
			font-family: "Font Awesome 6 Brands" !important;
			font-weight: 400;
		}
		
		/* Modern Navbar Styles */
		.navbar {
			z-index: 1030 !important;
			transition: all 0.3s ease;
		}
		
		.nav-link {
			position: relative;
			white-space: nowrap;
		}
		
		.nav-link:hover {
			color: #ffb000 !important;
			transform: translateY(-2px);
		}
		
		.nav-link i, .btn i {
			vertical-align: middle;
		}
		
		/* Desktop styles */
		@media (min-width: 992px) {
			.navbar-nav {
				gap: 0.15rem;
			}
			.nav-link {
				padding: 0.5rem 0.6rem !important;
				border-radius: 0.375rem;
			}
			.nav-link:hover {
				background: rgba(255, 176, 0, 0.1);
			}
		}

		/* Medium-large screens - tighter nav spacing */
		@media (min-width: 992px) and (max-width: 1199.98px) {
			.navbar-nav {
				gap: 0;
			}
			.navbar-nav .nav-link {
				padding: 0.4rem 0.4rem !important;
				font-size: 0.85rem !important;
			}
			.navbar-nav .btn {
				font-size: 0.8rem !important;
				padding: 0.4rem 0.75rem !important;
			}
		}

		/* Hire CTA button */
		.nav-item-hire {
			flex-shrink: 0 !important;
		}
		.btn-hire-cta {
			color: #fff;
			background: transparent;
			border: 1.5px solid rgba(255, 255, 255, 0.6);
			font-size: 0.88rem;
			letter-spacing: 0.3px;
			white-space: nowrap;
			transition: all 0.25s ease;
		}
		.btn-hire-cta:hover,
		.btn-hire-cta:focus {
			color: #041640;
			background: #fff;
			border-color: #fff;
			box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
			transform: translateY(-1px);
		}
		
		/* Tablet and Mobile styles */
		@media (max-width: 991.98px) {
			.navbar-collapse {
				background: rgba(4, 22, 64, 0.98);
				margin-top: 0.5rem;
				padding: 1rem 0.5rem;
				border-radius: 0.5rem;
				max-height: calc(100vh - 80px);
				overflow-y: auto;
			}
			.navbar-nav {
				width: 100%;
			}
			.navbar-nav .nav-item {
				width: 100%;
			}
			.navbar-nav .nav-link {
				padding: 0.75rem 1rem !important;
				margin: 0.125rem 0;
				border-radius: 0.375rem;
				width: 100%;
				display: flex;
				align-items: center;
			}
			.navbar-nav .nav-link:hover {
				background: rgba(255, 176, 0, 0.15);
			}
			.navbar-brand span {
				font-size: 1rem !important;
			}
		}
		
		/* Small mobile screens */
		@media (max-width: 575.98px) {
			.navbar {
				min-height: 65px;
			}
			.navbar-brand img {
				width: 35px !important;
				height: 35px !important;
			}
			.navbar-nav .nav-link {
				font-size: 0.9rem !important;
				padding: 0.65rem 0.75rem !important;
			}
			.btn {
				font-size: 0.85rem !important;
				padding: 0.5rem 1rem !important;
			}
		}
		
		/* Prevent text wrapping */
		.navbar-nav {
			flex-wrap: nowrap;
		}
		
		@media (max-width: 991.98px) {
			.navbar-nav {
				flex-wrap: wrap;
			}
		}
		
		/* Smooth transitions */
		.nav-link, .btn, .navbar-brand {
			transition: all 0.3s ease;
		}
	</style>
</head>
<body>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=688908964868655&autoLogAppEvents=1"></script>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-lg" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%); backdrop-filter: blur(10px); z-index: 1030; min-height: 70px;">
			<div class="container-fluid px-2 px-md-3 px-lg-4">
				<!-- Logo -->
				<a class="navbar-brand d-flex align-items-center" href="<?php echo base_url('/'); ?>" style="transition: transform 0.3s;">
					<img src="<?php echo base_url('assets/icon/logo.png'); ?>" alt="Alphawonders" class="me-2" style="width: 40px; height: 40px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));" onerror="this.onerror=null; this.src='<?php echo base_url('assets/icon/awlogo.png'); ?>';">
					<span class="fw-bold text-white d-none d-md-inline" style="font-size: 1.1rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3); letter-spacing: 0.5px;">Alphawonders</span>
				</a>
				
				<!-- Contact info for desktop - compact -->
				<div class="d-none d-lg-flex align-items-center me-3">
					<a href="tel:+254736099643" class="text-white text-decoration-none me-3" style="font-size: 0.85rem; transition: color 0.3s;" title="Call us">
						<i class="fas fa-phone text-warning" aria-hidden="true"></i>
					</a>
					<a href="mailto:info@alphawonders.com" class="text-white text-decoration-none" style="font-size: 0.85rem; transition: color 0.3s;" title="Email us">
						<i class="fas fa-envelope text-warning" aria-hidden="true"></i>
					</a>
				</div>

				<!-- Mobile menu toggle -->
				<button class="navbar-toggler border-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="outline: none; box-shadow: none;">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Navigation menu -->
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ms-auto align-items-center flex-wrap">
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-2 py-2 text-white text-nowrap" href="<?php echo base_url('/softwares'); ?>" style="transition: all 0.3s; font-weight: 500; font-size: 0.95rem;">
								<i class="fas fa-code d-lg-none me-2" aria-hidden="true"></i>Software
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-2 py-2 text-white text-nowrap" href="<?php echo base_url('/system-administration'); ?>" style="transition: all 0.3s; font-weight: 500; font-size: 0.95rem;">
								<i class="fas fa-server d-lg-none me-2" aria-hidden="true"></i>Systems
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-2 py-2 text-white text-nowrap" href="<?php echo base_url('/digital-marketing'); ?>" style="transition: all 0.3s; font-weight: 500; font-size: 0.95rem;">
								<i class="fas fa-bullhorn d-lg-none me-2" aria-hidden="true"></i>Marketing
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-2 py-2 text-white text-nowrap" href="<?php echo base_url('/design'); ?>" style="transition: all 0.3s; font-weight: 500; font-size: 0.95rem;">
								<i class="fas fa-palette d-lg-none me-2" aria-hidden="true"></i>Design
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-2 py-2 text-white text-nowrap" href="<?php echo base_url('/ict-consultancy'); ?>" style="transition: all 0.3s; font-weight: 500; font-size: 0.95rem;">
								<i class="fas fa-lightbulb d-lg-none me-2" aria-hidden="true"></i>Consultancy
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-2 py-2 text-white text-nowrap" href="<?php echo base_url('/it-support'); ?>" style="transition: all 0.3s; font-weight: 500; font-size: 0.95rem;">
								<i class="fas fa-headset d-lg-none me-2" aria-hidden="true"></i>Support
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-2 py-2 text-white text-nowrap" href="<?php echo base_url('/blog'); ?>" style="transition: all 0.3s; font-weight: 500; font-size: 0.95rem;">
								<i class="fas fa-blog d-lg-none me-2" aria-hidden="true"></i>Blog
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-2 py-2 text-white text-nowrap" href="<?php echo base_url('/contact-us'); ?>" style="transition: all 0.3s; font-weight: 500; font-size: 0.95rem;">
								<i class="fas fa-envelope d-lg-none me-2" aria-hidden="true"></i>Contact
							</a>
						</li>
						<!-- Contact info for mobile - in menu -->
						<li class="nav-item d-lg-none w-100 mt-2 pt-2 border-top border-secondary">
							<div class="px-3">
								<a href="tel:+254736099643" class="text-white text-decoration-none d-flex align-items-center mb-2" style="font-size: 0.9rem;">
									<i class="fas fa-phone me-2 text-warning" aria-hidden="true"></i>
									<span>+254 736 099 643</span>
								</a>
								<a href="mailto:info@alphawonders.com" class="text-white text-decoration-none d-flex align-items-center" style="font-size: 0.9rem;">
									<i class="fas fa-envelope me-2 text-warning" aria-hidden="true"></i>
									<span>info@alphawonders.com</span>
								</a>
							</div>
						</li>
						<!-- CTA Button -->
						<li class="nav-item nav-item-hire ms-lg-2 mt-2 mt-lg-0">
							<a class="btn btn-hire-cta rounded-pill px-4 px-lg-3 fw-semibold" href="<?php echo base_url('/hire'); ?>">
								<i class="fas fa-briefcase me-1" aria-hidden="true"></i>Hire Us
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<div class="alph-wrapper">

					
			    
			    