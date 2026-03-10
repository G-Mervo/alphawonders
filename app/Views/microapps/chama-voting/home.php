<style>
    body {
        background-image: url('assets/valiants/vncd.jpg');
        background-position: top;
        background-repeat: no-repeat;
        background-color: #548fd0;
        background-size: cover;
        background-color:#548fd0;
    }
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
            ?>
        </div>
        <div class="form-box">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">                
                            <a class="btn btn-info btn-block" href="<?php echo base_url('vvc/login') ?>">Login</a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>