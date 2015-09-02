<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Check_login{

	function login_check()
	{
		$CI =& get_instance();

		// $CI->output->enable_profiler(TRUE);
		
		define('UID', $CI->session->userdata('uid'));
		define('USERNAME', $CI->session->userdata('username'));
		define('FULL_NAME', $CI->session->userdata('full_name'));

		define("SHOW_GUIDE", !$CI->session->userdata('show_guide'));
	}
}

?>