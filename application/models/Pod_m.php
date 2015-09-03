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

    function getPodTypes()
    {
        $query = $this->db->get('pod_type');
        $data = array();

        if($query)
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
        if(count($data))
            return $data;
        return false;
    }

    function save($pod)
    {
        //todo move this to a stored procedure
        if($pod["pod_id"] == null)
        {
            // we don't have a team id, we're adding
            $this->db->insert('pod', $pod);
            return $this->db->affected_rows();
        }

        $this->db->query("call update_pod({$pod['pod_id']},{$pod['pod_name']},{$pod['pod_type']})");
    }
}