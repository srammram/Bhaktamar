<?php
Class Parking_model extends CI_Model{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	function getall(){
		$result = $this->db->get('parking_slot');
        return $result->result();
	}
	
	function save($save){
	  if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('parking_slot', $save);
            return $save['id'];
        }else{
            $this->db->insert('parking_slot', $save);
            return $this->db->insert_id();
        }
	}
	function delete($id){
		$this->db->where('id', $id);
        $this->db->delete('parking_slot');
	}
	function get($id){
		$this->db->select("parking_slot.*,project.Name project,building_info.name building,floors.name floors,add_unit.unit_name unit");
		$this->db->join("project","project.id=parking_slot.project_id","left");
		$this->db->join("building_info","building_info.bldid=parking_slot.unit_id","left");
		$this->db->join("floors","floors.id=parking_slot.floor_id","left");
		$this->db->join("add_unit","add_unit.uid=parking_slot.unit_id","left");
		$this->db->where("parking_slot.id",$id);
		$q=$this->db->get("parking_slot");
		if($q->num_rows()>0){
			return $q->row() ;
		}
		return false;
	}
     
}