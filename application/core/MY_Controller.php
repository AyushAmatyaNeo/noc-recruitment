<?php

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        // echo 'My Controller'; die;
        parent::__construct();
        $this->load->model('UserModel');
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
        if($this->isUserLoggedIn){ 
             
        }else{ 
           
            redirect('users/login');
        }
    }

}

?>