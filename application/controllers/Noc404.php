<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Noc404 extends CI_Controller 
{

    public function __construct() 
    {
        parent::__construct();
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
            // echo '<pre>';print_r($data['user']); die;
            $data['meta'] = array(
            'title' => 'NOC | Error',
            'Description' => 'Page Not Found'
        );
        $this->load->view('templates/header',$data);
        $this->load->view('pages/404');
        $this->load->view('templates/footer');
        }
        else
        {
            redirect('users/login'); 
        }

    }

}