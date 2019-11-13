<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">  <?php  $seg= $this->uri->segment(4);?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
  <style>

  </style>
  <?php  $seg= $this->uri->segment(4);?>
   <section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Services') ?>"> <?php echo lang('Services')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
	</section>
      <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/Services/form/'.$id); ?>" enctype="multipart/form-data">	
		  <div class="box-body">
          <div class="form-group">
            <label for="Services_name"><?php echo lang('Services_name')?> :</label>
            <input type="text" name="Services_name" value="<?php if(isset($Service_name)){ echo $Service_name; } ?>"  class="form-control" />
          </div>
		  <?php $Services_duration;  ?>
		   <div class="form-group">
            <label for="Services_provider"><?php echo lang('Serv_Period')?> :</label>
           <select class="form-control" name="period">
		   <option>Select</option>
		   <option value="<?php echo lang('paid_hrs')  ?>"<?php if(!empty($Services_duration)) echo $Services_duration ==    lang('paid_hrs') ? 'selected':''   ?>><?php echo lang('paid_hrs')  ?></option>
		   <option value="<?php echo lang('paid_Days')  ?>"<?php if(!empty($Services_duration)) echo $Services_duration ==    lang('paid_Days') ? 'selected':''   ?>><?php echo lang('paid_Days')  ?></option>
		   <option value="<?php echo lang('paid_Weekly')  ?>"<?php if(!empty($Services_duration)) echo $Services_duration ==    lang('paid_Weekly') ? 'selected':''   ?>><?php echo lang('paid_Weekly')  ?></option>
		   <option value="<?php echo lang('paid_Monthly')  ?>"<?php if(!empty($Services_duration)) echo $Services_duration ==    lang('paid_Monthly') ? 'selected':''   ?>><?php echo lang('paid_Monthly')  ?></option>
		   <option value="<?php echo lang('paid_quarterly')  ?>"<?php if(!empty($Services_duration)) echo $Services_duration ==    lang('paid_quarterly') ? 'selected':''   ?>><?php echo lang('paid_quarterly')  ?></option>
		   <option value="<?php echo lang('paid_Halfly')  ?>"<?php if(!empty($Services_duration)) echo $Services_duration ==    lang('paid_Halfly') ? 'selected':''   ?>><?php echo lang('paid_Halfly')  ?></option>
		   <option value="<?php echo lang('paid_Year')  ?>"<?php if(!empty($Services_duration)) echo $Services_duration ==    lang('paid_Year') ? 'selected':''   ?>><?php echo lang('paid_Year')  ?></option>
		   </select>
          </div>
		   <div class="form-group">
            <label for="Services_provider"><?php echo lang('Service_type')?> :</label>
               <select class="form-control" name="Servicestype">
			   <option>Select</option>
		   <option value="<?php echo lang('Paid_services')  ?>"<?php if(!empty($SeviceType)) echo $SeviceType ==    lang('Paid_services') ? 'selected':''   ?>><?php echo lang('Paid_services')  ?></option>
		   <option value="<?php echo lang('UnPaid_services')  ?>"<?php if(!empty($SeviceType)) echo $SeviceType ==    lang('UnPaid_services') ? 'selected':''   ?>><?php echo lang('UnPaid_services')  ?></option>
		   </select>
          </div>
          <div class="form-group">
            <label for="Services_provider"><?php echo lang('Services_provider')?> :</label>
            <input type="text" name="Services_provider" value="<?php if(isset($Service_provider)){ echo $Service_provider; } ?>"  class="form-control" />
          </div>
		   <div class="form-group">
            <label for="Contact_number"><?php echo lang('Contact_number')?> :</label>
            <input type="text" name="Contact_number" value="<?php if(isset($Contact_number)){ echo $Contact_number; } ?>"  class="form-control" />
          </div>
		   <div class="form-group">
            <label for="Mobile"><?php echo lang('Mobile')?> :</label>
            <input type="text" name="Mobile" value="<?php if(isset($Mobile_number)){ echo $Mobile_number; } ?>"  class="form-control" />
          </div>
		   <div class="form-group">
            <label for="Email"><?php echo lang('Email')?> :</label>
            <input type="text" name="Email" value="<?php if(isset($Email)){ echo $Email; } ?>"  class="form-control" />
          </div>
		  <div class="form-group">
            <label for="C_person_name"><?php echo lang('C_person_name')?> :</label>
            <input type="text" name="C_person_name" value="<?php if(isset($Contact_person_name)){ echo $Contact_person_name; } ?>"  class="form-control" />
          </div>
		  
          <div class="form-group">
            <label for="Address"><?php echo lang('Address')?>:</label>
            <textarea name="Address"  class="form-control"><?php if(isset($Address)){ echo $Address; } ?></textarea>
			
          </div>
        </div>	
		<div class="box-footer">
				<input class="btn btn-primary" type="submit" value="Save"/>
		</div>
		</form>
	 </div><!-- /.box-body -->
  </div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row -->
</section>
		 
		
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>

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
	$('.datepicker1').datepicker({
      	todayHighlight: true,
		autoclose: true,
	   format: 'yyyy-mm',
    });
 	$('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
     });
	      });
 </script>
