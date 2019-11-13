<?php
	function get_setting(){
					$CI =& get_instance();
		 			$CI->db->where('S.id',1);
					$CI->db->select('S.*,C.currency_code,C.currrency_symbol currency_symbol');
					$CI->db->join('currency C', 'C.id = S.currency', 'LEFT');
			return 	$CI->db->get('settings S')->row();	
	}
	function get_option($name){
    $CI =& get_instance();
    $CI->load->database();
    $result = $CI->db->get_where('payroll_options', array(
        'name' => $name
    ))->row();
    if(empty($result)){
       $result = (object)array(
         'value' => ''
       );
    }
    return $result->value;
}

function get_timeago( $ptime ){
    $estimate_time =time()- $ptime ;
   if( $estimate_time < 1 ) {
		return 'less than 1 second ago';
    }
    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );
    foreach( $condition as $secs => $str ){
        $d = $estimate_time / $secs;
        if( $d >= 1 ){
            $r = round( $d );
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}
function completedtask($projectid,$buildingid){
	$CI =& get_instance();
    $CI->load->database();
	$CI->db->select("*");
	$CI->db->where("soft_delete",0);
	$CI->db->where("building_id",$buildingid);
	$CI->db->where("project_id",$projectid);
	$CI->db->where("status",'complete');
	$query=$CI->db->get("building_task");
	if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}

function people_settings(){
	$CI =& get_instance();
    $CI->load->database();
	$query=$CI->db->get_where("peoples_settings",array('soft_delete'=>0));
	if($query->num_rows()>0){
			return  $query->row();
	}
	return false;
}
function getBuildingWisefloor($projectid,$buildingid){
	$CI =& get_instance();
    $CI->load->database();
	$CI->db->select("*");
	$CI->db->where("soft_delete",0);
	$CI->db->where("building_id",$buildingid);
	$CI->db->where("projectid",$projectid);
	
	$query=$CI->db->get("floors");
	if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}
function getBuildingWiseunit($projectid,$buildingid){
	$CI =& get_instance();
    $CI->load->database();
	$CI->db->select("*");
	$CI->db->where("soft_delete",0);
	$CI->db->where("building_id",$buildingid);
	$CI->db->where("Project_id",$projectid);
	$query=$CI->db->get("add_unit");
	if($query->num_rows()>0){
		foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
	}
	return false;
}
	function stagesWiseTask($projectid,$stageid){
		$CI =& get_instance();
        $CI->load->database();
		$CI->db->select("*");
		$CI->db->where("soft_delete",0);
		$CI->db->where("project_id",$projectid);
		$CI->db->where("stage_id",$stageid);
		$q=$CI->db->get("task");
		if($q->num_rows()>0){
		foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return  false;
	}
	function taskwise_costing($projectid,$stageid,$taskid){
		$CI =& get_instance();
        $CI->load->database();
		$CI->db->select("costing_sheet.*,Name");
		$CI->db->join("costing_sheet","costing_sheet.costing_id=costing.id","left");
		$CI->db->join("estimation_master","estimation_master.id=costing_sheet.master_id","left");
		$CI->db->where("costing.project_id",$projectid);
		$CI->db->where("costing.stage_id",$stageid);
		$CI->db->where("costing.task_id",$taskid);
		$q=$CI->db->get("costing");
		if($q->num_rows()>0){
				foreach($q->result() as $row){
					$data[]=$row;
				}
				return $data;
		}
		return  false;
	}
?>