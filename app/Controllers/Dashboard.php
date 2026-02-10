<?php

namespace App\Controllers;

use App\Models\AlphaBlogModel;

class Dashboard extends BaseController
{
    protected $alphaBlogModel;
    protected $db;

    public function __construct()
    {
        $this->alphaBlogModel = new AlphaBlogModel();
        $this->db = \Config\Database::connect();
    }

    public function admin()
    {
        $data['title'] = 'Dashboard | Alphawonders';
        $data['blogCount'] = $this->db->table('blog')->countAllResults();
        $data['messagesCount'] = $this->db->table('messages')->countAllResults();
        $data['commentsCount'] = $this->db->table('posts_comments')->countAllResults();
        $data['subscribersCount'] = $this->db->table('subscriptions')->countAllResults();
        $data['hiresCount'] = $this->db->table('hires')->countAllResults();
        $data['recentPosts'] = $this->alphaBlogModel->orderBy('date_created', 'DESC')->findAll(5);

        // Hires by status
        $data['pendingHires'] = $this->db->table('hires')->where('status', 'pending')->countAllResults();
        $data['ongoingHires'] = $this->db->table('hires')->where('status', 'ongoing')->countAllResults();
        $data['completedHires'] = $this->db->table('hires')->where('status', 'completed')->countAllResults();

        // Recent hires
        $data['recentHires'] = $this->db->table('hires')->orderBy('date_created', 'DESC')->limit(5)->get()->getResultArray();

        // Unread messages
        $data['unreadMessages'] = $this->db->table('messages')->where('is_read', false)->countAllResults();

        return view('dashboard/inc/header', $data) .
               view('dashboard/index', $data) .
               view('dashboard/inc/footer');
    }

    public function services()
    {
        $data['title'] = 'Services Management | Alphawonders';
        $data['services'] = [
            ['name' => 'Software Development', 'icon' => 'fa-code', 'route' => 'softwares', 'color' => 'primary', 'desc' => 'Custom software solutions, enterprise apps, SaaS platforms'],
            ['name' => 'Web Development', 'icon' => 'fa-globe', 'route' => 'softwares', 'color' => 'success', 'desc' => 'Responsive websites, web apps, e-commerce solutions'],
            ['name' => 'System Administration', 'icon' => 'fa-server', 'route' => 'system-administration', 'color' => 'info', 'desc' => 'Server setup, cloud infrastructure, DevOps'],
            ['name' => 'UI/UX Design', 'icon' => 'fa-palette', 'route' => 'design', 'color' => 'warning', 'desc' => 'User interfaces, branding, graphic design'],
            ['name' => 'Digital Marketing', 'icon' => 'fa-bullhorn', 'route' => 'digital-marketing', 'color' => 'danger', 'desc' => 'SEO, social media, content marketing, PPC'],
            ['name' => 'ICT Consultancy', 'icon' => 'fa-handshake', 'route' => 'ict-consultancy', 'color' => 'secondary', 'desc' => 'IT strategy, digital transformation, tech advisory'],
            ['name' => 'IT Support', 'icon' => 'fa-headset', 'route' => 'it-support', 'color' => 'dark', 'desc' => 'Help desk, maintenance, troubleshooting'],
            ['name' => 'AI Services', 'icon' => 'fa-robot', 'route' => 'ai-services', 'color' => 'primary', 'desc' => 'Machine learning, automation, data analytics'],
        ];

        // Count hires per service
        foreach ($data['services'] as &$service) {
            $service['hire_count'] = $this->db->table('hires')
                ->like('work', str_replace(['UI/UX ', 'ICT ', 'IT '], '', $service['name']), 'both')
                ->countAllResults();
        }

        return view('dashboard/inc/header', $data) .
               view('dashboard/services', $data) .
               view('dashboard/inc/footer');
    }

    public function messages()
    {
        $data['title'] = 'Messages | Alphawonders';
        $data['messages'] = $this->db->table('messages')->orderBy('id', 'DESC')->get()->getResultArray();

        return view('dashboard/inc/header', $data) .
               view('dashboard/messages', $data) .
               view('dashboard/inc/footer');
    }

