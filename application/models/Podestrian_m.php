<?php

class Podestrian_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_podestrians()
    {
        $query = $this->db->query('call get_all_podestrians()');
        $data = array();

        foreach (@$query->result() as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
    }

    function addPodestrian($first_name, $last_name, $email, $podestrian_type_id, $address_id, $sex, $facebook, $twitter, $instagram, $birthday, $how_found)
    {
        //todo move this to a stored procedure
        $data = array('first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'podestrian_type_id' => $podestrian_type_id, 'address_id' => $address_id, 'sex' => $sex, 'facebook' => $facebook, 'twitter' => $twitter, 'instagram' => $instagram, 'birthday' => $birthday, 'how_found' => $how_found);
        $this->db->insert('podestrian', $data);
        return $this->db->affected_rows();
    } 

    function deletePodestrian($podestrian_id)
    {
        $this->db->delete('podestrian', array('podestrian_id' => $podestrian_id));
        return $this->db->affected_rows();
    }

    function editEmployee($employee_id, $username, $password, $firstname, $lastname, $telephone, $email, $department_id, $employee_type, $employee_salary, $employee_hiring_date)
    {
        $data = array('employee_username' => $username, 'employee_password' => $password, 'employee_firstname' => $firstname, 'employee_lastname' => $lastname, 'employee_telephone' => $telephone, 'employee_email' => $email, 'department_id' => $department_id, 'employee_type' => $employee_type, 'employee_salary' => $employee_salary, 'employee_hiring_date' => $employee_hiring_date);

        $this->db->where('employee_id', $employee_id);
        $this->db->update('team_member', $data);
    }

    function getEmployee($employee_id)
    {
        $query = $this->db->get_where('team_member', array('employee_id' => $employee_id));
        return $query->result();
    }

    function getPodestrianTypes()
    {
        $query = $this->db->from('podestrian_type')->get();
        $data = array();

        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
    }

    function getAddresses()
    {
        $query = $this->db->from('address')->get();
        $data = array();

        foreach ($query->result() as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
    }
}
