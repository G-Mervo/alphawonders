<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostsCommentsTable extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('posts_comments')) {
            return;
        }

        $this->forge->addField([
            'comment_id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'post_id' => [
                'type' => 'INT',
            ],
            'commentee' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => 'guest',
            ],
            'comment' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'email_addr' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'phoneno' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'activity_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'browser_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'platform' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'referral' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'time' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'device' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addPrimaryKey('comment_id');
        $this->forge->createTable('posts_comments');
    }

    public function down()
    {
        $this->forge->dropTable('posts_comments', true);
    }
}
