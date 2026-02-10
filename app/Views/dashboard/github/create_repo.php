<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">Create New Repository</h3>
    <a href="<?= base_url('aw-cp/github'); ?>" class="btn btn-outline-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Back
    </a>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-semibold">
                <i class="fa-brands fa-github me-2"></i>Repository Details
            </div>
            <div class="card-body">
                <form method="post" action="<?= base_url('aw-cp/github/create'); ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Repository Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" required
                               placeholder="e.g. my-awesome-project" pattern="[A-Za-z0-9._-]+">
                        <div class="form-text">Use letters, numbers, hyphens, underscores, and dots.</div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" id="description"
                               placeholder="Short description of the repository">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Visibility</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibility" id="vis_public" value="public" checked>
                            <label class="form-check-label" for="vis_public">
                                <i class="fa-solid fa-globe me-1"></i> Public
                                <span class="text-muted small">&mdash; Anyone can see this repository</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibility" id="vis_private" value="private">
                            <label class="form-check-label" for="vis_private">
                                <i class="fa-solid fa-lock me-1"></i> Private
                                <span class="text-muted small">&mdash; Only you can see this repository</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="auto_init" id="auto_init" value="1" checked>
                            <label class="form-check-label" for="auto_init">
                                Initialize with a README file
                            </label>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="<?= base_url('aw-cp/github'); ?>" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fa-solid fa-plus me-2"></i>Create Repository
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
