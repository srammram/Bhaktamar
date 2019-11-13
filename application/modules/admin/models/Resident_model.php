<?php
Class Resident_model extends CI_Model
{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	
    function get_all(){
		$result = $this->db->query('SELECT * FROM `resident` WHERE soft_deleted=0')->result();
        return $result;
    }
	function get($id){
		$result = $this->db->query("SELECT * FROM `resident` WHERE residentid='".$id."' and soft_deleted=0")->row();
        return $result;
    }
	function get_floor(){
		$result = $this->db->query("SELECT * FROM floors WHERE active=1")->result();
        return $result;
	}
    function save($save){
        if (!empty($save['residentid'])){
            $resident=$this->db->get_where('resident',array('residentid'=>$save['residentid']))->row();
                $this->db->where('residentid', $save['residentid']);
                if($this->db->update('resident', $save)){
                    $this->db->where("resident_id",$save['residentid']);
                    $this->db->update('resident_units',array("start_date"=> $save['start_date'],
                    "end_date"=>$save['end_date'],
                    "members"=>$save['family_members'],
                    "unit_id"=>$save['units'] ,
                    "project_id"=> $save['project_id'],
                    "building_id"=>$save['building_id'] ));
                /*  $data=array("username"=>$save['full_name'],
                 "email"=>$save['email'],
                 "contact"=>$save['handphone'],
                 "address"=>$save['permanent_address'],
                "per_address"=>$save['permanent_address'],
                "nid"=>$save['id_no'],"Owner_unit"=>$save['units'],
                "Owner_type"=>2,"project_id"=>$save['project_id'],
                "Owner_id"=>$save['residentid'],"ownertype"=>2,
                "user_role"=>2,
                "firstname"=>$save['firstname'],
                "lastname"=>$save['surname']);
                 $this->db->where('Owner_id',$save['residentid']);
                 $this->db->update('owner_login', $data); */
                }
            return $save['residentid'];
        }else{
            if($this->db->insert('resident', $save)){
                $residnet_id=$this->db->insert_id();
             /*    $data=array("username"=>$save['full_name'],
                "email"=>$save['email'],
                "contact"=>$save['handphone'],"address"=>$save['permanent_address'],
                "per_address"=>$save['permanent_address'],"nid"=>$save['id_no'],"Owner_unit"=>$save['units'],
                "Owner_type"=>2,"project_id"=>$save['project_id'],"Owner_id"=>$residnet_id,"ownertype"=>2,"user_role"=>2,
                "firstname"=>$save['firstname'],"lastname"=>$save['surname'],"password"=>$save['password']);
                $this->db->insert('owner_login', $data); */
                    $this->db->insert("resident_units",  array("start_date"=> $save['start_date'],
                    "end_date"=>$save['end_date'],
                    "members"=>$save['family_members'],
                    "unit_id"=>$save['units'] ,
                    "project_id"=> $save['project_id'],
                    "building_id"=>$save['building_id'] ));
            }
            return $residnet_id;
        }
    }
	 
    function delete($id){
        $this->db->where('residentid', $id);
        $this->db->delete('resident');
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
     function  getOwnerDetails($unit_id,$projectid,$buildingid){
      /*  $this->db->select('*');
        $this->db->where('FIND_IN_SET('.$unit_id.', units)');
        $this->db->where('project_id',$projectid);
        $this->db->where('building_id',$buildingid);
        $query=$this->db->get("owner");
     */
    
    $this->db->select("owner.*");
    $this->db->join("owner","owner.ownid=add_unit.owner_id","left");
    $this->db->where(array("add_unit.Project_id"=>$projectid,"add_unit.building_id"=>$buildingid,"uid"=>$unit_id));
    $query=$this->db->get("add_unit");
        if($query->num_rows()>0){
         return $query->row();
        }
       return false;
     }
     public function get_buidling(){
        $query= $this->db->get_where('building_info', array('soft_delete' => 0));
         if ($query->num_rows() > 0) {
             foreach ($query->result() as $row) {
                 $data[] = $row;
             }
             return $data;
         }
         return false;
     }   
     public function get_floors(){
        $query= $this->db->get_where('floors', array('Soft_delete' => 0));
         if ($query->num_rows() > 0) {
             foreach ($query->result() as $row) {
                 $data[] = $row;
             }
             return $data;
         }
         return false;
     }   
     public function get_units(){
        $query= $this->db->get_where('add_unit', array('Soft_delete' => 0));
         if ($query->num_rows() > 0) {
             foreach ($query->result() as $row) {
                 $data[] = $row;
             }
             return $data;
         }
         return false;
     }   
     public function get_Owner(){
        $query= $this->db->get_where('owner', array('soft_deleted' => 0));
         if ($query->num_rows() > 0) {
             foreach ($query->result() as $row) {
                 $data[] = $row;
             }
             return $data;
         }
         return false;
     }   
}