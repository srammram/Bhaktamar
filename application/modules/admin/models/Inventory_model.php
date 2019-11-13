<?php
Class Inventory_model extends CI_Model{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
   function get_all(){
        $query=$this->db->get_where("inventory",array('Soft_delete'=>1));
        if($query->num_rows()>0){
          foreach($query->result() as $row){
              $data[]=$row;
          }
          return $data;
        }
        return false;
    }
	function get($id){
        $query=$this->db->get_where("inventory",array('Soft_delete'=>1,'id'=>$id));
        if($query->num_rows()>0){
         return $query->row();
          }
        return false; 
		}
    function save($save){
        if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('inventory', $save);
            return $save['id'];
        }else{
            $this->db->insert('inventory', $save);
            return $this->db->insert_id();
        }
    }
    function delete($id){
		 $save=array('Soft_delete'=>0);
		 $this->db->where('id', $id);
         $this->db->update('inventory', $save);
         return $save['id'];
    }
	function Assets_getall(){
         $this->db->select("id, f.Facility_name,a.Facility_name as fn
         ,Assets_no, Assets_category , Assets_date  ,Assest_cost,Assets_name");
         $this->db->join("facility f","a.Facility_Name=f.Fac_id","left");
         $this->db->where("a.soft_delete",0);
         $query=$this->db->get("assets a");
         if($query->num_rows()>0){
             foreach($query->result() as $item){
                 $data[]=$item;
             }
             return $data;
         }
        return false;
		}
	function Assets_get($id){
              $this->db->select("id, f.Facility_name,a.Facility_name as fn
              ,Assets_no, Assets_category , Assets_date  ,Assest_cost,Assets_name,employee_id");
              $this->db->join("facility f","a.Facility_Name=f.Fac_id","left");
              $this->db->where("id",$id);
              $this->db->where("a.soft_delete",0);
              $query=$this->db->get("assets a");
              if ($query->num_rows()>0) {
                  return $query->row();  
            }
            return false;
	}
	function Assets_save($save){
		  if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('assets', $save);
            return $save['id'];
            }else{
            $this->db->insert('assets', $save);
            return $this->db->insert_id();
        }
	}
	function Slot_delete($id){
		$this->db->where('id', $id);
        $this->db->delete('assets');
	}
    function Get_Facility(){
		$query = $this->db->get('facility');
        if($query->num_rows()>0){
            foreach($query->result() as $item){
                $data[]=$item;
            }
            return $data;
        }
       return false;
	}
	 function Get_employee(){
		$query = $this->db->get('employee');
        if($query->num_rows()>0){
            foreach($query->result() as $item){
                $data[]=$item;
            }
            return $data;
        }
       return false;
	}
}