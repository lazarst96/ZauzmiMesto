<?php
class Client_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function complete_regist($id, $name, $lastname, $city_id, $phone, $gender,$ip_address){ 
		$data=array(
			"user_id"=>$id,
			"name"=>$name,
			"lastname" =>$lastname,
			"city_id"=>$city_id,
			"phone"=>$phone,
			"gender"=>$gender
		);
		$this->db->insert("clients",$data);
		if($this->db->affected_rows() > 0){
			$data = array("active" => 1);
			$this->db->where("id",$id);
			$this->db->update("users",$data);
			$data = array("user_id" => $id, "ip_address" => $ip_address);
			$this->db->insert("logins",$data);
			mkdir("./assets/Slike/profil_pictures/".$id."/");
			if($gender==1){
				copy("./assets/Slike/profil_pictures/none_male.jpg","./assets/Slike/profil_pictures/".$id."/1.jpg");
			}else{
				copy("./assets/Slike/profil_pictures/none_female.jpg","./assets/Slike/profil_pictures/".$id."/1.jpg");
			}
			
			return TRUE;
		}
		return FALSE;
	}
	public function data($id){
		$this->db->select("clients.*, users.image, cities.name as city")->from("clients")->join("users","clients.user_id=users.id","left")->join("cities","cities.id=clients.city_id","left")->where("users.id",$id);
		return $this->db->get()->row();
	}
	public function update_data($id, $data){
		$this->db->where("user_id",$id);
		$this->db->update("clients", $data);
	}
	public function about($token){
		$this->db->select("clients.*, users.email,users.username, users.image, SUM(clients_marks.value) as positive, (COUNT(clients_marks.value) -SUM(clients_marks.value)) as negative");
		$this->db->from("clients");
		$this->db->join("users","users.id=clients.user_id","left");
		$this->db->join("clients_marks","clients_marks.client_id=users.id","left");
		$this->db->where("CONCAT(MD5(users.username),MD5(users.email))",$token);
		$query= $this->db->get();

		if($query->num_rows()){
			return $query->row();
		}
		return FALSE;
	}
	public function reserved_tables($id){
		$this->db->select("companies.*, tables.capacity, reserved_tables.start_time,cities.name as city, users.image, users.username, users.email, company_types.name as type, company_types.description as type_description, countries.name as country");
		$this->db->from("reserved_tables");
		$this->db->join("clients", "clients.user_id=reserved_tables.client_id","left");
		$this->db->join("tables", "reserved_tables.table_id=tables.id","left");
		$this->db->join("companies", "companies.user_id = tables.company_id", "left");
		$this->db->join("cities", "cities.id=companies.city_id","left");
		$this->db->join("countries", "countries.id=cities.country_id","left");
		$this->db->join("users", "users.id=companies.user_id","left");
		$this->db->join("company_types", "company_types.id=companies.company_type","left");
		$this->db->where("clients.user_id", $id);
		$this->db->where("reserved_tables.start_time >=",date("Y-m-d H:i:s"));
		$this->db->order_by("reserved_tables.start_time");

		return $this->db->get()->result();
	}
	public function add_mark($client_id, $company_id, $value){
		$data = array(
			"client_id" => $client_id,
			"company_id" => $company_id,
			"value" => $value
		);
		$this->db->insert("clients_marks",$data);
	}
}