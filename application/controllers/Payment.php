<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url']);
    }

    public function index(){
        $data['key_id'] = 'rzp_test_se3uASWxOG0yvj';
        $data['amount'] = 10000;
        $this->load->view('dash/razorpay_view', $data);
    }


    public function success()
    {
        $payment_id = $this->input->get('payment_id');
        
        if ($payment_id) {
            echo "<h2>Payment successful!</h2>";
            echo "Payment ID: " . $payment_id;
        } else {
            echo "Payment Failed.";
        }
    }
}
