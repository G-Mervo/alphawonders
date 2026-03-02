<?php

namespace App\Controllers;

use App\Models\SocialMediaPostModel;
use App\Models\AlphaBlogModel;
use App\Libraries\GroqService;

class SocialMedia extends BaseController
{
    protected $socialModel;
    protected $blogModel;
    protected $db;

    public function __construct()
    {
        $this->socialModel = new SocialMediaPostModel();
        $this->blogModel = new AlphaBlogModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data['title'] = 'Social Media Hub | Alphawonders';

        $platform = $this->request->getGet('platform');
        $status = $this->request->getGet('status');
        $data['posts'] = $this->socialModel->getAllFiltered($platform, $status);
        $data['platformCounts'] = $this->socialModel->getCountsByPlatform();
        $data['currentPlatform'] = $platform ?: 'all';
        $data['currentStatus'] = $status ?: 'all';
        $data['blogPosts'] = $this->blogModel->orderBy('date_created', 'DESC')->findAll();

        return view('dashboard/inc/header', $data) .
               view('dashboard/social/index', $data) .
               view('dashboard/inc/footer');
    }

    public function create(string $platform = '')
    {
        $data['title'] = 'Create Social Post | Alphawonders';
        $data['post'] = null;
        $data['platform'] = $platform;
        $data['blogPosts'] = $this->blogModel->orderBy('date_created', 'DESC')->findAll();

        return view('dashboard/inc/header', $data) .
               view('dashboard/social/form', $data) .
               view('dashboard/inc/footer');
    }

    public function edit(int $id)
    {
        $data['title'] = 'Edit Social Post | Alphawonders';
        $data['post'] = $this->socialModel->find($id);

        if (!$data['post']) {
            return redirect()->to(base_url('aw-cp/social'))->with('error', 'Post not found.');
        }

        $data['platform'] = $data['post']['platform'];
        $data['blogPosts'] = $this->blogModel->orderBy('date_created', 'DESC')->findAll();

        return view('dashboard/inc/header', $data) .
               view('dashboard/social/form', $data) .
               view('dashboard/inc/footer');
    }

