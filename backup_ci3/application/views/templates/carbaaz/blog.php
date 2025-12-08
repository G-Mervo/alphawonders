<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container" id="blog">
    <div class="row eqHeight">
        <div class="col-sm-4 col-md-2">
            <div class="blog-home-left-categ">
                <?= $archives ?>
            </div>
            <div id="search-input-blog">
                <div class="input-group col-md-12">
                    <form method="GET" action="">
                        <input type="text" class="search-query form-control" value="<?= isset($_GET['find']) ? $_GET['find'] : '' ?>" name="find" placeholder="<?= lang('search') ?>" />
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </form>
                </div>
            </div>
            
        </div>
        <div class="col-sm-8 col-md-8">
            <div class="alone title">
                <span><?= lang('latest_blog') ?></span>
            </div>
            <div class="row">
                <?php
                if (!empty($posts)) {
                    foreach ($posts as $post) {
                        ?>
                        <div class="col-md-3 blog-col" style="margin: 20px 0px 40px; padding: 14px 13px ">
                            <div class="thumbnail blog-list">
                                <a href="<?= LANG_URL . '/blog/'.$post['year_published'] .'/'. $post['url'] ?>" class="img-container">
                                    <img class="img-responsive" src="<?= base_url('attachments/blog_images/' . $post['image']) ?>" alt="<?= $post['title'] ?>">
                                </a>
                                <div class="caption">
                                    <h5>
                                        <?= character_limiter($post['title'], 100) ?>
                                    </h5>
                                    <small>
                                        <span>
                                            <i class="fa fa-clock-o"></i>
                                            <?= date('M d, Y', $post['time']) ?>
                                        </span>
                                    </small>
                                    <p class="description"><?= character_limiter(strip_tags($post['description']), 100) ?></p>
                                    <a class="btn btn-blog pull-right" href="<?= LANG_URL . '/blog/' .$post['year_published'] .'/'. $post['url'] ?>">
                                        <i class="fa fa-arrow-right"></i>
                                        <?= lang('read_mode') ?>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-info"><?= lang('no_posts') ?></div>
                <?php } ?>
            </div>
            <?= $links_pagination ?>
        </div>
        <div class="col-sm-4 col-md-2">
        </div>
    </div>
</div>