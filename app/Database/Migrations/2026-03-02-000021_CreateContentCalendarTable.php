<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContentCalendarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'content_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'reference_id' => [
                'type'     => 'INT',
                'null'     => true,
            ],
            'platform' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'scheduled_date' => [
                'type' => 'DATE',
            ],
            'scheduled_time' => [
                'type'       => 'VARCHAR',
                'constraint' => 5,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'planned',
            ],
            'color' => [
                'type'       => 'VARCHAR',
                'constraint' => 7,
                'default'    => '#3788d8',
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('scheduled_date');
        $this->forge->addKey('content_type');
        $this->forge->createTable('content_calendar', true);
    }

    public function down()
    {
        $this->forge->dropTable('content_calendar', true);
    }
}
