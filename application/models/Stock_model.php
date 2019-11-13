<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

	
    }
    function SaleStockIn($product_id,$qty,$stock_unique_id){
	/*
	 *edit bill
	 *return bill
	 */
	$store_id = $this->store_id;
	
	$query = 'update '.$this->db->dbprefix('pro_stock_master').'
			set stock_in = stock_in + '.$qty.' ,
			    stock_out = stock_out - '.$qty.'
			where unique_id="'.$stock_unique_id.'"';
	    $this->db->query($query);
	return $id;
    }
    function ProductStockIn($product_id,$qty,$batch_no,$cost_price=0,$supplier='',$invoice_no=0,$s_price=0,$landing_cost = 0){
	/*
	 * when store stock receiver
	 * and invoice 
	 */
	
        $store_id = $this->store_id;
	$id='';
	if($cost_price==''){$cost_price = 0;}
	if($batch_no==''){$batch_no = '';}
	if($batch_no=="No batch no"){$batch_no = '';}
	if($supplier==''){$supplier = $this->getDefaultSupplier();}
	if($invoice_no==''){$invoice_no = 0;}
	$this->db->where('batch',$batch_no);
	$this->db->where('cost_price',$cost_price);
	$this->db->where('invoice_id',$invoice_no);
	$this->db->where('vendor_id',$supplier);
	$this->db->where('product_id',$product_id);
	$this->db->where('store_id',$store_id);
	//echo $this->db->get_compiled_select();exit;
	$q = $this->db->get('pro_stock_master');
	if($q->num_rows()>0){
	    $id =  $q->row('id');
		//line move from bottom line
		$query = 'update '.$this->db->dbprefix('pro_stock_master').'
			set stock_in = stock_in + '.$qty.' 
			where id='.$id;//,stock_out = stock_out - '.$qty.'
			//file_put_contents('u.txt',$query,FILE_APPEND); 
	    $this->db->query($query);  
	}else{
	    $id = $this->insert_stock_master($product_id,$qty,$batch_no,$cost_price,$supplier,$invoice_no,$s_price,$landing_cost);
	    $this->insert_price_master($product_id,$batch_no,$cost_price,$supplier,$invoice_no,$s_price);
	}	
//line move to top cuz have duplicate qty in first stock transfer.    
	/*
	$query = 'update '.$this->db->dbprefix('pro_stock_master').'
			set stock_in = stock_in + '.$qty.' 
			where id='.$id;//,stock_out = stock_out - '.$qty.'
			//file_put_contents('u.txt',$query,FILE_APPEND); 
	    $this->db->query($query);  
	*/
    }
    function SaleStockOut($product_id,$qty,$stock_unique_id){
	$store_id = $this->store_id;
	//$id='';
	//if($batch_no==''){
	//    $this->db->limit(1);
	//    $this->db->where(array('store_id'=>$store_id,'product_id'=>$product_id));
	//    $this->db->where('(batch ="" or batch is null)');
	//    $q = $this->db->get('pro_stock_master');	   
	//    if($q->num_rows()>0){
	//	 $id =  $q->row('id');
	//    }
	//}else{
	//    $this->db->limit(1);
	//    $q = $this->db->get_where('pro_stock_master',array('store_id'=>$store_id,'product_id'=>$product_id,'batch'=>$batch_no));
	//    if($q->num_rows()>0){
	//	$id = $q->row('id');
	//    }
	//}
         
	$query = 'update '.$this->db->dbprefix('pro_stock_master').'
			set stock_in = stock_in - '.$qty.' ,
			    stock_out = stock_out + '.$qty.'
			where unique_id="'.$stock_unique_id.'"';
	    $this->db->query($query);
	return $id;
	
    }
    function TransferStockOut($product_id,$qty,$stockid){
	$store_id = $this->store_id;
	$id=$stockid;	
	$query = 'update '.$this->db->dbprefix('pro_stock_master').'
			set stock_in = stock_in - '.$qty.' ,
			    stock_out = stock_out + '.$qty.'
			where unique_id="'.$id.'"';
	    $this->db->query($query);
	return $id;
	
    }
    function PurchaseReturnStockOut($product_id,$qty,$stockid){
	$store_id = $this->store_id;
	$id=$stockid;	
	$query = 'update '.$this->db->dbprefix('pro_stock_master').'
			set stock_in = stock_in - '.$qty.' ,
			    stock_out = stock_out + '.$qty.'
			where unique_id="'.$id.'"';
	    $this->db->query($query);
	return $id;
	
    }
    function insert_stock_master($product_id,$stock,$batch,$cost_price,$supplier,$invoice_id=0,$s_price=0,$landing_cost=0){
	
	$stock_data['store_id'] = $this->store_id;
	$stock_data['product_id'] = $product_id;	    
	$stock_data['category_id'] = 0;
	$stock_data['subcategory_id'] = 0;	
	$stock_data['selling_price'] = $s_price;
	$stock_data['cost_price'] = $cost_price;    
	$stock_data['stock_in'] = $stock;
	$stock_data['stock_out'] = 0;
	$stock_data['batch'] = $batch;
	$stock_data['vendor_id'] = $supplier;
	$stock_data['invoice_id'] = $invoice_id;
	$cp = str_replace('.','_',$cost_price);
	$stock_data['unique_id'] = $this->store_id.$product_id.$batch.$cp.$supplier.$invoice_id;
	$stock_data['barcode'] = crc32(uniqid($this->store_id.$product_id));
	$this->db->insert('pro_stock_master',$stock_data);
	$insertID = $this->db->insert_id();
	$UniqueID = $this->site->generateUniqueTableID($insertID);
	$this->site->updateUniqueTableId($insertID,$UniqueID,'pro_stock_master');
	return $UniqueID;		
       //p($this->db->error());exit;
    }
    
    
    /************** price master ****************/
    function ProductPriceMaster_bk($product_id,$qty,$batch_no,$cost_price=0,$supplier,$invoice_no){
	/*
	 * when store stock receiver
	 * and invoice 
	 */
        $store_id = $this->store_id;
	$id='';
	if($cost_price==''){$cost_price = 0;}
	if($batch_no==''){$batch_no = '';}
	if($supplier==''){$supplier = $this->getDefaultSupplier();}
	if($invoice_no==''){$invoice_no = 0;}
	
	$this->db->where('batch_no',$batch_no);
	$this->db->where('cost_price',$cost_price);
	$this->db->where('invoice_id',$invoice_no);
	$this->db->where('vendor_id',$supplier);
	$this->db->where('store_id',$this->store_id);
	$q = $this->db->get('price_master');
	if($q->num_rows()>0){
	    $id =  $q->row('id');
	    $u_data['cost_price'] = $cost_price;
	    $u_data['vendor_id'] = $supplier;
	    $u_data['invoice_id'] = $invoice_no;
	    $u_data['batch_no'] = $batch_no;
	    $this->db->where('id',$id);
	    $this->db->update('price_master',$u_data);
	}else{
	    $id = $this->insert_price_master($product_id,$qty,$batch_no,$cost_price,$supplier,$invoice_no);
	}	    
	
	
    }
    function insert_price_master($product_id,$batch,$cost_price,$supplier,$invoice_id,$s_price){
	$p_data['store_id'] = $this->store_id;
	$p_data['product_id'] = $product_id;   
	$p_data['price'] = $s_price;
	$p_data['cost_price'] = $cost_price;  
	$p_data['batch_no'] = $batch;
	$p_data['vendor_id'] = $supplier;
	$p_data['invoice_id'] = $invoice_id;
	$cp = str_replace('.','_',$cost_price);
	$p_data['unique_id'] = $this->store_id.$product_id.$batch.$cp.$supplier.$invoice_id;
	$this->db->insert('price_master',$p_data);
	$insertID = $this->db->insert_id();
	$UniqueID = $this->site->generateUniqueTableID($insertID);
	$this->site->updateUniqueTableId($insertID,$UniqueID,'price_master');
	return $UniqueID;
    }
	 function price_master_update($storeid,$product_id,$batch,$cost_price,$supplier,$invoice_id,$s_price){
		 $p_data['store_id'] = $storeid;
	$p_data['product_id'] = $product_id;   
	$p_data['price'] = $s_price;
	$p_data['cost_price'] = $cost_price;  
	$p_data['batch_no'] = $batch;
	$p_data['vendor_id'] = $supplier;
	$p_data['invoice_id'] = $invoice_id;
	$cp = str_replace('.','_',$cost_price);
	$p_data['unique_id']= $storeid.$product_id.$batch.$cp.$supplier.$invoice_id;
    $query=$this->db->get_where("price_master",array("unique_id"=>$p_data['unique_id']));
		 if($query->num_rows()>0){
			 return true;
		 }else{
			 
	$this->db->insert('price_master',$p_data);
	$insertID = $this->db->insert_id();
	$UniqueID = $this->site->generateUniqueTableID($insertID);
	$this->site->updateUniqueTableId($insertID,$UniqueID,'price_master');
	return $UniqueID;
		 }
    }
    //UPDATE `sramrms_price_master` SET unique_id = CONCAT(store_id,product_id,batch_no,'0_00',vendor_id,invoice_id)
    //UPDATE `sramrms_pro_stock_master` SET batch = '';
    //UPDATE `sramrms_pro_stock_master` SET unique_id = CONCAT(store_id,product_id,REPLACE(batch,' ','_'),REPLACE(cost_price,'.','_'),vendor_id,invoice_id)
    
}
