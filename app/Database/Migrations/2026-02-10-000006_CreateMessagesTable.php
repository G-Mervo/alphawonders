<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('messages')) {
            return;
        }

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'email_addr' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'phoneno' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'message' => [
                'type' => 'VARCHAR',
                'constraint' => 1000,
            ],
            'activity_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'browser_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'platform' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'referral' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'device' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'null' => true,
            ],
            'time' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'modified_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('messages');
    }

    public function down()
    {
        $this->forge->dropTable('messages', true);
    }
}
