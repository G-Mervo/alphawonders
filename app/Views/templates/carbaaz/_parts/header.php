<!DOCTYPE html>
<html lang="<?= MY_LANGUAGE_ABBR ?>">
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
        <meta name="description" content="<?= $description ?>" />
        <meta name="keywords" content="<?= $keywords ?>" />
        <meta property="og:title" content="<?= $title ?>" />
        <meta property="og:description" content="<?= $description ?>" />
        <meta property="og:url" content="<?= LANG_URL ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="<?= base_url('assets/imgs/logo.png') ?>" />
        <title><?= $title ?></title>
        
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>" />
        <link href="<?= base_url('assets/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet" />
        <link href="<?= base_url('templatecss/custom.css') ?>" rel="stylesheet" />
        <link href="<?= base_url('cssloader/theme.css') ?>" rel="stylesheet" />
        <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>" />
        <link rel = "stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
        
        <link rel="icon" type="image/png" href="<?php echo base_url('/assets/icon/awlogo.png'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/fontawesome-5.1.0/css/all.css'); ?>">
        
        <link rel="stylesheet" type="text/css" href="assets/styles/responsive.css">


        
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

        <script src="<?= base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
        <script src="<?= base_url('loadlanguage/all.js') ?>"></script>

</head>
<body>
    <div id="wrapper">
        <div id="content">
            <div id="fb-root"></div>

            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId=688908964868655&autoLogAppEvents=1"></script>
            <header>
                <nav class="navbar navbar-default navbar-fixed-top"> <!-- tap-nav -->
                    <div class="container-fluid">

                        <div class="navbar-header">                     
                            <a class="navbar-brand" href="<?php echo base_url('/'); ?>">
                                <img src="<?php echo base_url('assets/icon/logo.png'); ?>" alt="Alphawonders">
                                <div class="lg-id" id="al-lg">
                                    <p>Alphawonders</p>
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
                                    <a class="btn btn-primary" href="<?php echo base_url('/hire'); ?>">Hire</a>
                                </span>
                                <span class="qck-co-2">
                                    <span class="tel">Tel: <a class="alp-tel" href="#"> <a class="alp-tel" href="#"> 0736099643</a></span> 
                                    <span class="" id="cont-email">Email: <a href="mailto:info@alphawonders.com">  info@alphawonders.com</a></span>
                                </span>
                                
                            </p>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="navbar-collapse-2">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo base_url('/softwares'); ?>">Software Development</a></li>
                                <li><a href="<?php echo base_url('/system-administration'); ?>">System Administration</a></li>
                                <li><a href="<?php echo base_url('/digital-marketing'); ?>">Digital Marketing</a></li>
                                <li><a href="<?php echo base_url('/design'); ?>">Design</a></li>
                                <li><a href="<?php echo base_url('/ict-consultancy'); ?>">IT Consultancy</a></li>
                                <li><a href="<?php echo base_url('/it-support'); ?>">IT Support</a></li>
                                <!-- <li><a href="<?php //echo base_url('/'); ?>">Cyber Security</a></li> -->
                                <!-- <li><a href="<?php //echo base_url('/'); ?>">Data Services</a></li> -->
                                <li><a href="<?php echo base_url('/contact-us'); ?>">Contact Us</a></li>
                                <li><a href="<?php echo base_url('/blog'); ?>">Blog</a></li>
                            </ul>
                                            
                        </div><!-- /.navbar-collapse -->

                    </div><!-- /.container -->
                </nav><!-- /.navbar -->

            </header>

            <div class="alph-wrapper">
               
                

               

                
                   
                                       
                                       