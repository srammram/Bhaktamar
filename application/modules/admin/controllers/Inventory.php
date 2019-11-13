<?php

class Inventory extends Admin_Controller {

	function __construct()
	{		
		parent::__construct();
		$this->load->model(array('Inventory_model'));
	}
	
	function index()
	{
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Inventory');
		$data['parkmanager']	= $this->Inventory_model->get_all();
		$this->render_admin('Inventory_assets/list', $data);		
	}
	
	function view($id,$tab=false){
		
		$admin = $this->session->userdata('admin');
		$data['Inventory']			=	$Slot		= $this->Inventory_model->get($id);
		$data['page_title']	= lang('view')." ".lang('Inventory') ;
		$this->render_admin('Inventory_assets/view', $data);
	}
	function form($id = false)
	{
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('Add_Inventory');
		$data['id']					= '';
		$data['Name']				= '';
		$data['Quantity']			= '';
		$data['unit']				= '';
		$data['Current_status']		= '';
		$data['date']		= '';
		
		if ($id)
		{	
			$data['Inventory']			=	$Inventory		= $this->Inventory_model->get($id);
			if (!$Inventory)
			{
				$this->session->set_flashdata('error', lang('Slot_not_found'));
				redirect('admin/groups');
			}
			
			$data['id']				= $Inventory->id;
			$data['Name']		    = $Inventory->Name;
			$data['Quantity']		= $Inventory->Quantity;
			$data['unit']		= $Inventory->unit;
			$data['Current_status']		    = $Inventory->Current_status;
			$data['Inventory_date']		    = $Inventory->Date;
			
			
		}
			$this->form_validation->set_rules('Inv_name', 'lang:Inv_name', 'trim|required');
	     	$this->form_validation->set_rules('Unit', 'lang:Unit', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('Inventory_assets/form', $data);		
		}
		else
		{
			   $save['id']				    = $id;
			   $save['Name']			    = $this->input->post('Inv_name');
			   $save['Quantity']			= $this->input->post('Quantity');
			   $save['unit']	            = $this->input->post('Unit');
			   $save['date']		        = $this->input->post('Inventory_date');
			   $save['Current_status']		= $this->input->post('Current_status');
			   
			$this->Inventory_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('InventoryList_updated'));
			}else{
				$this->session->set_flashdata('message', lang('InventoryList_Save'));
			}
			
			redirect('admin/Inventory');
		}
	}
	
	function delete($id = false)
	{
		if ($id)
		{	
			$Inventory	= $this->Inventory_model->get($id);
		
			if (!$Inventory)
			{
				$this->session->set_flashdata('error', lang('InventoryList_Not_Found'));
				redirect('admin/Inventory');
			}
			else
			{
				$delete	= $this->Inventory_model->delete($id);
				$this->session->set_flashdata('message', lang('InventoryList_Delete'));
				redirect('admin/Inventory');
			}
		}
		else
		{
			
			$this->session->set_flashdata('error', lang('InventoryList_Not_Found'));
				redirect('admin/Inventory');
		}
	}

	function Assets_list()
	{
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Assets');
		$data['assets']	= $this->Inventory_model->Assets_getall();
		$this->render_admin('Inventory_assets/Assets_list', $data);		
		}
   function get_assets(){
		 $actions = "<div class=\"text-center\">";
         $actions .= "<a href='" . base_url('admin/Inventory/Assets_View/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Inventory/Assets_Form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Inventory/Assets_delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
         $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("a.id,Assets_no, Assets_name,f.Facility_name as Facility_name,Assets_category,
           Assest_cost,first_name", FALSE)
            ->from("assets a")
			->join("facility f","a.Facility_Name=f.Fac_id","left")
			->join("employee e","e.id=a.employee_id","left")
			->where("a.soft_delete",0)
            ->add_column("Actions", $actions, "a.id");
			echo $this->datatables->generate();
		
	}
		function Assets_View($id = false)
	 {
		$admin = $this->session->userdata('admin');
		$data['assets']			=	$this->Inventory_model->Assets_get($id);
		$data['page_title']	= lang('view')." ".lang('Assets') ;
		$this->render_admin('Inventory_assets/Assets_view', $data);
	}
		function Assets_Form($id = false)
	{
		
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['Get_Facility']		= $this->Inventory_model->Get_Facility();  
		$data['employee']		= $this->Inventory_model->Get_employee();  
		$data['page_title']		= lang('Add_Assets');
		$data['id']					    = '';
		$data['Facility_name']				= '';
		$data['Assets_no']			        = '';
		$data['Assets_category']		    = '';
		$data['Assets_date']				= '';
		$data['Assest_cost']				= '';
		$data['Assets_name']				= '';
		$data['employee_id']				= '';
		
		if ($id)
		{	
			$data['assets']			=	$assets		= $this->Inventory_model->Assets_get($id);
			if (!$assets)
			{
				$this->session->set_flashdata('error', lang('Slot_not_found'));
				redirect('admin/groups');
			}
			$data['id']					= $assets->id;
			$data['Facility_name']	    = $assets->fn;
			$data['Assets_no']		    = $assets->Assets_no;
			$data['Assets_category']    = $assets->Assets_category;
			$data['Assets_date']		= $assets->Assets_date;
			$data['Assest_cost']		= $assets->Assest_cost;
			$data['Assets_name']		= $assets->Assets_name;
			$data['employee_id']		= $assets->employee_id;
			
		}
		$this->form_validation->set_rules('Assets_no', 'lang:Assets_no', 'trim|required');
		$this->form_validation->set_rules('Assets_name', 'lang:Assets_name', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('Inventory_assets/Assets_form', $data);		
		}
		else
		{
			$save['id']				    = $id;
			$save['Assets_no']			= $this->input->post('Assets_no');
			$save['Facility_Name']		= $this->input->post('Facility_Name');
			$save['Assets_category']	= $this->input->post('Assets_category');
			$save['Assets_date']		= $this->input->post('Assets_date');
			$save['Assest_cost']		= $this->input->post('Assest_cost');
			$save['Assets_name']		= $this->input->post('Assets_name');
			$save['employee_id']		= $this->input->post('employee');
			$this->Inventory_model->Assets_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('Slot_update'));
			}else{
				$this->session->set_flashdata('message', lang('Slot_save'));
			}
			redirect('admin/Inventory/Assets_list');
		}
		
	}
		function Assets_delete($id = false)
     	{
		if ($id)
		{	
			$Slot	= $this->Inventory_model->Assets_get($id);
			if (!$Slot)
			{
				$this->session->set_flashdata('error', lang('Assets_not_found'));
				redirect('admin/Inventory/Assets_list');
			}
			else
			{
				$delete	= $this->Inventory_model->Slot_delete($id);
				$this->session->set_flashdata('message', lang('Assets_deleted'));
				redirect('admin/Inventory/Assets_list');
			}
		}
		else
		{
     			$this->session->set_flashdata('error', lang('Assets_not_found'));
				redirect('admin/Inventory/Assets_list');
		}
		
		
	}
	
}