    public function messageToggleRead(int $id)
    {
        $msg = $this->db->table('messages')->where('id', $id)->get()->getRowArray();
        if ($msg) {
            $this->db->table('messages')->where('id', $id)->update(['is_read' => !$msg['is_read']]);
        }
        return redirect()->to(base_url('aw-cp/messages'));
    }

    public function messageDelete(int $id)
    {
        $this->db->table('messages')->where('id', $id)->delete();
        return redirect()->to(base_url('aw-cp/messages'))->with('success', 'Message deleted.');
    }

    // Hires Management
    public function hires()
    {
        $data['title'] = 'Projects & Hires | Alphawonders';

        $status = $this->request->getGet('status');
        $query = $this->db->table('hires')->orderBy('date_created', 'DESC');
        if ($status && in_array($status, ['pending', 'ongoing', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }
        $data['hires'] = $query->get()->getResultArray();
        $data['currentStatus'] = $status ?: 'all';

        // Counts
        $data['allCount'] = $this->db->table('hires')->countAllResults();
        $data['pendingCount'] = $this->db->table('hires')->where('status', 'pending')->countAllResults();
        $data['ongoingCount'] = $this->db->table('hires')->where('status', 'ongoing')->countAllResults();
        $data['completedCount'] = $this->db->table('hires')->where('status', 'completed')->countAllResults();
        $data['cancelledCount'] = $this->db->table('hires')->where('status', 'cancelled')->countAllResults();

        return view('dashboard/inc/header', $data) .
               view('dashboard/hires', $data) .
               view('dashboard/inc/footer');
    }

    public function hireView(int $id)
    {
        $data['title'] = 'Project Details | Alphawonders';
        $data['hire'] = $this->db->table('hires')->where('id', $id)->get()->getRowArray();

        if (!$data['hire']) {
            return redirect()->to(base_url('aw-cp/hires'))->with('error', 'Project not found.');
        }

        return view('dashboard/inc/header', $data) .
               view('dashboard/hire_detail', $data) .
               view('dashboard/inc/footer');
    }

    public function hireUpdateStatus(int $id)
    {
        $status = $this->request->getPost('status');
        $notes = $this->request->getPost('admin_notes');

        if (!in_array($status, ['pending', 'ongoing', 'completed', 'cancelled'])) {
            return redirect()->to(base_url('aw-cp/hires/view/' . $id))->with('error', 'Invalid status.');
        }

        $this->db->table('hires')->where('id', $id)->update([
            'status'       => $status,
            'admin_notes'  => $notes,
            'date_modified' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('aw-cp/hires/view/' . $id))->with('success', 'Project updated.');
    }

    public function blog()
    {
        $data['title'] = 'Blog Management | Alphawonders';
        $data['posts'] = $this->alphaBlogModel->orderBy('date_created', 'DESC')->findAll();

        return view('dashboard/inc/header', $data) .
               view('dashboard/blog', $data) .
               view('dashboard/inc/footer');
    }

    public function blogCreate()
    {
        $data['title'] = 'Create Blog Post | Alphawonders';
        $data['post'] = null;

        return view('dashboard/inc/header', $data) .
               view('dashboard/blog_form', $data) .
               view('dashboard/inc/footer');
    }

    public function blogSave()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'blog_title' => 'required|min_length[3]',
            'blog_url' => 'required|min_length[3]',
            'blog_author' => 'required',
            'blogtxtarea' => 'required',
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->to(base_url('aw-cp/blog/create'))->withInput()->with('errors', $validation->getErrors());
        }

        $slug = url_title($this->request->getPost('blog_url'), '-', true);

        $imageFile = $this->request->getFile('blog_image');
        $imagePath = 'assets/img/blog/default.jpg';

        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $slug . '-' . time() . '.' . $imageFile->getExtension();
            $uploadPath = FCPATH . 'assets/img/blog';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $imageFile->move($uploadPath, $newName);
            $imagePath = 'assets/img/blog/' . $newName;
        }

        $data = [
            'blog_author' => $this->request->getPost('blog_author'),
            'blog_title' => $this->request->getPost('blog_title'),
            'blog_url' => $slug,
            'blog_description' => $this->request->getPost('blogtxtarea'),
            'blog_image' => $imagePath,
            'blog_category' => $this->request->getPost('blog_category') ?: null,
            'blog_id' => time(),
            'date_created' => date('Y-m-d H:i:s'),
        ];

        if ($this->alphaBlogModel->insert($data)) {
            return redirect()->to(base_url('aw-cp/blog'))->with('success', 'Blog post created successfully!');
        }

        return redirect()->to(base_url('aw-cp/blog/create'))->with('error', 'Failed to create blog post.');
    }

