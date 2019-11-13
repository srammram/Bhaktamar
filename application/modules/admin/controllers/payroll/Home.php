<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->mTitle = TITLE;
		$this->load->model('dashboard_model');
	}
	public function index()
	{
		//$this->load->model('user_model', 'users');
		$data['year'] = date('Y');
        // get yearly report
        if ($this->input->post('year', true)) { // if input data
            $year = $this->input->post('year', true);
            $data['year'] = $year;
        } else {
            $year = date('Y'); // present year select
            $data['year'] = $year;
        }

        $start_date = $year.'-'.'01'.'-'.'01';
        $end_date =   $year.'-'.'12'.'-'.'31';

        $data['notice'] = $this->db->order_by('id', 'desc')->get_where('payroll_notice', array(
                                                'date >=' => $start_date,
                                                'date <=' => $end_date
                                            ))->result();
       
		$this->mTitle .= lang('dashboard');
	    $this->render_admin('payroll/home');
	}


    /*** Get Yearly Report ***/
    public function get_yearly_sales_report($year)
    {

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= 1 && $i <= 9) {
                $start_date = $year.'-'.'0'.$i.'-'.'01';
                $end_date = $year.'-'.'0'.$i.'-'.'31';
            } else {
                $start_date = $year.'-'.$i.'-'.'01';
                $end_date = $year.'-'.$i.'-'.'31';
            }
            $get_all_report[$i] = $this->dashboard_model->get_all_report_by_date($start_date, $end_date);

        }

        return $get_all_report;
    }


	function addEvent()
	{

		$data['title'] = $this->input->post('title');
		$data['start'] 			= $this->input->post('start').' '.$this->input->post('startTime');
		$data['end'] 			= $this->input->post('end').' '.$this->input->post('endTime');
		$data['color'] 			= $this->input->post('color');
		$data['employee_id'] 	= $this->ion_auth->user()->row()->id;
		$data['type'] 			= 'A';
		$this->db->insert('events', $data);
		return true;
		//header('Location: '.$_SERVER['HTTP_REFERER']);
	}

	function editEventDate()
	{
		$id = $_POST['Event'][0];
		$data['start'] = $_POST['Event'][1];
		$data['end'] = $_POST['Event'][2];
		$this->db->where('id', $id);
		$this->db->update('events', $data);
		return true;
	}

	function edit_event()
	{
		$id = $this->input->post('id');
		$delete = $this->input->post('delete');
		if(isset($delete)){
			$this->db->delete('events', array('id' => $id));
			return true;
		}
		$data['title'] = $this->input->post('title');
		$data['start'] = $this->input->post('start').' '.$this->input->post('startTime');
		$data['end'] = $this->input->post('end').' '.$this->input->post('endTime');
		$data['color'] = $this->input->post('color');
		//update
		$this->db->where('id', $id);
		$this->db->update('events', $data);
		return true;
	}

	
	
}
