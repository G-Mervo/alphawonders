<?php

namespace App\Models;

use CodeIgniter\Model;

class SocialMediaPostModel extends Model
{
    protected $table = 'social_media_posts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'blog_id', 'platform', 'content', 'hashtags', 'media_url', 'link_url',
        'video_script', 'status', 'scheduled_at', 'posted_at', 'platform_post_id',
        'ai_generated', 'notes', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = false;

    public function getPostsByBlogId(int $blogId)
    {
        return $this->where('blog_id', $blogId)
                     ->orderBy('created_at', 'DESC')
                     ->findAll();
    }

    public function getPostsByPlatform(string $platform)
    {
        return $this->where('platform', $platform)
                     ->orderBy('created_at', 'DESC')
                     ->findAll();
    }

    public function getRecentPosts(int $limit = 20)
    {
        return $this->orderBy('created_at', 'DESC')
                     ->limit($limit)
                     ->findAll();
    }

    public function getScheduledPostsDue()
    {
        return $this->where('status', 'scheduled')
                     ->where('scheduled_at <=', date('Y-m-d H:i:s'))
                     ->findAll();
    }

    public function getCountsByPlatform(): array
    {
        $platforms = ['twitter', 'facebook', 'linkedin', 'instagram', 'tiktok'];
        $counts = [];

        foreach ($platforms as $platform) {
            $counts[$platform] = [
                'draft'     => $this->where('platform', $platform)->where('status', 'draft')->countAllResults(false),
                'scheduled' => $this->where('platform', $platform)->where('status', 'scheduled')->countAllResults(false),
                'posted'    => $this->where('platform', $platform)->where('status', 'posted')->countAllResults(false),
                'total'     => $this->where('platform', $platform)->countAllResults(false),
            ];
        }

        return $counts;
    }

    public function getSocialScoreForPosts(array $blogIds): array
    {
        if (empty($blogIds)) {
            return [];
        }

        $results = $this->select('blog_id, COUNT(*) as count')
                        ->whereIn('blog_id', $blogIds)
                        ->groupBy('blog_id')
                        ->findAll();

        $map = [];
        foreach ($results as $row) {
            $map[$row['blog_id']] = (int) $row['count'];
        }

        return $map;
    }

    public function getAllFiltered(?string $platform = null, ?string $status = null)
    {
        $builder = $this->orderBy('created_at', 'DESC');

        if ($platform) {
            $builder->where('platform', $platform);
        }
        if ($status) {
            $builder->where('status', $status);
        }

        return $builder->findAll();
    }
}
