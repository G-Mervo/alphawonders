<?php

namespace App\Controllers;

use App\Models\AlphaWModel;
use App\Models\AlphaBlogModel;
use CodeIgniter\Controller;

class Alphawonders extends BaseController
{
    protected $alphaWModel;
    protected $alphaBlogModel;

    public function __construct()
    {
        $this->alphaWModel = new AlphaWModel();
        $this->alphaBlogModel = new AlphaBlogModel();
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
            return redirect()->to(base_url())->with('success', 'Request submitted successfully!');
        } else {
            return redirect()->to(base_url('/'));
        }
    }

    public function alphablog()
    {
        $data['title'] = 'Blog | Alphawonders';
        
        try {
            $data['blogs'] = $this->alphaBlogModel->retrieveBlog();
        } catch (\Exception $e) {
            $data['blogs'] = [];
        }

        return view('layout/header', $data) . 
               view('blog/index', $data) . 
               view('layout/footer');
    }

    public function alphapost()
    {
        $data['title'] = 'Blog | Alphawonders';

        return view('layout/header', $data) . 
               view('blog/post', $data) . 
               view('layout/footer');
    }

    public function post_comments()
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'comm-sct' => 'required|trim'
        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->to(base_url('/'));
        }

        $userAgent = $this->request->getUserAgent();
        $device = $userAgent->isMobile() ? 'Mobile' : 'Desktop';

        $data = [
            'email_addr' => 'null',
            'phoneno' => 'null',
            'comment' => $this->request->getPost('comm-sct'),
            'commentee' => 'guest',
            'activity_name' => 'Post Comment',
            'post_id' => '1',
            'browser_name' => $userAgent->getBrowser() . ' ' . $userAgent->getVersion(),
            'ip_address' => $this->request->getIPAddress(),
            'platform' => $userAgent->getPlatform(),
            'referral' => $this->request->getServer('HTTP_REFERER'),
            'device' => $device,
            'time' => date("Y-m-d H:i:s"),
        ];

        if ($this->alphaBlogModel->insertComments($data)) {
            return redirect()->to(base_url())->with('success', 'Comment posted successfully!');
        } else {
            return redirect()->to(base_url('/'));
        }
    }
}


