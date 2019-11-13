<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">  <?php  $seg= $this->uri->segment(4);?>

<script src="<?php echo base_url('assets/admin/') ?>/dist/js/jquery.validate.min.js"></script>

<style>

.error {
color: red;

}
.dashboard_sec label{
color:red; }
.dashboard_sec{padding-bottom: 60px;}
.Booking h2{color:#3c3c3c;border-bottom: 1px solid #b4bcc3;padding-bottom: 10px;display:block;font-size: 25px;width: auto;}
.dashboard_sec .table-responsive{padding-left: 30px;}
.dashboard_sec .table-responsive table thead tr th{ background-color: transparent!important;    border-color:transparent!important;border-top: 1px solid transparent!important;    color: #666666!important;font-size: 16px;font-weight: normal;text-transform: capitalize;}
.dashboard_sec .table-responsive table tbody tr td{background-color: transparent!important;  border-color:transparent!important;border-top: 1px solid transparent!important;    color: #666666!important;font-size: 16px;font-weight: normal;outline:none;box-shadow:none!important;}
.dashboard_sec .table-responsive table tbody tr{background-color:none!important;}
.dashboard_sec .btn-primary{    background-color: #0f395b;    border-color: #0f395b;}
.Booking_details{    margin: 0px 0px 30px 30px;}
.Booking_res table{width: 100%;margin-left: 15px;}
.Booking_res table tbody tr td:nth-child(1){color: #666666;font-size: 16px;line-height: 40px;font-weight: 600;}
.Booking_res table tbody tr td:last-child{color: #989898;}
.Booking_res h4{border-bottom: 1px solid #232323;    display: inline-block;color: #232323;    font-size: 20px;    padding-bottom: 5px;    margin-left: 15px;}
.guest_reserver{margin-top: 40px;}
.dashboard_sec .adult_details table thead tr th{background-color: transparent !important;border-color: #a1a1a1!important;border-top: 1px solid #a1a1a1!important;text-align: center;padding: 10px 0px;}
.dashboard_sec .adult_details table tbody tr td{text-align: center;}
.guest_reserver p{color: #989898;font-size: 16px;font-weight: normal;line-height: 28px;text-align: left;padding-left: 15px;}
.dashboard_sec .form-control{border-radius: 5px!important;border:none;}
.dashboard_sec .form-control .select2-choice{border-radius: 5px!important;border:none;}
.dashboard_sec label{color: #666666;font-weight: normal;font-size: 16px;text-transform: capitalize;}
#check_in::after{content: '';position: relative;background-image: url(../../images/calender.png);top: 0px;right: 0px;bottom: 0px;left: 0px;z-index: 999999;float: left;}
fieldset {
padding: .35em .625em .75em;
margin: 0 15px;
border: none;
-webkit-box-shadow: 0px 0px 6px 1px #CCCCCC; 
box-shadow: 0px 0px 1px 1px #CCCCCC;
border-radius: 0px;
margin-bottom: 20px;
}
legend {
display: block;
width: auto; 
color: #3c3c3c;
border-bottom: 1px solid #3c3c3c!important; 
border-bottom: none;
font-size: 18px;
background-color: #fff;
margin: 0px 15px;
}
.Booking{background-color: #fff;}
@media (min-width: 768px) {
#sidebar-wrapper.sidebar-toggle {
transition: 0s;
left: 200px;
}
}
.table_sec1 table tr td{border: 1px solid #ccc;}
select {
    -moz-appearance:none; /* Firefox */
    -webkit-appearance:none; /* Safari and Chrome */
    appearance:none;
	background:none;
	border:none;
}
select option{display:none;border:none;line-height:0px;}
.btn_default{background-color: #2C3542 !important;
color: #fff!important;
padding: 3px 30px;
border-radius: 5px;
border-color: #2C3542;}
</style>
<section class="content" style="padding:50px;background-color: #ffff;">
<div class="row">
<div class="dashboard_sec">
<div class="row">
	<button type=""button" class="btn btn-default pull-right btn_default print-button hidden">Print</button>
</div>
<div class="row">
<form action="<?php echo site_url('admin/Office/booking_edit_save/'); ?>" role="form" id="Booking_form" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
<input type="hidden" value="<?php  if(isset($id)){  echo $id ; } ?>" name="bookid">
<div class="clearfix"></div>
<fieldset>
<legend><?php echo lang('Booking_details');?></legend>
<div class="col-md-4">
<div class="form-group">
<label for="Booking_type"><?php echo lang('Booking_Type');?></label>                                        
<select name="Booking_type" class="form-control" id="Booking_type"  tabindex="-1" title="Booking type">
<option value="walk_in" <?php if(!empty($BookingDetails->reservation_type)) echo $BookingDetails->reservation_type ==    lang('walk_in') ? 'selected':''   ?>><?php echo lang('walk_in');?></option>
<option value="phone_booking" <?php if(!empty($BookingDetails->reservation_type)) echo $BookingDetails->reservation_type ==    lang('phone_booking') ? 'selected':''   ?>><?php echo lang('phone_booking');?></option>

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
<input name="check_in_date" value="<?php if(!empty($BookingDetails->check_in)){ echo date('Y-m-d', strtotime($BookingDetails->check_in)) ; }  ?>" class="form-control  datepicker" id="check_in_date" placeholder="YYYY-MM-DD"  >
</div>
<div class="col-md-3">
<select name="check_in_hour" class="form-control" id="check_in_hour" tabindex="-1" title="">
<option value="0">00</option>
<?php   
for($i=1;$i<24;$i++)
{
?>
<option value=<?php echo $i  ?> <?php if(!empty($BookingDetails->check_in)) echo date('H', strtotime($BookingDetails->check_in)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3">
<select name="check_in_min" class="form-control" id="check_in_min" tabindex="-1" title="" >
<option value="0" selected="selected">00</option>
<?php   
for($i=1;$i<60;$i++)
{
?>
<option value=<?php echo $i  ?> <?php if(!empty($BookingDetails->check_in)) echo date('i', strtotime($BookingDetails->check_in)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
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
<input name="check_out_date" value="<?php if(!empty($BookingDetails->check_out)){ echo date('Y-m-d', strtotime($BookingDetails->check_out)) ; }  ?>" class="form-control  datepicker" id="checkoutDate" placeholder="YYYY-MM-DD" >
</div>
<div class="col-md-3">
<select name="check_out_hour" class="form-control" id="check_out_hour" tabindex="-1" title="">
<option value="0" selected="selected">00</option>
<?php   
for($i=1;$i<24;$i++)
{
?>
<option value=<?php echo $i  ?> <?php if(!empty($BookingDetails->check_out)) echo date('H', strtotime($BookingDetails->check_out)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3">
<select name="check_out_min" class="form-control" id="check_out_min" tabindex="-1" title="">
<option value="0" selected="selected">00</option>
<?php   
for($i=1;$i<60;$i++)
{
?>
<option value=<?php echo $i  ?> <?php if(!empty($BookingDetails->check_out)) echo date('i', strtotime($BookingDetails->check_out)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
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

<select name="grace_time" class="form-control" id="grace_time" tabindex="-1" title="grace time" >
<option value="00:00" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '00:00:00' ? 'selected':''   ?>>00:00</option>
<option value="00:15" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '00:15:00' ? 'selected':''   ?>>00:15</option>
<option value="00:30" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '00:30:00' ? 'selected':''   ?>>00:30</option>
<option value="00:45" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '00:45:00' ? 'selected':''   ?>>00:45</option>
<option value="01:00" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '01:00:00' ? 'selected':''   ?>>01:00</option>
<option value="01:15" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '01:15:00' ? 'selected':''   ?>>01:15</option>
<option value="01:30" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '01:30:00' ? 'selected':''   ?>>01:30</option>
<option value="01:45" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '01:45:00' ? 'selected':''   ?>>01:45</option>
<option value="02:00" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '02:00:00' ? 'selected':''   ?>>02:00</option>
<option value="02:15" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '02:15:00' ? 'selected':''   ?>>02:15</option>
<option value="02:30" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '02:30:00' ? 'selected':''   ?>>02:30</option>
<option value="02:45" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '02:45:00' ? 'selected':''   ?>>02:45</option>
<option value="03:00" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '03:00:00' ? 'selected':''   ?>>03:00</option>
<option value="03:15" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '03:15:00' ? 'selected':''   ?>>03:15</option>
<option value="03:30" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '03:30:00' ? 'selected':''   ?>>03:30</option>
<option value="03:45" <?php if(!empty($BookingDetails->grace_time)) echo $BookingDetails->grace_time == '03:45:00' ? 'selected':''   ?>>03:45</option>
</select>
</div>
</div>
<div class="clearfix"></div>
<div class="col-md-4">
<div class="form-group all">
<label for="night"><?php echo lang('Nights');?> *</label>
<input name="night" value="<?php if(!empty($BookingDetails->night)) echo $BookingDetails->night ;  ?>" class="form-control" id="night"  maxlength="2" minlength="1" >
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="number_of_adult"><?php echo lang('Number_Of_Adults');?> *</label>

<select name="number_of_adult" class="form-control adult" id="number_of_adult"  tabindex="-1" title="number of adult">
<option value="" selected="selected">Select Adult</option>
<option value="1" <?php if(!empty($BookingDetails->number_of_adult)) echo $BookingDetails->number_of_adult ==  1 ? 'selected':''   ?>>1</option>
<?php   
for($i=2;$i<15;$i++){
?>
<option value=<?php echo $i  ?> <?php if(!empty($BookingDetails->number_of_adult)) echo $BookingDetails->number_of_adult ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>

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
<option value=<?php echo $i  ?> <?php if(!empty($BookingDetails->number_of_child)) echo $BookingDetails->number_of_child ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>


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
<select name="number_of_Units" class="form-control units" id="number_of_Units"  tabindex="-1" title="number of Units" >
<option value="" selected="selected">Select Units</option>
<?php   
for($i=1;$i<8;$i++){
?>
<option value=<?php echo $i  ?> <?php if(!empty($BookingDetails->number_of_rooms)) echo $BookingDetails->number_of_rooms ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="Booking_status"><?php echo lang('Booking_status');?>*</label>
<select name="Booking_status" class="form-control" id="Booking_status"  tabindex="-1" title="Booking status" >
<option value="<?php echo lang('conform');?>"<?php if(!empty($BookingDetails->reservation_status)) echo $BookingDetails->reservation_status ==    lang('conform') ? 'selected':''   ?>><?php echo lang('conform');?></option>
<option value="<?php echo lang('Pending');?>"<?php if(!empty($BookingDetails->reservation_status)) echo $BookingDetails->reservation_status ==    lang('Pending') ? 'selected':''   ?>><?php echo lang('Pending');?></option>
<option value="<?php echo lang('Cancel');?>"<?php if(!empty($BookingDetails->reservation_status)) echo $BookingDetails->reservation_status ==    lang('Cancel') ? 'selected':''   ?>><?php echo lang('Cancel');?></option>
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
<table id="Units" class="table col-xs-12 table-bordered ">
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

<?php
 if(isset($getunit)){
	 foreach($getunit as $getunits){
		 
?>



<tr><td><input type="hidden" name="unitsids[]" value="<?php  if(isset($getunits->id)){ echo ($getunits->id) ; } ?>"><select name="unittype[]" class="form-control select unittype"  id="unittype"><option value="">Select </option>
<?php if(isset($unittype)){ foreach($unittype as $unittypes){ ?><option value=<?php echo $unittypes->id  ?>   <?php if(!empty($getunits->Unit_type)) echo $getunits->Unit_type ==   $unittypes->id ? 'selected':''   ?>><?php echo $unittypes->UnitType  ?></option><?php } } ?>

</select></td><td><select name="unit_id[]" class="form-control select Unit_id"  id="unit_id"><option value="00" >select </option>
<?php
if(isset($allunit)){
	foreach($allunit as $allunits){
		if($allunits->Unit_type==$getunits->Unit_type){
?>
<option value="<?php echo $allunits->uid  ?>"  <?php if(!empty($getunits->uid)) echo $getunits->uid ==   $allunits->uid ? 'selected':''   ?>><?php echo $allunits->unit_no  ?></option>
<?php
}
	}
}
?>

</select></td><td><input name="price[]" value="<?php  if(isset($getunits->Price)){ echo round($getunits->Price,2) ; } ?>" class="form-control "   id="price0"></td><td><select name="extrabeds[]" class="form-control select extrabeds"  id="extrabeds"><option value="">Select </option><?php    for($i=1;$i<10;$i++){ ?><option value=<?php echo $i  ?> 
<?php if(!empty($getunits->ExtraBeds)) echo $getunits->ExtraBeds ==   $i ? 'selected':''   ?>

><?php echo $i  ?></option><?php }
?></select></td><td><input name="extra_price[]" value="<?php  if(isset($getunits->Extra_price)){ echo round($getunits->Extra_price,2) ; } ?>" class="form-control extra_price total_extra_traiff" id="extra_price0"></td></tr>

<?php
	 }
 }

?>



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
<option value="<?php echo lang('Booking_self');?>" <?php if(!empty($BookingDetails->GuestType)) echo $BookingDetails->GuestType ==    lang('Booking_self') ? 'selected':''   ?>><?php echo lang('Booking_self');?></option>
<option value="<?php echo lang('Booking_Others');?>" <?php if(!empty($BookingDetails->GuestType)) echo $BookingDetails->GuestType ==    lang('Booking_Others') ? 'selected':''   ?>><?php echo lang('Booking_Others');?></option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="guest_mode"><?php echo lang('Guest_Mode');?> *</label>
<select name="guest_mode" class="form-control" id="guest_mode"  tabindex="-1" title="guest mode" >
<option value="<?php echo lang('New_customer');?>" <?php if(!empty($BookingDetails->GuestType)) echo $BookingDetails->GuestType ==    lang('Booking_Others') ? 'selected':''   ?>><?php echo lang('New_customer');?></option>
<option value="<?php echo lang('Regular');?>" <?php if(!empty($BookingDetails->GuestMode)) echo $BookingDetails->GuestMode ==    lang('Regular') ? 'selected':''   ?>><?php echo lang('Regular');?></option>
</select>
</div>
</div>
<div class="col-md-4">

<div class="form-group all customer" style="<?php 
 if(isset($BookingDetails->GuestMode ))
 {  if($BookingDetails->GuestMode == lang('Regular_customer')){}
else{ echo 'display:none;' ;
 } }
 ?> "
 >
<label for="regular_customer"><?php echo lang('Regular_customer');?></label>
<select name="customer_id" class="form-control select customer_id" id="customer_id" placeholder="Select Customer" style="width: 100%;" tabindex="-1" title="">
<?php 
 if(isset($Guestlists)){
	 foreach($Guestlists as $Guestlist){
?>
<option value="<?php  echo  $Guestlist->id ?>"
<?php if(!empty($BookingDetails->Guest_id)) echo $BookingDetails->Guest_id ==    $Guestlist->id ? 'selected':''   ?>
><?php  echo $Guestlist->firstname  ?></option>
<?php
	 }
 }
?>
</select>
</div>
</div>

<div class="clearfix"></div>
<div class="col-md-4">
<div class="form-group all">
<label for="first_name"><?php echo lang('firstname');?> *</label>
<input name="first_name" value="<?php if(!empty($Guest->firstname)){ echo $Guest->firstname ; }  ?>" class="form-control " id="first_name" >
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="last_name"><?php echo lang('lastname');?> *</label>
<input name="last_name" value="<?php if(!empty($Guest->lastname)){ echo $Guest->lastname ; }  ?>" class="form-control " id="last_name" >
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="email_address"><?php echo lang('email');?>*</label>
<input name="email_address" value="<?php if(!empty($Guest->email)){ echo $Guest->email ; }  ?>" type="email" class="form-control " id="email_address" >
</div>
</div>
<div class="clearfix"></div>
<div class="col-md-4">
<div class="form-group all">
<label for="phone_number"><?php echo lang('Phone');?> *</label>
<input name="phone_number" value="<?php if(!empty($Guest->mobile)){ echo $Guest->mobile ; }  ?>" class="form-control" maxlength="10" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" id="phone_number" >
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="address"><?php echo lang('address');?> *</label>
<input name="address" value="<?php if(!empty($Guest->address)){ echo $Guest->address ; }  ?>" class="form-control " id="address" >
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


</fieldset>
<div class="clearfix"></div>
<fieldset>
<legend><?php echo lang('Persons_details');?></legend>
<div class="table-responsive">
<table id="adults" class="table table-bordered ">
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

<?php  
if(isset($Persons)){
	foreach($Persons  as $Get_Person){

?>



<tr id="number_adult"><td><input name="adultids[]" value="<?php if(isset($Get_Person->id)){ echo $Get_Person->id ;  }  ?>" type="hidden"><input name="adult_name[]" value="<?php if(isset($Get_Person->First_name)){ echo $Get_Person->First_name ;  }  ?>" class="form-control tip"  id="adult_name0"></td><td><input name="adult_age[]" value="<?php if(isset($Get_Person->Age)){ echo $Get_Person->Age ;  }  ?>" class="form-control tip" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"  maxlength="2" minlength="1" id="adult_age0"></td><td><input name="adult_birth[]" value="<?php if(isset($Get_Person->DOB)){ echo $Get_Person->DOB ;  }  ?>" class="form-control  dobdatepicker" id="check_in_date" placeholder="YYYY-MM-DD"  type="date"></td><td>
<select name="adult_gender[]" class="form-control" id="adult_gender0">
<option value="<?php echo lang('male');?>" <?php if(!empty($Get_Person->Gender)) echo $Get_Person->Gender ==    lang('male') ? 'selected':''   ?>><?php echo lang('male');?></option><option value="<?php echo lang('female');?>"  <?php if(!empty($Get_Person->Gender)) echo $Get_Person->Gender ==    lang('female') ? 'selected':''   ?>><?php echo lang('female');?></option><option value="<?php echo lang('Others');?>" <?php if(!empty($Get_Person->Gender)) echo $Get_Person->Gender ==    lang('Others') ? 'selected':''   ?>><?php echo lang('Others');?></option>

</select></td><td><select name="adult_id_proof[]" class="form-control" id="adult_id_proof0"><option value="<?php echo lang('passbook');?>"  <?php if(!empty($Get_Person->Idproof)) echo $Get_Person->Idproof ==    lang('passbook') ? 'selected':''   ?>><?php echo lang('passbook');?></option><option value="<?php echo lang('Others');?>"  <?php if(!empty($Get_Person->Idproof)) echo $Get_Person->Idproof ==  lang('Others') ? 'selected':''   ?>><?php echo lang('Others');?></option></select></td><td><input name="adult_id_number[]" value="<?php if(isset($Get_Person->Idnumber)){ echo $Get_Person->Idnumber ;  }  ?>" class="form-control tip" maxlength="15" minlength="7" id="adult_id_number0"></td></tr>

<?php 

	}
}

?>

</tbody>
</table>
</div>
</fieldset>
<div class="clearfix"></div>
<div class="clearfix"></div>

<fieldset class="vehicle_main">
<legend><?php echo lang('Vechile_details');?></legend>
<div class="vehicle_details">

<?php  
if(isset($Vechiles)){
	foreach($Vechiles  as $Vechilelist){
		
?>

<div class="col-xs-12 vehicle" id="arrival">
<div class="col-md-3">
<div class="form-group all">			
				<label for="vehicle_date">Slot No</label>		
<input name="vechileid[]" value="<?php if(isset($Vechilelist->id)){ echo $Vechilelist->id ;  }  ?>" type="hidden">				<select name="Slotno[]" class="form-control" id="Slotno" tabindex="-1" title=""><option>Select</option>	
<?php
 if(isset($Vechilelist->Slot_No))	{ echo '<option value="'.$Vechilelist->Slot_id.'" selected>'.$Vechilelist->Slot_No.'</option>' ; } 												
if(isset($Slot)){										
foreach($Slot as $Slots){							
	?>												
	<option value="<?php echo $Slots->id ; ?>"><?php echo $Slots->Slot_No ;  ?></option>
<?php   
}
}
?></select>	
</div>
</div>
<div class="col-md-3">
<div class="form-group all">
<label for="location"><?php  echo lang('Vechile_no'); ?></label>             <input name="vechileno[]" value="<?php if(!empty($Vechilelist->Vechilenumber)){ echo $Vechilelist->Vechilenumber ; }  ?>" class="form-control "></div>										</div>
<div class="col-md-2">
<div class="form-group all row">
<label for="vehicle_date" class="col-md-12"><?php  echo lang('arrival'); ?></label>  
<div class="col-md-6">
<select name="vehicle_hour_arrival[]" class="form-control" id="vehicle_hour_arrival" tabindex="-1" title="">
<option value="">hour</option>
<?php   
for($i=1;$i<24;$i++){
?>
<option value=<?php echo $i  ?> <?php if(!empty($Vechilelist->arrival)) echo date('H', strtotime($Vechilelist->arrival)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
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
<option value=<?php echo $i  ?> <?php if(!empty($Vechilelist->arrival)) echo date('i', strtotime($Vechilelist->arrival)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>         <?php										                           }
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
<option value=<?php echo $i  ?> <?php if(!empty($Vechilelist->departure)) echo date('H', strtotime($Vechilelist->departure)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
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
<option value=<?php echo $i  ?> <?php if(!empty($Vechilelist->departure)) echo date('i', strtotime($Vechilelist->departure)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
<?php
}
?></select>
</div>
</div>
</div>
<div class="col-md-2">
<label for="vehicle_date" class="col-md-12">&nbsp;</label> 
<!--<i class="fa fa-plus"></i>-->
</div>
</div>
</div>
<?php
	}
}
?>
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
<?php
  if(isset($Payment)){
	  foreach($Payment as $Pay){
?>


<div class="col-sm-12">
<div class="form-group">									<label for="paid_by_1"><?php  echo lang('Payingby'); ?></label>
<input name="payid[]" type="hidden" value="<?php if(!empty($Pay->id)){ echo round($Pay->id) ; }  ?>">


<select name="paid_by[]" id="paid_by_1" class="form-control paid_by" title="Paying by"  tabindex="-1">
	<option value="<?php  echo lang('cash'); ?>"  <?php if(!empty($Pay->Payingby)) echo $Pay->Payingby ==  lang('cash') ? 'selected':''   ?>><?php  echo lang('cash'); ?></option>
	<option value="<?php  echo lang('card'); ?>"  <?php if(!empty($Pay->Payingby)) echo $Pay->Payingby ==  lang('card') ? 'selected':''   ?>><?php  echo lang('card'); ?></option>				
	<option value="<?php  echo lang('Others'); ?>"  <?php if(!empty($Pay->Payingby)) echo $Pay->Payingby ==  lang('Others') ? 'selected':''   ?>><?php  echo lang('Others'); ?></option>											</select>
</div>
</div>
<div class="main_detail">
<div class="col-sm-6">
<div class="form-group" style="margin-bottom: 5px;">
<label><?php  echo lang('amount'); ?></label>
<input name="amount[]" type="text" id="amount_1" data-currency="currency_id_1" maxlength="10" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="pa form-control  amount" autocomplete="off"  value="<?php if(!empty($Pay->Amount)){ echo round($Pay->Amount,2) ; }  ?>">
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
<div class="col-sm-12  <?php
if(!empty($Pay->Payingby== lang('cash') ||$Pay->Payingby== lang('Others')))
{
	echo 'paymentblock';
}
?>">
<div class="form-group gc_1" style="display:none ;">

<div id="gc_details_1"></div>
</div>
<?php
if(!empty($Pay->Payingby== lang('cash')))
{
?>


<div class="pcc_1" style="display: block;">

<div class="row">
<div class="col-md-6">
	<div class="form-group">
		<input name="cc_no[]" type="text" id="pcc_no_1" maxlength="18" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Credit Card No" value="<?php if(!empty($Pay->Card_number)){ echo ($Pay->Card_number) ; }  ?>">
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<input name="cc_holer[]" type="text" id="pcc_holder_1" class="form-control" placeholder="Holder Name" value="<?php if(!empty($Pay->Holdername)){ echo ($Pay->Holdername) ; }  ?>">
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
		<select name="cc_type[]" id="pcc_type_1" class="form-control pcc_type" placeholder="Card Type" title="" tabindex="-1">
			<option value="<?php  echo lang('Visa'); ?> "<?php if(!empty($Pay->Cardtype)) echo $Pay->Cardtype ==  lang('Visa') ? 'selected':''   ?>><?php  echo lang('Visa'); ?> </option>
			<option value="<?php  echo lang('Mastercard'); ?>"<?php if(!empty($Pay->Cardtype)) echo $Pay->Cardtype ==  lang('Mastercard') ? 'selected':''   ?>><?php  echo lang('Mastercard'); ?> </option>
			<option value="<?php  echo lang('Amex'); ?>"<?php if(!empty($Pay->Cardtype)) echo $Pay->Cardtype ==  lang('Amex') ? 'selected':''   ?>><?php  echo lang('Amex'); ?> </option>
			<option value="<?php  echo lang('Discover'); ?>"<?php if(!empty($Pay->Cardtype)) echo $Pay->Cardtype ==  lang('Discover') ? 'selected':''   ?>><?php  echo lang('Discover'); ?> </option>
		</select>
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
		<input name="cc_month[]" type="text" id="pcc_month_1" maxlength="2" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Month" value="<?php if(!empty($Pay->Month)){ echo ($Pay->Month) ; }  ?>">
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
		<input name="cc_year[]" type="text" id="pcc_year_1" maxlength="4" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Year" value="<?php if(!empty($Pay->Year)){ echo ($Pay->Year) ; }  ?>">
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
		<input name="cc_cvv2[]" type="text" id="pcc_cvv2_1" maxlength="3" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Security Code" value="<?php if(!empty($Pay->cvv)){ echo ($Pay->cvv) ; }  ?>">
	</div>
</div>
</div>
</div>
<?php
	  }
?>
<div class="pcheque_1" style="display:none;">
<div class="form-group"><label for="cheque_no_1"><?php  echo lang('Cheque'); ?> </label>                                            <input name="cheque_no[]" type="text" id="cheque_no_1" class="form-control cheque_no">
</div>
</div>
</div>
</div>
</div>

<?php
	  }
  }

?>
</div>
</div>
</div>

<div style="clear:both; height:15px;"></div>
<div class="table_sec1">
<table class="table table-bordered" style="margin-bottom: 0;">
<tbody>
<tr>
<td>
<?php  echo lang('Total_payable'); ?>

</td>
<td class="text-right">
<input type="text" name="totalpayable" value="<?php if(!empty($BookingDetails->TotalPayable)) echo round($BookingDetails->TotalPayable,2) ;  ?>" class="form-control totalpayable">

<td>
<?php  echo lang('Advance_traiff'); ?> 
</td>
<td class="text-right">
<input type="text" name="advancetraiff" value="<?php if(!empty($BookingDetails->Advance_traiff)) echo round($BookingDetails->Advance_traiff,3) ;  ?>" class="form-control advancetraiff">

</td>
</tr>
<tr>
<td><?php  echo lang('Total_paying'); ?></td>
<td class="text-right"><span id="total_paying1">$<?php if(!empty($BookingDetails->Totalpaying)) echo round($BookingDetails->Totalpaying,3) ;  ?><input type="hidden" name="total_paying" class="total_paying" value="<?php if(!empty($BookingDetails->Totalpaying)) echo round($BookingDetails->Totalpaying,3) ;  ?>"></span></td>
<td><?php  echo lang('Balance'); ?></td>
<td class="text-right"><span id="balance_BASE1">$<?php if(!empty($BookingDetails->Balance)) echo round($BookingDetails->Balance,3) ;  ?>
<input type="hidden" name="balance" class="balance_BASE" value="<?php if(!empty($BookingDetails->Balance)) echo round($BookingDetails->Balance,3) ;  ?>"></span>
</td></tr>
</tbody>
</table>
<div class="clearfix"></div>
<br>
<div class="col-md-12">
<div class="form-group">

</div>
</div>                   
</form>                                
</div>
</div>
</div>
</section>
<!--  hbjdbf-->
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
var rows='<tr><td><select name="unittype[]" class="form-control select unittype"  id="unittype"><option value="">Select </option><?php if(isset($unittype)){ foreach($unittype as $unittypes){ ?><option value=<?php echo $unittypes->id  ?>><?php echo $unittypes->UnitType  ?></option><?php } } ?></select></td><td><select name="unit_id[]" class="form-control select Unit_id"  id="unit_id"><option value="00" >select </option></select></td><td><input name="price[]" value="" class="form-control  unitprice"   id="price0"></td><td><select name="extrabeds[]" class="form-control select extrabeds"  id="extrabeds"><option value="">Select </option><?php    for($i=1;$i<10;$i++){ ?><option value=<?php echo $i  ?>><?php echo $i  ?></option><?php }
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
if(val =='regular'){
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
var fieldHTML = '<div class="col-sm-12"><div class="form-group"><label for="paid_by_1">Paying by</label><select name="paid_by[]" id="paid_by_1" class="form-control paid_by" title="Paying by"  tabindex="-1"><option value="cash">Cash</option><option value="Credit Card">Credit Card</option><option value="other">Other</option></select></div></div><div class="main_detail"><div class="col-sm-6"><div class="form-group" style="margin-bottom: 5px;"><label>Amount</label><input name="amount[]" type="text" id="amount_1" data-currency="currency_id_1" maxlength="10" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="pa form-control  amount" autocomplete="off"></div></div><div class="col-sm-6"><div class="form-group" style="margin-bottom: 5px;"><label>Currency Type</label><select name="currency_id[]" id="currency_id_1" class="form-control currency" title="" tabindex="-1"><option value="1,USD,1.000000" selected=""> US Dollar</option><option value="2,KHR,0.000250"> Combodia</option></select></div></div></div></div><div class="row"><div class="col-sm-12 paymentblock" style="display:none;"><div class="form-group gc_1" style="display: none;"><label for="gift_card_no_1">Gift Card No</label><input name="paying_gift_card_no[]" type="text" id="gift_card_no_1" class="pa form-control kb-pad gift_card_no"><div id="gc_details_1"></div></div><div class="pcc_1" style="display: block;"><div class="row"><div class="col-md-6"><div class="form-group"><input name="cc_no[]" type="text" id="pcc_no_1" maxlength="18" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Credit Card No"></div></div><div class="col-md-6"><div class="form-group"><input name="cc_holer[]" type="text" id="pcc_holder_1" class="form-control" placeholder="Holder Name"></div></div><div class="col-md-3"><div class="form-group"><select name="cc_type[]" id="pcc_type_1" class="form-control pcc_type" placeholder="Card Type" title="" tabindex="-1"><option value="Visa">Visa</option><option value="MasterCard">MasterCard</option><option value="Amex">Amex</option><option value="Discover">Discover</option></select></div></div><div class="col-md-3"><div class="form-group"><input name="cc_month[]" type="text" id="pcc_month_1" maxlength="2" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Month"></div></div><div class="col-md-3"><div class="form-group"><input name="cc_year[]" type="text" id="pcc_year_1" maxlength="4" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Year"></div></div><div class="col-md-3"><div class="form-group"><input name="cc_cvv2[]" type="text" id="pcc_cvv2_1" maxlength="3" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Security Code"></div></div></div></div><div class="pcheque_1" style="display:none;"><div class="form-group"><label for="cheque_no_1">Cheque No</label><input name="cheque_no[]" type="text" id="cheque_no_1" class="form-control cheque_no"></div></div></div></div></div>';
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
$('.print-button').on('click', function() {  
  window.print();  
  return false; // why false?
});
</script>



