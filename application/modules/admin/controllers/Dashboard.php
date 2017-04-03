<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends ADMIN_Controller {

	protected $access = "admin";

	public function __construct(){
		parent::__construct();
		// $this->load->model('our_profile_model', 'opm');	
	}

	public function index()
	{

		$data = array(
			);

		
			 
			$this->template->load($data, 'template', 'dashboard', 'admin');
	}

	
}
