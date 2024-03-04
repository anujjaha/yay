<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class email extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function index() 
	{
		$data = array();
		$this->load->model('Email_model');
		$data['results'] = $this->Email_model->getAll();
		$data['title']="YAY - Company Email List";
		$data['heading']="Company Email List";
		$this->template->load('email', 'email-list', $data);

	}
        
    public function create()
	{
		$this->load->model('Company_model');
		$data['companies'] = $this->Company_model->getAll('name', 'asc');
		$this->template->load('email', 'email-create', $data);
	} 


	public function save()
	{
		$input = $this->input->post();
		$this->load->model('Email_model');

		// send email
		$input['mailStatus'] = $this->sendEmail($input);


		$result = $this->Email_model->createRec($input);
		redirect('email/index', 'refresh');

	}

	
	public function delete()
	{
		$this->load->model('Email_model');
		$input = $this->input->get();
		$result = $this->Email_model->deleteById($input['id']);
			
		redirect('email/index', 'refresh');
	}

	public function update()
	{
		$this->load->model('Email_model');
		$input = $this->input->get();
		$this->load->model('Company_model');
		$data['companies'] = $this->Company_model->getAll('name', 'asc');
		$data['result'] = $this->Email_model->getRecordById($input['id']);
		
		$this->template->load('email', 'email-update', $data);
	}

	
	public function update_data()
	{
			$input = $this->input->post();
			$this->load->model('Email_model');
			
			$result = $this->Email_model->updateRec($input['id'], $input);
			redirect('email/index', 'refresh');
	}

	public function sendEmail($input)
	{
		require_once(APPPATH . '/libraries/mailer/src/PHPMailer.php');
		require_once(APPPATH . '/libraries/mailer/src/SMTP.php');
		
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->IsSMTP(); // enable SMTP
		
		$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
	    $mail->SMTPAuth = true; // authentication enabled
	    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	    $mail->Host = "smtpout.secureserver.net";
	    $mail->Port = 465; // or 587
	    $mail->IsHTML(true);
	    $mail->Username = "info@adroitclick.com";
	    $mail->Password = "Adt@12345678";
	    $mail->SetFrom("info@adroitclick.com");
	    $mail->Subject = $input['subject'];
	    $mail->Body = $input['body'];
	    $mail->AddAddress($input['email_id']);
	    $mail->addReplyTo($input['reply_to']);
    	$mail->addCC($input['cc']);
    	$mail->addBCC($input['bcc']);

	    if($mail->Send()) {
	    	return true;
		} else {
		  	return false;
		}
	}
}