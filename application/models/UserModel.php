<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
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
    function getRows($params = array()){ 
        $this->db->select('*'); 
        $this->db->from($this->table)
                ->join('HRIS_GENDERS','HRIS_GENDERS.GENDER_ID = HRIS_NOC_VACANCY_USERS.GENDER','left');
         
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
    public function insert($data = array()) { 
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
    
}