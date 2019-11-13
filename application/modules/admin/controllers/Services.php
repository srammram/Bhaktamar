<?php

class Services extends Admin_Controller {

	function __construct()
	{		
		parent::__construct();
		$this->load->model(array('Services_model'));
	}
	
	function index()
	{
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Services');
		$data['Services']	= $this->Services_model->get_all();
		$this->render_admin('services/list', $data);		
	}
	
	function view($id,$tab=false){
		
		$admin = $this->session->userdata('admin');
		$data['Services']			=	$Services		= $this->Services_model->get($id);
		$data['page_title']	= lang('view')." ".lang('Services') ;
		$this->render_admin('services/view', $data);
	}
	function form($id = false)
	{
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		            = lang('Add_Services');
		$data['id']					        = '';
		$data['Service_name']				= '';
		$data['Service_provider']			= '';
		$data['Contact_number']				= '';
		$data['Mobile_number']		        = '';
		$data['Email']		                = '';
		$data['Address']		            = '';
		$data['Contact_person_name']		= '';
		$data['Services_duration']		    ='';
		$data['SeviceType']	                ='';
		if ($id)
		{	
			$data['Services']			=	$Services		= $this->Services_model->get($id);
			if (!$Services)
			{
				$this->session->set_flashdata('error', lang('Services_not_found'));
				redirect('admin/groups');
			}
			$data['id']					        = $Services->id;
			$data['Service_name']				= $Services->Service_name;
			$data['Service_provider']			= $Services->Service_provider;
			$data['Contact_number']				= $Services->Contact_person_name;
			$data['Mobile_number']		        = $Services->Mobile_number;
			$data['Email']		                = $Services->Email;
			$data['Address']		            = $Services->Address;
			$data['Contact_person_name']		= $Services->Contact_person_name;
			$data['SeviceType']		            = $Services->SeviceType;
			$data['Services_duration']		    = $Services->Services_duration;
		}
		$this->form_validation->set_rules('Services_name', 'lang:Services_name', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('services/form', $data);		
		}
		else
		{
			$save['id']				        = $id;
			$save['Service_name']			= $this->input->post('Services_name');
			$save['Service_provider']		= $this->input->post('Services_provider');
			$save['Contact_number']			= $this->input->post('Contact_number');
			$save['Mobile_number']		    = $this->input->post('Mobile');
			$save['Email']		            = $this->input->post('Email');
			$save['Address']		        = $this->input->post('Address');
			$save['Contact_person_name']    = $this->input->post('C_person_name');
			$save['SeviceType']             = $this->input->post('Servicestype');
			$save['Services_duration']    = $this->input->post('period');
			$this->Services_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('Services_update'));
			}else{
				$this->session->set_flashdata('message', lang('Services_save'));
			}
			
			redirect('admin/Services');
		}
	}
	
	function delete($id = false)
	{
		if ($id)
		{	
			$Services	= $this->Services_model->get($id);
			if (!$Services)
			{
				$this->session->set_flashdata('error', lang('Services_not_found'));
				redirect('admin/Services');
			}
			else
			{
				$delete	= $this->Services_model->delete($id);
				$this->session->set_flashdata('message', lang('Services_delete'));
				redirect('admin/Services');
			}
		}
		else
		{
			$this->session->set_flashdata('error', lang('Services_not_found'));
			redirect('admin/Services');
		}
	}
	function Services_complaint()
	{
		$data['page_title']	= lang('Services_complaint');
		$data['projects']= $this->Services_model->get_project();
		$data['Complaint']= $this->Services_model->Complaint_get();
		$units=$this->Services_model->Get_unit();
		$this->render_admin('services/Complaint_list', $data);
		
	}
 function projectdatatble()
	{
		 $project_id=$this->input->post('id');
		$projectUnits=$this->Services_model->Project_complaint($project_id);
		$Units=$this->Services_model->Get_project_unit($project_id);
		$units='<option>Select</option>';
		foreach($Units as $Unit)
		{
			
			$units .='<option value="'.$Unit->uid.'">'.$Unit->unit_no.'</option>';
			
		}
		$option=''; 
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		 $url=str_replace('Services/projectdatatble','Complaint/',$actual_link);
		 foreach($projectUnits as $projectUnit)
		{
			$option .='<tr>
			<td class="gc_cell_left" >'.$projectUnit->unit_no .'</td>
			<td>'. $projectUnit->c_title .'</td>
			<td>'. $projectUnit->c_description.'</td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-default" href="'.$url.'/view/'.$projectUnit->complain_id.'"><i class="fa fa-eye"></i></a>
					
				</div>
			</td>
		</tr>';
			
		}
		
		echo json_encode(array($units, $option));
	}
	 function unitdatatble()
	{
		 $project_id=$this->input->post('id');
		 $unit=$this->input->post('unit');
		 $projectUnits=$this->Services_model->Unit_complaint($project_id,$unit);
		 $option=''; 
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		 $url=str_replace('Services/projectdatatble','Complaint/',$actual_link);
		 foreach($projectUnits as $projectUnit)
		{
			$option .='<tr>
			<td class="gc_cell_left" >'.$projectUnit->unit_no .'</td>
			<td>'. $projectUnit->c_title .'</td>
			<td>'. $projectUnit->c_description.'</td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-default" href="'.$url.'/view/'.$projectUnit->complain_id.'"><i class="fa fa-eye"></i></a>
					
				</div>
			</td>
		</tr>';
			
		}
		echo $option;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	function Amenities_complaint()
	{
		$data['page_title']	= lang('Amenties_complaint');
		$data['projects']= $this->Services_model->get_project();
		$data['Complaint']= $this->Services_model->Amenities_Complaint_get();
		$units=$this->Services_model->Get_unit();
		$this->render_admin('services/Amenties_complaint', $data);
		
	}
 function Amenities_projectdatatble()
	{
		 $project_id=$this->input->post('id');
		$projectUnits=$this->Services_model->Amenities_Project_complaint($project_id);
		$Units=$this->Services_model->Get_project_unit($project_id);
		$units='<option>Select</option>';
		foreach($Units as $Unit)
		{
			
			$units .='<option value="'.$Unit->uid.'">'.$Unit->unit_no.'</option>';
			
		}
		$option=''; 
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		 $url=str_replace('Services/projectdatatble','Complaint/',$actual_link);
		 foreach($projectUnits as $projectUnit)
		{
			$option .='<tr>
			<td class="gc_cell_left" >'.$projectUnit->unit_no .'</td>
			<td>'. $projectUnit->c_title .'</td>
			<td>'. $projectUnit->c_description.'</td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-default" href="'.$url.'/view/'.$projectUnit->complain_id.'"><i class="fa fa-eye"></i></a>
					
				</div>
			</td>
		</tr>';
			
		}
		
		echo json_encode(array($units, $option));
	}
	 function Amenities_unitdatatble()
	{
		 $project_id=$this->input->post('id');
		 $unit=$this->input->post('unit');
		 $projectUnits=$this->Services_model->Amenities_Unit_complaint($project_id,$unit);
		 $option=''; 
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		 $url=str_replace('Services/projectdatatble','Complaint/',$actual_link);
		 foreach($projectUnits as $projectUnit)
		{
			$option .='<tr>
			<td class="gc_cell_left" >'.$projectUnit->unit_no .'</td>
			<td>'. $projectUnit->c_title .'</td>
			<td>'. $projectUnit->c_description.'</td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-default" href="'.$url.'/view/'.$projectUnit->complain_id.'"><i class="fa fa-eye"></i></a>
					
				</div>
			</td>
		</tr>';
			
		}
		echo $option;
		
	}
	 
}