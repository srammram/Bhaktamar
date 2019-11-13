<?php
class Project_model extends CI_Model{
    public $CI;
    public function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('url');
    }
    public function Project_record_count(){
        $this->db->from('project');
        $this->db->where('Soft_delete', 0);
        return $this->db->count_all_results();
    }
    public function get_all(){
        /*    $result = $this->db->query("SELECT p.*,pt.id as ids,ProjectType FROM project p
        LEFT JOIN  `projecttypes` pt ON pt.id=p.Project_type
        WHERE p.Soft_delete=1")->result();
        return $result;*/
        $this->db->select("*");
        $this->db->or_where("project_status", lang('Ongoing'));
        $this->db->or_where("project_status", lang('Completed'));
        $this->db->or_where("project_status", lang('OnHold'));
        $query = $this->db->get("project p");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function getAllProjectStage($limit, $start){
        $this->db->select('project.*,projecttypes.id as ids,projecttypes.ProjectType');
        $this->db->join('projecttypes', 'project.Project_type=projecttypes.id', 'left');
        $this->db->where('project.Soft_delete', 0);
        $this->db->limit($limit, $start);
        $query = $this->db->get("project");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get($id){
		$this->db->select("project.*,projecttypes.id as ids");
		$this->db->join("projecttypes","projecttypes.id=project.project_type","left");
		$this->db->where("project.id",$id);
		$this->db->where("project.Soft_delete",0);
		$query=$this->db->get("project");
         if ($query->num_rows() > 0) {
			 return $query->row();
		 }
        return $result;
    }
    public function get_floor(){
		 $query = $this->db->get_where("floors",array("active"=>1));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function save($save){
        if (!empty($save['id'])) {
            $this->db->where('id', $save['id']);
            $this->db->update('project', $save);
            return $save['id'];
        } else {
            $this->db->insert('project', $save);
            return $this->db->insert_id();
        }
    }
    public function getProjectStagesForProject($projectStage_id){
        $data = array();
        $ids = join("','", $projectStage_id);
        $this->db->select('id');
        $this->db->where("id in('" . $ids . "')");
        $query = $this->db->get('soc');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function projectIfexists($id){
        $query = $this->db->get_where('floors', array('projectid' => $id))->result();
        if (!empty($query)) {
             return false;
        } else {
             $units = $this->db->get_where('add_unit', array('Project_id' => $id))->result();
             if (!empty($units)) {
                return false;
             } else {
                return true;
             }
        }
    }
    public function delete($id){
        $save = array('Soft_delete' => 1);
        $this->db->where('id', $id);
        $this->db->update('project', $save);
        return $id;
    }
    public function Get_projecttype(){
        $query = $this->db->get("projecttypes");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_all_soc(){
        $query = $this->db->get("soc");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function getProjectStages($projectStage_id){
        $ids = join("','", $projectStage_id);
        $this->db->select('*');
        $this->db->where("id in('" . $ids . "')");
        $query = $this->db->get('soc');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getProjectApprovedStage($projectStage_id){
        $ids = join("','", $projectStage_id);
        $this->db->select('*');
        $this->db->where("Project_stage_id in('" . $ids . "')");
        $query = $this->db->get('approved_stage');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function getapproval_stages($id){
        $query = $this->db->get_where("stage_approval", array("project_id" => $id));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function stage_approval_save($save, $id){
        $this->db->delete('stage_approval', array('Project_id' => $id));
        foreach ($save as $row) {
            $saved = $this->db->insert('stage_approval', $row);
        }
        return true;
    }
    public function getActiveProjectApprovedStage($id){
        $this->db->select('*');
        $this->db->where('Project_id', $id);
        $query = $this->db->get('stagewise_approved');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function getfacilities(){
        $query = $this->db->get_where('facility', array('soft_delete' => 0, 'Active' => 1));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
   public function getVendor(){
        $query = $this->db->get_where('ven_services_provider', array('soft_delete' => 0));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
   public function getContractor(){
        $query = $this->db->get_where('contractor', array('soft_delete' => 0));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
     }
 function  getBuilding($projectid){
    $query=$this->db->get_where('building_info',array("project_id"=>$projectid));
    if($query->num_rows()>0){
     foreach($query->result() as $row){
         $data[]=$row;
     }
     return $data;
     }
       return false; 
  }

  
function getUom(){
$this->db->select('*');
$this->db->where('Soft_delete',0);
$query=$this->db->get('uom');
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;

}
function getMaterial(){
$this->db->select('*');
$this->db->where('Soft_delete',0);
$query=$this->db->get('material');
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;

}
function getLabour(){
$this->db->select('*');
$this->db->where('Soft_delete',0);
$query=$this->db->get('labourtype');
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;

}
function estimaionFormSave($save,$Cost,$timeperiod,$timetype,$labourTaskid,$labourtype,$noofperson,$paymentperiod,$materialtaskid,$material,$Qty,$taskid,$Uom,$TaskName){
if($save){
$this->db->delete('project_estimation_plan', array('project_id' =>$save['project_id'],'Stage_id' => $save['Stage_id']));
$this->db->insert('project_estimation_plan',$save);
$insert_id = $this->db->insert_id();
$this->db->delete('project_estimate_plan_task', array('ProjectId' =>$save['project_id'],'ProjectStageId'=> $save['Stage_id']));
foreach($taskid as $key=>$value){
$this->db->insert('project_estimate_plan_task',array('TaskName'=>$TaskName[$key],'ProjectEstimatePlanId'=>$insert_id  ,'ProjectId'=>$save['project_id'],  'ProjectStageId'=>$save['Stage_id'],  'taskId'=>$taskid[$key],  'Cost'=>$Cost[$key],    'TimePeriod'=>$timeperiod[$key],  'TimePeriodType'=>$timetype[$key]));
}
$this->db->delete('projectTaskWisLabourDetails', array('projectId' =>$save['project_id'],'projectStageId' => $save['Stage_id']));
foreach($labourTaskid as $key=>$value){
$this->db->insert('projectTaskWisLabourDetails',array('projectId'=>$save['project_id'],  'projectStageId'=>$save['Stage_id'],  'Task_id'=>$labourTaskid[$key],  'LabourTypeId'=>$labourtype[$key],    'NoOfPerson'=>$noofperson[$key],  'PaymentPeriod'=>$paymentperiod[$key]));
}
$this->db->delete('projectTaskWiseMaterial', array('projectId' =>$save['project_id'],'projectStageId' => $save['Stage_id']));
foreach($materialtaskid as $key=>$value){
$this->db->insert('projectTaskWiseMaterial',array('projectId'=>$save['project_id'],  'projectStageId'=>$save['Stage_id'],  'taskId'=>$materialtaskid[$key],  'MaterialTypeid'=>$material[$key],    'Qty'=>$Qty[$key],  'UOMId'=>$Uom[$key]));
}
}
return true;

}
function getEstimationPlan($id){
$this->db->select('*');
$this->db->where('id',$id);
$query=$this->db->get('project_estimation_plan');
$result=$query->row();
return $result;
}
function getStage($id){
$this->db->select('*');
$this->db->where('id',$id);
$query=$this->db->get('soc');
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;
}
function getTasklistByid($id){
$this->db->select('*');
$this->db->where('ProjectEstimatePlanId',$id);
$query=$this->db->get('project_estimate_plan_task');
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;

}
function getTasklistWiseLabour($projectid,$stageid){
$this->db->select('*');
$this->db->where(array('projectId'=>$projectid,'projectStageId'=>$stageid));
$query=$this->db->get('projectTaskWisLabourDetails');
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;

}
function getTasklistWiseMaterial($projectid,$stageid){
$this->db->select('*');
$this->db->where(array('projectId'=>$projectid,'projectStageId'=>$stageid));
$query=$this->db->get('projectTaskWiseMaterial');
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;

}
function getAllEstimationplan(){
$this->db->select('project_estimation_plan.*,project.Name as project,soc.Name as soc');
$this->db->join('project','project.id=project_estimation_plan.project_id','left');
$this->db->join('soc','soc.id=project_estimation_plan.Stage_id','left');
//$this->db->where('project_estimate_plan_task.id',$id);
$query=$this->db->get('project_estimation_plan');
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;

}

function projectEstimation_delete($id){
$estimationplan=$this->db->get_where('project_estimation_plan',array('id'=>$id));
$estimationplan=$estimationplan->row();
$this->db->delete('project_estimation_plan', array('id'=>$id));
$this->db->delete('project_estimate_plan_task', array('ProjectId' =>$estimationplan->project_id,'ProjectStageId'=> $estimationplan->Stage_id));
$this->db->delete('projectTaskWisLabourDetails', array('projectId' =>$estimationplan->project_id,'projectStageId' =>$estimationplan->Stage_id));
$this->db->delete('projectTaskWiseMaterial', array('projectId' =>$estimationplan->project_id,'projectStageId' => $estimationplan->Stage_id));

}

function devlopementFormSave($save,$Cost,$timeperiod,$timetype,$labourTaskid,$labourtype,$noofperson,$paymentperiod,$materialtaskid,$material,$Qty,$taskid,$Uom,$id){
if($save){
$this->db->where('id',$id);
$this->db->update('project_estimation_plan',$save);

foreach($taskid as $key=>$value){
$this->db->where('id',$value);
$this->db->update('project_estimate_plan_task',array('Actual_cost'=>$Cost[$key],    'ActualTimePeriod'=>$timeperiod[$key],  'ActualTimePeriodType'=>$timetype[$key]));

}

foreach($labourTaskid as $key=>$value){
$this->db->where('id',$value);
$this->db->update('projectTaskWisLabourDetails',array('Actual_labourTypeid'=>$labourtype[$key],    'Actual_NoOfPerson'=>$noofperson[$key]));
}

foreach($materialtaskid as $key=>$value){
$this->db->where('id',$value);
$this->db->Update('projectTaskWiseMaterial',array('Actual_materialId'=>$material[$key],    'Actual_qty'=>$Qty[$key],  'Actual_uom'=>$Uom[$key]));
}
}
return true;

}
function getActiveProject(){
$result=$this->db->get_where('project',array('project_status'=>'Ongoing'))->result();
return $result;

}
function getProjectActiveStages($id){
$this->db->select('Project_stages');
$this->db->where('id',$id);
$query=$this->db->get('project');
$project=$query->row();
$projectStage = join("','",json_decode($project->Project_stages));
$this->db->select('id , Name');
$this->db->where("id in('".$projectStage."')");
$query=$this->db->get('soc');
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;

}
function getTasklist($projectid,$projectstageId){
$this->db->select('id , TaskName');
$this->db->where(array('ProjectId'=>$projectid,'ProjectStageId'=>$projectstageId));
$query=$this->db->get('project_estimate_plan_task');
if ($query->num_rows() > 0) {
foreach ($query->result() as $row) {
$data[] = $row;
}
return $data;
}
return false;

}
function addPlannerTask($save){
$this->db->insert('project_progress_planner',$save);
return true;

}
function getTask($projectid,$stageid,$start,$end){
$result=$this->db->query("SELECT *
FROM project_progress_planner
WHERE DATE(start) >= '".$start."' AND DATE(end) >= '".$end."'  and Project_id=$projectid  and ProjectStage_id=$stageid")->result_array();

return $result;
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

function getBuildingWiseTask($project_id){
$this->db->select("COUNT(building_task.id)task,building_info.name,building_info.bldid id");
$this->db->join("building_info","building_info.project_id=project.id","left");
$this->db->join("building_task","building_task.building_id=building_info.bldid","left");
$this->db->where("building_info.project_id",$project_id);
$this->db->where("building_info.soft_delete",0);
$this->db->group_by("building_task.building_id");
$query=$this->db->get("project");
if($query->num_rows()>0){
foreach($query->result() as $row){
$data[]=$row;
}
return $data;
}
return false;
}
 
}
