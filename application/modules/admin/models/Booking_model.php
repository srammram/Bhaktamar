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
function booking_save($save,$payment_plan){   
if(!empty($save['id'])){
	$booking=$this->getbookingByid($save['id']);
	$this->db->where('id',$save['id']);
	$this->db->update("booking",$save);
	/* $this->db->where('booking_id',$save['id']);
	$this->db->delete('booking_payment_details'); */
	$this->db->where('booking_id',$save['id']);
	$this->db->where_not_in('paid_status',0);
	$this->db->delete('booking_payment_plan');
	/* foreach($paymentdetails as $row){
		$row['booking_id']=$save['id'];
	    $this->db->insert('booking_payment_details',$row);
	} */
	foreach($payment_plan as $row){
		$row['booking_id']=$save['id'];
	    $this->db->insert('booking_payment_plan',$row);
	}
	$this->payment_status_update($save,$save['id']);
	$this->unitActive($booking->unit_id,$save['unit_id']);
	return true;
	
}else{
	 $this->db->insert('booking',$save);
	 $booking_id = $this->db->insert_id();
	/*  foreach($paymentdetails as $row){
		$row['booking_id']=$booking_id;
	    $this->db->insert('booking_payment_details',$row);
	} */
	foreach($payment_plan as $row){
		$row['booking_id']=$booking_id;
	    $this->db->insert('booking_payment_plan',$row);
	}
	$this->payment_status_update($save,$booking_id);
	$this->unitActive(NULL,$save['unit_id']);
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
function unitActive($oldunitid,$newunitid){
	if(!empty($oldunit)){
		$this->db->where('uid',$oldunitid);
		$this->db->update('add_unit',array('Booked_status'=>0));
	}
		$this->db->where('uid',$newunitid);
		$this->db->update('add_unit',array('Booked_status'=>1));
		return true;
}
function booking_delete($id){
		$this->db->where("id",$id);
		$this->db->update("booking",array("soft_delete"=>1));
		return true;
	}
  function payment_plan(){
	$this->db->select("*");
	$this->db->where("soft_delete",0);
	$q=$this->db->get("booking_payment_master");
	if($q->num_rows()>0){
		foreach($q->result() as $row){
				$data[]=$row;
		}
		return $data;
	}
	return false;
}
 function bookingwise_payment_plan($bookingid){
	$this->db->select("booking_payment_plan.*,booking_payment_master.name");
	$this->db->join("booking_payment_master","booking_payment_master.id=booking_payment_plan.payment_planid","left");
	$this->db->where("booking_id",$bookingid);
	$q=$this->db->get("booking_payment_plan");
	if($q->num_rows()>0){
		foreach($q->result() as $row){
				$data[]=$row;
		}
		return $data;
	}
	return false;
}
function payment_status_update($save,$booking_id){
	$this->db->select("payment_planid");
	$this->db->where("project_id",$save['project_id']);
	$this->db->where("building_id",$save['building_id']);
	$this->db->where("payment_planid !=",0);
	$this->db->where("status !=","complete");
	$this->db->group_by('payment_planid'); 
	$q=$this->db->get("task");
	if($q->num_rows()>0){
	 foreach($q->result() as $row)	{
		 $this->db->where("booking_id",$booking_id);
		 $this->db->where("payment_planid",$row->payment_planid);
		 $this->db->where("paid_status !=",0);
		 $this->db->update("booking_payment_plan",array("paid_status"=>2));
		 
	 }
	}
}
 function add_payment($data,$bookingid,$paymentid){
	$this->db->where(array("booking_id"=>$bookingid,"payment_planid"=>$paymentid));
	if($this->db->update("booking_payment_plan",array("paid_status"=>0))){
		$this->db->insert("booking_payment_details",$data);
		$this->db->set('balance', 'balance-'.$data['amount'], FALSE);
		$this->db->where('id',$bookingid );
		$this->db->update('booking');
		return true;
	}
	return false;
 }
	function due_paymentlist($bookingid){
	$this->db->select("booking_payment_plan.*,booking_payment_master.name");
	$this->db->join("booking_payment_master","booking_payment_master.id=booking_payment_plan.payment_planid","left");
	$this->db->where("booking_id",$bookingid);
	$this->db->where("paid_status !=",0);
	$q=$this->db->get("booking_payment_plan");
	if($q->num_rows()>0){
		foreach($q->result() as $row){
		$data[]=$row;
		}
		return $data;
	}
	}
	function add_partial_payment($bookingid,$paymentid,$paiddate,$partial_amount){
		$this->db->where("booking_id",$bookingid);
		$this->db->where_in("id",$paymentid);
		if($this->db->update("booking_payment_plan",array("paid_status"=>0))){
			$this->db->select("*");
			$this->db->where("booking_id",$bookingid);
			$this->db->where_in("id",$paymentid);
			$q=$this->db->get("booking_payment_plan");
			if($q->num_rows()>0){
				foreach($q->result() as $row){
			$data=array("booking_id"=>$bookingid,"date"=>$paiddate,
		           "amount"=>$row->amount,
		           "note"=>"Partial Amountpaid on".$paiddate);
			$this->db->insert("booking_payment_details",$data);
				}
				$this->db->set('balance', 'balance-'.$partial_amount, FALSE);
		        $this->db->where('id',$bookingid );
		        $this->db->update('booking');
			}
			return true;
		}
		return false;
	}
	function undo_paid_payment($bookingid,$paymentid,$amount){
		$this->db->where(array("booking_id"=>$bookingid,"payment_planid"=>$paymentid));
	    if($this->db->update("booking_payment_plan",array("paid_status"=>1))){
		  $this->db->where(array("booking_id"=>$bookingid,"paymentid"=>$paymentid));
		  $this->db->delete("booking_payment_details");
		  $this->db->set('balance', 'balance+'.$amount, FALSE);
		  $this->db->where('id',$bookingid );
		  $this->db->update('booking');
		  return true;
		}
		return false;
	}
}
