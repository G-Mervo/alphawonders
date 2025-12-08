<?php 
// CI4 View File - Header
if (!defined('BASEPATH')) {
    define('BASEPATH', realpath(__DIR__ . '/../../') . DIRECTORY_SEPARATOR);
}
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset = "utf-8" >
	<meta http-equiv = "X-UA-Compatible" content = "IE-Edge">
	<title><?= esc($title ?? 'Alphawonders') ?> - Providing ICT Expertise & Services </title>
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
	
	<!-- Top Info Bar -->
	<div class="top-bar">
		<div class="top-bar-content">
			<div class="welcome-tag">
				<i class="fas fa-sparkles"></i>
				<span>Welcome to Alphawonders Solutions</span>
			</div>
			<div class="top-contacts">
				<a href="tel:+254736099643" class="contact-item">
					<i class="fas fa-phone"></i>
					<span>+254 736 099 643</span>
				</a>
				<a href="mailto:info@alphawonders.com" class="contact-item">
					<i class="fas fa-envelope"></i>
					<span>info@alphawonders.com</span>
				</a>
			</div>
		</div>
	</div>

	<!-- Main Header -->
	<header class="main-header">
		<div class="header-container">
			<!-- Logo -->
			<a href="<?= base_url('/') ?>" class="brand-logo">
				<div class="logo-icon">
					<img src="<?= base_url('assets/icon/logo.png') ?>" alt="Alphawonders Logo" style="width: 100%; height: 100%; object-fit: contain;">
				</div>
				<div class="brand-name">
					<span class="brand-title">Alphawonders</span>
					<span class="brand-tagline">ICT EXPERTISE & SERVICES</span>
				</div>
			</a>

			<!-- Mobile Toggle -->
			<button class="mobile-toggle" type="button" onclick="toggleMobileMenu()">
				<span class="toggle-icon"></span>
			</button>

			<!-- Navigation -->
			<nav>
				<ul class="nav-menu" id="navMenu">
					<li class="nav-item">
						<a href="<?= base_url('softwares') ?>" class="nav-link">
							<i class="fas fa-code"></i>
							<span>Software Development</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('system-administration') ?>" class="nav-link">
							<i class="fas fa-server"></i>
							<span>System Admin</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('digital-marketing') ?>" class="nav-link">
							<i class="fas fa-bullhorn"></i>
							<span>Digital Marketing</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('design') ?>" class="nav-link">
							<i class="fas fa-palette"></i>
							<span>Design</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('ict-consultancy') ?>" class="nav-link">
							<i class="fas fa-user-tie"></i>
							<span>IT Consultancy</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('it-support') ?>" class="nav-link">
							<i class="fas fa-headset"></i>
							<span>IT Support</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('blog') ?>" class="nav-link">
							<i class="fas fa-blog"></i>
							<span>Blog</span>
						</a>
					</li>
				</ul>
			</nav>

			<!-- Action Buttons -->
			<div class="header-actions" id="headerActions">
				<a href="<?= base_url('contact-us') ?>" class="btn-header btn-contact">
					<i class="fas fa-envelope"></i>
					<span>Contact Us</span>
				</a>
				<a href="<?= base_url('hire') ?>" class="btn-header btn-hire">
					<i class="fas fa-briefcase"></i>
					<span>Hire Us</span>
				</a>
			</div>
		</div>
	</header>

	<script>
		function toggleMobileMenu() {
			const navMenu = document.getElementById('navMenu');
			const headerActions = document.getElementById('headerActions');
			if (navMenu && headerActions) {
				navMenu.classList.toggle('active');
				headerActions.classList.toggle('active');
			}
		}

		// Add scroll effect
		window.addEventListener('scroll', function() {
			const header = document.querySelector('.main-header');
			if (header) {
				if (window.scrollY > 50) {
					header.classList.add('scrolled');
				} else {
					header.classList.remove('scrolled');
				}
			}
		});

		// Close mobile menu when clicking outside
		document.addEventListener('click', function(event) {
			const navMenu = document.getElementById('navMenu');
			const headerActions = document.getElementById('headerActions');
			const mobileToggle = document.querySelector('.mobile-toggle');
			
			if (navMenu && headerActions && mobileToggle) {
				if (!navMenu.contains(event.target) && 
					!headerActions.contains(event.target) && 
					!mobileToggle.contains(event.target)) {
					navMenu.classList.remove('active');
					headerActions.classList.remove('active');
				}
			}
		});
	</script>

	<div class="alph-wrapper">

					
			     
