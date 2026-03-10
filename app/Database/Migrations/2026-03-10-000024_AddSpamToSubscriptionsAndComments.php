<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSpamToSubscriptionsAndComments extends Migration
{
    public function up()
    {
        // Add is_spam to subscriptions (country already added by migration 000018)
        $this->forge->addColumn('subscriptions', [
            'is_spam' => [
                'type'    => 'BOOLEAN',
                'default' => false,
                'after'   => 'device',
            ],
        ]);

        // Add is_spam, admin_reply, and replied_at to posts_comments (country already added by migration 000018)
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
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('subscriptions', ['is_spam']);
        $this->forge->dropColumn('posts_comments', ['is_spam', 'admin_reply', 'replied_at']);
    }
}
