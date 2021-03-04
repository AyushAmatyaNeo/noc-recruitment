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
        $this->db->select('*'); 
        $this->db->from($this->table);
                // ->join('HRIS_GENDERS','HRIS_GENDERS.GENDER_ID = HRIS_NOC_VACANCY_USERS.GENDER','left');
        
        if(array_key_exists("conditions", $params)){ 
            foreach($params['conditions'] as $key => $val){ 
                $this->db->where($key, $val); 
            } 
        } 
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $this->db->count_all_results(); 
        }else{ 
            if(array_key_exists("id", $params) || $params['returnType'] == 'single'){ 
                if(!empty($params['id'])){ 
                    $this->db->where('USER_ID', $params['id']); 
                } 
                $query = $this->db->get(); 
                $result = $query->row_array(); 
            }else{ 
                $this->db->order_by('USER_ID', 'desc'); 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit']); 
                } 
                 
                $query = $this->db->get(); 
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
                $data['CREATED_DT'] = DATE('d-M-Y'); 
            } 
            // if(!array_key_exists("MODIFIED_DT", $data)){ 
            //     $data['MODIFIED_DT'] = date("Y-m-d"); 
            // } 
            // echo '<pre>'; print_r($data); die;
            // Insert member data 
            $insert = $this->db->insert($this->table, $data); 
             return redirect('users/login');
            // Return the status 
            // return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    }

    public function updateuser($userData,$uid)
    {
        $this->db->where('USER_ID', $uid);
        $userData['MODIFIED_DT'] = DATE('d-M-Y'); 
        $update = $this->db->update($this->table, $userData);
        return $update;
    }

    public function getMaxId()
    {
        $this->db->select('MAX(USER_ID) AS MAXID')
                ->from('HRIS_NOC_VACANCY_USERS');
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    // Forgot Password Start
    public function forgotPassword($email)
    {
        $this->db->select('EMAIL_ID');
        $this->db->from('HRIS_NOC_VACANCY_USERS'); 
        $this->db->where('EMAIL_ID', $email); 
        $query=$this->db->get();
        return $query->row_array();
    }
    function randomPassword() 
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
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
            $this->db->where('EMAIL_ID', $email);
            $this->db->update('HRIS_NOC_VACANCY_USERS', $newpass); 
            $mail_message='Dear '.$row[0]['FIRST_NAME'].','. "\r\n";
            $mail_message.='Thanks for contacting regarding to forgot password,<br> Your <b> New Password</b> is <b>'.$passwordplain.'</b>'."\r\n";
            // $mail_message.='<br>Please Update your password.';
            $mail_message.='<br>Thanks & Regards';
            $mail_message.='<br>Nepal Oil Corporation';        
            date_default_timezone_set('Etc/UTC');
            // require FCPATH.'assets/PHPMailer/PHPMailerAutoload.php';
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
        // echo 'Failed to send password'; die;
        $this->session->set_flashdata('msg','Failed to send passwordEmail, please try again!');
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