    public function blogEdit(int $id)
    {
        $data['title'] = 'Edit Blog Post | Alphawonders';
        $data['post'] = $this->alphaBlogModel->getPostById($id);

        if (!$data['post']) {
            return redirect()->to(base_url('aw-cp/blog'))->with('error', 'Post not found.');
        }

        return view('dashboard/inc/header', $data) .
               view('dashboard/blog_form', $data) .
               view('dashboard/inc/footer');
    }

    public function blogUpdate(int $id)
    {
        $post = $this->alphaBlogModel->getPostById($id);
        if (!$post) {
            return redirect()->to(base_url('aw-cp/blog'))->with('error', 'Post not found.');
        }

        $validation = \Config\Services::validation();

        $validation->setRules([
            'blog_title' => 'required|min_length[3]',
            'blog_url' => 'required|min_length[3]',
            'blog_author' => 'required',
            'blogtxtarea' => 'required',
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->to(base_url('aw-cp/blog/edit/' . $id))->withInput()->with('errors', $validation->getErrors());
        }

        $slug = url_title($this->request->getPost('blog_url'), '-', true);

        $data = [
            'blog_author' => $this->request->getPost('blog_author'),
            'blog_title' => $this->request->getPost('blog_title'),
            'blog_url' => $slug,
            'blog_description' => $this->request->getPost('blogtxtarea'),
            'blog_category' => $this->request->getPost('blog_category') ?: null,
        ];

        $imageFile = $this->request->getFile('blog_image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $slug . '-' . time() . '.' . $imageFile->getExtension();
            $uploadPath = FCPATH . 'assets/img/blog';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $imageFile->move($uploadPath, $newName);
            $data['blog_image'] = 'assets/img/blog/' . $newName;
        }

        if ($this->alphaBlogModel->update($id, $data)) {
            return redirect()->to(base_url('aw-cp/blog'))->with('success', 'Blog post updated successfully!');
        }

        return redirect()->to(base_url('aw-cp/blog/edit/' . $id))->with('error', 'Failed to update blog post.');
    }

    public function blogDelete(int $id)
    {
        $post = $this->alphaBlogModel->getPostById($id);
        if (!$post) {
            return redirect()->to(base_url('aw-cp/blog'))->with('error', 'Post not found.');
        }

        if ($this->alphaBlogModel->delete($id)) {
            return redirect()->to(base_url('aw-cp/blog'))->with('success', 'Blog post deleted successfully!');
        }

        return redirect()->to(base_url('aw-cp/blog'))->with('error', 'Failed to delete blog post.');
    }

    // Subscribers
    public function subscribers()
    {
        $data['title'] = 'Subscribers | Alphawonders';
        $data['subscribers'] = $this->db->table('subscriptions')->orderBy('id', 'DESC')->get()->getResultArray();

        return view('dashboard/inc/header', $data) .
               view('dashboard/subscribers', $data) .
               view('dashboard/inc/footer');
    }

    // Analytics
    public function users_analytics()
    {
        $data['title'] = 'Analytics Overview | Alphawonders';
        $data = array_merge($data, $this->getAnalyticsData());

        return view('dashboard/inc/header', $data) .
               view('dashboard/analytics/overview', $data) .
               view('dashboard/inc/footer');
    }

    public function visits_analytics()
    {
        return $this->users_analytics();
    }

    public function interactions_analytics()
    {
        return $this->users_analytics();
    }

    private function getAnalyticsData(): array
    {
        // Visitor device breakdown from all tables with device data
        $devices = ['Desktop' => 0, 'Mobile' => 0];
        foreach (['messages', 'hires', 'subscriptions', 'posts_comments'] as $table) {
            $desktop = $this->db->table($table)->where('device', 'Desktop')->countAllResults();
            $mobile = $this->db->table($table)->where('device', 'Mobile')->countAllResults();
            $devices['Desktop'] += $desktop;
            $devices['Mobile'] += $mobile;
        }

        // Browser breakdown
        $browsers = $this->db->table('posts_comments')
            ->select('browser_name, COUNT(*) as count')
            ->where('browser_name IS NOT NULL')
            ->groupBy('browser_name')
            ->orderBy('count', 'DESC')
            ->limit(5)
            ->get()->getResultArray();

        // Platform breakdown
        $platforms = $this->db->table('posts_comments')
            ->select('platform, COUNT(*) as count')
            ->where('platform IS NOT NULL')
            ->groupBy('platform')
            ->orderBy('count', 'DESC')
            ->limit(5)
            ->get()->getResultArray();

        // Monthly activity (comments + messages + subscriptions over last 6 months)
        $monthlyActivity = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = date('Y-m', strtotime("-{$i} months"));
            $startDate = $date . '-01';
            $endDate = date('Y-m-t', strtotime($startDate));

            $comments = $this->db->table('posts_comments')
                ->where('created_at >=', $startDate)
                ->where('created_at <=', $endDate . ' 23:59:59')
                ->countAllResults();
            $messages = $this->db->table('messages')
                ->where('created_at >=', $startDate)
                ->where('created_at <=', $endDate . ' 23:59:59')
                ->countAllResults();
            $subs = $this->db->table('subscriptions')
                ->where('created_at >=', $startDate)
                ->where('created_at <=', $endDate . ' 23:59:59')
                ->countAllResults();

            $monthlyActivity[] = [
                'month' => date('M Y', strtotime($startDate)),
                'comments' => $comments,
                'messages' => $messages,
                'subscriptions' => $subs,
                'total' => $comments + $messages + $subs,
            ];
        }

        // Get Google Analytics ID from settings
        $gaSetting = $this->db->table('settings')->where('setting_key', 'google_analytics_id')->get()->getRowArray();

        return [
            'devices' => $devices,
            'browsers' => $browsers,
            'platforms' => $platforms,
            'monthlyActivity' => $monthlyActivity,
            'totalInteractions' => array_sum(array_column($monthlyActivity, 'total')),
            'googleAnalyticsId' => $gaSetting['setting_value'] ?? '',
        ];
    }

