 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/jquery-ui.css" type="text/css">
 <link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/jquery-ui.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<link href='<?php echo base_url('assets')?>/assets/plugin/datepicker/datepicker3.css' rel='stylesheet' media='screen'>
<script src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap.min.js"></script>
<style>
.error {
    color: #FF0000;
}
	fieldset.scheduler-border{margin: 20px!important;}
	.qty{
    color: #000;
    display: inline-block;
    vertical-align: top;
    font-size: 18px;
    font-weight: 700;
    line-height: 25px;
    padding: 0 2px;
	min-width: 35px;
    text-align: center;
}
	.count {
    color: #000;
    display: inline-block;
    vertical-align: top;
    font-size: 15px;
    font-weight: 700;
    line-height: 25px;
    padding: 0 2px;
	min-width: 50px;
    text-align: center;
}
.qty .plus {
    cursor: pointer;
    display: inline-block;
    vertical-align: top;
    color: white;
    width:25px;
    height: 25px;
    font: 22px/1 Arial,sans-serif;
    text-align: center;
    border-radius: 0%;
    }
.qty .minus {
    cursor: pointer;
    display: inline-block;
    vertical-align: top;
    color: white;
    width: 25px;
    height: 25px;
    font: 22px/1 Arial,sans-serif;
    text-align: center;
    border-radius: 0%;
    background-clip: padding-box;
}

.minus{
    background-color: #2C3542 !important;
}
.plus{
    background-color: #2C3542 !important;
}.minus:hover{
    background-color: #717fe0 !important;
}
.plus:hover{
    background-color: #717fe0 !important;
}
/*Prevent text selection*/

