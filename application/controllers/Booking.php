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

    public function modify($booking_id = null)
    {
        if($booking_id == null)
        {
            //We're adding, we need a null booking
            $booking = null;
            $data = array('title' => 'sleepover - Add Booking', 'page' => 'pod');
        }
        else
        {
            // We're editing, we want to get the pod
            $booking = $this->booking_m->getBooking($booking_id);
            $data = array('title' => 'sleepover - Edit Booking', 'page' => 'pod');
        }

        $this->load->view('header', $data);
        $pods = $this->pod_m->get_pods();
        $podestrians = $this->podestrian_m->get_podestrians();
        $viewdata = array(
            'booking_id' => $booking_id,
            'pod_types' => $pods,
            'podestrians' => $podestrians,
            'booking' => $booking[0]);
        $this->load->view('booking/modify',$viewdata);
        $this->load->view('footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */