<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Mail_model",'mail');
		$this->load->model("User_model","user");
		$this->load->model("Company_model",'company');
		$this->load->model("Client_model","client");
		$this->load->helper("form");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data = $this->user->data_for_objects();
		$page = $this->input->get("page");
		$data['page'] = intval($page);
		if(!$data['page']){
			$data['page']=1;
		}
		
		if($this->form_validation->run('search_objects')){
			$keywords = $this->input->post("keywords");
			$type = intval($this->input->post("type"));
			$city = intval($this->input->post("city"));
			$order = intval($this->input->post("order"));
			if(!$keywords) {
				$keywords = [];
			}
			$keywords=array_map('intval', $keywords);

			$data["set"] = $keywords;
			$data["City"] = $city;
			$data["Type"] = $type;
			$data["order"] = $order;
			$data["objects"] = $this->company->all($city, $keywords, $type, NULL, NULL, NULL, NULL, NULL, $order);
		}else{
			$data["set"] = [];
			$data["City"] = NULL;
			$data["Type"] = NULL;
			$data["order"] = 1;
			$data["objects"] = $this->company->all(NULL, array(), NULL, NULL, NULL, NULL,NULL,NULL,0);
		}
		$data['page_max']=intdiv(count($data["objects"]),15)+(count($data["objects"])%15>0);
		if($data["page"]>$data["page_max"]){
			show_404();
			return;
		}
		$data['objects']=array_slice($data['objects'],$data["page"]-1*15,15);
		$dataHeader["title"]="Svi objekti";
		$dataHeader["styles"] = array(
			base_url("assets/css/objects.css"),
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
		);
		$dataHeader = array_merge($dataHeader,data_header($this->session));
		$this->load->view('templates/header',$dataHeader);
		/*$data = $this->user->dataHomePage();
		$this->load->view('home',$data);*/
		
		

		$this->load->view("search",$data);
		$dataFooter["scripts"] = array(
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js",
			base_url("assets/js/object.js")
		);
		$dataFooter["all"]=$this->company->newest(20);
		$this->load->view('templates/footer',$dataFooter);
	}
}
