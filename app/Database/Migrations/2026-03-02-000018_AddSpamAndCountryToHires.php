<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSpamAndCountryToHires extends Migration
{
    public function up()
    {
        // Add spam/country fields to hires
        $this->forge->addColumn('hires', [
            'is_spam' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
                'after'      => 'admin_notes',
            ],
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'ip_address',
            ],
        ]);

        // Add country field to messages table too
        $this->forge->addColumn('messages', [
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'ip_address',
            ],
        ]);

        // Add country field to posts_comments table
        $this->forge->addColumn('posts_comments', [
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'ip_address',
            ],
        ]);

        // Add country field to subscriptions table
        $this->forge->addColumn('subscriptions', [
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'ip_address',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('hires', ['is_spam', 'country']);
        $this->forge->dropColumn('messages', 'country');
        $this->forge->dropColumn('posts_comments', 'country');
        $this->forge->dropColumn('subscriptions', 'country');
    }
}
