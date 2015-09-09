<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

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

    public function index()
    {
        $bookings = $this->booking_m->get_bookings();

        $viewdata = array('bookings' => $bookings);

        $data = array('title' => 'sleepover - Bookings', 'page' => 'booking');
        $this->load->view('header', $data);
        $this->load->view('booking/list',$viewdata);
        $this->load->view('footer');
    }

    public function start()
    {
        // we want to search for available pods here
        // we need to get podestrian, location, pod_type, checkin, checkout
        $data = array('title' => 'sleepover - New Booking', 'page' => 'booking');

        $this->load->view('header', $data);
        $podestrians = $this->podestrian_m->get_podestrians();
        $pod_types = $this->pod_m->getPodTypes();
        $locations = $this->pod_m->getLocations();
        $viewdata = array(
            'podestrians' => $podestrians,
            'pod_types' => $pod_types,
            'locations' => $locations);
        $this->load->view('booking/start',$viewdata);
        $this->load->view('footer');
    }

    public function get_available_pods()
    {
        //we need a checkin and checkout date
        if(!($this->input->post("checkin_date") && $this->input->post("checkout_date")))
            return; //todo error?

        //We're adding, make a new team member
        $current_booking = array(
            'location_id' => $this->input->post("location_id"),
            'pod_type' => $this->input->post("pod_type"),
            'checkin_date' => $this->input->post("checkin_date"),
            'checkout_date' => $this->input->post("checkout_date"));

        //Save the current booking to a cookie
        set_cookie('sleepovercurrentbooking', json_encode($current_booking), 0);

        $data = array('title' => 'sleepover - Choose a Pod', 'page' => 'booking');

        $this->load->view('header', $data);
        $pods = $this->booking_m->get_available_pods($current_booking);
        $viewdata = array('pods' => $pods);
        $this->load->view('booking/choose_pod',$viewdata);
        $this->load->view('footer');
    }

    public function confirm($pod_id)
    {
        // get current booking from cookie
        $current_booking = json_decode(get_cookie('sleepovercurrentbooking'),true);
        $current_booking["pod_id"] = $pod_id;
        //Save the current booking to a cookie
        set_cookie("sleepovercurrentbooking", json_encode($current_booking));

        $data = array('title' => 'sleepover - Confirm Booking', 'page' => 'booking');

        $this->load->view('header', $data);
        $podestrians = $this->podestrian_m->get_podestrians();
        $pod = $this->pod_m->getPod($pod_id);
        $statuses = $this->booking_m->get_statuses();
        $viewdata = array(
            'booking' => $current_booking,
            'pod' => $pod[0],
            'statuses' => $statuses,
            'podestrians' => $podestrians);
        $this->load->view('booking/confirm',$viewdata);
        $this->load->view('footer');
    }

    public function book()
    {
        // get current booking from cookie
        $current_booking = json_decode(get_cookie("sleepovercurrentbooking",true));

        //we need stuff
        if(!($this->input->post("podestrian_id") && $this->input->post("status_id") && $this->input->post("price")))
            return; //todo error?

        $current_booking["podestrian_id"] = $this->input->post("podestrian_id");
        $current_booking["status_id"] = $this->input->post("status_id");
        $current_booking["price"] = $this->input->post("price");

        $this->booking_m->save($current_booking);
        redirect("/booking");
    }

    public function save($booking_id = null)
    {
        if($booking_id == null)
        {
            //we need stuff
            if(!($this->input->post("podestrian_id") && $this->input->post("pod_id") && $this->input->post("checkin_date") && $this->input->post("checkout_date")))
                return; //todo error?

            //We're adding, make a new team member
            $booking = array(
                'pod' => $this->input->post("pod_id"),
                'podestrian' => $this->input->post("podestrian_id"),
                'checkin_date' => $this->input->post("checkin_date"),
                'checkout_date' => $this->input->post("checkout_date"),
                'price' => $this->input->post("price"),
                'booking_status' => $this->input->post("status_id"));
        }
        else
        {
            // We're editing
            $booking = array(
                'booking_id' => $booking_id,
                'pod_id' => $this->input->post("pod_id"),
                'checkout_date' => $this->input->post("checkout_date"));
        }

        $this->booking_m->save($booking);
        redirect("/booking");
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */