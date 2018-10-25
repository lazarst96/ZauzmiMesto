<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Mail_model",'mail');
		$this->load->model("User_model","user");
		$this->load->model("Company_model",'company');
		$this->load->model("Client_model","client");
		$this->load->helper("form");
		$this->load->library('form_validation');
	}

	public function client()
	{
		if(!$this->session->userdata("user_data")){
			show_404();
		}else{
			$message = "";
			
			if($this->input->post("submit")=="1"){
				if($this->form_validation->run("password_change")){
					$message = 'Uspešno ste promenili lozinku.';
				}else{
					$message = "";
				}
			}else{
				if($this->form_validation->run("client_change_settings")){
					$firstname=$this->input->post("firstname");
					$lastname=$this->input->post("lastname");
					$phone=$this->input->post("phone");
					$gender = $this->input->post("gender");
					$city = $this->input->post("city");
					$data = array();
					$session = $this->session->userdata("user_data");
					if($firstname!="" && $firstname!=$this->session->user_data["firstname"]){
						$data["name"] = $firstname;
						$session["firstname"]=$firstname;

					}
					if($lastname!="" && $lastname!=$this->session->user_data["lastname"]){
						$data["lastname"] = $lastname;
						$session["lastname"]=$lastname;

					}
					if($phone!=""){
						$data["phone"] = $phone;
					}
					if($gender!="" && intval($gender)!=$this->session->user_data["gender"]){
						$data["gender"] = intval($gender);
						$session["gender"]=$gender;
					}
					if($city!=""){
						$data["city"] = intval($city);
					}
					if(count($data)){
						$this->client->update_data($this->session->user_data["id"], $data);
						$this->session->set_userdata('user_data', $session);
					}
					

				}
			}
			
			
			
			$ret = $this->upload_client_image();
			$data["styles"]=array(
				base_url("assets/css/objects.css")
			);
			$data["title"]="Podešavanja";
			$data = array_merge($data,data_header($this->session));
			$this->load->view('templates/header',$data);
			$data["user"] = $this->client->data($this->session->user_data["id"]);
			$data["message"] = $message;
			$data["cities"]=$this->user->all_cities();
			if($ret["error"] && $ret["data"]["error"]!="<p>You did not select a file to upload.</p>"){
				$data["error"] = $ret["data"]["error"];
			}else{
				if(!$ret["error"]){
					$data["error"] = "<p>Uspešno ste dodali profilnu fotografiju.</p>";
				}else{
					$data["error"] = "";	
				}
				
			}
			$this->load->view("user/user_settings",$data);


			$data["scripts"]=array(
				base_url("assets/js/clientsettings.js")	
				);
			$data["all"]=$this->company->newest(20);
			$this->load->view('templates/footer',$data);
		}
	}
	public function company()
	{
		$message_uploc=$message_chpass=$message_chdata=$message_del_im=$message_ch_prof=$message_wt_st=false;
		if(!$this->session->userdata("user_data")){
			show_404();
		}else{
			if($this->input->post("submit")=="1"){
				$message_chdata = $this->update_company_data();
			}
			if($this->input->post("submit")=="2"){
				if($this->form_validation->run("password_change")){
					$message_chpass = 'Uspešno ste promenili lozinku.';
				}else{
					$message_chpass = false;
				}
			}
			if($this->input->post("submit")=="3"){
				$message_uploc = $this->update_location();
			}
			if($this->input->post("submit")=="4"){
				$this->update_wt_st();
				$message_wt_st = "Uspešno ste ažurirali podatke.";
			}
			if($this->input->post("submit-image")=="1"){
				$image = $this->input->post("profil");
				if($this->session->user_data["image"]!=$image){
					if(file_exists("./assets/Slike/profil_pictures/".$this->session->user_data["id"]."/".$image)){
						$session = $this->session->userdata("user_data");
						$session["image"] = $image;
						$this->session->set_userdata("user_data",$session);
						$this->set_profil_image($image);
						$message_ch_prof = "Uspešno ste promenili profilu fotografiju.";
					}
				}
			}
			if($this->input->post("submit-image")=="2"){
				$array = $this->input->post("MyArray");
				if (($key = array_search($this->session->user_data["image"], $array)) !== false) {
    				unset($array[$key]);
				}
				$this->delete_images($array);
				$message_del_im = "Uspešno ste obrisali fotografije.";
			}
			$error_upim=$this->upload_image();
			$data["styles"]=array(
				'https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css',
				base_url("assets/css/fotografije.css"),
				base_url("assets/css/firma.css")
			);
			$data["title"]="Podešavanja";
			$data = array_merge($data,data_header($this->session));
			$this->load->view('templates/header',$data);
			$data=array(
				"company" => $this->company->data($this->session->user_data["id"]),
				"message_uploc" => $message_uploc,
				"message_chpass" => $message_chpass,
				"message_chdata" => $message_chdata,
				"cities" => $this->user->all_cities(),
				"images" => $this->company->all_images($this->session->user_data["id"]),
				"error_upim" => $error_upim,
				"message_ch_prof" => $message_ch_prof,
				"message_del_im" => $message_del_im,
				"message_wt_st" => $message_wt_st,
				"working_time" => $this->company->working_time($this->session->user_data["id"]),
				"tables" => $this->company->tables($this->session->user_data["id"]),


			);
			$this->load->view('user/company_settings',$data);

			$data["scripts"]=array(
				'https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js',
				base_url("assets/js/company_settings.js")	
			);
			$data["all"]=$this->company->newest(20);
			$this->load->view('templates/footer',$data);
		}
	}
	private function upload_client_image(){
		$id = $this->session->user_data["id"]; 
		$config['upload_path']          = "./assets/Slike/profil_pictures/".$id."/";
        $config['allowed_types']        = 'jpg';
        $config['file_name']			= '1';
        $config['max_size']             = 2048;
        $config['max_width']            = 2048;
        $config['max_height']           = 2048;

        $this->load->library('upload', $config);
        copy("./assets/Slike/profil_pictures/".$id."/1.jpg","./assets/Slike/profil_pictures/".$id."/2.jpg");
        unlink("./assets/Slike/profil_pictures/".$id."/1.jpg");
        if ( ! $this->upload->do_upload('profil_image'))
        {
            $error = array('error' => $this->upload->display_errors());
            copy("./assets/Slike/profil_pictures/".$id."/2.jpg","./assets/Slike/profil_pictures/".$id."/1.jpg");
            unlink("./assets/Slike/profil_pictures/".$id."/2.jpg");
            return array("error"=>True,"data"=>$error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            unlink("./assets/Slike/profil_pictures/".$id."/2.jpg");

            return array("error"=>False,"data"=>$this->upload->data());
        }
	}
	public function change_user_password($new_password){
		$password = $this->input->post("password");
		if($this->user->check_old_password($this->session->user_data["id"], $password, $this->session->user_data["username"])){
			$this->user->change_password($this->session->user_data["id"], $new_password, $this->session->user_data["username"]);
			return True;
		}
		$this->form_validation->set_message('change_user_password', 'Pogrešna lozinka.');
		return false;
	}
	private function update_location(){
		if($this->form_validation->run("update_location")){
			$latitude = doubleval($this->input->post("latitude"));
			$longitude = doubleval($this->input->post("longitude"));
			$this->company->update_location($this->session->user_data["id"],$latitude, $longitude);
			return "Uspešno ste promenili lokaciju";
		}
		return false;
	}
	private function update_wt_st(){
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
		$this->company->update_wt_st($this->session->user_data["id"] ,$tables, $days);
	}
	private function update_company_data(){
		if($this->form_validation->run("update_company_data")){
			$name=$this->input->post("name");
			$phone1=$this->input->post("phone1");
			$phone2=$this->input->post("phone2");
			$website = $this->input->post("website");
			$city = $this->input->post("city");
			$info = $this->input->post("info");
			$data = array();
			$session = $this->session->userdata("user_data");
			if($name!="" && $name!=$this->session->user_data["name"]){
				$data["name"] = $name;
				$session["name"]=$name;
			}
			if($phone1!=""){
				$data["phone1"] = $phone1;
			}
			if($phone2!=""){
				$data["phone2"] = $phone2;
			}
			if($website!=""){
				$data["website"] = $website;
			}
			if($info!=""){
				$data["info"] = $info;
			}
			if($city!=""){
				$data["city_id"] = intval($city);
			}
			if(count($data)){
				$this->company->update_data($this->session->user_data["id"], $data);
				$this->session->set_userdata('user_data', $session);
				return "Uspešno ste ažurirali podatke.";
			}
			return FALSE;
		}
	}
	private function upload_image(){
		$id = $this->session->user_data["id"];
		$name = $this->company->next_image($id); 
		$config['upload_path']          = "./assets/Slike/profil_pictures/".$id."/";
        $config['allowed_types']        = 'jpg';
        $config['file_name']			= $name;
        $config['max_size']             = 2048;
        $config['max_width']            = 2048;
        $config['max_height']           = 2048;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('upload_image'))
        {
            return $this->upload->display_errors();
        }
        else
        {
            $this->company->add_image($id);
            return FALSE;
        }
	}
	private function set_profil_image($image){
		$id = $this->session->user_data["id"];
		if(file_exists("./assets/Slike/profil_pictures/".$id."/".$image)){
			$this->company->set_profil_image($id, $image);
		}else{
			log_message('WARNING', 'Korisnik sa indeksom['.$id.'] je pokušao da postavi za profilnu nepostojeću sliku.');
		}
	}
	private function delete_images($array){
		$id = $this->session->user_data["id"];
		foreach($array as $image){
			if(file_exists("./assets/Slike/profil_pictures/".$id."/".$image)){
			 	unlink("./assets/Slike/profil_pictures/".$id."/".$image);	
			}else{
				log_message('ERROR', 'Korisnik sa indeksom['.$id.'] je pokušao da obriše nepostojeću sliku.');
			}
			
		}
		$this->company->delete_images($id,count($array));
	}
}