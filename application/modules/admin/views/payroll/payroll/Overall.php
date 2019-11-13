<script type="text/javascript" src="<?php echo base_url()?>assets/assets/js/attendance.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>
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
.model-open {
    overflow: visible;
}

.btns {
    display: block;
    width: 115px;
    height: 25px;
    background: #3d9970 !important;
    padding: 10px;
    text-align: center;

    color: white;
    font-weight: bold;
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
}

.panel_controls label {
    height: 34px;
}

.tabbable {
    margin-top: 4%;
}

#tabs {
    background: #007b5e;
    color: #eee;
}

.tabs_sec_tab {
    position: relative;
    float: left;
    width: 100%;
    margin-top: 50px;
}

.nav-tabs>li>a {
    color: #24305E;
    cursor: default;

    border: 1px solid #605ca8;
    border-bottom-color: transparent;
}

.nav>li>a:focus,
.nav>li>a:hover {
    color: #fff;
    cursor: default;
    background-color: #24305E;
    border: 1px solid #605ca8;
    border-bottom-color: transparent;
    transition: all .2s ease-in;
}

.nav-tabs>li.active>a,
.nav-tabs>li.active>a:focus,
.nav-tabs>li.active>a:hover {
    color: #fff;
    cursor: default;
    background-color: #24305E;
    border: 1px solid #605ca8;
    border-bottom-color: transparent;
    transition: all .2s ease-in;
}

#tabs {
    background: #fff;
    color: #333;
    min-height: 400px;
    max-height: 100%;
    padding: 15px;
}

