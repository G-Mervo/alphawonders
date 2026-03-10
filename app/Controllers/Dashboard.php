<?php

namespace App\Controllers;

use App\Models\AlphaBlogModel;
use App\Models\BlogCategoryModel;
use App\Models\BlogTagModel;
use App\Models\SocialMediaPostModel;
use App\Models\ContentCalendarModel;
use App\Libraries\GroqService;
use App\Libraries\GitHubService;
use App\Libraries\HtmlSanitizer;

class Dashboard extends BaseController
{
    protected $alphaBlogModel;
    protected $blogCategoryModel;
    protected $blogTagModel;
    protected $socialMediaPostModel;
    protected $db;

    public function __construct()
    {
        $this->alphaBlogModel = new AlphaBlogModel();
        $this->blogCategoryModel = new BlogCategoryModel();
        $this->blogTagModel = new BlogTagModel();
        $this->socialMediaPostModel = new SocialMediaPostModel();
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

        // Content stats
        $data['draftCount'] = $this->db->table('blog')->where('status', 'draft')->countAllResults();
        $data['scheduledCount'] = $this->db->table('blog')->where('status', 'scheduled')->countAllResults();
        $data['socialPostsCount'] = $this->db->table('social_media_posts')->countAllResults();

        // Upcoming scheduled posts
        $data['upcomingScheduled'] = $this->db->table('blog')
            ->where('status', 'scheduled')
            ->where('scheduled_at >', date('Y-m-d H:i:s'))
            ->orderBy('scheduled_at', 'ASC')
            ->limit(5)
            ->get()->getResultArray();

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
        if ($status === 'spam') {
            $query->where('is_spam IS TRUE');
        } elseif ($status && in_array($status, ['pending', 'ongoing', 'completed', 'cancelled'])) {
            $query->where('status', $status)->where('is_spam IS NOT TRUE');
        } else {
            $query->where('is_spam IS NOT TRUE');
        }
        $data['hires'] = $query->get()->getResultArray();
        $data['currentStatus'] = $status ?: 'all';

        // Counts — use PostgreSQL IS TRUE / IS NOT TRUE for reliable boolean comparison
        $data['allCount'] = $this->db->table('hires')->where('is_spam IS NOT TRUE')->countAllResults();
        $data['pendingCount'] = $this->db->table('hires')->where('status', 'pending')->where('is_spam IS NOT TRUE')->countAllResults();
        $data['ongoingCount'] = $this->db->table('hires')->where('status', 'ongoing')->where('is_spam IS NOT TRUE')->countAllResults();
        $data['completedCount'] = $this->db->table('hires')->where('status', 'completed')->where('is_spam IS NOT TRUE')->countAllResults();
        $data['cancelledCount'] = $this->db->table('hires')->where('status', 'cancelled')->where('is_spam IS NOT TRUE')->countAllResults();
        $data['spamCount'] = $this->db->table('hires')->where('is_spam IS TRUE')->countAllResults();

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

    public function hireToggleSpam(int $id)
    {
        $hire = $this->db->table('hires')->where('id', $id)->get()->getRowArray();
        if (!$hire) {
            return redirect()->to(base_url('aw-cp/hires'))->with('error', 'Project not found.');
        }

        $newVal = !($hire['is_spam'] ?? false);
        $this->db->table('hires')->where('id', $id)->update([
            'is_spam'       => $newVal,
            'date_modified' => date('Y-m-d H:i:s'),
        ]);

        $msg = $newVal ? 'Marked as spam.' : 'Unmarked as spam.';
        return redirect()->to(base_url('aw-cp/hires/view/' . $id))->with('success', $msg);
    }

    public function blog()
    {
        $data['title'] = 'Blog Management | Alphawonders';

        $status = $this->request->getGet('status');
        $query = $this->alphaBlogModel->orderBy('date_created', 'DESC');
        if ($status && in_array($status, ['draft', 'scheduled', 'published'])) {
            $query->where('status', $status);
        }
        $data['posts'] = $query->findAll();
        $data['currentStatus'] = $status ?: 'all';

        // Status counts
        $data['allCount'] = $this->db->table('blog')->countAllResults();
        $data['publishedCount'] = $this->db->table('blog')->where('status', 'published')->countAllResults();
        $data['draftCount'] = $this->db->table('blog')->where('status', 'draft')->countAllResults();
        $data['scheduledCount'] = $this->db->table('blog')->where('status', 'scheduled')->countAllResults();

        // Pre-load tags for all posts to avoid N+1
        $postIds = array_column($data['posts'], 'id');
        $data['postTagsMap'] = $this->blogTagModel->getTagsMapForPosts($postIds);

        // Social score map
        $data['socialScoreMap'] = $this->socialMediaPostModel->getSocialScoreForPosts($postIds);

        return view('dashboard/inc/header', $data) .
               view('dashboard/blog', $data) .
               view('dashboard/inc/footer');
    }

    public function blogCreate()
    {
        $data['title'] = 'Create Blog Post | Alphawonders';
        $data['post'] = null;
        $data['categories'] = $this->blogCategoryModel->getAllCategories();
        $data['postTags'] = [];

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
                mkdir($uploadPath, 0775, true);
            }
            if (!is_writable($uploadPath)) {
                return redirect()->to(base_url('aw-cp/blog/create'))->withInput()->with('error', 'Upload directory is not writable. Please check server permissions.');
            }
            $imageFile->move($uploadPath, $newName);
            $imagePath = 'assets/img/blog/' . $newName;
        }

