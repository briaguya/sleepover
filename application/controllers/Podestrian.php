<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Podestrian extends CI_Controller {

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

	public function add()
	{
		if($this->input->post("first_name") && $this->input->post("last_name") && $this->input->post("email"))
		{
			$first_name = $this->input->post("first_name");
			$last_name = $this->input->post("last_name");
			$email = $this->input->post("email");
			$podestrian_type_id = $this->input->post("podestrian_type_id");
			$address_id = $this->input->post("address_id");
			$sex = $this->input->post("sex");
			$facebook = $this->input->post("facebook");
            $twitter = $this->input->post("twitter");
            $instagram = $this->input->post("instagram");
            $birthday = $this->input->post("birthday");
            $how_found = $this->input->post("how_found");
			
			$this->podestrian_m->addPodestrian($first_name, $last_name, $email, $podestrian_type_id, $address_id, $sex, $facebook, $twitter, $instagram, $birthday, $how_found);
			redirect("/podestrian");
		}

		$data = array('title' => 'sleepover - Add Podestrian', 'page' => 'podestrian');
		$this->load->view('header', $data);
		$podestrian_types = $this->podestrian_m->getPodestrianTypes();
        $addresses = $this->podestrian_m->getAddresses();
		$viewdata = array('podestrian_types' => $podestrian_types, 'addresses' => $addresses);
		$this->load->view('podestrian/add',$viewdata);
		$this->load->view('footer');
	}

	function delete($podestrian_id)
	{
		$this->podestrian_m->deletePodestrian($podestrian_id);
		redirect("/podestrian");
	}

	public function edit($employee_id)
	{
		if($this->input->post("username") && $this->input->post("password") && $this->input->post("email"))
		{
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$firstname = $this->input->post("firstname");
			$lastname = $this->input->post("lastname");
			$telephone = $this->input->post("telephone");
			$email = $this->input->post("email");
			$department_id = $this->input->post("department_id");
			$type = $this->input->post("type");
			$salary = $this->input->post("salary");
			$hiring_date = $this->input->post("hiring_date");
			
			$this->team_member_m->editEmployee($employee_id, $username, $password, $firstname, $lastname, $telephone, $email, $department_id, $type, $salary, $hiring_date);
			redirect("/team_member");
		}
		
		$data = array('title' => 'Edit Employee - DB Hotel Management System', 'page' => 'team_member');
		$this->load->view('header', $data);

		$departments = $this->team_member_m->getDepartments();
		$employee = $this->team_member_m->getEmployee($employee_id);
		
		$viewdata = array('departments' => $departments, 'team_member'  => $employee[0]);
		$this->load->view('team_member/edit',$viewdata);

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