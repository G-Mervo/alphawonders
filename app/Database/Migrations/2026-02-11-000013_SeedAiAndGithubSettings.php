<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SeedAiAndGithubSettings extends Migration
{
    public function up()
    {
        $settings = [
            ['setting_key' => 'groq_api_key', 'setting_value' => '', 'updated_at' => date('Y-m-d H:i:s')],
            ['setting_key' => 'groq_model', 'setting_value' => 'llama-3.3-70b-versatile', 'updated_at' => date('Y-m-d H:i:s')],
            ['setting_key' => 'github_pat', 'setting_value' => '', 'updated_at' => date('Y-m-d H:i:s')],
        ];

        foreach ($settings as $setting) {
            $exists = $this->db->table('settings')->where('setting_key', $setting['setting_key'])->countAllResults();
            if (!$exists) {
                $this->db->table('settings')->insert($setting);
            }
        }
    }

    public function down()
    {
        $this->db->table('settings')->whereIn('setting_key', ['groq_api_key', 'groq_model', 'github_pat'])->delete();
    }
}
