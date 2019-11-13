<?php
Class Vendor_model extends CI_Model
{

    var $CI;
    function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
    }
	
	function get_services_provider($id){
        $q=$this->db->get_where('ven_services_provider',array('soft_delete'=>0,'service_provider_id'=>$id));
        if ($q->num_rows()>0) {
           return $q->row();
        }
        return false;
        }
    function save($save,$id){
        if (!empty($save['service_provider_id'])){
                $this->db->where('service_provider_id',$save['service_provider_id']);
                $this->db->update('ven_services_provider', $save);
                return $id;
            }
            else  {
                $this->db->insert('ven_services_provider', $save);
                return $this->db->insert_id();
            }
        }
        function getProject(){
            $this->db->select("*");
            $this->db->where("Soft_delete",0);
            $this->db->where("project_status",lang('Completed'));
            $this->db->or_where("project_status",lang('Ongoing')); 
            $q=$this->db->get("Project");
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
        function  service_save($save){
            if (!empty($save['services_id'])){
                $this->db->where('services_id',$save['services_id']);
                $this->db->update('ven_services', $save);
                return $id;
            }
            else  {
                $this->db->insert('ven_services', $save);
                return $this->db->insert_id();
            }
        }
        function get_services($id){
            $q=$this->db->get_where('ven_services',array('soft_delete'=>0,'services_id'=>$id));
            if ($q->num_rows()>0) {
               return $q->row();
            }
            return false;
            }
            function services_delete($id){
                $this->db->where('services_id',$id);
                if($this->db->update('ven_services',array('soft_delete'=>1))){
                        return true;
                }else{
                    return false;
                }
            }
            function servicesProvider_delete($id){
                $this->db->where('pmc_id',$id);
                if($this->db->update('ven_services_provider',array('soft_delete'=>1))){
                        return true;
                }else{
                    return false;
                }
            }
			
	 function get_pmcByid($id){
        $q=$this->db->get_where('pmc',array('soft_delete'=>0,'pmc_id'=>$id));
        if ($q->num_rows()>0) {
           return $q->row();
        }
        return false;
        }
     function save_pmc($save,$id){
        if (!empty($save['pmc_id'])){
                $this->db->where('pmc_id',$save['pmc_id']);
                $this->db->update('pmc', $save);
                return $id;
            }
            else  {
                $this->db->insert('pmc', $save);
                return $this->db->insert_id();
            }
        }
        
        function get_pmc(){
            $this->db->select("*");
            $this->db->where("soft_delete",0);
            $q=$this->db->get("pmc");
            if($q->num_rows()>0){
               foreach($q->result() as $row){
                 $data[]=$row;
               }
               return $data;
            }
            return false;
        }
		  function pmc_delete($id){
                $this->db->where('pmc_id',$id);
                if($this->db->update('pmc',array('soft_delete'=>1))){
                        return true;
                }else{
                    return false;
                }
            }
        
}

