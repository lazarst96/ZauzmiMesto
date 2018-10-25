<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		/*$this->load->model("Mail_model",'mail');*/
		$this->load->model("User_model","user");
	}
	public function index()
	{
		if($this->form_validation->run('login')){
			if($this->session->user_data['type']==0){
				redirect(base_url("admin"));
			}else{
				redirect(base_url());
			}
			
		}
		if($this->session->userdata('user_data')) {
			redirect(base_url());
		}
		$dataHeader["title"]="Prijava";
		$dataHeader["styles"] = array(
			base_url("assets/css/login.css")
		);
		$dataHeader = array_merge($dataHeader,data_header($this->session));
		$this->load->view('templates/header',$dataHeader);
		$this->load->view('login');
		$dataFooter["scripts"] = array(
			/*base_url("assets/js/validation.js")*/
		);
		$dataFooter["all"]=$this->company->newest(20);
		$this->load->view('templates/footer',$dataFooter);

	}
	public function log_user($password){
		$username = $this->input->post('username');
		$ip_address = $this->input->ip_address();
		$row = $this->user->login($username,$password,$ip_address);
		if($row){
			$session = array(
				"id" => $row->id,
				"username" => $row->username,
				"email" => $row->email,
				"type" => $row->type,
				"image" => $row->image,
				"firstname" => $row->firstname,
				"lastname" => $row->lastname,
				"name" => $row->name,
				"gender" => $row->gender,
				"company_type" => $row->company_type
			);
			$this->session->set_userdata('user_data', $session);
			return true;
		}else{
			$this->form_validation->set_message('log_user', 'Pogrešno korisničko ime ili lozinka.');
			return false;
		}
	}
}