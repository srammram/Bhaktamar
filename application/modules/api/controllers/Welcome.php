<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Welcome extends REST_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->api_model('drivers_api');
		$this->load->library('firebase');
		$this->load->library('push');
		$this->load->helper('string');
		$this->load->library('upload');
        $this->load->model("Complaint_model");
		$this->load->library('socketemitter');
	}
	
	public function index_get($id = false)
	{
		
		if($id){
			echo $id;
		}else{
			$this->load->view('welcome_message');
		}
	}
	function  register_post()
	{
		$this->form_validation->set_rules('Email','Email', 'required');
		$this->form_validation->set_rules('Mobile','mobilenumber', 'required');
		$this->form_validation->set_rules('Password','Password', 'required');	
		$this->form_validation->set_rules('Username','Username', 'required');	
		$this->form_validation->set_rules('IMEI','IMEI', 'required');	
		
		   if ($this->form_validation->run() == true) {
              $data=$this->Complaint_model->Guest_check($this->input->post('Email'),$this->input->post('Mobile'),$this->input->post('Password'));
			    if($data == TRUE){
					if($data->Is_registerd ==1)
					{
							$result = array( 'status'=> false , 'message'=> 'User Already Registered');
					}else{
					$updatedata=$this->Complaint_model->Update_guest_password($this->input->post('Password'),$data->id,$this->input->post('IMEI'));
					 if($updatedata == TRUE){ 
					 $result = array( 'status'=> true , 'message'=> 'Registered Success');  }
					 else{  
					 	$result = array( 'status'=> false , 'message'=> 'Please Try Again');
					 }
					}
				}else{
					$result = array( 'status'=> false , 'message'=> 'Invalid User Data');
				}

	          }else{
			$result = array( 'status'=> false , 'message'=> 'Please Enter All Fields');
		   }
		
		$this->response($result);
	
}  
	
