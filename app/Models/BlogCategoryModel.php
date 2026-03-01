<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogCategoryModel extends Model
{
    protected $table = 'blog_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'slug', 'created_at'];
    protected $useTimestamps = false;

    public function getAllCategories()
    {
        return $this->orderBy('name', 'ASC')->findAll();
    }

    public function getCategoryBySlug(string $slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getCategoriesWithPostCount()
    {
        return $this->db->table('blog_categories c')
            ->select('c.*, COUNT(b.id) as post_count')
            ->join('blog b', 'b.category_id = c.id', 'left')
            ->groupBy('c.id')
            ->orderBy('c.name', 'ASC')
            ->get()
            ->getResultArray();
    }
}
