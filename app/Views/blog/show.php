<?php defined('FCPATH') OR exit('No direct script access is allowed'); ?>

<!-- Blog Post Hero -->
<section class="py-5 bg-primary text-white" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%); margin-top: 0; padding: 5rem 0;">
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-lg-8">
				<?php if (!empty($post['blog_category'])): ?>
					<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold"><?= esc($post['blog_category']); ?></span>
				<?php endif; ?>
				<h1 class="display-4 fw-bold mb-3"><?= esc($post['blog_title']); ?></h1>
				<p class="lead mb-0">
					<i class="fas fa-user me-1"></i> by <?= esc($post['blog_author']); ?>
					<span class="ms-3"><i class="fas fa-clock me-1"></i> <?= date('F d, Y', strtotime($post['date_created'])); ?></span>
				</p>
			</div>
		</div>
	</div>
</section>

<!-- Blog Post Content -->
<section class="py-5">
	<div class="container">
		<div class="row g-4">
			<div class="col-lg-8">
				<article class="card border-0 shadow-sm">
					<div class="card-body p-4 p-md-5">
						<?php if (!empty($post['blog_image'])): ?>
							<img src="<?= base_url($post['blog_image']); ?>" class="img-fluid rounded mb-4 w-100" alt="<?= esc($post['blog_title']); ?>" style="max-height: 400px; object-fit: cover;" onerror="this.onerror=null; this.src='<?= base_url('assets/img/qtmcomp.jpg'); ?>';">
						<?php endif; ?>

						<div class="blog-content" style="line-height: 1.8; font-size: 1.05rem;">
							<?= $post['blog_description']; ?>
						</div>
					</div>
				</article>

				<!-- Comments Section -->
				<div class="card border-0 shadow-sm mt-4">
					<div class="card-body p-4">
						<h4 class="fw-bold mb-4">
							<i class="fas fa-comments text-primary me-2"></i>Comments (<?= count($comments); ?>)
						</h4>

						<!-- Comment Form -->
						<form action="<?= base_url('blog/comment'); ?>" method="post" class="mb-4">
							<input type="hidden" name="post_id" value="<?= esc($post['id']); ?>">
							<input type="hidden" name="post_slug" value="<?= esc($post['blog_url']); ?>">
							<div class="mb-3">
								<label for="commentee" class="form-label">Name</label>
								<input type="text" class="form-control" id="commentee" name="commentee" placeholder="Your name (optional)">
							</div>
							<div class="mb-3">
								<label for="comm-sct" class="form-label">Your Comment</label>
								<textarea class="form-control" id="comm-sct" name="comm-sct" rows="3" required placeholder="Write your comment..."></textarea>
							</div>
							<button type="submit" class="btn btn-primary rounded-pill px-4">
								<i class="fas fa-paper-plane me-2"></i>Submit Comment
							</button>
						</form>

						<hr>

						<!-- Display Comments -->
						<?php if (!empty($comments)): ?>
							<?php foreach ($comments as $comment): ?>
								<div class="d-flex mb-3 pb-3 border-bottom">
									<div class="flex-shrink-0">
										<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
											<i class="fas fa-user text-primary"></i>
										</div>
									</div>
									<div class="flex-grow-1 ms-3">
										<h6 class="fw-bold mb-1">
											<?= esc($comment['commentee']); ?>
											<small class="text-muted fw-normal ms-2"><?= date('M d, Y \a\t h:i A', strtotime($comment['created_at'])); ?></small>
										</h6>
										<p class="mb-0"><?= esc($comment['comment']); ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<p class="text-muted">No comments yet. Be the first to comment!</p>
						<?php endif; ?>
					</div>
				</div>

				<!-- Back to Blog -->
				<div class="mt-4">
					<a href="<?= base_url('blog'); ?>" class="btn btn-outline-primary rounded-pill">
						<i class="fas fa-arrow-left me-2"></i>Back to Blog
					</a>
				</div>
			</div>

			<!-- Sidebar -->
			<div class="col-lg-4">
				<?= view('blog/_sidebar'); ?>
			</div>
		</div>
	</div>
</section>

<style>
.blog-content h1, .blog-content h2, .blog-content h3,
.blog-content h4, .blog-content h5, .blog-content h6 {
	margin-top: 1.5rem;
	margin-bottom: 0.75rem;
	font-weight: bold;
}

.blog-content p {
	margin-bottom: 1rem;
}

.blog-content img {
	max-width: 100%;
	height: auto;
	border-radius: 0.5rem;
}

.blog-content blockquote {
	border-left: 4px solid #ffb000;
	padding: 1rem 1.5rem;
	margin: 1.5rem 0;
	background: #f8f9fa;
	border-radius: 0 0.5rem 0.5rem 0;
	font-style: italic;
}
</style>
