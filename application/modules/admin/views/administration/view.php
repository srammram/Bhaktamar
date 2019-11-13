 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/jquery-ui.css" type="text/css">
 <link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/jquery-ui.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<link href='<?php echo base_url('assets')?>/assets/plugin/datepicker/datepicker3.css' rel='stylesheet' media='screen'>


  
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
/*	*/
/* Timeline */
.timeline,
.timeline-horizontal {
  list-style: none;
  padding: 20px;
  position: relative;
	overflow-x: scroll;
}
.timeline:before {
  top: 40px;
  bottom: 0;
  position: absolute;
  content: " ";
  width: 3px;
  background-color: #eeeeee;
  left: 50%;
  margin-left: -1.5px;
}
.timeline .timeline-item {
  margin-bottom: 20px;
  position: relative;
}
.timeline .timeline-item:before,
.timeline .timeline-item:after {
  content: "";
  display: table;
}
.timeline .timeline-item:after {
  clear: both;
}
.timeline .timeline-item .timeline-badge {
  color: #fff;
    width: 25px;
    height: 25px;
    line-height: 25px;
    font-size: 22px;
    text-align: center;
    position: absolute;
    top: 18px;
    left: 50%;
    margin-left: -25px;
    background-color: #333;
    border: 3px solid #ffffff;
    z-index: 100;
    border-top-right-radius: 50%;
    border-top-left-radius: 50%;
    border-bottom-right-radius: 50%;
    border-bottom-left-radius: 50%;
    top: 73%!important;
}
.timeline .timeline-item .timeline-badge i,
.timeline .timeline-item .timeline-badge .fa,
.timeline .timeline-item .timeline-badge .glyphicon {
  top: 2px;
  left: 0px;
}
.timeline .timeline-item .timeline-badge.primary {
  background-color: #2c3542;
}
.timeline .timeline-item .timeline-badge.info {
  background-color: #5bc0de;
}
.timeline .timeline-item .timeline-badge.success {
  background-color: #59ba1f;
}
.timeline .timeline-item .timeline-badge.warning {
  background-color: #d1bd10;
}
.timeline .timeline-item .timeline-badge.danger {
  background-color: #ba1f1f;
}
.timeline .timeline-item .timeline-panel {
  position: relative;
  width: 46%;
  float: left;
  right: 16px;
  border: 1px solid #777;
  background: #ffffff;
  border-radius: 2px;
  padding: 20px;
  -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
  box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
}
.timeline .timeline-item .timeline-panel:before {
  position: absolute;
  top: 26px;
  right: -16px;
  display: inline-block;
  border-top: 16px solid transparent;
  border-left: 16px solid #777;
  border-right: 0 solid #777;
  border-bottom: 16px solid transparent;
  content: " ";
}
.timeline .timeline-item .timeline-panel .timeline-title {
  margin-top: 0;
  color: inherit;
}
.timeline .timeline-item .timeline-panel .timeline-body > p,
.timeline .timeline-item .timeline-panel .timeline-body > ul {
  margin-bottom: 0;
}
.timeline .timeline-item .timeline-panel .timeline-body > p + p {
  margin-top: 5px;
}
.timeline .timeline-item:last-child:nth-child(even) {
  float: right;
}
.timeline .timeline-item:nth-child(even) .timeline-panel {
  float: right;
  left: 16px;
}
.timeline .timeline-item:nth-child(even) .timeline-panel:before {
  border-left-width: 0;
  border-right-width: 14px;
  left: -14px;
  right: auto;
}
.timeline-horizontal {
  list-style: none;
  position: relative;
  padding: 20px 0px 20px 0px;
  display: inline-block;
}
.timeline-horizontal:before {
  height: 3px;
  top: auto;
  bottom: 26px;
  left: 20px;
  right: 0;
  width: 190%;
  margin-bottom: 20px;
}
.timeline-horizontal .timeline-item {
  display: table-cell;
  height: 150px;
  width: 20%;
  min-width: 320px;
  float: none !important;
  padding-left: 0px;
  padding-right: 20px;
  margin: 0 auto;
  vertical-align: bottom;
}
.timeline-horizontal .timeline-item .timeline-panel {
  top: auto;
  bottom: 64px;
  display: inline-block;
  float: none !important;
  left: 0 !important;
  right: 0 !important;
  width: 100%;
  margin-bottom: 20px;
}
.timeline-horizontal .timeline-item .timeline-panel:before {
  top: auto;
  bottom: -16px;
  left: 28px !important;
  right: auto;
  border-right: 16px solid transparent !important;
  border-top: 16px solid #777 !important;
  border-bottom: 0 solid #777 !important;
  border-left: 16px solid transparent !important;
}
.timeline-horizontal .timeline-item:before,
.timeline-horizontal .timeline-item:after {
  display: none;
}
.timeline-horizontal .timeline-item .timeline-badge {
  top: auto;

  bottom: 0px;
  left: 59px;
}

	.form-control{border: none;box-shadow: none;}
	.form-control:hover,.form-control:focus{box-shadow: none;outline: none;border:none;}
	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{background-color: transparent;}
	select::-ms-expand {
    display: none;
}
	select {
    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
}
	.multiselect{border: none;}
	.multiselect{
		-webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
	}
	.multiselect:hover,.multiselect:focus{border: none;background-color: transparent;}
	.multiselect .caret{display: none;}
	.comments_box .form-control{border: 1px solid #ccc;}
	.comments_box label{font-size: 14px;}
	
	
	.radio-stars {
  display: inline-block;
  position: relative;
  unicode-bidi: bidi-override;
  direction:rtl;
  counter-reset: star-rating;
  font-size: 0;
}
.radio-stars:hover .radio-star::before {
  content: '☆';
}
.radio-stars:hover .radio-star:hover::before,
.radio-stars:hover .radio-star:hover ~ .radio-star::before {
  content: '★';
}

.radio-star {
  display: inline-block;
  overflow: hidden;
  cursor: pointer;
  padding: 0 2px;
  width: .9em;
  direction: ltr;
  color: rgba(0, 0, 0, 0.25);
  font-size: 40px;
  white-space: nowrap;
}
.radio-star::before {
  content: '☆';
}
.radio-star:hover, .radio-star:hover ~ .radio-star, input:checked ~ .radio-star {
  color: orange;
}
input:checked ~ .radio-star {
  counter-increment: star-rating;
}
input:checked ~ .radio-star::before {
  content: '★';
}

.radio-star-total {
  pointer-events: none;
  direction: ltr;
  unicode-bidi: bidi-override;
  position: absolute;
  right: -2em;
  bottom: .5em;
  color: gray;
  color: white;
  font-size: 20px;
}
.radio-star-total::before {
  content: counter(star-rating) "/5";
}
	.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  overflow: hidden;
  margin: -1px;
  padding: 0;
  clip: rect(0, 0, 0, 0);
  border: 0;
}
</style>
<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
   <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('request'); ?></li>
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
                                   <?php if(isset($title)){ echo $title;  }   ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('date') ?></label>
                                </div>
                                <div class="col-md-3 date">
                                    <?php if(isset($date)){ echo date('Y-m-d',strtotime($date));  }   ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('requesttype') ?></label>				
                                </div>
                                <div class="col-md-3">
                                
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
                                    
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('categorytype') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" disabled>
                                        <option></option>
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
                                    <select name="subcategory" class="form-control"  disabled>
                                        <option></option>
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
                                        class="form-control" disabled><?php if(isset($request_description)){ echo $request_description;  }   ?></textarea>
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
                                <div class="col-md-3 project_name">
                                    <input type="text" name="project_name" value="<?php if(isset($projectName->Name)){ echo $projectName->Name;  }   ?>" class="form-control " autocomplete='off'
                                    readonly   >
                                </div>
                            </div>
                        </div>
						  <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('Request_by') ?></label>
                                </div>
                                <div class="col-md-3 Request_by">
                                    <input type="text" name="Request_by"  value="<?php if(isset($RequerequesttedBy->Name)){ echo $RequerequesttedBy->Name;  }   ?>"class="form-control " autocomplete='off'
                                        readonly>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('Venue') ?></label>
                                </div>
                                <div class="col-md-3 Venue">
                                   <textarea name="venue" autocomplete="off"
                                        class="form-control" disabled><?php if(isset($RequerequesttedBy->permanent_address)){ echo $RequerequesttedBy->permanent_address;  }   ?></textarea>
                                </div>
                            </div>
                        </div>
								
							 <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('request_startDate') ?></label>
                                </div>
                                <div class="col-md-3 request_startDate">
                                    <input type="text" name="request_startDate" class="form-control  " autocomplete='off'
                                        value="<?php if(isset($requestStartDate)){ echo date('Y-m-d',strtotime($requestStartDate));  }   ?>" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('request_endDate') ?></label>
                                </div>
                                <div class="col-md-3 request_endDate">
                                    <input type="text" name="request_endDate" class="form-control " autocomplete='off'
                                        value="<?php if(isset($requestEndDate)  && $requestEndDate !='0000-00-00 00:00:00'){ echo date('Y-m-d',strtotime($requestEndDate));  }   ?>" readonly>
                                </div>
                            </div>
                        </div>	
						
						
						 <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('request_status') ?></label>
                                </div>
                                <div class="col-md-3 request_status">
                                     <select name="request_status" class="form-control"  disabled>
                                        <option ></option>
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
                                    <select  class="form-control" multiple="multiple" id="assign_to" >
                                     
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
                                  
                                      <?php if(isset($rescheduling) && $rescheduling !='0000-00-00 00:00:00'){ echo date('Y-m-d',strtotime($rescheduling));  }   ?> 
                                </div>
                            </div>
                        </div>						
								
						  <div class="form-group">
                              <div class="row">
								 <div class="col-md-2">
                                    <label><?php echo lang('services_cost') ?></label>
                                </div>
                                <div class="col-md-3">
                                       <?php echo $this->sma->formatMoney($request->service_cost) ;   ?>
                                </div>
								<div class="col-md-2">
                                    <label><?php echo lang('admin_note') ?></label>
                                </div>
                                <div class="col-md-3 rescheduling">
                                    <textarea name="adminnote" autocomplete="off"
                                        class="form-control" disabled><?php if(isset($assignee_comments)){ echo $assignee_comments;  }   ?></textarea>
                                </div>
                            </div>
                        </div>
						<div class="form-group">
                              <div class="row">
								 <div class="col-md-2">
                                    <label>Total Amount</label>
                                </div>
                                <div class="col-md-3">
                                       <?php echo $this->sma->formatMoney($request->total_amount) ;  ?>
                                </div>
								<div class="col-md-2">
                                    <label>Picture</label>
                                </div>
                                <div class="col-md-3 rescheduling">
                                    		<img class="form-control" src="<?php  echo base_url('uploads/worklist_image') ; ?>/<?php if(!empty($picture)){ echo $picture ; }else{ echo 'noimage.jpg' ; }  ?>" style="height:120px;width:120px;" id="output"/>
                                </div>
                            </div>
                        </div>
                       
                </div><!-- /.box-body -->
                
                <div class="row">
					<div class="col-sm-12">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Materials</legend>
