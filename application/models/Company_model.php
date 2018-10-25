<?php
class Company_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function complete_regist($id, $name, $city_id, $address, $info, $latitude, $longitude, $company_type, $ip_address,$tables,$days,$phone1,$phone2,$website){
		$data = array(
			"user_id" => $id,
			"name" => $name,
			"city_id" => $city_id,
			"address" => $address,
			"info" => $info,
			"latitude" => $latitude,
			"longitude" => $longitude,
			"company_type" => $company_type,
			"phone1" => $phone1,
			"phone2" => $phone2,
			"website" => $website,

		);
		$this->db->insert("companies",$data);
		if($this->db->affected_rows() > 0){
			$data = array("active" => 1);
			$this->db->where("id",$id);
			$this->db->update("users",$data);
			$data = array("user_id" => $id, "ip_address" => $ip_address);
			$this->db->insert("logins",$data);
			$tables_id = array();
			foreach ($tables as $capacity => $number) {
				$data = array("company_id" => $id, "capacity" => $capacity, "number" =>$number);
					$this->db->insert("tables",$data);
					array_push($tables_id,array("table_id"=>$this->db->insert_id(),"number"=>0));
				
			}
			$this->db->insert_batch("busy_tables",$tables_id);
			foreach ($days as $day => $prop) {
				$data = array("company_id" => $id, "day" => $day, "start_hour" =>$prop["start"], "end_hour" =>$prop["end"], "open" =>$prop["open"]);
				$this->db->insert("working_time",$data);
				
			}
			mkdir("./assets/Slike/profil_pictures/".$id."/");
			copy("./assets/Slike/profil_pictures/company.jpg","./assets/Slike/profil_pictures/".$id."/1.jpg");
			return TRUE;
		}
		return FALSE;
	}
	public function all($city_id, $keywords, $type, $event_type, $distance, $point, $limit_from, $limit_to, $order){
		$dayofweek = day_of_week();
		$f = true;
		$sql = "
			SELECT companies.*, users.image,users.email,users.username, (COALESCE(view2.free_places,0)) AS free_places, (COALESCE(view2.free_places,0) >0) AS free , cities.name AS city, countries.name AS country, COALESCE(view2.places,0)  AS places, company_types.description as type_description, company_types.name as type_name,working_time.start_hour,working_time.end_hour,working_time.open
			FROM companies 
			LEFT JOIN cities ON companies.city_id = cities.id
			LEFT JOIN countries ON countries.id = cities.country_id
			LEFT JOIN company_types ON company_types.id = companies.company_type
			LEFT JOIN working_time ON working_time.company_id = companies.user_id AND working_time.day = $dayofweek
			LEFT JOIN ( 
				SELECT name, user_id, SUM((number-busy-reserved)*capacity) as free_places,SUM((number)*capacity) as places
				FROM(
					SELECT companies.user_id,companies.name,tables.id, tables.capacity, (tables.number) as number,COALESCE(busy_tables.number,0) as  busy, COUNT(view.table_id) AS reserved
					FROM tables
					LEFT JOIN ( 
						SELECT table_id 
						FROM reserved_tables 
						WHERE CURRENT_TIMESTAMP >= start_time AND CURRENT_TIMESTAMP <= end_time) AS view ON view.table_id=tables.id
					LEFT JOIN busy_tables ON busy_tables.table_id=tables.id
					LEFT JOIN companies ON companies.user_id=tables.company_id
					GROUP BY tables.id) table1
					GROUP BY user_id) AS view2 ON view2.user_id=companies.user_id
			LEFT JOIN users ON users.id=companies.user_id ";

		$suff="GROUP BY companies.user_id ";
		if($city_id){
			$suff.=" HAVING city_id=$city_id ";
			$f = false;
		}
		if($type){
			if($f){
				$suff.=" HAVING company_type=$type ";
				$f=false;
			}else{
				$suff.="AND company_type=$type ";
			}
		}
		if($distance){
			$latitude=$point["latitude"];
			$longitude = $point["longitude"];
			if($f){
				$suff.=" HAVING distance($latitude, $longitude, latitude, longitude)<=$distance ";
				$f=false;
			}else{
				$suff.="AND distance($latitude, $longitude, companies.latitude, companies.longitude)<=$distance ";
			}
		}
		if(count($keywords)){
			$flag = true;
			$copy = $sql;
			$i=1;
			foreach ($keywords as $keyword) {
				$join="JOIN descriptions AS d$i ON d$i.company_id=companies.user_id AND d$i.keyword_id=$keyword ";
				$i++;
				$sql.=$join;
			}
			
		}
		$sql.=$suff;
		
		
		if($order){
			if($order==2){
				$sql.="ORDER BY users.join_time DESC ";
			}
			if($order==1){
				$sql.="ORDER BY users.join_time ASC ";
			}
		}
		if($limit_from){
			$sql.="LIMIT $limit_from, $limit_to ";
		}else{
			if($limit_to){
				$sql.="LIMIT $limit_to ";
			}
		}
		//echo $sql."<br>";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function most_popular($number){
		$dayofweek = day_of_week();
		$sql = "
			SELECT companies.*, users.image,users.email,users.username, (COALESCE(view2.free_places,0)) AS free_places, (COALESCE(view2.free_places,0) >0) AS free , cities.name as city, countries.name as country, company_types.description as type_description, company_types.name as type_name,working_time.start_hour,working_time.end_hour,working_time.open
			FROM companies 
			LEFT JOIN company_types ON company_types.id = companies.company_type
			LEFT JOIN working_time ON working_time.company_id = companies.user_id AND working_time.day = $dayofweek
			LEFT JOIN ( 
				SELECT name, user_id, SUM((number-busy-reserved)*capacity) as free_places
				FROM(
					SELECT companies.user_id,companies.name,tables.id, tables.capacity, (tables.number) as number,COALESCE(busy_tables.number,0) as  busy, COUNT(view.table_id) AS reserved
					FROM tables
					LEFT JOIN ( 
						SELECT table_id 
						FROM reserved_tables 
						WHERE CURRENT_TIMESTAMP >= start_time AND CURRENT_TIMESTAMP <= end_time) AS view ON view.table_id=tables.id
					LEFT JOIN busy_tables ON busy_tables.table_id=tables.id
					LEFT JOIN companies ON companies.user_id=tables.company_id
					GROUP BY tables.id) table1
					GROUP BY user_id) AS view2 ON view2.user_id=companies.user_id
			LEFT JOIN users ON users.id=companies.user_id
			LEFT JOIN visit ON visit.company_id=companies.user_id
			LEFT JOIN cities ON cities.id=companies.city_id
			LEFT JOIN countries ON countries.id = cities.country_id
			GROUP BY companies.user_id
			ORDER BY COUNT(visit.company_id) DESC
			LIMIT $number";
		$query = $this->db->query($sql);
		return $query->result();

	}
	public function newest($number){
		$dayofweek = day_of_week();
		$sql = "
			SELECT companies.*, users.image,users.email,users.username, (COALESCE(view2.free_places,0)) AS free_places, (COALESCE(view2.free_places,0) >0) AS free , cities.name as city, countries.name as country, company_types.description as type_description, company_types.name as type_name,working_time.start_hour,working_time.end_hour,working_time.open
			FROM companies
			LEFT JOIN company_types ON company_types.id = companies.company_type
			LEFT JOIN working_time ON working_time.company_id = companies.user_id AND working_time.day = $dayofweek
			LEFT JOIN ( 
				SELECT name, user_id, SUM((number-busy-reserved)*capacity) as free_places
				FROM(
					SELECT companies.user_id,companies.name,tables.id, tables.capacity, (tables.number) as number,COALESCE(busy_tables.number,0) as  busy, COUNT(view.table_id) AS reserved
					FROM tables
					LEFT JOIN ( 
						SELECT table_id 
						FROM reserved_tables 
						WHERE CURRENT_TIMESTAMP >= start_time AND CURRENT_TIMESTAMP <= end_time) AS view ON view.table_id=tables.id
					LEFT JOIN busy_tables ON busy_tables.table_id=tables.id
					LEFT JOIN companies ON companies.user_id=tables.company_id
					GROUP BY tables.id) table1
					GROUP BY user_id) AS view2 ON view2.user_id=companies.user_id
    		LEFT JOIN users ON users.id=companies.user_id
    		LEFT JOIN cities ON cities.id=companies.city_id
			LEFT JOIN countries ON countries.id = cities.country_id
			GROUP BY companies.user_id
			ORDER BY users.join_time DESC
			LIMIT $number";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function free($number){
		$dayofweek = day_of_week();
		$sql = "
			SELECT companies.*, users.image,users.email,users.username, (COALESCE(view2.free_places,0)) AS free_places, (COALESCE(view2.free_places,0) >0) AS free, cities.name as city, countries.name as country, company_types.description as type_description, company_types.name as type_name,working_time.start_hour,working_time.end_hour,working_time.open
			FROM companies
			LEFT JOIN company_types ON company_types.id = companies.company_type
			LEFT JOIN working_time ON working_time.company_id = companies.user_id AND working_time.day = $dayofweek
			LEFT JOIN ( 
				SELECT name, user_id, SUM((number-busy-reserved)*capacity) as free_places
				FROM(
					SELECT companies.user_id,companies.name,tables.id, tables.capacity, (tables.number) as number,COALESCE(busy_tables.number,0) as  busy, COUNT(view.table_id) AS reserved
					FROM tables
					LEFT JOIN ( 
						SELECT table_id 
						FROM reserved_tables 
						WHERE CURRENT_TIMESTAMP >= start_time AND CURRENT_TIMESTAMP <= end_time) AS view ON view.table_id=tables.id
					LEFT JOIN busy_tables ON busy_tables.table_id=tables.id
					LEFT JOIN companies ON companies.user_id=tables.company_id
					GROUP BY tables.id) table1
					GROUP BY user_id) AS view2 ON view2.user_id=companies.user_id
    		LEFT JOIN users ON users.id=companies.user_id
    		LEFT JOIN cities ON cities.id=companies.city_id
			LEFT JOIN countries ON countries.id = cities.country_id
			GROUP BY companies.user_id
			HAVING free=1
			LIMIT $number";
		$query = $this->db->query($sql);
		return $query->result();

	}
	public function all_keywords(){
		$this->db->select("*");
		$this->db->from("keywords");

		return $this->db->get()->result();
	}
	public function visit_page($company_id){
		$data = array("company_id" => $company_id);
		$this->db->insert("review", $data);
	}
	public function getTypeName($id){
		$this->db->select("name");
		$this->db->from("company_types");
		$this->db->where("id",$id);
		return $this->db->get()->row()->name;
	}
	public function aboutCompany($token){
		$dayofweek = day_of_week();
		$sql = "
			SELECT companies.*, users.username, users.email, users.image, cities.name as city,company_types.name as type_name, (COALESCE(view2.free_places,0)) AS free_places, (COALESCE(view2.free_places,0) >0) AS free, countries.name as country, AVG(company_marks.value) as rate,working_time.start_hour,working_time.end_hour,working_time.open
			FROM companies
			LEFT JOIN users ON users.id=companies.user_id
			LEFT JOIN company_types ON company_types.id=companies.company_type
			LEFT JOIN cities ON cities.id = companies.city_id
			LEFT JOIN countries ON countries.id = cities.country_id
			LEFT JOIN company_marks ON company_marks.company_id=companies.user_id
			LEFT JOIN working_time ON working_time.company_id = users.id AND working_time.day = $dayofweek
			LEFT JOIN ( 
				SELECT name, user_id, SUM((number-busy-reserved)*capacity) as free_places
				FROM(
					SELECT companies.user_id,companies.name,tables.id, tables.capacity, (tables.number) as number,COALESCE(busy_tables.number,0) as  busy, COUNT(view.table_id) AS reserved
					FROM tables
					LEFT JOIN ( 
						SELECT table_id 
						FROM reserved_tables 
						WHERE CURRENT_TIMESTAMP >= start_time AND CURRENT_TIMESTAMP <= end_time) AS view ON view.table_id=tables.id
					LEFT JOIN busy_tables ON busy_tables.table_id=tables.id
					LEFT JOIN companies ON companies.user_id=tables.company_id
					GROUP BY tables.id) table1
					GROUP BY user_id) AS view2 ON view2.user_id=companies.user_id
			WHERE CONCAT(MD5(users.username),MD5(users.email))='$token'
			
		";
		$query = $this->db->query($sql);
		if(isset($query->row_array()["user_id"])) {
			return $query->row();
		}else{
			return false;
		}
	}
	public function keywords_of_company($id){
		$this->db->select("descriptions.*, keywords.content")->from("descriptions")->join("keywords","keywords.id=descriptions.keyword_id")->where("descriptions.company_id",$id);
		return $this->db->get()->result();

	}
	public function make_visit($company_id,$client_id){
		$data = array("company_id"=>$company_id, "client_id"=>$client_id);
		$this->db->insert("visit",$data);
	}
	public function all_comments($company_id){
		$this->db->select("company_marks.*, clients.name, clients.lastname, users.image, clients.user_id")->from("company_marks")->join("clients", "clients.user_id=company_marks.client_id", "left")->join("users", "clients.user_id=users.id", "left")->where("company_id",$company_id)->where("text IS NOT NULL", NULL, false)->order_by("time", "desc");
		return $this->db->get()->result();
	}
	public function add_comment($company_id, $client_id, $value, $text){
		$data = array(
			"company_id" => $company_id,
			"client_id" => $client_id,
			"text" => $text,
			"value" => $value
		);
		$this->db->insert("company_marks", $data);
	}
	public function all_images($id){
		return directory_map("assets/Slike/profil_pictures/".$id,1,false);
	}
	public function update_location($id,$latitude, $longitude){
		$data = array("latitude" => $latitude, "longitude" => $longitude);
		$this->db->where("user_id", $id);
		$this->db->update("companies",$data);
	}
	public function data($id){
		$this->db->select("companies.*, users.image")->from("companies")->join("users","users.id=companies.user_id","left")->where("user_id",$id);
		return $this->db->get()->row();
	}
	public function update_data($id, $data){
		$this->db->where("user_id",$id);
		$this->db->update("companies",$data);
	}
	public function add_image($id){
		$this->db->set("next_image","next_image+1",FALSE);
		$this->db->set("number_images","number_images+1",FALSE);
		$this->db->where("user_id",$id);
		$this->db->update("companies");
	}
	public function delete_images($id, $number){
		$this->db->set("number_images","number_images - $number", FALSE);
		$this->db->where("user_id",$id);
		$this->db->update("companies");
	}
	public function set_profil_image($id, $image){
		$this->db->set("image", $image);
		$this->db->where("id",$id);
		$this->db->update("users");
	}
	public function next_image($id){
		$this->db->select("next_image")->from("companies")->where("user_id",$id);
		return $this->db->get()->row()->next_image;
	}
	public function working_time($id){
		$this->db->select("working_time.start_hour, working_time.end_hour, working_time.open");
		$this->db->from("working_time");
		$this->db->where("working_time.company_id", $id);
		$this->db->order_by("working_time.day");
		$query = $this->db->get();
		if($query->num_rows()){
			return $query->result();
		}else{
			$ret = array();
			for($i=1;$i<=7;++$i){
				array_push($ret, (object)array("start_hour" => 0, "end_hour" => 0,"open" => TRUE));
				$data=array("company_id" => $id, "day" => $i, "start_hour" => 0, "end_hour" => 0,"open" => 1);
				$this->db->insert("working_time",$data);
			}
			return $ret;

		}
		return array();
		
	}
	public function tables($id){
		$this->db->select("tables.*");
		$this->db->from("tables");
		$this->db->where("company_id", $id);

		$query= $this->db->get();
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
				$ret[$table->capacity] = $table->number;
			}
		}else{
			foreach ($ret as $capacity => $number) {
				$data = array("company_id" => $id, "capacity" => $capacity, "number" =>$number);
					$this->db->insert("tables",$data);
				
			}
		}
		
		return $ret;
	}
	public function update_wt_st($id, $tables, $days){
		foreach ($tables as $capacity => $number) {
			if($number>0){
				$data = array("number" =>$number);
				$this->db->where("company_id", $id);
				$this->db->where("capacity", $capacity);
				$this->db->update("tables",$data);
			}		
		}
		foreach ($days as $day => $prop) {
			$data = array("start_hour" =>$prop["start"], "end_hour" =>$prop["end"], "open" =>$prop["open"]);
			$this->db->where("company_id", $id);
			$this->db->where("day", $day);
			$this->db->update("working_time",$data);
				
		}
	}
	public function reserved_tables_for_day($id, $date, $hour){
		$datetime = new DateTime($date);
		$date = explode("-",$date);
		$day_week = day_week($date[2], $date[1], $date[0]);

		$all_tables_tmp = $this->db->select("*")->from("tables")->where("company_id",$id)->get()->result();
		$all_tables = array();
		foreach ($all_tables_tmp as $table) {
			$all_tables[$table->capacity] = $table->number;
		}
		

		$this->db->select("*");
		$this->db->from("working_time");
		$this->db->where("company_id",$id);
		$this->db->where("day", $day_week);
		$query = $this->db->get();
		if($query->num_rows()){
			$result = $query->row();
			$data = array(
				"start_hour" => $result->start_hour,
				"end_hour" => $result->end_hour,
				"open" => $result->open,
			);
		}else{
			$data = array(
				"start_hour" => NULL,
				"end_hour" => NULL,
				"open" => 0,
			);
		}
		$data["start_hour"]=$hour = max($data["start_hour"],$hour);
		if($data["start_hour"]>$data["end_hour"]){
			$end_hour = $data["end_hour"] + 24;
		}else{
			$end_hour = $data["end_hour"];
		}
		$tables = array();
		for($j=$hour;$j<=$end_hour-1;++$j){
			$tables[$j]=array();
			for($i=2;$i<=12;$i+=2){
				$tables[$j][$i] = ($data["open"])?$all_tables[$i]:0;
			}
		}
		
		
		if($data["open"]){
			if($data["start_hour"]>$data["end_hour"]){
				$datetime->setTime($hour,0);
				$begin = $datetime->format("Y-m-d H:i:s");
				$datetime->setTime($data["end_hour"],0)->modify("+1 day");
				$end = $datetime->format("Y-m-d H:i:s");

			}else{
				$datetime->setTime($hour,0);
				$begin = $datetime->format("Y-m-d H:i:s");
				$datetime->setTime($data["end_hour"],0);
				$end = $datetime->format("Y-m-d H:i:s");
			}
			$this->db->select("reserved_tables.start_time, reserved_tables.end_time, tables.*");
			$this->db->from("reserved_tables");
			$this->db->join("tables", "tables.id=reserved_tables.table_id", "left");
			$this->db->where("start_time >=",$begin);
			$this->db->where("end_time <=",$end);
			$this->db->where("tables.company_id",$id);

			$res = $this->db->get()->result();
			foreach ($res as $rt) {
				$sh = intval(explode(":",explode(" ",$rt->start_time)[1])[0]);
				$eh = intval(explode(":",explode(" ",$rt->end_time)[1])[0]);
				if($sh>$eh){
					$eh+=24;
				}
				for($i=$sh;$i<=$eh-1;++$i){
					$tables[$i][$rt->capacity]--;
				}
			}
			

		}
		$data["tables"]=$tables;
		return $data;
		

	}
	public function make_reservation($company_id, $client_id, $start, $end, $capacity){
		$this->db->select("id")->from("tables")->where("capacity",$capacity)->where("company_id", $company_id);
		$table_id=$this->db->get()->row()->id;
		$data = array(
			"table_id"=>$table_id,
			"client_id"=>$client_id,
			"start_time"=> $start,
			"end_time"=>$end
		);
		$this->db->insert("reserved_tables", $data);
	}
	public function add_description($id, $keywords){
		$data = array();
		foreach($keywords as $keyword_id){
			array_push($data, array("company_id"=>$id, "keyword_id"=>$keyword_id));
		} 
		$this->db->insert_batch("descriptions", $data);
	}
	
	
	
}