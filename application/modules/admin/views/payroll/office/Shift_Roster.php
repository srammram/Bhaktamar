<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/Shiftplanner.js"></script>
<link href='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets/admin')?>/plugins/select2/select2.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets/admin')?>/plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url()?>assets/assets/css/custom.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/daterangepicker/daterangepicker-bs3.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/datepicker/datepicker3.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/timepicker/bootstrap-timepicker.min.css' rel='stylesheet' media='screen'>
<style>
   .dataTables_filter {
   display: none;
   }
   .dataTables_info{
   display: none;
   }
	.multiselect-container.dropdown-menu {
    width: 200px;
    height: auto;
    overflow-x: hidden;
    overflow-y: auto;
    border: 1px solid #CCCCCC;
    padding: 5px;
	
} 
.multiselect-item.filter{display:none;}
	.multiselect-container.dropdown-menu > .active > a, .multiselect-container.dropdown-menu > .active > a:hover, .multiselect-container.dropdown-menu > .active > a:focus{color: #777;
    text-decoration: none;
    background-color: transparent;}
	.multiselect-container.dropdown-menu .input-group-addon{display: none;}
	.multiselect.dropdown-toggle{display: block;}
	.content-header{display:none;}
	#plannertable{height:250px;}
	
</style>

<script>
$(document).ready(function(){
 $('.framework').multiselect({
  nonSelectedText: 'Select Framework',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'200px'
 });});
 </script>

<section class="content-header">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/payroll/office/Shift_roster') ?>"> <?= lang('add_Shift_roster') ?> </a>
        </li>
    </ol>
</section>
<section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>
<div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box-content">
         <div class="box box-primary" data-collapsed="0">
            <div class="box-header with-border bg-primary-dark">
               <h3 class="box-title"><?= lang('Shift_calender') ?></h3>
            </div>
		<?php echo form_open('admin/payroll/Office/shift_Planner', array('class' =>'form-horizontal')) ?>
            <div class="panel-body">
               
               <div class="panel_controls">
                  <div class="form-group margin">
                     <label class="col-sm-3 control-label"><?= lang('date') ?><span class="required">*</span></label>
                     <div class="col-sm-5">
                        <div class="input-group">
                           <input type="text" name="date"  id="month"  class="form-control monthyear" value="<?php
                              if (!empty($months)) {
                                  echo date('Y-n', strtotime($months));
                              }
                              ?>" onkeydown="return false" >
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="field-1" class="col-sm-3 control-label"><?= lang('department') ?> <span class="required">*</span></label>
                     <div class="col-sm-5">
                        <select name="department_id" id="department" class="form-control" onchange="get_employee(this.value)">
                           <option value="" ><?= lang('select_department') ?>...</option>
                           <?php foreach ($all_department as $v_department) : ?>
                           <option value="<?php echo $v_department->id ?>"
                              <?php
                                 if (!empty($department_id)) {
                                     echo $v_department->id == $department_id ? 'selected' : '';
                                 }
                                   ?>
                             >
                              <?php echo $v_department->department ?>
                           </option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>  <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?= lang('employee') ?> <span class="required">*</span></label>

                                    <div class="col-sm-5">
                                        <select class="form-control select2" name="employee_id" id="employee" >
                                            <option value=""><?= lang('please_select') ?></option>
                                            <?php if(isset($employee)){ foreach($employee as $item){ ?>
                                                <option value="<?php echo $item->id ?>" >
                                                    <?php echo  $item->first_name.' '.$item->last_name ?>
                                                </option>
                                            <?php } } ?>
                                              <?php if(isset($employees)){  ?>
											  <option value="<?php echo $employees->id  ;  ?>" selected><?php echo $employees->first_name;   ?></option>
											  <?php    }   ?>
                                        </select>
                                    </div>
                                </div>
                     <div class="form-group">
                     <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-flat btn-md"><?= lang('go') ?></button>
							<a href="<?php  echo base_url(); ?>/admin/office/shift_Planner" class="btn bg-maroon btn-flat" id="cancelPersonal"  ><?= lang('Cancel') ?></a>
                     </div>
                  </div>
               </div>
              
            </div>
	  <?php echo form_close() ?>
         </div>
<br/>
<br/>
	   <?php    if(isset($employeeid)&& isset($months)){  ?>
					<div class="tab-pane fade active in" id="shift_update">
					<input type="hidden" id="currentdate" value="<?php  echo  $months;  ?>">
				  <input type="hidden" id="employeeid" value="<?php  echo  $employeeid;  ?>">
					<script src="<?php echo site_url('assets/js/Shiftplanner.js') ?>"></script>
          <div class="row">
           <div class="col-md-12">
        <!-- Calender Start from Here -->
        <div class="box"><!-- /primary heading -->
            <div id="portlet2" class="panel-collapse collapse in">
                <div class="box-body" style="">
                    <div id="calendar" class="col-centered"></div>
                    <!-- Modal -->
                    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                       <form class="addEvent form-horizontal" id="addEventForm">
                        <input type="hidden" name="employee_id" value="<?php echo $employeeid;  ?>" id="employee_id">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?= lang('Add_shift') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="color" class="col-sm-2 control-label"><?= lang('Shift_name') ?></label>
                                            <div class="col-sm-10">
                                                 <select name="shift[]" class="form-control select2" id="shift"   multiple style="width: 100%;">
                                                   <?php   if(isset($shifts)){ foreach($shifts as $shift){  ?>
												   <option value="<?php   echo $shift->id;  ?>"><?php  echo $shift->shift_name;  ?></option>
												   <?php   }  } ?>                </select>                                </div>
												   </div>
                                        <div class="form-group">            
										<label for="start" class="col-sm-2 control-label">Start date</label>
                                            <div class="col-sm-4">    
											<input type="text"  name="start" class="form-control" id="start" data-date-format="yyyy-mm-dd" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="addEvent" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form class="editEvent form-horizontal">
								 <input type="hidden" name="employee_id" value="<?php echo $employeeid;  ?>" id="employee_id">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Event</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="color" class="col-sm-2 control-label">Color</label>
                                            <div class="col-sm-10">
                                                 <select name="shift[]" class="form-control select2" id="shift"   multiple style="width: 100%;">
                                                   <?php   if(isset($shifts)){ foreach($shifts as $shift){  ?>
												   <option value="<?php   echo $shift->id;  ?>"><?php  echo $shift->shift_name;  ?></option>
												   <?php   }  } ?>
                                                </select>         
												</div>                                
												</div>                             
												<div class="form-group">
                                            <label for="start" class="col-sm-2 control-label">Start date</label>
                                            <div class="col-sm-4">
                                                <input type="text"  name="start" class="form-control" id="eStart" data-date-format="yyyy-mm-dd">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label class="text-danger"><input type="checkbox"  name="delete"><?= lang('Delete_shift') ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" class="form-control" id="id">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" id="editEvent" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
	<?php  } ?>
        </div>
    </div>
</div>
</section>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.js'></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/select2/select2.full.min.js'></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/fullcalendar/fullcalendar.min.js'></script>



<script>
	$('#month').on('changeDate',function(){
     $(this).datepicker('hide');
	});
</script>
<script>
	$('form').attr('autocomplete', 'off');
	</script>
	
	
	<script>
		$(".monthyear").datepicker( {
				format: "yyyy-mm",
				viewMode: "months",
				minViewMode: "months"
			});
	</script>