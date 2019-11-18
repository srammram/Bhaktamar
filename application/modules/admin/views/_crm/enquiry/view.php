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
	.form-group label::after{content: ':';position: absolute;right: 0px;top: 0px;}
	.form-group .fam::after{display: none;}
</style>
 <?php   $seg= $this->uri->segment(5); ?>
 <section class="content-header">
     <h1>
         Enquiry View
     </h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard')?></a></li>
         <li><a href="<?php echo site_url('admin/crm/Crm/Enquiry') ?>"> <?php echo lang('Enquiry')?> </a></li>
        
     </ol>
 </section>
 <section class="content">
     <div class="row">
         <div class="col-xs-12">
             <div class="box">
                 <div class="box-header">
                     <h3 class="box-title">Enquiry View</h3>
                 </div><!-- /.box-header -->
                 <div class="box-body">
					
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">View</legend>
					<div class="row">
               			<div class="form-group col-md-4 col-md-offset-8">
							<div class="form-group col-md-12">
								<label class="col-sm-4">Date</label>
								<div class="col-sm-8">
									<?php if(!empty($enquiry->date)){ echo $enquiry->date ; }   ?>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label class="col-sm-4">Serial No</label>
								<div class="col-sm-8">
									<?php if(isset($enquiry->serial_no)){ echo $enquiry->serial_no ; } ?>
								</div>
							</div>
							
						</div>
					</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label class="col-md-6">Name</label>
                			<div class="col-md-6">
                				<?php if(!empty($enquiry->name)){ echo $enquiry->name ; }   ?>
                			</div>
                		</div>
                		
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label class="col-md-6">Contact No</label>
                			<div class="col-md-6">
                				<?php if(!empty($enquiry->contact_no)){ echo $enquiry->contact_no ; }   ?>
							</div>
                		</div>
                		<div class="form-group col-md-5">
                			<label class="col-md-6">Alternate No</label>
                			<div class="col-md-6">
                				<?php if(!empty($enquiry->alernate_no)){ echo $enquiry->alernate_no ; }   ?>
                			</div>
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label class="col-md-6">Address</label>
                			<div class="col-md-6">
                				<?php if(!empty($enquiry->address)){ echo $enquiry->address ; }   ?>
                			</div>
                		</div>
                		<div class="form-group col-md-5">
                			<label class="col-md-6">Email</label>
                			<div class="col-md-6">
                				<?php if(!empty($enquiry->email)){ echo $enquiry->email ; }   ?>
							</div>
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label class="col-md-6">Profession</label>
                			<div class="col-md-6">
                				<?php if(!empty($enquiry->profession)){ echo $enquiry->profession ; }   ?>
							</div>
                		</div>
                		<div class="form-group col-md-5">
                			<label class="col-md-6">Organization Name</label>
                			<div class="col-md-6">
                				<?php if(!empty($enquiry->organization)){ echo $enquiry->organization ; }   ?>
							</div>
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-5">
                			<label class="col-md-6">Convenient time to call you</label>
                			<div class="col-md-6">
                				<?php if(!empty($enquiry->convenient)){ echo $enquiry->convenient; }   ?>
                			</div>
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-12" style="margin-bottom: 0px;">
                			<label class="fam">When do you plan to book the flat</label>
                		</div>
						<div class="form-group checkbox_group col-md-3">
							<input type="checkbox" id="withinaweek" class="plan_to_book"  name="plan_to_book_flat" value="1" <?php  if(!empty($enquiry->plan_to_book_flat)){ if($enquiry->plan_to_book_flat==1){ echo "checked" ;  }}  ?> disabled>
							<label for="withinaweek">Within a Week</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="within15days" class="plan_to_book" name="plan_to_book_flat" value="2" <?php  if(!empty($enquiry->plan_to_book_flat)){ if($enquiry->plan_to_book_flat==2){ echo "checked" ;  }}  ?> disabled>
						  <label for="within15days">Within 15 Days</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="withinamonth" class="plan_to_book" name="plan_to_book_flat" value="3" <?php  if(!empty($enquiry->plan_to_book_flat)){ if($enquiry->plan_to_book_flat==3){ echo "checked" ;  }}  ?> disabled>
						  <label for="withinamonth">Within a Month</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="within45days" class="plan_to_book" name="plan_to_book_flat" value="4" <?php  if(!empty($enquiry->plan_to_book_flat)){ if($enquiry->plan_to_book_flat==4){ echo "checked" ;  }}  ?> disabled>
						  <label for="within45days">Within 45 Days</label>
						</div>
                	</div><hr>
                	<div class="row family_dr" >
						<div class="form-group col-md-4">
							<label class="fam">FAMILY</label>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">Adult</label>
								<div class="col-sm-7">
									<?php if(!empty($enquiry->adult)){ echo $enquiry->adult ; }   ?>
								</div>
							</div>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">Child</label>
								<div class="col-sm-7">
									<?php if(!empty($enquiry->child)){ echo $enquiry->child ; }   ?>
								</div>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label class="fam">VEHICLE</label>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">4 Wheeler</label>
								<div class="col-sm-7">
									<?php if(!empty($enquiry->four_wheeler)){ echo $enquiry->four_wheeler ; }   ?>
								</div>
							</div>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">2 Wheeler</label>
								<div class="col-sm-7">
									<?php if(!empty($enquiry->two_wheeler)){ echo $enquiry->two_wheeler ; }   ?>
								</div>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label class="fam">BUILDING</label>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-4" style="padding-left: 0px;padding-right: 0px;">Preferred Wing</label>
								<div class="col-sm-7">
								
                                                    <?php  if(!empty($building)){ foreach($building as  $row) 
                                                        { ?>
													<?php  if(isset($enquiry->preferred_wing)){ echo $enquiry->preferred_wing == $row->bldid ?$row->name:'' ;  } ?>
												<?php   }  }  ?>	
												
								</div>
							</div>
							<div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-4" style="padding-left: 0px;">Floor</label>
								<div class="col-sm-7">
								
                                                 <?php  if(!empty($floorlist)){ foreach($floorlist as  $row) { ?>
													<?php  if(isset($enquiry->floor)){ echo $enquiry->floor == $row->id ?$row->name:'' ;  } ?>
												<?php   }  }  ?>	
                                           
								</div>
							</div>
							</div>
							<div class="form-group col-md-4">
						       <div class="form-group col-md-12" style="padding: 0px;">
								<label class="col-sm-3" style="padding-left: 0px">No Of People:</label>
								<div class="col-sm-7">
									<?php if(!empty($enquiry->no_of_people)){ echo $enquiry->no_of_people ; }   ?>
								</div>
							</div>
						</div>
					
					<hr>
					<div class="row">
                		<div class="form-group col-md-12" style="margin-bottom: 0px;">
                			<label class="fam">What brought to here</label>
                		</div>
						<div class="form-group checkbox_group col-md-3">
							<input type="checkbox" id="hoarding" class="brought_to_here" value="1" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==1){ echo "checked" ;  }}  ?>>
							<label for="hoarding">Hoarding</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="pole_kosk" value="2" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==2){ echo "checked" ;  }}  ?> disabled>
						  <label for="pole_kosk">pole Kosk</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="paper_ads" value="3" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==3){ echo "checked" ;  }}  ?> disabled>
						  <label for="paper_ads">Paper Ads</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="tv_radio" value="4" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==4){ echo "checked" ;  }}  ?> disabled>
						  <label for="tv_radio">TV/Radio</label>
						</div>
               			<div class="form-group checkbox_group col-md-3">
							<input type="checkbox" id="portal" value="5" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==5){ echo "checked" ;  }}  ?> disabled>
							<label for="portal">Portal</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="pamphlet" value="6" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==6){ echo "checked" ;  }}  ?> disabled>
						  <label for="pamphlet">Pamphlet</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="areavisit" value="7" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==7){ echo "checked" ;  }}  ?> disabled>
						  <label for="areavisit">Area Visit</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="associate" value="8" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==8){ echo "checked" ;  }}  ?> disabled>
						  <label for="associate">Associate</label>
						</div>
               			<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="expo" value="9" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==9){ echo "checked" ;  }}  ?> disabled>
						  <label for="expo">Expo/BTL</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="sms_email" value="10" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==10){ echo "checked" ;  }}  ?> disabled>
						  <label for="sms_email">SMS/Email</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="others" value="11" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==11){ echo "checked" ;  }}  ?> disabled>
						  <label for="others">Others(if any)</label>
						</div>
						<div class="clearfix"></div>
               			<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="clientreference" value="12" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==12){ echo "checked" ;  }}  ?> disabled>
						  <label for="clientreference">Client Reference</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="mgtreference" value="13" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==13){ echo "checked" ;  }}  ?> disabled>
						  <label for="mgtreference">Mgt Reference</label>
						</div>
						<div class="form-group checkbox_group col-md-3">
						  <input type="checkbox" id="website" value="14" class="brought_to_here" name="brought_to_here" <?php  if(!empty($enquiry->brought_to_here)){ if($enquiry->brought_to_here==14){ echo "checked" ;  }}  ?> disabled>
						  <label for="website">Website</label>
						</div>
                	</div>
                	<hr>
                	<div class="row">
                		<div class="form-group col-md-8">
                			<label class="col-sm-3">Post Visit Remarks </label>
                			<div class="col-sm-7">
                				<?php if(!empty($enquiry->post_visit_remark)){ echo $enquiry->post_visit_remark ; }   ?>
                			</div>
                		</div>
						<div class="form-group col-md-8">
                			<label class="col-sm-3">Pre Sales Executive  :</label>
                			<div class="col-sm-7">
                					<?php if(!empty($enquiry->pre_sales_excutive)){ echo $enquiry->pre_sales_excutive ; }   ?>
                			</div>
                		</div>
						<div class="form-group col-md-8">
                			<label class="col-sm-3">Lead Forwaded To :</label>
                			<div class="col-sm-7">
                            <?php  if(!empty($employee)){ foreach($employee as  $row) 
                             { ?>
						      <?php  if(isset($enquiry->lead_forward_to)){ echo $enquiry->lead_forward_to == $row->id ?$row->first_name:'' ;  } ?>
							   <?php   }  }  ?>	
							
                			</div>
                		</div>
                		<div class="form-group col-md-8">
                			<label class="col-sm-3">Follow Up</label>
                			<div class="col-sm-7">
                				<?php if(!empty($enquiry->followup)){ echo $enquiry->followup ; }   ?>
                			</div>
                		</div>
                		<div class="form-group col-md-4 col-md-offset-8">
                			<label class="col-sm-5">Attended by:</label>
                			<div class="col-sm-7">
							<?php     ?>
							
                                                    <?php  if(!empty($employee)){ foreach($employee as  $row) 
                                                        { ?>
													  <?php  if(isset($enquiry->attended_by)){ echo $enquiry->attended_by == $row->id ?$row->first_name:'' ;  } ?>
												<?php   }  }  ?>	
                				
                			</div>
                		</div>
                	</div>
					</fieldset>
					</form>
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Post Enquiry</legend>
						<div class="row">
							<div class="form-group col-md-5">
								<label class="col-md-6">Status</label>
								<div class="col-md-6">
									<?php  if(isset($status)){ echo $status == 1 ?'Hot':'' ;  } ?>
									<?php  if(isset($status)){ echo $status == 2 ?'Warm':'' ;  } ?>
									<?php  if(isset($status)){ echo $status == 3 ?'Cold':'' ;  } ?>
								</div>
							</div>
							<div class="form-group col-md-5">
								<label class="col-md-6">Looking For</label>
									<div class="col-md-6">
									<?php   if(!empty($unit_type)){ foreach($unit_type as $row){  ?>
									 <?php  if(isset($looking_for)){ echo $looking_for == $row->id ?$row->UnitType:'' ;  } ?>
									<?php   }  }   ?>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-5">
								<label class="col-md-6">Budget</label>
								<div class="col-md-6">
									<?php  if(isset($budget)){ echo $budget == 1 ?'>Less 40':'' ;  } ?>
									<?php  if(isset($budget)){ echo $budget == 2 ?'40-50':'' ;  } ?>
									<?php  if(isset($budget)){ echo $budget == 3 ?'>50-60':'' ;  } ?>
									<?php  if(isset($budget)){ echo $budget == 4 ?'>60-70':'' ;  } ?>
									<?php  if(isset($budget)){ echo $budget == 5 ?'>70-80':'' ;  } ?>
									<?php  if(isset($budget)){ echo $budget == 6 ?'>80-1Cr':'' ;  } ?>
									<?php  if(isset($budget)){ echo $budget == 7 ?'>1-1.2Cr':'' ;  } ?>
									<?php  if(isset($budget)){ echo $budget == 8 ?'>1.2-1.5Cr':'' ;  } ?>
									<?php  if(isset($budget)){ echo $budget == 9 ?'>1.5-1.75Cr':'' ;  } ?>
									<?php  if(isset($budget)){ echo $budget == 10 ?'>1.75 Cr+':'' ;  } ?>
								</div>
							</div>
							<div class="form-group col-md-5">
								<label class="col-md-6">Purpose</label>
								<div class="col-md-6">
									<?php  if(isset($purpose)){ echo $purpose == 1 ?'Investment':'' ;  } ?>
									<?php  if(isset($purpose)){ echo $purpose == 2 ?'Self':'' ;  } ?>
									<?php  if(isset($purpose)){ echo $purpose == 3 ?'Looking For Other':'' ;  } ?>
									<?php  if(isset($purpose)){ echo $purpose == 4 ?'Channel Partner':'' ;  } ?>
									<?php  if(isset($purpose)){ echo $purpose == 5 ?'Random Enquiry':'' ;  } ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-5">
								<label class="col-md-6">Breif Remark</label>
								<div class="col-md-6">
									<?php if(!empty($breif_remark)){ echo $breif_remark ; }   ?>
								</div>
							</div>
							<div class="form-group col-md-5">
								<label class="col-md-6">Next Followup </label>
								<div class="col-md-6">
									<?php if(!empty($next_followup)){ echo $next_followup ; }   ?>
								</div>
							</div>
						</div>
                	</fieldset>
				
				</div><!-- /.box-body -->
         </div><!-- /.box -->

     </div><!-- /.col -->
     </div><!-- /.row -->
 </section>