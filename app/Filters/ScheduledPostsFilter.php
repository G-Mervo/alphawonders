<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Fallback auto-publisher for scheduled blog posts.
 * Runs on public page requests but throttled to once per minute via file cache.
 * Primary publishing is handled by the scheduler Docker container running
 * `php spark content:publish-scheduled` every 60 seconds.
 * This filter acts as a safety net in case the scheduler container is down.
 */
class ScheduledPostsFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Throttle: only check once per 60 seconds using a simple lock file
        $lockFile = WRITEPATH . 'cache/scheduled_posts_check.lock';

        if (file_exists($lockFile) && (time() - filemtime($lockFile)) < 60) {
            return; // Checked less than 60 seconds ago, skip
        }

        // Update lock file timestamp
        @file_put_contents($lockFile, time());

        try {
            $blogModel = new \App\Models\AlphaBlogModel();
            $duePosts = $blogModel->getScheduledPostsDue();

            foreach ($duePosts as $post) {
                $blogModel->publishPost((int) $post['id']);
                log_message('info', 'Auto-published scheduled post: ' . ($post['blog_title'] ?? $post['id']));
            }
        } catch (\Exception $e) {
            log_message('error', 'ScheduledPostsFilter error: ' . $e->getMessage());
        }

        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return;
    }
}
