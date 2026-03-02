<?php

namespace App\Models;

use CodeIgniter\Model;

class AlphaBlogModel extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'blog_author', 'blog_title', 'blog_description', 'blog_image',
        'blog_url', 'blog_category', 'category_id', 'blog_id', 'date_created', 'date_modified',
        'status', 'scheduled_at', 'published_at', 'meta_description'
    ];
    protected $useTimestamps = false;

    public function getRecentPosts(int $perPage = 6)
    {
        return $this->orderBy('date_created', 'DESC')->paginate($perPage);
    }

    public function getPublishedPosts(int $perPage = 6)
    {
        return $this->where('status', 'published')
                     ->orderBy('published_at', 'DESC')
                     ->paginate($perPage);
    }

    public function getPostBySlug(string $slug)
    {
        return $this->where('blog_url', $slug)->first();
    }

    public function getPublishedPostBySlug(string $slug)
    {
        return $this->where('blog_url', $slug)
                     ->where('status', 'published')
                     ->first();
    }

    public function getPostById(int $id)
    {
        return $this->find($id);
    }

    public function getPostsByCategory(string $category, int $perPage = 6)
    {
        return $this->where('blog_category', $category)
                     ->orderBy('date_created', 'DESC')
                     ->paginate($perPage);
    }

    public function getScheduledPostsDue()
    {
        return $this->where('status', 'scheduled')
                     ->where('scheduled_at <=', date('Y-m-d H:i:s'))
                     ->findAll();
    }

    public function getDraftPosts()
    {
        return $this->where('status', 'draft')
                     ->orderBy('date_created', 'DESC')
                     ->findAll();
    }

    public function getScheduledPosts()
    {
        return $this->where('status', 'scheduled')
                     ->orderBy('scheduled_at', 'ASC')
                     ->findAll();
    }

    public function publishPost(int $id): bool
    {
        return $this->update($id, [
            'status'       => 'published',
            'published_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function getCommentsByPostId(int $postId)
    {
        return $this->db->table('posts_comments')
                        ->where('post_id', $postId)
                        ->orderBy('created_at', 'DESC')
                        ->get()
                        ->getResultArray();
    }

    public function insertComment(array $data)
    {
        return $this->db->table('posts_comments')->insert($data);
    }

    public function getPostsByCategoryId(int $categoryId, int $perPage = 6)
    {
        return $this->where('category_id', $categoryId)
                     ->orderBy('date_created', 'DESC')
                     ->paginate($perPage);
    }

    public function getPublishedPostsByCategoryId(int $categoryId, int $perPage = 6)
    {
        return $this->where('category_id', $categoryId)
                     ->where('status', 'published')
                     ->orderBy('published_at', 'DESC')
                     ->paginate($perPage);
    }

    public function getPublishedPostsByCategory(string $category, int $perPage = 6)
    {
        return $this->where('blog_category', $category)
                     ->where('status', 'published')
                     ->orderBy('published_at', 'DESC')
                     ->paginate($perPage);
    }

    public function getPublishedPostsByIds(array $ids, int $perPage = 6)
    {
        if (empty($ids)) {
            return [];
        }

        return $this->whereIn('id', $ids)
                     ->where('status', 'published')
                     ->orderBy('published_at', 'DESC')
                     ->paginate($perPage);
    }

    public function getPostsByIds(array $ids, int $perPage = 6)
    {
        if (empty($ids)) {
            return [];
        }

        return $this->whereIn('id', $ids)
                     ->orderBy('date_created', 'DESC')
                     ->paginate($perPage);
    }

    public function retrieveBlog()
    {
        return $this->where('status', 'published')
                     ->orderBy('published_at', 'DESC')
                     ->limit(4)
                     ->findAll();
    }
}
