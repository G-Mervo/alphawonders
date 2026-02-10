<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'setting_key' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'setting_value' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('settings', true);

        // Seed default settings
        $defaults = [
            ['setting_key' => 'google_analytics_id', 'setting_value' => '', 'updated_at' => date('Y-m-d H:i:s')],
            ['setting_key' => 'google_search_console_meta', 'setting_value' => '', 'updated_at' => date('Y-m-d H:i:s')],
            ['setting_key' => 'site_name', 'setting_value' => 'Alphawonders', 'updated_at' => date('Y-m-d H:i:s')],
            ['setting_key' => 'site_description', 'setting_value' => 'Providing ICT Expertise & Services', 'updated_at' => date('Y-m-d H:i:s')],
            ['setting_key' => 'contact_email', 'setting_value' => 'mervin@alphawonders.com', 'updated_at' => date('Y-m-d H:i:s')],
            ['setting_key' => 'social_facebook', 'setting_value' => 'https://www.facebook.com/pg/alphawonders', 'updated_at' => date('Y-m-d H:i:s')],
            ['setting_key' => 'social_twitter', 'setting_value' => 'https://twitter.com/Alphawondersltd', 'updated_at' => date('Y-m-d H:i:s')],
            ['setting_key' => 'social_linkedin', 'setting_value' => 'https://ke.linkedin.com/company/alphawonders', 'updated_at' => date('Y-m-d H:i:s')],
        ];

        foreach ($defaults as $setting) {
            $this->db->table('settings')->insert($setting);
        }
    }

    public function down()
    {
        $this->forge->dropTable('settings', true);
    }
}
