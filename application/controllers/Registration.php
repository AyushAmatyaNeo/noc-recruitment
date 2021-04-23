<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller
{
    public function index()
    {
        $con = array( 
            'id' => $this->session->userdata('userId')
        ); 
        $data['user'] = $this->UserModel->getRows($con);
        $data['meta'] = array(
            'title' => 'Noc | Registration',
            'Description' => 'Registration for new Users'
        );
        die;
        // $this->load->view('templates/header',$data);
        // $this->load->view('users/registration',$data);
        // $this->load->view('templates/footer');
    }

    public function view()
    {
        
    }
}