<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Tenant_Controller {
   public function __construct(){
		parent::__construct();
    $this->load->model(array('Dashboard_model'));
	}
	function index() {
	    $tenant=$this->session->userdata('tenant');
	    $data['page_title']	=	lang('dashboard');
		$data['user']=$tenant;
	    $this->load->view('template/header',$data);
		$this->load->view('dashboard/dashboard',$data);
		$this->load->view('template/footer',$data); 
	}	
	function myunits(){
		 $data['page_title']	=	lang('myunits');
		 $tenant = $this->session->userdata('tenant');
		 $data['unitrequest'] =$this->db->get_where("owner_unit_request",array("soft_delete"=>0))->result();
		 $data['activeunits'] = $activeunits = $this->Dashboard_model->get_ownerWiseUnit($tenant['owner_id']);
		 $this->render_owner('myunits/UnitList', $data);
		
	}
	
}