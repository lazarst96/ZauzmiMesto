<?php
class User_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->model("Company_model",'company');
	}
	public function login($username,$password,$ip_address){
		$this->db->select("users.*, clients.name as firstname, clients.lastname as lastname, clients.gender as gender,
			companies.*, company_types.name as company_type");
		$this->db->from("users");
		$this->db->where("username",$username);
		$this->db->where("password",md5($password).sha1($username));
		$this->db->where("active",1);
		$this->db->limit(1);
		$this->db->join("clients", "clients.user_id = users.id", "left");
		$this->db->join("companies", "companies.user_id = users.id", "left"); 
		$this->db->join("company_types", "company_types.id = companies.company_type", "left"); 

		$query=$this->db->get();
		if($query->num_rows()){
			$row = $query->row();

			$data = array("time" => date("Y-m-d H:i:s"), "ip_address" => $ip_address);
			$this->db->where("user_id", $row->id);
			$this->db->update("logins",$data);
			return $row;
		}
		return false;
	}
	public function regist($email,$username,$password,$type){
		$data=array(
			"username"=>$username,
			"email"=>$email,
			"type" =>$type,
			"password"=>md5($password).sha1($username)
		);
		$this->db->insert("users",$data);
		if($this->db->affected_rows() > 0)
			return TRUE;
		return FALSE;
	}
	private function numberCities(){
		$this->db->select("COUNT(DISTINCT(city_id)) AS count")->from("companies");
		return $this->db->get()->row()->count;
	}
	public function numberUsers(){
		$this->db->select("COUNT(*) as count")->from("users");
		return $this->db->get()->row()->count;
	}
	private function numberActiveUsers(){
		$this->db->select("COUNT(users.id) as count, ")->from("users")->join("logins","logins.user_id=users.id","left")->where("DATEDIFF(CURRENT_TIMESTAMP, logins.time) <= ",20);
		return $this->db->get()->row()->count;
	}
	public function dataHomePage(){
		
		$data['keywords'] = $this->all_keywords();
		$data['cities'] = $this->all_cities();
		$data['company_types'] = $this->all_company_types();
		$data['distances'] = $this->all_distances();
		$data['free'] = $this->company->free(4);
		$data['new'] = $this->company->newest(8);
		$data['most_popular'] = $this->company->most_popular(8);
		$data["city_count"] = $this->numberCities();
		$data["users_count"] = $this->numberUsers();
		$data["active_users_count"] = $this->numberActiveUsers();



		return $data;
	}
	private function all_keywords(){
		$this->db->select("*");
		$this->db->from("keywords");
		$this->db->order_by("content");
		return $this->db->get()->result();
	}
	public function all_cities(){
		$this->db->select("*");
		$this->db->from("cities");
		$this->db->order_by("name");
		return $this->db->get()->result();
	}
	public function all_company_types(){
		$this->db->select("*");
		$this->db->from("company_types");
		$this->db->order_by("name");
		return $this->db->get()->result();
	}
	private function all_distances(){
		return array(
			(object)array('id' => 10, 'value' => "do 10km" ),
			(object)array('id' => 25, 'value' => "do 25km" ),
			(object)array('id' => 50, 'value' => "do 50km" ),
			(object)array('id' => 75, 'value' => "do 75km" ),
			(object)array('id' => 100, 'value' => "do 100km" ),
			(object)array('id' => 150, 'value' => "do 150km" ),
			(object)array('id' => 200, 'value' => "do 200km" ),
			(object)array('id' => 250, 'value' => "do 250km" ),
			(object)array('id' => 300, 'value' => "do 300km" )
		);
	}
	public function is_true_info($token){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("CONCAT(MD5(username),MD5(email))",$token);
		$this->db->where("active",0);

		$query=$this->db->get();
		if($query->num_rows()){
			$row = $query->row();
			return $row;
		}
		return false;
	}
	public function is_true_data($token){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("CONCAT(MD5(username),MD5(email))",$token);

		$query=$this->db->get();
		if($query){
			$row = $query->row();
			return $row;
		}
		return false;
	}
	public function data_for_objects(){
		$data["most_popular"]= $this->company->most_popular(3);
		$data["new"]= $this->company->newest(3);
		$data['cities'] = $this->all_cities();
		$data['company_types'] = $this->all_company_types();
		$data['distances'] = $this->all_distances();
		$data['keywords'] = $this->all_keywords();
		return $data;
	}
	public function checkbox_val($val){
		if($val=="on"){
			return 1;
		}else{
			return 0;
		}
	}
	public function user_exists($username, $email){
		$this->db->select("*")->from("users")->where("username",$username)->where("email", $email);
		$query=$this->db->get();
		if($query->num_rows()){
			return true;
		}
		return false;
	}
	public function change_password($id, $password, $username){
		$data = array("password"=>md5($password).sha1($username));
		$this->db->where("id",$id);
		$this->db->update("users",$data);
	}
	public function check_old_password($id,$password, $username){
		$this->db->select("*")->from("users")->where("id", $id)->where("password", md5($password).sha1($username));
		$query = $this->db->get();
		if($query->num_rows()){
			return true;
		}
		return false;
	}
	public function delete_user($id){
		$this->db->where("id", $id);
		$this->db->delete("users");
	}
}