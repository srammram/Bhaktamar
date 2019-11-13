<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProducts()
    {
        $q = $this->db->get_where('products',array('Active'=>0));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getCategoryProducts($category_id)
    {
        $q = $this->db->get_where('products', array('category_id' => $category_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getSubCategoryProducts($subcategory_id)
    {
        $q = $this->db->get_where('products', array('subcategory_id' => $subcategory_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getProductOptions($pid)
    {
        $q = $this->db->get_where('inv_product_variants', array('product_id' => $pid));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getProductOptionsWithWH($pid)
    {
        $this->db->select('inv_product_variants.*, inv_warehouses.name as wh_name,inv_warehouses.id as warehouse_id, inv_warehouses_products_variants.quantity as wh_qty')
            ->join('inv_warehouses_products_variants', 'inv_warehouses_products_variants.option_id=inv_product_variants.id', 'left')
            ->join('inv_warehouses', 'inv_warehouses.id=inv_warehouses_products_variants.warehouse_id', 'left')
            ->group_by(array('inv_product_variants.id', 'inv_warehouses_products_variants.warehouse_id'))
            ->order_by('inv_product_variants.id');
        $q = $this->db->get_where('inv_product_variants', array('inv_product_variants.product_id' => $pid, 'inv_warehouses_products_variants.quantity !=' => NULL));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getProductComboItems($pid)
    {
        $this->db->select('inv_products.id as id, inv_products.code as code, inv_combo_items.quantity as qty, inv_products.name as name, inv_combo_items.unit_price as price')->join('inv_products', 'inv_products.code=inv_combo_items.item_code', 'left')->group_by('inv_combo_items.id');
        $q = $this->db->get_where('inv_combo_items', array('product_id' => $pid));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
        return FALSE;
    }

    public function getProductByID($id)
    {
        $q = $this->db->get_where('inv_products', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
	public function getAttribute()
    {
		
		 $this->db->select('*');
         $this->db->from('inv_attribute');
         $this->db->where('soft_delete', 0);
         $query = $this->db->get();
		
		
     $data = array();
             if($query !== FALSE && $query->num_rows() > 0){
    foreach ($query->result_array() as $row) {
        $data[] = $row;
    }
      return $data;
    }
	}
    public function getProductWithCategory($id)
    {
        $this->db->select($this->db->dbprefix('products') . '.*, ' . $this->db->dbprefix('categories') . '.name as category')
        ->join('categories', 'categories.id=products.category_id', 'left');
        $q = $this->db->get_where('products', array('products.id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function has_purchase($product_id, $warehouse_id = NULL)
    {
        if($warehouse_id) { $this->db->where('warehouse_id', $warehouse_id); }
        $q = $this->db->get_where('purchase_items', array('product_id' => $product_id), 1);
        if ($q->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function getProductDetails($id)
    {
        $this->db->select($this->db->dbprefix('products') . '.code, ' . $this->db->dbprefix('products') . '.name, ' . $this->db->dbprefix('categories') . '.code as category_code, cost, price, quantity, alert_quantity')
            ->join('categories', 'categories.id=products.category_id', 'left');
        $q = $this->db->get_where('products', array('products.id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getProductDetail($id)
    {
        $this->db->select($this->db->dbprefix('products') . '.*, ' . $this->db->dbprefix('tax_rates') . '.name as tax_rate_name, '.$this->db->dbprefix('tax_rates') . '.code as tax_rate_code, c.code as category_code, sc.code as subcategory_code', FALSE)
            ->join('tax_rates', 'tax_rates.id=products.tax_rate', 'left')
            ->join('categories c', 'c.id=products.category_id', 'left')
            ->join('categories sc', 'sc.id=products.subcategory_id', 'left');
        $q = $this->db->get_where('products', array('products.id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getSubCategories($parent_id) {
        $this->db->select('id as id, name as text')
        ->where('parent_id', $parent_id)->order_by('name');
        $q = $this->db->get("inv_categories");
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getProductByCategoryID($id)
    {

        $q = $this->db->get_where('products', array('category_id' => $id), 1);
        if ($q->num_rows() > 0) {
            return true;
        }
        return FALSE;
    }

    public function getAllWarehousesWithPQ($product_id)
    {
        $this->db->select('inv_warehouses.*,  inv_warehouses_products.quantity, inv_warehouses_products.rack')
            ->join('inv_warehouses_products', 'inv_warehouses_products.warehouse_id=inv_warehouses.id', 'left')
            ->where('inv_warehouses_products.product_id', $product_id)
            ->group_by('inv_warehouses.id');
        $q = $this->db->get('inv_warehouses');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getProductPhotos($id)
    {
        $q = $this->db->get_where("inv_product_photos", array('product_id' => $id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getProductByCode($code)
    {
        $q = $this->db->get_where('inv_products', array('code' => $code), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function addProduct($data, $items, $warehouse_qty, $product_attributes, $photos,$open_stock)
    {
	 
         if ($this->db->insert('inv_products', $data)) {
            $product_id = $this->db->insert_id();
	    //$all_stores = $this->site->getAllWarehouses();
	    $assigned_stores = $this->input->post('stores');
		
	    foreach($assigned_stores as $k => $storeid){
		$cost_price = ($data['cost'])?$data['cost']:0;
		$batch= '';
		$supplier=0;
		$invoice_id=0;
		$cp = str_replace('.','_',$cost_price);
		$p_data['unique_id'] = $storeid.$product_id.$batch.$cp.$supplier.$invoice_id;
		
		$p_data['cost_price'] = ($data['cost'])?$data['cost']:0; 
		$p_data['store_id'] = $storeid;
		$p_data['product_id'] = $product_id;
		$p_data['price'] = $data['price'];
		$p_data['created_on'] = date('Y-m-d H:i:s');
		$p_data['currency_id'] = $this->site->get_defaultCurrencyID();
		
		$this->insert_price_master($p_data);
		$s_data['unique_id'] = $storeid.$product_id.$batch.$cp.$supplier.$invoice_id;
		$s_data['store_id'] = $storeid;
		$s_data['product_id'] = $product_id;	    
		$s_data['category_id'] = ($data['category_id'])?$data['category_id']:0;
		$s_data['subcategory_id'] = ($data['subcategory_id'])?$data['subcategory_id']:0;
		//$s_data['brand'] = $row['brand']; // $row['brand']
		$s_data['selling_price'] = ($data['price'])?$data['price']:0;
		$s_data['cost_price'] = ($data['cost'])?$data['cost']:0;    
		$s_data['stock_in'] = $open_stock;
		$s_data['stock_out'] = 0;
		
		$this->insert_stock_master($s_data);
		
		$a_data['store_id'] = $storeid;
		$a_data['product_id'] = $product_id;
		$a_data['min_qty'] = $data['alert_quantity'];
		$this->insert_product_alert_qty($a_data);
		
		
		//if ($data['type'] != 'standard') {
                
                $this->db->insert('inv_warehouses_products', array('product_id' => $product_id, 'warehouse_id' => $storeid, 'quantity' => 0));
				
		//}
		
	    }
            if ($items) {
                foreach ($items as $item) {
                    $item['product_id'] = $product_id;
                    $this->db->insert('inv_combo_items', $item);
                }
            }
            //$warehouses = $this->site->getAllWarehouses();
	   
           
            $tax_rate = $this->site->getTaxRateByID($data['tax_rate']);
            if ($warehouse_qty && !empty($warehouse_qty)) {
                foreach ($warehouse_qty as $wh_qty) {
                    if (isset($wh_qty['quantity']) && ! empty($wh_qty['quantity'])) {
                        $this->db->insert('inv_warehouses_products', array('product_id' => $product_id, 'warehouse_id' => $wh_qty['warehouse_id'], 'quantity' => $wh_qty['quantity'], 'rack' => $wh_qty['rack'], 'avg_cost' => $data['cost']));

                   if (!$product_attributes)
							{
                            $tax_rate_id = $tax_rate ? $tax_rate->id : NULL;
                            $tax = $tax_rate ? (($tax_rate->type == 1) ? $tax_rate->rate . "%" : $tax_rate->rate) : NULL;
                            $unit_cost = $data['cost'];
                            if ($tax_rate) {
                                if ($tax_rate->type == 1 && $tax_rate->rate != 0) {
                                    if ($data['tax_method'] == '0') {
                                        $pr_tax_val = ($data['cost'] * $tax_rate->rate) / (100 + $tax_rate->rate);
                                        $net_item_cost = $data['cost'] - $pr_tax_val;
                                        $item_tax = $pr_tax_val * $wh_qty['quantity'];
                                    } else {
                                        $net_item_cost = $data['cost'];
                                        $pr_tax_val = ($data['cost'] * $tax_rate->rate) / 100;
                                        $unit_cost = $data['cost'] + $pr_tax_val;
                                        $item_tax = $pr_tax_val * $wh_qty['quantity'];
                                    }
                                } else {
                                    $net_item_cost = $data['cost'];
                                    $item_tax = $tax_rate->rate;
                                }
                            } else {
                                $net_item_cost = $data['cost'];
                                $item_tax = 0;
                            }

                            $subtotal = (($net_item_cost * $wh_qty['quantity']) + $item_tax);

                            $item = array(
                                'product_id' => $product_id,
                                'product_code' => $data['code'],
                                'product_name' => $data['name'],
                                'net_unit_cost' => $net_item_cost,
                                'unit_cost' => $unit_cost,
                                'real_unit_cost' => $unit_cost,
                                'quantity' => $wh_qty['quantity'],
                                'quantity_balance' => $wh_qty['quantity'],
                                'quantity_received' => $wh_qty['quantity'],
                                'item_tax' => $item_tax,
                                'tax_rate_id' => $tax_rate_id,
                                'tax' => $tax,
                                'subtotal' => $subtotal,
                                'warehouse_id' => $wh_qty['warehouse_id'],
                                'date' => date('Y-m-d'),
                                'status' => 'received',
                            );
                            $this->db->insert('purchase_items', $item);
                            $this->site->syncProductQty($product_id, $wh_qty['warehouse_id']);
                        }
                    }
                }
            }

            if ($product_attributes) {
                foreach ($product_attributes as $pr_attr) {
                    $pr_attr_details = $this->getPrductVariantByPIDandName($product_id, $pr_attr['name']);

                    $pr_attr['product_id'] = $product_id;
                    $variant_warehouse_id = $pr_attr['warehouse_id'];
                    unset($pr_attr['warehouse_id']);
                    if ($pr_attr_details) {
                        $option_id = $pr_attr_details->id;
                    } else {
                        $this->db->insert('inv_product_variants', $pr_attr);
                        $option_id = $this->db->insert_id();
                    }
                    if ($pr_attr['quantity'] != 0) {
                        $this->db->insert('inv_warehouses_products_variants', array('option_id' => $option_id, 'product_id' => $product_id, 'warehouse_id' => $variant_warehouse_id, 'quantity' => $pr_attr['quantity']));
                        $tax_rate_id = $tax_rate ? $tax_rate->id : NULL;
                        $tax = $tax_rate ? (($tax_rate->type == 1) ? $tax_rate->rate . "%" : $tax_rate->rate) : NULL;
                        $unit_cost = $data['cost'];
                        if ($tax_rate) {
                            if ($tax_rate->type == 1 && $tax_rate->rate != 0) {
                                if ($data['tax_method'] == '0') {
                                    $pr_tax_val = ($data['cost'] * $tax_rate->rate) / (100 + $tax_rate->rate);
                                    $net_item_cost = $data['cost'] - $pr_tax_val;
                                    $item_tax = $pr_tax_val * $pr_attr['quantity'];
                                } else {
                                    $net_item_cost = $data['cost'];
                                    $pr_tax_val = ($data['cost'] * $tax_rate->rate) / 100;
                                    $unit_cost = $data['cost'] + $pr_tax_val;
                                    $item_tax = $pr_tax_val * $pr_attr['quantity'];
                                }
                            } else {
                                $net_item_cost = $data['cost'];
                                $item_tax = $tax_rate->rate;
                            }
                        } else {
                            $net_item_cost = $data['cost'];
                            $item_tax = 0;
                        }

                        $subtotal = (($net_item_cost * $pr_attr['quantity']) + $item_tax);
                        $item = array(
                            'product_id' => $product_id,
                            'product_code' => $data['code'],
                            'product_name' => $data['name'],
                            'net_unit_cost' => $net_item_cost,
                            'unit_cost' => $unit_cost,
                            'quantity' => $pr_attr['quantity'],
                            'option_id' => $option_id,
                            'quantity_balance' => $pr_attr['quantity'],
                            'quantity_received' => $pr_attr['quantity'],
                            'item_tax' => $item_tax,
                            'tax_rate_id' => $tax_rate_id,
                            'tax' => $tax,
                            'subtotal' => $subtotal,
                            'warehouse_id' => $variant_warehouse_id,
                            'date' => date('Y-m-d'),
                            'status' => 'received',
                        );
                        $item['option_id'] = !empty($item['option_id']) && is_numeric($item['option_id']) ? $item['option_id'] : NULL;
                        $this->db->insert('purchase_items', $item);
                    }
                    foreach ($warehouses as $warehouse) {
                        if (!$this->getWarehouseProductVariant($warehouse->id, $product_id, $option_id)) {
                            $this->db->insert('inv_warehouses_products_variants', array('option_id' => $option_id, 'product_id' => $product_id, 'warehouse_id' => $warehouse->id, 'quantity' => 0));
                        }
                    }
                   $this->site->syncVariantQty($option_id, $variant_warehouse_id);
                }
            }

            if ($photos) {
                foreach ($photos as $photo) {
                    $this->db->insert('inv_product_photos', array('product_id' => $product_id, 'photo' => $photo));
                }
            }

            return true;
        }
        return false;

    }

    public function getPrductVariantByPIDandName($product_id, $name)
    {
        $q = $this->db->get_where('inv_product_variants', array('product_id' => $product_id, 'name' => $name), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function addAjaxProduct($data)
    {
        if ($this->db->insert('products', $data)) {
            $product_id = $this->db->insert_id();
            return $this->getProductByID($product_id);
        }
        return false;
    }

    public function add_products($products = array(),$warehouses)
    {
        if (!empty($products)) {
            foreach ($products as $product) {
                $variants = explode('|', $product['variants']);
                unset($product['variants']);
		$openStock = $product['stock'];unset($product['stock']);
                if ($this->db->insert('products', $product)) {
					$product_id = $this->db->insert_id();
					
					
		    $all_stores = $this->site->getAllWarehouses();
		    foreach($all_stores as $k => $store){
			
			$cost_price = ($product['cost'])?$product['cost']:0;
			$batch= '';
			$supplier=0;
			$invoice_id=0;
			$cp = str_replace('.','_',$cost_price);
			$p_data['unique_id'] = $store->id.$product_id.$batch.$cp.$supplier.$invoice_id;
			
			$p_data['cost_price'] = ($data['cost'])?$data['cost']:0;
		
		
			$p_data['store_id'] = $store->id;
			$p_data['product_id'] = $product_id;
			$p_data['price'] = $product['price'];
			$p_data['created_on'] = date('Y-m-d H:i:s');
			$p_data['currency_id'] = $this->site->get_defaultCurrencyID();
			
			$this->insert_inv_price_master($p_data);
			
			$s_data['unique_id'] = $store->id.$product_id.$batch.$cp.$supplier.$invoice_id;
			$s_data['store_id'] = $store->id;
			$s_data['product_id'] = $product_id;	    
			$s_data['category_id'] = ($product['category_id'])?$product['category_id']:0;
			$s_data['subcategory_id'] = ($product['subcategory_id'])?$product['subcategory_id']:0;
			//$s_data['brand'] = $row['brand']; // $row['brand']
			$s_data['selling_price'] = ($product['price'])?$product['price']:0;
			$s_data['cost_price'] = ($product['cost'])?$product['cost']:0;   	    
			$s_data['stock_in'] = ($openStock!='')?$openStock:0;
			$s_data['stock_out'] = 0;
			
			$this->insert_stock_master($s_data);
			$a_data['store_id'] = $store->id;
			$a_data['product_id'] = $product_id;
			$a_data['min_qty'] = $product['alert_quantity'];
			$this->insert_product_alert_qty($a_data);
		    }
					
              foreach ($warehouses as $warehouse) {
                    $this->db->insert('warehouses_products', array('product_id' => $product_id, 'warehouse_id' => $warehouse->id, 'quantity' => $product['quantity']));
				//	echo 'test';die;
                            $item = array(
                                'product_id' => $product_id,
                                'product_code' => $product['code'],
                                'product_name' => $product['name'],
                                'net_unit_cost' => 0,
                                'unit_cost' => 0,
                                'real_unit_cost' => 0,
                                'quantity' =>$product['quantity'],
                                'quantity_balance' => $product['quantity'],
                                'quantity_received' =>$product['quantity'],
                                'item_tax' =>$product['tax_rate'],
                                'tax_rate_id' => $product['tax_rate'],
                                'tax' => $product['tax_rate'],
                                'subtotal' =>$product['quantity'],
                                'warehouse_id' =>$warehouse->id,
                                'date' => date('Y-m-d'),
                                'status' => 'received',
				'barcode' => $product['barcode'],
                            );
                            $this->db->insert('purchase_items', $item);
                            $this->site->syncProductQty($product_id, $warehouse->id); 
							 } 
                    foreach ($variants as $variant) {
                        if ($variant && trim($variant) != '') {
                            $vat = array('product_id' => $product_id, 'name' => trim($variant));
                            $this->db->insert('product_variants', $vat);
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }

    public function getProductNames($term, $limit = 5)
    {
        $this->db->select('inv_products.id, code, inv_products.name as name, inv_products.price as price, inv_product_variants.name as vname')
            ->where("type != 'combo' AND "
                . "(inv_products .name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR
                concat(inv_products.name, ' (', code, ')') LIKE '%" . $term . "%')");
        $this->db->join('inv_product_variants', 'inv_product_variants.product_id=inv_products.id', 'left')
            ->where('inv_product_variants.name', NULL)
            ->group_by('inv_products.id')->limit($limit);
        $q = $this->db->get('inv_products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getQASuggestions($term, $limit = 5)
    {
        $this->db->select('' . $this->db->dbprefix('products') . '.id, code, ' . $this->db->dbprefix('products') . '.name as name')
            ->where("type != 'combo' AND "
                . "(" . $this->db->dbprefix('products') . ".name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR
                concat(" . $this->db->dbprefix('products') . ".name, ' (', code, ')') LIKE '%" . $term . "%')")
            ->limit($limit);
        $q = $this->db->get('products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getProductsForPrinting($term, $limit = 5)
    {
        $this->db->select('' . $this->db->dbprefix('products') . '.id, code, ' . $this->db->dbprefix('products') . '.name as name, ' . $this->db->dbprefix('products') . '.price as price')
            ->where("(" . $this->db->dbprefix('products') . ".name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR
                concat(" . $this->db->dbprefix('products') . ".name, ' (', code, ')') LIKE '%" . $term . "%')")
            ->limit($limit);
        $q = $this->db->get('products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function updateProduct($id, $data, $items, $warehouse_qty, $product_attributes, $photos, $update_variants)
    {
        if ($this->db->update('inv_products', $data, array('id' => $id))) {

	    
	    $assigned_stores = $this->input->post('stores');
	    foreach($assigned_stores as $k => $storeid){
		
                $q = $this->db->get_where('inv_warehouses_products', array('product_id' => $id, 'warehouse_id' => $storeid));
		if($q->num_rows()==0){
		    //$product_id = $id;
		    //$p_data['store_id'] = $storeid;
		    //$p_data['product_id'] = $product_id;
		    //$p_data['price'] = $data['price'];
		    //$p_data['created_on'] = date('Y-m-d H:i:s');
		    //$p_data['currency_id'] = $this->site->get_defaultCurrencyID();
		    //
		    //$this->insert_inv_price_master($p_data);
		    //
		    //$s_data['store_id'] = $storeid;
		    //$s_data['product_id'] = $product_id;	    
		    //$s_data['category_id'] = ($data['category_id'])?$data['category_id']:0;
		    //$s_data['subcategory_id'] = ($data['subcategory_id'])?$data['subcategory_id']:0;
		    ////$s_data['brand'] = $row['brand']; // $row['brand']
		    //$s_data['selling_price'] = ($data['price'])?$data['price']:0;
		    //$s_data['cost_price'] = ($data['cost'])?$data['cost']:0;    
		    //$s_data['stock_in'] = 0;
		    //$s_data['stock_out'] = 0;
		    //
		    //$this->insert_stock_master($s_data);
		    //$this->db->insert('warehouses_products', array('product_id' => $product_id, 'warehouse_id' => $storeid, 'quantity' => 0)); 
		
		}
	    }
	    
	    
            if ($items) {
                $this->db->delete('inv_combo_items', array('product_id' => $id));
                foreach ($items as $item) {
                    $item['product_id'] = $id;
                    $this->db->insert('inv_combo_items', $item);
                }
            }

            $tax_rate = $this->site->getTaxRateByID($data['tax_rate']);

            if ($warehouse_qty && !empty($warehouse_qty)) {
                foreach ($warehouse_qty as $wh_qty) {
                    $this->db->update('inv_warehouses_products', array('rack' => $wh_qty['rack']), array('product_id' => $id, 'warehouse_id' => $wh_qty['warehouse_id']));
                }
            }

            if (!empty($update_variants)) {
                $this->db->update_batch('inv_product_variants', $update_variants, 'id');
            }

            if ($photos) {
                foreach ($photos as $photo) {
                    $this->db->insert('inv_product_photos', array('product_id' => $id, 'photo' => $photo));
                }
            }

            if ($product_attributes) {
                foreach ($product_attributes as $pr_attr) {

                    $pr_attr['product_id'] = $id;
                    $variant_warehouse_id = $pr_attr['warehouse_id'];
                    unset($pr_attr['warehouse_id']);
                    $this->db->insert('inv_product_variants', $pr_attr);
                    $option_id = $this->db->insert_id();

                    if ($pr_attr['quantity'] != 0) {
                        $this->db->insert('inv_warehouses_products_variants', array('option_id' => $option_id, 'product_id' => $id, 'warehouse_id' => $variant_warehouse_id, 'quantity' => $pr_attr['quantity']));

                        $tax_rate_id = $tax_rate ? $tax_rate->id : NULL;
                        $tax = $tax_rate ? (($tax_rate->type == 1) ? $tax_rate->rate . "%" : $tax_rate->rate) : NULL;
                        $unit_cost = $data['cost'];
                        if ($tax_rate) {
                            if ($tax_rate->type == 1 && $tax_rate->rate != 0) {
                                if ($data['tax_method'] == '0') {
                                    $pr_tax_val = ($data['cost'] * $tax_rate->rate) / (100 + $tax_rate->rate);
                                    $net_item_cost = $data['cost'] - $pr_tax_val;
                                    $item_tax = $pr_tax_val * $pr_attr['quantity'];
                                } else {
                                    $net_item_cost = $data['cost'];
                                    $pr_tax_val = ($data['cost'] * $tax_rate->rate) / 100;
                                    $unit_cost = $data['cost'] + $pr_tax_val;
                                    $item_tax = $pr_tax_val * $pr_attr['quantity'];
                                }
                            } else {
                                $net_item_cost = $data['cost'];
                                $item_tax = $tax_rate->rate;
                            }
                        } else {
                            $net_item_cost = $data['cost'];
                            $item_tax = 0;
                        }

                        $subtotal = (($net_item_cost * $pr_attr['quantity']) + $item_tax);
                        $item = array(
                            'product_id' => $id,
                            'product_code' => $data['code'],
                            'product_name' => $data['name'],
                            'net_unit_cost' => $net_item_cost,
                            'unit_cost' => $unit_cost,
                            'quantity' => $pr_attr['quantity'],
                            'option_id' => $option_id,
                            'quantity_balance' => $pr_attr['quantity'],
                            'quantity_received' => $pr_attr['quantity'],
                            'item_tax' => $item_tax,
                            'tax_rate_id' => $tax_rate_id,
                            'tax' => $tax,
                            'subtotal' => $subtotal,
                            'warehouse_id' => $variant_warehouse_id,
                            'date' => date('Y-m-d'),
                            'status' => 'received',
                        );
                        $item['option_id'] = !empty($item['option_id']) && is_numeric($item['option_id']) ? $item['option_id'] : NULL;
                        $this->db->insert('purchase_items', $item);

                    }
                }
            }

          //  $this->site->syncQuantity(NULL, NULL, NULL, $id);
            return true;
        } else {
            return false;
        }
    }

    public function updateProductOptionQuantity($option_id, $warehouse_id, $quantity, $product_id)
    {
        if ($option = $this->getProductWarehouseOptionQty($option_id, $warehouse_id)) {
            if ($this->db->update('warehouses_products_variants', array('quantity' => $quantity), array('option_id' => $option_id, 'warehouse_id' => $warehouse_id))) {
                $this->site->syncVariantQty($option_id, $warehouse_id);
                return TRUE;
            }
        } else {
            if ($this->db->insert('warehouses_products_variants', array('option_id' => $option_id, 'product_id' => $product_id, 'warehouse_id' => $warehouse_id, 'quantity' => $quantity))) {
                $this->site->syncVariantQty($option_id, $warehouse_id);
                return TRUE;
            }
        }
        return FALSE;
    }

    public function updatePrice($data = array())
    {
        if ($this->db->update_batch('products', $data, 'code')) {
            return true;
        }
        return false;
    }

    public function deleteProduct($id)
    {
       /*  if ($this->db->delete('products', array('id' => $id)) && $this->db->delete('warehouses_products', array('product_id' => $id))) {
            $this->db->delete('warehouses_products_variants', array('product_id' => $id));
            $this->db->delete('product_variants', array('product_id' => $id));
            $this->db->delete('product_photos', array('product_id' => $id));
            $this->db->delete('product_prices', array('product_id' => $id));
            return true;
        }
        return FALSE; */
		$query=$this->db->query("SELECT CASE 
     WHEN EXISTS (SELECT 1 FROM sramrms_return_items  WHERE product_id ='".$id."')
       OR EXISTS (SELECT 1 FROM sramrms_quote_items WHERE product_id ='".$id."')
       OR EXISTS (SELECT 1 FROM sramrms_purchase_items  WHERE product_id ='".$id."')
        OR EXISTS (SELECT 1 FROM sramrms_sale_items WHERE product_id ='".$id."')
       OR EXISTS (SELECT 1 FROM sramrms_transfer_items  WHERE product_id ='".$id."')
      THEN 'y'
     ELSE 'n'
     END product")->row();
	 $exists=$query->product;
	 if($exists =='y')
	 {
		$data=array('Active'=>1);
		$this->db->where('id',$id);
		$this->db->update('products',$data);
		return true;
	 }else{
	if ($this->db->delete('products', array('id' => $id)) && $this->db->delete('warehouses_products', array('product_id' => $id))) {
            $this->db->delete('warehouses_products_variants', array('product_id' => $id));
            $this->db->delete('product_variants', array('product_id' => $id));
            $this->db->delete('product_photos', array('product_id' => $id));
            $this->db->delete('product_prices', array('product_id' => $id));
            return true;
	 }
	 return false;
    }
	}

    public function totalCategoryProducts($category_id)
    {
        $q = $this->db->get_where('products', array('category_id' => $category_id));
        return $q->num_rows();
    }

    public function getCategoryByCode($code)
    {
        $q = $this->db->get_where('categories', array('code' => $code))->row();

        if (!empty($q)) {
            return $q;
        }else{
		    $post_data=	array('code' => $code);
			    $this->db->insert('categories', $post_data);
                $id = $this->db->insert_id();
               return  $id;
			
		}
        return FALSE;
    }
public function getSubCategoryByCode($code)
    {
        $q = $this->db->get_where('subcategories', array('code' => $code))->row();
        if (!empty($q)) {
            return $q;
        }else{
		    $post_data=	array('code' => $code);
			    $this->db->insert('subcategories', $post_data);
                $id = $this->db->insert_id();
                return  $id;
			
		}
        return FALSE;
    }
    public function getTaxRateByName($name)
    {
        $q = $this->db->get_where('tax_rates', array('name' => $name))->row();
       if (!empty($q)) {
            return $q;
        }else{
			    $post_data=array('name' => $name);
			    $this->db->insert('tax_rates', $post_data);
                $id = $this->db->insert_id();
               return  $id;
		}
        return FALSE;
    }

  public function getUnitsByBUID($unit_id)
    {
        $q = $this->db->get_where('units', array('id' => $unit_id))->result();
	return $q;
    }






    public function getAdjustmentByID($id)
    {
        $q = $this->db->get_where('adjustments', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getAdjustmentItems($adjustment_id)
    {
        $this->db->select('adjustment_items.*, products.code as product_code, products.name as product_name, products.image, products.details as details, product_variants.name as variant')
            ->join('products', 'products.id=adjustment_items.product_id', 'left')
            ->join('product_variants', 'product_variants.id=adjustment_items.option_id', 'left')
            ->group_by('adjustment_items.id')
            ->order_by('id', 'asc');
        $this->db->where('adjustment_id', $adjustment_id);
        $q = $this->db->get('adjustment_items');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function syncAdjustment($data = array())
    {
        if(! empty($data)) {
            $clause = array('product_id' => $data['product_id'], 'option_id' => $data['option_id'], 'warehouse_id' => $data['warehouse_id'], 'status' => 'received');
            $qty = $data['type'] == 'subtraction' ? 0 - $data['quantity'] : 0 + $data['quantity'];
            $this->site->setPurchaseItem($clause, $qty);

            $this->site->syncProductQty($data['product_id'], $data['warehouse_id']);
            if ($data['option_id']) {
                $this->site->syncVariantQty($data['option_id'], $data['warehouse_id'], $data['product_id']);
            }
        }
    }

    public function reverseAdjustment($id)
    {
        if ($products = $this->getAdjustmentItems($id)) {
            foreach ($products as $adjustment) {
                $clause = array('product_id' => $adjustment->product_id, 'warehouse_id' => $adjustment->warehouse_id, 'option_id' => $adjustment->option_id, 'status' => 'received');
                $qty = $adjustment->type == 'subtraction' ? (0+$adjustment->quantity) : (0-$adjustment->quantity);
                $this->site->setPurchaseItem($clause, $qty);
                $this->site->syncProductQty($adjustment->product_id, $adjustment->warehouse_id);
                if ($adjustment->option_id) {
                    $this->site->syncVariantQty($adjustment->option_id, $adjustment->warehouse_id, $adjustment->product_id);
                }
            }
        }
    }

    public function addAdjustment($data, $products)
    {
        if ($this->db->insert('adjustments', $data)) {
            $adjustment_id = $this->db->insert_id();
            foreach ($products as $product) {
                $product['adjustment_id'] = $adjustment_id;
                $this->db->insert('adjustment_items', $product);
                $this->syncAdjustment($product);
            }
            if ($this->site->getReference('qa') == $data['reference_no']) {
                $this->site->updateReference('qa');
            }
            return true;
        }
        return false;
    }

    public function updateAdjustment($id, $data, $products)
    {
        $this->reverseAdjustment($id);
        if ($this->db->update('adjustments', $data, array('id' => $id)) &&
            $this->db->delete('adjustment_items', array('adjustment_id' => $id))) {
            foreach ($products as $product) {
                $product['adjustment_id'] = $id;
                $this->db->insert('adjustment_items', $product);
                $this->syncAdjustment($product);
            }
            return true;
        }
        return false;
    }

    public function deleteAdjustment($id)
    {
        $this->reverseAdjustment($id);
        if ( $this->db->delete('adjustments', array('id' => $id)) &&
            $this->db->delete('adjustment_items', array('adjustment_id' => $id))) {
            return true;
        }
        return false;
    }

    public function getProductQuantity($product_id, $warehouse)
    {
        $q = $this->db->get_where('warehouses_products', array('product_id' => $product_id, 'warehouse_id' => $warehouse), 1);
        if ($q->num_rows() > 0) {
            return $q->row_array();
        }
        return FALSE;
    }

    public function addQuantity($product_id, $warehouse_id, $quantity, $rack = NULL)
    {

        if ($this->getProductQuantity($product_id, $warehouse_id)) {
            if ($this->updateQuantity($product_id, $warehouse_id, $quantity, $rack)) {
                return TRUE;
            }
        } else {
            if ($this->insertQuantity($product_id, $warehouse_id, $quantity, $rack)) {
                return TRUE;
            }
        }

        return FALSE;
    }

    public function insertQuantity($product_id, $warehouse_id, $quantity, $rack = NULL)
    {
        $product = $this->site->getProductByID($product_id);
        if ($this->db->insert('warehouses_products', array('product_id' => $product_id, 'warehouse_id' => $warehouse_id, 'quantity' => $quantity, 'rack' => $rack, 'avg_cost' => $product->cost))) {
            $this->site->syncProductQty($product_id, $warehouse_id);
            return true;
        }
        return false;
    }

    public function updateQuantity($product_id, $warehouse_id, $quantity, $rack = NULL)
    {
        $data = $rack ? array('quantity' => $quantity, 'rack' => $rack) : $data = array('quantity' => $quantity);
        if ($this->db->update('warehouses_products', $data, array('product_id' => $product_id, 'warehouse_id' => $warehouse_id))) {
            $this->site->syncProductQty($product_id, $warehouse_id);
            return true;
        }
        return false;
    }

    public function products_count($category_id, $subcategory_id = NULL)
    {
        if ($category_id) {
            $this->db->where('category_id', $category_id);
        }
        if ($subcategory_id) {
            $this->db->where('subcategory_id', $subcategory_id);
        }
        $this->db->from('products');
        return $this->db->count_all_results();
    }

    public function fetch_products($category_id, $limit, $start, $subcategory_id = NULL)
    {

        $this->db->limit($limit, $start);
        if ($category_id) {
            $this->db->where('category_id', $category_id);
        }
        if ($subcategory_id) {
            $this->db->where('subcategory_id', $subcategory_id);
        }
        $this->db->order_by("id", "asc");
        $query = $this->db->get("products");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function getProductWarehouseOptionQty($option_id, $warehouse_id)
    {
        $q = $this->db->get_where('warehouses_products_variants', array('option_id' => $option_id, 'warehouse_id' => $warehouse_id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function syncVariantQty($option_id)
    {
        $wh_pr_vars = $this->getProductWarehouseOptions($option_id);
        $qty = 0;
        foreach ($wh_pr_vars as $row) {
            $qty += $row->quantity;
        }
        if ($this->db->update('product_variants', array('quantity' => $qty), array('id' => $option_id))) {
            return TRUE;
        }
        return FALSE;
    }

    public function getProductWarehouseOptions($option_id)
    {
        $q = $this->db->get_where('warehouses_products_variants', array('option_id' => $option_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function setRack($data)
    {
        if ($this->db->update('warehouses_products', array('rack' => $data['rack']), array('product_id' => $data['product_id'], 'warehouse_id' => $data['warehouse_id']))) {
            return TRUE;
        }
        return FALSE;
    }

    public function getSoldQty($id)
    {
        $this->db->select("date_format(" . $this->db->dbprefix('sales') . ".date, '%Y-%M') month, SUM( " . $this->db->dbprefix('sale_items') . ".quantity ) as sold, SUM( " . $this->db->dbprefix('sale_items') . ".subtotal ) as amount")
            ->from('sales')
            ->join('sale_items', 'sales.id=sale_items.sale_id', 'left')
            ->group_by("date_format(" . $this->db->dbprefix('sales') . ".date, '%Y-%m')")
            ->where($this->db->dbprefix('sale_items') . '.product_id', $id)
            //->where('DATE(NOW()) - INTERVAL 1 MONTH')
            ->where('DATE_ADD(curdate(), INTERVAL 1 MONTH)')
            ->order_by("date_format(" . $this->db->dbprefix('sales') . ".date, '%Y-%m') desc")->limit(3);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getPurchasedQty($id)
    {
        //$this->db->select("date_format(" . $this->db->dbprefix('purchases') . ".date, '%Y-%M') month, SUM( " . $this->db->dbprefix('purchase_items') . ".quantity ) as purchased, SUM( " . $this->db->dbprefix('purchase_items') . ".subtotal ) as amount")
        //    ->from('purchases')
        //    ->join('purchase_items', 'purchases.id=purchase_items.purchase_id', 'left')
        //    ->group_by("date_format(" . $this->db->dbprefix('purchases') . ".date, '%Y-%m')")
        //    ->where($this->db->dbprefix('purchase_items') . '.product_id', $id)
        //    //->where('DATE(NOW()) - INTERVAL 1 MONTH')
        //    ->where('DATE_ADD(curdate(), INTERVAL 1 MONTH)')
        //    ->order_by("date_format(" . $this->db->dbprefix('purchases') . ".date, '%Y-%m') desc")->limit(3);
        //$q = $this->db->get();
        //if ($q->num_rows() > 0) {
        //    foreach (($q->result()) as $row) {
        //        $data[] = $row;
        //    }
        //    return $data;
        //}
        return FALSE;
    }

    public function getAllVariants()
    {
        $q = $this->db->get('inv_variants');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getWarehouseProductVariant($warehouse_id, $product_id, $option_id = NULL)
    {
        $q = $this->db->get_where('warehouses_products_variants', array('product_id' => $product_id, 'option_id' => $option_id, 'warehouse_id' => $warehouse_id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getPurchaseItems($purchase_id)
    {
        $q = $this->db->get_where('purchase_items', array('purchase_id' => $purchase_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getTransferItems($transfer_id)
    {
        $q = $this->db->get_where('purchase_items', array('transfer_id' => $transfer_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getUnitByCode($name)
    {
        $q = $this->db->get_where("units", array('name' => $name))->row();
        if (!empty($q)) {
            return $q;
        }else{
			    $post_data=array('name' => $name);
			    $this->db->insert('units', $post_data);
                $id = $this->db->insert_id();
		$q = $this->db->get_where("units", array('id' => $id))->row();
                return  $q;

		}
        return FALSE;
    }

    public function getBrandByName($name)
    {
        $q = $this->db->get_where('brands', array('name' => $name))->row();
        if (!empty($q)) {
            return $q;
        }else{
			    $post_data=array('name' => $name);
			    $this->db->insert('brands', $post_data);
                $id = $this->db->insert_id();
		$q = $this->db->get_where('brands', array('id' => $id))->row();
                return  $q;
		}
        return FALSE;
    }

    public function getStockCountProducts($warehouse_id, $type, $categories = NULL, $brands = NULL)
    {
        $this->db->select("{$this->db->dbprefix('products')}.id as id, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('warehouses_products')}.quantity as quantity")
        ->join('warehouses_products', 'warehouses_products.product_id=products.id', 'left')
        ->where('warehouses_products.warehouse_id', $warehouse_id)
        ->where('products.type', 'standard')
        ->order_by('products.code', 'asc');
        if ($categories) {
            $r = 1;
            $this->db->group_start();
            foreach ($categories as $category) {
                if ($r == 1) {
                    $this->db->where('products.category_id', $category);
                } else {
                    $this->db->or_where('products.category_id', $category);
                }
                $r++;
            }
            $this->db->group_end();
        }
        if ($brands) {
            $r = 1;
            $this->db->group_start();
            foreach ($brands as $brand) {
                if ($r == 1) {
                    $this->db->where('products.brand', $brand);
                } else {
                    $this->db->or_where('products.brand', $brand);
                }
                $r++;
            }
            $this->db->group_end();
        }

        $q = $this->db->get('products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }

    public function getStockCountProductVariants($warehouse_id, $product_id)
    {
        $this->db->select("{$this->db->dbprefix('product_variants')}.name, {$this->db->dbprefix('warehouses_products_variants')}.quantity as quantity")
            ->join('warehouses_products_variants', 'warehouses_products_variants.option_id=product_variants.id', 'left');
        $q = $this->db->get_where('product_variants', array('product_variants.product_id' => $product_id, 'warehouses_products_variants.warehouse_id' => $warehouse_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function addStockCount($data)
    {
        if ($this->db->insert('stock_counts', $data)) {
            return TRUE;
        }
        return FALSE;
    }
	
	function getProduct(){
		$q = $this->db->get_where('products', array('Active' => 0 ))->result();
         if (!empty($q)){
            return $q ;
			}else{
		return false;
			}
	}
	function getSuppliers(){
		$q = $this->db->get_where('companies', array('Active' => 0 ))->result();
        if (!empty($q)){
            return $q ;
			}else{
		return false;
			}
	}

	public function getProductProperties($product_id){
		$product=$this->db->get_where('products',array('Active'=>0,'id'=>$product_id))->row();
		if($product){
			return $product ;
		}else{
			return false;
		}
	}
    public function finalizeStockCount($id, $data, $products)
    {
        if ($this->db->update('stock_counts', $data, array('id' => $id))) {
            foreach ($products as $product) {
                $this->db->insert('stock_count_items', $product);
            }
            return TRUE;
        }
        return FALSE;
    }
    public function getStouckCountByID($id)
    {
        $q = $this->db->get_where("stock_counts", array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getStockCountItems($stock_count_id)
    {
        $q = $this->db->get_where("stock_count_items", array('stock_count_id' => $stock_count_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return NULL;
    }

    public function getAdjustmentByCountID($count_id)
    {
        $q = $this->db->get_where('adjustments', array('count_id' => $count_id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getProductVariantID($product_id, $name)
    {
        $q = $this->db->get_where("product_variants", array('product_id' => $product_id, 'name' => $name), 1);
        if ($q->num_rows() > 0) {
            $variant = $q->row();
            return $variant->id;
        }
        return NULL;
    }
    function getAttribute_probyid($properties_id){
	    
	     $q = $this->db->get_where("inv_attribute_properties", array('id' => $properties_id, 'soft_delete' =>0), 1);
    if ($q->num_rows() > 0) {
	$attribute = $q->row();
	return $attribute->Attribute_id;
    }
    return NULL;
	    
    }
    public function getCategoryByName($name)
    {
        $q = $this->db->get_where('categories', array('name' => $name))->row();

        if (!empty($q)) {
            return $q;
        }else{
		    $post_data=	array('name' => $name);
			    $this->db->insert('categories', $post_data);
                $id = $this->db->insert_id();
		$q = $this->db->get_where('categories', array('id' => $id))->row();
               return  $q;
			
		}
        return FALSE;
    }
public function getSubCategoryByName($name,$cat_id)
    {
        $q = $this->db->get_where('categories', array('name' => $name,'parent_id'=>$cat_id))->row();
        if (!empty($q)) {
            return $q;
        }else{
		    $post_data=	array('name' => $name,'parent_id'=>$cat_id);
			    $this->db->insert('categories', $post_data);
                $id = $this->db->insert_id();
		$q = $this->db->get_where('categories', array('id' => $id))->row();
                return  $q;
			
		}
        return FALSE;
    }
    function searchProducts(){
	$search = $this->session->userdata();
	
	$this->db->select('products.*,categories.name as category_name,pro_stock_master.cost_price as cost,inv_price_master.price,inv_price_master.batch_no,inv_price_master.id as batch_id,inv_price_master.unique_id as stock_id');
	$this->db->from('products');
	$this->db->join('categories','categories.id=products.category_id');
	$this->db->join('inv_price_master','inv_price_master.product_id=products.id AND inv_price_master.store_id='.$this->store_id);
	$this->db->join('pro_stock_master','pro_stock_master.unique_id=inv_price_master.unique_id AND pro_stock_master.store_id='.$this->store_id);
	if($search['batch_no']!=''){
	    $this->db->where('inv_price_master.batch_no',$search['batch_no']);
	}
	if($search['category_id']!=''){
	    $this->db->where('products.category_id',$search['category_id']);
	}
	if($search['subcategory_id']!=''){
	    $this->db->where('products.subcategory_id',$search['subcategory_id']);
	}
	if($search['brand']!=''){
	    $this->db->where('brand',$search['brand']);
	}
	if($search['supplier']!=''){
	    $this->db->where('(supplier1='.$search['supplier'].' or supplier2='.$search['supplier'].' or supplier3='.$search['supplier'].' or supplier3='.$search['supplier'].' or supplier5='.$search['supplier'].')');
	}
	
	if($search['product']!=''){
	    $this->db->where('products.id',$search['product']);
	}
	if($search['cost_price']!=''){
	    $this->db->where('pro_stock_master.cost_price',$search['cost_price']);
	}
	if($search['selling_price']!=''){
	    $this->db->where('inv_price_master.price',$search['selling_price']);
	}
	if($search['mrp']!=''){
	   $this->db->where('mrp',$search['mrp']);
	}
	//echo $this->db->get_compiled_select();
	$q = $this->db->get();
	if($q->num_rows()>0){
	    return $q->result();
	}
	return false;
	
    }
    function updateSellingPrice($u_data){
	
	foreach($u_data as $row){
	    //$this->db->where(array('id'=>$row['id'],'batch_no'=>$row['batch_no'],'store_id'=>$row['store_id'],'product_id'=>$row['product_id']));
	    $this->db->where(array('unique_id'=>$row['unique_id']));
	    $this->db->update('inv_price_master',$row);
	    
	    $s_data['selling_price'] = $row['price'];
	    $this->db->where(array('unique_id'=>$row['unique_id']));
	    $this->db->update('pro_stock_master',$s_data);
	}
    }
	
    function getSupplier_byID($id){
	$q = $this->db->get_where('companies', array('id' => $id), 1);
	
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
    function getProductID($code,$name){
	$q = $this->db->get_where('products', array('code' => $code,'name'=>$name), 1);
	
        if ($q->num_rows() > 0) {
            return $q->row('id');
        }
        return FALSE;
    }
    function getBatchNo_byID($id){
	$q = $this->db->get_where('inv_price_master', array('id' => $id,'store_id'=>$this->store_id), 1);
	
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
    function getBatchNos($term, $limit = 5)
    {
        $this->db->select('*')
            ->where("(batch_no LIKE '%" . $term . "%')")
            ->where('store_id', $this->store_id);
        $q = $this->db->get('inv_price_master');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
function insert_price_master($price_data){
    $this->db->insert('inv_price_master',$price_data);
    $insertID = $this->db->insert_id();
    $UniqueID = $this->site->generateUniqueTableID($insertID);
    $this->site->updateUniqueTableId($insertID,$UniqueID,'inv_price_master');
    
}
function insert_stock_master($stock_data){
    $this->db->insert('inv_pro_stock_master',$stock_data);
    $insertID = $this->db->insert_id();
    $UniqueID = $this->site->generateUniqueTableID($insertID);
    $this->site->updateUniqueTableId($insertID,$UniqueID,'inv_pro_stock_master');
			
    //p($this->db->error());exit;
}
function insert_product_alert_qty($a_data){
    $this->db->insert('inv_product_alert_quantity',$a_data);
    $insertID = $this->db->insert_id(); 
    $UniqueID = $this->site->generateUniqueTableID($insertID);
    $this->site->updateUniqueTableId($insertID,$UniqueID,'inv_product_alert_quantity');
   
}
function getProductMinQty($id){
    $this->db->select('w.id as store_id,w.name as store_name,p.min_qty,p.max_qty');
    $this->db->from('warehouses w');
    $this->db->join('inv_product_alert_quantity p','p.store_id=w.id and p.product_id='.$id,'left');
   
    
    $q = $this->db->get();
    if($q->num_rows()>0){
	return $q->result();
    }
    return false;
}
function updateproductMinQty($stores,$id){
    foreach($stores as $k => $row){
	$q = $this->db->get_where('product_alert_quantity',array('store_id'=>$row['store_id'],'product_id'=>$id));
	if($q->num_rows()>0){
	    $this->db->where(array('store_id'=>$row['store_id'],'product_id'=>$id));
	    $this->db->update('product_alert_quantity',$row);
	}else{
	    $this->insert_product_alert_qty($row);
	}
    }
}
function getTotalStock($productID){
    $this->db
	->select("SUM(stock_in) as total_stock")
	->from('pro_stock_master')		
	->join('warehouses','warehouses.id=pro_stock_master.store_id')
	->where('pro_stock_master.product_id',$productID)
	->where('pro_stock_master.store_id',$this->store_id);
    $q = $this->db->get();
    if($q->num_rows()>0){
	return $q->row('total_stock');
    }
    return false;
}
public function getSettings()
{
    $q = $this->db->get('inv_settings');
    if ($q->num_rows() > 0) {
        return $q->row();
    }
    return FALSE;
}

}
