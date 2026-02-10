<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SeedAdminUser extends Migration
{
    public function up()
    {
        $this->db->table('admin_users')->insert([
            'username'      => 'admin',
            'email'         => 'mervin@alphawonders.com',
            'password_hash' => password_hash('changeme123', PASSWORD_DEFAULT),
            'full_name'     => 'Mervin Gaitho',
            'role'          => 'admin',
            'is_active'     => true,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->db->table('admin_users')->where('username', 'admin')->delete();
    }
}
