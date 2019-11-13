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
.dashboard_sec .table-responsive table tbody tr td{background-color: transparent!important;  border-color:transparent!important;border-top: 1px solid transparent!important;    color: #666666!important;font-size: 16px;font-weight: normal;}
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
.dashboard_sec .form-control{border-radius: 5px!important;}
.dashboard_sec .form-control .select2-choice{border-radius: 5px!important;}
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
</style>
<section class="content-header">
<h1>
<?php echo $page_title; ?>
<small><?php echo lang('edit'); ?></small>
</h1>

</section>
<br>
<section class="content" style="padding:50px;background-color: #ffff;">
<div class="row">
<div class="dashboard_sec">
<div class="row">
<form action="<?php echo site_url('admin/Office/Leaseuniteditsave/'.$id); ?>" role="form" id="leaseunitBooking_form" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
<div class="clearfix"></div>
<fieldset>
<legend><?php echo lang('Booking_details');?></legend>
<div class="col-md-4">
<div class="form-group">
<label for="leaseBooking_mode"><?php echo lang('Booking_mode');?></label>                                        
<select name="leaseBooking_mode" class="form-control" id="Booking_mode"  tabindex="-1" title="Booking type" required>
<option value="walk_in" <?php if(!empty($BookedDetails->reservation_type)) echo $BookedDetails->reservation_type ==    lang('walk_in') ? 'selected':''   ?>><?php echo lang('walk_in');?></option>
<option value="phone_booking" <?php if(!empty($BookedDetails->reservation_type)) echo $BookedDetails->reservation_type ==    lang('phone_booking') ? 'selected':''   ?>><?php echo lang('phone_booking');?></option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="leaseBooking_type"><?php echo lang('Booking_Type');?></label>                                        
<select name="leaseBooking_type" class="form-control" id="Booking_type"  tabindex="-1" title="Booking type" required>
<option value="<?php echo lang('Reservation');?>"<?php if(!empty($BookedDetails->reservation_type)) echo $BookedDetails->reservation_type ==    lang('Reservation') ? 'selected':''   ?> ><?php echo lang('Reservation');?></option>
<option value="<?php echo lang('Confirmed');?>"<?php if(!empty($BookedDetails->reservation_type)) echo $BookedDetails->reservation_type ==    lang('Confirmed') ? 'selected':''   ?>><?php echo lang('Confirmed');?></option>
<option value="<?php echo lang('Check_in');?>"<?php if(!empty($BookedDetails->reservation_type)) echo $BookedDetails->reservation_type ==    lang('Check_in') ? 'selected':''   ?>><?php echo lang('Check_in');?></option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="Leasetype"><span class="errorStar">*</span><?php echo lang('LeaseType')?>:</label>
<select class="form-control "     name="Leasetype">
<option>Select </option>
<option value="<?php echo lang('short_term')?>" <?php if(!empty($BookedDetails->Leasetype)) echo $BookedDetails->Leasetype == lang('short_term') ?'selected':''  ?>><?php echo lang('short_term')?></option>
<option value="<?php echo lang('Long_term')?>" <?php if(!empty($BookedDetails->Leasetype)) echo $BookedDetails->Leasetype == lang('Long_term') ?'selected':''  ?>><?php echo lang('Long_term')?></option>
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
<input name="Leasecheck_in_date" value="<?php if(!empty($BookedDetails->check_in)){ echo date('Y-m-d', strtotime($BookedDetails->check_in)) ; }  ?>" class="form-control  datepicker" id="check_in_date" placeholder="YYYY-MM-DD" required >
</div>
<div class="col-md-3">
<select name="Leasecheck_in_hour" class="form-control" id="check_in_hour" tabindex="-1" title="">
<option value="0">00</option>
<?php   
for($i=1;$i<24;$i++)
{
?>
<option value=<?php echo $i  ?> <?php if(!empty($BookedDetails->check_in)) echo date('H', strtotime($BookedDetails->check_in)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
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
<option value=<?php echo $i  ?> <?php if(!empty($BookedDetails->check_in)) echo date('i', strtotime($BookedDetails->check_in)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
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
<input name="leasecheck_out_date" value="<?php if(!empty($BookedDetails->check_out)){ echo date('Y-m-d', strtotime($BookedDetails->check_out)) ; }  ?>" class="form-control  datepicker" id="checkoutDate" placeholder="YYYY-MM-DD" required>
</div>
<div class="col-md-3">
<select name="leasecheck_out_hour" class="form-control" id="check_out_hour" tabindex="-1" title="">
<option value="0" selected="selected">00</option>
<?php   
for($i=1;$i<24;$i++){
?>
<option value=<?php echo $i  ?> <?php if(!empty($BookedDetails->check_out)) echo date('H', strtotime($BookedDetails->check_out)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
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
<option value=<?php echo $i  ?> <?php if(!empty($BookedDetails->check_out)) echo date('i', strtotime($BookedDetails->check_out)) ==  $i ? 'selected':''   ?>><?php echo $i  ?></option>
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

<select name="leasegrace_time" class="form-control" id="grace_time" tabindex="-1" title="grace time" >
<option value="00:00" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '00:00:00' ? 'selected':''   ?>>00:00</option>
<option value="00:15" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '00:15:00' ? 'selected':''   ?>>00:15</option>
<option value="00:30" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '00:30:00' ? 'selected':''   ?>>00:30</option>
<option value="00:45" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '00:45:00' ? 'selected':''   ?>>00:45</option>
<option value="01:00" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '01:00:00' ? 'selected':''   ?>>01:00</option>
<option value="01:15" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '01:15:00' ? 'selected':''   ?>>01:15</option>
<option value="01:30" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '01:30:00' ? 'selected':''   ?>>01:30</option>
<option value="01:45" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '01:45:00' ? 'selected':''   ?>>01:45</option>
<option value="02:00" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '02:00:00' ? 'selected':''   ?>>02:00</option>
<option value="02:15" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '02:15:00' ? 'selected':''   ?>>02:15</option>
<option value="02:30" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '02:30:00' ? 'selected':''   ?>>02:30</option>
<option value="02:45" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '02:45:00' ? 'selected':''   ?>>02:45</option>
<option value="03:00" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '03:00:00' ? 'selected':''   ?>>03:00</option>
<option value="03:15" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '03:15:00' ? 'selected':''   ?>>03:15</option>
<option value="03:30" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '03:30:00' ? 'selected':''   ?>>03:30</option>
<option value="03:45" <?php if(!empty($BookedDetails->grace_time)) echo $BookedDetails->grace_time == '03:45:00' ? 'selected':''   ?>>03:45</option>
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
<option value="<?php echo $item->uid ?>"<?php if(!empty($BookedDetails->Unit_id)) echo $BookedDetails->Unit_id == $item->uid ?'selected':''  ?> ><?php echo $item->unit_no ?></option>
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
<option value="<?php echo lang('conform');?>"<?php if(!empty($BookedDetails->reservation_status)) echo $BookedDetails->reservation_status ==    lang('conform') ? 'selected':''   ?>><?php echo lang('conform');?></option>
<option value="<?php echo lang('Pending');?>"<?php if(!empty($BookedDetails->reservation_status)) echo $BookedDetails->reservation_status ==    lang('Pending') ? 'selected':''   ?>><?php echo lang('Pending');?></option>
<option value="<?php echo lang('Cancel');?>"<?php if(!empty($BookedDetails->reservation_status)) echo $BookedDetails->reservation_status ==    lang('Cancel') ? 'selected':''   ?>><?php echo lang('Cancel');?></option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="Booking_reason"><?php echo lang('Booking_reason');?></label>
<input name="leaseBooking_reason" value="<?php if(!empty($BookedDetails->reservation_reason)) echo $BookedDetails->reservation_reason ;  ?>" class="form-control " id="Booking_reason" >
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="Leaseamount"><?php echo lang('LeaseAmount');?></label>
<input name="Leaseamount" value="<?php if(!empty($BookedDetails->LeaseAmount)) echo round($BookedDetails->LeaseAmount,2) ;  ?>" class="form-control Prices" id="Leaseamount" required>
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="extraamount"><?php echo lang('ExtraAmount');?></label>
<input name="extraamount" value="<?php if(!empty($BookedDetails->LeaseAmount)) echo round($BookedDetails->ExtraPrice,2) ;  ?>" class="form-control extraPrices" id="Extraamount" required>
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
<option value="<?php echo lang('Booking_self');?>" <?php if(!empty($BookedDetails->GuestType)) echo $BookedDetails->GuestType ==    lang('Booking_self') ? 'selected':''   ?>><?php echo lang('Booking_self');?></option>
<option value="<?php echo lang('Booking_Others');?>" <?php if(!empty($BookedDetails->GuestType)) echo $BookedDetails->GuestType ==    lang('Booking_Others') ? 'selected':''   ?>><?php echo lang('Booking_Others');?></option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="guest_mode"><?php echo lang('OwnerMode');?> *</label>
<select name="OwnerMOde" class="form-control" id="guest_mode"  tabindex="-1" title="guest mode" required>
<option value="<?php echo lang('New_customer');?>" <?php if(!empty($BookedDetails->GuestType)) echo $BookedDetails->GuestType ==    lang('Booking_Others') ? 'selected':''   ?>><?php echo lang('New_customer');?></option>
<option value="<?php echo lang('Regular');?>" <?php if(!empty($BookedDetails->GuestMode)) echo $BookedDetails->GuestMode ==    lang('Regular') ? 'selected':''   ?>><?php echo lang('Regular');?></option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group all customer" <?php 
if(isset($BookedDetails->GuestMode ))
{  if($BookedDetails->GuestMode == lang('Regular_customer')){}
else{ echo 'display:none;' ;
} }
?> ">
<label for="regular_Owner"><?php echo lang('Regular_Owner');?></label>

<select class="form-control  LeaseOwner"     name="LeaseOwner" required>
<option>Select </option>
<?php
foreach($leaseowner as $item){ 
?>
<option value="<?php echo $item->id ?>"<?php if(!empty($BookedDetails->Owner_id)) echo $BookedDetails->Owner_id == $item->id ?'selected':''  ?> ><?php echo $item->firstname ?></option>
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
<input name="ownerfirst_name" value="<?php if(!empty($BookedDetails->firstname)){ echo $BookedDetails->firstname ; }  ?>" class="form-control " id="first_names" >
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="last_name"><?php echo lang('lastname');?> *</label>
<input name="Ownerlast_name" value="<?php if(!empty($BookedDetails->lastname)){ echo $BookedDetails->lastname ; }  ?>" class="form-control " id="last_names" >
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="email_address"><?php echo lang('email');?>*</label>
<input name="Owneremail_address" value="<?php if(!empty($BookedDetails->email)){ echo $BookedDetails->email ; }  ?>" type="email" class="form-control " id="email_address_s" >
</div>
</div>
<div class="clearfix"></div>
<div class="col-md-4">
<div class="form-group all">
<label for="phone_number"><?php echo lang('Phone');?> *</label>
<input name="Ownerphone_number" value="<?php if(!empty($BookedDetails->mobile)){ echo $BookedDetails->mobile ; }  ?>" class="form-control" maxlength="10" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" id="phone_numbers" >
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="address"><?php echo lang('address');?> *</label>
<input name="Owneraddress" value="<?php if(!empty($BookedDetails->address)){ echo $BookedDetails->address ; }  ?>" class="form-control " id="address_s" >
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
<option value="<?php echo $countrys->id  ?>" <?php if(!empty($BookedDetails->country_id)) echo $BookedDetails->country_id ==   $countrys->id   ? 'selected':''   ?>><?php echo $countrys->name  ?></option>
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
<?php if(!empty($BookedDetails->id_type)) echo $BookedDetails->id_type ==    lang('passbook') ? 'selected':''   ?>><?php echo  lang('passbook');  ?></option>
<option value="<?php echo lang('Others');?>" <?php if(!empty($BookedDetails->id_type)) echo $BookedDetails->id_type ==    lang('Others') ? 'selected':''   ?>><?php echo lang('Others');?></option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group all">
<label for="id_number"><?php echo lang('Id_Number');?>*</label>
<input name="id_numbers" value="<?php if(!empty($BookedDetails->id_no)){ echo $BookedDetails->id_no ; }  ?>" class="form-control " id="id_numbers" maxlength="15" minlength="7" >
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
<input name="amount[]" type="text" id="amount_1" data-currency="currency_id_1" maxlength="10" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="pa form-control  amount payamounts" autocomplete="off"  value="<?php if(!empty($Pay->Amount)){ echo round($Pay->Amount,2) ; }  ?>">
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

<?php
}

}
?>
<div class="pcheque_1" style="display:none;">
<div class="form-group"><label for="cheque_no_1"><?php  echo lang('Cheque'); ?> </label>        
<input name="cheque_no[]" type="text" id="cheque_no_1" class="form-control cheque_no">
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
<input type="text" name="totalpayables" value="<?php if(!empty($BookedDetails->TotalPayable)){ echo round($BookedDetails->TotalPayable,2) ; }  ?>" class="form-control totalpayable totalpayingleaseowner">
<!--<span id="twt">$1.00</span></td>-->
<td>
<?php  echo lang('Advance_traiff'); ?> 
</td>
<td class="text-right">
<input type="text" name="advancetraiffs" value="<?php if(!empty($BookedDetails->Advance_traiff)){ echo round($BookedDetails->Advance_traiff,2) ; }  ?>" class="form-control advancetraiff">
<!--<span id="twt_BASE">$1.00</span>-->
</td>
</tr>
<tr>
<td><?php  echo lang('Total_paying'); ?></td>
<td class="text-right"><span class="leasetotalpaying">$<?php if(!empty($BookedDetails->Totalpaying)){ echo round($BookedDetails->Totalpaying,2) ; }  ?></span>
<input type="hidden" name="total_paying" value="<?php if(!empty($BookedDetails->Totalpaying)){ echo $BookedDetails->Totalpaying ; }  ?>"class="leasetotalpaying "></td>
<td><?php  echo lang('Balance'); ?></td>
<td class="text-right"><span class="leaseownerBalance">$<?php if(!empty($BookedDetails->Balance)){ echo round($BookedDetails->Balance,2) ; }  ?>
</span><input type="hidden" name="balance" class="leaseownerBalance" value="<?php if(!empty($BookedDetails->Balance)){ echo round($BookedDetails->Balance,2) ; }  ?>">
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
var fieldHTML = '<div class="col-sm-12"><div class="form-group"><label for="paid_by_1">Paying by</label><select name="paid_by[]" id="paid_by_1" class="form-control paid_by" title="Paying by"  tabindex="-1"><option value="cash">Cash</option><option value="Credit Card">Credit Card</option><option value="other">Other</option></select></div></div><div class="main_detail"><div class="col-sm-6"><div class="form-group" style="margin-bottom: 5px;"><label>Amount</label><input name="amount[]" type="text" id="amount_1" data-currency="currency_id_1" maxlength="10" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="pa form-control  amount payamounts" autocomplete="off"></div></div><div class="col-sm-6"><div class="form-group" style="margin-bottom: 5px;"><label>Currency Type</label><select name="currency_id[]" id="currency_id_1" class="form-control currency" title="" tabindex="-1"><option value="1" selected=""> US Dollar</option></select></div></div></div></div><div class="row"><div class="col-sm-12 paymentblock" style="display:none;"><div class="form-group gc_1" style="display: none;"><label for="gift_card_no_1">Gift Card No</label><input name="paying_gift_card_no[]" type="text" id="gift_card_no_1" class="pa form-control kb-pad gift_card_no"><div id="gc_details_1"></div></div><div class="pcc_1" style="display: block;"><div class="row"><div class="col-md-6"><div class="form-group"><input name="cc_no[]" type="text" id="pcc_no_1" maxlength="18" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Credit Card No"></div></div><div class="col-md-6"><div class="form-group"><input name="cc_holer[]" type="text" id="pcc_holder_1" class="form-control" placeholder="Holder Name"></div></div><div class="col-md-3"><div class="form-group"><select name="cc_type[]" id="pcc_type_1" class="form-control pcc_type" placeholder="Card Type" title="" tabindex="-1"><option value="Visa">Visa</option><option value="MasterCard">MasterCard</option><option value="Amex">Amex</option><option value="Discover">Discover</option></select></div></div><div class="col-md-3"><div class="form-group"><input name="cc_month[]" type="text" id="pcc_month_1" maxlength="2" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Month"></div></div><div class="col-md-3"><div class="form-group"><input name="cc_year[]" type="text" id="pcc_year_1" maxlength="4" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Year"></div></div><div class="col-md-3"><div class="form-group"><input name="cc_cvv2[]" type="text" id="pcc_cvv2_1" maxlength="3" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" class="form-control" placeholder="Security Code"></div></div></div></div><div class="pcheque_1" style="display:none;"><div class="form-group"><label for="cheque_no_1">Cheque No</label><input name="cheque_no[]" type="text" id="cheque_no_1" class="form-control cheque_no"></div></div></div></div></div>';
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