<!--
							 <div class="col-sm-8 col-sm-offset-2">
									 <div class="form-group has-search ui-widget">
										<span class="fa fa-search form-control-feedback"></span>
										<input type="text" name="" id="add_products" placeholder="Search the Products" class="search-query form-control ui-autocomplete-input" autocomplete="off">
											<p id="project-description"></p>
									  </div>
							 </div>
							 <div class="test">
							 </div>
-->
							<table class="table table-striped product_table_s" style="table-layout: fixed;">
								<thead>
									<tr>
										<th>Product Name</th>
										<th class="text-center">Qty</th>
										<th class="text-center">Cost</th>
										<th class="text-center">Total cost</th>
										
									</tr>
								</thead>
								<tbody id="productlist">
								    <?php   if(!empty($material)){ $material_total_cost=0; foreach($material as $item){  ?>
                                        <tr>
                                            <td><?php  echo $item->code .'-'.$item->name ;  ?></td>
                                            <td class="text-center"><?php  echo $item->qty;  ?></td>
                                            <td class="text-center">
                                                <?php     echo $this->sma->formatMoney($item->cost)   ;  ?></td>
                                            <td class="text-center">
                                                <?php echo $this->sma->formatMoney($item->total_cost) ;  ?></td>
                                        </tr>
                                        <tr>
                                            <?php  $material_total_cost +=$item->total_cost ; }   ?>
                                            <td colspan="2"></td>
                                            <td><b>Total</b></td>
                                            <td class="text-center">
                                                <b><?php echo !empty($material_total_cost)? $this->sma->formatMoney($material_total_cost):0;  ?></b>
                                            </td>
                                        </tr>
                                        <?php  }  ?>
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
								  <?php if(!empty($payment_details)){ $total=0; foreach($payment_details as $payment){  ?>
                                            <tr>
                                                <td><?php echo $payment->services_name;   ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php  echo $this->sma->formatMoney($payment->services_cost)      ; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php  echo $this->sma->formatMoney($payment->services_cost)      ; ?>
                                                </td>
                                            </tr>
                                            <?php  $total += $payment->services_cost ; }  ?>

                                            <tr>
                                                <td colspan="1"></td>
                                                <td class="text-right"><b>Total <input type="hidden"
                                                            name="payment_total" class="payment_total"></b></td>
                                                <td class="text-center">
                                                    <b><?php echo !empty($total)? $this->sma->formatMoney($total):0;  ?></b>
                                                </td>
                                            </tr>
                                            <?php	} ?>
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
    			
    			<div class="row">
    				<div class="col-sm-12">
						<fieldset class="scheduler-border">
								<legend class="scheduler-border">Track Status</legend>
								<div class="col-sm-12 table-responsive">
									<ul class="col-sm-12 timeline timeline-horizontal">

									  <?php  if(!empty($track)){  $i=1;
														  foreach ($track as $stage) {  ?>
														  <li class="timeline-item">
											<div class="timeline-badge primary"></div>
											<div class="timeline-panel">
													<p><?php  if(!empty($stage->note)||!empty($stage->datetime)){ echo  $stage->note.' '.$stage->datetime ;  }    ?></p>
											</div>
										</li>

															<?php $i++; }
													  }  ?>


									</ul>
								</div>
						</fieldset>
    				</div>
    			</div>
						
                <div class="row">
                <div class="col-sm-12 col-xs-12">
                <fieldset class="scheduler-border">
					<legend class="scheduler-border">Comments</legend>
					
					<div class="col-sm-12 col-xs-12 ">
					<h3 style="float: left;margin-right: 10px;">Rate us</h3>
					<div class="radio-stars">
						<input class="sr-only" id="radio-5" name="radio-star" type="radio" value="5"/>
						<label class="radio-star" for="radio-5">5</label>
						
						<input checked="" class="sr-only" id="radio-4" name="radio-star" type="radio" value="4"/>
						<label class="radio-star" for="radio-4">4</label>
						
						<input class="sr-only" id="radio-3" name="radio-star" type="radio" value="3"/>
						<label class="radio-star" for="radio-3">3</label>
						
						<input class="sr-only" id="radio-2" name="radio-star" type="radio" value="2"/>
						<label class="radio-star" for="radio-2">2</label> 
						
						<input class="sr-only" id="radio-1" name="radio-star" type="radio" value="1"/>
						<label class="radio-star" for="radio-1">1</label>

						<span class="radio-star-total"></span>
						</div>
					</div>
                	<div class="col-sm-12 col-xs-12 comments_box">
                		<h3 class="col-sm-12 col-xs-12">Comments<h3>
                		<form>
                			<div class="form-group col-sm-6">
                				<label>Name</label>
                				<input type="text" class="form-control" readonly>
                			</div>
                			<div class="form-group col-sm-6">
                				<label>email</label>
                				<input type="email" class="form-control" readonly>
                			</div>
                			<div class="form-group col-sm-12">
                				<label>Comments</label>
                				<textarea rows="5" style="width: 100%;" disabled></textarea>
							</div>
                		</form>
                	</div>
					</fieldset>
                </div></div>
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
  