.btn-success {
    border-radius: 0px;
    margin-top: 1%;
    color: #24305E;
    font-weight: bold;
}
</style>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3" data-offset="0">
                <div class="wrap-fpanel" style="padding:32px;">
                    <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h3 class="box-title"><?= lang('Clear_attendance') ?></h3>
                        </div>
                        <div class="panel-body ">
                            <?php echo form_open('admin/payroll/payroll/Consolidateview', array('class' => 'form-horizontal review_attendance')) ?>
                            <div class="panel_controls">
                                <div class="form-group margin">
                                    <label class="col-sm-3 control-label"><?= lang('month') ?> <span
                                            class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <input type="text" name="month" id="date" class="form-control monthyear"
                                                value="<?php
                                                if (!empty($months)) {
                                                    echo date('Y-n', strtotime($months));
                                                }
                                                ?>">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?= lang('department') ?> <span
                                            class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <select class="form-control select2" name="department_id" id="department"
                                            onchange="get_employee(this.value)">
                                            <option value=""><?= lang('select_department') ?>...</option>
                                            <?php foreach ($department as $v_department) : ?>
                                            <option value="<?php echo $v_department->id ?>" <?php
                                                    if (!empty($department_id)) {
                                                       echo $v_department->id == $department_id ? 'selected' : '';
                                                }
                                  ?>>
                                                <?php echo $v_department->department ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="field-1"
                                        class="col-sm-3 control-label"><?= lang('employee_name') ?><span
                                            class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <select class="form-control select2" name="employee_id" id="employee">
                                            <option value=""><?= lang('please_select') ?></option>
                                            <?php foreach($employee as $item){ ?>
                                            <option value="<?php echo $item->id ?>">
                                                <?php echo  $item->first_name.' '.$item->last_name ?>
                                            </option>
                                            <?php } ?>
                                            <?php if(isset($employees)){  ?>
                                            <option value="<?php echo $employees->id  ;  ?>" selected>
                                                <?php echo $employees->first_name;   ?></option>
                                            <?php    }   ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" id="sbtn" name="sbtn" value="1"
                                            class="btn bg-olive btn-md btn-flat"><?= lang('go') ?></button>
                                        <a href="<?php  echo base_url(); ?>/admin/payroll/Consolidate"
                                            class="btn bg-maroon btn-flat" id="cancelPersonal"><?= lang('Cancel') ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php  if(isset($missedshift) || isset( $missedAttendance) || isset($lop) || isset($absent_Based_on_time_sheet) || isset($empSalary))  {

  $url = $this->input->get('tab');
        $pieces = explode("/", $url);
          $tab = $pieces[0];
		?>
        <div class="row">
            <div class="tabbable col-sm-12">
                <ul class="nav nav-tabs">
                    <li <?php   if(empty($tab)){echo ' class="active"'; }  ?>><a href="#shift_update"
                            data-toggle="tab"><?= lang('Shift_update') ?></a></li>
                    <li <?php   if($tab == 'Setattendance'){echo ' class="active"'; }  ?>><a href="#set_attendance"
                            data-toggle="tab"><?= lang('set_attendance') ?></a></li>
                    <li <?php   if($tab == 'reviewAttendance'){echo ' class="active"'; }  ?>><a href="#clear_attendance"
                            data-toggle="tab"><?= lang('Review_attendance') ?></a></li>
                    <li <?php   if($tab == 'Payment'){echo ' class="active"'; }  ?>><a href="#generate_payment"
                            data-toggle="tab"><?= lang('Generate_payment') ?></a></li>
                    <li <?php   if($tab == 'Payslip'){echo ' class="active"'; }  ?>><a href="#print_slip"
                            data-toggle="tab"><?= lang('print_payslip') ?></a></li>
                </ul>
                <!-----                shift update ---->
                <div class="tab-content" id="tabs">
                    <?php    if(isset($missedshift)){  ?>
                    <!--	<div class="tab-pane fade in <?php if(isset($missedshift)){ echo 'active'; }  ?>" id="shift_update">-->
                    <div class="tab-pane fade in <?php if(isset($missedshift)){ echo 'active'; }  ?>" id="shift_update">
                        <input type="hidden" id="currentdate" value="<?php  echo  $months;  ?>">
                        <input type="hidden" id="employeeid" value="<?php  echo  $employee_id;  ?>">
                        <script src="<?php echo site_url('assets/admin/dist/js/Shiftplanner_consolidate.js') ?>">
                        </script>
                        <button type="button" class="btn " style="float:right;" data-toggle="modal"
                            data-target="#overallshift"><?= lang('OverallShift') ?></button>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Calender Start from Here -->
                                <div class="box">
                                    <!-- /primary heading -->
                                    <div id="portlet2" class="panel-collapse collapse in">
                                        <div class="box-body" style="">
                                            <div id="calendar" class="col-centered"></div>
                                            <div class="modal fade" id="overallshift" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="addEvent form-horizontal" id="addEventForm">
                                                            <input type="hidden" name="employee_id"
                                                                value="<?php echo $employee_id;  ?>" id="employee_id">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    <?= lang('Add_shift') ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="color"
                                                                        class="col-sm-2 control-label"><?= lang('Shift_name') ?></label>
                                                                    <div class="col-sm-10">
                                                                        <select name="shift[]"
                                                                            class="form-control select2" id="shift"
                                                                            multiple style="width: 100%;">
                                                                            <?php   if(isset($shifts)){ foreach($shifts as $shift){  ?>
                                                                            <option
                                                                                value="<?php   echo $shift->id;  ?>">
                                                                                <?php  echo $shift->shift_name;  ?>
                                                                            </option>
                                                                            <?php   }  } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="start"
                                                                        class="col-sm-2 control-label"><?= lang('Month') ?></label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="shiftmonth"
                                                                            value="<?php echo date('Y-m',strtotime($months));  ?>"
                                                                            class="form-control" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal"><?= lang('close') ?></button>
                                                                <button type="submit" id="addshift"
                                                                    class="btn btn-primary"><?= lang('Savechanges') ?></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> <!-- Modal -->
                                            <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="addEvent form-horizontal" id="addEventForm">
                                                            <input type="hidden" name="employee_id"
                                                                value="<?php echo $employee_id;  ?>" id="employee_id">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    <?= lang('Add_shift') ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="color"
                                                                        class="col-sm-2 control-label"><?= lang('Shift_name') ?></label>
                                                                    <div class="col-sm-10">
                                                                        <select name="shift[]"
                                                                            class="form-control select2" id="shift"
                                                                            multiple style="width: 100%;">
                                                                            <?php   if(isset($shifts)){ foreach($shifts as $shift){  ?>
                                                                            <option
                                                                                value="<?php   echo $shift->id;  ?>">
                                                                                <?php  echo $shift->shift_name;  ?>
                                                                            </option>
                                                                            <?php   }  } ?> </select> </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="start"
                                                                        class="col-sm-2 control-label"><?= lang('startdate') ?></label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="start"
                                                                            class="form-control" id="start"
                                                                            data-date-format="yyyy-mm-dd" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal"><?= lang('close') ?></button>
                                                                <button type="submit" id="addEvent"
                                                                    class="btn btn-primary"><?= lang('Savechanges') ?></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="editEvent form-horizontal">
                                                            <input type="hidden" name="employee_id"
                                                                value="<?php echo $employee_id;  ?>" id="employee_id">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">
                                                                    <?= lang('Edit_shift') ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="col-sm-2 control-label"><?= lang('Shift_name') ?></label>
                                                                    <div class="col-sm-10">
                                                                        <select name="shift[]"
                                                                            class="form-control select2" id="shift"
                                                                            multiple style="width: 100%;">
                                                                            <?php   if(isset($shifts)){ foreach($shifts as $shift){  ?>
                                                                            <option
                                                                                value="<?php   echo $shift->id;  ?>">
                                                                                <?php  echo $shift->shift_name;  ?>
                                                                            </option>
                                                                            <?php   }  } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="start"
                                                                        class="col-sm-2 control-label"><?= lang('startdate') ?></label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" name="start"
                                                                            class="form-control" id="eStart"
                                                                            data-date-format="yyyy-mm-dd">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-offset-2 col-sm-10">
                                                                        <div class="checkbox">
                                                                            <label class="text-danger"><input
                                                                                    type="checkbox"
                                                                                    name="delete"><?= lang('Delete_shift') ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="id" class="form-control"
                                                                    id="id">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal"><?= lang('close') ?></button>
                                                                <button type="submit" id="editEvent"
                                                                    class="btn btn-primary"><?= lang('Savechanges') ?></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <a href="<?php echo site_url('admin/payroll/payroll/Consolidateview/?tab=Setattendance/'.$employee_id.'/'.$months.'/'.$department_id); ?>"
                                            class="btns"><?= lang('Proceed') ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  } ?>
                <!----      shift update end                -->

                <!----------------    attendance update ------>
                <?php    if(isset($missedAttendance)){  ?>
                <?php echo form_open('admin/payroll/employee/consolidate_setattendance')?>
                <div class="tab-pane <?php if(isset($missedattendance)){ echo 'active'; }  ?>" id="set_attendance">
                    <table class="table table-hover table-bordered">
                        <input type="hidden" value="<?php echo $employee_id;    ?>" name="employeeid">
                        <input type="hidden" value="<?php echo $months;    ?>" name="month">
                        <input type="hidden" value="<?php echo $department_id;    ?>" name="department">
                        <thead>
                            <tr>
                                <th class="active"><?= lang('Attendancedate') ?></th>
                                <th class="active"><?= lang('Shift_name') ?></th>
                                <th class="active">
                                    <label class="css-input css-checkbox css-checkbox-success">
                                        <input type="checkbox" class="checkbox-inline select_one"
                                            id="parent_present"><span></span> <?= lang('attendance') ?>
                                    </label>
                                </th>
                                <th class="active">
                                    <label class="css-input css-checkbox css-checkbox-danger">
                                        <input type="checkbox" class="checkbox-inline select_one"
                                            id="parent_absent"><span></span> <?= lang('leave_category') ?>
                                    </label>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   foreach($missedAttendance as $attendance){  ?>
                            <?php      if($attendance){   ?>
                            <tr>
                                <td><?php echo $attendance['Attendacedate'];    ?><input type="hidden"
                                        value="<?php echo $attendance['Attendacedate'];    ?>" name="attendate[]"></td>
                                <td><?php echo $attendance['ShiftName'];    ?></td>
                                <?php
						 // echo $attendance->Attendacedate;
						   $where = array('employee_id' => $employee_id,'Shift_Date' => $attendance['Attendacedate'],'payroll_shift_rosters.Soft_delete' => 0,'payroll_shift_rosters.Shift_id'=>$attendance['shift_id']);
							$this->db->select('payroll_shift_rosters.Shift_id,shift_form,shift_to');	
							$this->db->from('payroll_shift_rosters');
					        $this->db->join('payroll_work_shift', 'payroll_work_shift.id = payroll_shift_rosters.Shift_id');
						    $this->db->where($where);
							$query_result = $this->db->get();
							$shifts = $query_result->row();	
						  ?>
                                <td>
                                    <div class="form-group row">
                                        <input type="hidden" class="form-control " name="shiftid[]"
                                            value="<?php if(!empty($attendance['shift_id'])){ echo $attendance['shift_id']; }?>">
                                        <input name="attendance[]"
                                            id="<?php echo strtotime($attendance['Attendacedate']).$attendance['shift_id'] ?>"
                                            value="<?php echo $attendance['Attendacedate'] ?>" type="checkbox"
                                            class="child_present" style="float:left;margin-left:12px;"
                                            <?php  if(isset($attendance['id'])){  echo 'checked' ;}   ?>>
                                        <label class="col-md-1 control-label">In</label>
                                        <div class="col-md-2">
                                            <div class="input-group bootstrap-timepicker timepicker">
                                                <input type="text" class="form-control timepicker" name="in[]"
                                                    value="<?php if(!empty($shifts->shift_form)){ echo  date("g:i a",strtotime($shifts->shift_form)); }else{ echo '06:00 PM'; } ?>">
                                            </div>
                                        </div>
                                        <label for="inputValue" class="col-md-1 control-label">Out</label>
                                        <div class="col-md-2">
                                            <div class="input-group bootstrap-timepicker timepicker1">
                                                <input type="text" class="form-control timepicker" name="out[]"
                                                    value="<?php if(!empty($shifts->shift_to)){  echo   date("g:i a",strtotime($shifts->shift_to)); }else{ echo '06:00 PM'; }?>">
                                            </div>
                                        </div>
                                    </div>
                </div>
                </td>
                <td><input type="checkbox" value="<?php echo $attendance['Attendacedate'] ?>" class="child_absent"
                        id="<?php echo strtotime($attendance['Attendacedate']).$attendance['shift_id'] ?>"
                        name="attendance[]" style="float:left;margin-left:12px;"
                        <?php  if(!isset($attendance['id'])){  echo 'checked' ;}   ?>>
                    <div id="l_category" class="col-sm-9">
                        <select name="leave_category_id[]" class="form-control leaves">
                            <option value=""><?= lang('select_leave_category') ?>...</option>
                            <?php foreach ($all_leave_category_info as $v_L_category) : ?>
                            <option value="<?php echo $v_L_category->id ?>" <?php
                                 if (!empty($attendance['leave_category_id'])) {
                                     echo $v_L_category->id == $attendance['leave_category_id'] ? 'selected' : '';
                                 }
                                  ?>>
                                <?php echo $v_L_category->leave_category ?></option>;
                            <?php endforeach; ?>
                        </select>
                    </div>
                </td>
                </tr>


                <?php  }  }  ?>
                </tbody>
                </table>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-2">
                    <button type="submit" id="sbtn" name="sbtn" value="1"
                        class="btn bg-olive btn-md btn-flat"><?= lang('save') ?></button>
                </div>
            </div>
            <?php      echo form_close()   ?><?php   } ?>
            <?php    if(isset($lop)){  ?>
            <div class="tab-pane <?php   if($tab == 'reviewAttendance' ||isset($lop)){echo 'active'; }  ?>"
                id="clear_attendance">
                <?php if(!empty($lop)){ ?>
                <?php echo form_open('admin/payroll/payroll/Savereviewattendance', array('class' => 'form-horizontal')) ?>
                <h5 style="text-align:center;"> <?= lang('Attendance_Result') ?></h5>
                <table class="table table-striped table-bordered ">
                    <thead>
                        <!-- Table head -->
                        <tr>
                            <th>#</th>
                            <th><?= lang('employee_name') ?></th>
                            <th><?= lang('month') ?></th>
                            <th><?= lang('Total_workingday') ?></th>
                            <th><?= lang('Absent') ?> (Days)</th>
                            <th><?= lang('TotalLateminutes') ?> (Mins)</th>
                            <th><?= lang('OverTime') ?> (Days)</th>
                            <th><?= lang('Absent_dates') ?> </th>
                            <th><?= lang('OT_dates') ?> </th>
                            <th><?= lang('Late_min_dates') ?></th>
                        </tr>
                    </thead><!-- / Table head -->
                    <tbody>
                        <!-- / Table body -->
                        <?php  $i=1; ?>
                        <?php foreach ($lop as $item) : ?>
                        <tr class="custom-tr">
                            <td class="vertical-td"><?php echo $i; ?><input type="hidden" name="employeeid"
                                    value="<?php echo $item['employeeid'] ?>"></td>
                            <td class="vertical-td"><?php echo $item['EmployeeName'] ?><input type="hidden"
                                    name="employeename" value="<?php echo $item['EmployeeName'] ?>"></td>
                            <td class="vertical-td"><?php echo date('Y-M',strtotime($item['month'])); ?><input
                                    type="hidden" name="salarymonth"
                                    value="<?php echo date('Y-M',strtotime($item['month'])); ?>"></td>
                            <td class="vertical-td">
                                <?php echo $item['workingday'] ?><input type="hidden" name="workingday"
                                    value="<?php echo $item['workingday'] ?>"></td>
                            <td class="vertical-td">
                                <?php
                                           if($item['workingday']>$item['absent_Based_on_time_sheet']){
											   echo $item['absent_Based_on_time_sheet'] ;
										   }else{
											   echo $item['workingday'];
										   }
										?>
                                <input type="hidden" name="absent" value="<?php
                                           if($item['workingday']>$item['absent_Based_on_time_sheet']){
											   echo $item['absent_Based_on_time_sheet'] ;
										   }else{
											   echo $item['workingday'];
										   }
										?>">
                            </td>
                            <td class="vertical-td"><?php
                                           if($item['total_latemintue']>0){
											   echo $item['total_latemintue'] ;
										   }
										?><input type="hidden" name="lateminute" value="<?php
                                           if($item['total_latemintue']>0){
											   echo $item['total_latemintue'] ;
										   }
										?>"></td>
                            <td class="vertical-td"><?php
                                           if($item['OverTime']>0.0){
											   echo $item['OverTime'] ;
										   }
										?><input type="hidden" name="overtime" value="<?php
                                           if($item['OverTime']>0.0){
											   echo $item['OverTime'] ;
										   }
										?>"></td>
                            <td>
                                <?php  if(!empty($item['absentdate'])){ ?>
                                <table>
                                    <tr>
                                        <th><?= lang('date') ?></th>
                                    </tr>
                                    <?php   foreach($item['absentdate'] as $abdate){ ?>
                                    <tr>
                                        <td><?php  echo $abdate;  ?></td>
                                    </tr>
                                    <?php  }  ?>
                                </table>
                                <?php  }else{ echo 0; }  ?>
                            </td>
                            <td>
                                <?php    if(!empty($item['OT_date'])){   ?>
                                <table>
                                    <tr>
                                        <th><?= lang('date') ?></th>
                                    </tr>
                                    <?php   foreach($item['OT_date'] as $Otdate){ ?>
                                    <tr>
                                        <td><?php  echo $Otdate;  ?></td>
                                    </tr>
                                    <?php  }  ?>
                                </table>
                                <?php   } else{  echo 0 ;} ?>
                            </td>
                            <td>
                                <?php   if(!empty($item['latemin'])){  ?>
                                <table>
                                    <tr>
                                        <th><?= lang('date') ?></th>
                                        <th><?= lang('Minute') ?></th>
                                        <th><?= lang('Type') ?></th>
                                    </tr>
                                    <?php   foreach($item['latemin'] as $latemin){  if($latemin['mintue']>0){ ?>
                                    <tr>
                                        <td><?php  echo $latemin['date'];  ?></td>
                                        <td><?php  echo '&nbsp;'.$latemin['mintue'];  ?></td>
                                        <td><?php  echo $latemin['Type'];  ?></td>
                                    </tr>
                                    <?php  }  } ?>
                                </table>
                                <?php  }else{  echo 0; }  ?>
                            </td>
                        </tr>
                        <?php $i++; endforeach;  ?>
                        <!--get all sub category if not this empty-->
                    </tbody><!-- / Table body -->
                </table> <!-- / Table -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-2">
                        <button type="submit" id="sbtn" name="sbtn" value="1"
                            class="btn bg-olive btn-md btn-flat"><?= lang('save') ?></button>
                    </div>
                </div>
                <?php echo form_close()  ?>
                <?php } ?>
            </div>
            <?php  } ?>
            <!----    review attendance end    -->

            <!---      generate payment -->

            <?php if(isset($absent_Based_on_time_sheet)){  ?>
            <div class="tab-pane  <?php   if($tab == 'Payment'){echo 'active'; }  ?>" id="generate_payment">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12" data-offset="0">
                                <div class="wrap-fpanel">
                                    <div class="box box-primary" data-collapsed="0">
                                        <div class="box-header with-border bg-primary-dark">
                                            <h3 class="box-title"><?= lang('Generate_Payment') ?></h3>
                                        </div>
                                        <div class="panel-body">
                                            <?php echo form_open('admin/payroll/payroll/savepayment', array('class' => 'form-horizontal')) ?>
                                            <input type="hidden" value="<?php echo $employee->id ?>" name="empid">
                                            <input type="hidden" value="<?php echo date('Y-m',strtotime($month)); ?>"
                                                name="month">
                                            <div class="panel_controls">
                                                <div class="form-group">
                                                    <label for="field-1"
                                                        class="col-sm-2 control-label"><?= lang('month') ?></label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <span class="label label-success"
                                                            style="font-size: 15px"><?php echo date('F Y',strtotime($month)); ?></span>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label for="field-1"
                                                        class="col-sm-2 control-label"><?= lang('employee') ?></label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <?php echo $employee->first_name.' '.$employee->last_name ?>
                                                    </div>
                                                    <label class="col-sm-1 control-label"
                                                        style="text-align: right"><?= lang('employee_id') ?> </label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <?php echo $employee->employee_id ?>
                                                    </div>
                                                    <label class="col-sm-1 control-label"
                                                        style="text-align: right"><?= lang('LOP') ?> </label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <!-- <?php if(isset($absent_Based_on_time_sheet)){ echo $absent_Based_on_time_sheet ; }else{ echo 0 ; } ?>-->
                                                        <input type="text"
                                                            value=" <?php if(isset($absent_Based_on_time_sheet)){ echo $absent_Based_on_time_sheet ; }else{ echo 0 ; } ?>"
                                                            class="form-control lops" name="lops">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-1"
                                                        class="col-sm-2 control-label"><?= lang('department') ?></label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <?php echo $department->department ?>
                                                    </div>
                                                    <label class="col-sm-1 control-label"
                                                        style="text-align: right"><?= lang('job_title') ?> </label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <?php echo $employee->job_title ?>
                                                    </div>
                                                    <label class="col-sm-1 control-label"
                                                        style="text-align: right"><?= lang('Late_Minutes') ?> </label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <input type="text"
                                                            value=" <?php if(isset($total_lateminute)){ echo $total_lateminute ; }else{ echo 0 ; } ?>"
                                                            class="form-control lateminute" name="Late_Minutes">
                                                        <label style="font-size:12px;"><?= lang('Per_min') ?> </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-1"
                                                        class="col-sm-2 control-label"><?= lang('gross_salary') ?></label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <input type="text"
                                                            value=" <?php echo ($salary->Current_total_payable + $salary->Current_total_deduction) ?>"
                                                            class="form-control rates" disabled>
                                                        <input type="hidden"
                                                            value=" <?php echo ($salary->Current_total_payable + $salary->Current_total_deduction) ?>"
                                                            class="rate">
                                                    </div>
                                                    <label class="col-sm-1 control-label"
                                                        style="text-align: right"><?= lang('deduction') ?> </label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <input type="text"
                                                            value=" <?php echo ($salary->Current_total_deduction) ?>"
                                                            class="form-control rates" disabled>
                                                        <input type="hidden"
                                                            value=" <?php echo ($salary->Current_total_deduction) ?>"
                                                            class="rate" disabled>
                                                    </div>
                                                    <label class="col-sm-1 control-label"
                                                        style="text-align: right"><?= lang('Late_fine') ?> </label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <input type="text"
                                                            value="<?php if(isset($fine_amount)){ echo $fine_amount ; }else{ echo 0 ; } ?>"
                                                            class="form-control latefine rates" name="Late_fine">
                                                        <input type="hidden"
                                                            value="<?php if(isset($fine_amount)){ echo $fine_amount ; }else{ echo 0 ; } ?>"
                                                            class="rate">
                                                    </div>
                                                </div>

                                                <div class="form-group margin">
                                                    <label class="col-sm-2 control-label"><?= lang('net_salary') ?>
                                                    </label>
                                                    <div class="col-sm-5">
                                                        <input type="text"
                                                            value=" <?php echo $salary->Current_total_payable ?>"
                                                            class="form-control rates" disabled>
                                                        <input type="hidden"
                                                            value=" <?php echo $salary->Current_total_payable ?>"
                                                            class="form-control rate" disabled>
                                                    </div>
                                                    <label class="col-sm-1 control-label"
                                                        style="text-align: right"><?= lang('Late_Amount') ?> </label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <input type="text"
                                                            value="<?php if(isset($fine_amount)){ echo $fine_amount*$total_lateminute ; }else{ echo 0 ; } ?>"
                                                            class="form-control Late_Amount rates" name="Late_Amount">
                                                        <input type="hidden"
                                                            value="<?php if(isset($fine_amount)){ echo $fine_amount*$total_lateminute ; }else{ echo 0 ; } ?>"
                                                            class="rate">
                                                    </div>
                                                </div>
                                                <?php  $totalAward = 0; if(!empty($award)): foreach($award as $item ): ?>
                                                <?php if ($item->award_amount == '0.00') { // skip even members
                                            continue;
                                        } ?>
                                                <?php $totalAward += $item->award_amount ?>
                                                <?php endforeach; endif ?>
                                                <div class="form-group margin">
                                                    <label class="col-sm-2 control-label"><?= lang('award') ?> </label>
                                                    <div class="col-sm-5">
                                                        <input type="text" value=" <?php echo $totalAward ?>"
                                                            class="form-control" disabled>
                                                    </div>
                                                    <label class="col-sm-1 control-label"
                                                        style="text-align: right"><?= lang('OverTime') ?> </label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <input type="text"
                                                            value="<?php if(isset($OverTime)){ echo $OverTime; }else{ echo 0 ; } ?>"
                                                            class="form-control OverTime rates" name="OverTime">
                                                        <input type="hidden"
                                                            value="<?php if(isset($OverTime)){ echo $OverTime ; }else{ echo 0 ; } ?>"
                                                            class="rate">
                                                    </div>
                                                </div>
                                                <?php
                                    if(!empty($totalAward)){
                                        $totalPayable =  $totalAward + $salary->Current_total_payable;
                                    }else{
                                        $totalPayable = $salary->Current_total_payable;
                                    }
                                    ?>
                                                <?php $totalfindeduction = 0; if(!empty($findeduction)):  foreach($findeduction as $findeductionitem ): ?>
                                                <?php if ($findeductionitem->deduction_amount == '0.00') { // skip even members
                                            continue;
                                        } ?>
                                                <?php $totalfindeduction += $findeductionitem->deduction_amount ?>
                                                <?php endforeach; endif ?>
                                                <div class="form-group margin">
                                                    <label class="col-sm-2 control-label"><?= lang('fine_deduction') ?>
                                                    </label>
                                                    <div class="col-sm-5">
                                                        <input type="text" value=" <?php  echo $totalfindeduction  ?>"
                                                            class="form-control rates" name="fine_deduction"
                                                            id="fine_deduction">
                                                        <input type="hidden" value="<?php  echo $totalfindeduction  ?>"
                                                            class="form-control rate">
                                                    </div>
                                                    <label class="col-sm-1 control-label"
                                                        style="text-align: right"><?= lang('OTAmount') ?> </label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <input type="text"
                                                            value="<?php if(isset($payroll->OverTimeAmount)){ echo round(($payroll->OverTimeAmount),2); }else{ echo 0 ; } ?>"
                                                            class="form-control  rates" name="OverTimeamount">
                                                        <input type="hidden"
                                                            value="<?php if(isset($payroll->OverTimeAmount)){ echo round(($payroll->OverTimeAmount),2) ; }else{ echo 0 ; } ?>"
                                                            class="rate">
                                                    </div>
                                                </div> <?php
                                    if(!empty($totalfindeduction)){
                                        $totalPayable =  $salary->Current_total_payable-$totalfindeduction;
                                    }else{
                                        $totalPayable = $salary->Current_total_payable;
                                    }
                                    ?>
                                                <input type="hidden" value=" <?php echo $totalPayable ?>" class="rates"
                                                    id="net_salary">
                                                <input type="hidden"
                                                    value=" <?php echo $salary->Current_total_payable ; ?>"
                                                    class="rates" id="grosssalary" name="grosssalary">
                                                <div class="form-group margin">
                                                    <label class="col-sm-2 control-label"><?= lang('bonus') ?> </label>
                                                    <div class="col-sm-5">
                                                        <input type="text"
                                                            value="<?php if(!empty($payroll)) echo $payroll->bonus ?>"
                                                            class="form-control rates" name="bonus" id="bonus">
                                                        <input type="hidden"
                                                            value="<?php if(!empty($payroll)) echo $payroll->bonus ?>"
                                                            class="form-control rate">
                                                    </div>
                                                    <label class="col-sm-1 control-label"
                                                        style="text-align: right"><?= lang('Advance') ?> </label>
                                                    <div class="col-sm-2" style="padding-top: 5px">
                                                        <input type="text"
                                                            value="<?php if(isset($payroll->Advance_Amount)){ echo round(($payroll->Advance_Amount),2); }else{ echo $Advance ; } ?>"
                                                            class="form-control OverTime rates" name="advance">
                                                        <input type="hidden" value="<?php if(isset($payroll->Advance_Amount)){ echo $payroll->Advance_Amount; $totalPayable=$totalPayable-$payroll->Advance_Amount; }else{ echo $Advance ;
											$totalPayable=$totalPayable-$Advance;
											} ?>" class="rate">
                                                    </div>
                                                </div>
                                                <div class="form-group margin">
                                                    <label class="col-sm-2 control-label"><?= lang('TAx_deduction') ?>
                                                    </label>
                                                    <div class="col-sm-3">
                                                        <label for="name"
                                                            class="control-label"><?= lang('Tax_slab') ?></label>
                                                        <input style="background-color:#fff;border:1px solid #fff;"
                                                            type="text"
                                                            value="<?php if(isset($taxs['tax']->Start_range)){echo $taxs['tax']->Start_range; }else { echo 0; }?> To <?php if(isset($taxs['tax']->End_range)){echo $taxs['tax']->End_range; }else { echo 0; }?>"
                                                            class="form-control" id="" name="" readonly>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="name"
                                                            class="control-label"><?= lang('Tax_Per') ?></label>
                                                        <input type="text"
                                                            value="<?php  if(!empty($taxs['tax']->Tax_percentage)){  echo $taxs['tax']->Tax_percentage;}else{ echo 0;} ?>"
                                                            class="form-control tax_cal" id="tax_perc"
                                                            name="tax_percentage" readonly>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="name"
                                                            class="control-label"><?= lang('Annual_salary') ?></label>
                                                        <input type="text"
                                                            value="<?php   if(isset($taxs['YearSalary'])){echo $taxs['YearSalary']; }else { echo 0; }  ?>"
                                                            class="form-control tax_cal rates" id="annualsalary"
                                                            name="annualsalary">
                                                        <input type="hidden"
                                                            value="<?php   if(isset($taxs['YearSalary'])){echo $taxs['YearSalary']; }else { echo 0; }  ?>"
                                                            class="tax_cal rate" readonly>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="name"
                                                            class="control-label"><?= lang('Annual_tax') ?></label>
                                                        <input type="text"
                                                            value="<?php
										if(isset( $taxs['YearSalary'])&&(isset($taxs['tax']->Tax_percentage)&&(($taxs['tax']->Tax_percentage))>0)){echo(( ($taxs['YearSalary'])/100)*($taxs['tax']->Tax_percentage))-$taxs['tax']->Allow_Benefits;  }else { echo 0; }  ?>"
                                                            class="form-control rates" id="Annualtax" name="Annualtax"
                                                            readonly>
                                                        <input type="hidden"
                                                            value="<?php
										if(isset( $taxs['YearSalary'])&&(isset($taxs['tax']->Tax_percentage)&&(($taxs['tax']->Tax_percentage))>0)){echo(( ($taxs['YearSalary'])/100)*($taxs['tax']->Tax_percentage))-$taxs['tax']->Allow_Benefits;  }else { echo 0; } ?>"
                                                            class="rate" readonly>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="name" class="control-label"></label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label for="name"
                                                            class="control-label"><?= lang('Monthly_Tax') ?></label>
                                                        <input type="text"
                                                            value="<?php 
									  if(isset( $taxs['YearSalary'])&&(isset($taxs['tax']->Tax_percentage)&&(($taxs['tax']->Tax_percentage))>0)){ $monthtax= round(((( ($taxs['YearSalary']/100)*($taxs['tax']->Tax_percentage))-$taxs['tax']->Allow_Benefits)/12),2); echo $monthtax; }else {  $monthtax=0; echo $monthtax;  } ?>"
                                                            class="form-control rates" id="Monthly_tax"
                                                            name="Monthly_tax" readonly>
                                                        <?php  $totalPayable=$totalPayable-$monthtax;   ?>
                                                        <input type="hidden"
                                                            value="<?php 
									 if(isset( $taxs['YearSalary'])&&(isset($taxs['tax']->Tax_percentage)&&(($taxs['tax']->Tax_percentage))>0)){echo round(((( ($taxs['YearSalary']/100)*($taxs['tax']->Tax_percentage))-$taxs['tax']->Allow_Benefits)/12),2);  }else { echo 0; }   ?>"
                                                            class="form-control rate" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group margin">
                                                    <label class="col-sm-2 control-label"><?= lang('payment_amount') ?>
                                                    </label>

                                                    <div class="col-sm-5">
                                                        <input type="text" value="<?php 
											 if(isset($totalPayable)){
											 
											echo round( ((($totalPayable/$totalworkingdaypermonth)*($totalworkingdaypermonth-$absent_Based_on_time_sheet))-($fine_amount*$total_lateminute)),2); 
											 }else{  echo 0; }
											?>  " class="form-control rates   payment_amount" name="PayAmounts" readonly>
                                                        <input type="hidden" value="<?php 
											if(isset($totalPayable)){
											echo round( ((($totalPayable/$totalworkingdaypermonth)*($totalworkingdaypermonth-$absent_Based_on_time_sheet))-($fine_amount*$total_lateminute)),2); 
											 }else{  echo 0; }
											 ?> 
											
											
											" class="form-control rate payment_amount" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group margin">
                                                    <label class="col-sm-2 control-label"><?= lang('payment_method') ?>
                                                    </label>

                                                    <div class="col-sm-5">
                                                        <select class="form-control select2 paymethod"
                                                            name="payment_method" id="paymethod">
                                                            <option value="<?= lang('cash') ?>"><?= lang('cash') ?>
                                                            </option>
                                                            <option value="<?= lang('check') ?>"><?= lang('check') ?>
                                                            </option>
                                                            <option value="<?= lang('electronic_transfer') ?>">
                                                                <?= lang('electronic_transfer') ?></option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group margin">
                                                    <label class="col-sm-2 control-label"><?= lang('comment') ?>
                                                    </label>
                                                    <div class="col-sm-5">
                                                        <input type="text"
                                                            value="<?php if(!empty($payroll)) echo $payroll->note ?>"
                                                            name="note" class="form-control">
                                                    </div>
                                                </div>

                                                <input type="hidden" name="employee_id"
                                                    value="<?php echo $employee->id?>">
                                                <input type="hidden" name="month" value="<?php echo $month ?>">

                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-5">
                                                        <button type="submit" id="sbtn" name="sbtn" value="1"
                                                            class="btn bg-olive btn-md btn-flat"><?= lang('save') ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo form_close() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }   ?>

            <!-----          payment generate end     ------>
            <!-----        payslip            ---->
            <?php  if(isset($empSalary)){  ?>
            <div class="tab-pane  <?php   if($tab == 'Payslip'){echo 'active'; }  ?>" id="print_slip">
                <script src="<?php echo base_url();  ?>assets/js/jquery-printme.js"></script>
                <script src="<?php echo base_url();  ?>assets/js/jquery-printme.min.js"></script>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12" data-offset="0">
                                <div class="wrap-fpanel">
                                    <div class="box box-primary" data-collapsed="0">
                                        <div class="box-header with-border bg-primary-dark">
                                            <h3 class="box-title"><?= lang('employee_payroll_list') ?></h3>
                                            <div class="box-tools" style="padding-top: 5px">
                                                <div class="input-group input-group-sm">
                                                    <a class="btn" style="color: #FFF" id="printButton">
                                                        <i class="fa fa-print fa-2x" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body1">
                                            <div class="employee_salary_slip">
                                                <div class="row">
                                                    <?php $company_logo = get_option('company_logo') ?>
                                                    <!--  <img height="180" width="180" src="<?php echo site_url(UPLOAD_LOGO.$company_logo)?>" class="img img-responsive center" >-->
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <h2 class="text-center Languagess"><?= lang('salary_payslip') ?>
                                                        </h2>
                                                        <div class="clearfix"></div>
                                                        <table class="table table-bordered">
                                                            <colgroup>
                                                                <col width="20%">
                                                                <col width="50%">
                                                            </colgroup>
                                                            <thead>
                                                                <tr>
                                                                    <th><?= lang('Language') ?></th>
                                                                    <th>
                                                                        <select class="form-control languagess">
                                                                            <option value="1"><?= lang('English') ?>
                                                                            </option>
                                                                            <option value="2"><?= lang('Thai') ?>
                                                                            </option>
                                                                        </select>
                                                                        <!--<div class="checkbox disabled">
                                        <label><input type="checkbox" value="1" ><?= lang('English') ?></label> <label><input type="checkbox" value="2" ><?= lang('Thai') ?></label>-->
                                                    </div>
                                                    </th>
                                                    </tr>

                                                    <tr>
                                                        <th><?= lang('employee') ?></th>
                                                        <th><?php echo $employee->first_name.' '.$employee->last_name ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th><?= lang('department') ?></th>
                                                        <th><?php echo $employee->department ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th><?= lang('salary_month') ?> </th>
                                                        <th> <?php echo date("F, Y", strtotime($pay_slip->month));  ?>
                                                        </th>
                                                    </tr>

                                                    </thead>
                                                    </table>
                                                    <div class="clearfix"></div>
                                                    <table class="table middle_salary_slip" style="margin-bottom: 0px;">
                                                        <tbody>
                                                            <colgroup>
                                                                <col width="50%">
                                                                <col width="50%">
                                                            </colgroup>
                                                            <tr>
                                                                <td style="padding: 0px;">
                                                                    <table class="table table-bordered"
                                                                        style="margin-bottom: 0px;">
                                                                        <colgroup>
                                                                            <col width="50%">
                                                                            <col width="50%">
                                                                        </colgroup>
                                                                        <thead>
                                                                <th><?= lang('Earnings') ?></th>
                                                                <th></th>
                                                                </thead>
                                                        <tbody>
                                                            <?php
										foreach($salaryEarningList as $earning){ ?>
                                                            <?php
								    	$salary = '';
									   if(!empty($empSalaryDetails)) {
									   foreach ($empSalaryDetails as $key => $details) {
									   if ($earning->id.'s' == $key) {
													 	$salary = $details;
														$data['total_earning'][]=$details;
											?>
                                                            <tr>
                                                                <td><?php echo $earning->component_name?></td>
                                                                <td><?php if(!empty($salary)){ echo $Currency_code.'&nbsp'. round(($salary*$Currency->Exchange_rate),$round_off) ;} ?>
                                                                </td>
                                                            </tr>
                                                            <?php  
																						}
																						}
																						}
																						}
																							?>
                                                            <tr>
                                                            <tr>
                                                                <td><?= lang('Bonus') ?></td>
                                                                <td>
                                                                    <?php echo $Currency_code.'&nbsp'. round(($pay_slip->bonus),$round_off); ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><?= lang('OverTime') ?></td>
                                                                <td>
                                                                    <?php echo $Currency_code.'&nbsp'. round(($pay_slip->OverTimeAmount),$round_off); ?>
                                                                </td>

                                                        </tbody>
                                                    </table>
                                                    </td>
                                                    <td style="padding: 0px;">
                                                        <table class="table table-bordered right_side_ded"
                                                            style="margin-bottom: 0px;">
                                                            <colgroup>
                                                                <col width="50%">
                                                                <col width="50%">
                                                            </colgroup>
                                                            <thead>
                                                    <th><?= lang('Deductions') ?></th>
                                                    <th></th>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($salaryDeductionList as $deduction){ ?>
                                                        <?php
                     $salary = '';
                      if(!empty($empSalaryDetails)) {
                            foreach ($empSalaryDetails as $key => $details) {
                               if ($deduction->id.'s' == $key) {
                                                 $salary = $details;
                                                   $data['total_Deduction'][]=$details;
                                                ?>
                                                        <tr>
                                                            <td><?php echo $deduction->component_name?></td>
                                                            <td><?php if(!empty($salary)){ echo $Currency_code.'&nbsp'.round(($salary*$Currency->Exchange_rate),$round_off) ;} ?>
                                                            </td>
                                                        </tr>
                                                        <?php  }  } }
							                        }
                                                 ?>
                                                        <tr>
                                                            <td><?= lang('Late_Fine') ?></td>
                                                            <td>
                                                                <?php echo $Currency_code.'&nbsp'. round(($pay_slip->Late_amount),$round_off) ; ?>
                                                            </td>
                                                        <tr>
                                                        <tr>
                                                            <td><?= lang('Tax') ?></td>
                                                            <td>
                                                                <?php echo $Currency_code.'&nbsp'.round(($pay_slip->Monthly_tax),$round_off) ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><?= lang('LOP') ?></td>
                                                            <td>
                                                                <?php echo $Currency_code.'&nbsp'. round(((($pay_slip->net_salary/$TotalWorkingday)*$pay_slip->Lop)*$Currency->Exchange_rate),$round_off); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><?= lang('Penalty') ?></td>
                                                            <td>
                                                                <?php echo $Currency_code.'&nbsp'. round(($pay_slip->Penalty),$round_off); ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><?= lang('Advance') ?></td>
                                                            <td>
                                                                <?php echo $Currency_code.'&nbsp'. round(($pay_slip->Advance_Amount),$round_off); ?>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                    </table>
                                                    </td>
                                                    </tr>
                                                    </tbody>
                                                    </table>
                                                    <style>
                                                    .net_salary_tab_s tbody tr td {
                                                        border: none;
                                                    }

                                                    .net_salary_tab tbody tr .br_cl {
                                                        border: none !important;
                                                    }

                                                    .net_salary_tab {
                                                        border: none !important;
                                                    }

                                                    @media print {
                                                        .net_salary_tab_s tbody tr td {
                                                            border: none !important;
                                                        }

                                                        .bottom_table_salary tbody tr td {
                                                            border: none !important;
                                                        }

                                                        .net_salary_tab tbody tr .br_cl {
                                                            border: none !important;
                                                        }

                                                        .net_salary_tab {
                                                            border: none !important;
                                                        }

                                                        .language {
                                                            border: none;
                                                        }

                                                        selectdiv:after {
                                                            border: none;
                                                        }

                                                        .go_back_se a {
                                                            display: none;
                                                        }
                                                    }
                                                    </style>



                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table class="table table-bordered"
                                                                style="table-layout: fixed;">
                                                                <tbody>
                                                                    <tr>

                                                                        <td><?= lang('Total_Addition') ?></td>
                                                                        <td><?php  if(isset($data['total_earning'])){echo $Currency_code.'&nbsp'. round(((array_sum($data['total_earning']))*$Currency->Exchange_rate +$pay_slip->bonus+$pay_slip->OverTimeAmount),$round_off); }else{  echo 0; } ?>
                                                                        </td>
                                                                        <td rowspan="3">
                                                                            Note:<?php   if(isset($pay_slip->note)){ echo $pay_slip->note; }  ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><?= lang('Total_Deductions') ?></td>
                                                                        <td><?php   
                                                   if(isset($data['total_Deduction'])){
													  $total_dec= array_sum($data['total_Deduction']);
												   }else{
													   $total_dec=0;
												   }
                                             echo $Currency_code.'&nbsp'. round((($pay_slip->Advance_Amount+$pay_slip->Penalty+$total_dec+ $pay_slip->Late_amount+$pay_slip->Monthly_tax+round((($pay_slip->net_salary/$TotalWorkingday)*$pay_slip->Lop),$round_off))*$Currency->Exchange_rate),$round_off); ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Amount Received</td>
                                                                        <td><strong><?php echo $Currency_code.'&nbsp'. round($pay_slip->Payment_amount,$round_off) ?></strong>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php  }  } ?>
                <!---  payslip   ----->
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.js'></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/select2/select2.full.min.js'></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/fullcalendar/fullcalendar.min.js'></script>



