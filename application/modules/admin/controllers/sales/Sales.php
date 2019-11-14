	<?php
class Sales extends Admin_Controller {
	
	
	public $name='vijay';
	function __construct()
	{		
		parent::__construct();
		$this->load->model(array('sales/Sales_model'));
		$this->load->library("pagination");
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	function index(){
		 $admin = $this->session->userdata('admin');
		 $config 			   = array();
         $config["base_url"]   = base_url() . "admin/sales/Sales";
         $config["total_rows"] = $this->Sales_model->saleproject();
         $config["per_page"]   = 10;
         $config["uri_segment"]= 2;
         $this->pagination->initialize($config);
         $page                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
         $data['confirm_booking']   = $this->Sales_model->get_all_confirm_booking($config["per_page"], $page);
         $data['hold_booking']      = $this->Sales_model->get_all_hold_booking($config["per_page"], $page);
         $data['cancelled_booking'] = $this->Sales_model->get_all_cancelled_booking($config["per_page"], $page);
         $data["links"]        = $this->pagination->create_links();
		 $data['page_title']	= lang('Bookinglist');		 
		$this->render_admin('_sales/Bookinglist', $data);
		
	}
	
	function bookingList()
	 {	 
		 $admin = $this->session->userdata('admin');
		 $config 			   = array();
         $config["base_url"]   = base_url() . "admin/sales/Sales";
         $config["total_rows"] = $this->Sales_model->saleproject();
         $config["per_page"]   = 10;
         $config["uri_segment"]= 2;
         $this->pagination->initialize($config);
         $page                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
         $data['confirm_booking']   = $this->Sales_model->get_all_confirm_booking($config["per_page"], $page);
         $data['hold_booking']      = $this->Sales_model->get_all_hold_booking($config["per_page"], $page);
         $data['cancelled_booking'] = $this->Sales_model->get_all_cancelled_booking($config["per_page"], $page);
         $data["links"]        = $this->pagination->create_links();
		 
		 $data['page_title']	= lang('Bookinglist');		 
		$this->render_admin('_sales/Bookinglist', $data);
	 }

	 function bookingView(){
		  $admin = $this->session->userdata('admin');
		  $data['page_title']	= lang('Sales View');
		  $this->render_admin('_sales/BookingView', $data);
	 }
	 
	 function bookingViewDetail($booking_id){
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Sales View');
		if(!empty($booking_id )) {
			 $data['result'] =$result=$this->Sales_model->get_sales($booking_id);
			 $data['payment_type'] =$result->payment_type;
			 $data['salepersonName']=$this->Sales_model->getSalesPersonName($result->SalesPersontype,$result->agentid);
			 $data['contractform']=$contract=$this->Sales_model->get_contractform($booking_id);
			
			 //paymenttype 1 means emi 
			 if($result->payment_type ==1){
		     $data['result_emi'] = $this->Sales_model->get_emi($booking_id,2);
		     $data['result_emi2']  = $this->Sales_model->get_emi($booking_id,1);
			 $advanceamt=!empty($result->advance_amt)?$result->advance_amt:0;
			        if($result->moratorium_per !=0.00 && $result->moratorium_amt !=0.00){
					 	  $principle=(($result->total_cost-$advanceamt) -$result->moratorium_amt);
				     }
		         	else{
						$principle=$result->total_cost -$advanceamt;
					}
			 $data['emi']=$emi=$this->calinterest($principle,$result->emi_period,$result->emi_percentage);
			 
			 }else{
				 $sql = "select * from sale_payment where sale_id = ".$booking_id;
		         $query = $this->db->query($sql);
		         $data['payment'] = $query->result();
			 }
		}
		$this->render_admin('_sales/BookingViewDetail', $data);
	 }
	 
	 function cancelBooking($booking_id){
		$cancel_booking=$this->Sales_model->cancelBooking($booking_id);
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Sales View');
		redirect('admin/sales/Sales/Bookinglist');
	}
	 function deleteBooking($booking_id){
		$cancel_booking=$this->Sales_model->deleteBooking($booking_id);
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Sales View');
		redirect('admin/sales/Sales/Bookinglist');
	}
	 
	 function Invoice($id,$type){  
	 if($type !=2){
		 $admin = $this->session->userdata('admin');
		 $data['page_title']	= lang('Invoice');
		 $data['invoice']=$invoice=$this->Sales_model->getInvoicerecipt($id);
		 $data['amount'] =$invoice->emi_amount;
		 $data['date'] =$invoice->paid_date;
		// $data['word']=$this->getIndianCurrency($invoice->emi_amount);
	 }else{
		 $data['page_title']	= lang('Invoice');
		 $data['invoice']=$invoice=$this->Sales_model->getInvoicerecipt1($id);
		 $data['amount'] =$invoice->paid_amount;
		 $data['date'] =$invoice->payment_date;
		 //$data['word']=$this->getIndianCurrency($invoice->paid_amount);
	 }
	     $data['currency']    =  $this->Sales_model->getCurrency();
	     $this->render_admin('_sales/receipt', $data);
		 
	 }
	  function advance_receipt($id){  
		 $data['page_title']	= lang('Invoice');
		 $data['invoice']=$invoice=$this->Sales_model->advancerecipt($id);
	     $this->render_admin('_sales/advance_receipt', $data);
	 }
	 
	 function addBooking(){
		$data['page_title']         	= lang('Sales Booking');
		$data['propertytypes']			= $this->Sales_model->Get_projecttype();
		$data['projects']		    	= $this->Sales_model->getProject();
		$data['Amenities']		    	= $this->Sales_model->getAmenities();
		$data['countries']		        = $this->Sales_model->getCountries();
		$data['agents']		        	= $this->Sales_model->getEmployees();
		$data['clients']				= $this->Sales_model->getClients();	
		$data['id']         	        = '';
		$this->form_validation->set_rules('client_id', 'lang:client_id', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('_sales/Salebooking', $data);		
		}
		else{			
			 $sale_person_details = $this->Sales_model->getSalesPersondetails($this->input->post('client_id'));
			$project['booking_date']                =$this->input->post('booking_date');
			$project['ref_no']			            = $this->input->post('ref_no');
			$project['client_id']		         	= $this->input->post('client_id');
		    $project['project_id']			        = $this->input->post('project_id');
			$project['building_id']			        = $this->input->post('building_id');
			$project['floor_id']			        = $this->input->post('floor_id');
			$project['unit_id']			            = $this->input->post('unit_id');
			$project['UnitType']			        = $this->input->post('unit_type');
			$project['rate_per_sqft']			    = $this->input->post('rate_per_sqft');
			$project['area_sqft']			        = $this->input->post('area_sqft');
			$project['basic_sale_price']			= $this->input->post('basic_sale_price');
			$project['discount']		            = $this->input->post('discount');
			$project['discount_amt']		        = $this->input->post('discount_amt');
			$project['total_cost']			        = $this->input->post('total_cost');
	//		$project['sales_type']			        = $this->input->post('sales_type');
			$project['booking_type']			    = $this->input->post('booking_type') ? $this->input->post('booking_type') : 1;
			$project['payment_type']				= $this->input->post('payment_type');
			$project['sales_person']			    = $sale_person_details[0]->agentid ? $sale_person_details[0]->agentid : 0;
			$project['sales_person_type']			= $sale_person_details[0]->SalesPersontype ? $sale_person_details[0]->SalesPersontype : '';
			$project['description']			        = $this->input->post('description');
			$project['created_on']			        = date('Y-m-d');
			$project['advance_amt']			        = $this->input->post('advance_amt');
			$project['balance']			            = $this->input->post('balance');
			$project['emi_period']			        = $this->input->post('emi_period');
			$project['emi_percentage']			    = $this->input->post('emi_percentage');
			$project['moratorium']			        = $this->input->post('moratorium');
			$project['moratorium_per']			    = $this->input->post('moratorium_per');
			$project['isPaid_initialAmount']	    = !empty($this->input->post('initialAmt_ispaid'))?$this->input->post('initialAmt_ispaid'):0;
			
			$project['moratorium_amt']			    = !empty($this->input->post('moratorium_amt'))?$this->input->post('moratorium_amt'):0;
			$project['moratorium_balance']			    = !empty($this->input->post('moratorium_amt'))?$this->input->post('moratorium_amt'):0;
			if(($this->input->post('initialAmt_ispaid')==1)){
			$project['initialAmount']			    = !empty($this->input->post('initial_amt'))?$this->input->post('initial_amt'):0;
			}else{
				$project['initialAmount']=0.0 ;
			}
			for($i=0; $i<count($this->input->post('sales_list_item')); $i++){
				$sale_invoce[] = array(
					'name' => 	$_POST['sales_list_item'][$i],
					'price' => 	$_POST['sales_list_amount'][$i],
					// 'discount' => 	$_POST['sales_list_item'][$i],
					'discount_amt' => 	$_POST['sales_list_discount'][$i],
					'subtotal' => 	$_POST['sales_list_total'][$i],
				);
			}
			

			for($i=0; $i<count($this->input->post('emi_no')); $i++){
				$sale_emi[] = array(
					'emi_no' =>	$_POST['emi_no'][$i],
					'emi_duedate' =>$_POST['emi_duedate'][$i],
					 'emi_amount' => $_POST['emi_amount'][$i],
					'Beginning_Balance' => $_POST['emi_Beginning_Balance'][$i],
					'Principal' => $_POST['emi_Principle'][$i],
					'Interest' => $_POST['emi_Interest'][$i],
					'Ending_Balance' =>@ $_POST['emi_Balance'][$i],
					'percentage'=>@ $_POST['percentage'][$i],
					'type' => $_POST['type'][$i],
					'emi_status' => 0,
				);
				
				if($_POST['type'][$i] ==2){
				$total_emi +=!empty($_POST['emi_amount'][$i])?$_POST['emi_amount'][$i] : 0;
				$total_interest +=!empty($_POST['emi_Interest'][$i])?$_POST['emi_Interest'][$i] : 0;
				}
			}
			$sale_emi=isset($sale_emi)?$sale_emi:array();
		     $project['total_loan_Amount']   =isset($total_emi)?$total_emi:0;
		     $project['loan_balance']  =isset($total_emi)?$total_emi:0;
			 $project['total_loan_interest']  =isset($total_interest)?$total_interest:0;
		    $sales=$this->Sales_model->sale_booking_insert($project,$sale_invoce,$sale_emi);
			if($sales){
				$this->Sales_model->generate_owner($sales);
				$this->session->set_flashdata('message', lang('BookingUpdated'));
				redirect('admin/sales/Sales');
			}else{
				$this->session->set_flashdata('message', lang('BookingSaved'));
				redirect('admin/sales/Sales');
			}
		       redirect('admin/sales/Sales');
		}
	 }
	 
	 function editBooking($id){

		$data['page_title']         	= lang('Sales Booking');
		$data['propertytypes']			= $this->Sales_model->Get_projecttype();
		$data['projects']		    	= $this->Sales_model->getProject();
		$data['Amenities']		    	= $this->Sales_model->getAmenities();
		$data['countries']		        = $this->Sales_model->getCountries();
		$data['agents']		        	= $this->Sales_model->getEmployees();
		$data['clients']				= $this->Sales_model->getClients();
		$data['unit_type']				= $this->Sales_model->getUnitType();
		$data['booking_id']				= $id;
		$data['booking']				= $booking=$this->Sales_model->Get_salebooking($id);	
		$data['buildings']		    = $this->Sales_model->getBuildingProjectWise($booking->project_id);
	    $data['floors']				    = $this->Sales_model->getFloor_project($booking->project_id,$booking->building_id);
		$data['units']				    = $unit=$this->Sales_model->getAllUnits_project($booking->project_id,$booking->building_id,$booking->floor_id,$booking->unit_id);
		$data['booking_invoice']		= $this->Sales_model->Get_salebookinginvoice($id);
		$data['booking_emi']			= $emi=$this->Sales_model->Get_salebookingemi($id);	
		
		$this->form_validation->set_rules('client_id', 'lang:client_id', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('_sales/Editbooking', $data);		
		}
		else{	
			 $sale_person_details = $this->Sales_model->getSalesPersondetails($this->input->post('client_id'));			 
			$project['booking_date']                =$this->input->post('booking_date');
			$project['ref_no']			            = $this->input->post('ref_no');
			$project['client_id']		         	= $this->input->post('client_id');
		    $project['project_id']			        = $this->input->post('project_id');
			$project['building_id']			        = $this->input->post('building_id');
			$project['floor_id']			        = $this->input->post('floor_id');
			$project['unit_id']			            = $this->input->post('unit_id');
			$project['UnitType']			            = $this->input->post('unit_type');
			$project['rate_per_sqft']			    = $this->input->post('rate_per_sqft');
			$project['area_sqft']			        = $this->input->post('area_sqft');
			$project['basic_sale_price']			= $this->input->post('basic_sale_price');
			$project['discount']		            = $this->input->post('discount');
			$project['discount_amt']		        = $this->input->post('discount_amt');
			$project['total_cost']			        = $this->input->post('total_cost');

		//	$project['sales_type']			        = $this->input->post('sales_type');
			$project['booking_type']			    = $this->input->post('booking_type') ? $this->input->post('booking_type') : 1;
			$project['payment_type']				= $this->input->post('payment_type');
			$project['sales_person']			    = $sale_person_details[0]->agentid ? $sale_person_details[0]->agentid : 0;
			$project['sales_person_type']			= $sale_person_details[0]->SalesPersontype ? $sale_person_details[0]->SalesPersontype : '';
			$project['description']			        = $this->input->post('description');
			$project['created_on']			        = date('Y-m-d');
			$project['advance_amt']			        = $this->input->post('advance_amt');
			$project['balance']			            = $this->input->post('balance');
			$project['emi_period']			        = $this->input->post('emi_period');
			$project['emi_percentage']			    = $this->input->post('emi_percentage');
			$project['moratorium']			        = $this->input->post('moratorium');
	        $project['moratorium_per']			    = $this->input->post('moratorium_per');
			$project['moratorium_amt']			    = !empty($this->input->post('moratorium_amt'))?$this->input->post('moratorium_amt'):0;
			$project['moratorium_balance']			    = !empty($this->input->post('moratorium_amt'))?$this->input->post('moratorium_amt'):0;
			for($i=0; $i<count($this->input->post('sales_list_item')); $i++){
				$sale_invoce[] = array(
					'name' => 	$_POST['sales_list_item'][$i],
					'price' => 	$_POST['sales_list_amount'][$i],
					// 'discount' => 	$_POST['sales_list_item'][$i],
					'discount_amt' => 	$_POST['sales_list_discount'][$i],
					'subtotal' => 	$_POST['sales_list_total'][$i],
				);
			}
             $total_emi=0;
			 $total_interest=0;
			for($i=0; $i<count($this->input->post('emi_no')); $i++){
				$sale_emi[] = array(
					'emi_no' =>	$_POST['emi_no'][$i],
					'emi_duedate' =>$_POST['emi_duedate'][$i],
					'emi_amount' => $_POST['emi_amount'][$i],
					'Beginning_Balance' => $_POST['emi_Beginning_Balance'][$i],
					'Principal' => $_POST['emi_Principle'][$i],
					'Interest' => $_POST['emi_Interest'][$i],
					'Ending_Balance' => $_POST['emi_Balance'][$i],
					'type' => $_POST['type'][$i],
					'emi_status' => 0,
				);
				if($_POST['type'][$i] ==2){
				$total_emi +=!empty($_POST['emi_amount'][$i])?$_POST['emi_amount'][$i] : 0;
				$total_interest +=!empty($_POST['emi_Interest'][$i])?$_POST['emi_Interest'][$i] : 0;
				}
			}
		     $project['total_loan_Amount']   =$total_emi;
		     $project['loan_balance']  =$total_emi;
			 $project['total_loan_interest']  =$total_interest;
			
		    $sales=$this->Sales_model->sale_booking_update($id,$project,$sale_invoce,$sale_emi);
			if($sales){
				$this->Sales_model->generate_owner($sales);
			}
			if($id){
				$this->session->set_flashdata('message', lang('BookingUpdated'));
				redirect('admin/sales/Sales');
			}else{
				$this->session->set_flashdata('message', lang('BookingSaved'));
				redirect('admin/sales/Sales');
			}
		       redirect('admin/sales/Sales');
		}
	 }

	function EnquiryView($id,$tab=false)
	 {
		$data['page_title']	= lang('Enquiry')." ".lang('view') ;
		$data['enquiry']	            = $enquiry = $this->Crm_model->getEnquiryView($id);
		$data['unitslists']					 = $this->Crm_model->getUnits($enquiry->projectid);
		$data['salespersons']				 = $this->Crm_model->getSalesPerson($enquiry->SalesPersontype);
		$data['Amenities']		    	= $this->Crm_model->getAmenities();
		$this->render_admin('_crm/EnquiryView', $data);
	 }
	 function Enquiryform($id = false){
		$data['page_title']         	= lang('Enquiry_form');
		$data['propertytypes']			= $this->Crm_model->Get_projecttype();
		$data['projects']		    	= $this->Crm_model->getProject();
		$data['Amenities']		    	= $this->Crm_model->getAmenities();
		$data['countries']		        = $this->Crm_model->getCountries();
		$data['agents']		        	= $this->Crm_model->getEmployees();
		$data['Customer_name']			= '';
		$data['propertytypesid']	    = '';
		$data['project_id']			    = '';
		$data['unit']			        = '';
		$data['enquiry_id']				= '';
		$data['enquiry_date']		    = '';
		$data['Budget']	                = '';
		$data['occupation']	            = '';
		$data['suggest_modification']	= '';
		$data['source_of_enquiry']		= '';
		$data['location_preference']	= '';
		$data['dob']		            = '';
		$data['address']		        = '';
		$data['contact_number']	        = '';
		$data['street']					= '';
		$data['city']					= '';
		$data['state']					= '';
		$data['email']					= '';
		$data['country_id']				= '';
		$data['Agent_id']				= '';
		$data['status']					= '';
		$data['doc']					= '';
		$data['SalesPersontype']					= 'SalesPersontype';
		if ($id)
		{	
			$data['enquiry']			=	$enquiry		= $this->Crm_model->getEnquiry($id);
			if (!$enquiry)
			{
				$this->session->set_flashdata('error', lang('EnquiryNotFound'));
				redirect('admin/Crm/Crm/Enquiry');
			}
		$data['unitslists']					 = $this->Crm_model->getUnits($enquiry->projectid);
		$data['salespersons']				 = $this->Crm_model->getSalesPerson($enquiry->SalesPersontype);
		$data['enquiry_id']					 = $enquiry->enquiry_id;
		$data['enquiry_date']		         = $enquiry->enquiry_date;
		$data['project_id']			         = $enquiry->projectid;
		$data['unit']			             = $enquiry->unitid;
		$data['Customer_name']			     = $enquiry->Customer_name;
		$data['Budget']	    				 = $enquiry->Budget;
		$data['propertytypesid']		     = $enquiry->type_for;
		$data['suggest_modification']		 = json_decode($enquiry->suggest_modification);
		$data['occupation']		             = $enquiry->occupation;
		$data['source_of_enquiry']		     = $enquiry->source_of_enquiry;
		$data['location_preference']		 = $enquiry->location_preference ;
		$data['dob']		                 = $enquiry->dob;
		$data['address']	                 = $enquiry->address;
		$data['contact_number']	             = $enquiry->contact_number;
		$data['street']	                     = $enquiry->street;
		$data['city']                        = $enquiry->city ;
		$data['state']                       = $enquiry->state;
		$data['email']                       = $enquiry->email;
		$data['country_id']                  = $enquiry->country;
		$data['Agent_id']	                 = $enquiry->agentid;
		$data['enquiry_status']              = $enquiry->enquiry_status;
	    $data['SalesPersontype']		    = $enquiry->SalesPersontype;
		}
		$this->form_validation->set_rules('Customername', 'lang:Customer_name', 'trim|required');
		$this->form_validation->set_rules('project', 'lang:Project', 'trim|required');
		$this->form_validation->set_rules('Enquiry_date', 'lang:Enquiry_date', 'trim|required');
		$this->form_validation->set_rules('sourceofenquiry', 'lang:Source_of_enquiry', 'trim|required');
		$this->form_validation->set_rules('dob', 'lang:DOB', 'trim|required');
		$this->form_validation->set_rules('address', 'lang:address', 'trim|required');
		$this->form_validation->set_rules('contactnumber', 'lang:Contact_number', 'trim|required');
		$this->form_validation->set_rules('email', 'lang:email', 'trim|required');
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
			$save['Customer_name']		         	= $this->input->post('Customername');
		    $save['Budget']			                = $this->input->post('Budget');
			$save['type_for']			            = $this->input->post('pertypes');
			$save['suggest_modification']			=json_encode( $this->input->post('suggestsmodification'));
			$save['occupation']			            = $this->input->post('occupation');
			$save['source_of_enquiry']			    = $this->input->post('sourceofenquiry');
			$save['location_preference']			= $this->input->post('locationpreference');
			$save['dob']		                    = $this->input->post('dob');
			$save['address']		                = $this->input->post('address');
			$save['contact_number']			        = $this->input->post('contactnumber');
			$save['street']			                = $this->input->post('street');
			$save['city']			                = $this->input->post('city');
			$save['state']			                = $this->input->post('state');
			$save['email']			                = $this->input->post('email');
			$save['country']			            = $this->input->post('country');
			$save['enquiry_status']			        = $this->input->post('status');
			$save['projectid']			            = $this->input->post('project');
			$save['unitid']			                = $this->input->post('units');
			$save['agentid']			            = $this->input->post('salesperson');
			$save['SalesPersontype']			    = $this->input->post('salespersontype');
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
	
	
	
	function followup(){
		
		 $data['page_title']	= lang('FollowUp');
		 $config 			   = array();
         $config["base_url"]   = base_url() . "admin/Crm/Crm/followup";
         $config["total_rows"] = $this->Crm_model->followUpcount();
         $config["per_page"]   = 10;
         $config["uri_segment"]= 2;
         $this->pagination->initialize($config);
         $page                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
         $data['enquiry']      = $this->Crm_model->get_all_Followup($config["per_page"], $page);
         $data["links"]        = $this->pagination->create_links();
		 
		$this->render_admin('_crm/Followuplist', $data);
	}
		function FollowupView($id,$tab=false)
	 {
		 $data['page_title']	= lang('FollowUp') ;
		 $data['enquiryid']=$id;
	   	 $data['enquiry']	= $enquiry = $this->Crm_model->getEnquiryView($id);
		 $data['follow_list']   = $this->Crm_model->getFollowupByEnquiry($enquiry->enquiry_id);
		$this->render_admin('_crm/FollowupView.php', $data);
	 }
	
	
function Agentlist()
	 {	 
		 $admin = $this->session->userdata('admin');
		 $config 			   = array();
         $config["base_url"]   = base_url() . "admin/sales/Sales";
         $config["total_rows"] = $this->Sales_model->saleproject();
         $config["per_page"]   = 10;
         $config["uri_segment"]= 2;
         $this->pagination->initialize($config);
         $page                 = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
         $data['agent_list']   = $this->Sales_model->get_all_agentlist($config["per_page"], $page);
         /*echo "<pre>";
         print_r($data['agent_list']);die;*/
         $data["links"]        = $this->pagination->create_links();
		 $data['page_title']	= lang('agent_list');		 
		$this->render_admin('_sales/Agentlist', $data);
	 }	
	 function Agentform($id = false){
		$data['page_title']         	= lang('agent_form');		
		$data['name']			        = '';
		$data['agentid']				= '';
		$data['agenttype']	            = '';
		$data['position']	            = '';
		$data['mobile']	 				= '';
		$data['email']					= '';
		$data['address']				= '';
		$data['active_status']		    = '';		
		$data['pro_pic']		        = '';	
		$data['sales_commission']		= '';	
			
		if ($id)
		{	
			$data['agent']			=	$agent	= $this->Sales_model->getAgent($id);			
			if (!$agent)
			{
				$this->session->set_flashdata('error', lang('AgentNotFound'));
				redirect('admin/sales/Sales/Agentform');
			}
			$data['agentid']				     = $agent->agentid;
			$data['name']					     = $agent->name;
			$data['agenttype']		             = $agent->agenttype;
			$data['position']			         = $agent->position;
			$data['mobile']			             = $agent->mobile;
			$data['email']			             = $agent->email;
			$data['address']	    		     = $agent->address;
			$data['active_status']		         = $agent->active_status;		
			$data['pro_pic']		             = $agent->pro_pic;		
			$data['sales_commission']		     = $agent->sales_commission;	
		}
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		//$this->form_validation->set_rules('agenttype', 'lang:agenttype', 'trim|required');
		//$this->form_validation->set_rules('position', 'lang:position', 'trim|required');
		$this->form_validation->set_rules('mobile', 'lang:mobile', 'trim|required');
		//$this->form_validation->set_rules('address', 'lang:address', 'trim|required');
		//$this->form_validation->set_rules('email', 'lang:email', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
			$this->render_admin('_sales/AgentForm', $data);		
		}
		else{
			/*$Doc = '';
			 if(!empty($_FILES['doc']['name'])){
                $config['upload_path'] = 'uploads/agent/';
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
		 		 $save['pro_pic']		        =$Doc;
			 }*/

			$save['agentid']                    = $this->input->post('agentid');
			$save['agenttype']                 = $this->input->post('agenttype');
			$save['name']			            = $this->input->post('name');
			$save['position']		         	= $this->input->post('position');
		    $save['mobile']			            = $this->input->post('mobile');
			$save['email']			            = $this->input->post('email');			
			$save['address']		            = $this->input->post('address');
			$save['sales_commission']		= $this->input->post('sales_commission');
			
		    $this->Sales_model->agent_save($save);
			if($id){
				$this->session->set_flashdata('message', lang('AgentformUpdated'));
			}else{
				$this->session->set_flashdata('message', lang('AgentformSaved'));
			}
		       redirect('admin/sales/Sales/Agentlist');
		}
	 }	 
	function Agentdelete($id = false)
	{
		if ($id){	
			$agent=$this->Sales_model->getAgent($id);
			if (!$agent){
				$this->session->set_flashdata('error', lang('AgentNotFound'));
				redirect('admin/sales/Sales/Agentlist');
			}else{
				$delete	= $this->Sales_model->agentDelete($id);
				$this->session->set_flashdata('message', lang('AgentDeleted'));
				redirect('admin/sales/Sales/Agentlist');
			}
		}
		else{
			    $this->session->set_flashdata('error', lang('AgentNotFound'));
				redirect('admin/sales/Sales/Agentlist');
		}
	}
	function get_building(){
	$HTML='';
    $project_id = $this->input->post('project_id');
	$building=$this->db->get_where('building_info',array('soft_delete'=>0,'project_id' => $project_id))->result();
	if ($building) {
		foreach ($building as $item) {
			$HTML.="<option value='" . $item->bldid . "'>" . $item->name. "</option>";
		}
	}else{
		$HTML.="<option value=''>Select Building</option>";
	}
        echo $HTML;
	 
    }
	function get_floor(){
	$HTML='';
    $project_id = $this->input->post('project_id');
	$building_id = $this->input->post('buildingid');
	$floors=$this->db->get_where('floors',array('Soft_delete'=>0,'projectid' => $project_id,'building_id'=>$building_id))->result();
	if ($floors) {
		foreach ($floors as $floor) {
			$HTML.="<option value='" . $floor->id . "'>" . $floor->name. "</option>";
		}
	}else{
		$HTML.="<option value=''>Select Floor</option>";
	}
        echo $HTML;
	 
    }
	
	function get_floorWiseUnit(){
	$HTML='';
        $projectid = $this->input->post('projectid');
        $buildingid = $this->input->post('building');
    	$floorid = $this->input->post('floor_id');
	    $flats=$this->db->get_where('add_unit',array('floor_no' => $floorid,'Project_id'=>$projectid,'building_id'=>$buildingid,'Booked_status'=>0))->result();
	if ($flats) {
		foreach ($flats as $flat) {
			$HTML.="<option value='" . $flat->uid . "'>" . $flat->unit_no. "</option>";
		}
	}else{
		$HTML.="<option value=''>Select Flat</option>";
	}
    echo $HTML;
    }
	function get_unit(){
    $uid = $this->input->post('uid');
	$client_id = $this->input->post('client_id') ? $this->input->post('client_id') : 0;
	$units=$this->db->get_where('add_unit',array('uid'=>$uid,'Booked_status'=>0))->result();
		if ($units) {
			$unit_types = $this->db->get_where('unit_type', array('id' => $units[0]->Unit_type))->result();
			$cus = $this->db->select('c.Customer_name, c.enquiry_id,c.initial_amount,c.initialAmountpaid,e.suggest_modification')->from('crm_customer c')->join('crm_enquiry e', 'e.enquiry_id = c.enquiry_id', 'left')->where('c.customer_id', $client_id)->get();
			if($cus){
				if(!empty(json_decode($cus->row('suggest_modification')))){
					$this->db->select('Name, AmenitiesPrice');
				   $this->db->where_in('id',json_decode($cus->row('suggest_modification')));
				   $query=$this->db->get('amenties');
				   $amenties=$query->result();
				   if($amenties){
					foreach($amenties as $amentie){
						$amenties_array[] = array('list_item' => $amentie->Name, 'list_amount' => $amentie->AmenitiesPrice, 'list_discount' => 0, 'list_total' => $amentie->AmenitiesPrice);	
					}
				}
				}
				$amenties_array[] = array('list_item' => 'Basic', 'list_amount' => $units[0]->unitPrice, 'list_discount' => 0, 'list_total' => $units[0]->unitPrice);
			}else{
				$amenties_array[] = array('list_item' => 'Basic', 'list_amount' => $units[0]->unitPrice, 'list_discount' => 0, 'list_total' => $units[0]->unitPrice);
			}
			$initialamount_ispaid=!empty($cus->row('initialAmountpaid'))?$cus->row('initialAmountpaid') :0;
			$initialamount=!empty($cus->row('initial_amount'))?$cus->row('initial_amount') :0;
			$data = array('rateperSqft' => $units[0]->rateperSqft, 'areaSqft' => $units[0]->areaSqft, 'unitPrice' => $units[0]->unitPrice, 'unit_types' => $unit_types, 'amenties_array' => (object)$amenties_array,'isPaidInitial_amt'=>$initialamount_ispaid,'initial_amt'=>$initialamount);
			
			echo json_encode($data);
		}
	 
    }
	
	
	function get_discount(){
		$basic_sale_price = $this->input->post('basic_sale_price');
		$discount =$this->input->post('discount') ? $this->input->post('discount') : 0; 
		$client_id = $this->input->post('client_id') ? $this->input->post('client_id') : 0;

		if ($discount) {
			$discount_amt = ($basic_sale_price * ($discount / 100));
			
		}else{
			$discount_amt=0;
		}
		$cus = $this->db->select('c.Customer_name, c.enquiry_id, e.suggest_modification')->from('crm_customer c')->join('crm_enquiry e', 'e.enquiry_id = c.enquiry_id', 'left')->where('c.customer_id', $client_id)->get();
			if($cus){
				$amenties = $this->db->select('Name, AmenitiesPrice')->where_in('id', json_decode($cus->row('suggest_modification')))->get('amenties')->result();
				if($amenties){
					foreach($amenties as $amentie){
						$AmenitiesPrice[] = $amentie->AmenitiesPrice;
					}
				}
				
			}
			$basic_total_cost = $basic_sale_price - $discount_amt;
			$total_cost = array_sum($AmenitiesPrice) + $basic_total_cost;
			$data = array('discount_amt' => $discount_amt, 'basic_total_cost' => $basic_total_cost, 'sales_text_discount' => $discount_amt, 'sales_text_total' => $basic_total_cost, 'total_cost' => $total_cost, 'balance' => $total_cost);
			echo json_encode($data);
		
	 
	}
	
	function get_advance_amt(){
		$advance_amt = $this->input->post('advance_amt');
		$balance = $this->input->post('balance');
		 $final_balance = $balance - $advance_amt;
		$emi_period = $this->input->post('emi_period');
		$emi_percentage = $this->input->post('emi_percentage');
		$date = $this->input->post('date');
		$moratorium = !empty($this->input->post('moratorium'))?$this->input->post('moratorium'):0;
		$moratorium_per = !empty($this->input->post('moratorium_per'))? $this->input->post('moratorium_per'):0;
		$moratorium_amt= round((($final_balance/100)*$moratorium_per),2);
		$emi = $this->paymentSchedulesummary($final_balance,$emi_period,$emi_percentage,$date,$moratorium,$moratorium_per);
		$data = array('balance' => $final_balance, 'emi' => $emi,'moratorium_amt'=>$moratorium_amt);
		echo json_encode($data); 
		
	}
	function get_initial_amt(){
		$advance_amt = $this->input->post('advance_amt');
		$balance = $this->input->post('balance');
		$final_balance = $balance;
		$emi_period = $this->input->post('emi_period');
		$emi_percentage = $this->input->post('emi_percentage');
		$date = $this->input->post('date');
		$moratorium = !empty($this->input->post('moratorium'))?$this->input->post('moratorium'):0;
		$moratorium_per = !empty($this->input->post('moratorium_per'))? $this->input->post('moratorium_per'):0;
		$moratorium_amt= round((($final_balance/100)*$moratorium_per),2);
		$emi = $this->paymentSchedulesummary($final_balance,$emi_period,$emi_percentage,$date,$moratorium,$moratorium_per);
	    $data = array('balance' => $final_balance, 'emi' => $emi,'moratorium_amt'=>$moratorium_amt);
		echo json_encode($data); 
		
	}
	
	function get_emi_period(){
		$balance = $this->input->post('balance');
		$final_balance = $balance;
		$emi_period = $this->input->post('emi_period');
		$emi_percentage = $this->input->post('emi_percentage');
		$date = $this->input->post('date');
		$moratorium = !empty($this->input->post('moratorium'))?$this->input->post('moratorium'):0;
		$moratorium_per = !empty($this->input->post('moratorium_per'))? $this->input->post('moratorium_per'):0;
		$moratorium_amt= round((($final_balance/100)*$moratorium_per),2);
		$emi = $this->paymentSchedulesummary($final_balance,$emi_period,$emi_percentage,$date,$moratorium,$moratorium_per);
		$data = array('balance' => $final_balance, 'emi' => $emi,'moratorium_amt'=>$moratorium_amt);
		echo json_encode($data); 
	}
	
	function get_emi_percentage(){
		$balance = $this->input->post('balance');
		$final_balance = $balance;
		$emi_period = $this->input->post('emi_period');
		$emi_percentage = $this->input->post('emi_percentage');
		$date = $this->input->post('date');
		$moratorium = !empty($this->input->post('moratorium'))?$this->input->post('moratorium'):0;
		$moratorium_per = !empty($this->input->post('moratorium_per'))? $this->input->post('moratorium_per'):0;
		$moratorium_amt= round((($final_balance/100)*$moratorium_per),2);
		$emi = $this->paymentSchedulesummary($final_balance,$emi_period,$emi_percentage,$date,$moratorium,$moratorium_per);
		$data = array('balance' => $final_balance, 'emi' => $emi,'moratorium_amt'=>$moratorium_amt);
		echo json_encode($data); 
	}
		function get_moratorium(){
		$balance = $this->input->post('balance');
		$final_balance = $balance;
		$emi_period = $this->input->post('emi_period');
		$emi_percentage = $this->input->post('emi_percentage');
		$date = $this->input->post('date');
		$moratorium = !empty($this->input->post('moratorium'))?$this->input->post('moratorium'):0;
		$moratorium_per = !empty($this->input->post('moratorium_per'))? $this->input->post('moratorium_per'):0;
		$moratorium_amt= round((($final_balance/100)*$moratorium_per),2);
		$emi = $this->paymentSchedulesummary($final_balance,$emi_period,$emi_percentage,$date,$moratorium,$moratorium_per);
		$data = array('balance' => $final_balance, 'emi' => $emi,'moratorium_amt'=>$moratorium_amt);
		echo json_encode($data); 
	}
	function get_moratorium_per(){
		$balance = $this->input->post('balance');
		$final_balance = $balance;
		$emi_period = $this->input->post('emi_period');
		$emi_percentage = $this->input->post('emi_percentage');
		$date = $this->input->post('date');
		$moratorium = !empty($this->input->post('moratorium'))?$this->input->post('moratorium'):0;
		$moratorium_per = !empty($this->input->post('moratorium_per'))? $this->input->post('moratorium_per'):0;
		$moratorium_amt= round((($final_balance/100)*$moratorium_per),2);
		$emi = $this->paymentSchedulesummary($final_balance,$emi_period,$emi_percentage,$date,$moratorium,$moratorium_per);
		$data = array('balance' => $final_balance, 'emi' => $emi,'moratorium_amt'=>$moratorium_amt);
		echo json_encode($data); 
	}
	
	function emiCalculater($principalamount,$terms,$interestpercentage){
		if($interestpercentage !=0){
      $intr =$interestpercentage/ 1200;
      $emi= round(($principalamount * $intr / (1 - (pow(1/(1 + $intr), $terms)))),2); 
      $totalinterest= round(((($principalamount * $intr / (1 - (pow(1/(1 + $intr), $terms))))*$terms) -$principalamount),2);
	  return $emi;
		}else{
			return $emi =round(($principalamount/$terms),2);
		}
	}
	function contract($id,$type){
		$data['bookingdetails']=$this->Sales_model->get_booking_details($id);
		$data['sales_id']=$id;
		$data['contract_id']=$type;
		switch ($type){
			case 1:
			
			$this->render_admin('_sales/contract-old',$data);
			break;
			case 2:
			$this->render_admin('_sales/contract_59',$data); 
			break;
			case 3:
			$this->render_admin('_sales/contract_c17',$data); 
			break;
			case 4:
			$this->render_admin('_sales/contract_c58',$data);
			break;
			case 5:
			$this->render_admin('_sales/contract_c59',$data);
			break;
			
		}
		 }
	function payment($sale_id){
		$emi_no = $this->input->post('emi_no');
		$status = $this->input->post('status');
		$paiddate = $this->input->post('paiddate');
		$emipayment=$this->Sales_model->payEMI($sale_id, $emi_no,$status,$paiddate);
		redirect('admin/sales/Sales/bookingViewDetail/'.$sale_id);
	 }	 

    public function add_payment($id = null){
        if ($id) {
            $sale = $this->Sales_model->getInvoiceByID($id);
        if ($sale->payment_status == 'paid' && $sale->balance<=0) {
            $this->session->set_flashdata('error', lang("Payment_status"));
			  redirect($_SERVER["HTTP_REFERER"]);
        }
        $this->form_validation->set_rules('amount-paid', lang("Amount"), 'required');
        $this->form_validation->set_rules('paid_by', lang("Paying_by"), 'required');
        if ($this->form_validation->run() == true) {
			   if($this->input->post('paymentid')){
				$payment_id=$this->input->post('paymentid');
			   	$balance = $this->Sales_model->checkPaidAmount($payment_id);
			 	$amountPaid = ($this->input->post('amount-paid') ? $this->input->post('amount-paid'):0);
			     $balanceamount=(($balance - $amountPaid)>=0)? $balance  - $amountPaid :0;
			        }else{
                      $balanceamount= ($sale->balance - ($this->input->post('amount-paid') ? $this->input->post('amount-paid'):0));
		       }
            $payment = array(
                'payment_date' => $this->input->post('date'),
                'sale_id' =>$id,
                'reference_no' => $this->input->post('reference_no') ,
                'paid_amount' => $this->input->post('amount-paid'),
                'paid_by' => $this->input->post('paid_by'),
                 'sale_type'=>'Partial',
                'cc_no' => $this->input->post('pcc_no'),
                'cc_holder' => $this->input->post('pcc_holder'),
                'cc_month' => $this->input->post('pcc_month'),
                'cc_year' => $this->input->post('pcc_year'),
                 'balance_amount'=>$balanceamount,
                'note' => $this->input->post('note'),
                'created_by' => $this->session->userdata('user_id'),
                'type' => 'received',
            );
        } elseif ($this->input->post('add_payment')) {
            $this->session->set_flashdata('error', validation_errors());
               redirect($_SERVER["HTTP_REFERER"]);
        }

        if ($this->form_validation->run() == true && $this->Sales_model->addPayment($payment,$id,$payment_id)) {
            $this->session->set_flashdata('message', lang("payment_added"));
              redirect($_SERVER["HTTP_REFERER"]);
        } else {
            $data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $data['inv'] = $sale;
            $data['payment_ref'] = '';
		  redirect($_SERVER["HTTP_REFERER"]);
        }
		}
		 redirect('admin/sales/Sales/bookingViewDetail/'.$id);
    }
	function paymentdelete($id = false){
		if ($id){	
				$delete	= $this->Sales_model->paymentdelete($id);
				$this->session->set_flashdata('message', lang('payment_delete'));
				 redirect($_SERVER["HTTP_REFERER"]);
		}
		else{
			    $this->session->set_flashdata('error', lang('Nodatafound'));
				redirect($_SERVER["HTTP_REFERER"]);
		}
		
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
 function SalesCommission(){
	     $admin = $this->session->userdata('admin');
		 $data['page_title']	= lang('agent_list');		 
         $data['SalesCommssion']   = $this->Sales_model->salesCommisionForAgentList();
		 $data['page_title']	= lang('Sales_commission');		 
		 $this->render_admin('_sales/SalecommsionList', $data);
 }

    public function add_Commission_payment()
    {
        $this->form_validation->set_rules('amount-paid', lang("Amount"), 'required');
        $this->form_validation->set_rules('date', lang("date"), 'required');
        if ($this->form_validation->run() == true) {
            $payment = array(
                'agentid' => $this->input->post('agentid'),
                'commission_paid' =>$this->input->post('amount-paid'),
                'paid_date' => $this->input->post('date') ,
                'note' => $this->input->post('note'),
                'agenttype' => $this->input->post('type'),
            );
			 if ($this->form_validation->run() == true && $this->Sales_model->addcommissionpayment($payment)) {
            $this->session->set_flashdata('message', lang("payment_added"));
             redirect($_SERVER["HTTP_REFERER"]);
        } else {
            $data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $data['inv'] = $sale;
            $data['payment_ref'] = '';
		 redirect($_SERVER["HTTP_REFERER"]);
        }
        } elseif ($this->input->post('add_payment')) {
            $this->session->set_flashdata('error', validation_errors());
              redirect($_SERVER["HTTP_REFERER"]);
        }
    }
	function viewsalesCommission(){
		$agentcommission=$this->db->get_where('sales_commission',array('agentid'=>$this->input->post('id'),'agenttype'=>$this->input->post('type')))->result();
		$HTML='';
		$i=1;
		if ($agentcommission) {
		foreach ($agentcommission as $item) {
			$HTML.="<tr><td>".$i."</td><td>".$item->commission_paid."</td><td>".date('Y-m-d',strtotime($item->paid_date))."</td><td>".$item->note."</td></td><td><div class='text-center'> <a href=".base_url().'admin/sales/Sales/salesCommissionPaymentReceipt/'.$item->commission_id." ><i class='fa fa-file-text-o'></i></a><a href=".base_url().'admin/sales/Sales/saleCommissionPaymentedit/'.$item->commission_id."><i class='fa fa-edit'></i></a><a href=".base_url().'admin/sales/Sales/salesCommissionPaymentDelete/'.$item->commission_id."><i class='fa fa-trash-o'></i></a></div></td></tr>" ;
			
			$i++;
		}
	}else{
		$HTML.="<tr>No Data Found.</tr>";
	}
        echo $HTML;
	 
    }
	function receipt()
	 {
		$this->render_admin('_sales/receipt');
	 }
	 function paymentSchedule($salesid,$typeid)
	 {
		$data['sales']   = $result=$this->Sales_model->getPaymentSchedule($salesid);
		$data['emi']   = $this->Sales_model->getEmi($salesid);
		$data['currency']    =  $this->Sales_model->getCurrency();
		$moratorium_percentage=!empty($result->moratorium_per)?$result->moratorium_per:0;
	       if($moratorium_percentage !=0 && $result->moratorium !=0){
		    $moratorium_amount=(($result->total_cost/100)*$moratorium_percentage);
		    $principle=($result->total_cost -$moratorium_amount);
	      }
              if(!isset($moratorium_amount)){
						$principle=$result->total_cost;
				}
				//for moratorium payment schedule
				if($typeid ==1){
			
			   $principle=$result->total_cost-$principle;
			   $result_emi=$this->db->get_where('sales_emi',array('sale_id'=>$salesid,'type'=>1))->result();
		       $data['result_emi'] = $result_emi;
			   $data['amounts']=$emi=$this->calinterest($principle,$result->moratorium,0);
			   $data['emi_period']=$result->total_cost;
			   $data['loanamount']=$principle;
			   $data['interest_per']=0;
			   $data['monthly']=$emi['emi'];
			   $data['numberpayment']=round(($result->moratorium),2);
			   $data['totalinterest']=$emi['interest'];
			   $data['payment']=$principle;
			   $data['loanpercentage']=$moratorium_percentage;
			   $data['amounts1']=$emi=$this->calinterest($result->total_cost-$moratorium_amount,$result->emi_period,$result->emi_percentage);
	         }else{
		
			   $result_emi=$this->db->get_where('sales_emi',array('sale_id'=>$salesid,'type'=>2))->result();
			   $data['amounts']=$emi=$this->calinterest($principle,$result->emi_period,$result->emi_percentage);
		       $data['result_emi1'] = $result_emi;
			   $data['emi_period1']=$result->emi_period;
			   $data['loanamount1']=$result->total_cost-$moratorium_amount;
			   $data['interest_per1']=$result->emi_percentage;
			   $data['monthly1']=$emi['emi'];
			   $data['numberpayment1']=$result->emi_period;
			   $data['totalinterest1']=$emi['interest'];
			   $data['payment1']=$principle + $emi['interest'];
			   $data['loanpercentage1']=100-$moratorium_percentage;
			  
		      
	 }
		       $this->render_admin('_sales/paymentschedule',$data);
	 }
	 function calinterest($principalamount,$terms,$interestpercentage){
		 if($interestpercentage !=0){
           $intr =$interestpercentage/ 1200;
           $emi= round(($principalamount * $intr / (1 - (pow(1/(1 + $intr), $terms)))),4); 
           $totalinterest = round(((($principalamount * $intr / (1 - (pow(1/(1 + $intr), $terms))))*$terms)-$principalamount),4);
	      return array('emi'=>$emi,'interest'=>$totalinterest);
		 }else{
			 $emi=round(($principalamount/$terms),2);
			 return array('emi'=>$emi,'interest'=>0);
		 }
	}
	
	function saleCommissionPaymentedit($id){
		
		$this->form_validation->set_rules('amount', 'lang:amount', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['id']=$id;
			$data['page_title']		= lang('Sales_commissionEdit');
		    $data['salesCommission']			=	$salesCommission		= $this->Sales_model->getSalesCommission($id);
			$this->render_admin('_sales/salesCommisionEdit', $data);		
		}
		else
		{
			$Commisionid		     = $this->input->post('id');
			$save['commission_paid'] =$this->input->post('amount');
		    $save['paid_date']	    =$this->input->post('date');
		    $save['note']		    =$this->input->post('note');
			$this->Sales_model->salesCommisionEditSave($save,$Commisionid);
			if($id){
				$this->session->set_flashdata('message', lang('Payment_updated'));
			}
	         redirect('admin/sales/Sales/SalesCommission');
		}
	}
	
	function salesCommissionPaymentDelete($id){
			$this->db->where('commission_id',$id);
            $this->db->delete('sales_commission'); 
		    $this->session->set_flashdata('message', lang('Payment_details'));
		    redirect($_SERVER["HTTP_REFERER"]);
	}
	function salesCommissionPaymentReceipt($id){
		$data['page_title']		= lang('SalesCommissionReceipt');
		$data['settings']=$this->Sales_model->getSettings();
		$data['currency']    =  $this->Sales_model->getCurrency();
		$data['details']=$this->Sales_model->getSalesCommission($id);
	    $this->render_admin('_sales/commissionRecipt', $data);
	}
	
	 function calinterest1(){
		 $principalamount=69860;
		 $terms=204;
		 $interestpercentage=9;
         $intr =$interestpercentage/ 1200;
         $emi= round(($principalamount * $intr / (1 - (pow(1/(1 + $intr), $terms)))),2); 
        $totalinterest= round(((($principalamount * $intr / (1 - (pow(1/(1 + $intr), $terms))))*$terms) -$principalamount),2);
	    print_r( array('emi'=>$emi,'interest'=>$totalinterest));
	}
	  


function  paymentSchedulesummary($principle,$time,$Interestrate,$payment_date,$moratorium,$moratorium_percentage){
		
	if($moratorium_percentage !=0 && $moratorium !=0){
	     $moratorium_amount=(($principle/100)*$moratorium_percentage);
		  $moratorium_month_amt=($moratorium_amount/$moratorium);
		 $this->session->set_userdata('moratorium_month_amt',$moratorium_month_amt);
	}elseif($moratorium_percentage !=0){
		  $moratorium_amount=(($principle/100)*$moratorium_percentage);
		  $moratorium_month_amt=$moratorium_amount;
		  $this->session->set_userdata('moratorium_month_amt',$moratorium_month_amt);
	}
	
	if(!isset($moratorium_amount)){
		 $moratorium_amount=0;
	}
	///////////////////////////////////
	$decimal=!empty(get_setting()->decimals)?get_setting()->decimals:2;
	if($Interestrate !=0){
        $rate = $Interestrate/100/12;//interest percentage
        $x= pow(1+$rate,$time);
		    if($moratorium_percentage !=0 && $moratorium !=0){
			   $monthly = (($principle-$moratorium_amount) *$x*$rate)/($x-1);
		       }else{
                $monthly = ($principle*$x*$rate)/($x-1);
	           }
              $monthly = round(($monthly),2);
	        }else{
		     $monthly=round(($principle/$time),2);
	      }
		  if($moratorium_percentage !=0){
			 $principle=round(($principle-$moratorium_amount),3);
		  }else{
			  $principle=$principle;
		  }
		 
        $type=($Interestrate !=0)?1:2;
        $k= $time;
        $arr= array();
        $data=array();
        $date = "";
        $upto = $time;
        $i = 0;
        $totalint = 0;
        $tp =0;
        $this->session->set_userdata('i', $i);
        $this->session->set_userdata('upto', $upto);
        $this->session->set_userdata('totalint', $totalint);
        $this->session->set_userdata('rate', $rate);
        $this->session->set_userdata('monthly', $monthly);
        $this->session->set_userdata('tp', $tp);
        $this->session->set_userdata('type', $type);
		$this->session->set_userdata('moratoriumAmount',$moratorium_amount);
		$this->session->set_userdata('moratorium', $moratorium);
		$this->session->set_userdata('interest', $Interestrate);
		$this->session->set_userdata('decimal', $decimal);
        return $this->getEmi($principle,$data,$payment_date);
}

function getEmi($t,$data,$payment_date){
   $i=$this->session->userdata('i');
   $upto=$this->session->userdata('upto');	
   $totalint=$this->session->userdata('totalint');
   $rate=$this->session->userdata('rate');	
   $monthly=$this->session->userdata('monthly');		
   $tp=$this->session->userdata('tp');	
   $type=$this->session->userdata('type');	
   $moratorium_amount=$this->session->userdata('moratoriumAmount');	
   $moratorium=$this->session->userdata('moratorium');
   $interest=$this->session->userdata('interest');
   $decimal=$this->session->userdata('decimal');
  // moratorium 
    if($moratorium_amount !=0 && $moratorium !=0){
		    $moratorium_month_amt=$this->session->userdata('moratorium_month_amt');	
		    if($moratorium<=0){
               return 0;
              }
			     $moratorium_amount=$this->session->userdata('moratoriumAmount');	
	             $e=round(($moratorium_amount-$moratorium_month_amt),2);
	             $e=($e>0)?$e :0;
	             $this->session->set_userdata('moratoriumAmount', $e);
	             $moratorium--;
	             $this->session->set_userdata('moratorium', $moratorium);
	             $dates=Date("Y-m-d", strtotime("".$payment_date." +".$i." Month +0 Day"));
				 $i++;
				 $this->session->set_userdata('i', $i);
	             $data[]=array('id'=>$i,'date'=>$dates,'Beginning_Balance'=>$moratorium_amount,'Total_Payment'=>round(($moratorium_month_amt),2),'Principle'=>0,'Interest'=>0,'Ending_Balance'=>$e,'type'=>1);
	            if($moratorium >0){
					return  $this->getEmi($t,$data,$payment_date);
	            }else{
					if( $interest !=0 && $upto !=0){
				       return  $this->getEmi($t,$data,$payment_date);
					}else{
					   return $data;
					}
	              }
	    }
	//emi with interest
	
   if($type ==1){
       if($upto<=0){
        return 0;
        }
        $r = round(($t*$rate),3);
        $p = round(($monthly-$r),2);
        $e= round(($t-$p),2);
		$this->session->set_userdata('p', $p);
        if($upto==2){
	 	$this->session->set_userdata('tt', $t);
        }
       if($upto==1){
        $p= $this->session->userdata('p');	
        $e= round(($t-$p),2);
		$e=($e>0)?$e :0;
        }
        $totalint = $totalint + $r;
	    $this->session->set_userdata('totalint', $totalint);
        $tp = $tp+$monthly;
	    $this->session->set_userdata('tp', $tp);
        $upto--;
	    $this->session->set_userdata('upto', $upto);
	    $dates=Date("Y-m-d", strtotime("".$payment_date." +".$i." Month +0 Day"));
		$i++;
	    $this->session->set_userdata('i', $i);
	    $data[]=array('id'=>$i,'date'=>$dates,'Beginning_Balance'=>$t,'Total_Payment'=>$monthly,'Principle'=>$p,'Interest'=>$r,'Ending_Balance'=>$e,'type'=>2);
	    if($upto >0){
		 return  $this->getEmi($e,$data,$payment_date);
	    }else{
		return  $data;
	  }
   }
   //emi without interest
   else{
	    if($upto<=0){
        return 0;
    }
	 $e=round(($t-$monthly),2);
	 $e=($e>0)?$e :0;
	 $this->session->set_userdata('tt', $e);
	 $upto--;
	 $this->session->set_userdata('upto', $upto);
	 $dates=Date("Y-m-d", strtotime("".$payment_date." +".$i." Month +0 Day"));
	 $i++;
	 $this->session->set_userdata('i', $i);
	 $data[]=array('id'=>$i,'date'=>$dates,'Beginning_Balance'=>$t,'Total_Payment'=>$monthly,'Principle'=>0,'Interest'=>0,'Ending_Balance'=>$e,'type'=>2);
	if($upto >0){
		return  $this->getEmi($e,$data,$payment_date);
	}else{
		return  $data;
	}
	   
   }
}
	function get_contractno(){
		$clientid = $this->input->post('clientid');
		$query=$this->db->get_where('crm_customer',array('customer_id'=>$clientid))->row();
		echo $Contractnumber= !empty($query->contractNumber)? $query->contractNumber:0;
	}
	function get_amenities($ids)
	{
		$amenties = $this->db->select(" group_concat(`Name` separator ',') as `name`")->where_in('id', json_decode($ids))->get('amenties')->row();
		return $amenties;
	}
	function get_moratorium_emi_per_wise_amt(){
		 $moratorium_emi_percentage = $this->input->post('moratorium_emi_per');
		  $moratorium_amount_total = $this->input->post('moratorium_amt');
		 $moratorium_tenure = $this->input->post('moratorium_emi_per');
		 $date = $this->input->post('date');
	 	 $total_percentage=array_sum($moratorium_emi_percentage);
		 $without_percentage_amount=round((($moratorium_amount_total/100)*(100-$total_percentage)),2);
		 $without_percentage_tenure=(count($moratorium_emi_percentage)-count(array_filter($moratorium_emi_percentage)));
		 $this->session->set_userdata('moratoriumAmount',$moratorium_amount_total);
	      $i=0;
	  foreach($moratorium_emi_percentage as $emislab){
		if(!empty($emislab)){
			     $moratorium_amount=$this->session->userdata('moratoriumAmount');	
				 $moratorium_month_amt=round((($moratorium_amount_total/100)*$emislab),3);
	             $e=round(($moratorium_amount-$moratorium_month_amt),2);
	             $e=($e>0)?$e :0;
				 $this->session->set_userdata('moratoriumAmount', $e);
		         $dates=Date("Y-m-d", strtotime("".$date." +".$i." Month +0 Day"));
				 $i++;
				 $this->session->set_userdata('i', $i);
	             $emi[]=array('id'=>$i,'date'=>$dates,'Beginning_Balance'=>$moratorium_amount,'Total_Payment'=>round(($moratorium_month_amt),2),'Principle'=>0,'Interest'=>0,'Ending_Balance'=>$e,'type'=>1,'percentage'=>$emislab);
		}else{
			     $moratorium_amount=$this->session->userdata('moratoriumAmount');
				 $moratorium_month_amt=round(($without_percentage_amount/$without_percentage_tenure),2);
	             $e=round(($moratorium_amount-$moratorium_month_amt),2);
	             $e=($e>0)?$e :0;
				 $this->session->set_userdata('moratoriumAmount', $e);
		         $dates=Date("Y-m-d", strtotime("".$date." +".$i." Month +0 Day"));
				 $i++;
				 $this->session->set_userdata('i', $i);
	             $emi[]=array('id'=>$i,'date'=>$dates,'Beginning_Balance'=>$moratorium_amount,'Total_Payment'=>round(($moratorium_month_amt),2),'Principle'=>0,'Interest'=>0,'Ending_Balance'=>$e,'type'=>1,'percentage'=>'');
			
		}
	}
	    $data = array('emi' => $emi);
		echo json_encode($data); 
		
	}
	function contract_pdf(){
		$data['date']='ddd';
	    $this->render_admin('_sales/contract_pdf',$data); 
		 }
	function docsave(){
	  $data =$this->input->post('data');
      $fname = "test.pdf"; // name the file
      $file = fopen("/" .$fname, 'w'); // open the file path
      fwrite($file, $data); //save data
      fclose($file);
	  die;
	}
	function contract_save(){
		$sales_id=$this->input->post('sales_id');
			 if(!empty($_FILES['doc']['name'])){
                $config['upload_path'] = 'uploads/contract/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $_FILES['doc']['name'];
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('doc')){
                    $uploadData = $this->upload->data();
					$save['contact_id']=$this->input->post('contract_id');
					$save['sale_id']=$this->input->post('sales_id');
					$save['docpath']=$uploadData['file_name'];
					$this->Sales_model->save_contract($save);
                }
			 }
			  redirect('admin/sales/Sales/bookingViewDetail/'.$sales_id);
	}
	function booking(){
		$this->render_admin('_sales/bookingform');		
	}
	
}