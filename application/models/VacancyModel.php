<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VacancyModel extends CI_Model
{
    function __construct()
    {
        $this->table    = 'HRIS_REC_VACANCY';
        $this->apptable = 'HRIS_REC_VACANCY_APPLICATION';
        $this->gatewaytable = 'HRIS_REC_PAYMENT_GATEWAY';

    }

    public function fetchvacancy()
    {
        // $sql = "SELECT * FROM HRIS_REC_VACANCY";
        $query  = $this->db->query("
            SELECT NV.VACANCY_ID,AD_NO,DESIGNATION_TITLE,HD.DESIGNATION_ID,
            NV.STATUS,NV.VACANCY_RESERVATION_NO,DEPARTMENT_NAME,FILE_IN_DIR_NAME,FUNCTIONAL_LEVEL_EDESC,SERVICE_TYPE_NAME,SERVICE_EVENT_NAME,START_DATE,END_DATE,EXTENDED_DATE,
            NV.INCLUSION_ID,STAGE_EDESC,FILE_NAME 
            FROM $this->table NV 

        LEFT JOIN HRIS_DESIGNATIONS HD ON NV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_DEPARTMENTS HVD ON NV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        LEFT JOIN HRIS_REC_OPENINGS_DOCUMENTS  HVF ON NV.OPENING_ID = HVF.OPENING_ID
        LEFT JOIN HRIS_FUNCTIONAL_LEVELS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = NV.LEVEL_ID
        LEFT JOIN HRIS_SERVICE_TYPES  HST ON HST.SERVICE_TYPE_ID = NV.SERVICE_TYPES_ID
        LEFT JOIN HRIS_REC_SERVICE_EVENTS_TYPES HET ON HET.SERVICE_EVENT_ID = NV.SERVICE_EVENTS_ID
        LEFT JOIN HRIS_REC_OPENINGS HRO ON HRO.OPENING_ID = NV.OPENING_ID
        LEFT JOIN HRIS_REC_VACANCY_STAGES HVS ON HVS.VACANCY_ID = NV.VACANCY_ID
        LEFT JOIN HRIS_REC_STAGES HS ON HS.REC_STAGE_ID = HVS.REC_STAGE_ID

        WHERE NV.VACANCY_TYPE = 'OPEN' AND 
              NV.STATUS = 'E' AND 
              HS.ORDER_NO > 3 AND 
              HVF.STATUS = 'E'");

        $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
        // echo '<pre>';print_r($result); die;
        return $result;
    }
    // Fetch all inclusion related to this vacancy ids:
    public function fetchinclusions($Incid)
    {   
        // echo '<pre>';print_r($Incid); die;
        $query  = $this->db->query("SELECT OPTION_ID AS INCLUSION_ID,OPTION_EDESC FROM HRIS_REC_OPTIONS where OPTION_ID = $Incid");
        $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $result;
    }
    public function fetchSkills($sid)
    {   
        $query  = $this->db->query("SELECT SKILL_NAME,SKILL_ID,UPLOAD_FLAG FROM HRIS_REC_SKILL where SKILL_ID = $sid");
        $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $result;
    }
    public function Vacancyskills($aid){
        $query  = $this->db->query("SELECT SKILL_ID FROM HRIS_REC_APPLICATION_PERSONAL where APPLICATION_ID = $aid");
        $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
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
        // echo '<pre>'; print_r('$vid'); die;
        // $query  = $this->db->query("SELECT NV.VACANCY_ID,NV.REMARK,NV.OPENING_ID,AD_NO,LEVEL_ID,NV.EXPERIENCE,DESIGNATION_TITLE,DESIGNATION_ID,DEPARTMENT_NAME,FILE_NAME,FILE_IN_DIR_NAME,SERVICE_TYPE_NAME,SERVICE_EVENT_NAME,STAGE_EDESC,END_DATE,EXTENDED_DATE,OPENING_NO,FUNCTIONAL_LEVEL_EDESC,SKILL_ID,INCLUSION_ID,HRO.INSTRUCTION_NDESC AS OPENING_NOTES,HRO.INSTRUCTION_EDESC AS OPENING_INSTRUCTION FROM $this->table NV 
        // LEFT JOIN HRIS_DESIGNATIONS HD ON NV.POSITION_ID = HD.DESIGNATION_ID
        // LEFT JOIN HRIS_DEPARTMENTS HVD ON NV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        // LEFT JOIN HRIS_REC_OPENINGS_DOCUMENTS  HVF ON NV.OPENING_ID = HVF.OPENING_ID
        // LEFT JOIN HRIS_FUNCTIONAL_LEVELS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = NV.LEVEL_ID
        // LEFT JOIN HRIS_SERVICE_TYPES  HST ON HST.SERVICE_TYPE_ID = NV.SERVICE_TYPES_ID
        // LEFT JOIN HRIS_REC_SERVICE_EVENTS_TYPES  HET ON HET.SERVICE_EVENT_ID = NV.SERVICE_EVENTS_ID
        // LEFT JOIN HRIS_REC_OPENINGS HRO ON HRO.OPENING_ID = NV.OPENING_ID
        // LEFT JOIN HRIS_REC_VACANCY_STAGES HVS ON HVS.VACANCY_ID = NV.VACANCY_ID
        // LEFT JOIN HRIS_REC_STAGES HS ON HS.REC_STAGE_ID = HVS.REC_STAGE_ID
        // -- LEFT JOIN HRIS_REC_OPENINGS OPN ON OPN.OPENING_ID = NV.OPENING_ID
        // WHERE NV.STATUS = 'E' AND HVF.STATUS = 'E' AND HRO.STATUS = 'E' AND NV.VACANCY_ID = $vid ORDER BY NV.VACANCY_ID");

        $query = $this->db->query(" SELECT NV.VACANCY_ID,NV.REMARK,NV.OPENING_ID,NV.AD_NO,NV.EXPERIENCE,NV.SKILL_ID,NV.INCLUSION_ID,NV.LEVEL_ID,NV.POSITION_ID,HD.DESIGNATION_TITLE,HVD.DEPARTMENT_NAME,HFL.FUNCTIONAL_LEVEL_EDESC,HST.SERVICE_TYPE_NAME,HET.SERVICE_EVENT_NAME,HRO.END_DATE,HRO.EXTENDED_DATE,HRO.OPENING_NO,HS.STAGE_EDESC,HVF.FILE_NAME,HVF.FILE_IN_DIR_NAME,HRO.INSTRUCTION_NDESC AS OPENING_NOTES,HRO.INSTRUCTION_EDESC AS OPENING_INSTRUCTION
        FROM $this->table NV 
        LEFT JOIN HRIS_DESIGNATIONS HD ON NV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_DEPARTMENTS HVD ON NV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        LEFT JOIN HRIS_FUNCTIONAL_LEVELS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = NV.LEVEL_ID
        LEFT JOIN HRIS_SERVICE_TYPES  HST ON HST.SERVICE_TYPE_ID = NV.SERVICE_TYPES_ID
        LEFT JOIN HRIS_REC_SERVICE_EVENTS_TYPES  HET ON HET.SERVICE_EVENT_ID = NV.SERVICE_EVENTS_ID
        LEFT JOIN HRIS_REC_OPENINGS HRO ON HRO.OPENING_ID = NV.OPENING_ID
        LEFT JOIN HRIS_REC_VACANCY_STAGES HVS ON HVS.VACANCY_ID = NV.VACANCY_ID
        LEFT JOIN HRIS_REC_STAGES HS ON HS.REC_STAGE_ID = HVS.REC_STAGE_ID
        LEFT JOIN HRIS_REC_OPENINGS_DOCUMENTS  HVF ON NV.OPENING_ID = HVF.OPENING_ID
        WHERE NV.STATUS = 'E' AND NV.VACANCY_ID = $vid");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // echo '<pre>';print_r($result); die;
        return $result;
    }
    
    /**
     *  Insert Application Details
     *  
     *  INSERTING INTO TABLES
     * 
     *  HRIS_REC_VACANCY_APPLICATION   |   HRIS_REC_APPLICATION_PERSONAL    |   HRIS_REC_APPLICATION_EDUCATION
     *  HRIS_REC_APPLICATION_EXPERIENCES   |   HRIS_REC_APPLICATION_TRAININGS
     * 
     * 
     *  */
    public function insert($data = array()) 
    { 
        if(!empty($data))
        { 
            $details     = $data['details'];            
            $personal    = $data['personal'];
            $education   = $data['education'];
            $experiences = $data['experience'];
            $training    = $data['training'];

            if( !empty($details) ) {

                // $details = implode('\',\'', $details);

                $key   = arrayKeyImplode($details, 'c', 'key');
                $value = arrayKeyImplode($details, 'qc', 'value');
                
                $sql = "INSERT INTO HRIS_REC_VACANCY_APPLICATION ($key) values ('$value')";

                $insert = $this->db->query($sql);
            }


            if (!empty($personal) ) {

                $key   = arrayKeyImplode($personal, 'c', 'key');
                $value = arrayKeyImplode($personal, 'qc', 'value');

                $sql   = "INSERT INTO HRIS_REC_APPLICATION_PERSONAL ($key) values ('$value')";
                $insert = $this->db->query($sql);          
            }

            if (!empty($education) ) {

                for($i=0; $i < count($education); $i++) {
                    $education[$i] = implode('\',\'', $education[$i]);
                    $sql = "INSERT INTO HRIS_REC_APPLICATION_EDUCATION values ('$education[$i]')";
                    $insert = $this->db->query($sql);          
                }
            }

            if (!empty($experiences[0]['ORGANISATION_NAME'] && $experiences[0]['POST_NAME'] )) {

                for($i=0; $i < count($experiences); $i++) {
                    $experiences[$i] = implode('\',\'', $experiences[$i]);
                    $sql = "INSERT INTO HRIS_REC_APPLICATION_EXPERIENCES values ('$experiences[$i]')";
                    // echo '<pre>'; print_r($sql); die;
                    $insert = $this->db->query($sql);          
                }
            }

            if (!empty($training)) {

                for($i=0; $i < count($training); $i++) {
                    $training[$i] = implode('\',\'', $training[$i]);
                    $sql = "INSERT INTO HRIS_REC_APPLICATION_TRAININGS values ('$training[$i]')";
                    // echo '<pre>'; print_r($sql); die;
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
                    $expCheck = $this->db->query("SELECT * FROM HRIS_REC_APPLICATION_EXPERIENCES WHERE EXPERIENCE_ID = $exp_id");
                    $Expresult = ($expCheck->num_rows() > 0)?TRUE:FALSE;
                    if($Expresult == TRUE){
                        $exp_id = $experiences[$i]['experience_id'];
                        $experiences[$i]['modified_date'] = DATE("Y-m-d");
                        $akey    = array_keys($experiences[$i]);
                        $keydata = implode(',', $akey);
                        $aval    = array_values($experiences[$i]);
                        $valdata = implode('\',\'', $aval);
                        $update = $this->db->query("UPDATE  HRIS_REC_APPLICATION_EXPERIENCES SET ($keydata) = ('$valdata') WHERE EXPERIENCE_ID = $exp_id AND APPLICATION_ID = $appid AND USER_ID = $uid");
                    }else
                    {
                        $experiences[$i]['created_date'] = DATE("Y-m-d");
                        $akey    = array_keys($experiences[$i]);
                        $keydata = implode(',', $akey);
                        $aval    = array_values($experiences[$i]);
                        $valdata = implode('\',\'', $aval);
                        $sql = "INSERT INTO HRIS_REC_APPLICATION_EXPERIENCES ($keydata) values ('$valdata')";
                        $insert = $this->db->query($sql);  
                    }                    
                }
            }
            if(!empty($trainings))
            {
                for($i=0; $i < (count($trainings)); $i++)
                {
                    $trn_id = $trainings[$i]['training_id'];
                    $trnCheck = $this->db->query("SELECT * FROM HRIS_REC_APPLICATION_TRAININGS WHERE TRAINING_ID = $trn_id");
                    $Trnresult = ($trnCheck->num_rows() > 0)?TRUE:FALSE;
                    if($Trnresult == TRUE){
                    $trg_id = $trainings[$i]['training_id'];
                    $trainings[$i]['modified_date'] = DATE("Y-m-d");
                    $akey    = array_keys($trainings[$i]);
                    $keydata = implode(',', $akey);
                    $aval    = array_values($trainings[$i]);
                    $valdata = implode('\',\'', $aval);
                    $update = $this->db->query("UPDATE  HRIS_REC_APPLICATION_TRAININGS SET ($keydata) = ('$valdata') WHERE TRAINING_ID = $trg_id AND APPLICATION_ID = $appid AND USER_ID = $uid");
                    }else
                    {
                        $trainings[$i]['created_date'] = DATE("Y-m-d");
                        $akey    = array_keys($trainings[$i]);
                        $keydata = implode(',', $akey);
                        $aval    = array_values($trainings[$i]);
                        $valdata = implode('\',\'', $aval);
                        $sql = "INSERT INTO HRIS_REC_APPLICATION_TRAININGS ($keydata) values ('$valdata')";
                        $insert = $this->db->query($sql);  
                    }

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
            $insert = $this->db->query("INSERT INTO HRIS_REC_APPLICATION_DOCUMENTS (REC_DOC_ID,APPLICATION_ID,VACANCY_ID,USER_ID,DOC_OLD_NAME,DOC_NEW_NAME,DOC_PATH,DOC_TYPE,DOC_FOLDER)
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
        $query = $this->db->query("SELECT NV.VACANCY_ID,NV.INCLUSION_ID,AD_NO,DESIGNATION_TITLE,HD.DESIGNATION_ID,NV.STATUS,DEPARTMENT_NAME,FUNCTIONAL_LEVEL_EDESC,FUNCTIONAL_LEVEL_ID,INSTRUCTION_EDESC,ACADEMIC_DEGREE_CODE,ACADEMIC_DEGREE_NAME,SKILL_ID,EXPERIENCE FROM $this->table NV 
        LEFT JOIN HRIS_DESIGNATIONS HD ON NV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_DEPARTMENTS HVD ON NV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        LEFT JOIN HRIS_FUNCTIONAL_LEVELS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = NV.LEVEL_ID
        LEFT JOIN HRIS_REC_OPENINGS HO ON HO.OPENING_ID = NV.OPENING_ID
        -- LEFT JOIN HRIS_ACADEMIC_DEGREE HI ON HI.VACANCY_ID = NV.VACANCY_ID
        LEFT JOIN HRIS_ACADEMIC_DEGREES AD ON AD.ACADEMIC_DEGREE_ID = NV.QUALIFICATION_ID
        WHERE NV.STATUS = 'E' AND NV.VACANCY_ID = $id");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // echo '<pre>';print_r($result); die;
        return $result;
    }


    public function academicDegree($academicCode){
        $query = $this->db->query("SELECT * from HRIS_ACADEMIC_DEGREES WHERE STATUS = 'E' AND ACADEMIC_DEGREE_CODE <= '$academicCode'");
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
    public function fetch_bloodGroup(){
        $query = $this->db->query("SELECT * FROM HRIS_BLOOD_GROUPS ORDER BY BLOOD_GROUP_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function degree()
    {
        $query = $this->db->query("SELECT * FROM HRIS_ACADEMIC_DEGREES WHERE STATUS = 'E' ORDER BY ACADEMIC_DEGREE_code asc");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function faculty()
    {

        $query = $this->db->query("SELECT * FROM HRIS_ACADEMIC_PROGRAMS WHERE STATUS = 'E' ");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function major()
    {
        $query = $this->db->query("SELECT * FROM HRIS_ACADEMIC_COURSES WHERE STATUS = 'E'");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function universities()
    {
        $query = $this->db->query("SELECT * FROM HRIS_ACADEMIC_UNIVERSITY WHERE STATUS = 'E'");
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
            echo '<pre>'; print_r($esewa); die;
            $sql = "INSERT INTO HRIS_REC_APPLICATION_PAYMENT values ('$esewa')";
            $insert = $this->db->query($sql);
            return true;
    }

    public function paymentInsertWithKey($data)
    {
            $columns = implode(',', array_keys($data));
            $values  = implode('\',\'', $data);

            $sql = "INSERT INTO HRIS_REC_APPLICATION_PAYMENT ($columns) values ('$values')";
            // echo '<pre>'; print_r($sql); die;
            $insert = $this->db->query($sql);
            return true;
    }

    public function paymentUpdateWithKey($table, $data, $where, $where_value)
    {
        $columns = implode(',', array_keys($data));
        $values  = implode('\',\'', $data);

        $sql = "UPDATE $table SET ($columns) = ('$values') WHERE $where = '$where_value'";
        // echo '<pre>'; print_r($sql); die;
        // $update = $this->db->query($sql);
        return ($this->db->query($sql)) ? true : false;
    }

    // public function insertPayment($table, $data)
    // {
    //     $this->db->insert($table, $data);
    //     return true;
    // }


    /* MY METHOD TESTING FOR CONNECTIPS PAYMENT*/
    public function payment_insert_ips($data)
    {   
            $data = implode('\',\'', $data);
            // echo '<pre>'; print_r($esewa); die;
            $sql = "INSERT INTO HRIS_REC_TEMP_PAYMENT_TEST values ('$data')";
            $insert = $this->db->query($sql);
            return true;
    }
    /* MY METHOD TESTING FOR CONNECTIPS PAYMENT*/

    // Applied vacnacy Details
    public function applicationDetails($uid)
    {
        $uid   = $uid['id'];
        $query = $this->db->query("

                        SELECT 
                            NV.APPLICATION_ID, NV.REMARKS,  NV.APPLICATION_AMOUNT, NV.PAYMENT_PAID, NV.PAYMENT_VERIFIED,
                            HP.ROLL_NO, 
                            HV.AD_NO, HV.VACANCY_ID, 
                            HD.DESIGNATION_TITLE, 
                            HFL.FUNCTIONAL_LEVEL_EDESC,
                            HAS.STAGE_EDESC


                        FROM HRIS_REC_VACANCY_APPLICATION AS NV 

                        LEFT JOIN HRIS_REC_VACANCY AS HV ON NV.AD_NO = HV.VACANCY_ID
                        LEFT JOIN HRIS_FUNCTIONAL_LEVELS AS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = HV.LEVEL_ID
                        LEFT JOIN HRIS_DESIGNATIONS AS HD ON HV.POSITION_ID = HD.DESIGNATION_ID
                        LEFT JOIN HRIS_REC_STAGES AS HAS ON NV.STAGE_ID = HAS.REC_STAGE_ID
                        LEFT JOIN HRIS_REC_APPLICATION_PERSONAL AS HP ON NV.APPLICATION_ID = HP.APPLICATION_ID
                        
                        WHERE NV.STATUS = 'D' AND NV.USER_ID = $uid ORDER BY NV.APPLICATION_ID");

        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }

    /* ======================================== */
    // Applied vacnacy Details
    public function applicationDetailsRow($uid)
    {
        // echo $uid['id']; die; 
        $uid   = $uid['id'];
        $query = $this->db->query("

                        SELECT 
                            NV.APPLICATION_ID, NV.REMARKS,  NV.APPLICATION_AMOUNT,
                            HP.ROLL_NO, 
                            HV.AD_NO, HV.VACANCY_ID, 
                            HD.DESIGNATION_TITLE, 
                            HFL.FUNCTIONAL_LEVEL_EDESC,
                            HAS.STAGE_EDESC

                        FROM HRIS_REC_VACANCY_APPLICATION AS NV 

                        LEFT JOIN HRIS_REC_VACANCY AS HV ON NV.AD_NO = HV.VACANCY_ID
                        LEFT JOIN HRIS_FUNCTIONAL_LEVELS AS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = HV.LEVEL_ID
                        LEFT JOIN HRIS_DESIGNATIONS AS HD ON HV.POSITION_ID = HD.DESIGNATION_ID
                        LEFT JOIN HRIS_REC_STAGES AS HAS ON NV.STAGE_ID = HAS.REC_STAGE_ID
                        LEFT JOIN HRIS_REC_APPLICATION_PERSONAL AS HP ON NV.APPLICATION_ID = HP.APPLICATION_ID
                        
                        WHERE NV.STATUS = 'D' AND NV.USER_ID = $uid ORDER BY NV.APPLICATION_ID");

        $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        return $result;
    }

    /* ======================================== */
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
        WHERE VA.AD_NO = $vid AND VA.USER_ID = $uid AND AA.STATUS = 'E'");
        // print_r($this->db->last_query()); die;
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function ApplicationDocument($vid,$uid,$condition,$folder, $table,$order)
    {
        $query  = $this->db->query("SELECT * FROM $table WHERE VACANCY_ID = $vid AND USER_ID = $uid AND DOC_FOLDER $condition ('$folder') ORDER BY $order ASC");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function admitCardVacancy($uid,$appid){
        $query  = $this->db->query("SELECT AP.ROLL_NO,NV.AD_NO,VU.FIRST_NAME,VU.MIDDLE_NAME,VU.LAST_NAME,HD.DESIGNATION_TITLE,HFL.FUNCTIONAL_LEVEL_EDESC,HST.SERVICE_TYPE_NAME,HET.SERVICE_EVENT_NAME,HUR.CITIZENSHIP_NO from $this->apptable AS NV
        LEFT JOIN HRIS_REC_VACANCY AS RV ON RV.VACANCY_ID = NV.AD_NO
        LEFT JOIN HRIS_REC_APPLICATION_PERSONAL AS AP ON AP.APPLICATION_ID = NV.APPLICATION_ID
        LEFT JOIN HRIS_DESIGNATIONS HD ON RV.POSITION_ID = HD.DESIGNATION_ID
        LEFT JOIN HRIS_DEPARTMENTS HVD ON RV.DEPARTMENT_ID = HVD.DEPARTMENT_ID
        LEFT JOIN HRIS_SERVICE_TYPES  HST ON HST.SERVICE_TYPE_ID = RV.SERVICE_TYPES_ID
        LEFT JOIN HRIS_REC_SERVICE_EVENTS_TYPES  HET ON HET.SERVICE_EVENT_ID = RV.SERVICE_EVENTS_ID
        LEFT JOIN HRIS_FUNCTIONAL_LEVELS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = RV.LEVEL_ID
        LEFT JOIN HRIS_REC_VACANCY_USERS AS VU ON VU.USER_ID = NV.USER_ID       
        LEFT JOIN HRIS_REC_USERS_REGISTRATION AS HUR ON HUR.USER_ID = NV.USER_ID  
        where NV.USER_ID = $uid AND NV.APPLICATION_ID = $appid ORDER BY NV.APPLICATION_ID");
        // echo $this->db->last_query(); die;
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
        
    }
    public function admitCardDocument($uid,$appid){
        $query  = $this->db->query("SELECT * from hris_rec_application_documents where doc_folder not in ('skills','certificates') and user_id = $uid and application_id = $appid order by rec_doc_id");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function checkapplied($vid,$uid)
    {   
        $query = $this->db->query("SELECT * FROM HRIS_REC_VACANCY_APPLICATION WHERE AD_NO = $vid AND USER_ID = $uid");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function checkAge($uid)
    {   

        $query = $this->db->query("SELECT AGE FROM HRIS_REC_USERS_REGISTRATION WHERE USER_ID = $uid");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // // echo $this->db->last_query(); die;
        // echo '<pre>'; print_r($result[0]); die;
        return $result[0];
    }
   
    public function DeleteEdu($edid)
    {   
        $MODIFIED_DATE = DATE('Y-m-d');
        $query = $this->db->query("UPDATE HRIS_REC_APPLICATION_EDUCATION SET STATUS = 'D' , MODIFIED_DATE = '$MODIFIED_DATE' WHERE EDUCATION_ID = '$edid'");
        $result = ($this->db->affected_rows() > 0)?TRUE:FALSE;
        return $result;
    }
    public function Check($table, $column, $whereCondition,$whereValue){
        $query = $this->db->query("SELECT $column FROM $table WHERE $whereCondition = $whereValue");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // echo $this->db->last_query(); die;
        // echo '<pre>'; print_r($result[0]); die;
        return $result[0];
    }
    public function shortInstruction()
    {
        $query  = $this->db->query("SELECT * from hris_rec_instructions where INSTRUCTION_CODE = 'REC_INSTRUCTION_TOP' ");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result[0];
    }
    public function longInstruction()
    {
        $query  = $this->db->query("SELECT * from hris_rec_instructions where INSTRUCTION_CODE = 'REC_INSTRUCTION_BUTTOM' ");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result[0];
    }
    public function officeName()
    {
        $query  = $this->db->query("SELECT * from hris_rec_instructions where INSTRUCTION_CODE = 'REC_OFFICE_NAME' ");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result[0];
    }
    public function insertTempPayment($data) 
    { 
        if(!empty($data))
        { 

            $details = $data['details'];            
            
            // print_r($details);
            // die;

            $details = implode('\',\'', $details);
 

            $sql = "INSERT INTO HRIS_REC_TEMP_PAYMENT (ID,APPLICATION_ID,
            MERCHANT_ID,
            APP_ID, 
            APP_NAME,
            TXN_ID,
            TXN_DATE,
            TXN_CUR,
            AMOUNT,
            REFERENCE_ID,
            REMARKS,
            PARTICULARS,
            TOKEN,
            STATUS,STATUSDESC,CREATED_DT,MODIFIED_DT) VALUES ('$details')";

            $insert = $this->db->query($sql);   

        }
        return true;
    }

    public function getApplicationAmountpayment($id){
        $query = $this->db->query("SELECT * from hris_rec_vacancy_application where APPLICATION_ID = '{$id}' ");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result[0]['APPLICATION_AMOUNT'];
    }

    public function getTempPayment($txn)
    {
        $query = $this->db->query("SELECT * from HRIS_REC_TEMP_PAYMENT where TXN_ID = '{$txn}' AND STATUS != 'failed' ");
        $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
        return $result[0];
    }

    public function fetchAll($table)
    {
        $query = $this->db->query("SELECT * FROM {$table}");
            return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    public function fetchAllStatus($table){
        $query = $this->db->query("SELECT * FROM {$table} WHERE STATUS = '1'");
            return ($query->num_rows() > 0) ? $query->result_array() : false;
    }

    /**
     * 
     * 
     * @param fetch_type ['result', DEFAULT = 'result_array', 'row', 'row_array']
     * */
    public function fetchAllOrRowSelectWhere($table, $select, $where = NULL, $where_value = NULL, $fetch_type = 'result_array')
    {
        if (isset($select)) {

            $select = strtoupper(is_array($select) ? implode(' ,', $select) : $select);

        } else {

            // DEFAULT IS ALL
            $select = ' * ';

        }

        $statement = "SELECT " . $select . " FROM ". $table . " WHERE " . $where ."=". "'". $where_value ."'";

        $query = $this->db->query($statement);

        switch (strtolower($fetch_type)) {
            case 'result':
                return $query->result();
                break;

            case 'row_array':
                return $query->row_array();
                break;

            case 'row':
                return $query->row();
                break;
            
            default:
                return $query->result_array();
                break;
        }

    }


    public function fetchAllBySelect($table, $select)
    {   
        
        
        if (isset($select)) {

            if (is_array($select)) {
            
                $select = strtoupper(implode(' ,', $select));

            } else {

                $select = strtoupper($select);

            }

        } else {

            // DEFAULT IS ALL
            $select = ' * ';

        }
        
        $query = $this->db->query("SELECT {$select} FROM {$table}");
            return ($query->num_rows() > 0) ? $query->result_array() : false;
    }


    // GETTING APPLICANT DATA WITH VACANCY ID [AD_NO IS VACANCY_ID IN HRIS_REC_VACANCY_APPLICATION]
    function fetchVacancyAndApplicationById($aid, $vid)
    {
        $query = $this->db->query("
                            SELECT NV.*, 
                                HV.VACANCY_TYPE, HV.OPENING_ID

                            FROM $this->apptable NV 
                            LEFT JOIN HRIS_REC_VACANCY HV ON NV.AD_NO = HV.VACANCY_ID

                            WHERE NV.APPLICATION_ID = $aid AND NV.AD_NO = $vid");

        $result = ($query->num_rows() > 0) ? $query->row_array():FALSE;
        // echo '<pre>';print_r($result); die;
        return $result;
    }
}