<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active"><i class="fa-solid fa-gauge-high me-1"></i> Overview</li>
            </ol>
        </nav>
    </div>
    <span class="text-muted small"><?= date('l, F d, Y'); ?></span>
</div>

<!-- Stats Cards Row 1 -->
<div class="row g-3 mb-4">
    <div class="col-xl-2 col-md-4 col-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center py-3">
                <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-2" style="width:42px;height:42px">
                    <i class="fa-solid fa-newspaper text-primary"></i>
                </div>
                <div class="fs-4 fw-bold"><?= $blogCount ?? 0; ?></div>
                <div class="text-muted small">Blog Posts</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center py-3">
                <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-2" style="width:42px;height:42px">
                    <i class="fa-solid fa-envelope text-success"></i>
                </div>
                <div class="fs-4 fw-bold"><?= $messagesCount ?? 0; ?><?php if (($unreadMessages ?? 0) > 0): ?><span class="badge bg-danger ms-1 small"><?= $unreadMessages; ?></span><?php endif; ?></div>
                <div class="text-muted small">Messages</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center py-3">
                <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-2" style="width:42px;height:42px">
                    <i class="fa-solid fa-comments text-warning"></i>
                </div>
                <div class="fs-4 fw-bold"><?= $commentsCount ?? 0; ?></div>
                <div class="text-muted small">Comments</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center py-3">
                <div class="rounded-circle bg-info bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-2" style="width:42px;height:42px">
                    <i class="fa-solid fa-bell text-info"></i>
                </div>
                <div class="fs-4 fw-bold"><?= $subscribersCount ?? 0; ?></div>
                <div class="text-muted small">Subscribers</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center py-3">
                <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-2" style="width:42px;height:42px">
                    <i class="fa-solid fa-briefcase text-danger"></i>
                </div>
                <div class="fs-4 fw-bold"><?= $hiresCount ?? 0; ?></div>
                <div class="text-muted small">Hires</div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-6">
        <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #0f3460, #1a1a2e); color:#fff;">
            <div class="card-body text-center py-3">
                <div class="fs-5 fw-bold"><?= ($ongoingHires ?? 0); ?></div>
                <div class="small opacity-75">Ongoing Projects</div>
                <a href="<?= base_url('aw-cp/hires?status=ongoing'); ?>" class="stretched-link"></a>
            </div>
        </div>
    </div>
</div>

<!-- Project Pipeline -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
        <span><i class="fa-solid fa-diagram-project me-2"></i>Project Pipeline</span>
        <a href="<?= base_url('aw-cp/hires'); ?>" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="card-body">
        <div class="row g-3 text-center">
            <div class="col-md-3">
                <div class="border rounded p-3">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                    </div>
                    <div class="fs-3 fw-bold text-warning"><?= $pendingHires ?? 0; ?></div>
                    <div class="text-muted small">Awaiting review</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="border rounded p-3 border-primary">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <span class="badge bg-primary rounded-pill px-3 py-2">Ongoing</span>
                    </div>
                    <div class="fs-3 fw-bold text-primary"><?= $ongoingHires ?? 0; ?></div>
                    <div class="text-muted small">In progress</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="border rounded p-3">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <span class="badge bg-success rounded-pill px-3 py-2">Completed</span>
                    </div>
                    <div class="fs-3 fw-bold text-success"><?= $completedHires ?? 0; ?></div>
                    <div class="text-muted small">Delivered</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="border rounded p-3">
                    <?php
                    $total = ($pendingHires ?? 0) + ($ongoingHires ?? 0) + ($completedHires ?? 0);
                    $rate = $total > 0 ? round(($completedHires ?? 0) / $total * 100) : 0;
                    ?>
                    <div class="text-muted small mb-2">Completion Rate</div>
                    <div class="fs-3 fw-bold"><?= $rate; ?>%</div>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: <?= $rate; ?>%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Row -->
<div class="row g-4">
    <!-- Recent Hires -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-briefcase me-2"></i>Recent Project Requests
            </div>
            <div class="card-body p-0">
                <?php if (!empty($recentHires)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr><th>Client</th><th>Work</th><th>Budget</th><th>Status</th><th></th></tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentHires as $hire): ?>
                                    <tr>
                                        <td>
                                            <strong><?= esc($hire['name']); ?></strong>
                                            <div class="text-muted small"><?= esc($hire['email']); ?></div>
                                        </td>
                                        <td><span class="badge bg-light text-dark"><?= esc($hire['work']); ?></span></td>
                                        <td><?= esc($hire['budget']); ?></td>
                                        <td>
                                            <?php
                                            $statusColors = ['pending' => 'warning', 'ongoing' => 'primary', 'completed' => 'success', 'cancelled' => 'secondary'];
                                            $s = $hire['status'] ?? 'pending';
                                            ?>
                                            <span class="badge bg-<?= $statusColors[$s] ?? 'secondary'; ?>"><?= ucfirst($s); ?></span>
                                        </td>
                                        <td><a href="<?= base_url('aw-cp/hires/view/' . $hire['id']); ?>" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-eye"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4 text-muted">No hire requests yet.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quick Actions + Recent Posts -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-bolt me-2"></i>Quick Actions
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?= base_url('aw-cp/blog/create'); ?>" class="btn btn-outline-primary text-start">
                        <i class="fa-solid fa-plus me-2"></i>New Blog Post
                    </a>
                    <a href="<?= base_url('aw-cp/hires'); ?>" class="btn btn-outline-danger text-start">
                        <i class="fa-solid fa-briefcase me-2"></i>Manage Projects
                    </a>
                    <a href="<?= base_url('/'); ?>" target="_blank" class="btn btn-outline-secondary text-start">
                        <i class="fa-solid fa-globe me-2"></i>View Website
                    </a>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-solid fa-clock me-2"></i>Recent Posts
            </div>
            <div class="card-body">
                <?php if (!empty($recentPosts)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach (array_slice($recentPosts, 0, 4) as $post): ?>
                            <a href="<?= base_url('aw-cp/blog/edit/' . $post['id']); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                                <span class="text-truncate me-2"><?= esc($post['blog_title']); ?></span>
                                <small class="text-muted text-nowrap"><?= date('M d', strtotime($post['date_created'])); ?></small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted mb-0">No blog posts yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
