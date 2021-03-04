<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VacancyModelCopy extends CI_Model
{
    function __construct()
    {
        $this->table = 'HRIS_REC_VACANCY';
    }

    function fetchvacancy()
    {
        $sql = "SELECT * FROM $this->table WHERE $this->table.STATUS = 'E'";
        $query = $this->db->query($sql);

        // $this->db->query()
        // $this->db->select('*')
        //         // ->from($this->table)->where(['HRIS_DEPARTMENTS.STATUS' => 'E', 'HRIS_REC_VACANCY.STATUS' => 'E', 'HRIS_REC_VACANCY_OPTIONS.STATUS' => 'E'])
        //         ->from($this->table)->where(['HRIS_DEPARTMENTS.STATUS' => 'E', 'HRIS_REC_VACANCY.STATUS' => 'E','HRIS_REC_VACANCY_FILES.STATUS' => 'E'])
        //         ->join('HRIS_DEPARTMENTS','HRIS_DEPARTMENTS.DEPARTMENT_ID = HRIS_REC_VACANCY.DEPARTMENT_ID','left')
        //         ->join('HRIS_DESIGNATIONS','HRIS_DESIGNATIONS.DESIGNATION_ID = HRIS_REC_VACANCY.POSITION_ID','left')
        //         // ->join('HRIS_REC_VACANCY_OPTIONS','HRIS_REC_VACANCY_OPTIONS.VACANCY_ID = HRIS_REC_VACANCY.VACANCY_ID', 'left')
        //         ->join('HRIS_REC_VACANCY_FILES','HRIS_REC_VACANCY_FILES.VACANCY_ID = HRIS_REC_VACANCY.VACANCY_ID', 'left')
        //         ->order_by('AD_NO', 'ASC');
        // $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // echo '<pre>';print_r($result); die;
        return $result;
    }

    function fetchVacancyById($id)
    {
        $this->db->select('*')
                ->from($this->table)->where(['HRIS_DEPARTMENTS.STATUS' => 'E', 'HRIS_REC_VACANCY.STATUS' => 'E','HRIS_REC_VACANCY.VACANCY_ID' => $id])
                ->join('HRIS_DEPARTMENTS','HRIS_DEPARTMENTS.DEPARTMENT_ID = HRIS_REC_VACANCY.DEPARTMENT_ID','left')
                ->join('HRIS_DESIGNATIONS','HRIS_DESIGNATIONS.DESIGNATION_ID = HRIS_REC_VACANCY.POSITION_ID','left')
                // ->join('HRIS _REC_VACANCY_OPTIONS','HRIS_REC_VACANCY_OPTIONS.VACANCY_ID = HRIS_REC_VACANCY.VACANCY_ID', 'left')
                ->join('HRIS_REC_VACANCY_FILES','HRIS_REC_VACANCY_FILES.VACANCY_ID = HRIS_REC_VACANCY.VACANCY_ID', 'left')
                ->order_by('AD_NO', 'ASC');
        $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        // echo '<pre>';print_r($result); die;
        return $result;
    }

    function fetchvacancyold()
    {
        $rawsql = 'SELECT * FROM '.$this->table.' ';
        $query = $this->db->query($rawsql);
        // $this->db->select('*')
        //         ->from($this->table)->where(['HRIS_DEPARTMENTS.STATUS' => 'E', 'HRIS_REC_VACANCY.STATUS' => 'D', 'HRIS_REC_VACANCY_OPTIONS.STATUS' => 'E'])
        //         ->join('HRIS_DEPARTMENTS','HRIS_DEPARTMENTS.DEPARTMENT_ID = HRIS_REC_VACANCY.DEPARTMENT_ID','left')
        //         ->join('HRIS_DESIGNATIONS','HRIS_DESIGNATIONS.DESIGNATION_ID = HRIS_REC_VACANCY.POSITION_ID','left')
        //         ->join('HRIS_REC_VACANCY_OPTIONS','HRIS_REC_VACANCY_OPTIONS.VACANCY_ID = HRIS_REC_VACANCY.VACANCY_ID', 'left')
        //         ->join('HRIS_REC_VACANCY_FILES','HRIS_REC_VACANCY_FILES.VACANCY_ID = HRIS_REC_VACANCY.VACANCY_ID', 'left')
        //         ->order_by('AD_NO', 'ASC');
        // $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    public function fetchOptionByid($vid)
    {
        $this->db->select('*')
                ->from('HRIS_REC_VACANCY_OPTIONS')->where(['HRIS_REC_VACANCY_OPTIONS.STATUS' => 'E','HRIS_REC_OPTIONS.STATUS' => 'E', 'VACANCY_ID' => $vid])
                ->join('HRIS_REC_OPTIONS','HRIS_REC_OPTIONS.OPTION_ID = HRIS_REC_VACANCY_OPTIONS.OPTION_ID', 'left');
        $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        return $result;
    }
    
}