<?php

class Facility extends Admin_Controller {

	function __construct()
	{		
		parent::__construct();
		$this->load->model(array('Facility_model'));
		   $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('download');
	}
	
	function index()
	{
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Facility');
		$data['Facility']	= $this->Facility_model->get_all();
		$this->render_admin('Facility/list', $data);		
	}
	function get_facility(){
		$actions = "<div class=\"text-center\">";
		$actions .= "<a href='" . base_url('admin/Facility/view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/Facility/form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Facility/delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
		$actions .= "</div>";
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("Fac_id,Facility_name , Charges  , Charges_per,  Status ,  Booking_status
		  ", FALSE)
		   ->from("facility")
		   ->where("facility.soft_delete",0)
		   ->add_column("Actions", $actions, "Fac_id");
		echo $this->datatables->generate();
   }
	function view($id,$tab=false){
		$admin = $this->session->userdata('admin');
		$data['Facility']			=	$Facility		= $this->Facility_model->get($id);
		$data['page_title']	= lang('view')." ".lang('Facility') ;
		$this->render_admin('Facility/view', $data);
	}              
	function form($id = false)
	{
		$admin = $this->session->userdata('admin');
		$this->load->helper('form');
		$this->load->library('form_validation');
	    $data['Owners']	= $this->Facility_model->Get_owner($id);
		$data['service_provider']	= $this->Facility_model->get_services_provider($id);
		$data['page_title']		= lang('Add_Facility');
		$data['id']					    = '';
		$data['Facility_name']		    = '';
		$data['Charges']				= '';
		$data['Charges_per']			= '';
		$data['Booking_status']		    = '';
		$data['Contact']		        = '';
		$data['Comments']		        = '';
		$data['maintenance_by']		    = '';
		$data['mananged_by']		    = '';
		if ($id)
		{	
			$data['Facility']			=	$Facility		= $this->Facility_model->get($id);
			

			if (!$Facility)
			{
				$this->session->set_flashdata('error', lang('Compaint_Not_found'));
				redirect('admin/Facility');
			}
			$data['Fac_id']		        = $Facility->Fac_id;
			$data['Facility_name']	    = $Facility->Facility_name;
			$data['Charges']			= $Facility->Charges;
			$data['Charges_per']		= $Facility->Charges_per;
			$data['Status']		        = $Facility->Status;
			$data['Booking_status']	    = $Facility->Booking_status;
			$data['Contact']	        = $Facility->Contact;
		    $data['Comments']	        = $Facility->Comments;
			$data['maintenance_by']		= $Facility->maintenance_by;
			$data['mananged_by']		= $Facility->mananged_by;
		}
		$this->form_validation->set_rules('Facility_name', 'lang:Facility_name', 'trim|required');
		$this->form_validation->set_rules('Charge', 'lang:Charges', 'trim|required');
		$this->form_validation->set_rules('Per', 'lang:Charges_per', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->render_admin('Facility/form', $data);		
		}
		else
		{
			$ids	                = $this->input->post('ids');
			$save['Facility_name']	= $this->input->post('Facility_name');
			$save['Charges']	    = $this->input->post('Charge');
			$save['Charges_per']	= $this->input->post('Per');
			$save['Status']	        = $this->input->post('Status');
			$save['Booking_status']	= $this->input->post('Booking_status');
			$save['Contact']	    = $this->input->post('Contact');
			$save['Comments']	    = $this->input->post('Comments');
			$save['maintenance_by']	= $this->input->post('maintenance_by');
			$save['mananged_by']	= $this->input->post('mananged_by');
			$this->Facility_model->save($save,$ids);
			if($id){
				$this->session->set_flashdata('message', lang('Facility_Updated'));
			}else{
				$this->session->set_flashdata('message', lang('Facility_save'));
			}
			redirect('admin/Facility');
		}
	}
	
	function delete($id = false){
		if ($id){	
			$Faclity	= $this->Facility_model->get($id);
			if (!$Faclity){
				$this->session->set_flashdata('error', lang('Facility_not_found'));
				redirect('admin/Facility');
			}else{
				$delete	= $this->Facility_model->delete($id);
				$this->session->set_flashdata('message', lang('Facility_Deleted'));
				redirect('admin/Facility');
			}
		}
		else{
			    $this->session->set_flashdata('error', lang('Facility_not_found'));
				redirect('admin/Facility');
		}
	}
   function utility_services()  {
	    $data['page_title']=lang('utility_services');
	    $this->render_admin('Facility/utility_services', $data);		
     }
     function get_services(){   
        $actions = "<div class=\"text-center\">";
        $actions .= "<a href='" . base_url('admin/Facility/servicesview/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/Facility/utility_service_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/Facility/serviceDelete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
        $actions .= "</div>";
        $this->load->library('datatables');
        $this->datatables
        ->select("id,Service_name,Mobile_number,Contact_person_name,SeviceType,Services_duration  ", FALSE)
        ->from("services vs")
        ->where("vs.Soft_delete",0)
    //    ->join("ven_services_provider vsp", "vsp.service_provider_id =vs.services_provider_id", 'left')
      //  ->join("project p", "p.id = vs.project_id", 'left')
        ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
}
function utility_service_form($id = false){
    $data['page_title']		           = lang('add_services_form');
	$data['services_id']	           = '';
    $data['servicename']		       = '';  
    $data['period']	                   = ''; 
    $data['servicestype']	           = '';
    $data['contact_person']	           = '';
    $data['Contact_number']	           = '';
    if ($id){	
        $data['page_title']		        = lang('edit_services_form');
        $data['service']	            =	$service		= $this->Facility_model->get_services($id);
        if (!$service){
            $this->session->set_flashdata('error', lang('Services_not_found'));
            redirect('admin/vendor/utility_services');
        }       
        $data['services_id']	        = $service->id;
        $data['servicename']		    = $service->Service_name;
        $data['period']	                = $service->Services_duration;
        $data['servicestype']           = $service->SeviceType;
        $data['contact_person']         = $service->Contact_person_name;
        $data['Contact_number']         = $service->Contact_number;
     }
    $this->form_validation->set_rules('servicename', 'lang:service_name', 'trim|required');
    if ($this->form_validation->run() == FALSE){
        $this->render_admin('Facility/utility_services_form', $data);		
    }
    else{
        $save['id']	                    =$this->input->post('services_id');
        $save['Service_name']		    =$this->input->post('servicename');
        $save['Services_duration']	    =$this->input->post('period');
        $save['SeviceType']	            =$this->input->post('servicestype');
        $save['Contact_person_name']    =$this->input->post('contact_person');
        $save['Contact_number']         =$this->input->post('Contact_number');
        $this->Facility_model->service_save($save);
        if($id){
            $this->session->set_flashdata('message', lang('Services_updated'));
        }else{
            $this->session->set_flashdata('message', lang('services_saved'));
        }
        redirect('admin/Facility/utility_services'); 
    }
 }
 function  servicesview($id = false){
    $data['page_title']		        = lang('utility_services');
    $data['service']	            =	$service		= $this->Facility_model->get_services($id);
    $this->render_admin('Facility/view_services', $data);	
 }
 function serviceDelete($id){
    if ($id){	
        $service		= $this->Facility_model->get_services($id);
      if (!$service){
            $this->session->set_flashdata('error', lang('Services_not_found'));
            redirect('admin/Facility/utility_services');
        }else{
            $delete	= $this->Facility_model->services_delete($id);
            $this->session->set_flashdata('message', lang('Services_deleted_successfully'));
            redirect('admin/Facility/utility_services');
        }
    }else{
            $this->session->set_flashdata('error', lang('Services_not_found'));
            redirect('admin/Facility/utility_services');
    }
 }
 function download_Attachment($id = null)  {
        $servicesattachment = $this->Facility_model->get_services($id);
        $Attachment = $servicesattachment->attachment_path;
        $file = base_url().'uploads/vendor/'.$Attachment;
        $data =  file_get_contents($file);
        force_download($servicesattachment->attachment_path, $data);
    }
  function download_otherdoc($name){
    $file = base_url().'uploads/vendor/others/'.$name;
    $data =  file_get_contents($file);
    force_download($servicesattachment->attachment_path, $data);
  }
  function doc_delete(){
         $doc= $this->input->post('doc'); 
         $id=$this->input->post('service_id');
         $servicesattachment = $this->Facility_model->get_services($id);
         $otherdoc=json_decode(($servicesattachment->other_docpath));
         if (($key = array_search($doc, $otherdoc)) !== false) {
            unset($otherdoc[$key]);
           $this->db->where('services_id',$id);
           $this->db->update('ven_services',array('other_docpath'=>json_encode($otherdoc)));
           echo $this->db->last_query();
           if(file_exists(BASEPATH.'../uploads/vendor/others/'.$doc)){
                    unlink(BASEPATH.'../uploads/vendor/others/'.$doc);
            } 
  }
  return true;
}

}