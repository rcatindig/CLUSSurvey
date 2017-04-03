<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Municipalities_model extends CI_Model {

	private $_main_tbl = "municipality";

	

	public function get_data()
	{
		return $this->_data;
	}

	public function get_municipalities($params = NULL)
	{
		try
		{
			$query = $this->db->get($this->_main_tbl);
			$list = $query->result();

			return $list;
		}
		catch(Exception $e)
		{
			throw $e;
		}
	}

	public function get_specific_data($params)
	{
		try{
			$query = $this->db->get_where($this->_main_tbl, $params);
			$data = $query->result();

			return $data;
		}
		catch(Exception $e){
			throw $e;
		}
	}

	public function insert($params)
	{
		try
		{
			$this->db->insert($this->_main_tbl, $params);
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

	public function update($data, $params)
	{
		try
		{
			$this->db->where($params);
			$this->db->update($this->_main_tbl, $data);
		}
		catch(Exception $e)
		{
			throw $e;
		}

	}

}