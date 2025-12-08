<?php defined('BASEPATH') OR exit('No direct script access Allowed');

class Valiant extends My_Controller {

	public function __CONSTRUCT()
	{
		parent::__CONSTRUCT();
        $this->load->library(array('form_validation'));
        $this->history = $this->config->item('admin_history');
        $this->load->model('Valiant_v_model');
        $this->load->model('Valiant_users_model');
	}

	public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Valiant Venture Club - Login';
        $head['description'] = '';
        $head['keywords'] = '';
        $this->load->view('valiants/_parts/header', $head);
        if ($this->session->userdata('logged_in')) {
            redirect('vvc/home');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run($this)) {
                $result = $this->Valiant_users_model->loginCheck($_POST);
                if (!empty($result)) {
                    $_SESSION['last_login'] = $result['last_login'];
                    $this->session->set_userdata('logged_in', $result['username']);
                    $this->saveHistory('User ' . $result['username'] . ' logged in');
                    redirect('vvc');
                } else {
                    $this->saveHistory('Cant login with - User: ' . $_POST['username'] . ' and Pass: ' . $_POST['username']);
                    $this->session->set_flashdata('err_login', 'Wrong username or password!');
                    redirect('groove');
                }
            }
            $this->load->view('valiants/login');
        }
        $this->load->view('valiants/_parts/footer');
    }

    public function home()
	{
		$this->login_check();

		$header = "Technology, Investment & Finance";
		$head['title'] = $header;
		$head['description'] = '';
        $head['keywords'] = '';
       

		$this->load->view('valiants/_parts/header', $head);
		$this->load->view('valiants/home');
		$this->load->view('valiants/_parts/footer');

	}

	public function vcc_index()
	{
		$this->login_check();

		$header = "Valiant Venture Club";
		$head['title'] = $header;
		$data['users'] = $this->Valiant_users_model->getusersinfo();
		// var_dump($data); exit;

		$this->load->view('valiants/lays/header', $head);
		$this->load->view('valiants/index', $data);
		$this->load->view('valiants/lays/footer');
	}

	public function create()
	{
		$this->login_check();
		$header = "Valiant Venture Club";
		$head['title'] = $header;

		if (isset($_GET['delete'])) {
            $this->Valiant_users_model->deleteAdminUser($_GET['delete']);
            $this->session->set_flashdata('result_delete', 'User is deleted!');
            redirect('vvc/register');
        }
        if (isset($_GET['edit']) && !isset($_POST['username'])) {
            $_POST = $this->Valiant_users_model->getAdminUsers($_GET['edit']);
        }
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Admin Users';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['users'] = $this->Valiant_users_model->getAdminUsers();
        $this->form_validation->set_rules('username', 'User', 'trim|required');
        $this->form_validation->set_rules('lname', 'lname', 'trim|required');
		$this->form_validation->set_rules('phoneno', 'Phoneno', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('residence', 'Residence', 'trim|required');
		$this->form_validation->set_rules('profession', 'Profession', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if (isset($_POST['edit']) && $_POST['edit'] == 0) {
        	$data = $this->input->post();
        	
        	$this->form_validation->set_rules('username', 'User', 'trim|required');
			$this->form_validation->set_rules('lname', 'Lname', 'trim|required');
			$this->form_validation->set_rules('phoneno', 'Phoneno', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('residence', 'Residence', 'trim|required');
			$this->form_validation->set_rules('profession', 'Profession', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            // var_dump($data); exit;
        }
        if ($this->form_validation->run($this)) {
        	$data = $this->input->post();
        	// var_dump($data); exit;
            $this->Valiant_users_model->setAdminUser($_POST);
            $this->saveHistory('Create admin user - ' . $_POST['username']);
            redirect('vvc/register');
        }
        

		$this->load->view('valiants/lays/header', $head);
		$this->load->view('valiants/create', $data);
		$this->load->view('valiants/lays/footer');
		$this->saveHistory('Go to Admin Users');

	}

	public function vote()
    {
    	$this->login_check();

		$header = "Technology, Investment & Finance";
		$head['title'] = $header;
		$head['description'] = '';
        $head['keywords'] = '';
        $data['vote'] = '';

    	$this->load->view('valiants/lays/header', $head);
		$this->load->view('valiants/voting', $data);
		$this->load->view('valiants/lays/footer');
		$this->saveHistory('Go to user voting');
    }

    public function saveVote()
    {
    	$this->login_check();
    	$postdata = $this->input->post();

    	$username = $this->session->userdata('logged_in');
    	$user_id = $this->Valiant_users_model->getuserid($username);

    	$data = [
    		"user_id" => $user_id,
    		"username" => $username,
    		"position" => $postdata
    	];
    	
    	$save = $this->Valiant_users_model->saveposVote($data);
    	// $this->userid = $this->session->userdata('logged_in');
    	


    	// var_dump($username); echo "<br>";
    	// var_dump($user_id['id']); echo "<br>";
    	// var_dump($postdata); exit;
    	var_dump($data); exit;
    }

    protected function login_check()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('vvc');
        }
        $this->username = $this->session->userdata('logged_in');
    }

    protected function saveHistory($activity)
    {
        if ($this->history === true) {
            $this->load->model('Valiant_history_model');
            $usr = $this->username;
            $this->Valiant_history_model->setHistory($activity, $usr);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('vvc');
    }



	
}