<script>
$('#month').data("DateTimePicker").hide();
</script>
<script>
$('form').attr('autocomplete', 'off');
$(".skin-purple").addClass("sidebar-collapse");
</script>
<script>
$('#continue-shopping').click(function(event) {
    $('.nav-tabs > .active').next('li').find('a').trigger('click');
});
</script>
<script>
$("#printButton").click(function() {
    $("div.panel-body1").printMe({
        "path": ["<?php echo  base_url().'assets/css/example.css';?>"],
    });
});
$(function() {

    $('.timepicker').datetimepicker({
        format: 'LT'
    });
});
</script>

<script type="text/javascript">
$(document).on("change", function() {
    var fine = 0;
    var bonus = 0;
    var monthday = 30;
    var lop = !isNaN($('.lops').val()) ? $('.lops').val() : 0;
    var lateminute = $('.lateminute').val();
    var latefine = $('.latefine').val();
    var tax = $('#Monthly_tax').val();
    var total_late_fine = (lateminute * latefine);
    fine = $("#fine_deduction").val();
    bonus = $("#bonus").val();
    var net_salary = $("#net_salary").val();
    var totals = (net_salary / monthday) * (monthday - lop);
    var total_net = (totals - total_late_fine);
    var total = total_net - fine + +bonus;
    var with_tax = (total - tax);
    $('.Late_Amount').val(total_late_fine);
    $(".payment_amount").val(with_tax.toFixed(2));

});
</script>
</script>
<script>
$(document).on("change", '.tax_cal', function() {
    var tax_per = !isNaN($('#tax_perc').val()) ? $('#tax_perc').val() : 0;
    var Amount = !isNaN($('.payment_amount').val()) ? $('.payment_amount').val() : 0;
    var Annual_salary = !isNaN($('#annualsalary').val()) ? $('#annualsalary').val() : 0;
    var totaltax = ((Annual_salary / 100) * tax_per);
    var anualtax = totaltax * 12;
    var Totalamount = Amount - totaltax;
    $('.payment_amount').val(Totalamount.toFixed(2));
    $('#Annualtax').val(anualtaxtoFixed(2));
    $('#Monthly_tax').val(totaltaxtoFixed(2));

});
</script>
<script>
$(document).ready(function() {
            function calculate(Exchange_rate, Round_of) {
                var total = 0;
                $('.rate').each(function() {
                    total = isNaN(parseFloat($(this).val()) * parseFloat(Exchange_rate)) ? 0 : parseFloat($(
                        this).val()) * parseFloat(Exchange_rate);
                    $(this).siblings('.rates').val(total.toFixed(2));

                })


                $('.currency').on('change', function() {
                    var Currency_id = $(this).val();
                    //Ajax Load data from ajax
                    $.ajax({
                        url: "<?php echo site_url('admin/Payroll/currency_load/')?>/" + Currency_id,
                        type: "GET",
                        data: {
                            'csrf_test_name': getCookie('csrf_cookie_name')
                        },
                        dataType: "JSON",
                        success: function(data) {
                            $('#Exchangerate').val(parseFloat(data.Exchange_rate, 6));
                            calculate(parseFloat(data.Exchange_rate), data.Round_of);
                        }
                    });
                });


            });
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('.languagess').change(function() {
        if ($(this).val() == 2) {
            $('div.panel-body1').html($('div.panel-body1').html().replace('Language', 'ภาษา'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Company Name',
                'ชื่อ บริษัท'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Earnings', 'รายได้'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Bonus', 'โบนัส'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('OverTime', 'ล่วงเวลา'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Total Addition',
                'รวมทั้งหมด'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Deductions', 'หัก'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Late Fine', 'สายดี'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Tax', 'ภาษี'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Penalty', 'การลงโทษ'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Advance', 'ความก้าวหน้า'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Total  Deductions',
                'การหักเงินโดยรวม'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('NET_Salary',
                'เงินเดือนสุทธิ'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Bonus Remarks',
                'ข้อสังเกตโบนัส'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Deductions Remarks',
                'หมายเหตุการหักเงิน'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Name of Bank',
            'ชื่อธนาคาร'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Date', 'วันที่'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Signature of the Employee',
                'ลายเซ็นของพนักงาน'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Director', 'ผู้อำนวยการ'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Go Back', 'ย้อนกลับ'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Salary Month',
                'เดือนเงินเดือน'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Department', 'แผนก'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Employee', 'ลูกจ้าง'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Total_Deductions',
                'ចំនួនសរុប'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Amount Received',
                'ចំនួនទឹកប្រាក់ដែលបានទទួល'));
            $('div.panel-body1').html($('div.panel-body1').html().replace('Basic', 'មូលដ្ឋាន'));
        } else {

            location.reload();
        }

    });
});
</script>
<script>
$('#btnAdd').on('click', function(e) {
    e.preventDefault();
    var elem = $(this).next('.td1')
    elem.toggle('slow');
});
</script>
<script>
$(function() {
    $('#date').datepicker({
        autoclose: true,
        format: "yyyy-mm",
        startView: "months",
        minViewMode: "months"
    });
});
</script>
<script>
$(document).ready(function() {
    $('.review_attendance').validate({
        rules: {
            month: {
                required: true,

            },
            department_id: {
                required: true,

            },
            employee_id: {
                required: true,

            }
        }
    });

});
</script>