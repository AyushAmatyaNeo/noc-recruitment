<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->model('UserModel');
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');

    }

    public function index()
    {
        if($this->isUserLoggedIn)
        { 
            $con = array( 
                'id' => $this->session->userdata('userId')
            );
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'Vacancy Payment',
                'Description' => 'vacancy Payment!'
            );
            $payment = [
                'redirect' => 'https://uat.esewa.com.np/epay/main',
                'amount'   => 100,
                'merchant_id' => 'EPAYTEST',
                'invoice'   => 'ee2c3ca1-696b-4cc5-a6be-2c40d929d453',
                'returnURl' => 'http://merchant.com.np/page/esewa_payment_success?q=su',
                'cancelURL' => 'http://merchant.com.np/page/esewa_payment_failed?q=fu',

            ];
            $this->load->view('templates/header',$data);
            $this->load->view('pages/payment',$payment);
            $this->load->view('templates/footer');
        }
        else{
            redirect('users/login'); 
        }
    }
}
http://localhost/noc-recruitment/vacancy/payment_success?q=su&oid=ee2c3ca1-696b-4cc5-a6be-2c403d929d4ss53&amt=1.0&refId=0001UEN