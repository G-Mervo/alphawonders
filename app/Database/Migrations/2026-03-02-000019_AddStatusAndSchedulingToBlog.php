<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusAndSchedulingToBlog extends Migration
{
    public function up()
    {
        $this->forge->addColumn('blog', [
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'published',
                'after'      => 'date_modified',
            ],
            'scheduled_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'after' => 'status',
            ],
            'published_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'after' => 'scheduled_at',
            ],
            'meta_description' => [
                'type'       => 'VARCHAR',
                'constraint' => 300,
                'null'       => true,
                'after'      => 'published_at',
            ],
        ]);

        // Backfill existing posts: set status=published, published_at=date_created
        $this->db->query("UPDATE blog SET status = 'published', published_at = date_created WHERE status IS NULL OR status = 'published'");
    }

    public function down()
    {
        $this->forge->dropColumn('blog', ['status', 'scheduled_at', 'published_at', 'meta_description']);
    }
}
