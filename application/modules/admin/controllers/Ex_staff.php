<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ex_staff extends Admin_Controller {
	function __construct(){		
		parent::__construct();
		$this->load->model(array('ExternalStaff_model'));
	}
	function index(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('External_staff');
		$this->render_admin('External_staff/list', $data);		
	}
	function get_externalStaff(){
		$actions = "<div class=\"text-center\">";
		$actions .= "<a href='" . base_url('admin/Ex_staff/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Ex_staff/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Ex_staff/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		$actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("external_staff_id,full_name,project.Name,email,nationalities.Nationality,sex 
		  ", FALSE)
		   ->from("external_staff")
		   ->join("project","project.id=external_staff.project_id","left")
		   ->join("nationalities","nationalities.NationalityID=external_staff.nationality","left")
		   ->where("external_staff.soft_deleted",0)
		   ->add_column("Actions", $actions, "external_staff_id");
		echo $this->datatables->generate();
   }
	function view($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['idtype']	       = $this->ExternalStaff_model->get_idtype();
		$data['project']	   = $this->ExternalStaff_model->get_Project();
		$data['External_staff']	   =	$External_staff		= $this->ExternalStaff_model->get($id);
		$data['nationalitylist']        = $this->ExternalStaff_model->get_nationality();
		$data['projectunits']  =	$units		= $this->ExternalStaff_model->get_unitBy_projectWise($id,$External_staff->units);
		$data['page_title']	= lang('view')." ".lang('External_staff') ;
		$this->render_admin('External_staff/view', $data);
	}
	function form($id = false){
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']	         	= lang('edit_external_staff');
		$data['idtype']	                = $this->ExternalStaff_model->get_idtype();
		$data['project']	            = $this->ExternalStaff_model->get_Project();
		$data['nationalitylist']        = $this->ExternalStaff_model->get_nationality();
		$data['resident']		        =	$resident		= $this->ExternalStaff_model->get($id);
		$data['id']						= '';
		$data['ownid']		    		= '';
	    $data['relatiotype']		    = '';
		$data['occupy_status']		    = '';
		$data['job_title']		        = '';
		$data['company_name']		        = '';
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
		$data['vip']  				 	= '';
		if ($id){	
			$data['Ex_staff']			=	$Ex_staff		= $this->ExternalStaff_model->get($id);
			$data['projectunits']	    =	$units		    = $this->ExternalStaff_model->get_unitBy_projectWise($id,$Ex_staff->units);
			if (!$Ex_staff){
				$this->session->set_flashdata('error', lang('external_staff_not_found'));
				redirect('Ex_staff/form');
			}
			$data['external_staff_id']		       = $Ex_staff->external_staff_id;
	     	$data['relatiotype']		    = $Ex_staff->relatiotype;
			$data['occupy_status']		    = $Ex_staff->occupy_status;
			$data['job_title']		        = $Ex_staff->job_title;
			$data['company_name']		    = $Ex_staff->company_name;
		    $data['full_name']		 	    = $Ex_staff->full_name;
		    $data['salutation']	    		= $Ex_staff->salutation;
		    $data['surname']				= $Ex_staff->surname;
		    $data['firstname']  			= $Ex_staff->firstname;
		    $data['nationality']		    = $Ex_staff->nationality;
		    $data['dob']					= $Ex_staff->dob;
		    $data['sex']					= $Ex_staff->sex;
		    $data['id_type']				= $Ex_staff->id_type;
		    $data['id_no']   				= $Ex_staff->id_no;
		    $data['primary_phone']   		= $Ex_staff->primary_phone;
		    $data['handphone']   			= $Ex_staff->handphone;
		    $data['app_communication_details']= json_decode($Ex_staff->app_communication_details);
		    $data['permanent_address']   	= $Ex_staff->permanent_address;
		    $data['project_id'] 		  	= $Ex_staff->project_id;
		    $data['assigned_unit']   	    = json_decode($Ex_staff->units);
		    $data['email']   				= $Ex_staff->email;
		    $data['attachments'] 		  	= $Ex_staff->attachments;
		    $data['vip']  				 	= $Ex_staff->vip;
		}
		$this->form_validation->set_rules('fullname', 'lang:fullname', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('External_staff/form', $data);		
		}else{
			foreach ($_FILES['attachment']['name'] as $key => $image) {
				$config['upload_path'] = 'uploads/resident/';
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
                if(!empty($appdetails)){
				  $save['app_communication_details']=json_encode($appdetails)	;
				}
                if (!empty($this->input->post('password'))) {
                    $save['password']   			=sha1($this->input->post('password'));
                }
			 $save['external_staff_id']		    = $this->input->post('id');
			 $save['relatiotype']		 	= $this->input->post('resident_relationship');
			 $save['occupy_status']		 	= $this->input->post('Occupancy_status');
			 $save['job_title']		 	    = $this->input->post('job_title');
		     $save['company_name']		 	= $this->input->post('company_name');
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
			 $save['units']   				= json_encode($this->input->post('assigned_unit'));
			 $save['email']   				=$this->input->post('email');
			 $save['vip']  				 	=!empty($this->input->post('vip'))?$this->input->post('vip'):0;
			$this->ExternalStaff_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('external_staff_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('external_staff_Saved'));
			}
	         redirect('admin/Ex_staff');
		}
	}
	
	function delete($id = false){
		if ($id){	
			$Ex_staff	= $this->ExternalStaff_model->get($id);
		    if (!$Ex_staff){
				$this->session->set_flashdata('error', lang('external_staff_not_found'));
			    redirect('admin/Ex_staff');
			}else{
				$delete	= $this->ExternalStaff_model->delete($id);
				$this->session->set_flashdata('message', lang('delete_resident'));
				redirect('admin/Ex_staff');
			}
		}else{
			    $this->session->set_flashdata('error', lang('external_staff_not_found'));
				redirect('admin/Ex_staff');
		}
	}
	function get_unitByProject(){
		$projectid = $this->input->post('projectid');
		$HTML='';
		$units=$this->ExternalStaff_model->get_unitBy_project($projectid);
		if ($units) {
			foreach ($units as $unit) {
				$HTML.="<option value='" . $unit->uid . "'>" . $unit->unit_name. "</option>";
			}
		}else{
			$HTML.="<option value=''>Select unit</option>";
		}
			echo $HTML;
		
		}
		function doc_delete(){
			$doc= $this->input->post('doc'); 
			$id=$this->input->post('external_staff_id');
			$ownerattachment = $this->Owner_model->get($id);
			$otherdoc=json_decode(($ownerattachment->attachments));
			if (($key = array_search($doc, $otherdoc)) !== false) {
			   unset($otherdoc[$key]);
			  $this->db->where('external_staff_id',$id);
			  $this->db->update('external_staff',array('attachments'=>json_encode($otherdoc)));
			  
			  if(file_exists(BASEPATH.'../uploads/external_staff/'.$doc)){
					   unlink(BASEPATH.'../uploads/external_staff/'.$doc);
			   } 
		}
		return true;
		}
		function download_attachment($name){
			$file = base_url().'uploads/external_staff/'.$name;
			$data =  file_get_contents($file);
			$file = base_url().'uploads/external_staff/'.$name;
			force_download($name, $data);
		  }
}