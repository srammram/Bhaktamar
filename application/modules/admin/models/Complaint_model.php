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
	function get($id)
    {
		$this->db->where('complain_id', $id);
		$result = $this->db->get('add_complain');
        return $result->row();
    }
    function save($save,$ids)
    {
        if ($ids)
        {
            $this->db->where('complain_id', $ids);
            $this->db->update('add_complain', $save);
            return $ids;
        }
        else
        {
            $this->db->insert('add_complain', $save);
            return $this->db->insert_id();
        }
    }
	 
    function delete($id)
    {
        $this->db->where('complain_id', $id);
        $this->db->delete('add_complain');
    }
    function Get_owner()
    {
		$result = $this->db->get('add_owner');
        return $result->result();
	}
	function Get_amenities()
	{
		$result = $this->db->query("SELECT    id,  NAME    FROM `amenties`   WHERE Soft_delete=1")->result();
        return $result;
	}
	function Get_Services()
	{
		$result = $this->db->query("SELECT id , Service_name  AS NAME FROM `services` WHERE Soft_delete=1")->result();
        return $result;
	}
   function Get_types($id)
   {
	   switch($id)
	   {
		  case 1:
				$result = $this->db->query("SELECT    id,  Name    FROM `amenties`   WHERE Soft_delete=1")->result();
		  break;
          case 2:		  
		       $result = $this->db->query("SELECT id , Service_name  AS Name FROM `services` WHERE Soft_delete=1")->result();
		   break;
	   }
	    return $result;
	   
   }
   function GetUnit_list()
	{
		$result=$this->db->query("SELECT uid, unit_no FROM    add_unit WHERE Soft_delete=1")->result();
        return $result;
		
	}
	 function Get_complaint($id)
	{
		$result=$this->db->query(" SELECT * FROM   `add_complain` ac
 LEFT JOIN add_unit au ON au.uid=ac.Unit_id
 WHERE complain_id='".$id."'")->row();
        return $result;
		
	}
function Get_users(){
		$result=$this->db->query("SELECT * FROM `users` WHERE user_role !=1")->result();
		return $result;
		
		
	}
}