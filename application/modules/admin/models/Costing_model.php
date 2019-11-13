<?php
Class Costing_model extends CI_Model{
    var $CI;
    function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }

	function get($id){
		$this->db->select("costing.*,soc.Name as stage,project.Name as project,taskName");
		$this->db->join("project","project.id=costing.project_id","left");
		$this->db->join("soc","soc.id=costing.stage_id","left");
		$this->db->join("task","task.id=costing.task_id","left");
		$this->db->where("costing.id",$id);
		$q=$this->db->get("costing");
		if($q->num_rows()>0){
			return $q->row();
		}
		return  false;
	}
	function get_worksheet($id){
		$this->db->select("costing_sheet.*,Name");
		$this->db->join("estimation_master","estimation_master.id=costing_sheet.master_id","");
		$this->db->where("costing_id",$id);
		$q=$this->db->get("costing_sheet");
		if($q->num_rows()>0){
				foreach($q->result() as $row){
					$data[]=$row;
				}
				return $data;
		}
		return  false;
	}
	function get_task_details($id){
		$this->db->select("task.*,soc.Name as stage,project.Name as project");
		$this->db->join("project","project.id=task.project_id","left");
		$this->db->join("soc","soc.id=task.stage_id","left");
		$this->db->where("task.id",$id);
		$q=$this->db->get("task");
		if($q->num_rows()>0){
			return $q->row();
		}
		return  false;
	}
		function get_project(){
		$this->db->select("*");
		$this->db->where("soft_delete",0);
		$q=$this->db->get("project");
		if($q->num_rows()>0){
		foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return  false;
	}
	function get_stages($projectid){
		$query=$this->db->get_where("project",array("id"=>$projectid));
		if($query->num_rows()>0){
			$project=$query->row(); 
			$this->db->select("*");
			$this->db->where_in("id",json_decode($project->Project_stages));
			$q=$this->db->get("soc");
			if($q->num_rows()>0){
				foreach($q->result() as $row){
					$data[]=$row;
				}
				return $data;
			}
			return false;
		}
		
	}
	function get_stagesWiseTask($projectid,$stageid){
		$this->db->select("*");
		$this->db->where("soft_delete",0);
		$this->db->where("project_id",$projectid);
		$this->db->where("stage_id",$stageid);
		$q=$this->db->get("task");
		if($q->num_rows()>0){
		foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return  false;
	}
	function get_estimation_master(){
		$this->db->select("*");
		$this->db->where("soft_delete",0);
		$q=$this->db->get("estimation_master");
		if($q->num_rows()>0){
		foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return  false;
	}
    
	function get_material(){
		$this->db->select("*");
		$this->db->where("Soft_delete",0);
		$q=$this->db->get("material");
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	 function get_labourtype(){
		$this->db->select("*");
		$this->db->where("Soft_delete",0);
		$q=$this->db->get("labourtype");
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	function get_uom(){
		$this->db->select("*");
		$this->db->where("Soft_delete",0);
		$q=$this->db->get("uom");
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	function save($save,$worksheet){
		if(!empty($save['id'])){
			$this->db->where("id",$save['id']);
			$this->db->update("costing",$save);
			$this->db->where("costing_id",$save['id']);
			$this->db->delete("costing_sheet");
			foreach($worksheet as $sheet){
				$sheet['costing_id']=$save['id'];
                $this->db->insert("costing_sheet",$sheet);
			}
				return true;			
		}
		return false;
	}
}