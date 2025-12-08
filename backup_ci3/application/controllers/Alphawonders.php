<?php defined('BASEPATH') OR exit('No direct script access Allowed');

class Alphawonders extends My_Controller
{
	public function __CONSTRUCT()
	{
		parent::__CONSTRUCT();
		$this->load->model('alpha_w_model');
		$this->load->model('alpha_blog_model');
	}

	public function index()
	{	
		$data['title'] = 'Alphawonders';
		$data['blogs'] = $this->alpha_blog_model->retrieve_blog();

		// $DYA = $this->alpha_blog_model->retrieve_blog();

		

		// var_dump($DYA); exit;

		$this->load->view('layout/header',$data);
		$this->load->view('index');
		$this->load->view('layout/footer');
	}

	public function home()
	{
		$data['title'] = 'Alphawonders Solutions';

		// $data['blog'] = $this->alpha_blog_model->retrieve_blog();

		// var_dump($data); exit;

		$this->load->view('layout/header',$data);
		$this->load->view('alphawonders');
		$this->load->view('layout/footer');
	}

	public function alphasoftwares()
	{
		$page = 'software | Alphawonders';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphasoftwares');
		$this->load->view('layout/footer');
	}

	public function alphasystems()
	{
		$page = 'System';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphasystems');
		$this->load->view('layout/footer');
	}

	public function alphadesign()
	{
		$page = 'Design | Alphawonders';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphadesigns');
		$this->load->view('layout/footer');
	}

	public function alphamarketing()
	{
		$page = 'Digital Marketing | Alphawonders';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphamarketing');
		$this->load->view('layout/footer');
	}

	public function alphaconsultancy()
	{
		$page = 'IT Consultancy | Alphawonders';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphaconsultancy');
		$this->load->view('layout/footer');
	}

	public function alphasupport()
	{
		$page = 'IT Support | Alphawonders';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphasupport');
		$this->load->view('layout/footer');
	}

	public function alphahires()
	{
		$page = 'Hire | Alphawonders';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('hires');
		$this->load->view('layout/footer');
	}

	/*public function alphapplications()
	{
		$page = 'Applications';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphapplications');
		$this->load->view('layout/footer');
	}

	public function alphaweb()
	{
		$data['title'] = "Web solutions";

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphaweb');
		$this->load->view('layout/footer');
	}	

	public function alphacommerce()
	{
		$page = 'Ecommerce';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphacommerce');
		$this->load->view('layout/footer');
	}

	public function alphadata()
	{
		$page = 'Data Services';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphadata');
		$this->load->view('layout/footer');
	}

	public function alphasecurity()
	{
		$page = 'Security';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphasecurity');
		$this->load->view('layout/footer');
	}

	public function alphaprototyping()
	{
		$page = 'Prototyping';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('services/alphaprototyping');
		$this->load->view('layout/footer');
	}

	public function alphaprofile()
	{
		$page = 'Alphawonders Profile & Portfolio';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('profile');
		$this->load->view('layout/footer');
	}	*/

	public function contact()
	{
		$page = 'Contact us | Alphawonders';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('contacts');
		$this->load->view('layout/footer');
	}

