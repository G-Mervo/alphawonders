<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

	</div>
	<footer class="alph-footer">
		<div class="container-fluid">
			<div class="row ft-1" style="">
				<div class="col-lg-2 col-xs-12">
					<h4 class="">Quick links</h4>
					<ul class="nav-bottom">
						    <li><a href="<?php echo base_url('/'); ?>">Software Development</a></li>
						    <li><a href="<?php echo base_url('/'); ?>">System Administration</a></li>
						    <li><a href="<?php echo base_url('/'); ?>">Digital Marketing</a></li>
						    <li><a href="<?php echo base_url('/'); ?>">Design</a></li>
						    <!-- <li><a href="<?php //echo base_url('/'); ?>">Cyber Security</a></li> -->
						    <li><a href="<?php echo base_url('/'); ?>">IT Consultancy</a></li>
						    <!-- <li><a href="<?php //echo base_url('/'); ?>">Data Services</a></li> -->
						    <li><a href="<?php echo base_url('/'); ?>">IT Support</a></li>
							<li><a href="<?php echo base_url('contact-us'); ?>">Contact Us</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-xs-12">
					<h4 class="text-center">Our Expertise</h4>
					<div class="row">
						<div class="col-lg-6">
							<ul>
								<li>PHP</li>
								<li>HTML & CSS</li>
								<li>HTML5 & CSS3</li>
								<li>Javascript</li>
								<li>Codeigniter</li>
								<li>Laravel</li>
								<li>Wordpress</li>
								<li>Joomla</li>
								<li>E-commerce</li>
								<li>Android</li>
							</ul>
						</div>
						<div class="col-lg-6">
							<ul>
								<li>SEO Optimization</li>
								<li>Social Media Marketing</li>
								<li>Content Marketing</li>
								<li>Linux, unix & Windows Server Administration</li>
								<li>Python</li>
								<li>Web Design</li>
								<li>Graphic Design</li>
								<li>Prototyping</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-xs-12">
					<h4 class="">Contact us | Social Media </h4>
					<ul class="social">
	                    <li><a href="https://facebook.com/alphawonders" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
	                    <li><a href="https://twitter.com/alphawondersltd" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
	                    <li><a href="https://ke.linkedin.com/company/alphawonders" target="_blank"><i class="fab fa-linkedin"></i></a></li>
	                </ul>
				</div>
				<div class="col-lg-2 col-xs-12">
					<h4>Blog</h4>
					<ul class="blog-cat">
						<li><a href="<?php echo base_url('/'); ?>">Software World</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Systems</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Applications</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Digital Marketing</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Data Analytics</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Cyber Security</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Data Science</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Blockchain Technology</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Internet of Things</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Machine Learning</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Artificial Intelligence</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Robotics</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Quantum Computing</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Control Theory</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Mathematics</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Business</a></li>
						<li><a href="<?php echo base_url('/'); ?>">Trends in Technology</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-xs-12">
					<h5>Newsletter</h5>
					<form method="post" action="<?php echo base_url('/subscribe'); ?>">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-12">
									<label for="subscribe" class="sr-only">Subscribe to our newsletter</label>
									<input type="text" class="form-control" name="email_sub" id="sub" placeholder="Enter your email">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-lg-12">
									<button class="btn btn-primary form-control" id="subscr">subscribe</button>
								</div>
							</div>
						</div>
					</form>
				</div>
							
				
			</div>
			<div class="row ft-2">
				<div class="col-lg-4 col-xs-12">
					<p>Alphawonders &copy <?php echo "2017 - ".date('Y'); ?></p>
				</div>
				<div class="col-lg-4 col-xs-12">
					<p>
						<a href="">info@alphawonders.com</a>
					</p>
				</div>
				<div class="col-lg-4 col-xs-12">
					<p>
						<a href="">About us</a>
						<a href=""></a>
					</p>
				</div>
			</div>
		</div>
	</footer>

	<script src = "<?php echo base_url("assets/js/custom.js") ?>"> </script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url("assets/js/wow.min.js") ?>"></script>
    <script>
    	new WOW().init();
    </script>
	<script>
		$(document).ready(function(){
			$("#subscr").click(function(){
			  	$.post("<?php echo base_url("/subscribe"); ?>",
			  	{
			    	subscr: "mail"
			  	},
			  	function(data, status){
			    	alert("Data: " + data + "\nStatus: " + status);
			  	});
			});
			
		});
	</script>

	<!-- JSON-LD markup generated by Google Structured Data Markup Helper. -->
	<script type="application/ld+json">
	{
	  "@context" : "http://schema.org",
	  "@type" : "LocalBusiness",
	  "name" : "Alphawonders",
	  "image" : "https://alphawonders.com/assets/icon/logo.png",
	  "telephone" : "+254 736 099 643",
	  "email" : "info@alphawonders.com"
	}
	</script>

</body>
</html>