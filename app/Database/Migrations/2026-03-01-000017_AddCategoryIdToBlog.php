<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategoryIdToBlog extends Migration
{
    public function up()
    {
        $this->forge->addColumn('blog', [
            'category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'blog_category',
            ],
        ]);

        // Migrate existing blog_category slugs to category_id
        $categories = $this->db->table('blog_categories')->get()->getResultArray();
        $slugToId = [];
        foreach ($categories as $cat) {
            $slugToId[$cat['slug']] = $cat['id'];
        }

        $posts = $this->db->table('blog')->select('id, blog_category')->get()->getResultArray();
        foreach ($posts as $post) {
            if (!empty($post['blog_category']) && isset($slugToId[$post['blog_category']])) {
                $this->db->table('blog')
                    ->where('id', $post['id'])
                    ->update(['category_id' => $slugToId[$post['blog_category']]]);
            }
        }
    }

    public function down()
    {
        $this->forge->dropColumn('blog', 'category_id');
    }
}
