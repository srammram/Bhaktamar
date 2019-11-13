<?php if (!defined('BASEPATH')) {   exit('No direct script access allowed'); }
class Myunits extends Owner_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('owner/Myunits_model'));
        $this->load->library('form_validation');
    }
    public function index(){
		 $data['page_title']	=	lang('myunits');
		 $Owner = $this->session->userdata('owner');
		 $data['unitrequest'] =$this->db->get_where("owner_unit_requesttype",array("soft_delete"=>0))->result();
		 $data['activeunits'] = $activeunits = $this->Myunits_model->get_ownerWiseUnit($Owner['owner_id']);
		 $this->render_owner('myunits/UnitList', $data);
    }
    public function unit_request_list(){
        $Owner = $this->session->userdata('owner');
        $data['page_title'] = lang('owner_unit_request');
        $data['request'] = $this->Myunits_model->get_allRequest($Owner['owner_id']);
        $this->render_owner('myunits/UnitRequestList', $data);
    }
    public function unit_request_view($id){
        $data['page_title'] = lang('owner_unit_request_view') ;
		$data['request'] = $request = $this->Myunits_model->getrequestView($id);
		$data['reqequestunit']  = $this->Myunits_model->get_ownerunit($request->owner_realtion_unitid);
		$data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$request->request_type))->row()->name;
        $this->render_owner('myunits/UnitRequestView', $data);
    }
	function Unit_Self_Lease_RequestView($id){
	$data['page_title'] = lang('Unit_Self_Lease_RequestView') ;
	$this->db->where("id",$id);
	$this->db->update("owner_unit_request",array("is_read_owner"=>1));
	$data['request'] = $request = $this->Myunits_model->getrequestView($id);
	$data['reqequestunit']  = $this->Myunits_model->get_ownerunit($request->owner_realtion_unitid);
    $data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$request->request_type))->row()->name;
	$this->render_owner('myunits/Unit_Self_Lease_RequestView', $data);
	}
	function Unit_Sales_RequestView($id){
	$data['page_title'] = lang('Unit_Sales_RequestView') ;
	$this->db->where("id",$id);
	$this->db->update("owner_unit_request",array("is_read_owner"=>1));
	$data['request'] = $request = $this->Myunits_model->getrequestView($id);
	$data['reqequestunit']  = $this->Myunits_model->get_ownerunit($request->owner_realtion_unitid);
    $data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$request->request_type))->row()->name;
	$this->render_owner('myunits/Unit_Sales_RequestView', $data);
		}
	function Unit_Lease_RequestView($id){
	     $data['page_title'] = lang('Unit_Lease_RequestView') ;
	     $data['request'] = $request = $this->Myunits_model->getrequestView($id);
		
		 $this->db->where("id",$id);
	     $this->db->update("owner_unit_request",array("is_read_owner"=>1));
	     $data['reqequestunit']  = $this->Myunits_model->get_ownerunit($request->owner_realtion_unitid);
         $data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$request->request_type))->row()->name;
	     $this->render_owner('myunits/Unit_Lease_RequestView', $data);
		}
	function Unit_maintenance_RequestView($id){
		$data['page_title'] = lang('Unit_maintenance_RequestView') ;
		$this->db->where("id",$id);
	    $this->db->update("owner_unit_request",array("is_read_owner"=>1));
	    $data['maintenanceservices']  = $this->db->get_where("request_subcategory",array("soft_delete"=>0))->result();
		$data['services_list']             = $this->db->get_where("services",array("Soft_delete"=>0))->result();
	    $data['request'] = $request = $this->Myunits_model->getrequestView($id);
	    $data['reqequestunit']  = $this->Myunits_model->get_ownerunit($request->owner_realtion_unitid);
        $data['requesttype']    = $this->db->get_where('owner_unit_requesttype',array("id"=>$request->request_type))->row()->name;
	    $this->render_owner('myunits/Unit_maintenance_RequestView', $data);
	}
	
    public function unit_selfLease_request_form($type,$unitid,$id = false){
        $data['page_title'] = lang('unit_request_form');
        $Owner = $this->session->userdata('owner');
        if (!empty($id)) {
			$request = $this->db->get_where('owner_unit_request', array('id' => $id))->row();
        }
        $data['unitid']         = $unitid;
        $data['requesttypid']   = $type;
		$data['reqequestunit']  = $this->Myunits_model->get_ownerunit($unitid);
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
            $this->render_owner('myunits/Unit_Self_Lease_RequestForm', $data);
        } else {
			$save['title']                = $this->input->post('title');
			$save['request_type']         = $type;
            $save['requesteddate']        = $this->input->post('date');
            $save['tenure']               = $this->input->post('tenure');
            $save['tenure_type']          = $this->input->post('tenure_type');
            $save['expect_amount']        = $this->input->post('expectAmount');
            $save['owner_description']    = $this->input->post('description');
			$save['owner_realtion_unitid']= $unitid;
            $save['owner_id']             = $Owner['owner_id'];
			$save['request_status']             = lang('pending');
            if ($id) {
                $save['id'] = $id;
            }
            $this->Myunits_model->unit_request_save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('owner/Myunits/unit_request_list');
        }
    }
 public function unit_lease_request_form($type,$unitid,$id = false){
        $data['page_title'] = lang('unit_request_form');
        $Owner = $this->session->userdata('owner');
        if (!empty($id)) {
			$request = $this->db->get_where('owner_unit_request', array('id' => $id))->row();
        }
        $data['unitid']         = $unitid;
        $data['requesttypid']   = $type;
		$data['reqequestunit']  = $this->Myunits_model->get_ownerunit($unitid);
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
            $this->render_owner('myunits/Unit_Lease_RequestForm', $data);
          } else {
			$save['title']                = $this->input->post('title');
			$save['request_type']         = $type;
            $save['requesteddate']        = $this->input->post('date');
            $save['tenure']               = $this->input->post('tenure');
            $save['tenure_type']          = $this->input->post('tenure_type');
            $save['expect_amount']        = $this->input->post('expectAmount');
            $save['owner_description']    = $this->input->post('description');
			$save['owner_realtion_unitid']= $unitid;
			$save['request_status']             = lang('pending');
            $save['owner_id']             = $Owner['owner_id'];
            if ($id) {
                $save['id'] = $id;
            }
            $this->Myunits_model->unit_request_save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('owner/Myunits/unit_request_list');
        }
    }
	public function unit_maintenance_request_form($type,$unitid,$id = false){
        $data['page_title'] = lang('unit_request_form');
        $Owner = $this->session->userdata('owner');
        if (!empty($id)) {
			$request = $this->db->get_where('owner_unit_request', array('id' => $id))->row();
        }
        $data['unitid']         = $unitid;
        $data['requesttypid']   = $type;
		$data['reqequestunit']  = $this->Myunits_model->get_ownerunit($unitid);
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
            $this->render_owner('myunits/Unit_maintenance_RequestForm', $data);
        } else {
			$save['title']                = $this->input->post('title');
			$save['request_type']         = $type;
            $save['requesteddate']        = $this->input->post('date');
            $save['tenure']               = $this->input->post('tenure');
            $save['tenure_type']          = $this->input->post('tenure_type');
            $save['expect_amount']        = $this->input->post('expectAmount');
            $save['owner_description']    = $this->input->post('description');
			$save['owner_realtion_unitid']= $unitid;
            $save['owner_id']             = $Owner['owner_id'];
			$save['request_status']             = lang('pending');
            if ($id) {
                $save['id'] = $id;
            }
            $this->Myunits_model->unit_request_save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('owner/Myunits/unit_request_list');
        }
    }
