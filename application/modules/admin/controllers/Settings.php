<?php
class Settings extends Admin_Controller {

	function __construct(){		
		parent::__construct();
		$this->load->model(array('setting_model','language_model','currency_model','tax_model','payroll/global_model'));
		//echo '<pre>'; print_r($_SESSION);die;
			$this->load->library('form_validation');
			$this->load->library("pagination");
		    $this->load->helper("url");
		    $this->load->helper('form');
			
	}
	function index(){
		$fonts			=	json_decode(file_get_contents('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCmvcRx-h8aQxpKJ8-y3otFEiQH_7ylz5U'));
		$data['fonts']	=	$fonts->items;
		//echo '<pre>'; print_r($data['fonts']);die;
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('settings');
		$data['languages']		= $this->language_model->get_all();
		$data['currency']		= $this->currency_model->get_all();
		$data['taxes']			= $this->tax_model->get_all();
		//default values are empty if the customer is new
		$data['id']					= '';
		$data['name']				= '';
		$data['maintenance_mode']				= 0;
		$data['setting']			=	$setting		= $this->setting_model->get();
		if (!empty($setting)){	
			//set values to db values
			$data['id']								= $setting->id;
			$data['name']							= $setting->name;
			$data['maintenance_mode']				= $setting->maintenance_mode;
			$data['room_block_period']			    = $setting->room_block_start_date.' / '.$setting->room_block_end_date;
		}
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');		
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/form', $data);		
		}else{
			$this->load->library('upload');	
				if(!empty($_FILES['logo']['name'])){
						$_FILES['userfile']['name']= time().rand(1,988).'.'.substr(strrchr($_FILES['logo']['name'],'.'),1);	
						$_FILES['userfile']['tmp_name']= $_FILES['logo']['tmp_name'];
						$_FILES['userfile']['type']= $_FILES['logo']['type'];
						$_FILES['userfile']['error']= $_FILES['logo']['error'];
						$_FILES['userfile']['size']= $_FILES['logo']['size'];
						$save['logo'] = $_FILES['userfile']['name'];
						$this->upload->initialize($this->set_upload_options());
						$flag = $this->upload->do_upload();
						$this->upload->data();
						if(file_exists(BASEPATH.'../assets/admin/uploads/images/'.$this->input->post('old_logo')) && $flag)
							unlink(BASEPATH.'../assets/admin/uploads/images/'.$this->input->post('old_logo'));
				}
			$room_block_period	=	explode('/',$_POST['room_block_period']);	
			$save['id']				= $this->input->post('id');
			$save['name']			= $this->input->post('name');
			$save['address']		= $this->input->post('address');
			$save['email']			= $this->input->post('email');
			$save['phone']			= $this->input->post('phone');
			$save['fax']			= $this->input->post('fax');
			$save['footer_text']	= $this->input->post('footer_text');
			$save['language']		= $this->input->post('language');
			$save['currency']		= $this->input->post('currency');
			$save['date_format']			= $this->input->post('date_format');
			$save['timezone']			= $this->input->post('timezone');
			$save['minimum_booking']			= $this->input->post('minimum_booking');
			$save['advance_payment']			= $this->input->post('advance_payment');
			$save['taxes']			= json_encode($this->input->post('taxes'));
			$save['check_in_time']			= $this->input->post('check_in_time');
			$save['check_out_time']			= $this->input->post('check_out_time');
			$save['time_format']			= $this->input->post('time_format');
			$save['maintenance_mode']			= $this->input->post('maintenance_mode');
			$save['maintenance_message']			= $this->input->post('maintenance_message');
			$save['smtp_mail']			= $this->input->post('smtp_mail');
			$save['smtp_host']			= $this->input->post('smtp_host');
			$save['smtp_user']			= $this->input->post('smtp_user');
			$save['smtp_pass']			= $this->input->post('smtp_pass');
			$save['smtp_port']			= $this->input->post('smtp_port');
			$save['invoice']			= $this->input->post('invoice');
			$save['room_block_start_date']			= date('Y-m-d', strtotime($room_block_period[0]));
			$save['room_block_end_date']			= date('Y-m-d', strtotime($room_block_period[1]));
			$save['paypal']					= $this->input->post('paypal');
			$save['stripe']					= $this->input->post('stripe');
			$save['pay_on_arrival']			= $this->input->post('pay_on_arrival');
			$save['paypal_sandbox']			= $this->input->post('paypal_sandbox');
			$save['paypal_business_email']	= $this->input->post('paypal_business_email');
			$save['stripe_key']				= $this->input->post('stripe_key');
			$save['stripe_api_key']			= $this->input->post('stripe_api_key');
			$save['facebook_link']					    = $this->input->post('facebook_link');
			$save['twitter_link']					    = $this->input->post('twitter_link');
			$save['google_plus_link']					= $this->input->post('google_plus_link');
			$save['linkedin_link']					    = $this->input->post('linkedin_link');
			$save['cancellation_policy']				= $this->input->post('cancellation_policy');
			$save['content_section_title']			    = $this->input->post('content_section_title');
			$save['content_section_description']		= $this->input->post('content_section_description');
			
		
			$save['meta_description']			        = $this->input->post('meta_description');
			$save['meta_keywords']				        = $this->input->post('meta_keywords');
			$save['auto_db_backup']				        = $this->input->post('auto_db_backup');
			$save['auto_to_file_backup']				= $this->input->post('auto_to_file_backup');
			
			//echo '<pre>'; print_r($save);die;
			$this->setting_model->save($save);
			$this->session->set_flashdata('message', lang('setting_update'));
			redirect('admin/settings');
		}
	}
	
	function export(){
		 $this->load->dbutil();
		 $prefs = array(     
					'format'      => 'zip',             
					'filename'    => 'db_backup.sql'
		 );
	  	$backup =& $this->dbutil->backup($prefs); 
	  	$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
	  	$this->load->helper('download');
		force_download($db_name, $backup);
	}
	
	private function set_upload_options()
	{  //  upload an image and document options
		$config = array();
		$config['upload_path'] = BASEPATH.'../assets/admin/uploads/images/';
		$config['allowed_types'] = 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG';
		$config['max_size'] = '0'; // 0 = no file size limit
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['overwrite'] = TRUE;
		return $config;
	}
	function OwnerType()
	{
		$admin = $this->session->userdata('admin'); 
		$data['page_title']	= lang('OwnerType');
		$data['OwnerType']	= $this->setting_model->get_all();
		$this->render_admin('settings/ownertype_list', $data);		
	}
 
	function Ownertypeview($id,$tab=false){
		
		$admin = $this->session->userdata('admin');
		$data['OwnerType']			=	$OwnerType		= $this->setting_model->get_Ownertype($id);
		$data['page_title']	= lang('view')." ".lang('OwnerType') ;
		$this->render_admin('settings/ownertype_view', $data);
	}
	function Ownerform($id = false)
	{
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		        = lang('OwnerType_form');
		$data['id']					    = '';
		$data['OwnerType']				= '';
		$data['Description']			= '';
		if ($id)
		{	
			$data['Ownertype']			=	$Ownertype		= $this->setting_model->get_Ownertype($id);
			if (!$Ownertype)
			{
				$this->session->set_flashdata('error', lang('OwnerType_Not_found'));
				redirect('Settings/OwnerType');
			}
			$data['id']					= $Ownertype->id;
			$data['OwnerType']				= $Ownertype->OwnerType;
			$data['Description']			= $Ownertype->Description;
		}
		$this->form_validation->set_rules('OwnerType', 'lang:OwnerType', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('settings/Ownertype_form', $data);		
		}
		else
		{
			 $save['id']	=$this->input->post('ids');
			 $save['OwnerType']			= $this->input->post('OwnerType');
			 $save['Description']	    = $this->input->post('Description');
		    $this->setting_model->OwnerTypesave($save,$id);
			if($id){
				$this->session->set_flashdata('message', lang('OwnerType_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('OwnerType_Saved'));
			}
			redirect('admin/Settings/OwnerType'); 
		}
	}
	
	function ownerdelete($id = false)
	{
		if ($id)
		{	
			$Ownertype	= $this->setting_model->get($id);
			if (!$Ownertype)
			{
				$this->session->set_flashdata('error', lang('OwnerType_Not_found'));
				redirect('admin/Settings/OwnerType');
			}
			else
			{
				
				$delete	= $this->setting_model->Ownertype_delete($id);
				$this->session->set_flashdata('message', lang('OwnerType_delete'));
				redirect('admin/Settings/OwnerType');
			}
		}
		else
		{
			    $this->session->set_flashdata('error', lang('OwnerType_Not_found'));
				redirect('admin/Settings/OwnerType');
		}
	}

	function ProjectType(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	    = lang('ProjectType');
		$data['ProjectType']	= $this->setting_model->get_ProjectType_all();
		$this->render_admin('settings/ProjectType_list', $data);		
	}
	function ProjectTypeview($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['ProjectType']			=	$ProjectType		= $this->setting_model->get_ProjectType($id);
		$data['page_title']	= lang('view')." ".lang('ProjectType') ;
		$this->render_admin('settings/ProjectType_view', $data);
	}
	function ProjectTypeform($id = false){
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('ProjectType_form');
		$data['id']					= '';
		$data['ProjectType']		= '';
		$data['Description']	    = '';
		if ($id){	
			$data['ProjectType']			=	$ProjectType		= $this->setting_model->get_ProjectType($id);
			if (!$ProjectType){
				$this->session->set_flashdata('error', lang('Unit_not_found'));
				redirect('Settings/ProjectType');
			} 
			$data['id']					        = $ProjectType->id;
			$data['ProjectType']				= $ProjectType->ProjectType;
			$data['Description']			    = $ProjectType->Description;
		}
		$this->form_validation->set_rules('ProjectType', 'lang:ProjectType', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/ProjectType_form', $data);		
		}else{
			  $save['id']=$this->input->post('ids');
			  $save['ProjectType']			= $this->input->post('ProjectType');
			  $save['Description']			= $this->input->post('Description');
		     $this->setting_model->ProjectTypesave($save);
			if($id){
				$this->session->set_flashdata('message', lang('ProjectType_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('ProjectType_Save'));
			}
			redirect('admin/Settings/ProjectType'); 
		}
	}
	
	function Projecttypedelete($id = false){
		if ($id){	
			$ProjectType	= $this->setting_model->get($id);
			if (!$ProjectType){
				$this->session->set_flashdata('error', lang('ProjectType_not_found'));
				redirect('admin/Settings/ProjectType');
			}
			else{
				$delete	= $this->setting_model->ProjectTypedelete($id);
				$this->session->set_flashdata('message', lang('ProjectType_Delete'));
				redirect('admin/Settings/ProjectType');
			}
		}
		else{
			  $this->session->set_flashdata('error', lang('ProjectType_not_found'));
			   redirect('admin/Settings/ProjectType');
		}
	}

		function soc()
	     {
		   $admin = $this->session->userdata('admin');
		   $data['page_title']	= lang('Soc_');
		   $data['Soc']	= $this->setting_model->SOC_all();
		   $this->render_admin('settings/soc_list', $data);		
	  }
	
	function Socview($id,$tab=false){
		
		$admin = $this->session->userdata('admin');
		$data['soc']			=	$soc		= $this->setting_model->SOC_get($id);
		$data['page_title']	= lang('view')." ".lang('Soc_') ;
		$this->render_admin('settings/soc_view', $data);
	}
	function Socform($id = false)
	{
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		    = lang('Soc_Form');
		$data['id']					= '';
		$data['Name']			    = '';
		$data['Percentage']			= '';
		$data['Description']	    = '';
		if ($id)
		{	
			$data['soc']			=	$soc		= $this->setting_model->SOC_get($id);
			if (!$soc)
			{
				$this->session->set_flashdata('error', lang('Soc_not_found'));
				redirect('admin/Settings/soc');
			}
			$data['id']			        = $soc->id;
			$data['Name']			        = $soc->Name;
			$data['Description']			= $soc->Description;
			$data['Percentage']				= $soc->Percentage;
		}
		$this->form_validation->set_rules('Name', 'lang:Soc_Name', 'trim|required');
		$this->form_validation->set_rules('Percentage', 'lang:Soc_Percentage', 'trim|required');
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('settings/soc_form', $data);		
		}
		else
		{
			 $save['id']=$this->input->post('ids');
			$save['Name']			= $this->input->post('Name');
			$save['Percentage']			= $this->input->post('Percentage');
			$save['Description']			= $this->input->post('description');
		   $this->setting_model->Socsave($save);
			if($id){
				$this->session->set_flashdata('message', lang('Soc_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('Soc_Saved'));
			}
			redirect('admin/Settings/soc'); 
		}
	}

	function Socdelete($id = false)
	{
		if ($id)
		{	
			$soc	= $this->setting_model->SOC_get($id);
			
			if (!$soc)
			{
				$this->session->set_flashdata('error', lang('Soc_not_found'));
				redirect('admin/Settings/soc');
			}
			else
			{
			
				$delete	= $this->setting_model->Socdelete($id);
				
				$this->session->set_flashdata('message', lang('Soc_Deleted'));
				redirect('admin/Settings/soc');
			}
		}
		else
		{
			$this->session->set_flashdata('error', lang('Soc_not_found'));
		   redirect('admin/Settings/soc');
		}
	}

			function Amenities()
	    {
		  $admin = $this->session->userdata('admin');
	   	  $data['page_title']	= lang('Amenties');
		  $data['Amenties']	= $this->setting_model->get_amenities_all();
		  $data['AmentiesType']	= $this->setting_model->get_AmenitiesType();
		  $this->render_admin('settings/ammenties_list', $data);		
	   }
	function Amenitiesview($id,$tab=false){
		
		$admin = $this->session->userdata('admin');
		$data['Amenties']			=	$Amenties		= $this->setting_model->get_amenities($id);
		$data['page_title']	= lang('view')." ".lang('Amenties') ;
		$this->render_admin('settings/ammenties_view', $data);
	}
	function Amenitiesform($id = false)
	{
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['propertytypes']	=	$Amenities		= $this->setting_model->get_AmenitiesType();
		$data['page_title']		= lang('Amenities_form');
		$data['id']				= '';
		$data['Name']			= '';
		$data['Perperty_type']	= '';
		$data['Description']	= '';
		$data['Property']	    ='';
		$data['AmenitiesType']	='';
		$data['AmenitiesPrice']	='';
		if ($id)
		{	
			$data['Amenities']	=	$Amenities		= $this->setting_model->get_amenities($id);
			if (!$Amenities)
			{
				$this->session->set_flashdata('error', lang('Amenities_not_found'));
				 redirect('admin/Settings/Amenities');
			}
			$data['id']					= $Amenities->id;
			$data['Name']				= $Amenities->NAME;
			$data['Perperty_type']		= $Amenities->Perperty_type;
			$data['Description']		= $Amenities->Description;
			$data['AmenitiesType']	    =$Amenities->AmenitiesType;
		    $data['AmenitiesPrice']	    =$Amenities->AmenitiesPrice;
		}
		
		$this->form_validation->set_rules('Perperty_type', 'lang:AmenitiesType', 'trim|required');
		$this->form_validation->set_rules('Name', 'lang:Name', 'trim|required');
		$this->form_validation->set_rules('AmenitiesType', 'lang:AmenitiesType', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('settings/ammenties_form', $data);		
		}
		else
		{
			 $save['id']            =$this->input->post('ids');
			 $save['Name']			= $this->input->post('Name');
			 $save['Perperty_type']	= $this->input->post('Perperty_type');
			 $save['Description']   =$this->input->post('Description');
			 $save['AmenitiesType']	=$this->input->post('AmenitiesType');
		     $save['AmenitiesPrice']=$this->input->post('AmenitiesPrice');
		     $this->setting_model->Amenitiessave($save);
			if($id){
				$this->session->set_flashdata('message', lang('Amenities_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('Amenities_Save'));
			}
			redirect('admin/Settings/Amenities'); 
		}
	}
		
	function Amenitiesdelete($id = false)
	{
		if ($id)
		{	
			$floor	= $this->setting_model->get($id);
			if (!$floor)
			{
				$this->session->set_flashdata('error', lang('Amenities_not_found'));
				redirect('admin/Settings/Amenities');
			}
			else
			{
			
				$delete	= $this->setting_model->Amenitiesdelete($id);
				$this->session->set_flashdata('message', lang('Amenities_Delete'));
				redirect('admin/Settings/Amenities');
			}
		}
		else
		{
			
			$this->session->set_flashdata('error', lang('Amenities_not_found'));
				redirect('admin/Settings/Amenities');
		}
	}
	function  Userprivilege($id){
		$data['id']=$id;
		
		$data['roles']	= $this->setting_model->get_userrole();
		$data['userrole']	= $this->setting_model->get_userrole_permission($id);
		
		$this->render_admin('settings/Userprivilege',$data);		
	}
	function screenpermission_save(){
	  $this->form_validation->set_rules('UserGroup', lang("UserGroup"), 'trim|required');
	 $UserGroup=$this->input->post('UserGroup');
        if ($this->form_validation->run() == true) {
			   $data = array(
			   'Group_id'=>$UserGroup,
			   'Project_index'=>$this->input->post('project_view'),
			   'Project_add'=>$this->input->post('project_add'),
			   'Project_edit'=>$this->input->post('project_edit'),
			   'Project_delete'=>$this->input->post('project_delete'),
			   'Units_index'=>$this->input->post('unit_view'),
			   'Units_edit'=>$this->input->post('unit_edit'),
			   'Units_add'=>$this->input->post('unit_add'),
			   'Units_delete'=>$this->input->post('unit_delete'),
			   'Floor_index'=>$this->input->post('floor_view'),
			   'Floors_add'=>$this->input->post('floor_add'),
			   'Floors_edit'=>$this->input->post('floor_edit'),
			   'Floors_delete'=>$this->input->post('floor_delete'),
			   'Owner_index'=>$this->input->post('Owner_view'),
			   'Owner_add'=>$this->input->post('Owner_add'),
			   'Owner_edit'=>$this->input->post('Owner_edit'),
			   'Owner_delete'=>$this->input->post('Owner_delete'),
			   'Guests_indexs'=>$this->input->post('Guest_view'),
			   'Guests_adds'=>$this->input->post('Guest_add'),
			   'Guests_edits'=>$this->input->post('Guest_edit'),
			   'Guests_deletes'=>$this->input->post('Guest_delete'),
			   'LeaseOwner_index'=>$this->input->post('LeaseOwner_view'),
			   'LeaseOwner_add'=>$this->input->post('LeaseOwner_add'),
			   'LeaseOwner_edit'=>$this->input->post('LeaseOwner_edit'),
			   'LeaseOwner_delete'=>$this->input->post('LeaseOwner_delete'),
			   'Complaint_index'=>$this->input->post('Complaint_view'),
			   'Complaint_add'=>$this->input->post('Complaint_add'),
			   'Complaint_edit'=>$this->input->post('Complaint_edit'),
			   'Complaint_delete'=>$this->input->post('Complaint_delete'),
			   'Fund_index'=>$this->input->post('fund_view'),
			   'Fund_add'=>$this->input->post('fund_add'),
			   'Fund_edit'=>$this->input->post('fund_edit'),
			   'Fund_delete'=>$this->input->post('fund_delete'),
			   'Management_committee_add'=>$this->input->post('Manage_committe_add'),
			   'Management_committee_inedx'=>$this->input->post('Manage_committe_view'),
			   'Management_committee_edit'=>$this->input->post('Manage_committe_edit'),
			   'Management_committee_delete'=>$this->input->post('Manage_committe_delete'),
			   'Facility_index'=>$this->input->post('Facility_view'),
			   'Facility_add'=>$this->input->post('Facility_add'),
			   'Facility_edit'=>$this->input->post('Facility_edit'),
			   'Facility_delete'=>$this->input->post('Facility_delete'),
			   'Services_index'=>$this->input->post('services_view'),
			   'Services_add'=>$this->input->post('services_add'),
			   'Services_delete'=>$this->input->post('services_delete'),
			   'Services_edit'=>$this->input->post('services_edit'),
			   'Accounts_indexs'=>$this->input->post('Accounts_view'),
			   'Accounts_adds'=>$this->input->post('Accounts_add'),
			   'Accounts_edits'=>$this->input->post('Accounts_edit'),
			   'Accounts_deletes'=>$this->input->post('Accounts_delete'),
			   'Parking_Manager_index'=>$this->input->post('Parking_Manager_view'),
			   'Parking_Manager_add'=>$this->input->post('Parking_Manager_add'),
			   'Parking_Manager_edit'=>$this->input->post('Parking_Manager_edit'),
			   'Parking_Manager_delete'=>$this->input->post('Parking_Manager_delete'),
			   'Parking_Slot_index'=>$this->input->post('slot_view'),
			   'ParkingSlot_add'=>$this->input->post('slot_add'),
			   'ParkingSlot_edit'=>$this->input->post('slot_edit'),
			   'ParkingSlot_delete'=>$this->input->post('slot_delete'),
			   'Inventory_index'=>$this->input->post('Inventory_view'),
			   'Inventory_add'=>$this->input->post('Inventory_add'),
			   'Inventory_edit'=>$this->input->post('Inventory_edit'),
			   'Inventory_delete'=>$this->input->post('Inventory_delete'),
			   'Assets_index'=>$this->input->post('assets_view'),
			   'Assets_add'=>$this->input->post('assets_add'),
			   'Assets_edit'=>$this->input->post('assets_edit'),
			   'Assets_delete'=>$this->input->post('assets_delete'),
			   'Employees_index'=>$this->input->post('employee_view'),
			   'Employees_add'=>$this->input->post('employee_add'),
			   'Employees_edit'=>$this->input->post('employee_edit'),
			   'Employees_delete'=>$this->input->post('employee_delete'),
			   'Departments_index'=>$this->input->post('departments_View'),
			   'Departments_add'=>$this->input->post('departments_add'),
			   'Departments_edit'=>$this->input->post('departments_edit'),
			   'Departments_delete'=>$this->input->post('departments_delete'),
			   'Designations_index'=>$this->input->post('Designations_view'),
			   'Designations_add'=>$this->input->post('Designations_add'),
			   'Designations_edit'=>$this->input->post('Designations_edit'),
			   'Designations_delete'=>$this->input->post('Designations_delete'),
			   'Employee_salary_index'=>$this->input->post('Employee_salary_view'),
			   'Employee_salary_adds'=>$this->input->post('Employee_salary_add'),
			   'Employee_salary_edit'=>$this->input->post('Employee_salary_edit'),
			   'Employee_salary_delete'=>$this->input->post('Employee_salary_delete'),
			   'Perperty_Dashboard'=>$this->input->post('perpertyview'),
			   'Accounts_index'=>$this->input->post('Accountsview'),
			   'Accounts_add'=>$this->input->post('Accountsadd'),
			   'Accounts_edit'=>$this->input->post('Accountsedit'),
			   'Accounts_delete'=>$this->input->post('Accountsdelete'),
			   'Settings_index'=>$this->input->post('settingsview'),
			   'Settings_add'=>$this->input->post('settingsadd'),
			   'Settings_edit'=>$this->input->post('settingsedit'),
			   'Settings_delete'=>$this->input->post('settingsdelete'),
			   'Languages_index'=>$this->input->post('Languagesview'),
			   'Languages_add'=>$this->input->post('Languagesadd'),
			   'Languages_edit'=>$this->input->post('Languagesedit'),
			   'Languages_delete'=>$this->input->post('Languagesdelete'),
			   'Currency_index'=>$this->input->post('Currencyview'),
			   'Currency_add'=>$this->input->post('Currencyadd'),
			   'Currency_edit'=>$this->input->post('Currencyedit'),
			   'Currency_delete'=>$this->input->post('Currencydelete'),
			   'Locations_index'=>$this->input->post('Locationsview'),
			   'Locations_add'=>$this->input->post('Locationadd'),
			   'Locations_edit'=>$this->input->post('Locationedit'),
			   'Locations_delete'=>$this->input->post('Locationdelete'),
			   'Testimonials_index'=>$this->input->post('Testimonialsview'),
			   'Testimonials_add'=>$this->input->post('Testimonialsadd'),
			   'Testimonials_edit'=>$this->input->post('Testimonialsedit'),
			   'Testimonials_delete'=>$this->input->post('Testimonialsedelete'),
			   'Owner_Type_index'=>$this->input->post('Owner_Type_view'),
			   'Owner_Type_add'=>$this->input->post('Owner_Type_add'),
			   'Owner_Type_edit'=>$this->input->post('Owner_Type_edit'),
			   'Owner_Type_delete'=>$this->input->post('Owner_Type_delete'),
			   'Soc_index'=>$this->input->post('Socview'),
			   'Soc_add'=>$this->input->post('Socadd'),
			   'Soc_edit'=>$this->input->post('Socedit'),
			   'Soc_delete'=>$this->input->post('Socdelete'),
			   'Amenities_index'=>$this->input->post('Amenitiesview'),
			   'Amenities_add'=>$this->input->post('Amenitiesadd'),
			   'Amenities_edit'=>$this->input->post('Amenitiesedit'),
			   'Amenities_delete'=>$this->input->post('Amenitiesdelete'),
			   'Lease_Owner_index'=>$this->input->post('Lease_Owner_view'),
			   'Lease_Owner_add'=>$this->input->post('Lease_Owner_add'),
			   'Lease_Owner_edit'=>$this->input->post('Lease_Owner_edit'),
			   'Lease_Owner_delete'=>$this->input->post('Lease_Owner_delete'),
			   'Booked_guestlist_index'=>$this->input->post('Booked_guestlist_view'),
			   'Booked_guestlist_add'=>$this->input->post('Booked_guestlist_add'),
			   'Booked_guestlist_edit'=>$this->input->post('Booked_guestlist_edit'),
			   'Booked_guestlist_delete'=>$this->input->post('Booked_guestlist_delete'),
			   'Guest_Book_List_index'=>$this->input->post('Guest_Book_List_view'),
			   'Guest_Book_List_add'=>$this->input->post('Guest_Book_List_add'),
			   'Guest_Book_List_edit'=>$this->input->post('Guest_Book_List_edit'),
			   'Guest_Book_List_delete'=>$this->input->post('Guest_Book_List_delete'),
			   'Delivery_Level_index'=>$this->input->post('Lease_Book_Listview'),
			   'Delivery_Level_add'=>$this->input->post('Lease_Book_Listadd'),
			   'Delivery_Level_edit'=>$this->input->post('Lease_Book_Listedit'),
			   'Delivery_Level_delete'=>$this->input->post('Lease_Book_Listdelete'),
			   'unitlevelview'=>$this->input->post('unitlevelview'),
			   'unitleveladd'=>$this->input->post('unitleveladd'),
			   'unitleveledit'=>$this->input->post('unitleveledit'),
			   'unitleveldelete'=>$this->input->post('unitleveldelete'),
			   'Delivery_Level_index'=>$this->input->post('Deliveryview'),
			   'Delivery_Level_add'=>$this->input->post('Deliveryadd'),
			   'Delivery_Level_edit'=>$this->input->post('Deliveryedit'),
			   'Delivery_Level_delete'=>$this->input->post('Deliverydelete'),
			   'bookingview'=>$this->input->post('Booking_view'),
			   'bookingadd'=>$this->input->post('Booking_add'),
			   'bookingedit'=>$this->input->post('Booking_edit'),
			   'bookingdelete'=>$this->input->post('Booking_delete'),
			   'Check_In_index'=>$this->input->post('checkinview'),
			   'Check_In_add'=>$this->input->post('checkinadd'),
			   'Check_In_edit'=>$this->input->post('checkedit'),
			   'Check_In_delete'=>$this->input->post('checkdelete'),
			   'Checkout_index'=>$this->input->post('Checkoutview'),
			   'Checkout_add'=>$this->input->post('Checkoutadd'),
			   'checkout_edit'=>$this->input->post('Checkoutedit'),
			   'Checkout_delete'=>$this->input->post('Checkout_delete'),
				'Invoice_List_index'=>$this->input->post('invoicelistview'),
				'complaint_Services_index'=>$this->input->post('complaintview'),	
				'complaint_Services_add'=>$this->input->post('complaintadd'),	
				'complaint_Services_edit'=>$this->input->post('complaintedit'),	
				'complaint_Services_delete'=>$this->input->post('complaintdelete'));
				
		}
		
        if ($this->form_validation->run() == true && $this->setting_model->updatePermissions($id,$data,$UserGroup)) {
           $this->session->set_flashdata('message', lang("UserPermissionupdated"));
            redirect('admin/settings/userrolelist');
        } else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('admin/settings/userrolelist');
		}
	}
	function userrolelist(){
		$data['page_title']=lang('UserRoleList');
		$data['userrolelist']=$this->setting_model->GetUserlist();
		$this->render_admin('settings/userrolelist', $data);		
		
	}
		function userroleladd(){
			$id=$this->input->post('name');
			if(!empty($id)){
		        $data = array(
			   'Role_name'=>$this->input->post('name'));
               $this->setting_model->userroleeditsave($id,$data);
			}else
			{
				$data = array(
			   'Role_name'=>$this->input->post('name'));
		       $insert=$this->setting_model->userroleAdd($data);
		       $this->session->set_flashdata('message', lang("UserPermissionupdated"));
               redirect('admin/settings/userrolelist');
			}
		
	}
	function userroleeditload(){
		$id=$this->input->post('id');
		$result=$this->setting_model->getedituserrole($id);
		echo json_encode($result);
	}
		
	function Approved()
	{
		 $admin                = $this->session->userdata('admin');
		 $data['page_title']   = lang('Approved_stage');
		 $config 			   = array();
         $config["base_url"]   = base_url() . "admin/Settings/Approved";
         $config["total_rows"] = $this->setting_model->Approved_record_count();
         $config["per_page"]   = 10;
         $config["uri_segment"]= 4;
         $this->pagination->initialize($config);
         $page                 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
         $data['approved_stages']   = $this->setting_model->get_all_approved_stage($config["per_page"], $page);
         $data["links"]        = $this->pagination->create_links();
	     $this->render_admin('settings/Approved_list', $data);		
	}
 	function Approved_view($id,$tab=false){
		$data['Approved_stage']			=	$Approved_stage		= $this->setting_model->getApproved_stage($id);
		$data['page_title']	= lang('view')." ".lang('Approved_stage') ;
		$this->render_admin('settings/Approved_view', $data);
	}
	function Approved_form($id = false)
	{
		$data['soc']	= $this->setting_model->get_all_soc();	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('Approved_stage');
		$data['id']				 	        = '';
		$data['project_stage']			    = '';
		$data['Name']			            = '';
		$data['description']				= '';
		if ($id){
			$data['Approved_stage']			=	$Approved_stage		= $this->setting_model->getApproved_stage($id);
			if (!$Approved_stage){
				$this->session->set_flashdata('error', lang('Approved_stage_not_found'));
				redirect('admin/Settings/Approved');
			}
			$data['id']					    = $Approved_stage->id;
			$data['project_stage']			= $Approved_stage->Project_stage_id;
			$data['Name']			        = $Approved_stage->Name;
			$data['description']			= $Approved_stage->description;
			
		}
		$this->form_validation->set_rules('Name', 'lang:Approved_Name', 'trim|required');
		$this->form_validation->set_rules('project_stage', 'lang:Project_Stage', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/Approved_form', $data);		
		}else
		{	
			$save['id']					= $id;
			$save['description']			= $this->input->post('description');
			$save['Name']			= $this->input->post('Name');
			$save['Project_stage_id']				= $this->input->post('project_stage');
			if(!$id){
				$save['added']				= date('Y-m-d H:i:s');
			}
			$this->setting_model->Add_approved_stage($save);
			if($id){
				$this->session->set_flashdata('message', lang('Approved_stage_updated'));
			}else{
				$this->session->set_flashdata('message', lang('Approved_stage_Saved'));
			}
			redirect('admin/Settings/Approved'); 
		}
	}
	
	function Approved_stage_delete($id = false)
	{
		if ($id)
		{	
		    $approved	= $this->setting_model->getApproved_stage($id);
			if (!$approved){
				$this->session->set_flashdata('error', lang('Approved_stage_not_found'));
				redirect('admin/Settings/Approved'); 
			}
			else
			{
			    $delete	= $this->setting_model->Aproved_stage_delete($id);
				$this->session->set_flashdata('message', lang('Approved_stage_Deleted'));
				redirect('admin/Settings/Approved'); 
			}
		}
		else
		{
			     $this->session->set_flashdata('error', lang('Approved_stage_not_found'));
				 redirect('admin/Settings/Approved'); 
		}
	} 

	function UOM(){
		 $admin                = $this->session->userdata('admin');
		 $data['page_title']   = lang('UOM');
		 $config 			   = array();
         $config["base_url"]   = base_url() . "admin/Settings/UOM";
         $config["total_rows"] = $this->setting_model->UOM_record_count();
         $config["per_page"]   = 10;
         $config["uri_segment"]= 4;
         $this->pagination->initialize($config);
         $page                 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
         $data['uom']          = $this->setting_model->get_all_UOM($config["per_page"], $page);
         $data["links"]        = $this->pagination->create_links();
	     $this->render_admin('settings/Uom_list', $data);		
	}
 	function UOM_view($id,$tab=false){
		$data['uom']			            =$UOM		= $this->setting_model->getUOM($id);
		$data['uomlist']			       	= $this->setting_model->get_uom();
		$data['page_title']	= lang('view')." ".lang('UOM') ;
		$this->render_admin('settings/Uom_view', $data);
	}
	function UOM_form($id = false){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		            = lang('UOM');
	    $data['uomlist']			       	= $this->setting_model->get_uom();
		$data['id']				 	        = '';
		$data['Name']			            = '';
		$data['description']				= '';
		if ($id){
			$data['UOM']			        =	$UOM		= $this->setting_model->getUOM($id);
			if (!$UOM){
				$this->session->set_flashdata('error', lang('UOM_Not_found'));
				redirect('admin/Settings/UOM');
			}
			$data['id']					     = $UOM->id;
			$data['name']			         = $UOM->Name;
			$data['description']             = $UOM->description;
			$data['default_uom']             = $UOM->default_uom;
			$data['convert_rate']            = $UOM->convert_rate;
		}
		$this->form_validation->set_rules('UOM_name', 'lang:UOM_name', 'trim|required');
		$this->form_validation->set_rules('UOM_Description', 'lang:UOM_Description', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/Uom_form', $data);		
		}else{
			$save['id']					   = $id;
			$save['Name']		           = $this->input->post('UOM_name');
			$save['description']		   = $this->input->post('UOM_Description');
			$save['default_uom']		   = !empty($this->input->post('default_uom'))?$this->input->post('default_uom'):0;
			$save['convert_rate']		   = $this->input->post('convert_rate');
			if(!$id){
				$save['added']				= date('Y-m-d H:i:s');
			}
			$this->setting_model->Add_UOM($save);
			if($id){
				$this->session->set_flashdata('message', lang('UOM_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('UOM_Saved'));
			}
			redirect('admin/Settings/UOM'); 
		}
	}
	
	function UOM_delete($id = false){
		if ($id){	
			$approved	= $this->setting_model->getUOM($id);
			if (!$approved){
				$this->session->set_flashdata('error', lang('UOM_Not_found'));
				redirect('admin/Settings/UOM'); 
			}
			else{
				$delete	= $this->setting_model->UOM_delete($id);
				$this->session->set_flashdata('message', lang('UOM_Deleted'));
				redirect('admin/Settings/UOM'); 
			}
		}else{
			$this->session->set_flashdata('error', lang('UOM_Not_found'));
				redirect('admin/Settings/UOM'); 
		}
	} 
	function workingDays(){
		$data['workingDays'] = $this->db->get('working_days')->result();
		//$this->render('office/working_days');
		$this->render_admin('settings/working_days', $data);	
	}

	public function save_working_days()	{
		$workingDaysId = $this->input->post('working_days');
		$days = $this->input->post('days');
		foreach($days as $day){
			foreach($workingDaysId as $id){
				if($day == $id){
					$data['flag'] = 1;
					$this->db->where('id', $id);
					$this->db->update('working_days', $data);
					$val = array_search($id, $days);
					unset($days[$val]);
				}
			}
		}
		foreach($days as $day){
			$data['flag'] = 0;
			$this->db->where('id', $day);
			$this->db->update('working_days', $data);
		}
		$this->session->set_flashdata('message', lang('Workingday_Saved'));
		redirect('admin/settings/workingDays'); 
	}
	function Material(){
		 $admin                = $this->session->userdata('admin');
		 $data['page_title']   = lang('Material');
		 $config 			   = array();
         $config["base_url"]   = base_url() . "admin/Settings/Material";
         $config["total_rows"] = $this->setting_model->material_record_count();
         $config["per_page"]   = 10;
         $config["uri_segment"]= 4;
         $this->pagination->initialize($config);
         $page                 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
         $data['material']          = $this->setting_model->get_all_material($config["per_page"], $page);
         $data["links"]        = $this->pagination->create_links();
	     $this->render_admin('settings/Material_list', $data);		
	}
 	function Material_view($id,$tab=false){
		$data['material']			=	$material		= $this->setting_model->getMaterial($id);
		$data['page_title']	= lang('view')." ".lang('Material') ;
		$this->render_admin('settings/Material_view', $data);
	}
	function Material_form($id = false){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('Material');
		$data['id']				 	        = '';
		$data['Name']			            = '';
		$data['description']				= '';
		if ($id){
			$data['material']			=	$material = $this->setting_model->getMaterial($id);
			if (!$material){
				$this->session->set_flashdata('error', lang('Material_Not_found'));
				redirect('admin/Settings/Material');
			}
			$data['id']					         = $material->id;
			$data['Material_name']			     = $material->Name;
			$data['Material_Description']        = $material->Description;
		}
		$this->form_validation->set_rules('Material_name', 'lang:Material_name', 'trim|required');
		$this->form_validation->set_rules('Material_Description', 'lang:Material_Description', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/Material_form', $data);		
		}
		else{
			$save['id']					   = $id;
			$save['description']		   = $this->input->post('Material_Description');
			$save['Name']			       = $this->input->post('Material_name');
			if(!$id){
				$save['added']				= date('Y-m-d H:i:s');
			}
			$this->setting_model->Add_Material($save);
			if($id){
				$this->session->set_flashdata('message', lang('Material_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('Material_Saved'));
			}
			redirect('admin/Settings/Material'); 
		}
	}
	
	function Material_delete($id = false){
		if ($id){	
			$material	= $this->setting_model->getMaterial($id);
			if (!$material){
				$this->session->set_flashdata('error', lang('Material_Not_found'));
				redirect('admin/Settings/Material'); 
			}
			else{
				$delete	= $this->setting_model->Material_delete($id);
				$this->session->set_flashdata('message', lang('Material_Deleted'));
				redirect('admin/Settings/Material'); 
			}
		}else{
			$this->session->set_flashdata('error', lang('Material_Not_found'));
			redirect('admin/Settings/Material'); 
		}
	} 

 function Labour()
	{
		 $admin                = $this->session->userdata('admin');
		 $data['page_title']   = lang('Labour');
		 $config 			   = array();
         $config["base_url"]   = base_url() . "admin/Settings/Labour";
         $config["total_rows"] = $this->setting_model->LabourType_record_count();
         $config["per_page"]   = 10;
         $config["uri_segment"]= 4;
         $this->pagination->initialize($config);
         $page                 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
         $data['Labour']          = $this->setting_model->get_all_LabourType($config["per_page"], $page);
         $data["links"]        = $this->pagination->create_links();
	     $this->render_admin('settings/LabourType_list', $data);		
	}
 	function Labour_view($id,$tab=false){
		$data['Labour']			=	$Labour		= $this->setting_model->getLabourType($id);
		$data['page_title']	= lang('view')." ".lang('Labour') ;
		$this->render_admin('settings/LabourType_view', $data);
	}
	function Labour_form($id = false)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('Labour');
		$data['id']				 	        = '';
		$data['Name']			            = '';
		$data['description']				= '';
		if ($id){
			$data['Labour']			=	$Labour = $this->setting_model->getLabourType($id);
			if (!$Labour){
				$this->session->set_flashdata('error', lang('LabourType_Not_found'));
				redirect('admin/Settings/Labour');
			}
			$data['id']					        = $Labour->id;
			$data['LabourType_name']			    = $Labour->Name;
			$data['Type_description']       = $Labour->Description;
		}
		  $this->form_validation->set_rules('LabourType_name', 'lang:LabourType_name', 'trim|required');
		 $this->form_validation->set_rules('Type_description', 'lang:Type_description', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/LabourType_form', $data);		
		}
		else{
			$save['id']					   = $id;
			$save['Description']		   = $this->input->post('Type_description');
			$save['Name']			       = $this->input->post('LabourType_name');
			if(!$id){
				$save['added']				= date('Y-m-d H:i:s');
			}
			$this->setting_model->Add_LabourType($save);
			if($id){
				$this->session->set_flashdata('message', lang('LabourType_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('LabourType_Saved'));
			}
			redirect('admin/Settings/Labour'); 
		}
	}
	
	function Labour_delete($id = false)
	{
		if ($id){	
			$Labour	= $this->setting_model->getLabourType($id);
			if (!$Labour){
				$this->session->set_flashdata('error', lang('LabourType_Not_found'));
				redirect('admin/Settings/Labour'); 
			}
			else{
				$delete	= $this->setting_model->Labour_delete($id);
				$this->session->set_flashdata('message', lang('LabourType_Deleted'));
				redirect('admin/Settings/Labour'); 
			}
		}
		else
		{
			$this->session->set_flashdata('error', lang('LabourType_Not_found'));
			redirect('admin/Settings/Labour'); 
		}
	} 
	function soe()
	     {
		   $admin = $this->session->userdata('admin');
		   $data['page_title']	= lang('source_of_enquiry');
		   $data['soe']	= $this->setting_model->soe();
		   $this->render_admin('settings/soe_list', $data);		
	  }
	
	function soeview($id,$tab=false){
		
		$admin = $this->session->userdata('admin');
		$data['soe']			=	$soe		= $this->setting_model->soe_get($id);
		$data['page_title']	= lang('view')." ".lang('source_of_enquiry') ;
		$this->render_admin('settings/soe_view', $data);
	}
	function soeform($id = false)
	{
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		    = lang('source_of_enquiry_form');
		$data['id']					= '';
		$data['Name']			    = '';
		$data['description']	    = '';
		if ($id)
		{	
			$data['soe']			=	$soe		= $this->setting_model->soe_get($id);
			if (!$soe)
			{
				$this->session->set_flashdata('error', lang('source_of_enquiry_NOF'));
				redirect('admin/Settings/soe');
			}
			$data['id']			            = $soe->id;
			$data['Name']			        = $soe->Name;
			$data['description']			= $soe->Description;
			
		}
		$this->form_validation->set_rules('Name', 'lang:Name', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/soe_form', $data);		
		}else{
			 $save['id']=$this->input->post('id');
			 $save['Name']			= $this->input->post('Name');
			 $save['Description']			= $this->input->post('description');
			
		   $this->setting_model->soesave($save);
			if($id){
				$this->session->set_flashdata('message', lang('source_of_enquiry_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('source_of_enquiry_saved'));
			}
			redirect('admin/Settings/soe'); 
		}
	}

	function soedelete($id = false){
		if ($id){	
			$soe	= $this->setting_model->soe_get($id);
			if (!$soe){
				$this->session->set_flashdata('error', lang('source_of_enquiry_NOF'));
				redirect('admin/Settings/soe');
			}else{
				$delete	= $this->setting_model->soedelete($id);
				$this->session->set_flashdata('message', lang('source_of_enquiry_deleted'));
				redirect('admin/Settings/soe');
			}
		}
		else{
			$this->session->set_flashdata('error', lang('source_of_enquiry_NOF'));
		    redirect('admin/Settings/soe');
		}
	}
	function requestType()
	{
		 $admin                = $this->session->userdata('admin');
		 $data['page_title']   = lang('requesttype');
         $data['requestType']   = $this->setting_model->getRequestTypeAll();
	     $this->render_admin('settings/requestType_list', $data);		
	}
 	function requestType_view($id){
		$data['requestType']			=	$requestType		= $this->setting_model->getRequestType($id);
		$data['page_title']	= lang('view')." ".lang('requesttype') ;
		$this->render_admin('settings/requestType_view', $data);
	}
	function requestType_form($id = false)
	{
		
		$data['page_title']		= lang('requesttype');
		$data['id']				 	        = '';
		$data['Name']			            = '';
		$data['description']				= '';
		if ($id){
			$data['requestType']			=	$requestType		= $this->setting_model->getRequestType($id);
			if (!$requestType){
				$this->session->set_flashdata('error', lang('requestType_not_found'));
				redirect('admin/Settings/requestType_form');
			}
			$data['id']					    = $requestType->id;
			$data['Name']			        = $requestType->Name;
			$data['description']			= $requestType->description;
			
		}
		$this->form_validation->set_rules('Name', 'lang:name', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/requestType_form', $data);		
		}else
		{	
			$save['id']					            = $id;
			$save['description']		         	= $this->input->post('description');
			$save['Name']			                = $this->input->post('Name');
			$this->setting_model->add_requestType($save);
			if($id){
				$this->session->set_flashdata('message', lang('requestType_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('requestType_Saved'));
			}
			redirect('admin/Settings/requestType'); 
		}
	}
	
	function requestType_delete($id = false)
	{
		if ($id)
		{	
		    $requestType	= $this->setting_model->delete_requestType($id);
			if (!$requestType){
				$this->session->set_flashdata('error', lang('requestType_not_found'));
				redirect('admin/Settings/requestType'); 
			}
			else
			{
			    $delete	= $this->setting_model->Aproved_stage_delete($id);
				$this->session->set_flashdata('message', lang('requestType_delete'));
				redirect('admin/Settings/requestType'); 
			}
		}
		else
		{
			     $this->session->set_flashdata('error', lang('requestType_not_found'));
				 redirect('admin/Settings/requestType'); 
		}
	} 
  function request_category()
	{
		 $admin                = $this->session->userdata('admin');
		 $data['page_title']   = lang('requestType_category');
         $data['category']   = $this->setting_model->get_requestType_Category();
	     $this->render_admin('settings/requestCatgorylist', $data);		
	}
	function request_categoryView($id){
		$data['category']			=	$category		= $this->setting_model->get_requestCategorybyid($id);
		$data['page_title']	= lang('view')." ".lang('requestType_category') ;
		$this->render_admin('settings/request_categoryView', $data);
	}
	function request_categoryForm($id = false)
	{
		$data['requesttype']	= $this->setting_model->getRequestTypeAll();	
		$data['page_title']		= lang('requestType_category_form');
		$data['id']				 	        = '';
		$data['Name']			            = '';
		$data['description']				= '';
		if ($id){
			$data['request_category']			=	$request_category		= $this->setting_model->get_requestCategorybyid($id);
			if (!$request_category){
				$this->session->set_flashdata('error', lang('requestType_category_Not_found'));
				redirect('admin/Settings/request_category');
			}
			$data['id']					    = $request_category->id;
			$data['Name']			        = $request_category->Name;
			$data['description']			= $request_category->description;
			$data['request_type']			= $request_category->request_typeid;
			
		}
		$this->form_validation->set_rules('Name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('requesttype', 'lang:requesttype', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/request_catgoryform', $data);		
		}else
		{	
			$save['id']					            = $id;
			$save['description']		         	= $this->input->post('description');
			$save['Name']			                = $this->input->post('Name');   
			$save['request_typeid']			        = $this->input->post('requesttype');   			                
			$this->setting_model->add_requestCategory($save);
			if($id){
				$this->session->set_flashdata('message', lang('requestType_category_Not_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('requestType_category_Not_Saved'));
			}
			redirect('admin/Settings/request_category'); 
		}
	}
	
	function request_category_delete($id = false)
	{
		if ($id)
		{	
		    $request_category	= $this->setting_model->get_requestCategorybyid($id);
			if (!$request_category){
				$this->session->set_flashdata('error', lang('requestType_category_Not_found'));
				redirect('admin/Settings/request_category'); 
			}
			else
			{
			    $delete	= $this->setting_model->requestCategory_delete($id);
				$this->session->set_flashdata('message', lang('requestType_category_Not_deleted'));
				redirect('admin/Settings/request_category'); 
			}
		}
		else
		{
			     $this->session->set_flashdata('error', lang('requestType_category_Not_found'));
				 redirect('admin/Settings/request_category'); 
		}
	} 
	function request_subcategory()
	{
		 $admin                = $this->session->userdata('admin');
		 $data['page_title']   = lang('requestType_subcategory');
         $data['subcategory']   = $this->setting_model->get_requestType_SubCategory();
	     $this->render_admin('settings/request_subCatgorylist', $data);		
	}
	function request_subcategoryView($id){
		$data['category']			=	$category		= $this->setting_model->get_request_subCategorybyid($id);
		$data['page_title']	= lang('view')." ".lang('requestType_subcategory') ;
		$this->render_admin('settings/request_subcategoryView', $data);
	}
	function request_subcategoryForm($id = false)
	{
		$data['requesttype']	= $this->setting_model->getRequestTypeAll();	
		if($id){
		$data['category']	= $this->setting_model->get_category();	
		}
		$data['page_title']		= lang('requestType_subcategory_form');
		$data['id']				 	        = '';
		$data['Name']			            = '';
		$data['description']				= '';
		if ($id){
			$data['request_subcategory']			=	$request_subcategory		= $this->setting_model->get_request_subCategorybyid($id);
			if (!$request_subcategory){
				$this->session->set_flashdata('error', lang('requestType_subcategory_Not_found'));
				redirect('admin/Settings/request_subcategory');
			}
			$data['id']					    = $request_subcategory->id;
			$data['Name']			        = $request_subcategory->Name;
			$data['description']			= $request_subcategory->description;
			$data['request_type']			= $request_subcategory->request_typeid;
			$data['category_id']			= $request_subcategory->category_id;
			$data['price']			        = $request_subcategory->price;
			
		}
		$this->form_validation->set_rules('Name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('requesttype', 'lang:requesttype', 'trim|required');
		$this->form_validation->set_rules('category', 'lang:category', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/request_subcatgoryform', $data);		
		}else
		{	
			$save['id']					            = $id;
			$save['description']		         	= $this->input->post('description');
			$save['Name']			                = $this->input->post('Name');   
			$save['request_typeid']			        = $this->input->post('requesttype'); 
			$save['category_id']			        = $this->input->post('category'); 	
			$save['price']							= $this->input->post('price');			
			$this->setting_model->add_requestSubCategory($save);
			if($id){
				$this->session->set_flashdata('message', lang('requestType_subcategory_Not_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('requestType_subcategory_Not_Saved'));
			}
			redirect('admin/Settings/request_subcategory'); 
		}
	}
	
	function request_subcategory_delete($id = false)
	{
		if ($id)
		{	
		    $request_subcategory	= $this->setting_model->get_request_subCategorybyid($id);
			if (!$request_subcategory){
				$this->session->set_flashdata('error', lang('requestType_subcategory_Not_found'));
				redirect('admin/Settings/request_subcategory'); 
			}
			else
			{
			    $delete	= $this->setting_model->request_subCategory_delete($id);
				$this->session->set_flashdata('message', lang('requestType_subcategory_Not_deleted'));
				redirect('admin/Settings/request_subcategory'); 
			}
		}
		else
		{
			     $this->session->set_flashdata('error', lang('requestType_subcategory_Not_found'));
				 redirect('admin/Settings/request_subcategory'); 
		}
	} 
	function get_category(){
	$HTML='';
    $requesttype = $this->input->post('requesttype');
	$request_category=$this->db->get_where('request_category',array('soft_delete'=>0,'request_typeid' => $requesttype))->result();
	if ($request_category) {
		foreach ($request_category as $item) {
			$HTML.="<option value='" . $item->id . "'>" . $item->Name. "</option>";
		}
	}else{
		$HTML.="<option value=''>Select Category</option>";
	}
        echo $HTML;
	 
    }
		 public function get_subcategory()
    {
        $HTML = '';
        $categoryid = $this->input->post('categoryid');
        $categoryid = $this->db->get_where('request_subcategory', array('soft_delete' => 0, 'category_id' => $categoryid))->result();
        if ($categoryid) {
            foreach ($categoryid as $item) {
                $HTML .= "<option value='" . $item->id . "'>" . $item->Name . "</option>";
            }
        } else {
            $HTML .= "<option value=''>Select SubCategory</option>";
        }
        echo $HTML;

    }
    public function get_subcategory_details()
    {
        $subcategoryid = $this->input->post('subcategoryid');
        $subcategory = $this->db->get_where('request_subcategory', array('soft_delete' => 0, 'id' => $subcategoryid))->row();
        if (!empty($subcategory->price)) {echo $subcategory->price;} else {echo 0;};

	}
	
	function get_flat(){
	$HTML='';
    $floor_no = $this->input->post('floor_id');
	$projectid = $this->input->post('projectid');
	$flats=$this->db->get_where('add_unit',array('floor_no' => $floor_no,'Project_id'=>$projectid,'Booked_status'=>1))->result();
	
	if ($flats) {
		foreach ($flats as $flat) {
			$HTML.="<option value='" . $flat->uid . "'>" . $flat->unit_no. "</option>";
		}
	}else{
		$HTML.="<option value=''>Select Flat</option>";
	}
        echo $HTML;
	 
    }
	function get_owners(){
	$HTML='';
	$ownertype = $this->input->post('ownertype');
	$owners=$this->setting_model->getRequestby($ownertype);
	if ($owners) {
		foreach ($owners as $owner) {
			$HTML.="<option value='" . $owner->id . "'>" . $owner->Name. "</option>";
		}
	}else{
		$HTML.="<option value=''>Select Flat</option>";
	}
        echo $HTML;
	 
    }
	function contractor()  {
	    $data['page_title']='contractor_list';
	    $this->render_admin('settings/contractor', $data);		
     }
   function get_contractor(){   
    $actions = "<div class=\"text-center\">";
    $actions .= "<a href='" . base_url('admin/settings/contractor_view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/settings/contract_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/settings/contractor_delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
    $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("contractor_id ,con_Name,con_type ,con_address,  con_contact_number,  con_email,  con_start_date", FALSE)
            ->from("contractor")
			->where("soft_delete",0)
            ->add_column("Actions", $actions, "contractor_id");
	        echo $this->datatables->generate();
    }
     function contract_form($id = false){
		$data['page_title']		           = lang('add_contractor_form');
		$data['name']		               = '';
		$data['address']			       = '';
		$data['contact_number']            = '';
		$data['email']			           = '';
		$data['contract_date']	           = '';
		$data['con_type']	               = '';
		$data['contractor_id']	           = '';
		if ($id){	
            $data['page_title']		            = lang('edit_contractor_form');
			$data['contractor']		         	=	$contractor		= $this->setting_model->get_contractorByid($id);
			$save['contractor_id']		= $id;
			if (!$contractor){
				$this->session->set_flashdata('error', lang('Contactor_data_not_found'));
				redirect('admin/settings/contractor');
            }       
			$data['contractor_id']	    = $contractor->contractor_id;
			$data['name']		        = $contractor->con_Name;
	    	$data['address']			= $contractor->con_address;
	    	$data['contact_number']     = $contractor->con_contact_number;
	    	$data['email']			    = $contractor->con_email;
			$data['contract_date']	    = $contractor->con_start_date;
			$data['con_type']	        = $contractor->con_type;
		 }
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/contractor_form', $data);		
		}
		else{
			
			 $save['con_Name']			        = $this->input->post('name');
			 $save['con_address']			    = $this->input->post('address');
			 $save['con_contact_number']		= $this->input->post('contact_number');
		   	 $save['con_email']	                = $this->input->post('email');
			 $save['con_start_date']	        = $this->input->post('contractdate');
			 $save['con_type']	                = $this->input->post('contrator_type');
	     	 $this->setting_model->contractor_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('Contactor_data_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('Contactor_data_saved'));
			}
			redirect('admin/settings/contractor'); 
		}
     }
     function contractor_view($id = false){
        if ($id){	
            $data['contractor']	=	$contractor = $this->setting_model->get_contractorByid($id);
            $data['page_title']	        =	lang('contractor_view');
			if (!$contractor){
				$this->session->set_flashdata('error', lang('Contactor_data_not_found'));
				redirect('admin/settings/contractor');
            }  
            $this->render_admin('settings/view_contractor', $data);	
        }else{
            $this->session->set_flashdata('error', lang('Contactor_data_not_found'));
            redirect('admin/settings/contractor');
        }
     }
     function contractor_delete($id){
        if ($id){	
            $contractor		= $this->setting_model->get_contractorByid($id);
          if (!$contractor){
                $this->session->set_flashdata('error', lang('Contactor_data_not_found'));
                redirect('admin/settings/contractor');
            }else{
                $delete	= $this->setting_model->contractDelete($id);
                $this->session->set_flashdata('message', lang('Contactor_data_deleted'));
                redirect('admin/settings/contractor');
            }
        }else{
                $this->session->set_flashdata('error', lang('Contactor_data_not_found'));
                redirect('admin/settings/contractor');
        }
     }
	
	function unit_status(){
		 $data['page_title']='unit_status';
	     $this->render_admin('settings/unitStatus', $data);		
	}
	function get_unitStatus(){
		  $actions = "<div class=\"text-center\">";
    $actions .= "<a href='" . base_url('admin/settings/unitStatus_view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/settings/unitStatusForm/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/settings/unitStatusDelete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
    $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("status_id  ,status_name ,unit_group_type.unit_group_type, unit_status.description ", FALSE)
            ->from("unit_status")
			->join("unit_group_type","unit_group_type,id=unit_status.unit_group_type","left")
			->where("soft_deleted",0)
            ->add_column("Actions", $actions, "status_id");
	        echo $this->datatables->generate();
	}
	function unitStatus_view($id = false){
		 if ($id){	
            $data['unitstatus']	=	$unitstatus = $this->setting_model->get_unitstatusByid($id);
            $data['page_title']	        =	lang('unit_status_view');
			if (!$unitstatus){
				$this->session->set_flashdata('error', lang('Unit_status_not_found'));
				redirect('admin/settings/unit_status');
            }  
            $this->render_admin('settings/view_unit_status', $data);	
        }else{
            $this->session->set_flashdata('error', lang('Unit_status_not_found'));
            redirect('admin/settings/unit_status');
        }
	}
	function unitStatusForm($id = false){
		$data['page_title']		           = lang('add_unit_status');
		$data['unitgroup']	=	$unitgroup = $this->setting_model->get_unitGroup_type();
		$data['description']	           = '';
		$data['status_name']	           = '';
		$data['unit_group_type']	       = '';
		$data['status_id']	               = '';
		if ($id){	
            $data['page_title']		            = lang('edit_unit_status');
			$data['unitStatus']		         	= $unitStatus		= $this->setting_model->get_unitstatusByid($id);
			$save['status_id']		            = $id;
			if (!$unitStatus){
				$this->session->set_flashdata('error', lang('Unit_status_not_found'));
				redirect('admin/settings/unit_status');
            }       
			$data['status_id']	            = $unitStatus->status_id;
			$data['status_name']		    = $unitStatus->status_name;
	    	$data['description']			= $unitStatus->description;
			$data['unit_group_type']	    = $unitStatus->unit_group_type;      
		 }
		$this->form_validation->set_rules('status_name', 'lang:name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/unitStatus_form', $data);		
		}
		else{
			 $save['status_name']			        = $this->input->post('status_name');
			 $save['description']		            = $this->input->post('description');
			 $save['unit_group_type']		        = $this->input->post('unit_group_type');
	     	 $this->setting_model->unitStatus_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('Unit_status_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('Unit_status_saved'));
			}
			redirect('admin/settings/unit_status'); 
		}
	}
	function unitStatusDelete($id){
		 if ($id){	
            $unitstatus		= $this->setting_model->get_unitstatusByid($id);
          if (!$unitstatus){
                $this->session->set_flashdata('error', lang('Unit_status_not_found'));
                redirect('admin/settings/unit_status');
            }else{
                $delete	= $this->setting_model->uniStatusDelete($id);
                $this->session->set_flashdata('message', lang('Unit_status_deleted'));
                redirect('admin/settings/unit_status');
            }
        }else{
                $this->session->set_flashdata('error', lang('Unit_status_not_found'));
                redirect('admin/settings/unit_status');
        }
	}
	function unitIntension(){
		 $data['page_title']='unit_intension';
		 $data['intension']=$this->db->get_where('unit_intension',array("soft_delete"=>0))->result();
	     $this->render_admin('settings/unit/unitIntension', $data);		
	}
	function get_unitIntension(){
		  $actions = "<div class=\"text-center\">";
          $actions .= "<a href='" . base_url('admin/settings/unitIntension_view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/settings/unitIntensionForm/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> ";
		  $actions .= "  <a href='" . base_url('admin/settings/unitIntensionDelete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
          $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("intension_id,name,description", FALSE)
            ->from("unit_intension")
			->where("soft_delete",0)
            ->add_column("Actions", $actions, "intension_id");
	        echo $this->datatables->generate();
	}
	function unitIntension_view($id = false){
		 if ($id){	
            $data['unitintension']	=	$unitintension = $this->setting_model->get_unitIntensionByid($id);
            $data['page_title']	        =	lang('view_unit_intension');
			if (!$unitintension){
				$this->session->set_flashdata('error', lang('unit_intension_not_found'));
				redirect('admin/settings/unitIntension');
            }  
            $this->render_admin('settings/unit/view_unitIntension', $data);	
        }else{
            $this->session->set_flashdata('error', lang('unit_intension_not_found'));
            redirect('admin/settings/unitIntension');
        }
	}
	function unitIntensionForm($id = false){
		$data['page_title']		           = lang('add_unit_intension');
		$data['intension_id']	           = '';
		$data['name']	                   = '';
		$data['description']	           = '';
		if ($id){	
            $data['page_title']		            = lang('edit_unit_intension');
			$data['unitIntension']		        = $unitIntension		= $this->setting_model->get_unitIntensionByid($id);
			$save['intension_id']		        = $id;
			if (!$unitIntension){
				$this->session->set_flashdata('error', lang('unit_intension_not_found'));
				redirect('admin/settings/unitIntension');
            }       
			$data['intension_id']	            = $unitIntension->intension_id;
			$data['name']		                = $unitIntension->name;
	    	$data['description']		     	= $unitIntension->description;
		 }
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/unit/unitIntension_form', $data);		
		}
		else{
			 $save['name']		                = $this->input->post('name');
			 $save['description']		        = $this->input->post('description');
	     	 $this->setting_model->unitIntension_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('unit_intension_updated'));
			}else{
				$this->session->set_flashdata('message', lang('unit_intension_saved'));
			}
			redirect('admin/settings/unitIntension'); 
		}
	}
	function unitIntensionDelete($id){
		 if ($id){	
            $unitstatus		= $this->setting_model->get_unitIntensionByid($id);
          if (!$unitstatus){
                $this->session->set_flashdata('error', lang('unit_intension_not_found'));
                redirect('admin/settings/unitIntension');
            }else{
                $delete	= $this->setting_model->unitIntensionDelete($id);
                $this->session->set_flashdata('message', lang('Unit_status_deleted'));
                redirect('admin/settings/unitIntension');
            }
        }else{
                $this->session->set_flashdata('error', lang('unit_intension_not_found'));
                redirect('admin/settings/unitIntension');
        }
	}
	function unitGroupType(){
		 $data['page_title']='unit_group_type';
	     $this->render_admin('settings/unit/unitGroupType', $data);		
	}
	function get_unitGroupType(){
		  $actions = "<div class=\"text-center\">";
          $actions .= "<a href='" . base_url('admin/settings/unitGroundType_view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/settings/unitGroupTypeForm/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/settings/unitGroupTypeDelete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
          $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("id,unit_group_type , Description", FALSE)
            ->from("unit_group_type")
			->where("soft_delete",0)
            ->add_column("Actions", $actions, "id");
	        echo $this->datatables->generate();
	}
	function unitGroundType_view($id = false){
		 if ($id){	
            $data['unitGrouptype']	    =	$unitGrouptype = $this->setting_model->get_unitGroupTypeByid($id);
            $data['page_title']	        =	lang('view_unit_group_type');
			if (!$unitGrouptype){
				$this->session->set_flashdata('error', lang('unit_group_type_not_found'));
				redirect('admin/settings/unitGroupType');
            }  
            $this->render_admin('settings/unit/view_unit_grouptype', $data);	
        }else{
            $this->session->set_flashdata('error', lang('unit_group_type_not_found'));
            redirect('admin/settings/unitGroupType');
        }
	}
	function unitGroupTypeForm($id = false){
		$data['page_title']		           = lang('add_unit_group_type');
		$data['id']	                       = '';
		$data['name']	                   = '';
		$data['description']	           = '';
		if ($id){	
            $data['page_title']		            = lang('edit_unit_group_type');
			$data['unitGroupType']		        = $unitGroupType		= $this->setting_model->get_unitGroupTypeByid($id);
			$save['id']		        = $id;
			if (!$unitGroupType){
				$this->session->set_flashdata('error', lang('unit_group_type_not_found'));
				redirect('admin/settings/unitGroupType');
            }       
			$data['id']	                        = $unitGroupType->id;
			$data['name']		                = $unitGroupType->unit_group_type;
	    	$data['description']		     	= $unitGroupType->Description;
		 }
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/unit/unit_grouptype_form', $data);		
		}
		else{
			 $save['unit_group_type']		                = $this->input->post('name');
			 $save['Description']		        = $this->input->post('description');
	     	 $this->setting_model->unitGroupType_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('unit_group_type_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('unit_group_type_saved'));
			}
			redirect('admin/settings/unitGroupType'); 
		}
	}
	function unitGroupTypeDelete($id){
		 if ($id){	
            $unitstatus		= $this->setting_model->get_unitGroupTypeByid($id);
          if (!$unitstatus){
                $this->session->set_flashdata('error', lang('unit_group_type_not_found'));
                redirect('admin/settings/unitGroupType');
            }else{
                $delete	= $this->setting_model->unitGroupTypeDelete($id);
                $this->session->set_flashdata('message', lang('unit_group_type_deleted'));
                redirect('admin/settings/unitGroupType');
            }
        }else{
                $this->session->set_flashdata('error', lang('unit_group_type_not_found'));
                redirect('admin/settings/unitGroupType');
        }
	}
	function unitType(){
		 $data['page_title']='unit_type';
	     $this->render_admin('settings/unit/unitType', $data);		
	}
	function get_unitType(){
		  $actions = "<div class=\"text-center\">";
          $actions .= "<a href='" . base_url('admin/settings/unitType_view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/settings/unitTypeForm/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/settings/unitTypeDelete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
          $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("id,UnitType , Description", FALSE)
            ->from("unit_type")
			->where("Soft_delete",0)
            ->add_column("Actions", $actions, "id");
	        echo $this->datatables->generate();
	}
	function unitType_view($id = false){
		 if ($id){	
            $data['unittype']	    =	$unitType = $this->setting_model->get_unitTypeByid($id);
            $data['page_title']	        =	lang('view_unit_Type');
			if (!$unitType){
				$this->session->set_flashdata('error', lang('unit_Type_not_found'));
				redirect('admin/settings/unitType');
            }  
            $this->render_admin('settings/unit/view_unitType', $data);	
        }else{
            $this->session->set_flashdata('error', lang('unit_Type_not_found'));
            redirect('admin/settings/unitType');
        }
	}
	function unitTypeForm($id = false){
		$data['page_title']		               = lang('add_unit_Type');
		$data['id']	                           = '';
		$data['UnitType']	                   = '';
		$data['Description']	               = '';
		if ($id){	
            $data['page_title']		            = lang('edit_unit_Type');
			$data['unitType']		            = $unitType		= $this->setting_model->get_unitTypeByid($id);
			$save['id']		        = $id;
			if (!$unitType){
				$this->session->set_flashdata('error', lang('unit_Type_not_found'));
				redirect('admin/settings/unitType');
            }       
			$data['id']	                        = $unitType->id;
			$data['name']		                = $unitType->UnitType;
	    	$data['description']		     	= $unitType->Description;
		 }
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/unit/unitType_form', $data);		
		}
		else{
			 $save['UnitType']		    = $this->input->post('name');
			 $save['Description']		        = $this->input->post('description');
	     	 $this->setting_model->unitType_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('unit_Type_updated'));
			}else{
				$this->session->set_flashdata('message', lang('unit_Type_saved'));
			}
			redirect('admin/settings/unitType'); 
		}
	}
	function unitTypeDelete($id){
		 if ($id){	
            $unitstatus		= $this->setting_model->get_unitTypeByid($id);
          if (!$unitstatus){
                $this->session->set_flashdata('error', lang('unit_Type_not_found'));
                redirect('admin/settings/unitType');
            }else{
                $delete	= $this->setting_model->unitTypeDelete($id);
                $this->session->set_flashdata('message', lang('unit_Type_deleted'));
                redirect('admin/settings/unitType');
            }
        }else{
                $this->session->set_flashdata('error', lang('unit_Type_not_found'));
                redirect('admin/settings/unitType');
        }
	}
	function idType(){
		$data['page_title']='id_type';
		$this->render_admin('settings/id_type', $data);		
   }
   function get_idType(){
		 $actions = "<div class=\"text-center\">";
		 $actions .= "<a href='" . base_url('admin/settings/idType_view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/settings/idType_Form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/settings/idType_Delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		 $actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("id,  id_type_name  ,description", FALSE)
		   ->from("id_type")
		   ->where("soft_delete",0)
		   ->add_column("Actions", $actions, "id");
		   echo $this->datatables->generate();
   }
   function idType_view($id = false){
		if ($id){	
		   $data['idtype']	    =	$idtype = $this->setting_model->get_idTypeByid($id);
		   $data['page_title']	        =	lang('view_id_type');
		   if (!$idtype){
			   $this->session->set_flashdata('error', lang('id_type_not_found'));
			   redirect('admin/settings/idType');
		   }  
		   $this->render_admin('settings/view_id_type', $data);	
	   }else{
		   $this->session->set_flashdata('error', lang('unit_group_type_not_found'));
		   redirect('admin/settings/idType');
	   }
   }
   function idType_Form($id = false){
	   $data['page_title']		           = lang('add_id_type');
	   $data['id']	                       = '';
	   $data['name']	                   = '';
	   $data['description']	               = '';
	   if ($id){	
		   $data['page_title']		       = lang('edit_id_type');
		   $data['idType']		           = $idType		= $this->setting_model->get_idTypeByid($id);
		   $save['id']		               = $id;
		   if (!$idType){
			   $this->session->set_flashdata('error', lang('unit_group_type_not_found'));
			   redirect('admin/settings/idType');
		   }       
		   $data['id']	                        = $idType->id;
		   $data['name']		                = $idType->id_type_name;
		   $data['description']		     	    = $idType->description;
		}
	   $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
	   if ($this->form_validation->run() == FALSE){
		   $this->render_admin('settings/id_type_form', $data);		
	   }
	   else{
			$save['id_type_name']		                = $this->input->post('name');
			$save['description']		                = $this->input->post('description');
			 $this->setting_model->idType_save($save);
		   if($id){
			   $this->session->set_flashdata('message', lang('id_type_Updated'));
		   }else{
			   $this->session->set_flashdata('message', lang('id_type_Saved'));
		   }
		   redirect('admin/settings/idType'); 
	   }
   }
   function idType_Delete($id){
		if ($id){	
		   $unitstatus		= $this->setting_model->get_idTypeByid($id);
		 if (!$unitstatus){
			   $this->session->set_flashdata('error', lang('id_type_not_found'));
			   redirect('admin/settings/idType');
		   }else{
			   $delete	= $this->setting_model->idTypeDelete($id);
			   $this->session->set_flashdata('message', lang('id_type_deleted'));
			   redirect('admin/settings/idType');
		   }
	   }else{
			   $this->session->set_flashdata('error', lang('id_type_not_found'));
			   redirect('admin/settings/idType');
	   }
   }
      function people_settings(){
	   $data['page_title']=lang('people_settings');
		   $data['peoplesetting']		           = $peoplesetting		= $this->setting_model->get_peopleSettings();
		   $data['id']	                            = !empty($peoplesetting->id)? $peoplesetting->id:'';
		   $data['rent_max_tenure']	                        = !empty($peoplesetting->rent_max_tenure)? $peoplesetting->rent_max_tenure:'';
		   $data['tenure_type']		                    = !empty($peoplesetting->tenure_type)? $peoplesetting->tenure_type:'';
		   $data['tenture_period_active']		     	            = !empty($peoplesetting->tenture_period_active)?$peoplesetting->tenture_period_active:'';
		   
	   $this->form_validation->set_rules('resident_tenure_limit', 'lang:resident_tenure_limit', 'trim|required');
	   if ($this->form_validation->run() == FALSE){
		   $this->render_admin('settings/people_settings', $data);	
	   }
	   else{
		   if(!empty($this->input->post('resident_tenure_limit'))){
			$save['id']=$this->input->post('id');
		   }
			$save['rent_max_tenure']		                = $this->input->post('resident_tenure_limit');
			$save['tenure_type']		                    = $this->input->post('tenure_type');
			$save['tenture_period_active']		            = $this->input->post('active');
			 $this->setting_model->people_settings_save($save);
		   if($id){
			   $this->session->set_flashdata('message', lang('setting_updated'));
		   }else{
			   $this->session->set_flashdata('message', lang('setting_updated'));
		   }
		   redirect('admin/settings/people_settings'); 
	   }		  
   }
   function permissionlist($id = NULL){
		$admin = $this->session->userdata('admin'); 
		$data['page_title']	= lang('permission');
		$this->render_admin('settings/group_permissionlist', $data);		
	}
	function get_permission_list(){
		 $actions = "<div class=\"text-center\">";
		 $actions .= '<a href="' . base_url('admin/settings/permissions/$1') .'" class="btn btn-xs btn-default" style="padding:6px;" ><i class=\"fa fa-bars\"><i class="fa fa-bars"></i></a><a style="padding:6px;margin-left:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
		 $actions .= "</div>";
		 $this->load->library('datatables');
		 $this->datatables
		 ->select(" id , name, description", FALSE)
		 ->from("groups")
		  // ->where("soft_delete",0)
		 ->add_column("Actions", $actions, "id");
		 echo $this->datatables->generate();
		
	}
	 public function permission_add(){
        $this->global_model->table = 'groups';
        $this->_permission_validate();
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );
        $insert_id = $this->global_model->save($data);
		if($insert_id){
			$this->db->insert("permissions",array("Group_id"=>$insert_id));
		}
	
        echo json_encode(array("status" => true));
    }
	 public function permission_edit($id){
        $this->global_model->table = 'groups';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
      }
    public function permission_update(){
        $this->global_model->table = 'groups';
        $this->_permission_validate();
        $data = array(
            'name' => $this->input->post('name', true),
            'description' => $this->input->post('description'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function permission_delete($id){
        $this->global_model->table = 'groups';
        $users = $this->db->get_where('users', array('group_id' => $id))->result();
		$groups = $this->db->get_where('groups', array('flag' =>0))->result();
        if (empty($users)&& empty($groups)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }
    }
	 private function _permission_validate(){
        $rules = array(
            array('field' => 'name', 'label' => lang('name'), 'rules' => 'required|alpha_dash|is_unique[groups.name]'),
        );
        $this->global_model->validation($rules);
    }
	function permissions($id){
			if(!empty($this->input->post('flag'))){
			$permission_data=array(
			"project_index"=>$this->input->post('project_index'),
			"project_view"=>$this->input->post('view_project'),
			"project_form"=>$this->input->post('add_project'),
			"project_form_edit"=>$this->input->post('edit_project'),
			"project_delete"=>$this->input->post('delete_project'), 
			"building_index"=>$this->input->post('building_index'),
			"building_view"=>$this->input->post('view_project'),
			"building_form"=>$this->input->post('add_project'),
			"building_form_edit"=>$this->input->post('edit_building'),
			"building_delete"=>$this->input->post('delete_building'),
			"floors_index"=>$this->input->post('floor_index'),
			"floors_view"=>$this->input->post('view_floor'),
			"floors_form"=>$this->input->post('add_floor'),
			"floors_form_edit"=>$this->input->post('edit_floor'),
			"floors_deleted"=>$this->input->post('delete_floor'),
			"unit_index"=>$this->input->post('units_index'),
			"unit_view"=>$this->input->post('view_unit'),
			"unit_form"=>$this->input->post('add_unit'),
			"unit_form_edit"=>$this->input->post('edit_unit'),
			"unit_delete"=>$this->input->post('delete_unit'));
			 $this->setting_model->group_permission_update($permission_data,$id);
			 $this->session->set_flashdata('message', lang('permissions_saved_successfully'));
			 redirect('admin/settings/permissionlist');
            }
	  	$admin = $this->session->userdata('admin'); 
		$data['page_title']	= lang('permission');
		$data['id'] = $id;
        $data['p'] = $this->setting_model->get_group_permission($id);
        $data['group'] = $this->setting_model->getGroupByID($id);
		$this->render_admin('settings/permissions', $data);		
	}
	
	function custom_plan(){
		 $data['page_title']='custom_plan';
	     $this->render_admin('settings/custom_plan', $data);		
	}
	function get_custom_plan(){
		  $actions = "<div class=\"text-center\">";
          $actions .= "<a href='" . base_url('admin/settings/custom_plan_active/$1') . "'  class='tip' ><i class=\"fa fa-refresh\"></i></a> <a href='" . base_url('/admin/settings/custom_plan_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> ";
          $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("  id  ,name ,  percentage,soft_delete", FALSE)
            ->from("booking_payment_master")
			//->where("soft_delete",0)
            ->add_column("Actions", $actions, "id");
	        echo $this->datatables->generate();
	}
	
	function custom_plan_form($id = false){
		$data['page_title']		               = lang('add_custom_plan');
		$data['id']	                           = '';
		$data['name']	                       = '';
		$data['percentage']	                   = '';
		if ($id){	
            $data['page_title']		            = lang('edit_custom_plan');
			$data['custom_payment_plan']		= $custom_payment_plan		= $this->setting_model->get_payment_plan($id);
			$save['id']		        = $id;
			if (!$custom_payment_plan){
				$this->session->set_flashdata('error', lang('custom_payment_plan_not_found'));
				redirect('admin/settings/custom_plan');
            }       
			$data['id']	                        = $custom_payment_plan->id;
			$data['name']		                = $custom_payment_plan->name;
	    	$data['percentage']		     	    = $custom_payment_plan->percentage;
		 }
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('settings/custom_plan_form', $data);		
		}
		else{
			 $save['name']		                = $this->input->post('name');
			 $save['percentage']		        = $this->input->post('percentage');
	     	 $this->setting_model->payment_plan_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('custom_payment_plan_update'));
			}else{
				$this->session->set_flashdata('message', lang('custom_payment_plan_save'));
			}
			redirect('admin/settings/custom_plan'); 
		}
	}
	function custom_plan_active($id){
		 if ($id){	
		         $delete	= $this->setting_model->statusChange($id);
                $this->session->set_flashdata('message', lang('custom_payment_plan_status_changed'));
                redirect('admin/settings/custom_plan');
            }else{
                $this->session->set_flashdata('error', lang('custom_payment_plan_not_found'));
                redirect('admin/settings/custom_plan');
            }
       
	}
}