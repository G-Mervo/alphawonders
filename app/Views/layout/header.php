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
		/* Responsive navbar fixes */
		@media (max-width: 991.98px) {
			.navbar-collapse {
				background: rgba(4, 22, 64, 0.98);
				margin-top: 1rem;
				padding: 1rem;
				border-radius: 0.5rem;
			}
			.navbar-nav .nav-link {
				padding: 0.75rem 1rem !important;
				margin: 0.25rem 0;
			}
		}
		/* Ensure navbar stays on top */
		.navbar {
			z-index: 1030 !important;
		}
		/* Fix icon alignment */
		.nav-link i, .btn i {
			vertical-align: middle;
		}
	</style>
</head>
<body>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=688908964868655&autoLogAppEvents=1"></script>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-lg" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%); backdrop-filter: blur(10px); z-index: 1030;">
			<div class="container-fluid px-3 px-md-4">
				<a class="navbar-brand d-flex align-items-center" href="<?php echo base_url('/'); ?>" style="transition: transform 0.3s;">
					<img src="<?php echo base_url('assets/icon/logo.png'); ?>" alt="Alphawonders" class="me-2" style="width: 45px; height: 45px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));" onerror="this.style.display='none'">
					<span class="fw-bold fs-5 text-white d-none d-sm-inline" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">Alphawonders</span>
				</a>
				
				<!-- Contact info for desktop -->
				<div class="d-none d-xl-flex align-items-center me-3">
					<div class="me-3">
						<a href="tel:+254736099643" class="text-white text-decoration-none d-flex align-items-center" style="font-size: 0.9rem; transition: color 0.3s;">
							<i class="fas fa-phone me-2 text-warning" aria-hidden="true"></i>
							<span class="d-none d-xxl-inline">+254 736 099 643</span>
						</a>
					</div>
					<div>
						<a href="mailto:info@alphawonders.com" class="text-white text-decoration-none d-flex align-items-center" style="font-size: 0.9rem; transition: color 0.3s;">
							<i class="fas fa-envelope me-2 text-warning" aria-hidden="true"></i>
							<span class="d-none d-xxl-inline">info@alphawonders.com</span>
						</a>
					</div>
				</div>

				<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="outline: none; box-shadow: none; padding: 0.5rem;">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ms-auto align-items-lg-center">
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2 mx-1 rounded text-white" href="<?php echo base_url('/softwares'); ?>" style="transition: all 0.3s; font-weight: 500;">
								<i class="fas fa-code d-lg-none me-2" aria-hidden="true"></i>Software Development
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2 mx-1 rounded text-white" href="<?php echo base_url('/system-administration'); ?>" style="transition: all 0.3s; font-weight: 500;">
								<i class="fas fa-server d-lg-none me-2" aria-hidden="true"></i>System Administration
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2 mx-1 rounded text-white" href="<?php echo base_url('/digital-marketing'); ?>" style="transition: all 0.3s; font-weight: 500;">
								<i class="fas fa-bullhorn d-lg-none me-2" aria-hidden="true"></i>Digital Marketing
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2 mx-1 rounded text-white" href="<?php echo base_url('/design'); ?>" style="transition: all 0.3s; font-weight: 500;">
								<i class="fas fa-palette d-lg-none me-2" aria-hidden="true"></i>Design
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2 mx-1 rounded text-white" href="<?php echo base_url('/ict-consultancy'); ?>" style="transition: all 0.3s; font-weight: 500;">
								<i class="fas fa-lightbulb d-lg-none me-2" aria-hidden="true"></i>IT Consultancy
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2 mx-1 rounded text-white" href="<?php echo base_url('/it-support'); ?>" style="transition: all 0.3s; font-weight: 500;">
								<i class="fas fa-headset d-lg-none me-2" aria-hidden="true"></i>IT Support
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2 mx-1 rounded text-white" href="<?php echo base_url('/blog'); ?>" style="transition: all 0.3s; font-weight: 500;">
								<i class="fas fa-blog d-lg-none me-2" aria-hidden="true"></i>Blog
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2 mx-1 rounded text-white" href="<?php echo base_url('/contact-us'); ?>" style="transition: all 0.3s; font-weight: 500;">
								<i class="fas fa-envelope d-lg-none me-2" aria-hidden="true"></i>Contact Us
							</a>
						</li>
						<li class="nav-item ms-lg-2 mt-2 mt-lg-0">
							<a class="btn btn-warning btn-sm btn-lg rounded-pill px-3 px-lg-4 fw-bold shadow-sm text-dark" href="<?php echo base_url('/hire'); ?>" style="transition: all 0.3s; background: linear-gradient(135deg, #ffb000 0%, #ffc733 100%); border: none; white-space: nowrap;">
								<i class="fas fa-briefcase me-2" aria-hidden="true"></i><span class="d-none d-sm-inline">Hire Us</span><span class="d-sm-none">Hire</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<div class="alph-wrapper">

					
			    