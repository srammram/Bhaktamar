<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
    $(document).ready(function(){
        loadSubcategories($('#category').val())
         $('#category').change(function () {
            var v = $(this).val();
            loadSubcategories(v)
        });
        
        $product_id = $('#search-product').val();
        if ($product_id!='') {
            $.ajax({
                url : site.base_url+"products/getproduct_byID",
                type:'get',
                dataType:'json',
                data:{id:$product_id},
                success:function(scdata){
                    $("#search-product").select2("destroy").empty().attr("placeholder", "Please select subcategory").select2({
                                    placeholder: "Please select Subcategory",
                                    minimumResultsForSearch: 7,
                                    data: scdata
                    });
                }
            })
        }
        
        $batch_id = $('#search-batch-no').val();
        if ($batch_id!='') {
            $.ajax({
                url : site.base_url+"products/getBatchNo_byID",
                type:'get',
                dataType:'json',
                data:{id:$batch_id},
                success:function(scdata){
                    $("#search-batch-no").select2("destroy").empty().attr("placeholder", "Please select Batch No").select2({
                                    placeholder: "Please select Batch No",
                                    minimumResultsForSearch: 7,
                                    data: scdata
                    });
                }
            })
        }
        
        $supplier_id = $('#supplier').val();
        if ($supplier_id!='') {
            $.ajax({
                url : site.base_url+"products/getSupplier_byID",
                type:'get',
                dataType:'json',
                data:{id:$supplier_id},
                success:function(scdata){
                    $("#supplier").select2("destroy").empty().attr("placeholder", "Please select subcategory").select2({
                                    placeholder: "Please select Subcategory",
                                    minimumResultsForSearch: 7,
                                    data: scdata
                    });
                }
            })
        }
        
        $('#reset').click(function(){
           
           $("#category").select2("val", "");
           $("#brand").select2("val", "");
          // $("#search-products-form input").val('');
           $('#input-selling-price').val('');
           $('#input-mrp').val('');
           $('#input-cost-price').val('');
           $("#subcategory").select2("val", "");
           $empty = [];
           $("#subcategory").select2("destroy").empty().attr("placeholder", "Please select subcategory").select2({
                                    placeholder: "Please select Subcategory",
                                    minimumResultsForSearch: 7,
                                    data: $empty
                    });
           $("#supplier").select2("val", "");
           $("#supplier").select2("destroy").empty().attr("placeholder", "Please select Supplier").select2({
                                    placeholder: "Please select Supplier",
                                    minimumResultsForSearch: 7,
                                    data: $empty
                    });
           $("#search-product").select2("val", "");
           $("#search-product").select2("destroy").empty().attr("placeholder", "Please select product").select2({
                                    placeholder: "Please select product",
                                    minimumResultsForSearch: 7,
                                    data: $empty
                    });
           $("#search-batch-no").select2("val", "");
           $("#search-batch-no").select2("destroy").empty().attr("placeholder", "Please select Batch no").select2({
                                    placeholder: "Please select Batch No",
                                    minimumResultsForSearch: 7,
                                    data: $empty
                    });
            $.ajax({
                url:site.base_url+"products/reset_product_search",
                type:'get',
                success:function(){
                   // window.location.reload();
                }
            });
           
        });
        $('.p-selling-price').dblclick(function(){
            $(this).attr('readonly',false);
        });
        $('.p-selling-price').blur(function(){
            $(this).attr('readonly',true);
        });
        
        $('#search-batch-no').select2({
            minimumInputLength: 1,
            ajax: {
             url: site.base_url+"products/getBatchNos",
             dataType: 'json',
             quietMillis: 15,
             data: function (term, page) {
                 return {
                     term: term,
                     limit: 10
                 };
             },
             results: function (data, page) {
                 if(data.results != null) {
                     return { results: data.results };
                 } else {
                     return { results: [{id: '', text: 'No Match Found'}]};
                 }
             }
         }
        });
         
         
    });
    function loadSubcategories(v){
        if (v) {
                $.ajax({
                    type: "get",
                    async: false,
                    url: '<?=admin_url('products/getSubCategories/')?>'+v,
                    dataType: "json",
                    success: function (scdata) {
                        if (scdata != null) {
                            scdata.push({id: '', text: 'Please Select Subcategory'});
                            $("#subcategory").select2("destroy").empty().attr("placeholder", "Please select subcategory").select2({
                                placeholder: "Please select Subcategory",
                                minimumResultsForSearch: 7,
                                data: scdata
                            });
                        } else {
                            $("#subcategory").select2("destroy").empty().attr("placeholder", "No Cards").select2({
                                placeholder: "No Subcategory",
                                minimumResultsForSearch: 7,
                                data: [{id: '', text: 'No Subcategory'}]
                            });
                        }
                    },
                    error: function () {
                        bootbox.alert('Ajax error occurred, Please tray again.');
                        $('#modal-loading').hide();
                    }
                });
            } else {
                $("#subcategory").select2("destroy").empty().attr("placeholder", "Please select subcategory").select2({
                    placeholder: "Please select subcategory",
                    minimumResultsForSearch: 7,
                    data: [{id: '', text: 'Please select subcategory'}]
                });
            }
            
    }
