<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogTagModel extends Model
{
    protected $table = 'blog_tags';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug', 'created_at'];
    protected $useTimestamps = false;

    public function getTagsForPost(int $blogId): array
    {
        return $this->db->table('blog_tags t')
            ->select('t.*')
            ->join('blog_tag_map m', 'm.tag_id = t.id')
            ->where('m.blog_id', $blogId)
            ->orderBy('t.name', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function syncTagsForPost(int $blogId, string $tagsString): void
    {
        // Remove existing mappings
        $this->db->table('blog_tag_map')->where('blog_id', $blogId)->delete();

        if (empty(trim($tagsString))) {
            return;
        }

        $tagNames = array_map('trim', explode(',', $tagsString));
        $tagNames = array_filter($tagNames, fn($t) => $t !== '');

        foreach ($tagNames as $tagName) {
            $slug = url_title($tagName, '-', true);
            $tag = $this->where('slug', $slug)->first();

            if (!$tag) {
                $this->insert([
                    'name'       => $tagName,
                    'slug'       => $slug,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $tagId = $this->getInsertID();
            } else {
                $tagId = $tag['id'];
            }

            // Check for duplicate before inserting
            $exists = $this->db->table('blog_tag_map')
                ->where('blog_id', $blogId)
                ->where('tag_id', $tagId)
                ->countAllResults();

            if (!$exists) {
                $this->db->table('blog_tag_map')->insert([
                    'blog_id' => $blogId,
                    'tag_id'  => $tagId,
                ]);
            }
        }
    }

    public function getAllTagsWithPostCount(): array
    {
        return $this->db->table('blog_tags t')
            ->select('t.*, COUNT(m.blog_id) as post_count')
            ->join('blog_tag_map m', 'm.tag_id = t.id', 'left')
            ->groupBy('t.id')
            ->orderBy('t.name', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getPostIdsByTag(int $tagId): array
    {
        $rows = $this->db->table('blog_tag_map')
            ->select('blog_id')
            ->where('tag_id', $tagId)
            ->get()
            ->getResultArray();

        return array_column($rows, 'blog_id');
    }

    public function getTagsMapForPosts(array $postIds): array
    {
        if (empty($postIds)) {
            return [];
        }

        $rows = $this->db->table('blog_tags t')
            ->select('t.*, m.blog_id')
            ->join('blog_tag_map m', 'm.tag_id = t.id')
            ->whereIn('m.blog_id', $postIds)
            ->orderBy('t.name', 'ASC')
            ->get()
            ->getResultArray();

        $map = [];
        foreach ($rows as $row) {
            $map[$row['blog_id']][] = $row;
        }

        return $map;
    }
}
