<?php

class Complaint extends Admin_Controller {

	function __construct()
	{		
		parent::__construct();
		$this->load->model(array('Complaint_model'));
	}
	function index()
	{
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Complaint');
		$data['Complaint']	= $this->Complaint_model->get_all();
		$this->render_admin('Complaint/list', $data);		
	}
	function view($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['Complaint']			=	$complaint		= $this->Complaint_model->Get_complaint($id);
		$data['page_title']	= lang('view')." ".lang('Complaint') ;
		$this->render_admin('Complaint/view', $data);
	}              
	function form($id = false)
	{
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
	    $data['Units']	        = $this->Complaint_model->GetUnit_list();
		$data['employes']	    = $this->Complaint_model->Get_users();
		$data['page_title']		= lang('Add_complaint');
		$data['id']					    = '';
		$data['c_title']				= '';
		$data['Unit_id']			    = '';
		$data['c_description']		    = '';
		$data['c_date']		            = '';
		$data['Complaint_status']		= '';
		$data['Complaint_type']      	='';
		$data['Type_category']       	='';
		$data['Assign_to']       	    ='';
		if ($id)
		{	
			$data['Complaint']			=	$Complaint		= $this->Complaint_model->get($id);
			if (!$Complaint)
			{
				$this->session->set_flashdata('error', lang('Compaint_Not_found'));
				redirect('admin/Complaint');
			}
			$data['complain_id']		  = $Complaint->complain_id;
			$data['c_title']			  = $Complaint->c_title;
			$data['Unit_id']			  =$Complaint->Unit_id;
			$data['c_description']		  = $Complaint->c_description;
			$data['c_date']		          = $Complaint->c_date;
			$data['Complaint_status']	  = $Complaint->Complaint_status;
			$data['Type_category']	      = $Complaint->Type_category;
			$data['Type_categorysDrop']   = $this->Complaint_model->Get_types($Complaint->Complaint_type);
			$data['Complaint_type']	      = $Complaint->Complaint_type;
			$data['Assign_to']	          = $Complaint->Assign_to;
		}
		$this->form_validation->set_rules('txtCTitle', 'lang:Complaint_title', 'trim|required');
		$this->form_validation->set_rules('txtCDescription', 'lang:Complaint_desc', 'trim|required');
		$this->form_validation->set_rules('txtCDate', 'lang:Complaint_date', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('Complaint/form', $data);		
		}else{
			$ids	= $this->input->post('ids');
			$save['c_title']	            = $this->input->post('txtCTitle');
			$save['Unit_id']	            = $this->input->post('Complaintby');
			$save['c_description']	        = $this->input->post('txtCDescription');
			$save['c_date']	                = $this->input->post('txtCDate');
		 	$save['Complaint_status']	    = $this->input->post('status');
			$save['Type_category']	        = $this->input->post('category');
			$save['Complaint_type']	        = $this->input->post('types');
			$save['Assign_to']           	= $this->input->post('Assignto');
			$this->Complaint_model->save($save,$ids);
			if($id){
				$this->session->set_flashdata('message', lang('Complaint_update'));
			}else{
				$this->session->set_flashdata('message', lang('Compaint_insert'));
			}
			redirect('admin/Complaint');
		}
	}
	
	function delete($id = false)
	{
		if ($id)
		{	
			$floor	= $this->Complaint_model->get($id);
			if (!$floor)
			{
				$this->session->set_flashdata('error', lang('Compaint_Not_found'));
				redirect('admin/Complaint');
			}
			else
			{
				$delete	= $this->Complaint_model->delete($id);
				$this->session->set_flashdata('message', lang('Compaint_Deleted'));
				redirect('admin/Complaint');
			}
		}
		else
		{
			$this->session->set_flashdata('error', lang('Compaint_Not_found'));
		    redirect('admin/Complaint');
		}
	}
	function Get_types()
	{
		$type=$this->input->post('id');
		$options='';
		switch($type)
		{
			case 1:
			     $amenities=$this->Complaint_model->Get_amenities();
				 foreach($amenities as $item)
				{
				    $options .='<option value="'.$item->id.'">'.$item->NAME.'</option>';
				}
			break;
			case 2:
			    $services=$this->Complaint_model->Get_Services();
				foreach($services as $item)
				{
				    $options .='<option value="'.$item->id.'">'.$item->NAME.'</option>';
				}
			break;
			case 3:
			     echo $options='';
			break;
			
			
		}
		
		echo $options;
		
	}
}