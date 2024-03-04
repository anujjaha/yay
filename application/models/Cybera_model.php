<?php

class Cybera_model extends CI_Model
{
	public function getAllOptions() 
	{
		$cybera = $this->load->database('cybera', true);

		return $cybera->select("*")
			->from('items')
			->get()
			->result_array();
	}

	public function getDealerById($dealerId) 
	{
		$cybera = $this->load->database('cybera', true);

		return $cybera->select("*")
			->from('customer')
			->where('mobile = ' .  $dealerId. ' OR emailid = '. $dealerId)
			->get()
			->row();
	}
	
	public function getDealerByUserId($userId = null) 
	{
		$cybera = $this->load->database('cybera', true);

		return $cybera->select("*")
			->from('customer')
			->where('id', $userId)
			->get()
			->row();
	}

	public function getItemsById($categoryId) 
	{
		$cybera = $this->load->database('cybera', true);
		return $cybera->select("*")
			->from('items')
			->where("id", $categoryId)
			->get()
			->result_array();
	}

	public function getProcessListById($dealerCategoryType, $categoryId) 
	{
		$cybera = $this->load->database('cybera', true);

		return $cybera->select("*")
			->from('process_list')
			->where("cat_type = ".$dealerCategoryType." AND category_id = ".$categoryId)
			->get()
			->result_array();
	}
}
