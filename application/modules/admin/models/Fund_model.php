<?php
Class Fund_model extends CI_Model
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
		$result = $this->db->query('SELECT fund_id,f_date,total_amount,purpose,owner_id,full_name,For_Month FROM `add_fund` af 
		LEFT JOIN  `owner`  ao ON ao.ownid=af.owner_id')->result();
        return $result;
    }
	function get($id)
    {
		$result = $this->db->query("SELECT fund_id,f_date,total_amount,purpose,owner_id,full_name,For_Month FROM `add_fund` af 
		LEFT JOIN  `owner`  ao ON ao.ownid=af.owner_id where fund_id=$id")->row();
        return $result;
    }
    function save($save,$ids)
    {
        if ($ids)
        {
            $this->db->where('fund_id', $ids);
            $this->db->update('add_fund', $save);
            return $ids;
        }
        else
        {
            $this->db->insert('add_fund', $save);
            return $this->db->insert_id();
        }
    }
	function reserve_fund_save($save){
        if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('reserve_fund', $save);
            return $save['id'];
        }else
        {
            $this->db->insert('reserve_fund', $save);
            return $this->db->insert_id();
        }
    }
	function get_reserve_fund($id){
		$this->db->select("reserve_fund.*,owner.full_name");
		$this->db->join("owner","owner.ownid=reserve_fund.owner_id","left");
		$this->db->where("reserve_fund.id",$id);
		$query=$this->db->get("reserve_fund");
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
		
		
	}
	 function reserve_fund_delete($id){
		 $this->db->where("id",$id);
		 if($this->db->update("reserve_fund",array("soft_delete"=>1))){
			 return true;
		 }else{
			 return false;
		 }
		 
	 }
    function delete($id)
    {
        $this->db->where('fund_id', $id);
        $this->db->delete('add_fund');
    }
    function Get_owner()
    {
		$result = $this->db->get('owner');
        return $result->result();
		
	}
   function property_management_fee_save($save){
        if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('property_management_fee', $save);
            return $save['id'];
        }else {
            $this->db->insert('property_management_fee', $save);
            return $this->db->insert_id();
        }
    }
	function get_property_management_fee_fund($id){
		$this->db->select("property_management_fee.*,owner.full_name");
		$this->db->join("owner","owner.ownid=property_management_fee.owner_id","left");
		$this->db->where("property_management_fee.id",$id);
		$query=$this->db->get("property_management_fee");
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
		
		
	}
	 function property_management_fee_delete($id){
		 $this->db->where("id",$id);
		 if($this->db->update("property_management_fee",array("soft_delete"=>1))){
			 return true;
		 }else{
			 return false;
		 }
		 
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
	function get_building($projectid){
      	$this->db->select('*');
		$this->db->where('soft_delete',0);
		$this->db->where('project_id',$projectid);
		$query= $this->db->get('building_info');
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
           return false;
    }
	   function get_OwnerbyBuilding($projectid,$buildingid){
		   $this->db->select("*");
		   $this->db->where(array("project_id"=>$projectid,"building_id"=>$buildingid));
		   $query=$this->db->get("owner");
		   if($query->num_rows()>0){
			   foreach($query->result() as $row){
				   $data[]=$row;
			   }
		   return $data;
	     }
	       return false;
	   }
	      function get_Ownerunits($projectid,$buildingid,$ownerid){
		   $this->db->select("add_owner_unit_relation.*,unit_name,uid");
		   $this->db->join("add_unit","add_unit.uid=add_owner_unit_relation.unit_id","left");
		   $this->db->where(array("add_owner_unit_relation.project_id"=>$projectid,"add_owner_unit_relation.building_id"=>$buildingid,"add_owner_unit_relation.owner_id"=>$ownerid));
		   $query=$this->db->get("add_owner_unit_relation");
		   if($query->num_rows()>0){
			   foreach($query->result() as $row){
				   $data[]=$row;
			   }
		   return $data;
	   }
	   return false;
	   }
	
}