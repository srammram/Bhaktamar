<?php
class Request_model  extends CI_Model  {
	
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
	function get_requestType_Category($id){
		$this->db->select('*');
		$this->db->where('request_typeid',$id);
		$query=$this->db->get('request_category');

	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function get_requestType_SubCategory($id){
		$this->db->select('*');
		$this->db->where('category_id',$id);
		$query=$this->db->get('request_subcategory');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	
	function get_requestall($ownertype,$ownerid){
		
		$this->db->select('request.*,request_category.Name as categoryname,request_type.Name as requesttype,request_subcategory.Name as subcategory');
		$this->db->join('request_type','request_type.id=request.requesttypeId','left');
		$this->db->join('request_category','request_category.id=request.categoryId','left');
		$this->db->join('request_subcategory','request_subcategory.id=request.subcategoryId','left');
		$this->db->where('request.Soft_delete',0);
		$this->db->where('request.owner_type',$ownertype);
		$this->db->where('request.owner_id',$ownerid);
		$query=$this->db->get('request');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function getrequestView($id){
		$this->db->select('request.*,request_category.Name as categoryname,request_type.Name as requesttype,request_subcategory.Name as subcategory');
		$this->db->join('request_type','request_type.id=request.requesttypeId','left');
		$this->db->join('request_category','request_category.id=request.categoryId','left');
		$this->db->join('request_subcategory','request_subcategory.id=request.subcategoryId','left');
		$this->db->where('request.request_id',$id);
		$query=$this->db->get('request');
		if($query->num_rows()>0){
	    return  $query->row();
		}
		return false;
	}
		  
	    function request_save($save)
    {
        if ($save['request_id'])
        {
			
            $this->db->where('request_id', $save['request_id']);
            $this->db->update('request', $save);
			$this->db->insert('request_logs',array('request_id'=>$save['request_id'],'note'=>'Modified Request'));
            return $save['request_id'];
        }
        else
        {
            $this->db->insert('request', $save);
            $request_id=$this->db->insert_id();
			$this->db->insert('request_logs',array('request_id'=>$request_id,'note'=>'Request Raised'));
			return $request_id;
        }
	}
	
	function getMaterial($request_id){
		$this->db->select('*');
		$this->db->join('inv_products','inv_products.id=request_services_material.product_id','left');
		$this->db->where('request_id',$request_id);
		$query=$this->db->get('request_services_material');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
		
	}
	
	function getpayment($request_id){
		$this->db->select('*');
		$this->db->where('request_id',$request_id);
		$query=$this->db->get('request_services_payment_details');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function getRequestLogs($request_id){
		$this->db->select('*');
		$this->db->where('request_id',$request_id);
		$query=$this->db->get('request_logs');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function  requestDelete($id)
	{
		  $save=array('Soft_delete'=>1);
		  $this->db->where('request_id', $id);
		  $result = $this->db->update('request',$save);
          return $id;
	}
	function getOwnerunits($OwnerId){
		$this->db->select('add_owner_unit_relation.*,add_unit.unit_name as unit_name');
		$this->db->join("add_unit","add_unit.uid=add_owner_unit_relation.unit_id","left");
		$this->db->where('add_owner_unit_relation.owner_id',$OwnerId);
		$query=$this->db->get('add_owner_unit_relation');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function  get_unitDetails($relationalunitid){
		$query=$this->db->get_where("add_owner_unit_relation",array("id"=>$relationalunitid));
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	function  get_ownerRelationalunitDetails($unitid,$floorid,$building_id,$projectid){
		$query=$this->db->get_where("add_owner_unit_relation",array("project_id"=>$projectid,"building_id"=>$building_id,"floor_id"=>$floorid,"unit_id"=>$unitid));
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
}
