<?php

namespace App\Controllers;

use App\Models\ContentCalendarModel;
use App\Models\AlphaBlogModel;
use App\Models\SocialMediaPostModel;

class ContentCalendar extends BaseController
{
    protected $calendarModel;
    protected $blogModel;
    protected $socialModel;

    public function __construct()
    {
        $this->calendarModel = new ContentCalendarModel();
        $this->blogModel = new AlphaBlogModel();
        $this->socialModel = new SocialMediaPostModel();
    }

    public function index()
    {
        try {
            $data['title'] = 'Content Calendar | Alphawonders';
            $year = (int) ($this->request->getGet('year') ?? date('Y'));
            $month = (int) ($this->request->getGet('month') ?? date('m'));

            $data['year'] = $year;
            $data['month'] = $month;
            $data['events'] = $this->getAggregatedEvents($year, $month);
            $data['upcoming'] = $this->calendarModel->getUpcoming(10);

            return view('dashboard/inc/header', $data) .
                   view('dashboard/calendar', $data) .
                   view('dashboard/inc/footer');
        } catch (\Throwable $e) {
            log_message('error', 'Calendar page failed: ' . $e->getMessage());
            return redirect()->to(base_url('aw-cp'))->with('error', 'Content Calendar encountered an error: ' . $e->getMessage());
        }
    }

    public function getEvents()
    {
        $year = (int) ($this->request->getGet('year') ?? date('Y'));
        $month = (int) ($this->request->getGet('month') ?? date('m'));

        $events = $this->getAggregatedEvents($year, $month);

        return $this->response->setJSON(['success' => true, 'events' => $events]);
    }

    public function addEvent()
    {
        $data = [
            'title'          => $this->request->getPost('title'),
            'content_type'   => $this->request->getPost('content_type') ?? 'campaign',
            'reference_id'   => $this->request->getPost('reference_id') ?: null,
            'platform'       => $this->request->getPost('platform') ?: null,
            'scheduled_date' => $this->request->getPost('scheduled_date'),
            'scheduled_time' => $this->request->getPost('scheduled_time') ?: null,
            'status'         => $this->request->getPost('status') ?? 'planned',
            'color'          => $this->request->getPost('color') ?? '#ff9800',
            'notes'          => $this->request->getPost('notes'),
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        if (empty($data['title']) || empty($data['scheduled_date'])) {
            return $this->response->setJSON(['success' => false, 'error' => 'Title and date are required.']);
        }

        $this->calendarModel->insert($data);
        $id = $this->calendarModel->getInsertID();

        return $this->response->setJSON(['success' => true, 'id' => $id, 'event' => array_merge($data, ['id' => $id])]);
    }

    public function updateEvent(int $id)
    {
        $event = $this->calendarModel->find($id);
        if (!$event) {
            return $this->response->setJSON(['success' => false, 'error' => 'Event not found.']);
        }

        $data = [
            'title'          => $this->request->getPost('title') ?? $event['title'],
            'content_type'   => $this->request->getPost('content_type') ?? $event['content_type'],
            'platform'       => $this->request->getPost('platform') ?: $event['platform'],
            'scheduled_date' => $this->request->getPost('scheduled_date') ?? $event['scheduled_date'],
            'scheduled_time' => $this->request->getPost('scheduled_time') ?: $event['scheduled_time'],
            'status'         => $this->request->getPost('status') ?? $event['status'],
            'color'          => $this->request->getPost('color') ?? $event['color'],
            'notes'          => $this->request->getPost('notes') ?? $event['notes'],
        ];

        $this->calendarModel->update($id, $data);
        return $this->response->setJSON(['success' => true, 'event' => array_merge($data, ['id' => $id])]);
    }

    public function deleteEvent(int $id)
    {
        $event = $this->calendarModel->find($id);
        if (!$event) {
            return redirect()->to(base_url('aw-cp/calendar'))->with('error', 'Event not found.');
        }

        $this->calendarModel->delete($id);
        return redirect()->to(base_url('aw-cp/calendar'))->with('success', 'Event deleted.');
    }

    /**
     * Aggregate manual calendar entries + scheduled blog posts + scheduled social posts
     */
    private function getAggregatedEvents(int $year, int $month): array
    {
        $events = [];

        // Manual calendar entries
        $calendarEvents = $this->calendarModel->getEventsForMonth($year, $month);
        foreach ($calendarEvents as $ce) {
            $events[] = [
                'id'        => 'cal-' . $ce['id'],
                'title'     => $ce['title'],
                'date'      => $ce['scheduled_date'],
                'time'      => $ce['scheduled_time'],
                'type'      => $ce['content_type'],
                'platform'  => $ce['platform'],
                'status'    => $ce['status'],
                'color'     => $ce['color'],
                'source'    => 'calendar',
                'source_id' => $ce['id'],
            ];
        }

        // Scheduled blog posts
        $startDate = sprintf('%04d-%02d-01', $year, $month);
        $endDate = date('Y-m-t', strtotime($startDate));

        $scheduledBlogs = $this->blogModel
            ->where('status', 'scheduled')
            ->where('scheduled_at >=', $startDate . ' 00:00:00')
            ->where('scheduled_at <=', $endDate . ' 23:59:59')
            ->findAll();

        foreach ($scheduledBlogs as $sb) {
            $events[] = [
                'id'        => 'blog-' . $sb['id'],
                'title'     => $sb['blog_title'],
                'date'      => date('Y-m-d', strtotime($sb['scheduled_at'])),
                'time'      => date('H:i', strtotime($sb['scheduled_at'])),
                'type'      => 'blog',
                'platform'  => null,
                'status'    => 'scheduled',
                'color'     => '#3788d8',
                'source'    => 'blog',
                'source_id' => $sb['id'],
            ];
        }

        // Scheduled social posts
        $scheduledSocial = $this->socialModel
            ->where('status', 'scheduled')
            ->where('scheduled_at >=', $startDate . ' 00:00:00')
            ->where('scheduled_at <=', $endDate . ' 23:59:59')
            ->findAll();

        foreach ($scheduledSocial as $ss) {
            $events[] = [
                'id'        => 'social-' . $ss['id'],
                'title'     => mb_substr(strip_tags($ss['content']), 0, 50),
                'date'      => date('Y-m-d', strtotime($ss['scheduled_at'])),
                'time'      => date('H:i', strtotime($ss['scheduled_at'])),
                'type'      => 'social',
                'platform'  => $ss['platform'],
                'status'    => 'scheduled',
                'color'     => '#28a745',
                'source'    => 'social',
                'source_id' => $ss['id'],
            ];
        }

        // Sort by date
        usort($events, fn($a, $b) => strcmp($a['date'] . ($a['time'] ?? ''), $b['date'] . ($b['time'] ?? '')));

        return $events;
    }
}
