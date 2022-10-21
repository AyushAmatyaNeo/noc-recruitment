<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Users extends CI_Controller 
{

    private $isUserLoggedIn;

    public function __construct() 
    {
        parent::__construct(); 
         
        // Load form validation Library & user model 
        $this->load->library('form_validation'); 
        $this->load->model('UserModel');
        $this->load->model('VacancyModel');
        $this->load->helper('captcha');
        $this->load->helper('url');
        // $this->load->helper(array('form', 'url'));
        // User login status 
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    }

    // Show login page
    public function index()
    { 
        if($this->isUserLoggedIn) { 

            redirect('vacancy/vacancylist'); 
        
        } else { 
            
            redirect('users/login'); 
        
        }
    }
	
	public function login() { 

        $data = array();
		
		$data['meta'] = ['title' => 'Noc | Login'];
		$this->load->view('templates/header', $data); 
		$this->load->view('users/login_coming'); 
		$this->load->view('templates/footer', $data); 
        
        
    }

}