    public function save()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'platform' => 'required|in_list[twitter,facebook,linkedin,instagram,tiktok]',
            'content'  => 'required',
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->to(base_url('aw-cp/social/create'))->withInput()->with('errors', $validation->getErrors());
        }

        $action = $this->request->getPost('action') ?? 'draft';
        $status = 'draft';
        $scheduledAt = null;
        $postedAt = null;

        if ($action === 'schedule') {
            $status = 'scheduled';
            $scheduledAt = $this->request->getPost('scheduled_at');
        } elseif ($action === 'posted') {
            $status = 'posted';
            $postedAt = date('Y-m-d H:i:s');
        }

        // Handle media upload
        $mediaUrl = null;
        $mediaFile = $this->request->getFile('media_file');
        if ($mediaFile && $mediaFile->isValid() && !$mediaFile->hasMoved()) {
            $uploadPath = FCPATH . 'assets/img/social';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $newName = time() . '-' . $mediaFile->getRandomName();
            $mediaFile->move($uploadPath, $newName);
            $mediaUrl = 'assets/img/social/' . $newName;
        }

        $data = [
            'blog_id'      => $this->request->getPost('blog_id') ?: null,
            'platform'     => $this->request->getPost('platform'),
            'content'      => $this->request->getPost('content'),
            'hashtags'     => $this->request->getPost('hashtags'),
            'media_url'    => $mediaUrl,
            'link_url'     => $this->request->getPost('link_url'),
            'video_script' => $this->request->getPost('video_script'),
            'status'       => $status,
            'scheduled_at' => $scheduledAt,
            'posted_at'    => $postedAt,
            'ai_generated' => (bool) $this->request->getPost('ai_generated'),
            'notes'        => $this->request->getPost('notes'),
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ];

        if ($this->socialModel->insert($data)) {
            return redirect()->to(base_url('aw-cp/social'))->with('success', 'Social media post created!');
        }

        return redirect()->to(base_url('aw-cp/social/create'))->with('error', 'Failed to create post.');
    }

    public function update(int $id)
    {
        $post = $this->socialModel->find($id);
        if (!$post) {
            return redirect()->to(base_url('aw-cp/social'))->with('error', 'Post not found.');
        }

        $action = $this->request->getPost('action') ?? 'draft';
        $statusData = [];

        if ($action === 'draft') {
            $statusData['status'] = 'draft';
            $statusData['scheduled_at'] = null;
        } elseif ($action === 'schedule') {
            $statusData['status'] = 'scheduled';
            $statusData['scheduled_at'] = $this->request->getPost('scheduled_at');
        } elseif ($action === 'posted') {
            $statusData['status'] = 'posted';
            $statusData['posted_at'] = date('Y-m-d H:i:s');
        }

        // Handle media upload
        $mediaFile = $this->request->getFile('media_file');
        $mediaUrl = $post['media_url'];
        if ($mediaFile && $mediaFile->isValid() && !$mediaFile->hasMoved()) {
            $uploadPath = FCPATH . 'assets/img/social';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $newName = time() . '-' . $mediaFile->getRandomName();
            $mediaFile->move($uploadPath, $newName);
            $mediaUrl = 'assets/img/social/' . $newName;
        }

        $data = array_merge([
            'blog_id'      => $this->request->getPost('blog_id') ?: null,
            'platform'     => $this->request->getPost('platform'),
            'content'      => $this->request->getPost('content'),
            'hashtags'     => $this->request->getPost('hashtags'),
            'media_url'    => $mediaUrl,
            'link_url'     => $this->request->getPost('link_url'),
            'video_script' => $this->request->getPost('video_script'),
            'notes'        => $this->request->getPost('notes'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ], $statusData);

        if ($this->socialModel->update($id, $data)) {
            return redirect()->to(base_url('aw-cp/social'))->with('success', 'Social media post updated!');
        }

        return redirect()->to(base_url('aw-cp/social/edit/' . $id))->with('error', 'Failed to update post.');
    }

    public function delete(int $id)
    {
        $post = $this->socialModel->find($id);
        if (!$post) {
            return redirect()->to(base_url('aw-cp/social'))->with('error', 'Post not found.');
        }

        $this->socialModel->delete($id);
        return redirect()->to(base_url('aw-cp/social'))->with('success', 'Social media post deleted!');
    }

    public function generateFromBlog(int $blogId)
    {
        $blog = $this->blogModel->find($blogId);
        if (!$blog) {
            return redirect()->to(base_url('aw-cp/social'))->with('error', 'Blog post not found.');
        }

        $data['title'] = 'Generate Social Posts | Alphawonders';
        $data['blog'] = $blog;
        $data['existingPosts'] = $this->socialModel->getPostsByBlogId($blogId);

        return view('dashboard/inc/header', $data) .
               view('dashboard/social/generate_from_blog', $data) .
               view('dashboard/inc/footer');
    }

    public function bulkGenerate()
    {
        $blogId = $this->request->getPost('blog_id');
        $blog = $this->blogModel->find($blogId);

        if (!$blog) {
            return $this->response->setJSON(['success' => false, 'error' => 'Blog post not found.']);
        }

        $groq = new GroqService();
        if (!$groq->isConfigured()) {
            return $this->response->setJSON(['success' => false, 'error' => 'AI service not configured. Add your Groq API key in Settings.']);
        }

        $url = base_url('blog/' . $blog['blog_url']);
        $result = $groq->generateAllSocialPosts($blog['blog_title'], $blog['blog_description'], $url);

        if (!$result['success']) {
            return $this->response->setJSON(['success' => false, 'error' => $result['error'] ?? 'AI generation failed.']);
        }

        $generated = $result['content'];
        if (!is_array($generated)) {
            return $this->response->setJSON(['success' => false, 'error' => 'Invalid AI response format.']);
        }

        $platforms = ['twitter', 'facebook', 'linkedin', 'instagram', 'tiktok'];
        $saved = [];

        foreach ($platforms as $platform) {
            if (!isset($generated[$platform])) continue;

            $postContent = is_array($generated[$platform]) ? ($generated[$platform]['content'] ?? '') : $generated[$platform];
            $hashtags = is_array($generated[$platform]) ? ($generated[$platform]['hashtags'] ?? '') : '';

            if (empty($postContent)) continue;

            // Generate video script for TikTok
            $videoScript = null;
            if ($platform === 'tiktok') {
                $scriptResult = $groq->generateVideoScript($blog['blog_title'], $blog['blog_description'], 'tiktok', 60);
                if ($scriptResult['success']) {
                    $videoScript = $scriptResult['content'];
                }
            }

            $this->socialModel->insert([
                'blog_id'      => $blogId,
                'platform'     => $platform,
                'content'      => $postContent,
                'hashtags'     => $hashtags,
                'link_url'     => $url,
                'video_script' => $videoScript,
                'status'       => 'draft',
                'ai_generated' => true,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]);

            $saved[$platform] = [
                'content'      => $postContent,
                'hashtags'     => $hashtags,
                'video_script' => $videoScript,
            ];
        }

        return $this->response->setJSON([
            'success'   => true,
            'generated' => $saved,
            'count'     => count($saved),
        ]);
    }
}
