 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js">
 </script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
.error{
    color: #FF0000;
}
.content-header .breadcrumb{ margin-bottom: 0px;background-color: transparent;}
	.content-header h3{margin: 0px;}
	fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
		border: 1px solid;
    }
	.table-bordered>thead>tr>th {background-color: #2c3542!important;}
	.terms_conditions_s{padding-left: 20px;}
	.terms_conditions_s li{line-height: 28px;}
	.form-control{border-radius: 0px;}
	.checkbox_group label:before {
	  content:'';
	  -webkit-appearance: none;
	  background-color: transparent;
	  border: 2px solid #0079bf;
	  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
	  padding: 8px;
	  display: inline-block;
	  position: relative;
	  vertical-align: middle;
	  cursor: pointer;
	  margin-right: 5px;
	}
	.checkbox_group input:checked + label:after {
		content: '';
		display: block;
		position: absolute;
		top: 5px;
		left: 7px;
		width: 6px;
		height: 12px;
		border: solid #0079bf;
		border-width: 0 2px 2px 0;
		transform: rotate(45deg);
	}
	.checkbox_group input {
    padding: 0;
    height: initial;
    width: initial;
    margin-bottom: 0;
    display: none;
    cursor: pointer;
}
	.checkbox_group label {
  position: relative;
  cursor: pointer;
}
/*	rating*/
.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}
.rating > .half:before { 
  content: "\f089";
  position: absolute;
}
.rating > label { 
  color: #ccc; 
 float: right; 
}
/***** CSS Magic to Highlight Stars on Hover *****/
.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #2c3542;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #2c3542;  } 
</style>
 <?php   $seg= $this->uri->segment(5);?>
 <?php /*?><section class="content-header">
     <h1>
         <?php echo lang('enquirs_form'); ?>
     </h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard')?></a></li>
         <li><a href="<?php echo site_url('admin/crm/Crm/Enquiry') ?>"> <?php echo lang('Enquiry')?> </a></li>
         <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
     </ol>
 </section><?php */?>
 <section class="content">
     <div class="row">
         <div class="col-xs-12">
             <div class="box">
                 <div class="box-header">
                     <h3 class="box-title">Enquiry Form</h3>
                 </div><!-- /.box-header -->
                 <div class="box-body">
					 <form method="post" action="" id="enquiryform">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">Form</legend>
					<div class="row">
               			<div class="form-group col-md-4 col-md-offset-8">
							<div class="form-group col-md-12">
								<label class="col-sm-4">Date</label>
								<div class="col-sm-8">
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="form-group col-md-12">
								<label class="col-sm-4">Serial No</label>
								<div class="col-sm-8">
									<input type="text" class="form-control">
								</div>
							</div>
							
						</div>
					</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label>Name</label>
                			<input type="text" class="form-control">
                		</div>
                		
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label>Contact No</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-5">
                			<label>Alternate No</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label>Address</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-5">
                			<label>Email</label>
                			<input type="email" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label>Profession</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-5">
                			<label>Organization Name</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label>Convenient time to call you</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-12" style="margin-bottom: 0px;">
                			<label>When do you plan to book the flat</label>
                		</div>
						<div class="form-group checkbox_group col-md-3">
							<input type="checkbox" id="withinaweek">
							<label for="withinaweek">Within a Week</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="within15days">
						  <label for="within15days">Within 15 Days</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="withinamonth">
						  <label for="withinamonth">Within a Month</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="within45days">
						  <label for="within45days">Within 45 Days</label>
						</div>
                	</div><hr>
                	<div class="row">
						<div class="form-group col-md-4">
							<label>FAMILY</label>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">Adult:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">Child:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label>VEHICLE</label>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">4 Wheeler:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">2 Wheeler:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label>BUILDING</label>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-4" style="padding-left: 0px;padding-right: 0px;">Preferred Wing:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control">
								</div>
							</div>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-4" style="padding-left: 0px;">Floor:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
                		<div class="form-group col-md-12" style="margin-bottom: 0px;">
                			<label>When do you plan to book the flat</label>
                		</div>
						<div class="form-group checkbox_group col-md-3">
							<input type="checkbox" id="hoarding">
							<label for="hoarding">Hoarding</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="pole_kosk">
						  <label for="pole_kosk">pole Kosk</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="paper_ads">
						  <label for="paper_ads">Paper Ads</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="tv_radio">
						  <label for="tv_radio">TV/Radio</label>
						</div>
               			<div class="form-group checkbox_group col-md-3">
							<input type="checkbox" id="portal">
							<label for="portal">Portal</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="pamphlet">
						  <label for="pamphlet">Pamphlet</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="areavisit">
						  <label for="areavisit">Area Visit</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="associate">
						  <label for="associate">Associate</label>
						</div>
               			<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="expo">
						  <label for="expo">Expo/BTL</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="sms_email">
						  <label for="sms_email">SMS/Email</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="others">
						  <label for="others">Others(if any)</label>
						</div>
						<div class="clearfix"></div>
               			<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="clientreference">
						  <label for="clientreference">Client Reference</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="mgtreference">
						  <label for="mgtreference">Mgt Reference</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="website">
						  <label for="website">Website</label>
						</div>
                	</div>
                	<hr>
                	<div class="row">
                		<div class="form-group col-md-8">
                			<label class="col-sm-3">Post Visit Remarks :</label>
                			<div class="col-sm-7">
                				<textarea rows="2" style="width: 100%"></textarea>
                			</div>
                		</div>
                		<div class="form-group col-md-8">
                			<label class="col-sm-3">Follow Up:</label>
                			<div class="col-sm-7">
                				<textarea rows="4" style="width: 100%"></textarea>
                			</div>
                		</div>
                		<div class="form-group col-md-4 col-md-offset-8">
                			<label class="col-sm-5">Attended by:</label>
                			<div class="col-sm-7">
                				<input type="text" class="form-control">
                			</div>
                		</div>
                	</div>
					</fieldset>
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Post Enquiry</legend>
						<div class="row">
							<div class="form-group col-md-5">
								<label>Status:</label>
								<select class="form-control">
									<option>Hot</option>
									<option>Warm</option>
									<option>Cold</option>
								</select>
							</div>
							<div class="form-group col-md-5">
								<label>Looking For:</label>
								<select class="form-control">
									<option>Flat</option>
									<option>Garden Flat</option>
									<option>4-BHK</option>
									<option>Shop</option>
									<option>Office</option>
									<option>O-1BHK</option>
									<option>0-3BHK</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-5">
								<label>Budget:</label>
								<select class="form-control">
									<option>Less 40</option>
									<option>40-50 </option>
									<option>50-60</option>
									<option>60-70</option>
									<option>70-80</option>
									<option>80-1Cr</option>
									<option>1-1.2Cr</option>
									<option>1.2-1.5Cr</option>
									<option>1.5-1.75Cr</option>
									<option>1.75 Cr+</option>
								</select>
							</div>
							<div class="form-group col-md-5">
								<label>Purpose:</label>
								<select class="form-control">
									<option>Investment</option>
									<option>Self</option>
									<option>Looking For Other</option>
									<option>Channel Partner</option>
									<option>Random Enquiry</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-5">
								<label>Breif Remark</label>
								<textarea rows="4" style="width: 100%;"></textarea>
							</div>
							<div class="form-group col-md-5">
								<label>Next Followup </label>
								<input type="text" class="form-control datepicker" placeholder="dd/mm/yyyy">
							</div>
						</div>
                	</fieldset>
                	<fieldset class="scheduler-border">
						<legend class="scheduler-border">Feedback Link </legend>
						<div class="form-group col-md-10">
							<label class="col-sm-8">1) How Whould You Rate The Waiting Time To Be Attended ? </label>
							<div class="rating col-sm-4">
								<input type="radio" id="star5" name="rating" value="5" />
								<label class = "full" for="star5" title="Awesome - 5 stars"></label>
								<input type="radio" id="star4half" name="rating" value="4 and a half" />
								<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
								<input type="radio" id="star4" name="rating" value="4" />
								<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
								<input type="radio" id="star3half" name="rating" value="3 and a half" />
								<label class="half" for="star3half" title="Meh - 3.5 stars"></label>
								<input type="radio" id="star3" name="rating" value="3" />
								<label class = "full" for="star3" title="Meh - 3 stars"></label>
								<input type="radio" id="star2half" name="rating" value="2 and a half" />
								<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
								<input type="radio" id="star2" name="rating" value="2" />
								<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
								<input type="radio" id="star1half" name="rating" value="1 and a half" />
								<label class="half" for="star1half" title="Meh - 1.5 stars"></label>
								<input type="radio" id="star1" name="rating" value="1" />
								<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
								<input type="radio" id="starhalf" name="rating" value="half" />
								<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
							</div>
						</div>
						<div class="form-group col-md-10">
							<label class="col-sm-8">2) How Whould You Rate Our Representative Communication ? </label>
							<div class="rating col-sm-4">
								<input type="radio" id="1star5" name="rating" value="5" />
								<label class ="full" for="1star5" title="Awesome - 5 stars"></label>
								<input type="radio" id="1star4half" name="rating" value="4 and a half" />
								<label class="half" for="1star4half" title="Pretty good - 4.5 stars"></label>
								<input type="radio" id="1star4" name="rating" value="4" />
								<label class ="full" for="1star4" title="Pretty good - 4 stars"></label>
								<input type="radio" id="1star3half" name="rating" value="3 and a half" />
								<label class="half" for="1star3half" title="Meh - 3.5 stars"></label>
								<input type="radio" id="1star3" name="rating" value="3" />
								<label class ="full" for="1star3" title="Meh - 3 stars"></label>
								<input type="radio" id="1star2half" name="rating" value="2 and a half" />
								<label class="half" for="1star2half" title="Kinda bad - 2.5 stars"></label>
								<input type="radio" id="1star2" name="rating" value="2" />
								<label class ="full" for="1star2" title="Kinda bad - 2 stars"></label>
								<input type="radio" id="1star1half" name="rating" value="1 and a half" />
								<label class="half" for="1star1half" title="Meh - 1.5 stars"></label>
								<input type="radio" id="1star1" name="rating" value="1" />
								<label class ="full" for="1star1" title="Sucks big time - 1 star"></label>
								<input type="radio" id="1starhalf" name="rating" value="half" />
								<label class="half" for="1starhalf" title="Sucks big time - 0.5 stars"></label>
							</div>
						</div>
						<div class="form-group col-md-10">
							<label class="col-sm-8">3) How Whould You Rate Our Overall Hospitality ? </label>
							<div class="rating col-sm-4">
								<input type="radio" id="2star5" name="rating" value="5" />
								<label class ="full" for="2star5" title="Awesome - 5 stars"></label>
								<input type="radio" id="2star4half" name="rating" value="4 and a half" />
								<label class="half" for="2star4half" title="Pretty good - 4.5 stars"></label>
								<input type="radio" id="2star4" name="rating" value="4" />
								<label class ="full" for="2star4" title="Pretty good - 4 stars"></label>
								<input type="radio" id="2star3half" name="rating" value="3 and a half" />
								<label class="half" for="2star3half" title="Meh - 3.5 stars"></label>
								<input type="radio" id="2star3" name="rating" value="3" />
								<label class ="full" for="2star3" title="Meh - 3 stars"></label>
								<input type="radio" id="2star2half" name="rating" value="2 and a half" />
								<label class="half" for="2star2half" title="Kinda bad - 2.5 stars"></label>
								<input type="radio" id="2star2" name="rating" value="2" />
								<label class ="full" for="2star2" title="Kinda bad - 2 stars"></label>
								<input type="radio" id="2star1half" name="rating" value="1 and a half" />
								<label class="half" for="2star1half" title="Meh - 1.5 stars"></label>
								<input type="radio" id="2star1" name="rating" value="1" />
								<label class ="full" for="2star1" title="Sucks big time - 1 star"></label>
								<input type="radio" id="2starhalf" name="rating" value="half" />
								<label class="half" for="2starhalf" title="Sucks big time - 0.5 stars"></label>
							</div>
						</div>
						<div class="form-group col-md-10">
							<label class="col-sm-8">4) How Whould You Rate Our Project Presentation ? </label>
							<div class="rating col-sm-4">
								<input type="radio" id="3star5" name="rating" value="5" />
								<label class ="full" for="3star5" title="Awesome - 5 stars"></label>
								<input type="radio" id="3star4half" name="rating" value="4 and a half" />
								<label class="half" for="3star4half" title="Pretty good - 4.5 stars"></label>
								<input type="radio" id="3star4" name="rating" value="4" />
								<label class ="full" for="3star4" title="Pretty good - 4 stars"></label>
								<input type="radio" id="3star3half" name="rating" value="3 and a half" />
								<label class="half" for="3star3half" title="Meh - 3.5 stars"></label>
								<input type="radio" id="3star3" name="rating" value="3" />
								<label class ="full" for="3star3" title="Meh - 3 stars"></label>
								<input type="radio" id="3star2half" name="rating" value="2 and a half" />
								<label class="half" for="3star2half" title="Kinda bad - 2.5 stars"></label>
								<input type="radio" id="3star2" name="rating" value="2" />
								<label class ="full" for="3star2" title="Kinda bad - 2 stars"></label>
								<input type="radio" id="3star1half" name="rating" value="1 and a half" />
								<label class="half" for="3star1half" title="Meh - 1.5 stars"></label>
								<input type="radio" id="3star1" name="rating" value="1" />
								<label class ="full" for="3star1" title="Sucks big time - 1 star"></label>
								<input type="radio" id="3starhalf" name="rating" value="half" />
								<label class="half" for="3starhalf" title="Sucks big time - 0.5 stars"></label>
							</div>
						</div>
						<div class="form-group col-md-10">
							<label class="col-sm-8">5) How Whould You Rate The Project Overall ?</label>
							<div class="rating col-sm-4">
								<input type="radio" id="4star5" name="rating" value="5" />
								<label class ="full" for="4star5" title="Awesome - 5 stars"></label>
								<input type="radio" id="4star4half" name="rating" value="4 and a half" />
								<label class="half" for="4star4half" title="Pretty good - 4.5 stars"></label>
								<input type="radio" id="4star4" name="rating" value="4" />
								<label class ="full" for="4star4" title="Pretty good - 4 stars"></label>
								<input type="radio" id="4star3half" name="rating" value="3 and a half" />
								<label class="half" for="4star3half" title="Meh - 3.5 stars"></label>
								<input type="radio" id="4star3" name="rating" value="3" />
								<label class ="full" for="4star3" title="Meh - 3 stars"></label>
								<input type="radio" id="4star2half" name="rating" value="2 and a half" />
								<label class="half" for="4star2half" title="Kinda bad - 2.5 stars"></label>
								<input type="radio" id="4star2" name="rating" value="2" />
								<label class ="full" for="4star2" title="Kinda bad - 2 stars"></label>
								<input type="radio" id="4star1half" name="rating" value="1 and a half" />
								<label class="half" for="4star1half" title="Meh - 1.5 stars"></label>
								<input type="radio" id="4star1" name="rating" value="1" />
								<label class ="full" for="4star1" title="Sucks big time - 1 star"></label>
								<input type="radio" id="4starhalf" name="rating" value="half" />
								<label class="half" for="4starhalf" title="Sucks big time - 0.5 stars"></label>
							</div>
						</div>
					</fieldset>
					 </form>
				</div><!-- /.box-body -->
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
$.validator.addMethod('customphone', function(value, element) {
    return this.optional(element) || /[0-9\-\(\)\s]+/.test(value);
}, "Please enter a valid phone number");
$.validator.addMethod('TextCheck', function(value, element) {
    return this.optional(element) || /[a-z]/.test(value);
}, "Must contain  letters");

