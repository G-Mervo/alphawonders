<?php defined('BASEPATH') OR exit('No direct script access Allowed');

class Administrator extends My_Controller
{
	public function __CONSTRUCT()
	{
		parent::__construct();

		$this->load->helper('postAcceptor');
	}

	public function index()
	{
		$page = 'Alphawonders - The Alpha Technology';
		$data['title'] = $page;

		$this->load->view('dashboard/inc/header', $data);
		$this->load->view('dashboard/index');
		$this->load->view('dashboard/inc/footer');
	}

	public function admin()
	{
		$page = 'Alphawonders - The Alpha Technology';
		$data['title'] = $page;

		$this->load->view('dashboard/inc/header', $data);
		$this->load->view('dashboard/index');
		$this->load->view('dashboard/inc/footer');
	}

	public function services ()
	{
		$page = 'Alphawonders - The Alpha Technology';
		$data['title'] = $page;

		$this->load->view('dashboard/inc/header', $data);
		$this->load->view('dashboard/services');
		$this->load->view('dashboard/inc/footer');
	}

	

	public function users()
	{

		$page = 'Alphawonders - The Alpha Technology';
		$data['title'] = $page;

		$this->load->view('dashboard/inc/header', $data);
		$this->load->view('dashboard/users');
		$this->load->view('dashboard/inc/footer');
	}

	public function messages()
	{
		$page = 'Alphawonders - The Alpha Technology';
		$data['title'] = $page;

		$this->load->view('dashboard/inc/header', $data);
		$this->load->view('dashboard/messages');
		$this->load->view('dashboard/inc/footer');
	}

	public function blog()
	{
		$page = 'Alphawonders - The Alpha Technology';
		$data['title'] = $page;

		$this->load->view('dashboard/inc/header', $data);
		$this->load->view('dashboard/blog');
		$this->load->view('dashboard/inc/footer');
	}

	public function blog_save()
	{
		$data = $this->input->post();

		var_dump($data); exit;
	}

	public function users_analytics()
	{
		$page = 'Alphawonders - The Alpha Technology';
		$data['title'] = $page;

		$this->load->view('dashboard/inc/header', $data);
		$this->load->view('dashboard/users-analytics');
		$this->load->view('dashboard/inc/footer');
	}

	public function visits_analytics()
	{

		$page = 'Alphawonders - The Alpha Technology';
		$data['title'] = $page;

		$this->load->view('dashboard/inc/header', $data);
		$this->load->view('dashboard/visits-analytics');
		$this->load->view('dashboard/inc/footer');
	}

	public function interactions_analytics()
	{
		$page = 'Alphawonders - The Alpha Technology';
		$data['title'] = $page;

		$this->load->view('dashboard/inc/header', $data);
		$this->load->view('dashboard/interactions-analytics');
		$this->load->view('dashboard/inc/footer');
	}

	public function products()
	{
		$page = 'Alphawonders - The Alpha Technology';
		$data['title'] = $page;

		$this->load->view('dashboard/inc/header', $data);
		$this->load->view('dashboard/products');
		$this->load->view('dashboard/inc/footer');
	}

	public function settings()
	{
		$page = 'Alphawonders - The Alpha Technology';
		$data['title'] = $page;

		$this->load->view('dashboard/inc/header', $data);
		$this->load->view('dashboard/settings');
		$this->load->view('dashboard/inc/footer');
	}

	public function tester()
	{
		// $page = 'Alphawonders - The Alpha Technology';
		$page = 'Alphawonders Full Report Generator';
		$data['title'] = $page;

		$this->load->view('includes/header', $data);
		$this->load->view('dashboard/tester');
	}



}