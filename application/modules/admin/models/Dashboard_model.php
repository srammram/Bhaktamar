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
       function Get_owner()
	   {
		 $result = $this->db->query('SELECT COUNT(ownid) AS owners FROM `add_owner`')->row();
        return $result;  
		   
	   }
	   
	   function Get_Employee()
	   {
		 $result = $this->db->query('SELECT COUNT(eid)AS Employee FROM   `add_employee`')->row();
        return $result;  
	   }
	    function Get_Manage()
	   {
		 $result = $this->db->query('SELECT count(mc_members) as mem FROM  `add_management_committee`')->row();
         return $result;  
		   
	   }
	       function Get_Services()
	   {
		 $result = $this->db->query('SELECT COUNT(id)AS services FROM  `services`')->row();
         return $result;  
		   
	   }
	     function Get_Guest()
	   {
		 $result = $this->db->query('SELECT COUNT(id) AS Guest FROM `guests`')->row();
         return $result;  
		   
	  }
	   function Get_vip()
	   {
		 $result = $this->db->query('SELECT COUNT(id) AS vip FROM  guests WHERE vip=1')->row();
         return $result;  
		   
	   }
	 function Get_month_Revenue()
	   {
		 $result = $this->db->query("SELECT SUM(total_amount) AS MONTH FROM `add_bill`  WHERE Soft_delete=1 AND Paid_Status='Paid' AND  YEAR(bill_date) =YEAR(CURRENT_DATE())  AND MONTH(bill_date) = MONTH(CURRENT_DATE())")->row();
         return $result;  
		   
	   }
function Get_Year_Revenue()
	   {
		 $result = $this->db->query("SELECT SUM(total_amount) AS MONTH FROM `add_bill`  WHERE Soft_delete=1 AND Paid_Status='Paid' AND  YEAR(bill_date) =YEAR(CURRENT_DATE())  ")->row();
         return $result;  
		   
	   }
	   
	   function Get_Project()
	   {
		 $result = $this->db->query("
        SELECT  id  ,NAME   FROM `project` WHERE Soft_delete=1 ORDER BY created_on DESC ")->result();
         return $result;  
		   
	   }
	   
	   function Get_Units($id)
	   {
		 $result = $this->db->query("SELECT p.Name, unit_no, uid ,Percentage FROM `project` p
LEFT JOIN add_unit au ON au.Project_id=p.id
LEFT JOIN soc s ON s.id=au.Soc
WHERE p.Name='".$id."' ORDER BY au.uid ASC ")->result();
         return $result;  
		   
	   }
	    function Get_Unit()
	   {
		 $result = $this->db->query("SELECT p.Name, unit_no, uid ,Percentage FROM `project` p
                     LEFT JOIN add_unit au ON au.Project_id=p.id
                     LEFT JOIN soc s ON s.id=au.Soc
                      ORDER BY au.uid ASC")->result();
         return $result;  
		   
	   }
       function get_Owner_units($ownertype)
		 {
			$result = $this->db->query("SELECT  ownid,Owner_unit   FROM `add_owner` ao 
			LEFT JOIN ownertype ot ON ot.id=ao.ownid
			WHERE Owner_type='".$ownertype."'")->result();
			return $result;  
		 }
		   function Get_Unit_groups($ownertypeid,$soc)
	     {
		   $result = $this->db->query("SELECT uid,unit_no,Booked_status FROM `add_unit` au
                                       LEFT JOIN soc  ON au.Soc=soc.`id`
                                       WHERE Unit_groupType='".$ownertypeid."' AND  au.soc='".$soc."' ")->result();
            return $result;  
	   }
	      function TotalOwner()
	   {
		   $result = $this->db->query(" SELECT COUNT(ownid) AS OWNER FROM  `add_owner` WHERE Owner_type=11")->row();
           return $result;  
	   }
}