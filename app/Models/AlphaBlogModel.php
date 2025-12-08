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
        $query = $this->db->table('blog')->get();
        $blogs = [];
        
        foreach ($query->getResult() as $row) {
            $blogs[] = $row;
        }
        
        return $blogs;
    }

    public function insertComments($data)
    {
        return $this->db->table('posts_comments')->insert($data);
    }
}

