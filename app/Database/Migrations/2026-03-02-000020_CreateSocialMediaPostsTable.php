<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSocialMediaPostsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'blog_id' => [
                'type'     => 'INT',
                'null'     => true,
            ],
            'platform' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'content' => [
                'type' => 'TEXT',
            ],
            'hashtags' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'media_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'link_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
            ],
            'video_script' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'draft',
            ],
            'scheduled_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'posted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'platform_post_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'ai_generated' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('blog_id');
        $this->forge->addKey('platform');
        $this->forge->addKey('status');
        $this->forge->createTable('social_media_posts', true);
    }

    public function down()
    {
        $this->forge->dropTable('social_media_posts', true);
    }
}
