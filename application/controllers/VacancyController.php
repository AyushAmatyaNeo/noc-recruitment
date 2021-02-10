<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VacancyController extends CI_Controller
{
    function __construct()
    {
        

    }

    function index()
    {
        $this->load->database();
        $this->load->model('VacancyModel');
        $data['h'] = $this->VacancyModel->fetchvacancy();
        print_r($data['h']); die;
        $this->load->view('pages/vacancylist', $data);
    }
}