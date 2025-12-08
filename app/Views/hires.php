<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="container-fluid alph-hires">
	<div class="text-center">
		<h2>Hire skilled and qualified professionals & technicians</h2>
		<p>Do you have a job, a vacant post or require a contractor in your company? Then, Hire us Today!</p>
	</div>

	<div class="container">
		<!-- <a href="./proposal" class="btn btn-primary form-control"> Request for proposal</a> -->
		<form action="<?php echo base_url('hires'); ?>" method="POST">
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						<label>Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="name" placeholder="your name">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Email Address <span class="text-danger">*</span></label>
						<input type="email" class="form-control" name="email" placeholder="email">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Telephone No. <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="telno" placeholder="tel">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						<label>Your Budget <span class="text-danger">*</span></label>
						<input type="text"class="form-control"  name="budget" placeholder="currency amount e.g KSh 200000 or USD 2000">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Location <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="loc" placeholder="city, country">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Skype ID </label>
						<input type="text" class="form-control" name="sky" placeholder="jmervin12">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						<label>Individual or company <span class="text-danger">*</span></label>
						<select name="client" id="" class="form-control">
							<option> Select whether you are an individual or company</option>
							<option value="individual">Individual</option>
							<option value="company">Company</option>
						</select>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Nature of work <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="work" placeholder="design, development, support, consultancy, marketing">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label>Whatsapp No.</label>
						<input type="text" class="form-control" name="whts" placeholder="254707043488">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<label>Project Description<span class="text-danger">*</span></label>
						<textarea class="form-control" rows="8" name="proj_desc" placeholder="What does your project entail"></textarea>
					</div>
				</div>
			</div>
			<div class="row ">
				<div class="col-lg-12 text-center">
					<button class="btn btn-success">Send</button>			
				</div>
			</div>
		</form>
	</div>

</section>


