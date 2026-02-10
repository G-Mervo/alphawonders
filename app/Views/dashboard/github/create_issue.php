<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">
        Create Issue &mdash; <?= esc($owner); ?>/<?= esc($repoName); ?>
    </h3>
    <a href="<?= base_url("aw-cp/github/repo/{$owner}/{$repoName}"); ?>" class="btn btn-outline-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Repo
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
                <i class="fa-solid fa-circle-dot me-2 text-success"></i>New Issue
            </div>
            <div class="card-body">
                <form method="post" action="<?= base_url("aw-cp/github/repo/{$owner}/{$repoName}/issues/create"); ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" id="title" required
                               placeholder="Brief description of the issue">
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Description</label>
                        <textarea class="form-control" name="body" id="body" rows="8"
                                  placeholder="Detailed description (Markdown supported)..."></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="labels" class="form-label">Labels</label>
                        <input type="text" class="form-control" name="labels" id="labels"
                               placeholder="bug, enhancement, documentation (comma-separated)">
                        <div class="form-text">Separate multiple labels with commas. Labels must already exist in the repository.</div>
                    </div>
                    <div class="text-center">
                        <a href="<?= base_url("aw-cp/github/repo/{$owner}/{$repoName}"); ?>" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fa-solid fa-plus me-2"></i>Create Issue
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
