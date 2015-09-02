<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team_member extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

    public function check_login()
    {
        if(!UID)
            redirect("login");
    }

    function delete($podestrian_id)
    {
        $this->podestrian_m->deletePodestrian($podestrian_id);
        redirect("/podestrian");
    }

    public function modify($team_id = null)
    {
        if($team_id == null)
        {
            // We're adding
            if($this->input->post("username") && $this->input->post("password") && $this->input->post("podestrian_id"))
            {
                //We're submitting a new team member
                $team_member = array(
                    'username' => $this->input->post("username"),
                    'password' => $this->input->post("password"),
                    'podestrian_id' => $this->input->post("podestrian_id"),
                    'role' => $this->input->post("role_id"));

                $this->team_member_m->modify($team_member);
                redirect("/team_member");
            }

            // We're filling out the team member form, we need a null team member
            $team_member = null;
            $data = array('title' => 'sleepover - Add Team Member', 'page' => 'team_member');
        }
        else
        {
            // We're editing, we want to get the podestrian
            $team_member = $this->team_member_m->getTeamMember($team_id);
            $data = array('title' => 'sleepover - Edit Team Member', 'page' => 'team_member');
        }

        $this->load->view('header', $data);
        $podestrians = $this->podestrian_m->get_podestrians();
        //$roles = $this->team_member_m->getRoles();
        $viewdata = array(
            'podestrians' => $podestrians,
            'roles' => null,
            'team_id' => $team_id,
            'team_member' => $team_member[0]);
        $this->load->view('team_member/modify',$viewdata);
        $this->load->view('footer');
    }

    public function index()
    {
        $team_members = $this->team_member_m->get_team_members();

        $data = array('title' => 'sleepover - Team Members', 'page' => 'team_member');
        $this->load->view('header', $data);
        $this->load->view('team_member/list', array('team_members' => $team_members));
        $this->load->view('footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */