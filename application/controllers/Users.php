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
        $this->load->model('VacancyModel');
        $this->load->helper('captcha');
        // $this->load->helper(array('form', 'url'));
        // User login status 
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    }

    // Show login page
    public function index()
    { 
        if($this->isUserLoggedIn){ 
            redirect('vacancy/vacancylist'); 
        }else{ 
            redirect('users/login'); 
        }
    } 
    public function login()
    { 
        $data = array();
        
        if($this->isUserLoggedIn){ 
            $checkpwStatus = $this->UserModel->checkpwResetstatus($this->session->userdata('userId'));
                // echo '<pre>'; print_r(($checkpwStatus[0]['RESET_STATUS'])); die;
                if($checkpwStatus == 1)
                {
                    $this->session->set_flashdata('msg', 'Please update your password before enter!');
                    redirect('users/updatepassword');
                }
            redirect('vacancy/vacancylist'); 
        }else{ 

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
            $this->form_validation->set_rules('email', 'email/Username', 'required'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 
            
            if($this->form_validation->run() == true){                 
                $con = array( 
                    'returnType' => 'single', 
                    'conditions' => array( 
                        
                        // 'USERNAME'=> $this->input->post('email'),
                        'PASSWORD' => ($this->input->post('password'))
                    )
                );
                $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';     
                if (preg_match($regex, $this->input->post('email'))) {
                    $con['conditions']['EMAIL_ID']= $this->input->post('email');
                }else{
                    $con['conditions']['USERNAME']= $this->input->post('email');
                }
                
                $checkLogin = $this->UserModel->getRows($con);
                if($checkLogin){ 
                    $this->session->set_userdata('isUserLoggedIn', TRUE); 
                    $this->session->set_userdata('userId', $checkLogin['USER_ID']); 
                    $checkpwStatus = $this->UserModel->checkpwResetstatus($this->session->userdata('userId'));
                    // echo '<pre>'; print_r(($checkpwStatus[0]['RESET_STATUS'])); die;
                    if($checkpwStatus[0]['RESET_STATUS'] == 1)
                    {
                        $this->session->set_flashdata('msg', 'Please update your password before enter!');
                        redirect('users/updatepassword');
                    }
                    redirect('vacancy/vacancylist'); 
                }else{ 
                    $data['error_msg'] = 'Wrong <strong>Email/Username</strong> or <strong>password</strong>, please try again.'; 
                } 
            }else{ 
                $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        } 
        $data['meta'] = array(
            'title' => 'Noc | Login'
        );
        // Load view 
        $this->load->view('templates/header', $data); 
        $this->load->view('users/login', $data); 
        $this->load->view('templates/footer'); 

        }
    }
    public function registration()
    {
        // If registration request is submitted 
        $userRegistred = $this->UserModel->userRegistred($this->session->userdata('userId'));
        if($userRegistred == true)
        {
            $this->session->set_flashdata('msg', 'You have already registred! Please view or edit your details from here.');
            redirect('profile/view');
        }
        if($this->isUserLoggedIn){             
            if($this->input->post('registration'))
            {
                $this->form_validation->set_rules('religion', 'religion', 'required');
                // echo '<pre>'; print_r($_POST) ; die;
                $userId = $this->UserModel->getMaxUserId();
                $registrationId = $this->UserModel->getMaxIdReg();
                $addressId = $this->UserModel->getMaxIdaddress();
                $userData['registration'] = array(
                    'registration_id'          => $registrationId['MAXID']+1,
                    'user_id'                  => $this->session->userdata('userId'),
                    'religion'                 => strip_tags($this->input->post('religion')),
                    'religion_input'           => strip_tags($this->input->post('religion_input')),
                    'region'                   => strip_tags($this->input->post('region')),
                    'region_input'             => strip_tags($this->input->post('region_input')),
                    'ethnicity'                => strip_tags($this->input->post('ethnicity')),
                    'ethnicity_input'          => strip_tags($this->input->post('ethnicity_input')),
                    'mother_tongue'            => strip_tags($this->input->post('mother_tongue')),
                    'Citizenship_no'           => strip_tags($this->input->post('Citizenship_no')),
                    'Issued_date'              => strip_tags($this->input->post('Issued_date')),
                    'Issuedistrict'            => strip_tags($this->input->post('Issuedistrict')),
                    'dob'                      => strip_tags($this->input->post('dateOfBirth')),
                    'age'                      => $this->input->post('age'),                  
                    'phone_no'                 => $this->input->post('phone_no'),
                    'gender'                   => strip_tags($this->input->post('gender')),
                    'father_name'              => strip_tags($this->input->post('father_name')),
                    'fatherEdu'                => strip_tags($this->input->post('fatherEdu')),
                    'mother_name'              => strip_tags($this->input->post('mother_name')),
                    'motherEdu'                => strip_tags($this->input->post('motherEdu')),
                    'fmoccupation'             => strip_tags($this->input->post('fmoccupation')),
                    'fm_occupation_input'      => strip_tags($this->input->post('fm_occupation_input')),
                    'grandfather_name'         => strip_tags($this->input->post('grandfather_name')),
                    'grandfather_nationality'  => strip_tags($this->input->post('grandfather_nationality')),
                    'spouse_name'              => strip_tags($this->input->post('spouse_name')),
                    'spouse_nationality'       => strip_tags($this->input->post('spouse_nationality')),
                    'profile_status'            => '1',
                    'status'                   => 'D',
                    'created_dt'               => date('Y-m-d'),                    
                    'modified_dt'              =>' '

                );                 
                // echo '<pre>'; print_r($userData) ; die;
                $userData['address'] = array(
                    'address_id' => $addressId['MAXID']+1,
                    'user_id' => $this->session->userdata('userId'),
                    'per_province' => strip_tags($this->input->post('per_province')),
                    'per_district' => strip_tags($this->input->post('per_district')), 
                    'per_vdc' => strip_tags($this->input->post('per_vdc')),
                    'per_ward' => strip_tags($this->input->post('per_ward')),
                    'per_tole' => strip_tags($this->input->post('per_tole')),
                    'mail_province' => strip_tags($this->input->post('mail_province')),
                    'mail_district' => strip_tags($this->input->post('mail_district')),
                    'mail_vdc' => strip_tags($this->input->post('mail_vdc')),
                    'mail_ward' => strip_tags($this->input->post('mail_ward')),
                    'mail_tole' => strip_tags($this->input->post('mail_tole')),
                    'status' => 'E',
                    'created_dt' => date('Y-m-d'),
                    'modified_dt' =>' '
                    
                );
                // echo '<pre>'; print_r($userData) ; die;
                if($this->form_validation->run() == true){
                    // echo '<pre>'; print_r($userData) ; die;
                    $insert = $this->UserModel->registerUser($userData);
                    if($insert == true)
                    {
                        $this->session->set_flashdata('success_msg', 'Your account registration has been successful. Please Check your Information.'); 
                        redirect('profile/view');
                    }
                    else{
                        $data['error_msg'] = 'Some problems occured, please try again.';
                        // echo 'Insert fails';
                    }

                }

                // echo '<pre>'; print_r($userData) ; die;
                }
                
     
            // Posted data 
            $data['proviences'] = $this->VacancyModel->fetch_provience();
            $data['districts'] = $this->VacancyModel->districts();
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            // print_r($con); die;
            $data['user'] = $this->UserModel->getRows($con);
            // print_r($userData); die;
            $data['meta'] = array(
                'title' => 'Noc | Registration'
            );
            // echo '<pre>'; print_r($data['user']); die;
            // Load view 

            $this->load->view('templates/header', $data); 
            $this->load->view('users/register', $data); 
            $this->load->view('templates/footer');
             
        }
        else
        { 
            redirect('users/login');
        }
             
    }
    // Existing email check during validation 
    public function email_check($str)
    {
        $con = array( 
            'returnType' => 'count', 
            'conditions' => array( 
                'email_id' => $str 
            ) 
        ); 
        $checkEmail = $this->UserModel->getRows($con); 
        // echo '<pre>'; print_r($checkEmail); die;
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
    // Forgot password --
    public function ForgotPassword()
   {

        $data = array();
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
        $data['meta'] = array(
            'title' => 'Noc | Forgot Password'
        );

        if($this->input->post('resetPassword'))
        {
            $email = $this->input->post('EMAIL_ID');
            // print_r($email); die;  
            $findemail = $this->UserModel->forgotPassword($email); 
            // print_r($findemail); die;
            if($findemail)
            {
                // echo 'Here'; die;
            $this->UserModel->sendpassword($findemail);
            }else{
            $this->session->set_flashdata('msg','Given Email doesn\'t match with the System');
            redirect(base_url().'users/forgotpassword','refresh');
            }
        }
        $con = array(
            'id' => $this->session->userdata('userId'),
            'returnType' => 'single',
        );
        // print_r($con);die;  
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'NOC | Forgot Password',
                'Description' => 'Forgot Password'
            );

        $this->load->view('templates/header',$data); 
        $this->load->view('users/forgotpassword',$data); 
        $this->load->view('templates/footer');
        
   }
   //Update password
   public function UpdatePassword()
   {
        $data = array();
       if($this->isUserLoggedIn){
        //    echo 'You are here to update password';
        if($this->input->post('update_password'))
        {
            // echo '<pre>'; print_r($_POST); die;
            $uid = $this->session->userdata('userId');
            $oldpw  = $this->input->post('old_password');
            $newpw  = $this->input->post('new_password');
            $confpw = $this->input->post('conf_password');
            $checkpassword = $this->UserModel->checkpw($oldpw,$uid);
            if((!strcmp($confpw, $newpw)) && $checkpassword == true) 
            {
                if($oldpw != $newpw)
                {
                    $update = $this->UserModel->updatepw($uid,$newpw);
                    if($update == true)
                    {
                        $this->session->set_flashdata('success_msg','Your password has been updated!');
                        redirect('profile/view');
                    }else
                    {
                        $this->session->set_flashdata('msg','Some error occured!');
                        redirect('users/updatepassword');
                    }

                }else
                {
                    $this->session->set_flashdata('msg','Your cannot use old password,please try again!');
                    redirect('users/updatepassword');
                }                
            }else
            {
                $this->session->set_flashdata('msg','Your old password doesn\'t match,please try again!');
                redirect('users/updatepassword');
            }
        }
        $con = array(
            'id' => $this->session->userdata('userId')
        );
        $data['meta'] = [
            'title' => 'Noc | Password Update',
        ];
        $data['user'] = $this->UserModel->getRows($con);
        $this->load->view('templates/header',$data);
        $this->load->view('users/updatepassword',$data);
        $this->load->view('templates/footer');

       }else
       {
           $this->session->set_flashdata('msg','Please login to update password!');
           redirect('users/login');
       }
   }
   // Check Unique Email ID while signup
    public function register_email_exists()
    {
        // print_r($_POST); die;
        if (array_key_exists('email_id',$_POST)) 
        {
         if ( $this->UserModel->email_exists2($this->input->post('email_id')) == TRUE ) 
            {
            echo json_encode(FALSE);
            } 
        else 
            {
                echo json_encode(TRUE);
            }
        }
    } 
    // Check Unique Mobile no. while signup
    public function register_mobile_exists()
    {
        // print_r($_POST); die;
        if (array_key_exists('mobile_no',$_POST)) 
        {
         if ( $this->UserModel->mobile_exists2($this->input->post('mobile_no')) == TRUE ) 
            {
            echo json_encode(FALSE);
            } 
        else 
            {
                echo json_encode(TRUE);
            }
        }
    } 
    public function signup()
    {
        if($this->isUserLoggedIn){ 
            redirect('vacancy/vacancylist'); 
        }else
        { 
            if($this->input->post('signup'))
        { 
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
            $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required');
            $this->form_validation->set_rules('email_id', 'Email Id', 'required'); 
            $this->form_validation->set_rules('username', 'Username', 'required'); 
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            $UserId = $this->UserModel->getMaxUserId();
            $userData = array(
                'USER_ID' => $UserId['MAXID'] +1,
                'FIRST_NAME' => strip_tags($this->input->post('first_name')),
                'MIDDLE_NAME' => $this->input->post('middle_name'), 
                'LAST_NAME' => strip_tags($this->input->post('last_name')),
                'MOBILE_NO' => strip_tags($this->input->post('mobile_no')),
                'EMAIL_ID' => strip_tags($this->input->post('email_id')),
                'USERNAME' => $this->input->post('username'),
                'PASSWORD' => $this->input->post('password'), 
                'CREATED_DT' => date('Y-m-d')
            ); 
            if($this->form_validation->run() == true)
            { 
                $inputCaptcha = $this->input->post('captcha');
                $sessCaptcha = $this->session->userdata('captchaCode');
                if($inputCaptcha !== $sessCaptcha){
                    $this->session->set_flashdata('error_msg', 'Your Captch doesn\'t Match. Please try again!'); 
                    redirect('users/signup');
                }
                // echo '<pre>'; print_r($userData); die;
                $insert = $this->UserModel->insert($userData); 
                if($insert){ 
                    $this->session->set_flashdata('success_msg', 'Your account registration has been successful. Please login to your account.'); 
                    redirect('users/login'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
                }else{ 
                    $data['error_msg'] = 'Please fill all the mandatory fields.'; 
            } 
        }
            $data['meta'] = array(
                'title' => 'Noc | SignUp Account'
            );
            // Captcha
            $config = array(
                'img_path'      => 'assets/captcha/',
                'img_url'       => base_url('assets/captcha/'),
                'font_path'     => '../../system/fonts/texb.ttf',
                'img_width'     => '160',
                'img_height'    => 50,
                'word_length'   => 8,
                'font_size'     => 18
            );
            // echo '<pre>'; print_r($config); die;
            $captcha = create_captcha($config);
            
            // Unset previous captcha and set new captcha word
            $this->session->unset_userdata('captchaCode');
            $this->session->set_userdata('captchaCode', $captcha['word']);
            
            // Pass captcha image to view
            $data['captchaImg'] = $captcha['image'];

            // echo '<pre>'; print_r($data['captchaImg']); die;
            // Load view 
            $this->load->view('templates/header', $data); 
            $this->load->view('users/signup', $data); 
            $this->load->view('templates/footer');
        }
    }
    //Captcha Refresh
    public function refresh(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'assets/captcha/',
            'img_url'       => base_url().'assets/captcha/',
            'font_path'     => '../../system/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 8,
            'font_size'     => 18
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image
        echo $captcha['image'];
    }
    public function logout()
    {
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('users/login/');
    }
    // Profile Edit page Address district & vdc populate
    public function fetch_district()
    {
        $province_id = $this->input->post('province_id');
        $district_id = $this->input->post('district_id');
        $mail_province_id = $this->input->post('mail_province_id');
        $mail_district_id = $this->input->post('mail_district_id');
        if ($province_id) 
        {
            echo $this->UserModel->fetch_user_district($province_id,$district_id);            
        }
        if($mail_province_id)
        {
            echo $this->UserModel->fetch_user_district($mail_province_id,$mail_district_id);
        }
    }
    public function fetch_vdc()
    {
        $district_id = $this->input->post('district_id');
        $vdc_id = $this->input->post('vdc_id');
        $mail_district_id = $this->input->post('mail_district_id');
        $mail_vdc_id = $this->input->post('mail_vdc_id');
        if ($district_id) {
            echo $this->UserModel->fetch_user_vdc($district_id,$vdc_id);
        }
        if ($mail_district_id) {
            echo $this->UserModel->fetch_user_vdc($mail_district_id,$mail_vdc_id);
        }
    }

}
