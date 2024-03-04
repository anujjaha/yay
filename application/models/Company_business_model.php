<!-- //in this model we have to run or pass all the queries connected with datbase table controlled by controller// -->
<?php
class Company_business_model extends CI_Model 
{
	//this query is created for inserting new records in database table entry in create method//
	public function createRec($input)
	{
		return $this->db->insert('cbusiness', [
			'company_id'	=>$input['company_id'],
			'title'			=>$input['title']
			]);
	}
	
	//this query is for update record which is selected in view method//
	public function updateRec($id, $input)
	{
		return $this->db->where('id', $id)
			->update('cbusiness', [
			'company_id'	=>$input['company_id'],
			'title'			=>$input['title']
		]);
	}

	//this query is for getting all records from database table//
	public function getAll()
	{
		return $this->db->select('*, cbusiness.id as id')
			->from('cbusiness')
			->join('company_entry', 'cbusiness.company_id  = company_entry.id', 'left')
			->get()
			->result_array();
	}

	//this query is for deleting particular selected id from the database table//
	public function deleteById($id)
	{
		return $this->db->where('id', $id)
			->delete('cbusiness');
			
	}
	
	//this query is for updating particular id from the database table//
	public function updateById($id)
	{
		return $this->db->select('*')
				->from('cbusiness')
				->join('company_entry', 'cbusiness.company_id  = company_entry.id', 'left')
				->get()
				->result_array();
	}

	//this query is used for getting all the records for updating for particular row when click on particular id from the view method//
	public function getRecordById($id)
	{
		return $this->db->where('id', $id)
			->select('*')
			->from('cbusiness')
			->get()
			->row();
	}
}