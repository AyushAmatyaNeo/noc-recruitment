<?php

use Mpdf\Tag\Em;

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
        $vid = base64_decode($this->uri->segment('3'));
        $userRegistred = $this->UserModel->userRegistred($this->session->userdata('userId'));
        // $userApplied = $this->UserModel->userApplied($this->session->userdata('userId'));
        if($userRegistred == false)
        {
            $this->session->set_flashdata('msg', 'You have not registred yet! Please register to apply.');
            redirect('users/registration');
        }

        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            if ($this->VacancyModel->checkapplied($vid, $this->session->userdata('userId')) == true) 
            {
                $this->session->set_flashdata('msg', 'You have already Applied to this vacancy! Please edit to update.');
                redirect('vacancy/vacancylist');
            }
            if ($this->input->post('applySubmit')) {
                // echo '<pre>'; print_r($_POST); die;
                $vid     = ($this->uri->segment('3'));                
                $appId   = $this->VacancyModel->getMaxIds('APPLICATION_ID','HRIS_REC_VACANCY_APPLICATION');
                $perId   = $this->VacancyModel->getMaxIds('PERSONAL_ID','HRIS_REC_APPLICATION_PERSONAL');
                $eduId   = $this->VacancyModel->getMaxIds('EDUCATION_ID','HRIS_REC_APPLICATION_EDUCATION');
                $expId   = $this->VacancyModel->getMaxIds('EXPERIENCE_ID','HRIS_REC_APPLICATION_EXPERIENCES');
                $trngId  = $this->VacancyModel->getMaxIds('TRAINING_ID','HRIS_REC_APPLICATION_TRAININGS');
                // A. Detail regarding the application
                $application['details'] = array(                     
                    'APPLICATION_ID'    => $appId['MAXID'] + 1,
                    'USER_ID'           => $this->session->userdata('userId'),
                    'AD_NO'             => $this->input->post('vacancy_id'),
                    'REGISTRATION_NO'   => $this->input->post('registration_no'),
                    'STAGE_ID'          => '1',
                    'STATUS'            => 'D',
                    'CREATED_DT'        => date('Y-m-d'),
                    'MODIFIED_DT'       => '',
                );
                $data['inclusion']  = $this->input->post('inclusion');
                $application['inclusion'] = [];
                $incId = $this->VacancyModel->getMaxIds('APPLICATION_INCLUSION_ID','HRIS_REC_APPLICATION_INCLUSION');
                for ($i = 0; $i < count($data['inclusion']); $i++) {
                    $application['inclusion'][$i]['APPLICATION_INCLUSION_ID']   = $incId['MAXID'] + 1 + $i;
                    $application['inclusion'][$i]['APPLICATION_ID']             = $appId['MAXID'] + 1;
                    $application['inclusion'][$i]['USER_ID']                    = $this->session->userdata('userId');
                    $application['inclusion'][$i]['VACANCY_ID']                 = $this->input->post('vacancy_id');
                    $application['inclusion'][$i]['INCLUSION_ID']               = $data['inclusion'][$i];
                    $application['inclusion'][$i]['STATUS']                     = 'E';
                    $application['inclusion'][$i]['CREATED_DT']                 = date('Y-m-d');
                    $application['inclusion'][$i]['MODIFIED_DT']                = NULL;
                    
                } 
                $application['personal'] = array(
                    'PERSONAL_ID'       => $perId['MAXID'] + 1,
                    'APPLICATION_ID'    => $appId['MAXID'] + 1,
                    'USER_ID'           => $this->session->userdata('userId'),
                    'MARITAL_STATUS'    => strip_tags($this->input->post('marital')),                   
                    'EMPLOYMENT_STATUS' => strip_tags($this->input->post('employment')),
                    'EMPLOYMENT_INPUT'  => strip_tags($this->input->post('employment_input')),
                    'DISABILITY'        => strip_tags($this->input->post('disability')),
                    'DISABILITY_INPUT'  => strip_tags($this->input->post('disability_input')),
                    'APPLICATION_AMOUNT' => strip_tags($this->input->post('inclusion_amount')),                
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
                    $application['education'][$i]['MODIFIED_DT']           = NULL;
                    
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
                    $application['experience'][$i]['USER_ID']              = $this->session->userdata('userId');
                    $application['experience'][$i]['ORGANISATION_NAME']    = $data['org_name'][$i];
                    $application['experience'][$i]['POST_NAME']            = $data['post_name'][$i];
                    $application['experience'][$i]['SERVICE_NAME']         = $data['service_name'][$i];
                    $application['experience'][$i]['LEVEL_ID']             = $data['org_level'][$i];
                    $application['experience'][$i]['EMPLOYEE_TYPE_ID']     = $data['employee_type'][$i];
                    $application['experience'][$i]['FROM_DATE']            = $data['from_date'][$i];
                    $application['experience'][$i]['TO_DATE']              = $data['to_date'][$i];
                    $application['experience'][$i]['STATUS']                = 'E';
                    $application['experience'][$i]['CREATED_DT']            = date('Y-m-d');
                    $application['experience'][$i]['MODIFIED_DT']           = NULL;
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
                    $application['training'][$i]['APPLICATION_ID']          = $appId['MAXID'] + 1;
                    $application['training'][$i]['USER_ID']                 = $this->session->userdata('userId');
                    $application['training'][$i]['TRAINING_NAME']           = $data['training_name'][$i];
                    $application['training'][$i]['CERTIFICATE']             = $data['certificate'][$i];
                    $application['training'][$i]['FROM_DATE']               = $data['tr_from_date'][$i];
                    $application['training'][$i]['TO_DATE']                 = $data['tr_to_date'][$i];
                    $application['training'][$i]['TOTAL_DAYS']              = ((strtotime($data['tr_to_date'][$i]) - strtotime($data['tr_from_date'][$i])) / 60 / 60 / 24);
                    $application['training'][$i]['DESCRIPTION']             = $data['description'][$i];
                    $application['training'][$i]['STATUS']                  = 'E';
                    $application['training'][$i]['CREATED_DATE']            = date('Y-m-d');
                    $application['training'][$i]['MODIFIED_DATE']             = NULL;
                }
                // echo '<pre>'; print_r($application['training']); die;
                // Inserting Folder Names
                if ($this->form_validation->run('noc_apply_form') == true) {
                    $insert_info = $this->VacancyModel->insert($application);
                    if ($insert_info)
                    {
                        $_FILES['nagrita_front']['folders'] = 'nagrita_front';
                        $_FILES['nagrita_back']['folders'] = 'nagrita_back';
                        $_FILES['recent_photo']['folders'] = 'photograph';
                        $_FILES['signature']['folders'] = 'signature';
                        $_FILES['right_finger_scan']['folders'] = 'fingerright';
                        $_FILES['left_finger_scan']['folders'] = 'fingerleft';
                        // Inserting Names
                        $_FILES['nagrita_front']['input_names'] = 'nagrita_front';
                        $_FILES['nagrita_back']['input_names'] = 'nagrita_back';
                        $_FILES['recent_photo']['input_names'] = 'recent_photo';
                        $_FILES['signature']['input_names'] = 'signature';
                        $_FILES['right_finger_scan']['input_names'] = 'right_finger_scan';
                        $_FILES['left_finger_scan']['input_names'] = 'left_finger_scan';
                        $files = array_chunk($_FILES,1);
                        if(!empty($files))
                        {
                            for($i=0; $i < count($files); $i++)
                            {
                                $tmpFilePath = $files[$i][0]['tmp_name'];
                                if($tmpFilePath != '')
                                {
                                    $input_name    = $files[$i][0]['input_names'];
                                    $folder_name = $files[$i][0]['folders'];
                                    $upload_fun = $this->file_upload($input_name,$folder_name,$appId);
                                    if($upload_fun == true)
                                    {
                                        echo "File Uploaded! Cheers";
                                    }else
                                    {
                                        echo "File Upload Error! ";
                                    }
                                }
                            }
                        }
                    }
                    redirect('vacancy/apply_success');
                } else {
                    // echo 'Form error'; //die;
                    // $data['post'] =  $_POST;

                    $data['error_msg'] = 'Please fill all the mandatory fields.';
                }
            }
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
            $data['inclusions'] = $this->VacancyModel->fetchInclusion($vid);
            $data['registration_no']  = ($this->VacancyModel->fetchvacancyByAdNo('HRIS_REC_VACANCY_APPLICATION',$vid)) + 1;

            if (isset($RegId['MAXID'])) {
                $data['details'] = $this->VacancyModel->registerdata($vid, $RegId['MAXID']);
            }
            // echo '<pre>';print_r($data); die;
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'NOC | Vacancy Apply',
                'Description' => 'Apply for vacancy'
            );
            $this->load->view('templates/header', $data);
            $this->load->view('pages/apply/apply', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('users/login');
        }
    }
    public function edit()
    {
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            if($this->input->post('applyedit')){
                // echo '<pre>'; print_r($_POST); die;
                $uid = $this->session->userdata('userId');
                $data['personal'] = array(
                    'marital_status'    => strip_tags($this->input->post('marital')),
                    'employment_status' => strip_tags($this->input->post('employment')),
                    'employment_input'  => strip_tags($this->input->post('employment_input')),
                    'disability'        => strip_tags($this->input->post('disability')),
                    'disability_input'  => strip_tags($this->input->post('disability_input')),
                    'application_amount'  => strip_tags($this->input->post('inclusion_amount')),
                );
                // echo '<pre>'; print_r(count($data['inclusion'])); die;
                $incId = $this->VacancyModel->applicationById($this->input->post('vacancy_id'),$uid,'HRIS_REC_APPLICATION_INCLUSION');
                for ($i = 0; $i < count($incId); $i++) {  
                    $data['inclusion'][$i]  = $incId[$i]['APPLICATION_INCLUSION_ID'];
                }
                // $delete = $this->VacancyModel->deleteInclusion($data,$this->session->userdata('userId'));
                $delete = false;
                if($delete == true)
                {
                    $data['application_inclusion_id']  = $this->input->post('application_inclusion_id');
                    $data['inclusion_id']              = $this->input->post('inclusion_id');
                    $data['inclusion_updated']          = [];
                    $incIds = $this->VacancyModel->getMaxIds('APPLICATION_INCLUSION_ID','HRIS_REC_APPLICATION_INCLUSION');
                    for ($i = 0; $i < count($data['inclusion_id']); $i++) {                      
                        $data['inclusion_updated'][$i]['APPLICATION_INCLUSION_ID']   = $incIds['MAXID'] + 1 + $i;
                        $data['inclusion_updated'][$i]['APPLICATION_ID']             = $this->input->post('application_id');
                        $data['inclusion_updated'][$i]['VACANCY_ID']                 = $this->input->post('vacancy_id');
                        $data['inclusion_updated'][$i]['USER_ID']                    = $this->session->userdata('userId');
                        $data['inclusion_updated'][$i]['INCLUSION_ID']               = $data['inclusion_id'][$i];
                        $data['inclusion_updated'][$i]['STATUS']                     = 'E';
                        $data['inclusion_updated'][$i]['CREATED_DT']                 = date('Y-m-d');
                        $data['inclusion_updated'][$i]['MODIFIED_DT']                = NULL;
                    
                    } 
                }
                // echo '<pre>'; print_r($application['inclusion']);die;
                $data['education_id']   = $this->input->post('education_id');
                $data['edu_institute']  = $this->input->post('edu_institute');
                $data['level_id']       = $this->input->post('level_id');
                $data['facalty']        = $this->input->post('facalty');
                $data['rank_type']      = $this->input->post('rank_type');
                $data['rank_value']     = $this->input->post('rank_value');
                $data['major_subject']  = $this->input->post('major_subject');
                $data['passed_year']    = $this->input->post('passed_year');
                $eduId   = $this->VacancyModel->getMaxIds('EDUCATION_ID','HRIS_REC_APPLICATION_EDUCATION');
                $data['educations'] = [];
                for($i=0; $i < count($data['edu_institute']); $i++)
                    {
                        $data['educations'][$i]['education_id']        = (!empty($data['education_id'][$i])) ? ($data['education_id'][$i]) : ($eduId['MAXID'] + 1);
                        if(empty($data['education_id'][$i]))
                        {
                            $data['educations'][$i]['application_id']        = $this->input->post('application_id');
                            $data['educations'][$i]['user_id']               = $this->session->userdata('userId');
                            $data['educations'][$i]['ad_no']                 = $this->input->post('vacancy_id');
                        }
                        $data['educations'][$i]['education_institute'] = $data['edu_institute'][$i];
                        $data['educations'][$i]['level_id']            = $data['level_id'][$i];
                        $data['educations'][$i]['facalty']             = $data['facalty'][$i];
                        $data['educations'][$i]['rank_type']           = $data['rank_type'][$i];
                        $data['educations'][$i]['rank_value']          = $data['rank_value'][$i];
                        $data['educations'][$i]['major_subject']       = $data['major_subject'][$i];
                        $data['educations'][$i]['passed_year']         = $data['passed_year'][$i];
                    }
                // Experience
                $data['experience_id']  = $this->input->post('experience_id');
                $data['org_name']       = $this->input->post('org_name');
                $data['post_name']      = $this->input->post('post_name');
                $data['service_name']   = $this->input->post('service_name');
                $data['org_level']      = $this->input->post('org_level');
                $data['employee_type']  = $this->input->post('employee_type');
                $data['from_date']      = $this->input->post('from_date');
                $data['to_date']        = $this->input->post('to_date');
                $data['experiences'] = [];
                for($i=0; $i < count($data['org_name']); $i++)
                    {
                        $data['experiences'][$i]['experience_id']    = $data['experience_id'][$i];
                        $data['experiences'][$i]['organisation_name'] = $data['org_name'][$i];
                        $data['experiences'][$i]['post_name']        = $data['post_name'][$i];
                        $data['experiences'][$i]['service_name']     = $data['service_name'][$i];
                        $data['experiences'][$i]['level_id']         = $data['org_level'][$i];
                        $data['experiences'][$i]['employee_type_id'] = $data['employee_type'][$i];
                        $data['experiences'][$i]['from_date']        = $data['from_date'][$i];
                        $data['experiences'][$i]['to_date']          = $data['to_date'][$i];
                    }
                // Training
                $data['training_id']    = $this->input->post('training_id');
                $data['training_name']  = $this->input->post('training_name');
                $data['certificate']    = $this->input->post('certificate');
                $data['tr_from_date']   = $this->input->post('tr_from_date');
                $data['tr_to_date']     = $this->input->post('tr_to_date');
                $data['period']         = $this->input->post('period');
                $data['description']    = $this->input->post('description');
                $data['trainings'] = [];
                for($i=0; $i < count($data['training_name']); $i++)
                    {
                        $data['trainings'][$i]['training_id']   = $data['training_id'][$i];
                        $data['trainings'][$i]['training_name'] = $data['training_name'][$i];
                        $data['trainings'][$i]['certificate']   = $data['certificate'][$i];
                        $data['trainings'][$i]['from_date']     = $data['tr_from_date'][$i];
                        $data['trainings'][$i]['to_date']       = $data['tr_to_date'][$i];
                        $data['trainings'][$i]['total_days']    = $data['period'][$i];
                        $data['trainings'][$i]['description']   = $data['description'][$i];
                    }
                // echo '<pre>'; print_r($data['educations']); die;
                $appId = $this->input->post('application_id');
                // $update = $this->VacancyModel->updateapplication($data,$uid,$appId);
                $update = true;
                if($update == true){
                    $files = $_FILES;
                    if($files)
                    {
                        foreach($files as $file)
                        {
                            if($file['error'] == 0 && $file['name'] != ''){
                                echo '<pre>'; print_r($file);
                            }
                        }  die;
                    }
                    $this->session->set_flashdata('msg', 'Your Application has been updated!');
                    redirect('vacancy/vacancylist'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                }
            }
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'NOC | Vacancy Edit',
                'Description' => 'Vacancy Edit'
            );
            $vid      =  base64_decode($this->uri->segment('3'));
            $uid      = $this->session->userdata('userId');
            $maxRegId = $this->VacancyModel->getMaxIdapplication($vid);
            $data['vacancylists']   = $this->VacancyModel->fetchVacancyById($vid);
            $data['vacancylists'][0]['maxregId'] = $maxRegId['MAXID'];
            $data['options']        = $this->VacancyModel->options($vid);
            $data['proviences']     = $this->VacancyModel->fetch_provience();
            $data['districts']      = $this->VacancyModel->districts();
            $data['degrees']        = $this->VacancyModel->degree();
            $data['divisions']      = $this->VacancyModel->division();
            $data['user_details']   = $this->UserModel->user($uid);
            $data['applications']   = $this->VacancyModel->applicationById($vid,$uid,'HRIS_REC_APPLICATION_PERSONAL');
            $data['educations']     = $this->VacancyModel->applicationById($vid,$uid,'HRIS_REC_APPLICATION_EDUCATION');
            $data['experiences']    = $this->VacancyModel->applicationById($vid,$uid,'HRIS_REC_APPLICATION_EXPERIENCES');
            $data['trainings']      = $this->VacancyModel->applicationById($vid,$uid,'HRIS_REC_APPLICATION_TRAININGS');
            $data['documents']      = $this->VacancyModel->applicationByOrderId($vid,$uid,'HRIS_REC_APPLICATION_DOCUMENTS','REC_DOC_ID');
            $data['inclusions']     = $this->VacancyModel->fetchInclusion($vid);
            $data['inclusionValue'] = $this->VacancyModel->fetchApplicationInclusion($data['applications'][0]['APPLICATION_ID']);
            // $data['inclusionValue'] = $this->VacancyModel->applicationById($vid,$uid,'HRIS_REC_APPLICATION_INCLUSION');
            // echo '<pre>'; print_r($data['inclusions']); die;
            $this->load->view('templates/header', $data);
            $this->load->view('pages/apply/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('users/login');
        }
    }
    public function file_upload($input_id,$folder_name,$appId)
    {
        $config = [
            'upload_path' => './uploads/noc_documents/users/'.$folder_name.'/',
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
            $image['APPLICATION_ID'] = $appId['MAXID'] +1;
            $image['USER_ID']        = $this->session->userdata('userId');
            $image['oldname']        = $uploadData['orig_name'];
            $image['newname']        = $uploadData['raw_name'];
            $image['fullpath']       = base_url('uploads/noc_documents/users/'.$folder_name.'/'.$uploadData['raw_name'].$uploadData['file_ext']);
            $image['type']           = ltrim($uploadData['file_ext'], '.'); 
            
            $insert_img = $this->VacancyModel->insertimg($image);
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
    public function file_update()
    {
        
    }
    public function apply_success()
    {
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'Vacancy Applied',
                'Description' => 'vacancy Application has been submitted!'
            );
            $data['details'] = $this->VacancyModel->successdata();
            // echo '<pre>'; print_r($data['details']); die;
            $this->load->view('templates/header', $data);
            $this->load->view('pages/apply/apply_success', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('users/login');
        }
    }
    //Vacancy List page
    public function vacancylist()
    {        
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $data['vacancylists'] = $this->VacancyModel->fetchvacancy();
            if($data['vacancylists'] != '')
            {            
                for($i=0; $i < count($data['vacancylists']); $i++)
                {
                    $data['INCLUSION'][$i] = $this->VacancyModel->fetchinclusion($data['vacancylists'][$i]['VACANCY_ID']);

                    $data['vacancylists'][$i]['OPTION_EDESC'] = implode(',', array_map(function ($el) {return $el['OPTION_EDESC']; }, $data['INCLUSION'][$i]));
                }
            }
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'Vacancy List',
                'Description' => 'View and Apply for vacancy'
            );
            $data['applications'] = $this->VacancyModel->applicationDetails($con);
            // echo '<pre>'; print_r($data['applications']); die;
            
            $this->load->view('templates/header', $data);
            $this->load->view('pages/vacancylist', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('users/login');
        }
    }
    public function vacancyDetail()
    {
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $vid = base64_decode($this->uri->segment('3'));
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'NOC | Vacancy Detail',
                'Description' => 'View and Apply for vacancy'
            );
            $data['details'] = $this->VacancyModel->vacancydetail($vid);
            // echo '<pre>'; print_r($data['details']); die;
            
            $this->load->view('templates/header', $data);
            $this->load->view('pages/vacancydetail', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('users/login');
        }
        // echo 'vacancy Details'; die;
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
    // Applied Details for vacancy
    public function appliedDetails()
    {
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );

            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'NOC | Vacancy Apply',
                'Description' => 'Apply for vacancy'
            );
            $this->load->view('templates/header', $data);
            $this->load->view('pages/apply', $data);
            $this->load->view('templates/footer');
        }else
        {
            redirect('users/login');
        }
    }
    public function admitCard()
    {
        $appid  = base64_decode($this->uri->segment('3')); 
        $uid = $this->session->userdata('userId');
        $data['vacancy'] = $this->VacancyModel->admitCard($uid,$appid);
        // echo '<pre>'; print_r($data['vacancy']); die;
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);

        $mpdf->WriteHTML('      
        <!DOCTYPE html>
        <html lang="en">        
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>NOC | Admit Card</title>
                <link rel="icon" href="http://noc.org.np/assets/noc-f4bc4277383043f1536e899f46af9498.png" type="image/gif" sizes="32x32">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            
                <style>
                    .card {
                    position: relative;
                    display: -ms-flexbox;
                    display: flex;
                    -ms-flex-direction: column;
                    flex-direction: column;
                    min-width: 0;
                    word-wrap: break-word;
                    background-color: #fff;
                    background-clip: border-box;
                    border: 1px solid rgba(0,0,0,.125);
                    border-radius: .25rem;
                    }
                    .card-body{
                        -ms-flex: 1 1 auto;
                        flex: 1 1 auto;
                        min-height: 1px;
                        padding: 1.25rem;
                    }
                    h6{
                        font-size: 14px;
                    }
                    .table-info th{
                        padding-bottom: 10px;
                    }
                    .table-info td{
                        padding-bottom: 10px;
                    }
                </style>
            </head>
            <body>            
                <div style="width:750px; font-size: 14px; margin: 0 auto;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 offset-md-2 card">
                                <div class="card-body">
                                    <h6 style="text-align: center; margin-block-end: -25px;">Nepal Oil Corporation Limited</h6>
                                    <h6 style="text-align: center; line-height: 22px; margin-block-end: 0px;">Open Competitive Examination<br>Admit card</h6>
                                    <div class="admit-card-inner">
                                        <table class="table table-responsive">
                                            <tr>
                                                <td style="border-top:0;">Examination type (Written/Practial/Interview)</td>
                                                <td style="border-top:0; width: 40%;">..............................................</td>
                                                <td>
                                                    <div class="card" style="max-width:150px; padding: 10px 0; text-align: center;">
                                                        <img src="'. $data['vacancy'][2]['DOC_PATH'] .'" style="width:150px;" >
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table-info">
                                            <tr>
                                                <th style="border-top:0; font-size: 13px; text-align: left;">Advertisement No.</th>
                                                <td style="border-top:0;">'. $data['vacancy'][2]['AD_NO'] .'</td>
                                            </tr>
                                            <tr>
                                                <th style="border-top:0; font-size: 13px; text-align: left;">Advertisement placed year</th>
                                                <td style="border-top:0;">2021</td>
                                            </tr>
                                            <tr>
                                                <th style="border-top:0; font-size: 13px; text-align: left;">Examination center</th>
                                                <td style="border-top:0;">Jawalakhel, Lalitpur</td>
                                            </tr>
                                            <tr>
                                                <td style="border-top:0; padding-top: 15px;" colspan="2">1. To be filled by Examinee :</td>
                                            </tr>
                                            <tr>
                                                <th style="border-top:0; font-size: 13px; text-align: left;">a. Full Name</th>
                                                <td style="border-top:0;">'. $data['vacancy'][2]['FIRST_NAME'].' '.$data['vacancy'][2]['MIDDLE_NAME'].' '.$data['vacancy'][2]['LAST_NAME']  .' </td>
                                            </tr>
                                            <tr>
                                                <th style="border-top:0; font-size: 13px; text-align: left;">b. Post</th>
                                                <td style="border-top:0;">'.  $data['vacancy'][2]['DESIGNATION_TITLE'] .'</td>
                                                <th style="border-top:0; font-size: 13px; text-align: left;">Level :</td>
                                                <td style="border-top:0;">' .$data['vacancy'][2]['FUNCTIONAL_LEVEL_EDESC'].'</th>         
                                            </tr>
                                            <tr>
                                                <th style="border-top:0; font-size: 13px; text-align: left;">c. Service/Group</th>
                                                <td style="border-top:0;">'.$data['vacancy'][2]['SERVICE_TYPE_NAME'].' / '.$data['vacancy'][2]['SERVICE_EVENT_NAME'].'</td>       
                                            </tr>
                                            <tr>
                                                <th style="border-top:0; font-size: 13px; text-align: left;">d. Signature Sample of Examinee</th>
                                                <td style="border-top:0;"><img src="'. $data['vacancy'][3]['DOC_PATH'] .'" style="width:200px;" ></td>       
                                            </tr>
                                        </table>
                                        <table class="table-info">
                                            <tr>
                                                <td style="border-top:0;" colspan="4">2. To be filled by related authority :</td>
                                            </tr>
                                            <tr>
                                                <td style="border-top:0;" colspan="4">You are allowed to enter the examination for the above mentioned post to be taken on/from date .......................................... conducted by this office from the following center.</td>
                                            </tr>
                                            <tr>
                                                <th style="border-top:0; font-size: 13px; text-align: left;">Center</th>
                                                <td style="border-top:0;">Jawalakhel, Lalitpur</td>
                                                <th style="border-top:0; width: 100px; font-size: 13px; text-align: left;">Roll. No.</td>
                                                <td style="border-top:0;">.................................</th>  
                                            </tr>
                                            <tr>
                                                <th style="border-top:0; font-size: 13px; text-align: left; padding-top: 20px;">Signature</th>
                                                <td style="border-top:0; padding-top: 20px;">.................................</td>
                                                <th style="border-top:0; width: 100px; font-size: 13px; text-align: left; padding-top: 20px;">Grade</th>
                                                <td style="border-top:0; padding-top: 20px;">.................................</td>  
                                            </tr>
                                        </table>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
        </html>
        ');
        $mpdf->Output();
    }
    public function inclusionamount()
    {
        $position = $this->input->post('position_id');
        $level    = $this->input->post('level_id');
        echo json_encode($this->VacancyModel->inclusionamount($position,$level)[0]);
        // echo json_encode($this->VacancyModel->inclusionamount($id)[0]);
    }
}
