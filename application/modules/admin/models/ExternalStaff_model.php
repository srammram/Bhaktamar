<?php
Class Externalstaff_model extends CI_Model
{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	
    function get_all(){
		$result = $this->db->query('SELECT * FROM `external_staff` WHERE soft_deleted=0')->result();
        return $result;
    }
	function get($id){
		$result = $this->db->query("SELECT * FROM `external_staff` WHERE external_staff_id='".$id."' and soft_deleted=0")->row();
        return $result;
    }
	function get_floor(){
		$result = $this->db->query("SELECT * FROM floors WHERE active=1")->result();
        return $result;
	}
    function save($save){
        if (!empty($save['external_staff_id'])){
            $external_staff=$this->db->get_where('external_staff',array('external_staff_id'=>$save['external_staff_id']))->row();
            $this->db->where_in('uid',json_decode($external_staff->units));
            if ($this->db->update('add_unit', array('Booked_status'=>0))) {
                $this->db->where('external_staff_id', $save['external_staff_id']);
                if($this->db->update('external_staff', $save)){
                 if (!empty(json_decode($save['units']))) {
                     $this->db->where_in('uid', json_decode($save['units']));
                     $this->db->update('add_unit', array('Booked_status'=>1));
                 }
                    $data=array("username"=>$save['full_name'],"email"=>$save['email'],"contact"=>$save['handphone'],"address"=>$save['permanent_address'],
                "per_address"=>$save['permanent_address'],"nid"=>$save['id_no'],"Owner_unit"=>$save['units'],
                "Owner_type"=>3,"project_id"=>$save['project_id'],"Owner_id"=>$save['external_staff_id'],"ownertype"=>3,"user_role"=>2,
                "firstname"=>$save['firstname'],"lastname"=>$save['surname']);
                 $this->db->where('Owner_id',$save['external_staff_id']);
                 $this->db->update('owner_login', $data);
                }
            }
            return $save['external_staff_id'];
        }else{
            if($this->db->insert('external_staff', $save)){
                $ownerid=$this->db->insert_id();
                $data=array("username"=>$save['full_name'],"email"=>$save['email'],"contact"=>$save['handphone'],"address"=>$save['permanent_address'],
                "per_address"=>$save['permanent_address'],"nid"=>$save['id_no'],"Owner_unit"=>$save['units'],
                "Owner_type"=>3,"project_id"=>$save['project_id'],"Owner_id"=>$ownerid,"ownertype"=>3,"user_role"=>2,
                "firstname"=>$save['firstname'],"lastname"=>$save['surname'],"password"=>$save['password']);
                $this->db->insert('owner_login', $data);
                $this->db->where_in('uid',json_decode($save['units']));
                $this->db->update('add_unit',array('Booked_status'=>1));
            }
            return $ownerid;
        }
    }
	 
    function delete($id){
        $this->db->where('external_staff_id', $id);
        $this->db->delete('external_staff');
    }
    function Get_unit(){
	    $result = $this->db->query("SELECT uid,unit_no FROM   `add_unit` WHERE Active=1")->result();
        return $result;
	}
	function Get_ownerType(){
		 $result = $this->db->get_where('unit_group_type',array('soft_delete'=>0))->result();
         return $result;
	}
    function GetOwnerUnits(){
		 $result = $this->db->get_where('add_unit',array('Soft_delete'=>1,'Unit_groupType'=>11,'Booked_status'=>0))->result();
         return $result;
    }
    function get_Project(){
      	$this->db->select('*');
		$this->db->where('soft_delete',0);
		$this->db->where('project_status','Ongoing');
		$this->db->or_where('project_status','Completed');
		$query= $this->db->get('project');
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
    function get_unitBy_project($id){
        $this->db->select('*');
		$this->db->where('Soft_delete',0);
        $this->db->where('Booked_status',0);
        $this->db->where('Project_id',$id);
		$query= $this->db->get('add_unit');
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
    function get_unitBy_projectWise($id,$units){
        $this->db->select('*');
		$this->db->where('Soft_delete',0);
        $this->db->where('Booked_status',0);
        $this->db->where('Project_id',$id);
        $this->db->or_where_in('uid',json_decode($units));
		$query= $this->db->get('add_unit');
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
    function get_idtype(){
        $this->db->select('*');
		$this->db->where('soft_delete',0);
		$query= $this->db->get('id_type');
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
    
    public function get_nationality(){
        $query= $this->db->get_where('nationalities', array('soft_delete' => 0));
         if ($query->num_rows() > 0) {
             foreach ($query->result() as $row) {
                 $data[] = $row;
             }
             return $data;
         }
         return false;
     }   
   
}