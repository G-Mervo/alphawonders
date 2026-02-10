<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlogTable extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('blog')) {
            // Add blog_category column if it doesn't exist
            if (!$this->db->fieldExists('blog_category', 'blog')) {
                $this->forge->addColumn('blog', [
                    'blog_category' => [
                        'type' => 'VARCHAR',
                        'constraint' => 100,
                        'null' => true,
                        'default' => null,
                    ],
                ]);
            }
            return;
        }

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'blog_author' => [
                'type' => 'VARCHAR',
                'constraint' => 70,
            ],
            'blog_description' => [
                'type' => 'TEXT',
            ],
            'blog_id' => [
                'type' => 'INT',
            ],
            'blog_image' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'blog_title' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'blog_url' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'blog_category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'default' => null,
            ],
            'date_created' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'date_modified' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('blog');
    }

    public function down()
    {
        $this->forge->dropTable('blog', true);
    }
}
