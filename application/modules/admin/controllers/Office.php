<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Office extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
    	$this->load->model(array('Office_model'));
		$this->load->library('form_validation');
	    $this->load->model(array('guest_model','location_model','Owner_model','LeaseOwner_Model'));
	    $this->load->library("pagination");
		$this->load->helper("url");
	}
	function index() {
		  $data['page_title']	=	lang('dashboard');
		 /*  $data['totalowner']=$this->Office_model->TotalOwner();
		  $data['Undetconstruction']=$this->get_count(11,1);
		  $data['Complete']=$this->get_count(11,4);
		  $data['OwnerDelivered']=$this->get_count(11,5);
		  $data['Ownerpaid']=$this->get_count(11,6);
		  $data['Ownerunpaid']=$this->get_count(11,7);
		  $data['hotellauc']=$this->get_count(12,1);
		  $data['hotelcom']=$this->get_count(12,4);
		  $data['hotelinbusi']=$this->get_count(12,8);
		  $data['hotel_avail']=$this->get_count(12,9);
		  $data['hotel_hired']=$this->get_count(12,10);
		  $data['leaseuc']=$this->get_count(13,1);
		  $data['leasecom']=$this->get_count(13,4);
		  $data['leaseinbusi']=$this->get_count(13,8);
		  $data['lease_avai']=$this->get_count(13,9);
		  $data['leasehired']=$this->get_count(13,10);
		  $data['OwnerComplete_unit']=$this->get_units(11,4);
		  $data['OwnerUnder_unit']=$this->get_units(11,1);
		  $data['OwnerDelivered_unit']=$this->get_units(11,5);
		  $data['Ownerpaid_unit']=$this->get_units(11,6);
		  $data['Ownerunpaid_unit']=$this->get_units(11,7);
		  
		  $data['HotelComplete_unit']=$this->get_units(12,4);
		  $data['HotelUnder_unit']=$this->get_units(12,1);
		  $data['HotelBusiness_unit']=$this->get_units(12,8);
		  $data['HotelAvail_unit']=$this->get_units(12,9);
		  $data['HotelHIred_unit']=$this->get_units(12,10);
		  
		  $data['LeaseComplete_unit']=$this->get_units(13,4);
		  $data['LeaseUnder_unit']=$this->get_units(13,1);
		  $data['LeaseBusiness_unit']=$this->get_units(13,8);
		  $data['LeaseAvail_unit']=$this->get_units(13,9);
		  $data['LeaseHIred_unit']=$this->get_units(13,10); */
	      //$this->render_admin('Office/dashboard',$data);
		  
		   $data['complaint']=$this->Office_model->get_all_count_complaint();
		 
	       $this->load->view('template/header',$data);
		//$this->load->view('template/sidebar',$data);
		$this->load->view('Office/dashboard',$data);
		$this->load->view('template/footer',$data);
	}	
	function Parking() {
		  $data['page_title']	=	lang('dashboard');
		  $data['Slot']=$this->Office_model->get_slot_details();
		 
	      $this->render_admin('dashboard/Parking_monit',$data);
	}	
	function lists() {
		  $data['page_title']	=	lang('Bookinglist');
		  $data['table']=$this->Office_model->bookinglist();
	      $this->render_admin('Office/list',$data);
	}
	
	function Checkout() {
		  $data['page_title']	=	lang('Checkout');
		  $data['table']=$this->Office_model->bookingCheckoutlist();
	      $this->render_admin('Office/Checkout',$data);
	}
	function Checkin() {
		  $data['page_title']	=	lang('Checkin');
		  $data['table']=$this->Office_model->bookingCheckinlist();
	      $this->render_admin('Office/Check_in',$data);
	}
    function Client() {
	  $data['page_title']	=	lang('dashboard');
	  $this->render_admin('Office/dashboard',$data);	
    }
	function Booking($id= false){
		$data['id']='';
		$data['units']		      	=	$units	    	= $this->Owner_model->GetOwnerUnits();
		$data['OwnerType']			=	$OwnerType		= $this->Owner_model->Get_ownerType();
		$data['leaseowner']			=	$leaseowner		= $this->Office_model->Get_leaseOwner();
		$data['leaseunits']			=	$leaseunits		= $this->Office_model->Get_leaseunits();
		$data['country']=$this->Office_model->country_load();
		$data['page_title']	=	'';
		$data['unittype']=$this->Office_model->Unittype();
		$data['Slot']=$this->Office_model->get_Slot();
		$this->render_admin('Office/Booking_form',$data);	
	}
	function Edit($id){
		$data['id']=$id;
		$data['country']=$this->Office_model->country_load();
		$data['unittype']=$this->Office_model->Unittype();
		$data['Slot']=$this->Office_model->get_Slot();
		$booking_details=$this->Office_model->Get_booking_details($id);
		$data['BookingDetails']=$booking_details;
		$data['getunit']=$this->Office_model->Get_booking_unit($id);
		$data['Guest']=$this->Office_model->Get_Booked_guest($booking_details->Guest_id);
		$data['allunit']=$this->Office_model->all_unit();
		$data['Vechiles']=$this->Office_model->Get_Vechile($id);
		$data['Persons']=$this->Office_model->Get_Person($id);
		$data['Payment']=$this->Office_model->Get_Payment($id);
		$data['Guestlists']=$this->Office_model->get_guest();
		$this->render_admin('Office/Bookings_edit',$data);	
	}
	function View($id){
		$data['id']=$id;
		$data['country']=$this->Office_model->country_load();
		$data['unittype']=$this->Office_model->Unittype();
		$data['Slot']=$this->Office_model->get_Slot();
		$booking_details=$this->Office_model->Get_booking_details($id);
		$data['BookingDetails']=$booking_details;
		$data['getunit']=$this->Office_model->Get_booking_unit($id);
		$data['Guest']=$this->Office_model->Get_Booked_guest($booking_details->Guest_id);
		$data['allunit']=$this->Office_model->all_unit();
		$data['Vechiles']=$this->Office_model->Get_Vechile($id);
		$data['Persons']=$this->Office_model->Get_Person($id);
		$data['Payment']=$this->Office_model->Get_Payment($id);
		$data['Guestlists']=$this->Office_model->get_guest();
		$this->render_admin('Office/Bookings_View',$data);	
	}
	function booking_save(){
		$this->form_validation->set_rules('Booking_type', lang("Booking_Type"), 'required');
		$this->form_validation->set_rules('check_in_date', lang("Check_in"), 'required');
		$this->form_validation->set_rules('night', lang("Nights"), 'required');
		$this->form_validation->set_rules('number_of_adult', lang("Number_Of_Adults"), 'required');
		$this->form_validation->set_rules('number_of_Units', lang("Number_Of_Units"), 'required');
		$this->form_validation->set_rules('Booking_status', lang("Booking_status"), 'required');

			if ($this->form_validation->run() == true) {
               $reservation_array = []; 
			   $reservation_adult_array = []; 
			   $reservation_child_array = []; 
			   $reservation_rooms_array = [];
			   $reservation_guest = [];
			   $reservation_customer = [];
			   $reservation_payment_array = [];
			   $reservation_traiff = [];
			   $reservation_vehicle_array = [];	
           if($this->input->post('Booking_status') == 'conform'){
				$closing_status  = 'checkin';
			}elseif($this->input->post('Booking_status') == 'pending'){
				$closing_status  = 'process';
			}else{
				$closing_status = '';
			}			
               $reservation_array = array(
				'reservation_number' => 'RES'.date('YmdHis'),
				'check_in' => $this->input->post('check_in_date').' '.$this->input->post('check_in_hour').':'.$this->input->post('check_in_min').':00',
				'check_out' => $this->input->post('check_out_date').' '.$this->input->post('check_out_hour').':'.$this->input->post('check_out_min').':00',
				'night' => $this->input->post('night'),
				'grace_time' => $this->input->post('grace_time'),
				'number_of_adult' => $this->input->post('number_of_adult'),
				'number_of_child' => $this->input->post('number_of_child'),
				'number_of_rooms' => $this->input->post('number_of_Units'),
				'reservation_status' => $this->input->post('Booking_status'),
				'reservation_reason' => $this->input->post('Booking_reason'),
				'reservation_type' => $this->input->post('Booking_type'),
				'description' => $this->input->post('description'),
				'reservation_closing_status' => $closing_status,
				'is_active' => 1,
				'TotalPayable'=>$this->input->post('totalpayable'),
				'Advance_traiff'=>$this->input->post('advancetraiff'), 
				'Totalpaying' =>$this->input->post('total_paying'), 
				'Balance'=>$this->input->post('balance'),
				'GuestType'=>$this->input->post('guest_type'),
				'GuestMode'=>$this->input->post('guest_mode'),
				'is_create' => date('Y-m-d H:i:s'),
			);	
			$booked_id=$this->Office_model->Booking_Units($reservation_array);
			
			if($this->input->post('number_of_adult') != 0){
				for($i=0; $i<$this->input->post('number_of_adult'); $i++){
					$reservation_adult_array[] = array(
					    'Booked_id'=>$booked_id,
						'First_name' => $_POST['adult_name'][$i],
						'Age' => $_POST['adult_age'][$i],
						'DOB' => $_POST['adult_birth'][$i],
						'Gender' => $_POST['adult_gender'][$i],
						
						'Idproof' => $_POST['adult_id_proof'][$i],
						'Idnumber' => $_POST['adult_id_number'][$i],
						'Created_on' => date('Y-m-d H:i:s'),
					); 
				}
			}
			if($this->input->post('guest_mode') == 'New'){	
				$reservation_customer = array(
					'firstname' => $this->input->post('first_name'),
					'lastname' => $this->input->post('last_name'),
					'email' => $this->input->post('email_address'),
					'mobile' => $this->input->post('phone_number'),
					'country_id' => $this->input->post('country_id'),
					'address' => $this->input->post('address'),
					'id_type' => $this->input->post('id_proof'),
					'id_no' => $this->input->post('id_number'),
					'is_active' => 1,
					'Created_on' => date('Y-m-d H:i:s'),
				);
				$customer = 0;
			}else{
				$reservation_customer = array(
					'firstname' => $this->input->post('first_name'),
					'lastname' => $this->input->post('last_name'),
					'email' => $this->input->post('email_address'),
					'mobile' => $this->input->post('phone_number'),
					'country_id' => $this->input->post('country_id'),
					'address' => $this->input->post('address'),
					'id_type' => $this->input->post('id_proof'),
					'id_no' => $this->input->post('id_number'),
					'Is_Updated' => date('Y-m-d H:i:s'),
				);
				$customer = $this->input->post('customer_id');
			}
		     $guest_id=$this->Office_model->Booking_guest($reservation_customer,$customer);
			 if($this->input->post('number_of_Units') != 0){
				
				for($k=0; $k<$this->input->post('number_of_Units'); $k++){
					$reservation_rooms_array[] = array(
					'Booking_id'=>$booked_id,
						'Unit_type' =>$_POST['unittype'][$k],
						'Unit_name' =>$_POST['unit_id'][$k],
						'Price' => $_POST['price'][$k],
						'ExtraBeds' => $_POST['extrabeds'][$k],
						'Extra_price' => $_POST['extra_price'][$k],
						'check_in' => $this->input->post('check_in_date').' '.$this->input->post('check_in_hour').':'.$this->input->post('check_in_min').':00',
						'check_out' => $this->input->post('check_out_date').' '.$this->input->post('check_out_hour').':'.$this->input->post('check_out_min').':00',
						'grace_time' => $this->input->post('grace_time'),
						'room_status' => $closing_status,
						'Created_on' => date('Y-m-d H:i:s'),
					); 
				}
			} 
		
			if(!empty($this->input->post('Slotno'))){
				for($i=0; $i<count($this->input->post('Slotno')); $i++){
					
					$reservation_vehicle_array[] = array(
					    'Booked_id'=>$booked_id,
						'Slot_id' =>$_POST['Slotno'][$i],
						'Vechilenumber' =>$_POST['vechileno'][$i],
						'arrival' => $this->input->post('check_in_date').' '.$_POST['vehicle_hour_arrival'][$i].':'.$_POST['vehicle_min_arrival'][$i].':00',
						'departure' => $this->input->post('check_in_date').' '.$_POST['vehicle_hour_depart'][$i].':'.$_POST['vehicle_min_depart'][$i].':00',
						'Is_parked' =>1,
						'is_create' => date('Y-m-d H:i:s'),
					); 
				}
			} 	
 if(isset($_POST['paid_by'])){
	for($i=0; $i<count($_POST['paid_by']); $i++){
           if($_POST['paid_by'][$i]==lang('cash') ||$_POST['paid_by'][$i]==lang('Others')){
        $reservation_payment_array[]=array(
		'Booked_id'=>$booked_id,
		'Guest_id'=>$guest_id,
		'Payingby'=>$_POST['paid_by'][$i],
		'Amount'=>$_POST['amount'][$i],
		'CurrencyType'=>$_POST['currency_id'][$i],
		'Created_on'=>date('Y-m-d H:i:s'));
}
else
{
	   $reservation_payment_array[]=array(
		'Booked_id'=>$booked_id,
		'Guest_id'=>$guest_id,
		'Payingby'=>$_POST['paid_by'][$i],
		'Amount'=>$_POST['amount'][$i],
		'CurrencyType'=>$_POST['currency_id'][$i],
		'Card_number'=>$_POST['cc_no'][$i],
		'Holdername'=>$_POST['cc_holer'][$i],
		'Cardtype'=>$_POST['cc_type'][$i],
		'Month'=>$_POST['cc_month'][$i],
		'Year'=>$_POST['cc_year'][$i],
		'cvv'=>$_POST['cc_cvv2'][$i],
		'Created_on'=>date('Y-m-d H:i:s'));
	
} 
}
}
}

if ($this->form_validation->run() == true && $this->Office_model->EditReservationsave($reservation_array, $reservation_adult_array, $reservation_child_array, $reservation_rooms_array, $reservation_guest, $reservation_customer, $reservation_payment_array, $reservation_traiff, $reservation_vehicle_array, $customer,$booked_id,$guest_id)) {
			
			
            $this->session->set_flashdata('message', lang("reservation_added"));
            redirect('admin/Office/lists');
        } else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('Office/Booking');
		}
}
	
	function unit_load_ajax(){
		 $Result=$this->Office_model->get_Owner_unit();
		 $unittype=$this->input->post('unittype');
	     $Owner_unit=array();
	   foreach($Result as $result) {
		  $Owner_unit[]=json_decode( $result->Owner_unit);
	   }
	   $units = array();
	   foreach($Owner_unit as $array) {
       foreach($array as $k=>$v) {
               $units[] = $v;
          }
        }
        $results= $this->Office_model->Get_Unit_group($units,$unittype);
		$option='';
		foreach($results as $result){
			$option .="<option value=".$result->uid.">".$result->unit_no."</option>";
			}
		echo $option;
	}
	function Get_guest_list(){
	$results= $this->Office_model->get_guest();
	$option='<option>Select</option>';
		foreach($results as $result){
			$option .="<option value=".$result->id.">".$result->firstname."</option>";
		}
		echo $option;
	}
	function Get_guest(){
		$Guest_id=$this->input->post('guest_id');
	    $result= $this->Office_model->get_guest_details($Guest_id);
		echo json_encode($result);
	
	}
	function booking_edit_save()
	{
		$this->form_validation->set_rules('Booking_type', lang("Booking_Type"), 'required');
		$this->form_validation->set_rules('check_in_date', lang("Check_in"), 'required');
		$this->form_validation->set_rules('night', lang("Nights"), 'required');
		$this->form_validation->set_rules('number_of_adult', lang("Number_Of_Adults"), 'required');
		$this->form_validation->set_rules('number_of_Units', lang("Number_Of_Units"), 'required');
		$this->form_validation->set_rules('Booking_status', lang("Booking_status"), 'required');

			if ($this->form_validation->run() == true) {
               $reservation_array = []; 
			   $reservation_adult_array = []; 
			   $reservation_child_array = []; 
			   $reservation_rooms_array = [];
			   $reservation_guest = [];
			   $reservation_customer = [];
			   $reservation_payment_array = [];
			   $reservation_traiff = [];
			   $reservation_vehicle_array = [];	
           if($this->input->post('Booking_status') == 'conform'){
				$closing_status  = 'checkin';
			}elseif($this->input->post('Booking_status') == 'pending'){
				$closing_status  = 'process';
			}else{
				$closing_status = '';
			}	
			
if($this->input->post('Booking_mode') == lang('Checkins')){
				$ischecked  = 1;
			}	else{
				$ischecked  = 0;
				
			}		
			$booking_id=$this->input->post('bookid');
               $reservation_array = array(
			   'Booking_mode'=>$this->input->post('Booking_mode'),
				'reservation_type'=>$this->input->post('Booking_type'),
				'check_in' => $this->input->post('check_in_date').' '.$this->input->post('check_in_hour').':'.$this->input->post('check_in_min').':00',
				'check_out' => $this->input->post('check_out_date').' '.$this->input->post('check_out_hour').':'.$this->input->post('check_out_min').':00',
				'night' => $this->input->post('night'),
				'grace_time' => $this->input->post('grace_time'),
				'number_of_adult' => $this->input->post('number_of_adult'),
				'number_of_child' => $this->input->post('number_of_child'),
				'number_of_rooms' => $this->input->post('number_of_Units'),
				'reservation_status' => $this->input->post('Booking_status'),
				'reservation_reason' => $this->input->post('Booking_reason'),
				'reservation_type' => $this->input->post('Booking_type'),
				'Booking_mode'=> $this->input->post('Booking_mode'),
				'description' => $this->input->post('description'),
				'reservation_closing_status' => $closing_status,
				'is_active' => 1,
				'TotalPayable'=>$this->input->post('totalpayable'),
				'Advance_traiff'=>$this->input->post('advancetraiff'), 
				'Totalpaying' =>$this->input->post('total_paying'), 
				'Balance'=>$this->input->post('balance'),
				'GuestType'=>$this->input->post('guest_type'),
				'GuestMode'=>$this->input->post('guest_mode'),
				'IS_checkin'=>$ischecked,
				'is_update' => date('Y-m-d H:i:s'),
			);	
			$booked_id=$this->Office_model->Booking_details_edit($reservation_array,$booking_id);
			
			if($this->input->post('number_of_adult') != 0){
				for($i=0; $i<$this->input->post('number_of_adult'); $i++){
					$reservation_adult_array[] = array(
					    'Booked_id'=>$booked_id,
						'First_name' => $_POST['adult_name'][$i],
						'Age' => $_POST['adult_age'][$i],
						'DOB' => $_POST['adult_birth'][$i],
						'Gender' => $_POST['adult_gender'][$i],
						'Idproof' => $_POST['adult_id_proof'][$i],
						'Idnumber' => $_POST['adult_id_number'][$i],
						'Created_on' => date('Y-m-d H:i:s'),
					); 
				}
			}
			if($this->input->post('guest_mode') == 'New'){	
				$reservation_customer = array(
					'firstname' => $this->input->post('first_name'),
					'lastname' => $this->input->post('last_name'),
					'email' => $this->input->post('email_address'),
					'mobile' => $this->input->post('phone_number'),
					'country_id' => $this->input->post('country_id'),
					'address' => $this->input->post('address'),
					'id_type' => $this->input->post('id_proof'),
					'id_no' => $this->input->post('id_number'),
					'is_active' => 1,
					'Created_on' => date('Y-m-d H:i:s'),
				);
				$customer = 0;
			}else{
				$reservation_customer = array(
					'firstname' => $this->input->post('first_name'),
					'lastname' => $this->input->post('last_name'),
					'email' => $this->input->post('email_address'),
					'mobile' => $this->input->post('phone_number'),
					'country_id' => $this->input->post('country_id'),
					'address' => $this->input->post('address'),
					'id_type' => $this->input->post('id_proof'),
					'id_no' => $this->input->post('id_number'),
					'Is_Updated' => date('Y-m-d H:i:s'),
				);
				$customer = $this->input->post('customer_id');
			}
		     $guest_id=$this->Office_model->Booking_guest($reservation_customer,$customer);
			 if($this->input->post('number_of_Units') != 0){
				
				for($k=0; $k<$this->input->post('number_of_Units'); $k++){
					$reservation_rooms_array[] = array(
					'Booking_id'=>$booked_id,
						'Unit_type' =>$_POST['unittype'][$k],
						'Unit_name' =>$_POST['unit_id'][$k],
						'Price' => $_POST['price'][$k],
						'ExtraBeds' => $_POST['extrabeds'][$k],
						'Extra_price' => $_POST['extra_price'][$k],
						'check_in' => $this->input->post('check_in_date').' '.$this->input->post('check_in_hour').':'.$this->input->post('check_in_min').':00',
						'check_out' => $this->input->post('check_out_date').' '.$this->input->post('check_out_hour').':'.$this->input->post('check_out_min').':00',
						'grace_time' => $this->input->post('grace_time'),
						'room_status' => $closing_status,
						'Created_on' => date('Y-m-d H:i:s'),
					); 
				}
			} 
		
			if(!empty($this->input->post('Slotno'))){
				for($i=0; $i<count($this->input->post('Slotno')); $i++){
					
					$reservation_vehicle_array[] = array(
					    'Booked_id'=>$booked_id,
						'Slot_id' =>$_POST['Slotno'][$i],
						'Vechilenumber' =>$_POST['vechileno'][$i],
						'arrival' => $this->input->post('check_in_date').' '.$_POST['vehicle_hour_arrival'][$i].':'.$_POST['vehicle_min_arrival'][$i].':00',
						'departure' => $this->input->post('check_in_date').' '.$_POST['vehicle_hour_depart'][$i].':'.$_POST['vehicle_min_depart'][$i].':00',
						'Is_parked' =>1,
						'is_create' => date('Y-m-d H:i:s'),
					); 
				}
			} 	
 if(isset($_POST['paid_by'])){
	for($i=0; $i<count($_POST['paid_by']); $i++){
           if($_POST['paid_by'][$i]==lang('cash') ||$_POST['paid_by'][$i]==lang('Others')){
        $reservation_payment_array[]=array(
		'Booked_id'=>$booked_id,
		'Guest_id'=>$guest_id,
		'Payingby'=>$_POST['paid_by'][$i],
		'Amount'=>$_POST['amount'][$i],
		'CurrencyType'=>$_POST['currency_id'][$i],
		'Created_on'=>date('Y-m-d H:i:s'));
}
else
{
	   $reservation_payment_array[]=array(
		'Booked_id'=>$booked_id,
		'Guest_id'=>$guest_id,
		'Payingby'=>$_POST['paid_by'][$i],
		'Amount'=>$_POST['amount'][$i],
		'CurrencyType'=>$_POST['currency_id'][$i],
		'Card_number'=>$_POST['cc_no'][$i],
		'Holdername'=>$_POST['cc_holer'][$i],
		'Cardtype'=>$_POST['cc_type'][$i],
		'Month'=>$_POST['cc_month'][$i],
		'Year'=>$_POST['cc_year'][$i],
		'cvv'=>$_POST['cc_cvv2'][$i],
		'Created_on'=>date('Y-m-d H:i:s'));
	
} 
}
}
}

if ($this->form_validation->run() == true && $this->Office_model->addReservationsave($reservation_array, $reservation_adult_array, $reservation_child_array, $reservation_rooms_array, $reservation_guest, $reservation_customer, $reservation_payment_array, $reservation_traiff, $reservation_vehicle_array, $customer,$booked_id,$guest_id)) {
			
			if($this->input->post('Booking_mode') == lang('Checkins')){
				$this->session->set_flashdata('message', lang("Checkin_success"));
			}else{
				  $this->session->set_flashdata('message', lang("reservation_edit"));
			}
          
			
            redirect('admin/Office/lists');
        } else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('Office/Booking');
		} 


		
	}
	 function get_count($Ownertype,$type)
   {
	   $Result=$this->Office_model->get_Owner_units($Ownertype);
	   $Owner_unit=array();
	   foreach($Result as $result) {
		  $Owner_unit[]=json_decode($result->Owner_unit);
	   }
	   $units = array();
	   foreach($Owner_unit as $array) {
       foreach($array as $k=>$v) {
               $units[] = $v;
          }
        }
	  return $count= count($this->Office_model->Get_Unit_groups($units,$type));
   }
   
    function get_units($Ownertype,$type)
   {
	   $Result=$this->Office_model->get_Owner_units($Ownertype);
	   $Owner_unit=array();
	   foreach($Result as $result) {
		  $Owner_unit[]=json_decode($result->Owner_unit);
	   }
	   $units = array();
	   foreach($Owner_unit as $array) {
       foreach($array as $k=>$v) {
               $units[] = $v;
          }
        }
	  $result=$this->Office_model->Get_Unit_groups($units,$type);
	  return $result ;
   }
   function delete($id = false)
	{
		if ($id)
		{	
			$booking	= $this->Office_model->Get_booking($id);
			if (!$booking)
			{
				$this->session->set_flashdata('error', lang('Booking_Not_found'));
				redirect('admin/Office/lists');
			}
			else
			{
				$delete	= $this->Office_model->delete($id);
				$this->session->set_flashdata('message', lang('Booking_Delete'));
				redirect('admin/Office/lists');
			}
		}
		else
		{
			$this->session->set_flashdata('error', lang('Booking_Not_found'));
				redirect('admin/Office/lists');
		}
	}
	function Unit_Details($id)
	{
		$this->load->model("Unit_model");
		$admin = $this->session->userdata('admin');
		$data['unit']			=	$unit		= $this->Unit_model->get($id);
		$data['page_title']	= lang('view')." ".lang('Units') ;
		$data['Amenities']			= $this->Unit_model->get_amenities();
		$data['complaint']=$this->Office_model->Unitwise_complaint($id);
		$this->render_admin('dashboard/Unit_view', $data);
		
		
	}
	function checkout_booking($id)
	{
		$ischecked=$this->Office_model->Ischeckedout($id);
		
		if($ischecked){
		
			$units=$this->Office_model->Get_booked_units($id);
			if($units){
				$release=$this->Office_model->Release_unit($units);
				if($release){
					$slot=$this->Office_model->Get_Assigned_slot($id);
					 if($slot){
						 $slotRelease=$this->Office_model->Release_slot($slot);
						 if($slotRelease){
							  $this->session->set_flashdata('message', lang("Checkout_success"));
							  redirect('admin/Office/Checkout');
						 }else{
							 $this->session->set_flashdata('message', lang("Billing_Amount_not_Closed"));
							redirect('admin/Office/Checkout');
						 }
					 }
				}
			}
		}else{
			 $this->session->set_flashdata('message', lang("Billing_Amount_not_Closed"));
						  redirect('admin/Office/Checkout');
		}
	}
	
	function cancel_booking($id)
	{
		$iscancelled=$this->Office_model->Iscancelled($id);
		
		if($iscancelled){
				 $this->session->set_flashdata('message', lang("Bookingcancelled"));
				 redirect('admin/Office/Checkin');
			}
		else{
			       $this->session->set_flashdata('message', lang("UnableBookingcancelled"));
				   redirect('admin/Office/Checkin');
		}
	}
	
	
	function bookingleaseunits(){
		
		$this->form_validation->set_rules('leaseBooking_mode', lang("Booking_mode"), 'required');
		$this->form_validation->set_rules('leaseBooking_type', lang("Booking_Type"), 'required');
		$this->form_validation->set_rules('Leasetype', lang("LeaseType"), 'required');
		$this->form_validation->set_rules('Leasecheck_in_date', lang("Check_in"), 'required');
		$this->form_validation->set_rules('leasecheck_out_date', lang("Check_Out"), 'required');
		$this->form_validation->set_rules('Leaseunit', lang("Unit"), 'required');

			if ($this->form_validation->run() == true) {
               $reservation_array = []; 
			   $reservation_Owner = [];
			   $reservation_payment_array = [];
			 
           if($this->input->post('Booking_status') == lang('conform') ){
				$closing_status  = 'checkin';
			}elseif($this->input->post('Booking_status') == lang('Pending')){
				$closing_status  = 'process';
			}else{
				$closing_status = '';
			}			
			
               $reservation_array = array(
				'reservation_number' => 'RES'.date('YmdHis'),
				'check_in' => $this->input->post('Leasecheck_in_date').' '.$this->input->post('Leasecheck_in_hour').':'.$this->input->post('Leasecheck_in_min').':00',
				'check_out' => $this->input->post('leasecheck_out_date').' '.$this->input->post('leasecheck_out_hour').':'.$this->input->post('leasecheck_out_min').':00',
				'grace_time' => $this->input->post('leasegrace_time'),
				'reservation_status' => $this->input->post('leaseBooking_status'),
				'reservation_reason' => $this->input->post('leaseBooking_reason'),
				'reservation_type' => $this->input->post('leaseBooking_type'),
				'Booking_mode'=> $this->input->post('leaseBooking_mode'),
				'Leasetype'=>$this->input->post('Leasetype'),
				'reservation_closing_status' => $closing_status,
				'is_active' => 1,
				'TotalPayable'=>$this->input->post('totalpayables'),
				'Advance_traiff'=>$this->input->post('advancetraiffs'), 
				'Totalpaying' =>$this->input->post('total_paying'), 
				'Balance'=>$this->input->post('balance'),
				'OwnerType'=>$this->input->post('Ownertype'),
				'OwnerMode'=>$this->input->post('OwnerMOde'),
				'Unit_id'=>$this->input->post('Leaseunit'),
				'LeaseAmount'=>$this->input->post('Leaseamount'),
				'ExtraPrice'=>$this->input->post('extraamount'),
				'is_create' => date('Y-m-d H:i:s'),
			);	
			
			}
		   $booked_id=$this->Office_model->Booking_LeaseUnits($reservation_array);
			
			if($this->input->post('OwnerMOde') == lang('New_customer')){	
				$reservation_Owner = array(
					'firstname' => $this->input->post('ownerfirst_name'),
					'lastname' => $this->input->post('Ownerlast_name'),
					'email' => $this->input->post('Owneremail_address'),
					'mobile' => $this->input->post('Ownerphone_number'),
					'country_id' => $this->input->post('country_ids'),
					'address' => $this->input->post('Owneraddress'),
					'id_type' => $this->input->post('id_proofs'),
					'id_no' => $this->input->post('id_numbers'),
					'is_active' => 1,
					'Created_on' => date('Y-m-d H:i:s'),
				);
				$customer = 0;
			}else{
				$reservation_Owner = array(
					'firstname' => $this->input->post('ownerfirst_name'),
					'lastname' => $this->input->post('Ownerlast_name'),
					'email' => $this->input->post('Owneremail_address'),
					'mobile' => $this->input->post('Ownerphone_number'),
					'country_id' => $this->input->post('country_ids'),
					'address' => $this->input->post('Owneraddress'),
					'id_type' => $this->input->post('id_proofs'),
					'id_no' => $this->input->post('id_numbers'),
					'Is_Updated' => date('Y-m-d H:i:s'),
				);
				$customer = $this->input->post('LeaseOwner');
			}
		   $Owner_id=$this->Office_model->Booking_Owner($reservation_Owner,$customer);
			
			
 if(isset($_POST['paid_by'])){
	for($i=0; $i<count($_POST['paid_by']); $i++){
           if($_POST['paid_by'][$i]==lang('cash') ||$_POST['paid_by'][$i]==lang('Others')){
        $reservation_payment_array[]=array(
		'Booked_id'=>$booked_id,
		'Guest_id'=>$Owner_id,
		'Payingby'=>$_POST['paid_by'][$i],
		'Amount'=>$_POST['amount'][$i],
		'CurrencyType'=>$_POST['currency_id'][$i],
		'Created_on'=>date('Y-m-d H:i:s'));
}
else
{
	   $reservation_payment_array[]=array(
		'Booked_id'=>$booked_id,
		'Guest_id'=>$Owner_id,
		'Payingby'=>$_POST['paid_by'][$i],
		'Amount'=>$_POST['amount'][$i],
		'CurrencyType'=>$_POST['currency_id'][$i],
		'Card_number'=>$_POST['cc_no'][$i],
		'Holdername'=>$_POST['cc_holer'][$i],
		'Cardtype'=>$_POST['cc_type'][$i],
		'Month'=>$_POST['cc_month'][$i],
		'Year'=>$_POST['cc_year'][$i],
		'cvv'=>$_POST['cc_cvv2'][$i],
		'Created_on'=>date('Y-m-d H:i:s'));
	
} 
}
}

if ($this->form_validation->run() == true && $this->Office_model->leaseUnitBookSave($reservation_array, $reservation_payment_array, $reservation_Owner,$customer,$booked_id,$Owner_id)) {
			
			
            $this->session->set_flashdata('message', lang("reservation_added"));
			
           redirect('admin/Office/leaseunitlists');
        } else {
			$this->session->set_flashdata('error', validation_errors());
		 redirect('admin/Office/leaseunitlists');
		} 

	}
	function unit_level(){
			$data['page_title']	= lang('Unit_level');
			$data['ownerunitlevel']=$this->Office_model->get_unit_level_for_ownerunit();
			$data['Hotelunitlevel']=$this->Office_model->get_unit_level_for_Hotelunit();
			$data['Leaseunitlevel']=$this->Office_model->get_unit_level_for_leaseunit();
		    $this->render_admin('Office/unit_level',$data);
	}
	function Delivery_level(){
			$data['page_title']	= lang('Unit_level');
			$data['ownerunitlevel']=$this->Office_model->get_Delivery_level_for_Ownerunit();
			$data['Hotelunitlevel']=$this->Office_model->get_Delivery_level_for_Hotelunit();
			$data['Leaseunitlevel']=$this->Office_model->get_Delivery_level_for_leaseunit();
		    $this->render_admin('Office/unit_level',$data);
	}
	function services_level(){
			$data['page_title']	= lang('Unit_level');
			$data['Ownerunits']=$this->Office_model->get_Owner_unit_list();
			$data['Hotelunits']=$this->Office_model->get_Hotel_unit_list();
			$data['Leaseunits']=$this->Office_model->get_Lease_unit_list();
			
		    $this->render_admin('Office/services_level',$data);
	}
    function complaintlist($unittype,$unitid){
		 $status=lang('Completed');
		 $data['page_title'] = lang('Complaintlist');
		 $config = array();
         $config["base_url"] = base_url()."admin/Office/complaintlist/$unittype/$unitid";
         $config["per_page"] = 10;
         $config["uri_segment"] = 6;
		 $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
		 $config["total_rows"] = $this->Office_model->get_Unitwise_complaint_record_count($unittype,$unitid,$config["per_page"],$page);
		 $data["total_rows"] = $this->Office_model->get_Unitwise_complaint_record_count($unittype,$unitid,$config["per_page"],$page);
         $this->pagination->initialize($config);
         $data['Yettoassign']	= $this->Office_model->get_Unitwise_complaint_yet_to($unittype,$unitid,$config["per_page"],$page);
		 $data['assign']	= $this->Office_model->get_Unitwise_complaint_byAssignd($unittype,$unitid,$config["per_page"],$page);
		 $data['Complete']	= $this->Office_model->get_Unitwise_complaint_complete($unittype,$unitid,$config["per_page"],$page);
         $data["links"] = $this->pagination->create_links();
		 $this->render_admin('Office/Complaintlist',$data);
		 
	}
	function Get_LeaseOwnerDeatils()
	{
			$ownerId	= $this->input->post('Owner_id');
	        $result= $this->Office_model->Get_LeaseOwner_details($ownerId);
		    echo json_encode($result);

	}	
	
	function leaseunitlists() {
		  $data['page_title']	=	lang('Bookinglist');
		  $data['table']=$this->Office_model->Leaseunitlist();
	      $this->render_admin('Office/Leaseunitbooklist',$data);
	}
	function leaseunitEdit($id) {
		  $data['page_title']	=	lang('Bookinglist');
		  $data['id']=$id;
		  $data['country']=$this->Office_model->country_load();
		  $data['leaseowner']			=	$leaseowner		= $this->Office_model->Get_leaseOwner();
		  $data['leaseunits']			=	$leaseunits		= $this->Office_model->Get_leaseunits();
		  $data['BookedDetails']=$this->Office_model->get_leaseunitBooked($id);
		  $data['Payment']=$this->Office_model->get_leaseunitBooked_payament($id);
		  
	      $this->render_admin('Office/LeaseunitBookEdit',$data);
	}
	function Leaseuniteditsave($id){
		
		$this->form_validation->set_rules('leaseBooking_mode', lang("Booking_mode"), 'required');
		$this->form_validation->set_rules('leaseBooking_type', lang("Booking_Type"), 'required');
		$this->form_validation->set_rules('Leasetype', lang("LeaseType"), 'required');
		$this->form_validation->set_rules('Leasecheck_in_date', lang("Check_in"), 'required');
		$this->form_validation->set_rules('leasecheck_out_date', lang("Check_Out"), 'required');
		$this->form_validation->set_rules('Leaseunit', lang("Unit"), 'required');

			if ($this->form_validation->run() == true) {
               $reservation_array = []; 
			   $reservation_Owner = [];
			   $reservation_payment_array = [];
			 
           if($this->input->post('Booking_status') == lang('conform') ){
				$closing_status  = 'checkin';
			}elseif($this->input->post('Booking_status') == lang('Pending')){
				$closing_status  = 'process';
			}else{
				$closing_status = '';
			}			
			
               $reservation_array = array(
				
				'check_in' => $this->input->post('Leasecheck_in_date').' '.$this->input->post('Leasecheck_in_hour').':'.$this->input->post('Leasecheck_in_min').':00',
				'check_out' => $this->input->post('leasecheck_out_date').' '.$this->input->post('leasecheck_out_hour').':'.$this->input->post('leasecheck_out_min').':00',
				'grace_time' => $this->input->post('leasegrace_time'),
				'reservation_status' => $this->input->post('leaseBooking_status'),
				'reservation_reason' => $this->input->post('leaseBooking_reason'),
				'reservation_type' => $this->input->post('leaseBooking_type'),
				'Booking_mode'=> $this->input->post('leaseBooking_mode'),
				'Leasetype'=>$this->input->post('Leasetype'),
				'reservation_closing_status' => $closing_status,
				'is_active' => 1,
				'TotalPayable'=>$this->input->post('totalpayables'),
				'Advance_traiff'=>$this->input->post('advancetraiffs'), 
				'Totalpaying' =>$this->input->post('total_paying'), 
				'Balance'=>$this->input->post('balance'),
				'OwnerType'=>$this->input->post('Ownertype'),
				'OwnerMode'=>$this->input->post('OwnerMOde'),
				'Unit_id'=>$this->input->post('Leaseunit'),
				'LeaseAmount'=>$this->input->post('Leaseamount'),
				'ExtraPrice'=>$this->input->post('extraamount'),
				'is_create' => date('Y-m-d H:i:s'),
			);	
			
			}
		   $booked_id=$this->Office_model->edit_leasedBook($reservation_array,$id);
			
			if($this->input->post('OwnerMOde') == lang('New_customer')){	
				$reservation_Owner = array(
					'firstname' => $this->input->post('ownerfirst_name'),
					'lastname' => $this->input->post('Ownerlast_name'),
					'email' => $this->input->post('Owneremail_address'),
					'mobile' => $this->input->post('Ownerphone_number'),
					'country_id' => $this->input->post('country_ids'),
					'address' => $this->input->post('Owneraddress'),
					'id_type' => $this->input->post('id_proofs'),
					'id_no' => $this->input->post('id_numbers'),
					
					'added' => date('Y-m-d H:i:s'),
				);
				$customer = 0;
			}else{
				$reservation_Owner = array(
					'firstname' => $this->input->post('ownerfirst_name'),
					'lastname' => $this->input->post('Ownerlast_name'),
					'email' => $this->input->post('Owneremail_address'),
					'mobile' => $this->input->post('Ownerphone_number'),
					'country_id' => $this->input->post('country_ids'),
					'address' => $this->input->post('Owneraddress'),
					'id_type' => $this->input->post('id_proofs'),
					'id_no' => $this->input->post('id_numbers'),
					'Is_Updated' => date('Y-m-d H:i:s'),
				);
				$customer = $this->input->post('LeaseOwner');
			}
		   $Owner_id=$this->Office_model->edit_leaseOwner($reservation_Owner,$customer);
			
			
 if(isset($_POST['paid_by'])){
	for($i=0; $i<count($_POST['paid_by']); $i++){
           if($_POST['paid_by'][$i]==lang('cash') ||$_POST['paid_by'][$i]==lang('Others')){
        $reservation_payment_array[]=array(
		'Booked_id'=>$booked_id,
		'Guest_id'=>$Owner_id,
		'Payingby'=>$_POST['paid_by'][$i],
		'Amount'=>$_POST['amount'][$i],
		'CurrencyType'=>$_POST['currency_id'][$i],
		'Created_on'=>date('Y-m-d H:i:s'));
}
else
{
	   $reservation_payment_array[]=array(
		'Booked_id'=>$booked_id,
		'Guest_id'=>$Owner_id,
		'Payingby'=>$_POST['paid_by'][$i],
		'Amount'=>$_POST['amount'][$i],
		'CurrencyType'=>$_POST['currency_id'][$i],
		'Card_number'=>$_POST['cc_no'][$i],
		'Holdername'=>$_POST['cc_holer'][$i],
		'Cardtype'=>$_POST['cc_type'][$i],
		'Month'=>$_POST['cc_month'][$i],
		'Year'=>$_POST['cc_year'][$i],
		'cvv'=>$_POST['cc_cvv2'][$i],
		'Created_on'=>date('Y-m-d H:i:s'));
	
} 
}
}


if ($this->form_validation->run() == true && $this->Office_model->EditReservationUnitsave($reservation_array, $reservation_payment_array, $reservation_Owner,$customer,$booked_id,$Owner_id)) {
            $this->session->set_flashdata('message', lang("reservation_edit"));
           redirect('admin/Office/leaseunitlists');
        } else {
			$this->session->set_flashdata('error', validation_errors());
              redirect('admin/Office/leaseunitlists');
		} 

	}
	
