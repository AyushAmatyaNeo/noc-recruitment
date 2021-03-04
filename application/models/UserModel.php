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
        // Set table name 
        $this->table = 'HRIS_NOC_VACANCY_USERS';
    } 
    /* 
     * Fetch user data from the database 
     * @param array filter data based on the passed parameters 
     */ 
    function getRows($params = array())
    {
        $where = "";
        if(array_key_exists("conditions", $params)){ 
            foreach($params['conditions'] as $key => $val){ 
                $where.= "and $key = '$val'"; 
            }
        }
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count')
        { 
            $rawquery = $this->db->query("SELECT COUNT('*') FROM HRIS_NOC_VACANCY_USERS");
            $result = $rawquery->current_row;
        }else{ 
            if(array_key_exists("id", $params) || $params['returnType'] == 'single'){ 
                if(!empty($params['id']))
                { 
                     $pid = $params['id'];
                    $where.= "and USER_ID = $pid";
                } 
                $query  = $this->db->query("SELECT * FROM HRIS_NOC_VACANCY_USERS NU LEFT JOIN HRIS_GENDERS HG ON HG.GENDER_ID = NU.GENDER where 1=1 $where ");
                $result = $query->row_array();
            }else{ 
                
                $this->db->order_by('USER_ID', 'desc'); 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit']); 
                } 
                $query  = $this->db->query("SELECT * FROM HRIS_NOC_VACANCY_USERS NU LEFT JOIN HRIS_GENDERS HG ON HG.GENDER_ID = NU.GENDER where 1=1 $where ");
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
            if(!array_key_exists("CREATED_DT", $data)){ 
                // $data['CREATED_DT'] = date("Y-m-d");
                $data['CREATED_DT'] = DATE("Y-m-d"); 
            }
            $data = implode('\',\'', $data);

            $insert = $this->db->query("INSERT INTO $this->table values ('$data','')"); 
            // print_r($insert); die;
             return redirect('users/login');
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

    public function getMaxId()
    {
        $query = $this->db->query("SELECT MAX(USER_ID) AS MAXID FROM HRIS_NOC_VACANCY_USERS");
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
    public function sendpassword($data)
    {
            $email = $data['EMAIL_ID'];
            $query1=$this->db->query("SELECT *  from HRIS_NOC_VACANCY_USERS where EMAIL_ID = '".$email."' ");
            $row=$query1->result_array();
        if ($query1->num_rows()>0)        
        {
            $passwordplain = "";
            $passwordplain  = $this->randomPassword();
            $newpass['PASSWORD'] = ($passwordplain);
            $query = $this->db->query("UPDATE $this->table SET PASSWORD = '$passwordplain' where EMAIL_ID = '$email'");
            $mail_message='Dear '.$row[0]['FIRST_NAME'].','. "<br \><br \>";
            $mail_message.='Thanks for contacting regarding to forgot password,<br> Your <b> New Password</b> is <b>'.$passwordplain.'</b>'."<br \><br \>";
            // $mail_message.='<br>Please Update your password.';
            $mail_message.='<br>Thanks & Regards';
            $mail_message.='<br>Nepal Oil Corporation';        
            date_default_timezone_set('Etc/UTC');
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPSecure = "tls"; 
            $mail->Debugoutput = 'html';
            $mail->Host = "smtp.ionos.com";
            $mail->Port = 587;
            $mail->SMTPAuth = true;   
            $mail->Username = "info@leantask.com";    
            $mail->Password = "JI(o)u89p77g&";
            $mail->setFrom('info@leantask.com', 'NOC');
            $mail->IsHTML(true);
            $mail->addAddress($email);
            $mail->Subject = 'OTP from NOC';
            $mail->Body    = $mail_message;
            $mail->AltBody = $mail_message;
        if (!$mail->send()) 
        {
            $this->session->set_flashdata('msg','Failed to send password Email, please try again!');
        } else 
        {
            
        $this->session->set_flashdata('msg','Password sent to your email!');
        }
        redirect(base_url().'users/Login','refresh');        
        }
        else
        {  
        $this->session->set_flashdata('msg','Email not found try again!');
        redirect(base_url().'users/Login','refresh');
        }
    }
    // FOrgot password End --
}