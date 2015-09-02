<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_l{

	public function __construct() {
		
	}
	public function login($user)
	{
		// var_dump($user);
		$data = array(
			'uid' => $user[0]->team_id,
			'username' => $user[0]->username,
			'full_name' => $user[0]->first_name." ".$user[0]->last_name
		);
		$CI = &get_instance();
		$CI->session->set_userdata($data);
		// $_SESSION["uid"] = $user[0]->employee_id

		// if($_SESSION["uid"]) giris yapmistir

		// $this->session->userdata("uid")  
	}
	public function logout()
	{
		$CI = &get_instance();
		$CI->session->sess_destroy();
	}
}
