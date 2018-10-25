<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Emailsend{
	private $from;
	private $subject;

	public function __construct(){
		$this->from="zauzmimesto@outlook.com";
		$this->subject="ZauzmiMesto verifikacija eMail adrese";
	}

	public function From(){
		return $this->from;
	}
	public function Subject(){
		return $this->subject;
	}

}