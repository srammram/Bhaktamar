<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link href='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.css' rel='stylesheet'
    media='screen'>
<link href='<?php echo base_url('assets/admin')?>/plugins/select2/select2.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets/admin')?>/plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet'
    media='screen'>
<link href='<?php echo base_url()?>assets/assets/css/custom.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/daterangepicker/daterangepicker-bs3.css' rel='stylesheet'
    media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/datepicker/datepicker3.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/timepicker/bootstrap-timepicker.min.css' rel='stylesheet'
    media='screen'>
  <style>
  .btn-group
  {
	  width:100%;
  }
  .multiselect
    {
	  width:100%;
  }
  .multiselect-container
  {
	width:100%;  
  }
  </style>
  <?php  $seg= $this->uri->segment(4);?>
   <section class="content-header">
          <h1>
            &nbsp;
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/payroll/employee/addEmployee') ?>"> <?php echo lang('add_employee')?> </a></li>
            
          </ol>
	</section>
      <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
	 <?php echo form_open_multipart('admin/payroll/employee/changeApplicationStatus', array('class' => 'form-horizontal')) ?>

                                <div class="panel_controls">
								<div class="form-group margin">
                                        <label class="col-sm-3 control-label"><?= lang('employee_id') ?> :</label>
                                        <div class="col-sm-5" style="padding-top: 5px">
                                            <?php echo $application->employee_id ?>
											<input type="hidden" value="<?php    echo $application->emp_id; ?>" name="employeeid">
                                        </div>
                                    </div>
									 <div class="form-group margin">
                                        <label class="col-sm-3 control-label"><?= lang('employee_name') ?> :</label>
                                        <div class="col-sm-5" style="padding-top: 5px">
                                            <?php echo  $application->first_name.' '.$application->last_name ?>
                                        </div>
                                    </div>
                                    <div class="form-group margin">
                                        <label class="col-sm-3 control-label"><?= lang('leave_date') ?> :</label>
                                        <div class="col-sm-5" style="padding-top: 5px">
                                            <?php echo date(get_option('date_format'), strtotime($application->start_date)).' To '. date(get_option('date_format'), strtotime($application->end_date)) ?>
                                        </div>
                                    </div>

                                    <div class="form-group margin">
                                        <label class="col-sm-3 control-label"><?= lang('leave_type') ?> :</label>
                                        <div class="col-sm-5" style="padding-top: 5px">
                                            <?php echo $application->leave_category ?>
											<input type="hidden" value="<?php    echo $application->Leaveid; ?>" name="leaveid">
                                        </div>
                                    </div>

                                    <div class="form-group margin">
                                        <label class="col-sm-3 control-label"><?= lang('application_date') ?> :</label>
                                        <div class="col-sm-5" style="padding-top: 5px">
                                            <?php echo date(get_option('date_format'), strtotime($application->application_date)) ?>
                                        </div>
                                    </div>

                                    <div class="form-group margin">
                                        <label class="col-sm-3 control-label"><?= lang('status') ?> :</label>
                                        <div class="col-sm-3" style="padding-top: 5px">
                                            <select class="form-control status" name="status" >
                                                <option value="pending" <?php echo $application->status == 'Pending' ? 'selected':''  ?>>Pending</option>
                                                <option value="Accepted" <?php echo $application->status == 'Accepted' ? 'selected':''  ?>>Accepted</option>
                                                <option value="Rejected" <?php echo $application->status == 'Rejected' ? 'selected':''  ?>>Rejected</option>
                                            </select>
                                        </div>
                                    </div>
									 <div class="form-group margin">
                                        <label class="col-sm-3 control-label"><?= lang('Medical_Certificate') ?> :</label>
                                        <div class="col-sm-3" style="padding-top: 5px">
										<input type="hidden" value="<?php echo $application->id;  ?>" name="applicationid">
                                         
											 <?php 
											 if(empty($application->File_path_Url))
											 {?>
										 <div class="form-group">
                                   <div class="input-group">
                                     <input type="file" name="Certificate" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"  />
                                           <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>
                                   </div>
                                    </div>
                                      <span class="required">PDF and JPEG only</span>
											<?php }else
											{
											?>
											 <a href="<?php echo base_url().$application->File_path_Url ; ?>">
                                                <span class="glyphicon glyphicon-search"></span>
                                             </a>
											 <?php  
											}
											 ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $application->id?>">
                                    <div class="form-group no-print">
                                        <div class="col-sm-offset-3 col-sm-5">
                                            <button type="submit"  class="btn bg-olive btn-md btn-flat">  <?= lang('save') ?></button>
                                        </div>
                                    </div>
                                </div>
                           <?php echo form_close() ?>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
		 
</section>

<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.js'></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/select2/select2.full.min.js'></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/fullcalendar/fullcalendar.min.js'></script>
<script type="text/javascript" src="<?php echo base_url('assets/assets')?>/js/forms_validation.js"></script>
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
 
<script>
$('#month').data("DateTimePicker").hide();
</script>
