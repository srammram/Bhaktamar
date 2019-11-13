<?php
Class Setting_model extends CI_Model{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	function get(){
		$this->db->where('id', 1);
		$result = $this->db->get('settings');
        return $result->row();
    }
    function save($save){
        if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('settings', $save);
            return $save['id'];
        }else{
            $this->db->insert('settings', $save);
            return $this->db->insert_id();
        }
    }
	  function get_all(){ 
		 $result = $this->db->query('select * from ownertype where Soft_delete=1')->result();
         return $result;
	 }
     function get_Ownertype($id){ 
	     $data=array('id'=>$id,'Soft_delete'=>1);
		 $this->db->where($data);
		 $result = $this->db->get('ownertype');
         return $result->row();
	 }
    function OwnerTypesave($save){
        if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('ownertype', $save);
            return $save['id'];
        }else{
            $this->db->insert('ownertype', $save);
            return $this->db->insert_id();
        }
      }
	   function Ownertype_delete($id){ 
	     $save=array('Soft_delete'=>0);
		 $this->db->where('id', $id);
		 $result = $this->db->update('ownertype',$save);
         return $id;
	   }
     function get_ProjectType_all(){
		 $result=$this->db->query("SELECT * FROM `projecttypes` WHERE soft_delete=0")->result();
		 return $result;
	 }
	  function get_ProjectType($id){
		 $result=$this->db->query("SELECT * FROM `projecttypes` WHERE soft_delete=0 and id='".$id."'")->row();
		 return $result;
	  }
	     function ProjectTypesave($save){
        if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('projecttypes', $save);
            return $save['id'];
        }else{
            $this->db->insert('projecttypes', $save);
            return $this->db->insert_id();
        }
    }
	function  ProjectTypedelete($id){
		  $save=array('Soft_delete'=>0);
		  $this->db->where('id', $id);
		  $result = $this->db->update('projecttypes',$save);
          return $id;
	}
	 function get_amenities_all(){
		 $result=$this->db->query("SELECT   a.id ,  NAME ,p.ProjectType as Property, a.Description FROM  amenties a
         LEFT JOIN projecttypes p ON p.id=a.id WHERE a.Soft_delete=0")->result();
		 return $result;
	 }
	  function get_amenities($id){
		 $result=$this->db->query("SELECT   a.id, AmenitiesPrice,AmenitiesType, NAME ,p.ProjectType, Perperty_type,a.Description FROM  amenties a
         LEFT JOIN projecttypes p ON p.id=a.id WHERE a.Soft_delete=0 and a.id='".$id."'")->row();
		 return $result;
	  }
	     function Amenitiessave($save){
        if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('amenties', $save);
            return $save['id'];
        }else{
            $this->db->insert('amenties', $save);
            return $this->db->insert_id();
        }
    }
	function  Amenitiesdelete($id){
		  $save=array('Soft_delete'=>1);
		  $this->db->where('id', $id);
		  $result = $this->db->update('amenties',$save);
          return $id;
	}
	function get_AmenitiesType(){
		 $result=$this->db->query("SELECT * FROM `projecttypes` WHERE soft_delete=0")->result();
		 return $result;
	}
		function SOC_all(){
		 $result=$this->db->query("SELECT * FROM `soc` WHERE Soft_delete=1")->result();
		 return $result;
	}
	function SOC_get($id){
		 $result=$this->db->query("SELECT * FROM `soc` WHERE Soft_delete=1 and id='".$id."'")->row();
		 return $result;
	}
    function Socsave($save){
        if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('soc', $save);
            return $save['id'];
        }else{
            $this->db->insert('soc', $save);
            return $this->db->insert_id();
        }
    }
	function  Socdelete($id){
		  $save=array('Soft_delete'=>0);
		  $this->db->where('id', $id);
		  $result = $this->db->update('soc',$save);
          return $id;
	}
	function  get_userrole_permission($id){
		  $result = $this->db->get_where('permissions',array('Soft_delete'=>1,'Group_id'=>$id))->row();
          return $result;
	}
	function  get_userrole(){
		  $result = $this->db->get_where('user_role',array('Soft_delete'=>1))->result();
          return $result;
	}
	function updatePermissions($id,$data,$UserGroup){
		 $result = $this->db->get_where('permissions',array('Group_id'=>$UserGroup));
		if($result->num_rows()>0){
			$this->db->where('Group_id',$UserGroup);
			$update=$this->db->update('permissions',$data);
			if($update){
				return true;
			}else{ return false; }
		}else{
			$insert=$this->db->insert('permissions',$data);
			if($insert){
				return true;
			}else{ 
			return false;
			}
		}
	}
	
	function GetUserlist(){
		$result=$this->db->get_where('user_role',array('soft_delete'=>1))->result();
		return $result;
    	}
  function userroleAdd($data){
	  $insert=$this->db->insert('user_role',$data);
		if($insert){
			return true;
		}else{
			return false;
		}
	}
	function getedituserrole($id){
		$result=$this->db->get_where('user_role',array('Id'=>$id))->row();
		return $result;
	}
	function userroleeditsave($id,$data){
		$this->db->where('Id',$id);
		$this->db->update('user_role',$data);
		return true;
	}
	 public function Approved_record_count() {
       return $this->db->count_all("approved_stage");
      }
     function get_all_approved_stage($limit,$start){
		$this->db->where('Soft_delete',0);
		 $this->db->limit($limit, $start);
          $query = $this->db->get("approved_stage");
       if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
   function get_all_soc(){
          $query = $this->db->get("soc");
       if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
	function getApproved_stage($id){
		$this->db->select('approved_stage.*,soc.Name as socname');
		$this->db->join('soc','soc.id=approved_stage.Project_stage_id','left');
		$this->db->where('approved_stage.id',$id);
		$query=$this->db->get('approved_stage');
		$result=$query->row();
		return $result;
	}
	  
	    function Add_approved_stage($save){
        if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('approved_stage', $save);
            return $save['id'];
        }else{
            $this->db->insert('approved_stage', $save);
            return $this->db->insert_id();
        }
    }
	    function Aproved_stage_delete($id){
        if ($id){
            $this->db->where('id', $id);
            $this->db->update('approved_stage', array('Soft_delete'=>1));
            return $id;
        }
	}
	
	
	
	 public function UOM_record_count() {
       return $this->db->count_all("uom");
   }
     function get_all_UOM($limit,$start)
    {
		$this->db->where('Soft_delete',0);
		 $this->db->limit($limit, $start);
          $query = $this->db->get("uom");
       if ($query->num_rows() > 0) {
 
           foreach ($query->result() as $row) {
 
               $data[] = $row;
           }
           return $data;
       }
       return false;
 
    }
	
	function getUOM($id){
		
		$result=$this->db->get_where('uom',array('Id'=>$id))->row();
		return $result;
		return $result;
	}
	  
	    function Add_UOM($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('uom', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('uom', $save);
            return $this->db->insert_id();
        }
    }
	    function UOM_delete($id)
    {
        if ($id)
        {
            $this->db->where('id', $id);
            $this->db->update('uom', array('Soft_delete'=>1));
            return $id;
        }
	}
	
	
	
	
	 public function material_record_count() {
       return $this->db->count_all("material");
   }
     function get_all_material($limit,$start)
    {
		$this->db->where('Soft_delete',0);
		 $this->db->limit($limit, $start);
          $query = $this->db->get("material");
       if ($query->num_rows() > 0) {
 
           foreach ($query->result() as $row) {
 
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
	
	function getMaterial($id){
		$result=$this->db->get_where('material',array('Id'=>$id))->row();
		return $result;
		return $result;
	}
	    function Add_Material($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('material', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('material', $save);
            return $this->db->insert_id();
        }
    }
	    function Material_delete($id)
        {
        if ($id)
        {
            $this->db->where('id', $id);
            $this->db->update('material', array('Soft_delete'=>1));
            return $id;
        }
	   }
	 public function LabourType_record_count() {
       return $this->db->count_all("labourtype");
     }
     function get_all_LabourType($limit,$start)
      {
		$this->db->where('Soft_delete',0);
		 $this->db->limit($limit, $start);
          $query = $this->db->get("labourtype");
        if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
	
	function getLabourType($id){
		$result=$this->db->get_where('labourtype',array('Id'=>$id))->row();
		return $result;
		return $result;
	}
	    function Add_LabourType($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('labourtype', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('labourtype', $save);
            return $this->db->insert_id();
        }
    }
	    function Labour_delete($id)
        {
        if ($id)
        {
            $this->db->where('id', $id);
            $this->db->update('labourtype', array('Soft_delete'=>1));
            return $id;
        }
	   }
	
    function soe()
	   {
		$this->db->select('*');
		$this->db->where('Soft_delete',1);
		$query=$this->db->get('soe');
		 return $query->result();
	}
	function soe_get($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$query=$this->db->get('soe');
		return $query->row();
	}
    function soesave($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('soe', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('soe', $save);
            return $this->db->insert_id();
        }
    }
	function  soedelete($id)
	{
		  $save=array('Soft_delete'=>0);
		  $this->db->where('id', $id);
		  $result = $this->db->update('soe',$save);
          return $id;
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
	function getRequestType($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query=$this->db->get('request_type');
		$result=$query->row();
		return $result;
	}
	  
	    function add_requestType($save)
       {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('request_type', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('request_type', $save);
            return $this->db->insert_id();
        }
    }
	    function delete_requestType($id)
       {
        if ($id)
        {
            $this->db->where('id', $id);
            $this->db->update('request_type', array('soft_delete'=>1));
            return $id;
        }
	}
	function get_requestType_Category(){
		$this->db->select('request_category.*,request_type.Name as request_typeName,request_type.id as request_typeId');
		$this->db->join('request_type','request_type.id=request_category.request_typeid','left');
		$this->db->where('request_category.soft_delete',0);
		$query=$this->db->get('request_category');
		
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	
	function get_requestCategorybyid($id){
		$this->db->select('request_category.*,request_type.Name as request_typeName,request_type.id as request_typeId');
		$this->db->join('request_type','request_type.id=request_category.request_typeid','left');
		$this->db->where('request_category.id',$id);
		$query=$this->db->get('request_category');
		$result=$query->row();
		return $result;
	}
	  
	    function add_requestCategory($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('request_category', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('request_category', $save);
            return $this->db->insert_id();
        }
    }
	    function requestCategory_delete($id)
    {
        if ($id)
        {
            $this->db->where('id', $id);
            $this->db->update('request_category', array('soft_delete'=>1));
            return $id;
        }
	}
	
	function get_requestType_SubCategory(){
	    $this->db->select('request_subcategory.*,request_type.Name as request_typeName,request_type.id as request_typeId,request_category.id as categopryid,request_category.Name as categoryName');
		$this->db->join('request_type','request_type.id=request_subcategory.request_typeid','left');
		$this->db->join('request_category','request_category.id=request_subcategory.category_id','left');
		$this->db->where('request_subcategory.soft_delete',0);
		$query=$this->db->get('request_subcategory');
		
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	
	function get_request_subCategorybyid($id){
		$this->db->select('request_subcategory.*,request_type.Name as request_typeName,request_type.id as request_typeId,request_category.id as categopryid,request_category.Name as categoryName');
		$this->db->join('request_type','request_type.id=request_subcategory.request_typeid','left');
		$this->db->join('request_category','request_category.id=request_subcategory.category_id','left');
		$this->db->where('request_subcategory.id',$id);
		$query=$this->db->get('request_subcategory');
		$result=$query->row();
		return $result;
	}
	  
	    function add_requestSubCategory($save)
    {
        if ($save['id'])
        {
            $this->db->where('id', $save['id']);
            $this->db->update('request_subcategory', $save);
            return $save['id'];
        }
        else
        {
            $this->db->insert('request_subcategory', $save);
            return $this->db->insert_id();
        }
    }
	    function request_subCategory_delete($id)
    {
        if ($id)
        {
            $this->db->where('id', $id);
            $this->db->update('request_category', array('soft_delete'=>1));
            return $id;
        }
	}
	
	function get_category(){
		$this->db->select('*');
		$this->db->where('request_category.soft_delete',0);
		$query=$this->db->get('request_category');
		
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
		
	}
	function getRequestby($ownertype){
		
		if($ownertype  ==1){
			$this->db->select("o_name as Name,ownid as id");
			$this->db->where('Soft_deleted',1);
			$query=$this->db->get('add_owner');
			return $query->result();
		}else{
		    $this->db->select("firstname as Name,id as id");
			$this->db->where('Soft_deleted',1);
			$query=$this->db->get('leaseowner');
			return $query->result();
		}
		return  false;
    }
    function get_unitstatusByid($id){
        $q=$this->db->get_where('unit_status',array('soft_deleted'=>0,'status_id'=>$id));
        if ($q->num_rows()>0) {
           return $q->row();
        }
        return false;
        }
    function unitStatus_save($save){
        if (!empty($save['status_id'])){
                $this->db->where('status_id',$save['contractor_id']);
                $this->db->update('unit_status', $save);
                return $id;
            }
            else  {
                $this->db->insert('unit_status', $save);
                return $this->db->insert_id();
            }
        }
      
        function get_unitStatus(){
            $this->db->select("*");
            $this->db->where("soft_delete",0);
            $q=$this->db->get("unit_status");
            if($q->num_rows()>0){
               foreach($q->result() as $row){
                 $data[]=$row;
               }
               return $data;
            }
            return false;
        }
      function uniStatusDelete($id)
      {
          $this->db->where('status_id', $id);
          if ($this->db->update('unit_status', array('soft_deleted'=>1))) {
              return true;
          } else {
              return false;
          }
      }
	  
	     function get_unitIntensionByid($id){
        $q=$this->db->get_where('unit_intension',array('soft_delete'=>0,'intension_id'=>$id));
        if ($q->num_rows()>0) {
           return $q->row();
        }
        return false;
        }
    function unitIntension_save($save){
        if (!empty($save['intension_id'])){
                $this->db->where('intension_id',$save['intension_id']);
                $this->db->update('unit_intension', $save);
                return $id;
            }
            else  {
                $this->db->insert('unit_intension', $save);
                return $this->db->insert_id();
            }
        }
      
        function get_unitIntension(){
            $this->db->select("*");
            $this->db->where("soft_delete",0);
            $q=$this->db->get("unit_intension");
            if($q->num_rows()>0){
               foreach($q->result() as $row){
                 $data[]=$row;
               }
               return $data;
            }
            return false;
        }
      function unitIntensionDelete($id)
      {
          $this->db->where('intension_id', $id);
          if ($this->db->update('unit_intension', array('soft_delete'=>1))) {
              return true;
          } else {
              return false;
          }
      } 
	  
	   function get_unitGroupTypeByid($id){
        $q=$this->db->get_where('unit_group_type',array('soft_delete'=>0,'id'=>$id));
        if ($q->num_rows()>0) {
           return $q->row();
        }
        return false;
        }
    function unitGroupType_save($save){
        if (!empty($save['id'])){
                $this->db->where('id',$save['id']);
                $this->db->update('unit_group_type', $save);
                return $id;
            }
            else  {
                $this->db->insert('unit_group_type', $save);
                return $this->db->insert_id();
            }
        }
      
        function get_unitGroupType(){
            $this->db->select("*");
            $this->db->where("soft_delete",0);
            $q=$this->db->get("unit_group_type");
            if($q->num_rows()>0){
               foreach($q->result() as $row){
                 $data[]=$row;
               }
               return $data;
            }
            return false;
        }
      function unitGroupTypeDelete($id)
      {
          $this->db->where('id', $id);
          if ($this->db->update('unit_group_type', array('soft_delete'=>1))) {
              return true;
          } else {
              return false;
          }
      } 
	  
	  
	   function get_unitTypeByid($id){
        $q=$this->db->get_where('unit_type',array('Soft_delete'=>0,'id'=>$id));
        if ($q->num_rows()>0) {
           return $q->row();
        }
        return false;
        }
    function unitType_save($save){
        if (!empty($save['id'])){
                $this->db->where('id',$save['id']);
                $this->db->update('unit_type', $save);
                return $id;
            }
            else  {
                $this->db->insert('unit_type', $save);
                return $this->db->insert_id();
            }
        }
      
        function get_unitType(){
            $this->db->select("*");
            $this->db->where("Soft_delete",0);
            $q=$this->db->get("unit_type");
            if($q->num_rows()>0){
               foreach($q->result() as $row){
                 $data[]=$row;
               }
               return $data;
            }
            return false;
        }
      function unitTypeDelete($id)
      {
          $this->db->where('id', $id);
          if ($this->db->update('unit_type', array('Soft_delete'=>1))) {
              return true;
          } else {
              return false;
          }
      } 
	  
	  
	  
	    function get_unitGroup_type(){
            $this->db->select("*");
            $this->db->where("soft_delete",0);
            $q=$this->db->get("unit_group_type");
            if($q->num_rows()>0){
               foreach($q->result() as $row){
                 $data[]=$row;
               }
               return $data;
            }
            return false;
        }


        function get_idTypeByid($id){
            $q=$this->db->get_where('id_type',array('soft_delete'=>0,'id'=>$id));
            if ($q->num_rows()>0) {
               return $q->row();
            }
            return false;
            }
        function idType_save($save){
            if (!empty($save['id'])){
                    $this->db->where('id',$save['id']);
                    $this->db->update('id_type', $save);
                    return $id;
                }
                else  {
                    $this->db->insert('id_type', $save);
                    return $this->db->insert_id();
                }
            }
          
            function get_idType(){
                $this->db->select("*");
                $this->db->where("soft_delete",0);
                $q=$this->db->get("id_type");
                if($q->num_rows()>0){
                   foreach($q->result() as $row){
                     $data[]=$row;
                   }
                   return $data;
                }
                return false;
            }
          function idTypeDelete($id)
          {
              $this->db->where('id', $id);
              if ($this->db->update('id_type', array('soft_delete'=>1))) {
                  return true;
              } else {
                  return false;
              }
          }
		   function get_contractorByid($id){
        $q=$this->db->get_where('contractor',array('soft_delete'=>0,'contractor_id'=>$id));
        if ($q->num_rows()>0) {
           return $q->row();
        }
        return false;
        }
		 function contractor_save($save){
        if (!empty($save['contractor_id'])){
                $this->db->where('contractor_id',$save['contractor_id']);
                $this->db->update('contractor', $save);
                return $id;
            }
            else  {
                $this->db->insert('contractor', $save);
                return $this->db->insert_id();
            }
        }
      
        function get_contractor(){
            $this->db->select("*");
            $this->db->where("soft_delete",0);
            $q=$this->db->get("contractor");
            if($q->num_rows()>0){
               foreach($q->result() as $row){
                 $data[]=$row;
               }
               return $data;
            }
            return false;
        }
	  function contractDelete($id){
         $this->db->where('contractor_id',$id);
         if($this->db->update('contractor',array('soft_delete'=>1))){
             return true;
      }else{
          return false;
      }
    }
    function people_settings_save($save){
        if (!empty($save['id'])){
                $this->db->where('id',$save['id']);
                $this->db->update('peoples_settings', $save);
                return $id;
            }
            else  {
                $this->db->insert('peoples_settings', $save);
                return $this->db->insert_id();
            }
        }
        function get_peopleSettings(){
            $q=$this->db->get_where('peoples_settings',array('soft_delete'=>0));
            if ($q->num_rows()>0) {
               return $q->row();
            }
            return false;
         }
		 
		 function get_group_permission($id){
			 $query=$this->db->get_where("permissions",array("Group_id"=>$id));
			 if($query->num_rows()>0){
				 return $query->row();
			 }
			 return false;
		 }
		   public function getGroupByID($id){
             $q = $this->db->get_where('groups', array('id' => $id), 1);
              if ($q->num_rows() > 0) {
               return $q->row();
             }
        return FALSE;
    }
	function group_permission_update($data,$id){
		$query=$this->db->get_where("permissions",array("Group_id"=>$id))->row();
		if(!empty($query)){
			$this->db->where("Group_id",$id);
			$this->db->update("permissions",$data);
		}else{
			$this->db->insert("permissions",$data);
			return true;
		}
		return false;
	}
	  function get_uom(){
		 $this->db->select("*");
		 $this->db->where("Soft_delete",0);
		 $query=$this->db->get("uom");
		 if($query->num_rows()>0){
			foreach($query->result() as $row) {
				$data[]=$row;
		 }
		 return $data;
	     }
	     return false;
	   }
	  
}