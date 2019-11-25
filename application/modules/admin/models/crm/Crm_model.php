<?php
Class Crm_model extends CI_Model
{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	function getProject(){
		$this->db->select('*');
		$this->db->where('Soft_delete',0);
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
	function getUnits($id){
		return $this->db->get_where('add_unit',array('Project_id'=>$id,'Booked_status'=>0))->result();
	}
	function getSalesPerson($salepersontype){
		  if(lang('Executive') == $salepersontype){
		
		$this->db->select('id,first_name as Name');
		$this->db->where(array('soft_delete'=>0,'termination'=>1));
		$agents=$this->db->get('employee');
        return $agents->result();
	 }else{ 
		$this->db->select('agentid as id,Name as Name');
		$this->db->where(array('soft_delete'=>0));
		$agents=$this->db->get('sales_agent');
        return $agents->result();
	 }
	}
	function getAmenities(){
		return $this->db->get_where('amenties',array('soft_delete'=>0))->result();
	}
	function getCountries(){
		return $this->db->get_where('countries',array('soft_delete'=>0))->result();
	}
	function getEmployees(){
		return $this->db->get_where('employee',array('soft_delete'=>0,'termination'=>1))->result();
	}
		function getEnquiry($id){
		return $this->db->get_where('crm_enquiry',array('soft_delete'=>0,'enquiry_id'=>$id))->row();
	}
		function getEnquiryView($id){
		/* return $this->db->get_where('crm_enquiry',array('soft_delete'=>0,'enquiry_id'=>$id))->row(); */
		$this->db->select('crm_enquiry.*,project.Name as projectname,projecttypes.ProjectType,countries.name as countryname,soe.Name as soename');
		$this->db->join('project','project.id=crm_enquiry.projectid','left');
		$this->db->join('add_unit','add_unit.uid=crm_enquiry.unitid and add_unit.Project_id=crm_enquiry.projectid','left');
		$this->db->join('countries','countries.id=crm_enquiry.country','left');
		$this->db->join('projecttypes','projecttypes.id=crm_enquiry.type_for','left');
		$this->db->join('soe','soe.id=crm_enquiry.source_of_enquiry','left');
		$this->db->where('enquiry_id',$id);
		$query=$this->db->get('crm_enquiry');
		return $query->row();
     
		
	}
    function save($save)
    {
        if ($save['enquiry_id']){
            $this->db->where('enquiry_id', $save['enquiry_id']);
            $this->db->update('crm_enquiry', $save);
            return $save['enquiry_id'];
        }else{
            $this->db->insert('crm_enquiry', $save);
            return $this->db->insert_id();
        }
    }
	
    function enquiryDelete($id){
		    $save=array('soft_delete'=>1);
            $this->db->where('enquiry_id', $id);
            $this->db->update('crm_enquiry', $save);
            return $id;
    }
    function Get_projecttype()
	{
		$result = $this->db->query("SELECT * FROM projecttypes WHERE Soft_delete=1")->result();
        return $result;
	}
    function get_all_soc()
    {
          $query = $this->db->get("soc");
       if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
 
    }
	function enquirycount(){
		return $this->db->count_all("crm_enquiry");
	}
	function visitorcount(){
		return $this->db->count_all("visitor");
	}	
	/*function followupcount(){
		return $this->db->count_all("crm_followup");
	}*/	
	 function get_all_Enquiry()
      {
		$this->db->select('crm_enquiry.*,project.Name as projectname,projecttypes.ProjectType,countries.name as countryname,soe.Name as soename');
		$this->db->join('project','project.id=crm_enquiry.projectid','left');
		$this->db->join('add_unit','add_unit.uid=crm_enquiry.unitid and add_unit.Project_id=crm_enquiry.projectid','left');
		$this->db->join('countries','countries.id=crm_enquiry.country','left');
		$this->db->join('projecttypes','projecttypes.id=crm_enquiry.type_for','left');
		$this->db->join('soe','soe.id=crm_enquiry.source_of_enquiry','left');
		$this->db->where('crm_enquiry.soft_delete',0);
	//	$this->db->limit($limit, $start);
        $query = $this->db->get("crm_enquiry");
        if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
	
	function followUpcount(){
		$this->db->from('crm_enquiry');
       $this->db->where('Soft_delete',0);
	   $this->db->where('crm_enquiry.enquiry_status',1);
	   return  $this->db->count_all_results();
	}
	 function get_all_Followup($limit,$start)
      {
		$this->db->select('crm_enquiry.*,project.Name as projectname,projecttypes.ProjectType,countries.name as countryname');
		$this->db->join('project','project.id=crm_enquiry.projectid','left');
		$this->db->join('add_unit','add_unit.uid=crm_enquiry.unitid and add_unit.Project_id=crm_enquiry.projectid','left');
		$this->db->join('countries','countries.id=crm_enquiry.country','left');
		$this->db->join('projecttypes','projecttypes.id=crm_enquiry.type_for','left');
		$this->db->where('crm_enquiry.soft_delete',0);
		$this->db->where('crm_enquiry.enquiry_status',1);
		//$this->db->limit($limit, $start);
        $query = $this->db->get("crm_enquiry");
        if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
	function getFollowupByEnquiry($enquiryid){
		return $this->db->get_where('crm_followup',array('enquiryid'=>$enquiryid,'soft_delete'=>0))->result();
	}
	function follow_save($save,$id){
		   if ($id){
            $this->db->where('followupid', $id);
            $this->db->update('crm_followup', $save);
            return $save['id'];
        }else{
           $this->db->insert('crm_followup',$save);
		   $insert_id = $this->db->insert_id();
		  return $insert_id;
        }
	}
	 function followupDelete($id){
		    $save=array('soft_delete'=>1);
            $this->db->where('followupid', $id);
            $this->db->update('crm_followup', $save);
            return $id;
    }
	function  addFinaltag($id,$Intial_Amount,$paiddate){
		$query = $this->db->get_where('crm_enquiry',array('enquiry_id'=>$id));
        foreach ($query->result() as $row) {
			unset($row->enquiry_date,$row->Budget,$row->type_for,$row->suggest_modification,$row->source_of_enquiry,$row->enquiry_status,$row->projectid,$row->unitid,$row->created_on);
			$row->initial_amount=$Intial_Amount;
			$row->initialamount_date=$paiddate;
	    	$customer = $this->db->get_where('crm_customer',array('enquiry_id'=>$id))->row();	
	
		if(empty($customer)){
         $this->db->insert('crm_customer',$row);
		}else{
			$this->db->where('customer_id',$customer->customer_id);
			$this->db->update('crm_customer',$row);
		}
        }
	return true;
	}
    function customer_update($data)
    {    	
        if ($data['customer_id']){
            $this->db->where('customer_id', $data['customer_id']);
            $this->db->update('crm_customer', $data);            
            return $data['customer_id'];
        }else{
            $this->db->insert('crm_customer', $data);            
            return $this->db->insert_id();
        }
    }

    function clientDelete($id){
		    $save=array('soft_delete'=>1);
            $this->db->where('customer_id', $id);
            $this->db->update('crm_customer', $save);
            return $id;
    }

	function getClientView($id){		
		$this->db->select('crm_customer.*,countries.name as countryname');
		$this->db->join('countries','countries.id=crm_customer.country','left');
		$this->db->where('customer_id',$id);
		$query=$this->db->get('crm_customer');
		return $query->row();		
	}


	function getCustomerlist(){
		return $this->db->get_where('crm_customer',array('soft_delete'=>0))->result();
	}
	function getCustomer($id){
		return $this->db->get_where('crm_customer',array('soft_delete'=>0,'customer_id'=>$id))->row();
	}
	function getCurrency(){
		$this->db->select('currrency_symbol,currency_code');
		$this->db->join('currency','settings.default_currency =currency.id');
		$this->db->where('currency.STATUS=1');
		$query=$this->db->get('settings');
		return $query->row();
	}
	function getReceipt($enquiryId){
		$this->db->select('*');
		$this->db->join('crm_customer','crm_customer.enquiry_id=crm_enquiry.enquiry_id','left');
		$this->db->join('add_unit','add_unit.uid=crm_enquiry.unitid','left');
		$this->db->join('unit_type','unit_type.id=add_unit.Unit_type','left');
		$this->db->where('crm_enquiry.enquiry_id',$enquiryId);
		$query=$this->db->get('crm_enquiry');
		return $query->row();
		
		
	}
	function getsoe(){
		$this->db->select('*');
		$this->db->where('Soft_delete',0);
		$query=$this->db->get('soe');
		 if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
	}
	
	function getSalesPersonName($salepersontype,$id){
		  if(lang('Executive') == $salepersontype){
		$this->db->select('id,first_name as Name');
		$this->db->where(array('soft_delete'=>0,'termination'=>1,'id'=>$id));
		$agents=$this->db->get('employee');
        return $agents->row();
	 }else{ 
		$this->db->select('agentid as id,Name as Name');
		$this->db->where(array('soft_delete'=>0,'agentid'=>$id));
		$agents=$this->db->get('sales_agent');
        return $agents->row();
	 }
	}
	function get_amenities($ids){
		$amenties = $this->db->select(" group_concat(`Name` separator ',') as `name`")->where_in('id', json_decode($ids))->get('amenties')->row();
		return $amenties;
		
	}
		function get_type(){
		$this->db->select('*');
		$this->db->where('soft_delete',0);
		$query=$this->db->get('unit_group_type');
		 if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
	}
	function get_employee(){
		$this->db->select("id,first_name");
		$this->db->where("termination",1);
		$q=$this->db->get("employee");
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	function get_followups(){
		$this->db->select("enquiry_id,Customer_name");
		$this->db->where("enquiry_status",1);
		$q=$this->db->get("crm_enquiry");
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	  function campaign_save($save){
        if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('campaign', $save);
            return $save['id'];
        }else{
            $this->db->insert('campaign', $save);
            return $this->db->insert_id();
        }
    }
	function get_campaign($id){
		$this->db->select("campaign.*,employee.first_name");
		$this->db->join("employee","employee.id=campaign.created_by","left");
		$this->db->where("campaign.soft_delete",0);
		$this->db->where("campaign.id",$id);
		$q=$this->db->get("campaign");
		if($q->num_rows()>0){
			return $q->row();
		}
		return false;
		
	}
	function campaign_delete($id){
		$this->db->where("id",$id);
		$this->db->delete("campaign");
		return true;
	}
	function get_campaignlist(){
		$this->db->select("*");
		$this->db->where("campaign.soft_delete",0);
		$q=$this->db->get("campaign");
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	function get_leads($campaignid){
		$campaign=$this->db->get_where("campaign",array("id"=>$campaignid));
		if($campaign->num_rows()>0){
		$campaign_details=$campaign->row();
		$this->db->select("Customer_name");
		$this->db->where_in("enquiry_id",json_decode($campaign_details->members));
		$q=$this->db->get("crm_enquiry");
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		}
		return false;
	}
	function get_leads_contact($campaignid){
		$campaign=$this->db->get_where("campaign",array("id"=>$campaignid));
		if($campaign->num_rows()>0){
		$campaign_details=$campaign->row();
		$this->db->select("contact_number");
		$this->db->where_in("enquiry_id",json_decode($campaign_details->members));
		$q=$this->db->get("crm_enquiry");
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		}
		return false;
	}
	function getbuilding(){
		$this->db->select('*');
		$this->db->where('soft_delete',0);
		$query= $this->db->get('building_info');
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
	}
	
	function get_enquirys_details($enquiry_id){
		$this->db->select("crm_enquirys.*,building_info.name building,floors.name floors,u.first_name,s.first_name attendedby");
		$this->db->where("crm_enquirys.id",$enquiry_id);
		$this->db->join("building_info","building_info.bldid=crm_enquirys.preferred_wing","left");   
		$this->db->join("floors","floors.id=crm_enquirys.floor","left");
		$this->db->join("users u","u.id=crm_enquirys.lead_forward_to","left");
		$this->db->join("users s","s.id=crm_enquirys.attended_by","left");
		$q=$this->db->get("crm_enquirys");
		if($q->num_rows()>0){
			return $q->row();
		}
		return false;
	}
	function enquiryForm_save($save,$crm_pos_enquiry){
		if(!empty($save['id'])){
			$this->db->where("id",$save['id']);
			$this->db->update("crm_enquirys",$save);
			if(!empty($crm_pos_enquiry)){
				$this->db->where('enquiry_id',$save['id']);
				$this->db->delete('crm_pos_enquiry');
				$crm_pos_enquiry['enquiry_id']=$save['id'];
				$this->db->insert("crm_pos_enquiry",$crm_pos_enquiry);
			}
			return true;
		}else{
			$this->db->insert("crm_enquirys",$save);;
			return 	$this->db->insert_id();
		}
		return false;
	}
	 function findmaxId(){
	  $this->db->select(" IFNULL(MAX(id),0)+1 AS `maxid`");
	  $q=$this->db->get("crm_enquirys");
	  if($q->num_rows()>0){
		  return $q->row('maxid');
	  }
	  return false;
  }
  function get_unit_type(){
	  	$this->db->select("*");
		$this->db->where("Soft_delete",0);
		$q=$this->db->get("unit_type");
		if($q->num_rows()>0){
			  foreach ($q->result() as $row) {
               $data[] = $row;
           }
           return $data;
		}
		return false;
  }
   function get_pos_enquiry($enquiry_id){
	  $this->db->select("*");
	  $this->db->where("enquiry_id",$enquiry_id);
	  $q=$this->db->get("crm_pos_enquiry");
	  if($q->num_rows()>0){
		  return $q->row();
	  }
	  return false;
  }
   function get_floor($buildingid){
	   $this->db->select("*");
	   $this->db->where("building_id",$buildingid);
	   $q=$this->db->get('floors');
	   if($q->num_rows()>0){
		   foreach($q->result() as $row){
			$data[]=$row;
		}
		return $data;
	   }
	   return false;
   }
   function  get_sale_person(){
	   $this->db->select("*");
	   $this->db->where("Is_sales_persons",1);
	   $q=$this->db->get("users");
	   if($q->num_rows()>0){
		   foreach($q->result() as $row){
			   $data[]=$row;
		   }
		   return $data;
	   }
	   return false;
   }
}