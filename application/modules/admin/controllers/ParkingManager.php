<?php

class ParkingManager extends Admin_Controller {

	function __construct()
	{		
		parent::__construct();
		$this->load->model(array('ParkingManager_model'));
	}
	
	function index()
	{
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Parking_Manager');
		$data['parkmanager']	= $this->ParkingManager_model->get_all();
		$this->render_admin('ParkingManager/list', $data);		
	}
	
	function view($id,$tab=false){
		
		$admin = $this->session->userdata('admin');
		$data['Parkmanager']			=	$Slot		= $this->ParkingManager_model->get($id);
		$data['page_title']	= lang('view')." ".lang('Parking_Manager') ;
		$this->render_admin('ParkingManager/view', $data);
	}
	function form($id = false)
	{
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['Owner']		= $this->ParkingManager_model->Get_owner();
		$data['Slots']		= $this->ParkingManager_model->Get_Slot();
		$data['page_title']		= lang('Add_Parking_Manager');
		$data['id']					= '';
		$data['name']				= '';
		$data['Slot_no']			= '';
		$data['active']				= '';
		$data['description']		= '';
		
		if ($id)
		{	
			$data['ParkingManager']			=	$ParkingManager		= $this->ParkingManager_model->get($id);
			if (!$ParkingManager)
			{
				$this->session->set_flashdata('error', lang('Slot_not_found'));
				redirect('admin/groups');
			}
			$data['id']					= $ParkingManager->id;
			$data['Slot_No']		    = $ParkingManager->Slot_Nos;
			$data['OwnerName']			= $ParkingManager->OwnerName;
			$data['Vechile_number']		= $ParkingManager->Vechile_number;
			$data['Assign_status']		= $ParkingManager->Assign_status;
			$data['Status']		        = $ParkingManager->STATUS;
			
		}
			$this->form_validation->set_rules('Slotno', 'lang:Slotno', 'trim|required');
	     	$this->form_validation->set_rules('Owner', 'lang:Owners', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('ParkingManager/form', $data);		
		}
		else
		{
				$save['id']				    = $id;
			   $save['Slot_No']			= $this->input->post('Slotno');
			   $save['OwnerName']			= $this->input->post('Owner');
			   $save['Vechile_number']			= $this->input->post('Vechile_number');
			   $save['Assign_status']			= $this->input->post('AssignStatus');
			   $save['Status']			= $this->input->post('Vechile_status');
			$this->ParkingManager_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('Slot_update'));
			}else{
				$this->session->set_flashdata('message', lang('Slot_save'));
			}
			
			redirect('admin/ParkingManager');
		}
	}
	
	function delete($id = false)
	{
		if ($id)
		{	
			$ParkingManager	= $this->ParkingManager_model->get($id);
		
			if (!$ParkingManager)
			{
				$this->session->set_flashdata('error', lang('Parking_Record_not_found'));
				redirect('admin/ParkingManager');
			}
			else
			{
				$delete	= $this->ParkingManager_model->delete($id);
				$this->session->set_flashdata('message', lang('Parking_Record_Deleted'));
				redirect('admin/ParkingManager');
			}
		}
		else
		{
			
			$this->session->set_flashdata('error', lang('Parking_Record_not_found'));
				redirect('admin/ParkingManager');
		}
	}

	function Slot_list()
	{
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Slot');
		$data['Slots']	= $this->ParkingManager_model->Slot_getall();
		$this->render_admin('ParkingManager/Slot_list', $data);		
		}
		
		function Slot_View($id = false)
	 {
		$admin = $this->session->userdata('admin');
		$data['Slot']			=	$this->ParkingManager_model->Slot_get($id);
		$data['page_title']	= lang('view')." ".lang('Slot') ;
		$this->render_admin('ParkingManager/Slot_view', $data);
	}
		function Slot_Form($id = false)
	{
		
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('Slot_add');
		$data['id']					    = '';
		$data['Slot_No']				= '';
		$data['Slot_Type']			    = '';
		$data['Comments']				= '';
		
		if ($id)
		{	
			$data['Slot']			=	$Slot		= $this->ParkingManager_model->Slot_get($id);
			if (!$Slot)
			{
				$this->session->set_flashdata('error', lang('Slot_not_found'));
				redirect('admin/groups');
			}
			$data['id']					= $Slot->id;
			$data['Slot_No']			= $Slot->Slot_No;
			$data['Slot_Type']		    = $Slot->Slot_Type;
			$data['Comments']		    = $Slot->Comments;
			
		}
		$this->form_validation->set_rules('Slotno', 'lang:Slotno', 'trim|required');
		$this->form_validation->set_rules('Type', 'lang:Slot_type', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('ParkingManager/Slot_form', $data);		
		}
		else
		{
			$save['id']				    = $id;
			$save['Slot_No']			= $this->input->post('Slotno');
			$save['Slot_Type']			= $this->input->post('Type');
			$save['Comments']			= $this->input->post('Comments');
			$this->ParkingManager_model->Slot_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('Slot_update'));
			}else{
				$this->session->set_flashdata('message', lang('Slot_save'));
			}
			
			redirect('admin/ParkingManager/Slot_list');
		}
		
	}
		function Slot_delete($id = false)
	{
		if ($id)
		{	
			$Slot	= $this->ParkingManager_model->Slot_get($id);
			if (!$Slot)
			{
				$this->session->set_flashdata('error', lang('Slot_Not_found'));
				redirect('admin/ParkingManager/Slot_list');
			}
			else
			{
				$delete	= $this->ParkingManager_model->Slot_delete($id);
				$this->session->set_flashdata('message', lang('Slot_delete'));
				redirect('admin/ParkingManager/Slot_list');
			}
		}
		else
		{
     			$this->session->set_flashdata('error', lang('Slot_Not_found'));
				redirect('admin/ParkingManager/Slot_list');
		}
		
		
	}
	
}