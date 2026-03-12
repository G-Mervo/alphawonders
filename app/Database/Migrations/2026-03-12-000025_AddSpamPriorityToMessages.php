<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSpamPriorityToMessages extends Migration
{
    public function up()
    {
        $this->forge->addColumn('messages', [
            'city' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'country',
            ],
            'is_spam' => [
                'type'    => 'BOOLEAN',
                'default' => false,
                'after'   => 'is_read',
            ],
            'is_priority' => [
                'type'    => 'BOOLEAN',
                'default' => false,
                'after'   => 'is_spam',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('messages', ['city', 'is_spam', 'is_priority']);
    }
}