    public function products()
    {
        $data['title'] = 'Products | Alphawonders';

        return view('dashboard/inc/header', $data) .
               view('dashboard/products', $data) .
               view('dashboard/inc/footer');
    }

    public function settings()
    {
        $data['title'] = 'Settings | Alphawonders';

        if ($this->request->getMethod() === 'POST') {
            $keys = [
                'google_analytics_id', 'google_search_console_meta',
                'site_name', 'site_description', 'contact_email',
                'social_facebook', 'social_twitter', 'social_linkedin',
            ];

            foreach ($keys as $key) {
                $value = $this->request->getPost($key) ?? '';
                $exists = $this->db->table('settings')->where('setting_key', $key)->countAllResults();
                if ($exists) {
                    $this->db->table('settings')->where('setting_key', $key)->update([
                        'setting_value' => $value,
                        'updated_at'    => date('Y-m-d H:i:s'),
                    ]);
                } else {
                    $this->db->table('settings')->insert([
                        'setting_key'   => $key,
                        'setting_value' => $value,
                        'updated_at'    => date('Y-m-d H:i:s'),
                    ]);
                }
            }

            return redirect()->to(base_url('aw-cp/settings'))->with('success', 'Settings saved successfully!');
        }

        // Load settings
        $settingsRows = $this->db->table('settings')->get()->getResultArray();
        $data['settings'] = [];
        foreach ($settingsRows as $row) {
            $data['settings'][$row['setting_key']] = $row['setting_value'];
        }

        return view('dashboard/inc/header', $data) .
               view('dashboard/settings', $data) .
               view('dashboard/inc/footer');
    }
}
