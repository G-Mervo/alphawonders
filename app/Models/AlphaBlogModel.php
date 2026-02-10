<?php

namespace App\Models;

use CodeIgniter\Model;

class AlphaBlogModel extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'blog_author', 'blog_title', 'blog_description', 'blog_image',
        'blog_url', 'blog_category', 'blog_id', 'date_created', 'date_modified'
    ];
    protected $useTimestamps = false;

    public function getRecentPosts(int $perPage = 6)
    {
        return $this->orderBy('date_created', 'DESC')->paginate($perPage);
    }

    public function getPostBySlug(string $slug)
    {
        return $this->where('blog_url', $slug)->first();
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

    public function retrieveBlog()
    {
        return $this->orderBy('date_created', 'DESC')->limit(4)->findAll();
    }
}
