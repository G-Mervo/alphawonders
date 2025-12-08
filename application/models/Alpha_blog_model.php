<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Alpha_blog_model extends CI_Model {

	public function __CONSTRUCT()	
	{
		parent::__CONSTRUCT();
	}

	public function retrieve_blog()
	{
		// $query = $this->db->query("SELECT * FROM blog;");
		$query = $this->db->get('blog');

		// $blogs = array();

		foreach ($query->result() as $row)
		{
		   $blog[] = $row;
		}

		return $blog;
	}

	public function insert_comments($data)
	{
		// var_dump($data); exit;
		$query = $this->db->insert('posts_comments', $data);
	}
}