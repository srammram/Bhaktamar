<?php if (!defined('BASEPATH')) {   exit('No direct script access allowed'); }
class Lease extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array('Lease_model','Tenant_model'));
        $this->load->library('form_validation');
    }
    public function index(){
	     $data['page_title']	=	lang('Unit_request_list');
		 $this->render_admin('lease/request_list', $data); 
    }
	function get_unitRequest(){
		   $actions = "<div class=\"text-center\">";
		   $actions .= "<a href='" .
		   base_url('admin/Lease/$5/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Lease/$4/$2/$3/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Resident/delete/$1/$2/$3') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		    $actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("owner_unit_request.id,project.Name project,building_info.name building,floors.name as floors,unit_name,requesteddate,title,owner_unit_requesttype.name,owner_unit_request.request_status,owner_unit_request.request_type,owner_unit_request.owner_realtion_unitid,owner_unit_requesttype.link,owner_unit_requesttype.view_link", FALSE)
		   ->from("owner_unit_request")
		   ->join("project","project.id=owner_unit_request.projectid","left")
		   ->join("floors","floors.id=owner_unit_request.floorid","left")
		   ->join("add_unit","add_unit.uid=owner_unit_request.unitid","left")
		   ->join("building_info","building_info.bldid=owner_unit_request.buildingid","left")
		   ->join("owner_unit_requesttype","owner_unit_requesttype.id=owner_unit_request.request_type","left")
		   ->where("soft_deleted", 0)
		   ->add_column("Actions", $actions, "owner_unit_request.id,owner_unit_request.request_type,owner_unit_request.owner_realtion_unitid,owner_unit_requesttype.link,owner_unit_requesttype.view_link")
		    ->unset_column('owner_unit_request.request_type,owner_unit_request.owner_realtion_unitid,owner_unit_requesttype.link,owner_unit_requesttype.view_link');
	  echo  $this->datatables->generate();
   }
    public function unit_request_view($id){
        $data['page_title'] = lang('owner_unit_request_view') ;
		$data['request'] = $request = $this->Lease_model->getrequestView($id);
		$data['reqequestunit']  = $this->Lease_model->get_ownerunit($request->owner_realtion_unitid);
		$data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$request->request_type))->row()->name;
        $this->render_admin('myunits/UnitRequestView', $data);
    }
		function Unit_Self_Lease_RequestView($id){
	    $data['page_title'] = lang('Unit_Self_Lease_RequestView') ;
	    $this->db->where("id",$id);
	    $this->db->update("owner_unit_request",array("is_read_pmc"=>1));
	    $data['request'] = $request = $this->Lease_model->getrequestView($id);
	    $data['reqequestunit']  = $this->Lease_model->get_ownerunit($request->owner_realtion_unitid);
        $data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$request->request_type))->row()->name;
	    $this->render_admin('lease/Unit_Self_Lease_RequestView', $data);
	}
	function Unit_Lease_RequestView($id){
	    $data['page_title'] = lang('Unit_Lease_RequestView') ;
	    $this->db->where("id",$id);
	    $this->db->update("owner_unit_request",array("is_read_pmc"=>1));
	    $data['request'] = $request = $this->Lease_model->getrequestView($id);
	    $data['reqequestunit']  = $this->Lease_model->get_ownerunit($request->owner_realtion_unitid);
        $data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$request->request_type))->row()->name;
	    $this->render_admin('lease/Unit_Lease_RequestView', $data);
	}
	function Unit_Sales_RequestView($id){
	    $data['page_title'] = lang('Unit_Sales_RequestView') ;
	    $this->db->where("id",$id);
	    $this->db->update("owner_unit_request",array("is_read_pmc"=>1));
	    $data['request'] = $request = $this->Lease_model->getrequestView($id);
	    $data['reqequestunit']  = $this->Lease_model->get_ownerunit($request->owner_realtion_unitid);
        $data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$request->request_type))->row()->name;
	    $this->render_admin('lease/Unit_Sales_RequestView', $data);
	}
	function Unit_maintenance_RequestView($id){
	    $data['page_title'] = lang('Unit_maintenance_RequestView') ;
	    $this->db->where("id",$id);
	    $this->db->update("owner_unit_request",array("is_read_pmc"=>1));
		$data['maintenanceservices']   = $this->db->get_where("request_subcategory",array("soft_delete"=>0))->result();
		$data['services_list']         = $this->db->get_where("services",array("Soft_delete"=>0))->result();
	    $data['request'] = $request    = $this->Lease_model->getrequestView($id);
	    $data['reqequestunit']         = $this->Lease_model->get_ownerunit($request->owner_realtion_unitid);
        $data['requesttype']           = $this->db->get_where('owner_unit_requesttype',array("id"=>$request->request_type))->row()->name;
	    $this->render_admin('lease/Unit_maintenance_RequestView', $data);
	}
    public function unit_request_form($type,$unitid,$id = false){
        $data['page_title'] = lang('unit_request_form');
        if (!empty($id)) {
			$request = $this->db->get_where('owner_unit_request', array('id' => $id))->row();
        }
        $data['unitid']         = $unitid;
        $data['requesttypid']   = $type;
		$data['reqequestunit']  = $this->Lease_model->get_ownerunit($unitid);
        $data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$type))->row()->name;
        $data['title']           = '';
        $data['date']    		 = '';
        $data['tenure']          = '';
		$data['tenuretype']      = '';
		$data['expectAmount']    = '';
		$data['description']     = '';
        $data['id']              = '';
        if ($id) {
            if (!$request) {
                $this->session->set_flashdata('error', lang('request_not_found'));
                redirect('owner/Myunits/unit_request_list');
			}
            $data['title']           = $request->title;
            $data['tenure']          = $request->tenure;
            $data['tenuretype']      = $request->tenure_type;
            $data['expectAmount']    = $request->expect_amount;
            $data['description']     = $request->owner_description;
            $data['date']            = date('Y-m-d', strtotime($request->requesteddate));
            $data['id']              = $request->id;
        }
        $this->form_validation->set_rules('title', 'lang:title', 'trim|required');
        $this->form_validation->set_rules('tenure', 'lang:tenure', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->render_admin('lease/UnitRequestForm', $data);
        } else {
			$save['title']                = $this->input->post('title');
			$save['request_type']         = $type;
            $save['requesteddate']        = $this->input->post('date');
            $save['tenure']               = $this->input->post('tenure');
            $save['tenure_type']          = $this->input->post('tenure_type');
            $save['expect_amount']        = $this->input->post('expectAmount');
            $save['owner_description']    = $this->input->post('description');
			$save['owner_realtion_unitid']= $unitid;
            if ($id) {
                $save['id'] = $id;
            }
            $this->Lease_model->unit_request_save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('owner/Myunits/unit_request_list');
        }
    }
