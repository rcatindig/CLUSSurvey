<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questions_model extends CI_Model {

	private $_main_tbl = "county";
	private $_mun_tbl = "municipality";
	private $_opt_tbl = "options";

	

	public function get_data()
	{
		return $this->_data;
	}


	public function get_municipalities($params)
	{
		try{
			$query = $this->db->get_where($this->_mun_tbl, $params);
			$data = $query->result();

			return $data;
		}
		catch(Exception $e){
			throw $e;
		}
	}

	public function insert_response($params)
	{
		try
		{
			$this->db->insert("response", $params);
			$insert_id = $this->db->insert_id();

			return $insert_id;
		}
		catch(Exception $e)
		{
			throw $e;
		}
	}

	public function multiple_insert($arr)
	{
		try
		{
			//$this->db->insert('municipality', $arr);

			$this->db->insert_batch('municipality',$arr); 
		}
		catch(Exception $e)
		{
			throw $e;
		}
	}

	public function insert_hitoric_preservations($arr)
	{
		try
		{
			//$this->db->insert('municipality', $arr);

			$this->db->insert_batch('response_part_one',$arr); 
		}
		catch(Exception $e)
		{
			throw $e;
		}

	}

	public function get_questions()
	{
		try {
			$query = $this->db->get('questions');
			$data = $query->result();

			return $data;
			
		} catch (Exception $e) {
			throw $e;
		}
	}

	public function get_options($params)
	{
		try{
			$query = $this->db->get_where($this->_opt_tbl, $params);
			$data = $query->result();

			return $data;
		}
		catch(Exception $e){
			throw $e;
		}
		
	}

	public function get_municipalities_by_response($params)
	{
		try
		{
			/*
				SELECT * FROM response_part_one AS r
				LEFT JOIN municipality AS m
				ON r.municipality_id = m.id
				*/
			$this->db->select('m.id,m.municipality_name')
					->from('response_part_one as r')
					->join('municipality as m', 'r.municipality_id = m.id')
					->where($params);

			$query = $this->db->get();
			$data = $query->result();

			return $data;
		}
		catch(Exception $e){
			throw $e;
		}
	}


}

