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
	<header>
		<nav class="navbar navbar-expand-xl navbar-dark bg-dark fixed-top shadow-lg" style="padding: 0.5rem 0;">
			<div class="container-fluid px-3 px-lg-4">
				<!-- Logo and Brand -->
				<a class="navbar-brand d-flex align-items-center me-4" href="<?= base_url('/') ?>" style="min-width: 180px;">
					<img src="<?= base_url('assets/icon/logo.png') ?>" alt="Alphawonders Logo" class="me-2" style="width: 45px; height: 45px; object-fit: contain;">
					<span class="fw-bold fs-5 text-white d-none d-sm-inline">Alphawonders</span>
				</a>
				
				<!-- Contact info for large desktop -->
				<div class="d-none d-xxl-flex align-items-center me-4 text-white" style="white-space: nowrap;">
					<div class="me-4">
						<i class="fas fa-phone me-2"></i>
						<a href="tel:+254736099643" class="text-white text-decoration-none" style="font-size: 0.9rem;">+254 736 099 643</a>
					</div>
					<div>
						<i class="fas fa-envelope me-2"></i>
						<a href="mailto:info@alphawonders.com" class="text-white text-decoration-none" style="font-size: 0.9rem;">info@alphawonders.com</a>
					</div>
				</div>

				<!-- Mobile Toggle Button -->
				<button class="navbar-toggler border-0 ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Navigation Menu -->
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ms-auto align-items-center" style="gap: 0; flex-wrap: nowrap;">
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2" href="<?= base_url('softwares') ?>" style="white-space: nowrap; font-size: 0.95rem;">
								<span class="d-lg-none"><i class="fas fa-code me-2"></i></span>Software Development
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2" href="<?= base_url('system-administration') ?>" style="white-space: nowrap; font-size: 0.95rem;">
								<span class="d-lg-none"><i class="fas fa-server me-2"></i></span>System Administration
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2" href="<?= base_url('digital-marketing') ?>" style="white-space: nowrap; font-size: 0.95rem;">
								<span class="d-lg-none"><i class="fas fa-bullhorn me-2"></i></span>Digital Marketing
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2" href="<?= base_url('design') ?>" style="white-space: nowrap; font-size: 0.95rem;">
								<span class="d-lg-none"><i class="fas fa-palette me-2"></i></span>Design
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2" href="<?= base_url('ict-consultancy') ?>" style="white-space: nowrap; font-size: 0.95rem;">
								<span class="d-lg-none"><i class="fas fa-user-tie me-2"></i></span>IT Consultancy
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2" href="<?= base_url('it-support') ?>" style="white-space: nowrap; font-size: 0.95rem;">
								<span class="d-lg-none"><i class="fas fa-headset me-2"></i></span>IT Support
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2" href="<?= base_url('blog') ?>" style="white-space: nowrap; font-size: 0.95rem;">
								<span class="d-lg-none"><i class="fas fa-blog me-2"></i></span>Blog
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2 px-lg-3 py-2" href="<?= base_url('contact-us') ?>" style="white-space: nowrap; font-size: 0.95rem;">
								<span class="d-lg-none"><i class="fas fa-envelope me-2"></i></span>Contact Us
							</a>
						</li>
						<li class="nav-item ms-lg-3 mt-2 mt-lg-0">
							<a class="btn btn-primary rounded-pill px-3 px-lg-4 py-2" href="<?= base_url('hire') ?>" style="white-space: nowrap; font-size: 0.9rem;">
								<i class="fas fa-briefcase me-2"></i>Hire Us
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<div class="alph-wrapper">

					
			    