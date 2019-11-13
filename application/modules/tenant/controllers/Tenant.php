<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Tenant extends Tenant_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array('owner/Tenant_model'));
        $this->load->library('form_validation');
		$this->load->helper('form');
    }
    public function index(){
        $user = $this->session->userdata('owner');
        $data['page_title'] = lang('dashboard');
        $this->load->view('template/header', $data);
        $this->load->view('dashboard/dashboard', $data);
        $this->load->view('template/footer', $data);
    }

    public function tenant_list(){
        $Owner = $this->session->userdata('owner');
        $data['page_title'] = lang('list_tenant');
        $data['tenant'] = $this->Tenant_model->get_tenant($Owner['owner_id']);
        $this->render_owner('tenant/tenantList', $data);
    }
	function view($id,$tab=false){
		$Owner = $this->session->userdata('owner');
		$data['idtype']	                = $this->Tenant_model->get_idtype();
		$data['nationalitylist']        = $this->Tenant_model->get_nationality();
		$data['tenant']	                =	$tenant		= $this->Tenant_model->get($id);
		$data['units']  =	$units		= $this->Tenant_model->get_ownerWiseTentUnit($tenant->relation_owner_id,$tenant->project_id,$tenant->building_id,$tenant->floor_id,$tenant->unitid);
		$data['page_title']	= lang('view')." ".lang('Tenant') ;
		$this->render_owner('tenant/view', $data);
	}
	public function tenant_form($id = false){
		$Owner = $this->session->userdata('owner');
	 	$data['page_title']	         	= lang('tenant_form');
		$data['idtype']	                = $this->Tenant_model->get_idtype();
		$data['nationalitylist']        = $this->Tenant_model->get_nationality();
		$data['tenant']			        =	$tenant		= $this->Tenant_model->get($id);
		$data['ownerunits']		        =	$units = $this->Tenant_model->get_ownerWiseUnit($Owner['owner_id']);
		$data['id']						= '';
	    $data['type']		            = '';
		$data['occupy_status']		    = '';
		$data['start_date']		        = '';
		$data['end_date']		        = '';
		$data['full_name']		 	    = '';
		$data['salutation']	    		= '';
		$data['surname']				= '';
		$data['firstname']  			= '';
		$data['nationality']		    = '';
		$data['dob']					= '';
		$data['sex']					= '';
		$data['id_type']				= '';
		$data['id_no']   				= '';
		$data['primary_phone']   		= '';
		$data['handphone']   			= '';
		$data['app_communication_details']  = '';
		$data['permanent_address']   	= '';
		$data['project_id'] 		  	= '';
		$data['units']   				= '';
		$data['email']   				= '';
		$data['password']   			= '';
		$data['attachments'] 		  	= '';
		$data['building_id']   	        = '';
		$data['vip']  				 	= '';
		$data['family_members']         = '';
		if ($id){	
			$data['tenant']			       =	$tenant		= $this->Tenant_model->get($id);
			$data['ownerunits']		        =	$units = $this->Tenant_model->get_ownerWiseTentUnit($tenant->relation_owner_id,$tenant->project_id,$tenant->building_id,$tenant->floor_id,$tenant->unitid);
			if (!$tenant){
				$this->session->set_flashdata('error', lang('tenant_not_found'));
				redirect('owner/Tenant/tenant_form');
			}
			
			$data['tentant_id']		        = $tenant->tentant_id;
	     	$data['type']		            = $tenant->tenant_type;
			$data['occupy_status']		    = $tenant->occupy_status;
			$data['start_date']		        = $tenant->start_date;
			$data['end_date']		        = $tenant->end_date;
		    $data['full_name']		 	    = $tenant->full_name;
		    $data['salutation']	    		= $tenant->salutation;
		    $data['surname']				= $tenant->surname;
		    $data['firstname']  			= $tenant->firstname;
		    $data['nationality']		    = $tenant->nationality;
		    $data['dob']					= $tenant->dob;
		    $data['sex']					= $tenant->sex;
		    $data['id_type']				= $tenant->id_type;
		    $data['id_no']   				= $tenant->id_no;
		    $data['primary_phone']   		= $tenant->primary_phone;
		    $data['handphone']   			= $tenant->handphone;
		    $data['app_communication_details']= json_decode($tenant->app_communication_details);
		    $data['permanent_address']   	= $tenant->permanent_address;
		    $data['project_id'] 		  	= $tenant->project_id;
			$data['assigned_unit']   	    = $this->Tenant_model->get_ownerrealtionunit($tenant->project_id,$tenant->building_id,$tenant->floor_id,$tenant->unitid,$tenant->relation_owner_id);
			$data['building_id']   	        = $tenant->building_id;
		    $data['email']   				= $tenant->email;
		    $data['attachments'] 		  	= $tenant->attachments;
			$data['family_members']= json_decode($tenant->family_members);
		}
		$this->form_validation->set_rules('fullname', 'lang:fullname', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			 $this->render_owner('tenant/tenant_form', $data);
		}else{
			foreach ($_FILES['attachment']['name'] as $key => $image) {
				$config['upload_path'] = 'uploads/tenant/';
				$config['allowed_types'] = '*';
				$_FILES['file']['name']= $_FILES['attachment']['name'][$key];
				$_FILES['file']['type']= $_FILES['attachment']['type'][$key];
				$_FILES['file']['tmp_name']= $_FILES['attachment']['tmp_name'][$key];
				$_FILES['file']['error']= $_FILES['attachment']['error'][$key];
				$_FILES['file']['size']= $_FILES['attachment']['size'][$key];
				$fileName =  $image;
				$config['file_name'] = $fileName;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$doc=$this->upload->data();
					$otherdoc[] =str_replace(' ', '_',$doc['file_name']) ;
				}
			}
			if(!empty($otherdoc) && !empty($tenant->attachments)){
			  foreach(json_decode($tenant->attachments) as $path){
				$otherdoc[]=$path;
			  }
				$save['attachments']	        =!empty($otherdoc)? json_encode($otherdoc):NULL;
			}
			for($i=0; $i<count($this->input->post('Appname')); $i++){
				if(!empty($_POST['Appname'][$i]) ){
				$appdetails[] = array(
					'Appname' =>	$_POST['Appname'][$i],
					'Appid' =>$_POST['Appid'][$i]
				);
			 }
		   }
		  
		   for($i=0; $i<count($this->input->post('resident_name')); $i++){
			if(!empty($_POST['resident_name'][$i]) ){
			$config['upload_path'] = 'uploads/tenant/familymembers';
				$config['allowed_types'] = '*';
				$_FILES['photo']['name']= $_FILES['memberPhoto']['name'][$i];
				$_FILES['photo']['type']= $_FILES['memberPhoto']['type'][$i];
				$_FILES['photo']['tmp_name']= $_FILES['memberPhoto']['tmp_name'][$i];
				$_FILES['photo']['error']= $_FILES['memberPhoto']['error'][$i];
				$_FILES['photo']['size']= $_FILES['memberPhoto']['size'][$i];
				$fileName =  $image;
				$config['file_name'] = $fileName;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('photo')) {
					$uploadphoto=$this->upload->data();
					$photo_url=str_replace(' ', '_',$uploadphoto['file_name']) ;
				}

			$familymembers[] = array(
				'name' =>	$_POST['resident_name'][$i],
				'gender' =>$_POST['optradio'][$i],
				'age' =>$_POST['resident_age'][$i],
				'relationship' =>$_POST['relationship'][$i],
				'id_no' =>$_POST['resident_no'][$i],
				'dob' =>$_POST['resident_dob'][$i],
				'photo'=>$photo_url,
			); 
			
		 }
		
	   }
	       if(!empty($familymembers)){
	      	$save['family_members']=json_encode($familymembers)	;
	      }
                if(!empty($appdetails)){
				  $save['app_communication_details']=json_encode($appdetails)	;
				}
                if (!empty($this->input->post('password'))) {
                    $save['password']   			=sha1($this->input->post('password'));
                }
				if(!empty($this->input->post('unit'))){
					 $units=$this->db->get_where('add_owner_unit_relation',array('id'=>$this->input->post('unit')))->row();
					 $save['project_id'] 		  	= $units->project_id;
			         $save['unitid']   				=  $units->unit_id;
			         $save['building_id']   	    =  $units->building_id;
					 $save['floor_id']   	        =  $units->floor_id;
				}
			 $save['tentant_id']		    = $this->input->post('tentant_id');
			 $save['tenant_type']		 	= $this->input->post('type');
			 $save['occupy_status']		 	= $this->input->post('Occupancy_status');
			 $save['start_date']		 	= $this->input->post('Start_date');
		     $save['end_date']		 	    = $this->input->post('End_date');
			 $save['full_name']		 	    = $this->input->post('fullname');
			 $save['salutation']	    	= $this->input->post('salutation');
			 $save['surname']				= $this->input->post('surname');
			 $save['firstname']  			= $this->input->post('firstname');
			 $save['nationality']		    = $this->input->post('nationality');
			 $save['dob']					= $this->input->post('dob');
			 $save['sex']					= $this->input->post('sex');
			 $save['id_type']				= $this->input->post('idtype');
			 $save['id_no']   				= $this->input->post('id_no');
			 $save['primary_phone']   		= $this->input->post('primary_phone');
			 $save['handphone']   			= $this->input->post('handphone');
			 $save['permanent_address']   	= $this->input->post('permanent_address');
			 $save['email']   				= $this->input->post('email');
			// $save['owner_details']=$Owner['per_address'];
			 $save['relation_owner_id']=$Owner['owner_id'];
			
			 $this->Tenant_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('resident_updated'));
			}else{
				$this->session->set_flashdata('message', lang('tenant_saved'));
			}
	         redirect('owner/Tenant/tenant_list');
		}
    }

    
   
