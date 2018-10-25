<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Mail_model",'mail');
		$this->load->model("User_model","user");
		$this->load->model("Company_model",'company');
		$this->load->model("Client_model","client");
		$this->load->helper("form");
		$this->load->library('form_validation');
	}

	public function index($token="")
	{
		if($token==""){
			show_404();
		}else{
			if(($about = $this->company->aboutCompany($token))){
				if($this->form_validation->run("add_comment")){
					$this->company->add_comment($about->user_id, $this->session->user_data["id"],intval($this->input->post("rating")), $this->input->post("text"));
				}
				$data["title"]=$about->name;
				if($this->session->userdata('user_data')) {
					$this->company->make_visit($about->user_id, $this->session->user_data["id"]);
				}
				$data["styles"]=array(
					base_url("assets/css/objekatprofil.css"),
					base_url("assets/slick/slick.css"),
					"https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.css",
					base_url("assets/slick/slick-theme.css")
				);
				$data = array_merge($data,data_header($this->session));
				$this->load->view('templates/header',$data);
				$data = array(
					"company" => $about,
					"keywords" => $this->company->keywords_of_company($about->user_id),
					"comments" => $this->company->all_comments($about->user_id),
					"images" => $this->company->all_images($about->user_id),
					"suggestions" => $this->company->all(NULL, array(), $about->company_type, NULL, NULL, NULL, NULL, 6, 2),
					"loggedin" => ($this->session->userdata("user_data"))?True:False,
					"type"=>$this->session->user_data["type"]
				);
				$this->load->view('company',$data);
				$data["scripts"]=array(
					"https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.js",
					base_url("assets/slick/slick.min.js"),
					base_url("assets/js/objekatprofil.js")
				);
				$data["all"]=$this->company->newest(20);
				$this->load->view('templates/footer',$data);
			}else{
				show_404();
			}
		}
	}
	public function settings(){

	}
}
?>