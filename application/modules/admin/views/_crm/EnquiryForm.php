 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js">
 </script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
 <style>
.btn-group {
    width: 100%;
}

.multiselect {
    width: 100%;
}

.multiselect-container {
    width: 100%;
}

.error {
    color: #FF0000;
}

.datepicker td,
.datepicker th {
    width: 1.5em;
    height: 1.5em;
}
 </style>
 <?php   $seg= $this->uri->segment(5);?>
 <section class="content-header">
     <h1>
         <?php echo lang('enquirs_form'); ?>
     </h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard')?></a></li>
         <li><a href="<?php echo site_url('admin/crm/Crm/Enquiry') ?>"> <?php echo lang('Enquiry')?> </a></li>
         <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
     </ol>
 </section>
 <section class="content">
     <div class="row">
         <div class="col-xs-12">
             <div class="box">
                 <div class="box-header">
                     <h3 class="box-title"><?php echo lang('enquirs_form'); ?></h3>
                 </div><!-- /.box-header -->
                 <div class="box-body">
                     <form method="post" action="<?php echo site_url('admin/crm/Crm/Enquiryform/'.$enquiry_id); ?>"
                         enctype="multipart/form-data" id="enquiryform">
                         <div class="form-group col-md-5">
                             <label><?php echo lang('Customer_name') ?></label> <span style="color:red">*</span>
                             <!--	<input class="checkbox_s is_display1" value="1" name="is_display1"type="checkbox" <?php if(isset($is_display1)){if($is_display1 == 1){  echo 'checked';  } }   ?>  />-->

                             <input type="text" autocomplete="off" name="Customername" class="form-control"
                                 value="<?php if(isset($customer_name)){ echo $customer_name;  }   ?>">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('Customer_name2') ?></label> <span style="color:red">*</span>
                             <!--<input class="checkbox_s is_display2" value="1" name="is_display2"type="checkbox" <?php if(isset($is_display2)){if($is_display2 == 1){  echo 'checked';  } }   ?>  />-->
                             <input type="text" autocomplete="off" name="Customername2" class="form-control"
                                 value="<?php if(isset($customername2)){ echo $customername2;  }   ?>">
                         </div>

                         <div class="form-group col-md-5">
                             <label><?php echo lang('NationalId') ?></label>
                             <input type="text" name="NationalId" class="form-control " autocomplete='off'
                                 value="<?php if(isset($NationalId)){ echo $NationalId;  }   ?>">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('NationalId2') ?></label>
                             <input type="text" name="NationalId2" class="form-control " autocomplete='off'
                                 value="<?php if(isset($NationalId2)){ echo $NationalId2;  }   ?>">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('DOB') ?></label>
                             <input type="text" name="dob" class="form-control datepicker" autocomplete='off'
                                 value="<?php if(isset($dob)){ echo $dob;  }   ?>" onkeydown="return false">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('DOB2') ?></label>
                             <input type="text" name="dob2" class="form-control datepicker" autocomplete='off'
                                 value="<?php if(isset($dob2)){ echo $dob2;  }   ?>" onkeydown="return false">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('Contact_number') ?></label><span style="color:red"> *</span>
                             <input type="text" name="contactnumber" class="form-control allownumber" autocomplete='off'
                                 value="<?php if(isset($contact_number)){ echo $contact_number;  }   ?>">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('email') ?></label>
                             <input type="text" name="email" class="form-control " autocomplete='off'
                                 value="<?php if(isset($email)){ echo $email;  }   ?>">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('Customer_address1') ?></label>
                             <textarea autocomplete="off" name="address1"
                                 class="form-control"><?php if(isset($address)){ echo $address;  }   ?></textarea>
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('Customer_address2') ?></label>
                             <textarea name="address2" autocomplete="off"
                                 class="form-control"><?php if(isset($customeraddress2)){ echo $customeraddress2;  }   ?></textarea>
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('Project') ?></label><span style="color:red"> *</span>
                             <select name="project" class="form-control" onchange="get_units(this.value)">
                                 <option value="">Select</option>
                                 <?php if(isset($projects)){ foreach($projects as $project){ ?>
                                 <option value="<?php  echo $project->id   ?>"
                                     <?php  if(isset($project_id)){ echo $project_id == $project->id ?'selected':'' ;  } ?>>
                                     <?php  echo $project->Name  ?></option> <?php } } ?>
                             </select>
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('Type_for') ?></label>
                             <select name="pertypes[]"  multiple="multiple" 
                                 class="form-control my-select">
                                 <option value="">Select</option>
                                 <?php  if(isset($type)){ foreach($type as $row){ $selected = in_array( $row->id, $ptype ) ? ' selected="selected" ' : '';   ?>
                                 <option value="<?php  echo $row->id   ?>"<?php echo $selected; ?>>
                                     <?php  echo $row->unit_group_type  ?></option>
                                 <?php }  } ?>
                             </select>
                         </div>

                         <div class="form-group col-md-5">
                             <label><?php echo lang('Units') ?></label>
                             <select name="units" class="form-control" id="units">
                                 <option value="">Select</option>
                                 <?php 
								if(isset($unitslists)){ foreach($unitslists as $unitslist){ ?>
                                 <option value="<?php  echo $unitslist->uid   ?>"
                                     <?php  if(isset($unit)){ echo $unit == $unitslist->uid ?'selected':'' ;  } ?>>
                                     <?php  echo $unitslist->unit_no  ?></option>
                                 <?php } } ?>
                             </select>
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('Enquiry_date') ?></label><span style="color:red"> *</span>
                             <input type="text" name="Enquiry_date" class="form-control datepicker" autocomplete='off'
                                 value="<?php if(isset($enquiry_date)){ echo $enquiry_date;  }   ?>"
                                 onkeydown="return false">
                         </div>

                         <div class="form-group col-md-5">
                             <label><?php echo lang('Budget') ?></label>
                             <input type="text" name="Budget" autocomplete='off' class="form-control"
                                 value="<?php if(isset($Budget)){ echo $Budget;  }   ?>">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('Suggets_modification') ?></label>
                             <select name="suggestsmodification[]" multiple="multiple" id="my-select"
                                 class="form-control my-select">
                                 <option>Select</option>
                                 <?php 
								if(isset($Amenities)){  foreach($Amenities as $Amenitie){ $selected = in_array( $Amenitie->id, $suggest_modification ) ? ' selected="selected" ' : '';  ?>
                                 <option value="<?php  echo $Amenitie->id   ?>" <?php echo $selected; ?>>
                                     <?php  echo $Amenitie->Name  ?></option>
                                 <?php } } ?>
                             </select>
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('occupation') ?> </label>
                             <input type="text" name="occupation" autocomplete='off' class="form-control"
                                 value="<?php if(isset($occupation)){ echo $occupation;  }   ?>">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('Location_preference') ?></label>
                             <input type="text" name="locationpreference" autocomplete='off' class="form-control"
                                 value="<?php if(isset($location_preference)){ echo $location_preference;  }   ?>">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('select_country') ?></label>
                             <select name="country" class="form-control">
                                 <option>Select</option>
                                 <?php  if(isset($countries)){ foreach($countries as $country){ ?>
                                 <option value="<?php  echo $country->id   ?>"
                                     <?php  if(isset($country_id)){ echo $country_id == $country->id ?'selected':'' ;  } ?>>
                                     <?php  echo $country->name  ?></option> <?php } } ?>
                             </select>
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('City') ?></label>

                             <input type="text" name="city" class="form-control " autocomplete='off'
                                 value="<?php if(isset($city)){ echo $city;  }   ?>">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('SalesPersontype') ?></label>
                             <select name="salespersontype" class="form-control" onchange="get_agent(this.value)">
                                 <option>Select</option>
                                 <option value="<?php echo lang('Executive')  ?>"
                                     <?php  if(isset($SalesPersontype)){ echo $SalesPersontype == lang('Executive')  ?'selected':'' ;  } ?>>
                                     <?php echo lang('Executive')  ?></option>
                                 <option value="<?php echo lang('Agent')  ?>"
                                     <?php  if(isset($SalesPersontype)){ echo $SalesPersontype == lang('Agent') ?'selected':'' ;  } ?>>
                                     <?php echo lang('Agent')  ?></option>
                                 <option value="<?php echo lang('pmc')  ?>"
                                     <?php  if(isset($SalesPersontype)){ echo $SalesPersontype == lang('pmc') ?'selected':'' ;  } ?>>
                                     <?php echo lang('pmc')  ?></option>
                             </select>
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('SalesPerson') ?></label>
                             <select name="salesperson" class="form-control" id="salesperson">
                                 <?php  if(isset($salespersons)){ foreach($salespersons as $salesperson){ ?>
                                 <option value="<?php  echo $salesperson->id   ?>"
                                     <?php  if(isset($Agent_id)){ echo $Agent_id == $salesperson->id ?'selected':'' ;  } ?>>
                                     <?php  echo $salesperson->Name  ?></option>
                                 <?php } } ?>
                             </select>

                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('remarks') ?></label>
                             <textarea name="remarks" autocomplete="off"
                                 class="form-control"><?php if(isset($remarks)){ echo $remarks;  }   ?></textarea>
                         </div>
                         <br>
                         <br>
                         <br>
                         <div class="form-group">
                             <div class="row">
                                 <div class="col-md-2 col-md-offset-1"><span style="color:red"> *</span>
                                     <input class="checkbox_s status" value="1" name="status" type="radio"
                                         <?php if(isset($enquiry_status)){if($enquiry_status == 1){  echo 'checked';  } }   ?> />
                                     <label><?php echo lang('Follow_up') ?></label>
                                 </div>
                                 <div class="col-md-2">
                                     <input class="checkbox_s status" value="2" name="status" type="radio"
                                         <?php if( isset($enquiry_status)){if($enquiry_status == 2){  echo 'checked' ;  }  } ?>>
                                     <label><?php echo lang('Trash') ?></label>
                                     <input type="hidden"
                                         value="<?php if(isset($enquiry_id)){ echo $enquiry_id;  }   ?>"
                                         name="enquiry_id">
                                 </div>
                                 <!-- /.input group -->
                             </div>
                         </div>
                 </div>
                 <div class="box-footer">
                     <input class="btn btn-primary" type="submit" id="enquirybtn" value="Save" />
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