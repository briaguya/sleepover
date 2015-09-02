<?php

class User_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function check_login($username, $password)
    {
        $query = $this->db->query("call check_login('{$username}', '{$password}')");
        $data = array();

        $result = $query->result();

        $query->next_result(); // Dump the extra resultset.
        $query->free_result(); // Does what it says.

        foreach (@$result as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
    }
}