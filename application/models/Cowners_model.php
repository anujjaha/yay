<?php
class Cowners_model extends CI_Model 
{
	//this query is created for inserting new records in database table entry in create method//
	public function createRec($input)
	{
		return $this->db->insert('cowners', [
			'company_id'	=>$input['company_id'],
			'oname'			=>$input['oname'],
			'oemail'		=>$input['oemail'],
			'omobile'		=>$input['omobile'],
			'omobile2'		=>$input['omobile2'],
			'gender' 		=>$input['gender'],
			'dob'			=>$input['dob'],
			'oadd1'			=>$input['oadd1'],
			'oadd2'			=>$input['oadd2'],
			'ocity'			=>$input['ocity'],	
			'ostate'		=>$input['ostate'],
			'opin'			=>$input['opin']
			]);
	}
	
	//this query is for update record which is selected in view method//
	public function updateRec($id, $input)
	{
		return $this->db->where('id', $id)
			->update('cowners', [
			'company_id'	=>$input['company_id'],
			'oname'			=>$input['oname'],
			'oemail'		=>$input['oemail'],
			'omobile'		=>$input['omobile'],
			'omobile2'		=>$input['omobile2'],
			'gender' 		=>$input['gender'],
			'dob'			=>$input['dob'],
			'oadd1'			=>$input['oadd1'],
			'oadd2'			=>$input['oadd2'],
			'ocity'			=>$input['ocity'],	
			'ostate'		=>$input['ostate'],
			'opin'			=>$input['opin']
			]);
	}

	//this query is for getting all records from database table//
	public function getAll()
	{
		return $this->db->select('*, cowners.id as id')
			->from('cowners')
			->join('company_entry', 'cowners.company_id  = company_entry.id', 'left')
			->get()
			->result_array();
	}
	//this query is for deleting particular selected id from the database table//
	public function deleteById($id)
	{
		return $this->db->where('id', $id)
			->delete('cowners');
	}
	
	//this query is for updating particular id from the database table//
	public function updateById($id)
	{
		return $this->db->select('*')
				->from('cowners')
				->join('company_entry', 'cemployees.company_id  = company_entry.id', 'left')
				->get()
				->result_array();
	}

	//this query is used for getting all the records for updating for particular row when click on particular id from the view method//
	public function getRecordById($id)
	{
		return $this->db->where('id', $id)
			->select('*')
			->from('cowners')
			->get()
			->row();
	}
}