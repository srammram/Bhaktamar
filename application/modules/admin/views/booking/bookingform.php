<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/select2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
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
	.payment_tk{width: 75%;float: left;margin-right: 1px;text-align: center;padding: 0px;}
	.percentage_s{margin-top: 5px;position: relative;float: left;}
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
                    <h3 class="box-title">Application | Booking Form</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/booking/booking/'.$id); ?>"
                        enctype="multipart/form-data" id="bookingform">
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Form</legend>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Date<span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control datepicker" id="datepicker"
                                            name="date" data-date-format="yyyy/mm/dd" onkeydown="return false"  value="<?php  if(!empty($date)){ echo $date;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Serial No</label>
                                    <input type="text" class="form-control" name="serialno" value="<?php echo $serial_no;  ?>"readonly value="<?php  if(!empty($serial_no)){ echo $serial_no ;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Applicant Name</label>
                                    <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control"  name="applicantname" value="<?php  if(!empty($applicant_name)){ echo $applicant_name;  } ?>">
                           
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="<?php  if(!empty($address)){ echo $address ;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Pincode</label>
                                    <input type="text" class="form-control allownumber" name="pincode" value="<?php  if(!empty($pincode)){ echo $pincode ;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Contact No</label>
                                        <input type="text" class="form-control allownumber" name="contact" value="<?php  if(!empty($contactno)){ echo $contactno ;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Whats app</label>
                                    </label>
                                        <input type="text" class="form-control allownumber" name="whatapp" value="<?php  if(!empty($whatapp)){ echo $whatapp;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Email id</label>
                                    </label>
                                        <input type="email" class="form-control" name="email" value="<?php  if(!empty($email)){ echo $email ;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control"  name="occupation" value="<?php  if(!empty($occuption)){ echo $occuption ;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Organization</label>
                                    <input type="text" class="form-control"  name="organization" value="<?php  if(!empty($organization)){ echo $organization ;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Desigantion</label>
                                    <input type="text" class="form-control"  name="desigantion" value="<?php  if(!empty($desigantion)){ echo $desigantion;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>D.O.B (Age)</label>
                                    <input type="text" class="form-control allownumber"  name="age" value="<?php  if(!empty($d_o_b)){ echo $d_o_b;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Anniversary</label>
                                    <input type="text" class="form-control"  name="Anniversary" value="<?php  if(!empty($anniversary)){ echo $anniversary;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Pan No</label>
                                    <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control"  name="pan" value="<?php  if(!empty($pan_no)){ echo $pan_no;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Aadhar No</label>
                                    </label>
                                        <input type="text" class="form-control allownumber"  name="adhar" value="<?php  if(!empty($aadhar_no)){ echo $aadhar_no;  } ?>">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border" style="padding-top:1.4em !important">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Co-Applicant's Name</label>
                                    </label>
                                        <input type="text" class="form-control"  name="co_applicant" value="<?php  if(!empty($co_applicant_name)){ echo $co_applicant_name;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Relationship</label>
                                    <input type="text" class="form-control"  name="relationship" value="<?php  if(!empty($relationship)){ echo $relationship ;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Contact No</label>
                                    </label>
                                        <input type="text" class="form-control allownumber"  name="contact2" value="<?php  if(!empty($co_app_contact_no)){ echo $co_app_contact_no;  } ?>">
                                    </div>
                                <div class="form-group col-md-5">
                                    <label>Email id</label>
                                    </label>
                                        <input type="email" class="form-control"  name="email2" value="<?php  if(!empty($co_app_email)){ echo $co_app_email;  } ?>">
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control" name="occupation2" value="<?php  if(!empty($co_app_occupation)){ echo $co_app_occupation;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Organization</label>
                                    <input type="text" class="form-control"  name="organization2" value="<?php  if(!empty($co_app_organization)){ echo $co_app_organization;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Desigantion</label>
                                    <input type="text" class="form-control"  name="desigantion2" value="<?php  if(!empty($co_app_desigantion)){ echo $co_app_desigantion;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>D.O.B (Age)</label>
                                    <input type="text" class="form-control" name="dob2" value="<?php  if(!empty($co_app_d_o_b)){ echo $co_app_d_o_b;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Anniversary</label>
                                    <input type="text" class="form-control" name="anniversary2" value="<?php  if(!empty($co_app_anniversary)){ echo $co_app_anniversary ;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Pan No</label>
                                    </label>
                                        <input type="text" class="form-control" name="pan2" value="<?php  if(!empty($co_app_pan_no)){ echo $co_app_pan_no;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Aadhar No</label>
                                        <input type="text" class="form-control allownumber"  name="adhar2" value="<?php  if(!empty($co_app_aadhar_no)){ echo  $co_app_aadhar_no ;  } ?>">
                            </div>
                        </fieldset>
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">Booking Details(For office use only)</legend>
                            <div class="row">
                                <div class="form-group col-md-5" style="padding: 0px;">
                                    <div class="form-group col-md-6">
                                        <label>Wing No</label>
                                        <div class="col-md-12" style="padding: 0px;">
                                            <select class="form-control select2" name="building_id" onchange="get_buildingfloors(this.value)">
                                                <option value="">Select Wing</option>
                                                    <?php  if(!empty($building)){ foreach($building as  $row) 
                                                        { ?>
													<option value="<?php   echo $row->bldid ; ?>"  <?php  if(isset($building_no)){ echo $building_no == $row->bldid ?'selected':'' ;  } ?>><?php echo $row->name ;  ?></option>
												<?php   }  }  ?>	
												</select>
                                       <label for="building_id" class="error" style="display: none;">Please select your Building.</label>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Floor</label>
                                        <div class="col-md-12" style="padding: 0px;">
                                            <select class="form-control select2" name="floor_id" id="floor" onchange="get_floorunit(this.value)">
                                                 <?php  if(!empty($floorlist)){ foreach($floorlist as  $row) { ?>
													<option value="<?php   echo $row->id ; ?>"  <?php  if(isset($floor)){ echo $floor == $row->id ?'selected':'' ;  } ?>><?php echo $row->name ;  ?></option>
												<?php   }  }  ?>	
                                            </select>
                                            <label for="floor" class="error" style="display: none;">Please select your Floor.</label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Shop/Flat No</label>
                                    <div class="col-md-12" style="padding: 0px;">
                                        <select class="form-control select2" id="units" name="unit_id">
                                             <?php  if(!empty($unitlist)){ foreach($unitlist as  $row) { ?>
													<option value="<?php   echo $row->uid ; ?>"  <?php  if(isset($flat)){ echo $flat == $row->uid ?'selected':'' ;  } ?>><?php echo $row->unit_name ;  ?></option>
												<?php   }  }  ?>	
                                        </select>
                                        <label for="units" class="error" style="display: none;">Please select your Units.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Carpet Area(5q. mtr)</label>
                                    </label>
                                        <input type="text" class="form-control allowdecimalpoint" name="carpetarea" value="<?php  if(!empty($carpet_area)){ echo  $carpet_area ;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Enclosed Balcony Carpet Area(5q. mtr)</label>
                                    <input type="text" class="form-control allowdecimalpoint" name="enclosed_balconycarpet_area" value="<?php  if(!empty($enclosed_balcony_area)){ echo $enclosed_balcony_area;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Open Balcony Carpet Area(5q. mtr)</label>
                                   </label>
                                        <input type="text" class="form-control allowdecimalpoint"  name="open_balcony_carpet_area" value="<?php  if(!empty($open_balcony_carpet)){ echo$open_balcony_carpet ;  } ?>">
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Basic Cost</label>
                                    <input type="text" class="form-control allowdecimalpoint" name="basic_cost" value="<?php  if(!empty($basic_cost)){ echo $basic_cost;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Intra Charges</label>
                                   </label>
                                        <input type="text" class="form-control allowdecimalpoint" name="intra_charges" value="<?php  if(!empty($intra_charges)){ echo  $intra_charges ;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Agreement Value</label>
                                   </label>
                                        <input type="text" class="form-control allowdecimalpoint"  name="agreementvalue" value="<?php  if(!empty($agreement_value)){ echo $agreement_value;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Stamp Duty @</label>
                                    <input type="text" class="form-control allowdecimalpoint"  name="stamp_duty" value="<?php  if(!empty($stamp_duty)){ echo $stamp_duty;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Registration Fees</label>
                                    <input type="text" class="form-control allowdecimalpoint"  name="registration_fees" value="<?php  if(!empty($registration_fee)){ echo $registration_fee;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Legal Charges</label>
                                    <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control allowdecimalpoint"  name="legal_charges" value="<?php  if(!empty($legal_charges)){ echo  $legal_charges ;  } ?>">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>GST</label>
                                    <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control allowdecimalpoint"  name="gst" value="<?php  if(!empty($gst)){ echo  $gst ;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>GRAND TOTAL COST</label>
                                    <span class="required" aria-required="true">*</span></label>
                                        <input type="text" class="form-control allowdecimalpoint"  name="total_cost" value="<?php  if(!empty($grand_total_cost)){ echo $grand_total_cost;  } ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Own Contribution</label>
                                    <input type="text" class="form-control allowdecimalpoint"  name="own_contribution" value="<?php  if(!empty($owner_contribution)){ echo $owner_contribution ;  } ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Bank Loan</label>
                                    <input type="text" class="form-control allowdecimalpoint"  name="bank_loan" value="<?php  if(!empty($bank_loan)){ echo $bank_loan;  } ?>">
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Payment Schedule<sup></sup>:</h4>
                                
                                   <div class="form-group">
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="scheduletype" value="1" 
                                                    type="radio" class="scheduletype" <?php  if(!empty($payment_schedule_plan)){ if($payment_schedule_plan==1){ echo "checked" ;  }}  ?>><span></span> Custom Plan
                                            </label> &nbsp;  &nbsp;  &nbsp;  &nbsp;  
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="scheduletype" value="2" <?php  if(!empty($payment_schedule_plan)){ if($payment_schedule_plan==2){ echo "checked" ;  }}else{ echo "checked" ; }  ?>
                                                    type="radio" class="scheduletype" ><span></span> Regular Plan
                                            </label>
                                        </div>
                                
                                <table class="table table-bordered">
                                    <colgroup>
                                        <col width="85%">
                                        <col width="15%">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td>Token/Booking Amount</td>
                                            <td><input type="text"  name="token_booking_amt"class="payment_tk form-control allowdecimalpoint" value="<?php  if(!empty($token_booking_amt)){ echo round($token_booking_amt);  }else{ echo 10 ;  }  ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Execution of Agreement</td>
                                            <td><input type="text"  name="execution_of_agreement_amt" class="payment_tk form-control allowdecimalpoint" value="<?php  if(!empty($execution_of_agreement_amt)){ echo round($execution_of_agreement_amt);  }else{ echo 20 ;  }  ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Plinth</td>
                                            <td><input type="text"  class="payment_tk form-control allowdecimalpoint" name="completion_of_plinth_amt" value="<?php  if(!empty($completion_of_plinth_amt)){ echo round($completion_of_plinth_amt) ;  }else{ echo 15;  }  ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Parking & 1st Slab</td>
                                            <td><input type="text"  class="payment_tk form-control allowdecimalpoint" name="parking_1st_slab_amt" value="<?php  if(!empty($parking_1st_slab_amt)){ echo round($parking_1st_slab_amt);  }else{ echo 5 ;  }  ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 2nd Slab</td>
                                            <td><input type="text"  class="payment_tk form-control allowdecimalpoint"  name="completionof_2nd_slab_amt"
											value="<?php  if(!empty($completionof_2nd_slab_amt))
											{ echo round($completionof_2nd_slab_amt) ;  }else{ echo 5;  } ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 5th Slab</td>
                                            <td><input type="text"  class="payment_tk form-control allowdecimalpoint" name="completion_of_5th_slab_amt" value="<?php  if(!empty($completion_of_5th_slab_amt)){ echo  round($completion_of_5th_slab_amt) ;  }else{ echo 5 ;  }  ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 8th Slab</td>
                                            <td><input type="text"  class="payment_tk form-control allowdecimalpoint" name="completion_of_8th_slab_amt" value="<?php  if(!empty($completion_of_8th_slab_amt)){ echo round($completion_of_8th_slab_amt);  }else{ echo 5 ;  }  ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of 11th Slab</td>
                                            <td><input type="text"  class="payment_tk form-control allowdecimalpoint" name="completion_of_11_slab_amt" value="<?php  if(!empty($completion_of_11_slab_amt)){ echo round($completion_of_11_slab_amt);  }else{ echo 5;  }  ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Topmost Slab</td>
                                            <td><input type="text"  class="payment_tk form-control allowdecimalpoint"  name="completion_of_topmost_slab_amt" value="<?php  if(!empty($completion_of_topmost_slab_amt)){ echo round($completion_of_topmost_slab_amt);  }else{ echo 5 ;  }  ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Brick Work,Plaster & Flooring</td>
                                            <td><input type="text" class="payment_tk form-control allowdecimalpoint" name="brick_work_amt" value="<?php  if(!empty($paint_stage_amt)){ echo round($paint_stage_amt) ;  }else{ echo 5;  }  ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of Sanitary Fitting & Paint</td>
                                            <td><input type="text"  class="payment_tk form-control allowdecimalpoint" name="paint_stage_amt" value="<?php  if(!empty($finishg_work_amt)){ echo round($finishg_work_amt);  }else{ echo 5 ;  }  ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Completion of MEP & Finishing Work</td>
                                            <td><input type="text"  class="payment_tk form-control allowdecimalpoint" name="finishg_work_amt" value="<?php  if(!empty($possesion_amt)){ echo round($possesion_amt);  }else{ echo 10 ;  }  ?>"><span class="percentage_s">%</span></td>
                                        </tr>
                                        <tr>
                                            <td>On Handover/Possesion</td>
                                            <td><input type="text" class="payment_tk form-control allowdecimalpoint" name="possesion_amt" value="<?php  if(!empty($possesion_amt)){ echo round($possesion_amt);  }else{ echo 5 ;  }  ?>"><span class="percentage_s">%</span></td>
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
                                            <td><input type="text" class="form-control" name="cheque[]"  value="<?php echo $row->cheque_no  ;  ?>" ></td>
                                            <td><input type="text" class="form-control datepicker" name="paymentdate[]" value="<?php echo $row->date  ;  ?>" onkeydown="return false"></td>
                                            <td><input type="text" class="form-control" name="bank_details[]" value="<?php echo $row->bank_branch  ;  ?>"></td>
                                            <td><input type="text" class="form-control allowdecimalpoint paymentdue" name="amount[]" value="<?php echo $row->amount  ;  ?>"><a href="javascript:void(0);" class="remCF">x</a></td>
                                            </tr>
                                    <?php  $i++; }  }  ?>
                                        <tr>
                                            <td><?php   if(isset($i)){ echo $i ; }else{ echo 1; }?>.</td>
                                            <td><input type="text" class="form-control" name="cheque[]" ></td>
                                            <td><input type="text" class="form-control datepicker" name="paymentdate[]" onkeydown="return false"></td>
                                            <td><input type="text" class="form-control" name="bank_details[]"></td>
                                            <td><input type="text" class="form-control allowdecimalpoint paymentdue" name="amount[]"><a href="javascript:void(0);"
                                                    class="addCF">+</a></td>

                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" style="text-align: right;">Total Received Payment</td>
                                            <td><input type="text" class="form-control total_received"
                                                    style="border: none;border-bottom: 1px solid #ddd;" name="total_received_payment" value="<?php  if(!empty($total_received_amt)){ echo $total_received_amt ;  } ?>"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <input type="text" class="form-control"
                                                    style="border: none;border-bottom: 1px solid #ddd;"
                                                    placeholder="Rupees(in Words)" name="rupee_in_word" value="<?php  if(!empty($rupee_in_word)){ echo $rupee_in_word ;  } ?>">
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
                                    <li>The above quotation id valid for <input type="text" class="allownumber"  name="valid_days" value="<?php  if(!empty($valid_days)){ echo $valid_days ;  } ?>"> days only.</li>
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
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom: 25px;">
                                <div class="form-group col-md-6">
                                    <label class="col-sm-4">Attended By :</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control"
                                            style="border: none;border-bottom: 1px solid #ddd;"  name="attendedby" value="<?php  if(!empty($attended_by)){ echo  $attended_by ;  } ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group  col-md-12">
                                    <div class="col-md-12 file_upload">
                                        <div class="file-upload-wrapper" data-text-upload="Upload Document">
                                            <input  type="file" name="purchaser_signature" class="file-upload-field"
                                                value="">
                                        </div>
                                    </div>
                                    <label class="col-sm-12">Purchaser Sign</label>
									<?php if(!empty($purchaser_signature_path)){ $url="uploads/booking/purchaser_signatory/".$purchaser_signature_path ;   }else{ if(!empty($id)){ $url="assets/assets/images/no_image.jpg";  } }   ?>
                                       <?php  if(!empty($url)){  ?>
                                        <img height="100px" width="160px" src="<?=base_url().$url?>">
										<?php   }     ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group col-md-12">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control"
                                            style="border: none;border-bottom: 1px solid #ddd;" name="witness" value="<?php  if(!empty($witness)){ echo $witness ;  } ?>">
                                    </div>
                                    <label class="col-sm-12">Witness</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group col-md-12">
                                    <div class="col-md-12 file_upload">
                                        <div class="file-upload-wrapper" data-text-upload="Upload Document">
                                            <input  type="file" class="file-upload-field" value="<?php  if(!empty($witness)){ echo $witness ;  } ?>"  name="authorised_signatory">
                                        </div>
                                    </div>
                                    <label class="col-sm-12" style="padding-right: 0px;">Authorised Signatory with
                                        company seal</label>
										<?php if(!empty($authorized_signatory)){ $url="uploads/booking/authorized_signatory/".$authorized_signatory ;   }else{ if(!empty($id)){$url="assets/assets/images/no_image.jpg"; } }   ?>
										<?php  if(!empty($url)){  ?>
                                        <img height="100px" width="160px" src="<?=base_url().$url?>">
										<?php   }       ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn bg-navy btn-flat" id="booking">
                                Save </button>
                        </div>
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
<script>
$(document).on('focus',".datepicker", function(){
    $(this).datepicker({ todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd',    });
});
$(function() {
    $('.datepicker1').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd',
    });
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
</script>
<script>
$('input[type="checkbox"]').on('change', function() {
    $('input[type="checkbox"]').not(this).prop('checked', false);
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#my-select').multiselect();
});
</script>
<script>
$(document).ready(function() {
    var i =<?php   if(isset($i)){ echo $i+1 ; }else{ echo 2; }?>;
    $(".addCF").on('click', function() { 
        var data = '<tr><td>' + i + '.</td><td><input type="text" class="form-control" name="cheque[]"></td><td><input type="text" class="form-control datepicker" name="paymentdate[]"  onkeydown="return false"></td><td><input type="text" class="form-control" name="bank_details[]"></td><td><input type="text" class="form-control allowdecimalpoint paymentdue" name="amount[]"><a href="javascript:void(0);" class="remCF">x</a></tr>';
        $('#customFields').append(data);
        i++;
		$(document).on('click', '.remCF' ,function(){
       // $(".remCF").on('click', function() {
            $(this).parent().parent().remove();
			 calculatetotal();
        });
    });

});
</script>
<script>
$(".file_upload").on("change", ".file-upload-field", function() {
    $(this).parent(".file-upload-wrapper").attr("data-text-upload", $(this).val().replace(/.*(\/|\\)/, ''));
});
$(document).ready(function() {
    $('.select2').select2();
});
$(document).ready(function() {
	 $('.payment_tk').attr('readonly', true);
	$('.scheduletype').on('ifChanged', function(event){
	 if(this.value ==1){
		 $('.payment_tk').attr('readonly', false);
	 }else{
		 $('.payment_tk').attr('readonly', true);
	 }
});
});
$(document).ready(function(){
	$(document.body).on('blur', '.paymentdue' ,function(){
  //$(".paymentdue").blur(function(){
   calculatetotal();
  });
});
function calculatetotal(){
	var sum = 0;
    $('.paymentdue').each(function() {
        sum += Number($(this).val());
    });
$(".total_received").val(sum);
}
</script>
<script>
$('form').attr('autocomplete', 'off');
</script>