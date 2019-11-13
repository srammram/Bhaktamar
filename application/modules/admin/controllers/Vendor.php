<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendor extends Admin_Controller {
	function __construct(){		
		parent::__construct();
        $this->load->model(array('Vendor_model'));
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('download');
	}
    function service_provider()  {
	    $data['page_title']='service_provider_list';
	    $this->render_admin('vendor/services_provider', $data);		
     }
   function getService_provider(){   
    $actions = "<div class=\"text-center\">";
    $actions .= "<a href='" . base_url('admin/vendor/service_provider_view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/vendor/serviceProvider_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/vendor/serviceProvider_Delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
    $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("service_provider_id,sp_name,sp_contract_date,sp_contact_number,sp_email,sp_address", FALSE)
            ->from("ven_services_provider")
			->where("soft_delete",0)
			//->order_by("service_provider_id", "ASC")
            ->add_column("Actions", $actions, "service_provider_id");
	        echo $this->datatables->generate();
    }
     function serviceProvider_form($id = false){
		$data['page_title']		           = lang('add_services_provider');
		$data['sp_name']		           = '';
		$data['sp_address']			       = '';
		$data['sp_contact_number']         = '';
		$data['sp_email']			       = '';
		$data['sp_contract_date']	       = '';
		$data['service_provider_id']	   = '';
		if ($id){	
            $data['page_title']		            = lang('edit_services_provider');
            $data['service_provider']			=	$service_provider		= $this->Vendor_model->get_services_provider($id);
			if (!$service_provider){
				$this->session->set_flashdata('error', lang('service_provider_not_found'));
				redirect('admin/vendor/service_provider');
            }       
			$data['service_provider_id']	= $service_provider->service_provider_id;
			$data['sp_name']		        = $service_provider->sp_name;
	    	$data['sp_address']			    = $service_provider->sp_address;
	    	$data['sp_contact_number']      = $service_provider->sp_contact_number;
	    	$data['sp_email']			    = $service_provider->sp_email;
	    	$data['sp_contract_date']	    = $service_provider->sp_contract_date;
		 }
		$this->form_validation->set_rules('providername', 'lang:service_provider_name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('vendor/services_provider_form', $data);		
		}
		else{
			 $save['service_provider_id']		= $id;
			 $save['sp_name']			        = $this->input->post('providername');
			 $save['sp_address']			    = $this->input->post('address');
			 $save['sp_contact_number']			= $this->input->post('contact_number');
		   	 $save['sp_email']	                = $this->input->post('email');
			 $save['sp_contract_date']	        = $this->input->post('contractdate');
	     	 $this->Vendor_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('service_provider_updated'));
			}else{
				$this->session->set_flashdata('message', lang('service_provider_Saved'));
			}
			redirect('admin/vendor/service_provider'); 
		}
     }
     function service_provider_view($id = false){
        if ($id){	
            $data['service_provider']	=	$service_provider = $this->Vendor_model->get_services_provider($id);
            $data['page_title']	        =	lang('View_services_provider');
			if (!$service_provider){
				$this->session->set_flashdata('error', lang('service_provider_not_found'));
				redirect('admin/vendor/service_provider');
            }  
            $this->render_admin('vendor/view_service_provider', $data);	
        }else{
            $this->session->set_flashdata('error', lang('service_provider_not_found'));
            redirect('admin/vendor/service_provider');
        }
     }
     function serviceProvider_Delete($id){
        if ($id){	
            $service_provider		= $this->Vendor_model->get_services_provider($id);
          if (!$service_provider){
                $this->session->set_flashdata('error', lang('service_provider_not_found'));
                redirect('admin/vendor/service_provider');
            }else{
                $delete	= $this->Vendor_model->servicesProvider_delete($id);
                $this->session->set_flashdata('message', lang('service_provider_deleted'));
                redirect('admin/vendor/service_provider');
            }
        }else{
                $this->session->set_flashdata('error', lang('service_provider_not_found'));
                redirect('admin/vendor/service_provider');
        }
     }
     function services()  {
	    $data['page_title']='services';
	    $this->render_admin('vendor/services', $data);		
     }
     function get_services(){   
        $actions = "<div class=\"text-center\">";
        $actions .= "<a href='" . base_url('admin/vendor/servicesview/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/vendor/service_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/vendor/serviceDelete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
        $actions .= "</div>";
        $this->load->library('datatables');
        $this->datatables
        ->select("services_id,services_name,services_period,sp_name,Name,contract_status", FALSE)
        ->from("ven_services vs")
        ->where("vs.soft_delete",0)
        ->join("ven_services_provider vsp", "vsp.service_provider_id =vs.services_provider_id", 'left')
        ->join("project p", "p.id = vs.project_id", 'left')
        ->add_column("Actions", $actions, "services_id");
        echo $this->datatables->generate();
}
function service_form($id = false){
    $data['page_title']		           = lang('add_services_form');
    $data['project']		           =$this->Vendor_model->getProject();
    $data['service_provider']		   =$this->Vendor_model->getServicesProvider();
    $data['services_id']	           = '';
    $data['services_name']		       = '';
    $data['services_period']	       = '';
    $data['contract_status']           = '';
    $data['contract_start_date']       = '';
    $data['contract_end_date']	       = '';
    $data['services_provider_id']	   = '';
    $data['contact_person']	           = '';
    $data['mobilenumber']	           = '';
    $data['email']	                   = '';
    $data['address']	               = '';
    $data['attachment_path']	       = '';
    $data['other_docpath']	           = '';
    $data['project_id']	               = '';
    if ($id){	
        $data['page_title']		        = lang('edit_services_form');
        $data['service']	            =	$service		= $this->Vendor_model->get_services($id);
        if (!$service){
            $this->session->set_flashdata('error', lang('Services_not_found'));
            redirect('admin/vendor/services');
        }       
        $data['services_id']	        = $service->services_id;
        $data['services_name']		    = $service->services_name;
        $data['services_period']	    = $service->services_period;
        $data['contract_status']        = $service->contract_status;
        $data['servicestype']           = $service->service_type;
        $data['contract_start_date']    = $service->contract_start_date;
        $data['contract_end_date']	    = $service->contract_end_date;
        $data['services_provider_id']	= $service->services_provider_id;
        $data['contact_person']	        = $service->contact_person;
        $data['Contact_number']	        = $service->Contact_number;
        $data['email']	                = $service->email;
        $data['address']	            = $service->address;
        $data['attachment_path']	    = $service->attachment_path;
        $data['other_docpath']	        = json_decode($service->other_docpath);
        $data['project_id']	            = $service->project_id;
     }
    $this->form_validation->set_rules('servicename', 'lang:service_name', 'trim|required');
    if ($this->form_validation->run() == FALSE){
        $this->render_admin('vendor/services_form', $data);		
    }
    else{
        if (!empty($_FILES['attachment']['name'])) {
            $config['upload_path'] = 'uploads/vendor/';
            $config['allowed_types'] = '*';
            $config['file_name'] = $_FILES['attachment']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('attachment')) {
                $uploadData = $this->upload->data();
                $attachment = str_replace(' ', '_',$uploadData['file_name']) ;
            } 
            $save['attachment_path']	    =!empty($attachment)?$attachment:NULL;
        }
        foreach ($_FILES['doc']['name'] as $key => $image) {
            $config['upload_path'] = 'uploads/vendor/others';
            $config['allowed_types'] = '*';
            $_FILES['file']['name']= $_FILES['doc']['name'][$key];
            $_FILES['file']['type']= $_FILES['doc']['type'][$key];
            $_FILES['file']['tmp_name']= $_FILES['doc']['tmp_name'][$key];
            $_FILES['file']['error']= $_FILES['doc']['error'][$key];
            $_FILES['file']['size']= $_FILES['doc']['size'][$key];
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
          foreach(json_decode($service->other_docpath) as $path){
            $otherdoc[]=$path;
          }
            $save['other_docpath']	        =!empty($otherdoc)? json_encode($otherdoc):NULL;
        }
        $save['services_id']	        =$this->input->post('services_id');
        $save['services_name']		    =$this->input->post('servicename');
        $save['services_period']	    =$this->input->post('servicesperiod');
        $save['service_type']	        =$this->input->post('servicestype');
        $save['contract_status']        =$this->input->post('contract_status');
        $save['contract_start_date']    =$this->input->post('startdate');
        $save['contract_end_date']	    =$this->input->post('enddate');
        $save['services_provider_id']	=$this->input->post('serviceprovider');
        $save['contact_person']	        =$this->input->post('contact_person');
        $save['Contact_number']	        =$this->input->post('Contact_number');
        $save['email']	                =$this->input->post('email');
        $save['address']	            =$this->input->post('address');
        $save['project_id']	            =$this->input->post('projectname');
        $this->Vendor_model->service_save($save);
        if($id){
            $this->session->set_flashdata('message', lang('Services_updated'));
        }else{
            $this->session->set_flashdata('message', lang('services_saved'));
        }
        redirect('admin/vendor/services'); 
    }
 }
 function  servicesview($id = false){
    $data['page_title']		        = lang('Services_View');
    $data['service']	            =	$service		= $this->Vendor_model->get_services($id);
    $data['services_id']	        = $service->services_id;
    $data['services_name']		    = $service->services_name;
    $data['services_period']	    = $service->services_period;
    $data['contract_status']        = $service->contract_status;
    $data['servicestype']           = $service->service_type;
    $data['contract_start_date']    = $service->contract_start_date;
    $data['contract_end_date']	    = $service->contract_end_date;
    $data['services_provider_id']	= $service->services_provider_id;
    $data['contact_person']	        = $service->contact_person;
    $data['Contact_number']	        = $service->Contact_number;
    $data['email']	                = $service->email;
    $data['address']	            = $service->address;
    $data['attachment_path']	    = $service->attachment_path;
    $data['other_docpath']	        = json_decode($service->other_docpath);
    $data['project_id']	            = $service->project_id;
    $data['project']		           =$this->Vendor_model->getProject();
    $data['service_provider']		   =$this->Vendor_model->getServicesProvider();
    $this->render_admin('vendor/view_services', $data);	
 }
 function serviceDelete($id){
    if ($id){	
        $service		= $this->Vendor_model->get_services($id);
      if (!$service){
            $this->session->set_flashdata('error', lang('Services_not_found'));
            redirect('admin/vendor/services');
        }else{
            $delete	= $this->Vendor_model->services_delete($id);
            $this->session->set_flashdata('message', lang('Services_deleted_successfully'));
            redirect('admin/vendor/services');
        }
    }else{
            $this->session->set_flashdata('error', lang('Services_not_found'));
            redirect('admin/vendor/services');
    }
 }
 function download_Attachment($id = null)  {
        $servicesattachment = $this->Vendor_model->get_services($id);
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
         $servicesattachment = $this->Vendor_model->get_services($id);
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



 function pmc()  {
	    $data['page_title']='Project Management Consultant';
	    $this->render_admin('vendor/pmc', $data);		
     }
   function get_pmc(){   
    $actions = "<div class=\"text-center\">";
    $actions .= "<a href='" . base_url('admin/vendor/pmc_view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('/admin/vendor/pmc_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/vendor/pmc_delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
    $actions .= "</div>";
            $this->load->library('datatables');
            $this->datatables
            ->select("pmc_id,NAME,contract_date,contact_number,email,address", FALSE)
            ->from("pmc")
			->where("soft_delete",0)
			//->order_by("service_provider_id", "ASC")
            ->add_column("Actions", $actions, "pmc_id");
	        echo $this->datatables->generate();
    }
     function pmc_form($id = false){
		$data['page_title']		           = 'Add PMC';
		$data['name']		               = '';
		$data['address']			       = '';
		$data['contcat_number']            = '';
		$data['email']			           = '';
		$data['contract_date']	           = '';
		$data['id']	     				   = '';
		if ($id){	
            $data['page_title']		            = 'Edit PMC';
            $data['pmc']			         =	$pmc		= $this->Vendor_model->get_pmcByid($id);
			if (!$pmc){
				$this->session->set_flashdata('error', 'PMC Not Found');
				redirect('admin/vendor/pmc');
            }       
			$data['id']	                = $pmc->pmc_id;
			$data['name']		        = $pmc->name;
	    	$data['address']		    = $pmc->address;
	    	$data['contcat_number']     = $pmc->contact_number;
	    	$data['email']			    = $pmc->email;
	    	$data['contract_date']	    = $pmc->contract_date;
		 }
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('vendor/pmc_form', $data);		
		}
		else{
			 $save['pmc_id']		        = $id;
			 $save['name']			        = $this->input->post('name');
			 $save['address']			    = $this->input->post('address');
			 $save['contact_number']	    = $this->input->post('contact_number');
		   	 $save['email']	                = $this->input->post('email');
			 $save['contract_date']	        = $this->input->post('contractdate');
	     	 $this->Vendor_model->save_pmc($save);
			if($id){
				$this->session->set_flashdata('message', 'PMC Updated');
			}else{
				$this->session->set_flashdata('message','PMC Saved');
			}
			redirect('admin/vendor/pmc'); 
		}
     }
     function pmc_view($id = false){
        if ($id){	
            $data['pmc']	=	$pmc = $this->Vendor_model->get_pmcByid($id);
            $data['page_title']	        =	'View PMC';
			if (!$pmc){
				$this->session->set_flashdata('error', 'PMC Not Found');
				redirect('admin/vendor/pmc');
            }  
            $this->render_admin('vendor/view_pmc', $data);	
        }else{
            $this->session->set_flashdata('error', 'PMC Not Found');
            redirect('admin/vendor/pmc');
        }
     }
     function pmc_delete($id){
        if ($id){	
            $pmc		= $this->Vendor_model->get_services_provider($id);
          if (!$pmc){
                $this->session->set_flashdata('error', 'PMC Not Found');
                redirect('admin/vendor/pmc');
            }else{
                $delete	= $this->Vendor_model->pmc_delete($id);
                $this->session->set_flashdata('message','PMC Deleted');
                redirect('admin/vendor/pmc');
            }
        }else{
                $this->session->set_flashdata('error', 'PMC Not Found');
                redirect('admin/vendor/pmc');
        }
     }
}