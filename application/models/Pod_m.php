<?php

class Pod_m extends CI_Model
{
    function get_pods()
    {
        $query = $this->db->query("call get_all_pods()");
        $data = array();

        $result = $query->result();
        $query->free_result();

        $query->next_result(); // Dump the extra resultset.
        // Does what it says.

        foreach (@$result as $row)
        {
            $data[] = $row;
        }
        if(count($data))
            return $data;
        return false;
    }
}