function login_post(){
	    $this->form_validation->set_rules('Username','Username', 'required');
		$this->form_validation->set_rules('Password','Password', 'required');
		if ($this->form_validation->run() == true) {
			   $data=$this->Complaint_model->CHeck_guest_user($this->input->post('Username'));
			   if($data == TRUE){
				     $guestdata=$this->Complaint_model->Guestlogincheck($this->input->post('Username'),$this->input->post('Password'));
					 if($guestdata == true){
						  $result = array( 'status'=> true , 'data'=> $guestdata);
					 }else{
						 $result = array( 'status'=> false , 'message'=> 'Invalid Password');
					 }
			 }else{
				 $result = array( 'status'=> false , 'message'=> 'Invalid Username');
			 }
			
		  }else{
			$result = array( 'status'=> false , 'message'=> 'Please Enter All Fields');
		   }
		   $this->response($result);
}
function dashboardlist_post(){
	$this->form_validation->set_rules('guestid','guestid', 'required');
	 if ($this->form_validation->run() == true) {
	 $Services=$this->Complaint_model->get_services();
	 $Amenities=$this->Complaint_model->Get_amenities();
	  if($Services == TRUE){
		   $result = array( 'status'=> true , 'message'=> 'Data Found','data'=>array('services'=>array('Name'=>'Services','id'=>2),'Amenities'=>array('Name'=>'Amenities','id'=>1),'Others'=>array('Name'=>'Others','id'=>3)));
	  }else{
		   $result = array( 'status'=> false , 'message'=> 'Data Not found');
	  }
	   }else{
		 
		 $result = array( 'status'=> false , 'message'=> 'Guest Id Missing');
	 }
	 $this->response($result);
}
function serviceslist_post(){
	$this->form_validation->set_rules('guestid','guestid', 'required');
	$this->form_validation->set_rules('servicesid','servicesid', 'required');
	 if ($this->form_validation->run() == true) {
		 $id=$this->input->post('servicesid');
		 switch ($id){
			 case 1:
			  $Services=$this->Complaint_model->get_services();
			  $result = array( 'status'=> true , 'data'=> $Services);
			 break;
			 case 2:
			      $Amenities=$this->Complaint_model->Get_amenities();
				  $result = array( 'status'=> true , 'message'=> $Amenities);
			 break;
			 case 3:
			 $data=array('data'=>'Not Found');
		       	 $result = array( 'status'=> true , 'message'=> $data);  
			 break;
			 
		 }
	 }else{    
	          $result = array('status'=> false ,'message'=>'Parameneter In validate');
	 }
	 $this->response($result);
}
function Complaintlist_post(){
	
	 $this->form_validation->set_rules('Guestid','Guestid', 'required');
	 if ($this->form_validation->run() == true) {
		 
	                 $complaint=$this->Complaint_model->get_complaint($this->input->post('Guestid'));
	                if($complaint == TRUE){
		             $result = array( 'status'=> true , 'message'=> 'Data Found','complaint'=>$complaint);
	                     }else{
		            $result = array( 'status'=> false , 'message'=> 'Data Not found');
	              }
	 }else{
		 
		 $result = array( 'status'=> false , 'message'=> 'Guest Id Missing');
	 }
	  $this->response($result);
}
function Notification_post(){
	
	 $this->form_validation->set_rules('Guestid','Guestid', 'required');
	 if ($this->form_validation->run() == true) {
		 
	                 $complaint=$this->Complaint_model->get_complaint($this->input->post('Guestid'));
	                if($complaint == TRUE){
		             $result = array( 'status'=> true , 'message'=> 'Data Found','complaint'=>$complaint);
	                     }else{
		            $result = array( 'status'=> false , 'message'=> 'Data Not found');
	              }
	 }else{
		 $result = array( 'status'=> false , 'message'=> 'Guest Id Missing');
	 }
	  $this->response($result);
}
function Complaint_post(){
      	$this->form_validation->set_rules('Guestid','Guestid', 'required');
	    $this->form_validation->set_rules('Title','Title', 'required');
		$this->form_validation->set_rules('Description','Description', 'required');
		$this->form_validation->set_rules('Complianttype','Complianttype', 'required');
		$this->form_validation->set_rules('Categorytype','Categorytype', 'required');
		$this->form_validation->set_rules('Date','Date', 'required');
		$this->form_validation->set_rules('fromtime','fromtime', 'required');
		$this->form_validation->set_rules('totime','totime', 'required');
		if ($this->form_validation->run() == true) {
			$data=array('c_title'=>$this->input->post('Title'),'c_description'=>$this->input->post('Description'),
			'c_date'=>$this->input->post('Date'),'Complaint_type'=>$this->input->post('Complianttype'),
			'Type_category'=>$this->input->post('Categorytype'),'ServicesFromtime'=>$this->input->post('fromtime'),'servicesTotime'=>$this->input->post('totime'),'Guest_id'=>$this->input->post('Guestid'));
			 $complaint=$this->Complaint_model->Complaint_booking($data);
			  if($complaint == true){
				  $result = array( 'status'=> true , 'message'=> 'Complaint Booked ');
			  }else{
				  $result = array( 'status'=> false , 'message'=> 'Please Try Again');
			  }
		}else{
			 $result = array( 'status'=> false , 'message'=> 'Guest Id Missing');
		}
	 $this->response($result);
}
function ReviewedFrom_post(){
	    $this->form_validation->set_rules('Reviewstatus','reviewstatus', 'required');
	    $this->form_validation->set_rules('description','description', 'required');
		$this->form_validation->set_rules('isinitiated','isinitiated', 'required');
		$this->form_validation->set_rules('Complaint_id','Complaintid', 'required');
	 if ($this->form_validation->run() == true) {
			 $data=array('Review'=>$this->input->post('Reviewstatus'),'Reviewdescription'=>$this->input->post('description'),
			'initiated_request'=>$this->input->post('isinitiated'));
			 $complaint=$this->Complaint_model->ReviewUpdate($data,$this->input->post('Complaint_id'));
			  if($complaint == true){
				  $result = array( 'status'=> true , 'message'=> 'Review Success');
			  }else{
				  $result = array( 'status'=> false , 'message'=> 'Please Try Again');
			  }
		}else{
			 $result = array( 'status'=> false , 'message'=> 'Invalid Parameter');
		}
	 $this->response($result);
}
}