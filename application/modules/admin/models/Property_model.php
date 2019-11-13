<?php
Class Property_model extends CI_Model
{
    var $CI;
    function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
		
    }
	    function Get_Unit()
	   {
		 $result = $this->db->query("SELECT p.Name, unit_no, uid ,Percentage FROM `project` p
                     LEFT JOIN add_unit au ON au.Project_id=p.id
                     LEFT JOIN soc s ON s.id=au.Soc
                     ORDER BY au.uid ASC")->result();
         return $result;  
	   }
         function get_Owner_unit($ownertype)
		 {
			$result = $this->db->query("SELECT  ownid,Owner_unit   FROM `add_owner` ao 
			LEFT JOIN ownertype ot ON ot.id=ao.ownid
			WHERE Owner_type='".$ownertype."'")->result();
			return $result;  
		 }
		  function Get_Unit_group($units_id,$soc)
	   {
		   $units_id=join("','",$units_id);  
		   $result = $this->db->query("SELECT p.Name, unit_no, uid ,Percentage,s.Name AS socs,s.Description  FROM `project` p
            LEFT JOIN add_unit au ON au.Project_id=p.id
            LEFT JOIN soc s ON s.id=au.Soc
            WHERE uid IN ('".$units_id."') AND au.Soc='".$soc."'")->result();
         return $result;  
	   }
	   function TotalOwner()
	   {
		   $result = $this->db->query(" SELECT COUNT(ownid) AS OWNER FROM  `add_owner` WHERE Owner_type=11")->row();
           return $result;  
	   }
	   function TotalOwner_unit_under_con()
	   {
		   $result = $this->db->query(" SELECT COUNT(ownid) AS OWNER FROM  `add_owner` WHERE Owner_type=11")->row();
           return $result;  
	   }
}