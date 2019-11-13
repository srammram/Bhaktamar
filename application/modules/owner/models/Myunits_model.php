<?php
class Myunits_model  extends CI_Model  {
		public function get_ownerWiseUnit($ownerid){
		$this->db->select("add_owner_unit_relation.id,add_owner_unit_relation.book_status,unit_name,project.Name project,floors.name as floors,building_info.name building");
		$this->db->join("project","project.id=add_owner_unit_relation.project_id","left");
		$this->db->join("floors","floors.id=add_owner_unit_relation.floor_id","left");
		$this->db->join("add_unit","add_unit.uid=add_owner_unit_relation.unit_id","left");
		$this->db->join("building_info","building_info.bldid=add_owner_unit_relation.building_id","left");
        $this->db->where("soft_deleted", 0);
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
            $this->db->where('id', $save['id']);
            $this->db->update('owner_unit_request', $save);
            return $save['request_id'];
        }else{
			$save['is_read_pmc']=2;
            $this->db->insert('owner_unit_request', $save);
            $request_id=$this->db->insert_id();
			return $request_id;
        }
	}
	function get_allRequest($ownerid){
		$this->db->select("owner_unit_request.id,owner_unit_request.request_status,unit_name,project.Name project,floors.name as floors,building_info.name building,requesteddate,title,request_type,owner_realtion_unitid,link,view_link");
		$this->db->join("project","project.id=owner_unit_request.projectid","left");
		$this->db->join("floors","floors.id=owner_unit_request.floorid","left");
		$this->db->join("add_unit","add_unit.uid=owner_unit_request.unitid","left");
		$this->db->join("building_info","building_info.bldid=owner_unit_request.buildingid","left");
		$this->db->join("owner_unit_requesttype","owner_unit_requesttype.id=owner_unit_request.request_type","left");
        $this->db->where("soft_deleted", 0);
        $this->db->where("owner_unit_request.owner_id", $ownerid);
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
	 function unit_selfLease_request_enquiry_save($enquiry){
		 $id=$enquiry['id'];
		 unset($enquiry['id']);
		 for($i=0; $i<count($enquiry['name']); $i++){
			if(!empty($enquiry['name'][$i]) ){
			   $data[] = array(
				'name' =>$enquiry['name'][$i],
				'enquirydate' =>$enquiry['enquiryDate'][$i],
				'phone' => $enquiry['phone'][$i],
				'mobile' =>$enquiry['mobile'][$i],
				'email' =>$enquiry['email'][$i],
				'address' =>$enquiry['address'][$i],
				'message' =>$enquiry['message'][$i],
				'enquirystatus' =>$enquiry['enquirystatus'][$i]	);
				$this->leasecomission_generate($enquiry['enquirystatus'][$i],$id);
			
		 }
	   } 
		$this->db->where("id",$id);
		$this->db->update("owner_unit_request",array("enquiry"=>json_encode($data)));
		
		return true;
	}
	function leasecomission_generate($enquirystatus,$id){
		switch ($enquirystatus){
			case 0:
			     $this->db->where("id",$id);
				 $this->db->update("owner_unit_request",array("is_closed"=>1,"is_closed_by"=>"Owner"));
				 
			break;
			case 1:
			     $this->db->where("id",$id);
				 $this->db->update("owner_unit_request",array("is_closed"=>1,"is_closed_by"=>"Owner"));
				 $this->generate_commission($id);
			break;
		}
		return true;
		
	}
	
	function   generate_commission($id){
		$unitRequest=$this->db->get_where("owner_unit_request",array("id"=>$id))->row();
		 if(!empty($unitRequest->pmc_suggest_amount)){
			    $leaseAmount=0;
                   if($unitRequest->commission_type == lang('percentage')){
					   $leaseAmount=($unitRequest->pmc_suggest_amount/100)*$unitRequest->commission;
				   }else{
					   $leaseAmount=$unitRequest->commission;
				   }
		 }		
		 $data=array("owner_id"=>$unitRequest->owner_id,
		 "owner_realtion_unitid"=>$unitRequest->owner_realtion_unitid,
		 "projectid"=>$unitRequest->projectid,
		 "buildingid"=>$unitRequest->buildingid,
		 "floorid"=>$unitRequest->floorid,
		 "unitid"=>$unitRequest->unitid,
		 "date"=> date('Y-m-d '),
		 "reference_number"=>'SLC'.strtotime(date('Y/m/d H:i:s')),
		 "commission_amount"=>$leaseAmount,
		 "balance"=>$leaseAmount);
		 $this->db->insert("lease_commission",$data);
		 return true;
	}
	
}
