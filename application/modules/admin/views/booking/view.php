<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/select2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/select2.min.js"></script>
<link href='<?php echo base_url()?>assets/assets/plugin/datepicker/datepicker3.css' rel='stylesheet' media='screen'>
<style>
.error {
    color: #FF0000;
}

.select2-container .select2-selection--single {
    height: 35px;
    border-radius: 0px;
    border: 1px solid #ddd;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 35px;
}
	.select2{border: none;background-color: transparent;}
	.well-sm .form-group{margin-bottom: 0px;}
select {
  /* for Firefox */
  -moz-appearance: none;
  /* for Chrome */
  -webkit-appearance: none;
}

/* For IE10 */
select::-ms-expand {
  display: none;
}
.content-header .breadcrumb {
    margin-bottom: 0px;
    background-color: transparent;
}

.content-header h3 {
    margin: 0px;
}

fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow: 0px 0px 0px 0px #000;
    box-shadow: 0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    width: auto;
    padding: 0 10px;
    border-bottom: none;
    border: 1px solid;
}

.table-bordered>thead>tr>th {
    background-color: #2c3542 !important;
}

.terms_conditions_s {
    padding-left: 20px;
}

.terms_conditions_s li {
    line-height: 28px;
}

.form-control {
    border-radius: 0px;
}

#customFields tbody tr td input {
    border: none;
    border-bottom: 1px solid #ddd;
}

#customFields {
    position: relative;
	table-layout: fixed;
}

.remCF,
.addCF {
    position: absolute;
    right: 7px;
    margin-top: -2%;
    color: white;
    background-color: #d80404;
    padding: 0;
    width: 20px;
    height: 20px;
    line-height: 17px;
    text-align: center;
    border-radius: 10px;
}

.addCF {
    line-height: 20px;
    background-color: darkgreen;
}

.addCF:hover {
    line-height: 20px;
    background-color: darkgreen;
    color: white
}

#customFields>tbody>tr>td,
#customFields>tbody>tr>th,
#customFields>tfoot>tr>td,
#customFields>tfoot>tr>th {
    padding: 4px;
}

