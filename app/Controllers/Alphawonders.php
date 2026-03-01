<?php

namespace App\Controllers;

use App\Models\AlphaWModel;
use App\Models\AlphaBlogModel;
use App\Models\BlogCategoryModel;
use App\Models\BlogTagModel;
use CodeIgniter\Controller;

class Alphawonders extends BaseController
{
    protected $alphaWModel;
    protected $alphaBlogModel;
    protected $blogCategoryModel;
    protected $blogTagModel;

    public function __construct()
    {
        $this->alphaWModel = new AlphaWModel();
        $this->alphaBlogModel = new AlphaBlogModel();
        $this->blogCategoryModel = new BlogCategoryModel();
        $this->blogTagModel = new BlogTagModel();
    }

    public function sitemap()
    {
        $baseUrl = 'https://alphawonders.com';
        $today = date('Y-m-d');

        // Static pages with priority
        $staticPages = [
            ['loc' => '/',                      'changefreq' => 'weekly',   'priority' => '1.0'],
            ['loc' => '/softwares',             'changefreq' => 'monthly',  'priority' => '0.8'],
            ['loc' => '/system-administration', 'changefreq' => 'monthly',  'priority' => '0.8'],
            ['loc' => '/design',                'changefreq' => 'monthly',  'priority' => '0.8'],
            ['loc' => '/digital-marketing',     'changefreq' => 'monthly',  'priority' => '0.8'],
            ['loc' => '/ict-consultancy',       'changefreq' => 'monthly',  'priority' => '0.8'],
            ['loc' => '/it-support',            'changefreq' => 'monthly',  'priority' => '0.8'],
            ['loc' => '/ai-services',           'changefreq' => 'monthly',  'priority' => '0.8'],
            ['loc' => '/hire',                  'changefreq' => 'monthly',  'priority' => '0.7'],
            ['loc' => '/contact-us',            'changefreq' => 'monthly',  'priority' => '0.7'],
            ['loc' => '/blog',                  'changefreq' => 'weekly',   'priority' => '0.9'],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Add static pages
        foreach ($staticPages as $page) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . $baseUrl . $page['loc'] . '</loc>' . "\n";
            $xml .= '    <lastmod>' . $today . '</lastmod>' . "\n";
            $xml .= '    <changefreq>' . $page['changefreq'] . '</changefreq>' . "\n";
            $xml .= '    <priority>' . $page['priority'] . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        // Add blog posts from database
        try {
            $posts = $this->alphaBlogModel->orderBy('date_created', 'DESC')->findAll();
            $categories = [];

            foreach ($posts as $post) {
                $lastmod = !empty($post['date_modified']) ? date('Y-m-d', strtotime($post['date_modified'])) : date('Y-m-d', strtotime($post['date_created']));

                $xml .= '  <url>' . "\n";
                $xml .= '    <loc>' . $baseUrl . '/blog/' . esc($post['blog_url']) . '</loc>' . "\n";
                $xml .= '    <lastmod>' . $lastmod . '</lastmod>' . "\n";
                $xml .= '    <changefreq>monthly</changefreq>' . "\n";
                $xml .= '    <priority>0.6</priority>' . "\n";
                $xml .= '  </url>' . "\n";

                // Collect unique categories
                if (!empty($post['blog_category']) && !in_array($post['blog_category'], $categories)) {
                    $categories[] = $post['blog_category'];
                }
            }

            // Add blog category pages
            foreach ($categories as $category) {
                $xml .= '  <url>' . "\n";
                $xml .= '    <loc>' . $baseUrl . '/blog/category/' . esc($category) . '</loc>' . "\n";
                $xml .= '    <lastmod>' . $today . '</lastmod>' . "\n";
                $xml .= '    <changefreq>weekly</changefreq>' . "\n";
                $xml .= '    <priority>0.7</priority>' . "\n";
                $xml .= '  </url>' . "\n";
            }

            // Add blog tag pages
            $tags = $this->blogTagModel->findAll();
            foreach ($tags as $tag) {
                $xml .= '  <url>' . "\n";
                $xml .= '    <loc>' . $baseUrl . '/blog/tag/' . esc($tag['slug']) . '</loc>' . "\n";
                $xml .= '    <lastmod>' . $today . '</lastmod>' . "\n";
                $xml .= '    <changefreq>weekly</changefreq>' . "\n";
                $xml .= '    <priority>0.5</priority>' . "\n";
                $xml .= '  </url>' . "\n";
            }
        } catch (\Exception $e) {
            log_message('error', 'Sitemap generation error: ' . $e->getMessage());
        }

        $xml .= '</urlset>';

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->setBody($xml);
    }

    public function index()
    {
        $data['title'] = 'Alphawonders';

        try {
            $data['blogs'] = $this->alphaBlogModel->retrieveBlog();
        } catch (\Exception $e) {
            $data['blogs'] = [];
        }

        return view('layout/header', $data) .
               view('index', $data) .
               view('layout/footer');
    }

    public function home()
    {
        $data['title'] = 'Alphawonders Solutions';

        return view('layout/header', $data) .
               view('alphawonders', $data) .
               view('layout/footer');
    }

    public function alphasoftwares()
    {
        $data['title'] = 'software | Alphawonders';

        return view('layout/header', $data) .
               view('services/alphasoftwares', $data) .
               view('layout/footer');
    }

    public function alphasystems()
    {
        $data['title'] = 'System';

        return view('layout/header', $data) .
               view('services/alphasystems', $data) .
               view('layout/footer');
    }

    public function alphadesign()
    {
        $data['title'] = 'Design | Alphawonders';

        return view('layout/header', $data) .
               view('services/alphadesigns', $data) .
               view('layout/footer');
    }

    public function alphamarketing()
    {
        $data['title'] = 'Digital Marketing | Alphawonders';

        return view('layout/header', $data) .
               view('services/alphamarketing', $data) .
               view('layout/footer');
    }

    public function alphaconsultancy()
    {
        $data['title'] = 'IT Consultancy | Alphawonders';

        return view('layout/header', $data) .
               view('services/alphaconsultancy', $data) .
               view('layout/footer');
    }

    public function alphasupport()
    {
        $data['title'] = 'IT Support | Alphawonders';

        return view('layout/header', $data) .
               view('services/alphasupport', $data) .
               view('layout/footer');
    }

    public function alphaiservices()
    {
        $data['title'] = 'AI Services | Alphawonders';

        return view('layout/header', $data) .
               view('services/alphaiservices', $data) .
               view('layout/footer');
    }

    public function alphahires()
    {
        $data['title'] = 'Hire | Alphawonders';

        return view('layout/header', $data) .
               view('hires', $data) .
               view('layout/footer');
    }

    public function contact()
    {
        $data['title'] = 'Contact us | Alphawonders';

        return view('layout/header', $data) .
               view('contacts', $data) .
               view('layout/footer');
    }

    public function send_contact_data()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'fullname' => 'required|trim',
            'email' => 'required|valid_email|trim',
            'phone_number' => 'required|trim',
            'message' => 'required|trim'
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->to(base_url('contact-us'))->withInput();
        }

