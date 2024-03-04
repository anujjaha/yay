<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
          if($this->session->userdata['login']) {
              $this->dashboard();
          }
        }
        
        public function logout() {
        	$set_data = array('user_id'=>null,'login'=>"0",'department'=>null,'username'=>null,'mobile'=>null);
            $this->session->unset_userdata($array_items);
            $this->session->sess_destroy(); 
            session_destroy();
            $this->session->set_userdata($set_data);
            redirect("user/login/",'refresh');
        }

	public function dashboard() 
	{
		$data = array();
		$this->load->model('Company_model');
		$data['results'] = $this->Company_model->getAll();
		$data['title']="YAY - Company List";
		$data['heading']="Companies";
		$this->template->load('user', 'index', $data);
	}

	public function admin()
	{
		$today = date("Y-m-d");
		$condition = array('condition'=>array('jdate'=>$today))	;
		$result = $this->user_model->get_jobs('',$condition);
		$data['title']="Dashboard";
		$data['heading']="Dashboard";
		$data['today_jobs']="15";
		$data['today_counter']="100";
		$data['total_dealers']="12";
		$data['total_customers']="100";
		$data['jobs']= $result;
		$this->template->load('user', 'index', $data);
	}
	
	public function get_leftbar_status() {
		$data = $this->user_model->get_leftbar_status();
		echo json_encode($data,true);
		die;
	}
	
	public function search() {
		$data=array();
		$data['title']="Search Result";
		$data['heading']="Search Result";
		$data['search']="";
		if($this->input->post('q')) {
			$search = $this->input->post('q');
			$data['dealers'] = $data['customers'] = $this->user_model->search_customers($search);
			$data['job_data'] = $this->user_model->search_job($search);
			//echo "<pre>";
			//print_r($data);
			$data['job_details'] = $this->user_model->search_jobdetails($search);
			$data['search']=$search;
		}
		$this->template->load('user', 'search', $data);
	}
	
	public function search_date()
	{
		$data=array();
		$data['heading'] = $data['title']="Search Result";
		$data['search']="";
		if($this->input->post('q')) {
			$search = $this->input->post('q');
			$data['job_data'] = $this->user_model->search_job_date($search);
			$data['search']=$search;
		}
		
		$this->template->load('user', 'search_job', $data);
	}

	public function search_voucher()
	{
		$data=array();
		$data['heading'] = $data['title']="Search Result";
		$data['search']="";
		if($this->input->post('voucher_search')) {
			$search = $this->input->post('voucher_search');
			$data['items'] = $this->user_model->search_old_voucher($search);
			$data['search']=$search;
		}
		$this->template->load('user', 'search_voucher', $data);
	}
	
	public function search_job() {
		$data=array();
		$data['heading'] = $data['title']="Search Result";
		$data['search']="";
		if($this->input->post('job_number')) {
			$search = $this->input->post('job_number');
			$data['job_data'] = $this->user_model->search_job_num($search);
			$data['search']=$search;
		}
		$this->template->load('user', 'search_job', $data);
	}
	public function old_search() {
		$data=array();
		$data['heading'] = $data['title']="Old Data - Search Result";
		$data['search']="";
		if($this->input->post('old_q')) {
			$search = $this->input->post('old_q');
			$data['results'] = $this->user_model->old_search_jobdetails($search);
			$data['search']=$search;
		}
		$this->template->load('user', 'old_search', $data);
	}
	
	function login() {
			$this->load->helper(array('form'));
            $data=array();
            if($this->input->post()) 
            {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $result = $this->user_model->login_user($username,$password);
                if($result) {
                    $set_data = array('login'=>true,'user_id'=>$result->id,'department'=>$result->department,
                                       'username'=>$result->nickname,'mobile'=>$result->mobile,
                                       'profile_pic'=>$result->profile_pic
                                       );
                $this->session->set_userdata($set_data);

                redirect("user/dashboard/",'refresh');
                } else {
                    $this->session->set_flashdata('msg', 'Invalid Credentials');
                }
            } else {
            	$this->session->sess_destroy(); 
            }
            $data['title'] = $data['heading']="Login";
            $this->load->view('login_view',$data);
	 }
	
	
	public function mydb() {
			
		$this->load->model('user_model');
		echo "Records Updated : ".$this->user_model->mydb_done();
		//echo "Records Updated :".$this->user_model->migrate_user_transactions();
		die("I DONE");
	}
	
	public function crash_system() {
		return true;
		$this->load->model('user_model');
		$this->user_model->crash_system();
		die("test");
	}
        
    public function create()
	{
		$this->template->load('user', 'user-create', $data);
	} 


	public function save()
	{
		$input = $this->input->post();
		$this->load->model('Company_model');

		$result = $this->Company_model->createRec($input);
		redirect('user/dashboard', 'refresh');

	}

	
	public function delete()
	{
		$this->load->model('Company_model');
		$input = $this->input->get();
		$result = $this->Company_model->deleteById($input['id']);
			
		redirect('user/index', 'refresh');
	}

	public function update()
	{
		$this->load->model('Company_model');
		$input = $this->input->get();
		$data['result'] = $this->Company_model->getRecordById($input['id']);
		
		$this->template->load('user', 'company-update', $data);
	}

	public function update_data()
	{
			$input = $this->input->post();
			$this->load->model('Company_model');
			
			$result = $this->Company_model->updateRec($input['id'], $input);
			redirect('user/dashboard', 'refresh');
	}

	public function getCompanyInfo()
	{
		$input = $this->input->post();
		$companyId = $input['companyId'];

		$this->load->model('Company_model');
		$company = $this->Company_model->getRecordById($companyId);
		$result = [
			'companyRec' => $company,
			'status'	 => true
		];

		echo json_encode($result);
		exit;
	}

	public 	function downloadPDF()
	{
		$this->load->model('Company_model');
		$data['results'] = $this->Company_model->getAll();

		$companyHtml = $this->load->view('user/company-list-pdf', $data, true);

		require_once(APPPATH . '/libraries/tcpdf/tcpdf.php');
		$pdf = new TCPDF();

		// Add a page
		$pdf->AddPage();

		// Write HTML content
		$pdf->writeHTML($companyHtml);

		// Output PDF
		$filePath  = FCPATH . 'assets/pdf/';
		$fileName = 'company_list_'.time().'.pdf';
		$pdf->Output($filePath .  $fileName, 'F');

		$result = [
			'status' => true,
			'fileName' => $fileName
		];

		echo json_encode($result);
		exit;
	}
}