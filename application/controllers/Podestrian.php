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
			
			$this->team_member_m->addEmployee($username, $password, $firstname, $lastname, $telephone, $email, $department_id, $type, $salary, $hiring_date);
			redirect("/team_member");
		}

		$data = array('title' => 'Add Employee - DB Hotel Management System', 'page' => 'team_member');
		$this->load->view('header', $data);
		$departments = $this->team_member_m->getDepartments();
		$viewdata = array('departments' => $departments);
		$this->load->view('team_member/add',$viewdata);
		$this->load->view('footer');
	}

	function delete($employee_id)
	{
		$this->team_member_m->deleteEmployee($employee_id);
		redirect("/team_member");
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
		$employees = $this->team_member_m->get_team_members();

		$data = array('title' => 'sleepover - Team Members', 'page' => 'team_member');
		$this->load->view('header', $data);
		$this->load->view('team_member/list', array('employees' => $employees));
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */