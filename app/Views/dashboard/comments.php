<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h3 class="fw-bold mb-0">Blog Comments</h3>
</div>

<?php if (session()->getFlashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<?= session()->getFlashdata('success'); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<?= session()->getFlashdata('error'); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>

<!-- Filter Tabs -->
<ul class="nav nav-pills mb-3">
	<li class="nav-item">
		<a class="nav-link <?= $currentFilter === 'all' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/comments'); ?>">
			All <span class="badge bg-secondary ms-1"><?= $totalAll; ?></span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= $currentFilter === 'unreplied' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/comments?filter=unreplied'); ?>">
			Needs Reply <span class="badge bg-warning text-dark ms-1"><?= $totalUnreplied; ?></span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= $currentFilter === 'replied' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/comments?filter=replied'); ?>">
			Replied <span class="badge bg-success ms-1"><?= $totalReplied; ?></span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= $currentFilter === 'spam' ? 'active' : ''; ?>" href="<?= base_url('aw-cp/comments?filter=spam'); ?>">
			Spam <span class="badge bg-danger ms-1"><?= $totalSpam; ?></span>
		</a>
	</li>
</ul>

<!-- Comments List -->
<?php if (!empty($comments)): ?>
	<?php foreach ($comments as $comment): ?>
		<div class="card border-0 shadow-sm mb-3 <?= !empty($comment['is_spam']) ? 'border-start border-danger border-3' : ''; ?>">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-start">
					<div class="d-flex align-items-start">
						<div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
							<i class="fa-solid fa-user text-primary"></i>
						</div>
						<div class="ms-3">
							<h6 class="fw-bold mb-0">
								<?= esc($comment['commentee']); ?>
								<?php if (!empty($comment['is_spam'])): ?>
									<span class="badge bg-danger ms-1">Spam</span>
								<?php endif; ?>
							</h6>
							<small class="text-muted">
								<?= date('M d, Y \a\t h:i A', strtotime($comment['created_at'])); ?>
								&middot; IP: <code><?= esc($comment['ip_address'] ?? '-'); ?></code>
								<?php if (!empty($comment['country'])): ?>
									&middot; <?= esc($comment['country']); ?>
								<?php endif; ?>
							</small>
						</div>
					</div>
					<div class="text-nowrap">
						<a href="<?= base_url('aw-cp/comments/spam/' . $comment['comment_id']); ?>" class="btn btn-sm btn-outline-warning" title="<?= !empty($comment['is_spam']) ? 'Restore' : 'Mark Spam'; ?>">
							<i class="fa-solid fa-<?= !empty($comment['is_spam']) ? 'check' : 'ban'; ?>"></i>
						</a>
						<a href="<?= base_url('aw-cp/comments/delete/' . $comment['comment_id']); ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Delete this comment permanently?');">
							<i class="fa-solid fa-trash"></i>
						</a>
					</div>
				</div>

				<!-- Post link -->
				<?php if (!empty($comment['blog_title'])): ?>
					<div class="mt-2">
						<small class="text-muted">
							On: <a href="<?= base_url('blog/' . esc($comment['blog_url'])); ?>" target="_blank" class="text-decoration-none">
								<?= esc($comment['blog_title']); ?> <i class="fa-solid fa-arrow-up-right-from-square fa-xs"></i>
							</a>
						</small>
					</div>
				<?php endif; ?>

				<!-- Comment text -->
				<div class="mt-2 p-3 bg-light rounded">
					<?= esc($comment['comment']); ?>
				</div>

				<!-- Admin reply -->
				<?php if (!empty($comment['admin_reply'])): ?>
					<div class="mt-2 ms-4 p-3 bg-primary bg-opacity-10 rounded">
						<small class="fw-bold text-primary"><i class="fa-solid fa-reply me-1"></i> Admin Reply</small>
						<small class="text-muted ms-2"><?= date('M d, Y \a\t h:i A', strtotime($comment['replied_at'])); ?></small>
						<p class="mb-0 mt-1"><?= esc($comment['admin_reply']); ?></p>
					</div>
				<?php endif; ?>

				<!-- Reply form -->
				<?php if (empty($comment['is_spam'])): ?>
					<div class="mt-3">
						<button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#reply-<?= $comment['comment_id']; ?>">
							<i class="fa-solid fa-reply me-1"></i> <?= !empty($comment['admin_reply']) ? 'Update Reply' : 'Reply'; ?>
						</button>
						<div class="collapse mt-2" id="reply-<?= $comment['comment_id']; ?>">
							<form method="post" action="<?= base_url('aw-cp/comments/reply/' . $comment['comment_id']); ?>">
								<div class="input-group">
									<textarea class="form-control" name="admin_reply" rows="2" placeholder="Write your reply..." required><?= esc($comment['admin_reply'] ?? ''); ?></textarea>
									<button type="submit" class="btn btn-primary">
										<i class="fa-solid fa-paper-plane"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<div class="card border-0 shadow-sm">
		<div class="card-body text-center py-5 text-muted">
			No comments found.
		</div>
	</div>
<?php endif; ?>
