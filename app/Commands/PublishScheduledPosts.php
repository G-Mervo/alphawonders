<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\AlphaBlogModel;

class PublishScheduledPosts extends BaseCommand
{
    protected $group       = 'Content';
    protected $name        = 'content:publish-scheduled';
    protected $description = 'Publishes blog posts that are scheduled and past their scheduled time.';

    public function run(array $params)
    {
        $blogModel = new AlphaBlogModel();
        $posts = $blogModel->getScheduledPostsDue();

        if (empty($posts)) {
            CLI::write('No scheduled posts due for publishing.', 'yellow');
            return;
        }

        $count = 0;
        foreach ($posts as $post) {
            $blogModel->publishPost((int) $post['id']);
            CLI::write("Published: {$post['blog_title']}", 'green');
            $count++;
        }

        CLI::write("{$count} post(s) published successfully.", 'green');
    }
}
