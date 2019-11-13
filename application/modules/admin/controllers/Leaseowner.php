<?php

class Leaseowner extends Admin_Controller {
	function __construct()
	{		
		parent::__construct();
		$this->load->model(array('guest_model','location_model','dashboard_model','LeaseOwner_Model'));
		$this->load->library("pagination");
		$this->load->helper("url");
	}
	
	function index()
	{
		 $admin = $this->session->userdata('admin');
		 $data['page_title']	= lang('Lease_Owner');
		 $config = array();
         $config["base_url"] = base_url() . "admin/Leaseowner/index";
         $config["total_rows"] = $this->LeaseOwner_Model->record_count();
         $config["per_page"] = 10;
         $config["uri_segment"] = 4;
         $this->pagination->initialize($config);
         $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
         $data['LeaseOwner']	= $this->LeaseOwner_Model->get_all($config["per_page"], $page);
         $data["links"] = $this->pagination->create_links();
	     $this->render_admin('LeaseOwner/list', $data);		
	}
	function view($id,$tab=false){
		$data['leaseowner']			=	$leaseowner		= $this->LeaseOwner_Model->get($id);
		$data['page_title']	= lang('view')." ".lang('Lease_Owner') ;
		$this->render_admin('LeaseOwner/view', $data);
	}
	function form($id = false)
	{
		$data['countries']	= $this->location_model->get_countries();	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('Lease_OwnerForm');
		$data['id']					= '';
		$data['firstname']			= '';
		$data['lastname']			= '';
		$data['gender']				= '';
		$data['password']			= '';
		$data['dob']				= '';
		$data['email']				= '';
		$data['country_id']			= '';
		$data['state_id']			= '';
		$data['city_id']			= '';
		$data['address']			= '';
		$data['mobile']				= '';
		$data['id_type']			= '';
		$data['id_no']				= '';
		$data['id_upload']			= '';
		$data['remark']				= '';
		$data['vip']				= '';
		
		if ($id){	
			$data['leaseowner']			=	$leaseowner		= $this->LeaseOwner_Model->get($id);
			if (!$leaseowner){
				$this->session->set_flashdata('error', lang('Lease_OwnerNotfound'));
				redirect('admin/Leaseowner');
			}
			$data['id']					= $leaseowner->id;
			$data['firstname']			= $leaseowner->firstname;
			$data['lastname']			= $leaseowner->lastname;
			$data['gender']				= $leaseowner->gender;
			$data['dob']				= $leaseowner->dob;
			$data['email']				= $leaseowner->email;
		//	$data['password']			= $leaseowner->password;
			$data['country_id']			= $leaseowner->country_id;
			$data['state_id']			= $leaseowner->state_id;
			$data['city_id']			= $leaseowner->city_id;
			$data['address']			= $leaseowner->address;
			$data['mobile']				= $leaseowner->mobile;
			$data['id_type']			= $leaseowner->id_type;
			$data['id_no']				= $leaseowner->id_no;
			$data['id_upload']			= $leaseowner->id_upload;
			$data['remark']				= $leaseowner->remark;
			$data['vip']				= $leaseowner->vip;
		}
		$this->form_validation->set_rules('firstname', 'lang:firstname', 'trim|required');
		$this->form_validation->set_rules('lastname', 'lang:lastname', 'trim|required');
		if($this->input->post('email') == $this->input->post('old_email')) {
		  	$this->form_validation->set_rules('email', 'lanng:email', 'trim|required|max_length[128]|required');
		} else {
		  $this->form_validation->set_rules('email', 'lanng:email', 'trim|required|max_length[128]|is_unique[guests.email]');
		}
		
		$this->form_validation->set_rules('mobile', 'lang:mobile', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('gender', 'lang:gender', 'required');
		
		if ($this->input->post('password') != '' || $this->input->post('confirm') != '' || !$id)
		{
			$this->form_validation->set_rules('password', 'lang:password', 'required|min_length[6]');
			$this->form_validation->set_rules('confirm', 'lang:password_confirm', 'required|matches[password]');
		}
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('LeaseOwner/form', $data);		
		}
		else
		{
			$this->load->library('upload');	
				if(!empty($_FILES['id_upload']['name'])){
						$_FILES['userfile']['name']= time().rand(1,988).'.'.substr(strrchr($_FILES['id_upload']['name'],'.'),1);	
						$_FILES['userfile']['tmp_name']= $_FILES['id_upload']['tmp_name'];
						$_FILES['userfile']['type']= $_FILES['id_upload']['type'];
						$_FILES['userfile']['error']= $_FILES['id_upload']['error'];
						$_FILES['userfile']['size']= $_FILES['id_upload']['size'];
						$save['id_upload'] = $_FILES['userfile']['name'];
						$this->upload->initialize($this->set_upload_options());
						$flag = $this->upload->do_upload();
						$this->upload->data();
						if(file_exists(BASEPATH.'../assets/admin/uploads/ids/LeaseOwner/'.$this->input->post('old_id')) && $flag)
							unlink(BASEPATH.'../assets/admin/uploads/ids/LeaseOwner/'.$this->input->post('old_id'));
				}
			$save['id']					= $id;
			$save['firstname']			= $this->input->post('firstname');
			$save['lastname']			= $this->input->post('lastname');
			$save['gender']				= $this->input->post('gender');
			$save['dob']				= $this->input->post('dob');
			$save['email']				= $this->input->post('email');
			$save['country_id']			= $this->input->post('country_id');
			$save['state_id']			= $this->input->post('region_id');
			$save['city_id']			= $this->input->post('city_id');
			$save['address']			= $this->input->post('address');
			$save['mobile']				= $this->input->post('mobile');
			$save['id_type']			= $this->input->post('id_type');
			$save['id_no']				= $this->input->post('id_no');
			$save['remark']				= $this->input->post('remark');
			if ($this->input->post('password') != '' || !$id)
			{
				$save['password']	= sha1($this->input->post('password'));
			}
			
			if(!$id){
				$save['added']				= date('Y-m-d H:i:s');
			}
			
			
			$this->LeaseOwner_Model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('Lease_OwnerUpdate'));
			}else{
				$this->session->set_flashdata('message', lang('Lease_OwnerSaved'));
			}
			
