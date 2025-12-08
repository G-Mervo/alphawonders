<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-2 left-col-archive">
            <?= $archives ?>
            <a href="<?= LANG_URL . '/blog' ?>" class="btn btn-default"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?= lang('go_back') ?></a>
        </div>
        <div class="col-sm-8">
            <div class="alone title">
                <span><?= $article['title'] ?></span>
            </div>
            <span class="blog-preview-time">
                <i class="fa fa-clock-o"></i>
                <?= date('M d, Y', $article['time']) ?>
            </span>
            <div class="thumbnail blog-detail-thumb">
                <img class="img-responsive" src="<?= base_url('attachments/blog_images/' . $article['image']) ?>" alt="<?= $article['title'] ?>">
            </div>
            <div class="blog-description">
                <?= $article['description'] ?>
            </div>
        </div>
        <div class="col-sm-3 col-md-2">
        </div>
    </div>
</div>