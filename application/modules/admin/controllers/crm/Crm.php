<?php
class Crm extends Admin_Controller {
	function __construct()
	{		
		parent::__construct();
		$this->load->model(array('crm/Crm_model'));
		$this->load->library("pagination");
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->library('form_validation');
			$this->load->library('datatables');
	}
	
	 function  Dashboard()
	 {
		 $admin = $this->session->userdata('admin');
		 $data['page_title']	= lang('Dashboard');
		 $config 			   = array();
         $config["base_url"]   = base_url() . "admin/crm/Crm/Dashboard";
         $config["total_rows"] = $this->Crm_model->enquirycount();
         $data["total_enquiry"] = $this->Crm_model->enquirycount();
         $data["total_visitor"] = $this->Crm_model->visitorcount();
         $data["followup_visitor"] = $this->Crm_model->followupcount();
         $config["per_page"]   = 10;
         $config["uri_segment"]= 2;
         $this->pagination->initialize($config);
         $page                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
         // $data['enquiry']      = $this->Crm_model->get_all_Enquiry($config["per_page"], $page);
         $data["links"]        = $this->pagination->create_links();
		 $this->render_admin('_crm/dashboard', $data);
		 
	 }
 function   Enquiry_trash(){
		 $admin = $this->session->userdata('admin');
		 $data['page_title']	= lang('enquiry_trash');
		 $this->render_admin('_crm/EnquiryTrashlist', $data);
	 }
	 function get_enquirys_trash(){
		  $actions = "<div class=\"text-center\">";
          $actions .= "<a href='" . base_url('admin/crm/Crm/EnquiryView/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/crm/Crm/Enquiryform/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/crm/Crm/Enquirydelete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
          $actions .= "</div>";
          $this->datatables
		  ->select("enquiry_id ,Customer_name,enquiry_date,project.Name,crm_enquiry.contact_number
		   ", FALSE)
		  ->from("crm_enquiry")
	      ->join('project','project.id=crm_enquiry.projectid','left')
	      ->join('add_unit','add_unit.uid=crm_enquiry.unitid and add_unit.Project_id=crm_enquiry.projectid','left')
	      ->join('countries','countries.id=crm_enquiry.country','left')
		  ->join('projecttypes','projecttypes.id=crm_enquiry.type_for','left')
		  ->join('soe','soe.id=crm_enquiry.source_of_enquiry','left')
		  ->where('crm_enquiry.soft_delete',0)
		   ->where('crm_enquiry.enquiry_status',2)
          ->add_column("Actions", $actions, "enquiry_id");
	     echo   $this->datatables->generate();
	}
	 function   Enquiry(){
		 $admin = $this->session->userdata('admin');
		 $data['page_title']	= lang('Enquiry');
		 $config 			   = array();
         $config["base_url"]   = base_url() . "admin/crm/Crm/Enquiry";
         $config["total_rows"] = $this->Crm_model->enquirycount();
         $config["per_page"]   = 10;
         $config["uri_segment"]= 2;
         $this->pagination->initialize($config);
         $page                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        // $data['enquiry']      = $this->Crm_model->get_all_Enquiry($config["per_page"], $page);
		  $data['enquiry']      = $this->Crm_model->get_all_Enquiry();
         $data["links"]        = $this->pagination->create_links();
		 $this->render_admin('_crm/Enquirylist', $data);
		 
	 }
	  function get_enquirys(){
		  $actions = "<div class=\"text-center\">";
          $actions .= "<a href='" . base_url('admin/crm/Crm/EnquiryView/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/crm/Crm/Enquiryform/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/crm/Crm/Enquirydelete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
          $actions .= "</div>";
          $this->datatables
		  ->select("enquiry_id ,Customer_name,enquiry_date,project.Name,soe.Name as soe,crm_enquiry.contact_number
		   ", FALSE)
		  ->from("crm_enquiry")
	      ->join('project','project.id=crm_enquiry.projectid','left')
	      ->join('add_unit','add_unit.uid=crm_enquiry.unitid and add_unit.Project_id=crm_enquiry.projectid','left')
	      ->join('countries','countries.id=crm_enquiry.country','left')
		  ->join('projecttypes','projecttypes.id=crm_enquiry.type_for','left')
		  ->join('soe','soe.id=crm_enquiry.source_of_enquiry','left')
		  ->where('crm_enquiry.soft_delete',0)
          ->add_column("Actions", $actions, "enquiry_id");
	      echo $this->datatables->generate();
	}
	function EnquiryView($id,$tab=false)
	 {
		$data['page_title']	= lang('Enquiry')." ".lang('view') ;
		$data['enquiry']	= $enquiry = $this->Crm_model->getEnquiryView($id);
		$data['unitslists']					 = $this->Crm_model->getUnits($enquiry->projectid);
		$data['salespersons']				 = $this->Crm_model->getSalesPerson($enquiry->SalesPersontype);
		$data['Amenities']		    	= $this->Crm_model->getAmenities();
		$data['soe']		        	= $this->Crm_model->getsoe();
		$data['currency']               =  $this->Crm_model->getCurrency();
		$this->render_admin('_crm/EnquiryView', $data);
	 }
	 function Enquiryform($id = false){
		$data['page_title']         	= lang('Enquiry_form');
		$data['type']			         = $this->Crm_model->get_type();
		$data['projects']		    	= $this->Crm_model->getProject();
		$data['Amenities']		    	= $this->Crm_model->getAmenities();
		$data['countries']		        = $this->Crm_model->getCountries();
		$data['agents']		        	= $this->Crm_model->getEmployees();
		$data['soe']		        	= $this->Crm_model->getsoe();
		$data['customer_name']			= '';
		$data['ptype']	                = '';
		$data['project_id']			    = '';
		$data['unit']			        = '';
		$data['enquiry_id']				= '';
		$data['enquiry_date']		    = '';
		$data['Budget']	                = '';
		$data['occupation']	            = '';
		$data['suggest_modification']	= '';
	//	$data['source_of_enquiry']		= '';
		$data['location_preference']	= '';
		$data['dob']		            = '';
		$data['dob2']		            = '';
		$data['address']		        = '';
		$data['contact_number']	        = '';
	//	$data['pincode']			    = '';
		$data['city']					= '';
		//$data['state']					= '';
		$data['email']					= '';
		$data['country_id']				= '';
		$data['Agent_id']				= '';
		$data['status']					= '';
		$data['doc']					= '';
		$data['SalesPersontype']		= '';
		$data['customername2']			= '';
		$data['customeraddress2']		= '';
		$data['NationalId']				= '';
		$data['NationalId2']		    = '';
		$data['is_display1']			= '';
		$data['is_display2']		    = '';
		$data['remarks']		        = '';
		if ($id)
		{	
			$data['enquiry']			=	$enquiry		= $this->Crm_model->getEnquiry($id);
			if (!$enquiry)
			{
				$this->session->set_flashdata('error', lang('EnquiryNotFound'));
				redirect('admin/crm/Crm/Enquiry');
			}
		$data['unitslists']					 = $this->Crm_model->getUnits($enquiry->projectid);
		$data['salespersons']				 = $this->Crm_model->getSalesPerson($enquiry->SalesPersontype);
		$data['enquiry_id']					 = $enquiry->enquiry_id;
		$data['enquiry_date']		         = $enquiry->enquiry_date;
		$data['project_id']			         = $enquiry->projectid;
		$data['unit']			             = $enquiry->unitid;
		$data['customer_name']			     = $enquiry->Customer_name;
		$data['Budget']	    				 = $enquiry->Budget;
		$data['ptype']		                 = json_decode($enquiry->type_for);
		$data['suggest_modification']		 = json_decode($enquiry->suggest_modification);
		$data['occupation']		             = $enquiry->occupation;
	//	$data['source_of_enquiry']		     = $enquiry->source_of_enquiry;
		$data['location_preference']		 = $enquiry->location_preference ;
		$data['dob']		                 = $enquiry->dob;
		$data['dob2']		                 = $enquiry->dob2;
		$data['address']	                 = $enquiry->address;
		$data['contact_number']	             = $enquiry->contact_number;
		//$data['pincode']	                 = $enquiry->pincode;
		$data['city']                        = $enquiry->city ;
	//	$data['state']                       = $enquiry->state;
		$data['email']                       = $enquiry->email;
		$data['country_id']                  = $enquiry->country;
		$data['Agent_id']	                 = $enquiry->agentid;
		$data['enquiry_status']              = $enquiry->enquiry_status;
	    $data['SalesPersontype']		     = $enquiry->SalesPersontype;
		$data['customername2']               = $enquiry->customername2;
		$data['customeraddress2']		     = $enquiry->customeraddress2;
		$data['NationalId']		             = $enquiry->nationalid;
		$data['NationalId2']		         = $enquiry->nationalid2;
		//$data['is_display1']			    = $enquiry->displayname1;
		$data['remarks']		            = $enquiry->remarks;
		$data['Agreement_location']		    = $enquiry->document_path;
		}
		$this->form_validation->set_rules('Customername', 'lang:Customer_name', 'trim|required');
		$this->form_validation->set_rules('project', 'lang:Project', 'trim|required');
		$this->form_validation->set_rules('Enquiry_date', 'lang:Enquiry_date', 'trim|required');
	//	$this->form_validation->set_rules('sourceofenquiry', 'lang:Source_of_enquiry', 'trim|required');
		//$this->form_validation->set_rules('dob', 'lang:DOB', 'trim|required');
		//$this->form_validation->set_rules('address1', 'lang:address', 'trim|required');
		$this->form_validation->set_rules('contactnumber', 'lang:Contact_number', 'trim|required');
		//$this->form_validation->set_rules('email', 'lang:email', 'trim|required');
		$this->form_validation->set_rules('country', 'lang:select_country', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('_crm/EnquiryForm', $data);		
		}
		
		else{
	
			$Doc = '';
			 if(!empty($_FILES['doc']['name'])){
                $config['upload_path'] = 'uploads/enquiry/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['doc']['name'];
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('doc')){
                    $uploadData = $this->upload->data();
                    $Doc = $uploadData['file_name'];
                }else{
                    $Doc = '';
                }
			 }
			 if(!empty($Doc))
			 {
		 		 $save['document_path']		        =$Doc;
			 }
			$save['enquiry_id']                     =$this->input->post('enquiry_id');
			$save['enquiry_date']			        = $this->input->post('Enquiry_date');
			$save['customer_name']		         	= $this->input->post('Customername');
		    $save['Budget']			                = $this->input->post('Budget');
			$save['type_for']			            = json_encode($this->input->post('pertypes'));
			$save['suggest_modification']			=json_encode( $this->input->post('suggestsmodification'));
			$save['occupation']			            = $this->input->post('occupation');
		//	$save['source_of_enquiry']			    = $this->input->post('sourceofenquiry');
			$save['location_preference']			= $this->input->post('locationpreference');
			$save['dob']		                    = $this->input->post('dob');
			$save['dob2']		                    = $this->input->post('dob2');
			$save['address']		                = $this->input->post('address1');
			$save['contact_number']			        = $this->input->post('contactnumber');
		//	$save['pincode']			                = $this->input->post('pincode');
			$save['city']			                = $this->input->post('city');
			//$save['state']			                = $this->input->post('state');
			$save['email']			                = $this->input->post('email');
			$save['country']			            = $this->input->post('country');
			$save['enquiry_status']			        = $this->input->post('status');
			$save['projectid']			            = $this->input->post('project');
			$save['unitid']			                = $this->input->post('units');
			$save['agentid']			            = $this->input->post('salesperson');
			$save['SalesPersontype']			    = $this->input->post('salespersontype');
			$save['customeraddress2']			    = $this->input->post('address2');
			$save['customername2']			        = $this->input->post('Customername2');
			$save['nationalid']			            =$this->input->post('NationalId');
			$save['nationalid2']			        =$this->input->post('NationalId2');
			$save['displayname1']			        = $this->input->post('is_display1');
		    $save['dislayname2']		            = $this->input->post('is_display2');
			$save['remarks']		                = $this->input->post('remarks');
		    $this->Crm_model->save($save);
			if($id){
				$this->session->set_flashdata('message', lang('EnquiryUpdated'));
			}else{
				$this->session->set_flashdata('message', lang('EnquirySaved'));
			}
		       redirect('admin/crm/Crm/Enquiry');
		}
	 }
	


	function Enquirydelete($id = false)
	{
		if ($id){	
			$enquiry=$this->Crm_model->getEnquiry($id);
			if (!$enquiry){
				$this->session->set_flashdata('error', lang('EnquiryNotFound'));
				redirect('admin/crm/Crm/Enquiry');
			}else{
				$delete	= $this->Crm_model->enquiryDelete($id);
				$this->session->set_flashdata('message', lang('EnquiryDelete'));
				redirect('admin/crm/Crm/Enquiry');
			}
		}
		else{
			    $this->session->set_flashdata('error', lang('EnquiryNotFound'));
				redirect('admin/crm/Crm/Enquiry');
		}
	}
	function get_agent(){
	$HTML='';
	$salespersontype = $this->input->post('salespersontype');
	switch($salespersontype){
			case lang('Executive'):
			  $query=$this->db->get_where('employee',array('soft_delete'=>0,'termination'=>1));
			  if($query->num_rows()>0){
				  foreach($query->result() as $item){
					$HTML.="<option value='" . $item->id . "'>" . $item->first_name.' '.$item->last_name . "</option>";
				  }
			  }
			break;
			case lang('Agent'):
			$query=$this->db->get_where('sales_agent',array('soft_delete'=>0,'agenttype'=>lang('sales_agent')));
			if($query->num_rows()>0){
				foreach($query->result() as $item){
					$HTML.="<option value='" . $item->agentid . "'>" . $item->name. "</option>";
				}
			}
			break;
			case lang('pmc'):
			$query=$this->db->get_where('pmc',array('soft_delete'=>0));
			if($query->num_rows()>0){
				foreach($query->result() as $item){
					$HTML.="<option value='" . $item->pmc_id . "'>" . $item->name. "</option>";
				}
			}
			break;
     

	}
	echo $HTML;
    }
	
	function get_unit(){
	$HTML='';
    $projectid = $this->input->post('projectid');
		$units=$this->db->get_where('add_unit',array('Project_id'=>$projectid,'Booked_status'=>0))->result();
		
    if ($units) {
        foreach ($units as $unit) {
                $HTML.="<option value='" . $unit->uid . "'>" . $unit->unit_no. "</option>";
            }
        }
        echo $HTML;
	 
    }
	
	
	function followup(){
		
		 $data['page_title']	= lang('FollowUp');
		 $config 			   = array();
         $config["base_url"]   = base_url() . "admin/crm/Crm/followup";
         $config["total_rows"] = $this->Crm_model->followUpcount();
         $config["per_page"]   = 10;
         $config["uri_segment"]= 2;
         $this->pagination->initialize($config);
         $page                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
         $data['enquiry']      = $this->Crm_model->get_all_Followup($config["per_page"], $page);
         $data["links"]        = $this->pagination->create_links();
		 
		$this->render_admin('_crm/Followuplist', $data);
	}
	 function get_followups(){
		  $actions = "<div class=\"text-center\">";
          $actions .= "<a href='" . base_url('admin/crm/Crm/FollowupView/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a>";
          $actions .= "</div>";
          $this->datatables
		  ->select("enquiry_id ,Customer_name,enquiry_date,project.Name,soe.Name as soe,crm_enquiry.contact_number
		   ", FALSE)
		  ->from("crm_enquiry")
	      ->join('project','project.id=crm_enquiry.projectid','left')
	      ->join('add_unit','add_unit.uid=crm_enquiry.unitid and add_unit.Project_id=crm_enquiry.projectid','left')
	      ->join('countries','countries.id=crm_enquiry.country','left')
		  ->join('projecttypes','projecttypes.id=crm_enquiry.type_for','left')
		  ->join('soe','soe.id=crm_enquiry.source_of_enquiry','left')
		  ->where('crm_enquiry.soft_delete',0)
		   ->where('crm_enquiry.enquiry_status',1)
          ->add_column("Actions", $actions, "enquiry_id");
	      echo $this->datatables->generate();
	}
		function FollowupView($id,$tab=false){
		 $data['page_title']	= lang('FollowUp') ;
		 $data['enquiryid']=$id;
	   	 $data['enquiry']	= $enquiry = $this->Crm_model->getEnquiryView($id);
		 $data['type']			         = $this->Crm_model->get_type();
		 $data['salesperson']=$this->Crm_model->getSalesPersonName($enquiry->SalesPersontype,$enquiry->agentid);
		 $data['amenities']=$this->Crm_model->get_amenities($enquiry->suggest_modification);
		 $data['follow_list']   = $this->Crm_model->getFollowupByEnquiry($enquiry->enquiry_id);
		 $this->render_admin('_crm/FollowupView.php', $data);
	 }
	 function addFollowup(){
		 if(isset($_POST)){
			 
 			 $followdate = new DateTime(date('Y-m-d ',strtotime($this->input->post('followdate'))));
	 	     $followdate =$followdate->format('Y-m-d G:i');
			 $nextdate = new DateTime(date('Y-m-d ',strtotime($this->input->post('nextdate'))));
	 	     $nextdate =$nextdate->format('Y-m-d G:i');
		     $save['followup_date_time']			=$followdate;
			 $save['calltype']			    = $this->input->post('calltype');
			 $save['discussion']			    = $this->input->post('discuss');
			 $save['next_followup_date']			    = $nextdate;
			 $save['enquiryid']			    = $this->input->post('Enquiry_id');
			 $id			    = $this->input->post('id');
			 
		     $this->Crm_model->follow_save($save,$id);
	 }else{
		 return false;
	 }
	 }
	 function editFollowup()
	 {
		 $result=$this->db->get_where('crm_followup',array('followupid'=>$this->input->post('followupid')))->row();
		 echo json_encode($result);
	 }
	 function followupDelete($followupid,$id = false){
		if ($id){	
				$delete	= $this->Crm_model->followupDelete($followupid);
				$this->session->set_flashdata('message', lang('Followupdeleted'));
				redirect('admin/crm/Crm/FollowupView/'.$id);
		}else{
			    $this->session->set_flashdata('error', lang('EnquiryNotFound'));
				redirect('admin/crm/Crm/FollowupView/'.$id);
		}
	}
	function addfinalTag(){
		 $enquiryid = $this->input->post('id');
		 $Intial_Amount = $this->input->post('Intial_Amount');
	 	 $paiddate = !empty($this->input->post('paiddate'))?$this->input->post('paiddate') : date('Y-m-d H:i:s');
		 $this->Crm_model->addFinaltag($enquiryid,$Intial_Amount,$paiddate);
		return true;
	}
	function get_clients(){
		  $actions = "<div class=\"text-center\">";
        $actions .= "<a href='" . base_url('admin/crm/Crm/ClientView/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/crm/Crm/ClientForm/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/crm/Crm/Clientdelete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
          $actions .= "</div>";
          $this->datatables
		  ->select("customer_id,customer_name,enquiry_id,email,contact_number,address,occupation
		   ", FALSE)
		  ->from("crm_customer")
		  ->where('crm_customer.soft_delete',0)
          ->add_column("Actions", $actions, "customer_id");
	      echo $this->datatables->generate(); 
	}
	function ClientList(){
		 $data['page_title']	= lang('Customer');
         $data['crm_customer']      = $this->Crm_model->getCustomerlist();
		$this->render_admin('_crm/ClientList', $data);
	}
	function ClientView($id,$tab=false)
	 {
		$data['page_title']	= lang('Client')." ".lang('view') ;
		$data['client']	= $enquiry = $this->Crm_model->getClientView($id);
	    $data['countries']		        = $this->Crm_model->getCountries();
		$this->render_admin('_crm/ClientView', $data);
	 }	
	 function ClientForm($id = false){
		$data['page_title']         	= lang('Client_form');		
		$data['countries']		        = $this->Crm_model->getCountries();
		$data['customer_id']			= $id;
		$data['customer_name']		    = '';
		$data['customername2']			= '';
		$data['dob']	                = '';
		$data['dob2']			        = '';
		$data['address']	    	    = '';
		$data['customeraddress2']		= '';		
		$data['nationalid']		        = '';
		//$data['street']		     			 = $client->street;
		$data['nationalid2']		 	= '';
		$data['contact_number']		    ='';
		$data['email']	                ='';
		$data['country_id']	            ='';
		$data['city']	                ='';
		$data['occupation']             ='';
		$data['contractNumber']         ='';
		$data['enquiry_id']             ='';		
		$data['initial_amount']         = '';
		$data['is_display1']         = '';
		$data['is_display2']         = '';
		$data['is_display1']         = '';
		$data['is_display2']         = '';
		if ($id)
		{	
			$data['client']			=	$client		= $this->Crm_model->getCustomer($id);
			if (!$client)
			{
				$this->session->set_flashdata('error', lang('ClientNotFound'));
				redirect('admin/crm/Crm/ClientForm');
			}		
		// $data['customer_id']			     = $client->customer_id;
		$data['customer_name']		         = $client->customer_name;
		$data['customername2']			     = $client->customername2;
		$data['dob']	                     = $client->dob;
		$data['dob2']			             = $client->dob2;
		$data['address']	    		     = $client->address;
		$data['customeraddress2']		     = $client->customeraddress2;		
		$data['nationalid']		             = $client->nationalid;
		//$data['street']		     			 = $client->street;
		$data['nationalid2']		 		 = $client->nationalid2 ;
		$data['contact_number']		         = $client->contact_number;
		$data['email']	                 	 = $client->email;
		$data['country_id']	                 = $client->country;
		$data['city']	                     = $client->city;
		$data['occupation']                  = $client->occupation ;
		$data['contractNumber']              = $client->contractNumber;
		//$data['enquiry_id']                  = $client->enquiry_id;		
		$data['initial_amount']              = $client->initial_amount;
		$data['is_display1']                 = $client->displayname1;
		$data['is_display2']                 = $client->dislayname2;
		$data['SalesPersontype']             = $client->SalesPersontype;
		$data['salespersons']				 = $this->Crm_model->getSalesPerson($client->SalesPersontype);
		$data['agentid']                     = $client->agentid;
		}
		$this->form_validation->set_rules('Customername', 'lang:Customername', 'trim|required');
	//	$this->form_validation->set_rules('occupation', 'lang:occupation', 'trim|required');
		$this->form_validation->set_rules('dob', 'lang:DOB', 'trim|required');
	 //	$this->form_validation->set_rules('address', 'lang:address', 'trim|required');
	//	$this->form_validation->set_rules('contact_number', 'lang:Contact_number', 'trim|required');
	//	$this->form_validation->set_rules('email', 'lang:email', 'trim|required');
	//	$this->form_validation->set_rules('country', 'lang:select_country', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('_crm/ClientForm', $data);		
		}
		else{		
			$save['customer_id']		         =$id;
			$save['customer_name']		         = $this->input->post('Customername');
			$save['customername2']		         = $this->input->post('Customername2');
			$save['dob']	    				 = $this->input->post('dob');
			$save['dob2']	    				 = $this->input->post('dob2');
			$save['address']		     		 = $this->input->post('address1');
			$save['customeraddress2']		     		 = $this->input->post('address2');
			$save['nationalid']		     		 = $this->input->post('NationalId');
			$save['nationalid2']		     		 = $this->input->post('NationalId2');
			$save['contact_number']		         = $this->input->post('contactnumber');
			$save['email']	                 	 = $this->input->post('email');
			$save['country']	                 = $this->input->post('country');
			$save['city']		 				 = $this->input->post('city');
			$save['occupation']			         = $this->input->post('occupation');
			$save['contractNumber']	             = $this->input->post('contractnumber');
			$save['initial_amount']			     = $this->input->post('initialamount');
			$save['displayname1']			     = $this->input->post('is_display1');
			$save['dislayname2']			     = $this->input->post('is_display2');
			$save['SalesPersontype']		 	 = $this->input->post('salespersontype');
			$save['agentid']			         = $this->input->post('salesperson');
			
		    $this->Crm_model->customer_update($save);
			if($id){
				$this->session->set_flashdata('message', lang('ClientUpdated'));
				 redirect('admin/crm/Crm/ClientList');
			}else{
				$this->session->set_flashdata('message', lang('ClientSaved'));
				 redirect('admin/crm/Crm/ClientList');
			}
		       redirect('admin/crm/Crm/ClientList');
		}
	 }
	function Clientdelete($id = false)
	{
		if ($id){	
			$customer=$this->Crm_model->getCustomer($id);
			if (!$customer){
				$this->session->set_flashdata('error', lang('ClientNotFound'));
				redirect('admin/crm/Crm/ClientList');
			}else{
				$delete	= $this->Crm_model->clientDelete($id);
				$this->session->set_flashdata('message', lang('ClientDelete'));
				redirect('admin/crm/Crm/ClientList');
			}
		}
		else{
			    $this->session->set_flashdata('error', lang('EnquiryNotFound'));
				redirect('admin/crm/Crm/Enquiry');
		}
	}
	function depositReceipt($enquiryid){
		 $data['currency']    =  $this->Crm_model->getCurrency();
		 $data['receipt']=$receipt=$this->Crm_model->getReceipt($enquiryid);
		 $data['word']=$this->getIndianCurrency($receipt->initial_amount);
	     $this->render_admin('_crm/Deposite_recipt', $data);
	}
  function getIndianCurrency(float $number)
  {
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $usd = implode('', array_reverse($str));
    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Pound' : '';
    return ($usd ? $usd . 'Dollar' : '') . $paise ;
}
	function clientformSales($id = false){
		$this->form_validation->set_rules('Customername', 'lang:Customername', 'trim|required');
    	//	$this->form_validation->set_rules('occupation', 'lang:occupation', 'trim|required');
		//$this->form_validation->set_rules('dob', 'lang:DOB', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			 redirect('admin/sales/Sales/addBooking');	
		}
		else{		
			$save['customer_id']		         =$id;
			$save['customer_name']		         = $this->input->post('Customername');
			$save['customername2']		         = $this->input->post('Customername2');
			$save['dob']	    				 = $this->input->post('dob');
			$save['dob2']	    				 = $this->input->post('dob2');
			$save['address']		     		 = $this->input->post('address1');
			$save['customeraddress2']		     = $this->input->post('address2');
			$save['nationalid']		     		 = $this->input->post('NationalId');
			$save['nationalid2']		         = $this->input->post('NationalId2');
			$save['contact_number']		         = $this->input->post('contactnumber');
			$save['email']	                 	 = $this->input->post('email');
			$save['country']	                 = $this->input->post('country');
			$save['city']		 				 = $this->input->post('city');
			$save['occupation']			         = $this->input->post('occupation');
			$save['contractNumber']	             = $this->input->post('contractnumber');
			$save['initial_amount']			     = $this->input->post('initialamount');
			$save['displayname1']			     = $this->input->post('is_display1');
			$save['dislayname2']			     = $this->input->post('is_display2');
			$save['SalesPersontype']			 = $this->input->post('salespersontype');
			$save['agentid']			         = $this->input->post('salesperson');
			
		    $this->Crm_model->customer_update($save);
			if($id){
				$this->session->set_flashdata('message', lang('ClientUpdated'));
				 redirect('admin/sales/Sales/addBooking');
			}else{
				$this->session->set_flashdata('message', lang('ClientSaved'));
				 redirect('admin/sales/Sales/addBooking');
			}
		         redirect('admin/sales/Sales/addBooking');
		}
	 }
	 function campaign(){
		$data['page_title']	= lang('campaign');
		$this->render_admin('_crm/campaignlist', $data);
	 }
	 function get_campaign(){
		$actions = "<div class=\"text-center\">";
        $actions .= "<a href='" . base_url('admin/crm/Crm/campaignView/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/crm/Crm/campaignForm/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/crm/Crm/campaign_delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
          $actions .= "</div>";
          $this->datatables
		  ->select("campaign.id,campaign_name,  purpose, employee.first_name,  description ,created_on
		   ", FALSE)
		  ->from("campaign")
		->join("employee","employee.id=campaign.created_by","left")
		  ->where('campaign.soft_delete',0)
          ->add_column("Actions", $actions, "campaign.id");
	      echo $this->datatables->generate(); 
	}
	function campaignView($id,$tab=false){
		$data['page_title']	            = lang('campaign')." ".lang('view') ;
		$data['campaign']	                = $campaign = $this->Crm_model->get_campaign($id);
		$data['employee']		             = $this->Crm_model->get_employee();
		$data['leads']		                 = $this->Crm_model->get_followups();
		$this->render_admin('_crm/campaignView', $data);
	 }	
	 function campaignForm($id = false){
		$data['page_title']         	     = lang('campaign_form');		
		$data['employee']		             = $this->Crm_model->get_employee();
		$data['leads']		                 = $this->Crm_model->get_followups();
		$data['id']		                     = '';
		$data['campaign_name']			     = '';
		$data['purpose']	                 = '';
		$data['members']			         = '';
		$data['description']	    		 = '';
		$data['created_by']	    		     = '';
		if ($id){	
			$data['campaign']			=	$campaign		= $this->Crm_model->get_campaign($id);
			if (!$campaign){
				$this->session->set_flashdata('error', lang('campaign_details_not_found'));
				redirect('admin/crm/Crm/campaignForm');
			}		
		$data['id']		                     = $campaign->id;
		$data['campaign_name']			     = $campaign->campaign_name;
		$data['purpose']	                 = $campaign->purpose;
		$data['members']			         = json_decode($campaign->members);
		$data['description']	    		 = $campaign->description;
		$data['created_by']	    		     = $campaign->created_by;
		}
		$this->form_validation->set_rules('campaign_name', 'lang:campaign_name', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('_crm/campaignForm', $data);		
		}
		else{		
			$save['id']		                     = $id;
			$save['campaign_name']		         = $this->input->post('campaign_name');
			$save['purpose']		             = $this->input->post('purpose');
			$save['created_by']		             = $this->input->post('created_by');
			$save['members']		             = json_encode($this->input->post('leads'));
			$save['description']	    		 = $this->input->post('description');
		    $this->Crm_model->campaign_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('campaign_details_updated'));
				 redirect('admin/crm/Crm/campaign');
			}else{
				$this->session->set_flashdata('message', lang('campaign_details_saved'));
				 redirect('admin/crm/Crm/campaign');
			}
		       redirect('admin/crm/Crm/campaign');
		}
	 }
	function campaign_delete($id = false){
		if ($id){	
			$campaign=$this->Crm_model->get_campaign($id);
			if (!$campaign){
				$this->session->set_flashdata('error', lang('campaign_details_not_found'));
				redirect('admin/crm/Crm/campaign');
			}else{
				$delete	= $this->Crm_model->campaign_delete($id);
				$this->session->set_flashdata('message', lang('campaign_details_deleted'));
				redirect('admin/crm/Crm/campaign');
			}
		}
		else{
			    $this->session->set_flashdata('error', lang('campaign_details_not_found'));
				redirect('admin/crm/Crm/campaign');
		}
	}
	
	
	function sms(){
		$data['page_title']	= lang('campaign');
		$data['campaignlist']=$this->Crm_model->get_campaignlist();
		$this->render_admin('_crm/sms_form', $data);
	}
	function send_sms(){
		$message=$this->input->post('message');
		$campaignid=$this->input->post('campaignid');
		$purpose=$this->input->post('purpose');
		$data['date']=date('Y-m-d H:i:s');
		$data['message']=$message;
		$data['purpose']=$purpose;
		$data['leads']=$this->Crm_model->get_leads_contact($campaignid);
		$str = http_build_query($data);
		$url=base_url().'/main/send_smss';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		$this->session->set_flashdata('message', lang('sms_sending'));
		redirect('admin/crm/Crm/sms');
		
		
	}
	function sms_history(){
		$data['page_title']	= lang('campaign');
		$this->render_admin('_crm/sms_history', $data);
	}
	function get_sms_history(){
		$actions = "<div class=\"text-center\">";
        $actions .= "<a href='" . base_url('admin/crm/Crm/campaignView/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/crm/Crm/campaignForm/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/crm/Crm/campaign_delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
          $actions .= "</div>";
          $this->datatables
		  ->select("id , message ,purpose  ,status ,created_on  
		   ", FALSE)
		  ->from("sms_history")
		  ->where('soft_delete',0)
          ->add_column("Actions", $actions, "id");
	      echo $this->datatables->generate(); 
	}
	function get_leads(){
		$campaignid=$this->input->post('campaignid');
		$leads=$this->Crm_model->get_leads($campaignid);
		$html='';
		if(!empty($leads)){
			foreach($leads as $lead){
				$html .=$lead->Customer_name.'<br>';
			}
			echo $html;
		}else{
			$html .="No data Found in Database";
			echo $html;
		}
		
	}
	
	function post_sale_followup(){
		
		$this->render_admin('_crm/post_sales');
	}
	function pre_sale_followup(){
		$this->render_admin('_crm/pre_sales');
	}
	function pre_sale_bricks(){
		$this->render_admin('_crm/pre_sales_bricks');
	}
		function pre_sale_website(){
		$this->render_admin('_crm/pre_sales_web');
	}
		function pre_sale_feedback_tele(){
		$this->render_admin('_crm/pre_sales_tele');
	}
	function enquirys(){
        $admin = $this->session->userdata('admin');
        $data['page_title'] = lang('enquiry');
        $this->render_admin('_crm/enquiry/list',$data);
	}
	public function getenquirys(){
        $actions = "<div class=\"text-center\">";
        $actions .= " <a href='" . base_url('admin/crm/Crm/enquirys_view/$1') . "'  class='tip' ><i class=\"fa fa-eye\"></i></a> <a href='" . base_url('admin/crm/Crm/enquiry_form/$1') . "'  class='tip' ><i class=\"fa fa-edit\"></i></a> <a href='" . base_url('admin/crm/Crm/enquirys_delete/$1') . "' class='tip po'  onclick='return areyousure(this)'><i class=\"fa fa-trash-o\"></i></a>";
        $actions .= "</div>";
        $this->load->library('datatables');  
        $this->datatables
			->select("crm_enquirys.id,serial_no, date ,building_info.name building,floors.name floors,crm_enquirys. name ,contact_no", false)
			->from("crm_enquirys")
			->join("floors","floors.id=crm_enquirys.floor","left")
			->join("building_info","building_info.bldid=crm_enquirys.preferred_wing","left")
            ->where("crm_enquirys.soft_deleted", 0)
            ->add_column("Actions", $actions, "crm_enquirys.id");
        echo $this->datatables->generate();
	}
	function   enquirys_view($id){
		    $data['enquiry']       =$enquiry= $this->Crm_model->get_enquirys_details($id);
			$data['employee']		             = $this->Crm_model->get_employee();
			$data['unit_type']     =$this->Crm_model->get_unit_type();
			$data['floorlist']     =$this->Crm_model->get_floor($enquiry->preferred_wing);
			$data['pos_enquirys']  =$pos_enquirys=$this->Crm_model->get_pos_enquiry($id);
			if(!empty($pos_enquirys)){
			$data['status']		         = $pos_enquirys->status;
			$data['looking_for']		 = $pos_enquirys->looking_for;
			$data['budget']		         = $pos_enquirys->budget;
			$data['purpose']		     = $pos_enquirys->purpose;
			$data['breif_remark']		 = $pos_enquirys->breif_remark;
			$data['next_followup']		 = $pos_enquirys->next_followup;
			}
		 $this->render_admin('_crm/enquiry/view',$data);
	}
	
	function  enquirys_delete($id){
		$this->db->where("id",$id);
		if($this->db->update("crm_enquirys",array("soft_deleted"=>1))){
			$this->session->set_flashdata('error', 'Enquiry Details Not Found');
		    redirect('admin/crm/Crm/enquirys');
		}
		
	}
	
	function enquiry_form($id = false){
	    $data['page_title']         	     = lang('enquiry');		
		$data['employee']		             = $this->Crm_model->get_employee();
		$data['building']		             = $this->Crm_model->getbuilding();
		$maxid=$this->Crm_model->findmaxId();
		$data['id']		                     = '';
		$data['date']		                 = '';
		$data['serial_no']		             = 'ENQ.NO-'.str_pad($maxid, 6, '0', STR_PAD_LEFT);
		$data['name']		                 = '';
		$data['contact_no']		             = '';
		$data['alernate_no']		         = '';
		$data['address']		             = '';
		$data['email']		                 = '';
		$data['profession']		             = '';
		$data['organization']		         = '';
		$data['convenient']		             = '';
		$data['plan_to_book_flat']	         = '';
		$data['adult']		                 = '';
		$data['child']		                 = '';
		$data['vechile']		             = '';
		$data['four_wheeler']		         = '';
		$data['two_wheeler']		         = '';
		$data['preferred_wing']		         = '';
		$data['floor']	                     = '';
		$data['brought_to_here']		     = '';
		$data['post_visit_remark']		     = '';
		$data['followup']		             = '';
		$data['attended_by']		         = '';
		$data['status']		                 = '';
	    $data['looking_for']		         = '';
		$data['budget']		                 = '';
		$data['purpose']		             = '';
		$data['breif_remark']		         = '';
		$data['next_followup']		         = '';
		$data['no_of_people']		         = '';
	    $data['pre_sales_excutive']		     = '';
		$data['lead_forward_to']		     = '';
		if ($id){	
			$data['enquiry']       =$enquiry= $this->Crm_model->get_enquirys_details($id);
			$data['unit_type']     =$this->Crm_model->get_unit_type();
			$data['floorlist']     =$this->Crm_model->get_floor($enquiry->preferred_wing);
			$data['pos_enquirys']  =$pos_enquirys=$this->Crm_model->get_pos_enquiry($id);
			if(!empty($pos_enquirys)){
			$data['status']		         = $pos_enquirys->status;
			$data['looking_for']		 = $pos_enquirys->looking_for;
			$data['budget']		         = $pos_enquirys->budget;
			$data['purpose']		     = $pos_enquirys->purpose;
			$data['breif_remark']		 = $pos_enquirys->breif_remark;
			$data['next_followup']		 = $pos_enquirys->next_followup;
			}
			if (!$enquiry){
				$this->session->set_flashdata('error', 'Enquiry Details Not Found');
				redirect('admin/crm/Crm/enquirys');
			}		
		$data['id']		                     = $enquiry->id;
		$data['date']		                 = $enquiry->date;
		$data['serial_no']		             = $enquiry->serial_no;
		$data['name']		                 = $enquiry->name;
		$data['contact_no']		             = $enquiry->contact_no;
		$data['alernate_no']		         = $enquiry->alernate_no;
		$data['address']		             = $enquiry->address;
		$data['email']		                 = $enquiry->email;
		$data['profession']		             = $enquiry->profession;
		$data['organization']		         = $enquiry->organization;
		$data['convenient']		             = $enquiry->convenient;
		$data['plan_to_book_flat']		     = $enquiry->plan_to_book_flat;
		$data['adult']		                 = $enquiry->adult;
		$data['child']		                 = $enquiry->child;
		$data['vechile']		             = $enquiry->vechile;
		$data['four_wheeler']		         = $enquiry->four_wheeler;
		$data['two_wheeler']		         = $enquiry->two_wheeler;
		$data['preferred_wing']		         = $enquiry->preferred_wing;
		$data['floor']		                 = $enquiry->floor;
		$data['brought_to_here']		     = $enquiry->brought_to_here;
		$data['post_visit_remark']		     = $enquiry->post_visit_remark;
		$data['followup']		             = $enquiry->followup;
		$data['attended_by']		         = $enquiry->attended_by;
		$data['no_of_people']		         = $enquiry->no_of_people;
	    $data['pre_sales_excutive']		     = $enquiry->pre_sales_excutive;
		$data['lead_forward_to']		     = $enquiry->lead_forward_to;
		}
		$this->form_validation->set_rules('date', 'lang:date', 'trim|required');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('name', 'lang:contact', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('_crm/enquiry/EnquiryForm',$data);
		}
		else{		
		
		if($id){
			$post_enquiry['status']		         = $this->input->post('status');
			$post_enquiry['looking_for']		 = $this->input->post('looking_for');
			$post_enquiry['budget']		         = $this->input->post('budget');
			$post_enquiry['purpose']		     = $this->input->post('purpose');
			$post_enquiry['breif_remark']		 = $this->input->post('breif_remark');
			$post_enquiry['next_followup']		 = $this->input->post('next_followup');
		}
		    $post_enquiry=!empty($post_enquiry)?$post_enquiry:array();
			$save['id']		                     = $id;
		    $save['date']		                 = $this->input->post('date');
		    $save['serial_no']		             = $this->input->post('serial_no');
		    $save['name']		                 = $this->input->post('name');
		    $save['contact_no']		             = $this->input->post('contact');
		    $save['alernate_no']		         = $this->input->post('alternate');
			$save['address']		             = $this->input->post('address');
			$save['email']		                 = $this->input->post('email');
			$save['profession']		             = $this->input->post('profession');
			$save['organization']		         = $this->input->post('organization');
			$save['convenient']		             = $this->input->post('convenienttime');
			$save['plan_to_book_flat']		     = $this->input->post('plan_to_book_flat');
			$save['adult']		                 = $this->input->post('adult');
			$save['child']		                 = $this->input->post('child');
			$save['four_wheeler']		         = $this->input->post('4wheeler');
			$save['two_wheeler']		         = $this->input->post('2wheeler');
			$save['preferred_wing']		         = $this->input->post('building_id');
			$save['floor']		                 = $this->input->post('floor_id');  
			$save['brought_to_here']		     = $this->input->post('brought_to_here');
			$save['post_visit_remark']		     = $this->input->post('post_visit_remark');
			$save['followup']		             = $this->input->post('followup');
			$save['attended_by']		         = $this->input->post('attended_by');
			$save['no_of_people']		         = $this->input->post('no_of_people');
			$save['pre_sales_excutive']		     = $this->input->post('pre_sales_excutive');
			$save['lead_forward_to']		     = $this->input->post('lead_forward_to');
		    $this->Crm_model->enquiryForm_save($save,$post_enquiry);
			if($id){
				//$this->main->()
				 $this->session->set_flashdata('message', 'Enquiry Details Updated');
				 redirect('admin/crm/Crm/enquirys');
			}else{
				$this->session->set_flashdata('message', lang('Enquiry Details Saved'));
				 redirect('admin/crm/Crm/enquirys');
			}
		         redirect('admin/crm/Crm/enquirys');
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
}