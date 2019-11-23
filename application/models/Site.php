<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

 public function get_setting() {
        $q = $this->db->get('settings');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
	public function getUserGroup($user_id = false) {
        if (!$user_id) {
            $user_id = $this->session->userdata('user_id');
        }
        $group_id = $this->getUserGroupID($user_id);
        $q = $this->db->get_where('groups', array('id' => $group_id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getUserGroupID($user_id = false) {
        $user = $this->getUser($user_id);
        return $user->group_id;
    }
   
   
    public function getUser($id = NULL) {
        if (!$id) {
            $id = $this->session->userdata('user_id');
        }
        $q = $this->db->get_where('users', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
	  public function checkPermissions() {
        $q = $this->db->get_where('permissions', array('group_id' => $this->session->userdata('group_id')), 1);
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
        return FALSE;
    }
	 public function getAllWarehouses() {
        $q = $this->db->get('inv_warehouses');
        if ($q->num_rows() > 0) {
            return $q->result_array();
        }
        return FALSE;
    }
	  public function getAllCategories() {
        $this->db->where('parent_id', NULL)->or_where('parent_id', 0)->order_by('name');
        $q = $this->db->get("inv_categories");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	
    public function getAllTaxRates() {
        $q = $this->db->get('inv_tax_rates');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	 public function getAllBrands() {
        $q = $this->db->get("inv_brands");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
 public function getAllBaseUnits() {
        $q = $this->db->get_where("inv_units", array('base_unit' => NULL));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	 function generateUniqueTableID($db_insertid,$store_id=false){
	   $storeid = ($store_id)?$store_id:$this->store_id;
	   return $storeid.$db_insertid;
    }
	
	  public function syncProductQty($product_id, $warehouse_id) {
        $balance_qty = $this->getBalanceQuantity($product_id);
        $wh_balance_qty = $this->getBalanceQuantity($product_id, $warehouse_id);
        if ($this->db->update('products', array('quantity' => $balance_qty), array('id' => $product_id))) {
            if ($this->getWarehouseProducts($product_id, $warehouse_id)) {
                $this->db->update('warehouses_products', array('quantity' => $wh_balance_qty), array('product_id' => $product_id, 'warehouse_id' => $warehouse_id));
            } else {
                if( ! $wh_balance_qty) { $wh_balance_qty = 0; }
                $product = $this->site->getProductByID($product_id);
                $this->db->insert('warehouses_products', array('quantity' => $wh_balance_qty, 'product_id' => $product_id, 'warehouse_id' => $warehouse_id, 'avg_cost' => $product->cost));
            }
            return TRUE;
        }
        return FALSE;
    }
	   public function syncVariantQty($variant_id, $warehouse_id, $product_id = NULL) {
        $balance_qty = $this->getBalanceVariantQuantity($variant_id);
        $wh_balance_qty = $this->getBalanceVariantQuantity($variant_id, $warehouse_id);
        if ($this->db->update('product_variants', array('quantity' => $balance_qty), array('id' => $variant_id))) {
            if ($this->getWarehouseProductsVariants($variant_id, $warehouse_id)) {
                $this->db->update('warehouses_products_variants', array('quantity' => $wh_balance_qty), array('option_id' => $variant_id, 'warehouse_id' => $warehouse_id));
            } else {
                if($wh_balance_qty) {
                    $this->db->insert('warehouses_products_variants', array('quantity' => $wh_balance_qty, 'option_id' => $variant_id, 'warehouse_id' => $warehouse_id, 'product_id' => $product_id));
                }
            }
            return TRUE;
        }
        return FALSE;
    }
	 public function getUnitsByBUID($base_unit) {
        $this->db->where('id', $base_unit)->or_where('base_unit', $base_unit)
        ->group_by('id')->order_by('id asc');
        $q = $this->db->get("inv_units");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	 public function getTaxRateByID($id) {
        $q = $this->db->get_where('inv_tax_rates', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
	public function get_defaultCurrencyID() {
        $q = $this->db->get_where('inv_currencies',array('code'=>$this->Settings->default_currency));
        if ($q->num_rows() > 0) {
            return $q->row('id');
        }
        return FALSE;
    }
	 function updateUniqueTableId($db_insertid,$unique_ID,$table_name){
	$this->db->set('id',$unique_ID);
	$this->db->where('s_no',$db_insertid);
	$this->db->update($table_name);
    }
	 public function getProductByID($id) {
        $q = $this->db->get_where('inv_products', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
	    public function getUnitByID($id) {
        $q = $this->db->get_where("inv_units", array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
	  public function getBrandByID($id) {
        $q = $this->db->get_where('inv_brands', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
	  public function getCategoryByID($id) {
        $q = $this->db->get_where('inv_categories', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
    function get_project(){
		 $this->db->select("*");
		 $this->db->where("soft_delete",0);
		 $q=$this->db->get("project");
		 if($q->num_rows()>0){
			 foreach($q->result() as $row){
				 $data[]=$row;
			 }
			 return $data;
		 }
		 return false;
	 }
	 function get_building($projectid){
		 $this->db->select("*");
		 $this->db->where("soft_delete",0);
		 $this->db->where("project_id",$projectid);
		 $q=$this->db->get("building_info");
		 if($q->num_rows()>0){
			 foreach($q->result() as $row){
				 $data[]=$row;
			 }
			 return $data;
		 }
		 return false;
	 }
	 function get_floor($projectid,$buildingid){      
		 $this->db->select("*");
		 if(!empty($projectid)){
		 $this->db->where("projectid",$projectid);
		 }
		 $this->db->where("building_id",$buildingid);
		 $q=$this->db->get("floors");
		 if($q->num_rows()>0){
			 foreach($q->result() as $row){
				 $data[]=$row;
			 }
			 return $data;
		 }
		 return false;
	 }
	  function get_unit($projectid,$buildingid,$floorid){      
		 $this->db->select("*");
	 if(!empty($projectid)){
		 $this->db->where("Project_id",$projectid);
	 }
	  if(!empty($buildingid)){
		 $this->db->where("building_id",$buildingid);
	  }
		 $this->db->where("floor_no",$floorid);
		  $this->db->where("Booked_status",0);
		 $q=$this->db->get("add_unit");
		 if($q->num_rows()>0){
			 foreach($q->result() as $row){
				 $data[]=$row;
			 }
			 return $data;
		 }
		 return false;
	 }
	 
	 function  checkFeedback($pos_enquiryid){
		 $this->db->select("*");
		 $this->db->where("id",$pos_enquiryid);
         $this->db->where("feedback",0);		 
	     $q=$this->db->get("crm_pos_enquiry");
		 if($q->num_rows()>0){
			 return 1;
		 }else{
			 return 0;
		 }
		 
	 }
	  function  feedback_save($save){
		  if($save['pos_enquiry_id']){
			  $this->db->insert("feedback_form",$save);
			  return true;
		  }
		  return false;
	  }
	  function get_enquiryId($pos_enquiryid){
		  $this->db->select("enquiry_id");
		  $this->db->where("id",$pos_enquiryid);
		  $q=$this->db->get("crm_pos_enquiry");
		  if($q->num_rows()>0){
			  return $q->row('enquiry_id');
		  }
		  return false;
	  }
}
