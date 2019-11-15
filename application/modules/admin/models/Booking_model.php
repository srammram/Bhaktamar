<?php
Class Booking_model extends CI_Model{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	function getbuilding(){
		$this->db->select('*');
		$this->db->where('soft_delete',0);
		$query= $this->db->get('building_info');
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
	}
  function findmaxId(){
	  $this->db->select(" IFNULL(MAX(id),0)+1 AS `maxid`");
	  $q=$this->db->get("booking");
	  if($q->num_rows()>0){
		  return $q->row('maxid');
	  }
	  return false;
  }
   function get_floor($buildingid){
	   $this->db->select("*");
	   $this->db->where("building_id",$buildingid);
	   $q=$this->db->get('floors');
	if($q->num_rows()>0){
		   foreach($q->result() as $row){
			$data[]=$row;
		}
		return $data;
	   }
	   return false;
   }
    function get_units($floor_no){
	   $this->db->select("*");
	   $this->db->where("floor_no",$floor_no);
	   $q=$this->db->get("add_unit");
	   if($q->num_rows()>0){
		   foreach($q->result() as $row){
			$data[]=$row;
		}
		return $data;
	   }
	   return false;
   }
  
  function getbookingByid($id){
	$this->db->select("*");
	$this->db->where("soft_delete",0);
	$q=$this->db->get('booking');
	if($q->num_rows()>0){
		return $q->row();
	}
	return fasle;
  }
function booking_save($save,$paymentdetails){   
if(!empty($save['id'])){
	$this->db->where('id',$save['id']);
	$this->db->update("booking",$save);
	$this->db->where('booking_id',$save['id']);
	$this->db->delete('booking_payment_details');
	foreach($paymentdetails as $row){
		$row['booking_id']=$save['id'];
	    $this->db->insert('booking_payment_details',$row);
	}
	return true;
	
}else{
	 $this->db->insert('booking',$save);
	 $booking_id = $this->db->insert_id();
	 foreach($paymentdetails as $row){
		$row['booking_id']=$booking_id;
	    $this->db->insert('booking_payment_details',$row);
	}
	return true;
}
return false;
}
function get_payment_details($bookingid){
	$this->db->select("*");
	$this->db->where("booking_id",$bookingid);
	$q=$this->db->get("booking_payment_details");
	if($q->num_rows()>0){
		foreach($q->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}
}
