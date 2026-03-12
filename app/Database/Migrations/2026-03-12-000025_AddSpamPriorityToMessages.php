<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSpamPriorityToMessages extends Migration
{
    public function up()
    {
        $this->db->query('ALTER TABLE messages ADD COLUMN IF NOT EXISTS country VARCHAR(100)');
        $this->db->query('ALTER TABLE messages ADD COLUMN IF NOT EXISTS city VARCHAR(100)');
        $this->db->query('ALTER TABLE messages ADD COLUMN IF NOT EXISTS is_spam BOOLEAN NOT NULL DEFAULT false');
        $this->db->query('ALTER TABLE messages ADD COLUMN IF NOT EXISTS is_priority BOOLEAN NOT NULL DEFAULT false');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE messages DROP COLUMN IF EXISTS city');
        $this->db->query('ALTER TABLE messages DROP COLUMN IF EXISTS is_spam');
        $this->db->query('ALTER TABLE messages DROP COLUMN IF EXISTS is_priority');
    }
}
