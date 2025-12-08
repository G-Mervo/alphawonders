<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

	</div>
	<footer class="alph-footer">
		<div class="container-fluid">
			<div class="row ft-1" style="">
				<div class="col-lg-2 col-xs-12">
					<h4 class=""></h4>
					
				</div>
				<div class="col-lg-3 col-xs-12">
					<h4 class="text-center"></h4>
					<div class="row">
						<div class="col-lg-6">
							
						</div>
						<div class="col-lg-6">
							
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-xs-12">
					<h4 class="">Contact us | Social Media </h4>
					<ul class="social">
	                    
	                </ul>
				</div>
				<div class="col-lg-2 col-xs-12">
					<h4></h4>
					
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
						<a href="#">info@alphawonders.com</a>
					</p>
				</div>
				<div class="col-lg-4 col-xs-12">
					<p>
						<a href="#">About us</a>
						<a href="#"></a>
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
			var w = $('#memindex').DataTable({
                responsive: true,
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
                "order": [[ 1, 'asc' ]]
            });

            w.on( 'order.dt search.dt', function () {
                w.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

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

</body>
</html>