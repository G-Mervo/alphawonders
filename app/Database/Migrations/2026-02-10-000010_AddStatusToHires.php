<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToHires extends Migration
{
    public function up()
    {
        $this->forge->addColumn('hires', [
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'pending',
                'null'       => false,
                'after'      => 'timeline',
            ],
            'admin_notes' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'status',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('hires', ['status', 'admin_notes']);
    }
}
