<!-- //in this model we have to run or pass all the queries connected with datbase table controlled by controller// -->
<?php
class Clocations_model extends CI_Model 
{
	//this query is created for inserting new records in database table entry in create method//
	public function createRec($input)
	{
		return $this->db->insert('clocations', [
			'company_id'	=>$input['company_id'],
			'ltitle'		=>$input['ltitle'],
			'branch_manager'=>$input['branch_manager'],
			'ladd1'			=>$input['ladd1'],
			'ladd2'			=>$input['ladd2'],
			'lcity' 		=>$input['lcity'],
			'lstate'		=>$input['lstate'],
			'lpin'			=>$input['lpin'],
			'lmobile1'		=>$input['lmobile1'],
			'lmobile2'		=>$input['lmobile2'],	
			'google_map'	=>$input['google_map'],
			'lemail'		=>$input['lemail']
			]);
	}
	
	//this query is for update record which is selected in view method//
	public function updateRec($id, $input)
	{
		return $this->db->where('id', $id)
			->update('clocations', [
			'company_id'	=>$input['company_id'],
			'ltitle'		=>$input['ltitle'],
			'branch_manager'=>$input['branch_manager'],
			'ladd1'			=>$input['ladd1'],
			'ladd2'			=>$input['ladd2'],
			'lcity' 		=>$input['lcity'],
			'lstate'		=>$input['lstate'],
			'lpin'			=>$input['lpin'],
			'lmobile1'		=>$input['lmobile1'],
			'lmobile2'		=>$input['lmobile2'],	
			'google_map'	=>$input['google_map'],
			'lemail'		=>$input['lemail']
			]);
	}

	//this query is for getting all records from database table//
	public function getAll()
	{
		return $this->db->select('*, clocations.id as id')
			->from('clocations')
			->join('company_entry', 'clocations.company_id  = company_entry.id', 'left')
			->get()
			->result_array();
	}
	//this query is for deleting particular selected id from the database table//
	public function deleteById($id)
	{
		return $this->db->where('id', $id)
			->delete('clocations');
	}
	
	//this query is for updating particular id from the database table//
	public function updateById($id)
	{
		return $this->db->select('*')
				->from('clocations')
				->join('company_entry', 'cemployees.company_id  = company_entry.id', 'left')
				->get()
				->result_array();
	}

	//this query is used for getting all the records for updating for particular row when click on particular id from the view method//
	public function getRecordById($id)
	{
		return $this->db->where('id', $id)
			->select('*')
			->from('clocations')
			->get()
			->row();
	}
}