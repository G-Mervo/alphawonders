<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSubjectToMessages extends Migration
{
    public function up()
    {
        $this->forge->addColumn('messages', [
            'subject' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'is_read' => [
                'type'    => 'BOOLEAN',
                'default' => false,
                'null'    => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('messages', ['subject', 'is_read']);
    }
}
