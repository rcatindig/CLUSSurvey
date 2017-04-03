<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends ADMIN_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin/counties_model', 'cm');	
		$this->load->model('questions_model', 'qm');	
	}

	public function index()
	{

		$data = array(
			);

		$data['load_js'] = array(

			"questions"

		);

		// GET ALL COUNTIES
		$data["counties"] = $this->cm->get_counties();

		$this->template->load($data, 'template', 'contact');
	}

	public function continue()
	{
		$success = 0;
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
        $phone_number = $this->input->post('phone_number');
        $email_address = $this->input->post('email_address');
        $county = $this->input->post('county');

        $county_arr = explode("|", $county);
        $county_name = $county_arr[0];
        $county_id = $county_arr[1];

        $newdata = array(
        'first_name'  => $first_name,
        'last_name'     => $last_name,
        'phone_number' => $phone_number,
        'email_address' => $email_address,
        'county' => $county_name,
        'county_id' => $county_id
		);

		$this->session->set_userdata($newdata);

		var_export($newdata);

		$success = 1;

		// echo $success;
       	
	}

	public function part_1()
	{

		$county_name = $this->session->userdata('county');
		$county_id = $this->session->userdata('county_id');

		

		$data['load_js'] = array(

			"historic_preservation"

		);


		$data["county_name"] = $county_name;
		$data["county_id"] = $county_id;

		$params["county_name"] = $county_name;
		$data["municipalities"] = $this->qm->get_municipalities($params);

		$this->template->load($data, 'template', 'historic_preservation');
	}

	public function save()
	{
		try
		{

			$this->db->trans_begin();

			$msg  = "";
			$county_name = $this->session->userdata('county');
			$county_id = $this->session->userdata('county_id');
			$county_id = $this->input->post('county_id');
			$last_name = $this->session->userdata('last_name');
			$first_name = $this->session->userdata('first_name');
			$email_address = $this->session->userdata('email_address');
			$phone_number = $this->session->userdata('phone_number');

			$response_data = array(
					"first_name" => $first_name,
					"last_name" => $last_name,
					"email_address" => $email_address,
					"phone_number" => $phone_number,
					"county_id" => $county_id
				);

			$response_id = $this->qm->insert_response($response_data);



			$status = 1;

			$field_str = "";

			$params["county_name"] = $county_name;
			$municipalities = $this->qm->get_municipalities($params);

			$hist_res_mun =  "";

			$new_arr = array();

			foreach($municipalities as $mun)
			{
				$mun_id = $mun->id;
				$mun_name = $mun->municipality_name;

				$field = "mun_" . $mun_id;


				$field_val = $this->input->post($field);

				if(EMPTY($field_val))
				{
					if(!EMPTY($field_str))
						$field_str .= ",  \n";
			

					$field_str .= $mun_name . " is required";
				}
				else
				{
					if($field_val == "Yes")	
					{
						if ($hist_res_mun !=  "")
							$hist_res_mun .=  "|";

						$hist_res_mun .=  $mun_id;
					}
				}


				$new_arr[] = array(
					'response_id' => $response_id,
					'municipality_id' => $mun_id,
					'hist_preservation' => $field_val
				);


			}

			



			if(!EMPTY($field_str))
			{
				throw new Exception($field_str);
				
			}
			else
			{
				$this->qm->insert_hitoric_preservations($new_arr);
			}
			

			// SAVE RESPONSE

			
			$this->db->trans_commit();

		}
		catch(Exception $e)
		{
			$status = 0;
			$msg = $e->getMessage();

			$this->db->trans_rollback();

		}

		$data["county_name"] = $county_name;
		$data["county_id"] = $county_id;
		$data["his_mun"] =  $hist_res_mun;

		$data["status"] = $status;
		$data["msg"] = $msg;

		echo json_encode($data);

	}

	

	public function part_2($id)
	{
		$data = array(
			);

		
		// GET ALL MUNICIPALITIES WITH HISTORIC PRESERVATIONS
		$param_hist["response_id"] = $id;

		$municipalities = $this->qm->get_municipalities_by_response($param_hist);
		$data["municipalities"] = $municipalities;
		$data["total"] = count($municipalities);




		$quest_opt_arr = array();

		// GET ALL QUESTIONS FIRST
		$questions = $this->qm->get_questions();

		if(!EMPTY($questions))
		{
			foreach($questions as $quest)
			{
				$question_id = $quest->id;
				$question_name = $quest->question_name;
				$params["question_id"] = $question_id;

				$opt_arr = array();

				// GET ALL OPTION PER QUESTIONS
				$options = $this->qm->get_options($params);

				if(!EMPTY($options))
				{
					foreach ($options as $opt) {



						$option_id = $opt->id;
						$option_name = $opt->option_name;

						$opt_arr[] = array(
								"option_id" => $option_id,
								"option_name" => $option_name

							);
					}
				}

				$quest_opt_arr[] = array(
						"question_id" => $question_id,
						"question_name" => $question_name,
						"options" => $opt_arr		
					);

			}
		}

		$data["questions"] = $quest_opt_arr;


		// GET ALL COUNTIES
		$data["counties"] = $this->cm->get_counties();

		$this->template->load($data, 'template', 'part_2');
	}

	
}
