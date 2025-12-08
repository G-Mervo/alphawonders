<style>
    body {
        background-image:url('assets/img/software_7.jpg');
        background-position: top;
        background-repeat: no-repeat;
        background-color: #548fd0;
        background-size: cover;
        background-color:#548fd0;
    }
    .avatar {background-image:url('assets/img/tech_world.jpg')}
</style>

<div class="container">
    <div class="login-container">
        <div id="output">       
            <?php
            if ($this->session->flashdata('err_login')) {
                ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('err_login') ?></div>
                <?php
            }
            ?></div>
        <div class="avatar"></div>
        <div class="form-box">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input class="form-control" type="text" name="username" placeholder="username">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">                
                            <button class="btn btn-info btn-block login" type="submit">Login</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>