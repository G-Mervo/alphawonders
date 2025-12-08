<?php defined('BASEPATH') OR exit('No direct script allowed'); ?>

	<!-- <section class="contact" id="contacts"> -->
<section class="alph-services contact text-center" id="contacts">
	<div class="container-fluid">
			<h2 class="wow fadeInUp">Contact us</h2>
			<p class="wow fadeInUp" data-wow-delay="0.4s">Send us an Email today.</p>
			<div class="container-fluid">
				<form action="<?php echo base_url('/send'); ?>" method="POST">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="input-group input-group-lg wow fadeInUp" data-wow-delay="0.8s">
								<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
								<input type="text" class="form-control" aria-describedby="sizing-addon1" placeholder="Fullname" name="fullname" required>							
							</div>
							<div class="input-group input-group-lg wow fadeInUp" data-wow-delay="1.2s">
								<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
								<input type="text" class="form-control" aria-describedby="sizing-addon1" placeholder="Email Address" name="email" required>							
							</div>
							<div class="input-group input-group-lg wow fadeInUp" data-wow-delay="1.6s">
								<span class="input-group-addon" id="sizing-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
								<input type="text" class="form-control" aria-describedby="sizing-addon1" placeholder="Phone Number" name="phone_number" required>							
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="input-group wow fadeInUp" data-wow-delay="2s">
								<textarea name="message" id=" " cols="86" rows="4" class="form-control" placeholder="Enter your Message here" required></textarea>
							</div>
							<div class="row text-center">
								<div class="col-lg-4"></div>
								<div class="col-lg-4">
									<button class="btn btn-lg wow fadeInUp" data-wow-delay="2.4s" style="border-radius: 7px;">Submit Your Message</button>
								</div>
							</div>							
						</div>					
					</div>
				</form>
			</div>
	</div>
	</section>