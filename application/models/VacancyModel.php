<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VacancyModel extends CI_Model
{
    function __construct()
    {
        $this->table = 'HRIS_REC_VACANCY';
    }

    public function fetchvacancy()
    {
        // $sql = "SELECT * FROM HRIS_REC_VACANCY";
        $query  = $this->db->query("SELECT VACANCY_ID,VACANCY_EDESC,AD_NO,DESIGNATION_TITLE,NV.STATUS,DEPARTMENT_NAME FROM $this->table NV 
        LEFT JOIN HRIS_DESIGNATIONS HD ON NV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_DEPARTMENTS HVD ON NV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        WHERE NV.STATUS = 'E' ORDER BY NV.VACANCY_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // echo '<pre>';print_r($result); die;
        return $result;
    }
    public function insert($data = array()) 
    { 
        // echo '<pre>'; print_r(count($data)); die;
        // echo '<pre>'; print_r(($data)); die;
        if(!empty($data))
        { 
            $details = $data['details'];
            $education = $data['Education'];
            $experiance = $data['Experiance'];
            $traning = $data['Traning'];
            // echo '<pre>'; print_r(($experiance)); die;
            for($i=0; $i < count($details); $i++) {
                $details = implode('\',\'', $details);
                $insert = $this->db->query("INSERT INTO HRIS_REC_REGISTRATION (REG_ID,USER_ID,OPENING_ID,AD_NO,POSITION_ID,EXAM_CENTER,REG_DT,
                FULL_NAME_EN,FULL_NAME_NP,GENDER_ID,AGE,DOB_EN,DOB_NP,INCLUSIVE_ID,PERMANENT_PROVIENCE_ID,PERMANENT_DISTRICT_ID,PERMANENT_VDC,PERMANENT_WARD_ID,PERMANENT_TOLE,
                PHONE_NO,MAILLING_PROVIENCE_ID,MAILLING_DISTRICT_ID,MAILLING_VDC,MAILLING_WARD_NO,MAILLING_TOLE,MOBILE_NO,EMAIL_ID,CITIZENSHIP_NO,CTZ_ISSUE_DATE,
                CTZ_ISSUE_DISTRICT_ID,FATHER_NAME,MOTHER_NAME,SPOUSE_NAME)
                values ('$details')");
                // print_r($insert); die;                
            }
            for($i=0; $i < count($education); $i++) {
                $education[$i] = implode('\',\'', $education[$i]);
                $insert = $this->db->query("INSERT INTO HRIS_REC_EDUCATION (EDU_ID,REG_ID,EDUCATION_INSTITUTE,LEVEL_ID,FACALTY,DIVISION_ID,PASSED_YEAR,MAJOR_SUBJECT,CREATED_DATE,CREATED_BY) values ('$education[$i]')"); 
                // echo '<pre>'; print_r($insert); die;                
            }
            for($i=0; $i < count($experiance); $i++) {
                $experiance[$i] = implode('\',\'', $experiance[$i]);
                $insert = $this->db->query("INSERT INTO HRIS_REC_EXPERIENCES (EXP_ID,REG_ID,ORGANISATION_NAME,POST_NAME,SERVICE_NAME,LEVEL_ID,EMPLOYEE_TYPE_ID,FROM_DATE,TO_DATE,CREATED_DATE,CREATED_BY) values ('$experiance[$i]')"); 
                // print_r($insert); die;                
            } 
            for($i=0; $i < count($traning); $i++) {
                $traning[$i] = implode('\',\'', $traning[$i]);
                $insert = $this->db->query("INSERT INTO HRIS_REC_TRAININGS values ('$traning[$i]')"); 
                // print_r($insert); die;                
            } 

            return redirect('vacancy/apply_success');
        }
        return false; 
    }
    public function insertimg($image)
    {
        // echo '<pre>'; print_r(($image)); die;
        if(!empty($image)){ 
            $image = implode('\',\'', $image);
            // echo '<pre>'; print_r(($image)); die;
            $insert = $this->db->query("INSERT INTO HRIS_REC_DOCUMENTS (REC_DOC_ID,REG_ID,USER_ID,DOC_OLD_NAME,DOC_NEW_NAME,DOC_PATH,DOC_TYPE)
            values ('$image')");
            return true;
        }
        else{
            return false;
        }
    }
    function fetchVacancyById($id)
    {
        $query = $this->db->query("SELECT VACANCY_ID,VACANCY_EDESC,AD_NO,DESIGNATION_TITLE,DESIGNATION_ID,NV.STATUS,DEPARTMENT_NAME FROM $this->table NV 
        LEFT JOIN HRIS_DESIGNATIONS HD ON NV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_DEPARTMENTS HVD ON NV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        WHERE NV.STATUS = 'E' AND NV.VACANCY_ID = $id");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // echo '<pre>';print_r($result); die;
        return $result;
    }
    public function fetchOptionByid($vid)
    {
        $query = $this->db->query("SELECT * FROM HRIS_REC_VACANCY WHERE VACANCY_ID = $vid");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function options($vid)
    {
        $query = $this->db->query("SELECT HO.OPTION_EDESC,HO.OPTION_ID,HVO.LATE_AMT,HVO.NORMAL_AMT FROM HRIS_REC_VACANCY_OPTIONS HVO
        LEFT JOIN HRIS_REC_OPTIONS HO ON HO.OPTION_ID = HVO.OPTION_ID
        WHERE HO.VACANCY_ID = $vid");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function fetch_provience()
    {
        $query = $this->db->query("SELECT * FROM HRIS_PROVINCES ORDER BY PROVINCE_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function degree()
    {
        $query = $this->db->query("SELECT * FROM HRIS_ACADEMIC_DEGREES WHERE STATUS = 'E' ORDER BY ACADEMIC_DEGREE_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function division()
    {
        $query = $this->db->query("SELECT * FROM HRIS_REC_DIVISION WHERE STATUS = 'E' ORDER BY DIVISION_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function districts()
    {
        $query = $this->db->query("SELECT * FROM HRIS_DISTRICTS WHERE STATUS = 'E' ORDER BY DISTRICT_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function fetch_district($province_id)
    {
        $query = $this->db->query("SELECT * FROM HRIS_DISTRICTS WHERE PROVINCE_ID = $province_id ORDER BY DISTRICT_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        $output = '<option value="" > Select District </option>';
        foreach($result as $row)
        {
            $output .= '<option value="'.$row['DISTRICT_ID'].'">'.$row['DISTRICT_NAME'].'</option>';
        }
        return $output;
    }
    // Maximum Registration Id
    public function getMaxIdReg()
    {
        $query = $this->db->query("SELECT MAX(REG_ID) AS MAXID FROM HRIS_REC_REGISTRATION");
        $result = $query->row_array();
        return $result;
    }
    // Max Education ID
    public function getMaxIdEdu()
    {
        $query = $this->db->query("SELECT MAX(EDU_ID) AS MAXID FROM HRIS_REC_EDUCATION");
        $result = $query->row_array();
        return $result;
    }
    // Max Experiance ID
    public function getMaxIdExp()
    {
        $query = $this->db->query("SELECT MAX(EXP_ID) AS MAXID FROM HRIS_REC_EXPERIENCES");
        $result = $query->row_array();
        return $result;
    }
    // Max Training ID
    public function getMaxIdTr()
    {
        $query = $this->db->query("SELECT MAX(TRAINING_ID) AS MAXID FROM HRIS_REC_TRAININGS");
        $result = $query->row_array();
        return $result;
    }
    
    // Max Vacancy Id
    public function getMaxId()
    {
        $query = $this->db->query("SELECT MAX(VACANCY_ID) AS MAXID FROM HRIS_REC_VACANCY");
        $result = $query->row_array();
        return $result;
    }
    public function imageMaxId()
    {
        $query = $this->db->query("SELECT MAX(REC_DOC_ID) AS MAXID FROM HRIS_REC_DOCUMENTS");
        $result = $query->row_array();
        return $result;
    }
    
    
}