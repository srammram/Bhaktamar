<?php
class FinalSheet extends Admin_Controller {
	function __construct(){		
		parent::__construct();
		$this->load->model(array('FinalSheet_model'));
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('download');
	}
	function index(){
		 $this->sma->checkPermissions();
		 $data['page_title']	= lang('Final_sheet');
		 $this->render_admin('FinalSheet/FinalSheet_list', $data);				
	}
	function getsheetlist(){
			 $actions = "<div class=\"text-center\">";
			   $actions .= " <a href='" . base_url('admin/FinalSheet/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a>";
             $actions .= "</div>";
             $this->load->library('datatables');
             $this->datatables
             ->select("project.id,Name,project_status ,COUNT(task.id) totaltask,", FALSE)
             ->from("task")
			 ->join("project","project.id=task.project_id","left")
			 ->where("task.soft_delete",0)
			 ->group_by("project.id")
             ->add_column("Actions", $actions, "project.id");
	         echo $this->datatables->generate();
	}
	function view($id,$tab=false){
		$this->sma->checkPermissions();
		$admin = $this->session->userdata('admin');
		$data['project']		     	        = $project= $this->FinalSheet_model->get_project($id);
		$data['stage']                          =$stage= $this->FinalSheet_model->get_stages($project->Project_stages);
	//	$data['material']		                = $this->FinalSheet_model->get_material(); 
	//	$data['uom']		                    = $this->FinalSheet_model->get_uom();
		$data['page_title']	                    =lang('Final_sheet') ;
	    $this->render_admin('FinalSheet/FinalSheet_view', $data);
	}
}