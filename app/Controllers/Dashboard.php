<?php

namespace App\Controllers;

use App\Models\AlphaBlogModel;

class Dashboard extends BaseController
{
    protected $alphaBlogModel;

    public function __construct()
    {
        $this->alphaBlogModel = new AlphaBlogModel();
    }

    public function admin()
    {
        $data['title'] = 'Dashboard | Alphawonders';

        return view('dashboard/inc/header', $data) .
               view('dashboard/index', $data) .
               view('dashboard/inc/footer');
    }

    public function services()
    {
        $data['title'] = 'Services Management | Alphawonders';

        return view('dashboard/inc/header', $data) .
               view('dashboard/services', $data) .
               view('dashboard/inc/footer');
    }

    public function messages()
    {
        $data['title'] = 'Messages | Alphawonders';

        return view('dashboard/inc/header', $data) .
               view('dashboard/messages', $data) .
               view('dashboard/inc/footer');
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

    public function users_analytics()
    {
        $data['title'] = 'Users Analytics | Alphawonders';

        return view('dashboard/inc/header', $data) .
               view('dashboard/analytics/users', $data) .
               view('dashboard/inc/footer');
    }

    public function visits_analytics()
    {
        $data['title'] = 'Visits Analytics | Alphawonders';

        return view('dashboard/inc/header', $data) .
               view('dashboard/analytics/visits', $data) .
               view('dashboard/inc/footer');
    }

    public function interactions_analytics()
    {
        $data['title'] = 'Interactions Analytics | Alphawonders';

        return view('dashboard/inc/header', $data) .
               view('dashboard/analytics/interactions', $data) .
               view('dashboard/inc/footer');
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

        return view('dashboard/inc/header', $data) .
               view('dashboard/settings', $data) .
               view('dashboard/inc/footer');
    }
}
