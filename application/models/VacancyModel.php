<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VacancyModel extends CI_Model
{
    function __construct()
    {
        $this->table = 'HRIS_REC_VACANCY';
    }

    function fetchvacancy()
    {
        $this->db->select('*')
                ->from($this->table)->where(['HRIS_DEPARTMENTS.STATUS' => 'E', 'HRIS_REC_VACANCY.STATUS' => 'E', 'HRIS_REC_VACANCY_OPTIONS.STATUS' => 'E'])
                ->join('HRIS_DEPARTMENTS','HRIS_DEPARTMENTS.DEPARTMENT_ID = HRIS_REC_VACANCY.DEPARTMENT_ID','left')
                ->join('HRIS_DESIGNATIONS','HRIS_DESIGNATIONS.DESIGNATION_ID = HRIS_REC_VACANCY.POSITION_ID','left')
                ->join('HRIS_REC_VACANCY_OPTIONS','HRIS_REC_VACANCY_OPTIONS.VACANCY_ID = HRIS_REC_VACANCY.VACANCY_ID', 'left')
                ->order_by('AD_NO', 'ASC');
        $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // echo '<pre>';print_r($result); die;
        return $result;
    }
    
}