.product_table_s input{  
    border: 0;
    width: 5%;
	background-color: #fff;
}
.product_table_s{border: 1px solid #ccc;}
.product_table_s input::-webkit-outer-spin-button,
.product_table_s input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.product_table_s input:disabled{
    background-color:white;
}
	.product_table_s thead tr th{text-align: center;}
	.product_table_s thead tr th:first-child{text-align: left;}
	.product_table_s thead tr th:last-child{text-align: right;}
	.product_table_s tbody tr td{text-align: center;}
	.product_table_s tbody tr td:first-child{text-align: left;}
	.product_table_s tbody tr td:last-child{text-align: right;}
	
	.has-search .form-control {
    padding-left: 35px;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
	left: 20px;
	top: 6px;
}
/*	*/
	.switch {
	display: inline-block;
	height: 23px;
	position: relative;
	width: 50px;
	margin-bottom: 0px;
}
	.se_mu_cu{float: left;margin-right: 5px;}
.switch input {
  display:none;
}
.slider {
  background-color: #ccc;
  bottom: 0;
  cursor: pointer;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  transition: .4s;
}
.slider:before {
  background-color: #fff;
  bottom: 4px;
  content: "";
  height: 15px;
  left: 4px;
  position: absolute;
  transition: .4s;
  width: 16px;
}
input:checked + .slider {
  background-color: #66bb6a;
}
input:checked + .slider:before {
  transform: translateX(26px);
}
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
	.timeline {
  width: 100%;
  height: 100px;
  margin: 0 auto;
  display: flex;      
  justify-content: center;    
}

.timeline .events {
  position: relative;
  background-color: #606060;
  height: 3px;
  width: 100%;
  border-radius: 4px;
  margin: 5em 0;
 }

.timeline .events ol {
  margin: 0;
  padding: 0;
  text-align: center;
}

.timeline .events ul {
  list-style: none;
}

.timeline .events ul li {
  display: inline-block;
  width: 24.65%;
  margin: 0;
  padding: 0;
}

.timeline .events ul li a {
  font-family: 'Arapey', sans-serif;
  font-style: italic;
  font-size: 1.25em;
  color: #606060;
  text-decoration: none;
  position: relative;
  top: -32px;
}

.timeline .events ul li a:after {
  content: '';
  position: absolute;
  bottom: -22px;
  left: 50%;
  right: auto;
  height: 20px;
  width: 20px;
  border-radius: 50%;
  border: 3px solid #606060;
  background-color: #fff;
  transition: 0.3s ease;
  transform: translateX(-50%);
}

.timeline .events ul li a:hover::after {
  background-color: #194693;
  border-color: #194693;
}

.timeline .events ul li a.selected:after {
  background-color: #194693;
  border-color: #194693;
}
            
.events-content {
  width: 100%;
  height: 100px;
  max-width: 800px;
  margin: 0 auto;
  display: flex;      
  justify-content: left;
}

.events-content li {
  display: none;
  list-style: none;
}

.events-content li.selected {
  display: initial;
}

.events-content li h2 {
  font-family: 'Frank Ruhl Libre', serif;
  font-weight: 500;
  color: #919191;
  font-size: 2.5em;
}
	.timeline:before{display: none;}
</style>
<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/crm/Crm/Clientform') ?>"> <?php echo lang('Client')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<br>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('request_form'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/administration/Administration/form/'.$requestId); ?>"
                        enctype="multipart/form-data" id="requestform">
                            <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('title') ?></label>
                                </div>
                                <div class="col-md-3 title">
                                    <input type="text" name="title" class="form-control " autocomplete='off'
                                        value="<?php if(isset($title)){ echo $title;  }   ?>">
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('date') ?></label>
                                </div>
                                <div class="col-md-3 date">
                                    <input type="text" name="date" class="form-control datepicker" autocomplete='off'
                                        value="<?php if(isset($date)){ echo date('Y-m-d',strtotime($date));  }   ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('requesttype') ?></label>				
                                </div>
                                <div class="col-md-3">
                                    <select name="requesttype" class="form-control" onchange="get_category(this.value)">
                                         <option value=""><?php echo lang('select')?></option>
                                <?php 
								if(isset($requesttypes)){
									foreach($requesttypes as $row){
									?>
                                        <option value="<?php  echo $row->id   ?>"
                                            <?php  if(isset($requestType)){ echo $requestType == $row->id ?'selected':'' ;  } ?>>
                                            <?php  echo $row->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('categorytype') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <select name="categorytype" class="form-control" id="category" onchange="get_subcategory(this.value)">
                                        <option value="">Select</option>
                                        <?php 
								if(isset($category)){
									foreach($category as $item){
									?>
                                        <option value="<?php  echo $item->id   ?>"
                                            <?php  if(isset($categtoryType)){ echo $categtoryType == $item->id ?'selected':'' ;  } ?>>
                                            <?php  echo $item->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                            </div>
                        </div>

						
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('subtype') ?></label><span style="color:red" > *</span>
                                </div>
                                <div class="col-md-3">
                                    <select name="subcategory" class="form-control" id="subcategory" onchange="get_subcategory_details(this.value)">
                                        <option value="">Select</option>
                                        <?php 
							    	if(isset($Subcategory)){
									foreach($Subcategory as $item){
									?>
                                        <option value="<?php  echo $item->id   ?>"
                                            <?php  if(isset($subcategoryType)){ echo $subcategoryType == $item->id ?'selected':'' ;  } ?>>
                                            <?php  echo $item->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('description') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <textarea name="description" autocomplete="off"
                                        class="form-control"><?php if(isset($request_description)){ echo $request_description;  }   ?></textarea>
                                </div>
								</div>
									</div>
									
										 <div class="form-group">
                            <div class="row">
                                
                                 <div class="col-md-2">
                                    <label><?php echo lang('OwnerType') ?></label>				
                                </div>
                                <div class="col-md-3">
                                    <select name="OwnerType" class="form-control"  onchange="get_owners(this.value)">
                                         <option value=""><?php echo lang('select')?></option>
										 <option value="1"   <?php  if(isset($ownertype)){ echo $ownertype == 1 ?'selected':'' ;  } ?>>Owners</option>
										 <option value="2"   <?php  if(isset($ownertype)){ echo $ownertype == 2 ?'selected':'' ;  } ?>>Resident</option>
                                    </select>
                                </div>
								<div class="col-md-2">
                                    <label><?php echo lang('Request_by') ?></label>				
                                </div>
                                <div class="col-md-3">
                                    <select name="requestby" class="form-control"   id="owners" onchange="get_venue(this.value)" >
                                         <option value=""><?php echo lang('select')?></option>
                                <?php 
								if(isset($owners)){
									foreach($owners as $item){
									?>
                                        <option value="<?php  echo $item->id   ?>"
                                           <?php  if(isset($ownerid)){ echo $ownerid == $item->id ?'selected':'' ;  } ?> >
                                            <?php  echo $item->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
								</div>
									</div>
									
										<div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('request_id') ?></label>
                                </div>
                                <div class="col-md-3 request_id">
                                    <input type="text"  class="form-control " autocomplete='off'
                                        readonly  value="<?php if(isset($requestId)){ echo $requestId;  }   ?>">
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('project_name') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <select name="projectid" class="form-control" id="projectid" onchange="get_floors(this.value)">
                                        <option value="">Select</option>
                                        <?php 
								if(isset($Project)){
									foreach($Project as $item){
									?>
                                        <option value="<?php  echo $item->id   ?>"
                                           <?php  if(isset($projectid)){ echo $projectid == $item->id ?'selected':'' ;  } ?> >
                                            <?php  echo $item->Name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                            </div>
                        </div>
									
							
						  <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('Floor_name') ?></label><span style="color:red" > *</span>
                                </div>
                                <div class="col-md-3">
                                    <select name="floorid" class="form-control" id="floor_id" onchange="get_houses(this.value)">
                                        <option value="">Select</option>
                                        <?php 
								if(isset($floors)){
									foreach($floors as $item){
									?>
                                        <option value="<?php  echo $item->id   ?>"
                                           <?php  if(isset($floorid)){ echo $floorid == $item->id ?'selected':'' ;  } ?> >
                                            <?php  echo $item->name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('Houses') ?></label>
                                </div>
                                <div class="col-md-3">
                                   <select name="houseid[]" class="form-control" id="houses">
                                        <option value="">Select</option>
                                       <?php 
								if(isset($houses)){
									foreach($houses as $item){
										 $selected = in_array( $item->uid, $houseid ) ? ' selected="selected" ' : '';   
									?>
                                        <option value="<?php  echo $item->uid   ?>"<?php echo $selected; ?> >
                                            <?php  echo $item->unit_no  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
								</div>
							</div>		
									 <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('request_startDate') ?></label>
                                </div>
                                <div class="col-md-3 request_startDate">
                                    <input type="text" name="request_startDate" class="form-control  datepicker" autocomplete='off'
                                        value="<?php if(isset($requestStartDate)){ echo date('Y-m-d',strtotime($requestStartDate));  }   ?>">
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('request_endDate') ?></label>
                                </div>
                                <div class="col-md-3 request_endDate">
                                    <input type="text" name="request_endDate" class="form-control datepicker" autocomplete='off'
                                        value="<?php if(isset($requestEndDate)  && $requestEndDate !='0000-00-00 00:00:00'){ echo date('Y-m-d',strtotime($requestEndDate));  }   ?>">
                                </div>
                            </div>
                        </div>	
						
						
						 <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('request_status') ?></label>
                                </div>
                                <div class="col-md-3 request_status">
                                     <select name="request_status" class="form-control"  >
                                        <option value="" ><?php echo lang('select');  ?></option>
		                       <option value="<?php echo lang('Initiated'); ?>" <?php if(!empty($status)) echo $status ==    lang('Initiated') ? 'selected':''   ?>><?php echo lang('Initiated');  ?></option>
		                    <option value="<?php echo lang('Inprogress'); ?>" <?php if(!empty($status)) echo $status == lang('Inprogress') ?'selected':''  ?>><?php echo lang('Inprogress'); ?></option>
			               <option value="<?php echo lang('Accepted'); ?>" <?php if(!empty($status)) echo $status == lang('Accepted') ?'selected':''  ?>><?php echo lang('Accepted'); ?></option>
			                 <option value="<?php echo lang('ReInitiated'); ?>" <?php if(!empty($status)) echo $status == lang('ReInitiated') ?'selected':''  ?>><?php echo lang('ReInitiated'); ?></option>
			                  <option value="<?php echo lang('Completed'); ?>" <?php if(!empty($status)) echo $status == lang('Completed') ?'selected':''  ?>><?php echo lang('Completed'); ?></option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('assign_to') ?></label>
                                </div>
                                <div class="col-md-3 assign_to">
                                    <select name="assign_to[]" class="form-control" multiple="multiple" id="assign_to" onchange="get_subcategory_details(this.value)">
                                        <option value="">Select</option>
                                          <?php 
							    	if(!empty($services_persons)){
									foreach($services_persons as $item){
										$selected = in_array( $item->id, $assignto ) ? ' selected="selected" ' : ''; 
									?>
                                        <option value="<?php  echo $item->id   ?>"   <?php echo $selected; ?> >
                                          
                                            <?php  echo $item->first_name  ?></option>
                                        <?php
									}
								}
								?>
                                    </select>
                                </div>
                            </div>
                        </div>
						
							<div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('assignee_comments') ?></label>
                                </div>
                                <div class="col-md-3 assignee_comments">
                                   <textarea  autocomplete="off"
                                        class="form-control" disabled><?php if(isset($assignee_comments)){ echo $assignee_comments;  }   ?></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('rescheduling') ?></label>
                                </div>
                                <div class="col-md-3 rescheduling">
                                    <input type="text" name="rescheduling" class="form-control datepicker" autocomplete='off'
                                     value=" <?php if(isset($rescheduling) && $rescheduling !='0000-00-00 00:00:00'){ echo date('Y-m-d',strtotime($rescheduling));  }   ?> ">
                                </div>
                            </div>
                        </div>		
							
						 
								  <div class="form-group">
                              <div class="row">
								 <div class="col-md-2">
                                    <label><?php echo lang('services_cost') ?></label>
                                </div>
                                <div class="col-md-3">
                                      <input type="text" id="price" name="service_cost" value="<?php if(isset($services_cost)){ echo $services_cost;  }   ?>" class="form-control " autocomplete='off'
                                         readonly>
                                </div>
								<div class="col-md-2">
                                    <label><?php echo lang('admin_note') ?></label>
                                </div>
                                <div class="col-md-3 rescheduling">
                                    <textarea name="adminnote" autocomplete="off"
                                        class="form-control" ><?php if(isset($assignee_comments)){ echo $assignee_comments;  }   ?></textarea>
                                </div>
                            </div>
                        </div>	
						 <div class="form-group">
                            <div class="row">
                                
                                <div class="col-md-2">
                                    <label><?php echo lang('Venue') ?></label>
                                </div>
                                <div class="col-md-3 Venue">
                                   <textarea name="venue" autocomplete="off"
                                        class="form-control"><?php if(isset($Venue)){ echo $Venue;  }   ?></textarea>
                                </div>
                            </div>
                        </div>
                <div class="row">
					<div class="col-sm-12">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Materials</legend>
							 <div class="col-sm-8 col-sm-offset-2">
									 <div class="form-group has-search ui-widget">
										<span class="fa fa-search form-control-feedback"></span>
										<input type="text" name="" id="add_products" placeholder="Search the Products" class="search-query form-control ui-autocomplete-input" autocomplete="off">
											<p id="project-description"></p>
									  </div>
							 </div>
							
							<table class="table table-striped product_table_s" style="table-layout: fixed;">
								<thead>
									<tr>
										<th>Product Name</th>
										<th>Avail Qty</th>
										<th class="text-center">Qty</th>
										<th class="text-center">Cost</th>
										<th class="text-center">Total cost</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody id="productlist" class="productlist">
								
								<?php   if(!empty($material)){  foreach($material as $item){  ?>
							<tr><td><?php  echo $item->code .'-'.$item->name ;  ?></td><td></td><td class="text-center"><div class="qty"><span class="minus bg-dark">-</span><input type="number" class="count" name="qty[]" value="<?php  echo $item->qty;  ?>"><span class="plus bg-dark">+</span></div></td><td class="cost"><?php  echo $item->cost;  ?></td><td class="totalcost"><?php  echo $item->total_cost;  ?></td><td><input type="hidden" class="subtotal" name="subtotal[]" value="<?php  echo $item->total_cost;  ?>"<input type="hidden" class="productcost" name="produccost[]" value="<?php  echo $item->cost;  ?>"><input type="hidden" name="productid[]" id="productid" value="<?php  echo $item->product_id;  ?>"><span class="glyphicon glyphicon-trash removeOption" onclick="removerow()" style="color:red;"></span></td></tr>
									<tr >
								<?php  }  } ?>
										<td colspan="3"></td>
										<td ><b>Total</b><input type="hidden" name="materialtotal"class="materialgrandtotal" ></td>
										<td id="total" style="font-weight:bold;"></td>
									</tr>
								</tbody>
							</table>
						</fieldset>
					</div>
    			</div>
           		<div class="row">
					<div class="col-sm-12">
						<div class="form-group col-sm-12">
							<span class="se_mu_cu">Is Paid</span>
							<label class="switch" for="chkcurrency">
								<input type="checkbox" class="skip" name="is_paid"id="chkcurrency" value="1" checked />
								<div class="slider round"></div>
							</label>
						</div>
					</div>
					<div class="col-sm-12">
					<fieldset class="scheduler-border ">
						<legend class="scheduler-border">Payment Details</legend>
						<div id="dvdropdown" style="display: block">
							<table class="table table-striped product_table_s" style="table-layout: fixed;">
								<thead>
									<tr>
										<th>Services Name</th>
										<th class="text-center">Cost</th>
										<th class="text-center">Total</th>
									</tr>
								</thead>
								<tbody>
								<?php if(!empty($payment_details)){ $i=1; foreach($payment_details as $payment){  ?>
									<tr>
										<td><?php echo $payment->services_name;   ?> <input type="hidden" name="servicesName[]" value="<?php echo $payment->services_name;   ?>">
										<input type="hidden" name="cost[]"   value="<?php echo $payment->services_cost;   ?>"  class="Material_cost<?php  echo $i;  ?>">
										<input type="hidden" name="totalcost[]" value="<?php echo $payment->services_cost;   ?>" class="Material_totalcost<?php  echo $i;  ?>"></td>
										<td class="mat_cost<?php  echo $i;  ?>"><?php echo $payment->services_cost;   ?></td>
										<td class="mat_cost<?php  echo $i;  ?>"><?php echo $payment->services_cost;   ?></td>
									</tr>
									
								<?php   $i++; }   } else{ ?>
								<tr>
										<td>Material charges <input type="hidden" name="servicesName[]" value="Services Chagres">
										<input type="hidden" name="cost[]"       class="Material_cost1">
										<input type="hidden" name="totalcost[]"  class="Material_totalcost1"></td>
										<td class="mat_cost1"></td>
										<td class="mat_cost1"></td>
									</tr>
									<tr>
										<td><input type="text"  name="servicesName[]"  class="form-control" readonly value="Others" style="width:100%;background-color:#fff;"></td>
										<td><input type="text" name="cost[]" value="0"  class="form-control others allownumericwithdecimalpoint" style="width:100%;background-color:#fff;"></td>
										<td class="col-md-12"><input type="text" name="totalcost[]"	 class="form-control others" style="width:100%;background-color:#fff;" readonly value="0"> </td>
									</tr>
								<?php  } ?>
									<tr >
										<td colspan="1"></td>
										<td ><b>Total <input type="hidden" name="payment_total"class="payment_total"  value="<?php  echo $total_amount-$services_cost;  ?>"></b></td>
										<td class="paymenttotal"><b><?php echo  ($total_amount-$services_cost >=0)?$total_amount-$services_cost:0;  ?></b></td>
									</tr>
								</tbody>
							</table>
						</div>
					</fieldset>
					</div>
					</div>
   				<!--<div class="row">
					<div class="col-sm-12">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Assignee Details</legend>
							<table class="table table-striped product_table_s_s" style="border: 1px solid #ccc;">
							<colgroup>
								<col width="20%">
								<col width="2%">
								<col width="30%">
							</colgroup>
								<tbody>
									<tr>
										<td>Assignee Names</td>
										<td>:</td>
										<td>1000</td>
									</tr>
									<tr>
										<td>Department</td>
										<td>:</td>
										<td></td>
									</tr>
									<tr>
										<td>Type</td>
										<td>:</td>
										<td></td>
									</tr>
								
								</tbody>
							</table>
							
						</fieldset>
					</div>
    			</div>-->
    		<!--	<div class="row">
					<div class="col-sm-12"><h4 style="margin-left:12px;">Track Status</h4>
						 <div class="timeline col-sm-12">
							  <div class="events">
								<ol>
								  <ul>
									<li>
									  <a href="#0" class="selected">services Request Accepted</a>
									</li>
									<li>
									  <a href="#1" class="selected">text1</a>
									</li>
									<li>
									  <a href="#2">text1</a>
									</li>
									<li>
									  <a href="#3">text1</a>
									</li>
								  </ul>
								</ol>
							  </div>
						</div>
					</div>
					</div>-->
    			
                        <div class="box-footer">
                                <input class="btn btn-primary" type="submit" id="request" value="Save" />
                            </div>
                    </form>
					
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    
</section>

<script src="<?php echo base_url('assets/plugin/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>
<script>
$(function() {
    $('.datepicker').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd',
    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#assign_to').multiselect();
});
		$(document).ready(function(){
			var count=0;
			var cost=0;
			var totalcost=0;
		   //$('.count').prop('disabled', true);
   			$(document).on('click','.plus',function(){
				count=(parseInt($(this).closest('tr').find(".count").val()));
				var productid=$(this).closest('tr').find("#productid").val();
				//stockcheck(count);
				count +=  1;
				cost=$(this).closest('tr').find(".cost").text();
				totalcost=parseFloat(count)*parseFloat(cost);
				$(this).closest('tr').find(".count").val(count);
				$(this).closest('tr').find(".totalcost").text(totalcost);
				$(this).closest('tr').find(".subtotal").val(totalcost);
				//$(this).closest('tr').css('background-color','#ffcccc');
				grandtotals();
    		});
        	$(document).on('click','.minus',function(){
    			count=(parseInt($(this).closest('tr').find(".count").val()))- 1;
    				if (count > 0) {
						cost=$(this).closest('tr').find(".cost").text();
				        totalcost=parseFloat(count)*parseFloat(cost);
				     	$(this).closest('tr').find(".count").val(count);
						$(this).closest('tr').find(".totalcost").text(totalcost);
						$(this).closest('tr').find(".subtotal").val(totalcost);
						grandtotals();
					}
    	    	});
 		});
		function grandtotals(){
	    var grandtotal=0;
	    $(".subtotal").each(function() {
        grandtotal +=parseFloat(this.value);
    });
	$('#total').text(formatMoney(grandtotal));
	$('.materialgrandtotal').val(grandtotal);
	$('.mat_cost1').text(grandtotal);
	$('.Material_cost1').val(grandtotal);
	$('.Material_totalcost1').val(grandtotal);
	$('.paymenttotal').text(grandtotal);
	$('.payment_total').val(grandtotal);
}
	
</script>

<script>
$(".product_table_s").on("click", ".removeOption", function(event) {
      $(this).closest("tr").remove();
	  grandtotals();
 });
</script>
<script>
function formatSA (x) {
    x=x.toString();
    var afterPoint = '';
    if(x.indexOf('.') > 0)
       afterPoint = x.substring(x.indexOf('.'),x.length);
    x = Math.floor(x);
    x=x.toString();
    var lastThree = x.substring(x.length-3);
    var otherNumbers = x.substring(0,x.length-3);
    if(otherNumbers != '')
        lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
    return res;
}
function formatMoney(x, symbol) {
	
	var currencysymbol=<?php echo $settings->symbol;   ?>;
	var display_symbol=<?php echo $settings->display_symbol;   ?>;
	var decimals =<?php echo  $settings->decimals;   ?>;
	var thousands_sep ='<?php echo $settings->thousands_sep;   ?>';
	var decimals_sep ='<?php echo $settings->decimals_sep;   ?>';
	var sac ='<?php echo $settings->sac;   ?>';
    if(!symbol) { symbol = ""; }
    if(sac == 1) {
		alert('dd');
        return (display_symbol == 1 ? currencysymbol : '') +
            ''+formatSA(parseFloat(x).toFixed(decimals)) +
            (display_symbol == 2 ? currencysymbol : '');
    }
    var fmoney = accounting.formatMoney(x, symbol, decimals,thousands_sep == 0 ? ' ' : thousands_sep, decimals_sep);
	return fmoney; 
	/*   return (display_symbol == 1 ? <?php echo $settings->symbol;   ?> : '') +
        fmoney +
        (display_symbol == 2 ? <?php echo $settings->symbol;   ?> : ''); 
		*/
  
}
</script>
<script>
$('.others').on('change',function(e){
   var service_cost=0;
   var total_cost=0;
     if( $('.Material_cost1').val() ) {		 
		  service_cost=parseFloat($('.Material_cost1').val());
		
      }
 $('.others').val($(this).val());
   total_cost=(service_cost)+(parseFloat($(this).val()));
   $('.payment_total').val(total_cost);
   $('.paymenttotal').text(total_cost);
   
});
$(".allownumericwithdecimalpoint").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
     $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
		$(function () {
	
        $("#chkcurrency").click(function () {
            if ($(this).is(":checked")) {
                $("#dvdropdown").show();
            } else {
                $("#dvdropdown,#currency_ex_rate").hide();
            }
        });
    });

</script>
  <script>
  
	function itemload(productid){
		$.ajax({
                    type: 'post',
                    url: getBaseURL()+'admin/administration/Administration/productSelect',
                    dataType: "html",
                    data: {
                        productid: productid
                    },
					cache: false,
                    success: function (results) {
						$( "#productlist" ).append(results);
						// document.getElementById('test').value = '<input type="text" name="hi" value="fff">';
                    }
                });

	}
  
  </script>