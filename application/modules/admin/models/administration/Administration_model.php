<?php
class Administration_model extends CI_Model
{
    public $CI;
    public function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
        $this->CI->load->database();
        $this->CI->load->helper('url');
    }
   function get_new_request(){
	    $requests=$this->db->get_where('request',array('Soft_delete'=>0,'Is_read'=>0))->result();
		
	    if($requests){
			foreach($requests as $request){
			//	print_r($request);
	       switch ($request->owner_type){
			   case 1:
			   $this->db->select('request.*,owner.full_name as ownername');
	           $this->db->join('owner','owner.ownid=request.owner_id','left');
	           $this->db->where('request.Is_read',0);
			   $this->db->where('request.owner_type',1);
			   $this->db->where('request.request_id',$request->request_id);
			 
			   break;
			   case 2:
			    $this->db->select('request.*,resident.full_name as ownername');
	           $this->db->join('resident','resident.residentid=request.owner_id','left');
	           $this->db->where('request.Is_read',0);
			    $this->db->where('request.owner_type',2);
				$this->db->where('request.request_id',$request->request_id);
				
			   break;
			   case 3:
			    $this->db->select('request.*,external_staff.full_name as ownername');
	            $this->db->join('external_staff','external_staff.external_staff_id=request.owner_id','left');
	            $this->db->where('request.Is_read',0);
				$this->db->where('request.owner_type',3);
				$this->db->where('request.request_id',$request->request_id);
			
			    break;
		   }
		   $this->db->group_by('request_id'); 
	       $this->db->order_by('request_id', 'DESC');
	       $this->db->limit('10');
	       $query=$this->db->get('request');
		 //  echo $this->db->last_query();
		   if($query->num_rows()>0){
		   foreach($query->result() as $row){
		  $data[]=$row;
	   }
	   }
     }
		return $data;
			
		}
	return false;
   }
 function get_open_request(){
	   $requests=$this->db->get_where('request',array('Soft_delete'=>0,'Is_read'=>1))->result();
	    if($requests){
			foreach($requests as $request){
			//	print_r($request);
	       switch ($request->owner_type){
			   case 1:
			   $this->db->select('request.*,owner.full_name as ownername');
	           $this->db->join('owner','owner.ownid=request.owner_id','left');
	           $this->db->where('request.Is_read',1);
			   $this->db->where('request.owner_type',1);
			   $this->db->where('request.request_id',$request->request_id);
			 
			   break;
			   case 2:
			    $this->db->select('request.*,resident.full_name as ownername');
	           $this->db->join('resident','resident.residentid=request.owner_id','left');
	           $this->db->where('request.Is_read',1);
			    $this->db->where('request.owner_type',2);
				$this->db->where('request.request_id',$request->request_id);
				
			   break;
			   case 3:
			    $this->db->select('request.*,external_staff.full_name as ownername');
	            $this->db->join('external_staff','external_staff.external_staff_id=request.owner_id','left');
	            $this->db->where('request.Is_read',1);
				$this->db->where('request.owner_type',3);
				$this->db->where('request.request_id',$request->request_id);
			
			    break;
		   }
		   $this->db->group_by('request_id'); 
	       $this->db->order_by('request_id', 'DESC');
	       $this->db->limit('10');
	       $query=$this->db->get('request');
		 //  echo $this->db->last_query();
		   if($query->num_rows()>0){
		   foreach($query->result() as $row){
		  $data[]=$row;
	   }
	   }
     }
		return $data =!empty($data)? $data:$data=array();
		}
	return false;
   }
   function get_all_request(){
	   $this->db->select('request.*,owner.full_name as ownername');
	   $this->db->join('owner','owner.ownid=request.owner_id','left');
	   $this->db->group_by('request_id'); 
	   $this->db->order_by('request_id', 'DESC');
	   $query=$this->db->get('request');
	   if($query->num_rows()>0){
		   foreach($query->result() as $row){
		   $data[]=$row;
	   }
	   return $data;
	   }
	   return false;
   }
   function get(){
	   $this->db->select('request.*,owner.full_name as ownername');
	   $this->db->join('owner','owner.ownid=request.owner_id','left');
	   $this->db->order_by('request_id', 'DESC');
	   $query=$this->db->get('request');
	   if($query->num_rows()>0){
		   foreach($query->result() as $row){
		   $data[]=$row;
	   }
	   return $data;
	   }
	   return false;
   }
   function getProductNames($term){
	    $this->db->select('inv_products.*,ism.stock_in,sum(ism.stock_in) instock');
		$this->db->from('inv_products');
		$this->db->join('inv_pro_stock_master ism', 'ism.product_id=inv_products.id ');
		$this->db->where("(inv_products.name LIKE '" . $term . "%' OR inv_products.code LIKE '" . $term . "%' OR inv_products.barcode LIKE '" . $term . "%' )");
		$this->db->where('ism.stock_in>',0);
		$this->db->group_by('ism.product_id');
		$this->db->limit(5);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach($query->result()  as $row){
				$data[]=$row;
			}
			return $data;
		}
	   return false;
   }
    function getProductitem($productid){
	    $this->db->select('inv_products.*,ism.stock_in');
		$this->db->from('inv_products');
		$this->db->join('inv_pro_stock_master ism', 'ism.product_id=inv_products.id ');
		$this->db->where('inv_products.id',$productid);
		$query = $this->db->get();
		return $query->row();
   }
   function get_settings(){
	   return $this->db->get_where('settings',array('soft_delete'=>0))->row();
   }
   function get_services_person(){
	    $this->db->select('*');
        $this->db->where(array('soft_delete'=>0,'is_service_person'=>1));
		$query = $this->db->get('employee');
		if ($query->num_rows() > 0) {
			foreach($query->result()  as $row){
				$data[]=$row;
			}
			return $data;
		}
	   return false;
   }
   function getRequestByid($id){
	   return $this->db->get_where('request',array('request_id'=>$id))->row();
   }
   function getRequestTypeAll(){
		$this->db->select('*');
		$this->db->where('soft_delete',0);
		$query=$this->db->get('request_type');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
  function get_requestType_Category($id){
		$this->db->select('*');
		$this->db->where('request_typeid',$id);
		$query=$this->db->get('request_category');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function get_requestType_SubCategory($id){
		$this->db->select('*');
		$this->db->where('category_id',$id);
		$query=$this->db->get('request_subcategory');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function requestStatuschange($id){
		$this->db->where('request_id',$id);
		$this->db->update('request',array('Is_read'=>1));
		return true;
	}
	function requestReject($id){
		$this->db->where('request_id',$id);
		$this->db->delete('request');
		return true;
	}
	function getProject($projectid){
		return $this->db->get_where('project',array('id'=>$projectid))->row();
		
	}
	function getRequestby($ownertype,$ownerid){
		
		switch ($ownertype){
			case 1:
			$this->db->select("full_name as Name,permanent_address");
			$this->db->where('ownid',$ownerid);
			$query=$this->db->get('owner');
			break;
			case 2:
			 $this->db->select("full_name as Name,permanent_address");
			 $this->db->where('residentid',$ownerid);
			 $query=$this->db->get('resident');
			break;
			case 3:
			$this->db->select("full_name as Name,permanent_address");
			 $this->db->where('external_staff_id',$ownerid);
			 $query=$this->db->get('external_staff');
			break ;
		}
		    if($query->num_rows()>0){
				return $query->row();
			}
			return false;
	}
	
	function requestSave($save, $service_payments,$service_material){
		if(!empty($save['request_id'])){
			$this->db->where('request_id',$save['request_id']);
			$this->db->update('request',$save);
			 if (!empty($save['request_id'])){
			   $this->db->where('request_id',$save['request_id']);
               $this->db-> delete('request_services_payment_details');
				 foreach ($service_payments as  $payments) {
        		 $payments['request_id'] = $save['request_id']; 
        	     $this->db->insert('request_services_payment_details',$payments);
        	  }
			  $this->db->where('request_id',$save['request_id']);
              $this->db-> delete('request_services_material');
			  foreach ($service_material as  $material) {
        		 $material['request_id'] = $save['request_id']; 
        	     $this->db->insert('request_services_material',$material);
				 $stock=$this->db->get_where('inv_pro_stock_master',array('product_id'=>$material['product_id']))->row();
				 $data=array('stock_in' =>$stock->stock_in-$material['qty']);
				 $this->db->where('product_id',$material['product_id']);
				 $this->db->update('inv_pro_stock_master',$data);
        	 }
			 }
			 return true;
			
		}else{
			return false;
		}
	}
	function getMaterial($request_id){
		$this->db->select('*');
		$this->db->join('inv_products','inv_products.id=request_services_material.product_id','left');
		$this->db->where('request_id',$request_id);
		$query=$this->db->get('request_services_material');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
		
	}
	
	function getpayment($request_id){
		$this->db->select('*');
		$this->db->where('request_id',$request_id);
		$query=$this->db->get('request_services_payment_details');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}
	function stockCheck($qty,$productid){
		$this->db->select("stock_in");
		$this->db->where("stock_in >=",$qty);
		$this->db->where('product_id',$productid);
		$query=$this->db->get('inv_pro_stock_master');
	   if($query->num_rows()>0){
		   return $query->row();
	   }
		return false;
	}
	 function get_Project()
	{
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
	function   requestQuickSave($save){
		$this->db->insert('request',$save);
		return  $this->db->insert_id();
	}
	function getFloorByid($projectid){
			return $this->db->get_where('floors',array('Soft_delete'=>0,'projectid'=>$projectid))->result();
		}
		function getHouseByid($projectid,$floorid){
			return $this->db->get_where('add_unit',array('Soft_delete'=>0,'Project_id'=>$projectid,'floor_no'=>$floorid))->result();
		}
	function getOwnerByid($ownertype){
		
		if($ownertype  ==1){
		
			$this->db->select("full_name as Name,ownid as id");
			$this->db->where('Soft_deleted',1);
			$query=$this->db->get('owner');
			return $query->result();
		}else{
		    $this->db->select("full_name as Name,residentid as id");
			$this->db->where('Soft_deleted',1);
			$query=$this->db->get('resident');
			return $query->result();
		}
		return  false;
	}
		function getRequestLogs($request_id){
		$this->db->select('*');
		$this->db->where('request_id',$request_id);
		$query=$this->db->get('request_logs');
	    if($query->num_rows()>0){
			foreach($query->result() as $row){
			$data[]=$row;
		}
		return $data;
		}
		return false;
	}	
}
