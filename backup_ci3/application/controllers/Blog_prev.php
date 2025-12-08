<?php defined('BASEPATH') OR exit('No direct script access Allowed');

class Blog extends CI_Controller
{
	public function __CONSTRUCT()
	{
		parent::__construct();
	}

	public function qtm_comp()
	{
		$page = 'Blog | Alphawonders';
		$data['title'] = $page;

		// $this->alpha_blog_model->retrieve_blog();

		$this->load->view('layout/header', $data);
		$this->load->view('blog/qtm_comp');
		$this->load->view('layout/footer');
	}

	public function dtsci()
	{
		$page = 'Blog | Alphawonders';
		$data['title'] = $page;

		// $this->alpha_blog_model->retrieve_blog();

		$this->load->view('layout/header', $data);
		$this->load->view('blog/data_sci');
		$this->load->view('layout/footer');
	}

	public function privacy()
	{
		$page = 'Blog | Alphawonders';
		$data['title'] = $page;

		// $this->alpha_blog_model->retrieve_blog();

		$this->load->view('layout/header', $data);
		$this->load->view('blog/privacy');
		$this->load->view('layout/footer');
	}

	public function robotics()
	{
		$page = 'Blog | Alphawonders';
		$data['title'] = $page;

		// $this->alpha_blog_model->retrieve_blog();

		$this->load->view('layout/header', $data);
		$this->load->view('blog/robotics');
		$this->load->view('layout/footer');
	}

	



}