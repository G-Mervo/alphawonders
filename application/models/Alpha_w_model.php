<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Alpha_w_model extends CI_Model {

	public function __CONSTRUCT()	
	{
		parent::__CONSTRUCT();
	}

	public function insert_subscr($data)
	{
		$query = $this->db->insert('subscriptions', $data);
	}

	public function hires($data)
	{
		$query = $this->db->insert('hires', $data);
	}

	public function save_message($data)
	{
		$query = $this->db->insert('messages', $data);
	}

}