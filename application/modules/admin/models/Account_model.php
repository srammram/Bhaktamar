<?php
Class Account_model extends CI_Model{
    var $CI;
    function __construct(){
        parent::__construct();
        $this->CI =& get_instance();
        $this->CI->load->database(); 
        $this->CI->load->helper('url');
    }
	function get_bill($id){
		  $this->db->select("add_bill.*,unit_name,uid,project.Name project,building_info.name,");
		   $this->db->join("project","project.id=add_bill.project_id","left");
		   $this->db->join("add_unit","add_unit.uid=add_bill.owner_unit","left");
		   $this->db->join("building_info","building_info.bldid=add_bill.building_id","left");
		   $this->db->where(array("add_bill.bill_id"=>$id));
		   $query=$this->db->get("add_bill");
		   if($query->num_rows()>0){
		   return $query->row();
	   }
	   return false;
	 }
   
	 function bill_save($save){
        if ($save['bill_id']){
            $this->db->where('bill_id', $save['bill_id']);
            $this->db->update('add_bill', $save);
            return $save['bill_id'];
        }else{
            $this->db->insert('add_bill', $save);
            return $this->db->insert_id();
        }
    }
	   function get_Ownerunits($projectid,$buildingid,$ownerid){
		   $this->db->select("add_owner_unit_relation.*,unit_name,uid");
		   $this->db->join("add_unit","add_unit.uid=add_owner_unit_relation.unit_id","left");
		   $this->db->where(array("add_owner_unit_relation.project_id"=>$projectid,"add_owner_unit_relation.building_id"=>$buildingid,"add_owner_unit_relation.owner_id"=>$ownerid));
		   $query=$this->db->get("add_owner_unit_relation");
		   if($query->num_rows()>0){
			   foreach($query->result() as $row){
				   $data[]=$row;
			   }
		   return $data;
	   }
	   return false;
	   }
	   function get_OwnerbyBuilding($projectid,$buildingid){
		   $this->db->select("*");
		   $this->db->where(array("project_id"=>$projectid,"building_id"=>$buildingid));
		   $query=$this->db->get("owner");
		   if($query->num_rows()>0){
			   foreach($query->result() as $row){
				   $data[]=$row;
			   }
		   return $data;
	     }
	       return false;
	   }
	function get_Project(){
      	$this->db->select('*');
		$this->db->where('soft_delete',0);
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
	function get_building($projectid){
      	$this->db->select('*');
		$this->db->where('soft_delete',0);
		$this->db->where('project_id',$projectid);
		$query= $this->db->get('building_info');
	   if ($query->num_rows() > 0) {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
           return false;
    }
	function bill_delete($id){
		$this->db->where("bill_id",$id);
		if($this->db->update("add_bill",array("soft_delete"=>1))){
			return true;
		}
		return false;
	}
	 function get_bills($billtype,$project,$building,$owner,$unit){
		 if($billtype ==lang('utility_services')){
			 $this->db->select("bill_id id ,reference_no rfno");
			 $this->db->where("owner_unit",$unit);
			 $this->db->where("Owner_id",$owner);
			 $this->db->where("building_id",$building);
			 $this->db->where("project_id",$project);
			 $this->db->where("is_billed","0");
			 $q=$this->db->get("add_bill");
	      }else{
			 $this->db->select("request_id id, reference_no rfno");
			 $this->db->where("project_id",$project);
			 $this->db->where("Unit_id",$unit);
			 $this->db->where("owner_id",$owner);
			 $this->db->where("building_id",$building);
			 $this->db->where("is_billed",0);
			 $q=$this->db->get("request");
	     }
		 if($q->num_rows()>0){
			 foreach($q->result() as $row){
				 $data[]=$row;
		 }
		 return $data;
		 }
		 return false;
	 }
	
	function   get_bills_details($billtype,$billid){
		 if($billtype ==lang('utility_services')){
			 $this->db->select("total_amount amount ,reference_no refno");
			 $this->db->where("bill_id",$billid);
			 $q=$this->db->get("add_bill");
	      }else{
			 $this->db->select("total_amount amount,reference_no refno");
			 $this->db->where("request_id",$billid);
			 $q=$this->db->get("request");
	     }
		 if($q->num_rows()>0){
		 return $q->row();
		 }
		 return false;
	}
	
	function billpayment_save($save){
		 if ($save['id']){
            $this->db->where('id', $save['id']);
            $this->db->update('bill_payments', $save);
			$this->updatepayment($save);
			$this->billupdate($save);
            return $save['id'];
        }else{
            $this->db->insert('bill_payments', $save);
			$this->updatepayment($save);
			$this->billupdate($save);
            return true;
        }
	}
	function updatepayment($save){
		
	   	   if(!empty($save['id'])){
			   $payment=$this->db->get_where("bill_payments",array("id"=>$save['id']))->row();
			   switch ($save['paid_form']){
				   case lang('reserve_fund'):
				       $this->reservefundUpdate($payment->ownerid,$payment->bill_amount,'+');
				   break;
				   case lang('property_fund'):
				       $this->propertyfundUpdate($payment->ownerid,$payment->unitid,$payment->bill_amount,'+');
				   break;
			   }
			   return true;
		   }else{
			   switch ($save['paid_form']){
				   case lang('reserve_fund'):
				       $this->reservefundUpdate($save['ownerid'],$save['bill_amount'],'-');
				   break;
				   case lang('property_fund'):
				    $this->propertyfundUpdate($save['ownerid'],$save['unitid'],$save['bill_amount'],'-');
				   break;
				   return true;
			   }
		   }
	}

	function propertyfundUpdate($ownerid,$unitid,$payment,$type){
			$query = 'update property_management_fee
			set balance = balance  '.$type.$payment.' 
			where owner_id='.$ownerid.' and unitid='.$unitid;
	        $this->db->query($query); 
		    return true;
	}
	function reservefundUpdate($ownerid,$payment,$type){
		$query = 'update reserve_fund
			set balance = balance '.$type.$payment.' 
			where owner_id='.$ownerid;
	    $this->db->query($query); 
		return true;
	}
		function billupdate($save){
		   if(!empty($save['id'])){
			   $payment=$this->db->get_where("bill_payments",array("id"=>$save['id']))->row();
			   $old_billid=$payment->bill_id;
		   }else{
			   $old_billid=null;
		   }
		   if($save['billtype']==lang('utility_services')){
			   $this->utility_billupdate($save['bill_id'],$old_billid);
			   return   true;
		   }
		   if($save['billtype']==lang('Request_services')){
				$this->request_servicesbillupdate($save['bill_id'],$old_billid);
				return true;
		   }
			 
	}
	 function get_billdetails($billtype,$billid){
		 if($billtype ==lang('utility_services')){
			 $this->db->select("bill_id id ,reference_no rfno,bill_details services");
			 $this->db->where("bill_id",$billid);
			 $q=$this->db->get("add_bill");
	      }else{
			 $this->db->select("request_id id, reference_no rfno,request_description services");
			 $this->db->where("request_id",$billid);
			 $q=$this->db->get("request");
	     }
		 if($q->num_rows()>0){
			return $q->row();
		 return $data;
		 }
		 return false;
	 }
	function get_accounts_heads(){
		$account_type = $this->db->get('accounts_type')->result();
        foreach($account_type as $type){
            $tem_head = $this->db->select('accounts_head.*,accounts_type.accounts_type')
                ->from('accounts_head')
                ->join('accounts_type', 'accounts_head.accounts_type_id = accounts_type.id', 'left')
                ->where('accounts_head.accounts_type_id', $type->id)
                ->get();
				if($tem_head->num_rows()>0){
					foreach($tem_head->result() as $item){
						 $data[] = $item;
					}
					return $data;
				}
        }
	}
	function utility_billupdate($billid,$old_billid = false){
			if(!empty($old_billid)){
			$this->db->where("bill_id",$old_billid);
			$this->db->update("add_bill",array("is_billed"=>0,"Paid_Status"=>"UnPaid"));
		}
			$this->db->where("bill_id",$billid);
			$this->db->update("add_bill",array("is_billed"=>1,"Paid_Status"=>"Paid"));
		return true;
	}
	
	function request_servicesbillupdate($billid,$old_billid = false){
		if(!empty($old_billid)){
			$this->db->where("request_id",$old_billid);
			$this->db->update("request",array("is_paid"=>0));
		}
			$this->db->where("request_id",$billid);
			$this->db->update("request",array("is_paid"=>1));
		    return true;
	}
	function get_billpayment($id){
		  $this->db->select("bill_payments.*,unit_name,uid,project.Name project,building_info.name building,owner.full_name owner,owner.handphone handphone,owner.email email,");
		   $this->db->join("project","project.id=bill_payments.projectid","left");
		   $this->db->join("add_unit","add_unit.uid=bill_payments.buildingid","left");
		   $this->db->join("building_info","building_info.bldid=bill_payments.buildingid","left");
		     $this->db->join("owner","owner.ownid=bill_payments.ownerid","left");
		   $this->db->where(array("bill_payments.id"=>$id));
		   $query=$this->db->get("bill_payments");
		   if($query->num_rows()>0){
		   return $query->row();
	   }
	   return false;
	 }
	 function  get_Ownerbilllist($project,$buildingid,$ownerid,$billtype,$billid){
		  if($billtype ==lang('utility_services')){
			 $this->db->select("bill_id id ,reference_no rfno");
			// $this->db->where("owner_unit",$unit);
			 $this->db->where("Owner_id",$ownerid);
			 $this->db->where("building_id",$buildingid);
			 $this->db->where("project_id",$project);
			 $this->db->or_where_in("bill_id",$billid);
			 $q=$this->db->get("add_bill");
	      }else{
			 $this->db->select("request_id id, reference_no rfno");
			 $this->db->where("project_id",$project);
			 $this->db->where("Unit_id",$unit);
			 $this->db->where("owner_id",$owner);
			 $this->db->where("building_id",$building);
			 $this->db->where("is_billed",0);
			 $this->db->or_where_in("request_id",$billid);
			 $q=$this->db->get("request");
	     }
		 if($q->num_rows()>0){
			 foreach($q->result() as $row){
				 $data[]=$row;
		 }
		 return $data;
		 }
		 return false;
	 }
	 
	 function billpayment_delete($id){
		$payment=$this->db->get_where("bill_payments",array("id"=>$id))->row();
		      switch ($payment->paid_form){
				   case lang('reserve_fund'):
				       $this->reservefundUpdate($payment->ownerid,$payment->paid_amount,'+');
				   break;
				   case lang('property_fund'):
				    $this->propertyfundUpdate($payment->ownerid,$payment->unitid,$payment->paid_amount,'+');
				   break;
			   }
			     switch ($payment->billtype){
				   case lang('utility_services'):
				       $this->db->where("bill_id",$payment->bill_id);
					   $this->db->update("add_bill",array("Paid_Status"=>"UnPaid","is_billed"=>0));
				   break;
				   case lang('Request_services'):
				       $this->db->where("request_id",$payment->bill_id);
					   $this->db->update("request",array("is_billed"=>0));
				   break;
			   }
		  $this->db->where("id",$id);
		  $this->db->delete("bill_payments");
		  return true;
		 
	 }
	function checkrental($projectid,$buildingid,$unitid,$tenantid,$month){
		$query=$this->db->get_where("unit_rental",array("projectid"=>$projectid,"buildingid"=>$buildingid,"unitid"=>$unitid,"tenantid"=>$tenantid,"month"=>$month));
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	function get_unpaidBills($unitid,$tenantid){
		$query=$this->db->get_where("add_bill",array("is_billed"=>0,"tenant_id"=>$tenantid,"tenant_unit"=>$unitid));
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	function get_rental_details($unitid,$tenantid,$revenueAmount){
		$query=$this->db->get_where("tenant",array("tentant_id"=>$tenantid,"unitid"=>$unitid));
		if($query->num_rows()>0){
			$tenant=$query->row();
			$rentaltype=json_decode($tenant->type);
			$revenuerent=0;
			$fixedrent=0;
			 if(in_array( lang('revenue_sales'), $rentaltype )){
				 $revenuerent=($revenueAmount/100)*$tenant->percentage;
			 }
			  if(in_array( lang('fixed'), $rentaltype )){
				 $fixedrent=!empty($tenant->amount)?$tenant->amount:0;
			 }
		 return array("rentalamount"=>$revenuerent+$fixedrent,"revenueAmount"=>$revenueAmount,"revenue_percentage"=>$tenant->percentage);
	}
	return 0;
	}
	function getprojectBy_id($projectid){
		$query=$this->db->get_where("project",array("id"=>$projectid));
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	function getbuildingBy_id($projectid,$buildingid){
		$query=$this->db->get_where("building_info",array("bldid"=>$buildingid,"project_id"=>$projectid));
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	function gettenantBy_id($tenantid){
		$query=$this->db->get_where("tenant",array("tentant_id"=>$tenantid));
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	function gettenantunitBy_id($tenantid,$unitid){
		  $this->db->select("tenant.*,unit_name,uid");
		   $this->db->join("add_unit","add_unit.uid=tenant.unitid","left");
		   $this->db->where(array("tenant.unitid"=>$unitid,"tenant.tentant_id"=>$tenantid));
		   $query=$this->db->get("tenant");
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	function  rental_save($save){
		$this->db->insert("unit_rental",$save);
		$rentalid = $this->db->insert_id();
        $referncenumber ='REN'.$rentalid;
		$this->db->where("id",$rentalid);
		if($this->db->update("unit_rental",array("referncenumber"=>$referncenumber))){
			if(!empty($save['bill_details'])){
				foreach(json_decode($save['bill_details']) as $billid){
					$this->db->where("bill_id",$billid);
					$this->db->update("add_bill",array("is_billed"=>1,"is_billed_id"=>$rentalid));
					
				}
			}
			return true;
		}
		return false;
	}
	function get_rental_detail($rentalid){
		$this->db->select("unit_rental.*,unit_name,uid,project.Name project,building_info.name,tenant.full_name");
		   $this->db->join("project","project.id=unit_rental.projectid","left");
		   $this->db->join("add_unit","add_unit.uid=unit_rental.unitid","left");
		   $this->db->join("building_info","building_info.bldid=unit_rental.buildingid","left");
		   $this->db->join("tenant","tenant.tentant_id=unit_rental.tenantid","left");
		   $this->db->where(array("unit_rental.id"=>$rentalid));
		   $query=$this->db->get("unit_rental");
		   if($query->num_rows()>0){
		   return $query->row();
	   }
	   return false;
	}
	function delete_rental($rentalid){
		$query=$this->db->get_where("unit_rental",array("id"=>$rentalid));
		if($query->num_rows()>0){
			$rental=$query->row();
			if($rental->payment_status !=lang('pending')){
				return false;
			}else{
				 $this->db->where('id', $rentalid);
				 $this->db->delete('unit_rental');
				 if(!empty($rental->bill_details)){
					foreach(json_decode($rental->bill_details) as $billid){
                     $this->db->where("bill_id",$billid);
					 $this->db->update("add_bill",array("add_bill"=>0,"is_billed_id"=>0));
					}						
				 }
				return true; 
			}
		}
		return false;
	}
	function get_billByrentalid($rentalid){
		$query=$this->db->get_where("add_bill",array("is_billed_id"=>$rentalid));
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	function get_rentalbill($projectid,$buildingid,$tenantid,$unitid){
		$query=$this->db->get_where("unit_rental",array("projectid"=>$projectid,"buildingid"=>$buildingid,"unitid"=>$unitid,"tenantid"=>$tenantid,"payment_status"=>lang('pending')));
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	function getrentalbill_details($id){
		$query=$this->db->get_where("unit_rental",array("id"=>$id));
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	function  payment_save($save){
		$query=$this->db->get_where("unit_rental",array("id"=>$save['rentalbillid']));
		$unit_rental=$query->row();
		$rentalbillid=$unit_rental->id;
		$rentalbillrefno=$unit_rental->referncenumber;
		unset($unit_rental->id,$unit_rental->referncenumber);
		$this->db->insert("unit_rental_payment",$unit_rental);
		$paymentid = $this->db->insert_id();
		$referenceNumber="INV00".$paymentid;
		 $this->db->where("id",$paymentid);
		 $this->db->update("unit_rental_payment",array("paid_amount"=>$save['paid_amount'],"paid_date"=>$save['paid_date'],"note"=>$save['note'],
		 "paid_from"=>$save['paid_from'],"referncenumber"=>$referenceNumber,"rental_id"=>$rentalbillid,"rental_referenceNo"=>$rentalbillrefno));
		$this->updateBills($unit_rental,$rentalbillid);
		 return true;
	}
	
	function updateBills($unit_rental,$rentalbillid){
		$this->db->where("id",$rentalbillid);
		if($this->db->update("unit_rental",array("payment_status"=>"Paid"))){
			if(!empty($unit_rental->bill_details)){
				foreach(json_decode($unit_rental->bill_details) as $billid){
					$this->db->where("bill_id",$billid);
					$this->db->update("add_bill",array("Paid_Status"=>"Paid"));
				}
			}
			return true;
		}
		return false;
	}
	function get_payment($id){
		   $this->db->select("unit_rental_payment.*,unit_name,uid,project.Name project,building_info.name,tenant.full_name,tenant.handphone,tenant.email");
		   $this->db->join("project","project.id=unit_rental_payment.projectid","left");
		   $this->db->join("add_unit","add_unit.uid=unit_rental_payment.unitid","left");
		   $this->db->join("building_info","building_info.bldid=unit_rental_payment.buildingid","left");
		   $this->db->join("tenant","tenant.tentant_id=unit_rental_payment.tenantid","left");
		   $this->db->where(array("unit_rental_payment.id"=>$id));
		   $query=$this->db->get("unit_rental_payment");
		   if($query->num_rows()>0){
		   return $query->row();
	       }
	   return false;
	}
	function agreementDetails($id){
		$this->db->select("tenant_agreement.*,project.Name project,building_info.name building,add_unit.unit_name unit,floors.name floors,tenant.full_name as tenant");
		$this->db->join("project","project.id=tenant_agreement.project_id","left");
		$this->db->join("building_info","building_info.bldid=tenant_agreement.building_id","left");
		$this->db->join("add_unit","add_unit.uid=tenant_agreement.unitid","left");
		$this->db->join("floors","floors.id=add_unit.floor_no","left");
		$this->db->join("tenant","tenant.tentant_id=tenant_agreement.tentant_id","left");
		$this->db->where("tenant_agreement.agreement_id",$id);
		$query=$this->db->get("tenant_agreement");
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	function addPayment($payment,$id,$payment_id){
		if($payment_id){
			  $this ->db->where('id', $payment_id);
			  $this ->db->delete('lease_payments');
			  $this->db->where('agreement_id',$id);
		      $this->db->update('tenant_agreement',array('balanceamount'=>$payment['balance_amount']));
		      $this->db->insert('lease_payments',$payment);
		      return true;
		}else{
		      $this->db->where('agreement_id',$id);
		      $this->db->update('tenant_agreement',array('balanceamount'=>$payment['balance_amount']));
		      $this->db->insert('lease_payments',$payment);
		      return true;
		}
	}
	
	function paymentdetails($agreementid){
		$this->db->select("*");
		$this->db->where("agreementid",$agreementid);
		$query=$this->db->get("lease_payments");
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;		
	}
	 function paymentdelete($id){
	    $payment=$this->db->get_where('lease_payments',array('id'=>$id))->row();
	    $paid=($payment->paid_amount)? $payment->paid_amount :0;
 	    $balanceamount=($payment->balance_amount)? $payment->balance_amount :0;
        $totalBalance=($paid)+ ($balanceamount);
		$this->db->where('agreement_id',$payment->agreementid);
		$paymentupdate=$this->db->update('tenant_agreement',array('balanceamount'=>$totalBalance));
		if($paymentupdate){
			$this ->db->where('id', $id);
			  $this ->db->delete('lease_payments');
			return true;
		}else{
			
			return false;
		}
  }
  
  function getPayments($id){
	    $query=$this->db->get_where("lease_payments",array("id"=>$id));
	  	if($query->num_rows()>0){
			return $query->row();
		}
		return false;
  }
  function commissionDetails($id){
		$this->db->select("lease_commission.*,project.Name project,building_info.name building,add_unit.unit_name unit,floors.name floors,owner.full_name as owner");
	    $this->db->join("project","project.id=lease_commission.projectid","left");
	    $this->db->join("add_unit","add_unit.uid=lease_commission.unitid","left");
		$this->db->join("floors","floors.id=add_unit.floor_no","left");
		$this->db->join("building_info","building_info.bldid=lease_commission.buildingid","left");
		$this->db->join("owner","owner.ownid=lease_commission.owner_id","left");
		$this->db->where("lease_commission.id",$id);
		$query=$this->db->get("lease_commission");
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	function commission_paymentdetails($leasecommissionid){
		$this->db->select("*");
		$this->db->where("leasecommissionid",$leasecommissionid);
		$query=$this->db->get("leaseCommission_payments");
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;		
	}
	function addCommissionPayment($payment,$id,$payment_id){
		if($payment_id){
			  $this ->db->where('id', $payment_id);
			  $this ->db->delete('leasecommission_payments');
			  $this->db->where('id',$id);
		      $this->db->update('lease_commission',array('balance'=>$payment['balance_amount']));
		      $this->db->insert('leasecommission_payments',$payment);
		      return true;
		}else{
		      $this->db->where('id',$id);
		      $this->db->update('lease_commission',array('balance'=>$payment['balance_amount']));
		      $this->db->insert('leasecommission_payments',$payment);
		      return true;
		}
	}
	 function commissionpaymentdelete($id){
	    $payment=$this->db->get_where('leasecommission_payments',array('id'=>$id))->row();
	    $paid=($payment->paid_amount)? $payment->paid_amount :0;
 	    $balanceamount=($payment->balance_amount)? $payment->balance_amount :0;
        $totalBalance=($paid)+ ($balanceamount);
		$this->db->where('id',$payment->leasecommissionid);
		$paymentupdate=$this->db->update('lease_commission',array('balance'=>$totalBalance));
		if($paymentupdate){
			$this ->db->where('id', $id);
			  $this ->db->delete('leasecommission_payments');
			return true;
		}else{
			
			return false;
		}
  }
  function getcommissionPayments($id){
	    $query=$this->db->get_where("leasecommission_payments",array("id"=>$id));
	  	if($query->num_rows()>0){
			return $query->row();
		}
		return false;
  }
  
  
  
  
  function resale_commissionDetails($id){
		$this->db->select("resale_commission.*,project.Name project,building_info.name building,add_unit.unit_name unit,floors.name floors,owner.full_name as owner");
	    $this->db->join("project","project.id=resale_commission.projectid","left");
	    $this->db->join("add_unit","add_unit.uid=resale_commission.unitid","left");
		$this->db->join("floors","floors.id=add_unit.floor_no","left");
		$this->db->join("building_info","building_info.bldid=resale_commission.buildingid","left");
		$this->db->join("owner","owner.ownid=resale_commission.owner_id","left");
		$this->db->where("resale_commission.id",$id);
		$query=$this->db->get("resale_commission");
		if($query->num_rows()>0){
			return $query->row();
		}
		return false;
	}
	function resale_commission_paymentdetails($resalecommissionid){
		$this->db->select("*");
		$this->db->where("resalecommissionid",$resalecommissionid);
		$query=$this->db->get("resalecommission_payments");
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$data[]=$row;
			}
			return $data;
		}
		return false;		
	}
	function add_resale_CommissionPayment($payment,$id,$payment_id){
		if($payment_id){
			  $this ->db->where('id', $payment_id);
			  $this ->db->delete('resalecommission_payments');
			  $this->db->where('id',$id);
		      $this->db->update('resale_commission',array('balance'=>$payment['balance_amount']));
		      $this->db->insert('resalecommission_payments',$payment);
		      return true;
		}else{
		      $this->db->where('id',$id);
		      $this->db->update('resale_commission',array('balance'=>$payment['balance_amount']));
		      $this->db->insert('resalecommission_payments',$payment);
		      return true;
		}
	}
	 function resale_commissionpaymentdelete($id){
	    $payment=$this->db->get_where('resalecommission_payments',array('id'=>$id))->row();
	    $paid=($payment->paid_amount)? $payment->paid_amount :0;
 	    $balanceamount=($payment->balance_amount)? $payment->balance_amount :0;
        $totalBalance=($paid)+ ($balanceamount);
		$this->db->where('id',$payment->resalecommissionid);
		$paymentupdate=$this->db->update('resale_commission',array('balance'=>$totalBalance));
		if($paymentupdate){
			$this ->db->where('id', $id);
			  $this ->db->delete('resalecommission_payments');
			return true;
		}else{
			
			return false;
		}
  }
  function getresale_commissionPayments($id){
	    $query=$this->db->get_where("resalecommission_payments",array("id"=>$id));
	  	if($query->num_rows()>0){
			return $query->row();
		}
		return false;
  }
}