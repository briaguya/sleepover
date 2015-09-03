<?php

class Pod_m extends CI_Model
{

    function get_pods()
    {
        $query = $this->db->order_by('room_id')->get('room');
        $data = array();

        $i=-1;
        
        if(count($data))
            return $data;
        return false;
    }
}