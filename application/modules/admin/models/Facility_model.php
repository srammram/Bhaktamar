<?php
Class Facility_model extends CI_Model{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
    function get_all(){
		$result = $this->db->get('facility');
        return $result->result();
    }
	function get($id){
		$this->db->where('Fac_id', $id);
		$result = $this->db->get('facility');
        return $result->row();
    }
    function save($save,$ids){
        if ($ids){
            $this->db->where('Fac_id', $ids);
            $this->db->update('facility', $save);
            return $ids;
        }else{
            $this->db->insert('facility', $save);
            return $this->db->insert_id();
        }
    }
	 
    function delete($id){
        $this->db->where('Fac_id', $id);
        $this->db->delete('facility');
    }
    function Get_owner(){
		$result = $this->db->get('owner');
        return $result->result();
		
	}
	function get_services_provider(){
		$this->db->select("*");
		$this->db->where("soft_delete",0);
		$query=$this->db->get("ven_services_provider");
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$data[]=$row;
			}
			return $data;
	}
   return false;
}
 function  service_save($save){
            if (!empty($save['id'])){
                $this->db->where('id',$save['id']);
                $this->db->update('services', $save);
                return $id;
            }
            else  {
                $this->db->insert('services', $save);
                return $this->db->insert_id();
            }
        }
        function get_services($id){
            $q=$this->db->get_where('services',array('soft_delete'=>0,'id'=>$id));
            if ($q->num_rows()>0) {
               return $q->row();
            }
            return false;
            }
            function services_delete($id){
                $this->db->where('id',$id);
                if($this->db->update('services',array('soft_delete'=>1))){
                        return true;
                }else{
                    return false;
                }
            }
            function servicesProvider_delete($id){
                $this->db->where('service_provider_id',$id);
                if($this->db->update('ven_services_provider',array('soft_delete'=>1))){
                        return true;
                }else{
                    return false;
                }
            }
			function getProject(){
            $this->db->select("*");
            $this->db->where("Soft_delete",0);
            $this->db->where("project_status",lang('Completed'));
            $this->db->or_where("project_status",lang('Ongoing')); 
            $q=$this->db->get("project");
            if($q->num_rows()>0){
               foreach($q->result() as $row){
                 $data[]=$row;
               }
               return $data;
            }
            return false;
        }
		  function getServicesProvider(){
            $this->db->select("*");
            $this->db->where("soft_delete",0);
            $q=$this->db->get("ven_services_provider");
            if($q->num_rows()>0){
               foreach($q->result() as $row){
                 $data[]=$row;
               }
               return $data;
            }
            return false;
        }
}