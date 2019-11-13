<?php
class Owner_model extends CI_Model
{
    public $CI;
    public function __construct(){
        parent::__construct();
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('url');
    }

    public function get_all(){
        $result = $this->db->query('SELECT * FROM `owner` WHERE soft_deleted=0')->result();
        return $result;
    }
    public function get($id){
        $result = $this->db->query("SELECT * FROM `owner` WHERE ownid='" . $id . "' and soft_deleted=0")->row();
        return $result;
    }
    public function get_floor(){
        $result = $this->db->query("SELECT * FROM floors WHERE active=1")->result();
        return $result;
    }
    public function save($save){
        if (!empty($save['ownid'])) {
            $owner = $this->db->get_where('owner', array('ownid' => $save['ownid']))->row();
            $this->db->where_in('uid', json_decode($owner->units));
            if ($this->db->update('add_unit', array('Booked_status' => 0))) {
                $this->db->where('ownid', $save['ownid']);
                if ($this->db->update('owner', $save)) {
                    if (!empty(json_decode($save['units']))) {
                        $this->db->where_in('uid', json_decode($save['units']));
                        $this->db->update('add_unit', array('Booked_status' => 1,'owner_id'=>$save['ownid']));
                    }
                    $data = array("username" => $save['full_name'], "email" => $save['email'], "contact" => $save['handphone'], "address" => $save['permanent_address'],
                        "per_address" => $save['permanent_address'], "nid" => $save['id_no'], "Owner_unit" => $save['units'],
                        "Owner_type" => 1, "project_id" => $save['project_id'], "Owner_id" => $save['ownid'], "ownertype" => 1, "user_role" => 2,
                        "firstname" => $save['firstname'], "lastname" => $save['surname'],'building_id'=>$save['building_id']);
                    $this->db->where('Owner_id', $save['ownid']);
                    $this->db->update('owner_login', $data);
					$this->createUnitRealtion($save['project_id'],$save['units'],$save['building_id'], $save['ownid']);
                }
            }
            return $save['ownid'];
        } else {
            if ($this->db->insert('owner', $save)) {
                $ownerid = $this->db->insert_id();
                $data = array("username" => $save['full_name'], "email" => $save['email'], "contact" => $save['handphone'], "address" => $save['permanent_address'],
                    "per_address" => $save['permanent_address'], "nid" => $save['id_no'], "Owner_unit" => $save['units'],
                    "Owner_type" => 1, "project_id" => $save['project_id'], "Owner_id" => $ownerid, "ownertype" => 1, "user_role" => 2,
                    "firstname" => $save['firstname'], "lastname" => $save['surname'], "password" => $save['password'],'building_id'=>$save['building_id']);
                $this->db->insert('owner_login', $data);
                $this->db->where_in('uid', json_decode($save['units']));
                $this->db->update('add_unit', array('Booked_status' => 1,'owner_id'=>$ownerid));
				$this->createUnitRealtion($save['project_id'],$save['units'],$save['building_id'],$ownerid);
            }
            return $ownerid;
        }
    }
    public function delete($id){
        $this->db->where('ownid', $id);
        $this->db->delete('owner');
    }
    public function Get_unit(){
        $result = $this->db->query("SELECT uid,unit_no FROM   `add_unit` WHERE Active=1")->result();
        return $result;
    }
    public function Get_ownerType(){
        $result = $this->db->get_where('unit_group_type', array('soft_delete' => 0))->result();
        return $result;
    }
    public function GetOwnerUnits(){
        $result = $this->db->get_where('add_unit', array('Soft_delete' => 1, 'Unit_groupType' => 11, 'Booked_status' => 0))->result();
        return $result;
    }
    public function get_Project(){
        $this->db->select('*');
        $this->db->where('soft_delete', 0);
        $this->db->where('project_status', 'Ongoing');
        $this->db->or_where('project_status', 'Completed');
        $query = $this->db->get('project');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_unitBy_project($projectid,$buildingid){
        $this->db->select('*');
        $this->db->where('Soft_delete', 0);
        $this->db->where('Booked_status', 0);
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
    public function get_unitBy_building($projectid,$buildingid){
        $this->db->select('*');
        $this->db->where('Soft_delete', 0);
        $this->db->where('Booked_status', 0);
        $this->db->where('Project_id', $projectid);
        $this->db->where('building_id', $buildingid);
        $query = $this->db->get('add_unit');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_buildingByproject($id, $units){
        $this->db->select('*');
        $this->db->where('Soft_delete', 0);
        $this->db->where('Booked_status', 0);
        $this->db->where('Project_id', $id);
        $this->db->or_where_in('uid', json_decode($units));
        $query = $this->db->get('add_unit');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
    public function get_unitBy_projectWise($id, $units){
        $this->db->select('*');
        $this->db->where('Soft_delete', 0);
        $this->db->where('Booked_status', 0);
        $this->db->where('Project_id', $id);
        $this->db->or_where_in('uid', json_decode($units));
        $query = $this->db->get('add_unit');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_unitBy_buildingwise($projectid
    ,$buildingid,$activeUnits){
		$query=$this->db->query("select * from add_unit where Soft_delete=0 and Booked_status=0 and building_id=$buildingid and  Project_id=$projectid or `uid` IN('$activeUnits')");
       /*  $this->db->select('*');
        $this->db->where('Soft_delete', 0);
        $this->db->where('Booked_status', 0);
        $this->db->where('building_id', $buildingid);
        $this->db->where('Project_id', $projectid);
        $this->db->or_where_in('uid', $activeUnits);
        $query = $this->db->get('add_unit'); */
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_buildingbyProjects($projectid){
        $this->db->select('*');
        $this->db->where('project_id', $projectid);
        $query = $this->db->get('building_info');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
    public function get_idtype(){
        $this->db->select('*');
        $this->db->where('soft_delete', 0);
        $query = $this->db->get('id_type');
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
    public function get_units($projectid,$buildingid)
    {
        $this->db->select('*');
        $this->db->where('Soft_delete', 0);
        //$this->db->where('Booked_status', 0);
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
	 public function get_active_unit($ownerid){
		$this->db->select("GROUP_CONCAT(unit_id SEPARATOR ',') AS ids ");
        $this->db->where("soft_deleted", 0);
        //$this->db->where('Booked_status', 0);
        $this->db->where("owner_id", $ownerid);
        $query = $this->db->get("add_owner_unit_relation");
        if ($query->num_rows() > 0) {
                return  $query->row();
        }
        return false;
		
	} 
	function createUnitRealtion($projectid,$units,$buildingid,$ownerid){
		if(!empty($units)){
		$this->db->where(array('owner_id'=>$ownerid));
		$this->db->delete('add_owner_unit_relation');
		foreach(json_decode($units) as $unit){
			$unit_details=$this->db->get_where('add_unit',array('Project_id'=>$projectid,'building_id'=>$buildingid,'uid'=>$unit))->row();
			$this->db->insert('add_owner_unit_relation',array('owner_id'=>$ownerid,'project_id'=>$projectid,'building_id'=>$buildingid,'floor_id'=>$unit_details->floor_no,'unit_id'=>$unit));
		}
		}
		return false;
		
	}
	public function get_ownerWiseUnit($ownerid){
		$this->db->select("unit_name,project.Name project,floors.name as floors,building_info.name building");
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
}
