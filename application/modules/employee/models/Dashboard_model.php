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
	   
	
}