<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Profile extends CI_Controller 
{

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation'); 
        $this->load->model('UserModel');
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    }

    public function index()
    { 
        if($this->isUserLoggedIn){ 
            redirect('profile/view'); 
        }else{ 
            redirect('users/login'); 
        } 
    }

    public function view()
    { 
        $data = array();
        if($this->isUserLoggedIn){       
        $con = array( 
            'id' => $this->session->userdata('userId') 
        ); 
        $data['user'] = $this->UserModel->getRows($con); 
        
        // Pass the user data and load view 
        $this->load->view('templates/header', $data); 
        $this->load->view('profile/view', $data); 
        $this->load->view('templates/footer');
        }else{ 
            redirect('users/login'); 
        }
    } 

    public function edit()
    {
        $data = array();
        if($this->isUserLoggedIn)
        {
            $con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->UserModel->getRows($con); 
            // echo '<pre>'; print_r($data); die;
            // Pass the user data and load view 
            $this->load->view('templates/header', $data); 
            $this->load->view('profile/edit', $data); 
            $this->load->view('templates/footer');
        }else
        { 
            redirect('users/login'); 
        }
        if($this->input->post('signupSubmit'))
        {
            // $userdata = $_POST;
            $uid = $this->session->userdata('userId');
            $userData = array(

                'SR_NO' => strip_tags($this->input->post('SR_NO')),
                'FIRST_NAME' => strip_tags($this->input->post('FIRST_NAME')),
                'MIDDLE_NAME' => strip_tags($this->input->post('MIDDLE_NAME')), 
                'LAST_NAME' => strip_tags($this->input->post('LAST_NAME')), 
                'EMAIL_ID' => strip_tags($this->input->post('EMAIL_ID')), 
                'GENDER' => $this->input->post('GENDER'), 
                'MOBILE_NO' => strip_tags($this->input->post('MOBILE_NO')) 
            ); 
            $update = $this->UserModel->updateuser($userData,$uid);
            if($update){ 
                redirect('profile/view'); 
            }else{ 
                $data['error_msg'] = 'Some problems occured, please try again.'; 
            }
        }
    }
}