	public function send_contact_data()
	{
		$data = $this->input->post();

		if (isset($_POST) && ( ! empty($_POST)))
        {
        	// validate form input
			$this->form_validation->set_rules('fullname', str_replace(':', '', $this->lang->line('create_eventype_label')), 'trim|required');
			$this->form_validation->set_rules('email', str_replace(':', '', $this->lang->line('create_eventype_label')), 'trim|required');
			$this->form_validation->set_rules('phone_number', str_replace(':', '', $this->lang->line('create_eventype_label')), 'trim|required');
			$this->form_validation->set_rules('message', str_replace(':', '', $this->lang->line('create_eventype_label')), 'trim|required');
        

	        if ($this->form_validation->run() === TRUE)
			{
				$activity = 'Contact us';
				$description = 'send message';
				$device;

		    	if ($this->agent->mobile())
		    	{
		    		$device = 'Mobile';
		    	} 
		    	else 
		    	{
		    		$device = 'Desktop';
		    	}

				$data = array(
					'full_name' => $this->input->post('fullname'),
					'email_addr' => $this->input->post('email'),
					'phoneno' => $this->input->post('phone_number'),
					'message' => $this->input->post('message'),
					'activity_name' => $activity,
			        // 'data'=> $description,
			        'browser_name' => $this->agent->browser().' '.$this->agent->version(),
			        'ip_address' => $this->input->ip_address(),
			        'platform' => $this->agent->platform(),
			        'referral' => $this->agent->referrer(),
			        'device' => $device,
			        'time' => date("Y-m-d H:i:s"),
				);

				// var_dump($data); exit;

				if ($this->alpha_w_model->save_message($data) === TRUE)
				{
					// $this->session->set_flashdata('message', $this->ion_auth->messages());
						// echo "successfully saved the message";
					redirect(base_url());
				}
				else {
					// echo 'failed to save the mesage';
					redirect(base_url('contact-us'));
				}
			}
			else
			{
				// echo "Saving the message failed";
				return redirect(base_url('contact-us'));
			}
		}
		else
        {
        	// echo "hall- Saving the message failed";
            return redirect(base_url('contact-us'));
        }			

	}

	public function subscriptions_email()
	{
		$data = $this->input->post();

		// var_dump($data); exit;
		if (isset($_POST) && ( ! empty($_POST)))
        {
        	// validate form input
			$this->form_validation->set_rules('email_sub', str_replace(':', '', $this->lang->line('create_eventype_label')), 'trim|required');

	        if ($this->form_validation->run() === TRUE)
			{
				$activity = 'Subscribe';

		    	if ($this->agent->mobile())
		    	{
		    		$device = 'Mobile';
		    	} 
		    	else 
		    	{
		    		$device = 'Desktop';
		    	}

				$data = array(
					'email' => $this->input->post('email_sub'),
					'activity_name' => $activity,
			        'browser_name' => $this->agent->browser().' '.$this->agent->version(),
			        'ip_address' => $this->input->ip_address(),
			        'platform' => $this->agent->platform(),
			        'referral' => $this->agent->referrer(),
			        'device' => $device,
			        'time' => date("Y-m-d H:i:s"),
				);

				// var_dump($data); exit;

				if ($this->alpha_w_model->insert_subscr($data) === TRUE)
				{
					// $this->session->set_flashdata('message', $this->ion_auth->messages());
						// echo "successfully saved the message";
					redirect(base_url());
				}
				else {
					// echo 'failed to save the mesage';
					redirect(base_url('/'));
				}
			}
			else
			{
				// echo "Saving the message failed";
				return redirect(base_url('/'));
			}
		}
		else
        {
        	// echo "hall- Saving the message failed";
            return redirect(base_url('/'));
        }	

	}