public function unit_selfLease_request_form($type,$unitid,$id = false){
	
        $data['page_title'] = lang('unit_request_form');
        if (!empty($id)) {
			$request = $this->db->get_where('owner_unit_request', array('id' => $id))->row();
        }
        $data['unitid']         = $unitid;
        $data['requesttypid']   = $type;
		$data['reqequestunit']  = $this->Lease_model->get_ownerunit($unitid);
        $data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$type))->row()->name;
        $data['title']           = '';
        $data['date']    		 = '';
        $data['tenure']          = '';
		$data['tenuretype']      = '';
		$data['expectAmount']    = '';
		$data['description']     = '';
        $data['id']              = '';
		$data['Suggested_amount']= '';
		$data['Pmc_description'] = '';
		$data['commission_type'] = '';
		$data['Commission']      = '';
		$data['owner_approved']    = '';
		$data['pmc_approved']    = '';
		$data['enquiry'] 		 ='';
		$data['is_closed'] 		 ='';

        if ($id) {
            if (!$request) {
                $this->session->set_flashdata('error', lang('request_not_found'));
                redirect('admin/lease');
			}
            $data['title']           = $request->title;
            $data['tenure']          = $request->tenure;
            $data['tenuretype']      = $request->tenure_type;
            $data['expectAmount']    = $request->expect_amount;
            $data['description']     = $request->owner_description;
            $data['date']            = date('Y-m-d', strtotime($request->requesteddate));
            $data['id']              = $request->id;
			$data['Suggested_amount']= $request->pmc_suggest_amount;
		    $data['Pmc_description'] = $request->pmc_description;
			$data['commission_type'] = $request->commission_type;
		    $data['Commission']      = $request->commission;
			$data['owner_approved']  = $request->owner_approved;
			$data['pmc_approved']    = $request->pmc_approved;
			$data['enquiry']         = json_decode($request->enquiry);
			$data['is_closed'] 		 = $request->is_closed;
        }
        $this->form_validation->set_rules('title', 'lang:title', 'trim|required');
        $this->form_validation->set_rules('tenure', 'lang:tenure', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->render_admin('lease/Unit_Self_Lease_RequestForm', $data);
        } else {
		   for($i=0; $i<count($this->input->post('name')); $i++){
			if(!empty($_POST['name'][$i]) ){
			$enquiry[] = array(
				'name' =>	$_POST['name'][$i],
				'enquirydate' =>$_POST['enquiryDate'][$i],
				'phone' =>$_POST['phone'][$i],
				'mobile' =>$_POST['mobile'][$i],
				'email' =>$_POST['email'][$i],
				'address' =>$_POST['address'][$i],
				'message' =>$_POST['message'][$i],
				'enquirystatus' =>$_POST['enquirystatus'][$i]
			); 
		 }
		
	   }
	     if(!empty($enquiry)){
	      	$save['enquiry']=json_encode($enquiry)	;
	      }
			$save['title']                = $this->input->post('title');
			$save['request_type']         = $type;
            $save['requesteddate']        = $this->input->post('date');
            $save['tenure']               = $this->input->post('tenure');
            $save['tenure_type']          = $this->input->post('tenure_type');
            $save['expect_amount']        = $this->input->post('expectAmount');
            $save['owner_description']    = $this->input->post('description');
			$save['owner_realtion_unitid']= $unitid;
			$save['request_status']       = lang('Progress');
			$save['is_read_owner']        = 2;
			$save['pmc_suggest_amount']   = $this->input->post('Suggested_amount');
		    $save['pmc_description']      = $this->input->post('Pmc_description');
			$save['commission_type']      = $this->input->post('commission_type');
		    $save['commission']           = $this->input->post('Commission');
		    if(!empty($this->input->post('Isclosed'))){
				$save['is_read_owner']           = 2;
				//$save['pmc_approved']          = $this->input->post('Commission');
				$save['is_closed_by']            ='Admin';
				$save['is_closed']               = 1;
				$save['request_status']         = lang('closed');
			}
			
            if ($id) {
                $save['id'] = $id;
            }
            $this->Lease_model->unit_request_save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('admin/lease');
        }
    }
 public function unit_lease_request_form($type,$unitid,$id = false){
	 
        $data['page_title'] = lang('unit_lease_request_form');
        if (!empty($id)) {
			$request = $this->db->get_where('owner_unit_request', array('id' => $id))->row();
        }
        $data['unitid']         = $unitid;
        $data['requesttypid']   = $type;
		$data['reqequestunit']  = $this->Lease_model->get_ownerunit($unitid);
        $data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$type))->row()->name;
        $data['title']           = '';
        $data['date']    		 = '';
        $data['tenure']          = '';
		$data['tenuretype']      = '';
		$data['expectAmount']    = '';
		$data['description']     = '';
        $data['id']              = '';
		
		
        if ($id) {
            if (!$request) {
                $this->session->set_flashdata('error', lang('request_not_found'));
                 redirect('admin/lease');
			}
            $data['title']           = $request->title;
            $data['tenure']          = $request->tenure;
            $data['tenuretype']      = $request->tenure_type;
            $data['expectAmount']    = $request->expect_amount;
            $data['description']     = $request->owner_description;
            $data['date']            = date('Y-m-d', strtotime($request->requesteddate));
            $data['id']              = $request->id;
			$data['Suggested_amount']= $request->pmc_suggest_amount;
		    $data['Pmc_description'] = $request->pmc_description;
			$data['commission_type'] = $request->commission_type;
		    $data['Commission']      = $request->commission;
			$data['owner_approved']    = $request->owner_approved;
			$data['pmc_approved']    = $request->pmc_approved;
        }
        $this->form_validation->set_rules('title', 'lang:title', 'trim|required');
        $this->form_validation->set_rules('tenure', 'lang:tenure', 'trim|required');
        if ($this->form_validation->run() == false) {
			 $this->render_admin('lease/Unit_Lease_RequestForm', $data);
        } else {
			$save['title']                = $this->input->post('title');
			$save['request_type']         = $type;
            $save['requesteddate']        = $this->input->post('date');
            $save['tenure']               = $this->input->post('tenure');
            $save['tenure_type']          = $this->input->post('tenure_type');
            $save['expect_amount']        = $this->input->post('expectAmount');
            $save['owner_description']    = $this->input->post('description');
			$save['owner_realtion_unitid']= $unitid;
			$save['request_status']             = lang('Progress');
		   $save['request_status']        = lang('Progress');
			$save['is_read_owner']        = 2;
			$save['pmc_suggest_amount']   = $this->input->post('Suggested_amount');
		    $save['pmc_description']      = $this->input->post('Pmc_description');
			$save['commission_type']      = $this->input->post('commission_type');
		    $save['commission']           = $this->input->post('Commission');
            if ($id) {
                $save['id'] = $id;
            }
            $this->Lease_model->unit_request_save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
             redirect('admin/lease');
        }
    }
	public function unit_maintenance_request_form($type,$unitid,$id = false){
        $data['page_title'] = lang('unit_request_form');
		
        if (!empty($id)) {
			$request = $this->db->get_where('owner_unit_request', array('id' => $id))->row();
        }
		
        $data['unitid']         = $unitid;
        $data['requesttypid']   = $type;
		$data['reqequestunit']  = $this->Lease_model->get_ownerunit($unitid);
		$data['maintenanceservices']  = $this->db->get_where("request_subcategory",array("soft_delete"=>0))->result();
		$data['services_list']             = $this->db->get_where("services",array("Soft_delete"=>0))->result();
        $data['requesttype']          = $this->db->get_where('owner_unit_requesttype',array("id"=>$type))->row()->name;
        $data['title']                = '';
        $data['date']    		      = '';
        $data['tenure']               = '';
		$data['tenuretype']           = '';
		$data['expectAmount']         = '';
		$data['description']          = '';
        $data['id']                   = '';
		$data['ms']          		  = '';
        $data['services']             = '';
		$data['maintenance_amount']   = '';
		$data['period']               = '';
		
        if ($id) {
            if (!$request) {
                $this->session->set_flashdata('error', lang('request_not_found'));
                 redirect('admin/lease');
			}
            $data['title']           = $request->title;
            $data['tenure']          = $request->tenure;
            $data['tenuretype']      = $request->tenure_type;
            $data['expectAmount']    = $request->expect_amount;
            $data['description']     = $request->owner_description;
            $data['date']            = date('Y-m-d', strtotime($request->requesteddate));
            $data['id']              = $request->id;
		    $data['ms']          		  = json_decode($request->maintenance_services);
            $data['services']             = json_decode($request->services);
			$data['maintenance_amount']   = $request->maintenance_amount;
			$data['Pmc_description']      = $request->pmc_description;
	     	$data['period']               = $request->period;
        }
		
        $this->form_validation->set_rules('title', 'lang:title', 'trim|required');
        $this->form_validation->set_rules('tenure', 'lang:tenure', 'trim|required');
        if ($this->form_validation->run() == false) {
			 $this->render_admin('lease/Unit_maintenance_RequestForm', $data);
        } else {
			
			$save['title']                = $this->input->post('title');
			$save['request_type']         = $type;
            $save['requesteddate']        = $this->input->post('date');
            $save['tenure']               = $this->input->post('tenure');
            $save['tenure_type']          = $this->input->post('tenure_type');
            $save['expect_amount']        = $this->input->post('expectAmount');
            $save['owner_description']    = $this->input->post('description');
			$save['owner_realtion_unitid']= $unitid;
			$save['request_status']             = lang('Progress');
			$save['maintenance_services']    = json_encode($this->input->post('maintenance_services'));
			$save['services']                = json_encode($this->input->post('services'));
			$save['maintenance_amount']   = $this->input->post('maintenance_Amount');
	     	$save['period']               = $this->input->post('m_period');
            if ($id) {
                $save['id'] = $id;
            }
            $this->Lease_model->unit_request_save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('admin/lease');
        }
    }
