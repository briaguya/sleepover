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

    public function modify($podestrian_id = null)
    {
        if($podestrian_id == null)
        {
            // We're adding
            if($this->input->post("first_name") && $this->input->post("last_name") && $this->input->post("email"))
            {
                //We're submitting a new podestrian
                $podestrian = array(
                    'first_name' => $this->input->post("first_name"),
                    'last_name' => $this->input->post("last_name"),
                    'email' => $this->input->post("email"),
                    'podestrian_type_id' => $this->input->post("podestrian_type_id"),
                    'address_id' => $this->input->post("address_id"),
                    'sex' => $this->input->post("sex"),
                    'facebook' => $this->input->post("facebook"),
                    'twitter' => $this->input->post("twitter"),
                    'instagram' => $this->input->post("instagram"),
                    'birthday' => $this->input->post("birthday"),
                    'how_found' => $this->input->post("how_found"));

                $this->podestrian_m->modify($podestrian);
                redirect("/podestrian");
            }

            // We're filling out the podestrian form, we need a null podestrian
            $podestrian = null;
            $data = array('title' => 'sleepover - Add Podestrian', 'page' => 'podestrian');
        }
        else
        {
            // We're editing, we want to get the podestrian
            $podestrian = $this->podestrian_m->getPodestrian($podestrian_id);
            $data = array('title' => 'sleepover - Edit Podestrian', 'page' => 'podestrian');
        }

        $this->load->view('header', $data);
        $podestrian_types = $this->podestrian_m->getPodestrianTypes();
        $addresses = $this->podestrian_m->getAddresses();
        $viewdata = array(
            'podestrian_types' => $podestrian_types,
            'addresses' => $addresses,
            'podestrian_id' => $podestrian_id,
            'podestrian' => $podestrian[0]);
        $this->load->view('podestrian/modify',$viewdata);
        $this->load->view('footer');
    }

    public function index()
    {
        $podestrians = $this->podestrian_m->get_podestrians();

        $data = array('title' => 'sleepover - Podestrians', 'page' => 'podestrian');
        $this->load->view('header', $data);
        $this->load->view('podestrian/list', array('podestrians' => $podestrians));
        $this->load->view('footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */