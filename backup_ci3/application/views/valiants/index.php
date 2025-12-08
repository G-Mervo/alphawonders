
<section class="bdi text-center">
	<h1 class="">Valiant Venture Club </h1>	
	<p>The Chama System</p>

	<div class="row">
		<div class="col-lg-4">
			<h4>Members</h4>
			<table id="memindex" class="table table-striped table-hover table-bordered" style="width:100%">
			        <thead>
			            <tr>
			            	<th></th>
			                <th>Name</th>			                
                            <th>Gender</th>
			                <th>Profession</th>
			                <th>Residence</th>
			                <th>Contribution</th>
			                <th>Position</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	
						<?php if(!empty($users)){ foreach($users as $row) {	 ?>
			                <tr>
			                	<td></td>
			                	<td><?php echo $row['fname'].' '.$row['lname']; ?></td>
					            <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['profession']; ?></td>
					            <td><?php echo $row['residence']; ?></td>
					            <td><?php echo $row['contribution']; ?></td>
					            <td><?php echo $row['position']; ?></td>
					            <td><?php echo $row['status']; ?></td>
					            <td><a class="btn btn-outline-info btn-sm" href=" <?php echo $row['id'] ?>" role="button">Edit <span class="fas fa-pen-square" aria-hidden="true"></span></a></td>		                    
			                    <td><a class="btn btn-warning btn-sm" href="<?php echo $row['id'] ?>" role="button">Details <span class="fa fa-arrow-circle-right" aria-hidden="true"></span></a></td>
					        </tr>
					        <?php } } else{ ?>
			                <tr><td colspan="9">No Items(s) found...</td></tr>
			                <?php } ?>
			            
			        </tbody>
			</table>
		</div>
		<div class="col-lg-6">
			<p>The Chama voting and progress status system</p>
		</div>
	</div>

</section>
