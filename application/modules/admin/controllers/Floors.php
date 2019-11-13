<?php

class Floors extends Admin_Controller {

	function __construct(){		
		parent::__construct();
		$this->load->model(array('floor_model'));
	}
	function index(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('floors');
		$data['floors']	= $this->floor_model->get_all();
			//echo '<pre>'; print_r($data['floors']);
		$this->render_admin('floors/list', $data);		
	}
	function get_floors(){
		 $actions = "<div class=\"text-center\">";
         $actions .= "<a href='" . base_url('admin/floors/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/floors/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/floors/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
         $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("floors.id,floor_no,project.Name project,building_info.name,description,CASE 
			WHEN active= 1 THEN 'Active' WHEN active=0 THEN 'InActive' END floorStatus", FALSE)
            ->from("floors")
			->join("project","project.id=floors.projectid","left")
			->join("building_info","building_info.bldid=floors.building_id","left")
			->where("floors.Soft_delete",0)
            ->add_column("Actions", $actions, "floors.id");
	     echo $this->datatables->generate();
		
	}
	function view($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['floor']			=	$floor		= $this->floor_model->get($id);
		$data['project']	    =	$project	= $this->floor_model->get_Project();
		$data['buildings']      = $building= $this->floor_model->get_buildingProjectWise($floor->projectid);
		$data['page_title']	    = lang('view')." ".lang('floor') ;
		$this->render_admin('floors/view', $data);
	}
	function form($id = false){
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('floor_form');
		$data['projects']			=	$project		= $this->floor_model->get_Project();
		$data['id']					= '';
		$data['name']				= '';
		$data['floor_no']			= '';
		$data['active']				= '';
		$data['description']		= '';
		$data['ProjectsName']		= '';
		$data['area']	         	= '';
		$data['shared_public_area']	= '';
		if ($id){	
			$data['floor']			=	$floor		= $this->floor_model->get($id);
			$data['buildings']      = $building= $this->floor_model->get_buildingProjectWise($floor->projectid);
			if (!$floor){
				$this->session->set_flashdata('error', lang('floor_not_found'));
				redirect('admin/groups');
			}
			$data['id']					= $floor->id;
			$data['name']				= $floor->name;
			$data['floor_no']			= $floor->floor_no;
			$data['active']				= $floor->active;
			$data['description']		= $floor->description;
			$data['ProjectsName']		= $floor->projectid;
			$data['building_id']		= $floor->building_id;
			$data['area']	         	= $floor->gross_area;
		    $data['shared_public_area']	= $floor->shared_area;
		}
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('floors/form', $data);		
		}else{
			$save['id']				    = $id;
			$save['name']			    = $this->input->post('name');
			$save['floor_no']			= $this->input->post('floor_no');
			$save['active']			    = $this->input->post('active');
			$save['description']		= $this->input->post('description');
			$save['projectid']		    = $this->input->post('ProjectsName');
			$save['building_id']		= $this->input->post('building_id');
			$save['gross_area']		    = $this->input->post('area');
			$save['shared_area']		= $this->input->post('shared_public_area');
			$this->floor_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('floor_update'));
			}else{
				$this->session->set_flashdata('message', lang('floor_save'));
			}
			redirect('admin/floors');
		}
	}
	
	function delete($id = false){
		if ($id){	
			$floor	= $this->floor_model->floorIfexists($id);
		 if (!$floor){
				$this->session->set_flashdata('error', lang('floor_unable_to_deleted'));
				redirect('admin/floors');
			}else{
				$delete	= $this->floor_model->delete($id);
				$this->session->set_flashdata('message', lang('floor_delete'));
				redirect('admin/floors');
			}
		}
		else{
			$this->session->set_flashdata('error', lang('floor_unable_to_deleted'));
		    redirect('admin/floors');
		}
	}
		function get_building(){
		$HTML='';
		$projectid = $this->input->post('projectid');
		$buildings=$this->db->get_where('building_info',array('project_id'=>$projectid))->result();
		if ($buildings) {
        foreach ($buildings as $building) {
                $HTML.="<option value='" . $building->bldid . "'>" . $building->name. "</option>";
            }
        }
        echo $HTML;
	 
    }
	
}