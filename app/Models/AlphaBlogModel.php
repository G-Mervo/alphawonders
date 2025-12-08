<?php

namespace App\Models;

use CodeIgniter\Model;

class AlphaBlogModel extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'image', 'url', 'time'];

    public function retrieveBlog()
    {
        try {
            $query = $this->db->table('blog')->orderBy('time', 'DESC')->limit(4)->get();
            $blogs = [];
            
            foreach ($query->getResultArray() as $row) {
                $blogs[] = $row;
            }
            
            return $blogs;
        } catch (\Exception $e) {
            // Return empty array if database error
            return [];
        }
    }

    public function insertComments($data)
    {
        return $this->db->table('posts_comments')->insert($data);
    }
}


