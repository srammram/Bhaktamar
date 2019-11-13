<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Tenant extends Admin_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Tenant_model'));
        $this->load->library('form_validation');
		$this->load->helper('form');
    }
  
    public function tenant_list(){
		 $data['page_title']	=	lang('list_tenant');
		 $this->render_admin('tenant/tenantList', $data);
    }
	function get_tenant(){
		 $actions = "<div class=\"text-center\">";
		 $actions .= "<a href='" . base_url('admin/tenant/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/tenant/tenant_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> ";
		 $actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("tentant_id,full_name,project.Name,building_info.name building,floors.name floor,unit_no 
		  ", FALSE)
		   ->from("tenant")
		   ->join("project","project.id=tenant.project_id","left")
		   ->join("building_info","building_info.bldid=tenant.building_id","left")
		   ->join("add_unit","add_unit.uid=tenant.unitid","left")
		   ->join("floors","floors.id=add_unit.uid","left")
		   ->where("tenant.soft_deleted",0)
		   ->where("tenant.leaseunit_type",lang('Lease_unit'))
		   ->add_column("Actions", $actions, "tentant_id");
		echo $this->datatables->generate();
   }
	function view($id,$tab=false){
		$Owner = $this->session->userdata('owner');
		$data['idtype']	                = $this->Tenant_model->get_idtype();
		$data['nationalitylist']        = $this->Tenant_model->get_nationality();
		$data['project']	            = $this->Tenant_model->get_Project();
		$data['tenant']	                =	$tenant		= $this->Tenant_model->get($id);
		$data['leasesunits']		        =	$units = $this->Tenant_model->get_TenantUnit($tenant->project_id,$tenant->building_id,$tenant->unitid,$tenant->leaseunit_type);
		$data['buildings']=$this->db->get_where("building_info",array("project_id"=>$tenant->project_id,"soft_delete"=>0))->result();
		$data['page_title']	= lang('view')." ".lang('Tenant') ;
		$this->render_admin('tenant/view', $data);
	}
	public function tenant_form($id = false){
		
	 	$data['page_title']	         	= lang('tenant_form');
		$data['idtype']	                = $this->Tenant_model->get_idtype();
		$data['nationalitylist']        = $this->Tenant_model->get_nationality();
		$data['project']	            = $this->Tenant_model->get_Project();
		$data['tenant']			       =	$tenant		= $this->Tenant_model->get($id);
		//$data['ownerunits']		        =	$units = $this->Tenant_model->get_ownerWiseUnit($Owner['owner_id']);
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
		$data['amount']                 = '';
		$data['tenure_type']         = '';
		if ($id){	
			$data['tenant']			       =	$tenant		= $this->Tenant_model->get($id);
			$data['leasesunits']		        =	$units = $this->Tenant_model->get_TenantUnit($tenant->project_id,$tenant->building_id,$tenant->unitid,$tenant->leaseunit_type);
			$data['buildings']=$this->db->get_where("building_info",array("project_id"=>$tenant->project_id,"soft_delete"=>0))->result();
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
			$data['assigned_unit']   	    = $tenant->unitid;
			$data['building_id']   	        = $tenant->building_id;
		    $data['email']   				= $tenant->email;
		    $data['attachments'] 		  	= $tenant->attachments;
		 	$data['leaseunit_type'] 		= $tenant->leaseunit_type;
			$data['type'] 		  	        = $tenant->type;
			$data['family_members']= json_decode($tenant->family_members);
			$data['amount']                 = $tenant->amount;
		    $data['tenure_type']            = $tenant->tenure_type;
		}
		$this->form_validation->set_rules('fullname', 'lang:fullname', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			 $this->render_admin('tenant/tenant_form', $data);
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
				/* if(!empty($this->input->post('unit'))){
					 $units=$this->db->get_where('add_owner_unit_relation',array('id'=>$this->input->post('unit')))->row();
					 $save['project_id'] 		  	= $units->project_id;
			         $save['unitid']   				=  $units->unit_id;
			         $save['building_id']   	    =  $units->building_id;
					 $save['floor_id']   	        =  $units->floor_id;
				} */
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
			 $save['project_id'] 		  	= $this->input->post('assigned_project');
			 $save['unitid']   				= $this->input->post('unit');
			 $save['building_id']   	    = $this->input->post('building_id');
			 $save['type']                  =$this->input->post('type');
			 $save['leaseunit_type']        =$this->input->post('lease_unit_type');
			 $save['amount']                =$this->input->post('lease_unit_type');
		     $save['tenure_type']           =$this->input->post('type');
			  if(lang('Rent') ==$this->input->post('type')){
				    $save['amount']           =$this->input->post('amount');
			  }else{
				    $save['amount']           =$this->input->post('lease_amount');
			  }
			 $this->Tenant_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('resident_updated'));
			}else{
				$this->session->set_flashdata('message', lang('tenant_saved'));
			}
	         redirect('admin/tenant/tenant_list');
		}
    }

    
	  public function get_unit(){
        $projectid = $this->input->post('project_id');
        $buildingid = $this->input->post('buildingid');
		$leaseUnitType = $this->input->post('leaseUnitType');
        $HTML = '<option value="">Select unit</option>';
		if($leaseUnitType !=lang('Owner_unit')){
        $units = $this->Tenant_model->get_units($projectid,$buildingid);
		}else{
			$units = $this->Tenant_model->get_Ownerunits($projectid,$buildingid);
		}
        if ($units) {
            foreach ($units as $unit) {
                $HTML .= "<option value='" . $unit->uid . "'>" . $unit->unit_name . "</option>";
            }
        } 
        echo $HTML;
    }
	
}
