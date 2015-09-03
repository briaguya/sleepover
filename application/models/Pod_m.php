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

    function getLocations()
    {
        $query = $this->db->get('location');
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

        $this->db->query("call update_pod({$pod['pod_id']},\"{$pod['pod_name']}\",{$pod['pod_type']})");
    }

    function getPod($pod_id)
    {
        $query = $this->db->query("call get_pod({$pod_id})");
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

    function deletePod($pod_id)
    {
        $this->db->delete('pod', array('pod_id' => $pod_id));
        return $this->db->affected_rows();
    }
}