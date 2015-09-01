<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {
    public function check_login()
    {
        if(!UID)
            redirect("login");
    }

    public function index()
    {
        $this->check_login();

        $this->load->view('header', array('title' => 'sleepover - Calendar', 'page' => 'calendar'));
        $this->load->view('calendar');
        $this->load->view('footer');
    }
}