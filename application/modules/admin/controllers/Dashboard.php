<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
    	$this->load->model(array('Dashboard_model'));
	}
	function index() {
	    $user=$this->session->userdata('admin');
	    $data['page_title']	=	lang('dashboard');
	    $this->load->view('template/header',$data);
		$this->load->view('dashboard/dashboard',$data);
		$this->load->view('template/footer',$data);
		
	}	
	
}