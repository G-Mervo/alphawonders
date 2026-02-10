<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">
        Create Release &mdash; <?= esc($owner); ?>/<?= esc($repoName); ?>
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
                <i class="fa-solid fa-tag me-2 text-success"></i>New Release
            </div>
            <div class="card-body">
                <form method="post" action="<?= base_url("aw-cp/github/repo/{$owner}/{$repoName}/releases/create"); ?>">
                    <div class="mb-3">
                        <label for="tag_name" class="form-label">Tag Version <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tag_name" id="tag_name" required
                               placeholder="e.g. v1.0.0">
                        <div class="form-text">If the tag doesn't exist, it will be created from the default branch.</div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Release Title</label>
                        <input type="text" class="form-control" name="name" id="name"
                               placeholder="e.g. Version 1.0.0 - Initial Release">
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Release Notes</label>
                        <textarea class="form-control" name="body" id="body" rows="8"
                                  placeholder="Describe what's in this release (Markdown supported)..."></textarea>
                    </div>
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="prerelease" id="prerelease" value="1">
                            <label class="form-check-label" for="prerelease">
                                This is a pre-release
                                <span class="text-muted small">&mdash; Mark as not ready for production</span>
                            </label>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="<?= base_url("aw-cp/github/repo/{$owner}/{$repoName}"); ?>" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fa-solid fa-tag me-2"></i>Publish Release
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
