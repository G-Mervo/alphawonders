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
                'after'      => 'phoneno',
            ],
            'is_read' => [
                'type'    => 'BOOLEAN',
                'default' => false,
                'null'    => false,
                'after'   => 'message',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('messages', ['subject', 'is_read']);
    }
}
