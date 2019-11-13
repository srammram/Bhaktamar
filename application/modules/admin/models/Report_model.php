<?php
Class Report_model extends CI_Model
{
    var $CI;
    function __construct()
    {
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	

     function get_all_booking_details()
      {
        $this->db->select('sale_project.*,project.Name as projectname,crm_customer.customer_name,add_unit.unit_no,
                          CASE
                            WHEN (booking_type=1) THEN "Confirm"
                            WHEN (booking_type=2) THEN "Hold"
                            WHEN (booking_type=3) THEN "Cancelled"
                         END as booking_status');
        $this->db->from('sale_project');
        $this->db->join('project','project.id=sale_project.project_id','left');         
        $this->db->join('crm_customer','crm_customer.customer_id=sale_project.client_id','left');          
        $this->db->join('add_unit','add_unit.uid=sale_project.unit_id','left');         
        // $this->db->where('sale_project.booking_type',3);
        // $this->db->limit($limit, $start);
        $query = $this->db->get();      
        
        if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }


    function get_all_units()
    {
        $result = $this->db->query(' SELECT uid,  Unit_type  ,unit_no,House_details         ,         House_length   ,Active , Project_id  ,au.Description  ,   Soc,  Amenities ,p.id,p.NAME as pn,s.id,s.NAME as sn,ut.id,ut.UnitType FROM `add_unit`  au
        LEFT JOIN project p ON p.id=au.Project_id
        LEFT JOIN soc  s  ON s.id=au.Soc
        LEFT JOIN unit_type ut ON ut.id=au.Unit_type
        ')->result();

        return $result;
    }

    function get_all()
    {
		$result = $this->db->query("SELECT bill_id,bill_type, CASE    WHEN bill_type=1
THEN (SELECT Facility_name FROM   `facility`  WHERE Fac_id=Bill_catgory)
WHEN   bill_type=2
THEN  (SELECT Service_name FROM   `services`  WHERE id=Bill_catgory)
WHEN bill_type=3
THEN 'Others'
 END AS Billtype_cat,o_name, bill_date,total_amount,bill_details, Issued_date,  Paid_Status,Owner_id  FROM     add_bill ab
LEFT JOIN add_owner ao ON ao.ownid=ab.Owner_id
WHERE Soft_delete=1")->result();
         return $result;
    }
	function get($id)
    {
		$result = $this->db->query("SELECT ab.Owner_id,bill_id,bill_type, CASE    WHEN bill_type=1
THEN (SELECT Facility_name FROM   `facility`  WHERE Fac_id=Bill_catgory)
WHEN   bill_type=2
THEN  (SELECT Service_name FROM   `services`  WHERE id=Bill_catgory)
WHEN bill_type=3
THEN 'Others'
 END AS Billtype_cat,o_name, bill_date,total_amount,bill_details, Issued_date,  Paid_Status,Owner_id  FROM     add_bill ab
LEFT JOIN add_owner ao ON ao.ownid=ab.Owner_id
WHERE Soft_delete=1 and bill_id=$id ")->row();
         return $result;
		
		
    }
    function save($save)
    {
        if ($save['bill_id'])
        {
            $this->db->where('bill_id', $save['bill_id']);
            $this->db->update('add_bill', $save);
            return $save['bill_id'];
        }
        else
        {
            $this->db->insert('add_bill', $save);
            return $this->db->insert_id();
        }
    }
	 
    function delete($id)
    {
		    $save=array('Soft_delete'=>0);
		    $this->db->where('bill_id', $id);
            $this->db->update('add_bill', $save);
    }
    function Get_owner()
    {
		$result = $this->db->get('add_owner');
        return $result->result();
	}
	function Get_Facility()
	{
		$result = $this->db->query('SELECT Fac_id  , Facility_name FROM   `facility` ')->result();
        return $result;
	}
	
	  function Get_Services()
    {
		$result = $this->db->query('SELECT  id,  Service_name FROM `services`')->result();
        return $result;
	}
	  function Get_add_bill()
       {
		$result = $this->db->query('SELECT bill_id,  add_bill_name FROM `add_bill`')->result();
        return $result;
	   }
	function Get_From()
       {
		$result = $this->db->query('SELECT address,phone,email FROM   `settings` LIMIT 1')->row();
        return $result;
	   }
	   function Get_To($id)
       {
		$result = $this->db->query("SELECT o_name,o_email,o_contact FROM add_owner WHERE  ownid=$id")->row();
        return $result;
	   }
	   function Get_bill_details($id)
	   { 
		   $result = $this->db->query("SELECT ab.Owner_id,bill_id,bill_type, CASE    WHEN bill_type=1
			THEN (SELECT Facility_name FROM   `facility`  WHERE Fac_id=Bill_catgory)
			WHEN   bill_type=2
			THEN  (SELECT Service_name FROM   `services`  WHERE id=Bill_catgory)
			WHEN bill_type=3
			THEN 'Others'
			END AS Servicess,o_name, bill_date,total_amount,bill_details, Issued_date,  Paid_Status,Owner_id  FROM     add_bill ab
			LEFT JOIN add_owner ao ON ao.ownid=ab.Owner_id
			WHERE Soft_delete=1 AND bill_id=$id")->row();
            return $result;
	   }
	   function getSalesReports($start,$end,$paymenttype,$limit,$offset){
       $this->db->start_cache();
       $this->db->select('s.*,p.Name as project,au.unit_no,cc.customer_name');
	   $this->db->join('project p','p.id=s.project_id','left');
	   $this->db->join('add_unit au','au.uid=s.unit_id','left');
	   $this->db->join('crm_customer cc','cc.customer_id=s.client_id','left');
                if($paymenttype ==1){
					$this->db->where('(advance_amt +balance) =total_cost');
					$this->db->where('isPaid_initialAmount',1);
				}
				if($paymenttype ==2){
					$this->db->where('balance >=',0);
				}
				if($paymenttype ==3){
					$this->db->where('balance <=',0);
				}
			  if(!empty($end)){
			  $this->db ->where('DATE(s.booking_date) >=', $start);
              $this->db->where('DATE(s.booking_date) <=', $end);
			  }else{
				   $this->db ->where('DATE(s.booking_date) =', $start);
			  }
              $this->db->stop_cache();
              $this->db->limit($limit,$offset);
	          $q = $this->db->get('sale_project s');
              $this->db->flush_cache();
              $data =  array();
              if($q->num_rows()>0){
              foreach($q->result() as $k => $row){
                $data[] = $row;
               }
            }
        return array('data'=>$data,'total'=>$q->num_rows()); 
    }
	   function getUnitReports($bookedtype,$limit,$offset){
       $this->db->start_cache();
       $this->db->select('au.unit_no,IFNULL(au.House_length,"") as House_length,IFNULL(au.House_details,"") as House_details,IFNULL(au.unitPrice,0)as unitPrice,p.Name as project');
	   $this->db->join('project p','p.id=au.Project_id','left');
                if($bookedtype ==1){
					$this->db->where('Booked_status',1);
				}else{
					$this->db->where('Booked_status',0);
				}
              $this->db->stop_cache();
              $this->db->limit($limit,$offset);
	          $q = $this->db->get('add_unit au');
              $this->db->flush_cache();
              $data =  array();
              if($q->num_rows()>0){
              foreach($q->result() as $k => $row){
                $data[] = $row;
               }
            }
        return array('data'=>$data,'total'=>$q->num_rows()); 
    }
	 function getUnattendantReports($start,$end,$limit,$offset){
              $this->db->start_cache();
              $this->db->select('*');
	          $this->db->join('crm_followup cf','cf.enquiryid=ce.enquiry_id','left');
			  if(!empty($end)){
			  $this->db ->where('DATE(ce.enquiry_date) >=', $start);
              $this->db->where('DATE(ce.enquiry_date) <=', $end);
			  }else{
				   $this->db ->where('DATE(ce.enquiry_date) =', $start);
			  }
			  $this->db->where('cf.followupid IS NULL');
              $this->db->stop_cache();
              $this->db->limit($limit,$offset);
	          $q = $this->db->get('crm_enquiry ce');
			  
              $this->db->flush_cache();
              $data =  array();
              if($q->num_rows()>0){
              foreach($q->result() as $k => $row){
                $data[] = $row;
               }
            }
        return array('data'=>$data,'total'=>$q->num_rows()); 
    }
	function getprospectiveEnquiry_Reports($start,$end,$limit,$offset){
              $this->db->start_cache();
              $this->db->select('*');
	          $this->db->join('crm_followup cf','cf.enquiryid=ce.enquiry_id','left');
			  $this->db->join('project p','p.id=ce.projectid','left');
	          $this->db->join('add_unit au','au.uid=ce.unitid','left');
			  if(!empty($end)){
			  $this->db ->where('DATE(ce.enquiry_date) >=', $start);
              $this->db->where('DATE(ce.enquiry_date) <=', $end);
			  }else{
				   $this->db ->where('DATE(ce.enquiry_date) =', $start);
			  }
			  $this->db->where('ce.enquiry_status',2);
              $this->db->stop_cache();
              $this->db->limit($limit,$offset);
	          $q = $this->db->get('crm_enquiry ce');
			  
              $this->db->flush_cache();
              $data =  array();
              if($q->num_rows()>0){
              foreach($q->result() as $k => $row){
                $data[] = $row;
               }
            }
        return array('data'=>$data,'total'=>$q->num_rows()); 
    }
		 function getPendingFollowUpReports($start,$end,$followuptype,$agenttype,$name,$limit,$offset){
			     if($followuptype ==1){
					  $date='DATE(cf.next_followup_date) as date,';
				 }else{
					  $date='DATE(followup_date_time) as date,';
				 }
				 if($agenttype == lang('Executive')){
					  $agentname='e.first_name as agentname,';
				 }
				 if($agenttype == lang('Agent')){
					 $agentname='sa.name as agentname,';
				 }
				 if(empty($name)){
					$agentname='"" as agentname,';
				 }
				 if(empty($agenttype)){
					$Atype='"" as agentype,';
				 }else{
					$Atype ='"'.$agenttype.'" as agentype';
				 }
			    $days='DATEDIFF(CURDATE(),DATE(enquiry_date)) AS days,';
			    $this->db->start_cache();
                $this->db->select(''.$date.''.$days.''.$agentname.''.$Atype.',ce.Customer_name,ce.contact_number,ce.email,ce.address,p.Name as project,au.unit_no');
	            $this->db->join('crm_enquiry ce','ce.enquiry_id=cf.enquiryid','left');
			    $this->db->join('project p','p.id=ce.projectid','left');
	            $this->db->join('add_unit au','au.uid=ce.unitid','left');
				 if($agenttype == lang('Executive')){
					  $this->db->join('employee e','e.id=ce.agentid','left');
				 }
				 if($agenttype == lang('Agent')){
					  $this->db->join('sales_agent sa','sa.agentid=ce.agentid','left');
				 }
				 ///where clause 
				 if($agenttype == lang('Executive') && !empty($name)){
					  $this->db->where('ce.agentid', $name);
					  $this->db->where('ce.SalesPersontype', lang('Executive'));
				 }
				 if($agenttype == lang('Agent')  && !empty($name)){
					  $this->db->where('ce.agentid', $name);
					  $this->db->where('ce.SalesPersontype', lang('Agent'));
				 }
                if($followuptype ==1){
					if(!empty($end)){
			        $this->db ->where('DATE(cf.next_followup_date) >=', $start);
                    $this->db->where('DATE(cf.next_followup_date) <=', $end);
			        }else{
				    $this->db ->where('DATE(cf.next_followup_date) =', $start);
			       }
				   }else{
			     if(!empty($end)){
			      $this->db ->where('DATE(cf.followup_date_time) >=', $start);
                  $this->db->where('DATE(cf.followup_date_time) <=', $end);
			      }else{
				   $this->db ->where('DATE(cf.followup_date_time) =', $start);
			     }
				}
				
              $this->db->stop_cache();
              $this->db->limit($limit,$offset);
	          $q = $this->db->get('crm_followup cf');
              $this->db->flush_cache();
              $data =  array();
              if($q->num_rows()>0){
              foreach($q->result() as $k => $row){
                $data[] = $row;
               }
            }
        return array('data'=>$data,'total'=>$q->num_rows()); 
    }
	function get_SalesmanWise_SalesReports($start,$end,$agenttype,$name,$limit,$offset){
			    
				 if($agenttype == lang('Executive')){
					  $agentname='e.first_name as agentname,';
				 }
				 if($agenttype == lang('Agent')){
					 $agentname='sa.name as agentname,';
				 }
				 if(empty($name)){
					$agentname='"" as agentname,';
				 }
				 if(empty($agenttype)){
					$Atype='"" as agentype,';
				 }else{
					$Atype ='"'.$agenttype.'" as agentype';
				 }
			    
			    $this->db->start_cache();
                $this->db->select(''.$agentname.''.$Atype.',s.booking_date,s.total_cost,ce.Customer_name,ce.contact_number,ce.email,ce.address,p.Name as project,au.unit_no');
				$this->db->join('crm_customer cc','cc.customer_id=s.client_id','left');
	            $this->db->join('crm_enquiry ce','ce.enquiry_id=cc.enquiry_id','left');
				 $this->db->join('project p','p.id=s.project_id','left');
	             $this->db->join('add_unit au','au.uid=s.unit_id','left');
				 if($agenttype == lang('Executive')){
					  $this->db->join('employee e','e.id=ce.agentid','left');
				 }
				 if($agenttype == lang('Agent')){
					  $this->db->join('sales_agent sa','sa.agentid=ce.agentid','left');
				 }
				 ///where clause 
				 if($agenttype == lang('Executive') && !empty($name)){
					  $this->db->where('ce.agentid', $name);
					  $this->db->where('ce.SalesPersontype', lang('Executive'));
				 }
				 if($agenttype == lang('Agent')  && !empty($name)){
					  $this->db->where('ce.agentid', $name);
					  $this->db->where('ce.SalesPersontype', lang('Agent'));
				 }
              
			 if(!empty($end)){
			  $this->db ->where('DATE(s.booking_date) >=', $start);
              $this->db->where('DATE(s.booking_date) <=', $end);
			  }else{
				$this->db ->where('DATE(s.booking_date) =', $start);
			  }
              $this->db->stop_cache();
              $this->db->limit($limit,$offset);
	          $q = $this->db->get('sale_project s');
			 
              $this->db->flush_cache();
              $data =  array();
              if($q->num_rows()>0){
              foreach($q->result() as $k => $row){
                $data[] = $row;
               }
            }
        return array('data'=>$data,'total'=>$q->num_rows()); 
    }
	function getSettings(){
		$this->db->select('symbol  as cur_symbol,   sac , display_symbol  ,decimals  ,thousands_sep,  decimals_sep');
		$this->db->where('id',1);
		$query=$this->db->get('settings');
		return $query->row();
	}
	function get_project($status){
		$this->db->select("*");
		$this->db->where("soft_delete",0);
		if($status !=lang('all')){
			$this->db->where("project_status",$status);
		}
		$q=$this->db->get("project");
		if($q->num_rows()>0){
              foreach($q->result() as $k => $row){
                $data[] = $row;
               }
			   return $data;
	}
	return false;
	}
	function get_building($project){
		$this->db->select("*");
		$this->db->where("soft_delete",0);
		$this->db->where("project_id",$project);
		$q=$this->db->get("building_info");
		if($q->num_rows()>0){
              foreach($q->result() as $k => $row){
                $data[] = $row;
               }
			   return $data;
	}
	return false;
		
	}
	function get_milestone($projectid,$buildingid){
		$this->db->select("*");
		$this->db->where("soft_delete",0);
		$this->db->where("projectid",$projectid);
		$this->db->where("buildingid",$buildingid);
		$q=$this->db->get("building_milestone");
		if($q->num_rows()>0){
              foreach($q->result() as $k => $row){
                $data[] = $row;
               }
			   return $data;
	}
	   return false;
	}
	function get_task($projectid,$buildingid,$milestoneid){
	    $this->db->select("*");
		$this->db->where("soft_delete",0);
		$this->db->where("project_id",$projectid);
		$this->db->where("building_id",$buildingid);
		$this->db->where("milestone_id",$milestoneid);
		$q=$this->db->get("building_task");
		if($q->num_rows()>0){
              foreach($q->result() as $k => $row){
                $data[] = $row;
               }
			   return $data;
	}
	   return false;
	}
	
	
	
}