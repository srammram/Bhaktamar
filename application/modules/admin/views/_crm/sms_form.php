
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
         <?php echo lang('sms'); ?>
     </h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard')?></a></li>
         <li><a href="<?php echo site_url('admin/crm/Crm/sms') ?>"> <?php echo lang('sms')?> </a></li>
         
     </ol>
 </section>
 <section class="content">
     <div class="row">
         <div class="col-xs-12">
             <div class="box">
                 <div class="box-header">
                     <h3 class="box-title"><?php echo lang('sms'); ?></h3>
                 </div><!-- /.box-header -->
                 <div class="box-body">
                    <div class="col-xs-6">
                     <form method="post" id="smsform"action="<?php echo site_url('admin/crm/Crm/send_sms/'); ?>"
                         enctype="multipart/form-data" id="enquiryform">
                         <div class="row">
                         <div class="form-group col-md-12">
                             <label><?php echo lang('campaign') ?></label><span style="color:red"> *</span>
                             <select name="campaignid" class="form-control" onchange="get_leads(this.value)">
                                 <option value="">Select</option>
                                 <?php if(isset($campaignlist)){ foreach($campaignlist as $row){ ?>
								 <option value="<?php  echo $row->id   ?>"><?php  echo $row->campaign_name  ?></option> <?php } } ?>    
                             </select>
                         </div>
                         <div class="form-group col-md-12">
                             <label><?php echo lang('purpose') ?></label>
                             <input type="text" name="purpose" class="form-control " autocomplete='off'
                                 value="<?php if(isset($purpose)){ echo $purpose;  }   ?>">
                         </div>
                         <div class="form-group col-md-12">
                             <label><?php echo lang('message') ?></label>
                             <textarea name="message" autocomplete="off"
                                 class="form-control"><?php if(isset($description)){ echo $description;  }   ?></textarea>
							 </div>
							 <div class="form-group col-md-12">
                             <label><?php echo lang('send_to') ?></label>
                              <div class="send_to">
							 </div>
							 </div>
							 </div>
							 </div>
         </div>
         <div class="box-footer">
             <input class="btn btn-primary sendsms" type="submit" id="enquirybtn" value="Send SMS" />
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
 $(".sendsms").click(function() {
    $("#smsform").validate({
        excluded: ':disabled',
        rules: {
           
            campaignid: {
                required: true,

            },
            message: {
                required: true,

            }
        },
        messages: {
            dob: {
                required: "Please enter you date of birth.",
                minAge: "You are not old enough(18<)!"
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.form-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});
 </script>
