<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSpamToSubscriptionsAndComments extends Migration
{
    public function up()
    {
        // Add is_spam and country to subscriptions
        $this->forge->addColumn('subscriptions', [
            'is_spam' => [
                'type'    => 'BOOLEAN',
                'default' => false,
                'after'   => 'device',
            ],
            'country' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'ip_address',
            ],
        ]);

        // Add is_spam, admin_reply, and replied_at to posts_comments
        $this->forge->addColumn('posts_comments', [
            'is_spam' => [
                'type'    => 'BOOLEAN',
                'default' => false,
                'after'   => 'device',
            ],
            'admin_reply' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'is_spam',
            ],
            'replied_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'after' => 'admin_reply',
            ],
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
        $this->forge->dropColumn('subscriptions', ['is_spam', 'country']);
        $this->forge->dropColumn('posts_comments', ['is_spam', 'admin_reply', 'replied_at', 'country']);
    }
}