        // Resolve category
        $categoryId = $this->request->getPost('category_id') ?: null;
        $blogCategory = null;
        if ($categoryId) {
            $cat = $this->blogCategoryModel->find($categoryId);
            $blogCategory = $cat ? $cat['slug'] : null;
        }

        // Determine status from action
        $action = $this->request->getPost('action') ?? 'publish';
        $status = 'published';
        $scheduledAt = null;
        $publishedAt = null;

        if ($action === 'draft') {
            $status = 'draft';
        } elseif ($action === 'schedule') {
            $status = 'scheduled';
            $scheduledAt = $this->request->getPost('scheduled_at');
        } else {
            $publishedAt = date('Y-m-d H:i:s');
        }

        $data = [
            'blog_author'      => $this->request->getPost('blog_author'),
            'blog_title'       => $this->request->getPost('blog_title'),
            'blog_url'         => $slug,
            'blog_description' => HtmlSanitizer::sanitizeHtml($this->request->getPost('blogtxtarea')),
            'blog_image'       => $imagePath,
            'blog_category'    => $blogCategory,
            'category_id'      => $categoryId,
            'blog_id'          => time(),
            'date_created'     => date('Y-m-d H:i:s'),
            'status'           => $status,
            'scheduled_at'     => $scheduledAt,
            'published_at'     => $publishedAt,
            'meta_description' => $this->request->getPost('meta_description') ?: null,
        ];

        if ($this->alphaBlogModel->insert($data)) {
            $newPostId = $this->alphaBlogModel->getInsertID();

            // Sync tags
            $tagsInput = $this->request->getPost('blog_tags') ?? '';
            $this->blogTagModel->syncTagsForPost($newPostId, $tagsInput);

            $messages = ['draft' => 'Blog post saved as draft!', 'schedule' => 'Blog post scheduled!', 'publish' => 'Blog post published!'];
            return redirect()->to(base_url('aw-cp/blog'))->with('success', $messages[$action] ?? 'Blog post created!');
        }

