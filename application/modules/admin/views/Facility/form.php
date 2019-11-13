<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js"></script>
<script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-select.min.js"></script>
  <style>
  
  </style>
  <?php  $seg= $this->uri->segment(4);?>
   <section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Facility') ?>"> <?php echo lang('Facility')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
	</section>
      <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/Facility/form/'.$id); ?>" enctype="multipart/form-data">	
		  <div class="box-body">
          <div class="form-group col-md-6">
            <label for="Facility_name"> <span style="color:red;">*</span><?php echo lang('Facility_name'); ?> :</label>
            <input type="text" name="Facility_name" value="<?php if(isset($Facility_name)){ echo $Facility_name; } ?>"  class="form-control" />
          </div>
		  
          <div class="form-group col-md-6">
            <label for="Charge"> <span style="color:red;">*</span><?php echo lang('Charges'); ?> :</label>
            <input type="text" name="Charge" value="<?php if(isset($Charges)){ echo $Charges; } ?>"  class="form-control" />
          </div>
          <div class="form-group col-md-6">
            <label for="Per"> <span style="color:red;">*</span><?php echo lang('Charges_per'); ?> :</label>
            <select class="form-control" name="Per">
		     <option ><?php echo lang('select');  ?></option>
		   <option value="<?php echo lang('Per_hours'); ?>" <?php if(!empty($Charges_per)) echo $Charges_per ==    lang('Per_hours') ? 'selected':''   ?>><?php echo lang('Per_hours');  ?></option>
		     <option value="<?php echo lang('Per_Day'); ?>" <?php if(!empty($Charges_per)) echo $Charges_per == lang('Per_Day') ?'selected':''  ?>><?php echo lang('Per_Day'); ?></option>
		   </select>
          </div>
		   <div class="form-group col-md-6">
            <label for="Status"> <span style="color:red;">*</span><?php echo lang('Status'); ?> :</label>
           <select class="form-control" name="Status">
		     <option ><?php echo lang('select');  ?></option>
		   <option value="<?php echo lang('Available'); ?>" <?php if(!empty($Status)) echo $Status ==    lang('Available') ? 'selected':''   ?>><?php echo lang('Available');  ?></option>
		     <option value="<?php echo lang('Open_shortly'); ?>" <?php if(!empty($Status)) echo $Status == lang('Open_shortly') ?'selected':''  ?>><?php echo lang('Open_shortly'); ?></option>
			 <option value="<?php echo lang('Temporary'); ?>" <?php if(!empty($Status)) echo $Status == lang('Temporary') ?'selected':''  ?>><?php echo lang('Temporary'); ?></option>
			 <option value="<?php echo lang('Permanent'); ?>" <?php if(!empty($Status)) echo $Status == lang('Permanent') ?'selected':''  ?>><?php echo lang('Permanent'); ?></option>
		   </select>
		   <input type="hidden" name="ids" value="<?php if(isset($complain_id)){ echo $complain_id; }  ?>">
          </div>
		  <div class="form-group col-md-6">
            <label for="Booking_status"> <span style="color:red;">*</span><?php echo lang('Booking_status'); ?> :</label>
           <select class="form-control" name="Booking_status">
		     <option ><?php echo lang('select');  ?></option>
		   <option value="<?php echo lang('Available'); ?>" <?php if(!empty($Booking_status)) echo $Booking_status ==    lang('Available') ? 'selected':''   ?>><?php echo lang('Available');  ?></option>
		     <option value="<?php echo lang('Not_Available'); ?>" <?php if(!empty($Booking_status)) echo $Booking_status == lang('Not_Available') ?'selected':''  ?>><?php echo lang('Not_Available'); ?></option>
		   </select>
          </div>
		  <div class="form-group col-md-6">
            <label for="Contact"> <span style="color:red;">*</span><?php echo lang('Contact_details'); ?> :</label>
            <textarea name="Contact"  class="form-control"><?php if(isset($Contact)){ echo $Contact; } ?></textarea>
          </div>
		    <div class="form-group col-md-6">
            <label for="Comments"> <span style="color:red;">*</span><?php echo lang('Comments'); ?> :</label>
            <textarea name="Comments"  class="form-control"><?php if(isset($Comments)){ echo $Comments; } ?></textarea>
          </div>
		  <div class="form-group col-md-6">
            <label for="maintenance_by"> <span style="color:red;">*</span><?php echo lang('maintenance_by'); ?> :</label>
           <!-- <textarea name="maintenance_by"  class="form-control"><?php if(isset($maintenance_by)){ echo $maintenance_by; } ?></textarea>-->
		   <select class="form-control chosen">
		   <option  value="">Select</option>
		   <?php   if(isset($service_provider)){  foreach($service_provider as $item){ ?>
		   <option   value="<?php  echo $item->service_provider_id  ; ?>"><?php  echo $item->sp_name  ; ?></option>
		   <?php    }  }?>
		   </select>
          </div>
		  <div class="form-group col-md-6">
            <label for="mananged_by"> <span style="color:red;">*</span><?php echo lang('mananged_by'); ?> :</label>
            <textarea name="mananged_by"  class="form-control"><?php if(isset($mananged_by)){ echo $mananged_by; } ?></textarea>
          </div>
           </div>			
			<div class="box-footer">
			  <input type="hidden" name="ids" value="<?php if(isset($Fac_id)){ echo $Fac_id; }  ?>">
			<input class="btn btn-primary" type="submit" value="Save"/>
					</div>
					</form>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
		 
</section>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
    $('#my-select').multiselect();
  });
 </script>
 <script>
 $(function() {
 $('.datepicker').datepicker({
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
