<?php
Class Floor_model extends CI_Model
{

    var $CI;

    function __construct(){
        parent::__construct();

        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
		
		
    }
	
    function get_all()
    {
		$result = $this->db->get('floors');
        return $result->result();
    }
	
	function get($id){
		$this->db->where('id', $id);
		$result = $this->db->get('floors');
        return $result->row();
    }
    function save($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('floors', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('floors', $save);
            return $this->db->insert_id();
        }
    }
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('floors');
    }
       function get_Project(){
		$query =$this->db->get_where('project',array('soft_delete'=>0)); 
		if($query->num_rows()>0){
			foreach($query->result()  as $row){
				$data[]=$row;
			}
			return $data;
		}
		return  false;
	   }
   function floorIfexists($id){
       $query=$this->db->get_where('add_unit',array('floor_no'=>$id))->result();
       if(!empty($query)){
          return false;
       }else{
           return true;
       }
   }
   
   function   get_buildingProjectWise($projectid){
	   $query=$this->db->get_where('building_info',array('project_id'=>$projectid));
	   if($query->num_rows()>0){
	   foreach($query->result() as $row){
		   $data[]=$row;
	   }
	   return $data;
	   }
	   return false;
   }
   
   
}