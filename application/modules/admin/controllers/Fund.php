<?php

class Fund extends Admin_Controller {
	function __construct(){		
		parent::__construct();
		$this->load->model(array('Fund_model'));
	}
	function index(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Fund');
		$data['Fund']	= $this->Fund_model->get_all();
		$this->render_admin('Fund/list', $data);		
	}
	
	function reserve_fund(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('reserve_fund_list');
		$this->render_admin('Fund/reserve_fund_list', $data);	
	}
	function get_reserve_fund(){
		 $actions = "<div class=\"text-center\">";
		 $actions .= "<a href='" . base_url('admin/fund/reserve_fund_view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/fund/reserve_fund_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/fund/reserve_fund_delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		 $actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("id, owner.full_name ,f_date, purpose,total_amount,balance", FALSE)
		   ->from("reserve_fund")
		   ->join("owner","owner.ownid=reserve_fund.owner_id","left")
		   ->where("soft_delete",0)
		   ->add_column("Actions", $actions, "id");
		   echo $this->datatables->generate();
	}
	function reserve_fund_view($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['reserve_fund']			=	$Fund		= $this->Fund_model->get_reserve_fund($id);
		$data['page_title']	= lang('reserve_fund')." ".lang('view') ;
		$this->render_admin('Fund/reserve_fund_view', $data);
	}    
function reserve_fund_form($id = false){
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
	    $data['Owners']	= $this->Fund_model->Get_owner($id);
		$data['page_title']		= lang('reserve_fund_form');
		$data['maintenanceservices']  = $this->db->get_where("request_subcategory",array("soft_delete"=>0))->result();
		$data['services_list']        = $this->db->get_where("services",array("Soft_delete"=>0))->result();
		$data['id']					    = '';
		$data['f_date']				    = '';
		$data['total_amount']			= '';
		$data['purpose']		        = '';
		$data['start_date']	            = '';
		$data['end_date']	            = '';
		if ($id){	
			$data['Fund']			=	$Fund		= $this->Fund_model->get_reserve_fund($id);
			if (!$Fund){
				$this->session->set_flashdata('error', lang('reserve_fund_data_notFound'));
				redirect('admin/Fund/reserve_fund');
			}
			$data['id']		        = $Fund->id;
			$data['owner_id']		= $Fund->owner_id;
			$data['f_date']			= $Fund->f_date;
			$data['total_amount']	= $Fund->total_amount;
			$data['purpose']		= $Fund->purpose;
			$data['start_date']	    = $Fund->start_date;
			$data['end_date']	    = $Fund->end_date;
		}
		
		$this->form_validation->set_rules('ownerid', 'lang:Owner_Name', 'trim|required');
		$this->form_validation->set_rules('paiddate', 'lang:paid_date', 'trim|required');
		$this->form_validation->set_rules('totalamount', 'lang:Total_amount', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('Fund/reserve_fund_form', $data);		
		}
		else
		{
			$save['id']= $this->input->post('id');
			$save['owner_id']	    = $this->input->post('ownerid');
			$save['f_date']	        = $this->input->post('paiddate');
			$save['total_amount']	= $this->input->post('totalamount');
			$save['purpose']	    = $this->input->post('txtPurpose');
			$save['start_date']	    = $this->input->post('startdate');
			$save['end_date']	    = $this->input->post('enddate');
		/* 	$save['maintenance_services'] = json_encode$this->input->post('maintenance_services'));
			$save['Other_services']       = json_encode($this->input->post('services')); */
			
			
			$this->Fund_model->reserve_fund_save($save,$ids);
			if($id){
				$this->session->set_flashdata('message', lang('Fund_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('Fund_Insert'));
			}
			
			redirect('admin/Fund/reserve_fund');
		}
	}	
	function form($id = false)
	{
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
	    $data['Owners']	= $this->Fund_model->Get_owner($id);
		$data['page_title']		= lang('Add_Fund');
		$data['id']					    = '';
		$data['f_date']				= '';
		$data['total_amount']			    = '';
		$data['purpose']		    = '';
		$data['For_Month']		            = '';
		if ($id){	
			$data['Fund']			=	$Fund		= $this->Fund_model->get($id);
			if (!$Fund){
				$this->session->set_flashdata('error', lang('Compaint_Not_found'));
				redirect('admin/Fund');
			}
			$data['fund_id']		= $Fund->fund_id;
			$data['owner_id']		= $Fund->owner_id;
			$data['f_date']			= $Fund->f_date;
			$data['total_amount']	= $Fund->total_amount;
			$data['purpose']		= $Fund->purpose;
			$data['For_Months']	    = $Fund->For_Month;
		}
		
		$this->form_validation->set_rules('ddlOwnerName', 'lang:Owner_Name', 'trim|required');
		$this->form_validation->set_rules('month', 'lang:Month', 'trim|required');
		$this->form_validation->set_rules('txtTotalAmount', 'lang:Total_amount', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('Fund/form', $data);		
		}
		else
		{
			$ids	= $this->input->post('ids');
			$save['owner_id']	    = $this->input->post('ddlOwnerName');
			$save['f_date']	    = $this->input->post('txtDate');
			$save['total_amount']	= $this->input->post('txtTotalAmount');
			$save['purpose']	         = $this->input->post('txtPurpose');
			$save['For_Month']	= $this->input->post('month').'-00';
			
			$this->Fund_model->save($save,$ids);
			if($id){
				$this->session->set_flashdata('message', lang('Fund_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('Fund_Insert'));
			}
			
			redirect('admin/Fund');
		}
	}
	function reserve_fund_delete($id = false)
	{
		if ($id)
		{	
			$reservefund	= $this->Fund_model->get_reserve_fund($id);
			
			if (!$reservefund)
			{
				$this->session->set_flashdata('error', lang('Fund_Record_Not_found'));
			redirect('admin/Fund/reserve_fund');
			}
			else
			{
				
				$delete	= $this->Fund_model->reserve_fund_delete($id);
				
				$this->session->set_flashdata('message', lang('fund_record_deleted'));
				redirect('admin/Fund/reserve_fund');
			}
		}
		else
		{
			
			$this->session->set_flashdata('error', lang('Fund_Record_Not_found'));
				redirect('admin/Fund/reserve_fund');
		}
	}
	
	function delete($id = false)
	{
		if ($id)
		{	
			$floor	= $this->Fund_model->get($id);
			//if the customer does not exist, redirect them to the customer list with an error
			if (!$floor)
			{
				$this->session->set_flashdata('error', lang('Fund_Record_Not_found'));
				redirect('admin/Fund');
			}
			else
			{
				//if the customer is legit, delete them
				$delete	= $this->Fund_model->delete($id);
				
				$this->session->set_flashdata('message', lang('fund_record_deleted'));
				redirect('admin/Fund');
			}
		}
		else
		{
			//if they do not provide an id send them to the customer list page with an error
			$this->session->set_flashdata('error', lang('Fund_Record_Not_found'));
				redirect('admin/Fund');
		}
	}
	function property_management_fee(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('reserve_fund_list');
		$this->render_admin('Fund/property_management_fee_list', $data);	
	}
	function get_property_management_fee(){
		 $actions = "<div class=\"text-center\">";
		 $actions .= "<a href='" . base_url('admin/fund/property_management_fee_view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/fund/property_management_fee_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/fund/property_management_fee_delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		 $actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("id, owner.full_name ,f_date, add_unit.unit_name,total_amount,balance", FALSE)
		   ->from("property_management_fee")
		   ->join("owner","owner.ownid=property_management_fee.owner_id","left")
		    ->join("add_unit","add_unit.uid=property_management_fee.unitid","left")
		   ->where("property_management_fee.soft_delete",0)
		   ->add_column("Actions", $actions, "id");
		   echo $this->datatables->generate();
	}
	function property_management_fee_view($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['property_management_fee']			=	$Fund		= $this->Fund_model->get_property_management_fee_fund($id);
		$data['maintenanceservices']  = $this->db->get_where("request_subcategory",array("soft_delete"=>0))->result();
		$data['services_list']        = $this->db->get_where("services",array("Soft_delete"=>0))->result();
		$data['page_title']	= lang('property_management_fee')." ".lang('view') ;
		$this->render_admin('Fund/property_management_fee_view', $data);
	}    
	function property_management_fee_form($id = false){
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
	    $data['Owners']             	= $this->Fund_model->Get_owner($id);
		$data['project']	            = $this->Fund_model->get_Project();
		$data['page_title']		        = lang('property_management_fee_form');
		$data['maintenanceservices']    = $this->db->get_where("request_subcategory",array("soft_delete"=>0))->result();
		$data['services_list']          = $this->db->get_where("services",array("Soft_delete"=>0))->result();
		$data['id']					    = '';
		$data['f_date']				    = '';
		$data['total_amount']			= '';
		$data['purpose']		        = '';
		$data['start_date']	            ='';
		$data['end_date']	            = '';
		$data['projectid']	            = '';
		$data['buildingid']	            = '';
	    $data['unitid']	                = '';
		$data['ms']	                    = '';
		$data['services']	            = '';
		if ($id){	
			$data['Fund']			=	$Fund		= $this->Fund_model->get_property_management_fee_fund($id);
			$data['buildings']  =	$building       = $this->Fund_model->get_building($Fund->projectid);
			$data['owners']	    =	$owner		    = $this->Fund_model->get_OwnerbyBuilding($Fund->projectid,$Fund->buildingid);
			$data['ownerunits']	=	$ownerunits	    = $this->Fund_model->get_Ownerunits($Fund->projectid,$Fund->buildingid,$Fund->owner_id);
			if (!$Fund){
				$this->session->set_flashdata('error', lang('reserve_fund_data_notFound'));
				redirect('admin/Fund/property_management_fee');
			}     
			$data['id']		        = $Fund->id;
			$data['owner_id']		= $Fund->owner_id;
			$data['f_date']			= $Fund->f_date;
			$data['total_amount']	= $Fund->total_amount;
			$data['purpose']		= $Fund->purpose;
			$data['start_date']	    = $Fund->start_date;
			$data['end_date']	    = $Fund->end_date;
			$data['projectid']	    = $Fund->projectid;
			$data['buildingid']	    = $Fund->buildingid;
			$data['unitid']	        = $Fund->unitid;
			$data['ms']	            = json_decode($Fund->maintenance_services);
		    $data['services']	    = json_decode($Fund->Other_services);
		}
		
		$this->form_validation->set_rules('owner_id', 'lang:Owner_Name', 'trim|required');
		$this->form_validation->set_rules('paiddate', 'lang:paid_date', 'trim|required');
		$this->form_validation->set_rules('totalamount', 'lang:Total_amount', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('Fund/property_management_fee_form', $data);		
		}
		else{
			$save['id']= $this->input->post('id');
			$save['owner_id']	    = $this->input->post('owner_id');
			$save['f_date']	        = $this->input->post('paiddate');
			$save['total_amount']	= $this->input->post('totalamount');
			$save['balance']	    = $this->input->post('totalamount');
			$save['purpose']	    = $this->input->post('txtPurpose');
			$save['start_date']	    = $this->input->post('startdate');
			$save['end_date']	    = $this->input->post('enddate');
			$save['projectid']	    = $this->input->post('project_id');
			$save['buildingid']	    = $this->input->post('building_id');
			$save['unitid']	        = $this->input->post('unitid');
			$save['maintenance_services'] = json_encode($this->input->post('maintenance_services'));
			$save['Other_services']       = json_encode($this->input->post('services')); 
			$this->Fund_model->property_management_fee_save($save,$ids);
			if($id){
				$this->session->set_flashdata('message', lang('Fund_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('Fund_Insert'));
			}
			
			redirect('admin/Fund/property_management_fee');
		}
	}	
	function property_management_fee_delete($id = false){
		if ($id){	
			$pmf	= $this->Fund_model->get_property_management_fee_fund($id);
			if (!$pmf)
			{
				$this->session->set_flashdata('error', lang('Fund_Record_Not_found'));
			    redirect('admin/Fund/property_management_fee');
			}else{
				$delete	= $this->Fund_model->reserve_fund_delete($id);
				$this->session->set_flashdata('message', lang('fund_record_deleted'));
				redirect('admin/Fund/property_management_fee');
			}
		}
		else{
			    $this->session->set_flashdata('error', lang('Fund_Record_Not_found'));
				redirect('admin/Fund/property_management_fee');
		}
	}
}