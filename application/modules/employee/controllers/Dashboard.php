<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Employee_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	function index() {
	      $user=$this->session->userdata('employee');
	    $data['page_title']	=	lang('dashboard');
		$data['user']=$user;
		$this->render_employee('dashboard/dashboard',$data); 
		
		
	}	
	
}