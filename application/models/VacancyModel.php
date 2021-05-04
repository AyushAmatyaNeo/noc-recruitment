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
        $query  = $this->db->query("SELECT NV.VACANCY_ID,VACANCY_EDESC,QUOTA_OPEN,AD_NO,DESIGNATION_TITLE,NV.STATUS,DEPARTMENT_NAME,FILE_NAME,FILE_IN_DIR_NAME,FUNCTIONAL_LEVEL_EDESC,SERVICE_TYPE_NAME,SERVICE_EVENT_NAME,START_DATE,END_DATE,EXTENDED_DATE,STAGE_EDESC FROM $this->table NV 
        LEFT JOIN HRIS_DESIGNATIONS HD ON NV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_DEPARTMENTS HVD ON NV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        LEFT JOIN HRIS_REC_OPENINGS_DOCUMENTS  HVF ON NV.OPENING_ID = HVF.OPENING_ID
        LEFT JOIN HRIS_FUNCTIONAL_LEVELS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = NV.LEVEL_ID
        LEFT JOIN HRIS_SERVICE_TYPES  HST ON HST.SERVICE_TYPE_ID = NV.SERVICE_TYPES_ID
        LEFT JOIN HRIS_REC_SERVICE_EVENTS_TYPES HET ON HET.SERVICE_EVENT_ID = NV.SERVICE_EVENTS_ID
        LEFT JOIN HRIS_REC_OPENINGS HRO ON HRO.OPENING_ID = NV.OPENING_ID
        LEFT JOIN HRIS_REC_VACANCY_STAGES HVS ON HVS.VACANCY_ID = NV.VACANCY_ID
        -- LEFT JOIN HRIS_REC_VACANCY_INCLUSION VI ON VI.VACANCY_ID = NV.VACANCY_ID
        -- LEFT JOIN HRIS_REC_OPTIONS VO ON VO.OPTION_ID = VI.INCLUSION_ID
        LEFT JOIN HRIS_REC_STAGES HS ON HS.REC_STAGE_ID = HVS.REC_STAGE_ID
        WHERE NV.STATUS = 'E' AND HVF.STATUS = 'E' AND HRO.STATUS = 'E' AND HVS.STATUS = 'E'  ORDER BY NV.VACANCY_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // echo '<pre>';print_r($this->db->last_query()); die;
        return $result;
    }
    // Fetch all inclusion related to this vacancy ids:
    public function fetchInclusion($vid)
    {   
        $query  = $this->db->query("SELECT OPTION_EDESC,VI.INCLUSION_ID,NV.VACANCY_ID FROM HRIS_REC_VACANCY_INCLUSION VI
        LEFT JOIN $this->table NV ON VI.VACANCY_ID = NV.VACANCY_ID
        LEFT JOIN HRIS_REC_OPTIONS VO ON VO.OPTION_ID = VI.INCLUSION_ID
        WHERE VI.STATUS = 'E' AND VI.VACANCY_ID = '$vid'");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function fetchApplicationInclusion($ApplicationId)
    {   
        $query  = $this->db->query("SELECT AI.INCLUSION_ID FROM HRIS_REC_APPLICATION_INCLUSION AI
        -- LEFT JOIN HRIS_REC_VACANCY_INCLUSION VI ON VI.VACANCY_ID = AI.VACANCY_ID
        LEFT JOIN HRIS_REC_OPTIONS VO ON VO.OPTION_ID = AI.INCLUSION_ID
        WHERE AI.STATUS = 'E' AND AI.APPLICATION_ID = '$ApplicationId'");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    } 
    // VACANCY DETAIL PAGE
    public function vacancydetail($vid)
    {
        $query  = $this->db->query("SELECT NV.VACANCY_ID,NV.OPENING_ID,AD_NO,LEVEL_ID,NV.VACANCY_EDESC,NV.VACANCY_NDESC,NV.JOB_SPECIFICATION,NV.ROLES,NV.RESPONSIBILITY,NV.EXPERIENCE,DESIGNATION_TITLE,DEPARTMENT_NAME,FILE_NAME,FILE_IN_DIR_NAME,SERVICE_TYPE_NAME,SERVICE_EVENT_NAME,STAGE_EDESC,END_DATE,EXTENDED_DATE,OPENING_NO,FUNCTIONAL_LEVEL_EDESC FROM $this->table NV 
        LEFT JOIN HRIS_DESIGNATIONS HD ON NV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_DEPARTMENTS HVD ON NV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        LEFT JOIN HRIS_REC_OPENINGS_DOCUMENTS  HVF ON NV.OPENING_ID = HVF.OPENING_ID
        LEFT JOIN HRIS_FUNCTIONAL_LEVELS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = NV.LEVEL_ID
        LEFT JOIN HRIS_SERVICE_TYPES  HST ON HST.SERVICE_TYPE_ID = NV.SERVICE_TYPES_ID
        LEFT JOIN HRIS_REC_SERVICE_EVENTS_TYPES  HET ON HET.SERVICE_EVENT_ID = NV.SERVICE_EVENTS_ID
        LEFT JOIN HRIS_REC_OPENINGS HRO ON HRO.OPENING_ID = NV.OPENING_ID
        LEFT JOIN HRIS_REC_VACANCY_STAGES HVS ON HVS.VACANCY_ID = NV.VACANCY_ID
        LEFT JOIN HRIS_REC_STAGES HS ON HS.REC_STAGE_ID = HVS.REC_STAGE_ID
        WHERE NV.STATUS = 'E' AND HVF.STATUS = 'E' AND HRO.STATUS = 'E' AND NV.VACANCY_ID = $vid ORDER BY NV.VACANCY_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // echo '<pre>';print_r($this->db->last_query()); die;
        return $result;
    }
    //Insert Application Details
    public function insert($data = array()) 
    { 
        if(!empty($data))
        { 
            $details = $data['details'];            
            $personal = $data['personal'];
            $inclusion = $data['inclusion'];
            $education = $data['education'];
            $experiences = $data['experience'];
            $training = $data['training'];
            // echo '<pre>'; print_r(($inclusion)); die;
            if(!empty($details))
            {
                $details = implode('\',\'', $details);
                $sql = "INSERT INTO HRIS_REC_VACANCY_APPLICATION values ('$details')";
                $insert = $this->db->query($sql);
            }
            if(!empty($personal))
            {
                $personal = implode('\',\'', $personal);
                $sql = "INSERT INTO HRIS_REC_APPLICATION_PERSONAL values ('$personal')";
                $insert = $this->db->query($sql);          
            }
            if(!empty($inclusion))
            {
                for($i=0; $i < count($inclusion); $i++) {
                    $inclusion[$i] = implode('\',\'', $inclusion[$i]);
                    $sql = "INSERT INTO HRIS_REC_APPLICATION_INCLUSION values ('$inclusion[$i]')";
                    $insert = $this->db->query($sql);          
                }          
            }
            if(!empty($education))
            {
                for($i=0; $i < count($education); $i++) {
                    $education[$i] = implode('\',\'', $education[$i]);
                    $sql = "INSERT INTO HRIS_REC_APPLICATION_EDUCATION values ('$education[$i]')";
                    $insert = $this->db->query($sql);          
                }
            }
            if(!empty($experiences[0]['ORGANISATION_NAME'] && $experiences[0]['POST_NAME'] ))
            {
                for($i=0; $i < count($experiences); $i++) {
                    $experiences[$i] = implode('\',\'', $experiences[$i]);
                    $sql = "INSERT INTO HRIS_REC_APPLICATION_EXPERIENCES values ('$experiences[$i]')";
                    $insert = $this->db->query($sql);          
                }
            }
            if(!empty($training))
            {
                for($i=0; $i < count($training); $i++) {
                    $training[$i] = implode('\',\'', $training[$i]);
                    $sql = "INSERT INTO HRIS_REC_APPLICATION_TRAININGS values ('$training[$i]')";
                    $insert = $this->db->query($sql);          
                }
            }

            return true;
        }
        return false; 
    }
    // Update Application
    public function updateapplication($data,$uid,$appid)
    {
        if(!empty($data)){
            $details    = $data['details'];
            $personal    = $data['personal'];
            $educations  = $data['educations'];
            $inclusion   = $data['inclusion_updated'];
            $experiences = $data['experiences'];
            $trainings   = $data['trainings'];
            if(!empty($personal))
            {
                $details['modified_date'] = DATE("Y-m-d");
                $akey    = array_keys($details);
                $keydata = implode(',', $akey);
                $aval    = array_values($details);
                $valdata = implode('\',\'', $aval);
                $update = $this->db->query("UPDATE HRIS_REC_VACANCY_APPLICATION  SET ($keydata) = ('$valdata')  where APPLICATION_ID = $appid AND USER_ID = $uid");
            }
            if(!empty($personal))
            {
                $personal['modified_date'] = DATE("Y-m-d");
                $akey    = array_keys($personal);
                $keydata = implode(',', $akey);
                $aval    = array_values($personal);
                $valdata = implode('\',\'', $aval);
                $update = $this->db->query("UPDATE HRIS_REC_APPLICATION_PERSONAL  SET ($keydata) = ('$valdata')  where APPLICATION_ID = $appid AND USER_ID = $uid");
            }
            if(!empty($inclusion))
            {
                for($i=0; $i < count($inclusion); $i++) {
                    $inclusion[$i] = implode('\',\'', $inclusion[$i]);
                    $sql = "INSERT INTO HRIS_REC_APPLICATION_INCLUSION values ('$inclusion[$i]')";
                    $insert = $this->db->query($sql);          
                }          
            }
            if(!empty($educations))
            {
                for($i=0; $i < (count($educations)); $i++)
                {
                    $edu_id = $educations[$i]['education_id'];
                    $eduCheck = $this->db->query("SELECT * FROM HRIS_REC_APPLICATION_EDUCATION WHERE EDUCATION_ID = $edu_id");
                    $Eduresult = ($eduCheck->num_rows() > 0)?TRUE:FALSE;
                    if($Eduresult == TRUE)
                    {
                        // $edu_id = $educations[$i]['education_id'];
                        $educations[$i]['modified_date'] = DATE("Y-m-d");
                        $akey    = array_keys($educations[$i]);
                        $keydata = implode(',', $akey);
                        $aval    = array_values($educations[$i]);
                        $valdata = implode('\',\'', $aval);
                        $update = $this->db->query("UPDATE  HRIS_REC_APPLICATION_EDUCATION SET ($keydata) = ('$valdata') WHERE EDUCATION_ID = $edu_id AND APPLICATION_ID = $appid AND USER_ID = $uid");
                    }else
                    {
                        $educations[$i]['created_date'] = DATE("Y-m-d");
                        $akey    = array_keys($educations[$i]);
                        $keydata = implode(',', $akey);
                        $aval    = array_values($educations[$i]);
                        $valdata = implode('\',\'', $aval);
                        $sql = "INSERT INTO HRIS_REC_APPLICATION_EDUCATION ($keydata) values ('$valdata')";
                        $insert = $this->db->query($sql);  
                    }
                    
                }                
            }
            if(!empty($experiences))
            {
                for($i=0; $i < (count($experiences)); $i++)
                {
                    $exp_id = $experiences[$i]['experience_id'];
                    $experiences[$i]['modified_date'] = DATE("Y-m-d");
                    $akey    = array_keys($experiences[$i]);
                    $keydata = implode(',', $akey);
                    $aval    = array_values($experiences[$i]);
                    $valdata = implode('\',\'', $aval);
                    $update = $this->db->query("UPDATE  HRIS_REC_APPLICATION_EXPERIENCES SET ($keydata) = ('$valdata') WHERE EXPERIENCE_ID = $exp_id AND APPLICATION_ID = $appid AND USER_ID = $uid");
                }
            }
            if(!empty($trainings))
            {
                for($i=0; $i < (count($trainings)); $i++)
                {
                    $trg_id = $trainings[$i]['training_id'];
                    $trainings[$i]['modified_date'] = DATE("Y-m-d");
                    $akey    = array_keys($trainings[$i]);
                    $keydata = implode(',', $akey);
                    $aval    = array_values($trainings[$i]);
                    $valdata = implode('\',\'', $aval);
                    $update = $this->db->query("UPDATE  HRIS_REC_APPLICATION_TRAININGS SET ($keydata) = ('$valdata') WHERE TRAINING_ID = $trg_id AND APPLICATION_ID = $appid AND USER_ID = $uid");
                }
            }
            return true;
        }
        return false;
    }
    //Update Application Edit images:
    public function updateimg($image,$imageId)
    {
        if(!empty($image)){ 
            // $image = implode('\',\'', $image);
            // echo '<pre>'; print_r(($image)); die;
            $image['modified_date'] = DATE("Y-m-d");
            $akey    = array_keys($image);
            $keydata = implode(',', $akey);
            $aval    = array_values($image);
            $valdata = implode('\',\'', $aval);
            $insert = $this->db->query("UPDATE HRIS_REC_APPLICATION_DOCUMENTS SET ($keydata) = ('$valdata') WHERE REC_DOC_ID = '$imageId'");
            return true;
        }
        else{
            return false;
        }
    }
    //INclusion selection Amount:
    public function inclusionamount($position,$level)
    {
        $query = $this->db->query("SELECT NORMAL_AMOUNT,LATE_AMOUNT,INCLUSION_AMOUNT,END_DATE,EXTENDED_DATE FROM HRIS_REC_VACANCY_LEVELS NV
        LEFT JOIN HRIS_REC_OPENINGS HO ON NV.OPENING_ID = HO.OPENING_ID
        WHERE FUNCTIONAL_LEVEL_ID = $level AND POSITION_ID = $position ORDER BY EFFECTIVE_DATE DESC");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    // Delete (Disable) existing inclusion before insert ----
    public function deleteInclusion($data,$uid)
    {
        if(!empty($data)){
            $inclusion   = $data['inclusion'];
            // echo '<pre>'; print_r(($inclusion)); die;
            if(!empty($inclusion))
            {
                for($i=0; $i < (count($inclusion)); $i++)
                {
                    // echo '<pre>'; print_r(($inclusion[$i])); die;
                    $inc_id = $inclusion[$i];
                    $MODIFIED_DATE = DATE("Y-m-d");
                    $update = $this->db->query("UPDATE  HRIS_REC_APPLICATION_INCLUSION SET STATUS = 'D',MODIFIED_DATE = '$MODIFIED_DATE' WHERE APPLICATION_INCLUSION_ID = $inc_id AND USER_ID = $uid");
                }                
            }
            return true;
        }
        return false;
    }
    public function insertimg($image)
    {
        // echo '<pre>'; print_r(($image)); die;
        if(!empty($image)){ 
            $image = implode('\',\'', $image);
            // echo '<pre>'; print_r(($image)); die;
            $insert = $this->db->query("INSERT INTO HRIS_REC_APPLICATION_DOCUMENTS (REC_DOC_ID,APPLICATION_ID,USER_ID,DOC_OLD_NAME,DOC_NEW_NAME,DOC_PATH,DOC_TYPE)
            values ('$image')");
            return true;
        }
        else{
            return false;
        }
    }
    // Registration Data
    public function details()
    {
        $query = $this->db->query("SELECT * FROM HRIS_REC_REGISTRATION WHERE REG_ID = (SELECT MAX(REG_ID) FROM HRIS_REC_REGISTRATION)");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    // Fetch Vacancy details as per Id
    function fetchVacancyById($id)
    {
        $query = $this->db->query("SELECT VACANCY_ID,VACANCY_EDESC,AD_NO,DESIGNATION_TITLE,DESIGNATION_ID,NV.STATUS,DEPARTMENT_NAME,FUNCTIONAL_LEVEL_EDESC,FUNCTIONAL_LEVEL_ID,INSTRUCTION_EDESC FROM $this->table NV 
        LEFT JOIN HRIS_DESIGNATIONS HD ON NV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_DEPARTMENTS HVD ON NV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        LEFT JOIN HRIS_FUNCTIONAL_LEVELS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = NV.LEVEL_ID
        LEFT JOIN HRIS_REC_OPENINGS HO ON HO.OPENING_ID = NV.OPENING_ID
        WHERE NV.STATUS = 'E' AND NV.VACANCY_ID = $id");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // echo '<pre>';print_r($result); die;
        return $result;
    }
    // Fetch all vacancy as per ad no. -- for Registration number
    public function fetchvacancyByAdNo($table,$AdNo)
    {
        $query = $this->db->query("SELECT COUNT(DISTINCT AD_NO) FROM $table WHERE AD_NO = $AdNo");
        return $query->result_array()[0]['COUNT(DISTINCT AD_NO)'];
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
        WHERE HVO.VACANCY_ID = $vid AND HVO.STATUS = 'E'");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function fetch_provience()
    {
        $query = $this->db->query("SELECT * FROM HRIS_PROVINCES ORDER BY PROVINCE_ID");
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
    public function fetch_vdc($district_id)
    {
        $query = $this->db->query("SELECT * FROM HRIS_VDC_MUNICIPALITIES WHERE DISTRICT_ID = $district_id ORDER BY VDC_MUNICIPALITY_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        $output = '<option value="" > Select Municipality </option>';
        foreach($result as $row)
        {
            $output .= '<option value="'.$row['VDC_MUNICIPALITY_ID'].'">'.$row['VDC_MUNICIPALITY_NAME'].'</option>';
        }
        return $output;
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
    // Maximum Registration Id
    public function getMaxIdReg()
    {
        $query = $this->db->query("SELECT ifnull(MAX(REG_ID),'1') AS MAXID FROM HRIS_REC_REGISTRATION");
        $result = $query->row_array();
        return $result;
    }
    // Max Application Id as per users
    public function getMaxIdapplication($Vid)
    {
        $query = $this->db->query("SELECT MAX(APPLICATION_ID) AS MAXID FROM HRIS_REC_VACANCY_APPLICATION WHERE AD_NO = $Vid");
        $result = $query->row_array();
        return $result;
    }
    // Maximum Personal Id
    public function getMaxIdfm()
    {
        $query = $this->db->query("SELECT MAX(FAMILY_ID) AS MAXID FROM HRIS_REC_APPLICATION_FAMILY");
        $result = $query->row_array();
        return $result;
    }
    public function getMaxIds($id_name,$table)
    {
        $query = $this->db->query("SELECT MAX($id_name) AS MAXID FROM $table");
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
    // Return Exisiting data
    public function registerdata($vid, $RegId)
    {
        $query = $this->db->query("SELECT * FROM HRIS_REC_VACANCY_APPLICATION WHERE AD_NO = $vid AND APPLICATION_ID = $RegId");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function registerId($uid)
    {
        $query = $this->db->query("SELECT MAX(APPLICATION_ID) AS MAXID FROM HRIS_REC_VACANCY_APPLICATION WHERE USER_ID = $uid");
        $result = $query->row_array();
        return $result;
    }
    //Success page data
    public function successdata($id)
    {
        $query = $this->db->query("SELECT VA.APPLICATION_ID,HV.AD_NO,VA.CREATED_DATE,DESIGNATION_TITLE,FUNCTIONAL_LEVEL_EDESC,SERVICE_TYPE_NAME,APPLICATION_AMOUNT,VACANCY_ID FROM HRIS_REC_VACANCY_APPLICATION VA
        LEFT JOIN HRIS_REC_APPLICATION_PERSONAL VAP ON  VAP.APPLICATION_ID = VA.APPLICATION_ID
        LEFT JOIN HRIS_REC_VACANCY HV ON HV.VACANCY_ID = VA.AD_NO
        LEFT JOIN HRIS_DESIGNATIONS HD ON HV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_DEPARTMENTS HVD ON HV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        LEFT JOIN HRIS_FUNCTIONAL_LEVELS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = HV.LEVEL_ID
        LEFT JOIN HRIS_SERVICE_TYPES  HST ON HST.SERVICE_TYPE_ID = HV.SERVICE_TYPES_ID
        WHERE VA.APPLICATION_ID = (SELECT MAX(APPLICATION_ID) from HRIS_REC_VACANCY_APPLICATION) AND VA.USER_ID = '$id'");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function payment_insert($esewa)
    {
            $esewa = implode('\',\'', $esewa);
            // echo '<pre>'; print_r($esewa); die;
            $sql = "INSERT INTO HRIS_REC_APPLICATION_PAYMENT values ('$esewa')";
            $insert = $this->db->query($sql);
            return true;
    }
    // Applied vacnacy Details
    public function applicationDetails($uid)
    {
        // echo $uid['id']; die; 
        $uid = $uid['id'];
        $query  = $this->db->query("SELECT NV.APPLICATION_ID,HV.AD_NO, HD.DESIGNATION_TITLE, HFL.FUNCTIONAL_LEVEL_EDESC,STAGE_NAME,APPLICATION_AMOUNT,VACANCY_ID FROM HRIS_REC_VACANCY_APPLICATION AS NV 
        LEFT JOIN HRIS_REC_VACANCY AS HV ON NV.AD_NO = HV.VACANCY_ID
        LEFT JOIN HRIS_FUNCTIONAL_LEVELS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = HV.LEVEL_ID
        LEFT JOIN HRIS_DESIGNATIONS HD ON HV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_REC_APPLICATION_STAGE HAS ON NV.STAGE_ID = HAS.APPLICATION_STAGE_ID
        WHERE NV.STATUS = 'D' AND NV.USER_ID = $uid ORDER BY NV.APPLICATION_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    //Get data for edit applied vacancy
    public function applicationById($vid,$uid, $table)
    {
        if($uid == '')
        {
            $col = $vid['columnid'];
            $val = $vid['valueid'];
            $field = $vid['field'];

            $query  = $this->db->query("SELECT $field FROM $table WHERE $col = $val");
            // print_r($this->db->last_query()); die;
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            return $result;
        }
        $query  = $this->db->query("SELECT * FROM $table AS AA
        LEFT JOIN HRIS_REC_VACANCY_APPLICATION AS VA ON VA.APPLICATION_ID = AA.APPLICATION_ID
        WHERE VA.AD_NO = $vid AND VA.USER_ID = $uid");
        // print_r($this->db->last_query()); die;
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function applicationByOrderId($vid,$uid, $table,$order)
    {
        $query  = $this->db->query("SELECT * FROM $table AS AA
        LEFT JOIN HRIS_REC_VACANCY_APPLICATION AS VA ON VA.APPLICATION_ID = AA.APPLICATION_ID
        WHERE VA.AD_NO = $vid AND VA.USER_ID = $uid ORDER BY $order ASC");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function admitCard($uid,$appid)
    {
        // echo $uid['id']; die; 
        $query  = $this->db->query("SELECT VU.FIRST_NAME,VU.MIDDLE_NAME,VU.LAST_NAME,RV.AD_NO,HD.DESIGNATION_TITLE,HFL.FUNCTIONAL_LEVEL_EDESC,SERVICE_TYPE_NAME,SERVICE_EVENT_NAME ,AD.* from HRIS_REC_APPLICATION_DOCUMENTS AS AD
        LEFT JOIN HRIS_REC_VACANCY_APPLICATION AS VA ON VA.APPLICATION_ID = AD.APPLICATION_ID
        LEFT JOIN HRIS_REC_VACANCY AS RV ON RV.VACANCY_ID = VA.AD_NO
        LEFT JOIN HRIS_REC_APPLICATION_PERSONAL AS AP ON AP.APPLICATION_ID = AD.APPLICATION_ID
        LEFT JOIN HRIS_DESIGNATIONS HD ON RV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_DEPARTMENTS HVD ON RV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        LEFT JOIN HRIS_SERVICE_TYPES  HST ON HST.SERVICE_TYPE_ID = RV.SERVICE_TYPES_ID
        LEFT JOIN HRIS_REC_SERVICE_EVENTS_TYPES  HET ON HET.SERVICE_EVENT_ID = RV.SERVICE_EVENTS_ID
        LEFT JOIN HRIS_FUNCTIONAL_LEVELS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = RV.LEVEL_ID
        LEFT JOIN HRIS_REC_VACANCY_USERS AS VU ON VU.USER_ID = AD.USER_ID
        
        where AD.USER_ID = $uid AND AD.APPLICATION_ID = $appid ORDER BY AD.REC_DOC_ID ");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function checkapplied($vid,$uid)
    {   
        $query = $this->db->query("SELECT * FROM HRIS_REC_VACANCY_APPLICATION WHERE AD_NO = $vid AND USER_ID = $uid");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;

    }
}