<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Users extends CI_Controller 
{

    public function __construct() 
    {
        parent::__construct(); 
         
        // Load form validation Library & user model 
        $this->load->library('form_validation'); 
        $this->load->model('UserModel'); 
        // $this->load->library('noc_validation');
         
        // User login status 
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    }

    // Show login page
    public function index()
    { 
        if($this->isUserLoggedIn){ 
            redirect('users/vacancylist'); 
        }else{ 
            redirect('users/login'); 
        } 
    } 

    // public function profile()
    // { 
    //     $data = array(); 
    //     if($this->isUserLoggedIn){ 
    //         $con = array( 
    //             'id' => $this->session->userdata('userId') 
    //         ); 
    //         $data['user'] = $this->UserModel->getRows($con); 
            
    //         // Pass the user data and load view 
    //         $this->load->view('templates/header', $data); 
    //         $this->load->view('users/profile', $data); 
    //         $this->load->view('templates/footer'); 
    //     }else{ 
    //         redirect('users/login'); 
    //     } 
    // } 

    public function login()
    { 
        $data = array(); 
     
        // Get messages from the session 
        if($this->session->userdata('success_msg'))
        { 
            $data['success_msg'] = $this->session->userdata('success_msg'); 
            $this->session->unset_userdata('success_msg'); 
        } 
        if($this->session->userdata('error_msg'))
        { 
            $data['error_msg'] = $this->session->userdata('error_msg'); 
            $this->session->unset_userdata('error_msg'); 
        } 
        // print_r($_POST); die;
        // If login request submitted 
        if($this->input->post('loginSubmit'))
        { 
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 
            
            if($this->form_validation->run() == true){ 
                $con = array( 
                    'returnType' => 'single', 
                    'conditions' => array( 
                        'EMAIL_ID'=> $this->input->post('email'), 
                        'PASSWORD' => ($this->input->post('password')) 
                        // 'status' => 1 
                    ) 
                ); 
                $checkLogin = $this->UserModel->getRows($con); 
                if($checkLogin){ 
                    $this->session->set_userdata('isUserLoggedIn', TRUE); 
                    $this->session->set_userdata('userId', $checkLogin['USER_ID']); 
                    redirect('users/vacancylist/'); 
                }else{ 
                    $data['error_msg'] = 'Wrong email or password, please try again.'; 
                } 
            }else{ 
                $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        } 
        
        // Load view 
        $this->load->view('templates/header', $data); 
        $this->load->view('users/login', $data); 
        $this->load->view('templates/footer'); 
    }

    public function registration()
    { 
        $data = $userData = array(); 
        // echo '<pre>'; print_r($data); die;
        // If registration request is submitted 
        if($this->input->post('signupSubmit'))
        { 
            $this->form_validation->set_rules('SR_NO', 'Sr No', 'required');
            $this->form_validation->set_rules('FIRST_NAME', 'First Name', 'required'); 
            $this->form_validation->set_rules('LAST_NAME', 'Last Name', 'required'); 
            $this->form_validation->set_rules('EMAIL_ID', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'password', 'required|callback_valid_password'); 
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');
            $this->form_validation->set_rules('MOBILE_NO', 'Mobile No', 'required');
            $this->form_validation->set_rules('GENDER', 'Gender', 'required');
            $UserId = $this->UserModel->getMaxId();
            $userData = array(

                'USER_ID' => $UserId['MAXID']+1,
                'SR_NO' => strip_tags($this->input->post('SR_NO')),
                'FIRST_NAME' => strip_tags($this->input->post('FIRST_NAME')),
                'MIDDLE_NAME' => strip_tags($this->input->post('MIDDLE_NAME')), 
                'LAST_NAME' => strip_tags($this->input->post('LAST_NAME')), 
                'EMAIL_ID' => strip_tags($this->input->post('EMAIL_ID')), 
                'PASSWORD' => $this->input->post('password'), 
                'GENDER' => $this->input->post('GENDER'), 
                'MOBILE_NO' => strip_tags($this->input->post('MOBILE_NO')) 
            ); 
            // echo '<pre>'; print_r($userData); die;
            if($this->form_validation->run() == true)
            { 
                // echo $userData; die;
                $insert = $this->UserModel->insert($userData); 
                if($insert){ 
                    $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
                    redirect('users/login'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
                }else{ 
                    $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        } 
     
        // Posted data 
        $data['user'] = $userData; 
        // echo '<pre>'; print_r($data['user']); die;
        // Load view 
        $this->load->view('templates/header', $data); 
        $this->load->view('users/registration', $data); 
        $this->load->view('templates/footer'); 
    }
 
    public function logout()
    { 
        $this->session->unset_userdata('isUserLoggedIn'); 
        $this->session->unset_userdata('userId'); 
        $this->session->sess_destroy(); 
        redirect('users/login/'); 
    } 
        // Existing email check during validation 
    public function email_check($str)
    {
        $con = array( 
            'returnType' => 'count', 
            'conditions' => array( 
                'EMAIL_ID' => $str 
            ) 
        ); 
        $checkEmail = $this->UserModel->getRows($con); 
            if($checkEmail > 0){ 
                $this->form_validation->set_message('email_check', 'The given email already exists.'); 
                return FALSE; 
            }else{ 
                return TRUE; 
            } 
    }
    public function valid_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        if (empty($password))
        {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 3)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least three lowercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' .htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            return FALSE;
        }
        if (strlen($password) < 5)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
            return FALSE;
        }
        if (strlen($password) > 32)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
            return FALSE;
        }
            return TRUE;
    }

    public function vacancylist()
    {
        if($this->isUserLoggedIn){ 
            $con = array( 
                'id' => $this->session->userdata('userId')
            );
            // print_r($con); die;
        $this->load->database();
        $this->load->model('VacancyModel');
        $data['vacancylist'] = $this->VacancyModel->fetchvacancy();
        $data['user'] = $this->UserModel->getRows($con);
        $this->load->view('templates/header',$data);
        $this->load->view('pages/vacancylist', $data);
        // echo '<pre>';print_r($data['user']); die;
        $this->load->view('templates/footer');
    }else{ 
        redirect('users/login'); 
    }
    }

}

?>