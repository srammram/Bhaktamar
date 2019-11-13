<?php
class Tenant_model  extends CI_Model  {

	
	function reset_password($email)
    {
       // $this->load->library('encrypt');
        $user = $this->get_user_by_email($email);
        if ($user)
        {
            $this->load->helper('string');
            $this->load->library('email');
            
            $new_password       = random_string('alnum', 8);
            $user['password']   = sha1($new_password);
            $this->save($user);
            $this->email->from($this->config->item('email'), $this->config->item('School Portal'));
            $this->email->to($email);
            $this->email->subject($this->config->item('School Portal').': Password Reset');
            $this->email->message('Your password has been reset to <strong>'. $new_password .'</strong>.');
            $this->email->send();
            return true;
        }
        else
        {
            return false;
        }
    }
	
	
	function getRequestTypeAll(){
		$this->db->select('*');
		$this->db->where('soft_delete',0);
		$query=$this->db->get('request_type');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function get_tenant($ownerid){
		$this->db->select("tentant_id,full_name,unit_name,project.Name project,building_info.name building,floors.name as floors");
		$this->db->join("project","project.id=tenant.project_id","left");
		$this->db->join("floors","floors.id=tenant.floor_id","left");
		$this->db->join("add_unit","add_unit.uid=tenant.unitid","left");
		$this->db->join("building_info","building_info.bldid=tenant.building_id","left");
        $this->db->where("soft_deleted", 0);
        //$this->db->where('Booked_status', 0);
        $this->db->where("tenant.relation_owner_id", $ownerid);
        $query = $this->db->get("tenant");
        if ($query->num_rows() > 0) {
               foreach($query->result() as $row){
				   $data[]=$row;
			   }
			  return $data;
        }
        return false;
	}
	 function get_idtype(){
        $this->db->select('*');
		$this->db->where('soft_delete',0);
		$query= $this->db->get('id_type');
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
    public function get_nationality(){
        $query= $this->db->get_where('nationalities', array('soft_delete' => 0));
         if ($query->num_rows() > 0) {
             foreach ($query->result() as $row) {
                 $data[] = $row;
             }
             return $data;
         }
         return false;
     }   
	  function save($save){
        if (!empty($save['tentant_id'])){
            $tenant=$this->db->get_where('tenant',array('tentant_id'=>$save['tentant_id']))->row();
                $this->db->where('tentant_id', $save['tentant_id']);
                if($this->db->update('tenant', $save)){
                 $data=array("username"=>$save['full_name'],
                 "email"=>$save['email'],
                 "contact"=>$save['handphone'],
                 "address"=>$save['permanent_address'],
                "per_address"=>$save['permanent_address'],
                "nid"=>$save['id_no'],"unit"=>$save['unitid'],
                "tenant_type"=>1,"project_id"=>$save['project_id'],
                "Owner_id"=>$save['relation_owner_id'],
				"tenant_id"=>$tenantid,
                "user_role"=>3,
                "firstname"=>$save['firstname'],"building_id"=>$save['building_id'],"floor_id"=>$save['floor_id'],
                "lastname"=>$save['surname']);
                 $this->db->where('id',$save['tentant_id']);
                 $this->db->update('tenant_login', $data);
				$this->db->where(array("owner_id"=>$save['relation_owner_id'],"project_id"=>$save['project_id'],
				"building_id"=>$save['building_id'],"floor_id"=>$save['floor_id'],"unit_id"=>$save['unitid']));
				$this->db->update("add_owner_unit_relation",array("book_status"=>1,"tenant_id"=>$save['tentant_id'],"tenantType"=>1)); 
                }
            return $save['tentant_id'];
        }else{
            if($this->db->insert('tenant', $save)){
                $tenantid=$this->db->insert_id();
                $data=array("username"=>$save['full_name'],
                "email"=>$save['email'],
                "contact"=>$save['handphone'],
				"address"=>$save['permanent_address'],
                "per_address"=>$save['permanent_address'],
				"nid"=>$save['id_no'],
				"unit"=>$save['unitid'],
				"building_id"=>$save['building_id'],
				"floor_id"=>$save['floor_id'],
                "tenant_type"=>1,"project_id"=>$save['project_id'],
				"Owner_id"=>$save['relation_owner_id'],
				"tenant_id"=>$tenantid,"user_role"=>3,
                "firstname"=>$save['firstname'],
				"lastname"=>$save['surname'],"password"=>$save['password']);
                if($this->db->insert('tenant_login', $data)){
			 	$this->db->where(array("owner_id"=>$save['relation_owner_id'],"project_id"=>$save['project_id'],
				"building_id"=>$save['building_id'],"floor_id"=>$save['floor_id'],"unit_id"=>$save['unitid']));
				$this->db->update("add_owner_unit_relation",array("book_status"=>1,"tenant_id"=>$tenantid,"tenantType"=>1)); 
				}
            }
            return $tenantid;
        }
    }
	function get($id){
		$query=$this->db->get_where('tenant',array('tentant_id'=>$id));
		if($query->num_rows()>0){
		return $query->row();
		}
        return false;
    }
	public function get_ownerWiseUnit($ownerid){
		$this->db->select("add_owner_unit_relation.id,uid,unit_name,project.Name project,floors.name as floors,building_info.name building");
		$this->db->join("project","project.id=add_owner_unit_relation.project_id","left");
		$this->db->join("floors","floors.id=add_owner_unit_relation.floor_id","left");
		$this->db->join("add_unit","add_unit.uid=add_owner_unit_relation.unit_id","left");
		$this->db->join("building_info","building_info.bldid=add_owner_unit_relation.building_id","left");
        $this->db->where("soft_deleted", 0);
		$this->db->where("book_status", 0);
		
        //$this->db->where('Booked_status', 0);
        $this->db->where("add_owner_unit_relation.owner_id", $ownerid);
        $query = $this->db->get("add_owner_unit_relation");
        if ($query->num_rows() > 0) {
               foreach($query->result() as $row){
				   $data[]=$row;
			   }
			  return $data;
        }
        return false;
		
	} 
	function get_ownerrealtionunit($projectid,$buildingid,$floorid,$unitid,$ownerid){
		$query=$this->db->get_where('add_owner_unit_relation',array('project_id'=>$projectid,'building_id'=>$buildingid,'floor_id'=>$floorid,'unit_id'=>$unitid,'owner_id'=>$ownerid));
		if($query->num_rows()>0){
			$unit=$query->row();
			return $unit->id;
		}
		return false;
		
	}
	
	public function get_ownerWiseTentUnit($ownerid,$projectid,$buildingid,$floor_id,$unitid){
		$query=$this->db->get_where('add_owner_unit_relation',array('project_id'=>$projectid,'building_id'=>$buildingid,'floor_id'=>$floor_id,'unit_id'=>$unitid,'owner_id'=>$ownerid));
		$unit=$query->row();
		$this->db->select("add_owner_unit_relation.id,uid,unit_name,project.Name project,floors.name as floors,building_info.name building");
		$this->db->join("project","project.id=add_owner_unit_relation.project_id","left");
		$this->db->join("floors","floors.id=add_owner_unit_relation.floor_id","left");
		$this->db->join("add_unit","add_unit.uid=add_owner_unit_relation.unit_id","left");
		$this->db->join("building_info","building_info.bldid=add_owner_unit_relation.building_id","left");
        $this->db->where("soft_deleted", 0);
		$this->db->where("book_status", 0);
		$this->db->or_where_in("add_owner_unit_relation.id",$unit->id);
        //$this->db->where('Booked_status', 0);
        $this->db->where(array("add_owner_unit_relation.owner_id"=>$ownerid,"add_owner_unit_relation.project_id"=>$projectid,
				"add_owner_unit_relation.building_id"=>$buildingid,"add_owner_unit_relation.floor_id"=>$floor_id,"add_owner_unit_relation.unit_id"=>$unitid));
        $query = $this->db->get("add_owner_unit_relation");
        if ($query->num_rows() > 0) {
               foreach($query->result() as $row){
				   $data[]=$row;
			   }
			  return $data;
        }
        return false;
		
	} 
}
