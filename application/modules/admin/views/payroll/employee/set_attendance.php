<script type="text/javascript" src="<?php echo base_url()?>assets/assets/js/attendance.js"></script>
<link href='<?php echo base_url('assets/assets/css/custom.css')?>' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets/assets/css/skins.css')?>' rel='stylesheet' media='screen'>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<p class="error" style="padding:21px;"></p>
<style>
div[id="l_category"] {
    display: none;
}

input[class="child_absent"]:checked~div[id="l_category"] {
    display: block;
}

.child_absent {
    float: left;
}

div[id="check_in"] {
    display: none;
}

input[class="child_present"]:checked~div[id="check_in"] {
    display: block;
}

.child_present {
    float: left;
}
</style>
<?php    
$atndnce= !empty($atndnce)?array_filter(array_map('array_filter', $atndnce)):'';


?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12" data-offset="0">
                <div class="wrap-fpanel" style="padding:0 24px;">
                    <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h3 class="box-title"><?= lang('set_attendance') ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="mailbox-controls pull-right">
                                <!-- Check all button -->
                                <a href="<?php echo base_url('admin/payroll/employee/importAttendance') ?>"
                                    class="btn bg-orange-active"><i class="fa fa-upload" aria-hidden="true"></i>
                                    <?= lang('import') ?></a>
                                <!-- /.pull-right -->
                            </div>
                            <?php echo form_open('admin/payroll/employee/setAttendance', array('class' => 'form-horizontal')) ?>
                            <div class="panel_controls">
                                <div class="form-group margin">
                                    <label class="col-sm-3 control-label"><?= lang('date') ?> <span
                                            class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <input type="text" name="date" id="date" class="form-control" value="<?php
                                    if (!empty($date)) { echo $date;}else{ echo date('Y-m-d');}
                                    ?>" data-format="dd-mm-yyyy">
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
                                        <select name="department_id" id="department" class="form-control select2">
                                            <option value=""><?= lang('select_department') ?>...</option>
                                            <?php foreach ($all_department as $v_department) : ?>
                                            <option value="<?php echo $v_department->id ?>" <?php
                                       if (!empty($department_id)) {
                                       echo $v_department->id == $department_id ? 'selected' : '';
                                       }
                                       ?>>
                                                <?php echo $v_department->department ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" id="sbtn" name="sbtn" value="1"
                                            class="btn bg-olive btn-md btn-flat"><?= lang('go') ?></button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                            <?php if (!empty($employee_info)): ?>
                            <?php echo form_open('admin/payroll/employee/save_attendance')?>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="active"><?= lang('employee_id') ?></th>
                                        <th class="active"><?= lang('employee') ?></th>
                                        <th class="active"><?= lang('job_title') ?></th>
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
                                    <?php  foreach ($employee_info as $v_employee) { ?>
                                    <tr>
                                        <td> <?php echo $v_employee->employee_id ?> </td>
                                        <td>
                                            <input type="hidden" name="date" value="<?php echo $date ?>">
                                            <?php
                                    $i=0;

                                    foreach ($atndnce as $atndnce_statuss) {
                                    	foreach($atndnce_statuss as $atndnce_status){
                                    if (!empty($atndnce_status)) {
                                    if ($v_employee->id == $atndnce_status->Employee_id) {
                                    ?>
                                            <input type="hidden" name="attendance_id[]"
                                                value="<?php if ($atndnce_status) echo $atndnce_status->id ?>">
                                            <?php  } } } } ?>
                                            <input type="hidden" class="employee_ids" name="employee_id[]"
                                                value="<?php echo  $v_employee->id ?>">
                                            <?php echo $v_employee->first_name . ' ' .  $v_employee->last_name; ?>
                                        </td>
                                        <?php
                                 $job_title = $this->db->get_where('payroll_job_title', array('id' => $v_employee->title))->row();
								 if(!empty($job_title)){
								  $job_title=   $job_title->job_title;
								 }else{
									$job_title=''; 
								 }
                                 ?>
                                        <td><?php echo $job_title ?></td>
                                        <td>
                                            <?php                 
                                      $where = array('employee_id' => $v_employee->id,'Shift_Date' => $date,'payroll_shift_rosters.Soft_delete' => 0);
							          $this->db->select('payroll_shift_rosters.Shift_id,shift_form,shift_to');	
							          $this->db->from('payroll_shift_rosters');
									  $this->db->join('payroll_work_shift', 'payroll_work_shift.id = payroll_shift_rosters.Shift_id');
									  $this->db->where($where);
									  $query_result = $this->db->get();
									  $shifts = $query_result->result();	
                                    if(array_filter($atndnce)){ 
                                       foreach($atndnce as $atndnce_statuss){
										  foreach($atndnce_statuss as $atndnce_status){
												if ($atndnce_status)	{
												     if ($v_employee->id == $atndnce_status->Employee_id){
														$inTime = date("h:i A", strtotime($atndnce_status->Clock_in));
														$out_time = date("h:i A", strtotime($atndnce_status->Clock_out));
														?>

                                            <input type="hidden" class="form-control " name="shiftid[]"
                                                value="<?php if(!empty($atndnce_status->Shift_id)){ echo $atndnce_status->Shift_id; }?>">
                                            <input name="attendance[]"
                                                <?php echo $atndnce_status->Absent != 'true' && $atndnce_status->leave_category_id ==0 ? 'checked ' : '';   ?>
                                                id="<?php echo $atndnce_status->id ?>"
                                                value="<?php echo $v_employee->id ?>" type="checkbox"
                                                class="child_present">
                                            <div class="form-group row" style="width:100%;">
                                                <label class="col-md-1 control-label">In</label>
                                                <div class="col-md-4">
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input type="text" class="form-control timepicker" name="in[]"
                                                            value="<?php if(!empty($inTime) &&$atndnce_status->Clock_in !='00:00:00'&& $atndnce_status->Clock_out !='00:00:00'){ echo $inTime; }else{ 
										   $this->db->select('shift_form');
										     $this->db->from('payroll_work_shift');
											 $this->db->where('id',$atndnce_status->Shift_id);
											 $query  = $this->db->get();
										     $query =$query->row();
											  echo   date("g:i a",strtotime($query->shift_form));
										   }?>">
                                                    </div>
                                                </div>
                                                <label for="inputValue" class="col-md-1 control-label">Out</label>

                                                <div class="col-md-4">
                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                        <input type="text" class="form-control timepicker" name="out[]"
                                                            value="<?php if(!empty($out_time)&&$atndnce_status->Clock_in !='00:00:00'&& $atndnce_status->Clock_out !='00:00:00'){ echo $out_time; }else{  $this->db->select('shift_to');
										     $this->db->from('payroll_work_shift');
											 $this->db->where('id',$atndnce_status->Shift_id);
											 $query  = $this->db->get();
										     $query =$query->row();
											  
										echo   date("g:i a",strtotime($query->shift_to)) ; }   ?>   ">
                                                    </div>
                                                </div>
                                            </div>
                        </div> <?php }else{ 
																(!empty($v_employee->id)) ? $i++ : '';
																if (count($atndnce) == $i){
																	$Ifattendanceexist=$this->db->get_where('payroll_attendanc_sheet',array('Employee_id'=>$v_employee->id,'Attendancedate'=>$date))->result();
																	if(empty($Ifattendanceexist)){
																	if (!empty($shifts)){
																		//echo 3;
																		//continue;
																		foreach($shifts as $shift){  ?>
                        <input type="hidden" class="form-control " name="shiftid[]"
                            value="<?php if(!empty($shift->Shift_id)){ echo $shift->Shift_id; }?>">
                        <input name="attendance[]" value="<?php echo $v_employee->id ?>" type="checkbox"
                            class="child_present">
                        <div class="form-group row" style="width:100%;">
                            <label class="col-md-1 control-label">In</label>
                            <div class="col-md-4">
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input type="text" class="form-control timepicker" name="in[]"
                                        value="<?php if(!empty($shift->shift_form)){ echo date("g:i a",strtotime($shift->shift_form)); }else{ echo '10:00 AM'; }?>">
                                </div>
                            </div>
                            <label for="inputValue" class="col-md-1 control-label">Out</label>
                            <div class="col-md-4">
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input type="text" class="form-control timepicker" name="out[]"
                                        value="<?php if(!empty($shift->shift_to)){ echo date("g:i a",strtotime($shift->shift_to)); }else{ echo '06:00 PM'; }?>">
                                </div>
                            </div>
                        </div>
                        <?php																			//	}
															}
																	} else{   echo '<p style="color:red;font-size:12px;">Shift Not Found</p>'; ?>
                        <!--<input  name="attendance[]" value="<?php echo $v_employee->id ?>"	 type="checkbox" class="child_present" 	>
                                                                       <div class="form-group row" style="width:100%;">
                                                                        <label class="col-md-1 control-label">In</label>
                                                                        <div class="col-md-4">
                                                                       <div class="input-group bootstrap-timepicker timepicker">
                                                                       <input type="text" class="form-control timepicker" name="in[]" value="<?php echo '10:00 AM'; ?>"
                  >
                                                                        </div>
                                                                        </div>
                                                                      <label for="inputValue" class="col-md-1 control-label">Out</label>
                                                                      <div class="col-md-4">
                                                                      <div class="input-group bootstrap-timepicker timepicker">
                                                                      <input type="text" class="form-control timepicker" name="out[]" value="<?php echo '06:00 PM'; ?>">
                                                                      </div>
                                                                       </div>
                                                                       </div>
                                                                       </div>	-->
                        <?php	}
																}
								                   }
													}
												}
											}
                                        }
									}else{
										if (!empty($shifts)){ 
																		foreach($shifts as $shift){   ?>
                        <input type="hidden" class="form-control " name="shiftid[]"
                            value="<?php if(!empty($shift->Shift_id)){ echo $shift->Shift_id; }?>">
                        <input name="attendance[]" value="<?php echo $v_employee->id ?>" type="checkbox"
                            class="child_present">
                        <div class="form-group row" style="width:100%;">
                            <label class="col-md-1 control-label">In</label>
                            <div class="col-md-4">
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input type="text" class="form-control timepicker" name="in[]"
                                        value="<?php if(!empty($shift->shift_form)){ echo date("g:i a",strtotime($shift->shift_form)); }else{ echo '10:00 AM'; }?>">
                                </div>
                            </div>
                            <label for="inputValue" class="col-md-1 control-label">Out</label>
                            <div class="col-md-4">
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input type="text" class="form-control timepicker" name="out[]"
                                        value="<?php if(!empty($shift->shift_to)){ echo date("g:i a",strtotime($shift->shift_to)); }else{ echo '06:00 PM'; }?>">
                                </div>
                            </div>
                        </div>
                        <?php																				}
																	} else{ echo '<p style="color:red;font-size:12px;">Shift Not Found</p>'; ?>

                        <?php }
									}


               ?>
                        </td>
                        <td style="width: 35%">
                            <?php
	 if(array_filter($atndnce)){
		 $m = 0;
         foreach($atndnce as $atndnce_statuss){
	      foreach($atndnce_statuss as $atndnce_status){
		  if ($atndnce_status){
			if ($v_employee->id == $atndnce_status->Employee_id){
				$atndnce_status->leave_category_id != 0 ? 'checked ' : '';
				?>
                            <input id="<?php echo $atndnce_status->id ?>" type="checkbox"
                                value="<?php echo $v_employee->id ?>" checked class="child_absent" id="leavecheck"
                                name="attendance[]">
                            <div id="l_category" class="col-sm-9">
                                <select name="leave_category_id[]" class="form-control leaves">
                                    <option value=""><?= lang('select_leave_category') ?>...</option>
                                    <?php foreach ($all_leave_category_info as $v_L_category) : ?>
                                    <option value="<?php echo $v_L_category->id ?>" <?php
                  if ($atndnce_status) {
                  	if ($v_employee->id == $atndnce_status->Employee_id) {
                  		echo $v_L_category->id == $atndnce_status->leave_category_id ? 'selected ' : '';
                  	}
                  }
                  ?>>
                                        <?php echo $v_L_category->leave_category ?></option>;
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <br>
                            <br>
                            <?php	
		}else{
				(!empty($v_employee->id)) ? $m++ : '';
				if (count($atndnce) == $m){
						$Ifattendanceexist=$this->db->get_where('payroll_attendanc_sheet',array('Employee_id'=>$v_employee->id,'Attendancedate'=>$date))->result();
			  if(empty($Ifattendanceexist)){
					if (!empty($shifts)){
						foreach($shifts as $shift){
							?>
                            <input type="checkbox" value="<?php echo $v_employee->id ?>" class="child_absent"
                                id="leavecheck" name="attendance[]">
                            <div id="l_category" class="col-sm-9">
                                <select name="leave_category_id[]" class="form-control leaves">
                                    <option value=""><?= lang('select_leave_category') ?>...</option>
                                    <?php foreach ($all_leave_category_info as $v_L_category) : ?>
                                    <option value="<?php echo $v_L_category->id ?>">
                                        <?php echo $v_L_category->leave_category ?></option>;
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <br>
                            <br>
                            <?php	
							}
						}
					  else
						{  echo '<p style="color:red;font-size:12px;">Shift Not Found</p>'; ?>
                            <!--<input  type="checkbox"
               value="" class="child_absent" >
            <div id="l_category" class="col-sm-9">
            <select name="leave_category_id[]" class="form-control leaves" >
            <option value="" ><?= lang('select_leave_category') ?>...</option>
            <?php foreach ($all_leave_category_info as $v_L_category) : ?>
            <option value="<?php echo $v_L_category->id ?>"
                >
            <?php echo $v_L_category->leave_category ?></option>;
            <?php endforeach; ?>
            </select>
            </div>
            <br>
            <br>-->
                            <?php		}
					}
				}
		}
			}
		}
	}
	 }else{
		 if (!empty($shifts)){
			 foreach($shifts as $shift){
				?>
                            <input type="checkbox" value="<?php echo $v_employee->id ?>" class="child_absent"
                                id="leavecheck" name="attendance[]">
                            <div id="l_category" class="col-sm-9">
                                <select name="leave_category_id[]" class="form-control leaves">
                                    <option value=""><?= lang('select_leave_category') ?>...</option>
                                    <?php foreach ($all_leave_category_info as $v_L_category) : ?>
                                    <option value="<?php echo $v_L_category->id ?>">
                                        <?php echo $v_L_category->leave_category ?></option>;
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <br>
                            <br>
                            <?php
				}
						}
					  else
						{  echo '<p style="color:red;font-size:12px;">Shift Not Found</p>'; ?>

                            <?php	}
	              }
               ?>
                        </td>
                        </tr>
                        <?php }
               ?>
                        </tbody>
                        </table>
                        <button type="submit" id="sbtn" class="btn bg-navy btn-md btn-flat">
                            <i class="fa fa-plus"></i> <?= lang('update') ?> </button>
                    </div>
                    <input type="hidden" name="department_id" value="<?php echo $department_id ?>">
                    <?php echo form_close() ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script>
$(function() {
    $('#date').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
    });
});
</script>
<script>
$(document).ready(function() {
    $('.leaves').on('change', function() {
        var leave_id = $(this).val();
        var employee_id = $(this).closest('tr').find(".employee_ids").val();
        var postUrl = getBaseURL() + 'admin/office/Allowed_leave_For_employe/';
        var csrftoken = getCookie('csrf_cookie_name');
        var element = this;
        // now upload the file using $.ajax
        $.ajax({
            url: postUrl,
            type: "POST",
            data: {
                leave_id: leave_id,
                employee_id: employee_id,
                'csrf_test_name': csrftoken
            },
            cache: false,
            context: this,
            success: function(response) {
                console.log(response);
                if (response == 1) {} else {
                    $(".error").addClass("alert-danger");
                    $('.alert-danger').text(
                        'Employee Reached Leave Limit Or This Leave Type Not For This Employee'
                        );
                    $(element).html(response);
                    $(".alert-danger").fadeOut(10000)
                    //}
                }
            }
        });
    });
});
</script>
<script>
$('form').attr('autocomplete', 'off');
</script>