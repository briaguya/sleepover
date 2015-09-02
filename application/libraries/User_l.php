<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_l{

	public function __construct() {
		
	}
	public function login($user)
	{
		$data = array(
			'uid' => $user[0]->uid,
			'username' => $user[0]->username,
			'full_name' => $user[0]->first_name." ".$user[0]->last_name
		);
		$CI = &get_instance();
		$CI->session->set_userdata($data);
	}
	public function logout()
	{
		$CI = &get_instance();
		$CI->session->sess_destroy();
	}
}
