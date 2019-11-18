<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/select2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/select2.min.js"></script>
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
	
/*	radio*/
	.feed_back [type="radio"]:checked,
.feed_back [type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
.feed_back [type="radio"]:checked + label,
.feed_back [type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
}
.feed_back [type="radio"]:checked + label:before,
.feed_back [type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 18px;
    height: 18px;
    border: 2px solid #0079bf;
    border-radius: 100%;
    background: #fff;
}
.feed_back [type="radio"]:checked + label:after,
.feed_back [type="radio"]:not(:checked) + label:after {
    content: '';
    width: 12px;
    height: 12px;
    background: #0079bf;
    position: absolute;
    top: 3px;
    left: 3px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
.feed_back [type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
.feed_back [type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
</style>
 <?php   $seg= $this->uri->segment(5); ?>
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
					 <form method="post" action="<?php echo site_url('admin/crm/Crm/enquiry_form/'.$id); ?>" id="enquiryform">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">Form</legend>
					<div class="row">
               			<div class="form-group col-md-4 col-md-offset-8">
							<div class="form-group col-md-12">
								<label class="col-sm-4">Date</label>
								<div class="col-sm-8">
									<input type="text" class="form-control datepicker" name="date" value="<?php if(!empty($date)){ echo $date ; }else{ date_default_timezone_set('Asia/Kolkata'); echo  date('Y-m-d'); }										?>" onkeydown="return false" >
								</div>
							</div>
							<div class="form-group col-md-12">
								<label class="col-sm-4">Serial No</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="serial_no"  value="<?php if(isset($serial_no)){ echo $serial_no ; } ?>" readonly>
								</div>
							</div>
							
						</div>
					</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label>Name</label>
                			<input type="text" class="form-control"  name="name" value="<?php if(!empty($name)){ echo $name ; }   ?>">
                		</div>
                		
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label>Contact No</label>
                			<input type="text" class="form-control allownumber"  name="contact" value="<?php if(!empty($contact_no)){ echo $contact_no ; }   ?>">
                		</div>
                		<div class="form-group col-md-5">
                			<label>Alternate No</label>
                			<input type="text" class="form-control allownumber"  name="alternate" value="<?php if(!empty($alernate_no)){ echo $alernate_no ; }   ?>">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label>Address</label>
                			<input type="text" class="form-control" name="address" value="<?php if(!empty($address)){ echo $address ; }   ?>">
                		</div>
                		<div class="form-group col-md-5">
                			<label>Email</label>
                			<input type="email" class="form-control" name="email" value="<?php if(!empty($email)){ echo $email ; }   ?>">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label>Profession</label>
                			<input type="text" class="form-control"  name="profession" value="<?php if(!empty($profession)){ echo $profession ; }   ?>">
                		</div>
                		<div class="form-group col-md-5">
                			<label>Organization Name</label>
                			<input type="text" class="form-control"  name="organization" value="<?php if(!empty($organization)){ echo $organization ; }   ?>">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label>Convenient time to call you</label>
                			<input type="text" class="form-control"  name="convenienttime" value="<?php if(!empty($convenient)){ echo $convenient; }   ?>">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-12" style="margin-bottom: 0px;">
                			<label>When do you plan to book the flat</label>
                		</div>
						<div class="form-group checkbox_group col-md-3">
							<input type="checkbox" id="withinaweek" class="plan_to_book"  name="plan_to_book_flat" value="1" <?php  if(!empty($plan_to_book_flat)){ if($plan_to_book_flat==1){ echo "checked" ;  }}  ?>>
							<label for="withinaweek">Within a Week</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="within15days" class="plan_to_book" name="plan_to_book_flat" value="2" <?php  if(!empty($plan_to_book_flat)){ if($plan_to_book_flat==2){ echo "checked" ;  }}  ?>>
						  <label for="within15days">Within 15 Days</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="withinamonth" class="plan_to_book" name="plan_to_book_flat" value="3" <?php  if(!empty($plan_to_book_flat)){ if($plan_to_book_flat==3){ echo "checked" ;  }}  ?>>
						  <label for="withinamonth">Within a Month</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="within45days" class="plan_to_book" name="plan_to_book_flat" value="4" <?php  if(!empty($plan_to_book_flat)){ if($plan_to_book_flat==4){ echo "checked" ;  }}  ?>>
						  <label for="within45days">Within 45 Days</label>
						</div>
                	</div><hr>
                	<div class="row">
						<div class="form-group col-md-4">
							<label>FAMILY</label>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">Adult:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="adult" value="<?php if(!empty($adult)){ echo $adult ; }   ?>">
								</div>
							</div>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">Child:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control"  name="child" value="<?php if(!empty($child)){ echo $child ; }   ?>">
								</div>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label>VEHICLE</label>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">4 Wheeler:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="4wheeler" value="<?php if(!empty($four_wheeler)){ echo $four_wheeler ; }   ?>">
								</div>
							</div>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">2 Wheeler:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control"  name="2wheeler" value="<?php if(!empty($two_wheeler)){ echo $two_wheeler ; }   ?>">
								</div>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label>BUILDING</label>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-4" style="padding-left: 0px;padding-right: 0px;">Preferred Wing:</label>
								<div class="col-sm-7">
								   <select class="form-control" name="building_id" onchange="get_buildingfloors(this.value)">
                                                <option value="">Select Wing</option>
                                                    <?php  if(!empty($building)){ foreach($building as  $row) 
                                                        { ?>
													<option value="<?php   echo $row->bldid ; ?>"  <?php  if(isset($preferred_wing)){ echo $preferred_wing == $row->bldid ?'selected':'' ;  } ?>><?php echo $row->name ;  ?></option>
												<?php   }  }  ?>	
												</select>
								</div>
							</div>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-4" style="padding-left: 0px;">Floor:</label>
								<div class="col-sm-7">
									<select class="form-control" name="floor_id" id="floor" >
									<option value="">Select Floor</option>
                                                 <?php  if(!empty($floorlist)){ foreach($floorlist as  $row) { ?>
													<option value="<?php   echo $row->id ; ?>"  <?php  if(isset($floor)){ echo $floor == $row->id ?'selected':'' ;  } ?>><?php echo $row->name ;  ?></option>
												<?php   }  }  ?>	
                                            </select>
								</div>
							</div>
						</div>
							<div class="form-group col-md-4">
						<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">No Of People:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" name="no_of_people" value="<?php if(!empty($no_of_people)){ echo $no_of_people ; }   ?>">
								</div>
							</div>
					</div>
					</div>
					<hr>
					<div class="row">
                		<div class="form-group col-md-12" style="margin-bottom: 0px;">
                			<label>What brought to here</label>
                		</div>
						<div class="form-group checkbox_group col-md-3">
							<input type="checkbox" id="hoarding" class="brought_to_here" value="1" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==1){ echo "checked" ;  }}  ?>>
							<label for="hoarding">Hoarding</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="pole_kosk" value="2" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==2){ echo "checked" ;  }}  ?>>
						  <label for="pole_kosk">pole Kosk</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="paper_ads" value="3" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==3){ echo "checked" ;  }}  ?>>
						  <label for="paper_ads">Paper Ads</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="tv_radio" value="4" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==4){ echo "checked" ;  }}  ?>>
						  <label for="tv_radio">TV/Radio</label>
						</div>
               			<div class="form-group checkbox_group col-md-3">
							<input type="checkbox" id="portal" value="5" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==5){ echo "checked" ;  }}  ?>>
							<label for="portal">Portal</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="pamphlet" value="6" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==6){ echo "checked" ;  }}  ?>>
						  <label for="pamphlet">Pamphlet</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="areavisit" value="7" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==7){ echo "checked" ;  }}  ?>>
						  <label for="areavisit">Area Visit</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="associate" value="8" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==8){ echo "checked" ;  }}  ?>>
						  <label for="associate">Associate</label>
						</div>
               			<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="expo" value="9" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==9){ echo "checked" ;  }}  ?>>
						  <label for="expo">Expo/BTL</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="sms_email" value="10" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==10){ echo "checked" ;  }}  ?>>
						  <label for="sms_email">SMS/Email</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="others" value="11" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==11){ echo "checked" ;  }}  ?>>
						  <label for="others">Others(if any)</label>
						</div>
						<div class="clearfix"></div>
               			<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="clientreference" value="12" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==12){ echo "checked" ;  }}  ?>>
						  <label for="clientreference">Client Reference</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="mgtreference" value="13" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==13){ echo "checked" ;  }}  ?>>
						  <label for="mgtreference">Mgt Reference</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="website" value="14" class="brought_to_here" name="brought_to_here" <?php  if(!empty($brought_to_here)){ if($brought_to_here==14){ echo "checked" ;  }}  ?>>
						  <label for="website">Website</label>
						</div>
                	</div>
                	<hr>
                	<div class="row">
                		<div class="form-group col-md-8">
                			<label class="col-sm-3">Pre Sales Executive  :</label>
                			<div class="col-sm-7">
                					<input type="text" class="form-control" name="pre_sales_excutive" value="<?php if(!empty($pre_sales_excutive)){ echo $pre_sales_excutive ; }   ?>">
                			</div>
                		</div>
						<div class="form-group col-md-8">
                			<label class="col-sm-3">Lead Forwaded To :</label>
                			<div class="col-sm-7">
                			<select class="form-control select2" name="lead_forward_to" >
							<option value="">Select Attended</option>
                            <?php  if(!empty($employee)){ foreach($employee as  $row) 
                             { ?>
						     <option value="<?php   echo $row->id ; ?>"  <?php  if(isset($lead_forward_to)){ echo $lead_forward_to == $row->id ?'selected':'' ;  } ?>><?php echo $row->first_name ;  ?></option>
							   <?php   }  }  ?>	
							</select>
                			</div>
                		</div>
						<div class="form-group col-md-8">
                			<label class="col-sm-3">Post Visit Remarks :</label>
                			<div class="col-sm-7">
                				<textarea rows="2"  name="post_visit_remark" style="width: 100%"><?php if(!empty($post_visit_remark)){ echo $post_visit_remark ; }   ?></textarea>
                			</div>
                		</div>
                		<div class="form-group col-md-8">
                			<label class="col-sm-3">Follow Up:</label>
                			<div class="col-sm-7">
                				<textarea rows="4"   style="width: 100%"  name="followup"><?php if(!empty($followup)){ echo $followup ; }   ?></textarea>
                			</div>
                		</div>
                		<div class="form-group col-md-4 col-md-offset-8">
                			<label class="col-sm-5">Attended by:</label>
                			<div class="col-sm-7">
							 <select class="form-control select2" name="attended_by" >
							     <option value="">Select Attended</option>
                                                    <?php  if(!empty($employee)){ foreach($employee as  $row) 
                                                        { ?>
													<option value="<?php   echo $row->id ; ?>"  <?php  if(isset($attended_by)){ echo $attended_by == $row->id ?'selected':'' ;  } ?>><?php echo $row->first_name ;  ?></option>
												<?php   }  }  ?>	
												</select>
                				
                			</div>
                		</div>
                	</div>
					<?php  if(empty($seg)){ ?>
					   <div class="box-footer">
                     <input class="btn btn-primary" type="submit" id="enquirybtn" value="Save" />
                 </div>
					</fieldset>
					
					
					</form>
					<?php }else{      ?> 	</fieldset>  <?php   } ?>
					<?php  if($seg){ ?>
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Post Enquiry</legend>
						<div class="row">
							<div class="form-group col-md-5">
								<label>Status:</label>
								<select class="form-control" name="status">
								<option value="">Select </option>
									<option value="1"  <?php  if(isset($status)){ echo $status == 1 ?'selected':'' ;  } ?>>Hot</option>
									<option  value="2"  <?php  if(isset($status)){ echo $status == 2 ?'selected':'' ;  } ?>>Warm</option>
									<option value="3"  <?php  if(isset($status)){ echo $status == 3 ?'selected':'' ;  } ?>>Cold</option>
								</select>
							</div>
							<div class="form-group col-md-5">
						
								<label>Looking For:</label>
								<select class="form-control" name="looking_for">
									<option value="">Select</option>
									<?php   if(!empty($unit_type)){ foreach($unit_type as $row){  ?>
									<option  value="<?php echo $row->id  ?>"  <?php  if(isset($looking_for)){ echo $looking_for == $row->id ?'selected':'' ;  } ?>><?php  echo $row->UnitType;    ?>
									<?php   }  }   ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-5">
								<label>Budget:</label>
								<select class="form-control" name="budget">
									<option value="">Select</option>
									<option value="1"  <?php  if(isset($budget)){ echo $budget == 1 ?'selected':'' ;  } ?>>Less 40</option>
									<option value="2"  <?php  if(isset($budget)){ echo $budget == 2 ?'selected':'' ;  } ?>>40-50 </option>
									<option value="3"  <?php  if(isset($budget)){ echo $budget == 3 ?'selected':'' ;  } ?>>50-60</option>
									<option value="4"  <?php  if(isset($budget)){ echo $budget == 4 ?'selected':'' ;  } ?>>60-70</option>
									<option value="5"  <?php  if(isset($budget)){ echo $budget == 5 ?'selected':'' ;  } ?>>70-80</option>
									<option value="6"  <?php  if(isset($budget)){ echo $budget == 6 ?'selected':'' ;  } ?>>80-1Cr</option>
									<option value="7"  <?php  if(isset($budget)){ echo $budget == 7 ?'selected':'' ;  } ?>>1-1.2Cr</option>
									<option value="8"  <?php  if(isset($budget)){ echo $budget == 8 ?'selected':'' ;  } ?>>1.2-1.5Cr</option>
									<option value="9"  <?php  if(isset($budget)){ echo $budget == 9 ?'selected':'' ;  } ?>>1.5-1.75Cr</option>
									<option value="10"  <?php  if(isset($budget)){ echo $budget == 10 ?'selected':'' ;  } ?>>1.75 Cr+</option>
								</select>
							</div>
							<div class="form-group col-md-5">
								<label>Purpose:</label>
								<select class="form-control" name="purpose">
									<option value="">Select</option>
									<option value="1"  <?php  if(isset($purpose)){ echo $purpose == 1 ?'selected':'' ;  } ?>>Investment</option>
									<option value="2"  <?php  if(isset($purpose)){ echo $purpose == 2 ?'selected':'' ;  } ?>>Self</option>
									<option value="3"  <?php  if(isset($purpose)){ echo $purpose == 3 ?'selected':'' ;  } ?>>Looking For Other</option>
									<option value="4"  <?php  if(isset($purpose)){ echo $purpose == 4 ?'selected':'' ;  } ?>>Channel Partner</option>
									<option value="5"  <?php  if(isset($purpose)){ echo $purpose == 5 ?'selected':'' ;  } ?>>Random Enquiry</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-5">
								<label>Breif Remark</label>
								<textarea rows="4" style="width: 100%;" name="breif_remark"><?php if(!empty($breif_remark)){ echo $breif_remark ; }   ?></textarea>
							</div>
							<div class="form-group col-md-5">
								<label>Next Followup </label>
								<input type="text" name="next_followup" class="form-control datepicker" placeholder="dd/mm/yyyy"  value="<?php if(!empty($next_followup)){ echo $next_followup ; }   ?>">
							</div>
						</div>
                	</fieldset>
						   <div class="box-footer">
                     <input class="btn btn-primary" type="submit" id="enquirybtn" value="Save" />
                 </div>
					<?php   }   ?>
                	
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
 $('.plan_to_book').on('change', function() {
    $('.plan_to_book').not(this).prop('checked', false);  
});
$('.brought_to_here').on('change', function() {
    $('.brought_to_here').not(this).prop('checked', false);  
});
 </script>
 
 <script>
$('form').attr('autocomplete', 'off');
$(document).ready(function() {
    $('.select2').select2();
});
 </script>