<?php
class Mail_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->library('email');
		$this->load->library('EmailSend');
	}
	public function send_to_verify($to,$username){
		$this->email->from($this->emailsend->From());
		$this->email->to($to);

		$this->email->subject($this->emailsend->Subject());

		$data['target'] = base_url("user/complete_regist/".md5($username).md5($to));
		$data['username'] = $username;
		$message = $this->load->view("verification_email/message",$data,true);
		$this->email->message($message);

		if($this->email->send()){
			return TRUE;
		}
		return $this->email->print_debugger();
	}
	public function send_to_change_password($to, $username){
		$this->email->from($this->emailsend->From());
		$this->email->to($to);

		$this->email->subject("Link za promenu lozinke");
		$data['target'] = base_url("user/change_password/".md5($username).md5($to));
		$data['username'] = $username;
		$message = $this->load->view("change_password/message",$data,true);
		$this->email->message($message);

		if($this->email->send()){
			return TRUE;
		}
		return $this->email->print_debugger();

	}
}