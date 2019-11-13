<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');
        $this->load->model('global_model');
        $this->load->model('crud_model', 'crud');
        $this->load->model('report_model', 'report');
        $this->load->model('attendance_model');
        $this->load->library('grocery_CRUD');
        $this->mTitle = TITLE;
    }

    function index()
    {
         $this->mViewData['logs']=$this->db->query("SELECT  l.id  ,STATUS,  message,user_id,created_at,Table_name,Table_row_id ,username FROM logs l
            LEFT JOIN admin_users au ON au.id=l.user_id
            ORDER BY id DESC")->result();
	     $this->render('report/Logs');
    }

}