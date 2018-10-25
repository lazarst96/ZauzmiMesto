<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model("Mail_model",'mail');
		$this->load->model("User_model","user");
		$this->load->model("Company_model",'company');
		$this->load->model("Client_model","client");
	}
	public function index(){
		//print_r($this->company->all(NULL, array(1,3), NULL, NULL, NULL, array("latitude" => 1, "longitude" => 1)));
		$day=intval(date("j"));
		$month = intval(date("m"));
		$year = intval(date("Y"));
		$id=20;
		//echo date("H");
		//print_r($this->company->reserved_tables_for_day(15, "2018-10-03", 0));
		//log_message('WARNING', 'Korisnik sa indeksom['.$id.'] je pokušao da postavi za profilnu nepostojeću sliku.');
		//$this->company->add_description(15,array(1,4,7,15));
		//$this->company->add_image(3);
		//echo  $this->company->next_image(3);
		/*mkdir("./assets/Slike/profil_pictures/".$id."/");
		copy("./assets/Slike/profil_pictures/company.jpg","./assets/Slike/profil_pictures/".$id."/1.jpg");*/
		
		//echo jddayofweek(intvaldate("j"),0);
		//echo md5("12345").sha1("velikabruka")."<br>";
		//echo md5("velikabruka").md5("velikabruka@gmail.com");
		/*$a = array(1,2,3);
		echo count($a);*/
		/*echo md5("12345").sha1("fishfish")."<br>";
		echo md5("12345").sha1("poslasticaracandy")."<br>";
		echo md5("12345").sha1("beerplace")."<br>";
		echo md5("12345").sha1("vodopad")."<br>";
		echo md5("12345").sha1("staravodenica")."<br>";
		echo md5("12345").sha1("starogrne")."<br>";
		echo md5("12345").sha1("bakinatajna")."<br>";
		echo md5("12345").sha1("kraljevskiuzitak")."<br>";*/
		$a[2]=1;
		$a[4]=6;
		$a[8]=4;
		/*foreach ($a as $key => $value) {
			echo $key." ".$value."<br>";
		}*/

	}
}