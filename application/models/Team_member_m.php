<?php

class Team_member_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function check_login($username, $password)
    {
        $query = $this->db->from('team_member')->where('username', $username)->where('password', $password)->get();
        $data = array();

        foreach (@$query->result() as $row)
        {
            $data[] = $row;
            // $row->customer_id
            // $row->customer_username
            // $data[0]->customer_id
            var_dump($row);
        }
        if(count($data))
            return $data;
        return false;
    }
}