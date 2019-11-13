<?php
class Costing extends Admin_Controller {
	function __construct(){		
		parent::__construct();
		$this->load->model(array('Costing_model'));
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('download');
	}
	function index(){
		 $this->sma->checkPermissions();
		 $data['page_title']	= lang('Costing');
		 $this->render_admin('Costing/costing_list', $data);				
	}
	function getcosting(){
			 $actions = "<div class=\"text-center\">";
      
         $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("costing.id,taskName,project.Name project,soc.Name soc,refno,date,costing.status", FALSE)
            ->from("costing")
			->join("project","project.id=costing.project_id","left")
			->join("soc","soc.id=costing.stage_id","left")
			->join("task","task.id=costing.task_id","left")
			->where("costing.soft_delete",0)
            ->add_column("Actions", $actions, "costing.id");
	         echo $this->datatables->generate();
	}
	function view($id,$tab=false){
		$this->sma->checkPermissions();
		$admin = $this->session->userdata('admin');
		$data['costing_details']		     	= $costing=	$this->Costing_model->get($id);
		$data['costing_worksheet']		    = $worksheet=	$this->Costing_model->get_worksheet($costing->id);
		$data['task']                           = $this->Costing_model->get_stagesWiseTask($costing->project_id,$costing->stage_id);
	    $data['stage']                          = $this->Costing_model->get_stages($costing->project_id);
		$data['material']		                = $this->Costing_model->get_material(); 
		$data['uom']		                    = $this->Costing_model->get_uom();
		$data['page_title']	                    = lang('view')." ".lang('Estimation') ;
	    $this->render_admin('Costing/costing_view', $data);
	}
	function form($id = false){
		$this->sma->checkPermissions();
		$admin = $this->session->userdata('admin');
		$data['page_title']		         = lang('update_Costing');
		$data['esMaster']		         = $this->Costing_model->get_estimation_master();
		$data['material']		         = $this->Costing_model->get_material();
		$data['labour']		             = $this->Costing_model->get_labourtype();
		$data['uom']		             = $this->Costing_model->get_uom();
		$data['project']		         = $this->Costing_model->get_project();
		$data['id']					     = "";
		$data['project_id']			     = "";
		$data['stage_id']	             = "";
		$data['task_id']		         = "";
		$data['refno']			         = "";
		$data['remarks']                 = "";
		$data['date']			         = "";
		$data['assigned_to']		     = "";
		$data['status']			         = "";
	    $data['approved_remarks']	     = "";
		$data['approved_date']			 = "";
		$data['total_estimate_cost']	 = "";
		if ($id){	  
		     $data['page_title']		= lang('update_Costing');
		     $this->sma->checkPermissions('edit');
			 $data['costing']			=	$costing		=  $this->Costing_model->get($id);
			 $data['workSheet']             =$this->Costing_model->get_worksheet($id);
			 $data['task']                  =$this->Costing_model->get_stagesWiseTask($costing->project_id,$costing->stage_id);
			 $data['stage']                 =$this->Costing_model->get_stages($costing->project_id);
			if (empty($costing)){
				$this->session->set_flashdata('error', lang('costing_details_not_found'));
				redirect('admin/Costing'); 
			}
		$data['id']					     = $costing->id;
		$data['project_id']			     = $costing->project_id;
		$data['stage_id']	             = $costing->stage_id;
		$data['task_id']		         = $costing->task_id;
		$data['refno']			         = $costing->refno;
		$data['remarks']                 = $costing->remarks;
		$data['date']			         = $costing->date;
		$data['status']			         = $costing->status;
	    $data['approved_remarks']	     = $costing->approved_remarks;
		$data['approved_date']			 = $costing->approved_date;
		$data['total_estimate_cost']	 = $costing->total_estimate_cost;
		}
		$this->form_validation->set_rules('estatus','lang:Status', 'trim|required');
		$this->form_validation->set_rules('date','lang:date','trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('Costing/costing_form', $data);		
		}else{
			 for($i=0; $i<count($this->input->post('d_unit')); $i++){
			 if(!empty($_POST['d_unit'][$i]) || !empty($_POST['d_cost'][$i]) ){
			 $worksheet[] = array(
				'master_id' =>$_POST['masterid'][$i],
				'material_id' =>!empty($_POST['material_id'][$i])?$_POST['material_id'][$i]:0,
				'unit' =>@$_POST['unit'][$i],
				'uom' =>@$_POST['uom'][$i],
				'cost' =>$_POST['cost'][$i],
				'd_unit' =>@$_POST['d_unit'][$i],
				'd_price' =>$_POST['d_cost'][$i]
			     ); 
		     }
			 }
			 if($id){
				   $save['approved_remarks']	     = $this->input->post('approved_remarks');
		           $save['approved_date']			 = $this->input->post('approved_date');
			 }
			 $save['id']					    =  $this->input->post('id');
			 $save['refno']		                =  $this->input->post('refno');
			 $save['remarks']			        =  $this->input->post('remark');
			 $save['date']                      =  $this->input->post('date');
			 $save['status']			        =  $this->input->post('estatus');
			 $save['total_costing_cost'] 	    =  $this->input->post('total_Costing_amount');
			
		     $this->Costing_model->save($save,$worksheet);
			 if($id){
				$this->session->set_flashdata('message', lang('costing_details_updated'));
			 }else{
				$this->session->set_flashdata('message', lang('costing_details_saved'));
			 }
			 redirect('admin/Costing'); 
		}
	}
}