function leaseownerBook_delete($id = false)
	{
		if ($id)
		{	
				$delete	= $this->Office_model->Leaseunit_book_delete($id);
				$this->session->set_flashdata('message', lang('Booking_Delete'));
				redirect('admin/Office/leaseunitlists');
		}
		else
		{
			$this->session->set_flashdata('error', lang('Booking_Not_found'));
				redirect('admin/Office/leaseunitlists');
		}
	}
	function list_level($id)
	{
		$data['BookedDetails']=$this->Office_model->get_Guest_Booked($id);
		$this->render_admin('Office/list_level',$data);
	}
	function Booked_guestlist()
	{
		
		$data['page_title']	= lang('guests');
		$data['guests']	= $this->guest_model->get_all();
	    $this->render_admin('Office/BookedGuestlist',$data);
	}
		function Invoicelist()
	{
		$admin = $this->session->userdata('admin');
		$data['page_title']	= lang('Invoice');
		$data['invoiceguest']	= $this->Office_model->get_Guest_Bookdall();
		$data['invoiceleaseowner']	= $this->Office_model->get_leaseunitBookedall();
		
		$this->render_admin('Office/Invoicelist', $data);		
	}
	
	function invoiceview($id){
	
     	$data['page_title']	= lang('view')." ".lang('Accounts') ;
		$data['Invoicedetails']	= $this->Office_model->get_Guest_BookedInvoice($id);
		$data['payment']=$this->Office_model->get_guest_book_payments($id);
	
		$this->render_admin('Office/Invoiceview', $data);
	}  
	
	function invoiceview1($id){
	
	    $data['page_title']	= lang('view')." ".lang('Accounts') ;
		$data['Invoicedetails']	= $this->Office_model->get_Lease_BookedInvoice($id);
		$data['payment']=$this->Office_model->get_LeaseUnits_book_payments($id);
		$this->render_admin('Office/Invoiceview1', $data);
	} 
	function booking_dashboard()
	{
		$dashboard='';
		$Ownertypes=$this->Office_model->Ownertype();
		$floors=$this->Office_model->get_floor();
		$dashboard .= '	 <div class="col-sm-12 col-xs-12" id="exTab1">	
			<ul  class="nav nav-pills">
				<li class="active">
					<a  href="#11" data-toggle="tab">Owner Units</a>
				</li>
				<li>
					<a href="#12" data-toggle="tab">Hotel Units</a>
				</li>
				<li>
					<a href="#13" data-toggle="tab">Lease Back Units</a>
				</li>
				
			</ul>

			<div class="tab-content">
			  	
				';
		   foreach($Ownertypes as $Ownertype){
		$dashboard .=  '<div class="tab-pane active" id="'.$Ownertype->id.'" style="background-color:#fff;">
					<div class="row">
						<div class="col-sm-12 col-xs-12 dashboard_sec">
							<div class="row header_right_dash">
								<div class="col-sm-2  col-xs-12">
									<p class="text-left">Available Units</p>
									<div class="info_box">
										<span class="info_box_con"><img src="'.base_url("assets/admin").'/dist/img/hms_total_rooms.png" alt="available"></span>
										<div class="info_box_content">
										  <span class="info_box_number">'.$this->Office_model->Get_Availableunits($Ownertype->id).'</span>
										</div>
									  </div>
								</div>
								<div class="col-sm-2 col-xs-12">
									<p class="text-left">Occupied Units</p>
									<div class="info_box ocupied_box">
										<span class="info_box_con "><img src="'. base_url("assets/admin").'/dist/img/hms_ocupied_room.png" alt="available"></span>
										<div class="info_box_content">
										  <span class="info_box_number">'.$this->Office_model->Get_Occupiedunits($Ownertype->id).'</span>
										</div>
									  </div>
								</div>
								
								<div class="col-sm-2 col-xs-12">
									<p class="text-left">Maintenance</p>
									<div class="info_box maintain_box">
										<span class="info_box_con "><img src="'.base_url("assets/admin").'/dist/img/hms_maintainence.png" alt="available"></span>
										<div class="info_box_content">
										  <span class="info_box_number">'.$this->Office_model->Get_Maintenanceunits($Ownertype->id).'</span>
										</div>
									  </div>
								</div>
								<div class="col-sm-2 col-xs-12">
									<p class="text-left">Total Units</p>
									<div class="info_box total_box_hms">
										<span class="info_box_con "><img src="'.base_url("assets/admin").'/dist/img/hms_total_rooms.png" alt="available"></span>
										<div class="info_box_content">
										  <span class="info_box_number">'.$this->Office_model->Get_Totaldunits($Ownertype->id).'</span>
										</div>
									  </div>
								</div>
							</div>
							<div class="row">
							<div class="col-sm-12 col-xs-12 floor_box_content">
							';    if(isset($floors)) {  foreach($floors as $floor){
						$dashboard .=  '
								<div class="col-sm-3 col-xs-6">
									<a href="javascript:void(0)" tabindex="-1">
									<div class="floor_box pink_floor_box">
										<div class="row head_number_box">
										<div class="col-xs-4"><span class="number_box">>></span></div>
										<div class="col-xs-8"><span class="floor_num">'. $floor->name.'</span></div></div>
										<p>Occupied :'.$this->Office_model->Get_Occupiedfloorunits($Ownertype->id,$floor->id).' </p>
										<p>Check-in : '.$this->Office_model->Get_Availablefloorunits($Ownertype->id,$floor->id).'</p></p>                                            </div>
									</a>
								</div>
								';
							}
							} 
								
						$dashboard .= '	
							</div>
						</div>
						

						
					</div>
     			</div>';
				
		   }
		$data['dashboard']=$dashboard;
		$this->render_admin('Office/booking_dashboard',$data);
	}
	
	function Checkoutform($id){
		$data['id']=$id;
		$data['country']=$this->Office_model->country_load();
		$data['unittype']=$this->Office_model->Unittype();
		$data['Slot']=$this->Office_model->get_Slot();
		$booking_details=$this->Office_model->Get_booking_details($id);
		$data['BookingDetails']=$booking_details;
		$data['getunit']=$this->Office_model->Get_booking_unit($id);
		$data['Guest']=$this->Office_model->Get_Booked_guest($booking_details->Guest_id);
		$data['allunit']=$this->Office_model->all_unit();
		$data['Vechiles']=$this->Office_model->Get_Vechile($id);
		$data['Persons']=$this->Office_model->Get_Person($id);
		$data['Payment']=$this->Office_model->Get_Payment($id);
		$data['Guestlists']=$this->Office_model->get_guest();
		$this->render_admin('Office/CheckoutForm',$data);
	}
	
	
	
	
	function Check_out_save()
	{
		$this->form_validation->set_rules('Booking_type', lang("Booking_Type"), 'required');
		$this->form_validation->set_rules('check_in_date', lang("Check_in"), 'required');
		$this->form_validation->set_rules('night', lang("Nights"), 'required');
		$this->form_validation->set_rules('number_of_adult', lang("Number_Of_Adults"), 'required');
		$this->form_validation->set_rules('number_of_Units', lang("Number_Of_Units"), 'required');
		$this->form_validation->set_rules('Booking_status', lang("Booking_status"), 'required');

			if ($this->form_validation->run() == true) {
               $reservation_array = []; 
			   $reservation_payment_array = [];
			   $reservation_traiff = [];
			   $reservation_serviceAmount = [];	
			   $booking_id=
			   $guest_id=$this->input->post('guestid');
               $reservation_array = array(
				'TotalPayable'=>$this->input->post('totalpayable'),
				'Advance_traiff'=>$this->input->post('advancetraiff'), 
				'Totalpaying' =>$this->input->post('total_paying'), 
				'Balance'=>$this->input->post('balance'),
			);	
			
			$booked_id=$this->Office_model->Booking_details_edit($reservation_array,$booking_id);
 if(isset($_POST['paid_by'])){
	for($i=0; $i<count($_POST['paid_by']); $i++){
           if($_POST['paid_by'][$i]==lang('cash') ||$_POST['paid_by'][$i]==lang('Others')){
        $reservation_payment_array[]=array(
		'Booked_id'=>$booked_id,
		'Guest_id'=>$guest_id,
		'Payingby'=>$_POST['paid_by'][$i],
		'Amount'=>$_POST['amount'][$i],
		'CurrencyType'=>$_POST['currency_id'][$i],
		'Created_on'=>date('Y-m-d H:i:s'));
}
else
{
	   $reservation_payment_array[]=array(
		'Booked_id'=>$booked_id,
		'Guest_id'=>$guest_id,
		'Payingby'=>$_POST['paid_by'][$i],
		'Amount'=>$_POST['amount'][$i],
		'CurrencyType'=>$_POST['currency_id'][$i],
		'Card_number'=>$_POST['cc_no'][$i],
		'Holdername'=>$_POST['cc_holer'][$i],
		'Cardtype'=>$_POST['cc_type'][$i],
		'Month'=>$_POST['cc_month'][$i],
		'Year'=>$_POST['cc_year'][$i],
		'cvv'=>$_POST['cc_cvv2'][$i],
		'Created_on'=>date('Y-m-d H:i:s'));
	
} 
}
 }
 if(isset($_POST['servicesname'])){
	for($i=0; $i<count($_POST['servicesname']); $i++){
           
        $reservation_serviceAmount[]=array(
		'Bookedid'=>$booked_id,
		'Servicename'=>$_POST['servicesname'][$i],
		'ServicesDescription'=>$_POST['description'][$i],
		'services_price'=>$_POST['servicesprices'][$i]);
		
}
}


if ($this->form_validation->run() == true && $this->Office_model->Checkoutsaves($reservation_payment_array,$reservation_serviceAmount,$booked_id)) {
				  $this->session->set_flashdata('message', lang("cHECKOUTsUCCESS"));
                  redirect('admin/Office/Checkout');
              } else {
		     	$this->session->set_flashdata('error', validation_errors());
			    redirect('admin/Office/Checkout');
		        } 


			}
	}
}