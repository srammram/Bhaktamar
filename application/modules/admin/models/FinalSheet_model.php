<?php
Class FinalSheet_model extends CI_Model{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }

	
	function get_project($id){
		$this->db->select("*");
		$this->db->where("soft_delete",0);
		$this->db->where("id",$id);
		$q=$this->db->get("project");
		if($q->num_rows()>0){
		return $q->row();
		}
		return  false;
	}
	function get_stages($stages){
		$this->db->select("*");
		$this->db->where("soft_delete",1);
		$this->db->where_in("id",json_decode($stages));
		$q=$this->db->get("soc");
		if($q->num_rows()>0){
	        foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return  false;
	}
	function get_stagesWiseTask($projectid,$stageid){
		$this->db->select("*");
		$this->db->where("soft_delete",0);
		$this->db->where("project_id",$projectid);
		$this->db->where("stage_id",$stageid);
		$q=$this->db->get("task");
		if($q->num_rows()>0){
		foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return  false;
	}
}