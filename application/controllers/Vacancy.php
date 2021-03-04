<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vacancy extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('UserModel');
        $this->load->model('VacancyModel');
        $this->load->helper(array('form', 'url'));
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');

    }

    public function index()
    {
        if($this->isUserLoggedIn){ 
            redirect('vacancy/vacancylist');
            // $this->load->view('pages/applydocs', array('error' => ' ' ));
        }else{ 
            redirect('users/login'); 
        }
    }

    public function apply()
    {
        if($this->isUserLoggedIn)
        { 
            $con = array( 
                'id' => $this->session->userdata('userId')
            );
            if($this->input->post('applySubmit'))
            {
                // $RegData['post'] = $_POST;
                echo '<pre>'; print_r($_POST); die;
                $vid = $this->input->post('vid');
                $RegId = $this->VacancyModel->getMaxIdReg();
                $ExpId = $this->VacancyModel->getMaxIdExp();
                $TrainingId = $this->VacancyModel->getMaxIdTr();
                $EducationId = $this->VacancyModel->getMaxIdEdu();
                // Personal Information ---
                $RegData['details'] = array(
                    // A. Detail regarding the post 
                    'REG_ID' => $RegId['MAXID']+1,
                    'USER_ID' => $this->session->userdata('userId'),
                    'OPENING_ID' => 1,
                    'AD_NO' => strip_tags($this->input->post('AD_NO')),
                    'POSITION_ID' => strip_tags($this->input->post('POSITION_ID')),
                    'EXAM_CENTER' =>'1', // Foreign Key , need to create
                    'REG_DT' => strip_tags($this->input->post('REG_DT')), 
                    // B. Personal Information
                    'FULL_NAME_EN' => strip_tags($this->input->post('FULL_NAME_EN')), 
                    'FULL_NAME_NP' => strip_tags($this->input->post('FULL_NAME_NP')),
                    'GENDER_ID' => $this->input->post('GENDER_ID'),
                    'AGE' => $this->input->post('AGE'),
                    'DOB_EN' => $this->input->post('DOB_EN'),
                    'DOB_NP' => $this->input->post('DOB_NP'),
                    // C. Group wanted to join
                    'INCLUSIVE_ID' => $this->input->post('INCLUSIVE_ID'),
                    // PERMANENT ADDRESS
                    'PERMANENT_PROVIENCE_ID' => $this->input->post('PERMANENT_PROVIENCE_ID'), 
                    'PERMANENT_DISTRICT_ID' => strip_tags($this->input->post('PERMANENT_DISTRICT_ID')),
                    'PERMANENT_VDC' => $this->input->post('PERMANENT_VDC'), 
                    'PERMANENT_WARD_ID' => $this->input->post('PERMANENT_WARD_ID'), 
                    'PERMANENT_TOLE' => strip_tags($this->input->post('PERMANENT_TOLE')),
                    'PHONE_NO' => $this->input->post('PHONE_NO'), 
                    // MAILLING ADDRESS
                    'MAILLING_PROVIENCE_ID' => $this->input->post('MAILLING_PROVIENCE_ID'), 
                    'MAILLING_DISTRICT_ID' => strip_tags($this->input->post('MAILLING_DISTRICT_ID')),
                    'MAILLING_VDC' => $this->input->post('MAILLING_VDC'), 
                    'MAILLING_WARD_ID' => $this->input->post('MAILLING_WARD_ID'), 
                    'MAILLING_TOLE' => strip_tags($this->input->post('MAILLING_TOLE')),
                    'MOBILE_NO' => $this->input->post('MOBILE_NO'), 
                    'EMAIL_ID' => $this->input->post('EMAIL_ID'),
                    // E. Citizenship Details
                    'CITIZENSHIP_NO' => $this->input->post('CITIZENSHIP_NO'), 
                    'CTZ_ISSUE_DATE' => strip_tags($this->input->post('CTZ_ISSUE_DATE')),
                    'CTZ_ISSUE_DISTRICT_ID' => $this->input->post('CTZ_ISSUE_DISTRICT_ID'),
                    // F. Family Details
                    'FATHER_NAME' => $this->input->post('FATHER_NAME'), 
                    'MOTHER_NAME' => $this->input->post('MOTHER_NAME'),
                    'SPOUSE_NAME' => $this->input->post('SPOUSE_NAME'),
                    
                    // 'CITIZENSHIP_NO' => $this->input->post('CITIZENSHIP_NO'), 
                    // 'CTZ_ISSUE_DATE' => strip_tags($this->input->post('CTZ_ISSUE_DATE'))  
                );
                // G. EDUCATION SECTION ----
                    $data['EDUCATION_INSTITUTE'] = $this->input->post('EDUCATION_INSTITUTE');
                    $data['LEVEL_ID'] = $this->input->post('LEVEL_ID');
                    $data['FACALTY'] = $this->input->post('FACALTY');
                    $data['DIVISION_ID'] = $this->input->post('DIVISION_ID');
                    $data['MAJOR_SUBJECT'] = $this->input->post('MAJOR_SUBJECT');
                    $data['PASSED_YEAR'] = $this->input->post('PASSED_YEAR');
                // echo '<pre>'; print_r($data); die;
                $RegData['Education'] = [];
                for($i=0; $i < count($data['EDUCATION_INSTITUTE']); $i++)
                {
                    $RegData['Education'][$i]['EDU_ID'] = $EducationId['MAXID']+ 1 + $i;
                    $RegData['Education'][$i]['REG_ID'] = $RegId['MAXID']+1;
                    $RegData['Education'][$i]['EDUCATION_INSTITUTE'] = $data['EDUCATION_INSTITUTE'][$i];
                    $RegData['Education'][$i]['LEVEL_ID'] = $data['LEVEL_ID'][$i];
                    $RegData['Education'][$i]['FACALTY'] = $data['FACALTY'][$i];
                    $RegData['Education'][$i]['DIVISION_ID'] = $data['DIVISION_ID'][$i];
                    $RegData['Education'][$i]['PASSED_YEAR'] = $data['PASSED_YEAR'][$i];                    
                    $RegData['Education'][$i]['MAJOR_SUBJECT'] = $data['MAJOR_SUBJECT'][$i];
                    $RegData['Education'][$i]['CREATED_DATE'] = DATE("Y-m-d");[$i];
                    $RegData['Education'][$i]['CREATED_BY'] = $this->session->userdata('userId');;
                    

                     
                    // return $RegData['Experiance'];
                }
                // H. Experience Detail
                    $data['ORGANISATION_NAME'] = $this->input->post('ORGANISATION_NAME');
                    $data['POST_NAME'] = $this->input->post('POST_NAME');
                    $data['SERVICE_NAME'] = $this->input->post('SERVICE_NAME');
                    $data['LEVEL_ID'] = $this->input->post('LEVEL_ID');
                    $data['EMPLOYEE_TYPE_ID'] = $this->input->post('EMPLOYEE_TYPE_ID');
                    $data['FROM_DATE'] = $this->input->post('FROM_DATE');
                    $data['TO_DATE'] = $this->input->post('TO_DATE');
                    $data['CREATED_DATE'] = $this->input->post('CREATED_DATE');

                // echo '<pre>'; print_r($data); die;
                $RegData['Experiance'] = [];
                    for($i=0; $i < count($data['ORGANISATION_NAME']); $i++)
                    {
                        $RegData['Experiance'][$i]['EXP_ID'] = $ExpId['MAXID']+ 1 + $i;
                        $RegData['Experiance'][$i]['REG_ID'] = $RegId['MAXID']+1;
                        $RegData['Experiance'][$i]['ORGANISATION_NAME'] = $data['ORGANISATION_NAME'][$i];
                        $RegData['Experiance'][$i]['POST_NAME'] = $data['POST_NAME'][$i];
                        $RegData['Experiance'][$i]['SERVICE_NAME'] = $data['SERVICE_NAME'][$i];
                        $RegData['Experiance'][$i]['LEVEL_ID'] = $data['LEVEL_ID'][$i];
                        $RegData['Experiance'][$i]['EMPLOYEE_TYPE_ID'] = $data['EMPLOYEE_TYPE_ID'][$i];
                        $RegData['Experiance'][$i]['FROM_DATE'] = $data['FROM_DATE'][$i];
                        $RegData['Experiance'][$i]['TO_DATE'] = $data['TO_DATE'][$i];
                        $RegData['Experiance'][$i]['CREATED_DATE'] = DATE("Y-m-d");[$i];
                        $RegData['Experiance'][$i]['CREATED_BY'] = $this->session->userdata('userId');
                        
                    }  
                // I. Training Detail
                    $data['TRAINING_NAME'] = $this->input->post('TRAINING_NAME');
                    $data['CERTIFICATE_NAME'] = $this->input->post('CERTIFICATE_NAME');
                    $data['TR_FROM_DATE'] = $this->input->post('TR_FROM_DATE');
                    $data['TR_TO_DATE'] = $this->input->post('TR_TO_DATE');
                    $data['PERIOD'] = $this->input->post('PERIOD');
                    $data['DESCRIPTION'] = $this->input->post('DESCRIPTION');

                // echo '<pre>'; print_r($data); die;
                $RegData['Traning'] = [];
                    for($i=0; $i < count($data['TRAINING_NAME']); $i++)
                    {
                        $RegData['Traning'][$i]['TRANING_ID'] = $TrainingId['MAXID']+ 1 + $i;
                        $RegData['Traning'][$i]['USER_ID'] = $this->session->userdata('userId');
                        $RegData['Traning'][$i]['REG_ID'] = $this->session->userdata('userId');
                        $RegData['Traning'][$i]['TRAINING_NAME'] = $data['TRAINING_NAME'][$i];
                        $RegData['Traning'][$i]['CERTIFICATE_NAME'] = $data['CERTIFICATE_NAME'][$i];
                        $RegData['Traning'][$i]['TR_FROM_DATE'] = $data['TR_FROM_DATE'][$i];
                        $RegData['Traning'][$i]['TR_TO_DATE'] = $data['TR_TO_DATE'][$i];
                        $RegData['Traning'][$i]['PERIOD'] = $data['PERIOD'][$i];
                        $RegData['Traning'][$i]['DESCRIPTION'] = $data['DESCRIPTION'][$i];
                        $RegData['Traning'][$i]['REMARK'] = '';
                        $RegData['Traning'][$i]['FUNDING'] = 0;
                        $RegData['Traning'][$i]['COMPANY_ID'] = 0;
                        $RegData['Traning'][$i]['BRANCH_ID'] = 0;
                        $RegData['Traning'][$i]['CREATED_DATE'] = DATE("Y-m-d");[$i];
                        $RegData['Traning'][$i]['CREATED_BY'] = $this->session->userdata('userId');
                        $RegData['Traning'][$i]['MODIFIED_BY'] = 0;
                        $RegData['Traning'][$i]['MODIFIED_DT'] = '1111-11-11';
                        $RegData['Traning'][$i]['APPROVED_BY'] = '0';
                        $RegData['Traning'][$i]['APPROVED_DT'] = '1111-11-11';
                        $RegData['Traning'][$i]['STATUS'] = 'E';
                        $RegData['Traning'][$i]['LOCATION'] = '';
                        $RegData['Traning'][$i]['DELIVERED_BY'] = '';
                        
                    }  
                
                
                    $data['TRAINING_NAME'] = $this->input->post('TRAINING_NAME');
                    $data['CERTIFICATE_NAME'] = $this->input->post('CERTIFICATE_NAME');
                    $data['TR_FROM_DATE'] = $this->input->post('TR_FROM_DATE');
                    $data['TR_TO_DATE'] = $this->input->post('TR_TO_DATE');
                    $data['PERIOD'] = $this->input->post('PERIOD');
                    $data['DESCRIPTION'] = $this->input->post('DESCRIPTION');

                    $RegData['Traning'] = [];
                    for($i=0; $i < count($data['TRAINING_NAME']); $i++)
                    {
                        $RegData['Traning'][$i]['TRANING_ID'] = $TrainingId['MAXID']+ 1 + $i;
                        $RegData['Traning'][$i]['USER_ID'] = $this->session->userdata('userId');
                        $RegData['Traning'][$i]['REG_ID'] = $this->session->userdata('userId');
                        $RegData['Traning'][$i]['TRAINING_NAME'] = $data['TRAINING_NAME'][$i];
                        $RegData['Traning'][$i]['CERTIFICATE_NAME'] = $data['CERTIFICATE_NAME'][$i];
                        $RegData['Traning'][$i]['TR_FROM_DATE'] = $data['TR_FROM_DATE'][$i];
                        $RegData['Traning'][$i]['TR_TO_DATE'] = $data['TR_TO_DATE'][$i];
                        $RegData['Traning'][$i]['PERIOD'] = $data['PERIOD'][$i];
                        $RegData['Traning'][$i]['DESCRIPTION'] = $data['DESCRIPTION'][$i];
                        $RegData['Traning'][$i]['REMARK'] = '';
                        $RegData['Traning'][$i]['FUNDING'] = 0;
                        $RegData['Traning'][$i]['COMPANY_ID'] = 0;
                        $RegData['Traning'][$i]['BRANCH_ID'] = 0;
                        $RegData['Traning'][$i]['CREATED_DATE'] = DATE("Y-m-d");[$i];
                        $RegData['Traning'][$i]['CREATED_BY'] = $this->session->userdata('userId');
                        $RegData['Traning'][$i]['MODIFIED_BY'] = 0;
                        $RegData['Traning'][$i]['MODIFIED_DT'] = '1111-11-11';
                        $RegData['Traning'][$i]['APPROVED_BY'] = '0';
                        $RegData['Traning'][$i]['APPROVED_DT'] = '1111-11-11';
                        $RegData['Traning'][$i]['STATUS'] = 'E';
                        $RegData['Traning'][$i]['LOCATION'] = '';
                        $RegData['Traning'][$i]['DELIVERED_BY'] = '';
                        
                    }  
                    // echo '<pre>'; print_r($RegData); die;
                
               
                // K. Document and Certificate
                                    
                // $insert = $this->VacancyModel->insertTraining($RegData['Traning']);
               
                // echo '<pre>'; print_r($RegData); die;
                if($this->form_validation->run('add_noc_docs_rules') == true)
                { 
                    // print_r($RegData['Experiance']); die;
                    // echo 'Form validated'; die;
                    // $insert = $this->VacancyModel->insert($RegData);

                     // J. Photograph and signature of Applicant
                    //PhotoGraph 
                    $config = [
                        'upload_path' => './uploads/noc_documents/users/photograph/',
                        'allowed_types' => 'jpg|png',
                        'encrypt_name' => TRUE,
                        'max_size'   => 1024,
                        'file_ext_tolower' => TRUE,
                        'overwrite' => TRUE,

                    ];
                    $this->load->library('upload',$config,'photographupload');
                    $this->photographupload->initialize($config);
                    if($this->photographupload->do_upload('photograph'))
                    {
                        $imageMaxId = $this->VacancyModel->imageMaxId();
                        $uploadData = $this->photographupload->data();
                        $image['REC_DOC_ID'] = $imageMaxId['MAXID'] +1;
                        $image['REG_ID']     = $RegId['MAXID'];
                        $image['USER_ID']    = $this->session->userdata('userId');
                        $image['oldname']    = $uploadData['orig_name'];
                        $image['newname']    = $uploadData['raw_name'];
                        $image['fullpath']   = base_url('uploads/noc_documents/users/photograph/'.$uploadData['raw_name'].$uploadData['file_ext']);
                        $image['type']       = ltrim($uploadData['file_ext'], '.'); 
                        
                        $insert = $this->VacancyModel->insertimg($image); 
                        if($insert == true){
                            // echo '<pre>'; print_r($image); die; 
                        }else
                        {
                            echo 'Insert Error';
                        }
                        // echo'<pre>'; print_r($image) ; die;
                    }
                    //Signature -- 
                    $config = [
                        'upload_path' => './uploads/noc_documents/users/signature/',
                        'allowed_types' => 'jpg|png',
                        'encrypt_name' => TRUE,
                        'max_size'   => 1024,
                        'file_ext_tolower' => TRUE
    
                    ];
                    $this->load->library('upload',$config,'signatureupload');
                    $this->signatureupload->initialize($config);
                    if($this->signatureupload->do_upload('signature'))
                    {
                        $imageMaxId = $this->VacancyModel->imageMaxId();
                        $uploadData = $this->signatureupload->data();
                        $image['REC_DOC_ID'] = $imageMaxId['MAXID'] +1;
                        $image['REG_ID']     = $RegId['MAXID'];
                        $image['USER_ID']    = $this->session->userdata('userId');
                        $image['oldname']    = $uploadData['orig_name'];
                        $image['newname']    = $uploadData['raw_name'];
                        $image['fullpath']   = base_url('uploads/noc_documents/users/signature/'.$uploadData['raw_name'].$uploadData['file_ext']);
                        $image['type']       = ltrim($uploadData['file_ext'], '.'); 
                        
                        $insert = $this->VacancyModel->insertimg($image); 
                        if($insert == true){
                            echo 'Insert pass Sign';
                        }else
                        {
                            echo 'Insert Error Sign';
                        }
                        // echo'<pre>'; print_r($image) ; die;

                    }
                    // Finger Right
                    $config = [
                        'upload_path' => './uploads/noc_documents/users/fingerright/',
                        'allowed_types' => 'jpg|png',
                        'encrypt_name' => TRUE,
                        'max_size'   => 1024,
                        'file_ext_tolower' => TRUE
    
                    ];
                    $this->load->library('upload',$config,'fingerrightupload');
                    $this->fingerrightupload->initialize($config);
                    if($this->fingerrightupload->do_upload('fingerright'))
                    {
                        $imageMaxId = $this->VacancyModel->imageMaxId();
                        $uploadData = $this->fingerrightupload->data();
                        $image['REC_DOC_ID'] = $imageMaxId['MAXID'] +1;
                        $image['REG_ID']     = $RegId['MAXID'];
                        $image['USER_ID']    = $this->session->userdata('userId');
                        $image['oldname']    = $uploadData['orig_name'];
                        $image['newname']    = $uploadData['raw_name'];
                        $image['fullpath']   = base_url('uploads/noc_documents/users/fingerright/'.$uploadData['raw_name'].$uploadData['file_ext']);
                        $image['type']       = ltrim($uploadData['file_ext'], '.'); 
                        
                        $insert = $this->VacancyModel->insertimg($image); 
                        if($insert == true){
                            echo 'Insert pass fingerright';
                        }else
                        {
                            echo 'Insert Error fingerright';
                        }
                        // echo'<pre>'; print_r($image) ; die;

                    }
                    // Finger Left
                    $config = [
                        'upload_path' => './uploads/noc_documents/users/fingerleft/',
                        'allowed_types' => 'jpg|png',
                        'encrypt_name' => TRUE,
                        'max_size'   => 1024,
                        'file_ext_tolower' => TRUE
    
                    ];
                    $this->load->library('upload',$config,'fingerleftupload');
                    $this->fingerleftupload->initialize($config);
                    if($this->fingerleftupload->do_upload('fingerright'))
                    {
                        $imageMaxId = $this->VacancyModel->imageMaxId();
                        $uploadData = $this->fingerleftupload->data();
                        $image['REC_DOC_ID'] = $imageMaxId['MAXID'] +1;
                        $image['REG_ID']     = $RegId['MAXID'];
                        $image['USER_ID']    = $this->session->userdata('userId');
                        $image['oldname']    = $uploadData['orig_name'];
                        $image['newname']    = $uploadData['raw_name'];
                        $image['fullpath']   = base_url('uploads/noc_documents/users/fingerleft/'.$uploadData['raw_name'].$uploadData['file_ext']);
                        $image['type']       = ltrim($uploadData['file_ext'], '.'); 
                        
                        $insert = $this->VacancyModel->insertimg($image); 
                        if($insert == true){
                            echo 'Insert pass fingerleft';
                        }else
                        {
                            echo 'Insert Error fingerleft';
                        }
                        // echo'<pre>'; print_r($image) ; die;

                    }
                    else
                    {
                        // echo 'Uploaded Fail'; die;
                        $upload_error_photo = $this->photographupload->display_errors();
                        $upload_error_sign = $this->signatureupload->display_errors();
                        $upload_error_left = $this->fingerleftupload->display_errors();
                        $upload_error_right = $this->fingerrightupload->display_errors();
                    }
                        $insert = true;
                        if($insert ==true)
                        { 
                            $this->session->set_flashdata('success_msg', 'Your Vacancy Application has been successfully submitted. Best of Luck.'); 
                            redirect('vacancy'); 
                        }else
                        { 
                            $data['upload_error_photo'] = $upload_error_photo;
                            $data['upload_error_sign'] = $upload_error_sign;
                            $data['upload_error_left'] = $upload_error_left;
                            $data['upload_error_right'] = $upload_error_right;
                            $data['error_msg'] = 'Some problems occured, please try again.'; 
                        } 
                }else
                { 
                    // echo 'Form error'; die;
                    $data['post'] =  $_POST;
                    
                    $data['error_msg'] = 'Please fill all the mandatory fields.'; 
                }
        }

               
            $vid =  $this->uri->segment('3');
            $data['vacancylists'] = $this->VacancyModel->fetchVacancyById($vid);
            $data['options'] = $this->VacancyModel->options($vid);
            $data['proviences'] = $this->VacancyModel->fetch_provience();
            $data['districts'] = $this->VacancyModel->districts();
            $data['degrees'] = $this->VacancyModel->degree();
            $data['divisions'] = $this->VacancyModel->division();
            // echo '<pre>';print_r($data['vacancylists']); die;
            $data['user'] = $this->UserModel->getRows($con);
            // echo '<pre>';print_r($data['user']); die;
            $data['meta'] = array(
            'title' => 'NOC | Vacancy Apply',
            'Description' => 'Apply for vacancy'
            );
            $this->load->view('templates/header',$data);
            $this->load->view('pages/apply', $data);
            $this->load->view('templates/footer');
            }
            else
            {
                redirect('users/login'); 
            }
    }
    public function file_upload()
    {
        if($this->isUserLoggedIn)
        { 
            $con = array( 
                'id' => $this->session->userdata('userId')
            );
            // print_r($con); die;
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'File Uploads',
                'Description' => 'View and Apply for vacancy'
            );

            // $this->load->view('templates/header', $data);
            // $this->load->view('pages/applydocs');
            // $this->load->view('templates/footer');
            $config['allowed_type'] = 'jpg|png|pdf';
            $config['upload_path'] = './uploads/noc_documents/';
            $config['encrypt_name'] = true;
            $this->load->library('upload',$config);

            if($this->form_validation->run('add_noc_docs_rules') && $this->unload->do_upload())
            {

            }else
            {
                $upload_error = $this->upload->display_errors();
                $this->load->view('pages/apply', compact('upload_error'));
            }
        }
        // if($this->upload->do_upload('photograph'))
        // {

        // }else{
        //     echo  $this->upload->display_errors();
        // }
        // }else{ 
        //     redirect('users/login'); 
        // }
    }
    public function apply_success()
    {
        if($this->isUserLoggedIn){ 
            $con = array( 
                'id' => $this->session->userdata('userId')
            );
            // print_r($con); die;
        // $data['vacancylists'] = $this->VacancyModel->fetchvacancy();
        // echo '<pre>'; print_r($data['vacancylists']); die;
        $data['user'] = $this->UserModel->getRows($con);
        $data['meta'] = array(
            'title' => 'Vacancy Applied',
            'Description' => 'vacancy Application has been submitted!'
        );
        $this->load->view('templates/header',$data);
        $this->load->view('pages/apply_success', $data);
        $this->load->view('templates/footer');
        }else{ 
            redirect('users/login'); 
        }
    }

    public function vacancylist()
    {
        if($this->isUserLoggedIn){ 
            $con = array( 
                'id' => $this->session->userdata('userId')
            );
            // print_r($con); die;
        $data['vacancylists'] = $this->VacancyModel->fetchvacancy();
        // echo '<pre>'; print_r($data['vacancylists']); die;
        $data['user'] = $this->UserModel->getRows($con);
        $data['meta'] = array(
            'title' => 'Vacancy List',
            'Description' => 'View and Apply for vacancy'
        );
        $this->load->view('templates/header',$data);
        $this->load->view('pages/vacancylist', $data);
        $this->load->view('templates/footer');
        }else{ 
            redirect('users/login'); 
        }
    }
    public function logout()
    { 
        $this->session->unset_userdata('isUserLoggedIn'); 
        $this->session->unset_userdata('userId'); 
        $this->session->sess_destroy(); 
        redirect('users/login/'); 
    }
    public function fetch_district()
    {

        if($this->input->post('province_id'))
        {
            echo $this->VacancyModel->fetch_district($this->input->post('province_id'));
        }
    }

}