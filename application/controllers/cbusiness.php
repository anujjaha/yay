<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cbusiness extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function index() 
	{
		$data = array();
		$this->load->model('Company_business_model');
		$data['results'] = $this->Company_business_model->getAll();
		$data['title']="YAY - Company Business List";
		$data['heading']="Company Business";
		$this->template->load('cbusiness', 'cbusiness-list', $data);
	}
        
    public function create()
	{
		$this->load->model('Company_model');
		$data['companies'] = $this->Company_model->getAll('name', 'asc');
		$this->template->load('cbusiness', 'cbusiness-create', $data);
	} 


	public function save()
	{
		$input = $this->input->post();
		$this->load->model('Company_business_model');

		$result = $this->Company_business_model->createRec($input);
		redirect('cbusiness/index', 'refresh');

	}

	
	public function delete()
	{
		$this->load->model('Company_business_model');
		$input = $this->input->get();
		$result = $this->Company_business_model->deleteById($input['id']);
			
		redirect('cbusiness/index', 'refresh');
	}

	public function update()
	{
		$this->load->model('Company_business_model');
		$input = $this->input->get();
		$this->load->model('Company_model');
		$data['companies'] = $this->Company_model->getAll('name', 'asc');
		$data['result'] = $this->Company_business_model->getRecordById($input['id']);
		
		$this->template->load('cbusiness', 'cbusiness-update', $data);
	}

	
	public function update_data()
	{
			$input = $this->input->post();
			$this->load->model('Company_business_model');
			
			$result = $this->Company_business_model->updateRec($input['id'], $input);
			redirect('cbusiness/index', 'refresh');
	}
}