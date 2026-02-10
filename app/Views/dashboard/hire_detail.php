<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>
<?php
$statusColors = ['pending' => 'warning', 'ongoing' => 'primary', 'completed' => 'success', 'cancelled' => 'secondary'];
$s = $hire['status'] ?? 'pending';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Project Details</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('aw-cp/hires'); ?>">Projects</a></li>
                <li class="breadcrumb-item active"><?= esc($hire['name']); ?></li>
            </ol>
        </nav>
    </div>
    <span class="badge bg-<?= $statusColors[$s] ?? 'secondary'; ?> <?= $s === 'pending' ? 'text-dark' : ''; ?> fs-6 px-3 py-2"><?= ucfirst($s); ?></span>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show"><small><?= session()->getFlashdata('success'); ?></small><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show"><small><?= session()->getFlashdata('error'); ?></small><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="row g-4">
    <!-- Client & Project Info -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold"><i class="fa-solid fa-user me-2"></i>Client Information</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small">Name</label>
                        <div class="fw-semibold"><?= esc($hire['name']); ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Email</label>
                        <div><a href="mailto:<?= esc($hire['email']); ?>"><?= esc($hire['email']); ?></a></div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Phone</label>
                        <div><?= esc($hire['tel']); ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">WhatsApp</label>
                        <div><?= esc($hire['whatsapp'] ?: '-'); ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Skype</label>
                        <div><?= esc($hire['skype'] ?: '-'); ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Client Type</label>
                        <div><span class="badge bg-light text-dark"><?= esc(ucfirst($hire['client'])); ?></span></div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Company</label>
                        <div><?= esc($hire['company_name'] ?: '-'); ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Location</label>
                        <div><i class="fa-solid fa-location-dot text-danger me-1"></i><?= esc($hire['location']); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold"><i class="fa-solid fa-briefcase me-2"></i>Project Information</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="text-muted small">Nature of Work</label>
                        <div class="fw-semibold"><?= esc($hire['work']); ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Project Type</label>
                        <div><?= esc($hire['nature'] ?: '-'); ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Industry</label>
                        <div><?= esc($hire['industry'] ?: '-'); ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Budget</label>
                        <div class="fs-5 fw-bold text-success"><?= esc($hire['budget']); ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Timeline</label>
                        <div><?= esc($hire['timeline'] ?: '-'); ?></div>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small">Submitted</label>
                        <div><?= date('M d, Y \a\t h:i A', strtotime($hire['date_created'])); ?></div>
                    </div>
                </div>
                <hr>
                <label class="text-muted small">Project Description</label>
                <div class="mt-1 p-3 bg-light rounded"><?= nl2br(esc($hire['description'])); ?></div>
            </div>
        </div>
    </div>

    <!-- Status Update Panel -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white fw-semibold"><i class="fa-solid fa-sliders me-2"></i>Update Status</div>
            <div class="card-body">
                <form method="post" action="<?= base_url('aw-cp/hires/update/' . $hire['id']); ?>">
                    <div class="mb-3">
                        <label for="status" class="form-label">Project Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="pending" <?= $s === 'pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="ongoing" <?= $s === 'ongoing' ? 'selected' : ''; ?>>Ongoing</option>
                            <option value="completed" <?= $s === 'completed' ? 'selected' : ''; ?>>Completed</option>
                            <option value="cancelled" <?= $s === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Admin Notes</label>
                        <textarea class="form-control" name="admin_notes" id="admin_notes" rows="4" placeholder="Internal notes about this project..."><?= esc($hire['admin_notes'] ?? ''); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold"><i class="fa-solid fa-clock-rotate-left me-2"></i>Activity</div>
            <div class="card-body">
                <div class="small">
                    <div class="d-flex mb-2">
                        <i class="fa-solid fa-circle text-primary me-2 mt-1" style="font-size:8px"></i>
                        <div>
                            <div>Last modified</div>
                            <div class="text-muted"><?= date('M d, Y h:i A', strtotime($hire['date_modified'])); ?></div>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <i class="fa-solid fa-circle text-success me-2 mt-1" style="font-size:8px"></i>
                        <div>
                            <div>Submitted</div>
                            <div class="text-muted"><?= date('M d, Y h:i A', strtotime($hire['date_created'])); ?></div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <i class="fa-solid fa-circle text-secondary me-2 mt-1" style="font-size:8px"></i>
                        <div>
                            <div>Via</div>
                            <div class="text-muted"><?= esc(($hire['device'] ?? '') . ' / ' . ($hire['browser_name'] ?? '')); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
