<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

class UserModel extends CI_Model{ 
    function __construct() 
    { 
        $this->table = 'HRIS_REC_VACANCY_USERS';
    } 
    /* 
     * Fetch user data from the database
     * @param array filter data based on the passed parameters 
     */ 
    function getRows($params = array())
    {
        // echo '<pre>'; print_r($params); die;
        $where = "";
        if(array_key_exists("conditions", $params)){ 
            foreach($params['conditions'] as $key => $val){ 
                
                $where.= " $key = '$val' ";
                if($key == 'PASSWORD')
                {
                    $where.= 'and';
                }                 
            }
        }
        // echo '<pre>'; print_r($where); die;
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count')
        { 
            $rawquery = $this->db->query("SELECT COUNT('*') FROM $this->table");
            $result = $rawquery->current_row;
        }else{ 
            if(array_key_exists("id", $params) || $params['returnType'] == 'single'){ 
                if(!empty($params['id']))
                { 
                     $pid = $params['id'];
                    $where.= "USER_ID = $pid";
                }
                // print_r($this->db->last_query()); die;
                $query  = $this->db->query("SELECT USER_ID,FIRST_NAME,MIDDLE_NAME,LAST_NAME,EMAIL_ID,USERNAME,MOBILE_NO FROM $this->table where $where");
                // print_r($this->db->last_query()); die;
                $result = $query->row_array();
            }else{ 
                
                $this->db->order_by('USER_ID', 'desc'); 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit']); 
                } 
                // $query  = $this->db->query("SELECT * FROM $this->table NU LEFT JOIN HRIS_GENDERS HG ON HG.GENDER_ID = NU.GENDER where 1=1 $where ");
                $query  = $this->db->query("SELECT * FROM $this->table where 1=1 $where ");
                // $query = $this->db->get($rawquery); 
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE; 
            } 
        } 
        //  echo '<pre>'; print_r($result); die;
        // Return fetched data 
        return $result; 
    } 
     
    /* 
     * Insert user data into the database 
     * @param $data data to be inserted 
     */ 
    public function insert($data = array()) 
    {
        if(!empty($data)){ 
            // Add created and modified date if not included 
            // if(!array_key_exists("CREATED_DT", $data)){ 
            //     // $data['CREATED_DT'] = date("Y-m-d");
            //     $data['CREATED_DT'] = DATE("Y-m-d"); 
            // }
            $data = implode('\',\'', $data);

            // $insert = $this->db->query("INSERT INTO $this->table (USER_ID,FIRST_NAME,MIDDLE_NAME,LAST_NAME,MOBILE_NO,EMAIL_ID,USERNAME,PASSWORD,CREATED_DT, NAME_NEPALI) values ('$data')"); 
            $insert = $this->db->query("INSERT INTO $this->table (USER_ID,FIRST_NAME,MIDDLE_NAME,LAST_NAME,MOBILE_NO,EMAIL_ID,USERNAME,PASSWORD,CREATED_DT) values ('$data')"); 
            // print_r($insert); die;
             return true;
        } 
        return false; 
    }

    public function registerUser($data = array()) 
    { 
        // echo '<pre>'; print_r(count($data)); die;
        if(!empty($data))
            { 
        // echo '<pre>'; print_r(($data)); die;
                $registration =  $data['registration'];
                $address = $data['address'];
                // echo '<pre>'; print_r(( $address)); die;
                // echo '<pre>'; print_r(($registration)); die;
                if(!empty($registration))
                { 
                    $registration = implode('\',\'', $registration);
                    $insert = $this->db->query("INSERT INTO HRIS_REC_USERS_REGISTRATION values ('$registration')");
                }
                if(!empty($address))
                { 
                    $address = implode('\',\'', $address);
                    $insert = $this->db->query("INSERT INTO HRIS_REC_USERS_ADDRESS values ('$address')");
                }
                return true;
            }

        return false; 
    }
    public function updateuser($userData,$uid)
    {
        $userData['MODIFIED_DT'] = DATE("Y-m-d"); 
        $akey = array_keys($userData);
        $keydata = implode(',', $akey);
        $aval = array_values($userData);
        $valdata = implode('\',\'', $aval);
        $update = $this->db->query("UPDATE  $this->table  SET ($keydata) = ('$valdata')  where USER_ID = $uid");
        return $update;
    }
    function email_exists2($email)
   {
        $query  = $this->db->query("SELECT * FROM $this->table where email_id = '$email'");
        if( $query->num_rows() > 0 )
        { 
        return TRUE; 
        } 
        else 
        { 
        return FALSE; 
        }
   }
   function mobile_exists2($mobile)
   {
        $query  = $this->db->query("SELECT * FROM $this->table where mobile_no = '$mobile'");
        // echo $this->db->last_query();
        if( $query->num_rows() > 0 )
        { 
        return TRUE; 
        } 
        else 
        { 
        return FALSE; 
        }
   }

   function username_exists2($username)
   {
        $query  = $this->db->query("SELECT * FROM $this->table where username = '$username'");
        // echo $this->db->last_query();
        if( $query->num_rows() > 0 )
        { 
            return TRUE; 
        } 
        else 
        { 
            return FALSE; 
        }
   }

   public function columnDataExits($column, $column_value)
   {
       $query = $this->db->query("SELECT * FROM ".$this->table." WHERE ".$column." = '".$column_value."'");

       return ($query->num_rows() > 0) ? true : false;

   }

    public function user($user_id)
    {
        if($user_id)
        {
            $query = $this->db->query("SELECT 
                FIRST_NAME,MIDDLE_NAME,LAST_NAME,MOBILE_NO,EMAIL_ID,USERNAME,AGE,CTZ_ISSUE_DATE,GENDER_NAME,FATHER_NAME,CITIZENSHIP_NO,DOB,DISTRICT_NAME,MOTHER_NAME,MARITAL_STATUS,EMPLOYMENT_STATUS,EMPLOYMENT_INPUT,DISABILITY,DISABILITY_INPUT, PHONE_NO, EMAIL_ID
                FROM HRIS_REC_VACANCY_USERS UR
                LEFT JOIN HRIS_REC_USERS_REGISTRATION HR ON HR.USER_ID = UR.USER_ID
                LEFT JOIN HRIS_GENDERS HG ON HG.GENDER_ID = HR.GENDER_ID
                LEFT JOIN HRIS_DISTRICTS HD ON HD.DISTRICT_ID = HR.CTZ_ISSUE_DISTRICT_ID
                WHERE UR.user_id = $user_id");
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
                return $result;
        }
        else
        {
            return false;
        }
    }
    // Maximum User Id from db
    public function getMaxUserId()
    {
        $query = $this->db->query("SELECT MAX(user_id) AS MAXID FROM HRIS_REC_VACANCY_USERS");
        $result = $query->row_array();
        return $result;
    }
    // Maximum Registration Id
    public function getMaxIdReg()
    {
        $query = $this->db->query("SELECT MAX(registration_id) AS MAXID FROM HRIS_REC_USERS_REGISTRATION");
        $result = $query->row_array();
        return $result;
    }
    public function getMaxIdaddress()
    {
        $query = $this->db->query("SELECT MAX(users_address_id) AS MAXID FROM HRIS_REC_USERS_ADDRESS");
        $result = $query->row_array();
        return $result;
    }
    // Forgot Password Start
    public function forgotPassword($email)
    {
        $query = $this->db->query("SELECT EMAIL_ID FROM $this->table WHERE EMAIL_ID = '$email'");
        return $query->row_array();
    }
    function randomPassword() 
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 10; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    /**
     * 
     * SEND PASSWORD AS FORGOT AND SEND EMAIL
     * 
     * */
    public function sendpassword($data)
    {

        $email = $data['EMAIL_ID'];

        $findEmail = $this->db->query("SELECT *  from $this->table where EMAIL_ID = '".$email."' ");

        $result = $findEmail->row_array();

        if ($findEmail->num_rows() > 0)        
        {

            $plainPassword = $this->randomPassword();
            $newPassword['PASSWORD'] = $plainPassword;

            $updateNewPassword = $this->db->query("UPDATE $this->table 
                                                   SET PASSWORD = '$plainPassword', RESET_STATUS = TRUE 
                                                   WHERE EMAIL_ID = '$email'");

            /* ---- CREATING EMAIL MESSAGE ---- */
            $mail_message = 'Dear '.ucwords($result['FIRST_NAME']).','. "<br \><br \>";
            $mail_message.='Thanks for contacting regarding to forgot password,<br> Your <b> New Password</b> is <b>'.$plainPassword.'</b>'."<br \><br \>";
            // $mail_message.='<br>Please Update your password.';
            $mail_message.='<br>Thanks & Regards';
            $mail_message.='<br>Nepal Oil Corporation';

            date_default_timezone_set('Asia/Kathmandu');

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Priority = 1;
            $mail->SMTPSecure = "tls"; 
            $mail->Debugoutput = 'html';
            $mail->Host = "smtp.ionos.com";
            $mail->Port = 587;
            $mail->SMTPAuth = true;   
            $mail->Username = "bidhya.singh@neosoftware.com.np";
            // $mail->Username = "jasmin.tamang@neosoftware.com.np";
            $mail->Password = "Bidhya@@Singh123";
            // $mail->Password = "Jasmin@12345#";
            $mail->setFrom('bidhya.singh@neosoftware.com.np', 'NOC');
            // $mail->setFrom('jasmin.tamang@neosoftware.com.np', 'NOC');
            $mail->IsHTML(true);
            $mail->addAddress($email);
            $mail->Subject = 'OTP from NOC';
            $mail->Body    = $mail_message;
            $mail->AltBody = $mail_message;


            if (!$mail->send()) 
            {
                
                $this->session->set_flashdata('msg','Failed to send password Email, please try again!');
                    redirect(base_url().'users/forgotpassword','refresh');        
            
            } else {
            
                $this->session->set_flashdata('msg_success','Password sent to your email!');
                    redirect(base_url().'users/login','refresh');        

            }
            
        
        } else {

            $this->session->set_flashdata('msg','Email not found try again!');
                redirect(base_url().'users/forgotpassword','refresh');

        }

    }
    // Forgot password End --
    public function userDetails($params = array())
    {


        $where = "";

        if ( array_key_exists("conditions", $params) ) { 

            foreach ( $params['conditions'] as $key => $val ) { 
                
                $where.= "and $key = '$val'"; 
            
            }
        
        }

        if ( array_key_exists("returnType", $params) && $params['returnType'] == 'count' ) { 

            $rawquery = $this->db->query("SELECT COUNT('*') FROM $this->table");
            $result   = $rawquery->current_row;

        } else { 

            if ( array_key_exists("id", $params) || $params['returnType'] == 'single' ) { 


                if ( !empty($params['id']) ) { 

                    $pid   = $params['id'];
                    $where.= "HU.USER_ID = $pid";

                } 

                $query = $this->db->query("SELECT 
                        HU.FIRST_NAME, HU.MIDDLE_NAME, HU.LAST_NAME, HU.MOBILE_NO, HU.EMAIL_ID, HU.USERNAME,  HU.NAME_NEPALI,
                        HUR.REGISTRATION_ID, HUR.USER_ID, HUR.RELIGION, HUR.RELIGION_INPUT, HUR.REGION, HUR.REGION_INPUT, HUR.ETHNIC_NAME, HUR.ETHNIC_INPUT, 
                        HUR.MOTHER_TONGUE, HUR.CITIZENSHIP_NO, HUR.CTZ_ISSUE_DATE, HUR.CTZ_ISSUE_DISTRICT_ID, HUR.DOB, HUR.AGE, HUR.PHONE_NO, HUR.GENDER_ID,
                        HUR.FATHER_NAME, HUR.FATHER_QUALIFICATION, HUR.MOTHER_NAME, HUR.MOTHER_QUALIFICATION, HUR.FM_OCCUPATION, HUR.FM_OCCUPATION_INPUT, HUR.GRANDFATHER_NAME,
                        HUR.GRANDFATHER_NATIONALITY, HUR.SPOUSE_NAME, HUR.SPOUSE_NATIONALITY, HUR.PROFILE_STATUS, HUR.MARITAL_STATUS, HUR.EMPLOYMENT_STATUS, 
                        HUR.EMPLOYMENT_INPUT, HUR.CTZ_ISSUE_DATE_AD, HUR.DOB_AD,
                        (CASE 
                            WHEN HUR.IN_SERVICE = 'Y' THEN 'YES' ELSE 'NO' 
                        END) AS IN_SERVICE,
                        HUR.DISABILITY, HUR.DISABILITY_INPUT, HUR.STATUS, HUR.CREATED_DT, HUR.MODIFIED_DT,

                        BG.BLOOD_GROUP_CODE as BLOOD_GROUP, BG.BLOOD_GROUP_ID,
                        HG.*,
                        HD.*,
                        HUA.*,
                        HP.PROVINCE_NAME AS PER_PROVINCE,
                        HP1.PROVINCE_NAME AS MAIL_PROVINCE,
                        HD1.DISTRICT_NAME AS PER_DISTRICT,
                        HD2.DISTRICT_NAME AS MAIL_DISTRICT,
                        HM1.VDC_MUNICIPALITY_NAME AS PER_VDC,
                        HM2.VDC_MUNICIPALITY_NAME AS MAIL_VDC

                        FROM $this->table HU

                        LEFT JOIN HRIS_REC_USERS_REGISTRATION HUR ON HUR.USER_ID = HU.USER_ID
                        LEFT JOIN HRIS_REC_USERS_ADDRESS HUA ON HUA.USER_ID = HU.USER_ID
                        LEFT JOIN HRIS_GENDERS AS HG ON HG.GENDER_ID = HUR.GENDER_ID
                        LEFT JOIN HRIS_DISTRICTS AS HD ON HD.DISTRICT_ID = HUR.CTZ_ISSUE_DISTRICT_ID                
                        LEFT JOIN HRIS_PROVINCES AS HP ON HP.PROVINCE_ID = HUA.PER_PROVINCE_ID
                        LEFT JOIN HRIS_PROVINCES AS HP1 ON HP1.PROVINCE_ID = HUA.MAIL_PROVINCE_ID
                        LEFT JOIN HRIS_DISTRICTS AS HD1 ON HD1.DISTRICT_ID = HUA.PER_DISTRICT_ID
                        LEFT JOIN HRIS_DISTRICTS AS HD2 ON HD2.DISTRICT_ID = HUA.MAIL_DISTRICT_ID
                        LEFT JOIN HRIS_VDC_MUNICIPALITIES AS HM1 ON HM1.VDC_MUNICIPALITY_ID = HUA.PER_VDC_ID
                        LEFT JOIN HRIS_VDC_MUNICIPALITIES AS HM2 ON HM2.VDC_MUNICIPALITY_ID = HUA.MAIL_VDC_ID
                        LEFT JOIN HRIS_BLOOD_GROUPS AS BG ON BG.BLOOD_GROUP_ID = HUR.BLOOD_GROUP
                        WHERE $where ");
                        // echo $this->db->last_query();
                        $result = $query->row_array();

            } else { 
                
                $this->db->order_by('USER_ID', 'desc'); 

                if ( array_key_exists("start",$params) && array_key_exists("limit",$params) ) { 
                   
                    $this->db->limit($params['limit'],$params['start']); 
                
                } elseif ( !array_key_exists("start",$params) && array_key_exists("limit",$params) ) { 
                    
                    $this->db->limit($params['limit']); 
                
                } 

                // $query  = $this->db->query("SELECT * FROM $this->table NU LEFT JOIN HRIS_GENDERS HG ON HG.GENDER_ID = NU.GENDER where 1=1 $where ");
                $query  = $this->db->query("SELECT * FROM $this->table where 1=1 $where ");
                // $query = $this->db->get($rawquery); 

                $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE; 
            } 
        } 
        return $result; 
    }
    public function userdocuments($params = array()){
        $where = "";
        if(array_key_exists("conditions", $params)){ 
            foreach($params['conditions'] as $key => $val){ 
                $where.= "and $key = '$val'"; 
            }
        }
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count')
        { 
            // $rawquery = $this->db->query("SELECT COUNT('*') FROM $this->table");
            // $result = $rawquery->current_row;
        }else{ 
            if(array_key_exists("id", $params) || $params['returnType'] == 'single'){ 
                if(!empty($params['id']))
                { 
                     $pid = $params['id'];
                    $where.= "and HU.USER_ID = $pid";
                } 
                $query  = $this->db->query("SELECT 
                HAD.DOC_OLD_NAME AS DOC_NAME,
                HAD.DOC_PATH AS DOC_PATH,
                HAD.DOC_FOLDER AS DOC_FOLDER
                FROM $this->table HU
                LEFT JOIN HRIS_REC_USERS_REGISTRATION HUR ON HUR.USER_ID = HU.USER_ID
                LEFT JOIN HRIS_REC_APPLICATION_DOCUMENTS AS HAD ON HAD.USER_ID = HUR.USER_ID 
                where HAD.DOC_FOLDER in ('ethnicity','disability','in_service') $where ");
                // echo $this->db->last_query();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        } 
        return $result; 
    }
    public function updateprofile($userData,$uid)
    {
        if(!empty($userData))
        {
            $users        = $userData['users'];
            $registration = $userData['registration'];
            $address      = $userData['address'];
            // echo "<pre>"; print_r($registration); die;
            // echo "<pre>"; print_r($address); die;
            if(!empty($users))
            {

                $users['MODIFIED_DT'] = DATE("Y-m-d");
                $akey = array_keys($users);
                $keydata = implode(',', $akey);
                $aval = array_values($users);
                $valdata = implode('\',\'', $aval);
                // echo "<pre>"; print_r($keydata); die;
                $update = $this->db->query("UPDATE  $this->table  SET ($keydata) = ('$valdata')  where USER_ID = $uid");
                // return true;
            }

            if(!empty($registration))
            {
           
                $users['MODIFIED_DT'] = DATE("Y-m-d");
                $akey = array_keys($registration);
                $keydata = implode(',', $akey);
                $aval = array_values($registration);
                $valdata = implode('\',\'', $aval);
                // echo "<pre>"; print_r($registration); echo "<br>";
                // echo "<pre>"; print_r($keydata); echo "<br>";
                // echo "<pre>"; print_r($valdata); die;
                // echo "<pre>"; print_r("UPDATE HRIS_REC_USERS_REGISTRATION  SET ($keydata) = ('$valdata')  where USER_ID = $uid"); die;
                $update = $this->db->query("UPDATE HRIS_REC_USERS_REGISTRATION  SET ($keydata) = ('$valdata')  where USER_ID = '$uid'");
                // return true;
            }
            if(!empty($address))
            {
                $users['MODIFIED_DT'] = DATE("Y-m-d");
                $akey = array_keys($address);
                $keydata = implode(',', $akey);
                $aval = array_values($address);
                $valdata = implode('\',\'', $aval);
                // echo "<pre>"; print_r($keydata); die;
                //  echo "<pre>"; print_r($keydata); echo "<br>";
                // echo "<pre>"; print_r($valdata); die;
                $update = $this->db->query("UPDATE HRIS_REC_USERS_ADDRESS  SET ($keydata) = ('$valdata')  where USER_ID = $uid");
                // return true;
            }
            return true;
        }
        return false;
    }
    // For Profile Edit page -- Address fields
    public function fetch_user_district($province_id,$district_id)
    {   
        $query = $this->db->query("SELECT * FROM HRIS_DISTRICTS WHERE PROVINCE_ID = $province_id ORDER BY DISTRICT_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        $output = '<option value="" > Select District </option>';
        // $output = '<option value="" > '.$district_name. ' </option>';
        foreach($result as $row)
        {
            $selected = ($row['DISTRICT_ID'] == $district_id) ? "selected" : "";
            $output .= '<option '. $selected .' value="'.$row['DISTRICT_ID'].'">'.$row['DISTRICT_NAME'].'</option>';

        }
        return $output;
    }
    public function fetch_user_vdc($district_id,$vdc_id)
    {
        $query = $this->db->query("SELECT * FROM HRIS_VDC_MUNICIPALITIES WHERE DISTRICT_ID = $district_id ORDER BY VDC_MUNICIPALITY_ID");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        $output = '<option value="" > Select Municipality </option>';
        foreach($result as $row)
        {
            $selected = ($row['VDC_MUNICIPALITY_ID'] == $vdc_id) ? "selected" : "";
            $output .= '<option '. $selected .' value="'.$row['VDC_MUNICIPALITY_ID'].'">'.$row['VDC_MUNICIPALITY_NAME'].'</option>';
        }
        return $output;
    }
    // Check if user is registred or not
    public function userRegistred($uid)
    {
        if($uid == ''){
            return FALSE;
        }
        $query  = $this->db->query("SELECT * FROM HRIS_REC_USERS_REGISTRATION where USER_ID = '$uid' AND PROFILE_STATUS = '1'");
        if( $query->num_rows() > 0 ){ 
            return TRUE; 
        }else{ 
            return FALSE; 
        }
    }
    public function userApplied()
    {
        $query  = $this->db->query("SELECT * FROM HRIS_REC_VACANCY_APPLICATION where USER_ID = '$uid' AND AD_NO = '1'");
        // echo $this->db->last_query();
        if( $query->num_rows() > 0 )
        { 
        return TRUE; 
        } 
        else 
        { 
        return FALSE; 
        }
    }
    //Check old password for password update page
    public function checkpw($data,$uid)
    {
        // echo $data; die;
        $query = $this->db->query("SELECT * FROM $this->table where password = '$data' AND USER_ID = $uid");
        if($query->num_rows() > 0)
        {
            return true;
        }else
        {
            return false;
        }
    }
    public function updatepw($uid,$newpw)
    {
        $query = $this->db->query("UPDATE $this->table SET (PASSWORD,RESET_STATUS) = ('$newpw',false) where USER_ID = $uid");
        return true;
    }
    //Check if user has requested pw and not been updated.
    public function checkpwResetstatus($uid)
    {
        $query = $this->db->query("SELECT RESET_STATUS FROM $this->table WHERE USER_ID = $uid");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    // Check account active status
    public function checkactivestatus($params = array())
    {
        // echo '<pre>'; print_r($params); die;
        if(array_key_exists("email", $params)){ 
            if(isset($params['email']['EMAIL_ID'])){
                $email_id = $params['email']['EMAIL_ID'];
                $query = $this->db->query("SELECT ACTIVE_STATUS FROM $this->table WHERE EMAIL_ID = '$email_id'");
                // print_r($query); die;
                $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
                return $result;
            }else{
                $username = $params['email']['USERNAME'];
                $query = $this->db->query("SELECT ACTIVE_STATUS FROM $this->table WHERE USERNAME = '$username'");
                // print_r($query); die;
                $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
                return $result;
            }
        }
        
    }
    // Check db values: like: age,inclusion etc
    public function checkattribute($table, $column,$uid)
    {
        // $uid = ($uid )? '0': '';
        $query = $this->db->query("SELECT $column FROM $table WHERE USER_ID = $uid");
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function checkattributes($table, $column,$aid,$wid)
    {   

        // $uid = ($uid )? '0': '';
        $query = $this->db->query("SELECT $column FROM $table WHERE $aid = '$wid'");
        // echo $this->db->last_query();
        $result = ($query->num_rows() > 0) ? TRUE : FALSE;
        return $result;
    }

    public function checkattributesWithStatus($table, $column,$aid,$wid, $status, $status_value)
    {   

        // $uid = ($uid )? '0': '';
        $query = $this->db->query("SELECT $column FROM $table WHERE $aid = '$wid' AND $status = '$status_value'");
        // echo $this->db->last_query();
        $result = ($query->num_rows() > 0) ? TRUE : FALSE;
        return $result;
    }

    public function userVacancyApplicationPaymentCheck($uid)
    {
        $uid   = (is_array($uid) ? $uid['id'] : $uid);
        $query = $this->db->query("
                        SELECT 
                            NV.APPLICATION_ID, NV.APPLICATION_AMOUNT,
                            AP.USER_ID, AP.PAYMENT_TYPE, AP.PAYMENT_NPR, AP.PAYMENT_EID, AP.PAYMENT_RFID, AP.STATUS

                        FROM HRIS_REC_VACANCY_APPLICATION AS NV 

                        LEFT JOIN HRIS_REC_APPLICATION_PAYMENT AS AP ON NV.USER_ID = AP.USER_ID
                        -- LEFT JOIN HRIS_FUNCTIONAL_LEVELS AS  HFL ON HFL.FUNCTIONAL_LEVEL_ID = HV.LEVEL_ID
                        -- LEFT JOIN HRIS_DESIGNATIONS AS HD ON HV.POSITION_ID = HD.DESIGNATION_ID
                        -- LEFT JOIN HRIS_REC_STAGES AS HAS ON NV.STAGE_ID = HAS.REC_STAGE_ID
                        -- LEFT JOIN HRIS_REC_APPLICATION_PERSONAL AS HP ON NV.APPLICATION_ID = HP.APPLICATION_ID
                        
                        WHERE AP.USER_ID = $uid AND AP.STATUS = 1");

        $result = ($query->num_rows() > 0) ? $query->result_array():FALSE;
        return $result;
    }


    public function checkattributesByStatus($table, $column, $aid, $wid)
    {   

        // $uid = ($uid )? '0': '';
        $query = $this->db->query("SELECT $column FROM $table WHERE $aid = '$wid'");
        // echo $this->db->last_query();
        $result = $query->row_array();
        return $result;
    }

    /**
     *  EMAIL VERIFICATION 
     * 
     * */
    public function sendVerificationEmail($email)
    {

        $findEmailQuery = $this->db->query("SELECT * from $this->table where EMAIL_ID = '".$email."' ");
        
        $row            = $findEmailQuery->result_array();
                
        $textplain      = $this->EmailrandomText();

        if ( $row ) {

            $query     = $this->db->query("UPDATE $this->table SET (EMAIL_VERIFICATION_CODE, ACTIVE_STATUS) = ('$textplain','D') WHERE EMAIL_ID = '$email'");
            $mail_message='Dear '.$row[0]['FIRST_NAME'].','. "<br \><br \>";
            $mail_message.='Thanks for signup to Nepal Oil Corporation,<br> Your <b> verification link </b> is below : <br \><br \><a href="'.base_url('users/verify?evc='.$textplain.'&email='.$row[0]['EMAIL_ID']).'">Activate Account</a>';
            // $mail_message.='<br>Please Update your password.';
            $mail_message.='<br>Thanks & Regards';
            $mail_message.='<br>Nepal Oil Corporation';        
            date_default_timezone_set('Asia/Kathmandu');
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Priority = 1;
            $mail->SMTPSecure = "tls"; 
            $mail->Debugoutput = 'html';
            $mail->Host = "smtp.ionos.com";
            $mail->Port = 587;
            $mail->SMTPAuth = true;   
            $mail->Username = "bidhya.singh@neosoftware.com.np";
                // $mail->Username = "jasmin.tamang@neosoftware.com.np";
            $mail->Password = "Bidhya@@Singh123";
            // $mail->Password = "Jasmin@12345#";
            $mail->setFrom('bidhya.singh@neosoftware.com.np', 'Nepal Oil Corporation');
                // $mail->setFrom('jasmin.tamang@neosoftware.com.np', 'NOC');
            $mail->IsHTML(true);
            $mail->addAddress($email);
            $mail->Subject = 'Verification Link | NOC';
            $mail->Body    = $mail_message;
            $mail->AltBody = $mail_message;

            return (!$mail->send()) ? false : true;
        } 

        return false;
        

        

    }


    function verifyEmailAddress($verificationText, $email){
        $sql = $this->db->query("SELECT EMAIL_VERIFICATION_CODE FROM $this->table where EMAIL_ID = '$email'");
        $row=$sql->result_array();
        if($row[0]['EMAIL_VERIFICATION_CODE'] === $verificationText){
            $this->db->query("UPDATE $this->table SET ACTIVE_STATUS = 'E' where EMAIL_ID = '$email'");
            return true;
        }else{
            return false;
        }
        // echo '<pre>'; print_r($row); die;
    }
    function EmailrandomText() 
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz!@$%^*()ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 30; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    public function insertimg($image)
    {
        // echo '<pre>'; print_r(($image)); die;
        if(!empty($image)){ 
            $image = implode('\',\'', $image);
            // echo '<pre>'; print_r(($image)); die;
            $insert = $this->db->query("INSERT INTO HRIS_REC_APPLICATION_DOCUMENTS (REC_DOC_ID,USER_ID,DOC_OLD_NAME,DOC_NEW_NAME,DOC_PATH,DOC_TYPE,DOC_FOLDER)
            values ('$image')");
            return true;
        }
        else{
            return false;
        }
    }
    public function FindAndDelImg($uid,$folder_name){

        $query = $this->db->query("SELECT * FROM HRIS_REC_APPLICATION_DOCUMENTS WHERE DOC_FOLDER = '$folder_name' AND USER_ID = $uid");
        $result['oldimg'] = ($query->num_rows() > 0) ? ($query->row_array()):FALSE;
        $result['status'] = 0;
        // echo'<pre>'; print_r($result) ; die;
        if($query->num_rows() > 0) {
            // echo ' ffff'; die;
            $query = $this->db->query("DELETE FROM HRIS_REC_APPLICATION_DOCUMENTS WHERE DOC_FOLDER = '$folder_name' AND USER_ID = $uid");
            $result['status'] = ($this->db->affected_rows() > 0) ? TRUE : FALSE;
            // $result['status'] = true;
            return $result;
        }
        return $result;
    }

    public function FindAndDelImgName($uid, $folder_name){

        $query = $this->db->query("SELECT * FROM HRIS_REC_APPLICATION_DOCUMENTS WHERE DOC_OLD_NAME = '$folder_name' AND USER_ID = $uid");
        $result['oldimg'] = ($query->num_rows() > 0) ? ($query->row_array()):FALSE;
        $result['status'] = 0;
        // echo'<pre>'; print_r($result) ; die;
        if($query->num_rows() > 0) {
            // echo ' ffff'; die;
            $query = $this->db->query("DELETE FROM HRIS_REC_APPLICATION_DOCUMENTS WHERE DOC_OLD_NAME = '$folder_name' AND USER_ID = $uid");
            $result['status'] = ($this->db->affected_rows() > 0) ? TRUE : FALSE;
            // $result['status'] = true;
            return $result;
        }
        return $result;
    }
}