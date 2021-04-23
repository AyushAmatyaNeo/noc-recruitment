<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vacancy extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('UserModel');
        $this->load->model('VacancyModel');
        $this->load->helper(array('form', 'url'));
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    }

    public function index()
    {
        if ($this->isUserLoggedIn) {
            redirect('vacancy/vacancylist');
            // $this->load->view('pages/applydocs', array('error' => ' ' ));
        } else {
            redirect('users/login');
        }
    }

    public function apply()
    {
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            if ($this->input->post('applySubmit')) {
                // echo '<pre>'; print_r($_POST); die;
                $vid     = $this->uri->segment('3');
                $appId   = $this->VacancyModel->getMaxIdapp();
                $perId   = $this->VacancyModel->getMaxIdpersonal();
                $fmId    = $this->VacancyModel->getMaxIdfm();
                $eduId   = $this->VacancyModel->getMaxIdEdu();
                $expId   = $this->VacancyModel->getMaxIdExp();
                $trngId  = $this->VacancyModel->getMaxIdTr();
                // A. Detail regarding the application
                $application['details'] = array(                     
                    'APPLICATION_ID'    => $appId['MAXID'] + 1,
                    'USER_ID'           => $this->session->userdata('userId'),
                    'AD_NO'             => $this->input->post('vacancy_id'),
                    'STATUS'            => 'D',
                    'CREATED_DT'        => date('Y-m-d'),
                    'MODIFIED_DT'       => '',
                );
                $application['personal'] = array(
                    'PERSONAL_ID'       => $perId['MAXID'] + 1,
                    'APPLICATION_ID'    => $appId['MAXID'] + 1,
                    'MARITAL_STATUS'    => strip_tags($this->input->post('marital')),                   
                    'EMPLOYMENT_STATUS' => strip_tags($this->input->post('employment')),
                    'EMPLOYMENT_INPUT'  => strip_tags($this->input->post('employment_input')),
                    'DISABILITY'        => strip_tags($this->input->post('disability')),
                    'DISABILITY_INPUT'  => strip_tags($this->input->post('disability_input')),                    
                    'STATUS'            => 'E',
                    'CREATED_DT'        => date('Y-m-d'),
                    'MODIFIED_DT'       => NULL,
                );
                $data['edu_institute']  = $this->input->post('edu_institute');
                $data['level_id']       = $this->input->post('level_id');
                $data['facalty']        = $this->input->post('facalty');
                $data['rank_type']      = $this->input->post('rank_type');
                $data['rank_value']     = $this->input->post('rank_value');
                $data['major_subject']  = $this->input->post('major_subject');
                $data['passed_year']    = $this->input->post('passed_year');

                $application['education'] = [];
                for ($i = 0; $i < count($data['edu_institute']); $i++) {
                    $application['education'][$i]['EDUCATION_ID']          = $eduId['MAXID'] + 1 + $i;
                    $application['education'][$i]['APPLICATION_ID']        = $appId['MAXID'] + 1;
                    $application['education'][$i]['USER_ID']               = $this->session->userdata('userId');
                    $application['education'][$i]['AD_NO']                 = $this->input->post('vacancy_id');
                    $application['education'][$i]['EDUCATION_INSTITUTE']   = $data['edu_institute'][$i];
                    $application['education'][$i]['LEVEL_ID']              = $data['level_id'][$i];
                    $application['education'][$i]['FACALTY']               = $data['facalty'][$i];
                    $application['education'][$i]['RANK_TYPE']             = $data['rank_type'][$i];
                    $application['education'][$i]['RANK_VALUE']            = $data['rank_value'][$i];
                    $application['education'][$i]['MAJOR_SUBJECT']         = $data['major_subject'][$i];
                    $application['education'][$i]['PASSED_YEAR']           = $data['passed_year'][$i];
                    $application['education'][$i]['STATUS']                = 'E';
                    $application['education'][$i]['CREATED_DT']            = date('Y-m-d');
                };
                $application['experience'] = [];
                    $data['org_name'] = $this->input->post('org_name');
                    $data['post_name'] = $this->input->post('post_name');
                    $data['service_name'] = $this->input->post('service_name');
                    $data['org_level'] = $this->input->post('org_level');
                    $data['employee_type'] = $this->input->post('employee_type');
                    $data['from_date'] = $this->input->post('from_date');
                    $data['to_date'] = $this->input->post('to_date');
                for ($i = 0; $i < count($data['org_name']); $i++) {
                    $application['experience'][$i]['EXPERIENCE_ID']        = $expId['MAXID'] + 1 + $i;
                    $application['experience'][$i]['APPLICATION_ID']       = $appId['MAXID'] + 1;
                    $application['experience'][$i]['ORGANISATION_NAME']    = $data['org_name'][$i];
                    $application['experience'][$i]['POST_NAME']            = $data['post_name'][$i];
                    $application['experience'][$i]['SERVICE_NAME']         = $data['service_name'][$i];
                    $application['experience'][$i]['LEVEL_ID']             = $data['org_level'][$i];
                    $application['experience'][$i]['EMPLOYEE_TYPE_ID']     = $data['employee_type'][$i];
                    $application['experience'][$i]['FROM_DATE']            = $data['from_date'][$i];
                    $application['experience'][$i]['TO_DATE']              = $data['to_date'][$i];
                    $application['experience'][$i]['STATUS']                = 'E';
                    $application['experience'][$i]['CREATED_DT']            = date('Y-m-d');
                }

                    $application['training'] = [];
                    $data['training_name'] = $this->input->post('training_name');
                    $data['certificate'] = $this->input->post('certificate');
                    $data['tr_from_date'] = $this->input->post('tr_from_date');
                    $data['tr_to_date'] = $this->input->post('tr_to_date');
                    $data['employee_type'] = $this->input->post('employee_type');
                    $data['description'] = $this->input->post('description');
                for ($i = 0; $i < count($data['training_name']); $i++) {
                    $application['training'][$i]['TRAINING_ID']             = $trngId['MAXID'] + 1 + $i;
                    $application['training'][$i]['USER_ID']                 = $this->session->userdata('userId');
                    $application['training'][$i]['APPLICATION_ID']          = $appId['MAXID'] + 1;
                    $application['training'][$i]['TRAINING_NAME']           = $data['training_name'][$i];
                    $application['training'][$i]['CERTIFICATE']             = $data['certificate'][$i];
                    $application['training'][$i]['FROM_DATE']               = $data['tr_from_date'][$i];
                    $application['training'][$i]['TO_DATE']                 = $data['tr_to_date'][$i];
                    $application['training'][$i]['TOTAL_DAYS']              = ((strtotime($data['tr_to_date'][$i]) - strtotime($data['tr_from_date'][$i])) / 60 / 60 / 24);
                    $application['training'][$i]['DESCRIPTION']             = $data['description'][$i];
                    $application['training'][$i]['STATUS']                  = 'E';
                    $application['training'][$i]['CREATED_DATE']            = date('Y-m-d');
                }
                // echo '<pre>'; print_r($application); die;
                $config = [
                    'upload_path' => './uploads/noc_documents/users/photograph/',
                    'allowed_types' => 'jpg|png',
                    'encrypt_name' => TRUE,
                    'max_size'   => 1024,
                    'file_ext_tolower' => TRUE,
                    'overwrite' => TRUE,
                ];
                $this->load->library('upload', $config, 'photographupload');
                $this->photographupload->initialize($config);
                if ($this->photographupload->do_upload('recent_photo')) {
                    $imageMaxId                 = $this->VacancyModel->imageMaxId();
                    $uploadData                 = $this->photographupload->data();
                    $image['REC_DOC_ID']        = $imageMaxId['MAXID'] + 1;
                    $image['APPLICATION_ID']    = $appId['MAXID'] +1;
                    $image['USER_ID']           = $this->session->userdata('userId');
                    $image['oldname']           = $uploadData['orig_name'];
                    $image['newname']           = $uploadData['raw_name'];
                    $image['fullpath']          = base_url('uploads/noc_documents/users/photograph/' . $uploadData['raw_name'] . $uploadData['file_ext']);
                    $image['type']              = ltrim($uploadData['file_ext'], '.');
                    // echo '<pre>'; print_r($image); die;
                    $insert_img = $this->VacancyModel->insertimg($image);
                }
                else{
                    $error = array('error' => $this->photographupload->display_errors());
                    // print_r($error); die;
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
                    $image['REG_ID']     = $appId['MAXID'] + 1;
                    $image['USER_ID']    = $this->session->userdata('userId');
                    $image['oldname']    = $uploadData['orig_name'];
                    $image['newname']    = $uploadData['raw_name'];
                    $image['fullpath']   = base_url('uploads/noc_documents/users/signature/'.$uploadData['raw_name'].$uploadData['file_ext']);
                    $image['type']       = ltrim($uploadData['file_ext'], '.'); 
                    
                    $insert_img = $this->VacancyModel->insertimg($image); 
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
                if($this->fingerrightupload->do_upload('right_finger_scan'))
                {
                    $imageMaxId = $this->VacancyModel->imageMaxId();
                    $uploadData = $this->fingerrightupload->data();
                    $image['REC_DOC_ID'] = $imageMaxId['MAXID'] +1;
                    $image['REG_ID']     = $appId['MAXID'] + 1;
                    $image['USER_ID']    = $this->session->userdata('userId');
                    $image['oldname']    = $uploadData['orig_name'];
                    $image['newname']    = $uploadData['raw_name'];
                    $image['fullpath']   = base_url('uploads/noc_documents/users/fingerright/'.$uploadData['raw_name'].$uploadData['file_ext']);
                    $image['type']       = ltrim($uploadData['file_ext'], '.'); 
                    
                    $insert_img = $this->VacancyModel->insertimg($image); 
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
                if($this->fingerleftupload->do_upload('left_finger_scan'))
                {
                    $imageMaxId = $this->VacancyModel->imageMaxId();
                    $uploadData = $this->fingerleftupload->data();
                    $image['REC_DOC_ID'] = $imageMaxId['MAXID'] +1;
                    $image['REG_ID']     = $appId['MAXID'] + 1;
                    $image['USER_ID']    = $this->session->userdata('userId');
                    $image['oldname']    = $uploadData['orig_name'];
                    $image['newname']    = $uploadData['raw_name'];
                    $image['fullpath']   = base_url('uploads/noc_documents/users/fingerleft/'.$uploadData['raw_name'].$uploadData['file_ext']);
                    $image['type']       = ltrim($uploadData['file_ext'], '.'); 
                    
                    $insert_img = $this->VacancyModel->insertimg($image); 
                    
                    // $insert = $this->VacancyModel->insert($RegData);
                    // echo'<pre>'; print_r($image) ; die;

                }
                // echo '<pre>';
                // // print_r($image);
                // die;
                if ($this->form_validation->run('noc_apply_form') == true) {
                    // $insert_info = $this->VacancyModel->insert($application);
                    // $insert_img = $this->VacancyModel->insertimg($image);

                    redirect('vacancy/apply_success');
                } else {
                    echo 'Form error'; //die;
                    // $data['post'] =  $_POST;

                    $data['error_msg'] = 'Please fill all the mandatory fields.';
                }
            }
        $vid =  $this->uri->segment('3');
        $uid = $this->session->userdata('userId');
        $maxRegId = $this->VacancyModel->getMaxIdapplication($vid);
        $RegId = $this->VacancyModel->registerId($uid);
        $data['vacancylists'] = $this->VacancyModel->fetchVacancyById($vid);
        $data['vacancylists'][0]['maxregId'] = $maxRegId['MAXID'];
        $data['options'] = $this->VacancyModel->options($vid);
        $data['proviences'] = $this->VacancyModel->fetch_provience();
        $data['districts'] = $this->VacancyModel->districts();
        $data['degrees'] = $this->VacancyModel->degree();
        $data['divisions'] = $this->VacancyModel->division();
        $data['user_details'] = $this->UserModel->user($uid);
            // $data['user_details'][0]['AGE'] = Date('Y-m-d') - $data['user_details'][0]['DOB'];
            // Get the values for entered data
            // $data
            // echo $maxRegId['MAXID']; die;


            if (isset($RegId['MAXID'])) {
                $data['details'] = $this->VacancyModel->registerdata($vid, $RegId['MAXID']);
            }

            // echo '<pre>';print_r($data['user_details']); die;
            $data['user'] = $this->UserModel->getRows($con);
            // echo '<pre>';print_r($data['user_details'][0]['DOB']); die;
            $data['meta'] = array(
                'title' => 'NOC | Vacancy Apply',
                'Description' => 'Apply for vacancy'
            );
            $this->load->view('templates/header', $data);
            $this->load->view('pages/apply', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('users/login');
        }
    }
    public function file_upload()
    {
        $config = [
            'upload_path' => './uploads/noc_documents/users/fingerright/',
            'allowed_types' => 'jpg|png',
            'encrypt_name' => TRUE,
            'max_size'   => 1024,
            'file_ext_tolower' => TRUE

        ];
        $this->load->library('upload',$config,'fingerrightupload');
        $this->fingerrightupload->initialize($config);
        if($this->fingerrightupload->do_upload('right_finger_scan'))
        {
            $imageMaxId = $this->VacancyModel->imageMaxId();
            $uploadData = $this->fingerrightupload->data();
            $image['REC_DOC_ID'] = $imageMaxId['MAXID'] +1;
            $image['REG_ID']     = $appId['MAXID'] + 1;
            $image['USER_ID']    = $this->session->userdata('userId');
            $image['oldname']    = $uploadData['orig_name'];
            $image['newname']    = $uploadData['raw_name'];
            $image['fullpath']   = base_url('uploads/noc_documents/users/fingerright/'.$uploadData['raw_name'].$uploadData['file_ext']);
            $image['type']       = ltrim($uploadData['file_ext'], '.'); 
            
            $insert_img = $this->VacancyModel->insertimg($image); 
            // echo'<pre>'; print_r($image) ; die;

        }
    }
    public function apply_success()
    {
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            // print_r($con); die;
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'Vacancy Applied',
                'Description' => 'vacancy Application has been submitted!'
            );
            $data['details'] = $this->VacancyModel->successdata();
            // echo '<pre>'; print_r($data['details']); die;
            $this->load->view('templates/header', $data);
            $this->load->view('pages/apply_success', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('users/login');
        }
    }
    public function vacancylist()
    {
        // $this->output->enable_profiler(TRUE);
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $data['vacancylists'] = $this->VacancyModel->fetchvacancy();
            // echo '<pre>'; print_r($data['vacancylists']); die;
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'Vacancy List',
                'Description' => 'View and Apply for vacancy'
            );
            // echo '<pre>'; print_r($data['user']); die;
            $this->load->view('templates/header', $data);
            $this->load->view('pages/vacancylist', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('users/login');
        }
    }
    // Fetch district & vdc list as per options for registration page - Address Fields
    public function fetch_district()
    {

        if ($this->input->post('province_id')) {
            echo $this->VacancyModel->fetch_district($this->input->post('province_id'));
        }
    }
    public function fetch_vdc()
    {

        if ($this->input->post('district_id')) {
            echo $this->VacancyModel->fetch_vdc($this->input->post('district_id'));
        }
    }
}