</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-cog"></i><?= lang('selling_price_change'); ?></h2>
    </div>
    <div class="box-content">
        <div class="upload-btn-wrapper col-sm-12 well">
            
            
            <form action="<?=admin_url('products/selling_price_change_bycsv')?>" method="post"  enctype="multipart/form-data" id="upload-form">
            <div class="file-upload-wrapper col-sm-4" data-text="Select your file!">
			  <input name="userfile" type="file" class="file-upload-field" value="">
			</div>
<!--            <input type="file" name=""  style="display: inline;">-->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="col-sm-6"><input type="submit"  id="import-csv" class="btn btn-primary" value="Import">&nbsp;&nbsp;<button type="button" id="reset" class="btn btn-primary btn-danger">Reset</button></div>
            
            </form>
        </div>
        <form action="<?=admin_url('products/selling_price_change')?>" method="post"  id="search-products-form">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="row">
                <div class="col-lg-12 selling_s">
				   <div class="row">
						<div class="form-group col-sm-4">
							<label class="control-label col-sm-4">Category</label>
							<div class="col-sm-8">
								<select name="category_id" id="category" class="form-control">
									<option value="">All</option>
									<?php foreach($categories as $k => $category) : ?>
										<option value="<?=$category->id?>" <?php if($this->session->userdata('category_id')==$category->id) { echo 'selected="selected"';}?>><?=$category->name?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group col-sm-4">
							<label class="control-label col-sm-5">Sub Category</label>
							<div class="col-sm-7">
								<input type="text" name="subcategory_id" value="<?=$this->session->userdata('subcategory_id')?>" id="subcategory" class="form-control">
							</div>
						</div>
						<div class="form-group col-sm-4">
							<label class="control-label col-sm-4">Brand</label>
							<div class="col-sm-8">
								<select name="brand" id="brand" class="form-control">
									<option value="">Please Select Brand</option>
									<?php foreach($brands as $k => $brand) : ?>
										<option value="<?=$brand->id?>" <?php if($this->session->userdata('brand')==$brand->id) { echo 'selected="selected"';}?>><?=$brand->name?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group col-sm-4">
								<label class="control-label col-sm-4">Supplier</label>
								<div class="col-sm-8">
										<input type="text" name="supplier"  value="<?=$this->session->userdata('supplier');?>" data-val="<?=$this->session->userdata('supplier');?>" id="supplier" class="form-control">
								</div>
						</div>
						<div class="form-group col-sm-4">
								<label class="control-label col-sm-5">Product</label>
								<div class="col-sm-7">
										<input type="text" name="product" value="<?=$this->session->userdata('product');?>" data-val="<?=$this->session->userdata('product');?>" id="search-product" class="form-control">
								</div>
						</div>
					 	<div class="form-group col-sm-1">
                            <input type="submit" name="show" class="btn btn-primary" value="Show" id="search-products-submit">
                        </div>
                        <div class="form-group col-sm-3">
                            <input type="submit" name="download" class="btn btn-primary" value="Download Products" id="download-products-submit">                                
                        </div>
					</div>
                        <div class="row rect_a">
							<div class="form-group col-sm-4" style="padding: 0px;">
								<label class="control-label col-sm-5">Batch No</label>
								<div class="col-sm-7">
										<input type="text" name="batch_no" value="<?=$this->session->userdata('batch_no');?>" data-val="<?=$this->session->userdata('batch_no');?>" id="search-batch-no" class="form-control">
								</div>
							</div>
							<div class="form-group col-sm-3" style="padding: 0px;">
									<label class="control-label col-sm-6">Cost Price</label>
									<div class="col-sm-6">
											<input type="text" name="cost_price" id="input-cost-price" class="form-control"  value="<?=$this->session->userdata('cost_price');?>">
									</div>
							</div>
							<div class="form-group col-sm-3" style="padding: 0px;">
									<label class="control-label col-sm-7">Selling Price</label>
									<div class="col-sm-5">
											<input type="text" name="selling_price"  id="input-selling-price" value="<?=$this->session->userdata('selling_price');?>" class="form-control">
									</div>
							</div>
                                                        <?php if($this->pos_settings->show_mrp) : ?>
							<div class="form-group col-sm-2" style="padding: 0px;">
									<label class="control-label col-sm-5">MRP</label>
									<div class="col-sm-7">
											<input type="text" name="mrp" id="input-mrp" class="form-control" value="<?=$this->session->userdata('mrp');?>">
									</div>
							</div>
                                                        <?php endif; ?>
                        </div>
                       
                </div>
            </div>
        </form>
        <form action="<?=admin_url('products/selling_price_change')?>" method="post" id="appy-price-form">
   <div class="row">
   	<div class="well well-sm col-sm-12 ">
   		<h4 class="text-danger">Based on Cost Price <?php if($this->pos_settings->show_mrp) : ?>and MRP<?php endif; ?></h4>
   		<div class="form-group col-sm-4">
   			<select id="change-price-type" class="form-control">
   				<!--<option value="mrp"><?=lang('mrp')?></option>
   				<option value="purchase_cost"><?=lang('purchase_cost')?></option>-->
                                <option value="selling_price"><?=lang('selling_price')?></option>
   			</select>
   		</div>
		<div class="form-group col-sm-1 text-center">=</div>
   		<div class="form-group col-sm-2">
   			<select id="select-price-type"  class="form-control">
                            <?php if($this->pos_settings->show_mrp) : ?>
   				<option value="mrp"><?=lang('mrp')?></option>
                                <?php endif; ?>
   				<option value="purchase_cost"><?=lang('purchase_cost')?></option>
                                <option value="selling_price"><?=lang('current_selling_price')?></option>
   			</select>
   		</div>
   		<div class="form-group col-sm-3">
			<div class="col-sm-6 plus-minus-container">
				<input type="radio" name="plus_minus" value="+" id="plus" checked="checked" class="plus_minus skip form-control">
				<label for="plus" style="border-right: 1px solid #908d8d;">+</label>  
				<input type="radio" name="plus_minus"  value="-" id="minus" class="plus_minus skip form-control">
				<label for="minus">-</label>
			</div>
			<div class="col-sm-6">
				<input type="text" name="add_value" id="update-with" class="form-control">
			</div>
   		</div>
   		<div class="form-group col-sm-2">
			<button type="button" class="btn btn-primary" id="apply-new-price">Apply</button>
  			<input type="submit" name="save" class="btn btn-success" value="Save">
   		</div>
   	</div>
   </div>
   
   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="row">
             <div class="col-sm-12 prise_lit table-responisve price_sr">
             <h4 class="text-primary">Price List</h4>
                     <table id="product-list" class="table table-bordered table-striped">
						 <thead>
						 	
							 <tr>
								<th>S No</th>
                                                                <th>Code</th>
								<th>product Name</th>
                                                                <th>Category</th>
                                                                <th>Batch No</th>
                                                                <th>Selling Price</th>
                                                                <?php if($this->pos_settings->show_mrp) : ?>
                                                                    <th>MRP</th>
                                                                <?php endif; ?>                                                                
                                                                <th>Cost Price</th>
							 </tr>
						 </thead>
						 <tbody>
							<?php if(isset($products) && !empty($products)) : ?>
							<?php foreach($products as $k => $product) : ?>
							<tr>
								<td><?=$k+1?></td>
								<td><?=$product->code?></td>
                                                                <td><?=$product->name?></td>
                                                                <td><?=$product->category_name?></td>
								<td><?=$product->batch_no?><input type="hidden" readonly name="selling_price[<?=$product->id.'_'.$product->batch_id?>][batch_no]" class="p-batch-no" value="<?=$product->batch_no?>">
								<input type="hidden" readonly name="selling_price[<?=$product->id.'_'.$product->batch_id?>][batch_id]" class="p-batch-id" value="<?=$product->batch_id?>">
                                                                <input type="hidden" readonly name="selling_price[<?=$product->id.'_'.$product->batch_id?>][stock_id]" class="p-stock-id" value="<?=$product->stock_id?>">
								<input type="hidden" readonly name="selling_price[<?=$product->id.'_'.$product->batch_id?>][id]" class="p-id" value="<?=$product->id?>"></td>
								  

							<td><input type="text" readonly name="selling_price[<?=$product->id.'_'.$product->batch_id?>][price]" class="p-selling-price" value="<?=$product->price?>">
                                                        <input type="hidden" readonly name="selling_price[<?=$product->id.'_'.$product->batch_id?>][existing_price]" class="p-ex-selling-price" value="<?=$product->price?>">
                                                        </td>
                                                        <?php if($this->pos_settings->show_mrp) : ?>
							<td><span class="p-mrp-label"><?=$product->mrp?></span><input type="hidden" name="mrp[<?=$product->id?>]" class="p-mrp" value="<?=$product->mrp?>"></td>
                                                        <?php endif; ?>   
							<td><span class="p-purchase-cost-label"><?=$product->cost?></span><input type="hidden" name="purchase_cost[<?=$product->id?>]" class="p-purchase-cost" value="<?=$product->cost?>"></td>

							</tr>
							<?php endforeach; ?>
							<?php else : ?>
							<tr><td colspan=7 style="text-align: center;">No products Found</td></tr>
							<?php endif; ?>
						 </tbody>
                     </table>
             </div>
             <div class="form-group pull-right" style="margin-top: 15px;margin-right: 15px;">
               <input type="submit" name="save" class="btn btn-success" value="Save">
             </div>
        </div>
   </form>
   
    
    </div>
