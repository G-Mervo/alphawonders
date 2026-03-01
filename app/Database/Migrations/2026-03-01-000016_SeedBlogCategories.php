<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SeedBlogCategories extends Migration
{
    public function up()
    {
        $categories = [
            ['name' => 'Machine Learning',        'slug' => 'machine-learning'],
            ['name' => 'Artificial Intelligence',  'slug' => 'artificial-intelligence'],
            ['name' => 'Robotics',                 'slug' => 'robotics'],
            ['name' => 'Quantum Computing',        'slug' => 'quantum-computing'],
            ['name' => 'Digital Marketing',        'slug' => 'digital-marketing'],
            ['name' => 'Blockchain Technology',    'slug' => 'blockchain'],
            ['name' => 'Internet of Things',       'slug' => 'iot'],
            ['name' => 'Cyber Security',           'slug' => 'cyber-security'],
            ['name' => 'Data Science',             'slug' => 'data-science'],
            ['name' => 'Trends in Technology',     'slug' => 'trends-technology'],
        ];

        $now = date('Y-m-d H:i:s');

        foreach ($categories as $cat) {
            $this->db->table('blog_categories')->insert([
                'name'       => $cat['name'],
                'slug'       => $cat['slug'],
                'created_at' => $now,
            ]);
        }
    }

    public function down()
    {
        $this->db->table('blog_categories')->truncate();
    }
}
