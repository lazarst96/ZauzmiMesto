<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Mail_model",'mail');
		$this->load->model("User_model","user");
		$this->load->model("Company_model",'company');
		$this->load->model("Client_model","client");
		$this->load->model("Dashboard_model","dashboard");
		$this->load->model("Admin_model","admin");
	}
	public function index(){
		if(!$this->session->userdata("user_data")){
			show_404();
			return;
		}
		if($this->session->user_data["type"]!=0){
			show_404();
			return;
		}
		$data["title"]="Admin panel";
		$data["styles"]=array(
			base_url("assets/css/animate.css"),
			base_url("assets/css/style.css"),
			base_url("assets/css/animate.css"),
			base_url("assets/css/colors/default.css")

		);
		$data = array_merge($data,data_header($this->session));
		$this->load->view('templates/header',$data);
		$id = $this->session->user_data["id"];
		$data = array(
			"num_companies" => $this->admin->number_companies(),
			"num_reservations" => $this->admin->number_reservations(),
			"num_users" => $this->user->numberUsers(),
			"tables" => $this->admin->get_all_reservation(),
			"new_users" => $this->admin->new_users()


		);
		$this->load->view('admin',$data);
		$data["scripts"]=array(
			base_url("assets/js/jquery.slimscroll.js"),
			base_url("assets/js/custom.min.js"),
			base_url("assets/js/dashboard.js")
		);
		
		$data["all"]=$this->company->newest(20);
		$this->load->view('templates/footer',$data);
	}
	public function members(){
		if(!$this->session->userdata("user_data")){
			show_404();
			return;
		}
		if($this->session->user_data["type"]!=0){
			show_404();
			return;
		}
		$data["title"]="Admin panel";
		$data["styles"]=array(
			base_url("assets/css/animate.css"),
			base_url("assets/css/style.css"),
			base_url("assets/css/animate.css"),
			base_url("assets/css/colors/default.css")

		);
		$data = array_merge($data,data_header($this->session));
		$this->load->view('templates/header',$data);
		$id = $this->session->user_data["id"];
		$data = array(
			"companies" => $this->admin->companies(),
			"clients" => $this->admin->clients()

		);
		$this->load->view('admin/members',$data);
		$data["scripts"]=array(
			base_url("assets/js/jquery.slimscroll.js"),
			base_url("assets/js/custom.min.js"),
			base_url("assets/js/dashboard.js")
		);
		
		$data["all"]=$this->company->newest(20);
		$this->load->view('templates/footer',$data);
	}
	public function settings(){
		if(!$this->session->userdata("user_data")){
			show_404();
			return;
		}
		if($this->session->user_data["type"]!=0){
			show_404();
			return;
		}
		$data["title"]="Admin panel";
		$data["styles"]=array(
			base_url("assets/css/animate.css"),
			base_url("assets/css/style.css"),
			base_url("assets/css/animate.css"),
			base_url("assets/css/colors/default.css")

		);
		$data = array_merge($data,data_header($this->session));
		$this->load->view('templates/header',$data);
		$id = $this->session->user_data["id"];
		$data = array(
			"num_companies" => $this->admin->number_companies(),
			"num_reservations" => $this->admin->number_reservations(),
			"num_users" => $this->user->numberUsers(),
			"tables" => $this->admin->get_all_reservation(),
			"new_users" => $this->admin->new_users()


		);
		$this->load->view('admin/settings',$data);
		$data["scripts"]=array(
			base_url("assets/js/jquery.slimscroll.js"),
			base_url("assets/js/custom.min.js"),
			base_url("assets/js/dashboard.js")
		);
		
		$data["all"]=$this->company->newest(20);
		$this->load->view('templates/footer',$data);
	}

}