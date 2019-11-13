<?php
class Estimation extends Admin_Controller {
	function __construct(){		
		parent::__construct();
		$this->load->model(array('Estimation_model','payroll/global_model'));
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('download');
		 $this->load->library('datatables');
	}
	function index(){
		 $this->sma->checkPermissions();
		 $admin = $this->session->userdata('admin');
		 $data['page_title']	= lang('Project');
		 $this->render_admin('Estimation/estimation_list', $data);		
	}
	function getEstimation(){
		 $actions = "<div class=\"text-center\">";
         $actions .= "<a href='" . base_url('admin/Costing/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Costing/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Costing/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
         $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("estimation.id,taskName,project.Name project,soc.Name soc,refno,date,estimation.status", FALSE)
            ->from("estimation")
			->join("project","project.id=estimation.project_id","left")
			->join("soc","soc.id=estimation.stage_id","left")
			->join("task","task.id=estimation.task_id","left")
			->where("estimation.soft_delete",0)
            ->add_column("Actions", $actions, "estimation.id");
	         echo $this->datatables->generate();
	}
	function estimation_view($id,$tab=false){
		$this->sma->checkPermissions();
		$admin = $this->session->userdata('admin');
		$data['estimation_details']		     	=$estimation=	$this->Estimation_model->get($id);
		$data['estimation_worksheet']		    =$worksheet=	$this->Estimation_model->get_worksheet($estimation->id);
		$data['task']                           =$this->Estimation_model->get_stagesWiseTask($estimation->project_id,$estimation->stage_id);
	    $data['stage']                          =$this->Estimation_model->get_stages($estimation->project_id);
		$data['material']		                = $this->Estimation_model->get_material(); 
		$data['uom']		                    = $this->Estimation_model->get_uom();
		$data['page_title']	                    = lang('view')." ".lang('Estimation') ;
	    $this->render_admin('Estimation/estimation_view', $data);
	}
	function form($id = false){
		$this->sma->checkPermissions();
		$admin = $this->session->userdata('admin');
		$data['page_title']		         = lang('new_estimation');
		$data['esMaster']		         = $this->Estimation_model->get_estimation_master();
		$data['material']		         = $this->Estimation_model->get_material();
		$data['labour']		             = $this->Estimation_model->get_labourtype();
		$data['uom']		             = $this->Estimation_model->get_uom();
		$data['project']		         = $this->Estimation_model->get_project();
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
		     $data['page_title']		= lang('update_estimation');
		     $this->sma->checkPermissions('edit');
			 $data['estimation']			=	$estimation		=  $this->Estimation_model->get($id);
			 $data['workSheet']             =$this->Estimation_model->get_worksheet($id);
			 $data['task']                  =$this->Estimation_model->get_stagesWiseTask($estimation->project_id,$estimation->stage_id);
			 $data['stage']                 =$this->Estimation_model->get_stages($estimation->project_id);
			if (empty($estimation)){
				$this->session->set_flashdata('error', lang('estimation_details_not_found'));
				redirect('admin/Estimation'); 
			}
		$data['id']					     = $estimation->id;
		$data['project_id']			     = $estimation->project_id;
		$data['stage_id']	             = $estimation->stage_id;
		$data['task_id']		         = $estimation->task_id;
		$data['refno']			         = $estimation->refno;
		$data['remarks']                 = $estimation->remarks;
		$data['date']			         = $estimation->date;
		$data['status']			         = $estimation->status;
	    $data['approved_remarks']	     = $estimation->approved_remarks;
		$data['approved_date']			 = $estimation->approved_date;
		$data['total_estimate_cost']	 = $estimation->total_estimate_cost;
		}
		$this->form_validation->set_rules('estatus','lang:Status', 'trim|required');
		$this->form_validation->set_rules('date','lang:date','trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('Estimation/estimation_form', $data);		
		}else{
			 for($i=0; $i<count($this->input->post('masterid')); $i++){
			 if(!empty($_POST['uom'][$i]) || !empty($_POST['cost'][$i]) || !empty($_POST['unit'][$i])){
			 $worksheet[] = array(
				'master_id' =>$_POST['masterid'][$i],
				'material_id' =>!empty($_POST['material_id'][$i])?$_POST['material_id'][$i]:0,
				'unit' =>@$_POST['unit'][$i],
				'uom' =>@$_POST['uom'][$i],
				'cost' =>$_POST['cost'][$i]
			     ); 
		     }
			 }
			 if($id){
				   $save['approved_remarks']	     = $this->input->post('approved_remarks');
		           $save['approved_date']			 = $this->input->post('approved_date');
			 }
			 $save['id']					    =  $this->input->post('id');
			 $save['project_id']			    =  $this->input->post('projectid');
			 $save['stage_id']			        =  $this->input->post('stageid');
			 $save['task_id']	                =  $this->input->post('taskid');
			 $save['refno']		                =  $this->input->post('refno');
			 $save['remarks']			        =  $this->input->post('remark');
			 $save['date']                      =  $this->input->post('date');
			 $save['status']			        =  $this->input->post('estatus');
			 $save['total_estimate_cost'] 	    =  $this->input->post('totalamount');
			
		     $this->Estimation_model->save($save,$worksheet);
			 if($id){
				$this->session->set_flashdata('message', lang('estimation_details_updated'));
			 }else{
				$this->session->set_flashdata('message', lang('estimation_details_saved'));
			 }
			 redirect('admin/Estimation'); 
		}
	}
	function delete($id =false){
			$this->sma->checkPermissions();
			if ($id){	
			$project	= $this->Task_model->projectIfexists($id);
			if (!$project){
				$this->session->set_flashdata('error', lang('Task_unable_deleted'));
				redirect('admin/Project'); 
			}else{
				$delete	= $this->Task_model->delete($id);
				$this->session->set_flashdata('message', lang('Task_details_deleted'));
				redirect('admin/Project'); 
			}
		   }else{
			    $this->session->set_flashdata('error', lang('task_details_not_found'));
				redirect('admin/Project'); 
		  }
	}
  function  estimation_master(){
	  $this->sma->checkPermissions();
	  $admin = $this->session->userdata('admin');
      $data['page_title']	= lang('estimation_master');
      $this->render_admin('Estimation/master/estimation_master', $data);		
	  } 
    public function get_estimation_master(){
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
        $this->datatables
            ->select("id,Name,description,flag", false)
            ->from("estimation_master");
           // ->add_column("Actions", $actions, "id");
       echo  $this->datatables->generate();
    }
    public function edit_estimation_master($id)
    {
        $this->global_model->table = 'estimation_master';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function add_estimation_master()
    {
        $this->global_model->table = 'estimation_master';
        $this->_esMaster_validate();
        $data = array(
            'Name' => $this->input->post('name'),
            'description' => $this->input->post('description'),

        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_estimation_master()
    {
        $this->global_model->table = 'estimation_master';
        $this->_esMaster_validate();
        $data = array(
            'Name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    /* public function delete_estimation_master($id)
    {
        $this->global_model->table = 'estimation_master';
        $result = $this->db->get_where('payroll_employee', array('department' => $id))->result();
        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    } */

    private function _esMaster_validate(){
        $rules = array(
            array('field' => 'name', 'label' => lang('Name'), 'rules' => 'trim|required'),
            array('field' => 'description', 'label' => lang('description'), 'rules' => 'trim|required'),
        );
        $this->global_model->validation($rules);
    }
	
	function stages(){
	$HTML='';
    $projectid = $this->input->post('projectid');
	$stages=$this->Estimation_model->get_stages($projectid);
    if ($stages) {
        foreach ($stages as $stage) {
                $HTML.="<option value='" . $stage->id . "'>" . $stage->Name. "</option>";
            }
        }
        echo $HTML;
    }
	function get_task(){
	$HTML='';
    $projectid = $this->input->post('projectid');
	$stageid = $this->input->post('stageid');
	$tasks=$this->Estimation_model->get_stagesWiseTask($projectid,$stageid);
    if ($tasks) {
        foreach ($tasks as $task) {
                $HTML.="<option value='" . $task->id . "'>" . $task->taskName. "</option>";
            }
        }
        echo $HTML;
    }
  function check_status(){
	$projectid = $this->input->post('projectid');
	$stageid = $this->input->post('stageid');
	$taskid = $this->input->post('taskid');
	$status = $this->input->post('status');
	$checkstatus=$this->Estimation_model->check_status($projectid,$stageid,$taskid);
	if($checkstatus){
		echo 1;
	}else{
		echo 0;
	}
	  
  }
}