<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
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
			if(($about = $this->client->about($token))){
				$data["styles"]=array(
					base_url("assets/css/korisnikprofil.css"),
					"https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.css",
				);
				$data["title"]=$about->name." ".$about->lastname;
				$data = array_merge($data,data_header($this->session));
				$this->load->view('templates/header',$data);
				$data = array(
					"client" => $about,
					"type" =>(($this->session->userdata("user_data"))?$this->session->user_data["type"]:0),
					"suggests" => $this->company->most_popular(6),
					"reserved_tables" => $this->client->reserved_tables($about->user_id),
					"same"=> ($about->user_id==$this->session->user_data["id"])
				);
				$this->load->view("client",$data);
				$data["scripts"]=array(
					"https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.js",
					base_url("assets/js/mapa_client_prof.js")	
				);
				$data["all"]=$this->company->newest(20);
				$this->load->view('templates/footer',$data);
			}else{
				show_404();
			}
		}
	}
	public function add_mark($id=""){
		if($id=="" || $this->input->get("value")==NULL || !$this->session->userdata("user_data") || ! $this->session->user_data["type"]==1){
			show_404();
		}else{
			$this->client->add_mark(intval($id), $this->session->user_data["id"], intval($this->input->get("value")));
			redirect($_SERVER["HTTP_REFERER"]);
		}
	}
}