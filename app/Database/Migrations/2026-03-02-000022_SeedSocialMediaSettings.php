<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SeedSocialMediaSettings extends Migration
{
    public function up()
    {
        $keys = [
            'social_instagram',
            'social_tiktok',
            'twitter_api_key',
            'twitter_api_secret',
            'facebook_page_token',
            'linkedin_access_token',
        ];

        foreach ($keys as $key) {
            $exists = $this->db->table('settings')->where('setting_key', $key)->countAllResults();
            if (!$exists) {
                $this->db->table('settings')->insert([
                    'setting_key'   => $key,
                    'setting_value' => '',
                    'updated_at'    => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }

    public function down()
    {
        $this->db->table('settings')->whereIn('setting_key', [
            'social_instagram', 'social_tiktok',
            'twitter_api_key', 'twitter_api_secret',
            'facebook_page_token', 'linkedin_access_token',
        ])->delete();
    }
}
