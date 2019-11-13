<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
       
        $this->load->library('form_validation');
        $this->load->model('procurment/products_model');
		 $this->load->model('procurment/site');
	 $this->load->model('payroll/global_model');
        $this->digital_upload_path = 'files/';
	if (!file_exists($this->digital_upload_path)) {
		    mkdir($this->digital_upload_path, 0777, true);
		}
        $this->upload_path = './assets/product/';
        $this->thumbs_path = './assets/product/thumbs/';
        $this->image_types = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt';
        $this->allowed_file_size = '1024';
        $this->popup_attributes = array('width' => '900', 'height' => '600', 'window_name' => 'sma_popup', 'menubar' => 'yes', 'scrollbars' => 'yes', 'status' => 'no', 'resizable' => 'yes', 'screenx' => '0', 'screeny' => '0');
    }

    function index($warehouse_id = NULL)
    {
   
        $data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $data['supplier'] = $this->input->get('supplier') ? $this->site->getCompanyByID($this->input->get('supplier')) : NULL;
        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => '#', 'page' => lang('products')));
        $meta = array('page_title' => lang('products'), 'bc' => $bc);
        $this->render_admin('procurment/products/index', $meta, $data);
    }
      function   get_products(){
		    $detail_link = anchor('admin/procurment/products/view/$1', '<i class="fa fa-file-text-o"></i> ' . lang('product_details'));
        $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line("delete_product") . "</b>' data-content=\"<p>"
            . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete1' id='a__$1' href='" . base_url('admin/procurment/products/delete/$1') . "'>"
            . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
            . lang('delete_product') . "</a>";
		$actions = "<div class=\"text-center\">";

		$actions = '<div class="text-center"><div class="btn-group text-left">'
            . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
            . lang('actions') . ' <span class="caret"></span></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li>' . $detail_link . '</li>
            <li><a href="' . base_url('admin/procurment/products/add/$1') . '"><i class="fa fa-plus-square"></i> ' . lang('duplicate_product') . '</a></li>
            <li><a href="' . base_url('admin/procurment/products/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_product') . '</a></li>';
			   $actions .= '<li><a href="' . base_url() . 'assets/product/$2" data-type="image" data-toggle="lightbox"><i class="fa fa-file-photo-o"></i> '
            . lang('view_image') . '</a></li>
           
            <li class="divider"></li>
            <li>' . $delete_link . '</li>
            </ul>
        </div></div>';
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("inv_products.id as productid,inv_products.image as image,inv_products.code as code ,inv_products.barcode,inv_products.name as name ,inv_categories.name category,inv_brands.name as brand,alert_quantity
		  ", FALSE)
		   ->from("inv_products")
		   ->join("inv_categories","inv_categories.id=inv_products.category_id","left")
		   ->join("inv_brands","inv_brands.id=inv_products.brand","left")
		  ->where('Active',0)
		   ->add_column("Actions", $actions, "productid,image, code, name");
		echo $this->datatables->generate();
		  
	  }
  /*   function getProducts($warehouse_id = NULL)
    {
		
       // $this->sma->checkPermissions('index', TRUE);
        $supplier = $this->input->get('supplier') ? $this->input->get('supplier') : NULL;

        if ((! $this->Owner || ! $this->Admin) && ! $warehouse_id) {
            $user = $this->site->getUser();
            $warehouse_id = $user->warehouse_id;
        }
        $detail_link = anchor('admin/procurment/products/view/$1', '<i class="fa fa-file-text-o"></i> ' . lang('product_details'));
        $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line("delete_product") . "</b>' data-content=\"<p>"
            . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete1' id='a__$1' href='" . base_url('products/delete/$1') . "'>"
            . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
            . lang('delete_product') . "</a>";
        $single_barcode = anchor('admin/procurment/products/print_barcodes/$1', '<i class="fa fa-print"></i> ' . lang('print_barcode_label'));
        // $single_label = anchor_popup('products/single_label/$1/' . ($warehouse_id ? $warehouse_id : ''), '<i class="fa fa-print"></i> ' . lang('print_label'), $this->popup_attributes);
        $action = '<div class="text-center"><div class="btn-group text-left">'
            . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
            . lang('actions') . ' <span class="caret"></span></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li>' . $detail_link . '</li>
            <li><a href="' . base_url('admin/procurment/products/add/$1') . '"><i class="fa fa-plus-square"></i> ' . lang('duplicate_product') . '</a></li>
            <li><a href="' . base_url('admin/procurment/products/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_product') . '</a></li>';
       // if ($warehouse_id) {
            $action .= '<li><a href="' . base_url('admin/procurment/products/set_rack/$1/' . $warehouse_id) . '" data-toggle="modal" data-target="#myModal"  data-backdrop="static" data-keyboard="false"><i class="fa fa-bars"></i> '
                . lang('set_rack') . '</a></li>';
       // }
        $action .= '<li><a href="' . base_url() . 'assets/uploads/$2" data-type="image" data-toggle="lightbox"><i class="fa fa-file-photo-o"></i> '
            . lang('view_image') . '</a></li>
            <li>' . $single_barcode . '</li>
            <li class="divider"></li>
            <li>' . $delete_link . '</li>
            </ul>
        </div></div>';
	
	
        if($this->isWarehouse){
            $actions = $action;
        }else if(isStore){
            $actions = '<div class="text-center"><div class="btn-group text-left">'
            . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
            . lang('actions') . ' <span class="caret"></span></button>
        <ul class="dropdown-menu pull-right" role="menu"><li>'.$detail_link.'</li><li><a href="' . base_url() . 'assets/uploads/$2" data-type="image" data-toggle="lightbox"><i class="fa fa-file-photo-o"></i> '
            . lang('view_image') . '</a></li>
            <li>' . $single_barcode . '</li></ul> </div></div>';
        }
	
        $this->load->library('datatables');
        if ($warehouse_id) {
            $this->datatables
            ->select($this->db->dbprefix('products') . ".id as productid, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('brands')}.name as brand, {$this->db->dbprefix('categories')}.name as cname,  {$this->db->dbprefix('units')}.name as unit, wp.rack as rack, alert_quantity, ".$this->db->dbprefix('products') . ".id as stock_r_id,", FALSE)
            ->from('products');
            if ($this->Settings->display_all_products) {
                $this->datatables->join("( SELECT product_id, quantity, rack from {$this->db->dbprefix('warehouses_products')} WHERE warehouse_id = {$warehouse_id}) wp", 'products.id=wp.product_id', 'left');
            } else {
                $this->datatables->join('warehouses_products wp', 'products.id=wp.product_id', 'left')
                ->where('wp.warehouse_id', $warehouse_id)
                ->where('wp.quantity !=', 0);
            }
            $this->datatables->join('categories', 'products.category_id=categories.id', 'left')
            ->join('units', 'products.unit=units.id', 'left')
            ->join('brands', 'products.brand=brands.id', 'left')
			->where('Active',0);
            // ->group_by("products.id");
        } else {
            $this->datatables
                ->select($this->db->dbprefix('products') . ".id as productid, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('brands')}.name as brand, {$this->db->dbprefix('categories')}.name as cname, {$this->db->dbprefix('units')}.name as unit, '' as rack, alert_quantity, ".$this->db->dbprefix('products') . ".id as stock_r_id,".$this->db->dbprefix('products') . ".id as min_qty,", FALSE)
                ->from('products')
                ->join('categories', 'products.category_id=categories.id', 'left')
                ->join('units', 'products.unit=units.id', 'left')
                ->join('brands', 'products.brand=brands.id', 'left')
				->where('Active',0)
                ->group_by("products.id");
        }
        if (!$this->Owner && !$this->Admin) {
            if (!$this->session->userdata('show_cost')) {
                $this->datatables->unset_column("cost");
            }
            if (!$this->session->userdata('show_price')) {
                $this->datatables->unset_column("price");
            }
        }
        if ($supplier) {
            $this->datatables->where('supplier1', $supplier)
            ->or_where('supplier2', $supplier)
            ->or_where('supplier3', $supplier)
            ->or_where('supplier4', $supplier)
            ->or_where('supplier5', $supplier);
        }
        $this->datatables->add_column("Actions", $actions, "productid, image, code, name");
        echo $this->datatables->generate();
    }
	 function getProducts1($warehouse_id = NULL)
    {
		
		
       // $this->sma->checkPermissions('index', TRUE);
        $supplier = $this->input->get('supplier') ? $this->input->get('supplier') : NULL;

        if ((! $this->Owner || ! $this->Admin) && ! $warehouse_id) {
            $user = $this->site->getUser();
            $warehouse_id = $user->warehouse_id;
        }
        $detail_link = anchor('admin/products/view/$1', '<i class="fa fa-file-text-o"></i> ' . lang('product_details'));
        $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line("delete_product") . "</b>' data-content=\"<p>"
            . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete1' id='a__$1' href='" . admin_url('products/delete/$1') . "'>"
            . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
            . lang('delete_product') . "</a>";
        $single_barcode = anchor('admin/products/print_barcodes/$1', '<i class="fa fa-print"></i> ' . lang('print_barcode_label'));
        // $single_label = anchor_popup('products/single_label/$1/' . ($warehouse_id ? $warehouse_id : ''), '<i class="fa fa-print"></i> ' . lang('print_label'), $this->popup_attributes);
        $action = '<div class="text-center"><div class="btn-group text-left">'
            . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
            . lang('actions') . ' <span class="caret"></span></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li>' . $detail_link . '</li>
            <li><a href="' . admin_url('products/add/$1') . '"><i class="fa fa-plus-square"></i> ' . lang('duplicate_product') . '</a></li>
            <li><a href="' . admin_url('products/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_product') . '</a></li>';
       // if ($warehouse_id) {
            $action .= '<li><a href="' . admin_url('products/set_rack/$1/' . $warehouse_id) . '" data-toggle="modal" data-target="#myModal"  data-backdrop="static" data-keyboard="false"><i class="fa fa-bars"></i> '
                . lang('set_rack') . '</a></li>';
       // }
        $action .= '<li><a href="' . base_url() . 'assets/uploads/$2" data-type="image" data-toggle="lightbox"><i class="fa fa-file-photo-o"></i> '
            . lang('view_image') . '</a></li>
            <li>' . $single_barcode . '</li>
            <li class="divider"></li>
            <li>' . $delete_link . '</li>
            </ul>
        </div></div>';
	
	
        if($this->isWarehouse){
            $actions = $action;
        }else if(isStore){
            $actions = '<div class="text-center"><div class="btn-group text-left">'
            . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
            . lang('actions') . ' <span class="caret"></span></button>
        <ul class="dropdown-menu pull-right" role="menu"><li>'.$detail_link.'</li><li><a href="' . base_url() . 'assets/uploads/$2" data-type="image" data-toggle="lightbox"><i class="fa fa-file-photo-o"></i> '
            . lang('view_image') . '</a></li>
            <li>' . $single_barcode . '</li></ul> </div></div>';
        }
	
        $this->load->library('datatables');
        if ($warehouse_id) {
            $this->datatables
            ->select($this->db->dbprefix('products') . ".id as productid, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('brands')}.name as brand, {$this->db->dbprefix('categories')}.name as cname,  {$this->db->dbprefix('units')}.name as unit, wp.rack as rack, alert_quantity, ".$this->db->dbprefix('products') . ".id as stock_r_id,", FALSE)
            ->from('products');
            if ($this->Settings->display_all_products) {
                $this->datatables->join("( SELECT product_id, quantity, rack from {$this->db->dbprefix('warehouses_products')} WHERE warehouse_id = {$warehouse_id}) wp", 'products.id=wp.product_id', 'left');
            } else {
                $this->datatables->join('warehouses_products wp', 'products.id=wp.product_id', 'left')
                ->where('wp.warehouse_id', $warehouse_id)
                ->where('wp.quantity !=', 0);
            }
            $this->datatables->join('categories', 'products.category_id=categories.id', 'left')
            ->join('units', 'products.unit=units.id', 'left')
            ->join('brands', 'products.brand=brands.id', 'left')
			->where('Active',0);
            // ->group_by("products.id");
        } else {
            $this->datatables
                ->select($this->db->dbprefix('products') . ".id as productid, {$this->db->dbprefix('products')}.image as image, {$this->db->dbprefix('products')}.code as code, {$this->db->dbprefix('products')}.name as name, {$this->db->dbprefix('brands')}.name as brand, {$this->db->dbprefix('categories')}.name as cname, {$this->db->dbprefix('units')}.name as unit, '' as rack, alert_quantity, ".$this->db->dbprefix('products') . ".id as stock_r_id,".$this->db->dbprefix('products') . ".id as min_qty,", FALSE)
                ->from('products')
                ->join('categories', 'products.category_id=categories.id', 'left')
                ->join('units', 'products.unit=units.id', 'left')
                ->join('brands', 'products.brand=brands.id', 'left')
				->where('Active',0)
                ->group_by("products.id");
        }
        if (!$this->Owner && !$this->Admin) {
            if (!$this->session->userdata('show_cost')) {
                $this->datatables->unset_column("cost");
            }
            if (!$this->session->userdata('show_price')) {
                $this->datatables->unset_column("price");
            }
        }
        if ($supplier) {
            $this->datatables->where('supplier1', $supplier)
            ->or_where('supplier2', $supplier)
            ->or_where('supplier3', $supplier)
            ->or_where('supplier4', $supplier)
            ->or_where('supplier5', $supplier);
        }
        $this->datatables->add_column("Actions", $actions, "productid, image, code, name");
        echo $this->datatables->generate();
    }
 */

    function add($id = NULL)
    {
    
        $this->load->helper('security');
        $warehouses = $this->site->getAllWarehouses();
		$data['productattributes'] = $this->products_model->getAttribute();
		 $data['Settings'] =$Settings= $this->products_model->getSettings();
        $this->form_validation->set_rules('category', lang("category"), 'required|is_natural_no_zero');
        if ($this->input->post('type') == 'standard') {
            $this->form_validation->set_rules('cost', lang("product_cost"), 'required');
            $this->form_validation->set_rules('unit', lang("product_unit"), 'required');
        }
     //   $this->form_validation->set_rules('code', lang("product_code"), 'is_unique[inv_products.code]|alpha_dash');
        $this->form_validation->set_rules('weight', lang("weight"), 'numeric');
        $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
        $this->form_validation->set_rules('digital_file', lang("digital_file"), 'xss_clean');
        $this->form_validation->set_rules('userfile', lang("product_gallery_images"), 'xss_clean');
		$this->form_validation->set_rules('tax_rate', lang("product_tax"), 'xss_clean');
		
        if ($this->form_validation->run() == true) {
			
			if(!empty($_POST['attribute_properties'])){
				$attr_properties=array();
			foreach($_POST['attribute_properties'] as $pro_attr){
				$attribute_ids=$this->products_model->getAttribute_probyid($pro_attr);
				
				if($pro_attr !=''){
					
				$attr_properties[]=array($attribute_ids=>$pro_attr);
				}
				
			}
			
			  $attribute_value=json_encode($attr_properties);
			}
				
            $tax_rate = $this->input->post('tax_rate') ? $this->site->getTaxRateByID($this->input->post('tax_rate')) : NULL;
            $data = array(
                'code' => $this->input->post('code'),
                'barcode_symbology' => $this->input->post('barcode_symbology'),
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'brand' => $this->input->post('brand'),
                'category_id' => $this->input->post('category'),
                'subcategory_id' => $this->input->post('subcategory') ? $this->input->post('subcategory') : NULL,
				'Attribute_value'=>$attribute_value,
				'CBM'=>$this->sma->formatDecimal($this->input->post('CBM')),
                'cost' => $this->sma->formatDecimal($this->input->post('cost')),
				'mrp' => $this->sma->formatDecimal($this->input->post('mrp')),
                'price' => $this->sma->formatDecimal($this->input->post('price')),
                'unit' => $this->input->post('unit'),
                'sale_unit' => $this->input->post('default_sale_unit'),
                'purchase_unit' => $this->input->post('default_purchase_unit'),
                'tax_rate' => $this->input->post('tax_rate'),
                'tax_method' => $this->input->post('tax_method'),
                'alert_quantity' => $this->input->post('alert_quantity'),
                'track_quantity' => $this->input->post('track_quantity') ? $this->input->post('track_quantity') : '0',
                'details' => $this->input->post('details'),
                'product_details' => $this->input->post('product_details'),
                'supplier1' => $this->input->post('supplier'),
                'supplier1price' => $this->sma->formatDecimal($this->input->post('supplier_price')),
                'supplier2' => $this->input->post('supplier_2'),
                'supplier2price' => $this->sma->formatDecimal($this->input->post('supplier_2_price')),
                'supplier3' => $this->input->post('supplier_3'),
                'supplier3price' => $this->sma->formatDecimal($this->input->post('supplier_3_price')),
                'supplier4' => $this->input->post('supplier_4'),
                'supplier4price' => $this->sma->formatDecimal($this->input->post('supplier_4_price')),
                'supplier5' => $this->input->post('supplier_5'),
                'supplier5price' => $this->sma->formatDecimal($this->input->post('supplier_5_price')),
                'cf1' => $this->input->post('cf1'),
                'cf2' => $this->input->post('cf2'),
                'cf3' => $this->input->post('cf3'),
                'cf4' => $this->input->post('cf4'),
                'cf5' => $this->input->post('cf5'),
                'cf6' => $this->input->post('cf6'),
                'promotion' => $this->input->post('promotion'),
                'promo_price' => $this->sma->formatDecimal($this->input->post('promo_price')),
                'start_date' => $this->input->post('start_date') ? $this->sma->fsd($this->input->post('start_date')) : NULL,
                'end_date' => $this->input->post('end_date') ? $this->sma->fsd($this->input->post('end_date')) : NULL,
                'supplier1_part_no' => $this->input->post('supplier_part_no'),
                'supplier2_part_no' => $this->input->post('supplier_2_part_no'),
                'supplier3_part_no' => $this->input->post('supplier_3_part_no'),
                'supplier4_part_no' => $this->input->post('supplier_4_part_no'),
                'supplier5_part_no' => $this->input->post('supplier_5_part_no'),
                'file' => $this->input->post('file_link'),
                'slug' => $this->input->post('slug'),
                'weight' => $this->input->post('weight'),
				'barcode' => $this->input->post('barcode'),
                'featured' => $this->input->post('featured'),
                'hsn_code' => $this->input->post('hsn_code'),
                'hide' => $this->input->post('hide') ? $this->input->post('hide') : 0,
				'Trans_active' => $this->input->post('TransactionActive') ? $this->input->post('TransactionActive') : 0,
                'second_name' => $this->input->post('second_name'),
				'batch_required' => $this->input->post('batch_required'),		
				'expiry_date_required' => $this->input->post('expiry_date_required'),
				'type_expiry' => $this->input->post('type_expiry') ? $this->input->post('type_expiry') : '',
				'value_expiry' => $this->input->post('value_expiry') ? $this->input->post('value_expiry') : 0,
            );
	    $open_stock = $this->input->post('open_stock') ? $this->input->post('open_stock') : 0;
            $warehouse_qty = NULL;
            $product_attributes = NULL;
            $this->load->library('upload');
            if ($this->input->post('type') == 'standard') {
                $wh_total_quantity = 0;
                $pv_total_quantity = 0;
                for ($s = 2; $s > 5; $s++) {
                    $data['suppliers' . $s] = $this->input->post('supplier_' . $s);
                    $data['suppliers' . $s . 'price'] = $this->input->post('supplier_' . $s . '_price');
                }
				
			
                foreach ($warehouses as $warehouse) {
                    if ($this->input->post('wh_qty_' . $warehouse->id)) {
                        $warehouse_qty[] = array(
                            'warehouse_id' => $this->input->post('wh_' . $warehouse->id),
                            'quantity' => $this->input->post('wh_qty_' . $warehouse->id),
                            'rack' => $this->input->post('rack_' . $warehouse->id) ? $this->input->post('rack_' . $warehouse->id) : NULL
                        );
                        $wh_total_quantity += $this->input->post('wh_qty_' . $warehouse->id);
                    }
                }
                if ($this->input->post('attributes')) {
                    $a = sizeof($_POST['attr_name']);
                    for ($r = 0; $r <= $a; $r++) {
                        if (isset($_POST['attr_name'][$r])) {
                            $product_attributes[] = array(
                                'name' => $_POST['attr_name'][$r],
                                'warehouse_id' => $_POST['attr_warehouse'][$r],
                                'quantity' => $_POST['attr_quantity'][$r],
                                'price' => $_POST['attr_price'][$r],
                            );
                            $pv_total_quantity += $_POST['attr_quantity'][$r];
                        }
                    }
                } else {
                    $product_attributes = NULL;
                }
                if ($wh_total_quantity != $pv_total_quantity && $pv_total_quantity != 0) {
                    $this->form_validation->set_rules('wh_pr_qty_issue', 'wh_pr_qty_issue', 'required');
                    $this->form_validation->set_message('required', lang('wh_pr_qty_issue'));
                }
            }

            if ($this->input->post('type') == 'service') {
                $data['track_quantity'] = 0;
            } elseif ($this->input->post('type') == 'combo') {
                $total_price = 0;
                $c = sizeof($_POST['combo_item_code']) - 1;
                for ($r = 0; $r <= $c; $r++) {
                    if (isset($_POST['combo_item_code'][$r]) && isset($_POST['combo_item_quantity'][$r]) && isset($_POST['combo_item_price'][$r])) {
                        $items[] = array(
                            'item_code' => $_POST['combo_item_code'][$r],
                            'quantity' => $_POST['combo_item_quantity'][$r],
                            'unit_price' => $_POST['combo_item_price'][$r],
                        );
                    }
                    $total_price += $_POST['combo_item_price'][$r] * $_POST['combo_item_quantity'][$r];
                }
                if ($this->sma->formatDecimal($total_price) != $this->sma->formatDecimal($this->input->post('price'))) {
                    $this->form_validation->set_rules('combo_price', 'combo_price', 'required');
                    $this->form_validation->set_message('required', lang('pprice_not_match_ciprice'));
                }
                $data['track_quantity'] = 0;
            } elseif ($this->input->post('type') == 'digital') {
                if ($_FILES['digital_file']['size'] > 0) {
                    $config['upload_path'] = $this->digital_upload_path;
                    $config['allowed_types'] = $this->digital_file_types;
                    $config['max_size'] = $this->allowed_file_size;
                    $config['overwrite'] = FALSE;
                    $config['encrypt_name'] = TRUE;
                    $config['max_filename'] = 25;
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('digital_file')) {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect("admin/procurment/products/add");
                    }
                    $file = $this->upload->file_name;
                    $data['file'] = $file;
                } else {
                    if (!$this->input->post('file_link')) {
                        $this->form_validation->set_rules('digital_file', lang("digital_file"), 'required');
                    }
                }
                $config = NULL;
                $data['track_quantity'] = 0;
            }
            if (!isset($items)) {
                $items = NULL;
            }
            if ($_FILES['product_image']['size'] > 0) {
                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $Settings->iwidth;
                $config['max_height'] = $Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['max_filename'] = 25;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect("admin/procurment/products/add");
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $Settings->twidth;
                $config['height'] = $Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }

            if ($_FILES['userfile']['name'][0] != "") {
                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $Settings->iwidth;
                $config['max_height'] = $Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $config['max_filename'] = 25;
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload()) {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                       redirect("admin/procurment/products/add");
                    } else {
                        $pho = $this->upload->file_name;
                        $photos[] = $pho;
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $this->upload_path . $pho;
                        $config['new_image'] = $this->thumbs_path . $pho;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = $Settings->twidth;
                        $config['height'] = $Settings->theight;
                        $this->image_lib->initialize($config);
                        if (!$this->image_lib->resize()) {
                            echo $this->image_lib->display_errors();
                        }
                        if ($Settings->watermark) {
                            $this->image_lib->clear();
                            $wm['source_image'] = $this->upload_path . $pho;
                            $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $Settings->site_name;
                            $wm['wm_type'] = 'text';
                            $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                            $wm['quality'] = '100';
                            $wm['wm_font_size'] = '16';
                            $wm['wm_font_color'] = '999999';
                            $wm['wm_shadow_color'] = 'CCCCCC';
                            $wm['wm_vrt_alignment'] = 'top';
                            $wm['wm_hor_alignment'] = 'left';
                            $wm['wm_padding'] = '10';
                            $this->image_lib->initialize($wm);
                            $this->image_lib->watermark();
                        }

                        $this->image_lib->clear();
                    }
                }
                $config = NULL;
            } else {
                $photos = NULL;
            }
            $data['quantity'] = isset($wh_total_quantity) ? $wh_total_quantity : 0;
            // $this->sma->print_arrays($data, $warehouse_qty, $product_attributes);
			
			/* echo '<pre>';
			print_r($data);
			die; */
        }

      if ($this->form_validation->run() == true && $this->products_model->addProduct($data, $items, $warehouse_qty, $product_attributes, $photos,$open_stock)) {
            $this->session->set_flashdata('message', lang("product_added"));
             redirect("admin/procurment/products");
        } else {
            $data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $data['categories'] = $this->site->getAllCategories();
            $data['tax_rates'] = $this->site->getAllTaxRates();
            $data['brands'] = $this->site->getAllBrands();
            $data['base_units'] = $this->site->getAllBaseUnits();
            $data['warehouses'] =  $this->site->getAllWarehouses();
            $data['warehouses_products'] = $id ? $this->products_model->getAllWarehousesWithPQ($id) : NULL;
            $data['product'] = $id ? $this->products_model->getProductByID($id) : NULL;
            $data['variants'] = $this->products_model->getAllVariants();
			$data['Settings'] =$Settings= $this->products_model->getSettings();
            $data['combo_items'] = ($id && $this->data['product']->type == 'combo') ? $this->products_model->getProductComboItems($id) : NULL;
            $data['product_options'] = $id ? $this->products_model->getProductOptionsWithWH($id) : NULL;
            $this->render_admin('procurment/products/add', $data);
        } 
    }
	
    function suggestions()
    {
        $term = $this->input->get('term', TRUE);
        if (strlen($term) < 1 || !$term) {
            die("<script type='text/javascript'>setTimeout(function(){ window.top.location.href = '" . admin_url('welcome') . "'; }, 10);</script>");
        }

        $rows = $this->products_model->getProductNames($term);
        if ($rows) {
            foreach ($rows as $row) {
                $pr[] = array('id' => $row->id, 'label' => $row->name . " (" . $row->code . ")", 'code' => $row->code, 'name' => $row->name, 'price' => $row->price, 'qty' => 1);
            }
            $this->sma->send_json($pr);
        } else {
            $this->sma->send_json(array(array('id' => 0, 'label' => lang('no_match_found'), 'value' => $term)));
        }
    }

    function get_suggestions()
    {
        $term = $this->input->get('term', TRUE);
        if (strlen($term) < 1 || !$term) {
            die("<script type='text/javascript'>setTimeout(function(){ window.top.location.href = '" . admin_url('welcome') . "'; }, 10);</script>");
        }

        $rows = $this->products_model->getProductsForPrinting($term);
        if ($rows) {
            foreach ($rows as $row) {
                $variants = $this->products_model->getProductOptions($row->id);
                $pr[] = array('id' => $row->id, 'label' => $row->name . " (" . $row->code . ")", 'code' => $row->code, 'name' => $row->name, 'price' => $row->price, 'qty' => 1, 'variants' => $variants);
            }
            $this->sma->send_json($pr);
        } else {
            $this->sma->send_json(array(array('id' => 0, 'label' => lang('no_match_found'), 'value' => $term)));
        }
    }
