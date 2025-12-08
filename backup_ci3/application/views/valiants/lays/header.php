<?php defined('BASEPATH') OR exit('No direct script allowed'); ?>

<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset = "utf-8" >
	<meta http-equiv = "X-UA-Compatible" content = "IE-Edge">
	<title><?= $title ?> - Chama System </title>
	<meta name = "description" content = "">
	<meta name = "keywords" content= "">
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
	<meta name = "robots" content = "Index, Follow">
	<meta name = "author" content = "alphawonders">
	<meta http-equiv="refresh" content="3600">
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

	<!-- Stylesheets -->
	<link rel="icon" type="image/png" href="<?php echo base_url('/assets/icon/awlogo.png'); ?>">
	<link rel = "stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/fontawesome-5.1.0/css/all.css'); ?>">
	<link rel = "stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
	<link rel = "stylesheet" href="<?php echo base_url('assets/css/responsive.css'); ?>">
	<link href="<?php echo base_url('assets/css/blog.css'); ?>" rel="stylesheet">
	<link rel = "stylesheet" href="<?php echo base_url('assets/valiants/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/animate.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/owl.theme.css'); ?>"/> 
    <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.css'); ?>"/> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dataTables/datatables.min.css'); ?>"/>

    <!-- Scripts -->
	<script src = "<?php echo base_url("assets/js/jquery-3.2.1.min.js") ?>"></script>	
	<script src= "<?php echo base_url("assets/js/bootstrap.min.js"); ?>" ></script>
	<script src="<?php echo base_url("assets/js/owl.carousel.min.js") ?>"></script>
	<script src="<?php echo base_url("vendor/twitter-api/tweetie.js") ?>"></script>
	<script src="<?php echo base_url("assets/js/main.js") ?>"></script>
	<script src="<?php echo base_url("assets/js/jquery.cookie-1.4.1.min.js") ?>"></script>
	<script src="<?php echo base_url("dataTables/datatables.min.js") ?>"></script>
	
</head>
<body>
	<header>
		<nav class="navbar navbar-default navbar-fixed-top"> <!-- tap-nav -->
			<div class="container-fluid">

				<div class="navbar-header">						
			        <a class="navbar-brand" href="<?php echo base_url('/'); ?>">
			         	<img src="<?php echo base_url('assets/Valiant/icon/logo.png'); ?>" alt="VVC">
			         	<div class="lg-id" id="al-lg">
			         		<p>Valiant Venture Club</p>
			         	</div>
			        </a>
					<!-- Brand and toggle get grouped for better mobile display -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
					    <span class="sr-only">Toggle navigation</span>
					    <span class="icon-bar"></span>
					    <span class="icon-bar"></span>
					    <span class="icon-bar"></span>
					</button>
				</div>
				<div class="alp-qck-co collapse navbar-collapse">
					<p class="">
						<span class="qck-co-1">
							
						</span>
						<span class="qck-co-2">
							<span class="tel"> <a class="alp-tel" href="#"> </a></span> 
							<span class="" id="cont-email"> <a href="">  </a></span>
						</span>
						
					</p>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
	        	<div class="collapse navbar-collapse" id="navbar-collapse-2">
					<ul class="nav navbar-nav navbar-right">
					    <li><a href="<?php echo base_url('/vvc'); ?>">Home</a></li>
					    <li><a href="<?php echo base_url('/vvc/register'); ?>">Register</a></li>
					    <li><a href="<?php echo base_url('/vvc/voting'); ?>">Voting</a></li>
					    <li><a href="<?php echo base_url('/vvc/progress'); ?>">Progress</a></li>
					    <li><a href="<?= base_url('vvc/logout') ?>" class="btn btn-default"><i class="fa fa-sign-out" ></i> Logout</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->

			</div><!-- /.container -->
		</nav><!-- /.navbar -->

	</header>

	<div class="alph-wrapper">

					