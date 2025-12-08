
<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Club Members</h1> 
    <hr>
    <?php if (validation_errors()) { ?>
        <hr>
        <div class="alert alert-danger"><?= validation_errors() ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_add')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_add') ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_delete')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div>
        <hr>
        <?php
    }
    ?>
    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> register member</a>
    <div class="clearfix"></div>
    <?php
    if ($users->result()) {
        ?>
        <div class="table-responsive">
            <table class="table table-striped custab">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Phone No</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Last login</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <?php foreach ($users->result() as $user) { ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->fname.' '.$user->lname ?></td>
                        <td><?= $user->phoneno ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= date('d.m.Y - H:i:s', $user->last_login) ?></td>
                        <td class="text-center">
                            <div>
                                <a href="?edit=<?= $user->id ?>">Edit</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php } else { ?>
        <div class="clearfix"></div><hr>
        <div class="alert alert-info">No users found!</div>
    <?php } ?>

   <!-- add edit users -->
    <div class="modal fade" id="add_edit_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Administrator</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '0' ?>">
                        <div class="row">
                        	<div class="col-lg-6">
                        		<div class="form-group">
		                            <label for="fname">First Name</label>
		                            <input type="text" name="fname" value="<?= isset($_POST['fname']) ? $_POST['fname'] : '' ?>" class="form-control" id="fname">
		                        </div>
                        	</div>
                        	<div class="col-lg-6">
                        		<div class="form-group">
		                            <label for="lname">Second Name</label>
		                            <input type="text" name="lname" value="<?= isset($_POST['lname']) ? $_POST['lname'] : '' ?>" class="form-control" id="lname">
		                        </div>
                        	</div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<div class="form-group">
		                            <label for="fname">Phone Number</label>
		                            <input type="text" name="phoneno" value="<?= isset($_POST['phoneno']) ? $_POST['phoneno'] : '' ?>" class="form-control" id="phoneno">
		                        </div>
                        	</div>
                        	<div class="col-lg-6">
                        		<div class="form-group">
		                            <label for="email">Email</label>
		                            <input type="text" name="email" class="form-control" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" id="email">
		                        </div>
                        	</div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<div class="form-group">
		                            <label for="fname">Username</label>
		                            <input type="text" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" class="form-control" id="username">
		                        </div>
                        	</div>
                        	<div class="col-lg-6">
                        		<div class="form-group">
		                            <label for="password">Password</label>
		                            <input type="password" name="password" class="form-control" value="" id="password">
		                        </div>
		                    </div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<div class="form-group">
		                            <label for="gender">Gender</label>
		                            <input type="text" name="gender" value="<?= isset($_POST['gender']) ? $_POST['gender'] : '' ?>" class="form-control" id="gender">
		                        </div>
                        	</div>
                        	<div class="col-lg-6">
                        		<div class="form-group">
		                            <label for="residence">Residence</label>
		                            <input type="residence" name="residence" class="form-control" value="" id="residence">
		                        </div>
		                    </div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-6">
                        		<div class="form-group">
		                            <label for="profession">Profession</label>
		                            <input type="text" name="profession" value="<?= isset($_POST['profession']) ? $_POST['profession'] : '' ?>" class="form-control" id="profession">
		                        </div>
                        	</div>
                        	
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
<?php if (isset($_GET['edit'])) { ?>
        $(document).ready(function () {
            $("#add_edit_users").modal('show');
        });
<?php } ?>
</script>


