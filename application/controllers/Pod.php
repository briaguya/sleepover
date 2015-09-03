<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pod extends CI_Controller {

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

	function delete($pod_id)
	{
		$this->pod_m->deletePod($pod_id);
		redirect("/pod");
	}

	public function modify($pod_id = null)
	{
		if($pod_id == null)
		{
			//We're adding, we need a null pod
			$pod = null;
			$data = array('title' => 'sleepover - Add Pod', 'page' => 'pod');
		}
		else
		{
			// We're editing, we want to get the pod
			$pod = $this->pod_m->getPod($pod_id);
			$data = array('title' => 'sleepover - Edit Pod', 'page' => 'pod');
		}

		$this->load->view('header', $data);
		$pod_types = $this->pod_m->getPodTypes();
        $locations = $this->pod_m->getLocations();
		$viewdata = array(
			'pod_id' => $pod_id,
			'pod_types' => $pod_types,
            'locations' => $locations,
			'pod' => $pod[0]);
		$this->load->view('pod/modify',$viewdata);
		$this->load->view('footer');
	}

	public function save($pod_id = null)
	{
		if($pod_id == null)
		{
			//we need pod name and pod type
			if(!($this->input->post("pod_name") && $this->input->post("pod_type")))
				return; //todo error?

			//We're adding, make a new team member
			$pod = array(
				'pod_name' => $this->input->post("pod_name"),
				'pod_type' => $this->input->post("pod_type"));
		}
		else
		{
			// We're editing
			$pod = array(
				'pod_id' => $pod_id,
				'pod_name' => $this->input->post("pod_name"),
				'pod_type' => $this->input->post("pod_type"));
		}

		$this->pod_m->save($pod);
		redirect("/pod");
	}

	public function index()
	{
		$pods = $this->pod_m->get_pods();

		$viewdata = array('pods' => $pods);

		$data = array('title' => 'sleepover - Pods', 'page' => 'pod');
		$this->load->view('header', $data);
		$this->load->view('pod/list',$viewdata);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */