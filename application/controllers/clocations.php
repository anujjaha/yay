<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clocations extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function index() 
	{
		$data = array();
		$this->load->model('Clocations_model');
		$data['results'] = $this->Clocations_model->getAll();
		$data['title']="YAY - Company Branch List";
		$data['heading']="Company Branch List";
		$this->template->load('clocations', 'clocations-list', $data);

	}
        
    public function create()
	{
		$this->load->model('Company_model');
		$data['companies'] = $this->Company_model->getAll('name', 'asc');
		$this->template->load('clocations', 'clocations-create', $data);
	} 


	public function save()
	{
		$input = $this->input->post();
		$this->load->model('Clocations_model');

		$result = $this->Clocations_model->createRec($input);
		redirect('clocations/index', 'refresh');

	}

	
	public function delete()
	{
		$this->load->model('Clocations_model');
		$input = $this->input->get();
		$result = $this->Clocations_model->deleteById($input['id']);
			
		redirect('clocations/index', 'refresh');
	}

	public function update()
	{
		$this->load->model('Clocations_model');
		$input = $this->input->get();
		$this->load->model('Company_model');
		$data['companies'] = $this->Company_model->getAll('name', 'asc');
		$data['result'] = $this->Clocations_model->getRecordById($input['id']);
		
		$this->template->load('clocations', 'clocations-update', $data);
	}

	
	public function update_data()
	{
			$input = $this->input->post();
			$this->load->model('Clocations_model');
			
			$result = $this->Clocations_model->updateRec($input['id'], $input);
			redirect('clocations/index', 'refresh');
	}

}