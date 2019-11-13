<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
       <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-3.3.2.min.js" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<style>
.error{
    color: #FF0000;
}
</style>    
  <?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/sales/Sales/Agentform') ?>"> <?php echo lang('Agent')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>
	<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  	 <div class="box-header">
                  <h3 class="box-title"><?php echo lang('agent_form'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                <form method="post" action="<?php echo site_url('admin/sales/Sales/Agentform/'.$agentid); ?>" enctype="multipart/form-data" id="enquiryform">	
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('name') ?></label> <span style="color:red">*</span>
                      	</div>
						<div class="col-md-3">
							<input type="text" name="name" class="form-control" value="<?php if(isset($name)){ echo $name;  }   ?>" autocomplete="off">
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('agent_type') ?>
                      	</div>
						<div class="col-md-3">
							<select name="agenttype" class="form-control" >
								<option value="">Select</option>
								<option value="<?php echo lang('sales_excutive') ?>" <?php  if(isset($agenttype)){ echo $agenttype == 'Sales excutive' ?'selected':'' ;  } ?> ><?php echo lang('sales_excutive') ?></option>	
								<option value="<?php echo lang('sales_agent') ?>" <?php  if(isset($agenttype)){ echo $agenttype == 'Sales Agent' ?'selected':'' ;  } ?> ><?php echo lang('sales_agent') ?></option>
							</select>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('position') ?></label>
                      	</div>
						<div class="col-md-3">
						<input type="text" name="position" autocomplete="off" class="form-control" value="<?php if(isset($position)){ echo $position;  }   ?>">
						</div>	
						<div class="col-md-2">
                      		<label><?php echo lang('mobile') ?></label><span style="color:red"> *</span>
                      	</div>
						
						<div class="col-md-3">
							<input type="text" name="mobile" autocomplete="off" class="form-control allownumber" value="<?php if(isset($mobile)){ echo $mobile;  }   ?>">
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('email') ?></label>
                      	</div>
						<div class="col-md-3">
								  <input type="text"  name="email" class="form-control"   autocomplete='off' value="<?php if(isset($email)){ echo $email;  }   ?>">
								</div>
						<div class="col-md-2">
                      		<label><?php echo lang('address') ?></label>
                      	</div>
						<div class="col-md-3">
							<input type="text" autocomplete="off" name="address" class="form-control" value="<?php if(isset($address)){ echo $address;  }   ?>">
						</div>	
					  </div>		
                    </div>
                    <div class="form-group">
					  <div class="row">
						
						
						<div class="col-md-2">
                      		<label><?php echo lang('Agent_commision') ?></label>
                      	</div>
						<div class="col-md-3">
							<input type="text" name="sales_commission" class="form-control" value="<?php if(isset($sales_commission)){ echo $sales_commission;  }   ?>">
						</div>	
					  </div>		
                    </div>
                    <input type="hidden" value="<?php if(isset($agentid)){ echo $agentid;  }   ?>" name="agentid">
						
                  
                    </div>
					<div class="box-footer">
							<input class="btn btn-primary" type="submit" id="enquiry" value="Save"/>
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