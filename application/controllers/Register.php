<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model("Mail_model",'mail');
		$this->load->model("User_model","user");
	}
	public function index()
	{
		if($this->form_validation->run('register')){

			$email = $this->input->post("email");
			$username = $this->input->post("username");
			$password=$this->input->post("password");
			$type = (int)$this->input->post("account-type");

			if(($m=$this->mail->send_to_verify($email,$username))===True){
				if($this->user->regist($email,$username,$password, $type)){
					redirect(base_url("user/confirm_email"));
				}
				else{
					$this->load->view('registererror');
				}
						
			}else{
				echo $m;
			}

		}



		$dataHeader["title"]="Registracija";
		$dataHeader["styles"] = array(
			base_url("assets/css/register.css")
		);
		$dataHeader = array_merge($dataHeader,data_header($this->session));
		$this->load->view('templates/header',$dataHeader);

		$this->load->view('register');
		$dataFooter["scripts"] = array(
			
		);
		$dataFooter["all"]=$this->company->newest(20);
		$this->load->view('templates/footer',$dataFooter);
	}
}