<?php
Class Dashboard_model extends CI_Model
{

    var $CI;

    function __construct()
    {
        parent::__construct();

        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
       function  request(){
		   $this->db->select("*");
		   $this->db->where("Soft_delete",1);
		   $query=$this->db->get("request");
		   if($query->num_rows()>0){
			   foreach($query->result()  as $row){
		             $data[]=$row;		   
			   }
			    return $data;
		   }
		   return false;
	   }
	   
	public function get_ownerWiseUnit($ownerid){
		$this->db->select("add_owner_unit_relation.id,add_owner_unit_relation.book_status,unit_name,project.Name project,floors.name as floors,building_info.name building");
		$this->db->join("project","project.id=add_owner_unit_relation.project_id","left");
		$this->db->join("floors","floors.id=add_owner_unit_relation.floor_id","left");
		$this->db->join("add_unit","add_unit.uid=add_owner_unit_relation.unit_id","left");
		$this->db->join("building_info","building_info.bldid=add_owner_unit_relation.building_id","left");
        $this->db->where("soft_deleted", 0);
        //$this->db->where('Booked_status', 0);
        $this->db->where("add_owner_unit_relation.owner_id", $ownerid);
        $query = $this->db->get("add_owner_unit_relation");
        if ($query->num_rows() > 0) {
               foreach($query->result() as $row){
				   $data[]=$row;
			   }
			  return $data;
        }
        return false;
		
	} 
}