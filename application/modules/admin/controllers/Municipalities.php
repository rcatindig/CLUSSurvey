<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Municipalities extends ADMIN_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('municipalities_model', 'mm');	
	}

	public function index()
	{

		$data = array(
				'municipalities' => TRUE
			);


		$data['load_js'] = array(

			"module/admin/municipalities"

		);
			 
		$this->template->load($data, 'template', 'municipalities', 'admin');
	}


	public function get_municipalities()
	{
		try
		{

			
			$params = array();
			$lst = $this->mm->get_municipalities();



			$aodata = array();
			$aodata["recordsTotal"] = count($lst);
			$aodata["recordsFiltered"] = count($lst);
			$aodata["data"] =  array();


			if(!EMPTY($lst))
			{
				foreach($lst as $l)
				{
					$action			= "";

					$id				= $l->id;
					$county 		= $l->county_name;
					$municipality 	= $l->municipality_name;

					$action				.= "<div class='text-center'><a  class='btn btn-success' ";
					$action				.= "href='". base_url()  ."admin/organisations/show/".  $id . "' ";

					$action				.= " data-target='#myModal'>View</a>";

					$aodata["data"][] = array(
							$county,
							$municipality,
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

	public function upload_excel()
	{
		$file = FCPATH . PATH_UPLOAD . 'List_County_Municipalities.xlsx';
		//load the excel library
		$this->load->library('excel');


		//read file from path
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		//get only the Cell Collection
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		//extract to a PHP readable array format
		foreach ($cell_collection as $cell) {
		    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
		    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
		    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
		    //header will/should be in row 1 only. of course this can be modified to suit your need.
		    if ($row == 1) {
		        $header[$row][$column] = $data_value;
		    } else {	
		        $arr_data[$row][$column] = $data_value;
		    }
		}
		//send the data in an array format

		$new_arr = array();
		

		foreach($arr_data as $arr){

			$new_arr[] = array(
					'county_name' => $arr['A'],
					'municipality_name' => $arr['B']
				);

		}

		$this->mm->multiple_insert($new_arr);
	}


}