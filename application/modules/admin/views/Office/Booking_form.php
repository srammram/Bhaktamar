<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-3.3.2.min.js" type="text/css">

<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/booking_form.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">  <?php  $seg= $this->uri->segment(4);?>
<script src="<?php echo base_url('assets/admin/') ?>/dist/js/jquery.validate.min.js"></script>
<style>
  .btn-group
  {
	  width:100%;
  }
  .multiselect
    {
	  width:100%;
	  
  }
  .multiselect-container
  {
	width:100%;  
	height:100%;
	min-height:300px;
	overflow-y:scroll;
  }
#exTab1 .tab-content {
  color : #333;
  background-color:transparent;
  padding : 5px 15px;
}
#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}
#exTab1 .nav-pills > li > a {
  border-radius: 0;border: 1px solid #2c3542; font-size: 18px;
}
#exTab1 .nav-pills > li+li{margin-left: 0px;}
#exTab1 .nav-pills>li.active>a, #exTab1 .nav-pills>li.active>a:focus, #exTab1 .nav-pills>li.active>a:hover{    background-color: #2c3542;}
#exTab1 .tab-content>.active{transition:all 5s ease-in;}
</style>
 <?php  $seg= $this->uri->segment(4);?>
	
<section class="content">
<div class="row">
<div class="col-sm-12 col-xs-12" id="exTab1">	
	<ul class="nav nav-pills">
		<li class="active">
			<a  href="#owners" data-toggle="tab">Owner Units</a>
		</li>
		<li>
			<a href="#hotels" data-toggle="tab">Hotel Units</a>
		</li>
		<li>
			<a href="#lease_block" data-toggle="tab">Lease Back Units</a>
		</li>
	</ul>