	public function hires_details()
	{
		$data = $this->input->post();

		// var_dump($data); exit;

		if (isset($_POST) && ( ! empty($_POST)))
        {
        	// validate form input
			$this->form_validation->set_rules('name', str_replace(':', '', $this->lang->line('create_name_label')), 'trim|required');
			$this->form_validation->set_rules('email', str_replace(':', '', $this->lang->line('create_email_label')), 'trim|required');
			$this->form_validation->set_rules('telno', str_replace(':', '', $this->lang->line('create_telno_label')), 'trim|required');
			$this->form_validation->set_rules('budget', str_replace(':', '', $this->lang->line('create_budget_label')), 'trim|required');
			$this->form_validation->set_rules('loc', str_replace(':', '', $this->lang->line('create_count_label')), 'trim|required');
			$this->form_validation->set_rules('sky', str_replace(':', '', $this->lang->line('create_sky_whts_label')), 'trim|required');
			$this->form_validation->set_rules('client', str_replace(':', '', $this->lang->line('create_proj_desc_label')), 'trim|required');
			$this->form_validation->set_rules('work', str_replace(':', '', $this->lang->line('create_proj_desc_label')), 'trim|required');
			$this->form_validation->set_rules('whts', str_replace(':', '', $this->lang->line('create_proj_desc_label')), 'trim|required');
			$this->form_validation->set_rules('proj_desc', str_replace(':', '', $this->lang->line('create_proj_desc_label')), 'trim|required');

	        if ($this->form_validation->run() === TRUE)
			{
				$activity = 'Hire us';
				$device;

		    	if ($this->agent->mobile())
		    	{
		    		$device = 'Mobile';
		    	} 
		    	else 
		    	{
		    		$device = 'Desktop';
		    	}

		    	$nature = "contract";

				$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'tel' => $this->input->post('telno'),
					'budget' => $this->input->post('budget'),
					'location' => $this->input->post('loc'),
					'skype' => $this->input->post('sky'),
					'client' => $this->input->post('client'),
					'work' => $this->input->post('work'),
					'nature' => $nature,
					'whatsapp' => $this->input->post('whts'),
					'description' => $this->input->post('proj_desc'),
					'activity_name' => $activity,
			        'browser_name' => $this->agent->browser().' '.$this->agent->version(),
			        'ip_address' => $this->input->ip_address(),
			        'platform' => $this->agent->platform(),
			        'referral' => $this->agent->referrer(),
			        'device' => $device,
			        'time' => date("Y-m-d H:i:s"),
				);

				// var_dump($data); exit;

				if ($this->alpha_w_model->hires($data) === TRUE)
				{
					// $this->session->set_flashdata('message', $this->ion_auth->messages());
						// echo "successfully saved the message";
					redirect(base_url());
				}
				else {
					// echo 'failed to save the mesage';
					redirect(base_url('/'));
				}
			}
			else
			{
				// echo "Saving the message failed";
				return redirect(base_url('/'));
			}
		}
		else
        {
        	// echo "hall- Saving the message failed";
            return redirect(base_url('/'));
        }			
	}

	public function alphablog()
	{
		$page = 'Blog | Alphawonders';
		$data['title'] = $page;

		// $this->alpha_blog_model->retrieve_blog();

		$this->load->view('layout/header', $data);
		$this->load->view('blog/index');
		$this->load->view('layout/footer');
	}

	public function alphapost()
	{
		$page = 'Blog | Alphawonders';
		$data['title'] = $page;

		$this->load->view('layout/header', $data);
		$this->load->view('blog/post');
		$this->load->view('layout/footer');
	}

	public function post_comments()
	{
		$data = $this->input->post();

		// var_dump($data); exit;

		if (isset($_POST) && ( ! empty($_POST)))
        {
        	// validate form input
			$this->form_validation->set_rules('comm-sct', str_replace(':', '', $this->lang->line('create_eventype_label')), 'trim|required');

	        if ($this->form_validation->run() === TRUE)
			{
				$activity = 'Post Comment';
				$description = 'Comment on the blog post';
				$name = 'guest comment';
				$post_id = "1";
				$commentee = "guest";				
				$device;
				$phone_number = "null";
				$email_addr = "null";


		    	if ($this->agent->mobile())
		    	{
		    		$device = 'Mobile';
		    	} 
		    	else 
		    	{
		    		$device = 'Desktop';
		    	}

				$data = array(
					'email_addr' => $email_addr,
					'phoneno' => $phone_number,
					'comment' => $this->input->post('comm-sct'),
					'commentee' => $commentee,
					'activity_name' => $activity,
			        'post_id'=> $post_id,
			        'browser_name' => $this->agent->browser().' '.$this->agent->version(),
			        'ip_address' => $this->input->ip_address(),
			        'platform' => $this->agent->platform(),
			        'referral' => $this->agent->referrer(),
			        'device' => $device,
			        'time' => date("Y-m-d H:i:s"),
				);

				// var_dump($data); exit;

				if ($this->alpha_blog_model->insert_comments($data) === TRUE)
				{
					// $this->session->set_flashdata('message', $this->ion_auth->messages());
						// echo "successfully saved the message";
					redirect(base_url());
				}
				else {
					// echo 'failed to save the mesage';
					redirect(base_url('/'));
				}
			}
			else
			{
				// echo "Saving the message failed";
				return redirect(base_url('/'));
			}
		}
		else
        {
        	// echo "hall- Saving the message failed";
            return redirect(base_url('/'));
        }			
	}


}