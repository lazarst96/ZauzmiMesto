<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function data_header($session){
	if($session->userdata('user_data')){
		$loggedin = true;
		$ret = $session->user_data;
		if($ret['image']=="none.jpg"){
			if($ret['type']==1){
				$ret['image'] = "none_company.jpg";
			}else{
				if($ret['gender']==1){
					$ret['image'] = "none_male.jpg";
				}else{
					$ret['image'] = "none_female.jpg";
				}
			}
		}
		$ret= array_merge($ret, array("loggedin"=>$loggedin));
	}else{
		$loggedin = false;
		$ret = array("loggedin"=>$loggedin);
	}
	return $ret;
}
function distance($lat1, $lng1, $lat2, $lng2)
{
	$lat1 = deg2rad($lat1);
	$lng1 = deg2rad($lng1);
	$lat2 = deg2rad($lat2);
	$lng2 = deg2rad($lng2);
 
	$r = 6372.797;
	$dlat = $lat2 - $lat1;
	$dlng = $lng2 - $lng1;
	$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
	$c = 2 * asin((sqrt($a)));
	$km = $r * $c;
 
	return $km;
}
function badge($type){
	switch ($type) {
		case 1:
			return '<img style="width:20px" src="'.base_url("assets/Slike/Badges/restoran.png").'">';
		case 2:
			return '<img style="width:20px" src="'.base_url("assets/Slike/Badges/beer.png").'">';
		case 3:
			return '<img style="width:20px" src="'.base_url("assets/Slike/Badges/coffee.png").'">';
		case 4:
			return '<img style="width:20px" src="'.base_url("assets/Slike/Badges/cookie.png").'">';
		case 5:
			return '<img style="width:20px" src="'.base_url("assets/Slike/Badges/pizza.png").'">';
		case 6:
			return '<img style="width:20px" src="'.base_url("assets/Slike/Badges/kafana.png").'">';
		case 7:
			return '<img style="width:20px" src="'.base_url("assets/Slike/Badges/disco.png").'">';
		default:
			return '<img style="width:20px" src="'.base_url("assets/Slike/Badges/coffee.png").'">';
		/*case 5:
			# code...
			break;
		case 6:
			# code...
			break;
		case 7:
			# code...
			break;*/
		
		
	}

}
function company_href($username,$email){
	return base_url("company/".md5($username).md5($email));
}
function client_href($username, $email){
	return base_url("client/".md5($username).md5($email));
}
function href($type, $username, $email){
	if($type==1){
		return company_href($username, $email);
	}else{
		return client_href($username, $email);
	}
}
function company_settings_href(){
	return base_url("settings/company");
}
function client_settings_href(){
	return base_url("settings/client");
}
function settings_href($type){
	if($type==1){
		return company_settings_href();
	}else{
		return client_settings_href();
	}
}
function day_of_week(){
	$day=intval(date("j"));
	$month = intval(date("m"));
	$year = intval(date("Y"));
	return jddayofweek(juliantojd($month, $day, $year),0)+1;
}
function day_week($day, $month, $year){
	return jddayofweek(juliantojd($month, $day, $year),0)+1;
}
function working_status($open, $start, $end){
	$open = intval($open);
	$start = intval($start);
	$end = intval($end);
	$hour=intval(date("H"));
	if($start<$end){
		if($open && $hour>=$start && $hour<$end){
			return "Otvoreno";
		}else{
			return "Zatvoreno";
		}
	}else{
		if($open && (($hour>=$start && $hour<24) ||  ($hour>=0 && $hour<$end))){
			return "Otvoreno";
		}else{
			return "Zatvoreno";
		}
	}
	
}
function comment_grammar($count){
	if($count%100<20){
		if($count==1){
			return $count." Komentar";
		}else{
			return $count." Komentara";
		}
	}else{
		if($count%10==1){
			return $count." Komentar";
		}else{
			return $count." Komentara";
		}
	}
}

function number_star($value){
	$int = intval($value);
	$add = ($value-$int>0.5)?1:0;
	return ($int+$add)/2;
}
function format_time($timestamp){
	$a = explode(" ",$timestamp);
	$date = explode("-",$a[0] );
	$time = explode(":",$a[1]);
	return $date[2].".".$date[1].".".$date[0]." ".$time[0].":".$time[1];
}
function checkbox_val($val){
	if($val=="on"){
		return 1;
	}
	return 0;
}