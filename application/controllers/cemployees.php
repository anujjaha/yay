<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cemployees extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function index() 
	{
		$data = array();
		$this->load->model('Cemployee_model');
		$data['results'] = $this->Cemployee_model->getAll();
		$data['title']="YAY - Company Employee List";
		$data['heading']="Company Employee List";
		$this->template->load('cemployees', 'cemployees-list', $data);
	}
        
    public function create()
	{
		$this->load->model('Company_model');
		$data['companies'] = $this->Company_model->getAll('name', 'asc');
		$this->template->load('cemployees', 'cemployees-create', $data);
	} 


	public function save()
	{
		$input = $this->input->post();
		$this->load->model('Cemployee_model');

		$result = $this->Cemployee_model->createRec($input);
		redirect('cemployees/index', 'refresh');

	}

	
	public function delete()
	{
		$this->load->model('Cemployee_model');
		$input = $this->input->get();
		$result = $this->Cemployee_model->deleteById($input['id']);
			
		redirect('cemployees/index', 'refresh');
	}

	public function update()
	{
		$this->load->model('Cemployee_model');
		$input = $this->input->get();
		$this->load->model('Company_model');
		$data['companies'] = $this->Company_model->getAll('name', 'asc');
		$data['result'] = $this->Cemployee_model->getRecordById($input['id']);
		
		$this->template->load('cemployees', 'cemployees-update', $data);
	}

	
	public function update_data()
	{
			$input = $this->input->post();
			$this->load->model('Cemployee_model');
			
			$result = $this->Cemployee_model->updateRec($input['id'], $input);
			redirect('cemployees/index', 'refresh');
	}
}