        return redirect()->to(base_url('aw-cp/blog/create'))->withInput()->with('error', 'Failed to create blog post. Please check your input and try again.');
    }

    public function blogEdit(int $id)
    {
        $data['title'] = 'Edit Blog Post | Alphawonders';
        $data['post'] = $this->alphaBlogModel->getPostById($id);

        if (!$data['post']) {
            return redirect()->to(base_url('aw-cp/blog'))->with('error', 'Post not found.');
        }

        $data['categories'] = $this->blogCategoryModel->getAllCategories();
        $data['postTags'] = $this->blogTagModel->getTagsForPost($id);

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

        // Resolve category
        $categoryId = $this->request->getPost('category_id') ?: null;
        $blogCategory = null;
        if ($categoryId) {
            $cat = $this->blogCategoryModel->find($categoryId);
            $blogCategory = $cat ? $cat['slug'] : null;
        }

        // Determine status from action
        $action = $this->request->getPost('action') ?? 'publish';
        $statusData = [];

        if ($action === 'draft') {
            $statusData['status'] = 'draft';
            $statusData['scheduled_at'] = null;
        } elseif ($action === 'schedule') {
            $statusData['status'] = 'scheduled';
            $statusData['scheduled_at'] = $this->request->getPost('scheduled_at');
        } else {
            $statusData['status'] = 'published';
            if (empty($post['published_at'])) {
                $statusData['published_at'] = date('Y-m-d H:i:s');
            }
            $statusData['scheduled_at'] = null;
        }

        $data = array_merge([
            'blog_author'      => $this->request->getPost('blog_author'),
            'blog_title'       => $this->request->getPost('blog_title'),
            'blog_url'         => $slug,
            'blog_description' => HtmlSanitizer::sanitizeHtml($this->request->getPost('blogtxtarea')),
            'blog_category'    => $blogCategory,
            'category_id'      => $categoryId,
            'date_modified'    => date('Y-m-d H:i:s'),
            'meta_description' => $this->request->getPost('meta_description') ?: null,
        ], $statusData);

        $imageFile = $this->request->getFile('blog_image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $slug . '-' . time() . '.' . $imageFile->getExtension();
            $uploadPath = FCPATH . 'assets/img/blog';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }
            if (!is_writable($uploadPath)) {
                return redirect()->to(base_url('aw-cp/blog/edit/' . $id))->withInput()->with('error', 'Upload directory is not writable. Please check server permissions.');
            }
            $imageFile->move($uploadPath, $newName);
            $data['blog_image'] = 'assets/img/blog/' . $newName;
        }

        if ($this->alphaBlogModel->update($id, $data)) {
            // Sync tags
            $tagsInput = $this->request->getPost('blog_tags') ?? '';
            $this->blogTagModel->syncTagsForPost($id, $tagsInput);

            $messages = ['draft' => 'Blog post saved as draft!', 'schedule' => 'Blog post scheduled!', 'publish' => 'Blog post published!'];
            return redirect()->to(base_url('aw-cp/blog'))->with('success', $messages[$action] ?? 'Blog post updated!');
        }

        return redirect()->to(base_url('aw-cp/blog/edit/' . $id))->with('error', 'Failed to update blog post. Please check your input and try again.');
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

    // Blog Preview
    public function blogPreview(int $id)
    {
        $post = $this->alphaBlogModel->getPostById($id);
        if (!$post) {
            return redirect()->to(base_url('aw-cp/blog'))->with('error', 'Post not found.');
        }

        $data['title'] = esc($post['blog_title']) . ' | Preview';
        $data['post'] = $post;
        $data['isPreview'] = true;
        $data['comments'] = $this->alphaBlogModel->getCommentsByPostId((int) $post['id']);
        $data['recentPosts'] = $this->alphaBlogModel->where('status', 'published')->orderBy('published_at', 'DESC')->limit(4)->findAll();
        $data['postTags'] = $this->blogTagModel->getTagsForPost((int) $post['id']);
        $data['postCategory'] = !empty($post['category_id']) ? $this->blogCategoryModel->find($post['category_id']) : null;
        $data['categories'] = $this->blogCategoryModel->getCategoriesWithPostCount();
        $data['allTags'] = $this->blogTagModel->getAllTagsWithPostCount();

        return view('layout/header', $data) .
               view('blog/preview_banner') .
               view('blog/show', $data) .
               view('layout/footer');
    }

    public function blogPreviewUnsaved()
    {
        $data['title'] = 'Preview | Alphawonders';
        $data['post'] = [
            'id'               => 0,
            'blog_title'       => $this->request->getPost('blog_title') ?? 'Untitled',
            'blog_description' => HtmlSanitizer::sanitizeHtml($this->request->getPost('blogtxtarea') ?? ''),
            'blog_author'      => $this->request->getPost('blog_author') ?? 'Author',
            'blog_url'         => $this->request->getPost('blog_url') ?? '',
            'blog_image'       => $this->request->getPost('existing_image') ?? 'assets/img/blog/default.jpg',
            'blog_category'    => '',
            'category_id'      => $this->request->getPost('category_id'),
            'date_created'     => date('Y-m-d H:i:s'),
            'status'           => 'draft',
        ];
        $data['isPreview'] = true;
        $data['comments'] = [];
        $data['recentPosts'] = $this->alphaBlogModel->where('status', 'published')->orderBy('published_at', 'DESC')->limit(4)->findAll();
        $data['postTags'] = [];
        $data['postCategory'] = !empty($data['post']['category_id']) ? $this->blogCategoryModel->find($data['post']['category_id']) : null;
        $data['categories'] = $this->blogCategoryModel->getCategoriesWithPostCount();
        $data['allTags'] = $this->blogTagModel->getAllTagsWithPostCount();

        return view('layout/header', $data) .
               view('blog/preview_banner') .
               view('blog/show', $data) .
               view('layout/footer');
    }

    // Subscribers
    public function subscribers()
    {
        $data['title'] = 'Subscribers | Alphawonders';
        $filter = $this->request->getGet('filter') ?? 'all';

        $builder = $this->db->table('subscriptions');
        if ($filter === 'spam') {
            $builder->where('is_spam', true);
        } elseif ($filter === 'active') {
            $builder->where('is_spam', false);
        }

        $data['subscribers'] = $builder->orderBy('id', 'DESC')->get()->getResultArray();
        $data['currentFilter'] = $filter;
        $data['totalAll'] = $this->db->table('subscriptions')->countAllResults();
        $data['totalActive'] = $this->db->table('subscriptions')->where('is_spam', false)->countAllResults();
        $data['totalSpam'] = $this->db->table('subscriptions')->where('is_spam', true)->countAllResults();

        return view('dashboard/inc/header', $data) .
               view('dashboard/subscribers', $data) .
               view('dashboard/inc/footer');
    }

    public function subscriberView(int $id)
    {
        $data['title'] = 'Subscriber Details | Alphawonders';
        $data['subscriber'] = $this->db->table('subscriptions')->where('id', $id)->get()->getRowArray();

        if (!$data['subscriber']) {
            return redirect()->to(base_url('aw-cp/subscribers'))->with('error', 'Subscriber not found.');
        }

        return view('dashboard/inc/header', $data) .
               view('dashboard/subscriber_detail', $data) .
               view('dashboard/inc/footer');
    }

    public function subscriberToggleSpam(int $id)
    {
        $sub = $this->db->table('subscriptions')->where('id', $id)->get()->getRowArray();
        if (!$sub) {
            return redirect()->to(base_url('aw-cp/subscribers'))->with('error', 'Subscriber not found.');
        }

        $newStatus = !$sub['is_spam'];
        $this->db->table('subscriptions')->where('id', $id)->update(['is_spam' => $newStatus]);

        $msg = $newStatus ? 'Subscriber marked as spam.' : 'Subscriber removed from spam.';
        return redirect()->to(base_url('aw-cp/subscribers'))->with('success', $msg);
    }

    public function subscriberDelete(int $id)
    {
        $this->db->table('subscriptions')->where('id', $id)->delete();
        return redirect()->to(base_url('aw-cp/subscribers'))->with('success', 'Subscriber deleted.');
    }

    // Comments Management
    public function comments()
    {
        $data['title'] = 'Blog Comments | Alphawonders';
        $filter = $this->request->getGet('filter') ?? 'all';

        $builder = $this->db->table('posts_comments pc')
            ->select('pc.*, b.blog_title, b.blog_url')
            ->join('blog b', 'b.id = pc.post_id', 'left');

        if ($filter === 'spam') {
            $builder->where('pc.is_spam', true);
        } elseif ($filter === 'replied') {
            $builder->where('pc.admin_reply IS NOT NULL');
        } elseif ($filter === 'unreplied') {
            $builder->where('pc.admin_reply IS NULL');
            $builder->where('pc.is_spam', false);
        }

        $data['comments'] = $builder->orderBy('pc.created_at', 'DESC')->get()->getResultArray();
        $data['currentFilter'] = $filter;
        $data['totalAll'] = $this->db->table('posts_comments')->countAllResults();
        $data['totalSpam'] = $this->db->table('posts_comments')->where('is_spam', true)->countAllResults();
        $data['totalReplied'] = $this->db->table('posts_comments')->where('admin_reply IS NOT NULL')->countAllResults();
        $data['totalUnreplied'] = $this->db->table('posts_comments')->where('admin_reply IS NULL')->where('is_spam', false)->countAllResults();

        return view('dashboard/inc/header', $data) .
               view('dashboard/comments', $data) .
               view('dashboard/inc/footer');
    }

    public function commentToggleSpam(int $id)
    {
        $comment = $this->db->table('posts_comments')->where('comment_id', $id)->get()->getRowArray();
        if (!$comment) {
            return redirect()->to(base_url('aw-cp/comments'))->with('error', 'Comment not found.');
        }

        $newStatus = !$comment['is_spam'];
        $this->db->table('posts_comments')->where('comment_id', $id)->update(['is_spam' => $newStatus]);

        $msg = $newStatus ? 'Comment marked as spam.' : 'Comment restored.';
        return redirect()->to(base_url('aw-cp/comments'))->with('success', $msg);
    }

    public function commentDelete(int $id)
    {
        $this->db->table('posts_comments')->where('comment_id', $id)->delete();
        return redirect()->to(base_url('aw-cp/comments'))->with('success', 'Comment deleted.');
    }

    public function commentReply(int $id)
    {
        $comment = $this->db->table('posts_comments')->where('comment_id', $id)->get()->getRowArray();
        if (!$comment) {
            return redirect()->to(base_url('aw-cp/comments'))->with('error', 'Comment not found.');
        }

        $reply = $this->request->getPost('admin_reply');
        if (empty(trim($reply))) {
            return redirect()->to(base_url('aw-cp/comments'))->with('error', 'Reply cannot be empty.');
        }

        $this->db->table('posts_comments')->where('comment_id', $id)->update([
            'admin_reply' => HtmlSanitizer::sanitizePlainText($reply),
            'replied_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('aw-cp/comments'))->with('success', 'Reply posted successfully.');
    }

    // Login Attempts Audit Log
    public function loginAttempts()
    {
        $data['title'] = 'Login Attempts | Alphawonders';

        $perPage = 50;
        $page = (int) ($this->request->getGet('page') ?? 1);
        $filter = $this->request->getGet('filter') ?? 'all';
        $offset = ($page - 1) * $perPage;

        $builder = $this->db->table('login_attempts');

        if ($filter === 'failed') {
            $builder->where('success', false);
        } elseif ($filter === 'success') {
            $builder->where('success', true);
        }

        $data['totalAttempts'] = $builder->countAllResults(false);
        $data['attempts'] = $builder->orderBy('attempted_at', 'DESC')
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();

        $data['currentPage'] = $page;
        $data['totalPages'] = max(1, ceil($data['totalAttempts'] / $perPage));
        $data['currentFilter'] = $filter;

        // Summary stats
        $data['totalAll'] = $this->db->table('login_attempts')->countAllResults();
        $data['totalFailed'] = $this->db->table('login_attempts')->where('success', false)->countAllResults();
        $data['totalSuccess'] = $this->db->table('login_attempts')->where('success', true)->countAllResults();

        // Top offending IPs (last 30 days)
        $data['topIPs'] = $this->db->table('login_attempts')
            ->select('ip_address, COUNT(*) as attempts, SUM(CASE WHEN success = false THEN 1 ELSE 0 END) as failures')
            ->where('attempted_at >=', date('Y-m-d H:i:s', strtotime('-30 days')))
            ->where('success', false)
            ->groupBy('ip_address')
            ->orderBy('failures', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();

        return view('dashboard/inc/header', $data) .
               view('dashboard/login_attempts', $data) .
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
                'social_instagram', 'social_tiktok',
                'groq_api_key', 'groq_model', 'github_pat',
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

    public function settingsSaveField()
    {
        $key = $this->request->getPost('key');
        $value = $this->request->getPost('value') ?? '';

        $allowedKeys = [
            'google_analytics_id', 'google_search_console_meta',
            'site_name', 'site_description', 'contact_email',
            'social_facebook', 'social_twitter', 'social_linkedin',
            'social_instagram', 'social_tiktok',
            'groq_api_key', 'groq_model', 'github_pat',
        ];

        if (!$key || !in_array($key, $allowedKeys)) {
            return $this->response->setJSON(['success' => false, 'error' => 'Invalid setting key.']);
        }

        try {
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

            return $this->response->setJSON(['success' => true]);
        } catch (\Throwable $e) {
            log_message('error', 'Settings save failed: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'error' => 'Failed to save setting.']);
        }
    }

    public function categoryStore()
    {
        $name = trim($this->request->getPost('name') ?? '');

        if (empty($name)) {
            return $this->response->setJSON(['success' => false, 'error' => 'Category name is required.']);
        }

        $slug = url_title($name, '-', true);

        // Check duplicate
        $existing = $this->blogCategoryModel->getCategoryBySlug($slug);
        if ($existing) {
            return $this->response->setJSON(['success' => false, 'error' => 'A category with this name already exists.']);
        }

        $this->blogCategoryModel->insert([
            'name'       => $name,
            'slug'       => $slug,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $id = $this->blogCategoryModel->getInsertID();

        return $this->response->setJSON([
            'success' => true,
            'category' => [
                'id'   => $id,
                'name' => $name,
                'slug' => $slug,
            ],
        ]);
    }

    public function changePassword()
    {
        $userId = session()->get('userId');
        if (!$userId) {
            return redirect()->to(base_url('aw-cp/login'));
        }

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // Validate inputs
        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            return redirect()->to(base_url('aw-cp/settings'))->with('pw_error', 'All password fields are required.');
        }

        if (strlen($newPassword) < 8) {
            return redirect()->to(base_url('aw-cp/settings'))->with('pw_error', 'New password must be at least 8 characters.');
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->to(base_url('aw-cp/settings'))->with('pw_error', 'New passwords do not match.');
        }

        // Verify current password
        $user = $this->db->table('admin_users')->where('id', $userId)->get()->getRowArray();
        if (!$user || !password_verify($currentPassword, $user['password_hash'])) {
            return redirect()->to(base_url('aw-cp/settings'))->with('pw_error', 'Current password is incorrect.');
        }

        // Update password
        $this->db->table('admin_users')->where('id', $userId)->update([
            'password_hash' => password_hash($newPassword, PASSWORD_DEFAULT),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(base_url('aw-cp/settings'))->with('pw_success', 'Password changed successfully.');
    }

    // ──────────────────────────────────────────────
    // AI Endpoints (Groq)
    // ──────────────────────────────────────────────

    public function aiGenerateBlog()
    {
        $topic = $this->request->getPost('topic');
        $outline = $this->request->getPost('outline') ?? '';

        if (!$topic) {
            return $this->response->setJSON(['success' => false, 'error' => 'Topic is required.']);
        }

        $groq = new GroqService();
        $result = $groq->generateBlogPost($topic, $outline);

        if ($result['success']) {
            // Also suggest a title and slug
            $titleResult = $groq->suggestTitle($result['content']);
            $slugResult = $groq->suggestSlug($titleResult['success'] ? $titleResult['content'] : $topic);

            return $this->response->setJSON([
                'success' => true,
                'content' => $result['content'],
                'title'   => $titleResult['success'] ? trim($titleResult['content'], '"\'') : '',
                'slug'    => $slugResult['success'] ? trim($slugResult['content']) : '',
            ]);
        }

        return $this->response->setJSON($result);
    }

    public function aiSuggestTitle()
    {
        $content = $this->request->getPost('content');
        if (!$content) {
            return $this->response->setJSON(['success' => false, 'error' => 'Content is required.']);
        }

        $groq = new GroqService();
        $result = $groq->suggestTitle($content);

        if ($result['success']) {
            $result['content'] = trim($result['content'], '"\'');
        }

        return $this->response->setJSON($result);
    }

    public function aiSuggestSlug()
    {
        $title = $this->request->getPost('title');
        if (!$title) {
            return $this->response->setJSON(['success' => false, 'error' => 'Title is required.']);
        }

        $groq = new GroqService();
        $result = $groq->suggestSlug($title);

        return $this->response->setJSON($result);
    }

    public function aiSuggestCategory()
    {
        $content = $this->request->getPost('content');
        if (!$content) {
            return $this->response->setJSON(['success' => false, 'error' => 'Content is required.']);
        }

        $categories = $this->blogCategoryModel->getAllCategories();
        $groq = new GroqService();
        $result = $groq->suggestCategory($content, $categories);

        return $this->response->setJSON($result);
    }

    public function aiDraftReply()
    {
        $senderName = $this->request->getPost('sender_name');
        $message = $this->request->getPost('message');
        $subject = $this->request->getPost('subject') ?? '';

        if (!$message) {
            return $this->response->setJSON(['success' => false, 'error' => 'Message is required.']);
        }

        $groq = new GroqService();
        $result = $groq->draftMessageReply($senderName ?? 'Unknown', $message, $subject);

        return $this->response->setJSON($result);
    }

    public function aiProjectInsights()
    {
        $hires = $this->db->table('hires')->orderBy('date_created', 'DESC')->limit(20)->get()->getResultArray();

        if (empty($hires)) {
            return $this->response->setJSON(['success' => false, 'error' => 'No project data to analyze.']);
        }

        $groq = new GroqService();
        $result = $groq->generateProjectInsights($hires);

        return $this->response->setJSON($result);
    }

    // ──────────────────────────────────────────────
    // AI Social Media Endpoints
    // ──────────────────────────────────────────────

    public function aiGenerateSocial()
    {
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $platform = $this->request->getPost('platform');
        $url = $this->request->getPost('url') ?? '';

        if (!$title || !$content || !$platform) {
            return $this->response->setJSON(['success' => false, 'error' => 'Title, content, and platform are required.']);
        }

        $groq = new GroqService();
        return $this->response->setJSON($groq->generateSocialPost($title, $content, $platform, $url));
    }

    public function aiGenerateAllSocial()
    {
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $url = $this->request->getPost('url') ?? '';

        if (!$title || !$content) {
            return $this->response->setJSON(['success' => false, 'error' => 'Title and content are required.']);
        }

        $groq = new GroqService();
        return $this->response->setJSON($groq->generateAllSocialPosts($title, $content, $url));
    }

    public function aiGenerateVideoScript()
    {
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $platform = $this->request->getPost('platform') ?? 'tiktok';
        $seconds = (int) ($this->request->getPost('seconds') ?? 60);

        if (!$title || !$content) {
            return $this->response->setJSON(['success' => false, 'error' => 'Title and content are required.']);
        }

        $groq = new GroqService();
        return $this->response->setJSON($groq->generateVideoScript($title, $content, $platform, $seconds));
    }

    public function aiSuggestHashtags()
    {
        $content = $this->request->getPost('content');
        $platform = $this->request->getPost('platform') ?? 'twitter';

        if (!$content) {
            return $this->response->setJSON(['success' => false, 'error' => 'Content is required.']);
        }

        $groq = new GroqService();
        return $this->response->setJSON($groq->suggestHashtags($content, $platform));
    }

    public function aiGenerateMetaDescription()
    {
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');

        if (!$title || !$content) {
            return $this->response->setJSON(['success' => false, 'error' => 'Title and content are required.']);
        }

        $groq = new GroqService();
        return $this->response->setJSON($groq->generateMetaDescription($title, $content));
    }

    public function aiRepurposeContent()
    {
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $format = $this->request->getPost('format') ?? 'newsletter';

        if (!$title || !$content) {
            return $this->response->setJSON(['success' => false, 'error' => 'Title and content are required.']);
        }

        $groq = new GroqService();
        return $this->response->setJSON($groq->repurposeContent($title, $content, $format));
    }

    // ──────────────────────────────────────────────
    // GitHub Projects Dashboard
    // ──────────────────────────────────────────────

    public function github()
    {
        $data['title'] = 'GitHub Projects | Alphawonders';
        $gh = new GitHubService();
        $data['configured'] = $gh->isConfigured();

        if ($data['configured']) {
            $userResult = $gh->getUser();
            $reposResult = $gh->listRepos();
            $data['ghUser'] = $userResult['success'] ? $userResult['data'] : null;
            $data['repos'] = $reposResult['success'] ? $reposResult['data'] : [];
            $data['error'] = $userResult['success'] ? null : $userResult['error'];
        }

        return view('dashboard/inc/header', $data) .
               view('dashboard/github/index', $data) .
               view('dashboard/inc/footer');
    }

    public function githubRepo(string $owner, string $repo)
    {
        $data['title'] = "{$owner}/{$repo} | GitHub Projects";
        $gh = new GitHubService();

        if (!$gh->isConfigured()) {
            return redirect()->to(base_url('aw-cp/github'));
        }

        $repoResult = $gh->getRepo($owner, $repo);
        if (!$repoResult['success']) {
            return redirect()->to(base_url('aw-cp/github'))->with('error', $repoResult['error']);
        }

        $data['repo'] = $repoResult['data'];
        $data['owner'] = $owner;
        $data['repoName'] = $repo;

        $commitsResult = $gh->getCommits($owner, $repo);
        $data['commits'] = $commitsResult['success'] ? $commitsResult['data'] : [];

        $langResult = $gh->getLanguages($owner, $repo);
        $data['languages'] = $langResult['success'] ? $langResult['data'] : [];

        $issuesResult = $gh->listIssues($owner, $repo);
        $data['issues'] = $issuesResult['success'] ? $issuesResult['data'] : [];

        return view('dashboard/inc/header', $data) .
               view('dashboard/github/repo_detail', $data) .
               view('dashboard/inc/footer');
    }

    public function githubCreateRepo()
    {
        $gh = new GitHubService();
        if (!$gh->isConfigured()) {
            return redirect()->to(base_url('aw-cp/github'));
        }

        if ($this->request->getMethod() === 'POST') {
            $result = $gh->createRepo([
                'name'          => $this->request->getPost('name'),
                'description'   => $this->request->getPost('description') ?? '',
                'private'       => $this->request->getPost('visibility') === 'private',
                'auto_init'     => (bool) $this->request->getPost('auto_init'),
            ]);

            if ($result['success']) {
                return redirect()->to(base_url('aw-cp/github'))->with('success', 'Repository created successfully!');
            }

            return redirect()->to(base_url('aw-cp/github/create'))->with('error', $result['error']);
        }

        $data['title'] = 'Create Repository | GitHub Projects';
        return view('dashboard/inc/header', $data) .
               view('dashboard/github/create_repo', $data) .
               view('dashboard/inc/footer');
    }

    public function githubCreateIssue(string $owner, string $repo)
    {
        $gh = new GitHubService();
        if (!$gh->isConfigured()) {
            return redirect()->to(base_url('aw-cp/github'));
        }

        if ($this->request->getMethod() === 'POST') {
            $issueData = [
                'title' => $this->request->getPost('title'),
                'body'  => $this->request->getPost('body') ?? '',
            ];
            $labels = $this->request->getPost('labels');
            if ($labels) {
                $issueData['labels'] = array_map('trim', explode(',', $labels));
            }

            $result = $gh->createIssue($owner, $repo, $issueData);
            if ($result['success']) {
                return redirect()->to(base_url("aw-cp/github/repo/{$owner}/{$repo}"))->with('success', 'Issue created successfully!');
            }

            return redirect()->to(base_url("aw-cp/github/repo/{$owner}/{$repo}/issues/create"))->with('error', $result['error']);
        }

        $data['title'] = "Create Issue | {$owner}/{$repo}";
        $data['owner'] = $owner;
        $data['repoName'] = $repo;
        return view('dashboard/inc/header', $data) .
               view('dashboard/github/create_issue', $data) .
               view('dashboard/inc/footer');
    }

    public function githubCreateRelease(string $owner, string $repo)
    {
        $gh = new GitHubService();
        if (!$gh->isConfigured()) {
            return redirect()->to(base_url('aw-cp/github'));
        }

        if ($this->request->getMethod() === 'POST') {
            $result = $gh->createRelease($owner, $repo, [
                'tag_name'   => $this->request->getPost('tag_name'),
                'name'       => $this->request->getPost('name') ?? '',
                'body'       => $this->request->getPost('body') ?? '',
                'prerelease' => (bool) $this->request->getPost('prerelease'),
            ]);

            if ($result['success']) {
                return redirect()->to(base_url("aw-cp/github/repo/{$owner}/{$repo}"))->with('success', 'Release created successfully!');
            }

            return redirect()->to(base_url("aw-cp/github/repo/{$owner}/{$repo}/releases/create"))->with('error', $result['error']);
        }

        $data['title'] = "Create Release | {$owner}/{$repo}";
        $data['owner'] = $owner;
        $data['repoName'] = $repo;
        return view('dashboard/inc/header', $data) .
               view('dashboard/github/create_release', $data) .
               view('dashboard/inc/footer');
    }
}
