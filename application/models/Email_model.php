<!-- //in this model we have to run or pass all the queries connected with datbase table controlled by controller// -->
<?php
class Email_model extends CI_Model 
{
	//this query is created for inserting new records in database table entry in create method//
	public function createRec($input)
	{
		$sentAt = null;
		$status = 0;

		if($input['mailStatus'])
		{
			$sentAt = date('Y-m-d H:i:s');
			$status = 1;
		}
		
		return $this->db->insert('email', [
			'company_id'	=>$input['company_id'],
			'email_id'		=>$input['email_id'],
			'subject'		=>$input['subject'],
			'body'			=>$input['body'],
			'cc'			=>$input['cc'],
			'reply_to'		=>$input['reply_to'],
			'bcc' 			=>$input['bcc'],
			'created_by'	=>$this->session->userdata('user_id'),	
			'created_at'	=> date('Y-m-d H:i:s'),
			'status'		=> $status,
			'sent_at'		=> $sentAt
			]);
	}
	
	
	//this query is for getting all records from database table//
	public function getAll()
	{
		return $this->db->select('*, email.id as id, user_meta.nickname as nickname')
			->join('user_meta', 'user_meta.user_id  = email.created_by', 'left')
			->join('company_entry', 'email.company_id  = company_entry.id', 'left')
			->from('email')
			->get()
			->result_array();
	}
	//this query is for deleting particular selected id from the database table//
	public function deleteById($id)
	{
		return $this->db->where('id', $id)
			->delete('email');
	}
	
	
	//this query is used for getting all the records for updating for particular row when click on particular id from the view method//
	public function getRecordById($id)
	{
		return $this->db->where('id', $id)
			->select('*')
			->from('email')
			->get()
			->row();
	}
}