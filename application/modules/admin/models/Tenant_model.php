<?php
class Tenant_model  extends CI_Model  {

	
	
	
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
				"tenant_id"=>$save['tentant_id'],
                "user_role"=>3,
                "firstname"=>$save['firstname'],"building_id"=>$save['building_id'],"floor_id"=>$save['floor_id'],
                "lastname"=>$save['surname']);
                 $this->db->where('id',$save['tentant_id']);
                 $this->db->update('tenant_login', $data);
					 if($save['tenant_type'] !=lang('Owner_unit')){
				$this->db->where(array("Project_id"=>$save['project_id'],"building_id"=>$save['building_id'],"uid"=>$save['unitid']));
				$this->db->update("add_unit",array("Booked_status"=>1)); 
					 }else{
						 $this->db->where(array("project_id"=>$save['project_id'],
				"building_id"=>$save['building_id'],"unit_id"=>$save['unitid']));
				$this->db->update("add_owner_unit_relation",array("book_status"=>1,"tenant_id"=>$save['tentant_id'],"tenantType"=>2)); 
						 
					 }
					 if($save['tenant_type'] == lang('Lease')){
						 
					 $save['tenant_creadted_by']=2;
				     $save['tentant_id']=$save['tentant_id'];
					 $save['balanceamount']=$save['amount'];
					 $this->db->where('tentant_id',$save['tentant_id']);
					 $this->db->update("tenant_agreement",$save);
					 }
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
			 	  if($save['tenant_type'] !=lang('Owner_unit')){
				$this->db->where(array("Project_id"=>$save['project_id'],"building_id"=>$save['building_id'],"uid"=>$save['unitid']));
				$this->db->update("add_unit",array("Booked_status"=>1)); 
					 }else{
						 $this->db->where(array("project_id"=>$save['project_id'],
				"building_id"=>$save['building_id'],"unit_id"=>$save['unitid']));
				$this->db->update("add_owner_unit_relation",array("book_status"=>1,"tenant_id"=>$tenantid,"tenantType"=>2)); 
						 
					 }
				}
			if($save['tenant_type'] == lang('Lease')){
				unset($save['id']);
				$save['tenant_creadted_by']=2;
				$save['tentant_id']=$tenantid;
				$save['balanceamount']=$save['amount'];
				$this->db->insert('tenant_agreement', $save);
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
	
	public function get_ownerWiseTentUnit($projectid,$buildingid,$unitid){
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
				"add_owner_unit_relation.building_id"=>$buildingid,"add_owner_unit_relation.unit_id"=>$unitid));
        $query = $this->db->get("add_owner_unit_relation");
        if ($query->num_rows() > 0) {
               foreach($query->result() as $row){
				   $data[]=$row;
			   }
			  return $data;
        }
        return false;
		
	} 
	public function get_TenantUnit($projectid,$buildingid,$unitid,$type){
		if($type !=lang('Owner_unit')){
		$this->db->select('*');
        $this->db->where('Soft_delete', 0);
        $this->db->where('Booked_status', 0);
		//for lease unit
		$this->db->where('intention', 1);
        $this->db->where('Project_id', $projectid);
        $this->db->where('building_id',$buildingid);
		$this->db->or_where_in("add_unit.uid",$unitid);
        $query = $this->db->get('add_unit');
		}else{
		$this->db->select('add_owner_unit_relation.*,uid,unit_name');
		$this->db->join("add_unit","add_unit.uid=add_owner_unit_relation.unit_id");
        $this->db->where('add_owner_unit_relation.soft_deleted', 0);
        $this->db->where('add_owner_unit_relation.book_status', 0);
		$this->db->where('is_lease', 1);
        $this->db->where('add_owner_unit_relation.project_id', $projectid);
        $this->db->where('add_owner_unit_relation.building_id',$buildingid);
		$this->db->or_where_in("add_owner_unit_relation.id",$unitid);
        $query = $this->db->get('add_owner_unit_relation');
		}
        if ($query->num_rows() > 0) {
               foreach($query->result() as $row){
				   $data[]=$row;
			   }
			  return $data;
        }
        return false;
		
	} 
	 function get_Project(){
      	$this->db->select('*');
		$this->db->where('soft_delete',0);
		$this->db->where('project_status','Ongoing');
		$this->db->or_where('project_status','Completed');
		$query= $this->db->get('project');
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
	 public function get_units($projectid,$buildingid)
    {
        $this->db->select('*');
        $this->db->where('Soft_delete', 0);
        $this->db->where('Booked_status', 0);
		//for lease unit
		$this->db->where('intention', 1);
        $this->db->where('Project_id', $projectid);
        $this->db->where('building_id',$buildingid);
        $query = $this->db->get('add_unit');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	 public function get_Ownerunits($projectid,$buildingid)
    {
        $this->db->select('add_owner_unit_relation.*,uid,unit_name');
        $this->db->where('add_owner_unit_relation.soft_deleted', 0);
        $this->db->where('add_owner_unit_relation.book_status', 0);
		$this->db->where('is_lease', 1);
        $this->db->where('add_owner_unit_relation.project_id', $projectid);
        $this->db->where('add_owner_unit_relation.building_id',$buildingid);
		$this->db->join("add_unit","add_unit.uid=add_owner_unit_relation.unit_id");
        $query = $this->db->get('add_owner_unit_relation');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
}