        $userAgent = $this->request->getUserAgent();
        $device = $userAgent->isMobile() ? 'Mobile' : 'Desktop';

        $data = [
            'full_name' => $this->request->getPost('fullname'),
            'email_addr' => $this->request->getPost('email'),
            'phoneno' => $this->request->getPost('phone_number'),
            'message' => $this->request->getPost('message'),
            'activity_name' => 'Contact us',
            'browser_name' => $userAgent->getBrowser() . ' ' . $userAgent->getVersion(),
            'ip_address' => $this->request->getIPAddress(),
            'platform' => $userAgent->getPlatform(),
            'referral' => $this->request->getServer('HTTP_REFERER'),
            'device' => $device,
            'time' => date("Y-m-d H:i:s"),
        ];

        if ($this->alphaWModel->saveMessage($data)) {
            return redirect()->to(base_url())->with('success', 'Message sent successfully!');
        } else {
            return redirect()->to(base_url('contact-us'))->with('error', 'Failed to send message.');
        }
    }

    public function subscriptions_email()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'email_sub' => 'required|valid_email|trim'
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->to(base_url('/'));
        }

        $userAgent = $this->request->getUserAgent();
        $device = $userAgent->isMobile() ? 'Mobile' : 'Desktop';

        $data = [
            'email' => $this->request->getPost('email_sub'),
            'activity_name' => 'Subscribe',
            'browser_name' => $userAgent->getBrowser() . ' ' . $userAgent->getVersion(),
            'ip_address' => $this->request->getIPAddress(),
            'platform' => $userAgent->getPlatform(),
            'referral' => $this->request->getServer('HTTP_REFERER'),
            'device' => $device,
            'time' => date("Y-m-d H:i:s"),
        ];

        if ($this->alphaWModel->insertSubscr($data)) {
            return redirect()->to(base_url())->with('success', 'Subscribed successfully!');
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function hires_details()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|trim',
            'email' => 'required|valid_email|trim',
            'telno' => 'required|trim',
            'budget' => 'required|trim',
            'loc' => 'required|trim',
            'sky' => 'permit_empty|trim',
            'client' => 'required|trim',
            'work' => 'required|trim',
            'whts' => 'permit_empty|trim',
            'proj_desc' => 'required|trim',
            'company_name' => 'permit_empty|trim',
            'industry' => 'permit_empty|trim',
            'project_type' => 'permit_empty|trim',
            'timeline' => 'permit_empty|trim'
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->to(base_url('/'));
        }

        $userAgent = $this->request->getUserAgent();
        $device = $userAgent->isMobile() ? 'Mobile' : 'Desktop';

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'tel' => $this->request->getPost('telno'),
            'budget' => $this->request->getPost('budget'),
            'location' => $this->request->getPost('loc'),
            'skype' => $this->request->getPost('sky'),
            'client' => $this->request->getPost('client'),
            'work' => $this->request->getPost('work'),
            'nature' => $this->request->getPost('project_type') ?: 'contract',
            'whatsapp' => $this->request->getPost('whts'),
            'description' => $this->request->getPost('proj_desc'),
            'company_name' => $this->request->getPost('company_name'),
            'industry' => $this->request->getPost('industry'),
            'timeline' => $this->request->getPost('timeline'),
            'activity_name' => 'Hire us',
            'browser_name' => $userAgent->getBrowser() . ' ' . $userAgent->getVersion(),
            'ip_address' => $this->request->getIPAddress(),
            'platform' => $userAgent->getPlatform(),
            'referral' => $this->request->getServer('HTTP_REFERER'),
            'device' => $device,
            'time' => date("Y-m-d H:i:s"),
        ];

        if ($this->alphaWModel->hires($data)) {
            // Send email notification
            $this->sendHireNotification($data);
            return redirect()->to(base_url())->with('success', 'Request submitted successfully!');
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    private function sendHireNotification(array $data): void
    {
        try {
            $email = \Config\Services::email();

            $email->setFrom(config('Email')->fromEmail, config('Email')->fromName);
            $email->setTo('mervin@alphawonders.com');
            $email->setSubject('New Hire Request from ' . esc($data['name']));

            $body = '
            <html>
            <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
                <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div style="background: linear-gradient(135deg, #041640, #0a2a5a); color: #ffffff; padding: 20px 30px;">
                        <h2 style="margin: 0; font-size: 22px;">New Hire Request</h2>
                        <p style="margin: 5px 0 0; opacity: 0.8; font-size: 14px;">Submitted on ' . date('M d, Y \a\t h:i A') . '</p>
                    </div>
                    <div style="padding: 30px;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640; width: 35%;">Name</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['name']) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">Email</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;"><a href="mailto:' . esc($data['email']) . '">' . esc($data['email']) . '</a></td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">Phone</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['tel']) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">Budget</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['budget']) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">Location</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['location']) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">Client Type</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['client']) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">Work Type</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['work']) . '</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">Project Type</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['nature']) . '</td>
                            </tr>' .
                            (!empty($data['company_name']) ? '
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">Company</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['company_name']) . '</td>
                            </tr>' : '') .
                            (!empty($data['industry']) ? '
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">Industry</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['industry']) . '</td>
                            </tr>' : '') .
                            (!empty($data['timeline']) ? '
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">Timeline</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['timeline']) . '</td>
                            </tr>' : '') .
                            (!empty($data['skype']) ? '
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">Skype</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['skype']) . '</td>
                            </tr>' : '') .
                            (!empty($data['whatsapp']) ? '
                            <tr>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee; font-weight: bold; color: #041640;">WhatsApp</td>
                                <td style="padding: 10px 0; border-bottom: 1px solid #eee;">' . esc($data['whatsapp']) . '</td>
                            </tr>' : '') . '
                        </table>
                        <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 6px; border-left: 4px solid #ffb000;">
                            <strong style="color: #041640;">Project Description:</strong>
                            <p style="margin: 8px 0 0; color: #333; line-height: 1.6;">' . nl2br(esc($data['description'])) . '</p>
                        </div>
                        <div style="margin-top: 20px; padding: 10px; background: #e8f4f8; border-radius: 6px; font-size: 12px; color: #666;">
                            <strong>Device:</strong> ' . esc($data['device']) . ' |
                            <strong>Browser:</strong> ' . esc($data['browser_name']) . ' |
                            <strong>IP:</strong> ' . esc($data['ip_address']) . '
                        </div>
                    </div>
                    <div style="background: #041640; color: #aaa; padding: 15px 30px; font-size: 12px; text-align: center;">
                        Alphawonders Solutions &mdash; Providing ICT Expertise &amp; Services
                    </div>
                </div>
            </body>
            </html>';

            $email->setMessage($body);
            $email->send(false);
        } catch (\Exception $e) {
            log_message('error', 'Hire notification email failed: ' . $e->getMessage());
        }
    }

    public function alphablog()
    {
        $data['title'] = 'Blog | Alphawonders';

        try {
            $data['blogs'] = $this->alphaBlogModel->getRecentPosts(6);
            $data['pager'] = $this->alphaBlogModel->pager;
            $data['recentPosts'] = $this->alphaBlogModel->orderBy('date_created', 'DESC')->limit(4)->findAll();
            $data['categories'] = $this->blogCategoryModel->getCategoriesWithPostCount();
            $data['allTags'] = $this->blogTagModel->getAllTagsWithPostCount();
        } catch (\Exception $e) {
            $data['blogs'] = [];
            $data['pager'] = null;
            $data['recentPosts'] = [];
            $data['categories'] = [];
            $data['allTags'] = [];
        }

        return view('layout/header', $data) .
               view('blog/index', $data) .
               view('layout/footer');
    }

    public function blogPost(string $slug)
    {
        $post = $this->alphaBlogModel->getPostBySlug($slug);

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Blog post not found.');
        }

        $data['title'] = esc($post['blog_title']) . ' | Alphawonders Blog';
        $data['post'] = $post;
        $data['comments'] = $this->alphaBlogModel->getCommentsByPostId((int) $post['id']);
        $data['recentPosts'] = $this->alphaBlogModel->orderBy('date_created', 'DESC')->limit(4)->findAll();
        $data['postTags'] = $this->blogTagModel->getTagsForPost((int) $post['id']);
        $data['postCategory'] = !empty($post['category_id']) ? $this->blogCategoryModel->find($post['category_id']) : null;
        $data['categories'] = $this->blogCategoryModel->getCategoriesWithPostCount();
        $data['allTags'] = $this->blogTagModel->getAllTagsWithPostCount();

        return view('layout/header', $data) .
               view('blog/show', $data) .
               view('layout/footer');
    }

    public function blogCategory(string $category)
    {
        $catRecord = $this->blogCategoryModel->getCategoryBySlug($category);
        $data['title'] = ($catRecord ? esc($catRecord['name']) : ucwords(str_replace('-', ' ', $category))) . ' | Alphawonders Blog';
        $data['category'] = $category;

        try {
            if ($catRecord) {
                $data['blogs'] = $this->alphaBlogModel->getPostsByCategoryId((int) $catRecord['id'], 6);
            } else {
                // Fallback to slug-based filtering for backward compat
                $data['blogs'] = $this->alphaBlogModel->getPostsByCategory($category, 6);
            }
            $data['pager'] = $this->alphaBlogModel->pager;
            $data['recentPosts'] = $this->alphaBlogModel->orderBy('date_created', 'DESC')->limit(4)->findAll();
            $data['categories'] = $this->blogCategoryModel->getCategoriesWithPostCount();
            $data['allTags'] = $this->blogTagModel->getAllTagsWithPostCount();
        } catch (\Exception $e) {
            $data['blogs'] = [];
            $data['pager'] = null;
            $data['recentPosts'] = [];
            $data['categories'] = [];
            $data['allTags'] = [];
        }

        return view('layout/header', $data) .
               view('blog/index', $data) .
               view('layout/footer');
    }

    public function blogTag(string $tagSlug)
    {
        $tag = $this->blogTagModel->where('slug', $tagSlug)->first();

        if (!$tag) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Tag not found.');
        }

        $data['title'] = esc($tag['name']) . ' | Alphawonders Blog';
        $data['tag'] = $tag;

        try {
            $postIds = $this->blogTagModel->getPostIdsByTag((int) $tag['id']);
            $data['blogs'] = $this->alphaBlogModel->getPostsByIds($postIds, 6);
            $data['pager'] = $this->alphaBlogModel->pager;
            $data['recentPosts'] = $this->alphaBlogModel->orderBy('date_created', 'DESC')->limit(4)->findAll();
            $data['categories'] = $this->blogCategoryModel->getCategoriesWithPostCount();
            $data['allTags'] = $this->blogTagModel->getAllTagsWithPostCount();
        } catch (\Exception $e) {
            $data['blogs'] = [];
            $data['pager'] = null;
            $data['recentPosts'] = [];
            $data['categories'] = [];
            $data['allTags'] = [];
        }

        return view('layout/header', $data) .
               view('blog/index', $data) .
               view('layout/footer');
    }

    public function post_comments()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'comm-sct' => 'required',
            'post_id' => 'required|numeric',
            'post_slug' => 'required'
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->to(base_url('blog'));
        }

        $userAgent = $this->request->getUserAgent();
        $device = $userAgent->isMobile() ? 'Mobile' : 'Desktop';

        $commentee = $this->request->getPost('commentee');

        $data = [
            'email_addr' => null,
            'phoneno' => null,
            'comment' => $this->request->getPost('comm-sct'),
            'commentee' => !empty($commentee) ? $commentee : 'guest',
            'activity_name' => 'Post Comment',
            'post_id' => $this->request->getPost('post_id'),
            'browser_name' => $userAgent->getBrowser() . ' ' . $userAgent->getVersion(),
            'ip_address' => $this->request->getIPAddress(),
            'platform' => $userAgent->getPlatform(),
            'referral' => $this->request->getServer('HTTP_REFERER'),
            'device' => $device,
            'time' => date("Y-m-d H:i:s"),
        ];

        $slug = $this->request->getPost('post_slug');

        if ($this->alphaBlogModel->insertComment($data)) {
            return redirect()->to(base_url('blog/' . $slug))->with('success', 'Comment posted successfully!');
        } else {
            return redirect()->to(base_url('blog/' . $slug));
        }
    }
}
