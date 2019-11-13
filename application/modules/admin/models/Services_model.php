<?php
Class Services_model extends CI_Model
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
		$result = $this->db->get('services');
        return $result->result();
    }
	function get($id)
    {
		$this->db->where('id', $id);
		$result = $this->db->get('services');
        return $result->row();
    }
    function save($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('services', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('services', $save);
            return $this->db->insert_id();
        }
    }
	 
    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('services');
    }
    function get_project(){
		$result = $this->db->get('project');
        return $result->result();
	}
    function Get_unit()
	{
		$result=$this->db->query("SELECT uid   FROM (SELECT * FROM project ORDER BY  id DESC LIMIT 1)p
 LEFT JOIN add_unit au ON au.Project_id=p.id")->result();
 return $result;
		
	} function Get_project_unit($id)
	{
		$result=$this->db->query("SELECT uid ,unit_no  FROM (SELECT * FROM project ORDER BY  id DESC LIMIT 1)p
 LEFT JOIN add_unit au ON au.Project_id=p.id where p.id='".$id."'")->result();
 return $result;
		
	}
	function Complaint_get()
	{
		$result=$this->db->query("  SELECT * FROM   `add_complain` ac
       LEFT JOIN add_unit au ON au.uid=ac.Unit_id
       WHERE Type_category=2")->result();
          return $result;
	}
	function Project_complaint($id)
	{
		$result=$this->db->query("  SELECT * FROM   `add_complain` ac
 LEFT JOIN add_unit au ON au.uid=ac.Unit_id
 LEFT JOIN project p ON p.id=au.Project_id
 WHERE Type_category=2 AND  p.id='".$id."'")->result();
       return $result;
	}
	function Unit_complaint($id,$unit)
	{
		$result=$this->db->query("  SELECT * FROM   `add_complain` ac
 LEFT JOIN add_unit au ON au.uid=ac.Unit_id
 LEFT JOIN project p ON p.id=au.Project_id
 WHERE Type_category=2 AND  p.id='".$id."' and au.uid='".$unit."'")->result();
       return $result;
	}
	
	
	function Amenities_Complaint_get()
	{
		$result=$this->db->query("  SELECT * FROM   `add_complain` ac
       LEFT JOIN add_unit au ON au.uid=ac.Unit_id
       WHERE Type_category=1")->result();
          return $result;
	}
	function Amenities_Project_complaint($id)
	{
		$result=$this->db->query("  SELECT * FROM   `add_complain` ac
 LEFT JOIN add_unit au ON au.uid=ac.Unit_id
 LEFT JOIN project p ON p.id=au.Project_id
 WHERE Type_category=1 AND  p.id='".$id."'")->result();
       return $result;
	}
	function Amenities_Unit_complaint($id,$unit)
	{
		$result=$this->db->query("  SELECT * FROM   `add_complain` ac
 LEFT JOIN add_unit au ON au.uid=ac.Unit_id
 LEFT JOIN project p ON p.id=au.Project_id
 WHERE Type_category=1 AND  p.id='".$id."' and au.uid='".$unit."'")->result();
       return $result;
	}
	
}