			redirect('admin/Leaseowner');
		}
	}
	
	function delete($id = false)
	{
		if ($id)
		{	
			$leaseowner	= $this->LeaseOwner_Model->get($id);
			if (!$leaseowner)
			{
				$this->session->set_flashdata('error', lang('Lease_OwnerNotfound'));
				redirect('admin/Leaseowner');
			}
			else
			{
				$file = BASEPATH.'../assets/admin/uploads/ids/LeaseOwner/'.$leaseowner->id_upload;
						if (file_exists($file)) {
							unlink($file);
						}
				
				$delete	= $this->LeaseOwner_Model->delete($id);
				
				$this->session->set_flashdata('message', lang('Lease_OwnerDeleted'));
				redirect('admin/Leaseowner');
			}
		}
		else
		{
			
			$this->session->set_flashdata('error', lang('Lease_OwnerNotfound'));
				redirect('admin/guests');
		}
	}
	function get_states()
	{
		$states		=	$this->location_model->get_zones($_POST['country_id']);
		echo '<option value="">--'.lang('select_region').'--</option>';
		foreach($states as $new){
			echo '<option value="'.$new->id.'">'.$new->name.'</option>';
		}
	}
	
	function get_cities()
	{
		$cities		=	$this->location_model->get_zone_areas($_POST['state_id']);
		echo '<option value="">--'.lang('select_city').'--</option>';
		foreach($cities as $new){
			echo '<option value="'.$new->id.'">'.$new->name.'</option>';
		}
	}
	
	function vip($id,$value){
		if($value==1){
			$save['vip']	=	0;
			$save['id']	=	$id;
			$this->session->set_flashdata('message', lang('guest_removed_from_vip'));
		}
		if($value==0){
			$save['vip']	=	1;
			$save['id']	=	$id;
			$this->session->set_flashdata('message', lang('guest_added_to_vip'));
		}
		if(!empty($save)){
			$this->guest_model->save($save);
		}	
		redirect('admin/guests');
	}
	private function set_upload_options()
	{  //  upload an image and document options
		$config = array();
		$config['upload_path'] = BASEPATH.'../assets/admin/uploads/ids/';
		$config['allowed_types'] = 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG|pdf';
		$config['max_size'] = '0'; // 0 = no file size limit
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['overwrite'] = TRUE;
		return $config;
	}
	
	
}