<?php
class Task extends Admin_Controller {
	function __construct(){		
		parent::__construct();
		$this->load->model(array('Task_model'));
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('download');
	}
	function index(){
		 $this->sma->checkPermissions();
		 $admin = $this->session->userdata('admin');
		 $data['page_title']	= lang('Project');
		 $this->render_admin('task/list', $data);		
	}
	function gettask(){
		 $actions = "<div class=\"text-center\">";
         $actions .= "<a href='" . base_url('admin/Task/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Task/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Task/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
         $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("task.id,taskName,project.Name project,soc.Name soc,task.start_date,task.due_date,status", FALSE)
            ->from("task")
			->join("project","project.id=task.project_id","left")
			->join("soc","soc.id=task.stage_id","left")
			->where("task.soft_delete",0)
            ->add_column("Actions", $actions, "task.id");
	         echo $this->datatables->generate();
	}
	function view($id,$tab=false){
		$this->sma->checkPermissions();
		$admin = $this->session->userdata('admin');
		$data['task']		     	=	$task		= $this->Task_model->get($id);
		$data['page_title']	        = lang('view')." ".lang('Task') ;
	    $this->render_admin('task/view', $data);
	}
	function form($id = false){
		$this->sma->checkPermissions();
		$admin = $this->session->userdata('admin');
		$data['page_title']		        = lang('add_task');
		$data['project']	            = $this->Task_model->get_project();
		$data['stages']		        	= $this->Task_model->get_project_stages();
		$data['tasks']		            = $this->Task_model->get_task();
		$data['employee']		        = $this->Task_model->get_employee();
		$data['id']					    = "";
		$data['taskName']			    = "";
		$data['projectid']	            = "";
		$data['parentasktid']		    = "";
		$data['Projectstageid']			= "";
		$data['start_date']             = "";
		$data['due_date']			    = "";
		$data['assigned_to']		    = "";
		$data['status']			        = "";
	    $data['comments']			    = "";
		if ($id){	  
		     $data['page_title']		= lang('edit_task');
		     $this->sma->checkPermissions('edit');
			 $data['task']			=	$task		= $this->Task_model->get($id);
			if (!$task){
				$this->session->set_flashdata('error', lang('task_details_not_found'));
				redirect('admin/Task');
			}
		$data['id']					     = $task->id;
		$data['taskName']			     = $task->taskName;
		$data['projectid']	             = $task->project_id;
		$data['parentasktid']		     = $task->parentasktid;
		$data['Projectstageid']			 = $task->stage_id;
		$data['start_date']              = $task->start_date;
		$data['due_date']			     = $task->due_date;
		$data['assigned_to']		     = $task->assign_to;
		$data['status']			         = $task->status;
	    $data['comments']			     = $task->comments;
		}
		$this->form_validation->set_rules('TaskName','lang:TaskName', 'trim|required');
		$this->form_validation->set_rules('projectid','lang:ProjectName', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('task/form', $data);		
		}else{
			 $save['id']					    =  $this->input->post('id');
			 $save['taskName']			        =  $this->input->post('TaskName');
			 $save['project_id']			    =  $this->input->post('projectid');
			 $save['parentasktid']	            =  $this->input->post('Parenttaskid');
			 $save['stage_id']		            =  $this->input->post('Projectstageid');
			 $save['start_date']			    =  $this->input->post('start_date');
			 $save['due_date']                  =  $this->input->post('due_date');
			 $save['assign_to']			        =  $this->input->post('assigned_to');
			 $save['status'] 	             	=  $this->input->post('status');
			 $save['comments']			        =  $this->input->post('content_section_description');
		     $this->Task_model->save($save);
			 if($id){
				$this->session->set_flashdata('message', lang('task_details_updated'));
			 }else{
				$this->session->set_flashdata('message', lang('task_details_saved'));
			 }
			 redirect('admin/Task'); 
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
}