public function unit_sale_request_form($type,$unitid,$id = false){
        $data['page_title'] = lang('unit_sales_request_form');
        if (!empty($id)) {
			$request = $this->db->get_where('owner_unit_request', array('id' => $id))->row();
        }
        $data['unitid']         = $unitid;
        $data['requesttypid']   = $type;
		$data['reqequestunit']  = $this->Lease_model->get_ownerunit($unitid);
        $data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$type))->row()->name;
        $data['title']           = '';
        $data['date']    		 = '';
        $data['tenure']          = '';
		$data['tenuretype']      = '';
		$data['expectAmount']    = '';
		$data['description']     = '';
        $data['id']              = '';
		$data['Suggested_amount']= '';
		$data['Pmc_description'] = '';
	    $data['commission_type'] = '';
		$data['Commission']      = '';
		
        if ($id) {
            if (!$request) {
                $this->session->set_flashdata('error', lang('request_not_found'));
                redirect('admin/lease');
			}
            $data['title']           = $request->title;
            $data['tenure']          = $request->tenure;
            $data['tenuretype']      = $request->tenure_type;
            $data['expectAmount']    = $request->expect_amount;
            $data['description']     = $request->owner_description;
			$data['Suggested_amount']= $request->pmc_suggest_amount;
		    $data['Pmc_description'] = $request->pmc_description;
			$data['commission_type'] = $request->commission_type;
		    $data['Commission']      = $request->commission;
            $data['date']            = date('Y-m-d', strtotime($request->requesteddate));
            $data['id']              = $request->id;
        }
        $this->form_validation->set_rules('title', 'lang:title', 'trim|required');
        //$this->form_validation->set_rules('tenure', 'lang:tenure', 'trim|required');
        if ($this->form_validation->run() == false) {
			$this->render_admin('lease/Unit_Sales_RequestForm', $data);
        } else {
			$save['title']                = $this->input->post('title');
			$save['request_type']         = $type;
            $save['requesteddate']        = $this->input->post('date');
            $save['tenure']               = $this->input->post('tenure');
            $save['tenure_type']          = $this->input->post('tenure_type');
            $save['expect_amount']        = $this->input->post('expectAmount');
            $save['owner_description']    = $this->input->post('description');
			$save['owner_realtion_unitid']= $unitid;
			$save['request_status']        = lang('Progress');
			$save['is_read_owner']        = 2;
			$save['pmc_suggest_amount']   = $this->input->post('Suggested_amount');
		    $save['pmc_description']      = $this->input->post('Pmc_description');
			$save['commission_type']      = $this->input->post('commission_type');
		    $save['commission']           = $this->input->post('Commission');
            if ($id) {
                $save['id'] = $id;
            }
		
            $this->Lease_model->unit_request_save($save);
			
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
          redirect('admin/lease');
        }
    }
	function request_acceptByPMC($id){
	  $request=$this->db->get_where("owner_unit_request",array("id"=>$id))->row();
	  $this->db->where("id",$id);
	  if($this->db->update("owner_unit_request",array("is_read_owner"=>2,"pmc_approved"=>1,"is_read_pmc"=>1))){
		    $request_url=$this->db->get_where("owner_unit_requesttype",array("id"=>$request->request_type))->row();
			switch($request->request_type){
				case  3 :
				 $this->db->where("id",$request->owner_realtion_unitid);
				 $this->db->update("add_owner_unit_relation",array("is_lease"=>1));
				break;
				case 2:
				 $this->db->where(array("uid"=>$request->unitid,"building_id"=>$request->buildingid,"floor_no"=>$request->floorid,"Project_id"=>$request->projectid));
				 $this->db->update("add_unit",array("Booked_status"=>0,"request_id"=>$id));
				break;
			}
		    $this->session->set_flashdata('message', lang('request_accepted'));
		    redirect('admin/lease/'.$request_url->link.'/'.$request->request_type.'/'.$request->owner_realtion_unitid.'/'.$id);
	  }
  }
  function request_rejectByPMC($id){
	    $request=$this->db->get_where("owner_unit_request",array("id"=>$id))->row();
	    $this->db->where("id",$id);
	   if($this->db->update("owner_unit_request",array("is_read_owner"=>2,"pmc_approved"=>2,"is_closed_by"=>'Admin',"is_closed"=>1,"request_status"=>lang('closed')))){
		    $request_url=$this->db->get_where("owner_unit_requesttype",array("id"=>$request->request_type))->row();
		    $this->session->set_flashdata('message', lang('request_updated'));
		    redirect('admin/lease/'.$request_url->view_link.'/'.$id);
	  }
	  
  }function request_declineByPMC($id){
		 $this->db->where("id",$id);
	     $this->db->update("owner_unit_request",array("is_read_pmc"=>1));
		 $this->session->set_flashdata('message', lang('request_updated'));
		 redirect('admin/lease/Unit_Self_Lease_RequestView/'.$id);
	  
  }
  function generate_Maintenance_Agreements($requestid){
	    $get_request=$this->Lease_model->get_request($requestid);
		if($this->Lease_model->generate_maintenance_agreements($get_request)){
			  $this->db->where("id",$requestid);
			  $this->db->update("owner_unit_request",array("request_status"=>lang('completed')));
			  $this->session->set_flashdata('message', lang('maintenance_agreement_generated_success'));
			  redirect('admin/lease/Unit_maintenance_RequestView/'.$requestid);
		}else{
			 $this->session->set_flashdata('message', lang('unable_to_generate_maintenance_agreement'));
			  redirect('admin/lease/Unit_maintenance_RequestView/'.$requestid);
		}
	    
	  
  }
   public function maintenance_agreements(){
	     $data['page_title']	=	lang('maintenance_agreement_list');
		 $this->render_admin('lease/maintenance_agreements_list', $data); 
    }
	function get_maintenance_agreements(){
		   $actions = "<div class=\"text-center\">";
		   $actions .= "<a href='" .
		   base_url('admin/Lease/view_maintenance_agreements/$1') . "'  class='tip' ><i class=\"fa fa-search\"></i></a> ";
		    $actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("owner_maintenance_agreements.id,project.Name project,building_info.name building,floors.name as floors,unit_name,full_name,owner_maintenance_agreements.start_date ,owner_maintenance_agreements. end_date,maintenance_amount ", FALSE)
		   ->from("owner_maintenance_agreements")
		   ->join("project","project.id=owner_maintenance_agreements.projectid","left")
		   ->join("floors","floors.id=owner_maintenance_agreements.floorid","left")
		   ->join("add_unit","add_unit.uid=owner_maintenance_agreements.unitid","left")
		   ->join("building_info","building_info.bldid=owner_maintenance_agreements.buildingid","left")
		   ->join("owner","owner.ownid=owner_maintenance_agreements.owner_id","left")
		   ->where("owner_maintenance_agreements.soft_deleted", 0)
		   ->add_column("Actions", $actions, "owner_maintenance_agreements.id");
		   
		//$this->datatables->unset_column($2);
	  echo  $this->datatables->generate();
			//   echo $this->db->last_query();
   }
    public function lease_agreements(){
	     $data['page_title']	=	lang('Lease_agreement_list');
		 $this->render_admin('lease/Lease_agreements_list', $data); 
    }
	function get_lease_agreements(){
		   $actions = "<div class=\"text-center\">";
		   $actions .= "<a href='" .
		   base_url('admin/lease/lease_agreements_view/$1') . "'  class='tip' ><i class=\"fa fa-search\"></i></a> ";
		    $actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("agreement_id,project.Name project,building_info.name building,floors.name as name,unit_name,tenant_agreement.full_name,tenant_agreement.start_date,tenant_agreement.end_date,tenant_agreement.type", FALSE)
		   ->from("tenant_agreement")
		   ->join("project","project.id=tenant_agreement.project_id","left")
		   ->join("floors","floors.id=tenant_agreement.floor_id","left")
		   ->join("add_unit","add_unit.uid=tenant_agreement.unitid","left")
		   ->join("building_info","building_info.bldid=tenant_agreement.building_id","left")
		  ->join("tenant","tenant.tentant_id=tenant_agreement.tentant_id","left")
		   ->where("tenant_agreement.soft_deleted", 0)
		     ->where("tenant_creadted_by", 2)
		   ->add_column("Actions", $actions, "agreement_id");
			echo  $this->datatables->generate();
			//echo $this->db->last_query();
   }
  function  lease_agreements_view($id,$tab=false){
		$tenant_agreement=$this->db->get_where("tenant_agreement",array("agreement_id"=>$id))->row();
		$data['idtype']	                = $this->Tenant_model->get_idtype();
		$data['nationalitylist']        = $this->Tenant_model->get_nationality();
		$data['project']	            = $this->Tenant_model->get_Project();
		$data['tenant']	                =	$tenant	= $this->Tenant_model->get($tenant_agreement->tentant_id);
		$data['leasesunits']		    =	$units  = $this->Tenant_model->get_TenantUnit($tenant->project_id,$tenant->building_id,$tenant->unitid,$tenant->leaseunit_type);
		$data['buildings']=$this->db->get_where("building_info",array("project_id"=>$tenant->project_id,"soft_delete"=>0))->result();
		$data['page_title']	= lang('view')." ".lang('Tenant') ;
		$this->render_admin('lease/lease_agreements_view', $data);
	}
	function view_maintenance_agreements($id){
	    $data['page_title'] = lang('Unit_maintenance_Agreement_view') ;
	   $data['agreements']= $agreements_details=$this->db->get_where("owner_maintenance_agreements",array("id"=>$id))->row();
	    $data['maintenanceservices']  = $this->db->get_where("request_subcategory",array("soft_delete"=>0))->result();
		$data['services_list']             = $this->db->get_where("services",array("Soft_delete"=>0))->result();
	    $data['request']                   = $request = $this->Lease_model->getrequestView($agreements_details->request_id);
	    $data['reqequestunit']             = $this->Lease_model->get_ownerunit($request->unitid);
        $data['requesttype']               = $this->db->get_where('owner_unit_requesttype',array("id"=>$request->request_type))->row()->name;
	    $this->render_admin('lease/maintenance_agreements_view', $data);
	}
}