#customFields>tbody>tr>td:first-child {
    text-align: center;
}
	.table-bordered>tbody>tr>td{border: 1px solid #ddd;}
.file-upload-wrapper {
    position: relative;
    width: 100%;
    height: 40px;
    border: 1px solid #ccc;
}

.file-upload-wrapper:after {
    content: attr(data-text-upload);
    font-size: 14px;
    position: absolute;
    top: 0;
    left: 0;
    background: #fff;
    padding: 0px 15px;
    display: block;
    width: calc(100% - 40px);
    pointer-events: none;
    z-index: 20;
    height: 35px;
    line-height: 35px;
    color: #999;
    border-radius: 5px 10px 10px 5px;
    font-weight: 300;
}

.file-upload-wrapper:before {
    content: "Upload";
    position: absolute;
    top: 0;
    right: 0;
    display: inline-block;
    height: 40px;
    background: #2c3542;
    color: #fff;
    font-weight: 700;
    z-index: 25;
    font-size: 14px;
    line-height: 40px;
    padding: 0 15px;
    text-transform: uppercase;
    pointer-events: none;
    border-radius: 0 0px 0px 0;
}

.file-upload-wrapper:hover:before {
    background: #2c3542;
}

.file-upload-wrapper input {
    opacity: 0;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 99;
    height: 40px;
    margin: 0;
    padding: 0;
    display: block;
    cursor: pointer;
    width: 100%;
}
	.payment_tk{width: 75%;float: left;margin-right: 1px;text-align: center;}
	.percentage_s{margin-top: 0px;position: relative;float: right;}
	#customFields thead tr th:first-child{text-align: center;}
	#customFields thead tr th:last-child{text-align: right;}
	#customFields tbody tr td:last-child{text-align: right;}
	#customFields tfoot tr td:last-child{text-align: right;}
	#customFields tfoot tr:last-child td{text-align: left;}
	.form-group label::after{content: ':';position: absolute;right: 0px;top: 0px;}
	.well-sm .form-group label::after{display: none;}
	.form-group .css-radio::after{display: none;}
	.bottom_s .form-group label::after{display: none;}
	.bottom_s .form-group .form-control{border: none!important;}
</style>
<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
    <h1>
        Booking
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/booking/booking') ?>">Booking </a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Application | Booking View</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">View</legend>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Date</label>
								   	<div class="col-md-6">
                               			<?php  if(!empty($booking->date)){ echo $booking->date;  } ?>
                               		</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Serial No</label>
									<div class="col-md-6">
                                    	<?php  if(!empty($booking->serial_no)){ echo $booking->serial_no ;  } ?>
                                	</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Applicant Name</label></label>
								   	<div class="col-md-6">
                                        <?php  if(!empty($booking->applicant_name)){ echo $booking->applicant_name;  } ?>
                                	</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Address</label>
									<div class="col-md-6">
										<?php  if(!empty($booking->address)){ echo $booking->address ;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Pincode</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->pincode)){ echo $booking->pincode ;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Contact No</label>
									<div class="col-md-6">
                                        <?php  if(!empty($booking->contactno)){ echo $booking->contactno ;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
									<label class="col-md-6">Whats app</label>
								   	<div class="col-md-6">
                                        <?php  if(!empty($booking->whatapp)){ echo $booking->whatapp;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Email id</label>
								   	<div class="col-md-6">
                                        <?php  if(!empty($booking->email)){ echo $booking->email ;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Occupation</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->occuption)){ echo $booking->occuption ;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Organization</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->organization)){ echo $booking->organization ;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Desigantion</label>
								 	<div class="col-md-6">
                                    	<?php  if(!empty($booking->desigantion)){ echo $booking->desigantion;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">D.O.B (Age)</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->d_o_b)){ echo $booking->d_o_b;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Anniversary</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->anniversary)){ echo $booking->anniversary;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Pan No</label>
								  	<div class="col-md-6"> 
                                        <?php  if(!empty($booking->pan_no)){ echo $booking->pan_no;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Aadhar No</label>
								   	<div class="col-md-6"> 
                                        <?php  if(!empty($booking->aadhar_no)){ echo $booking->aadhar_no;  } ?>
									</div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border" style="padding-top:1.4em !important">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Co-Applicant's Name</label>
								   <div class="col-md-6">
                                        <?php  if(!empty($booking->co_applicant_name)){ echo $booking->co_applicant_name;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Relationship</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->relationship)){ echo $booking->relationship ;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Contact No</label>
								   	<div class="col-md-6">
                                        <?php  if(!empty($booking->co_app_contact_no)){ echo $booking->co_app_contact_no;  } ?>
									</div>
								</div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Email id</label>
								   	<div class="col-md-6">
                                        <?php  if(!empty($booking->co_app_email)){ echo $booking->co_app_email;  } ?>
									</div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Occupation</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->co_app_occupation)){ echo $booking->co_app_occupation;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Organization</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->co_app_organization)){ echo $booking->co_app_organization;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Desigantion</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->co_app_desigantion)){ echo $booking->co_app_desigantion;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">D.O.B (Age)</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->co_app_d_o_b)){ echo $booking->co_app_d_o_b;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Anniversary</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->co_app_anniversary)){ echo $booking->co_app_anniversary ;  } ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Pan No</label>
								   	<div class="col-md-6">
                                        <?php  if(!empty($booking->co_app_pan_no)){ echo $booking->co_app_pan_no;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
									<label class="col-md-6">Aadhar No</label>
									<div class="col-md-6">
										<?php  if(!empty($booking->co_app_aadhar_no)){ echo  $booking->co_app_aadhar_no ;  } ?>
									</div>
                            	</div>
							</div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Booking Details(For office use only)</legend>
                            <div class="row well well-sm">
                                <div class="form-group col-md-7" style="padding: 0px;">
                                    <div class="form-group col-md-6">
                                        <label class="col-md-6" style="padding: 6px 15px;">Wing No</label>
                                        <div class="col-md-6" style="padding: 0px;">
                                                    <?php  if(!empty($building)){ foreach($building as  $row) 
                                                        {  ?>
													<?php  if(isset($booking->building_no)){ echo $booking->building_no == $row->bldid ?$row->name:'' ;  } ?>
												<?php   }  }  ?>	
												</select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-md-6" style="padding: 6px 15px;">Floor</label>
                                        <div class="col-md-6" style="padding: 0px;">
                                              <?php  if(!empty($floorlist)){ foreach($floorlist as  $row) { ?>
													<?php  if(isset($booking->floor)){ echo $booking->floor == $row->id ?$row->name:'' ;  } ?>
												<?php   }  }  ?>	
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6" style="padding: 6px 15px;">Shop/Flat No</label>
                                    <div class="col-md-6" style="padding: 0px;">
                                      
                                             <?php  if(!empty($unitlist)){ foreach($unitlist as  $row) { ?>
													<?php  if(isset($booking->unit_id)){ echo $booking->unit_id == $row->uid ?$row->unit_name:'' ;  } ?>
												<?php   }  }  ?>	
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Carpet Area(5q. mtr)</label>
								   	<div class="col-md-6">
                                        <?php  if(!empty($booking->carpet_area)){ echo  $booking->carpet_area ;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Enclosed Balcony Carpet Area(5q. mtr)</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->enclosed_balcony_area)){ echo $booking->enclosed_balcony_area;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Open Balcony Carpet Area(5q. mtr)</label>
									<div class="col-md-6">
                                        <?php  if(!empty($booking->open_balcony_carpet)){ echo $booking->open_balcony_carpet ;  } ?>
									</div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label  class="col-md-6">Basic Cost</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->basic_cost)){ echo $booking->basic_cost;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Intra Charges</label>
								   	<div class="col-md-6">
                                        <?php  if(!empty($booking->intra_charges)){ echo  $booking->intra_charges ;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Agreement Value</label>
									<div class="col-md-6">
                                        <?php  if(!empty($booking->agreement_value)){ echo $booking->agreement_value;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Stamp Duty @</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->stamp_duty)){ echo $booking->stamp_duty;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Registration Fees</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->registration_fee)){ echo $booking->registration_fee;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Legal Charges</label>
								   	<div class="col-md-6">
                                        <?php  if(!empty($booking->legal_charges)){ echo  $booking->legal_charges ;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">GST</label>
                                    <div class="col-md-6">
                                        <?php  if(!empty($booking->gst)){ echo  $booking->gst ;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">GRAND TOTAL COST</label>
								   	<div class="col-md-6">
                                        <?php  if(!empty($booking->grand_total_cost)){ echo $booking->grand_total_cost;  } ?>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Own Contribution</label>
									<div class="col-md-6">
                                    	<?php  if(!empty($booking->owner_contribution)){ echo $booking->owner_contribution ;  } ?>
									</div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label class="col-md-6">Bank Loan</label>
                                    <div class="col-md-6">
                                    	<?php  if(!empty($booking->bank_loan)){ echo $booking->bank_loan;  } ?>
									</div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Payment Schedule<sup></sup>:</h4>
                                
                                   <div class="form-group">
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="scheduletype" value="1" 
                                                    type="radio" class="scheduletype" <?php  if(!empty($booking->payment_schedule_plan)){ if($booking->payment_schedule_plan==1){ echo "checked" ;  }}  ?>><span></span> Custom Plan
                                            </label> &nbsp;  &nbsp;  &nbsp;  &nbsp;  
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="scheduletype" value="2" <?php  if(!empty($booking->payment_schedule_plan)){ if($booking->payment_schedule_plan==2){ echo "checked" ;  }}else{ echo "checked" ; }  ?>
                                                    type="radio" class="scheduletype" ><span></span> Regular Plan
                                            </label>
                                        </div>
                                
                                <table class="table table-bordered">
                                    <colgroup>
                                        <col width="85%">
                                        <col width="10%">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td>Token/Booking Amount</td>
                                            <td><?php  if(!empty($booking->token_booking_amt)){ echo round($booking->token_booking_amt);  } ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Execution of Agreement</td>
                                            <td><?php  if(!empty($booking->execution_of_agreement_amt)){ echo round($booking->execution_of_agreement_amt);  }  ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Plinth</td>
                                            <td><?php  if(!empty($booking->completion_of_plinth_amt)){ echo round($booking->completion_of_plinth_amt) ;  } ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Parking & 1st Slab</td>
                                            <td><?php  if(!empty($booking->parking_1st_slab_amt)){ echo round($booking->parking_1st_slab_amt);  }else{ echo 5 ;  }  ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 2nd Slab</td>
                                            <td><?php  if(!empty($booking->completionof_2nd_slab_amt))
											{ echo round($booking->completionof_2nd_slab_amt) ;  } ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 5th Slab</td>
                                            <td><?php  if(!empty($booking->completion_of_5th_slab_amt)){ echo  round($booking->completion_of_5th_slab_amt) ;  } ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 8th Slab</td>
                                            <td><?php  if(!empty($booking->completion_of_8th_slab_amt)){ echo round($booking->completion_of_8th_slab_amt);  }  ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 11th Slab</td>
                                            <td><?php  if(!empty($booking->completion_of_11_slab_amt)){ echo round($booking->completion_of_11_slab_amt);  }else{ echo 5;  }  ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Topmost Slab</td>
                                            <td><?php  if(!empty($booking->completion_of_topmost_slab_amt)){ echo round($booking->completion_of_topmost_slab_amt);  }  ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Brick Work,Plaster & Flooring</td>
                                            <td><?php  if(!empty($booking->paint_stage_amt)){ echo round($booking->paint_stage_amt) ;  }  ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Sanitary Fitting & Paint</td>
                                            <td><?php  if(!empty($booking->finishg_work_amt)){ echo round($booking->finishg_work_amt);  }  ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of MEP & Finishing Work</td>
                                            <td><?php  if(!empty($booking->possesion_amt)){ echo round($booking->possesion_amt);  }  ?><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Handover/Possesion</td>
                                            <td><?php  if(!empty($booking->possesion_amt)){ echo round($booking->possesion_amt);  } ?><span class="percentage_s">%</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p><sup>*</sup>No reveiving of payment as per payment schedule will cause interest and
                                    penality.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Payment Received Details(Till Date)</h3>
                                <table class="table table-bordered" id="customFields">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Cheque No.</th>
                                            <th>Dated</th>
                                            <th>Bank & Branch</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; if(!empty($payment_details)){ foreach($payment_details as $row){  ?>
                                        <tr>
                                        <td><?php  echo $i;  ?>.</td>
                                            <td><?php echo $row->cheque_no  ;  ?></td>
                                            <td><?php echo $row->date  ;  ?></td>
                                            <td><?php echo $row->bank_branch  ;  ?></td>
                                            <td><?php echo $this->sma->formatMoney($row->amount)  ;  ?></td>
                                            </tr>
                                    <?php  $i++; }  }  ?>
                                      
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" style="text-align: right;">Total Received Payment</td>
                                            <td><?php  if(!empty($booking->total_received_amt)){ echo $this->sma->formatMoney($booking->total_received_amt) ;  } ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <?php  if(!empty($booking->rupee_in_word)){ echo $booking->rupee_in_word ;  } ?>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <h4>Terms & Conditions:</h4>
                                <ol class="terms_conditions_s">
                                    <li>Document registration should be executed within 15-20 days after own
                                        contribution payment</li>
                                    <li>Cancellation charges Rs 25000 would be deducted on A/C of administartive
                                        expenses</li>
                                    <li>If any gift in promotional scheme.the same value would be deducted from
                                        refunding amount after cancellation.</li>
                                    <li>We are not accepting any kind of internal changes. so please don't request for
                                        any changes.</li>
                                    <li>The above quotation id valid for <b style="color:red;"><?php  if(!empty($booking->valid_days)){ echo $booking->valid_days ;  } ?></b> days only.</li>
                                    <li>Payment schedule must be followed. Non receiving of payment on time will cause
                                        interest and penalty.</li>
                                    <li>Above mentioned govt taxed are as per current charges. if it changes, same will
                                        be applicable to you too.</li>
                                    <li>GST rate is applicable as per received payment during existing tenure.</li>
                                    <li>Maintenance charge fo 24 months to be paid at the time of possession.</li>
                                    <li>The promoters reserve the right to change the design layout, plan and
                                        specification on technical ground</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row bottom_s">
                            <div class="col-md-12" style="margin-bottom: 25px;">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-3" style="padding: 8px 15px;">Attended By :</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control"
                                            style="border: none;border-bottom: 1px solid #ddd;"  name="attendedby" value="<?php  if(!empty($booking->attended_by)){ echo  $booking->attended_by ;  } ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                   <label class="col-sm-12" style="padding: 8px 15px;">Witness</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control"
                                            style="border: none;border-bottom: 1px solid #ddd;" name="witness" value="<?php  if(!empty($booking->witness)){ echo $booking->witness ;  } ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group col-md-12">
                                    <div class="col-md-6 file_upload">
									<?php if(!empty($booking->purchaser_signature_path)){ $url="uploads/booking/purchaser_signatory/".$booking->purchaser_signature_path ;   }else{ $url="assets/assets/images/no_image.jpg";  }   ?>
                                        <img height="100px" width="160px" src="<?=base_url().$url?>">
                                    </div>
                                    <label class="col-sm-12">Purchaser Sign</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="form-group col-md-12">
                                    <div class="col-md-6 file_upload">
									<?php if(!empty($booking->authorized_signatory)){ $url1="uploads/booking/authorized_signatory/".$booking->authorized_signatory ;   }else{ $url1="assets/assets/images/no_image.jpg";  }   ?>
                                        <img height="100px" width="160px"src="<?=base_url().$url1?>">
                                    </div>
                                    <label class="col-sm-12" style="padding-right: 0px;">Authorised Signatory with
                                        company seal</label>
                                </div>
                            </div>
                        </div>
                       
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