<div class="tab-content clearfix">
	<div class="tab-pane active" id="owners">
		<section class="content-header" style="padding: 15px 0px;">
			<h1><?php echo $page_title; ?></h1>
			  <ol class="breadcrumb">
				<li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
				<li><a href="<?php echo site_url('admin/Office/Booking') ?>"> <?php echo lang('Book')?> </a></li>
				<li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
			  </ol>
		</section><br>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
					<form method="post" action="<?php echo site_url('admin/Owner/form/'.$id); ?>" enctype="multipart/form-data">	
					  <div class="form-group">
						<label for="txtOwnerName"><span class="errorStar">*</span><?php echo lang('Owner_Name')?>:</label>
						<input type="text" required name="txtOwnerName" value="<?php if(isset($o_name)){ echo $o_name ; } ?>" id="txtOwnerName" class="form-control" />
					  </div>
					  <div class="form-group">
						<label for="txtOwnerEmail"><span class="errorStar">*</span><?php echo lang('Owner_email')?> :</label>
						<input type="text" required name="txtOwnerEmail" value="<?php if(isset($o_email)){ echo $o_email ; } ?>" id="txtOwnerEmail" class="form-control" />
					  </div>
					  <div class="form-group">
						<label for="txtPassword"><span class="errorStar">*</span><?php echo lang('Password')?> :</label>
						<input type="text" required name="txtPassword" value="<?php if(isset($Password)){ echo $Password ; } ?>" id="txtPassword" class="form-control" />
					  </div>
					  <div class="form-group">
						<label for="txtOwnerContact"><span class="errorStar">*</span><?php echo lang('Owner_Contact')?>:</label>
						<input type="text" required name="txtOwnerContact" value=" <?php if(isset($o_contact)){ echo $o_contact ; } ?>" id="txtOwnerContact" class="form-control" />
					  </div>
					  <div class="form-group">
						<label for="txtOwnerPreAddress"><span class="errorStar">*</span><?php echo lang('Present_address')?> :</label>
						<textarea name="txtOwnerPreAddress" id="txtOwnerPreAddress" class="form-control"><?php if(isset($o_pre_address)){ echo $o_pre_address ; } ?></textarea>
					  </div>
					  <div class="form-group">
						<label for="txtOwnerPerAddress"><span class="errorStar">*</span> <?php echo lang('Permanent_Address')?>:</label>
						<textarea name="txtOwnerAddress" id="txtOwnerPerAddress" class="form-control"><?php if(isset($per_address)){ echo $per_address ; } ?></textarea>
					  </div>
					  <div class="form-group">
						<label for="txtOwnerNID"><span class="errorStar">*</span><?php echo lang('NID')?>:</label>
						<input type="text" name="txtOwnerNID" value="<?php if(isset($o_nid)){ echo $o_nid ; } ?>" id="txtOwnerNID" class="form-control" />
					  </div>
					  <div class="form-group">
					  <label for="OwnerType"><span class="errorStar">*</span><?php echo lang('OwnerType')?>:</label>
						 <select class="form-control "   required  name="OwnerType">
						 <option>Select </option>
									 <?php
									  foreach($OwnerType as $item){ 
									 ?>
									<option value="<?php echo $item->id ?>"<?php if(!empty($Owner_type)) echo $Owner_type == $item->id ?'selected':''  ?> ><?php echo $item->OwnerType ?></option>
								<?php 
									 }				
									 ?>
							 </select>

						</div>
					  <div class="form-group">
						<label for="ChkOwnerUnit"><?php echo lang('Owner_Unit')?>:</label>
						<div >
						  <select class="form-control col-md-12" multiple="multiple" id="my-select"    style="width:420px;" name="Ownerunits[]">
									 <?php
									  foreach($units as $item){ 
									  $selected = in_array( $item->uid, $OwnerUnits ) ? ' selected="selected" ' : '';   
									 ?>
									<option value="<?php echo $item->uid ?>"  <?php echo $selected; ?> ><?php echo $item->unit_no ?></option>
								<?php 
									 }				
									 ?>

							 </select>
						  <div style="margin-left:.7%;">
							<label>
						   </label>
						  </div>
						</div>
					  </div>
					  <div class="form-group">
						<label for="Prsnttxtarea"><?php echo lang('Owner_photo')?>:</label>
						<img class="form-control" id="displayimage" src="<?php  echo base_url('uploads/images') ; ?>/<?php if(isset($OwnerPhoto)&& !empty($OwnerPhoto)){ echo $OwnerPhoto ; }else{ echo 'no-image.png'; }  ?>" style="height:100px;width:100px;" id="output"/>
						<br>
						<input type="file" name="OwnerPhoto" value="" onchange="readURL(this);" />
					  </div>
						<div class="box-footer">
						 <input type="hidden" name="ids" value="<?php  if(isset($ownid)){ echo $ownid ;  } ?>" class="form-control" />
						<input class="btn btn-primary" type="submit" value="Save"/>
						 </div>
						</form>
				  </div><!-- /.box -->
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane" id="hotels">
		<div class="row">
			<div class="dashboard_sec" style="background-color: #fff;padding: 20px;margin-top: 25px;">
				<div class="row">
				<form action="<?php echo site_url('admin/Office/booking_save/'); ?>" role="form" id="Booking_form" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
					<div class="clearfix"></div>
						<fieldset>
							<legend><?php echo lang('Booking_details');?></legend>
							<div class="col-md-4">
							<div class="form-group">
							<label for="Booking_mode"><?php echo lang('Booking_mode');?></label>                                        
							<select name="Booking_mode" class="form-control" id="Booking_mode"  tabindex="-1" title="Booking type" required>
							<option value="<?php echo lang('Checkins');?>" ><?php echo lang('Checkins');?></option>
							<option value="<?php echo lang('bookings');?>"><?php echo lang('bookings');?></option>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group">
							<label for="Booking_type"><?php echo lang('Booking_Type');?></label>                                        
							<select name="Booking_type" class="form-control" id="Booking_type"  tabindex="-1" title="Booking type" required>
							<option value="<?php echo lang('Reservation');?>" ><?php echo lang('Reservation');?></option>
							<option value="<?php echo lang('Confirmed');?>"><?php echo lang('Confirmed');?></option>
							<option value="<?php echo lang('Check_in');?>"><?php echo lang('Check_in');?></option>
							</select>
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-5">
							<div class="form-group all row">
							<div class="col-md-6"><label for="check_in"><?php echo lang('Check_in');?></label></div>
							<div class="col-md-3"><label for="hour"><?php echo lang('Hrs');?></label></div>
							<div class="col-md-3">
							<label for="minutes"><?php echo lang('Mins');?></label>
							</div>
							<div class="col-md-6">
							<input name="check_in_date" value="" class="form-control  datepicker" id="check_in_date" placeholder="YYYY-MM-DD"  required>
							</div>
							<div class="col-md-3">
							<select name="check_in_hour" class="form-control" id="check_in_hour" tabindex="-1" title="">
							<option value="0">00</option>
							<?php   
							for($i=1;$i<24;$i++)
							{
							?>
							<option value=<?php echo $i  ?> ><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							<div class="col-md-3">
							<select name="check_in_min" class="form-control" id="check_in_min" tabindex="-1" title="" >
							<option value="0" selected="selected">00</option>
							<?php   
							for($i=1;$i<60;$i++){
							?>
							<option value=<?php echo $i  ?> ><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							</div>
							</div>
							<div class="col-md-5">
							<div class="form-group all row">
							<div class="col-md-6">
							<label for="check_out"><?php echo lang('Check_Out');?></label>
							</div>
							<div class="col-md-3">
							<label for="hour"><?php echo lang('Hrs');?></label>                                            
							</div>
							<div class="col-md-3">
							<label for="minutes"><?php echo lang('Mins');?></label>                                            
							</div>
							<div class="col-md-6">
							<input name="check_out_date" value="<?php if(!empty($BookingDetails->check_out)){ echo date('Y-m-d', strtotime($BookingDetails->check_out)) ; }  ?>" class="form-control  datepicker" id="checkoutDate" placeholder="YYYY-MM-DD"  required>
							</div>
							<div class="col-md-3">
							<select name="check_out_hour" class="form-control" id="check_out_hour" tabindex="-1" title="">
							<option value="0" selected="selected">00</option>
							<?php   
							for($i=1;$i<24;$i++){
							?>
							<option value=<?php echo $i  ?>><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							<div class="col-md-3">
							<select name="check_out_min" class="form-control" id="check_out_min" tabindex="-1" title="">
							<option value="0" selected="selected">00</option>
							<?php   
							for($i=1;$i<60;$i++){
							?>
							<option value=<?php echo $i  ?> ><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							</div>
							</div>
							<div class="col-md-2">
							<div class="form-group all">
							<label for="grace_time"><?php echo lang('Grace_time');?></label>
							<?php if(!empty($BookingDetails->grace_time)){ echo $BookingDetails->grace_time ; }  ?>
							<select name="grace_time" class="form-control" id="grace_time" tabindex="-1" title="grace time" >
							<option value="00:00" >00:00</option>
							<option value="00:15">00:15</option>
							<option value="00:30" >00:30</option>
							<option value="00:45" >00:45</option>
							<option value="01:00" >01:00</option>
							<option value="01:15">01:15</option>
							<option value="01:30" >01:30</option>
							<option value="01:45" >01:45</option>
							<option value="02:00" >02:00</option>
							<option value="02:15" >02:15</option>
							<option value="02:30" >02:30</option>
							<option value="02:45" >02:45</option>
							<option value="03:00" >03:00</option>
							<option value="03:15">03:15</option>
							<option value="03:30">03:30</option>
							<option value="03:45" >03:45</option>
							</select>
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="night"><?php echo lang('Nights');?> *</label>
							<input name="night" value="" class="form-control" id="night"  maxlength="2" minlength="1" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="number_of_adult"><?php echo lang('Number_Of_Adults');?> *</label>

							<select name="number_of_adult" class="form-control adult" id="number_of_adult"  tabindex="-1" title="number of adult" required>
							<option value="" selected="selected">Select Adult</option>
							<option value="1" >1</option>
							<?php   
							for($i=2;$i<15;$i++){
							?>
							<option value=<?php echo $i  ?> ><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="number_of_child"><?php echo lang('Number_Of_Child');?></label>
							<select name="number_of_child" class="form-control" id="number_of_child" tabindex="-1" title="number of child" >
							<option value="0">0</option>
							<?php   
							for($i=1;$i<8;$i++){
							?>
							<option value=<?php echo $i  ?> ><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="number_of_Units"><?php echo lang('Number_Of_Units');?>*</label>
							<select name="number_of_Units" class="form-control units" id="number_of_Units"  tabindex="-1" title="number of Units" required>
							<option value="" selected="selected">Select Units</option>
							<?php   
							for($i=1;$i<8;$i++){
							?>
							<option value=<?php echo $i  ?> ><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="Booking_status"><?php echo lang('Booking_status');?>*</label>
							<select name="Booking_status" class="form-control" id="Booking_status"  tabindex="-1" title="Booking status" required>
							<option value="<?php echo lang('conform');?>"><?php echo lang('conform');?></option>
							<option value="<?php echo lang('Pending');?>"><?php echo lang('Pending');?></option>
							<option value="<?php echo lang('Cancel');?>"><?php echo lang('Cancel');?></option>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="Booking_reason"><?php echo lang('Booking_reason');?></label>
							<input name="Booking_reason" value="<?php if(!empty($BookingDetails->night)) echo $BookingDetails->reservation_reason ;  ?>" class="form-control " id="Booking_reason">
							</div>
							</div>
							<div class="clearfix"></div>
						</fieldset>
							<div class="clearfix"></div>
						<fieldset>
							<legend><?php echo lang('Units_details');?></legend>
							<div class="table-responsive">
							<table id="Units" class="table col-xs-12 table-bordered table-condensed table-striped">
							<thead>
							<tr class="active">
							<th><?php echo lang('Units_Types');?></th>
							<th><?php echo lang('Unit_number');?></th>
							<th><?php echo lang('Price');?></th>
							<th><?php echo lang('Extra_Beds');?></th>
							<th><?php echo lang('Extra_Price');?></th>
							</tr>
							</thead>
							<tbody id="number_Units">
							</tbody>
							</table>
							</div>
						</fieldset>
						<div class="clearfix"></div>
						<fieldset>
							<legend><?php echo lang('Guest_details');?></legend>
							<div class="col-md-4">
							<div class="form-group">
							<label for="guest_type"><?php echo lang('Guest_Type');?>*</label>
							<select name="guest_type" class="form-control" id="guest_type"  tabindex="-1" title="guest type" >
							<option value="<?php echo lang('Booking_self');?>" ><?php echo lang('Booking_self');?></option>
							<option value="<?php echo lang('Booking_Others');?>" ><?php echo lang('Booking_Others');?></option>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group">
							<label for="guest_mode"><?php echo lang('Guest_Mode');?> *</label>
							<select name="guest_mode" class="form-control" id="guest_mode"  tabindex="-1" title="guest mode" >
							<option value="<?php echo lang('New_customer');?>" ><?php echo lang('New_customer');?></option>
							<option value="<?php echo lang('Regular');?>" ><?php echo lang('Regular');?></option>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all customer" style="display:none;">
							<label for="regular_customer"><?php echo lang('Regular_customer');?></label>
							<select name="customer_id" class="form-control select customer_id" id="customer_id" placeholder="Select Customer" style="width: 100%;" tabindex="-1" title="">
							</select>
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="first_name"><?php echo lang('firstname');?> *</label>
							<input name="first_name" value="" class="form-control " id="first_name" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="last_name"><?php echo lang('lastname');?> *</label>
							<input name="last_name" value="" class="form-control " id="last_name" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="email_address"><?php echo lang('email');?>*</label>
							<input name="email_address" value="" type="email" class="form-control " id="email_address" >
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="phone_number"><?php echo lang('Phone');?> *</label>
							<input name="phone_number" value="" class="form-control" maxlength="10" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" id="phone_number" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="address"><?php echo lang('address');?> *</label>
							<input name="address" value="" class="form-control " id="address" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="country"><?php echo lang('country');?></label>

							<select name="country_id" class="form-control select" id="country_id" placeholder="Select Country" style="width: 100%;"  tabindex="-1" title="">
							<option value="" >select </option>
							<?php 
							if(isset($country)){
							foreach($country as $countrys){
							?>
							<option value="<?php echo $countrys->id  ?>" <?php if(!empty($Guest->country_id)) echo $Guest->country_id ==   $countrys->id   ? 'selected':''   ?>><?php echo $countrys->name  ?></option>
							<?php
							}
							}
							?>
							</select>
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-4">
							<div class="form-group">
							<label for="id_proof"><?php echo lang('Id_proof');?>*</label>
							<select name="id_proof" class="form-control" id="id_proof"  tabindex="-1" title="id proof" >
							<option value="<?php echo lang('passbook');?>"
							<?php if(!empty($Guest->id_type)) echo $Guest->id_type ==    lang('passbook') ? 'selected':''   ?>><?php echo  lang('passbook');  ?></option>
							<option value="<?php echo lang('Others');?>" <?php if(!empty($Guest->id_type)) echo $Guest->id_type ==    lang('Others') ? 'selected':''   ?>><?php echo lang('Others');?></option>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="id_number"><?php echo lang('Id_Number');?>*</label>
							<input name="id_number" value="<?php if(!empty($Guest->id_no)){ echo $Guest->id_no ; }  ?>" class="form-control " id="id_number" maxlength="15" minlength="7" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="document"><?php echo lang('Attachment');?></label>
							<span class="file-input file-input-new">
							<div class="input-group ">
							<div tabindex="-1" class="form-control file-caption  kv-fileinput-caption">
							<div class="file-caption-name"></div>
							</div>
							<div class="input-group-btn">
							<div class="btn btn-primary btn-file downloads"> 
							<i class="fa fa-folder-open"></i> &nbsp;Browse ... <input id="document" type="file" data-browse-label="Browse ..." name="document"  class="form-control file">
							</div>
							</div>
							</div>
							</span>
							</div>
							</div>
						</fieldset>
						<div class="clearfix"></div>
						<fieldset>
							<legend><?php echo lang('Persons_details');?></legend>
							<div class="table-responsive">
							<table id="adults" class="table table-bordered table-condensed table-striped">
							<thead>
							<tr class="active">
							<th><?php echo lang('firstname');?></th>
							<th><?php echo lang('Ages');?></th>
							<th><?php echo lang('dob');?></th>
							<th><?php echo lang('gender');?></th>
							<th><?php echo lang('Id_proof');?> </th>
							<th><?php echo lang('Id_Number');?></th>
							</tr>
							</thead>
							<tbody id="number_adults">
							</tbody>
							</table>
							</div>
						</fieldset>
						<div class="clearfix"></div>
						<div class="clearfix"></div>
						<fieldset class="vehicle_main">
							<legend><?php echo lang('Vechile_details');?></legend>
							<div class="vehicle_details">
							<div class="col-xs-12 vehicle" id="arrival">
							<div class="col-md-3">
								<div class="form-group all">			
									<label for="vehicle_date">Slot No</label>			
									<select name="Slotno[]" class="form-control" id="Slotno" tabindex="-1" title="">
										<option>Select</option>	
										<?php													
										if(isset($Slot)){										
										foreach($Slot as $Slots){							
										?>												
										<option value="<?php echo $Slots->id ; ?>"><?php echo $Slots->Slot_No ;  ?></option>
										<?php   
										}
										}
										?>
									</select>	
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group all">
								<label for="location"><?php  echo lang('Vechile_no'); ?></label>             
								<input name="vechileno[]" value="" class="form-control ">
								</div>										
							</div>
							<div class="col-md-2">
							<div class="form-group all row">
							<label for="vehicle_date" class="col-md-12"><?php  echo lang('arrival'); ?></label>  
							<div class="col-md-6">
							<select name="vehicle_hour_arrival[]" class="form-control" id="vehicle_hour_arrival" tabindex="-1" title="">
							<option value="">hour</option>
							<?php   
							for($i=1;$i<24;$i++){
							?>
							<option value=<?php echo $i  ?>><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							<div class="col-md-6">
							<select name="vehicle_min_arrival[]" class="form-control" id="vehicle_min_arrival" tabindex="-1" title="">
							<option value="">Min</option>
							<option value="0" >00</option>
							<?php   
							 for($i=1;$i<60;$i++) {
							   ?>
							<option value=<?php echo $i  ?>><?php echo $i  ?></option>         <?php										                           }
							?>														</select>
							</div>
							</div>
							</div>
							<div class="col-md-2">
							<div class="form-group all row">
							<label for="vehicle_date" class="col-md-12"><?php  echo lang('Departure'); ?></label>  
							<div class="col-md-6">
							<select name="vehicle_hour_depart[]" class="form-control" id="vehicle_hour_depart" tabindex="-1" title="">
							<option value="">hour</option>
							<option value="0" >00</option>
							<?php   
							for($i=1;$i<24;$i++) {
							?>
							<option value=<?php echo $i  ?>><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							<div class="col-md-6">
							<select name="vehicle_min_depart[]" class="form-control" id="vehicle_min_depart" tabindex="-1" title="">
							<option value="">Min</option>
							<option value="0">00</option>
							<?php   
							for($i=1;$i<60;$i++)
							{
							?>
							<option value=<?php echo $i  ?>><?php echo $i  ?></option>
							<?php
							}
							?></select>
							</div>
							</div>
							</div>
							<div class="col-md-2">
							<label for="vehicle_date" class="col-md-12">&nbsp;</label> 
							<i class="fa fa-plus"></i>
							</div>
							</div>
							</div>
							<div style="clear:both; height:15px;"></div>
						</fieldset>
						<div class="clearfix"></div>
						<fieldset>
						<legend><?php  echo lang('Payment_Details'); ?></legend>
			<div id="payments">
				<div class=" well-sm well_1">
				<div class="payment">
					<div class="row">
						<div class="col-sm-12">
						<div class="form-group">
						<label for="paid_by_1"><?php  echo lang('Content'); ?></label>
						<textarea rows="5" cols="40" name="content" autocomplete="off" style="width: 100%;"></textarea>
						</div>
						</div>
						<div class="paymentblockall">
						<div class="col-sm-12">
						<div class="form-group">									<label for="paid_by_1"><?php  echo lang('Payingby'); ?></label>
						<select name="paid_by[]" id="paid_by_1" class="form-control paid_by" title="Paying by"  tabindex="-1">
						<option value="<?php  echo lang('cash'); ?>"><?php  echo lang('amount'); ?></option>
						<option value="<?php  echo lang('card'); ?>"><?php  echo lang('card'); ?></option>				
						<option value="<?php  echo lang('Others'); ?>"><?php  echo lang('Others'); ?></option>											</select>
						</div>
						</div>
						<div class="main_detail">
						<div class="col-sm-6">
						<div class="form-group" style="margin-bottom: 5px;">
						<label><?php  echo lang('amount'); ?></label>
						<input name="amount[]" type="text" id="amount_1" data-currency="currency_id_1" maxlength="10" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="pa form-control  amount payamount" required autocomplete="off">
						</div>
						</div>

						<div class="col-sm-6">
						<div class="form-group" style="margin-bottom: 5px;">
						<label><?php  echo lang('currency'); ?></label>
						<select name="currency_id[]" id="currency_id_1" class="form-control currency" title="" tabindex="-1">								<option value="1" selected=""> US Dollar</option>		
						</select>
						</div>
						</div>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-12 paymentblock">
						<div class="form-group gc_1" style="display: none;">
						<label for="gift_card_no_1">Gift Card No</label>                                        
						<input name="paying_gift_card_no[]" type="text" id="gift_card_no_1" class="pa form-control kb-pad gift_card_no">
						<div id="gc_details_1"></div>
						</div>
						<div class="pcc_1" style="display: block;">

							<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<input name="cc_no[]" type="text" id="pcc_no_1" maxlength="18" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Credit Card No">
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<input name="cc_holer[]" type="text" id="pcc_holder_1" class="form-control" placeholder="Holder Name">
							</div>
							</div>
							<div class="col-md-3">
							<div class="form-group">
								<select name="cc_type[]" id="pcc_type_1" class="form-control pcc_type" placeholder="Card Type" title="" tabindex="-1">
									<option value="<?php  echo lang('Visa'); ?> "><?php  echo lang('Visa'); ?> </option>
									<option value="<?php  echo lang('Mastercard'); ?>"><?php  echo lang('Mastercard'); ?> </option>
									<option value="<?php  echo lang('Amex'); ?>"><?php  echo lang('Amex'); ?> </option>
									<option value="<?php  echo lang('Discover'); ?>"><?php  echo lang('Discover'); ?> </option>
								</select>
							</div>
							</div>
							<div class="col-md-3">
							<div class="form-group">
								<input name="cc_month[]" type="text" id="pcc_month_1" maxlength="2" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Month">
							</div>
							</div>
							<div class="col-md-3">
							<div class="form-group">
								<input name="cc_year[]" type="text" id="pcc_year_1" maxlength="4" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Year">
							</div>
							</div>
							<div class="col-md-3">
							<div class="form-group">
								<input name="cc_cvv2[]" type="text" id="pcc_cvv2_1" maxlength="3" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Security Code">
							</div>
							</div>
							</div>
						</div>
						<div class="pcheque_1" style="display:none;">
						<div class="form-group"><label for="cheque_no_1"><?php  echo lang('Cheque'); ?> </label>                                            <input name="cheque_no[]" type="text" id="cheque_no_1" class="form-control cheque_no">
						</div>
						</div>
						</div>
						</div>
					</div>
					</div>
					</div>
				</div>
				<button type="button" class="btn btn-primary col-md-12 addButton"><i class="fa fa-plus"></i><?php  echo lang('Add_payment'); ?> </button>
				<div style="clear:both; height:15px;"></div>
				<div class="table_sec1">
					<table class="table table-bordered" style="margin-bottom: 0;">
						<tbody>
							<tr>
							<td>
							<?php  echo lang('Total_payable'); ?>							</td>
							<td class="text-right">
							<input type="text" name="totalpayable" value="" class="form-control totalpayable">
							<!--<span id="twt">$1.00</span></td>-->
							<td>
							<?php  echo lang('Advance_traiff'); ?> 
							</td>
							<td class="text-right">
							<input type="text" name="advancetraiff" value="" class="form-control advancetraiff">
							<!--<span id="twt_BASE">$1.00</span>-->
							</td>
							</tr>
							<tr>
							<td><?php  echo lang('Total_paying'); ?></td>
							<td class="text-right"><span id="total_paying1">$0.00</span><input type="hidden" name="total_paying" class="total_paying"></td>
							<td><?php  echo lang('Balance'); ?></td>
							<td class="text-right"><span id="balance_BASE1">$0.00
							</span><input type="hidden" name="balance" class="balance_BASE">
							</td></tr>
						</tbody>
					</table>
				<div class="clearfix"></div>
				<br>
					<div class="col-md-12">
					<div class="form-group">
					<input type="submit" value="<?php  echo lang('save'); ?>" class="btn btn-success" id="payment">
					</div>
					</div>
				</div>
				</fieldset>                    
      </form>                                
</div>
			</div>
		</div>
	</div>
	<div class="tab-pane" id="lease_block">
		<div class="row">

			<div class="dashboard_sec" style="background-color: #fff;padding: 20px;margin-top: 25px;">
				<div class="row">
				
						<form action="<?php echo site_url('admin/Office/bookingleaseunits/'.$id); ?>" role="form" id="leaseunitBooking_form" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
					<div class="clearfix"></div>
						<fieldset>
							<legend><?php echo lang('Booking_details');?></legend>
							<div class="col-md-4">
							<div class="form-group">
							<label for="leaseBooking_mode"><?php echo lang('Booking_mode');?></label>                                        
							<select name="leaseBooking_mode" class="form-control" id="Booking_mode"  tabindex="-1" title="Booking type" required>
							<option value="walk_in" ><?php echo lang('walk_in');?></option>
							<option value="phone_booking"><?php echo lang('phone_booking');?></option>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group">
							<label for="leaseBooking_type"><?php echo lang('Booking_Type');?></label>                                        
							<select name="leaseBooking_type" class="form-control" id="Booking_type"  tabindex="-1" title="Booking type" required>
							<option value="<?php echo lang('Reservation');?>" ><?php echo lang('Reservation');?></option>
							<option value="<?php echo lang('Confirmed');?>"><?php echo lang('Confirmed');?></option>
							<option value="<?php echo lang('Check_in');?>"><?php echo lang('Check_in');?></option>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							  <div class="form-group">
		            <label for="Leasetype"><span class="errorStar">*</span><?php echo lang('LeaseType')?>:</label>
                   <select class="form-control "     name="Leasetype">
			           <option>Select </option>
						<option value="<?php echo lang('short_term')?>" <?php if(!empty($LeaseType)) echo $LeaseType == lang('short_term') ?'selected':''  ?>><?php echo lang('short_term')?></option>
						<option value="<?php echo lang('Long_term')?>" <?php if(!empty($LeaseType)) echo $LeaseType == lang('Long_term') ?'selected':''  ?>><?php echo lang('Long_term')?></option>
                 </select>
		    </div>
							   </div>
							
							<div class="clearfix"></div>
							<div class="col-md-5">
							<div class="form-group all row">
							<div class="col-md-6"><label for="check_in"><?php echo lang('Check_in');?></label></div>
							<div class="col-md-3"><label for="hour"><?php echo lang('Hrs');?></label></div>
							<div class="col-md-3">
							<label for="minutes"><?php echo lang('Mins');?></label>
							</div>
							<div class="col-md-6">
							<input name="Leasecheck_in_date" value="" class="form-control  datepicker" id="check_in_date" placeholder="YYYY-MM-DD" required >
							</div>
							<div class="col-md-3">
							<select name="Leasecheck_in_hour" class="form-control" id="check_in_hour" tabindex="-1" title="">
							<option value="0">00</option>
							<?php   
							for($i=1;$i<24;$i++)
							{
							?>
							<option value=<?php echo $i  ?> ><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							<div class="col-md-3">
							<select name="Leasecheck_in_min" class="form-control" id="check_in_min" tabindex="-1" title="" >
							<option value="0" selected="selected">00</option>
							<?php   
							for($i=1;$i<60;$i++){
							?>
							<option value=<?php echo $i  ?> ><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							</div>
							</div>
							<div class="col-md-5">
							<div class="form-group all row">
							<div class="col-md-6">
							<label for="check_out"><?php echo lang('Check_Out');?></label>
							</div>
							<div class="col-md-3">
							<label for="hour"><?php echo lang('Hrs');?></label>                                            
							</div>
							<div class="col-md-3">
							<label for="minutes"><?php echo lang('Mins');?></label>                                            
							</div>
							<div class="col-md-6">
							<input name="leasecheck_out_date" value="<?php if(!empty($BookingDetails->check_out)){ echo date('Y-m-d', strtotime($BookingDetails->check_out)) ; }  ?>" class="form-control  datepicker" id="checkoutDate" placeholder="YYYY-MM-DD" required>
							</div>
							<div class="col-md-3">
							<select name="leasecheck_out_hour" class="form-control" id="check_out_hour" tabindex="-1" title="">
							<option value="0" selected="selected">00</option>
							<?php   
							for($i=1;$i<24;$i++){
							?>
							<option value=<?php echo $i  ?>><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							<div class="col-md-3">
							<select name="leasecheck_out_min" class="form-control" id="check_out_min" tabindex="-1" title="">
							<option value="0" selected="selected">00</option>
							<?php   
							for($i=1;$i<60;$i++){
							?>
							<option value=<?php echo $i  ?> ><?php echo $i  ?></option>
							<?php
							}
							?>
							</select>
							</div>
							</div>
							</div>
							<div class="col-md-2">
							<div class="form-group all">
							<label for="grace_time"><?php echo lang('Grace_time');?></label>
							<?php if(!empty($BookingDetails->grace_time)){ echo $BookingDetails->grace_time ; }  ?>
							<select name="leasegrace_time" class="form-control" id="grace_time" tabindex="-1" title="grace time" >
							<option value="00:00" >00:00</option>
							<option value="00:15">00:15</option>
							<option value="00:30" >00:30</option>
							<option value="00:45" >00:45</option>
							<option value="01:00" >01:00</option>
							<option value="01:15">01:15</option>
							<option value="01:30" >01:30</option>
							<option value="01:45" >01:45</option>
							<option value="02:00" >02:00</option>
							<option value="02:15" >02:15</option>
							<option value="02:30" >02:30</option>
							<option value="02:45" >02:45</option>
							<option value="03:00" >03:00</option>
							<option value="03:15">03:15</option>
							<option value="03:30">03:30</option>
							<option value="03:45" >03:45</option>
							</select>
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="Booking_reason"><?php echo lang('Unit');?></label>
						 <select class="form-control "     name="Leaseunit">
			              <option>Select </option>
		     			    <?php
						      foreach($leaseunits as $item){ 
						         ?>
						<option value="<?php echo $item->uid ?>"<?php if(!empty($Unit_id)) echo $Unit_id == $item->uid ?'selected':''  ?> ><?php echo $item->unit_no ?></option>
					     <?php 
					           	 }				
					  	 ?>
                       </select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="Booking_status"><?php echo lang('Booking_status');?>*</label>
							<select name="leaseBooking_status" class="form-control" id="Booking_status"  tabindex="-1" title="Booking status" required>
							<option value="<?php echo lang('conform');?>"><?php echo lang('conform');?></option>
							<option value="<?php echo lang('Pending');?>"><?php echo lang('Pending');?></option>
							<option value="<?php echo lang('Cancel');?>"><?php echo lang('Cancel');?></option>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="Booking_reason"><?php echo lang('Booking_reason');?></label>
							<input name="leaseBooking_reason" value="<?php if(!empty($BookingDetails->night)) echo $BookingDetails->reservation_reason ;  ?>" class="form-control " id="Booking_reason" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="Leaseamount"><?php echo lang('LeaseAmount');?></label>
							<input name="Leaseamount" value="<?php if(!empty($BookingDetails->night)) echo $BookingDetails->reservation_reason ;  ?>" class="form-control Prices" id="Leaseamount" required>
							</div>
							</div>
								<div class="col-md-4">
							<div class="form-group all">
							<label for="extraamount"><?php echo lang('ExtraAmount');?></label>
							<input name="extraamount" value="<?php if(!empty($BookingDetails->night)) echo $BookingDetails->reservation_reason ;  ?>" class="form-control extraPrices" id="Extraamount" required>
							</div>
							</div>
							<div class="clearfix"></div>
						</fieldset>
							
						<div class="clearfix"></div>
						<fieldset>
							<legend><?php echo lang('OwnerDetails');?></legend>
							<div class="col-md-4">
							<div class="form-group">
							<label for="guest_type"><?php echo lang('OwnerType');?>*</label>
							<select name="Ownertype" class="form-control" id="guest_type"  tabindex="-1" title="guest type" required>
							<option value="<?php echo lang('Booking_self');?>" ><?php echo lang('Booking_self');?></option>
							<option value="<?php echo lang('Booking_Others');?>" ><?php echo lang('Booking_Others');?></option>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group">
							<label for="guest_mode"><?php echo lang('OwnerMode');?> *</label>
							<select name="OwnerMOde" class="form-control" id="guest_mode"  tabindex="-1" title="guest mode" required>
							<option value="<?php echo lang('New_customer');?>" ><?php echo lang('New_customer');?></option>
							<option value="<?php echo lang('Regular');?>" ><?php echo lang('Regular');?></option>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all customer" style="display:none;">
							<label for="regular_Owner"><?php echo lang('Regular_Owner');?></label>
						
							<select class="form-control  LeaseOwner"     name="LeaseOwner" required>
		                	 <option>Select </option>
		     			 <?php
						  foreach($leaseowner as $item){ 
						 ?>
						<option value="<?php echo $item->id ?>"<?php if(!empty($LeaseOwner_id)) echo $LeaseOwner_id == $item->id ?'selected':''  ?> ><?php echo $item->firstname ?></option>
					<?php 
						 }				
						 ?>
							</select>
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="first_name"><?php echo lang('firstname');?> *</label>
							<input name="ownerfirst_name" value="" class="form-control " id="first_names" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="last_name"><?php echo lang('lastname');?> *</label>
							<input name="Ownerlast_name" value="" class="form-control " id="last_names" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="email_address"><?php echo lang('email');?>*</label>
							<input name="Owneremail_address" value="" type="email" class="form-control " id="email_address_s" >
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="phone_number"><?php echo lang('Phone');?> *</label>
							<input name="Ownerphone_number" value="" class="form-control" maxlength="10" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" id="phone_numbers" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="address"><?php echo lang('address');?> *</label>
							<input name="Owneraddress" value="" class="form-control " id="address_s" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="country"><?php echo lang('country');?></label>

							<select name="country_ids" class="form-control select" id="country_ids" placeholder="Select Country" style="width: 100%;"  tabindex="-1" title="">
							<option value="" >select </option>
							<?php 
							if(isset($country)){
							foreach($country as $countrys){
							?>
							<option value="<?php echo $countrys->id  ?>" <?php if(!empty($Guest->country_id)) echo $Guest->country_id ==   $countrys->id   ? 'selected':''   ?>><?php echo $countrys->name  ?></option>
							<?php
							}
							}
							?>
							</select>
							</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-4">
							<div class="form-group">
							<label for="id_proof"><?php echo lang('Id_proof');?>*</label>
							<select name="id_proofs" class="form-control" id="id_proofs"  tabindex="-1" title="id proof" required>
							<option value="<?php echo lang('passbook');?>"
							<?php if(!empty($Guest->id_type)) echo $Guest->id_type ==    lang('passbook') ? 'selected':''   ?>><?php echo  lang('passbook');  ?></option>
							<option value="<?php echo lang('Others');?>" <?php if(!empty($Guest->id_type)) echo $Guest->id_type ==    lang('Others') ? 'selected':''   ?>><?php echo lang('Others');?></option>
							</select>
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="id_number"><?php echo lang('Id_Number');?>*</label>
							<input name="id_numbers" value="<?php if(!empty($Guest->id_no)){ echo $Guest->id_no ; }  ?>" class="form-control " id="id_numbers" maxlength="15" minlength="7" >
							</div>
							</div>
							<div class="col-md-4">
							<div class="form-group all">
							<label for="document"><?php echo lang('Attachment');?></label>
							<span class="file-input file-input-new">
							<div class="input-group">
							<div tabindex="-1" class="form-control file-caption  kv-fileinput-caption">
							<div class="file-caption-name"></div>
							</div>
							<div class="input-group-btn">
							<div class="btn btn-primary btn-file downloads"> 
							<i class="fa fa-folder-open"></i> &nbsp;Browse ... <input id="document" type="file" data-browse-label="Browse ..." name="document"  class="form-control file">
							</div>
							</div>
							</div>
							</span>
							</div>
							</div>
						</fieldset>
					
						<div class="clearfix"></div>
						<fieldset>
						<legend><?php  echo lang('Payment_Details'); ?></legend>
		      	<div id="payments">
				<div class=" well-sm well_1">
				<div class="payment">
					<div class="row">
						<div class="col-sm-12">
						<div class="form-group">
						<label for="paid_by_1"><?php  echo lang('Content'); ?></label>
						<textarea rows="5" cols="40" name="content" autocomplete="off" style="width: 100%;"></textarea>
						</div>
						</div>
						<div class="paymentblockall">
						<div class="col-sm-12">
						<div class="form-group">			<label for="paid_by_1"><?php  echo lang('Payingby'); ?></label>
						<select name="paid_by[]" id="paid_by_1" class="form-control paid_by" title="Paying by"  tabindex="-1">
						<option value="<?php  echo lang('cash'); ?>"><?php  echo lang('amount'); ?></option>
						<option value="<?php  echo lang('card'); ?>"><?php  echo lang('card'); ?></option>				
						<option value="<?php  echo lang('Others'); ?>"><?php  echo lang('Others'); ?></option>
						</select>
						</div>
						</div>
						<div class="main_detail">
						<div class="col-sm-6">
						<div class="form-group" style="margin-bottom: 5px;">
						<label><?php  echo lang('amount'); ?></label>
						<input name="amount[]" type="text" id="amount_1" data-currency="currency_id_1" maxlength="10"  ondrop="return false;" onpaste="return false;" class="pa form-control  amount payamounts" autocomplete="off" required>
						</div>
						</div>

						<div class="col-sm-6">
						<div class="form-group" style="margin-bottom: 5px;">
						<label><?php  echo lang('currency'); ?></label>
						<select name="currency_id[]" id="currency_id_1" class="form-control currency" title="" tabindex="-1"><option value="1" selected=""> US Dollar</option>		
						</select>
						</div>
						</div>
						</div>
						</div>
						<div class="row">
						<div class="col-sm-12 paymentblock">
						<div class="form-group gc_1" style="display: none;">
						<label for="gift_card_no_1">Gift Card No</label>                                        
						<input name="paying_gift_card_no[]" type="text" id="gift_card_no_1" class="pa form-control kb-pad gift_card_no">
						<div id="gc_details_1"></div>
						</div>
						<div class="pcc_1" style="display: block;">
							<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<input name="cc_no[]" type="text" id="pcc_no_1" maxlength="18"  ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Credit Card No">
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<input name="cc_holer[]" type="text" id="pcc_holder_1" class="form-control" placeholder="Holder Name">
							</div>
							</div>
							<div class="col-md-3">
							<div class="form-group">
								<select name="cc_type[]" id="pcc_type_1" class="form-control pcc_type" placeholder="Card Type" title="" tabindex="-1">
									<option value="<?php  echo lang('Visa'); ?> "><?php  echo lang('Visa'); ?> </option>
									<option value="<?php  echo lang('Mastercard'); ?>"><?php  echo lang('Mastercard'); ?> </option>
									<option value="<?php  echo lang('Amex'); ?>"><?php  echo lang('Amex'); ?> </option>
									<option value="<?php  echo lang('Discover'); ?>"><?php  echo lang('Discover'); ?> </option>
								</select>
							</div>
							</div>
							<div class="col-md-3">
							<div class="form-group">
								<input name="cc_month[]" type="text" id="pcc_month_1" maxlength="2"  ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Month">
							</div>
							</div>
							<div class="col-md-3">
							<div class="form-group">
								<input name="cc_year[]" type="text" id="pcc_year_1" maxlength="4"  ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Year">
							</div>
							</div>
							<div class="col-md-3">
							<div class="form-group">
								<input name="cc_cvv2[]" type="text" id="pcc_cvv2_1" maxlength="3"  ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Security Code">
							</div>
							</div>
							</div>
						</div>
						<div class="pcheque_1" style="display:none;">
						<div class="form-group"><label for="cheque_no_1"><?php  echo lang('Cheque'); ?> </label>        
						<input name="cheque_no[]" type="text" id="cheque_no_1" class="form-control cheque_no">
						</div>
						</div>
						</div>
						</div>
					</div>
					</div>
					</div>
				</div>
			
				<div style="clear:both; height:15px;"></div>
				<div class="table_sec1">
					<table class="table table-bordered" style="margin-bottom: 0;">
						<tbody>
							<tr>
							<td>
							<?php  echo lang('Total_payable'); ?>							</td>
							<td class="text-right">
							<input type="text" name="totalpayables" value="" class="form-control totalpayable totalpayingleaseowner">
							<!--<span id="twt">$1.00</span></td>-->
							<td>
							<?php  echo lang('Advance_traiff'); ?> 
							</td>
							<td class="text-right">
							<input type="text" name="advancetraiffs" value="" class="form-control advancetraiff">
							<!--<span id="twt_BASE">$1.00</span>-->
							</td>
							</tr>
							<tr>
							<td><?php  echo lang('Total_paying'); ?></td>
							<td class="text-right"><span class="leasetotalpaying">$0.00</span>
							<input type="hidden" name="total_paying" class="leasetotalpaying "></td>
							<td><?php  echo lang('Balance'); ?></td>
							<td class="text-right"><span class="leaseownerBalance">$0.00
							</span><input type="hidden" name="balance" class="leaseownerBalance">
							</td></tr>
						</tbody>
					</table>
				<div class="clearfix"></div>
				<br>
					<div class="col-md-12">
					<div class="form-group">
					<input type="submit" value="<?php  echo lang('save'); ?>" class="btn btn-success" id="payment">
					</div>
					</div>
				</div>
				</fieldset>                    
                 </form>   
                </div>
			</div>
		</div>
	</div>

</div>
</div>
</div>


</section>
<script type="text/javascript">
 $(document).ready(function() {
    $('#my-select').multiselect();
  });
 </script>
 
 <script>
   function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#displayimage')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
 
 </script>
 <div class="modal fade in" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" style="z-index: 9999;"
aria-hidden="true">
</div>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
	function parseDate(str) {
	var mdy = str.split('/');
	return new Date(mdy[2], mdy[0]-1, mdy[1]);
	}

	function datediff(first, second) {
	return Math.round((second-first)/(1000*60*60*24));
	}
	$('.datepicker').on('onClose',function(){
	var checkin=$('#check_in_date').val();
	var checkout=$('#checkoutDate').val();
	//alert(datediff(checkin, checkout));
	});
</script>
<script>
	$(function() {
	$('.datepicker').datepicker({
	todayHighlight: true,
	autoclose: true,
	format: 'yyyy-mm-dd',
	});
	});
</script>
<script>
	$(function() {
	$('.dobdatepicker').datepicker({
	todayHighlight: true,
	autoclose: true,
	format: 'yyyy-mm-dd',
	});
	});
</script>
<script>
	function isNumeric(event) {
	return !isNaN(parseFloat(event)) && isFinite(event);
	}
</script>
<script>
	$('.units').on('change',function(){
	var Id=$(this).val();
	var rows='<tr><td><select name="unittype[]" class="form-control select unittype"  id="unittype"><option value="">Select </option><?php if(isset($unittype)){ foreach($unittype as $unittypes){ ?><option value=<?php echo $unittypes->id  ?>><?php echo $unittypes->UnitType  ?></option><?php } } ?></select></td><td><select name="unit_id[]" class="form-control select Unit_id"  id="unit_id"><option value="00" >select </option></select></td><td><input name="price[]" value="" class="form-control unitprice"   id="price0"></td><td><select name="extrabeds[]" class="form-control select extrabeds"  id="extrabeds"><option value="">Select </option><?php    for($i=1;$i<10;$i++){ ?><option value=<?php echo $i  ?>><?php echo $i  ?></option><?php }
	?></select></td><td><input name="extra_price[]" value="" class="form-control extra_price total_extra_traiff" id="extra_price0"></td></tr>';

	var row='';
	for(var i=0;i<Id;i++){
	row +=rows;
	}
	$('#number_Units').html(row);
	});
	$('.adult').on('change',function(){
	var Id=$(this).val();
	var rows='<tr id="number_adult"><td><input name="adult_name[]" value="" class="form-control tip"  id="adult_name0"></td><td><input name="adult_age[]" value="" class="form-control tip" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"  maxlength="2" minlength="1" id="adult_age0"></td><td><input name="adult_birth[]" value="" class="form-control  dobdatepicker" id="check_in_date" placeholder="YYYY-MM-DD"  type="date"></td><td><select name="adult_gender[]" class="form-control" id="adult_gender0"><option value=<?php echo lang('male');?>><?php echo lang('male');?></option><option value=<?php echo lang('female');?>><?php echo lang('female');?></option><option value=<?php echo lang('Others');?>><?php echo lang('Others');?></option></select></td><td><select name="adult_id_proof[]" class="form-control" id="adult_id_proof0"><option value="<?php echo lang('passbook');?>"><?php echo lang('passbook');?></option><option value="<?php echo lang('Others');?>"><?php echo lang('Others');?></option></select></td><td><input name="adult_id_number[]" value="" class="form-control tip" maxlength="15" minlength="7" id="adult_id_number0"></td></tr>';
	var row='';
	for(var i=0;i<Id;i++){
	row +=rows;
	}
	$('#number_adults').html(row);
	});

	$(document).on('change', '.unittype', function(){
	var val = $(this).val();
	if(val){
	$.ajax({
	url: '<?php echo site_url('admin/Office/unit_load_ajax') ?>',
	type:'POST',
	data:{unittype:val},
	success:function(result){
	 $('.Unit_id').html(result);
	}
	});
	}     
	}); 
	$(document).on('change', '#guest_mode', function(){

	var val = $(this).val();
	if(val =='Regular'){
	$(".customer").css({ 'display' : '' });
	$.ajax({
	url: '<?php echo site_url('admin/Office/Get_guest_list') ?>',
	type:'POST',
	data:{type:val},
	success:function(result){
	$('#customer_id').html(result);
	}
	});
	}else{
	$(".customer").css({ 'display' : 'none' });
	}
	}); 
	$(document).on('change', '#customer_id', function(){
	var val = $(this).val();
	var urls='<?php echo base_url('assets/admin/') ?>';
	$.ajax({
	url: '<?php echo site_url('admin/Office/Get_guest') ?>',
	type:'POST',
	data:{guest_id:val},
	dataType: "JSON",
	success:function(result){
	$('#id_number').val(result.id_no);
	$('#address').val(result.address);
	$('#phone_number').val(result.mobile);
	$('#email_address').val(result.email);
	$('#last_name').val(result.lastname);
	$('#first_name').val(result.firstname);
	$('#country_id').append('<option selected value='+result.country_id+'>'+result.NAME+'</option>');
	$('#id_proof').append('<option selected value='+result.id_type+'>'+result.id_type+'</option>');
	if(result.id_upload==''){
	}else{
	$('.downloads').html('<a href='+urls+'/uploads/ids/'+result.id_upload+' ><span class="glyphicon glyphicon-download-alt"></span></a>');
	}
	}
	});
	}); 
</script>
<script>
	$(document).ready(function() {
	$(".paymentblock").css({ 'display' : 'none' });
	$(document).on('change', '#paid_by_1', function(){
	var val = $(this).val();
	if(val=='Credit Card'){
	$(".paymentblock").css({ 'display' : '' });
	}
	else{
	$(".paymentblock").css({ 'display' : 'none' });
	}
	});
	});
	$(document).ready(function(){
	var maxField = 10; 
	var addButton = $('.addButton');
	var wrapper = $('.paymentblockall'); 
	var fieldHTML = '<div class="col-sm-12"><div class="form-group"><label for="paid_by_1">Paying by</label><select name="paid_by[]" id="paid_by_1" class="form-control paid_by" title="Paying by"  tabindex="-1"><option value="cash">Cash</option><option value="Credit Card">Credit Card</option><option value="other">Other</option></select></div></div><div class="main_detail"><div class="col-sm-6"><div class="form-group" style="margin-bottom: 5px;"><label>Amount</label><input name="amount[]" type="text" id="amount_1" data-currency="currency_id_1" maxlength="10" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="pa form-control  amount payamount" autocomplete="off"></div></div><div class="col-sm-6"><div class="form-group" style="margin-bottom: 5px;"><label>Currency Type</label><select name="currency_id[]" id="currency_id_1" class="form-control currency" title="" tabindex="-1"><option value="1" selected=""> US Dollar</option></select></div></div></div></div><div class="row"><div class="col-sm-12 paymentblock" style="display:none;"><div class="form-group gc_1" style="display: none;"><label for="gift_card_no_1">Gift Card No</label><input name="paying_gift_card_no[]" type="text" id="gift_card_no_1" class="pa form-control kb-pad gift_card_no"><div id="gc_details_1"></div></div><div class="pcc_1" style="display: block;"><div class="row"><div class="col-md-6"><div class="form-group"><input name="cc_no[]" type="text" id="pcc_no_1" maxlength="18" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Credit Card No"></div></div><div class="col-md-6"><div class="form-group"><input name="cc_holer[]" type="text" id="pcc_holder_1" class="form-control" placeholder="Holder Name"></div></div><div class="col-md-3"><div class="form-group"><select name="cc_type[]" id="pcc_type_1" class="form-control pcc_type" placeholder="Card Type" title="" tabindex="-1"><option value="Visa">Visa</option><option value="MasterCard">MasterCard</option><option value="Amex">Amex</option><option value="Discover">Discover</option></select></div></div><div class="col-md-3"><div class="form-group"><input name="cc_month[]" type="text" id="pcc_month_1" maxlength="2" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Month"></div></div><div class="col-md-3"><div class="form-group"><input name="cc_year[]" type="text" id="pcc_year_1" maxlength="4" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Year"></div></div><div class="col-md-3"><div class="form-group"><input name="cc_cvv2[]" type="text" id="pcc_cvv2_1" maxlength="3" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Security Code"></div></div></div></div><div class="pcheque_1" style="display:none;"><div class="form-group"><label for="cheque_no_1">Cheque No</label><input name="cheque_no[]" type="text" id="cheque_no_1" class="form-control cheque_no"></div></div></div></div></div>';
	//New input field 
	var x = 1; 
	$(addButton).click(function(){
	if(x < maxField){ 
	x++; 
	$(wrapper).append(fieldHTML); 
	}
	});
	$(wrapper).on('click', '.remove_button', function(e){
	e.preventDefault();
	$(this).parent('div').remove();
	x--; 
	});
	});
	$(document).ready(function(){
	var maxField = 10; 
	var addButton = $('.fa-plus');
	var wrapper = $('.vehicle_details'); 
	var fieldHTML = '<div class="col-xs-12 vehicle" id="arrival"><div class="col-md-3"><div class="form-group all"><label for="vehicle_date">Slot No</label><select name="Slotno[]" class="form-control" id="Slotno" tabindex="-1" title=""><option>Select</option><?php  if(isset($Slot)){ foreach($Slot as $Slots){ ?><option value="<?php echo $Slots->id ; ?>"><?php echo $Slots->Slot_No ;  ?></option><?php    } } ?></select></div></div><div class="col-md-3"><div class="form-group all"><label for="location">Vehicle No</label>  <input name="vechileno[]" value="" class="form-control "></div></div><div class="col-md-2"><div class="form-group all row"><label for="vehicle_date" class="col-md-12">arrival</label>  <div class="col-md-6"><select name="vehicle_hour_arrival[]" class="form-control" id="vehicle_hour_arrival" tabindex="-1" title=""><option value="">hour</option><?php   for($i=1;$i<24;$i++){ ?><option value=<?php echo $i  ?>><?php echo $i  ?></option><?php } ?></select></div><div class="col-md-6"><select name="vehicle_min_arrival[]" class="form-control" id="vehicle_min_arrival" tabindex="-1" title=""><option value="">Min</option><option value="0" >00</option><?php   for($i=1;$i<60;$i++) { ?><option value=<?php echo $i  ?>><?php echo $i  ?></option><?php } ?></select></div></div></div><div class="col-md-2"><div class="form-group all row"><label for="vehicle_date" class="col-md-12">Departure</label>  <div class="col-md-6"><select name="vehicle_hour_depart[]" class="form-control" id="vehicle_hour_Departure" tabindex="-1" title=""><option value="">hour</option><option value="0" >00</option><?php   for($i=1;$i<24;$i++) { ?><option value=<?php echo $i  ?>><?php echo $i  ?></option><?php  } ?></select></div><div class="col-md-6"><select name="vehicle_min_depart[]" class="form-control" id="vehicle_min_arrival" tabindex="-1" title=""><option value="">Min</option><option value="0">00</option><?php   for($i=1;$i<60;$i++){ ?><option value=<?php echo $i  ?>><?php echo $i  ?></option><?php } ?></select></div></div></div><div class="col-md-2"><label for="vehicle_date" class="col-md-12">&nbsp;</label> <i class="glyphicon glyphicon-remove"></i></div></div>'; 
	var x = 1; 
	$(addButton).click(function(){
	if(x < maxField){ 
	x++; 
	$(wrapper).append(fieldHTML); 
	}
	});
	$(wrapper).on('click', '.glyphicon-remove', function(e){
	e.preventDefault();
	$(this).parent().parent().remove();
	x--; 
	});
	});
</script>
<script>
	 $(document).ready(function () {
	$('#Booking_form').validate({ 
	rules: {
	check_in_date: {
	required: true,
	},
	number_of_adult: {
	required: true,
	},
	number_of_Units: {
	required: true,
	},
	Booking_status: {
	required: true,
	},
	guest_type: {
	required: true,
	},
	guest_mode: {
	required: true,
	},
	first_name: {
	required: true,
	},
	phone_number: {
	required: true,
	},
	country_id: {
	required: true,
	},
	totalpayable: {
	required: true,
	},
	advancetraiff: {
	required: true,
	},
	unittype: {
	required: true,
	},
	unit_id: {
	required: true,
	},
	price: {
	required: true,
	}
	},
	messages: {

	check_in_date: 'This field is required',


	},
	});

	}); 
</script>
<script>
	$(document).ready(function() {

		 $(document).on('change', '.unitprice', function(){

		var total = 0; 
	   var extratotal = 0;     
	   var Granttotal = 0;     
		$('.unitprice').each(function() {
			total +=  Number($(this).val());
		});
		$('.extra_price').each(function() {
			extratotal +=  Number( $(this).val() );
		});
		Granttotal=total + Number(extratotal);
		$('.totalpayable').val(Granttotal);
	});
	});
	 $(document).on('change', '.extra_price', function(){
		var total = 0; 
		var extratotal = 0;     
		var Granttotal = 0;     
		$('.unitprice').each(function() {
			total +=  Number($(this).val());
		});
		$('.extra_price').each(function() {
			extratotal +=  Number( $(this).val() );
		});
		Granttotal=total + Number(extratotal);
		$('.totalpayable').val(Granttotal);
	});
	 $(document).on('change', '.payamount', function(){

		var payingtotal = 0; 
		var total = 0;     
		var Granttotal = 0;  
		var balance=0;	
		$('.payamount').each(function() {
			payingtotal +=  Number($(this).val());
		});
		balance= Number(isNaN($('.totalpayable').val()) ? 0 : $('.totalpayable').val()) -payingtotal;
		$('.total_paying').val(payingtotal);
		$('#total_paying1').text(payingtotal);
		$('.balance_BASE').val(balance);
		$('#balance_BASE1').text(balance);
	});
</script>
  <script>
	$('form').attr('autocomplete', 'off');
	</script>
<script>
	$(function() {
	$('.datepicker').datepicker({
	todayHighlight: true,
	autoclose: true,
	format: 'yyyy-mm-dd',
	});
	});
</script>
<script>
$(document).on('change', '.LeaseOwner', function(){
	var val = $(this).val();
	var urls='<?php echo base_url('assets/admin/') ?>';
	$.ajax({
	url: '<?php echo site_url('admin/Office/Get_LeaseOwnerDeatils') ?>',
	type:'POST',
	data:{Owner_id:val},
	dataType: "JSON",
	success:function(result){
	$('#id_numbers').val(result.id_no);
	$('#address_s').val(result.address);
	$('#phone_numbers').val(result.mobile);
	$('#email_address_s').val(result.email);
	$('#last_names').val(result.lastname);
	$('#first_names').val(result.firstname);
	$('#country_ids').append('<option selected value='+result.country_id+'>'+result.name+'</option>');
	$('#id_proofs').append('<option selected value='+result.id_type+'>'+result.id_type+'</option>');
	if(result.id_upload==''){
	}else{
	$('.downloads_s').html('<a href='+urls+'/uploads/ids/'+result.id_upload+' ><span class="glyphicon glyphicon-download-alt"></span></a>');
	}
	}
	});
	}); 
 $(document).on('change', '.payamounts', function(){
		var bookAmount=Number(isNaN($('.totalpayingleaseowner').val()) ? 0 : $('.totalpayingleaseowner').val());
		var payingtotal = 0; 
		var total = 0;     
		var Granttotal = 0;  
		var balance=0;	
		$('.payamounts').each(function() {
			payingtotal +=  Number($(this).val());
		});
		balance= Number(isNaN($('.totalpayingleaseowner').val()) ? 0 : $('.totalpayingleaseowner').val()) -payingtotal;
		$('.leasetotalpaying').val(payingtotal);
		$('.advancetraiff').val(payingtotal);
		$('.leaseownerBalance').val(balance);
		$('.leasetotalpaying').text(payingtotal);
		$('.leaseownerBalance').text(balance);
	});
 $(document).on('change', '.Prices', function(){
	
	    var Amount=Number(isNaN($('.Prices').val()) ? 0 : $('.Prices').val());
		var ExtraAmount=Number(isNaN($('.extraPrices').val()) ? 0 : $('.extraPrices').val());
		var payingtotal = 0; 
		payingtotal=Amount+Number(ExtraAmount);
	
	    $('.totalpayingleaseowner').val(payingtotal);
		$('#totalpayingleaseowner').val(payingtotal);
 });
  $(document).on('change', '.extraPrices', function(){
	
	    var Amount=Number(isNaN($('.extraPrices').val()) ? 0 : $('.extraPrices').val());
		var ExtraAmount=Number(isNaN($('.Prices').val()) ? 0 : $('.Prices').val());
		var payingtotal = 0; 
		payingtotal=Amount+Number(ExtraAmount);
		
	    $('.totalpayingleaseowner').val(payingtotal);
		$('#totalpayingleaseowner').val(payingtotal);
		
	 
 });
</script>


<script>
	jQuery(document).ready(function(){
	$('#leaseunitBooking_form').validate({ 
	alert(22);
	rules: {
	leaseBooking_mode: {
	required: true,
	},
	leaseBooking_type: {
	required: true,
	},
	Leasetype: {
	required: true,
	},
	Leasecheck_in_date: {
	required: true,
	},
	leasecheck_out_date: {
	required: true,
	},
	Leaseunit: {
	required: true,
	},
	leaseBooking_status: {
	required: true,
	},
	Leaseamount: {
	required: true,
	},
	Ownertype: {
	required: true,
	},
	OwnerMOde: {
	required: true,
	},
	ownerfirst_name: {
	required: true,
	},
	Ownerphone_number: {
	required: true,
	},
	Owneraddress: {
	required: true,
	},
	Ownerphone_number: {
	required: true,
	}
	},
	messages: {

	check_in_date: 'This field is required',


	},
	});

	}); 
</script>
