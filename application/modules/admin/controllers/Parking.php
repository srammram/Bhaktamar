<?php

class Parking extends Admin_Controller {
	function __construct()	{		
		parent::__construct();
		$this->load->model(array('Parking_model'));
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	function index(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('parking_area');
		$this->render_admin('parking_area/list', $data);		
		}
		function get_parkingArea(){         
		 $actions = "<div class=\"text-center\">";
         $actions .= "<a href='" . base_url('admin/Parking/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Parking/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Parking/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
            $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("parking_slot.id,parking_slot.Slot_No,project.Name,building_info.name,floors.name floorNo,unit_no,parking_slot.size,CASE 
			WHEN Isbooked= 1 THEN 'Booked' WHEN Isbooked=0 THEN 'Available' END status", FALSE)
            ->from("parking_slot")
			->join("project","project.id=parking_slot.project_id","left")
			->join("building_info","building_info.bldid=parking_slot.building_id","left")
			->join("floors","floors.id=parking_slot.floor_id","left")
			->join("add_unit","add_unit.uid=parking_slot.unit_id","left")
			->where("parking_slot.soft_delete",0)
            ->add_column("Actions", $actions, "parking_slot.id");
	        echo $this->datatables->generate();
		
	}
     function view($id = false){
		$admin = $this->session->userdata('admin');
		$data['Slot']			=	$this->ParkingManager_model->Slot_get($id);
		$data['page_title']	= lang('view')." ".lang('Slot') ;
		$this->render_admin('ParkingManager/Slot_view', $data);
	   }
		function form($id = false){
		$admin = $this->session->userdata('admin');
		$data['project']	            = $this->site->get_project($id);
		$data['page_title']		    = lang('add_parking_area');
		$data['id']				    = "";
	    $data['Slot_No']			= "";
	    $data['name']			    = "";
		$data['project_id']			= "";
		$data['building_id']	    = "";
		$data['floor_id']			= "";
		$data['unit_id']			= "";
		$data['size']			    = "";
		$data['description']	    = "";
		$data['Isbooked']			= 0;
		if ($id){	
			$data['slot']			=	$Slot		= $this->Parking_model->get($id);
			$data['building']	    =	$building	= $this->site->get_building($Slot->project_id);
			$data['floor']			=	$floor		= $this->site->get_floor($Slot->project_id,$Slot->building_id);
			$data['units']			=	$unit		= $this->site->get_unit($Slot->project_id,$Slot->building_id,$Slot->floor_id);
			
			if (!$Slot){
				$this->session->set_flashdata('error', lang('Slot_not_found'));
				redirect('admin/Parking');
			}
			$data['id']				    = $Slot->id;
			$data['Slot_No']			= $Slot->Slot_No;
			$data['name']			    = $Slot->name;
			$data['project_id']			= $Slot->project_id;
			$data['building_id']	    = $Slot->building_id;
			$data['floor_id']			= $Slot->floor_id;
			$data['unit_id']			= $Slot->unit_id;
			$data['size']			    = $Slot->size;
			$data['description']	    = $Slot->description;
			$data['Isbooked']			= 0;
		}
		$this->form_validation->set_rules('slotno', 'lang:Slot_no', 'trim|required');
		$this->form_validation->set_rules('project_id', 'lang:project', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('parking_area/form', $data);		
		}else{    
			$save['id']				    = $id;
			$save['Slot_No']			= $this->input->post('slotno');
			$save['name']			    = $this->input->post('slotno');
			$save['project_id']			= $this->input->post('project_id');
			$save['building_id']	    = $this->input->post('building_id');
			$save['floor_id']			= $this->input->post('floorid');
			$save['unit_id']			= $this->input->post('unitid');
			$save['size']			    = $this->input->post('size');
			$save['description']	    = $this->input->post('description');
			$save['Isbooked']			= 0;
			$this->Parking_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('Slot_update'));
			}else{
				$this->session->set_flashdata('message', lang('Slot_save'));
			}
			redirect('admin/Parking');
		}
		
	}
		function delete($id = false){
		if ($id){	
			$Slot	= $this->ParkingManager_model->Slot_get($id);
			if (!$Slot){
				$this->session->set_flashdata('error', lang('Slot_Not_found'));
				redirect('admin/ParkingManager/Slot_list');
			}else{
				$delete	= $this->ParkingManager_model->Slot_delete($id);
				$this->session->set_flashdata('message', lang('Slot_delete'));
				redirect('admin/ParkingManager/Slot_list');
			}
		}else{
     			$this->session->set_flashdata('error', lang('Slot_Not_found'));
				redirect('admin/ParkingManager/Slot_list');
		}
	}
	
	
}