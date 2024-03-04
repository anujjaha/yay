<?php
class Company_model extends CI_Model 
{
	//this query is created for inserting new records in database table entry in create method//
	public function createRec($input)
	{
		return $this->db->insert('company_entry', [
			'name' 		=> $input['name'],
			'add1'  	=> $input['add1'],
			'add2' 		=> $input['add2'],
			'city' 		=> $input['city'],
			'state' 	=> $input['state'],
			'pin' 		=> $input['pin'],
			'email' 	=> $input['email'],
			'contact' 	=> $input['contact'],
			'website' 	=> $input['website'],
			'logo' 		=> $input['logo'],
			'edate' 	=> date('Y-m-d', strtotime($input['edate'])),
			'category' 	=> $input['category'],
			'gstn' 		=> $input['gstn'],
			'grate' 	=> $input['grate'],
			'status' 	=> $input['status'],
			'created_at'=> date('Y-m-d H:i:s')
		]);
	}
	
	//this query is for update record which is selected in view method//
	public function updateRec($id, $input)
	{
		return $this->db->where('id', $id)
				->update('company_entry', [
				'name' 		=> $input['name'],
				'add1'  	=> $input['add1'],
				'add2' 		=> $input['add2'],
				'city' 		=> $input['city'],
				'state' 	=> $input['state'],
				'pin' 		=> $input['pin'],
				'email' 	=> $input['email'],
				'contact' 	=> $input['contact'],
				'website' 	=> $input['website'],
				'logo' 		=> $input['logo'],
				'edate' 	=> date('Y-m-d', strtotime($input['edate'])),
				'category' 	=> $input['category'],
				'gstn' 		=> $input['gstn'],
				'grate' 	=> $input['grate'],
				'status'	=> $input['status'] 
				]);
	}

	//this query is for getting all records from database table//
	public function getAll($orderBy = 'id', $order = 'desc')
	{
		return $this->db->select('*')
				->from('company_entry')
				->order_by($orderBy, $order)
				->get()
				->result_array();
	}

	//this query is for deleting particular selected id from the database table//
	public function deleteById($id)
	{
		return $this->db->where('id', $id)
			->delete('company_entry');
	}
	
	//this query is for updating particular id from the database table//
	public function updateById($id)
	{
		return $this->db->select('*')
				->from('company_entry')
				->get()
				->result_array();
	}

	//this query is used for getting all the records for updating for particular row when click on particular id from the view method//
	public function getRecordById($id)
	{
		return $this->db->where('id', $id)
			->select('*')
			->from('company_entry')
			->get()
			->row();
	}
}