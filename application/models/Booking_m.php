<?php

class Booking_m extends CI_Model
{
    function get_bookings()
    {
        $query = $this->db->query("call get_bookings()");
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

    function get_booking($booking_id)
    {
        $query = $this->db->query("call get_booking({$booking_id})");
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

    function save($booking)
    {
        if($booking["booking_id"] == null)
        {
            // we don't have a booking id, we're adding
            $this->db->query("call add_booking({$booking['pod_id']},{$booking['podestrian_id']},\"{$booking['checkin_date']}\"\"{$booking['checkout_date']}\",{$booking['price']},{$booking['status_id']})");
            return;
        }

        $this->db->query("call update_booking({$booking['booking_id']},{$booking['pod_id']},\"{$booking['checkout_date']}\")");
    }

    function get_available_pods($booking)
    {
        $query = $this->db->query("call get_available_pods({$booking['pod_type']},{$booking['location_id']},\"{$booking['checkin_date']}\",\"{$booking['checkout_date']}\")");
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

    function get_statuses()
    {
        $query = $this->db->query("call get_all_status()");
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