<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Resident extends Admin_Controller {
	function __construct(){		
		parent::__construct();
		$this->load->model(array('Resident_model'));
	}
	function index(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('resident');
		$data['project']	       = $this->Resident_model->get_Project();
		$data['buildings']	       = $this->Resident_model->get_buidling();
		$data['floors']	       = $this->Resident_model->get_floors();
		$data['units']	       = $this->Resident_model->get_units();
		$data['owners']	       = $this->Resident_model->get_Owner();
		$this->render_admin('Resident/list', $data);		
	}
	function get_resident(){
		$actions = "<div class=\"text-center\">";
		$actions .= "<a href='" . base_url('admin/Resident/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Resident/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Resident/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		$actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("residentid,full_name,project.Name,building_info.name building,floors.name floor,unit_no 
		  ", FALSE)
		   ->from("resident")
		   ->join("project","project.id=resident.project_id","left")
		   ->join("building_info","building_info.bldid=resident.building_id","left")
		   ->join("add_unit","add_unit.uid=resident.units","left")
		   ->join("floors","floors.id=add_unit.uid","left")
		   ->where("resident.soft_deleted",0)
		   ->add_column("Actions", $actions, "residentid");
		echo $this->datatables->generate();
   }
   function get_residentWithQuery(){
	$actions = "<div class=\"text-center\">";
	$actions .= "<a href='" . base_url('admin/Resident/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Resident/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Resident/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
	$actions .= "</div>";
	   $this->load->library('datatables');
	   $this->datatables
	   ->select("residentid,full_name,project.Name,building_info.name building,floors.name floor,unit_no 
	  ", FALSE)
	   ->from("resident")
	   ->join("project","project.id=resident.project_id","left")
	   ->join("building_info","building_info.bldid=resident.building_id","left")
	   ->join("add_unit","add_unit.uid=resident.units","left")
	   ->join("floors","floors.id=add_unit.uid","left");
	   if(!empty($_GET['projects'])){
		$this->datatables->where("resident.project_id",$_GET['projects']);
	   }
	   if(!empty($_GET['buildings'])){
		$this->datatables->where("resident.building_id",$_GET['buildings']);
	   }
	   if(!empty($_GET['floors'])){
		$this->datatables->where("resident.floor_id",$_GET['floors']);
	   }
	   if(!empty($_GET['units'])){
		$this->datatables->where("resident.project_id",$_GET['units']);
	   }
	   if(!empty($_GET['owner'])){
		$this->datatables->where("resident.relation_owner_id",$_GET['owner']);
	   }
	   $this->datatables->where("resident.soft_deleted",0);
	   $this->datatables->add_column("Actions", $actions, "residentid");
	   echo $this->datatables->generate();
}
	function view($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['idtype']	       = $this->Resident_model->get_idtype();
		$data['project']	   = $this->Resident_model->get_Project();
		$data['nationalitylist']        = $this->Resident_model->get_nationality();
		$data['resident']	   =	$resident		= $this->Resident_model->get($id);
		$data['projectunits']  =	$units		    = $this->Resident_model->get_unitBy_projectWise($id,$resident->units);
		$data['page_title']	= lang('view')." ".lang('resident') ;
		$this->render_admin('Resident/view', $data);
	}
	function form($id = false){
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']	         	= lang('add_resident');
		$data['idtype']	                = $this->Resident_model->get_idtype();
		$data['project']	            = $this->Resident_model->get_Project();
		$data['nationalitylist']        = $this->Resident_model->get_nationality();
		$data['resident']		        =	$resident		= $this->Resident_model->get($id);
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
		//$data['password']   			= '';
		$data['attachments'] 		  	= '';
		$data['building_id']   	        = '';
		$data['vip']  				 	= '';
		$data['family_members']         = '';
		if ($id){	
			$data['page_title']	         	= lang('edit_resident');
			$data['resident']			=	$resident		= $this->Resident_model->get($id);
			$data['projectunits']	    =	$units		    = $this->Resident_model->get_unitBy_projectWise($id,$resident->units);
			if (!$resident){
				$this->session->set_flashdata('error', lang('resident_not_found'));
				redirect('Resident/form');
			}
			$data['residentid']		       = $resident->residentid;
	     	$data['relatiotype']		    = $resident->relatiotype;
			$data['occupy_status']		    = $resident->occupy_status;
			$data['start_date']		        = $resident->start_date;
			$data['end_date']		        = $resident->end_date;
		    $data['full_name']		 	    = $resident->full_name;
		    $data['salutation']	    		= $resident->salutation;
		    $data['surname']				= $resident->surname;
		    $data['firstname']  			= $resident->firstname;
		    $data['nationality']		    = $resident->nationality;
		    $data['dob']					= $resident->dob;
		    $data['sex']					= $resident->sex;
		    $data['id_type']				= $resident->id_type;
		    $data['id_no']   				= $resident->id_no;
		    $data['primary_phone']   		= $resident->primary_phone;
		    $data['handphone']   			= $resident->handphone;
		    $data['app_communication_details']= json_decode($resident->app_communication_details);
		    $data['permanent_address']   	= $resident->permanent_address;
		    $data['project_id'] 		  	= $resident->project_id;
			$data['assigned_unit']   	    = $resident->units;
			$data['building_id']   	        = $resident->building_id;
		    $data['email']   				= $resident->email;
		    $data['attachments'] 		  	= $resident->attachments;
			$data['vip']  				 	= $resident->vip;
			$data['family_members']= json_decode($resident->family_members);
			
		}
		$this->form_validation->set_rules('fullname', 'lang:fullname', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
			
			$this->render_admin('Resident/form', $data);		
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
		  
		   for($i=0; $i<count($this->input->post('resident_name')); $i++){
			if(!empty($_POST['resident_name'][$i]) ){
			$config['upload_path'] = 'uploads/resident/familymembers';
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
              /*   if (!empty($this->input->post('password'))) {
                    $save['password']   			=sha1($this->input->post('password'));
                } */
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
	
	function delete($id = false){
		if ($id){	
			$Resident	= $this->Resident_model->get($id);
		    if (!$Resident){
				$this->session->set_flashdata('error', lang('resident_not_found'));
			    redirect('admin/Resident');
			}else{
				$delete	= $this->Resident_model->delete($id);
				$this->session->set_flashdata('message', lang('delete_resident'));
				redirect('admin/Resident');
			}
		}else{
			    $this->session->set_flashdata('error', lang('resident_not_found'));
				redirect('admin/Resident');
		}
	}
	function get_unitByProject(){
		$projectid = $this->input->post('projectid');
		$HTML='';
		$units=$this->Resident_model->get_unitBy_project($projectid);
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
			$id=$this->input->post('residentid');
			$ownerattachment = $this->Owner_model->get($id);
			$otherdoc=json_decode(($ownerattachment->attachments));
			if (($key = array_search($doc, $otherdoc)) !== false) {
			   unset($otherdoc[$key]);
			  $this->db->where('residentid',$id);
			  $this->db->update('resident',array('attachments'=>json_encode($otherdoc)));
			  
			  if(file_exists(BASEPATH.'../uploads/resident/'.$doc)){
					   unlink(BASEPATH.'../uploads/resident/'.$doc);
			   } 
		}
		return true;
		}
		function download_attachment($name){
			$file = base_url().'uploads/resident/'.$name;
			$data =  file_get_contents($file);
			$file = base_url().'uploads/resident/'.$name;
			force_download($name, $data);
		  }

		  function get_unitOwnerDetails(){
			$unit_id = $this->input->post('unit_id');
			$project_id = $this->input->post('projectid');
			$building_id = $this->input->post('building_id');
			$OwnerDetails=$this->Resident_model->getOwnerDetails($unit_id,$project_id,$building_id);
			echo json_encode($OwnerDetails);
		  }
        function callback_date_check(){
			$people_settings=$this->db->get_where('peoples_settings',array('id'=>1))->row();
			$startdate = $this->input->post('Start_date');
		echo 	$enddate = $this->input->post('End_date');
			die;
			$earlier = new DateTime($startdate);
			$later = new DateTime($enddate);
			$diff = $later->diff($earlier)->format("%a");
			 $diff;
			$this->form_validation->set_message('Url check is invalid');
  			die;
   // do some database things you need to do e.g.
   /*if ($url_check = $this->user_model->check_url($url, $id) {
       return TRUE;
   }
   $this->form_validation->set_message('Url check is invalid');
   return FALSE;  */
	     }
		
}