<?php

namespace App\Models;

use CodeIgniter\Model;

class AlphaWModel extends Model
{
    protected $table = 'subscriptions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'activity_name', 'browser_name', 'ip_address', 'platform', 'referral', 'device', 'time'];

    protected $tableHires = 'hires';
    protected $tableMessages = 'messages';

    public function insertSubscr($data)
    {
        return $this->db->table('subscriptions')->insert($data);
    }

    public function hires($data)
    {
        return $this->db->table('hires')->insert($data);
    }

    public function saveMessage($data)
    {
        return $this->db->table('messages')->insert($data);
    }
}


