<?php
Class Agreement_model extends CI_Model
{
    var $CI;
    function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	 public function Project_record_count() {
	   $this->db->from('project');
       $this->db->where('Soft_delete',0);
	   return  $this->db->count_all_results();
   }
    function get_all(){
		$result = $this->db->query("SELECT p.*,pt.id as ids,ProjectType FROM project p
									LEFT JOIN  `projecttypes` pt ON pt.id=p.Project_type
									WHERE p.Soft_delete=1")->result();
         return $result;
    }
	 function getAllProject(){
		 $this->db->select('*');
		 $this->db->where('project.Soft_delete',0);
        $query = $this->db->get("project");
        if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
	function get($id){
		/*$result = $this->db->query("SELECT p.*,pt.id as ids,ProjectType FROM project p
									LEFT JOIN  `projecttypes` pt ON pt.id=p.id
									WHERE p.Soft_delete=0 and p.id='".$id."'")->row();
		return $result;*/
		$this->db->select("*");
	//	$this->db->join("","","");
		$this->db->where("bldid",$id);
		$query = $this->db->get("building_info");
		if($query->num_rows()>0){
             return    $query->row();
		}else{
              return false;
		}
    }
	function get_floor(){
		$result = $this->db->query("SELECT * FROM floors WHERE active=1")->result();
        return $result;
	}
    function save($save){
        if (!empty($save['bldid'])){
            $this->db->where('bldid', $save['bldid']);
            $this->db->update('building_info', $save);
            return $save['id'];
        }else{
            $this->db->insert('building_info', $save);
            return $this->db->insert_id();
        }
    }
	
    function delete($id){
		  $save=array('Soft_delete'=>1);
            $this->db->where('id', $id);
            $this->db->update('project', $save);
            return $id;
    }
    function Get_projecttype(){
		$result = $this->db->query("SELECT * FROM projecttypes WHERE soft_delete=0")->result();
        return $result;
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
	function updateplannertask($save,$id,$delete){
		if(isset($delete)){
			$this->db->delete('project_progress_planner', array('id' => $id));
			return true;
		}
		$this->db->where('id', $id);
		$this->db->update('project_progress_planner', $save);
		return true;
		
	}
	function  getfacilities(){
		$query=$this->db->get_where('facility',array('soft_delete'=>0,'Active'=>1));
		if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}
function getVendor(){
	$query=$this->db->get_where('ven_services_provider',array('soft_delete'=>0));
	if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}
function getContractor(){
	$query=$this->db->get_where('contractor',array('soft_delete'=>0));
	if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;

}
function projectIfexists($id){
    $query=$this->db->get_where('floors',array('building_id'=>$id))->result();
     if(!empty($query)){
       return false;
	 }else{
		$units=$this->db->get_where('add_unit',array('building_id'=>$id))->result();
		if(!empty($units)){
			return false;
		}else{
			return true;
		}
	 }

}
function get_Completed_building(){
	$this->db->select("COUNT(bldid) Completed");
	$this->db->where("status",lang('Completed'));
	$query=$this->db->get("building_info");
    if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}

function getOngoing_building(){
	$this->db->select("COUNT(bldid) Ongoing");
	$this->db->where("status",lang('Ongoing'));
	$query=$this->db->get("building_info");
    if($query->num_rows()>0){
		return $query->row();
	}
	return false;
}
/*function getOverdue_building(){
	$this->db->select("COUNT(id) Ongoing");
	$this->db->where("status",lang('Ongoing'));
	$query=$this->db->get("building_info");
    if($query->num_rows()>0){
		return $query->row();
	}
	return false;
}*/

function getOverDue_building(){
	$this->db->select("COUNT(bldid) Ongoing");
	$this->db->where("planned_completion_date <","now()");
	$this->db->where("status",lang('Ongoing'));
	$query=$this->db->get("building_info");
    if($query->num_rows()>0){
		return $query->row();
	}
	return false;
}
function getEmployee(){
	$this->db->select("*");
	$this->db->where("termination",1);
	$query=$this->db->get("employee");
    if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}

function getlabourtype(){
	$this->db->select("*");
	$this->db->where("Soft_delete",0);
	$query=$this->db->get("labourtype");
    if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}
function building_member_save($save){
	if($this->db->insert('building_members',$save)){
		$this->db->insert('building_activity_log',array('name'=>'New member added to the project.','building_id'=>$save['building_id'],'project_id'=>$save['project_id']));
			return true;
	}else{
			return false;
	}
}
function getbuildingById($buildingid){
	$query=$this->db->get_where('building_info',array('bldid'=>$buildingid));
	if($query->num_rows()>0){
   return $query->row();
	}
	return false;
}
function tasksave($save){
   if(!empty($save['id'])){
	   $this->db->where("id",$save["id"]);
	   $this->db->update("building_task",$save);
	   return true;
   }else{
	   $this->db->insert("building_task",$save);
	   $this->db->insert('building_activity_log',array('name'=>'New task added to the project.','building_id'=>$save['building_id'],'project_id'=>$save['project_id']));
	   return true;
   }
}
function milestonesave($save){
	if(!empty($save['id'])){
		$this->db->where("id",$save["id"]);
		$this->db->update("building_milestone",$save);
		return true;
	}else{
		$this->db->insert("building_milestone",$save);
		$this->db->insert('building_activity_log',array('name'=>'New Milestone added to the project.','building_id'=>$save['building_id'],'project_id'=>$save['project_id']));
		return true;
	}
 }
function getmilestone($buildingid,$projectid){
	$this->db->select("*");
	$this->db->where("soft_delete",0);
	$this->db->where("projectid",$projectid);
	$this->db->where("buildingid",$buildingid);
	$query=$this->db->get("building_milestone");
    if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}
function getCurrency(){
	$this->db->select("*");
	$this->db->where("status",0);
	$query=$this->db->get("currency");
    if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}

function milestoneget($milestonid){
	$query=$this->db->get_where("building_milestone",array("id"=>$milestonid));
	if($query->num_rows()>0){
		return $query->row();
	}
	return false;
}
function milstoneifexists($milestonid){
	$query=$this->db->get_where("building_task",array("milestone_id"=>$milestonid));
	if($query->num_rows()>0){
		return $this->db->get_where("building_milestone",array("id"=>$milestonid))->row();
		 
	}
	return false;
}
function milstoneDeleted(){
	$this->db->where("id",$id);
	if($this->db->update("building_milestone",array("soft_delete"=>0))){
       return true;
	}else{
		return false;
	}
}
function building_doc_upload($save){
	$building=$this->db->get_where("building_info",array("bldid"=>$save['bldid']))->row();
	if(!empty($building->upload_doc)){
	foreach (json_decode($building->upload_doc) as $path) {
		$otherdoc[] = $path;
	}
}
	$otherdoc[]=$save['upload_doc'];
	$save['upload_doc'] = !empty($otherdoc) ? json_encode($otherdoc) : null;
	$this->db->where('bldid',$save['bldid']);
	if($this->db->update("building_info",$save)){
		return true;
	}else{
		return false;
	}
}
function getBuildingTask($buildingid,$projectid){
	$this->db->select("*");
	$this->db->where("soft_delete",0);
	$this->db->where("building_id",$buildingid);
	$this->db->where("project_id",$projectid);
	$query=$this->db->get("building_task");
    if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}
function incompletedTaskCount($buildingid,$projectid){
	$this->db->select("*");
	$this->db->where("soft_delete",0);
	$this->db->where("building_id",$buildingid);
	$this->db->where("project_id",$projectid);
	$this->db->where("status",'incomplete');
	$query=$this->db->get("building_task");
	if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}
function editTask($taskid){
	$query=$this->db->get_where("building_task",array("id"=>$taskid));
	if($query->num_rows()>0){
		return $query->row();
	}
	return false;
}

function assignLeadForBuilding($save){
  $this->db->where(array('building_id'=>$save['building_id'],'project_id'=>$save['project_id']));
  if($this->db->update('building_members',array('is_lead'=>0))){
	 $this->db->where(array('building_id'=>$save['building_id'],'project_id'=>$save['project_id'],'employee_id'=>$save['employee_id']));
	 $this->db->update('building_members',array('is_lead'=>1));
	 return true;
  }
  return false;
}
function getMembers($buildingid,$projectid){
	$this->db->select("building_members.*,labourtype.Name labour,first_name , last_name,email");
	$this->db->join("labourtype","labourtype.id=building_members.role_id","left");
	$this->db->join("employee","employee.id=building_members.employee_id","left");
	$this->db->where("building_members.soft_delete",0);
	$this->db->where("building_id",$buildingid);
	$this->db->where("project_id",$projectid);
	$query=$this->db->get("building_members");
    if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}
function getbuildingActivity($buildingid,$projectid){
	$this->db->select("*");
	$this->db->where("soft_deleted",0);
	$this->db->where("building_id",$buildingid);
	$this->db->where("project_id",$projectid);
	$query=$this->db->get("building_activity_log");
    if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}
}