</div>
<style>
    input[type="radio"] {  
    opacity:0;
    display: none;
}

input[type="radio"] + label {
    font-size: 25px;
    text-transform: uppercase;
    color: #000;
    cursor: pointer;
    margin-top: 0px;
    margin-bottom: 0px;
    width: 29px;
    height: 30px;
    line-height: 24px;
    float: left;
    display: inline-block;
    text-align: center;
    border-radius: 50px;
    border: 1px solid #908d8d;
    margin-right: 2px;
	border-right: 1px solid #908d8d;
}

input[type="radio"] + label span {
    display:inline-block;
    width:30px;
    height:10px;
    margin:1px 0px 0 -30px;                       
    cursor:pointer;
    border-radius: 20%;
}


input[type="radio"] + label  {
    background-color: #FFFFFF 
}


input[type="radio"]:checked + label{
     background-color: #0083ad;  
	color: #fff;
}
.plus-minus-container{
    width:75px;
	padding: 1px 5px;
	border-radius: 50px;
    display: inline-block;
}
input[readonly="readonly"] {
    border: none;
    background: none;
}
</style>
<script>
$("form").on("change", ".file-upload-field", function(){ 
    $(this).parent(".file-upload-wrapper").attr("data-text",         $(this).val().replace(/.*(\/|\\)/, '') );
});
</script>
