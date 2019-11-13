<?php
Class Complaint_model extends CI_Model
{

    var $CI;
    function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
    function get_all()
    {
		$result = $this->db->get('add_complain');
        return $result->result();
    }
	function Guest_check($email,$mobile,$password){
		  $result=$this->db->query("SELECT * FROM `guests` WHERE email='".$email."' OR mobile='".$mobile."' AND Soft_deleted=1")->row();
		  if(!empty($result->id)){
			  return $result;
		  }else{
			  return false;
		  }
		
	}
	function Update_guest_password($password,$guest_id,$Imei){
		
		$this->db->where('id',$guest_id);
		$update=$this->db->update('guests',array('password' => sha1($password),'IMEI'=>$Imei,'Is_registerd'=>1));
		if($update){
		return true;
		}else{ return false; 
		}
	}
	function CHeck_guest_user($username){
		
		$result=$this->db->query("SELECT * FROM `guests` WHERE email='".$username."' OR mobile='".$username."' or firstname='".$username."' AND Soft_deleted=1")->row();
		  if(!empty($result->id)){
			  return true;
		  }else{
			  return false;
		  }
		
	}
	function Guestlogincheck($username,$password){
		 	$result=$this->db->query("SELECT id ,firstname,lastname ,gender,dob ,email  , password     FROM `guests` WHERE email='".$username."' OR mobile='".$username."' or firstname='".$username."' AND Soft_deleted=1")->row();
		  if(!empty($result->password)){
			   if(($result->password)== sha1($password))
			   {
				   return $result;
		  }else{
			  return false;
		  }
		  }
	}
	function get_services(){
		$result=$this->db->query('select id , Service_name from services')->result();
		return $result();
	}
	function Get_amenities(){
		$result = $this->db->query("SELECT    id,  NAME    FROM `amenties`   WHERE Soft_delete=1")->result();
        return $result;
	}
	function get_complaint($guest_id)
	{
		$result = $this->db->query("SELECT complain_id,  c_title   ,          c_description ,        c_date,IsReviwed,
case when IsReviwed=0 then 'Not Done'
when IsReviwed=1 then 'Done' end  as reviewstatus
FROM `add_complain` WHERE Guest_id='".$guest_id."'")->result();
        return $result;
		
	}
	function Complaint_booking($data){
		$insert=$this->db->insert('add_complain',$data);
		if($insert){
		return true;
		}else{
			return false;
		}
	}
	function  ReviewUpdate($data,$complaintid){
		$this->db->where('complain_id',$complaintid);
		$update=$this->db->update('add_complain',$data);
		if($update){
		return true;
		}else{ return false; 
		}
		
	}
}