<link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.css')?>">
<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css"> 
<style>
.error{
    color: #FF0000;
}
#gender-error{
width:200px;
padding-top:15px;
}
</style>         

  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/employees') ?>"> <?php echo lang('Employee_salary')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>


<section class="content">
    	 
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  	 <div class="box-header">
                  <h3 class="box-title"><?php echo lang('employee_form'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					
				<form method="post" action="<?php echo site_url('admin/employees/Employee_salary_form/'.$id); ?>" enctype="multipart/form-data" id="signup_form">	
			  <div class="box-body">
			     <div class="form-group">
                  <label for="Employee_Names"> <span style="color:red;">*</span><?php echo lang('Employee_Names'); ?> :</label>
                <select class="form-control employee" name="employee">
				<option>Select</option>
				<?php
				if(isset($employees)){
					foreach($employees as $employee)
					{
				?>
				<option value="<?php echo $employee->id ;  ?>" <?php if(!empty($Employee_id)) echo $Employee_id == $employee->id  ? 'selected':''   ?>><?php  echo $employee->firstname ;  ?></option>	
				<?php
					}
				}
				?>
				</select>
              </div>
		  
		     <div class="form-group">
                <label for="Select_month"> <span style="color:red;">*</span><?php echo lang('Select_month'); ?> :</label>
              <input type="text" name="select_month" value="<?php if(isset($Select_month)){  echo $Select_month;  }  ?>" class="form-control datepicker1" autocomplete="off">
             </div>
		     <div class="form-group">
            <label for="Amount"> <span style="color:red;">*</span><?php echo lang('Amount'); ?> :</label>
          <input type="text" name="Amount" value="<?php if(isset($Amount)){  echo $Amount;  }  ?>" class="form-control " autocomplete="off">
          </div>
		  
		      <div class="form-group">
            <label for="Issue_date"> <span style="color:red;">*</span><?php echo lang('Issue_date'); ?> :</label>
          <input type="text" name="issuedate" value="<?php if(isset($Issued_date)){  echo $Issued_date;  }  ?>" class="form-control datepicker" autocomplete="off">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
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
	$(function() {
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