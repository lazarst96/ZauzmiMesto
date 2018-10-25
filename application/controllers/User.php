<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
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
		$dataHeader["title"]="Početna";
		$dataHeader["styles"] = array(
			base_url("assets/slick/slick.css"),
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css",
			"https://api.mapbox.com/mapbox.js/v3.0.1/mapbox.css",
			"https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.css",
			base_url("assets/slick/slick-theme.css")
		);
		$dataHeader = array_merge($dataHeader,data_header($this->session));
		$this->load->view('templates/header',$dataHeader);
		$data = $this->user->dataHomePage();
		$this->load->view('home',$data);
		$dataFooter["scripts"] = array(
			"https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.2/mapbox-gl.js",
			"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js",
			base_url("assets/slick/slick.min.js"),
			base_url("assets/js/pocetnascript.js"),
			base_url("assets/js/mapa.js")
		);
		$dataFooter["all"]=$this->company->newest(20);
		$this->load->view('templates/footer',$dataFooter);
	}
	public function logout(){
		$this->session->unset_userdata('user_data');
		redirect(base_url("login"));
	}
	public function confirm_email(){
		$dataHeader["title"]="Verifikacija eMail-a";
		$dataHeader["styles"] = array(
			
		);
		$dataHeader = array_merge($dataHeader,data_header($this->session));
		$this->load->view('templates/header',$dataHeader);
		$this->load->view('user/conf_email');
		$dataFooter["scripts"] = array(
			
		);
		$dataFooter["all"]=$this->company->newest(20);
		$this->load->view('templates/footer',$dataFooter);
	}
	public function complete_regist($token=""){
		$dataHeader["title"]="Kompletiranje registracije";
		
		if(($data = $this->user->is_true_info($token))){
			$dataHeader["styles"] = array(
				base_url("assets/css/firma.css"),
				'https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css'
			);
			$dataHeader = array_merge($dataHeader,data_header($this->session));
			$this->load->view('templates/header',$dataHeader);
			
			if($data->type!=1){
				if($this->form_validation->run('complete_regist_client')){
					if($this->complete_regist_client($data->id)){
						$session = array(
							"id" => $data->id,
							"username" => $data->username,
							"email" => $data->email,
							"type" => $data->type,
							"image" => $data->image,
							"firstname" => $this->input->post("firstname"),
							"lastname" => $this->input->post("lastname"),
							"name" => NULL,
							"gender" => (int)$this->input->post("gender"),
							"company_type" => NULL
						);
					}
					
					$this->session->set_userdata('user_data', $session);
					redirect(base_url());

				}
				$data1['cities'] = $this->user->all_cities();
				$this->load->view('user/complete_regist_client',$data1);
				
			}else{
				if($this->form_validation->run('complete_regist_company')){
					if($this->complete_regist_company($data->id)){
						$session = array(
							"id" => $data->id,
							"username" => $data->username,
							"email" => $data->email,
							"type" => $data->type,
							"image" => $data->image,
							"firstname" => NULL,
							"lastname" => NULL,
							"name" => $this->input->post("name"),
							"gender" => NULL,
							"company_type" => $this->company->getTypeName(intval($this->input->post("type")))
						);
					}
					
					$this->session->set_userdata('user_data', $session);
					redirect(base_url());

				}
				$data1['cities'] = $this->user->all_cities();
				$data1['types'] = $this->user->all_company_types();
				$this->load->view('user/complete_regist_company',$data1);
			}
			

			$dataFooter["scripts"] = array(
			
			);
			if($data->type==1){
				array_push($dataFooter["scripts"], 'https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js', base_url("assets/js/mapa_comp_reg.js"));
			}
			$dataFooter["all"]=$this->company->newest(20);
			$this->load->view('templates/footer',$dataFooter);
		}else{
			show_404();
		}
	}
	private function complete_regist_client($id){
		$city_id = intval($this->input->post("city"));
		$firstname = $this->input->post("firstname");
		$lastname = $this->input->post("lastname");
		$phone = $this->input->post("phone_prefix").$this->input->post("phone");
		$gender = intval($this->input->post("gender"));
		$ip_address = $this->input->ip_address();
		return $this->client->complete_regist($id, $firstname, $lastname, $city_id, $phone, $gender,$ip_address);
	}
	private function complete_regist_company($id){
		$name = $this->input->post("name");
		$phone1 = $this->input->post("prefix1").$this->input->post("phone1");
		$phone2 = $this->input->post("prefix2").$this->input->post("phone2");
		$city_id = intval($this->input->post("city"));
		$address = $this->input->post("address");
		$latitude = doubleval($this->input->post("latitude"));
		$longitude = doubleval($this->input->post("longitude"));
		$type = intval($this->input->post("type"));
		$website = $this->input->post("website");
		$info = $this->input->post("description");
		$tables[2] = intval($this->input->post("table2"));
		$tables[4] = intval($this->input->post("table4"));
		$tables[6] = intval($this->input->post("table6"));
		$tables[8] = intval($this->input->post("table8"));
		$tables[10] = intval($this->input->post("table10"));
		$tables[12] = intval($this->input->post("table12"));
		$days[1]["start"] = intval($this->input->post("start1"));
		$days[1]["end"] = intval($this->input->post("end1"));
		$days[1]["open"] = checkbox_val($this->input->post("workday1"));
		$days[2]["start"] = intval($this->input->post("start2"));
		$days[2]["end"] = intval($this->input->post("end2"));
		$days[2]["open"] = checkbox_val($this->input->post("workday2"));
		$days[3]["start"] = intval($this->input->post("start3"));
		$days[3]["end"] = intval($this->input->post("end3"));
		$days[3]["open"] = checkbox_val($this->input->post("workday3"));
		$days[4]["start"] = intval($this->input->post("start4"));
		$days[4]["end"] = intval($this->input->post("end4"));
		$days[4]["open"] = checkbox_val($this->input->post("workday4"));
		$days[5]["start"] = intval($this->input->post("start5"));
		$days[5]["end"] = intval($this->input->post("end5"));
		$days[5]["open"] = checkbox_val($this->input->post("workday5"));
		$days[6]["start"] = intval($this->input->post("start6"));
		$days[6]["end"] = intval($this->input->post("end6"));
		$days[6]["open"] = checkbox_val($this->input->post("workday6"));
		$days[7]["start"] = intval($this->input->post("start7"));
		$days[7]["end"] = intval($this->input->post("end7"));
		$days[7]["open"] = checkbox_val($this->input->post("workday7"));
		$ip_address = $this->input->ip_address();
		return $this->company->complete_regist($id, $name, $city_id, $address, $info, $latitude, $longitude, $type, $ip_address, $tables, $days,$phone1,$phone2,$website);
		

	}
	public function forgotpassword(){

		$message = "";
		$data['success'] = false;
		$data['message_succ'] = "E-mail je uspešno poslat. Link u mail-u vodi vas na stranicu za promenu lozinke.";
		if($this->form_validation->run("forgot_password")){
			$username = $this->input->post("username");
			$email = $this->input->post("email");
			if($this->user->user_exists($username, $email)){
				$this->mail->send_to_change_password($email, $username);
				$data['success'] = true;
			}else{
				$message = "Pogrešno korisnićko ime ili email.";
			}

		}

		$dataHeader["title"]="Zaboravljena lozinka";
		$dataHeader["styles"] = array(
			base_url("assets/css/login.css")
		);
		$dataHeader = array_merge($dataHeader,data_header($this->session));
		$this->load->view('templates/header',$dataHeader);
		$data["message"] = $message;
		$this->load->view('user/forgot_password',$data);
		$dataFooter["scripts"] = array(
			
		);
		$dataFooter["all"]=$this->company->newest(20);
		$this->load->view('templates/footer',$dataFooter);
	}
	public function change_password($token=""){
		if(($data = $this->user->is_true_data($token))){
			if($this->form_validation->run("change_password")){
				$password = $this->input->post("password");
				$this->user->change_password($data->id, $password, $data->username);
				redirect(base_url());
			}

			$dataHeader["title"]="Zaboravljena lozinka";
			$dataHeader["styles"] = array(
				base_url("assets/css/login.css")
			);
			$dataHeader = array_merge($dataHeader,data_header($this->session));
			$this->load->view('templates/header',$dataHeader);
			$this->load->view('user/change_password');
			$dataFooter["scripts"] = array(
				
			);
			$dataFooter["all"]=$this->company->newest(20);
			$this->load->view('templates/footer',$dataFooter);
		}
	}
}