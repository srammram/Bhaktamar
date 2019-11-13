<?php
Class ManageCommittee_Model extends CI_Model{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
    function get_all(){
		   $result = $this->db->query('SELECT * FROM `add_management_committee` amc
           LEFT JOIN owner aw ON aw.ownid=amc.mc_Leader ')->result();
           return $result;
    }
	function get($id){
		$this->db->select("add_management_committee.*,owner.full_name");
		$this->db->join("owner","owner.ownid=add_management_committee.mc_Leader","left");
		$this->db->where("mc_id",$id);
		$query=$this->db->get("add_management_committee");
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
    }
	function get_floor(){
		$result = $this->db->query("SELECT * FROM floors WHERE active=1")->result();
        return $result;
	}
    function save($save,$id){
        if ($id){
            $this->db->where('mc_id', $id);
            $this->db->update('add_management_committee', $save);
            return $id;
         }
        else{
            $this->db->insert('add_management_committee', $save);
		    return $this->db->insert_id();
        }
    }
	 function delete($id){
        $this->db->where('mc_id', $id);
        $this->db->delete('add_management_committee');
    }
    function Get_Owner(){
	    $result = $this->db->query("SELECT ownid , full_name FROM `owner`")->result();
        return $result;
	}
    function Get_Member($member){
		$ids = join("','",$member);   
	    $result = $this->db->query("SELECT ownid , full_name FROM `owner` where ownid in ('".$ids."')")->result();
        return $result;
	}
    
   
}