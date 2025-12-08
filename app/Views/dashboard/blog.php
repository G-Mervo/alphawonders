<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>


	<h1>Write a blog:</h1>
  	<form method="post" action="<?php echo base_url('blog/save'); ?>">
  		<div class="row">
  			<div class="col-lg-4">
  				<div class="form-group">
  					<label for="">Author:</label>
  					<input type="text" class="form-control" placeholder="laps" name="auth" id="">
  				</div>
  			</div>
  			<div class="col-lg-4">
  				<div class="form-group">
  					<label for="">Title:</label>
  					<input type="text" class="form-control" placeholder="laps" name="title" id="">
  				</div>
  			</div>
  			<div class="col-lg-4">
  				<div class="form-group">
  					<label for="">Custom URL: </label>
  					<input type="text" class="form-control" placeholder="laps" name="cus-url" id="">
  				</div>
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-lg-12">
  				<div class="form-group">
  					<label for="">Blog:</label>
  					<textarea class="form-control" id="blogtxtarea" name="blogtxtarea">Hello, World!</textarea>
  				</div>
  			</div>
  		</div>
  		<div class="row" style="margin:10px">
  			<div class="col-lg-4"></div>
  			<div class="col-lg-4 text-center">
  				<div class="form-group">
  					<button class="btn btn-primary btn-lg wow fadeInUp form-control col-lg-6" data-wow-delay="2.4s" style="border-radius: 7px;">Save</button>
  				</div>
  			</div>
  			<div class="col-lg-4"></div>
  		</div>

  	</form>
