<?php defined('BASEPATH') OR exit('No direct script allowed'); ?>

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
</head>
<body>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=688908964868655&autoLogAppEvents=1"></script>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-lg">
			<div class="container">
				<a class="navbar-brand d-flex align-items-center" href="<?php echo base_url('/'); ?>">
					<img src="<?php echo base_url('assets/icon/logo.png'); ?>" alt="Alphawonders" class="me-2" style="width: 50px; height: 50px;">
					<span class="fw-bold fs-5">Alphawonders</span>
				</a>
				
				<!-- Contact info for desktop -->
				<div class="d-none d-lg-flex align-items-center me-4 text-white">
					<div class="me-4">
						<i class="fas fa-phone me-2"></i>
						<a href="tel:+254736099643" class="text-white text-decoration-none">+254 736 099 643</a>
					</div>
					<div>
						<i class="fas fa-envelope me-2"></i>
						<a href="mailto:info@alphawonders.com" class="text-white text-decoration-none">info@alphawonders.com</a>
					</div>
				</div>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ms-auto align-items-center">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url('/softwares'); ?>">Software Development</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url('/system-administration'); ?>">System Administration</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url('/digital-marketing'); ?>">Digital Marketing</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url('/design'); ?>">Design</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url('/ict-consultancy'); ?>">IT Consultancy</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url('/it-support'); ?>">IT Support</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url('/blog'); ?>">Blog</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url('/contact-us'); ?>">Contact Us</a>
						</li>
						<li class="nav-item ms-2">
							<a class="btn btn-primary rounded-pill px-4" href="<?php echo base_url('/hire'); ?>">
								<i class="fas fa-briefcase me-2"></i>Hire Us
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<div class="alph-wrapper">

					
			    