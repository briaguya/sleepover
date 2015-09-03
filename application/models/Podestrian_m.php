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

    function save($podestrian)
    {
        //todo move this to a stored procedure
        if($podestrian["podestrian_id"] == null)
        {
            // we don't have a podestrian id, we're adding
            $this->db->insert('podestrian', $podestrian);
            return $this->db->affected_rows();
        }

        $this->db->where('podestrian_id', $podestrian["podestrian_id"]);
        $this->db->update('podestrian', $podestrian);
    } 

    function deletePodestrian($podestrian_id)
    {
        $this->db->delete('podestrian', array('podestrian_id' => $podestrian_id));
        return $this->db->affected_rows();
    }

    function getPodestrian($podestrian_id)
    {
        $query = $this->db->get_where('podestrian', array('podestrian_id' => $podestrian_id));
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
