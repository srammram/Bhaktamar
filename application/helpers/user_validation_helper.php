<?php
	function nameUnique($fieldsName,$tableName,$name){
		$this->db->select("*");
		$this->db->where("$fieldsName",$name);
		$query=$this->db->get("$tableName");
		if($query->num_rwos()>0){
			return $query->row();
		}
		return    false;
	}

?>