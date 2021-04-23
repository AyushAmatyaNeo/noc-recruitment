<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Profile extends CI_Controller 
{

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation'); 
        $this->load->model('UserModel');
        $this->load->model('VacancyModel');
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
        if($this->isUserLoggedIn)
        {
            $userRegistred = $this->UserModel->userRegistred($this->session->userdata('userId'));
            if($userRegistred == true){
                $data = array();
                if($this->isUserLoggedIn){       
                $con = array( 
                    'id' => $this->session->userdata('userId')
                ); 
                $data['user'] = $this->UserModel->userDetails($con); 
                $data['meta'] = array(
                    'title' => 'Noc | Profile View'
                );
                // Pass the user data and load view
                $this->load->view('templates/header', $data); 
                $this->load->view('profile/view', $data); 
                $this->load->view('templates/footer');
                }else{ 
                    redirect('users/login'); 
                }
            }else
            {
                $this->session->set_flashdata('msg', 'Please register to view and edit your account!');
                redirect('users/registration');
            }
        }else{
            $this->session->set_flashdata('msg', 'Please login to view your account!');
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
            $data['user'] = $this->UserModel->userDetails($con);
            $data['proviences'] = $this->VacancyModel->fetch_provience();
            $data['districts'] = $this->VacancyModel->districts();
            // echo '<pre>'; print_r($data); die;
            // Pass the user data and load view
            $data['meta'] = array(
                'title' => 'Noc | Profile Edit'
            );
            $this->load->view('templates/header', $data); 
            $this->load->view('profile/edit', $data); 
            $this->load->view('templates/footer');
        }else
        { 
            redirect('users/login'); 
        }
        if($this->input->post('profilupdate'))
        {
            $userdata = $_POST;
            // echo "<pre>"; print_r($userdata); die;
            $uid = $this->session->userdata('userId');


            $userData['users'] = array(
                'first_name'                => strip_tags($this->input->post('first_name')),
                'middle_name'                => strip_tags($this->input->post('middle_name')),
                'last_name'                 => strip_tags($this->input->post('last_name')),
                'mobile_no'                 => strip_tags($this->input->post('mobile_no')),
                'email_id'                  => strip_tags($this->input->post('email_id')),
            );
            $userData['registration'] = array(
                'religion'                  => strip_tags($this->input->post('religion')),
                'religion_input'            => strip_tags($this->input->post('religion_input')), 
                'region'                    => strip_tags($this->input->post('region')),
                'region_input'              => strip_tags($this->input->post('region_input')),
                'ethnic_name'               => strip_tags($this->input->post('ethnicity')),
                'ethnic_input'              => strip_tags($this->input->post('ethnicity_input')),
                'mother_tongue'             => strip_tags($this->input->post('mother_tongue')),
                'citizenship_no'            => strip_tags($this->input->post('citizenship_no')),
                'ctz_issue_date'            => strip_tags($this->input->post('ctz_issue_date')),
                'ctz_issue_district_id'     => strip_tags($this->input->post('ctz_issue_district_id')),
                'dob'                       => strip_tags($this->input->post('dob')),
                'age'                       => strip_tags($this->input->post('age')),
                'phone_no'                  => strip_tags($this->input->post('phone_no')),
                'gender_id'                 => strip_tags($this->input->post('gender')),                
                'father_name'               => strip_tags($this->input->post('father_name')),
                'father_qualification'      => strip_tags($this->input->post('father_qualification')),                
                'mother_name'               => strip_tags($this->input->post('mother_name')),
                'mother_qualification'      => strip_tags($this->input->post('mother_qualification')),
                'fm_occupation'             => strip_tags($this->input->post('fm_occupation')),
                'fm_occupation_input'       => strip_tags($this->input->post('fm_occupation_input')),
                'grandfather_name'          => strip_tags($this->input->post('grandfather_name')),
                'grandfather_nationality'   => strip_tags($this->input->post('grandfather_nationality')),
                'spouse_name'               => strip_tags($this->input->post('spouse_name')),
                'spouse_nationality'        => strip_tags($this->input->post('spouse_nationality')),
            );
            $userData['address'] = array(
                'per_province_id'           => strip_tags($this->input->post('per_province')),
                'per_district_id'           => strip_tags($this->input->post('per_district')),
                'per_vdc_id'                => strip_tags($this->input->post('per_vdc')),
                'per_ward_no'               => strip_tags($this->input->post('per_ward_no')),
                'per_tole'                  => strip_tags($this->input->post('per_tole')),
                'mail_province_id'          => strip_tags($this->input->post('mail_province')),
                'mail_district_id'          => strip_tags($this->input->post('mail_district')),
                'mail_vdc_id'               => strip_tags($this->input->post('mail_vdc')),
                'mail_ward_no'              => strip_tags($this->input->post('mail_ward_no')),
                'mail_tole'                 => strip_tags($this->input->post('mail_tole')),
            );
            if($userData['registration']['religion'] == 'other'){
                $userData['registration']['religion'] = 'others';
            }
            if($userData['registration']['ethnic_name'] == 'other'){
                $userData['registration']['ethnic_name'] = 'others';
            }
            if($userData['registration']['region'] == 'other'){
                $userData['registration']['region'] = 'others';
            }
            if($userData['registration']['fm_occupation'] == 'other'){
                $userData['registration']['fm_occupation'] = 'others';
            }
            // echo "<pre>"; print_r($userData); die;

            $update = $this->UserModel->updateprofile($userData,$uid);
            if($update == true){ 
                $this->session->set_flashdata('success_msg', 'Your Account has been updated!');
                redirect('profile/view'); 
            }else{ 
                $data['error_msg'] = 'Some problems occured, please try again.'; 
            }
        }
    }
}