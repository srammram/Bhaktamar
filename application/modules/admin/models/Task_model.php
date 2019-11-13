<?php
Class Task_model extends CI_Model{
    var $CI;
    function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	 public function Project_record_count() {
	   $this->db->from('project');
       $this->db->where('Soft_delete',0);
	   return  $this->db->count_all_results();
   }
    function get_all(){
		 $this->db->select("*");
		 $this->db->or_where("project_status", lang('Ongoing'));
		 $this->db->or_where("project_status",lang('Completed'));
		 $this->db->or_where("project_status",lang('OnHold'));
		 $query=$this->db->get("project p");
         if($query->num_rows()>0){
			 foreach($query->result() as $row){
			 $data[]=$row;
			 }
			 return $data;
		 }
		 return false;
    
}
function get_project(){
	  $this->db->select("*");
	  $this->db->where("soft_delete",0);
	  $q=$this->db->get("project");
	  if($q->num_rows()>0){
		  foreach($q->result() as $row){
			  $data[]=$row;
		  }
		  return $data;
	  }
	return false;
}
function get_task(){
	$this->db->select("*");
	  $this->db->where("soft_delete",0);
	  $q=$this->db->get("task");
	  if($q->num_rows()>0){
		  foreach($q->result() as $row){
			  $data[]=$row;
		  }
		  return $data;
	  }
	return false;
}

function get($id = false){
	  $this->db->select("task.*,project.Name project,soc.Name as stage,first_name ,  last_name");
	  $this->db->where("task.soft_delete",0);
	  $this->db->join("project","project.id=task.project_id","left");
	  $this->db->join("soc","soc.id=task.stage_id","left");
	  $this->db->join("employee","employee.id=task.assign_to","left");
	 // $this->db->join("task","","");
	  $this->db->where("task.id",$id);
	  $q=$this->db->get("task");
	  if($q->num_rows()>0){
		  return $q->row();
	  }
	return false;
	
}

function get_project_stages(){
	$this->db->select("*");
	$this->db->where("soft_delete",1);
	$q=$this->db->get("soc");
	if($q->num_rows()>0){
     foreach($q->result() as $row){
			  $data[]=$row;
	   }
		  return $data;
	  }
	return false;
	
}

function get_employee(){
	$this->db->select("*");
	  $this->db->where("soft_delete",0);
	  $q=$this->db->get("employee");
	  if($q->num_rows()>0){
		  foreach($q->result() as $row){
			  $data[]=$row;
		  }
		  return $data;
	  }
	return false;
}
function save($save){
	if($save['id']){
		$this->db->where("id",$save['id']);
		$this->db->update("task",$save);
		return true;
		
	}else{
		$this->db->insert("task",$save);
		return true;
	}
	
	
}
}