function form($id = false){
		$Owner = $this->session->userdata('owner');
		$this->form_validation->set_rules('fullname', 'lang:fullname', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_owner('tenant/tenant_form', $data);		
		}else{
			foreach ($_FILES['attachment']['name'] as $key => $image) {
				$config['upload_path'] = 'uploads/tenant/';
				$config['allowed_types'] = '*';
				$_FILES['file']['name']= $_FILES['attachment']['name'][$key];
				$_FILES['file']['type']= $_FILES['attachment']['type'][$key];
				$_FILES['file']['tmp_name']= $_FILES['attachment']['tmp_name'][$key];
				$_FILES['file']['error']= $_FILES['attachment']['error'][$key];
				$_FILES['file']['size']= $_FILES['attachment']['size'][$key];
				$fileName =  $image;
				$config['file_name'] = $fileName;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$doc=$this->upload->data();
					$otherdoc[] =str_replace(' ', '_',$doc['file_name']) ;
				}
			}
			if(!empty($otherdoc)  ){
			  foreach(json_decode($Owner->attachments) as $path){
				$otherdoc[]=$path;
			  }
				$save['attachments']	        =!empty($otherdoc)? json_encode($otherdoc):NULL;
			}
			for($i=0; $i<count($this->input->post('Appname')); $i++){
				if(!empty($_POST['Appname'][$i]) ){
				$appdetails[] = array(
					'Appname' =>	$_POST['Appname'][$i],
					'Appid' =>$_POST['Appid'][$i]
				);
			 }
		   }
		  
		   for($i=0; $i<count($this->input->post('resident_name')); $i++){
			if(!empty($_POST['resident_name'][$i]) ){
			$config['upload_path'] = 'uploads/tenant/familymembers';
				$config['allowed_types'] = '*';
				$_FILES['photo']['name']= $_FILES['memberPhoto']['name'][$i];
				$_FILES['photo']['type']= $_FILES['memberPhoto']['type'][$i];
				$_FILES['photo']['tmp_name']= $_FILES['memberPhoto']['tmp_name'][$i];
				$_FILES['photo']['error']= $_FILES['memberPhoto']['error'][$i];
				$_FILES['photo']['size']= $_FILES['memberPhoto']['size'][$i];
				$fileName =  $image;
				$config['file_name'] = $fileName;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('photo')) {
					$uploadphoto=$this->upload->data();
					$photo_url=str_replace(' ', '_',$uploadphoto['file_name']) ;
				}

			$familymembers[] = array(
				'name' =>	$_POST['resident_name'][$i],
				'gender' =>$_POST['optradio'][$i],
				'age' =>$_POST['resident_age'][$i],
				'relationship' =>$_POST['relationship'][$i],
				'id_no' =>$_POST['resident_no'][$i],
				'dob' =>$_POST['resident_dob'][$i],
				'photo'=>$photo_url,
			); 
		 }
		
	   }
	       if(!empty($familymembers)){
	      	$save['family_members']=json_encode($familymembers)	;
	      }
                if(!empty($appdetails)){
				  $save['app_communication_details']=json_encode($appdetails)	;
				}
                if (!empty($this->input->post('password'))) {
                    $save['password']   			=sha1($this->input->post('password'));
                }
			 $save['residentid']		    = $this->input->post('id');
			 $save['relatiotype']		 	= $this->input->post('resident_relationship');
			 $save['occupy_status']		 	= $this->input->post('Occupancy_status');
			 $save['start_date']		 	= $this->input->post('Start_date');
		     $save['end_date']		 	    = $this->input->post('End_date');
			 $save['full_name']		 	    = $this->input->post('fullname');
			 $save['salutation']	    	= $this->input->post('salutation');
			 $save['surname']				= $this->input->post('surname');
			 $save['firstname']  			= $this->input->post('firstname');
			 $save['nationality']		    = $this->input->post('nationality');
			 $save['dob']					= $this->input->post('dob');
			 $save['sex']					= $this->input->post('sex');
			 $save['id_type']				= $this->input->post('idtype');
			 $save['id_no']   				= $this->input->post('id_no');
			 $save['primary_phone']   		= $this->input->post('primary_phone');
			 $save['handphone']   			= $this->input->post('handphone');
			 $save['permanent_address']   	= $this->input->post('permanent_address');
			 $save['project_id'] 		  	= $this->input->post('assigned_project');
			 $save['units']   				= $this->input->post('assigned_unit');
			 $save['building_id']   	    = $this->input->post('building_id');
			 $save['email']   				=$this->input->post('email');
			 $save['vip']  				 	=!empty($this->input->post('vip'))?$this->input->post('vip'):0;
			 $save['owner_details']=$this->input->post('ownerdetails');
			 $save['relation_owner_id']=$this->input->post('ownerid');
			$this->Resident_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('resident_updated'));
			}else{
				$this->session->set_flashdata('message', lang('resident_Saved'));
			}
	         redirect('admin/Resident');
		}
	}
	
   function edit_form($id = false){
		$Owner = $this->session->userdata('owner');
		$data['page_title']	         	= lang('add_resident');
		$data['idtype']	                = $this->Tenant_model->get_idtype();
		//$data['project']	            = $this->Tenant_model->get_Project();
		$data['nationalitylist']        = $this->Tenant_model->get_nationality();
		$data['resident']		        =$resident = $this->Resident_model->get($id);
		$data['id']						= '';
		$data['ownid']		    		= '';
	    $data['relatiotype']		    = '';
		$data['occupy_status']		    = '';
		$data['start_date']		        = '';
		$data['end_date']		        = '';
		$data['full_name']		 	    = '';
		$data['salutation']	    		= '';
		$data['surname']				= '';
		$data['firstname']  			= '';
		$data['nationality']		    = '';
		$data['dob']					= '';
		$data['sex']					= '';
		$data['id_type']				= '';
		$data['id_no']   				= '';
		$data['primary_phone']   		= '';
		$data['handphone']   			= '';
		$data['app_communication_details']  = '';
		$data['permanent_address']   	= '';
		$data['project_id'] 		  	= '';
		$data['units']   				= '';
		$data['email']   				= '';
		$data['password']   			= '';
		$data['attachments'] 		  	= '';
		$data['building_id']   	        = '';
		$data['vip']  				 	= '';
		$data['family_members']         = '';
		if ($id){	
			$data['page_title']	         	= lang('edit_resident');
			$data['tenant']			       =	$tenant		= $this->Resident_model->get($id);
			$data['projectunits']	       =	$units		= $this->Resident_model->get_unitBy_projectWise($id,$tenant->units);
			if (!$tenant){
				$this->session->set_flashdata('error', lang('resident_not_found'));
				redirect('Resident/form');
			}
			$data['residentid']		       = $tenant->residentid;
	     	$data['relatiotype']		    = $tenant->relatiotype;
			$data['occupy_status']		    = $tenant->occupy_status;
			$data['start_date']		        = $tenant->start_date;
			$data['end_date']		        = $tenant->end_date;
		    $data['full_name']		 	    = $tenant->full_name;
		    $data['salutation']	    		= $tenant->salutation;
		    $data['surname']				= $tenant->surname;
		    $data['firstname']  			= $tenant->firstname;
		    $data['nationality']		    = $tenant->nationality;
		    $data['dob']					= $tenant->dob;
		    $data['sex']					= $tenant->sex;
		    $data['id_type']				= $tenant->id_type;
		    $data['id_no']   				= $tenant->id_no;
		    $data['primary_phone']   		= $tenant->primary_phone;
		    $data['handphone']   			= $tenant->handphone;
		    $data['app_communication_details']= json_decode($tenant->app_communication_details);
		    $data['permanent_address']   	= $tenant->permanent_address;
		    $data['project_id'] 		  	= $tenant->project_id;
			$data['assigned_unit']   	    = $tenant->units;
			$data['building_id']   	        = $tenant->building_id;
		    $data['email']   				= $tenant->email;
		    $data['attachments'] 		  	= $tenant->attachments;
			$data['vip']  				 	= $tenant->vip;
			$data['family_members']= json_decode($tenant->family_members);
		}
		$this->form_validation->set_rules('fullname', 'lang:fullname', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_owner('tenant/tenant_editform', $data);		
		}else{
			foreach ($_FILES['attachment']['name'] as $key => $image) {
				$config['upload_path'] = 'uploads/tenant/';
				$config['allowed_types'] = '*';
				$_FILES['file']['name']= $_FILES['attachment']['name'][$key];
				$_FILES['file']['type']= $_FILES['attachment']['type'][$key];
				$_FILES['file']['tmp_name']= $_FILES['attachment']['tmp_name'][$key];
				$_FILES['file']['error']= $_FILES['attachment']['error'][$key];
				$_FILES['file']['size']= $_FILES['attachment']['size'][$key];
				$fileName =  $image;
				$config['file_name'] = $fileName;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$doc=$this->upload->data();
					$otherdoc[] =str_replace(' ', '_',$doc['file_name']) ;
				}
			}
			if(!empty($otherdoc)  ){
			  foreach(json_decode($Owner->attachments) as $path){
				$otherdoc[]=$path;
			  }
				$save['attachments']	        =!empty($otherdoc)? json_encode($otherdoc):NULL;
			}
			for($i=0; $i<count($this->input->post('Appname')); $i++){
				if(!empty($_POST['Appname'][$i]) ){
				$appdetails[] = array(
					'Appname' =>	$_POST['Appname'][$i],
					'Appid' =>$_POST['Appid'][$i]
				);
			 }
		   }
		   for($i=0; $i<count($this->input->post('resident_name')); $i++){
			if(!empty($_POST['resident_name'][$i]) ){
			$config['upload_path'] = 'uploads/tenant/familymembers';
				$config['allowed_types'] = '*';
				$_FILES['photo']['name']= $_FILES['memberPhoto']['name'][$i];
				$_FILES['photo']['type']= $_FILES['memberPhoto']['type'][$i];
				$_FILES['photo']['tmp_name']= $_FILES['memberPhoto']['tmp_name'][$i];
				$_FILES['photo']['error']= $_FILES['memberPhoto']['error'][$i];
				$_FILES['photo']['size']= $_FILES['memberPhoto']['size'][$i];
				$fileName =  $image;
				$config['file_name'] = $fileName;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('photo')) {
					$uploadphoto=$this->upload->data();
					$photo_url=str_replace(' ', '_',$uploadphoto['file_name']) ;
				}
			$familymembers[] = array(
				'name' =>	$_POST['resident_name'][$i],
				'gender' =>$_POST['optradio'][$i],
				'age' =>$_POST['resident_age'][$i],
				'relationship' =>$_POST['relationship'][$i],
				'id_no' =>$_POST['resident_no'][$i],
				'dob' =>$_POST['resident_dob'][$i],
				'photo'=>$photo_url); 
		 }
	   }
	       if(!empty($familymembers)){
	      	$save['family_members']=json_encode($familymembers)	;
	      }
                if(!empty($appdetails)){
				  $save['app_communication_details']=json_encode($appdetails)	;
				}
                if (!empty($this->input->post('password'))) {
                    $save['password']   			=sha1($this->input->post('password'));
                }
			 $save['residentid']		    = $this->input->post('id');
			 $save['relatiotype']		 	= $this->input->post('resident_relationship');
			 $save['occupy_status']		 	= $this->input->post('Occupancy_status');
			 $save['start_date']		 	= $this->input->post('Start_date');
		     $save['end_date']		 	    = $this->input->post('End_date');
			 $save['full_name']		 	    = $this->input->post('fullname');
			 $save['salutation']	    	= $this->input->post('salutation');
			 $save['surname']				= $this->input->post('surname');
			 $save['firstname']  			= $this->input->post('firstname');
			 $save['nationality']		    = $this->input->post('nationality');
			 $save['dob']					= $this->input->post('dob');
			 $save['sex']					= $this->input->post('sex');
			 $save['id_type']				= $this->input->post('idtype');
			 $save['id_no']   				= $this->input->post('id_no');
			 $save['primary_phone']   		= $this->input->post('primary_phone');
			 $save['handphone']   			= $this->input->post('handphone');
			 $save['permanent_address']   	= $this->input->post('permanent_address');
			 $save['project_id'] 		  	= $this->input->post('assigned_project');
			 $save['units']   				= $this->input->post('assigned_unit');
			 $save['building_id']   	    = $this->input->post('building_id');
			 $save['email']   				=$this->input->post('email');
			 $save['vip']  				 	=!empty($this->input->post('vip'))?$this->input->post('vip'):0;
			 $save['owner_details']=$this->input->post('ownerdetails');
			 $save['relation_owner_id']=$this->input->post('ownerid');
			$this->Resident_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('resident_updated'));
			}else{
				$this->session->set_flashdata('message', lang('resident_Saved'));
			}
	         redirect('admin/Resident');
		}
	}
	
}
