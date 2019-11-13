<?php
Class Office_model extends CI_Model
{

    var $CI; 
    function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	function country_load(){
		$result=$this->db->query("SELECT * FROM `countries`")->result();
		return $result;
	}
   	function Unittype(){
		$result=$this->db->query("SELECT * FROM `unit_type`  WHERE Soft_delete=1")->result();
		return $result;
	}
    function get_Owner_unit()
		 {
			$result = $this->db->query("SELECT  ownid,Owner_unit   FROM `add_owner` ao 
			LEFT JOIN ownertype ot ON ot.id=ao.ownid
			WHERE Owner_type=12")->result();
			return $result;  
		 }
  function Get_Unit_group($units_id,$unittype)
	   {
		   $units_id=join("','",$units_id);  
		   $result = $this->db->query("SELECT uid,unit_no FROM   `add_unit`  WHERE    Booked_status NOT IN (1) OR Booked_status IS NULL AND Unit_type='".$unittype."' AND uid IN ('".$units_id."') ")->result();
         return $result;  
	   }
     function get_guest(){
	     $result = $this->db->query("SELECT id,            firstname,lastname  FROM `guests` WHERE Soft_deleted=1")->result();
	    return $result;  
    }
	 function get_guest_details($guest_id){
      	$result = $this->db->query(" SELECT g.id , firstname , lastname, email, mobile,address,country_id,
         id_type,id_no,NAME,id_upload FROM guests g 
         LEFT JOIN countries c ON c.id=g.country_id WHERE Soft_deleted=1 and g.id='".$guest_id."'")->row();
	    return $result;  
    }
	 function get_Slot(){
      	$result = $this->db->query("SELECT * FROM   `parking_slot` WHERE Slot_Type !='Owners' and Isbooked not in (1)")->result();
	    return $result;  
    }
	
	function Booking_Units($reservation_array)
	{
		 $this->db->insert('booking',$reservation_array);
         $insert_id = $this->db->insert_id();
         return  $insert_id;
		
	}
	function Booking_guest($reservation_customer,$customer){
		if($customer==0){
			$this->db->insert('guests',$reservation_customer);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
		}else{
			$this->db->where('id',$customer);
			$this->db->update('guests',$reservation_customer);
            return  $customer;
		}
		
	}
	function addReservationsave($reservation_array, $reservation_adult_array, $reservation_child_array, $reservation_rooms_array, $reservation_guest, $reservation_customer, $reservation_payment_array, $reservation_traiff, $reservation_vehicle_array, $customer,$booked_id,$guest_id){
		if($reservation_rooms_array){
			$this->db->delete('unit_book', array('Booking_id' => $booked_id));
		    	foreach ($reservation_rooms_array as $reservation_rooms) {
		     	if($this->db->insert('unit_book',$reservation_rooms)){
				$unit_status=array('Booked_status'=>1);
				$this->db->where('uid',$reservation_rooms['Unit_name']);
			    $this->db->update('add_unit',$unit_status);
				}
			    }
		}
			if($reservation_adult_array){
				$this->db->delete('booked_person_details', array('Booked_id' => $booked_id));
				foreach ($reservation_adult_array as $reservation_adult) {
			   $this->db->insert('booked_person_details',$reservation_adult);
				}
			}
		   if($reservation_vehicle_array){
			   $this->db->delete('vechile_manage', array('Booked_id' => $booked_id));
			   foreach ($reservation_vehicle_array as $reservation_vehicle) {
			if($this->db->insert('vechile_manage',$reservation_vehicle)){
				$Slot=array('Isbooked'=>1);
				$this->db->where('id',$reservation_vehicle['Slot_id']);
			    $this->db->update('parking_slot',$Slot);
			}
	        }
		    if($reservation_payment_array){
				 $this->db->delete('booked_payments', array('Booked_id' => $booked_id));
				 foreach ($reservation_payment_array as $reservation_payment) {
			$this->db->insert('booked_payments',$reservation_payment);
				 }
	        }
			$data=array('Guest_id'=>$guest_id);
			$this->db->where('id',$booked_id);
			$this->db->update('booking',$data);
			
			
	    }else{
			return false;
			
		}
		
	return true;
	}
	function EditReservationsave($reservation_array, $reservation_adult_array, $reservation_child_array, $reservation_rooms_array, $reservation_guest, $reservation_customer, $reservation_payment_array, $reservation_traiff, $reservation_vehicle_array, $customer,$booked_id,$guest_id){
		if($reservation_rooms_array){
		    	foreach ($reservation_rooms_array as $reservation_rooms) {
		     	if($this->db->insert('unit_book',$reservation_rooms)){
				$unit_status=array('Booked_status'=>1);
				$this->db->where('uid',$reservation_rooms['Unit_name']);
			    $this->db->update('add_unit',$unit_status);
				}
			    }
		}
			if($reservation_adult_array){
				foreach ($reservation_adult_array as $reservation_adult) {
			   $this->db->insert('booked_person_details',$reservation_adult);
				}
			}
		   if($reservation_vehicle_array){
			   foreach ($reservation_vehicle_array as $reservation_vehicle) {
			if($this->db->insert('vechile_manage',$reservation_vehicle)){
				$Slot=array('Isbooked'=>1);
				$this->db->where('id',$reservation_vehicle['Slot_id']);
			    $this->db->update('parking_slot',$Slot);
			}
	        }
		    if($reservation_payment_array){
				 foreach ($reservation_payment_array as $reservation_payment) {
			$this->db->insert('booked_payments',$reservation_payment);
				 }
	        }
			$data=array('Guest_id'=>$guest_id);
			$this->db->where('id',$booked_id);
			$this->db->update('booking',$data);
			
			
	    }else{
			return false;
			
		}
		
	return true;
	}
	function bookinglist(){
		$result = $this->db->query("SELECT b.id,firstname,reservation_number , reservation_type,  check_in,(number_of_adult+number_of_child) AS persons,number_of_rooms ,reservation_status FROM `booking` b
        LEFT JOIN `guests` g ON b.Guest_id=g.id WHERE is_delete=0 OR  is_delete IS NULL and IS_checkout not in (1)")->result();
	    return $result;  
		
	}
	
	
	function bookingCheckoutlist(){
		$result = $this->db->query("SELECT b.id,firstname,reservation_number , reservation_type,  check_in,(number_of_adult+number_of_child) AS persons,number_of_rooms ,reservation_status FROM `booking` b
        LEFT JOIN `guests` g ON b.Guest_id=g.id  WHERE is_delete=0  AND IS_checkout NOT IN (1) and Is_cancelled!=1")->result();
	    return $result;  
		
	}
	
	function bookingCheckinlist(){
		$bookingmode=lang('bookings');
		$result = $this->db->query("SELECT b.id,firstname,reservation_number , 
reservation_type,  check_in,(number_of_adult+number_of_child) AS persons,number_of_rooms ,reservation_status 
FROM `booking` b
LEFT JOIN `guests` g ON b.Guest_id=g.id  WHERE is_delete=0  AND IS_checkout NOT IN (1) AND IS_checkin !=1
AND  DATE(b.check_in)=CURDATE() AND Booking_mode ='".$bookingmode."'  and Is_cancelled!=1
        ")->result();
	    return $result;  
		
	}
	function Get_booking_details($id){
		$result=$this->db->get_where('booking', array('id =' =>$id))->row();
		return $result;
	}
	function Get_booking_unit($id){
		$result=$this->db->query("SELECT ub.id,uid,unit_no,  Booking_id,  ub.Unit_type , Unit_name,  check_in ,  check_out,Price,Extra_price,grace_time,ExtraBeds FROM  unit_book  ub 
		LEFT JOIN add_unit ut ON ub.Unit_name=ut.uid
		WHERE Booking_id='".$id."'")->result();
		return $result;
	}
	function Get_Booked_guest($id){
		$result=$this->db->get_where('guests', array('id =' =>$id))->row();
		return $result;
	}
	function Get_Vechile($id){
		$result=$this->db->query("SELECT  vm.id , Slot_id , Booked_id , Vechilenumber , arrival  ,  departure  ,Is_parked,  is_create ,Slot_No FROM  vechile_manage vm 
LEFT JOIN   parking_slot ps ON   vm.Slot_id=ps.id WHERE vm.Booked_id='".$id."'")->result();
		return $result;
	}
	function Get_Person($id){
		$result=$this->db->get_where('booked_person_details', array('Booked_id =' =>$id))->result();
		return $result;
	}
	function Get_Payment($id){
		$result=$this->db->get_where('booked_payments', array('Booked_id' =>$id))->result();
		return $result;
	}
	function all_unit(){
		$result=$this->db->get_where('add_unit', array('Soft_delete' =>1))->result();
		return $result;
	}
	function Booking_details_edit($reservation_array,$booking_id)
	{
            $this->db->where('id',$booking_id);
			$this->db->update('booking',$reservation_array);
            return  $booking_id;
		
	}
	function get_Owner_units($ownertype)
		 {
			$result = $this->db->query("SELECT  ownid,Owner_unit   FROM `add_owner` ao 
			LEFT JOIN ownertype ot ON ot.id=ao.ownid
			WHERE Owner_type='".$ownertype."'")->result();
			return $result;  
		 }
		function Get_Unit_groups($units_id,$soc)
	       {
		    $units_id=join("','",$units_id);  
		    $result = $this->db->query("SELECT p.Name, unit_no, uid ,Booked_status,Percentage,s.Name AS socs,s.Description  FROM `project` p
            LEFT JOIN add_unit au ON au.Project_id=p.id
            LEFT JOIN soc s ON s.id=au.Soc
            WHERE uid IN ('".$units_id."') AND au.Soc='".$soc."'")->result();
           return $result;  
	     }
	    function TotalOwner()
	   {
		   $result = $this->db->query(" SELECT COUNT(ownid) AS OWNER FROM  `add_owner` WHERE Owner_type=11")->row();
           return $result;  
	   }
	   function delete($id)
    {
		$data=array('is_delete'=>1);
        $this->db->where('id', $id);
        $this->db->update('booking',$data);
		return true;
    }
	function Get_booking($id){
		$result=$this->db->get_where('booking',array('id'=>$id))->result();
		return $result;
	}
	function Unitwise_complaint($id)
	{
		 $result = $this->db->query(" SELECT complain_id , c_title     , c_description     ,    c_date, Complaint_status ,unit_no FROM `add_complain` ac
         LEFT JOIN add_unit au ON au.uid=ac.Unit_id
         WHERE uid='".$id."'")->result();
           return $result; 
	}
	
	function Get_booked_units($id)
	{
		$result=$this->db->query("select Unit_name from unit_book where Booking_id='".$id."'")->result();
		return $result;
	}
	function Release_unit($units){
		 foreach($units as $unit){
		$result=$this->db->query("update add_unit set Booked_status=0  where  uid in('".$unit->Unit_name."')");
		 }
		if($result){
			return true;
		}else{
			return false;
		}
	}
	function Get_Assigned_slot($id){
		$result=$this->db->query("select Slot_id from vechile_manage where Booked_id='".$id."'")->result();
		return $result;
	}
	function Release_slot($slots){
		foreach($slots as $slot){
		$result=$this->db->query("update parking_slot set Isbooked=0  where  id in('".$slot->Slot_id."')");
		}
		if($result){
			return true;
		}else{
			return false;
		}
	}
	function Ischeckedout($id){
		    
			$result=$this->db->get_where('booking',array('id'=>$id))->row();
		if($result->Balance<=0)
		{
			$result=$this->db->query("update booking set IS_checkout=1  where  id='".$id."'");
				
		if($result){
			
			return true;
		}else{
				
			return false;
		}
		}else{
				
			return false;
		}
			
	}
	function Iscancelled($id){
			$data=array('Is_cancelled'=>1);
			$this->db->where('id',$id);
			$cancelled=$this->db->update('booking',$data);
		if($cancelled)
		{
			return true;
		
		}else{
				
			return false;
		}
			
	}
	function get_slot_details(){
		$result=$this->db->get_where('parking_slot',array('Active'=>1))->result();
		return $result;
	}
	function get_leaseUnit(){
			$result=$this->db->get_where('add_unit',array('Active'=>1))->result();
		    return $result;
	}
	 function save($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
           $update= $this->db->update('leaseunit_book', $save);
		    if($update)
			{
				$data=array('Booked_status'=>1);
				 $this->db->where('id', $save['Unit_id']);
                 $this->db->update('add_unit', $data);
			}
            return $save['id'];
        }
        else
        {
           $insert= $this->db->insert('leaseunit_book', $save);
			echo $save['Unit_id'];
				 if($insert)
			{
				 $data=array('Booked_status'=>1);
				 $this->db->where('uid', $save['Unit_id']);
                 $this->db->update('add_unit', $data);
			}
            return $this->db->insert_id();
        }
    }
	 function Get_leaseOwner()
	 {
		$result=$this->db->get_where('leaseowner',array('Soft_deleted'=>1))->result(); 
		return $result;
	 }
	 function Get_leaseunits(){
		 	$result=$this->db->get_where('add_unit',array('Unit_groupType'=>13,'Soft_delete'=>1,'Booked_status'=>0))->result(); 
		    return $result;
	 }
	 function Get_leaseunitBook($id){
		 $result=$this->db->get_where('leaseunit_book',array('id'=>$id))->row(); 
		    return $result;
	 }
	 function get_unit_level_for_ownerunit(){
		 $result=$this->db->query("
SELECT uid,unit_no ,NAME,soc.Description,OwnerType, CASE WHEN Booked_status=0 THEN 'Not Booked' WHEN Booked_status=1 THEN 'Booked' END AS book_status 
FROM `add_unit` au 
LEFT JOIN soc AS soc ON au.Soc=soc.id 
LEFT JOIN ownertype AS ot ON ot.id=au.Unit_groupType  WHERE au.Soft_delete=1 and Unit_groupType=11")->result();
		 return $result;
		 
	 }
	 function get_unit_level_for_Hotelunit(){
		 $result=$this->db->query("
SELECT uid,unit_no ,NAME,soc.Description,OwnerType, CASE WHEN Booked_status=0 THEN 'Not Booked' WHEN Booked_status=1 THEN 'Booked' END AS book_status 
FROM `add_unit` au 
LEFT JOIN soc AS soc ON au.Soc=soc.id 
LEFT JOIN ownertype AS ot ON ot.id=au.Unit_groupType WHERE au.Soft_delete=1 and Unit_groupType=12")->result();
		 return $result;
		 
	 }
	  function get_unit_level_for_leaseunit(){
		 $result=$this->db->query("
SELECT uid,unit_no ,NAME,soc.Description,OwnerType, CASE WHEN Booked_status=0 THEN 'Not Booked' WHEN Booked_status=1 THEN 'Booked' END AS book_status 
FROM `add_unit` au 
LEFT JOIN soc AS soc ON au.Soc=soc.id 
LEFT JOIN ownertype AS ot ON ot.id=au.Unit_groupType WHERE au.Soft_delete=1 and Unit_groupType=13")->result();
		 return $result;
		 
	 }
	function get_floor(){
		$result=$this->db->get_where('floors',array('Soft_delete'=>1))->result();
		return $result;
	}
	function get_floorwise_complaint($unittype,$floor,$status){
		$result = $this->db->query(" SELECT COUNT(complain_id)AS complaint FROM add_complain ac 
                  LEFT JOIN add_unit au ON  au.uid=ac.Unit_id
                  LEFT JOIN floors f   ON au.`floor_no`=f.`id`
                  WHERE Unit_groupType='".$unittype."' AND au.floor_no='".$floor."' AND Complaint_status !='".$status."'")->row();
	  return $result;
	}
	function get_Owner_unit_list(){
		$result = $this->db->get_where('add_unit',array('Soft_delete'=>1,'Unit_groupType'=>11))->result();  
	  return $result;
	}
		function get_Hotel_unit_list(){
		$result = $this->db->get_where('add_unit',array('Soft_delete'=>1,'Unit_groupType'=>12))->result();  
	  return $result;
	}
		function get_Lease_unit_list(){
		$result = $this->db->get_where('add_unit',array('Soft_delete'=>1,'Unit_groupType'=>13))->result();  
	  return $result;
	}
	function get_Unitwise_complaint_yet_to($unittype,$uid,$limit,$start){
		
		  $array = array('add_unit.Unit_groupType' => $unittype, 'add_unit.uid' => $uid);
		  $this->db->select('*');
          $this->db->from('add_complain');
          $this->db->join('add_unit', 'add_unit.uid=add_complain.Unit_id');
          $this->db->join('floors', 'floors.id=add_unit.floor_no');
          $this->db->where($array); 
          $this->db->limit($limit,$start);
          $query= $this->db->get();
          if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
	}
	function get_Unitwise_complaint_byAssignd($unittype,$uid,$limit,$start){
		
		  $array = array('add_unit.Unit_groupType' => $unittype, 'add_unit.uid' => $uid,'add_complain.Assign_to'=>0);
		  $this->db->select('*');
          $this->db->from('add_complain');
          $this->db->join('add_unit', 'add_unit.uid=add_complain.Unit_id');
          $this->db->join('floors', 'floors.id=add_unit.floor_no');
          $this->db->where($array); 
          $this->db->limit($limit,$start);
          $query= $this->db->get();
          if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
	}
	function get_Unitwise_complaint_complete($unittype,$uid,$limit,$start){
		
		  $array = array('add_unit.Unit_groupType' => $unittype, 'add_unit.uid' => $uid);
		  $this->db->select('*');
          $this->db->from('add_complain');
          $this->db->join('add_unit', 'add_unit.uid=add_complain.Unit_id');
          $this->db->join('floors', 'floors.id=add_unit.floor_no');
          $this->db->where($array); 
		  $this->db->where('add_complain.Assign_to !=',0);
          $this->db->limit($limit,$start);
          $query= $this->db->get();
          if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
	}
	function get_Unitwise_complaint_record_count($unittype,$unit,$limit,$start){
		  $status=lang('Completed');
		  $array = array('add_unit.Unit_groupType' => $unittype, 'add_unit.uid' => $unit,'add_complain.Complaint_status'=>$status);
		  $this->db->select('*');
          $this->db->from('add_complain');
          $this->db->join('add_unit', 'add_unit.uid=add_complain.Unit_id');
          $this->db->join('floors', 'floors.id=add_unit.floor_no');
          $this->db->where($array); 
          $this->db->limit($limit, $start);
          $query= $this->db->get();
          if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return count($data);
       }
       return false;
		
	}
		  function get_Delivery_level_for_Ownerunit(){
		 $result=$this->db->query(" SELECT uid,unit_no ,NAME,soc.Description,OwnerType, CASE WHEN Booked_status=0 THEN 'Not Booked' WHEN Booked_status=1 THEN 'Booked' END AS book_status 
		FROM `add_unit` au 
		LEFT JOIN soc AS soc ON au.Soc=soc.id 
		LEFT JOIN ownertype AS ot ON ot.id=au.Unit_groupType WHERE au.Soft_delete=1 and Unit_groupType=11 and soc.id=5")->result();
		 return $result;
		 
	 }
	 	  function get_Delivery_level_for_Hotelunit(){
		 $result=$this->db->query("SELECT uid,unit_no ,NAME,soc.Description,OwnerType, CASE WHEN Booked_status=0 THEN 'Not Booked' WHEN Booked_status=1 THEN 'Booked' END AS book_status 
         FROM `add_unit` au 
         LEFT JOIN soc AS soc ON au.Soc=soc.id 
         LEFT JOIN ownertype AS ot ON ot.id=au.Unit_groupType WHERE au.Soft_delete=1 and Unit_groupType=12 and soc.id=4")->result();
		 return $result;
		 
	 }
		  function get_Delivery_level_for_leaseunit(){
		 $result=$this->db->query("SELECT uid,unit_no ,NAME,soc.Description,OwnerType, CASE WHEN Booked_status=0 THEN 'Not Booked' WHEN Booked_status=1 THEN 'Booked' END AS book_status 
         FROM `add_unit` au 
         LEFT JOIN soc AS soc ON au.Soc=soc.id 
         LEFT JOIN ownertype AS ot ON ot.id=au.Unit_groupType WHERE au.Soft_delete=1 and Unit_groupType=13 and soc.id=5")->result();
		 return $result;
		 
	 }
	 
	 function Get_LeaseOwner_details($id){
		 
		 $this->db->select('*');
         $this->db->from('leaseowner');
         $this->db->join('countries', 'leaseowner.country_id = countries.id','left');
         $this->db->where('leaseowner.id', $id);
		$query = $this->db->get();
		return $query->row();
		 
	 }

	 function Booking_LeaseUnits($reservation_array)
	{
		 $this->db->insert('leaseunit_booking',$reservation_array);
         $insert_id = $this->db->insert_id();
         return  $insert_id;
		
	}
	function Booking_Owner($reservation_customer,$customer){
		if($customer==0){
			$this->db->insert('leaseowner',$reservation_customer);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
		}else{
			$this->db->where('id',$customer);
			$this->db->update('leaseowner',$reservation_customer);
            return  $customer;
		}
		
	}
	function leaseUnitBookSave($reservation_array, $reservation_payment_array, $reservation_Owner,$customer,$booked_id,$Owner_id){
		
			if($booked_id)
			{
		    if($reservation_payment_array){
				 $this->db->delete('LeaseUnitbooked_payments', array('Booked_id' => $booked_id));
				 foreach ($reservation_payment_array as $reservation_payment) {
			$this->db->insert('LeaseUnitbooked_payments',$reservation_payment);
				 }
	        }
			$data=array('Owner_id'=>$Owner_id);
			$this->db->where('id',$booked_id);
			$this->db->update('leaseunit_booking',$data);
			
			
	    }else{
			return false;
			
		}
		
	return true;
	}
	
	  function Leaseunitlist(){
		 $result=$this->db->query("SELECT reservation_number,lb.id,reservation_type,Booking_mode,check_in,firstname FROM  leaseunit_booking lb
LEFT JOIN leaseowner lo ON lb.Owner_id=lo.id
WHERE is_active=1")->result();
		 return $result;
		 
	 }
	 function get_leaseunitBooked($id){
		 $result=$this->db->query("SELECT * FROM  leaseunit_booking lb
LEFT JOIN leaseowner lo ON lb.Owner_id=lo.id
WHERE lb.id='".$id."'")->row();
		 return $result;
		 
	 }
	  function get_leaseunitBooked_payament($id){
		 $result=$this->db->query("SELECT * FROM `leaseunitbooked_payments` WHERE Booked_id='".$id."'")->result();
		 return $result;
		 
	 }
	 function EditReservationUnitsave($reservation_array, $reservation_payment_array, $reservation_Owner,$customer,$booked_id,$Owner_id){
		 
		 
		if($reservation_payment_array){
			 $this->db->delete('LeaseUnitbooked_payments', array('Booked_id' => $booked_id));
		    	foreach ($reservation_payment_array as $reservation_payment) {
		     $this->db->insert('LeaseUnitbooked_payments',$reservation_payment);
				}
				
				
				
			    
		}
			
	}
	
	function edit_leasedBook($reservation_array,$id){
		if(!empty($reservation_array)){
			 $this->db->where('id',$id);
			 $this->db->update('leaseunit_booking',$reservation_array);
		 }
		return $id;
	}
	
	function edit_leaseOwner($reservation_Owner,$customer){
		  if(!empty($reservation_Owner)){
			 $this->db->where('id',$customer);
			 $this->db->update('leaseowner',$reservation_Owner);
			 
		 }
		 return true;
}
  function Leaseunit_book_delete($id){
	  $data=array('is_active'=>0);
	         $this->db->where('id',$id);
			 $this->db->update('leaseunit_booking',$data);
			 return true;
	  
  }
   function get_Guest_Booked($id){
		 $result=$this->db->query("SELECT * FROM `booking` b
				LEFT JOIN `guests` g ON g.id=b.Guest_id
				WHERE Guest_id='".$id."'")->result();
		 return $result;
		 
	 }
	 
	  function get_Guest_Bookdall(){
		 $result=$this->db->query("SELECT b.id,firstname, reservation_number ,reservation_type, check_out, TotalPayable FROM `booking` b
				LEFT JOIN `guests` g ON g.id=b.Guest_id
				WHERE IS_checkout=1")->result();
		 return $result;
		 
	 }
	  function get_leaseunitBookedall(){
		 $result=$this->db->query("SELECT lb.id,firstname,reservation_number,Booking_mode,check_in ,check_out,TotalPayable  FROM  leaseunit_booking lb
LEFT JOIN leaseowner lo ON lb.Owner_id=lo.id
WHERE lb.Balance<=0")->result();
		 return $result;
		 }
		 function get_guest_book_payments($id)
		 {
			$result=$this->db->get_where('booked_payments',array('Booked_id'=>$id))->result(); 
			 return $result;
		 }
		  function get_Guest_BookedInvoice($id){
		 $result=$this->db->query("SELECT * FROM `booking` b
				LEFT JOIN `guests` g ON g.id=b.Guest_id
				WHERE b.id='".$id."'")->row();
		 return $result;
		 
	 }
	 function get_Lease_BookedInvoice($id){
		 $result=$this->db->query("SELECT *  FROM  leaseunit_booking lb
LEFT JOIN leaseowner lo ON lb.Owner_id=lo.id
WHERE lb.id='".$id."'")->row();
		 return $result;
		 
	 }
	  function get_LeaseUnits_book_payments($id)
		 {
			$result=$this->db->get_where('leaseunitbooked_payments',array('Booked_id'=>$id))->result(); 
			 return $result;
		 }
		  function Ownertype()
		 {
			$result=$this->db->get_where('ownertype',array('Soft_delete'=>1))->result(); 
			 return $result;
		 }
		 
		 function Get_Availableunits($id){
			 $result=$this->db->query("SELECT COUNT(uid) AS available FROM `add_unit` WHERE Unit_groupType='".$id."' AND Soc=4 AND Booked_status=0")->row(); 
			 return $result->available;
			 
		 }
		  function Get_Occupiedunits($id){
			 $result=$this->db->query("SELECT COUNT(uid) AS Occupied FROM `add_unit` WHERE Unit_groupType='".$id."' AND Soc=4 AND Booked_status=1")->row(); 
			 return $result->Occupied;
			 
		 }
		  function Get_Totaldunits($id){
			 $result=$this->db->query("SELECT COUNT(uid) AS totalunits FROM `add_unit` WHERE Unit_groupType='".$id."' AND Soc=4 ")->row(); 
			 return $result->totalunits;
			 
		 }
		  function Get_Maintenanceunits($id){
			  $result=$this->db->query("SELECT COUNT(complain_id) AS complaint FROM add_complain ac 
              LEFT JOIN add_unit au ON  au.uid=ac.Unit_id
              WHERE Unit_groupType=11")->row(); 
			 return $result->complaint;
			 
		 }
		   function Get_Occupiedfloorunits($id,$floorid){
			 $result=$this->db->query("SELECT COUNT(uid) AS Occupied FROM `add_unit` WHERE Unit_groupType='".$id."' AND Soc=4 AND Booked_status=1 and floor_no='".$floorid."'")->row(); 
			 return $result->Occupied;
			 
		 }
		  function Get_Availablefloorunits($id,$floorid){
			 $result=$this->db->query("SELECT COUNT(uid) AS available FROM `add_unit` WHERE Unit_groupType='".$id."' AND Soc=4 AND Booked_status=0 and floor_no='".$floorid."'")->row(); 
			 return $result->available;
			 
		 }
		 function get_all_count_complaint(){
			 $status=lang('Completed');
		$result = $this->db->query(" SELECT COUNT(complain_id)AS complaint FROM add_complain ac 
                  LEFT JOIN add_unit au ON  au.uid=ac.Unit_id
                  LEFT JOIN floors f   ON au.`floor_no`=f.`id`
                  WHERE  Complaint_status !='".$status."'")->row();
	  return $result->complaint;
	}

	function Get_users(){
		$result=$this->db->query("SELECT * FROM `users` WHERE user_role !=1")->result();
		return $result;
		
		
	}
	function Checkoutsaves($reservation_payment_array,$reservation_serviceAmount,$booked_id){
		if($booked_id){
		          if($reservation_payment_array){
			          $this->db->delete('booked_payments', array('Booked_id' => $booked_id));
		    	      foreach ($reservation_payment_array as $reservation_payment) {
		             $this->db->insert('booked_payments',$reservation_payment);
				  }
				  }
				   if($reservation_serviceAmount){
			        
		    	      foreach ($reservation_serviceAmount as $reservation_serviceAmountS) {
		             $this->db->insert('Booking_servicesPayment',$reservation_serviceAmountS);
				  }
				   }
		           	$data=array('IS_checkout'=>1);
			        $this->db->where('id',$booked_id);
			        $this->db->update('booking',$data);
			
			
	    }else{
			return false;
			
		}
		
	return true;
	}
	
}