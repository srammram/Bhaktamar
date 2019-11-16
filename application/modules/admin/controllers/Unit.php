<?php

class Unit extends Admin_Controller {
	function __construct()
	{		
		parent::__construct();
		$this->load->model(array('Unit_model'));
		$this->load->helper('download');
	}
	function index(){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Houses');
		//$data['units']	= $this->Unit_model->get_all();
		$this->render_admin('unit/list', $data);		
	}
	function get_units(){
		 $actions = "<div class=\"text-center\">";
         $actions .= "<a href='" . base_url('admin/unit/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/unit/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/unit/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
         $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("uid,unit_no,floors.name floorNo,building_info.name building,project.Name,size,CASE 
			WHEN Booked_status= 1 THEN 'Booked' WHEN Booked_status=0 THEN 'Available' END unitSTATUS", FALSE)
            ->from("add_unit")
			->join("project","project.id=add_unit.Project_id","left")
			->join("floors","floors.id=add_unit.floor_no","left")
			->join("building_info","building_info.bldid=add_unit.building_id","left")   
			->where("add_unit.soft_delete",0)
		//	->order_by("uid","ASC")
            ->add_column("Actions", $actions, "uid");
	     echo $this->datatables->generate();
		
	}
	function view($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['unit']	            =	$unit		= $this->Unit_model->get($id);
		$data['page_title']	        = lang('view')." ".lang('Units') ;
		$data['UnitGroupType']	    =$this->Unit_model->Get_UnitType();
		$data['floor']			  =   $floor	    = $this->Unit_model->get_floorbyBuildingwise($unit->Project_id,$unit->building_id);
		$data['buildings']        =   $building   = $this->Unit_model->get_buildingProjectWise($unit->Project_id);
		$data['Amenities']			= $this->Unit_model->get_amenities();
		$data['soc']			    = $this->Unit_model->get_SOC();
		$data['Project']			= $this->Unit_model->get_Project();
		$data['Unit_type']			= $this->Unit_model->get_Unit_type();
		$data['intension']			= $this->Unit_model->getInstension();
		$data['status']			    = $status=$this->Unit_model->getStatus();
		$data['currency']           =  $this->Unit_model->getCurrency();
		$data['Amenities']	        =  $this->Unit_model->get_amenities();
	    $data['residents']	    =  $resident=  $this->Unit_model->getUnitWiseResident($unit->Project_id,$unit->building_id,$unit->uid);
		$data['used_Amenities']	    =  $this->Unit_model->amenities($unit->Amenities);
	
		$this->render_admin('unit/view', $data);
	}
	function form($id = false){
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['page_title']		= lang('Add_Unit');
		$data['UnitGroupType']	    =$this->Unit_model->Get_UnitType();
		$data['Amenities']			= $this->Unit_model->get_amenities();
		$data['soc']			    = $this->Unit_model->get_SOC();
		$data['Project']			= $this->Unit_model->get_Project();
		$data['Unit_type']			= $this->Unit_model->get_Unit_type();
		$data['intension']			= $this->Unit_model->getInstension();
		$data['status']			    = $status=$this->Unit_model->getStatus();
		$data['pmc']			    = $pmc=$this->Unit_model->getPMC();
		$data['id']					= '';
		$data['Project_id']		    = '';
		$data['Unitgrouptype_id']	= '';
		$data['UnitType']		    = '';
		$data['status_id']			= '';
		$data['intention_id']	    = '';
		$data['Floor_id']	        = '';
		$data['unit_no']	        = '';
		$data['size']	            = '';
		$data['address']	        = '';
		$data['Inside_unit']	    = '';
	    $data['note']	            = '';
		$data['attachments']	    = '';
		$data['contracts']	        ='';
	    $data['Amenities_ids']	    = '';
		$data['building_id']	    = '';
	   // $data['Ownerid']	        = '';
	    $data['pmc_id']	            = '';
		$data['soc_id']			    = '';
		$data['price']	            = '';
		if ($id){	
			$data['unit']			=	$unit		= $this->Unit_model->get($id);
			$data['buildings']      =   $building   = $this->Unit_model->get_buildingProjectWise($unit->Project_id);
			$data['floor']			=   $floor	    = $this->Unit_model->get_floorbyBuildingwise($unit->Project_id,$unit->building_id);
			if (!$unit){
				$this->session->set_flashdata('error', lang('Unit_not_found'));
				redirect('admin/Unit');
			}
			$data['uid']			    = $unit->uid;
			$data['id']					= $unit->uid;
			$data['Project_id']		    = $unit->Project_id;
			$data['Unitgrouptype_id']	= $unit->Unit_groupType;
			$data['soc_id']			    = $unit->Soc;
			$data['UnitType']		    = $unit->Unit_type;
			$data['status_id']		    = $unit->status;
			$data['intention_id']		= $unit->intention;
			$data['unitname']		    = $unit->unit_name;
			$data['Floor_id']		    = $unit->floor_no;
			$data['unit_no']	        = $unit->unit_no;
		    $data['size']	            = $unit->size;
		    $data['address']	        = $unit->address;
			$data['Inside_unit']	    = $unit->insideunit;
	        $data['note']	            = $unit->note;
			$data['attachments']	    = json_decode($unit->attachment);
			$data['contracts']	        = $unit->contract;
			$data['Amenities_ids']	    = json_decode($unit->Amenities);
			$data['building_id']	    = $unit->building_id;
			$data['price']	            = $unit->unitPrice;
			$data['pmc_id']	            =$unit->pmc_id;
	     //   $data['Ownerid']	        = $unit->owner_id;
		 }
		$this->form_validation->set_rules('Project', 'lang:Unit_Project_name', 'trim|required');
		$this->form_validation->set_rules('unitname', 'lang:Unit_name', 'trim|required');
	    $this->form_validation->set_rules('UnitType', 'lang:UnitType', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('unit/form', $data);		
		}else{
				foreach ($_FILES['attachment']['name'] as $key => $image) {
				$config['upload_path'] = 'uploads/unit/attachment/';
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
			if(!empty($otherdoc)){
			  foreach(json_decode($unit->attachment) as $path){
				$otherdoc[]=$path;
			  }
				$save['attachment']	        =!empty($otherdoc)? json_encode($otherdoc):NULL;
			}
			if (!empty($_FILES['contract']['name'])) {
				$config['upload_path'] = 'uploads/unit/';
				$config['allowed_types'] = '*';
				$config['file_name'] = $_FILES['contract']['name'];
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('contract')) {
					$uploadData = $this->upload->data();
					$contract = str_replace(' ', '_',$uploadData['file_name']) ;
				} 
				$save['contract']	    =!empty($contract)?$contract:NULL;
			}
		
			 $id=$this->input->post('id');
			 $save['Project_id']		= $this->input->post('Project');
			 $save['Unit_groupType']    = $this->input->post('Unitgrouptype');
			 $save['Soc']			    = $this->input->post('soc');
			 $save['Unit_type']			= $this->input->post('UnitType');
		   	 $save['status']	        = $this->input->post('status');
			 $save['intention']	        = $this->input->post('intension');
			 $save['unit_name']	        = $this->input->post('unitname');
			 $save['floor_no']			= $this->input->post('Floor') ;
			 $save['unit_no']			= $this->input->post('unit_no') ;
			 $save['size']			    = $this->input->post('size') ;
			 $save['address']	        = $this->input->post('address');
		     $save['insideunit']	    = $this->input->post('Inside_unit');
		     $save['note']	            =$this->input->post('note');
			 $save['Amenities']	        =json_encode($this->input->post('Amenities'));
			 $save['building_id']	    =$this->input->post('building_id');
			 $save['pmc_id']	        =$this->input->post('pmc_id');
			 $save['Booked_status']	    = !empty($this->input->post('Ownerid'))?1:0 ;
			 $save['unitPrice']	        = !empty($this->input->post('price'))? $this->input->post('price'):0 ;
		 $this->Unit_model->save($save,$id);
			if($id){
				$this->session->set_flashdata('message', lang('unit_update'));
			}else{
				$this->session->set_flashdata('message', lang('unit_save'));
			}
			redirect('admin/Unit'); 
		}
	}
	
	function delete($id = false){
		if ($id){	
			$floor	= $this->Unit_model->get($id);
		 if (!$floor){
				$this->session->set_flashdata('error', lang('Unit_not_found'));
				redirect('admin/Unit');
			}else{
				$delete	= $this->Unit_model->delete($id);
				$this->session->set_flashdata('message', lang('unit_delete'));
				redirect('admin/Unit');
			}
		}
		else{
		        $this->session->set_flashdata('error', lang('Unit_not_found'));
				redirect('admin/Unit');
		}
	}

	function doc_delete(){
	$doc= $this->input->post('doc'); 
	$id=$this->input->post('unitid');
	$unitattachment = $this->Unit_model->get($id);
	$otherdoc=json_decode(($unitattachment->attachment));
	if (($key = array_search($doc, $otherdoc)) !== false) {
	   unset($otherdoc[$key]);
	  $this->db->where('uid',$id);
	  $this->db->update('add_unit',array('attachment'=>json_encode($otherdoc)));
	  echo $this->db->last_query();
	  if(file_exists(BASEPATH.'../uploads/unit/attachment/'.$doc)){
			   unlink(BASEPATH.'../uploads/unit/attachment/'.$doc);
	   } 
}
		return true;
}
	function download_contract($id = null)  {
        $unitattachment = $this->Unit_model->get($id);
        $Attachment = $unitattachment->contract;
        $file = base_url().'uploads/unit/'.$Attachment;
        $data =  file_get_contents($file);
        force_download($unitattachment->attachment_path, $data);
    }
  function download_otherdoc($name){
    $file = base_url().'uploads/unit/attachment/'.$name;
    $data =  file_get_contents($file);
    force_download($unitattachment->attachment_path, $data);
  }
  function importUnits(){
    if (isset($_POST["submit"])) {
		$tmp = explode(".", $_FILES['import']['name']); // For getting Extension of selected file
		
		die;
        $extension = end($tmp);
        $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
        if (in_array($extension, $allowed_extension)) { //check selected file extension is present in allowed extension array
            $this->load->library('Data_importer');
            $file = $_FILES["import"]["tmp_name"]; // getting temporary
            $prefix = EMPLOYEE_ID_PREFIX;
            // prepend file path with project directory
            $excel = PHPExcel_IOFactory::load($file);
            $i=0;
            foreach ($excel->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                for ($row=2; $row<=$highestRow; $row++) {
                    $ProjectName        = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$Floorname          = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$unit_name          = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $UnitNO             = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $Unit_GroupType     = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $UnitType           = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $STATUS         	= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $Intention    		= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $Size            	= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $Inside_Size    	= $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $Project_data          = array('Name'                  => $ProjectName);
                    $Floor_data            = array('name'                  => $Floorname);
                    $Unit_data             = array('add_unit'              => $UnitNO);
                    $Unit_GroupType_data   = array('unit_group_type'       => $Unit_GroupType);
                    $UnitType_data         = array('UnitType'              =>$UnitType);
                    $Intention_data        = array('name'                  => $Intention);
                    $STATUS_data           = array('status_name'           =>$STATUS);
                    if (isset($ProjectName)) {
                        $Project = $this->db->get_where('project', array('Name' => $ProjectName))->row();
                        if (empty($Project->Name)) {
                            $this->db->insert('project', $Project_data);
                            $project_id = $this->db->insert_id();
                        } else {
                            $Project_id=$Project->id;
                        }
                    }
                    if (isset($Floorname)) {
                        $floor = $this->db->get_where('floors', array('name' => $Floorname))->row();
                        if (empty($floor->name)) {
                            $this->db->insert('floors', $Floor_data);
                            $floor_id = $this->db->insert_id();
                        } else {
                            $floor_id=$floor->id ;
                        }
                    }
                    if (!empty($Unit_GroupType)) {
                        $unit_grouptype = $this->db->get_where('unit_group_type', array('unit_group_type' => $Unit_GroupType))->row();
                        if (empty($unit_grouptype->unit_group_type)) {
                            $this->db->insert('unit_group_type', $Unit_GroupType_data);
                            $unitgrouptype_id = $this->db->insert_id();
                        } else {
                            $unitgrouptype_id=$unit_grouptype->id ;
                        }
					}
					if (!empty($UnitType)) {
                        $UnitType = $this->db->get_where('unit_type', array('UnitType' => $UnitType))->row();
                        if (empty($UnitType->UnitType)) {
                            $this->db->insert('unit_type', $UnitType_data);
                            $unitytpe_id = $this->db->insert_id();
                        } else {
                            $unittype_id=$UnitType->id ;
                        }
					}
					if (!empty($STATUS)) {
                        $unit_status = $this->db->get_where('unit_status', array('status_name' => $STATUS))->row();
                        if (empty($unit_status->status_name)) {
                            $this->db->insert('unit_status', $STATUS_data);
                            $unitstatus_id= $this->db->insert_id();
                        } else {
                            $unitstatus_id=$unit_status->status_id ;
                        }
					}
					
					if (!empty($Intention)) {
                        $Intentions = $this->db->get_where('unit_intension', array('name' => $Intention))->row();
                        if (empty($unit_staIntentionstus->name)) {
                            $this->db->insert('unit_status', $STATUS_data);
                            $unit_intention_id= $this->db->insert_id();
                        } else {
                            $unit_intention_id=$Intentions->intension_id ;
                        }
                    }
				}
				$units[]= array(
					'Project_id'        => $Project_id,
					'Unit_groupType'    => $unitgrouptype_id,
					'Unit_type'         => $unitytpe_id,
					'status'            => $unitstatus_id,
					'intention'         => $unit_intention_id,
					'unit_name' 	    => $unit_name,
					'floor_no'          =>$floor_id,
					'unit_no'           =>$UnitNO,
					'size'  	        =>$Size,
					'insideunit'        =>$Inside_Size
				);
				  $this->db->insert('add_unit',$units);
			}
			$this->message->save_success('admin/unit/importUnits');
        }else{
			$this->message->custom_error_msg('admin/unit/importUnits', lang('failed_to_import_data'));
		}
    }
	
	$data['page_title']	= lang('Import_unit');
	$this->render_admin('unit/import_units', $data);		
}
function downloadUnitsSample(){
	$this->load->helper('download');
	$file = base_url().'./assets/import'.'/'.'units.xlsx';
	$data =  file_get_contents($file);
	force_download('units.xlsx', $data);
}
function get_floor(){
	$HTML='';
    $project_id = $this->input->post('project_id');
 	$buildingid = $this->input->post('buildingid');
	$floors=$this->db->get_where('floors',array('Soft_delete'=>0,'projectid' => $project_id,'building_id'=>$buildingid))->result();
	if ($floors) {
		foreach ($floors as $floor) {
			$HTML.="<option value='" . $floor->id . "'>" . $floor->name. "</option>";
		}
	}else{
		$HTML.="<option value=''>Select Floor</option>";
	}
        echo $HTML;
	 
    }
}