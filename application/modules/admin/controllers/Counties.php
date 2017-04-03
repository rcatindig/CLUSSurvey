<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Counties extends ADMIN_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('counties_model', 'cm');	
	}

	public function index()
	{

		$data = array(
				'counties' => TRUE
			);


		$data['load_js'] = array(

			"module/admin/counties"

		);
			 
		$this->template->load($data, 'template', 'counties', 'admin');
	}

	public function get_counties()
	{
		try
		{
			$params = array();
			$lst = $this->cm->get_counties();



			$aodata = array();
			$aodata["recordsTotal"] = count($lst);
			$aodata["recordsFiltered"] = count($lst);
			$aodata["data"] =  array();


			if(!EMPTY($lst))
			{
				foreach($lst as $l)
				{
					$action			= "";

					$id		= $l->id;
					$name 	= $l->county_name;

					$action				.= "<div class='text-center'><a  class='btn btn-success' ";
					$action				.= "href='". base_url()  ."admin/organisations/show/".  $id . "' ";

					$action				.= " data-target='#myModal'>View</a>";

					$aodata["data"][] = array(
							$name,
							$action
						);
				}	
			}

			echo json_encode($aodata);

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}


	}
}