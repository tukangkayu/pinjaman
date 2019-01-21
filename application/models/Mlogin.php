<?php
Class Mlogin extends CI_Model{

	public function verifyLogin($email,$password){
		$user=$this->db->query("select * from member where email_member = '".$email."' and password_member='".$password."'")->row();
		return $user;
	}
	public function register($data){
		$email = $data['email'];
		$password = $data['password'];
		$save = array(
			'email_member'=>$email,
			'password_member'=>$password,
			'saldo'=>0,
			'statuspengguna'=>1
		);
		$status= $this->db->insert('member',$save);
		return $status;
	}
	
}
?>