$("#enquirybtn").click(function() {
    $("#enquiryform").validate({
        excluded: ':disabled',
        rules: {
            contactnumber: 'customphone',
            Customername: {
                required: true,

            },
            project: {
                required: true,

            },
            Enquiry_date: {
                required: true

            },
            sourceofenquiry: {
                required: true,


            },
            contactnumber: {
                required: true
            },

            country: {
                required: true
            },
        },
        messages: {
            dob: {
                required: "Please enter you date of birth.",
                minAge: "You are not old enough(18<)!"
            }
        },
        highlight: function(element) {
            $(element).closest('.validates').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.validates').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});
 </script>
 <script>
$('.datepicker').datepicker({
    weekStart: 1,
    autoclose: true,
    todayHighlight: true,
    format: "yyyy-mm-dd",
});
// $('.datepicker').datepicker("setDate", new Date());
 </script>
 <script type="text/javascript">
$(document).ready(function() {
    $('.my-select').multiselect();
});

 </script>
 <script>
$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".nationalid");
    var add_button = $(".nationidadd");
    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append(
                '<div><input type="text" name="NationalId[]" class="form-control "   autocomplete="off""/><a href="#" class="remove_field">Remove</a></div>'
            );
        }
    });
    $(wrapper).on("click", ".remove_field", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
 </script>

 <script>
$('form').attr('autocomplete', 'off');
 </script>