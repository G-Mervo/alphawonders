<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSpamPriorityToMessages extends Migration
{
    public function up()
    {
        $fields = [];

        // Add country if it doesn't exist (was being saved by controller already)
        if (!$this->db->fieldExists('country', 'messages')) {
            $fields['country'] = [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ];
        }

        // City for geo-IP lookup
        if (!$this->db->fieldExists('city', 'messages')) {
            $fields['city'] = [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ];
        }

        // Spam flag
        if (!$this->db->fieldExists('is_spam', 'messages')) {
            $fields['is_spam'] = [
                'type'    => 'BOOLEAN',
                'default' => false,
                'null'    => false,
            ];
        }

        // Priority flag
        if (!$this->db->fieldExists('is_priority', 'messages')) {
            $fields['is_priority'] = [
                'type'    => 'BOOLEAN',
                'default' => false,
                'null'    => false,
            ];
        }

        if (!empty($fields)) {
            $this->forge->addColumn('messages', $fields);
        }
    }

    public function down()
    {
        $columns = [];
        foreach (['city', 'is_spam', 'is_priority'] as $col) {
            if ($this->db->fieldExists($col, 'messages')) {
                $columns[] = $col;
            }
        }
        if (!empty($columns)) {
            $this->forge->dropColumn('messages', $columns);
        }
    }
}
