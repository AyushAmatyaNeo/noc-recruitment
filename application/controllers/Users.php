<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Users extends CI_Controller 
{

    private $isUserLoggedIn;

    public function __construct() 
    {
        parent::__construct(); 
         
        // Load form validation Library & user model 
        $this->load->library('form_validation'); 
        $this->load->model('UserModel');
        $this->load->model('VacancyModel');
        $this->load->helper('captcha');
        $this->load->helper('url');
        // $this->load->helper(array('form', 'url'));
        // User login status 
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    }

    // Show login page
    public function index()
    { 
        if($this->isUserLoggedIn) { 

            redirect('vacancy/vacancylist'); 
        
        } else { 
            
            redirect('users/login'); 
        
        }
    }

    public function login() { 

        $data = array();
        
        /**
         * ON FINDING USER SESSION ID
         * */
        if ( $this->isUserLoggedIn ) {

            $checkpwStatus = $this->UserModel->checkpwResetstatus( $this->session->userdata( 'userId' ) );
                
                if ( $checkpwStatus == 1 ) {

                        $this->session->set_flashdata( 'msg', 'Please update your password before enter!' );
                            redirect( 'users/updatepassword' );

                }
            
                redirect( 'vacancy/vacancylist' ); 
        
        } else {

            // Get messages from the session 
            if ( $this->session->userdata( 'success_msg' ) ) { 
                
                $data[ 'success_msg' ] = $this->session->userdata( 'success_msg' ); 
                    $this->session->unset_userdata( 'success_msg' ); 
            
            } 
        
            if ( $this->session->userdata( 'error_msg' )) { 
            
                $data['error_msg'] = $this->session->userdata('error_msg'); 
                    $this->session->unset_userdata('error_msg'); 
            
            } 
        
            // If login request submitted 
            if ($this->input->post('loginSubmit')) {  

                $this->form_validation->set_rules('email', 'email/Username', 'required'); 
                $this->form_validation->set_rules('password', 'password', 'required');
                
                if ( $this->form_validation->run() == true ) {     
                
                    
                    // check active status
                    if ( emailCheckValid($this->input->post('email')) ) {
                    
                        $cond['email']['EMAIL_ID'] = $this->input->post('email');

                    } else {
                        
                        $cond['email']['USERNAME'] = $this->input->post('email');
                        
                    }
                
                    $checkactiveStatus = $this->UserModel->checkactivestatus($cond);

                    /**
                     *  ACTIVE STATUS ->>>>>> D : 'NOT EMAIL VERIFIED' || E:  'EMAIL VERIFIED'
                     * */
                
                    if ( $checkactiveStatus['ACTIVE_STATUS'] == 'D' ) {
                    
                        $this->session->set_flashdata('msg', 'Please verify your Email before enter!');
                            redirect('users/login');
                    
                    }

                    $con = [ 
                            'returnType' => 'single', 
                            'conditions' => [
                                // 'USERNAME'=> $this->input->post('email'),
                                'PASSWORD' => $this->input->post('password')
                                ]
                            ];

                    if (emailCheckValid($this->input->post('email'))) 
                    {
                     
                        $con['conditions']['EMAIL_ID'] = $this->input->post('email');

                    } else {
                        
                        $con['conditions']['USERNAME'] = $this->input->post('email');

                    }
                    

                    $checkLogin = $this->UserModel->getRows($con);
                    
                    // SETTING SESSION OF USERS
                    if ($checkLogin)
                    { 
                        
                        $this->session->set_userdata('isUserLoggedIn', TRUE); 
                        $this->session->set_userdata('userId', $checkLogin['USER_ID']); 
                        $checkpwStatus = $this->UserModel->checkpwResetstatus($this->session->userdata('userId'));


                        if($checkpwStatus[0]['RESET_STATUS'] == 1)
                        {
                        
                            $this->session->set_flashdata('msg', 'Please update your password before enter!');
                                redirect('users/updatepassword');

                        }
                        
                        redirect('vacancy/vacancylist'); 
                    
                    } else { 

                        $data['error_msg'] = 'Wrong <strong>Email/Username</strong> or <strong>password</strong>, please try again.'; 
                    
                    } 
                
                } else { 
                    
                    $data['error_msg'] = 'Please fill all the mandatory fields.'; 
                
                } 
            
            } 

            $data['meta'] = ['title' => 'Noc | Login'];

            // Load view 
            $this->load->view('templates/header', $data); 
            $this->load->view('users/login', $data); 
            $this->load->view('templates/footer'); 

        }
    }

    /**
     * CREATE NEW USER REGISTRATION
     * 
     * 
     * */
    public function registration()
    {

        // If registration request is submitted 
        $userRegistred = $this->UserModel->userRegistred($this->session->userdata('userId'));

        // echo "here"; die;
        // $userRegistred = false;
        if($userRegistred == true)
        {
            $this->session->set_flashdata('msg', 'You have already registred! Please view or edit your details from here.');
            redirect('profile/view');
        }
        if($this->isUserLoggedIn){             
            if($this->input->post('registration'))
            {
                $this->form_validation->set_rules('religion', 'religion', 'required');
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
                    'profile_status'           => '1',
                    'MARITAL_STATUS'           => strip_tags($this->input->post('marital')),     
                    'EMPLOYMENT_STATUS'        => strip_tags($this->input->post('employment')),
                    'EMPLOYMENT_INPUT'         => strip_tags($this->input->post('employment_input')),
                    'DISABILITY'               => strip_tags($this->input->post('disability')),
                    'DISABILITY_INPUT'         => strip_tags($this->input->post('disability_input')),   
                    'status'                   => 'D',
                    'created_dt'               => date('Y-m-d'),                    
                    'modified_dt'              =>' ',
                    'blood_group'              => strip_tags($this->input->post('blood_group')),
                    'in_service'              => strip_tags($this->input->post('in_service')),   

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
                    'modified_dt' =>' ',
                    'per_house_no' => strip_tags($this->input->post('per_house_no')),
                    'mail_house_no' => strip_tags($this->input->post('mail_house_no'))
                    
                );
                // echo '<pre>'; print_r($_FILES) ; die;
                if($this->form_validation->run() == true){
                    $insert = $this->UserModel->registerUser($userData);
                    // $insert = true;
                    if($insert == true)
                    {
                        // echo '<pre>' ;print_r($_FILES); die;
                        $_FILES['ethnicity_file']['folders'] = 'ethnicity';
                        $_FILES['disability_file']['folders'] = 'disability';
                        $_FILES['inservice_file']['folders'] = 'in_service';
                        $_FILES['ethnicity_file']['input_names'] = 'ethnicity_file';
                        $_FILES['disability_file']['input_names'] = 'disability_file';
                        $_FILES['inservice_file']['input_names'] = 'inservice_file';
                        $files = array_chunk($_FILES,1);
                        // echo '<pre>' ;print_r($files); die;
                        foreach($files as $file){
                            // echo '<pre>' ;print_r($file[0]); die;
                            if(!empty($file[0]['name'])){
                                // echo '<pre>';print_r($file); die;
                                $upload_fun = $this->file_upload($file[0]['input_names'],$file[0]['folders']); 
                                if($upload_fun == true){
                                    $this->session->set_flashdata('success_msg', 'Your account registration has been successful. Please Check your Information.'); 
                                    
                                }else{
                                    $this->session->set_flashdata('error_msg', 'Your account registration has been successful but image upload failed.');
                                }
                            }
                        }
                        redirect('profile/view');                    
                    }
                    else{
                        $data['error_msg'] = 'Some problems occured, please try again.';
                        // echo 'Insert fails';
                    }
                }
                }                
     
            // Posted data 
            $data['proviences'] = $this->VacancyModel->fetch_provience();
            $data['districts'] = $this->VacancyModel->districts();
            $data['blood_groups'] = $this->VacancyModel->fetch_bloodGroup();
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            // echo '<pre>'; print_r($data['blood_groups']); die;
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

    public function file_upload($input_id,$folder_name)
    {
        // echo'<pre>'; print_r($folder_name) ; die; 
        $config = [
            'upload_path' => './uploads/noc_documents/users/registration/'.$folder_name.'/',
            'allowed_types' => 'jpg|png|jpeg|pdf',
            'encrypt_name' => TRUE,
            'max_size'   => 1024,
            'file_ext_tolower' => TRUE,
        ];
        $this->load->library('upload',$config, $folder_name);
        $this->$folder_name->initialize($config);
        // echo $folder_name; die;
        if($this->$folder_name->do_upload($input_id))
        {
            $imageMaxId              = $this->VacancyModel->getMaxIds('REC_DOC_ID','HRIS_REC_APPLICATION_DOCUMENTS');
            $uploadData              = $this->$folder_name->data();
            $image['REC_DOC_ID']     = $imageMaxId['MAXID'] +1;
            $image['USER_ID']        = $this->session->userdata('userId');
            $image['oldname']        = $uploadData['orig_name'];
            $image['newname']        = $uploadData['raw_name'];
            $image['fullpath']       = base_url('uploads/noc_documents/users/registration/'.$folder_name.'/'.$uploadData['raw_name'].$uploadData['file_ext']);
            $image['type']           = ltrim($uploadData['file_ext'], '.'); 
            $image['folder']         = $folder_name;
            // echo'<pre>'; print_r($image) ; die;
            $insert_img = $this->UserModel->insertimg($image);
            if($insert_img == true)
            {
                return true;
            }
            // echo'<pre>'; print_r($image) ; die;          
        }
        else{
            echo $this->$folder_name->display_errors('<p>', '</p>');
            return false;
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
            if ($checkEmail > 0) { 
                $this->form_validation->set_message('email_check', 'The given email already exists.'); 
                return FALSE; 
            }else{ 
                return TRUE; 
            } 
    }


    /*************
     * 
     *  USER PASSWORD SECTION
     * 
     *********** */
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

    /**
     * Forgot password
     * 
     * */
    public function ForgotPassword()
    {

        $data = array();

        if (empty($this->session->userdata('userId'))) 
        {

            if ($this->session->userdata('success_msg')) 
            {

                $data['success_msg'] = $this->session->userdata('success_msg'); 
                    $this->session->unset_userdata('success_msg'); 
            
            }

            if ($this->session->userdata('error_msg')) 
            {

                $data['error_msg'] = $this->session->userdata('error_msg'); 
                    $this->session->unset_userdata('error_msg'); 
            
            }

            $data['meta'] = [
                'title' => 'Noc | Forgot Password',
                'description' => 'Forgot Password'
            ];

            if ($this->input->post('resetPassword') == 'Submit') 
            {
               
                $email     = $this->input->post('email_id');
                $findEmail = $this->UserModel->forgotPassword($email); 

                if ($findEmail)
                {
                    
                    $this->UserModel->sendpassword($findEmail);

                } else {

                    $this->session->set_flashdata('msg','Given Email doesn\'t match with the System');
                        redirect('users/forgotpassword','refresh');

                }
            }           

            
            $this->load->view('templates/header', $data); 
            $this->load->view('users/forgotpassword', $data); 
            $this->load->view('templates/footer');

        } else {

            redirect('users/updatepassword');

        }
    }

    /**
     * Update password
     * 
     * */
    public function UpdatePassword()
    {

        $data = array();
       
        if ($this->isUserLoggedIn)
        {
            $con = [
                    'id' => $this->session->userdata('userId')
                   ];

            if ($this->input->post('update_password'))
            {
                $oldpw  = $this->input->post('old_password');
                $newpw  = $this->input->post('new_password');
                $confpw = $this->input->post('conf_password');
                $checkpassword = $this->UserModel->checkpw($oldpw, $con['id']);

                if ((!strcmp($confpw, $newpw)) && $checkpassword == true) 
                {

                    if ($oldpw != $newpw)
                    {

                        $update = $this->UserModel->updatepw($con['id'], $newpw);
                        
                        if ($update == true)
                        {
                            
                            $this->session->set_flashdata('success_msg','Your password has been updated!');
                                redirect('profile/view');
                        
                        } else {

                            $this->session->set_flashdata('msg','Some error occured!');
                            redirect('users/updatepassword');

                        }

                    } else {

                        $this->session->set_flashdata('msg','Your cannot use old password,please try again!');
                            redirect('users/updatepassword');
                    
                    } 

                } else {

                    $this->session->set_flashdata('msg','Your old password doesn\'t match,please try again!');
                        redirect('users/updatepassword');

                }

            }

        
            $data['meta'] = [
                'title' => 'Noc | Password Update',
            ];

            $data['user'] = $this->UserModel->getRows($con);
            $this->load->view('templates/header',$data);
            $this->load->view('users/updatepassword',$data);
            $this->load->view('templates/footer');

        } else {

           $this->session->set_flashdata('msg','Please login to update password!');
            redirect('users/login');

        }
    }

    /**
    * CHECK UNIQUE EMAIL ID WHILE SIGNUP 
    * 
    * */
    public function register_email_exists()
    {
        if ( array_key_exists('email_id', $_POST) ) {
            
            if ( $this->UserModel->email_exists2($this->input->post('email_id') ) == TRUE ) {
                
                echo json_encode(false);
            
            } else {

                echo json_encode(true);
            
            }
        }
    } 
    
    /**
     * CHECK UNIQUE MOBILE NO. WHILE SIGNUP
     * 
     * */
    public function register_mobile_exists() {

        // print_r($_POST); die;
        if ( array_key_exists('mobile_no',$_POST) ) {
            
            if ( $this->UserModel->mobile_exists2($this->input->post('mobile_no')) == TRUE ) {
            
                echo json_encode(FALSE);
            
            } else {
            
                echo json_encode(TRUE);
            
            }
        }
    }  

    /**
     * CHECK UNIQUE USERNAME WHILE SIGNUP
     * 
     * */
    public function register_username_exists()
    {
        if (array_key_exists('username',$_POST)) 
        {
         if ( $this->UserModel->columnDataExits('username', $this->input->post('username')) == TRUE ) 
            {
                echo json_encode(FALSE);
            } 
        else 
            {
                echo json_encode(TRUE);
            }
        }
    } 

    /**
     *  USER SIGN UP FORM
     * 
     * 
     * */
    public function signup()
    {

        if ($this->isUserLoggedIn) 
        { 
        
            redirect('vacancy/vacancylist'); 
        
        } else {

            if ($this->input->post('signup'))
            {

                $this->form_validation->set_rules('first_name', 'First Name', 'required');
                $this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
                $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required');
                $this->form_validation->set_rules('email_id', 'Email Id', 'required'); 
                $this->form_validation->set_rules('username', 'Username', 'required|callback_username_check'); 
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('name_nepali', 'Name in Nepali', 'required');


                /* EXTRA LEVEL OF VERIFICATION */
                

                // $this->_checkInUserSameValue($_POST);


                // echo "<pre>";

                // print_r($this->input->post());

                // echo 'here only';

                // die;
                
               
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
                    'CREATED_DT' => date('Y-m-d'),
                    'NAME_NEPALI' => $this->input->post('name_nepali')
                );


                if ($this->form_validation->run() == true)
                { 

                    $inputCaptcha = $this->input->post('captcha');
                    $sessCaptcha  = $this->session->userdata('captchaCode');
                    
                    if ($inputCaptcha !== $sessCaptcha)
                    {

                        $this->session->set_flashdata('error_msg', 'Your Captch doesn\'t Match. Please try again!'); 
                        redirect('users/signup');
                    
                    }
                    
                    // echo '<pre>'; print_r($userData); die;
                    $insert = $this->UserModel->insert($userData); 
                    // $insert = 1; 
                    
                    if ($insert)
                    { 

                        //Send Email to user
                        // $this->sendVerificationEmail($userData['EMAIL_ID']);
                        $emailsend = $this->UserModel->sendVerificationEmail($userData['EMAIL_ID']);

                        if ($emailsend)
                        {
                        
                            $this->session->set_flashdata('success_msg', 'Account Signup successful , Verification Email sent.');
                            redirect('users/login');
                        
                        } else {
                            
                            $this->session->set_flashdata('error_msg', 'Account Signup successful , Verification Email Failed to send.'); 
                            redirect('users/login'); 
                        }

                    } else {

                        $data['error_msg'] = 'Some problems occured, please try again.'; 
                    
                    } 
                
                } else { 
                    
                    $data['error_msg'] = 'Please fill all the mandatory fields.'; 
                
                } 
            }

            $data['meta'] = ['title' => 'Noc | SignUp Account'];

            // Captcha
            $config = array(
                'img_path'      => 'assets/captcha/',
                'img_url'       => base_url('assets/captcha/'),
                'font_path'     => '../../assets/fonts/OpenSans.ttf', 
                'font_size'     => 100,
                'img_width'     => '160',
                'img_height'    => 40,
                'word_length'   => 4,
                'expiration'    => 7200
            );

            $captcha = create_captcha($config);
            // echo '<pre>'; print_r($captcha); die;
            
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

    /* CHECKING USER SAME VALUE [ONLY UNIQUE FIELD] */
    // private function _checkInUserSameValue($postData) {
        
    //     /* CHECKING FOR EMAIL | MOBILE | USERNAME */

    //     if ( $this->register_mobile_exists() == true ) {

            

    //     } else {

    //         echo 'not unique';
    //     }



    //     $mobile   = $postData['mobile_no'];
    //     $email    = $postData['email_id'];
    //     $username = $postData['username'];

    //     echo "<pre>";

    //     print_r(array($mobile, $email, $username));

    //     die;


    // }

    /**
     *  CHECKING UNIQUE USERNAME BY SYSTEM SIDE
     * 
     * */
    public function username_check($username)
    {   

        if ($this->UserModel->columnDataExits('username', $username) == TRUE ) 
        {
                
            $this->form_validation->set_message('username', 'This Username is already exists. Please Try Another One!');

            return FALSE;

        } else {

            return TRUE;

        }

    }


    //Captcha Refresh
    public function refresh(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'assets/captcha/',
            'img_url'       => base_url().'assets/captcha/',
            'font_path'     => '../../system/fonts/ttfont.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 4,
            'font_size'     => 72
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
    // Email Verification

    function verify(){ 
        // echo '<pre>'; print_r($_GET); die;
        $evc = $_GET['evc'];
        $email = $_GET['email'];
        $noRecords = $this->UserModel->verifyEmailAddress($evc,$email);  
        if ($noRecords){
         $this->session->set_flashdata('success_msg', 'Email Verified Successfully!');
         redirect('users/login'); 
        }else{
         $this->session->set_flashdata('error_msg', 'Sorry Unable to Verify Your Email!');
         redirect('users/login'); 
        }         
    }
}
