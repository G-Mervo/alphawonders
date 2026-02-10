<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHiresTable extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('hires')) {
            return;
        }

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'tel' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'skype' => [
                'type' => 'VARCHAR',
                'constraint' => 70,
                'null' => true,
            ],
            'whatsapp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'client' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'work' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'nature' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'budget' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'company_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'industry' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'timeline' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
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
            'time' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'device' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'null' => true,
            ],
            'date_created' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'date_modified' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('hires');
    }

    public function down()
    {
        $this->forge->dropTable('hires', true);
    }
}
