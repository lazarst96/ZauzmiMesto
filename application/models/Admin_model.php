<?php
class Admin_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function add_keywords($keyword){
		$data = array(
			"content"=>$keyword
		);
		$this->db->insert("keywords",$data);
	}
	public function delete_user($id){
		$this->db->where("id",$id);
		$this->db->delete("users");
	}
	public function number_companies(){
		$this->db->select("COUNT(*) as val")->from("companies");
		return $this->db->get()->row()->val;
	}
	public function number_reservations(){
		$this->db->select("COUNT(*) as val")->from("reserved_tables");
		return $this->db->get()->row()->val;
	}
	public function get_all_reservation(){
		$this->db->select("reserved_tables.*,clients.name as firstname, clients.lastname, users.username,tables.capacity, users.email, companies.name");
		$this->db->from("reserved_tables");
		$this->db->join("tables","tables.id=reserved_tables.table_id","left");
		$this->db->join("clients","clients.user_id=reserved_tables.client_id","left");
		$this->db->join("users","clients.user_id=users.id","left");
		$this->db->join("companies","companies.user_id=tables.company_id","left");
		$this->db->where("reserved_tables.start_time >=",date("Y-m-d H:i:s"));
		$this->db->order_by("reserved_tables.id","DESC");
		$query = $this->db->get();
		if($query->num_rows()){
			return $query->result();
		}else{
			return array();
		}
	}
	public function new_users(){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->order_by("id","desc");
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	public function companies(){
		$this->db->select("companies.name, company_types.name as type, users.username, users.email");
		$this->db->from("companies");
		$this->db->join("users", "users.id=companies.user_id", "left");
		$this->db->join("company_types", "company_types.id=companies.company_type", "left");
		$query = $this->db->get();
		if($query->num_rows()){
			return $query->result();
		}
		return array();

	}
	public function clients(){
		$this->db->select("clients.name as firstname, clients.lastname, users.username, users.email");
		$this->db->from("clients");
		$this->db->join("users", "users.id=clients.user_id", "left");
		$this->db->where("users.type",2);
		$query = $this->db->get();
		if($query->num_rows()){
			return $query->result();
		}
		return array();
	}
	
}