<?php
class Dashboard_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function inc_dec_busy_tables($table_id,$flag){
		if($flag){
			$str = "-1";
		}else{
			$str = "+1";
		}
		$this->db->where("table_id",$table_id);
		$this->db->set("number","number".$str,false);
		$this->db->update("busy_tables");
	}
	public function delete_reservation($id){
		$this->db->where("id",$id);
		$this->db->delete("reserved_tables");
	}
	public function tables($id){
		$sql = "SELECT tables.id as table_id, tables.capacity, (tables.number-COALESCE(busy_tables.number,0)-COUNT(view.table_id)) as number,tables.number as full 
				FROM tables
				LEFT JOIN ( 
					SELECT table_id 
					FROM reserved_tables 
					WHERE CURRENT_TIMESTAMP >= start_time AND CURRENT_TIMESTAMP <= end_time) AS view ON view.table_id=tables.id
				LEFT JOIN busy_tables ON busy_tables.table_id=tables.id
				LEFT JOIN companies ON companies.user_id=tables.company_id
				WHERE companies.user_id=$id
				GROUP BY tables.id";
		$query = $this->db->query($sql);
		$ret = array(
			2 => 0,
			4 => 0,
			6 => 0,
			8 => 0,
			10 => 0,
			12 => 0
		);
		if($query->num_rows()){
			$result = $query->result();
			foreach ($result as $table) {
				$ret[$table->capacity] = $table;
			}
		}
		return $ret;
	}
	public function get_all_reservation($id){
		$this->db->select("reserved_tables.*,clients.name as firstname, clients.lastname, users.username,tables.capacity, users.email");
		$this->db->from("reserved_tables");
		$this->db->join("tables","tables.id=reserved_tables.table_id","left");
		$this->db->join("clients","clients.user_id=reserved_tables.client_id","left");
		$this->db->join("users","clients.user_id=users.id","left");
		$this->db->where("reserved_tables.start_time >=",date("Y-m-d H:i:s"));
		$this->db->where("tables.company_id", $id);
		$this->db->order_by("reserved_tables.id","DESC");
		$query = $this->db->get();
		if($query->num_rows()){
			return $query->result();
		}else{
			return array();
		}
	}
}
?>