/*
    function addByAjax()
    {
        if (!$this->mPermissions('add')) {
            exit(json_encode(array('msg' => lang('access_denied'))));
        }
        if ($this->input->get('token') && $this->input->get('token') == $this->session->userdata('user_csrf') && $this->input->is_ajax_request()) {
            $product = $this->input->get('product');
            if (!isset($product['code']) || empty($product['code'])) {
                exit(json_encode(array('msg' => lang('product_code_is_required'))));
            }
            if (!isset($product['name']) || empty($product['name'])) {
                exit(json_encode(array('msg' => lang('product_name_is_required'))));
            }
            if (!isset($product['category_id']) || empty($product['category_id'])) {
                exit(json_encode(array('msg' => lang('product_category_is_required'))));
            }
            if (!isset($product['unit']) || empty($product['unit'])) {
                exit(json_encode(array('msg' => lang('product_unit_is_required'))));
            }
            if (!isset($product['price']) || empty($product['price'])) {
                exit(json_encode(array('msg' => lang('product_price_is_required'))));
            }
            if (!isset($product['cost']) || empty($product['cost'])) {
                exit(json_encode(array('msg' => lang('product_cost_is_required'))));
            }
            if ($this->products_model->getProductByCode($product['code'])) {
                exit(json_encode(array('msg' => lang('product_code_already_exist'))));
            }
            if ($row = $this->products_model->addAjaxProduct($product)) {
                $tax_rate = $this->site->getTaxRateByID($row->tax_rate);
                $pr = array('id' => $row->id, 'label' => $row->name . " (" . $row->code . ")", 'code' => $row->code, 'qty' => 1, 'cost' => $row->cost, 'name' => $row->name, 'tax_method' => $row->tax_method, 'tax_rate' => $tax_rate, 'discount' => '0');
                $this->sma->send_json(array('msg' => 'success', 'result' => $pr));
            } else {
                exit(json_encode(array('msg' => lang('failed_to_add_product'))));
            }
        } else {
            json_encode(array('msg' => 'Invalid token'));
        }

    }
*/
   

    function edit($id = NULL)
    {
       
        $this->load->helper('security');
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
        }
		 $data['Settings'] =$Settings= $this->products_model->getSettings();
		$data['pathupload'] =$this->upload_path;
		
        $warehouses = $this->site->getAllWarehouses();
        $warehouses_products = $this->products_model->getAllWarehousesWithPQ($id);
        $product = $this->site->getProductByID($id);
		$data['productattributes'] = $this->products_model->getAttribute();
        if (!$id || !$product) {
            $this->session->set_flashdata('error', lang('prduct_not_found'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
		
        $this->form_validation->set_rules('category', lang("category"), 'required|is_natural_no_zero');
        if ($this->input->post('type') == 'standard') {
            $this->form_validation->set_rules('cost', lang("product_cost"), 'required');
            $this->form_validation->set_rules('unit', lang("product_unit"), 'required');
        }
        $this->form_validation->set_rules('code', lang("product_code"), 'alpha_dash');
        if ($this->input->post('code') !== $product->code) {
            $this->form_validation->set_rules('code', lang("product_code"), 'is_unique[products.code]');
        }
        /* if (SHOP) {
            $this->form_validation->set_rules('slug', lang("slug"), 'required|alpha_dash');
            if ($this->input->post('slug') !== $product->slug) {
                $this->form_validation->set_rules('slug', lang("slug"), 'required|is_unique[products.slug]|alpha_dash');
            }
        } */
        $this->form_validation->set_rules('weight', lang("weight"), 'numeric');
        $this->form_validation->set_rules('product_image', lang("product_image"), 'xss_clean');
        $this->form_validation->set_rules('digital_file', lang("digital_file"), 'xss_clean');
        $this->form_validation->set_rules('userfile', lang("product_gallery_images"), 'xss_clean');

        if ($this->form_validation->run('products/add') == true) {
			if(!empty($_POST['attribute_properties'])){
				$attr_properties=array();
			foreach($_POST['attribute_properties'] as $pro_attr){
				$attribute_ids=$this->products_model->getAttribute_probyid($pro_attr);
				if($pro_attr !=''){
				$attr_properties[]=array($attribute_ids=>$pro_attr);
				}
			}
			  $attribute_value=json_encode($attr_properties);
			}
			
		
            $data = array('code' => $this->input->post('code'),
                'barcode_symbology' => $this->input->post('barcode_symbology'),
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'brand' => $this->input->post('brand'),
                'category_id' => $this->input->post('category'),
                'subcategory_id' => $this->input->post('subcategory') ? $this->input->post('subcategory') : NULL,
                'cost' => $this->sma->formatDecimal($this->input->post('cost')),
		'mrp' => $this->sma->formatDecimal($this->input->post('mrp')),
                'price' => $this->sma->formatDecimal($this->input->post('price')),
				'Attribute_value'=>$attribute_value,
				'CBM'=>$this->sma->formatDecimal($this->input->post('CBM')),
                'unit' => $this->input->post('unit'),
                'sale_unit' => $this->input->post('default_sale_unit'),
                'purchase_unit' => $this->input->post('default_purchase_unit'),
                'tax_rate' => $this->input->post('tax_rate'),
                'tax_method' => $this->input->post('tax_method'),
                'alert_quantity' => $this->input->post('alert_quantity'),
                'track_quantity' => $this->input->post('track_quantity') ? $this->input->post('track_quantity') : '0',
                'details' => $this->input->post('details'),
                'product_details' => $this->input->post('product_details'),
                'supplier1' => $this->input->post('supplier'),
                'supplier1price' => $this->sma->formatDecimal($this->input->post('supplier_price')),
                'supplier2' => $this->input->post('supplier_2'),
                'supplier2price' => $this->sma->formatDecimal($this->input->post('supplier_2_price')),
                'supplier3' => $this->input->post('supplier_3'),
                'supplier3price' => $this->sma->formatDecimal($this->input->post('supplier_3_price')),
                'supplier4' => $this->input->post('supplier_4'),
                'supplier4price' => $this->sma->formatDecimal($this->input->post('supplier_4_price')),
                'supplier5' => $this->input->post('supplier_5'),
                'supplier5price' => $this->sma->formatDecimal($this->input->post('supplier_5_price')),
                'cf1' => $this->input->post('cf1'),
                'cf2' => $this->input->post('cf2'),
                'cf3' => $this->input->post('cf3'),
                'cf4' => $this->input->post('cf4'),
                'cf5' => $this->input->post('cf5'),
                'cf6' => $this->input->post('cf6'),
                'promotion' => $this->input->post('promotion'),
                'promo_price' => $this->sma->formatDecimal($this->input->post('promo_price')),
                'start_date' => $this->input->post('start_date') ? $this->sma->fsd($this->input->post('start_date')) : NULL,
                'end_date' => $this->input->post('end_date') ? $this->sma->fsd($this->input->post('end_date')) : NULL,
                'supplier1_part_no' => $this->input->post('supplier_part_no'),
                'supplier2_part_no' => $this->input->post('supplier_2_part_no'),
                'supplier3_part_no' => $this->input->post('supplier_3_part_no'),
                'supplier4_part_no' => $this->input->post('supplier_4_part_no'),
                'supplier5_part_no' => $this->input->post('supplier_5_part_no'),
                'slug' => $this->input->post('slug'),
                'weight' => $this->input->post('weight'),
				'barcode' => $this->input->post('barcode'),
                'featured' => $this->input->post('featured'),
                'hsn_code' => $this->input->post('hsn_code'),
                'hide' => $this->input->post('hide') ? $this->input->post('hide') : 0,
                'second_name' => $this->input->post('second_name'),
				
				'batch_required' => $this->input->post('batch_required'),		
				'expiry_date_required' => $this->input->post('expiry_date_required'),
				'type_expiry' => $this->input->post('type_expiry') ? $this->input->post('type_expiry') : '',
				'value_expiry' => $this->input->post('value_expiry') ? $this->input->post('value_expiry') : 0,
            );
			
            $warehouse_qty = NULL;
            $product_attributes = NULL;
            $update_variants = array();
            $this->load->library('upload');
            if ($this->input->post('type') == 'standard') {
				
                if ($product_variants = $this->products_model->getProductOptions($id)) {
					
                    foreach ($product_variants as $pv) {
                        $update_variants[] = array(
                            'id' => $this->input->post('variant_id_'.$pv->id),
                            'name' => $this->input->post('variant_name_'.$pv->id),
                            'cost' => $this->input->post('variant_cost_'.$pv->id),
                            'price' => $this->input->post('variant_price_'.$pv->id),
                        );
                    }
                }
				
                for ($s = 2; $s > 5; $s++) {
                    $data['suppliers' . $s] = $this->input->post('supplier_' . $s);
                    $data['suppliers' . $s . 'price'] = $this->input->post('supplier_' . $s . '_price');
                }
                foreach ($warehouses as $warehouse) {
                    $warehouse_qty[] = array(
                        'warehouse_id' => $this->input->post('wh_' . $warehouse->id),
                        'rack' => $this->input->post('rack_' . $warehouse->id) ? $this->input->post('rack_' . $warehouse->id) : NULL
                    );
                }

                if ($this->input->post('attributes')) {
                    $a = sizeof($_POST['attr_name']);
                    for ($r = 0; $r <= $a; $r++) {
                        if (isset($_POST['attr_name'][$r])) {
                            if ($product_variatnt = $this->products_model->getPrductVariantByPIDandName($id, trim($_POST['attr_name'][$r]))) {
                                $this->form_validation->set_message('required', lang("product_already_has_variant").' ('.$_POST['attr_name'][$r].')');
                                $this->form_validation->set_rules('new_product_variant', lang("new_product_variant"), 'required');
                            } else {
                                $product_attributes[] = array(
                                    'name' => $_POST['attr_name'][$r],
                                    'warehouse_id' => $_POST['attr_warehouse'][$r],
                                    'quantity' => $_POST['attr_quantity'][$r],
                                    'price' => $_POST['attr_price'][$r],
                                );
                            }
                        }
                    }

                } else {
                    $product_attributes = NULL;
                }

            }

            if ($this->input->post('type') == 'service') {
                $data['track_quantity'] = 0;
            } elseif ($this->input->post('type') == 'combo') {
                $total_price = 0;
                $c = sizeof($_POST['combo_item_code']) - 1;
                for ($r = 0; $r <= $c; $r++) {
                    if (isset($_POST['combo_item_code'][$r]) && isset($_POST['combo_item_quantity'][$r]) && isset($_POST['combo_item_price'][$r])) {
                        $items[] = array(
                            'item_code' => $_POST['combo_item_code'][$r],
                            'quantity' => $_POST['combo_item_quantity'][$r],
                            'unit_price' => $_POST['combo_item_price'][$r],
                        );
                    }
                    $total_price += $_POST['combo_item_price'][$r] * $_POST['combo_item_quantity'][$r];
                }
                if ($this->sma->formatDecimal($total_price) != $this->sma->formatDecimal($this->input->post('price'))) {
                    $this->form_validation->set_rules('combo_price', 'combo_price', 'required');
                    $this->form_validation->set_message('required', lang('pprice_not_match_ciprice'));
                }
                $data['track_quantity'] = 0;
            } elseif ($this->input->post('type') == 'digital') {
                if ($this->input->post('file_link')) {
                    $data['file'] = $this->input->post('file_link');
                }
                if ($_FILES['digital_file']['size'] > 0) {
                    $config['upload_path'] = $this->digital_upload_path;
                    $config['allowed_types'] = $this->digital_file_types;
                    $config['max_size'] = $this->allowed_file_size;
                    $config['overwrite'] = FALSE;
                    $config['encrypt_name'] = TRUE;
                    $config['max_filename'] = 25;
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('digital_file')) {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                       redirect("admin/procurment/products/add");
                    }
                    $file = $this->upload->file_name;
                    $data['file'] = $file;
                }
                $config = NULL;
                $data['track_quantity'] = 0;
            }
            if (!isset($items)) {
                $items = NULL;
            }
            if ($_FILES['product_image']['size'] > 0) {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $Settings->iwidth;
                $config['max_height'] = $Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $config['max_filename'] = 25;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('product_image')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect("admin/procurment/products/edit/" . $id);
					
                }
                $photo = $this->upload->file_name;
                $data['image'] = $photo;
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload_path . $photo;
                $config['new_image'] = $this->thumbs_path . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = $Settings->twidth;
                $config['height'] = $Settings->theight;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                if ($Settings->watermark) {
                    $this->image_lib->clear();
                    $wm['source_image'] = $this->upload_path . $photo;
                    $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $Settings->site_name;
                    $wm['wm_type'] = 'text';
                    $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                    $wm['quality'] = '100';
                    $wm['wm_font_size'] = '16';
                    $wm['wm_font_color'] = '999999';
                    $wm['wm_shadow_color'] = 'CCCCCC';
                    $wm['wm_vrt_alignment'] = 'top';
                    $wm['wm_hor_alignment'] = 'left';
                    $wm['wm_padding'] = '10';
                    $this->image_lib->initialize($wm);
                    $this->image_lib->watermark();
                }
                $this->image_lib->clear();
                $config = NULL;
            }

            if ($_FILES['userfile']['name'][0] != "") {

                $config['upload_path'] = $this->upload_path;
                $config['allowed_types'] = $this->image_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['max_width'] = $Settings->iwidth;
                $config['max_height'] = $Settings->iheight;
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $config['max_filename'] = 25;
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
                for ($i = 0; $i < $cpt; $i++) {

                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload()) {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect("admin/procurment/products/edit/" . $id);
                    } else {
                        $pho = $this->upload->file_name;
                        $photos[] = $pho;
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $this->upload_path . $pho;
                        $config['new_image'] = $this->thumbs_path . $pho;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = $Settings->twidth;
                        $config['height'] = $Settings->theight;
                        $this->image_lib->initialize($config);
                        if (!$this->image_lib->resize()) {
                            echo $this->image_lib->display_errors();
                        }

                        if ($Settings->watermark) {
                            $this->image_lib->clear();
                            $wm['source_image'] = $this->upload_path . $pho;
                            $wm['wm_text'] = 'Copyright ' . date('Y') . ' - ' . $Settings->site_name;
                            $wm['wm_type'] = 'text';
                            $wm['wm_font_path'] = 'system/fonts/texb.ttf';
                            $wm['quality'] = '100';
                            $wm['wm_font_size'] = '16';
                            $wm['wm_font_color'] = '999999';
                            $wm['wm_shadow_color'] = 'CCCCCC';
                            $wm['wm_vrt_alignment'] = 'top';
                            $wm['wm_hor_alignment'] = 'left';
                            $wm['wm_padding'] = '10';
                            $this->image_lib->initialize($wm);
                            $this->image_lib->watermark();
                        }

                        $this->image_lib->clear();
                    }
                }
                $config = NULL;
            } else {
                $photos = NULL;
            }
            $data['quantity'] = isset($wh_total_quantity) ? $wh_total_quantity : 0;
            // $this->sma->print_arrays($data, $warehouse_qty, $update_variants, $product_attributes, $photos, $items);
        }
        if ($this->form_validation->run() == true && $this->products_model->updateProduct($id, $data, $items, $warehouse_qty, $product_attributes, $photos, $update_variants)) {
            $this->session->set_flashdata('message', lang("product_updated"));
            redirect("admin/procurment/products/" );
        } else {
             $data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $data['categories'] = $this->site->getAllCategories();
            $data['tax_rates'] = $this->site->getAllTaxRates();
            $data['brands'] = $this->site->getAllBrands();
            $data['base_units'] = $this->site->getAllBaseUnits();
            $data['warehouses'] = $warehouses;
            $data['warehouses_products'] = $id ? $this->products_model->getAllWarehousesWithPQ($id) : NULL;
            $data['product'] = $id ? $this->products_model->getProductByID($id) : NULL;
            $data['variants'] = $this->products_model->getAllVariants();
			$data['subunits'] = $this->site->getUnitsByBUID($product->unit);
            $data['product_variants'] = $this->products_model->getProductOptions($id);
            $data['combo_items'] = $product->type == 'combo' ? $this->products_model->getProductComboItems($product->id) : NULL;
			$data['Settings'] =$Settings= $this->products_model->getSettings();
          //  $data['combo_items'] = ($id && $this->data['product']->type == 'combo') ? $this->products_model->getProductComboItems($id) : NULL;
            $data['product_options'] = $id ? $this->products_model->getProductOptionsWithWH($id) : NULL;
             $this->render_admin('procurment/products/edit', $data);
        }
    }

    /* ---------------------------------------------------------------- */
