<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active"><i class="fa-solid fa-gauge-high me-1"></i> Dashboard</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                    <i class="fa-solid fa-newspaper fa-lg text-primary"></i>
                </div>
                <div>
                    <div class="text-muted small">Blog Posts</div>
                    <div class="fs-4 fw-bold"><?= $blogCount ?? 0; ?></div>
                </div>
            </div>
            <a href="<?= base_url('aw-cp/blog'); ?>" class="card-footer bg-primary text-white text-center text-decoration-none py-2">
                <small>View Details <i class="fa-solid fa-arrow-right ms-1"></i></small>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                    <i class="fa-solid fa-envelope fa-lg text-success"></i>
                </div>
                <div>
                    <div class="text-muted small">Messages</div>
                    <div class="fs-4 fw-bold"><?= $messagesCount ?? 0; ?></div>
                </div>
            </div>
            <a href="<?= base_url('aw-cp/messages'); ?>" class="card-footer bg-success text-white text-center text-decoration-none py-2">
                <small>View Details <i class="fa-solid fa-arrow-right ms-1"></i></small>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                    <i class="fa-solid fa-comments fa-lg text-warning"></i>
                </div>
                <div>
                    <div class="text-muted small">Comments</div>
                    <div class="fs-4 fw-bold"><?= $commentsCount ?? 0; ?></div>
                </div>
            </div>
            <a href="<?= base_url('aw-cp/blog'); ?>" class="card-footer bg-warning text-dark text-center text-decoration-none py-2">
                <small>View Details <i class="fa-solid fa-arrow-right ms-1"></i></small>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                    <i class="fa-solid fa-bell fa-lg text-danger"></i>
                </div>
                <div>
                    <div class="text-muted small">Subscribers</div>
                    <div class="fs-4 fw-bold"><?= $subscribersCount ?? 0; ?></div>
                </div>
            </div>
            <div class="card-footer bg-danger text-white text-center py-2">
                <small>Newsletter Subscribers</small>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-bolt me-2"></i>Quick Actions
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?= base_url('aw-cp/blog/create'); ?>" class="btn btn-outline-primary text-start">
                        <i class="fa-solid fa-plus me-2"></i>Create New Blog Post
                    </a>
                    <a href="<?= base_url('aw-cp/messages'); ?>" class="btn btn-outline-success text-start">
                        <i class="fa-solid fa-envelope me-2"></i>View Messages
                    </a>
                    <a href="<?= base_url('/'); ?>" target="_blank" class="btn btn-outline-secondary text-start">
                        <i class="fa-solid fa-globe me-2"></i>View Website
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-clock me-2"></i>Recent Blog Posts
            </div>
            <div class="card-body">
                <?php if (!empty($recentPosts)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($recentPosts as $post): ?>
                            <a href="<?= base_url('aw-cp/blog/edit/' . $post['id']); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                                <span><?= esc($post['blog_title']); ?></span>
                                <small class="text-muted"><?= date('M d', strtotime($post['date_created'])); ?></small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted mb-0">No blog posts yet. <a href="<?= base_url('aw-cp/blog/create'); ?>">Create one</a>.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
