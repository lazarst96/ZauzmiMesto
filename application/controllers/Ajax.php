<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Mail_model",'mail');
		$this->load->model("User_model","user");
		$this->load->model("Company_model",'company');
		$this->load->model("Client_model","client");
		$this->load->model("Dashboard_model","dashboard");
	}
	public function allobjects(){
		$keywords = json_decode($this->input->post("keywords"));
		$city = intval($this->input->post("city"));
		$type = intval($this->input->post("type"));
		$distance = intval($this->input->post("distance"));
		$point["latitude"]= doubleval($this->input->post("latitude"));
		$point["longitude"]= doubleval($this->input->post("longitude"));

		/*if(is_string($city)){
			echo json_encode(array("csrf"=>$this->security->get_csrf_hash(),"data"=>"radi"));
		}else{
			echo json_encode(array("csrf"=>$this->security->get_csrf_hash(),"data"=>$city));
		}*/
		$data = $this->company->all($city, $keywords, $type, NULL, $distance, $point, NULL, NULL, NULL);
		$result = array();
		foreach($data as $company){
			$row["name"] = $company->name;
			/*if($row["image"]=="none.jpg"){
				$row["image"] = base_url("Slike/profil_pictures/none_company.jpg");
			}else{
				$row["image"] = base_url("Slike/profil_pictures/".$company->image);
			}*/
			$row["image"] = base_url("assets/Slike/profil_pictures/".$company->user_id."/".$company->image);
			$row["longitude"] = $company->longitude;
			$row["latitude"] = $company->latitude;
			$row["free"] = $company->free;
			$row["city"] = $company->city;
			$row["country"] = $company->country;
			$row["address"] = $company->address;
			$row["type"] = $company->company_type;
			$row["link"] = company_href($company->username, $company->email);
			array_push($result, $row);
		}
		//$data = json_encode($result)
		
		echo json_encode(array("csrf"=>$this->security->get_csrf_hash(),"data"=>$result));
	}
	public function all_reserved_tables(){
		$id = $this->input->post("id");
		$data = $this->client->reserved_tables($id);
		$result = array();
		foreach($data as $company){
			$row["name"] = $company->name;
			/*if($row["image"]=="none.jpg"){
				$row["image"] = base_url("Slike/profil_pictures/none_company.jpg");
			}else{
				$row["image"] = base_url("Slike/profil_pictures/".$company->image);
			}*/
			$row["image"] = base_url("assets/Slike/profil_pictures/".$company->user_id."/".$company->image);
			$row["longitude"] = $company->longitude;
			$row["latitude"] = $company->latitude;
			/*$row["free"] = $company->free;*/
			$row["city"] = $company->city;
			$row["country"] = $company->country;
			$row["address"] = $company->address;
			$row["type"] = $company->company_type;
			$row["link"] = company_href($company->username, $company->email);
			array_push($result, $row);
		}
		//$data = json_encode($result)
		
		echo json_encode(array("csrf"=>$this->security->get_csrf_hash(),"data"=>$result));
	}
	public function company_tables_state(){
		$id = intval($this->input->post("id"));
		$date = $this->input->post("date");
		if($date == date("Y-m-d")){
			$hour = intval(date("H"))+1;
		}else{
			$hour = 0;
		}
		$data = $this->company->reserved_tables_for_day($id, $date, $hour);
		echo json_encode(array("data"=>$data, "csrf"=>$this->security->get_csrf_hash()));
	}
	public function make_reservation(){
		$company_id = intval($this->input->post("id"));
		$client_id = $this->session->user_data["id"];
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$capacity = intval($this->input->post('capacity'));
		$next_day_end = intval($this->input->post('next_day_end'));
		$next_day_start = intval($this->input->post('next_day_start'));
		if($next_day_start){
			$datetime= new DateTime($end);
			$end = $datatime->modify("+1 day")->format("Y-m-d H:i:s");
			$datetime= new DateTime($start);
			$start = $datatime->modify("+1 day")->format("Y-m-d H:i:s");
		}else if($next_day_end){
			$datetime= new DateTime($end);
			$end = $datetime->modify("+1 day")->format("Y-m-d H:i:s");
		}

		$this->company->make_reservation($company_id, $client_id, $start, $end, $capacity);

		echo json_encode(array("csrf"=>$this->security->get_csrf_hash())); 
	}
	public function update_status(){
		$flag = intval($this->input->post("flag"));
		$table_id = intval($this->input->post("table_id"));
		$this->dashboard->inc_dec_busy_tables($table_id,$flag);
		echo json_encode(array("csrf"=>$this->security->get_csrf_hash()));

	}
	public function dalete_res(){
		$res_id = intval($this->input->post("res_id"));
		$this->dashboard->delete_reservation($res_id);
		echo json_encode(array("csrf"=>$this->security->get_csrf_hash()));
	}
}