/*
    function import_csv()
    {
	ini_set('max_execution_time', 300000);
	$product_cnt = 0;
        $this->sma->checkPermissions('csv');
        $this->load->helper('security');
        $this->form_validation->set_rules('userfile', lang("upload_file"), 'xss_clean');
		$warehouses = $this->site->getAllWarehouses();
        if ($this->form_validation->run() == true) {
            if (isset($_FILES["userfile"])) {
                $this->load->library('upload');
                $config['upload_path'] = $this->digital_upload_path;
                $config['allowed_types'] = 'csv';
                //$config['max_size'] = $this->allowed_file_size;
                $config['overwrite'] = TRUE;
                $config['encrypt_name'] = TRUE;
                $config['max_filename'] = 25;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/import_csv");
                }
                $csv = $this->upload->file_name;
                $arrResult = array();
                $handle = fopen($this->digital_upload_path . $csv, "r");
                if ($handle) {
                    while (($row = fgetcsv($handle, 5000, ",")) !== FALSE) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                $titles = array_shift($arrResult);
                $keys = array('code','barcode','name','ProductType','barcode_symbology','category','subcategory','brand', 'product_unit','sale_unit', 'purchase_unit', 'cost', 'price','open_stock', 'alert_quantity', 'tax_rate','tax_method','variants', 'second_name');
                $final = array();
/* 				print_r($arrResult);
				echo '<br>';
				echo '<br>';
				echo '<br>';
				echo '<br>';
				print_r($keys);
				die(); 
                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }
                // $this->sma->print_arrays($final);
                $rw = 2; $items = array();
		
                foreach ($final as $csv_pr) {
                  //  if (!$this->products_model->getProductByCode(trim($csv_pr['code']))) {
                        if ($catd  = $this->products_model->getCategoryByName(trim($csv_pr['category']))) {
			    $prsubcat = $this->products_model->getSubCategoryByName(trim($csv_pr['subcategory']), $catd->id);
                            $brand = $this->products_model->getBrandByName(trim($csv_pr['brand']));
                            $unit  = $this->products_model->getUnitByCode(trim($csv_pr['product_unit']));
			   
                            $base_unit = $unit ? $unit->id : NULL;
                            $sale_unit = $base_unit;
                            $purcahse_unit = $base_unit;
                            if($base_unit){
                                $units = $this->products_model->getUnitsByBUID($base_unit);
                                foreach ($units as $u) {
                                    if ($u->code == trim($csv_pr['sale_unit'])) {
                                        $sale_unit = $u->id;
                                    }
                                    if ($u->code == trim($csv_pr['purchase_unit'])) {
                                        $purcahse_unit = $u->id;
                                    }
                                }
                            } else {
							
                                $this->session->set_flashdata('error', lang("check_unit") . " (" . $csv_pr['unit'] . "). " . lang("unit_code_x_exist") . " " . lang("line_no") . " " . $rw);
                                admin_redirect("products/import_csv");
                            }

                            $tax_details = $this->products_model->getTaxRateByName(trim($csv_pr['tax_rate']));
                            
                            $items[] = array (
                                'code' => trim($csv_pr['code']),
                                'name' => trim($csv_pr['name']),
				'barcode' => trim($csv_pr['barcode']),
				'type'=>mb_strtolower(trim($csv_pr['ProductType'])),
				'barcode_symbology' => mb_strtolower(trim($csv_pr['barcode_symbology']), 'UTF-8'),
                                'category_id' => $catd->id,
                                'subcategory_id' => ($prsubcat ? $prsubcat->id : NULL),
                                'brand' => ($brand ? $brand->id : NULL),
                                'unit' => $base_unit,
				'image'=>'no_image.png',
                                'sale_unit' => $sale_unit,
                                'purchase_unit' => $purcahse_unit,
                                'cost' => trim($csv_pr['cost']),
                                'price' => trim($csv_pr['price']),
                                'alert_quantity' => trim($csv_pr['alert_quantity']),
                                'tax_rate' => ($tax_details ? $tax_details->id : NULL),
                                'tax_method' => ($csv_pr['tax_method'] == 'exclusive' ? 1 : 0),
                                
                                'variants' => trim($csv_pr['variants']),
								 //'quantity' => trim($csv_pr['Quantity']),
								 'track_quantity'=>0,
								 'image'=>'no_image.png',
                                //'image' => trim($csv_pr['image']),
                                //'cf1' => trim($csv_pr['cf1']),
                                //'cf2' => trim($csv_pr['cf2']),
                                //'cf3' => trim($csv_pr['cf3']),
                                //'cf4' => trim($csv_pr['cf4']),
                                //'cf5' => trim($csv_pr['cf5']),
                                //'cf6' => trim($csv_pr['cf6']),
                                'hsn_code' => trim($csv_pr['hsn_code']),
                                'second_name' => trim($csv_pr['second_name']),
				'stock'=>trim($csv_pr['open_stock']),
                                );
                        } else {
			    var_dump($catd);
                           $this->session->set_flashdata('error', lang("check_category") . " (" . $csv_pr['category'] . "). " . lang("category_x_exist") . " " . lang("line_no") . " " . $rw);
                            admin_redirect("products/import_csv");
                        }
                  // }

                    $rw++;$product_cnt++;
                }
            }
	    //p($items,1);
            //echo 55; $this->sma->print_arrays($warehouses);exit;
        }

        if ($this->form_validation->run() == true && $prs = $this->products_model->add_products($items,$warehouses)) {
            $this->session->set_flashdata('message', sprintf(lang("products_added"), $product_cnt));
            admin_redirect('products');
        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['userfile'] = array('name' => 'userfile',
                'id' => 'userfile',
                'type' => 'text',
                'value' => $this->form_validation->set_value('userfile')
            );

            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('import_products_by_csv')));
            $meta = array('page_title' => lang('import_products_by_csv'), 'bc' => $bc);
            $this->page_construct('products/import_csv', $meta, $this->data);

        }
    }

    /* ------------------------------------------------------------------ 

    function update_price()
    {
        $this->sma->checkPermissions('csv');
        $this->load->helper('security');
        $this->form_validation->set_rules('userfile', lang("upload_file"), 'xss_clean');

        if ($this->form_validation->run() == true) {

            if (DEMO) {
                $this->session->set_flashdata('message', lang("disabled_in_demo"));
                admin_redirect('welcome');
            }

            if (isset($_FILES["userfile"])) {

                $this->load->library('upload');
                $config['upload_path'] = $this->digital_upload_path;
                $config['allowed_types'] = 'csv';
                $config['max_size'] = $this->allowed_file_size;
                $config['overwrite'] = TRUE;
                $config['encrypt_name'] = TRUE;
                $config['max_filename'] = 25;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products");
                }

                $csv = $this->upload->file_name;

                $arrResult = array();
                $handle = fopen($this->digital_upload_path . $csv, "r");
                if ($handle) {
                    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                $titles = array_shift($arrResult);

                $keys = array('code', 'price');

                $final = array();

                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }
                $rw = 2;
                foreach ($final as $csv_pr) {
                    if (!$this->products_model->getProductByCode(trim($csv_pr['code']))) {
                        $this->session->set_flashdata('message', lang("check_product_code") . " (" . $csv_pr['code'] . "). " . lang("code_x_exist") . " " . lang("line_no") . " " . $rw);
                        admin_redirect("products");
                    }
                    $rw++;
                }
            }

        } elseif ($this->input->post('update_price')) {
            $this->session->set_flashdata('error', validation_errors());
            admin_redirect("system_settings/group_product_prices/".$group_id);
        }

        if ($this->form_validation->run() == true && !empty($final)) {
            $this->products_model->updatePrice($final);
            $this->session->set_flashdata('message', lang("price_updated"));
            admin_redirect('products');
        } else {

            $this->data['userfile'] = array('name' => 'userfile',
                'id' => 'userfile',
                'type' => 'text',
                'value' => $this->form_validation->set_value('userfile')
            );
            $this->data['modal_js'] = $this->site->modal_js();
            $this->load->view($this->theme.'products/update_price', $this->data);

        }
    }

    /* -------------------------------------------------------------------------------

    function delete($id = NULL)
    {
        $this->sma->checkPermissions(NULL, TRUE);

        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->products_model->deleteProduct($id)) {
            if($this->input->is_ajax_request()) {
                $this->sma->send_json(array('error' => 0, 'msg' => lang("product_deleted")));
            }
            $this->session->set_flashdata('message', lang('product_deleted'));
            admin_redirect('welcome');
        }

    }

    /* ----------------------------------------------------------------------------- 

    function quantity_adjustments($warehouse_id = NULL)
    {
        $this->sma->checkPermissions('adjustments');

        if ($this->Owner || $this->Admin || !$this->session->userdata('warehouse_id')) {
            $this->data['warehouses'] = $this->site->getAllWarehouses();
            $this->data['warehouse'] = $warehouse_id ? $this->site->getWarehouseByID($warehouse_id) : null;
        } else {
            $this->data['warehouses'] = null;
            $this->data['warehouse'] = $this->session->userdata('warehouse_id') ? $this->site->getWarehouseByID($this->session->userdata('warehouse_id')) : null;
        }

        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('quantity_adjustments')));
        $meta = array('page_title' => lang('quantity_adjustments'), 'bc' => $bc);
        $this->page_construct('products/quantity_adjustments', $meta, $this->data);
    }

    function getadjustments($warehouse_id = NULL)
    {
        $this->sma->checkPermissions('adjustments');

        /*$delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line("delete_adjustment") . "</b>' data-content=\"<p>"
            . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . admin_url('products/delete_adjustment/$1') . "'>"
            . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i></a>";

$delete_link='';

        $this->load->library('datatables');
        $this->datatables
            ->select("{$this->db->dbprefix('adjustments')}.id as id, date, reference_no, warehouses.name as wh_name, CONCAT({$this->db->dbprefix('users')}.first_name, ' ', {$this->db->dbprefix('users')}.last_name) as created_by, note, attachment")
            ->from('adjustments')
            ->join('warehouses', 'warehouses.id=adjustments.warehouse_id', 'left')
            ->join('users', 'users.id=adjustments.created_by', 'left')
            ->group_by("adjustments.id");
            if ($warehouse_id) {
                $this->datatables->where('adjustments.warehouse_id', $warehouse_id);
            }
        $this->datatables->add_column("Actions", "<div class='text-center'><a href='" . admin_url('products/edit_adjustment/$1') . "' class='tip' title='" . lang("edit_adjustment") . "'><i class='fa fa-edit'></i></a> " . $delete_link . "</div>", "id");

        echo $this->datatables->generate();

    }

    public function view_adjustment($id)
    {
        $this->sma->checkPermissions('adjustments', TRUE);

        $adjustment = $this->products_model->getAdjustmentByID($id);
        if (!$id || !$adjustment) {
            $this->session->set_flashdata('error', lang('adjustment_not_found'));
            $this->sma->md();
        }
        $this->data['inv'] = $adjustment;
        $this->data['rows'] = $this->products_model->getAdjustmentItems($id);
        $this->data['created_by'] = $this->site->getUser($adjustment->created_by);
        $this->data['updated_by'] = $this->site->getUser($adjustment->updated_by);
        $this->data['warehouse'] = $this->site->getWarehouseByID($adjustment->warehouse_id);
        $this->load->view($this->theme.'products/view_adjustment', $this->data);
    }

    function add_adjustment($count_id = NULL)
    {
        $this->sma->checkPermissions('adjustments', true);
        $this->form_validation->set_rules('warehouse', lang("warehouse"), 'required');

        if ($this->form_validation->run() == true) {

            if ($this->Owner || $this->Admin) {
                $date = $this->sma->fld($this->input->post('date'));
            } else {
                $date = date('Y-m-d H:s:i');
            }
            $reference_no = $this->input->post('reference_no') ? $this->input->post('reference_no') : $this->site->getReference('qa');
            $warehouse_id = $this->input->post('warehouse');
            $note = $this->sma->clear_tags($this->input->post('note'));

            $i = isset($_POST['product_id']) ? sizeof($_POST['product_id']) : 0;
            for ($r = 0; $r < $i; $r++) {
                $product_id = $_POST['product_id'][$r];
                $type = $_POST['type'][$r];
                $quantity = $_POST['quantity'][$r];
                $serial = $_POST['serial'][$r];
                $variant = isset($_POST['variant'][$r]) && !empty($_POST['variant'][$r]) ? $_POST['variant'][$r] : NULL;

                if (!$this->Settings->overselling && $type == 'subtraction') {
                    if ($variant) {
                        if($op_wh_qty = $this->products_model->getProductWarehouseOptionQty($variant, $warehouse_id)) {
                            if ($op_wh_qty->quantity < $quantity) {
                                $this->session->set_flashdata('error', lang('warehouse_option_qty_is_less_than_damage'));
                                redirect($_SERVER["HTTP_REFERER"]);
                            }
                        } else {
                            $this->session->set_flashdata('error', lang('warehouse_option_qty_is_less_than_damage'));
                            redirect($_SERVER["HTTP_REFERER"]);
                        }
                    }
                    if($wh_qty = $this->products_model->getProductQuantity($product_id, $warehouse_id)) {
                        if ($wh_qty['quantity'] < $quantity) {
                            $this->session->set_flashdata('error', lang('warehouse_qty_is_less_than_damage'));
                            redirect($_SERVER["HTTP_REFERER"]);
                        }
                    } else {
                        $this->session->set_flashdata('error', lang('warehouse_qty_is_less_than_damage'));
                        redirect($_SERVER["HTTP_REFERER"]);
                    }
                }
                $products[] = array(
                    'product_id' => $product_id,
                    'type' => $type,
                    'quantity' => $quantity,
                    'warehouse_id' => $warehouse_id,
                    'option_id' => $variant,
                    'serial_no' => $serial,
                    );

            }

            if (empty($products)) {
                $this->form_validation->set_rules('product', lang("products"), 'required');
            } else {
                krsort($products);
            }

            $data = array(
                'date' => $date,
                'reference_no' => $reference_no,
                'warehouse_id' => $warehouse_id,
                'note' => $note,
                'created_by' => $this->session->userdata('user_id'),
                'count_id' => $this->input->post('count_id') ? $this->input->post('count_id') : NULL,
                );

          /*   if ($_FILES['document']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path'] = $this->digital_upload_path;
                $config['allowed_types'] = $this->digital_file_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('document')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER["HTTP_REFERER"]);
                }
                $photo = $this->upload->file_name;
                $data['attachment'] = $photo;
            } 

            // $this->sma->print_arrays($data, $products);

        }

        if ($this->form_validation->run() == true && $this->products_model->addAdjustment($data, $products)) {
            $this->session->set_userdata('remove_qals', 1);
            $this->session->set_flashdata('message', lang("quantity_adjusted"));
            admin_redirect('products/quantity_adjustments');
        } else {

            if ($count_id) {
                $stock_count = $this->products_model->getStouckCountByID($count_id);
                $items = $this->products_model->getStockCountItems($count_id);
                $c = rand(100000, 9999999);
                foreach ($items as $item) {
                    if ($item->counted != $item->expected) {
                        $product = $this->site->getProductByID($item->product_id);
                        $row = json_decode('{}');
                        $row->id = $item->product_id;
                        $row->code = $product->code;
                        $row->name = $product->name;
                        $row->qty = $item->counted-$item->expected;
                        $row->type = $row->qty > 0 ? 'addition' : 'subtraction';
                        $row->qty = $row->qty > 0 ? $row->qty : (0-$row->qty);
                        $options = $this->products_model->getProductOptions($product->id);
                        $row->option = $item->product_variant_id ? $item->product_variant_id : 0;
                        $row->serial = '';
                        $ri = $this->Settings->item_addition ? $product->id : $c;

                        $pr[$ri] = array('id' => str_replace(".", "", microtime(true)), 'item_id' => $row->id, 'label' => $row->name . " (" . $row->code . ")",
                            'row' => $row, 'options' => $options);
                        $c++;
                    }
                }
            }
            $this->data['adjustment_items'] = $count_id ? json_encode($pr) : FALSE;
            $this->data['warehouse_id'] = $count_id ? $stock_count->warehouse_id : FALSE;
            $this->data['count_id'] = $count_id;
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['warehouses'] = $this->site->getAllWarehouses();
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('add_adjustment')));
            $meta = array('page_title' => lang('add_adjustment'), 'bc' => $bc);
            $this->page_construct('products/add_adjustment', $meta, $this->data);

        }
    }

    function edit_adjustment($id)
    {
        $this->sma->checkPermissions('adjustments', true);
        $adjustment = $this->products_model->getAdjustmentByID($id);
        if (!$id || !$adjustment) {
            $this->session->set_flashdata('error', lang('adjustment_not_found'));
            $this->sma->md();
        }
        $this->form_validation->set_rules('warehouse', lang("warehouse"), 'required');

        if ($this->form_validation->run() == true) {

            if ($this->Owner || $this->Admin) {
                $date = $this->sma->fld($this->input->post('date'));
            } else {
                $date = $adjustment->date;
            }
            $reference_no = $this->input->post('reference_no');
            $warehouse_id = $this->input->post('warehouse');
            $note = $this->sma->clear_tags($this->input->post('note'));
            $i = isset($_POST['product_id']) ? sizeof($_POST['product_id']) : 0;
            for ($r = 0; $r < $i; $r++) {

                $product_id = $_POST['product_id'][$r];
                $type = $_POST['type'][$r];
                $quantity = $_POST['quantity'][$r];
                $serial = $_POST['serial'][$r];
                $variant = isset($_POST['variant'][$r]) && !empty($_POST['variant'][$r]) ? $_POST['variant'][$r] : null;

                if (!$this->Settings->overselling && $type == 'subtraction') {
                    if ($variant) {
                        if($op_wh_qty = $this->products_model->getProductWarehouseOptionQty($variant, $warehouse_id)) {
                            if ($op_wh_qty->quantity < $quantity) {
                                $this->session->set_flashdata('error', lang('warehouse_option_qty_is_less_than_damage'));
                                redirect($_SERVER["HTTP_REFERER"]);
                            }
                        } else {
                            $this->session->set_flashdata('error', lang('warehouse_option_qty_is_less_than_damage'));
                            redirect($_SERVER["HTTP_REFERER"]);
                        }
                    }
                    if($wh_qty = $this->products_model->getProductQuantity($product_id, $warehouse_id)) {
                        if ($wh_qty['quantity'] < $quantity) {
                            $this->session->set_flashdata('error', lang('warehouse_qty_is_less_than_damage'));
                            redirect($_SERVER["HTTP_REFERER"]);
                        }
                    } else {
                        $this->session->set_flashdata('error', lang('warehouse_qty_is_less_than_damage'));
                        redirect($_SERVER["HTTP_REFERER"]);
                    }
                }
                $products[] = array(
                    'product_id' => $product_id,
                    'type' => $type,
                    'quantity' => $quantity,
                    'warehouse_id' => $warehouse_id,
                    'option_id' => $variant,
                    'serial_no' => $serial,
                    );

            }
            if (empty($products)) {
                $this->form_validation->set_rules('product', lang("products"), 'required');
            } else {
                krsort($products);
            }
            $data = array(
                'date' => $date,
                'reference_no' => $reference_no,
                'warehouse_id' => $warehouse_id,
                'note' => $note,
                'created_by' => $this->session->userdata('user_id')
                );
            if ($_FILES['document']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path'] = $this->digital_upload_path;
                $config['allowed_types'] = $this->digital_file_types;
                $config['max_size'] = $this->allowed_file_size;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('document')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER["HTTP_REFERER"]);
                }
                $photo = $this->upload->file_name;
                $data['attachment'] = $photo;
            }
            // $this->sma->print_arrays($data, $products);

        }

        if ($this->form_validation->run() == true && $this->products_model->updateAdjustment($id, $data, $products)) {
            $this->session->set_userdata('remove_qals', 1);
            $this->session->set_flashdata('message', lang("quantity_adjusted"));
            admin_redirect('products/quantity_adjustments');
        } else {

            $inv_items = $this->products_model->getAdjustmentItems($id);
            // krsort($inv_items);
            $c = rand(100000, 9999999);
            foreach ($inv_items as $item) {
                $product = $this->site->getProductByID($item->product_id);
                $row = json_decode('{}');
                $row->id = $item->product_id;
                $row->code = $product->code;
                $row->name = $product->name;
                $row->qty = $item->quantity;
                $row->type = $item->type;
                $options = $this->products_model->getProductOptions($product->id);
                $row->option = $item->option_id ? $item->option_id : 0;
                $row->serial = $item->serial_no ? $item->serial_no : '';
                $ri = $this->Settings->item_addition ? $product->id : $c;

                $pr[$ri] = array('id' => str_replace(".", "", microtime(true)), 'item_id' => $row->id, 'label' => $row->name . " (" . $row->code . ")",
                    'row' => $row, 'options' => $options);
                $c++;
            }

            $this->data['adjustment'] = $adjustment;
            $this->data['adjustment_items'] = json_encode($pr);
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['warehouses'] = $this->site->getAllWarehouses();
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('edit_adjustment')));
            $meta = array('page_title' => lang('edit_adjustment'), 'bc' => $bc);
            $this->page_construct('products/edit_adjustment', $meta, $this->data);

        }
    }

    function add_adjustment_by_csv()
    {
        $this->sma->checkPermissions('adjustments', true);
        $this->form_validation->set_rules('warehouse', lang("warehouse"), 'required');

        if ($this->form_validation->run() == true) {

            if ($this->Owner || $this->Admin) {
                $date = $this->sma->fld($this->input->post('date'));
            } else {
                $date = date('Y-m-d H:s:i');
            }

            $reference_no = $this->input->post('reference_no') ? $this->input->post('reference_no') : $this->site->getReference('qa');
            $warehouse_id = $this->input->post('warehouse');
            $note = $this->sma->clear_tags($this->input->post('note'));
            $data = array(
                'date' => $date,
                'reference_no' => $reference_no,
                'warehouse_id' => $warehouse_id,
                'note' => $note,
                'created_by' => $this->session->userdata('user_id'),
                'count_id' => NULL,
                );

            if ($_FILES['csv_file']['size'] > 0) {

                $this->load->library('upload');
                $config['upload_path'] = $this->digital_upload_path;
                $config['allowed_types'] = 'csv';
                $config['max_size'] = $this->allowed_file_size;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('csv_file')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER["HTTP_REFERER"]);
                }

                $csv = $this->upload->file_name;
                $data['attachment'] = $csv;

                $arrResult = array();
                $handle = fopen($this->digital_upload_path . $csv, "r");
                if ($handle) {
                    while (($row = fgetcsv($handle, 5000, ",")) !== FALSE) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                $titles = array_shift($arrResult);
                $keys = array('code', 'quantity', 'variant');
                $final = array();
                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }
                // $this->sma->print_arrays($final);
                $rw = 2;
                foreach ($final as $pr) {
                    if ($product = $this->products_model->getProductByCode(trim($pr['code']))) {
                        $csv_variant = trim($pr['variant']);
                        $variant = !empty($csv_variant) ? $this->products_model->getProductVariantID($product->id, $csv_variant) : FALSE;

                        $csv_quantity = trim($pr['quantity']);
                        $type = $csv_quantity > 0 ? 'addition' : 'subtraction';
                        $quantity = $csv_quantity > 0 ? $csv_quantity : (0-$csv_quantity);

                        if (!$this->Settings->overselling && $type == 'subtraction') {
                            if ($variant) {
                                if($op_wh_qty = $this->products_model->getProductWarehouseOptionQty($variant, $warehouse_id)) {
                                    if ($op_wh_qty->quantity < $quantity) {
                                        $this->session->set_flashdata('error', lang('warehouse_option_qty_is_less_than_damage'). ' - ' . lang('line_no') . ' ' . $rw);
                                        redirect($_SERVER["HTTP_REFERER"]);
                                    }
                                } else {
                                    $this->session->set_flashdata('error', lang('warehouse_option_qty_is_less_than_damage'). ' - ' . lang('line_no') . ' ' . $rw);
                                    redirect($_SERVER["HTTP_REFERER"]);
                                }
                            }
                            if($wh_qty = $this->products_model->getProductQuantity($product->id, $warehouse_id)) {
                                if ($wh_qty['quantity'] < $quantity) {
                                    $this->session->set_flashdata('error', lang('warehouse_qty_is_less_than_damage'). ' - ' . lang('line_no') . ' ' . $rw);
                                    redirect($_SERVER["HTTP_REFERER"]);
                                }
                            } else {
                                $this->session->set_flashdata('error', lang('warehouse_qty_is_less_than_damage'). ' - ' . lang('line_no') . ' ' . $rw);
                                redirect($_SERVER["HTTP_REFERER"]);
                            }
                        }

                        $products[] = array(
                            'product_id' => $product->id,
                            'type' => $type,
                            'quantity' => $quantity,
                            'warehouse_id' => $warehouse_id,
                            'option_id' => $variant,
                            );

                    } else {
                        $this->session->set_flashdata('error', lang('check_product_code') . ' (' . $pr['code'] . '). ' . lang('product_code_x_exist') . ' ' . lang('line_no') . ' ' . $rw);
                        redirect($_SERVER["HTTP_REFERER"]);
                    }
                    $rw++;
                }

            } else {
                $this->form_validation->set_rules('csv_file', lang("upload_file"), 'required');
            }

            // $this->sma->print_arrays($data, $products);

        }

        if ($this->form_validation->run() == true && $this->products_model->addAdjustment($data, $products)) {
            $this->session->set_flashdata('message', lang("quantity_adjusted"));
            admin_redirect('products/quantity_adjustments');
        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['warehouses'] = $this->site->getAllWarehouses();
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('add_adjustment')));
            $meta = array('page_title' => lang('add_adjustment_by_csv'), 'bc' => $bc);
            $this->page_construct('products/add_adjustment_by_csv', $meta, $this->data);

        }
    }

    function delete_adjustment($id = NULL)
    {
        $this->sma->checkPermissions('delete', TRUE);

        if ($this->products_model->deleteAdjustment($id)) {
            $this->sma->send_json(array('error' => 0, 'msg' => lang("adjustment_deleted")));
        }

    }

    /* --------------------------------------------------------------------------------------------- 

    function modal_view($id = NULL)
    {
        $this->sma->checkPermissions('index', TRUE);
        $pr_details = $this->site->getProductByID($id);
        if (!$id || !$pr_details) {
            $this->session->set_flashdata('error', lang('prduct_not_found'));
            $this->sma->md();
        }
        $this->data['barcode'] = "<img src='" . admin_url('products/gen_barcode/' . $pr_details->code . '/' . $pr_details->barcode_symbology . '/40/0') . "' alt='" . $pr_details->code . "' class='pull-left' />";
        if ($pr_details->type == 'combo') {
            $this->data['combo_items'] = $this->products_model->getProductComboItems($id);
        }
        $this->data['product'] = $pr_details;
        $this->data['unit'] = $this->site->getUnitByID($pr_details->unit);
        $this->data['brand'] = $this->site->getBrandByID($pr_details->brand);
        $this->data['images'] = $this->products_model->getProductPhotos($id);
        $this->data['category'] = $this->site->getCategoryByID($pr_details->category_id);
        $this->data['subcategory'] = $pr_details->subcategory_id ? $this->site->getCategoryByID($pr_details->subcategory_id) : NULL;
        $this->data['tax_rate'] = $pr_details->tax_rate ? $this->site->getTaxRateByID($pr_details->tax_rate) : NULL;
        $this->data['warehouses'] = $this->products_model->getAllWarehousesWithPQ($id);
        $this->data['options'] = $this->products_model->getProductOptionsWithWH($id);
        $this->data['variants'] = $this->products_model->getProductOptions($id);
        $this->load->view($this->theme.'products/modal_view', $this->data);
    }
*/
    function view($id = NULL)
    {
      //  $this->sma->checkPermissions('index');

        $pr_details = $this->products_model->getProductByID($id);
        if (!$id || !$pr_details) {
            $this->session->set_flashdata('error', lang('prduct_not_found'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        $data['barcode'] = "<img src='" . base_url('admin/procurment/products/gen_barcode/' . $pr_details->code . '/' . $pr_details->barcode_symbology . '/40/0') . "' alt='" . $pr_details->code . "' class='pull-left' />";
        if ($pr_details->type == 'combo') {
            $data['combo_items'] = $this->products_model->getProductComboItems($id);
        }
        $data['product'] = $pr_details;
        $data['unit'] = $this->site->getUnitByID($pr_details->unit);
        $data['brand'] = $this->site->getBrandByID($pr_details->brand);
        $data['images'] = $this->products_model->getProductPhotos($id);
        $data['category'] = $this->site->getCategoryByID($pr_details->category_id);
        $data['subcategory'] = $pr_details->subcategory_id ? $this->site->getCategoryByID($pr_details->subcategory_id) : NULL;
        $data['tax_rate'] = $pr_details->tax_rate ? $this->site->getTaxRateByID($pr_details->tax_rate) : NULL;
        $data['popup_attributes'] = $this->popup_attributes;
        $data['warehouses'] = $this->products_model->getAllWarehousesWithPQ($id);
        $data['options'] = $this->products_model->getProductOptionsWithWH($id);
        $data['variants'] = $this->products_model->getProductOptions($id);
       // $data['sold'] = $this->products_model->getSoldQty($id);
       // $data['purchased'] = $this->products_model->getPurchasedQty($id);

      /*   $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => $pr_details->name));
        $meta = array('page_title' => $pr_details->name, 'bc' => $bc); */
        $this->render_admin('procurment/products/view', $data);
    }
	
	function stock($rid){
		
		$id =$rid;
		$this->data['product'] = $this->products_model->getProductByID($id);
		$this->data['id'] = $id;
		$this->data['modal_js'] = $this->site->modal_js();
		$this->data['total_stock'] = $this->products_model->getTotalStock($id);
		$this->load->view($this->theme . 'products/stock', $this->data);
    }
	
    function stocklist($warehouse_id = NULL)
    {
   
        $data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $data['supplier'] = $this->input->get('supplier') ? $this->site->getCompanyByID($this->input->get('supplier')) : NULL;
        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => '#', 'page' => lang('products')));
        $meta = array('page_title' => lang('products'), 'bc' => $bc);
        $this->render_admin('procurment/products/stocklist', $meta, $data);
    }
      function   get_stocklist(){
		    $detail_link = anchor('admin/procurment/products/view/$1', '<i class="fa fa-file-text-o"></i> ' . lang('product_details'));
        $delete_link = "<a href='#' class='tip po' title='<b>" . $this->lang->line("delete_product") . "</b>' data-content=\"<p>"
            . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete1' id='a__$1' href='" . base_url('admin/procurment/products/delete/$1') . "'>"
            . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> "
            . lang('delete_product') . "</a>";
		$actions = "<div class=\"text-center\">";

		$actions = '<div class="text-center"><div class="btn-group text-left">'
            . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">'
            . lang('actions') . ' <span class="caret"></span></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li>' . $detail_link . '</li>
            <li><a href="' . base_url('admin/procurment/products/add/$1') . '"><i class="fa fa-plus-square"></i> ' . lang('duplicate_product') . '</a></li>
            <li><a href="' . base_url('admin/procurment/products/edit/$1') . '"><i class="fa fa-edit"></i> ' . lang('edit_product') . '</a></li>';
			   $actions .= '<li><a href="' . base_url() . 'assets/product/$2" data-type="image" data-toggle="lightbox"><i class="fa fa-file-photo-o"></i> '
            . lang('view_image') . '</a></li>
           
            <li class="divider"></li>
            <li>' . $delete_link . '</li>
            </ul>
        </div></div>';
		   $this->load->library('datatables');
		   $this->datatables
		   ->select("inv_products.id as productid,inv_products.image as image,inv_products.code as code ,inv_products.barcode,inv_products.name as name ,inv_categories.name category,inv_brands.name as brand,alert_quantity,ifnull(sum(stock_in),0.00)
		  ", FALSE)
		   ->from("inv_products")
		   ->join("inv_categories","inv_categories.id=inv_products.category_id","left")
		   ->join("inv_brands","inv_brands.id=inv_products.brand","left")
		   ->join("inv_pro_stock_master","inv_pro_stock_master.product_id=inv_products.id","left")
		  ->where('Active',0)
		  ->group_by('inv_products.id');
		  // ->add_column("Actions", $actions, "productid,image, code, name");
		echo $this->datatables->generate();
		  
	  }
/*
    function pdf($id = NULL, $view = NULL)
    {
        

        $pr_details = $this->products_model->getProductByID($id);
        if (!$id || !$pr_details) {
            $this->session->set_flashdata('error', lang('prduct_not_found'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        $this->data['barcode'] = "<img src='" . base_url('products/gen_barcode/' . $pr_details->code . '/' . $pr_details->barcode_symbology . '/40/0') . "' alt='" . $pr_details->code . "' class='pull-left' />";
        if ($pr_details->type == 'combo') {
            $this->data['combo_items'] = $this->products_model->getProductComboItems($id);
        }
        $this->data['product'] = $pr_details;
        $this->data['unit'] = $this->site->getUnitByID($pr_details->unit);
        $this->data['brand'] = $this->site->getBrandByID($pr_details->brand);
        $this->data['images'] = $this->products_model->getProductPhotos($id);
        $this->data['category'] = $this->site->getCategoryByID($pr_details->category_id);
        $this->data['subcategory'] = $pr_details->subcategory_id ? $this->site->getCategoryByID($pr_details->subcategory_id) : NULL;
        $this->data['tax_rate'] = $pr_details->tax_rate ? $this->site->getTaxRateByID($pr_details->tax_rate) : NULL;
        $this->data['popup_attributes'] = $this->popup_attributes;
        $this->data['warehouses'] = $this->products_model->getAllWarehousesWithPQ($id);
        $this->data['options'] = $this->products_model->getProductOptionsWithWH($id);
        $this->data['variants'] = $this->products_model->getProductOptions($id);

        $name = $pr_details->code . '_' . str_replace('/', '_', $pr_details->name) . ".pdf";
        if ($view) {
            $this->load->view($this->theme . 'products/pdf', $this->data);
        } else {
            $html = $this->load->view($this->theme . 'admin/procurment/products/pdf', $this->data, TRUE);
            if (! $this->Settings->barcode_img) {
                $html = preg_replace("'\<\?xml(.*)\?\>'", '', $html);
            }
            $this->sma->generate_pdf($html, $name);
        }
    }
*/
    function getSubCategories($category_id = NULL)
    {
        if ($rows = $this->products_model->getSubCategories($category_id)) {
            $data = json_encode($rows);
        } else {
            $data = false;
        }
        echo $data;
    }
/*
    function product_actions($wh = NULL)
    {
        if (!$this->Owner && !$this->GP['bulk_actions']) {
            $this->session->set_flashdata('warning', lang('access_denied'));
            redirect($_SERVER["HTTP_REFERER"]);
        }

        $this->form_validation->set_rules('form_action', lang("form_action"), 'required');

        if ($this->form_validation->run() == true) {

            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'sync_quantity') {

                    foreach ($_POST['val'] as $id) {
                        $this->site->syncQuantity(NULL, NULL, NULL, $id);
                    }
                    $this->session->set_flashdata('message', $this->lang->line("products_quantity_sync"));
                    redirect($_SERVER["HTTP_REFERER"]);

                } elseif ($this->input->post('form_action') == 'delete') {

                    $this->sma->checkPermissions('delete');
                    foreach ($_POST['val'] as $id) {
                        $this->products_model->deleteProduct($id);
                    }
                    $this->session->set_flashdata('message', $this->lang->line("products_deleted"));
                    redirect($_SERVER["HTTP_REFERER"]);

                } elseif ($this->input->post('form_action') == 'labels') {

                    foreach ($_POST['val'] as $id) {
                        $row = $this->products_model->getProductByID($id);
                        $selected_variants = false;
                        if ($variants = $this->products_model->getProductOptions($row->id)) {
                            foreach ($variants as $variant) {
                                $selected_variants[$variant->id] = $variant->quantity > 0 ? 1 : 0;
                            }
                        }
                        $pr[$row->id] = array('id' => $row->id, 'label' => $row->name . " (" . $row->code . ")", 'code' => $row->code, 'name' => $row->name, 'price' => $row->price, 'qty' => $row->quantity, 'variants' => $variants, 'selected_variants' => $selected_variants);
                    }

                    $this->data['items'] = isset($pr) ? json_encode($pr) : false;
                    $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
                    $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('print_barcodes')));
                    $meta = array('page_title' => lang('print_barcodes'), 'bc' => $bc);
                    $this->page_construct('products/print_barcodes', $meta, $this->data);

                } elseif ($this->input->post('form_action') == 'export_excel') {

                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle('Products');
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('name'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('code'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('barcode_symbology'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('brand'));
                    $this->excel->getActiveSheet()->SetCellValue('E1', lang('category_code'));
                    $this->excel->getActiveSheet()->SetCellValue('F1', lang('unit_code'));
                    $this->excel->getActiveSheet()->SetCellValue('G1', lang('sale').' '.lang('unit_code'));
                    $this->excel->getActiveSheet()->SetCellValue('H1', lang('purchase').' '.lang('unit_code'));
                    $this->excel->getActiveSheet()->SetCellValue('I1', lang('cost'));
                    $this->excel->getActiveSheet()->SetCellValue('J1', lang('price'));
                    $this->excel->getActiveSheet()->SetCellValue('K1', lang('alert_quantity'));
                    $this->excel->getActiveSheet()->SetCellValue('L1', lang('tax_rate'));
                    $this->excel->getActiveSheet()->SetCellValue('M1', lang('tax_method'));
                    $this->excel->getActiveSheet()->SetCellValue('N1', lang('image'));
                    $this->excel->getActiveSheet()->SetCellValue('O1', lang('subcategory_code'));
                    $this->excel->getActiveSheet()->SetCellValue('P1', lang('product_variants'));
                    $this->excel->getActiveSheet()->SetCellValue('Q1', lang('pcf1'));
                    $this->excel->getActiveSheet()->SetCellValue('R1', lang('pcf2'));
                    $this->excel->getActiveSheet()->SetCellValue('S1', lang('pcf3'));
                    $this->excel->getActiveSheet()->SetCellValue('T1', lang('pcf4'));
                    $this->excel->getActiveSheet()->SetCellValue('U1', lang('pcf5'));
                    $this->excel->getActiveSheet()->SetCellValue('V1', lang('pcf6'));
                    $this->excel->getActiveSheet()->SetCellValue('W1', lang('quantity'));

                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $product = $this->products_model->getProductDetail($id);
                        $brand = $this->site->getBrandByID($product->brand);
                        $base_unit = $sale_unit = $purchase_unit = '';
                        if($units = $this->site->getUnitsByBUID($product->unit)) {
                            foreach($units as $u) {
                                if ($u->id == $product->unit) {
                                    $base_unit = $u->code;
                                }
                                if ($u->id == $product->sale_unit) {
                                    $sale_unit = $u->code;
                                }
                                if ($u->id == $product->purchase_unit) {
                                    $purchase_unit = $u->code;
                                }
                            }
                        }
                        $variants = $this->products_model->getProductOptions($id);
                        $product_variants = '';
                        if ($variants) {
                            foreach ($variants as $variant) {
                                $product_variants .= trim($variant->name) . '|';
                            }
                        }
                        $quantity = $product->quantity;
                        if ($wh) {
                            if($wh_qty = $this->products_model->getProductQuantity($id, $wh)) {
                                $quantity = $wh_qty['quantity'];
                            } else {
                                $quantity = 0;
                            }
                        }
                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $product->name);
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $product->code);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $product->barcode_symbology);
                        $this->excel->getActiveSheet()->SetCellValue('D' . $row, ($brand ? $brand->name : ''));
                        $this->excel->getActiveSheet()->SetCellValue('E' . $row, $product->category_code);
                        $this->excel->getActiveSheet()->SetCellValue('F' . $row, $base_unit);
                        $this->excel->getActiveSheet()->SetCellValue('G' . $row, $sale_unit);
                        $this->excel->getActiveSheet()->SetCellValue('H' . $row, $purchase_unit);
                        if ($this->Owner || $this->Admin || $this->session->userdata('show_cost')) {
                            $this->excel->getActiveSheet()->SetCellValue('I' . $row, $product->cost);
                        }
                        if ($this->Owner || $this->Admin || $this->session->userdata('show_price')) {
                            $this->excel->getActiveSheet()->SetCellValue('J' . $row, $product->price);
                        }
                        $this->excel->getActiveSheet()->SetCellValue('K' . $row, $product->alert_quantity);
                        $this->excel->getActiveSheet()->SetCellValue('L' . $row, $product->tax_rate_name);
                        $this->excel->getActiveSheet()->SetCellValue('M' . $row, $product->tax_method ? lang('exclusive') : lang('inclusive'));
                        $this->excel->getActiveSheet()->SetCellValue('N' . $row, $product->image);
                        $this->excel->getActiveSheet()->SetCellValue('O' . $row, $product->subcategory_code);
                        $this->excel->getActiveSheet()->SetCellValue('P' . $row, $product_variants);
                        $this->excel->getActiveSheet()->SetCellValue('Q' . $row, $product->cf1);
                        $this->excel->getActiveSheet()->SetCellValue('R' . $row, $product->cf2);
                        $this->excel->getActiveSheet()->SetCellValue('S' . $row, $product->cf3);
                        $this->excel->getActiveSheet()->SetCellValue('T' . $row, $product->cf4);
                        $this->excel->getActiveSheet()->SetCellValue('U' . $row, $product->cf5);
                        $this->excel->getActiveSheet()->SetCellValue('V' . $row, $product->cf6);
                        $this->excel->getActiveSheet()->SetCellValue('W' . $row, $quantity);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                    $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(40);
                    $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
                    $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $filename = 'products_' . date('Y_m_d_H_i_s');
                    $this->load->helper('excel');
                    create_excel($this->excel, $filename);

                }
            } else {
                $this->session->set_flashdata('error', $this->lang->line("no_product_selected"));
                redirect($_SERVER["HTTP_REFERER"]);
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'admin/products');
        }
    }

    public function delete_image($id = NULL)
    {
        $this->sma->checkPermissions('edit', true);
        if ($id && $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            $this->db->delete('product_photos', array('id' => $id));
            $this->sma->send_json(array('error' => 0, 'msg' => lang("image_deleted")));
        }
        $this->sma->send_json(array('error' => 1, 'msg' => lang("ajax_error")));
    }
*/
    public function getSubUnits($unit_id)
    {
        // $unit = $this->site->getUnitByID($unit_id);
        // if ($units = $this->site->getUnitsByBUID($unit_id)) {
        //     array_push($units, $unit);
        // } else {
        //     $units = array($unit);
        // }
        $units = $this->site->getUnitsByBUID($unit_id);
        $this->sma->send_json($units);
    }
/*
    public function qa_suggestions()
    {
        $term = $this->input->get('term', true);

        if (strlen($term) < 1 || !$term) {
            die("<script type='text/javascript'>setTimeout(function(){ window.top.location.href = '" . admin_url('welcome') . "'; }, 10);</script>");
        }

        $analyzed = $this->sma->analyze_term($term);
        $sr = $analyzed['term'];
        $option_id = $analyzed['option_id'];

        $rows = $this->products_model->getQASuggestions($sr);
        if ($rows) {
            foreach ($rows as $row) {
                $row->qty = 1;
                $options = $this->products_model->getProductOptions($row->id);
                $row->option = $option_id;
                $row->serial = '';

                $pr[] = array('id' => str_replace(".", "", microtime(true)), 'item_id' => $row->id, 'label' => $row->name . " (" . $row->code . ")",
                    'row' => $row, 'options' => $options);

            }
            $this->sma->send_json($pr);
        } else {
            $this->sma->send_json(array(array('id' => 0, 'label' => lang('no_match_found'), 'value' => $term)));
        }
    }

    function adjustment_actions()
    {
        if (!$this->Owner && !$this->GP['bulk_actions']) {
            $this->session->set_flashdata('warning', lang('access_denied'));
            redirect($_SERVER["HTTP_REFERER"]);
        }

        $this->form_validation->set_rules('form_action', lang("form_action"), 'required');

        if ($this->form_validation->run() == true) {

            if (!empty($_POST['val'])) {
                if ($this->input->post('form_action') == 'delete') {

                    $this->sma->checkPermissions('delete');
                    foreach ($_POST['val'] as $id) {
                        $this->products_model->deleteAdjustment($id);
                    }
                    $this->session->set_flashdata('message', $this->lang->line("adjustment_deleted"));
                    redirect($_SERVER["HTTP_REFERER"]);

                } elseif ($this->input->post('form_action') == 'export_excel') {

                    $this->load->library('excel');
                    $this->excel->setActiveSheetIndex(0);
                    $this->excel->getActiveSheet()->setTitle('quantity_adjustments');
                    $this->excel->getActiveSheet()->SetCellValue('A1', lang('date'));
                    $this->excel->getActiveSheet()->SetCellValue('B1', lang('reference_no'));
                    $this->excel->getActiveSheet()->SetCellValue('C1', lang('warehouse'));
                    $this->excel->getActiveSheet()->SetCellValue('D1', lang('created_by'));
                    $this->excel->getActiveSheet()->SetCellValue('E1', lang('note'));
                    $this->excel->getActiveSheet()->SetCellValue('F1', lang('items'));

                    $row = 2;
                    foreach ($_POST['val'] as $id) {
                        $adjustment = $this->products_model->getAdjustmentByID($id);
                        $created_by = $this->site->getUser($adjustment->created_by);
                        $warehouse = $this->site->getWarehouseByID($adjustment->warehouse_id);
                        $items = $this->products_model->getAdjustmentItems($id);
                        $products = '';
                        if ($items) {
                            foreach ($items as $item) {
                                $products .= $item->product_name.'('.$this->sma->formatQuantity($item->type == 'subtraction' ? -$item->quantity : $item->quantity).')'."\n";
                            }
                        }

                        $this->excel->getActiveSheet()->SetCellValue('A' . $row, $this->sma->hrld($adjustment->date));
                        $this->excel->getActiveSheet()->SetCellValue('B' . $row, $adjustment->reference_no);
                        $this->excel->getActiveSheet()->SetCellValue('C' . $row, $warehouse->name);
                        $this->excel->getActiveSheet()->SetCellValue('D' . $row, $created_by->first_name.' ' .$created_by->last_name);
                        $this->excel->getActiveSheet()->SetCellValue('E' . $row, $this->sma->decode_html($adjustment->note));
                        $this->excel->getActiveSheet()->SetCellValue('F' . $row, $products);
                        $row++;
                    }

                    $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                    $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                    $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
                    $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                    $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
                    $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
                    $this->excel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $filename = 'quantity_adjustments_' . date('Y_m_d_H_i_s');
                    $this->load->helper('excel');
                    create_excel($this->excel, $filename);
                }
            } else {
                $this->session->set_flashdata('error', $this->lang->line("no_record_selected"));
                redirect($_SERVER["HTTP_REFERER"]);
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }

    function stock_counts($warehouse_id = NULL)
    {
        $this->sma->checkPermissions('stock_count');

        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        if ($this->Owner || $this->Admin || !$this->session->userdata('warehouse_id')) {
            $this->data['warehouses'] = $this->site->getAllWarehouses();
            $this->data['warehouse_id'] = $warehouse_id;
            $this->data['warehouse'] = $warehouse_id ? $this->site->getWarehouseByID($warehouse_id) : NULL;
        } else {
            $this->data['warehouses'] = NULL;
            $this->data['warehouse_id'] = $this->session->userdata('warehouse_id');
            $this->data['warehouse'] = $this->session->userdata('warehouse_id') ? $this->site->getWarehouseByID($this->session->userdata('warehouse_id')) : NULL;
        }

        $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('stock_counts')));
        $meta = array('page_title' => lang('stock_counts'), 'bc' => $bc);
        $this->page_construct('products/stock_counts', $meta, $this->data);
    }

    function getCounts($warehouse_id = NULL)
    {
        $this->sma->checkPermissions('stock_count', TRUE);
        if ((! $this->Owner || ! $this->Admin) && ! $warehouse_id) {
            $user = $this->site->getUser();
            $warehouse_id = $user->warehouse_id;
        }
        $detail_link = anchor('admin/products/view_count/$1', '<label class="label label-primary pointer">'.lang('details').'</label>', 'class="tip" title="'.lang('details').'" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false"');
        $this->load->library('datatables');
        $this->datatables
            ->select("{$this->db->dbprefix('stock_counts')}.id as id, date, reference_no, {$this->db->dbprefix('warehouses')}.name as wh_name, type, brand_names, category_names, initial_file, final_file")
            ->from('stock_counts')
            ->join('warehouses', 'warehouses.id=stock_counts.warehouse_id', 'left');
        if ($warehouse_id) {
            $this->datatables->where('warehouse_id', $warehouse_id);
        }
        $this->datatables->add_column('Actions', '<div class="text-center">'.$detail_link.'</div>', "id");
        echo $this->datatables->generate();
    }

    function view_count($id)
    {
        $this->sma->checkPermissions('stock_count', TRUE);
        $stock_count = $this->products_model->getStouckCountByID($id);
        if ( ! $stock_count->finalized) {
            $this->sma->md('admin/products/finalize_count/'.$id);
        }
        $this->data['stock_count'] = $stock_count;
        $this->data['stock_count_items'] = $this->products_model->getStockCountItems($id);
        $this->data['warehouse'] = $this->site->getWarehouseByID($stock_count->warehouse_id);
        $this->data['adjustment'] = $this->products_model->getAdjustmentByCountID($id);
        $this->load->view($this->theme.'products/view_count', $this->data);
    }

    function count_stock($page = NULL)
    {
        $this->sma->checkPermissions('stock_count');
        $this->form_validation->set_rules('warehouse', lang("warehouse"), 'required');
        $this->form_validation->set_rules('type', lang("type"), 'required');
        if ($this->form_validation->run() == true) {

            $warehouse_id = $this->input->post('warehouse');
            $type = $this->input->post('type');
            $categories = $this->input->post('category') ? $this->input->post('category') : NULL;
            $brands = $this->input->post('brand') ? $this->input->post('brand') : NULL;
            $this->load->helper('string');
            $name = random_string('md5').'.csv';
            $products = $this->products_model->getStockCountProducts($warehouse_id, $type, $categories, $brands);
            $pr = 0; $rw = 0;
            foreach ($products as $product) {
                if ($variants = $this->products_model->getStockCountProductVariants($warehouse_id, $product->id)) {
                    foreach ($variants as $variant) {
                        $items[] = array(
                            'product_code' => $product->code,
                            'product_name' => $product->name,
                            'variant' => $variant->name,
                            'expected' => $variant->quantity,
                            'counted' => ''
                            );
                        $rw++;
                    }
                } else {
                    $items[] = array(
                        'product_code' => $product->code,
                        'product_name' => $product->name,
                        'variant' => '',
                        'expected' => $product->quantity,
                        'counted' => ''
                        );
                    $rw++;
                }
                $pr++;
            }
            if ( ! empty($items)) {
                $csv_file = fopen('./files/'.$name, 'w');
                fputcsv($csv_file, array(lang('product_code'), lang('product_name'), lang('variant'), lang('expected'), lang('counted')));
                foreach ($items as $item) {
                    fputcsv($csv_file, $item);
                }
                // file_put_contents('./files/'.$name, $csv_file);
                // fwrite($csv_file, $txt);
                fclose($csv_file);
            } else {
                $this->session->set_flashdata('error', lang('no_product_found'));
                redirect($_SERVER["HTTP_REFERER"]);
            }

            if ($this->Owner || $this->Admin) {
                $date = $this->sma->fld($this->input->post('date'));
            } else {
                $date = date('Y-m-d H:s:i');
            }
            $category_ids = '';
            $brand_ids = '';
            $category_names = '';
            $brand_names = '';
            if ($categories) {
                $r = 1; $s = sizeof($categories);
                foreach ($categories as $category_id) {
                    $category = $this->site->getCategoryByID($category_id);
                    if ($r == $s) {
                        $category_names .= $category->name;
                        $category_ids .= $category->id;
                    } else {
                        $category_names .= $category->name.', ';
                        $category_ids .= $category->id.', ';
                    }
                    $r++;
                }
            }
            if ($brands) {
                $r = 1; $s = sizeof($brands);
                foreach ($brands as $brand_id) {
                    $brand = $this->site->getBrandByID($brand_id);
                    if ($r == $s) {
                        $brand_names .= $brand->name;
                        $brand_ids .= $brand->id;
                    } else {
                        $brand_names .= $brand->name.', ';
                        $brand_ids .= $brand->id.', ';
                    }
                    $r++;
                }
            }
            $data = array(
                'date' => $date,
                'warehouse_id' => $warehouse_id,
                'reference_no' => $this->input->post('reference_no'),
                'type' => $type,
                'categories' => $category_ids,
                'category_names' => $category_names,
                'brands' => $brand_ids,
                'brand_names' => $brand_names,
                'initial_file' => $name,
                'products' => $pr,
                'rows' => $rw,
                'created_by' => $this->session->userdata('user_id')
            );

        }
        if ($this->form_validation->run() == true && $this->products_model->addStockCount($data)) {
            $this->session->set_flashdata('message', lang("stock_count_intiated"));
            admin_redirect('products/stock_counts');

        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['warehouses'] = $this->site->getAllWarehouses();
            $this->data['categories'] = $this->site->getAllCategories();
            $this->data['brands'] = $this->site->getAllBrands();
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('count_stock')));
            $meta = array('page_title' => lang('count_stock'), 'bc' => $bc);
            $this->page_construct('products/count_stock', $meta, $this->data);

        }

    }

    function finalize_count($id)
    {
        $this->sma->checkPermissions('stock_count');
        $stock_count = $this->products_model->getStouckCountByID($id);
        if ( ! $stock_count || $stock_count->finalized) {
            $this->session->set_flashdata('error', lang("stock_count_finalized"));
            admin_redirect('products/stock_counts');
        }
        $this->form_validation->set_rules('count_id', lang("count_stock"), 'required');
        if ($this->form_validation->run() == true) {
            if ($_FILES['csv_file']['size'] > 0) {
                $note = $this->sma->clear_tags($this->input->post('note'));
                $data = array(
                    'updated_by' => $this->session->userdata('user_id'),
                    'updated_at' => date('Y-m-d H:s:i'),
                    'note' => $note
                );
                $this->load->library('upload');
                $config['upload_path'] = $this->digital_upload_path;
                $config['allowed_types'] = 'csv';
                $config['max_size'] = $this->allowed_file_size;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('csv_file')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect($_SERVER["HTTP_REFERER"]);
                }
                $csv = $this->upload->file_name;
                $arrResult = array();
                $handle = fopen($this->digital_upload_path . $csv, "r");
                if ($handle) {
                    while (($row = fgetcsv($handle, 5000, ",")) !== FALSE) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                $titles = array_shift($arrResult);
                $keys   =  array('product_code', 'product_name', 'product_variant', 'expected', 'counted');
                $final = array();
                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }
                // $this->sma->print_arrays($final);
                $rw = 2; $differences = 0; $matches = 0;
                foreach ($final as $pr) {
                    if ($product = $this->products_model->getProductByCode(trim($pr['product_code']))) {
                        $pr['counted'] = !empty($pr['counted']) ? $pr['counted'] : 0;
                        if ($pr['expected'] == $pr['counted']) {
                            $matches++;
                        } else {
                            $pr['stock_count_id'] = $id;
                            $pr['product_id'] = $product->id;
                            $pr['cost'] = $product->cost;
                            $pr['product_variant_id'] = empty($pr['product_variant']) ? NULL : $this->products_model->getProductVariantID($pr['product_id'], $pr['product_variant']);
                            $products[] = $pr;
                            $differences++;
                        }
                    } else {
                        $this->session->set_flashdata('error', lang('check_product_code') . ' (' . $pr['product_code'] . '). ' . lang('product_code_x_exist') . ' ' . lang('line_no') . ' ' . $rw);
                        admin_redirect('products/finalize_count/'.$id);
                    }
                    $rw++;
                }
                $data['final_file'] = $csv;
                $data['differences'] = $differences;
                $data['matches'] = $matches;
                $data['missing'] = $stock_count->rows-($rw-2);
                $data['finalized'] = 1;
            }
            // $this->sma->print_arrays($data, $products);
        }
        if ($this->form_validation->run() == true && $this->products_model->finalizeStockCount($id, $data, $products)) {
            $this->session->set_flashdata('message', lang("stock_count_finalized"));
            admin_redirect('products/stock_counts');
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['stock_count'] = $stock_count;
            $this->data['warehouse'] = $this->site->getWarehouseByID($stock_count->warehouse_id);
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('products'), 'page' => lang('products')), array('link' => admin_url('products/stock_counts'), 'page' => lang('stock_counts')), array('link' => '#', 'page' => lang('finalize_count')));
            $meta = array('page_title' => lang('finalize_count'), 'bc' => $bc);
            $this->page_construct('products/finalize_count', $meta, $this->data);
        }
    }
	

	public function getproduct_property(){
		
		$prduct_id=$this->input->get('product');
		$product=$this->products_model->getProductProperties($prduct_id);
		echo json_encode($product); 
		
	}
    function selling_price_change(){
	$this->sma->checkPermissions();
        $model = 'products_model';
	//p($_POST,1);
        if(isset($_POST['save'])){
	  $selling_prices = $_POST['selling_price'];
	  $cnt = 0;
	  $u_data = array();
	  foreach($selling_prices as $k => $price){
	    if($price['existing_price']==$price['price']){continue;}
	    $u_data[$cnt]['id'] = $price['batch_id'];
	    $u_data[$cnt]['product_id'] =  $price['id'];
	    $u_data[$cnt]['batch_no'] = $price['batch_no'];
	    $u_data[$cnt]['price'] = $price['price'];
	    $u_data[$cnt]['unique_id'] = $price['stock_id'];
	    $u_data[$cnt]['store_id'] = $this->store_id;
	    $cnt++;
	  }
	  if(!empty($u_data)){
	    $this->products_model->updateSellingPrice($u_data);
	    $this->session->set_flashdata('message', lang("selling_price_updated"));
            admin_redirect('products/selling_price_change');
	  }
	}else if(isset($_POST['show']) || isset($_POST['download'])){
	  
	    $this->session->set_userdata($_POST);
	    $this->data['products'] = $this->products_model->searchProducts();
	    if(isset($_POST['download'])){
		$filename = 'selling_price_change_format.csv';
		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename="'.$filename.'";');
		$header = array('SNO','ID','CODE','PRODUCT_NAME','BATCH_NO','COST_PRICE','SELLINGPRICE','MRP','NEWSELLINGPRICE');
		$fp = fopen('php://output', 'w');       
		fputcsv($fp, $header);
		$row_cnt = 1;
		foreach($this->data['products'] as $k => $row){
		    $content = array($row_cnt,$row->batch_id,$row->code,$row->name,$row->batch_no,$row->cost,$row->price,$row->mrp,'');
		    fputcsv($fp, $content);
		    $row_cnt++;
		}
		fclose($fp);  exit();
	    }
	}else{
	    $this->data['products'] = $this->products_model->searchProducts();
	}
	$this->data['categories'] = $this->site->getAllCategories();
        $this->data['brands'] = $this->site->getAllBrands();
            $bc = array(array('link' => base_url(), 'page' => lang('home')), array('link' => admin_url('products'), 'page' => lang('products')), array('link' => '#', 'page' => lang('selling_price_change')));
        $meta = array('page_title' => lang('selling_price_change'), 'bc' => $bc);
            $this->page_construct('products/selling_price_change', $meta, $this->data);
       // }
    
    }
    function product_suggestions()
    {
        $term = $this->input->get('term', TRUE);
        if (strlen($term) < 1 || !$term) {
            die("<script type='text/javascript'>setTimeout(function(){ window.top.location.href = '" . admin_url('welcome') . "'; }, 10);</script>");
        }

        $rows = $this->products_model->getProductNames($term);
        if ($rows) {
            foreach ($rows as $row) {
                $pr[] = array('id' => $row->id, 'text' => $row->name . " (" . $row->code . ")", 'code' => $row->code, 'name' => $row->name, 'price' => $row->price, 'qty' => 1);
            }
	    $data['results'] = $pr;
            $this->sma->send_json($data);
        } 
    }
    function getproduct_byID(){
	$id = $this->input->get('id');
	$data[] = $this->products_model->getProductByID($id);
	$json =  array();
	
	foreach($data as $k => $row){
	   $json[$k]['id'] = $row->id;
	   $json[$k]['text'] = $row->name;
	}
	$this->sma->send_json($json);
    }
    function getBatchNo_byID(){
	$id = $this->input->get('id');
	$data[] = $this->products_model->getBatchNo_byID($id);
	$json =  array();
	
	foreach($data as $k => $row){
	   $json[$k]['id'] = $row->id;
	   $json[$k]['text'] = $row->name;
	}
	$this->sma->send_json($json);
    }
    function getSupplier_byID(){
	$id = $this->input->get('id');
	$data[] = $this->products_model->getSupplier_byID($id);
	$json =  array();
	
	foreach($data as $k => $row){
	   $json[$k]['id'] = $row->id;
	   $json[$k]['text'] = $row->name;
	}
	$this->sma->send_json($json);
    }
    function reset_product_search(){
	//p($this->session->userdata());
	$this->session->unset_userdata('category_id');
	$this->session->unset_userdata('subcategory_id');
	$this->session->unset_userdata('supplier');
	$this->session->unset_userdata('brand');
	$this->session->unset_userdata('product');
	$this->session->unset_userdata('mrp');
	$this->session->unset_userdata('cost_price');
	$this->session->unset_userdata('selling_price');
	$this->session->unset_userdata('batch_no');
	//p($this->session->userdata(),1);
    }
    function download_sellingprice_csv(){
	 $filename = 'selling_price_change_format.csv';
    header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
    $header = array('batch_no','product_code','product_name','selling_price','purchase_cost','mrp');
    $fp = fopen('php://output', 'w');       
        fputcsv($fp, $header);
    fclose($fp);  
    }
    function selling_price_change_bycsv(){
	$this->form_validation->set_rules('userfile', lang("upload_file"), 'xss_clean');
	//echo 33;p($_FILES["userfile"]);exit;
        if ($this->form_validation->run() == true) {
            if (isset($_FILES["userfile"])) {
		if (!file_exists($this->digital_upload_path)) {
		    mkdir($this->digital_upload_path, 0777, true);
		}
                $this->load->library('upload');
                $config['upload_path'] = $this->digital_upload_path;
                $config['allowed_types'] = 'csv';
                $config['max_size'] = $this->allowed_file_size;
                $config['overwrite'] = TRUE;
                $config['encrypt_name'] = TRUE;
                $config['max_filename'] = 25;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    admin_redirect("products/selling_price_change");
                }

                $csv = $this->upload->file_name;

                $arrResult = array();
                $handle = fopen($this->digital_upload_path . $csv, "r");
                if ($handle) {
                    while (($row = fgetcsv($handle, 5000, ",")) !== FALSE) {                 
					$arrResult[] = $row;
                    }
                    fclose($handle);
                }
		$keys = array_shift($arrResult);//print_R(array_values($keys));exit;
		$values = $arrResult;
                $final = array();
                foreach ($arrResult as $k => $value) {
                    $final[$k] = array_combine($keys,array_values($value));
                }
       
        
                $products = array();
		$rw = 2;
		$cnt = 0;
                foreach ($final as $ik => $csv_pr) {
		    $batch_id  = $csv_pr['ID'];
		    $batch_no  = $csv_pr['BATCH_NO'];
		    $code  = $csv_pr['CODE'];
		    $name  = $csv_pr['PRODUCT_NAME'];
		    $id = $this->products_model->getProductID($code,$name);		   
		    $products[$cnt]['id'] = $batch_id;
		    $products[$cnt]['batch_no'] = $batch_no;
		    $products[$cnt]['store_id'] = $this->store_id;
		    $products[$cnt]['product_id'] = $id;
		    $products[$cnt]['price'] = $csv_pr['NEWSELLINGPRICE'];
		    $cnt++;
		}
		//p($products,1);
		if(!empty($products)){
		    $this->products_model->updateSellingPrice($products);
		    $this->session->set_flashdata('message', 'Price Updated through csv');
		    admin_redirect("products/selling_price_change");
		}
		
    }
	}
    }
    function getBatchNos()
    {
        $term = $this->input->get('term', TRUE);
        if (strlen($term) < 1 || !$term) {
            die("<script type='text/javascript'>setTimeout(function(){ window.top.location.href = '" . admin_url('welcome') . "'; }, 10);</script>");
        }

        $rows = $this->products_model->getBatchNos($term);
        if ($rows) {
            foreach ($rows as $row) {
                $pr[] = array('id' => $row->batch_no, 'text' => $row->batch_no);
            }
	    $data['results'] = $pr;
            $this->sma->send_json($data);
        } 
    }
    function stock_min_qty($rid){
		
		$id =$rid;
		if(isset($_POST['update'])){
		    $data = $this->input->post('stock');
		    $count = count($data['store_id']);
		    $stores = array();
		    for($i=0;$i<$count;$i++){
			$stores[$i]['product_id'] = $id;
			$stores[$i]['store_id'] = $data['store_id'][$i];
			$stores[$i]['min_qty'] = $data['min_qty'][$i];
			$stores[$i]['max_qty'] = $data['max_qty'][$i];
		    }
		    if(!empty($stores)){
			$this->products_model->updateproductMinQty($stores,$id);
			$this->session->set_flashdata('message', 'Product Min Qty Updated');
			admin_redirect("products");
		    }
		}
		$this->data['product'] = $this->products_model->getProductByID($id);
		$this->data['id'] = $id;
		$this->data['stock_minqty'] = $this->products_model->getProductMinQty($id);
		//p($this->data['stock_minqty'],1);
		$this->data['modal_js'] = $this->site->modal_js();
		$this->load->view($this->theme . 'products/stock_min_qty', $this->data);
    }
    function printb(){
	system("lp D:\xampp\htdocs\sramrms\Barcode_Prn_File.prn");
    } */
	public function tax()
    {
        $data['page_title'] = lang('tax');
        $this->render_admin('procurment/settings/tax', $data);
    }
    public function get_tax() {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
		 $this->load->library('datatables');
        $this->datatables
            ->select("id  ,name ,code,rate,case type when 1 THEN 'Percentage' else 'Fixed' end type", false)
            ->from("inv_tax_rates")
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }
    public function edit_tax($id)
    {
        $this->global_model->table = 'inv_tax_rates';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function add_tax()
    {
        $this->global_model->table = 'inv_tax_rates';
        $this->_tax_validate();
        $data = array(
            'name' => $this->input->post('tax_name'),
            'code' => $this->input->post('code'),
			'rate' => $this->input->post('tax_rate'),
			'type' => $this->input->post('type'),

        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_tax()
    {
        $this->global_model->table = 'inv_tax_rates';
       // $this->_tax_validate();
        $data = array(
          'name' => $this->input->post('tax_name'),
            'code' => $this->input->post('code'),
			'rate' => $this->input->post('tax_rate'),
			'type' => $this->input->post('type'),
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_tax($id)
    {
        $this->global_model->table = 'inv_tax_rates';
        $result = $this->db->get_where('inv_pro_purchase_invoice_items', array('tax_rate_id' => $id))->result();
        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    }

    private function _tax_validate()
    {
        $rules = array(
            array('field' => 'tax_name', 'label' => lang('name'), 'rules' => 'trim|required'),
            array('field' => 'tax_rate', 'label' => lang('rate'), 'rules' => 'trim|required'),
        );

        $this->global_model->validation($rules);
    }
	
	
	public function brand()
    {
        $data['page_title'] = lang('brand');
        $this->render_admin('procurment/settings/brand', $data);
    }
    public function get_brand() {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
		 $this->load->library('datatables');
        $this->datatables
            ->select("id  ,name ,code,slug", false)
            ->from("inv_brands")
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }
    public function edit_brand($id)
    {
        $this->global_model->table = 'inv_brands';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function add_brand()
    {
        $this->global_model->table = 'inv_brands';
        $this->_brand_validate();
         $data = array(
          'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
			'slug' => $this->input->post('slug')
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_brand()
    {
        $this->global_model->table = 'inv_brands';
       // $this->_tax_validate();
        $data = array(
          'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
			'slug' => $this->input->post('slug')
			
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_brand($id)
    {
        $this->global_model->table = 'inv_brands';
        $result = $this->db->get_where('inv_products', array('brand' => $id))->result();
        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    }

    private function _brand_validate()
    {
        $rules = array(
            array('field' => 'name', 'label' => lang('name'), 'rules' => 'trim|required'),
            array('field' => 'code', 'label' => lang('code'), 'rules' => 'trim|required'),
        );

        $this->global_model->validation($rules);
    }
	
	//departments
	public function department()
    {
        $data['page_title'] = lang('department');
        $this->render_admin('procurment/settings/department', $data);
    }
    public function get_department() {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
		 $this->load->library('datatables');
        $this->datatables
            ->select("id  ,name ,code,slug", false)
            ->from("inv_categories")
			->where("level",1)
            ->add_column("Actions", $actions, "id");
        echo $this->datatables->generate();
    }
    public function edit_department($id)
    {
        $this->global_model->table = 'inv_categories';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function add_department()
    {
        $this->global_model->table = 'inv_categories';
        $this->_department_validate();
         $data = array(
          'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
			'slug' => $this->input->post('slug'),
			   'level' => 1,
                'parent_id'=>0,
        );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_department()
    {
        $this->global_model->table = 'inv_categories';
       // $this->_tax_validate();
        $data = array(
          'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
			'slug' => $this->input->post('slug'),
			   'level' => 1,
                'parent_id'=>0,
			
        );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_department($id)
    {
        $this->global_model->table = 'inv_categories';
        $result = $this->db->get_where('inv_products', array('brand' => $id))->result();
        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    }

    private function _department_validate()
    {
        $rules = array(
            array('field' => 'name', 'label' => lang('name'), 'rules' => 'trim|required'),
            array('field' => 'code', 'label' => lang('code'), 'rules' => 'trim|required'),
        );

        $this->global_model->validation($rules);
    }
	
	//categories
	
	public function categories()
    {
        $data['page_title'] = lang('categories');
		$data['department']=$this->db->get_where("inv_categories",array("level"=>1))->result();
        $this->render_admin('procurment/settings/categories', $data);
    }
    public function get_categories() {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
		 $this->load->library('datatables');
        $this->datatables
            ->select("inv_categories.id  ,inv_categories.name ,inv_categories.code,inv_categories.slug,d.name as department,c.name as parent", false)
            ->from("inv_categories")
		  ->join("inv_categories c", 'c.id=inv_categories.parent_id and inv_categories.level=3', 'left')
            ->join("inv_categories d", 'd.id=inv_categories.parent_id and inv_categories.level=2', 'left')
            ->group_by('inv_categories.id')
            ->add_column("Actions", $actions, "inv_categories.id");
        echo $this->datatables->generate();
    }
    public function edit_categories($id)
    {
        $this->global_model->table = 'inv_categories';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function add_categories()
    {
        $this->global_model->table = 'inv_categories';
       // $this->_categories_validate();
         $data = array(
          'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
			'slug' => $this->input->post('slug'),
			   'level' => 1,
               'parent_id' => $this->input->post('parent'),
                
                );
                if($data['parent_id']==''){
                    $data['parent_id']=$this->input->post('department_id');
                    $data['level'] =2;
                }else{
                    $data['level'] =3;
                }
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_categories()
    {
        $this->global_model->table = 'inv_categories';
       // $this->_tax_validate();
        $data = array(
          'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
			'slug' => $this->input->post('slug'),
			   'level' => 1,
               'parent_id' => $this->input->post('parent'),
                
                );
                if($data['parent_id']==''){
                    $data['parent_id']=$this->input->post('department_id');
                    $data['level'] =2;
                }else{
                    $data['level'] =3;
                }
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_categories($id){
        $this->global_model->table = 'inv_categories';
        $result = $this->db->get_where('inv_products', array('category_id' => $id))->result();
        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    }

    private function _categories_validate()
    {
        $rules = array(
            array('field' => 'name', 'label' => lang('name'), 'rules' => 'trim|required'),
            array('field' => 'code', 'label' => lang('code'), 'rules' => 'trim|required'),
        );

        $this->global_model->validation($rules);
    }
	//units 
	
	public function unit(){
        $data['page_title'] = lang('unit');
		$data['base_unit']=$this->db->get("inv_units")->result();
        $this->render_admin('procurment/settings/unit', $data);
    }
    public function get_unit() {
        $actions = "<div class=\"text-center\">";
        $actions .= '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' . "'" . '$1' . "'" . ')"><i class="fa fa-pencil"></i></a>
        		<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' . "'" . '$1' . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        $actions .= "</div>";
		 $this->load->library('datatables');
        $this->datatables
            ->select("inv_units.id,inv_units.name,inv_units.code,b.name as baseuits,inv_units.operator,inv_units.operation_value", false)
            ->from("inv_units")
		  ->join("inv_units b", 'b.id=inv_units.base_unit', 'left')
            ->group_by('inv_units.id')
            ->add_column("Actions", $actions, "inv_units.id");
        echo $this->datatables->generate();
    }
    public function edit_unit($id)
    {
        $this->global_model->table = 'inv_units';
        $data = $this->global_model->get_by_id($id);
        echo json_encode($data);
    }
    public function add_unit()
    {
        $this->global_model->table = 'inv_units';
       // $this->_categories_validate();
        $data = array(
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'base_unit' => $this->input->post('base_unit') ? $this->input->post('base_unit') : NULL,
                'operator' => $this->input->post('base_unit') ? $this->input->post('operator') : NULL,
                'operation_value' => $this->input->post('operation_value') ? $this->input->post('operation_value') : NULL,
                );
        $insert = $this->global_model->save($data);
        echo json_encode(array("status" => true));
    }

    public function update_unit()
    {
        $this->global_model->table = 'inv_units';
       // $this->_tax_validate();
        $data = array(
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'base_unit' => $this->input->post('base_unit') ? $this->input->post('base_unit') : NULL,
                'operator' => $this->input->post('base_unit') ? $this->input->post('operator') : NULL,
                'operation_value' => $this->input->post('operation_value') ? $this->input->post('operation_value') : NULL,
                );
        $this->global_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => true));
    }

    public function delete_unit($id){
        $this->global_model->table = 'inv_units';
        $result = $this->db->get_where('inv_products', array('unit' => $id))->result();
        if (empty($result)) {
            $this->global_model->delete_by_id($id);
            echo 1;
        } else {
            echo 0;
        }

    }

    private function _unit_validate()
    {
        $rules = array(
            array('field' => 'name', 'label' => lang('name'), 'rules' => 'trim|required'),
            array('field' => 'code', 'label' => lang('code'), 'rules' => 'trim|required'),
        );

        $this->global_model->validation($rules);
    }
}
