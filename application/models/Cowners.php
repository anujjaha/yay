<!-- //in this model we have to run or pass all the queries connected with datbase table controlled by controller// -->
<?php
class Cemployee_model extends CI_Model 
{
	//this query is created for inserting new records in database table entry in create method//
	public function createRec($input)
	{
		return $this->db->insert('cemployees', [
			'company_id'	=>$input['company_id'],
			'name'			=>$input['ename'],
			'designation'	=>$input['designation'],
			'email'			=>$input['ceemail'],
			'personal_email'=>$input['personal_email'],
			'department'	=>$input['department'],
			'mobile'		=>$input['mobile'],
			'mobile2'		=>$input['mobile2']
			]);
	}
	
	//this query is for update record which is selected in view method//
	public function updateRec($id, $input)
	{
		return $this->db->where('id', $id)
			->update('cemployees', [
			'company_id'	=>$input['company_id'],
			'name'			=>$input['ename'],
			'designation'	=>$input['designation'],
			'email'			=>$input['ceemail'],
			'personal_email'=>$input['personal_email'],
			'department'	=>$input['department'],
			'mobile'		=>$input['mobile'],
			'mobile2'		=>$input['mobile2']
			]);
	}

	//this query is for getting all records from database table//
	public function getAll()
	{
		return $this->db->select('*, cemployees.id as id, cemployees.name as ename, cemployees.email as ceemail')
			->from('cemployees')
			->join('company_entry', 'cemployees.company_id  = company_entry.id', 'left')
			->get()
			->result_array();
	}
	//this query is for deleting particular selected id from the database table//
	public function deleteById($id)
	{
		return $this->db->where('id', $id)
			->delete('cemployees');
	}
	
	//this query is for updating particular id from the database table//
	public function updateById($id)
	{
		return $this->db->select('*, cemployees.email as ceemail')
				->from('cemployees')
				->join('company_entry', 'cemployees.company_id  = company_entry.id', 'left')
				->get()
				->result_array();
	}

	//this query is used for getting all the records for updating for particular row when click on particular id from the view method//
	public function getRecordById($id)
	{
		return $this->db->where('id', $id)
			->select('*')
			->from('cemployees')
			->get()
			->row();
	}
}