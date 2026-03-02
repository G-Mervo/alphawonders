<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentCalendarModel extends Model
{
    protected $table = 'content_calendar';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'content_type', 'reference_id', 'platform',
        'scheduled_date', 'scheduled_time', 'status', 'color', 'notes', 'created_at'
    ];
    protected $useTimestamps = false;

    public function getEventsForMonth(int $year, int $month): array
    {
        $startDate = sprintf('%04d-%02d-01', $year, $month);
        $endDate = date('Y-m-t', strtotime($startDate));

        return $this->where('scheduled_date >=', $startDate)
                     ->where('scheduled_date <=', $endDate)
                     ->orderBy('scheduled_date', 'ASC')
                     ->orderBy('scheduled_time', 'ASC')
                     ->findAll();
    }

    public function getUpcoming(int $limit = 10): array
    {
        return $this->where('scheduled_date >=', date('Y-m-d'))
                     ->where('status !=', 'cancelled')
                     ->orderBy('scheduled_date', 'ASC')
                     ->orderBy('scheduled_time', 'ASC')
                     ->limit($limit)
                     ->findAll();
    }
}
