<?php
Class Employee_model extends CI_Model
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
		$result = $this->db->get('users');
        return $result->result();
    }
	function get($id)
    {
		$this->db->where('id', $id);
		$result = $this->db->get('users');
        return $result->row();
    }
    function save($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('users', $save);
            return $save['id'];
        }
        else
        {
            
            $this->db->insert('users', $save);
            return $this->db->insert_id();
        }
    }
    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }
    function check_username($username){
		$this->db->where('username', $username);
		$result = $this->db->get('users');
        return $result->row();
	}
	function employee_salary_all()
	{
		
       $result = $this->db->query('SELECT es.id,Employee_id , designation , Select_month , Amount,  Issued_date,  firstname FROM  
       employee_salary es
       LEFT JOIN users u ON u.id=es.Employee_id WHERE Soft_delete=1');
        return $result->result();
    }
	function employee_salary($id)
	{
		$result = $this->db->query("SELECT es.id,Employee_id , designation , Select_month , Amount,  Issued_date,  firstname FROM  
       employee_salary es
       LEFT JOIN users u ON u.id=es.Employee_id WHERE Soft_delete=1 and es.id='".$id."'");
        return $result->row();
    }
		
   function get_employee()
   {
	        $result = $this->db->query('SELECT id , firstname  FROM users');
            return $result->result();
   }
   function Get_designation($id)
   {
	     $result = $this->db->query("
         SELECT d.id,d.name FROM users u
         LEFT JOIN designation d ON u.id=d.id WHERE u.id='".$id."'");
         return $result->row(); 
   }
		 function Employee_save($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('employee_salary', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('employee_salary', $save);
            return $this->db->insert_id();
        }
    }
	
		 function Employee_Delete($id)
         {
          $save=array('Soft_delete'=>0);
            $this->db->where('id', $id);
            $this->db->update('employee_salary', $save);
            return $id;
         
		
	}

}