public function unit_sale_request_form($type,$unitid,$id = false){
        $data['page_title'] = lang('unit_request_form');
        $Owner = $this->session->userdata('owner');
        if (!empty($id)) {
			$request = $this->db->get_where('owner_unit_request', array('id' => $id))->row();
        }
        $data['unitid']          = $unitid;
        $data['requesttypid']    = $type;
		$data['reqequestunit']   = $this->Myunits_model->get_ownerunit($unitid);
        $data['requesttype']     = $this->db->get_where('owner_unit_requesttype',array("id"=>$type))->row()->name;
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
        //$this->form_validation->set_rules('tenure', 'lang:tenure', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->render_owner('myunits/Unit_Sales_RequestForm', $data);
        } else {
			$save['title']                = $this->input->post('title');
			$save['request_type']         = $type;
            $save['requesteddate']        = $this->input->post('date');
            $save['tenure']               = $this->input->post('tenure');
            $save['tenure_type']          = $this->input->post('tenure_type');
            $save['expect_amount']        = $this->input->post('expectAmount');
            $save['owner_description']    = $this->input->post('description');
			$save['owner_realtion_unitid']= $unitid;
            $save['owner_id']             = $Owner['owner_id'];
			$save['request_status']        = lang('pending');
            if ($id) {
                $save['id'] = $id;
            }
            $this->Myunits_model->unit_request_save($save);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('owner/Myunits/unit_request_list');
        }
    }
  function request_acceptByOwner($id){
	  $request=$this->db->get_where("owner_unit_request",array("id"=>$id))->row();
	  $this->db->where("id",$id);
	  if($this->db->update("owner_unit_request",array("is_read_owner"=>1,"owner_approved"=>1,"is_read_pmc"=>2))){
		    $request_url=$this->db->get_where("owner_unit_requesttype",array("id"=>$request->request_type))->row();
		    $this->session->set_flashdata('message', lang('request_updated'));
		    redirect('owner/Myunits/'.$request_url->view_link.'/'.$id);
	  }
  }
  function request_rejectByOwner($id){
	    $request=$this->db->get_where("owner_unit_request",array("id"=>$id))->row();
	    $this->db->where("id",$id);
	    $Owner = $this->session->userdata('owner');
	    if($this->db->update("owner_unit_request",array("is_read_owner"=>1,"owner_approved"=>1,"is_closed_by"=>'Owner',"is_closed"=>1,"request_status"=>lang('closed')))){
		    $request_url=$this->db->get_where("owner_unit_requesttype",array("id"=>$request->request_type))->row();
		    $this->session->set_flashdata('message', lang('request_updated'));
		    redirect('owner/Myunits/'.$request_url->view_link.'/'.$id);
	  }
  }
    public function unit_selfLease_request_enquiry(){
		
	   $this->Myunits_model->unit_selfLease_request_enquiry_save($_POST);
            if ($id) {
                $this->session->set_flashdata('message', lang('request_updated'));
            } else {
                $this->session->set_flashdata('message', lang('request_saved'));
            }
            redirect('owner/Myunits/unit_request_list');
	}
}
