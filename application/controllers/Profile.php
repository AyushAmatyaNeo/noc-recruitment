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
        sessionCheck();

        redirect('profile/view'); 
        
    }

    public function view($tabcontent = NULL)
    { 
        sessionCheck('Please login to view your account!');

        /**
         *  $1 IS DYNAMIC ROUTE SEGMENT 
         * 
         * */ 
        $tabcontent = ($tabcontent == '' || $tabcontent == '$1' ) ?  'personal' : $tabcontent;

        $userRegistred = $this->UserModel->userRegistred($this->session->userdata('userId'));


        if ( $userRegistred == true ) {

            $data = array();
            
            if ( $this->isUserLoggedIn ) {


                /**
                 *  AVAILABLE TAB FOR PROFILE
                 *  
                 *  Personal Extra Contact Education Training Professional Council Experience Documents Preview
                 * 
                 * */

                $availableTab = ['personal', 'extra', 'contact', 'education', 'training', 'experience', 'documents', 'preview'];

                if ( in_array($tabcontent, $availableTab) ) {

                    $con = array( 
                        'id' => $this->session->userdata('userId')
                    ); 
                
                    $data['user']         = $this->UserModel->userDetails($con);
                    $data['proviences']   = $this->VacancyModel->fetch_provience();
                    $data['blood_groups'] = $this->VacancyModel->fetch_bloodGroup();
                    $data['districts']    = $this->VacancyModel->districts();
                    $data['documents']    = $this->UserModel->userdocuments($con);


                    // echo "<pre>";

                    // print_r($data['user']);

                    // die;

                    $data['documents']  = $this->UserModel->userdocuments($con);
                    $data['tabcontent'] = $tabcontent;
                    $data['meta'] = array(
                        'title' => 'Noc | Profile View',
                    );

                    $this->load->view('templates/header', $data); 
                    $this->load->view('profile/view', $data); 
                    $this->load->view('templates/footer');

                } else {

                    redirect('profile/view/personal');

                }
            
            } else {

                redirect('users/login'); 
            }
        
        } else {

            $this->session->set_flashdata('msg', 'Please register to view and edit your account!');
                redirect('users/registration');
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
            $data['blood_groups'] = $this->VacancyModel->fetch_bloodGroup();
            $data['districts'] = $this->VacancyModel->districts();
            $data['documents'] = $this->UserModel->userdocuments($con);
            // echo '<pre>'; print_r($data['documents']); die;
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
            // echo "<pre>"; print_r($_FILES); die;
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
                'marital_status'            => strip_tags($this->input->post('marital')),
                'employment_status'         => strip_tags($this->input->post('employment')),
                'employment_input'          => strip_tags($this->input->post('employment_input')),
                'disability'                => strip_tags($this->input->post('disability')),
                'disability_input'          => ($this->input->post('disability') == 'Yes') ? $this->input->post('disability_input') : '',
                'blood_group'               => strip_tags($this->input->post('blood_group')),
                'in_service'                => strip_tags($this->input->post('in_service')),
                'dob_ad'                    => date('Y-m-d', strtotime($this->input->post('dob_ad'))),
                'ctz_issue_date_ad'         => date('Y-m-d', strtotime($this->input->post('ctz_issue_date_ad'))),
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
                'per_house_no'              => strip_tags($this->input->post('per_house_no')),
                'mail_house_no'             => strip_tags($this->input->post('mail_house_no'))
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
            // echo "<pre>"; print_r($_FILES); die;

            // echo $this->input->post('previous_in_service');

            // echo $userData['registration']['in_service'];

            /* IN SERVICE SELECT NO HAVE REMOVE FILE*/

            if (($userData['registration']['in_service'] == 'N') AND ($this->input->post('previous_in_service') !== '')) {


                $oldfile  = $this->UserModel->FindAndDelImgName($this->session->userdata('userId') , $this->input->post('previous_in_service'));

                if ($oldfile['status'] == 1) {

                    unlink ("./uploads/noc_documents/users/registration/".$oldfile['oldimg']['DOC_FOLDER'].'/'.$oldfile['oldimg']['DOC_NEW_NAME'].'.'.$oldfile['oldimg']['DOC_TYPE']);
                }


            }

            /* DISABILITY SELECT NO HAVE REMOVE FILE*/

            if (($userData['registration']['disability'] == 'No') AND ($this->input->post('previous_disability') !== '')) {


                $oldfile  = $this->UserModel->FindAndDelImgName($this->session->userdata('userId') , $this->input->post('previous_disability'));

                if ($oldfile['status'] == 1) {

                    unlink ("./uploads/noc_documents/users/registration/".$oldfile['oldimg']['DOC_FOLDER'].'/'.$oldfile['oldimg']['DOC_NEW_NAME'].'.'.$oldfile['oldimg']['DOC_TYPE']);
                }


            }

            // print_r($_FILES['inservice_file']);
            // die;


            /* IN SERVICE SELECT NO HAVE REMOVE FILE*/

            $update = $this->UserModel->updateprofile($userData,$uid);
            // $update = true;
            if ($update == true) {

                $_FILES['ethnicity_file']['folders'] = 'ethnicity';
                $_FILES['disability_file']['folders'] = 'disability';
                $_FILES['inservice_file']['folders'] = 'in_service';
                $_FILES['ethnicity_file']['input_names'] = 'ethnicity_file';
                $_FILES['disability_file']['input_names'] = 'disability_file';
                $_FILES['inservice_file']['input_names'] = 'inservice_file';

                foreach($_FILES as $file) {

                    if(!empty($file['name'])) {
                        // echo'<pre>'; print_r($file) ; die;
                        $this->file_update($file);
                    }
                }

                // die;
                $this->session->set_flashdata('success_msg', 'Your Account has been updated!');
                redirect('profile/view');
            }else{ 
                $this->session->set_flashdata('error_msg', 'Some Error occured, please try again later!');
            }
        }
    }

     public function editNew()
    {

        $data = array();

        /**
         *  UPDATING BASIC PERSONAL INFORMATION
         * */
        if($this->input->post('basic'))
        {

            $data = [

                'dob' => $this->input->post('dob'),
                'dob_ad' => $this->input->post('dob_ad'),
                'marital' => $this->input->post('marital'),
                'fatherName' => $this->input->post('fatherName'),
                'father_qualification' => $this->input->post('father_qualification'),
                'fm_occupation' => $this->input->post('fm_occupation'),
                'motherName' => $this->input->post('motherName'),
                'mother_qualification' => $this->input->post('mother_qualification'),
                'grandfatherName' => $this->input->post('grandfatherName'),
                'grandfather_nationality' => $this->input->post('grandfather_nationality'),
                'spouseName' => $this->input->post('spouseName'),
                'spouse_nationality' => $this->input->post('spouse_nationality'),
                'citizenship_no' => $this->input->post('citizenship_no'),
                'ctz_issue_district_id' => $this->input->post('ctz_issue_district_id'),
                'ctz_issue_date' => $this->input->post('ctz_issue_date'),
                'ctz_issue_date_ad' => $this->input->post('ctz_issue_date_ad'),

            ];
            echo "<pre>";

            print_r($_POST);

            die;

        }

        if($this->isUserLoggedIn)
        {
            $con = array( 
                'id' => $this->session->userdata('userId') 
            ); 
            $data['user'] = $this->UserModel->userDetails($con);
            $data['proviences'] = $this->VacancyModel->fetch_provience();
            $data['blood_groups'] = $this->VacancyModel->fetch_bloodGroup();
            $data['districts'] = $this->VacancyModel->districts();
            $data['documents'] = $this->UserModel->userdocuments($con);
            // echo '<pre>'; print_r($data['blood_groups']); die;
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
                'marital_status'            => strip_tags($this->input->post('marital')),
                'employment_status'         => strip_tags($this->input->post('employment')),
                'employment_input'          => strip_tags($this->input->post('employment_input')),
                'disability'                => strip_tags($this->input->post('disability')),
                'disability_input'          => strip_tags($this->input->post('disability_input')),
                'blood_group'               => strip_tags($this->input->post('blood_group')),
                'in_service'               => strip_tags($this->input->post('in_service')),
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
                'per_house_no' => strip_tags($this->input->post('per_house_no')),
                'mail_house_no' => strip_tags($this->input->post('mail_house_no'))
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
            // echo "<pre>"; print_r($_FILES); die;

            $update = $this->UserModel->updateprofile($userData,$uid);
            // $update = true;
            if($update == true){
                $_FILES['ethnicity_file']['folders'] = 'ethnicity';
                $_FILES['disability_file']['folders'] = 'disability';
                $_FILES['inservice_file']['folders'] = 'in_service';
                $_FILES['ethnicity_file']['input_names'] = 'ethnicity_file';
                $_FILES['disability_file']['input_names'] = 'disability_file';
                $_FILES['inservice_file']['input_names'] = 'inservice_file';
                foreach($_FILES as $file){                    
                    if(!empty($file['name'])) {
                        // echo'<pre>'; print_r($file) ;
                        $this->file_update($file);
                    }
                }
                // die;
                $this->session->set_flashdata('success_msg', 'Your Account has been updated!');
                redirect('profile/view');
            }else{ 
                $this->session->set_flashdata('error_msg', 'Some Error occured, please try again later!');
            }
        }
    }


    public function file_upload($input_id,$folder_name)
    {
        // echo'<pre>'; print_r($input_id) ; die; 
        $config = [
            'upload_path' => './uploads/noc_documents/users/registration/'.$folder_name.'/',
            'allowed_types' => 'jpg|png|jpeg|pdf',
            'encrypt_name' => TRUE,
            'max_size'   => 1024,
            'file_ext_tolower' => TRUE,
        ];
        $this->load->library('upload',$config, $folder_name);
        $this->$folder_name->initialize($config);
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
            $insert_img = $this->UserModel->insertimg($image);
            if($insert_img == true)
            {
                return true;
            }
        }
        else{
            echo $this->$folder_name->display_errors('<p>', '</p>');
            return false;
        }
    }
    public function file_update($file)
    {
        // echo'<pre>'; print_r($file) ; die; 
        $folder_name = $file['folders'];
        $input_name = $file['input_names'];

        $uid      = $this->session->userdata('userId');

        // echo $uid; die;

        $oldfile  = $this->UserModel->FindAndDelImg($uid,$folder_name);
        $Oldimage = $oldfile['oldimg']['DOC_NEW_NAME'].'.'.$oldfile['oldimg']['DOC_TYPE'];
        // echo'<pre>'; print_r($oldfile) ; die;
        if ( $oldfile['status'] == true ) {

            $insert_img = $this->file_upload($input_name,$folder_name);
            if($insert_img == true)
            {
                if(file_exists("./uploads/noc_documents/users/registration/".$folder_name.'/'.$Oldimage))
                {
                    unlink ("./uploads/noc_documents/users/registration/".$folder_name.'/'.$Oldimage);
                }
                return true;
            }            
        }else if($oldfile['status'] == '0'){
            $insert_img = $this->file_upload($input_name,$folder_name);
        }
        else{

            echo $this->$folder_name->display_errors('<p>', '</p>');
            return false;
        }
    }
}