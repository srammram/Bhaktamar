<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Owner_Controller {

	public function __construct()
	{
		parent::__construct();
    $this->load->model(array('Dashboard_model'));
	}
	function index() {
	    $user=$this->session->userdata('owner');
	    $data['page_title']	=	lang('dashboard');
		$data['user']=$user;
	    $this->load->view('template/header',$data);
		$this->load->view('dashboard/dashboard',$data);
		$this->load->view('template/footer',$data); 
	}	
	function myunits(){
		 $data['page_title']	=	lang('myunits');
		 $Owner = $this->session->userdata('owner');
		 $data['unitrequest'] =$this->db->get_where("owner_unit_request",array("soft_delete"=>0))->result();
		 $data['activeunits'] = $activeunits = $this->Dashboard_model->get_ownerWiseUnit($Owner['owner_id']);
		 $this->render_owner('myunits/UnitList', $data);
		
	}
	
}