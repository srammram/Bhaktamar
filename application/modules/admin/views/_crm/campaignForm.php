
  <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery1.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/select2.min.js"></script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap3.3.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/select2.min.css">
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
         <?php echo lang('campaign_form'); ?>
     </h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard')?></a></li>
         <li><a href="<?php echo site_url('admin/crm/Crm/campaign') ?>"> <?php echo lang('campaign')?> </a></li>
         <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
     </ol>
 </section>
 <section class="content">
     <div class="row">
         <div class="col-xs-12">
             <div class="box">
                 <div class="box-header">
                     <h3 class="box-title"><?php echo lang('campaign_form'); ?></h3>
                 </div><!-- /.box-header -->
                 <div class="box-body">
                    <div class="col-xs-12">
                     <form method="post" action="<?php echo site_url('admin/crm/Crm/campaignForm/'.$id); ?>"
                         enctype="multipart/form-data" id="enquiryform">
                         <div class="row">
                         <div class="form-group col-md-5">
                             <label><?php echo lang('campaign_name') ?></label> <span style="color:red">*</span>
                             <input type="text" autocomplete="off" name="campaign_name" class="form-control"
                                 value="<?php if(isset($campaign_name)){ echo $campaign_name;  }   ?>">
                         </div>
                         <div class="form-group col-md-5">
                             <label><?php echo lang('purpose') ?></label>
                             <input type="text" name="purpose" class="form-control " autocomplete='off'
                                 value="<?php if(isset($purpose)){ echo $purpose;  }   ?>">
                         </div>
                         </div>
                          <div class="row">
                         <div class="form-group col-md-5">
                             <label><?php echo lang('created_by') ?></label><span style="color:red"> *</span>
                             <select name="created_by" class="form-control" >
                                 <option value="">Select</option>
                                 <?php if(isset($employee)){ foreach($employee as $row){ ?>
                                 <option value="<?php  echo $row->id   ?>"
                                     <?php  if(isset($created_by)){ echo $created_by == $row->id ?'selected':'' ;  } ?>>
                                     <?php  echo $row->first_name  ?></option> <?php } } ?>
                             </select>
                         </div>
                         
                         <div class="form-group col-md-5">
                             <label><?php echo lang('leads') ?></label>
                             <select name="leads[]" multiple="multiple" class="form-control my-select">
                                 <option value="">Select</option>
                                 <?php  if(isset($leads)){ foreach($leads as $row){ $selected = in_array( $row->enquiry_id, $members ) ? ' selected="selected" ' : '';   ?>
                                 <option value="<?php  echo $row->enquiry_id   ?>" <?php echo $selected; ?>>
                                     <?php  echo $row->Customer_name  ?></option>
                                 <?php }  } ?>
                             </select>
                         </div>
                         </div>
                        <div class="row">
                         <div class="form-group col-md-5">
                             <label><?php echo lang('description') ?></label>
                             <textarea name="description" autocomplete="off"
                                 class="form-control"><?php if(isset($description)){ echo $description;  }   ?></textarea>
							 </div>
							 </div>
                             <input type="hidden" value="<?php if(isset($id)){ echo $id;  }   ?>" name="id">
                         <!-- /.input group -->
         </div>
         <div class="box-footer">
             <input class="btn btn-primary" type="submit" id="enquirybtn" value="Save" />
         </div>
         </form>
     </div><!-- /.box-body -->
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
 <script>
$(".my-select").select2({
	placeholder: 'select',
});
</script>