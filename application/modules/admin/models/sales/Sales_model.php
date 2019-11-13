<?php
Class Sales_model extends CI_Model
{
    var $CI;
    function __construct()
    {
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

	function getSalesPersondetails($client_id){
		$this->db->select('E.agentid,E.SalesPersontype');
		$this->db->from('crm_customer C');
		$this->db->join('crm_enquiry E','E.enquiry_id = C.enquiry_id');
		$this->db->where('C.customer_id',$client_id);
		$query = $this->db->get();
		return $query->result();
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
	function getClients(){
		return $this->db->get_where('crm_customer',array('soft_delete'=>0))->result();
	}
	function getFloor(){
		return $this->db->get_where('floors',array('Soft_delete'=>0))->result();
	}	
	function getAllUnits(){
		return $this->db->get_where('add_unit',array('Soft_delete'=>0))->result();		
	}
	function getUnitType(){
		return $this->db->get_where('unit_type',array('Soft_delete'=>0))->result();		
	}

		function getEnquiry($id){
		return $this->db->get_where('crm_enquiry',array('soft_delete'=>0,'enquiry_id'=>$id))->row();
	}
		function getEnquiryView($id){
		/* return $this->db->get_where('crm_enquiry',array('soft_delete'=>0,'enquiry_id'=>$id))->row(); */
		$this->db->select('crm_enquiry.*,project.Name as projectname,projecttypes.ProjectType,countries.name as countryname');
		$this->db->join('project','project.id=crm_enquiry.projectid','left');
		$this->db->join('add_unit','add_unit.uid=crm_enquiry.unitid and add_unit.Project_id=crm_enquiry.projectid','left');
		$this->db->join('countries','countries.id=crm_enquiry.country','left');
		$this->db->join('projecttypes','projecttypes.id=crm_enquiry.type_for','left');
		$this->db->where('enquiry_id',$id);
		$query=$this->db->get('crm_enquiry');
		return $query->row();
		
	}
function sale_booking_insert($project,$sale_invoce,$sale_emi){
    	$this->db->insert('sale_project',$project);
		$booking_id = $this->db->insert_id();
         $this->db->where('uid',$project['unit_id']);
		 $this->db->update('add_unit',array('Booked_status'=>1));
		 if(isset($project['isPaid_initialAmount'])){
			 $this->db->where('customer_id',$project['client_id']);
			 $this->db->update('crm_customer',array('initialAmountpaid'=>1));
		 }
        if (!empty($booking_id)){
        	foreach ($sale_invoce as  $invoice) {
        		$invoice['sale_id'] = $booking_id; 
        	$this->db->insert('sales_invoice_item',$invoice);
        	}
			if(!empty($sale_emi)){
        	foreach ($sale_emi as  $emi) {
        		$emi['sale_id'] = $booking_id; 
        	    $this->db->insert('sales_emi',$emi);
        	}
			}
            return $booking_id;
        }
return $booking_id;
    }

function sale_booking_update($booking_id,$project,$sale_invoce,$sale_emi)
    {   
        $this->db->where('uid',$project['unit_id']);
		$this->db->update('add_unit',array('Booked_status'=>1));
    	$this->db->where('id', $booking_id);
        $this->db->update('sale_project', $project);
        if (!empty($booking_id)){
    	    $this ->db->where('sale_id', $booking_id);
			$this ->db->delete('sales_invoice_item');
			$this ->db->where('sale_id', $booking_id);
			$this ->db->delete('sales_emi');
			// $this ->db->where('sale_id', $booking_id);
        	foreach ($sale_invoce as  $invoice) {
        		$invoice['sale_id'] = $booking_id; 
        		$this->db->insert('sales_invoice_item',$invoice);        		
        	}
        	foreach ($sale_emi as  $emi) {
        		$emi['sale_id'] = $booking_id; 
        		$this->db->insert('sales_emi',$emi);
        	}
		
            return $booking_id;
        }
		 return $booking_id;
    }
      function get_sales($sale_id){
		   $this->db->select("sp.*,cc.*,cc.agentid,cc.SalesPersontype,au.unit_no,f.name floorname,f.floor_no as fn");
		   $this->db->join("crm_customer cc","cc.customer_id=sp.client_id","left");
		//   $this->db->join("crm_enquiry ce","ce.enquiry_id=cc.enquiry_id","left");
		   $this->db->join("floors f","f.id=sp.floor_id","left");
		   $this->db->join("add_unit au","au.uid=sp.unit_id","left");
		   $this->db->where("sp.id",$sale_id);
		   $query= $this->db->get('sale_project sp');
           return $query->row();
            
	  }
    function Get_salebooking($id)
	{
		$result = $this->db->query("SELECT * FROM sale_project WHERE id =".$id."")->row();
        return $result;
	}
    function Get_salebookinginvoice($id)
	{
		$result = $this->db->query("SELECT * FROM sales_invoice_item WHERE sale_id =".$id."")->result();
        return $result;
	}
     function Get_salebookingemi($id)
	{
		$result = $this->db->query("SELECT * FROM sales_emi WHERE sale_id =".$id."")->result();
        return $result;
	}


    /*function Get_salebooking($id)
	{
		$result = $this->db->query("SELECT * FROM sale_project WHERE Soft_delete=1 AND id =".$id."")->result();
        return $result;
	}
    function Get_salebookinginvoice($id)
	{
		$result = $this->db->query("SELECT * FROM ales_invoice_item WHERE Soft_delete=1 AND sale_id =".$id."")->result_array();
        return $result;
	}	*/


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
	function saleproject(){
		return $this->db->count_all("sale_project");
	}
	 function get_all_confirm_booking($limit,$start)
      {
		$this->db->select('sale_project.*,project.Name as projectname,crm_customer.customer_name,add_unit.unit_no');
		$this->db->join('project','project.id=sale_project.project_id','left');			
		$this->db->join('crm_customer','crm_customer.customer_id=sale_project.client_id','left');			
		$this->db->join('add_unit','add_unit.uid=sale_project.unit_id','left');			
	$this->db->where(array('sale_project.booking_type'=>1,'sale_project.Soft_delete'=>0));
		//$this->db->limit($limit, $start);
        $query = $this->db->get("sale_project");   

        if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }

	 function get_all_hold_booking($limit,$start)
      {
		$this->db->select('sale_project.*,project.Name as projectname,crm_customer.customer_name,add_unit.unit_no');
		$this->db->join('project','project.id=sale_project.project_id','left');			
		$this->db->join('crm_customer','crm_customer.customer_id=sale_project.client_id','left');			
		$this->db->join('add_unit','add_unit.uid=sale_project.unit_id','left');	
		$this->db->where(array('sale_project.booking_type'=>2,'sale_project.Soft_delete'=>0));
	//	$this->db->limit($limit, $start);
        $query = $this->db->get("sale_project");        
        if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }

     function get_all_cancelled_booking($limit,$start)
      {
		$this->db->select('sale_project.*,project.Name as projectname,crm_customer.customer_name,add_unit.unit_no');
		$this->db->join('project','project.id=sale_project.project_id','left');			
		$this->db->join('crm_customer','crm_customer.customer_id=sale_project.client_id','left');			
		$this->db->join('add_unit','add_unit.uid=sale_project.unit_id','left');			
		$this->db->where(array('sale_project.booking_type'=>3,'sale_project.Soft_delete'=>0));
		//$this->db->limit($limit, $start);
        $query = $this->db->get("sale_project");        
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
		$this->db->limit($limit, $start);
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
		   if ($id)
        {
            $this->db->where('followupid', $id);
            $this->db->update('crm_followup', $save);
            return $save['id'];
        }
        else
        {
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
	function  addFinaltag($id){
		
		$query = $this->db->get_where('crm_enquiry',array('enquiry_id'=>$id));
        foreach ($query->result() as $row) {
			unset($row->enquiry_date,$row->Budget,$row->type_for,$row->suggest_modification,$row->source_of_enquiry,$row->enquiry_status,$row->projectid,$row->unitid,$row->agentid,$row->SalesPersontype,$row->created_on);
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
	
	function getCustomerlist($pricinpalAmount,$term,$interestpercentage){
		$term = 30; 
		$intr =$interestpercentage/ 1200; 
		# This for total emi for per month
		$EMI= ceil($pricinpalAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
		# This is for Total interest		
		$TOT_INTEREST= ceil(($pricinpalAmount * $intr / (1 - (pow(1/(1 + $intr), $term))))*$term) - $pricinpalAmount; 
	}

	function  agent_save($save){		

		if ($save['agentid']){
            $this->db->where('agentid', $save['agentid']);
            $this->db->update('sales_agent', $save);
			if($save['agenttype'] ==lang('sales_excutive')){
			$data=array('first_name'=>$save['name'],'is_agent'=>1,'agent_id'=>$save['agentid'],'contact_details'=>$save['mobile']);
			$this->db->where('agent_id', $save['agentid']);
            $this->db->update('employee', $data);
			}
            return $save['agentid'];
        }else{
            $this->db->insert('sales_agent',$save);  
            $agentid= $this->db->insert_id();
		
			if($save['agenttype'] ==lang('sales_excutive')){
			$data=array('first_name'=>$save['name'],'is_agent'=>1,'agent_id'=>$agentid,'contact_details'=>$save['mobile']);
			$this->db->insert('employee',$data);  
			}
			return true;   			
        }
	}

	 function get_all_agentlist($limit,$start)
      {
		$this->db->select('sales_agent.*');		
		$this->db->where('soft_delete', 0);
		$this->db->limit($limit, $start);
        $query = $this->db->get("sales_agent");        
        if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
    }
    function getAgent($id){
    	return $this->db->get_where('sales_agent',array('soft_delete'=>0,'agentid'=>$id))->row();		
	}
	
   function agentDelete($id){
		    $save=array('soft_delete'=>1);
            $this->db->where('agentid', $id);
            $this->db->update('sales_agent', $save);
            return $id;
    }
	
	function cancelBooking($id){
		    $sales=$this->db->get_where('sale_project',array('id'=>$id))->row();
		    $save=array('booking_type'=>3);
            $this->db->where('id', $id);
            $this->db->update('sale_project', $save);  
			$this->db->where(array('uid'=>$sales->unit_id ,'Project_id'=>$sales->project_id,'floor_no'=>$sales->floor_id));
			$this->db->update('add_unit',array('Booked_status'=>0));
            return $id;
    }
	function deleteBooking($id){
            $this->db->where('id',$id);
            $this->db->update('sale_project', array('Soft_delete'=>1));  
            return $id;
    }
	

	function get_booking_details($id){
		$this->db->select('*');
		$this->db->join('crm_customer','crm_customer.customer_id=sale_project.client_id','left');
		$this->db->join('add_unit','add_unit.uid=sale_project.unit_id','left');
		$this->db->where('sale_project.id',$id);
		$query = $this->db->get("sale_project");
		return $query->row();
	}
	    
	function payEMI($sale_id, $emi_no,$status,$date){
		
		 	$Emi=$this->db->get_where('sales_emi',array('id'=>$emi_no))->row();
			$paidemi=$Emi->emi_amount;
			$sales=$this->db->get_where('sale_project',array('id'=>$sale_id))->row();
		if($status =='Paid'){
			
			if($Emi->type ==1){
			$balance=$sales->moratorium_balance;
			$totalbalance=($balance) + ($paidemi);
			$this->db->where('id',$sale_id);
			$this->db->update('sale_project',array('moratorium_balance'=>$totalbalance));
			$this->db->where('id',$emi_no);
			$this->db->update('sales_emi',array('emi_status'=>0,'balance'=>$totalbalance,'paid_date'=>$date));
			}else{
			$balance=$sales->loan_balance;
			$totalbalance=($balance) + ($paidemi);
			$this->db->where('id',$sale_id);
			$this->db->update('sale_project',array('loan_balance'=>$totalbalance));
			$this->db->where('id',$emi_no);
			$this->db->update('sales_emi',array('emi_status'=>0,'balance'=>$totalbalance,'paid_date'=>$date));
			}
			return true; 
		}else{
		   if($Emi->type ==1){
			$balance=$sales->moratorium_balance;
			$totalbalance=($balance) - ($paidemi);
			$this->db->where('id',$sale_id);
			$this->db->update('sale_project',array('moratorium_balance'=>$totalbalance));
			$this->db->where('id',$emi_no);
			$this->db->update('sales_emi',array('emi_status'=>1,'balance'=>$totalbalance,'paid_date'=>$date));
			}else{
				
			 $balance=$sales->loan_balance;
		 	 $totalbalance=($balance) - ($paidemi);
	
			$this->db->where('id',$sale_id);
			$this->db->update('sale_project',array('loan_balance'=>$totalbalance));
			$this->db->where('id',$emi_no);
			$this->db->update('sales_emi',array('emi_status'=>1,'balance'=>$totalbalance,'paid_date'=>$date));
				
			}
			return true;
		}
		   
    }
    function getInvoicerecipt($id){
        $query=$this->db->query("SELECT unit_no,house_no,ad.address houseaddress,emi_amount ,LPAD(se.id,5,'0') as receiptid,LPAD(sp.id,5,'0') as contract_id,
emi_duedate,paid_date,cc.customer_name,cc.address customeraddress,  cc.contact_number,ut.UnitType,ref_no,contractNumber,cc.customername2,cc.displayname1 ,cc.dislayname2,advance_amt,booking_date   FROM  sales_emi se
			LEFT JOIN `sale_project` sp ON sp.id=se.sale_id
			LEFT JOIN add_unit ad ON ad.uid=sp.unit_id
			LEFT JOIN crm_customer cc ON cc.customer_id=sp.client_id
			left join unit_type ut on ut.id=ad.Unit_type
			WHERE se.id=$id ");
            
			return $query->row();
    }
	function getInvoicerecipt1($id){
        $query=$this->db->query("SELECT unit_no,house_no,ad.address houseaddress,paid_amount ,LPAD(se.id,5,'0')     as      receiptid,LPAD(sp.id,5,'0') as contract_id,
           payment_date,cc.customer_name,cc.address customeraddress,  cc.contact_number,ut.UnitType,ref_no,contractNumber,cc.customername2,cc.displayname1 ,cc.dislayname2   FROM  sale_payment se
			LEFT JOIN `sale_project` sp ON sp.id=se.sale_id
			LEFT JOIN add_unit ad ON ad.uid=sp.unit_id
			LEFT JOIN crm_customer cc ON cc.customer_id=sp.client_id
			left join unit_type ut on ut.id=ad.Unit_type
			WHERE se.id=$id ");
			return $query->row();
    }
	function getInvoiceByID($id){
		$this->db->select("*");
		$this->db->where('id',$id);
		$query=$this->db->get("sale_project");
		return $query->row();
	}
	function advancerecipt($id){
		//return $this->db->get_where('sale_project',array('id',$id))->row();
		$this->db->select('LPAD(sp.id,5,"0") as id,sp.booking_date,advance_amt,,cc.customername2,cc.displayname1 ,cc.dislayname2,unit_no,house_no,ad.address houseaddress,cc.customer_name,cc.address customeraddress,  cc.contact_number,ut.UnitType,ref_no,contractNumber,');
		$this->db->join('add_unit ad','ad.uid=sp.unit_id','left');
		$this->db->join('crm_customer cc','cc.customer_id=sp.client_id','left');
		$this->db->join('unit_type ut','ut.id=ad.Unit_type','left');
		$this->db->where('sp.id',$id);
		$query=$this->db->get('sale_project sp');
		return $query->row();
		
	}
	function addPayment($payment,$id,$payment_id){
		if($payment_id){
			  $this ->db->where('id', $payment_id);
			  $this ->db->delete('sale_payment');
			  $this->db->where('id',$id);
		      $this->db->update('sale_project',array('balance'=>$payment['balance_amount']));
		     $this->db->insert('sale_payment',$payment);
		     return true;
		}else{
		$this->db->where('id',$id);
		$this->db->update('sale_project',array('balance'=>$payment['balance_amount']));
		$this->db->insert('sale_payment',$payment);
		return true;
		}
	}
  function checkPaidAmount($paymentid){
	  $payment=$this->db->get_where('sale_payment',array('id'=>$paymentid))->row();
	  $paid=($payment->paid_amount)? $payment->paid_amount :0;
 	  $balanceamount=($payment->balance_amount)? $payment->balance_amount :0;
      $totalBalance=($paid)+ ($balanceamount);
	 return $totalBalance;
	  
  }
  function paymentdelete($id){
	    $payment=$this->db->get_where('sale_payment',array('id'=>$id))->row();
	    $paid=($payment->paid_amount)? $payment->paid_amount :0;
 	    $balanceamount=($payment->balance_amount)? $payment->balance_amount :0;
        $totalBalance=($paid)+ ($balanceamount);
		$this->db->where('id',$payment->sale_id);
		$paymentupdate=$this->db->update('sale_project',array('balance'=>$totalBalance));
		if($paymentupdate){
			$this ->db->where('id', $id);
			  $this ->db->delete('sale_payment');
			return true;
		}else{
			
			return false;
		}
  }
  
  function salesCommisionForAgentList(){
	  $this->db->select('sales_agent.agentid  ,name,((((sum(total_cost))/100)*sales_commission)- IFNULL(sum(commission_paid),0)) as pending,IFNULL(sum(commission_paid),0) as paid,(((sum(total_cost))/100)*sales_commission) as commissionamt,sales_commission,crm_enquiry.SalesPersontype');
	  $this->db->join('crm_customer','crm_customer.enquiry_id=crm_enquiry.enquiry_id','left');
	  $this->db->join('sale_project','sale_project.client_id=crm_customer.customer_id','left');
	  $this->db->join('sales_agent','sales_agent.agentid=crm_enquiry.agentid','left');
	  $this->db->join('sales_commission','sales_commission.agentid=crm_enquiry.agentid','left');
	  $this->db->where('crm_enquiry.SalesPersontype','Agent');
	  $this->db->where('crm_enquiry.agentid !=',0);
	  $this->db->where('sales_agent.sales_commission !=',0.00);
	  $this->db->where('crm_enquiry.SalesPersontype','Agent');
	  $this->db->group_by(array("crm_enquiry.agentid", "crm_enquiry.SalesPersontype"));
	  $query= $this->db->get('crm_enquiry');
	 
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       return false;
  }
  function addcommissionpayment($payment){
	  $this->db->insert('sales_commission',$payment);
	  return true;
  }
  function getCurrency(){
		$this->db->select('currrency_symbol,currency_code');
		$this->db->join('currency','settings.default_currency =currency.id');
		$this->db->where('currency.STATUS=1');
		$query=$this->db->get('settings');
		return $query->row();
	}
	function getEmi($saleid){
		return $query=$this->db->get_where('sales_emi',array('sale_id'=>$saleid))->result();
	}
	function getPaymentSchedule($saleid){
		$this->db->select('*');
		$this->db->join('crm_customer','crm_customer.customer_id=sale_project.client_id');
		$this->db->join('add_unit','add_unit.uid=sale_project.unit_id');
		$this->db->where('sale_project.id',$saleid);
		$query=$this->db->get('sale_project');
		return $query->row();
	}
	function getSalesCommission($id){
		
		$this->db->select('*');
		$this->db->join('sales_agent','sales_agent.agentid=sales_commission.agentid');
		$this->db->where('sales_commission.commission_id',$id);
		$query=$this->db->get('sales_commission');
		return $query->row();
	}
	function salesCommisionEditSave($save,$id){
		if($id){
		$this->db->where('commission_id',$id);
		$this->db->update('sales_commission',$save);
		return true;
		}else{
			return false;
		}
	}
	function getSettings(){
		return $this->db->get_where('settings',array('id'=>1))->row();
		
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
	
	function get_emi($sales_id,$type){
		return $this->db->get_where('sales_emi',array('sale_id'=>$sales_id,'type'=>$type))->result();
		
	}
	function getBuildingProjectWise($projectid){
		return $this->db->get_where('building_info',array('soft_delete'=>0,'project_id'=>$projectid))->result();
	}	
	function getFloor_project($projectid,$buildingid){
		return $this->db->get_where('floors',array('Soft_delete'=>0,'projectid'=>$projectid,'building_id'=>$buildingid))->result();
	}	
	function getAllUnits_project($projectid,$buildingid,$floorid,$unit_id){
		$this->db->select('*');
		$this->db->where(array('Project_id'=>$projectid,'floor_no'=>$floorid,'building_id'=>$buildingid));
		$this->db->where('Booked_status',0);
		$this->db->or_where_in('uid',$unit_id);
		$query=$this->db->get('add_unit');
		 if ($query->num_rows() >= 1){
        foreach ($query->result() as $row){
            $data[] = $row;
        }
    }
    return $data;
	
	}
	function save_contract($save){
		$sales=$this->db->get_where('contract_upload',array('contact_id'=>$save['contact_id'],'sale_id'=>$save['sale_id']))->row();
		if(!empty($sales)){
		$this->db->where(array('contact_id'=>$save['contact_id'],'sale_id'=>$save['sale_id']));
			$this->db->update('contract_upload',$save);
		}else{
			$this->db->insert('contract_upload',$save);
		}
		return true;
	}
	function get_contractform($sale_id){
		$this->db->select('*');
		$this->db->where('sale_id',$sale_id);
		$query=$this->db->get('contract_upload');
		if($query->num_rows()>0){
			 foreach ($query->result() as $row){
              $data[] = $row;
		}
		return $data;
		}
		return false;
	}
	function generate_owner($sales_id){
		$sales=$this->db->get_where("sale_project",array("id"=>$sales_id));
		if($sales->num_rows()>0){
		     $sales=$sales->row();
			$client=$this->db->get_where("crm_customer",array("customer_id"=>$sales->client_id))->row();   
			$Owner=$this->db->get_where('owner',array('client_id'=>$sales->client_id));
			if($Owner->num_rows()>0){
				$Owner=$Owner->row();
				$Owner_id=$Owner->ownid;
			$data=array('client_id'=>$sales->client_id,
			'full_name'=>$client->customer_name,
			'dob'=>$client->dob,
			'primary_phone'=>$client->contact_number,
			'handphone'=>$client->contact_number,
			'permanent_address'=>$client->address,
			'project_id'=>$sales->project_id,
			'building_id'=>$sales->building_id,
			'floor_id'=>$sales->floor_id,
			'units'=>$sales->unit_id,
			'email'=>$client->email);
			$this->db->where("client_id",$sales->client_id);
			$this->db->update("owner",$data);
			
			}else{
				$data=array('client_id'=>$sales->client_id,'full_name'=>$client->customer_name,
				'dob'=>$client->dob,'primary_phone'=>$client->contact_number,
				'handphone'=>$client->contact_number,
				'permanent_address'=>$client->address,
			    'project_id'=>$sales->project_id,
				'building_id'=>$sales->building_id,
				'floor_id'=>$sales->floor_id,
				'units'=>$sales->unit_id,
				'email'=>$client->email);
				$this->db->insert("owner",$data);
				$Owner_id= $this->db->insert_id();
			}
			$query=$this->db->get_where('add_owner_unit_relation',array('owner_id'=>$Owner_id,
			'project_id'=>$sales->project_id,
			'building_id'=>$sales->building_id,
			'floor_id'=>$sales->floor_id,
			'unit_id'=>$sales->unit_id));
			if($query->num_rows()>0){
				$this->db->where(array(
				'project_id'=>$sales->project_id,
				'building_id'=>$sales->building_id,
				'floor_id'=>$sales->floor_id,
				'unit_id'=>$sales->unit_id));
				$this->db->delete("add_owner_unit_relation");
			}
				$this->db->insert('add_owner_unit_relation',array('owner_id'=>$Owner_id,'project_id'=>$sales->project_id,'building_id'=>$sales->building_id,'floor_id'=>$sales->floor_id,'unit_id'=>$sales->unit_id));
				
			//sale commission for pmc .when sale unit be  resale request unit from owner
			  $this->sale_commission_generate($sales->project_id,$sales->building_id,$sales->unit_id,$sales->basic_sale_price,$sales->ref_no,$Owner_id,$sales->booking_date);
		}
		
	}
	
	function sale_commission_generate($projectid,$buildingid,$unitid,$price,$refno,$Owner_id,$sale_date){
		$unit=$this->db->get_where("add_unit",array("Project_id"=>$projectid,"building_id"=>$buildingid,"uid"=>$unitid))->row();
		if($unit->request_id !=0){
			$unitRequest=$this->db->get_where("owner_unit_request",array("id"=>$unit->request_id))->row();
		  if(!empty($price)){
			    $leaseAmount=0;
            if($unitRequest->commission_type == lang('percentage')){
			     $leaseAmount=($unitRequest->price/100)*$unitRequest->commission;
		      }else{
			     $leaseAmount=$unitRequest->commission;
			 }
		 }		
		 $data=array("owner_id"=>$unitRequest->owner_id,

		 "projectid"=>$unitRequest->projectid,
		 "buildingid"=>$unitRequest->buildingid,
		 "floorid"=>$unitRequest->floorid,
		 "unitid"=>$unitRequest->unitid,
		 "date"=> date('Y-m-d '),
		 "reference_number"=>'SC'.strtotime(date('Y/m/d H:i:s')),
		 "commission_amount"=>$leaseAmount,
		 "balance"=>$leaseAmount,
		 "saled_to_owner "=>$Owner_id,
		 "sales_refno"=>$refno,
		 "sales_date "=>$sale_date);
		 $this->db->insert("resale_commission",$data);
		 $this->db->where(array("Project_id"=>$projectid,"building_id"=>$buildingid,"uid"=>$unitid));
		 $this->db->update("add_unit",array("request_id"=>0));
		 $this->db->where("id",$unitRequest->id);
		 $this->db->update("owner_unit_request",array("is_closed"=>1,"is_closed_by"=>"PMC"));
		 return true;
		}
		return true;
	}
}
