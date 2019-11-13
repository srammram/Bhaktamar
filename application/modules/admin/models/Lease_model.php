<?php
class Lease_model  extends CI_Model  {
		public function get_ownerWiseUnit($ownerid){
		$this->db->select("add_owner_unit_relation.id,add_owner_unit_relation.book_status,unit_name,project.Name project,floors.name as floors,building_info.name building");
		$this->db->join("project","project.id=add_owner_unit_relation.project_id","left");
		$this->db->join("floors","floors.id=add_owner_unit_relation.floor_id","left");
		$this->db->join("add_unit","add_unit.uid=add_owner_unit_relation.unit_id","left");
		$this->db->join("building_info","building_info.bldid=add_owner_unit_relation.building_id","left");
        $this->db->where("soft_deleted", 0);
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
	function get_ownerunit($unitid){
		$this->db->select("add_owner_unit_relation.id,add_owner_unit_relation.book_status,unit_name,project.Name project,floors.name as floors,building_info.name building");
		$this->db->join("project","project.id=add_owner_unit_relation.project_id","left");
		$this->db->join("floors","floors.id=add_owner_unit_relation.floor_id","left");
		$this->db->join("add_unit","add_unit.uid=add_owner_unit_relation.unit_id","left");
		$this->db->join("building_info","building_info.bldid=add_owner_unit_relation.building_id","left");
        $this->db->where("soft_deleted", 0);
        $this->db->where("add_owner_unit_relation.id", $unitid);
        $query = $this->db->get("add_owner_unit_relation");
		
        if ($query->num_rows() > 0) {
             return   $query->row();
			   }
        return false;
	}
	  function unit_request_save($save){
		  $units_details=$this->db->get_where('add_owner_unit_relation',array("id"=>$save['owner_realtion_unitid']))->row();
		  $save['projectid']=$units_details->project_id;
		  $save['buildingid']=$units_details->building_id;
		  $save['floorid']=$units_details->floor_id;
		  $save['unitid']=$units_details->unit_id;
        if ($save['id']){
			$save['is_read_owner']=2;
            $this->db->where('id', $save['id']);
            $this->db->update('owner_unit_request', $save);
            return $save['id'];
        }else{
			$save['is_read_owner']=2;
            $this->db->insert('owner_unit_request', $save);
            $request_id=$this->db->insert_id();
			return $request_id;
        }
	}
	function get_allRequest(){
		$this->db->select("owner_unit_request.id,owner_unit_request.request_status,unit_name,project.Name project,floors.name as floors,building_info.name building,requesteddate,title,request_type,owner_realtion_unitid");
		$this->db->join("project","project.id=owner_unit_request.projectid","left");
		$this->db->join("floors","floors.id=owner_unit_request.floorid","left");
		$this->db->join("add_unit","add_unit.uid=owner_unit_request.unitid","left");
		$this->db->join("building_info","building_info.bldid=owner_unit_request.buildingid","left");
        $this->db->where("soft_deleted", 0);
        $query = $this->db->get("owner_unit_request");
      if ($query->num_rows() > 0) {
               foreach($query->result() as $row){
				   $data[]=$row;
			   }
			  return $data;
        }
        return false;
	}
	
	function getrequestView($requestid){
		$this->db->select("owner_unit_request.id,owner_unit_request.request_status,unit_name,project.Name project,floors.name as floors,building_info.name building,requesteddate,owner_realtion_unitid,title,request_type,tenure,tenure_type,expect_amount,owner_description,commission_type  ,commission,pmc_description,pmc_suggest_amount,owner_accept,pmc_approved,enquiry,services,maintenance_services,maintenance_amount,period,owner_approved");
		$this->db->join("project","project.id=owner_unit_request.projectid","left");
		$this->db->join("floors","floors.id=owner_unit_request.floorid","left");
		$this->db->join("add_unit","add_unit.uid=owner_unit_request.unitid","left");
		$this->db->join("building_info","building_info.bldid=owner_unit_request.buildingid","left");
        $this->db->where("soft_deleted", 0);
        $this->db->where("owner_unit_request.id", $requestid);
        $query = $this->db->get("owner_unit_request");
      if ($query->num_rows() > 0) {
              return $query->row();
			  }
        return false;
	}
    function  get_request($requestid){
		$this->db->select("owner_unit_request.*,owner_unit_requesttype.link,owner_unit_requesttype.view_link");
		$this->db->join("owner_unit_requesttype","owner_unit_requesttype.id=owner_unit_request.request_type","left");
        $this->db->where("soft_deleted", 0);
        $this->db->where("owner_unit_request.id", $requestid);
        $query = $this->db->get("owner_unit_request");
      if ($query->num_rows() > 0) {
              return $query->row();
			  }
        return false;
		
	}
	                                                  
	function generate_maintenance_agreements($agrements_details){
		$start_date = date('Y-m-d');
		if($agrements_details->tenure_type == lang('month')){
			$enddate=date("Y-m-d", strtotime("+".$agrements_details->tenure." month", $start_date));
		}else{
			$enddate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($start_date)) . " + ".$agrements_details->tenure." year"));
		}
		$data=array(
		"owner_id"=>$agrements_details->owner_id,
		"projectid"=>$agrements_details->projectid,
		"buildingid"=>$agrements_details->buildingid,
		"floorid"=>$agrements_details->floorid,
		"unitid"=>$agrements_details->unitid,
		"requesteddate"=>$agrements_details->requesteddate,
		"tenure_type"=>$agrements_details->tenure_type,
		"tenure"=>$agrements_details->tenure,
		"maintenance_amount"=>$agrements_details->maintenance_amount,
		"pmc_id"=>$agrements_details->pmc_id,
		"maintenance_services"=>$agrements_details->maintenance_services,
		"services"=>$agrements_details->services,
		"period"=>$agrements_details->period,
		"request_id"=>$agrements_details->id,
		"start_date"=>$start_date,
		"end_date"=>$enddate
		);
		  
		if($this->db->insert("owner_maintenance_agreements",$data)){
			return true;
		}else{
			return false;
		}
		
	}
}
