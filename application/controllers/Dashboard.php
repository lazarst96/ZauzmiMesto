<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Mail_model",'mail');
		$this->load->model("User_model","user");
		$this->load->model("Company_model",'company');
		$this->load->model("Client_model","client");
		$this->load->model("Dashboard_model","dashboard");
	}
	public function index(){
		if(!$this->session->userdata("user_data")){
			show_404();
			return;
		}
		$data["title"]="Dashboard";
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
			"tables" => $this->dashboard->tables($id),
			"reserved_tables" => $this->dashboard->get_all_reservation($id)

		);
		$this->load->view('dashboard',$data);
		$data["scripts"]=array(
			base_url("assets/js/jquery.slimscroll.js"),
			base_url("assets/js/custom.min.js"),
			base_url("assets/js/dashboard.js")
		);
		
		$data["all"]=$this->company->newest(20);
		$this->load->view('templates/footer',$data);
	}

}