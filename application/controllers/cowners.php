<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cowners extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function index() 
	{
		$data = array();
		$this->load->model('Cowners_model');
		$data['results'] = $this->Cowners_model->getAll();
		$data['title']="YAY - Company Owner List";
		$data['heading']="Company Owner List";
		$this->template->load('cowners', 'cowners-list', $data);
	}
        
    public function create()
	{
		$this->load->model('Company_model');
		$data['companies'] = $this->Company_model->getAll('name', 'asc');
		$this->template->load('cowners', 'cowners-create', $data);
	} 


	public function save()
	{
		$input = $this->input->post();
		$this->load->model('Cowners_model');

		$result = $this->Cowners_model->createRec($input);
		redirect('cowners/index', 'refresh');

	}

	
	public function delete()
	{
		$this->load->model('Cowners_model');
		$input = $this->input->get();
		$result = $this->Cowners_model->deleteById($input['id']);
			
		redirect('cowners/index', 'refresh');
	}

	public function update()
	{
		$this->load->model('Cowners_model');
		$input = $this->input->get();
		$this->load->model('Company_model');
		$data['companies'] = $this->Company_model->getAll('name', 'asc');
		$data['result'] = $this->Cowners_model->getRecordById($input['id']);
		
		$this->template->load('cowners', 'cowners-update', $data);
	}

	
	public function update_data()
	{
			$input = $this->input->post();
			$this->load->model('Cowners_model');
			
			$result = $this->Cowners_model->updateRec($input['id'], $input);
			redirect('cowners/index', 'refresh');
	}
	public 	function downloadPDF()
	{
		$this->load->model('Cowners_model');
		$data['results'] = $this->Cowners_model->getAll();

		$ownerHtml = $this->load->view('cowners/owner-list-pdf', $data, true);

		require_once(APPPATH . '/libraries/tcpdf/tcpdf.php');
		$pdf = new TCPDF();

		// Add a page
		$pdf->AddPage();

		// Write HTML content
		$pdf->writeHTML($ownerHtml);

		// Output PDF
		$filePath  = FCPATH . 'assets/pdf/';
		$fileName = 'owner_list_'.time().'.pdf';
		$pdf->Output($filePath .  $fileName, 'F');

		$result = [
			'status' => true,
			'fileName' => $fileName
		];

		echo json_encode($result);
		exit;
	}
}