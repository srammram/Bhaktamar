<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{
	function getUsers(){
		$this->db->select("*");
		$this->db->where("active",1);
		$query=$this->db->get("users");
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	function getGroups(){
		$this->db->select("*");
		$query=$this->db->get("groups");
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;
		
	}
	function getUsersByid($id){
		$this->db->select("*");
		$this->db->where("active",1);
		$this->db->where("id",$id);
		$query=$this->db->get("users");
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	 function save($save){
        if (!empty($save['id'])){
            $this->db->where('id',$save['id']);
            $this->db->update('users', $save);
            return $id;
        }else{
			$this->db->insert('users', $save);
			if($save['is_employee']){
				$this->db->insert('employee',array('first_name'=>$save['first_name'],'email'=>$save['email'],'termination'=>1));
			}
			 return $this->db->insert_id();
        }
    }
}
