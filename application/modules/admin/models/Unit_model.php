<?php
Class Unit_model extends CI_Model
{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
    function get_all(){
		$result = $this->db->query('SELECT uid, pmc_id,Unit_type  ,unit_no,size ,building_id,insideunit,Active ,Project_id,au.Description,Soc,Amenities ,p.id,p.NAME as pn,s.id,s.NAME as sn,ut.id,ut.UnitType FROM `add_unit`  au
        LEFT JOIN project p ON p.id=au.Project_id
        LEFT JOIN soc  s  ON s.id=au.Soc
        LEFT JOIN unit_type ut ON ut.id=au.Unit_type
        WHERE au.Soft_delete=0')->result();
        return $result;
    }
	function get($id){
		$result = $this->db->query(" SELECT uid,pmc_id,  Unit_type ,building_id ,size ,au.address,insideunit  ,unit_no  ,Active ,unit_name, floor_no,Unit_groupType,Project_id,rateperSqft,
        areaSqft ,  unitPrice  ,au.note,status,intention,unit_name,au.attachment,contract,owner_id  ,   Soc,  Amenities ,p.id,p.NAME as pn,s.id,s.NAME as sn,ut.id,ut.UnitType FROM `add_unit`  au
         LEFT JOIN project p ON p.id=au.Project_id
         LEFT JOIN soc  s  ON s.id=au.Soc
         LEFT JOIN unit_type ut ON ut.id=au.Unit_type
         WHERE au.Soft_delete=0
         and uid='".$id."'")->row();
        return $result;
    }
    function save($save,$id){
        if (!empty($id)){
            $this->db->where('uid', $id);
            $this->db->update('add_unit', $save);
            return $id;
        }else{
            $this->db->insert('add_unit', $save);
            return $this->db->insert_id();
        }
    }
	 
    function delete($id){
        $this->db->where('uid', $id);
        $this->db->delete('add_unit');
    }
    function get_amenities(){
	   $query= $this->db->get_where('amenties',array('Soft_delete'=>0));
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
	}
     function get_SOC(){
	 $query= $this->db->get_where('soc',array('Soft_delete'=>1));
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
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
	
	  function get_Unit_type(){
		$result = $this->db->query("SELECT     id,  UnitType,display_name as unitType_name  FROM  unit_type WHERE Soft_delete=0")->result();
        return $result;
	}
	
	function Get_UnitType()
	{
		 $result = $this->db->get_where('unit_group_type',array('soft_delete'=>0))->result();
         return $result;
	}
    function Get_floor()
	{
		 $result = $this->db->get_where('floors',array('Soft_delete'=>0,'active'=>1))->result();
         return $result;
	}
	function get_floorbyProject($projectid)
	{
		 $result = $this->db->get_where('floors',array('Soft_delete'=>0,'active'=>1,'projectid'=>$projectid))->result();
         return $result;
	}
	function get_floorbyBuildingwise($projectid,$buildingid)
	{
		$this->db->select("*");
		$this->db->where(array('Soft_delete'=>0,'active'=>1,'projectid'=>$projectid,'building_id'=>$buildingid));
		$query=$this->db->get('floors');
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;	
		}
	function getCurrency(){
		$this->db->select('currrency_symbol,currency_code');
		$this->db->join('currency','settings.default_currency =currency.id');
		$this->db->where('currency.STATUS=1');
		$query=$this->db->get('settings');
		return $query->row();
	}
	function getInstension(){
		$query=$this->db->get_where('unit_intension',array('soft_delete'=>0));
		if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	function getStatus(){
		$query=$this->db->get_where('unit_status',array('soft_deleted'=>0));
		if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	function amenities($ids){
		$this->db->select("*");
		$this->db->where_in('id',json_decode($ids));
		$query=$this->db->get("amenties");
			if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	function   get_buildingProjectWise($projectid){
	   $query=$this->db->get_where('building_info',array('project_id'=>$projectid));
	   if($query->num_rows()>0){
	   foreach($query->result() as $row){
		   $data[]=$row;
	   }
	   return $data;
	   }
	   return false;
   }
   function   getUnitWiseResident($projectid,$building,$unitid){
	  $this->db->select("*");
	  $this->db->where("project_id",$projectid);
	  $this->db->where("building_id",$building);
	  $this->db->where("units",$unitid);
	  $query=$this->db->get("resident");
	   if($query->num_rows()>0){
	   foreach($query->result() as $row){
		   $data[]=$row;
	   }
	   return $data;
	   }
	   return false;
   }
    function   getPMC(){
	  $this->db->select("*");
	  $this->db->where("soft_delete",0);
	  $query=$this->db->get("pmc");
	   if($query->num_rows()>0){
	   foreach($query->result() as $row){
		   $data[]=$row;
	   }
	   return $data;
	   }
	   return false;
   }
		
   
}