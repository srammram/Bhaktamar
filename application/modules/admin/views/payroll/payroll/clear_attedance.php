
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12" data-offset="0">
                <div class="wrap-fpanel">
                    <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h3 class="box-title"><?= lang('Clear_attendance') ?></h3>
                        </div>
                        <div class="panel-body">
                                <?php echo form_open('admin/payroll/Getattendance', array('class' => 'form-horizontal')) ?>
                                <div class="panel_controls">
                                    <div class="form-group">
                                        <label for="field-1" class="col-sm-3 control-label"><?= lang('department') ?> <span class="required">*</span></label>

                                        <div class="col-sm-5">
                                            <select class="form-control select2" name="department_id" id="department">
                                                <option value="" ><?= lang('select_department') ?>...</option>
                                                <?php foreach ($department as $v_department) : ?>
                                                    <option value="<?php echo $v_department->id ?>" >
                                                        <?php echo $v_department->department ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group margin">
                                        <label class="col-sm-3 control-label"><?= lang('month') ?> <span class="required">*</span></label>

                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="month" id="month" class="form-control monthyear" value="<?php
                                                if (!empty($date)) {
                                                    echo date('Y-n', strtotime($date));
                                                }
                                                ?>" >
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-5">
                                            <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('go') ?></button>
											
											   <a href="<?php  echo base_url(); ?>/admin/payroll/ClearAttendance" class="btn bg-maroon btn-flat" id="cancelPersonal"  >Cancel</a>
                                        </div>
                                    </div>
                                </div>
                           <?php echo form_close() ?>
						   <!-------         shift data will display here                 -------------------->
						   <?php if(!empty($norecorsd)){  echo '<h5 style="color:red;text-align:center;">'.$norecorsd.'</h5>'; }   ?>
						   	  
                            <?php if(!empty($missedshift)){ ?>
							<h5 style="color:red;text-align:center;"><?= lang('MissedOut_Shift') ?></h5>
                            <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                                <thead ><!-- Table head -->
                                <tr>
                                    <th><?= lang('Shift_date') ?></th>
                                    <th><?= lang('employee_name') ?></th>
									<th><?= lang('Shift_Status') ?></th>
                                
                                    
                                </tr>
                                </thead><!-- / Table head -->
                                <tbody><!-- / Table body -->
                               <?php foreach ($missedshift as $item) : ?>
									<tr class="custom-tr">
                                        <td class="vertical-td"><?php echo $item['shiftdate'] ?></td>
                                        <td class="vertical-td"><?php echo $item['employeename'] ?></td>
										<td class="vertical-td"><?php echo $item['Shift_status'] ?></td>
                                    </tr>
                                  
									 <?php endforeach;  ?><!--get all sub category if not this empty-->
                                </tbody><!-- / Table body -->
                            </table> <!-- / Table -->

                        <?php } ?>
						   
						    <!-------         attendance result data will display here                 -------------------->
						   <?php if(!empty($norecorsd)){  echo '<h5 style="color:red;text-align:center;">'.$norecorsd.'</h5>'; }   ?>
						   	  
                            <?php if(!empty($lop)){ ?>
							 <?php echo form_open('admin/payroll/Saveattendance', array('class' => 'form-horizontal')) ?>
							 
							<h5 style="text-align:center;"> <?= lang('Attendance_Result') ?></h5>
                            <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                                <thead ><!-- Table head -->
                                <tr>
								<th>#</th>
                                    <th><?= lang('employee_name') ?></th>
                                    <th><?= lang('month') ?></th>
									<th><?= lang('Total_workingday') ?></th>
									<th><?= lang('Absent') ?> (Days)</th>
								<th><?= lang('TotalLateminutes') ?> (Mins)</th>       
								<th><?= lang('OverTime') ?> (Days)</th>								</tr>
                                </thead><!-- / Table head -->
                                <tbody><!-- / Table body -->
								
								<?php  $i=1; ?>
                               <?php foreach ($lop as $item) : ?>
									<tr class="custom-tr">
									<td class="vertical-td"><?php echo $i; ?><input type="hidden"name="employeeid[]"value="<?php echo $item['employeeid'] ?>"></td>
									<td class="vertical-td"><?php echo $item['EmployeeName'] ?><input type="hidden"name="employeename[]"value="<?php echo $item['EmployeeName'] ?>"></td>
									<td class="vertical-td"><?php echo date('Y-M',strtotime($item['month'])); ?><input type="hidden"name="salarymonth[]"value="<?php echo date('Y-M',strtotime($item['month'])); ?>"></td>
                                        <td class="vertical-td">
										<?php echo $item['workingday'] ?><input type="hidden"name="workingday[]"value="<?php echo $item['workingday'] ?>"></td>
										<td class="vertical-td">
										<?php
                                           if($item['workingday']>$item['absent_Based_on_time_sheet']){
											   echo $item['absent_Based_on_time_sheet'] ;
										   }else{
											   echo $item['workingday'];
											   
										   }
										?>
										<input type="hidden"name="absent[]"value="<?php
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
										?><input type="hidden"name="lateminute[]"value="<?php
                                           if($item['total_latemintue']>0){
											   echo $item['total_latemintue'] ;
										   }
										?>"></td>
										<td class="vertical-td"><?php
                                           if($item['OverTime']>0.0){
											   echo $item['OverTime'] ;
										   }
										?><input type="hidden"name="overtime[]"value="<?php
                                           if($item['OverTime']>0.0){
											   echo $item['OverTime'] ;
										   }
										?>"></td>

                                      
                                    </tr>
                                  
									 <?php $i++; endforeach;  ?><!--get all sub category if not this empty-->
									 
                                </tbody><!-- / Table body -->
                            </table> <!-- / Table -->
							<div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-2">
                                            <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('save') ?></button>
                                        </div>
                                    </div>
 <?php echo form_close() ?>
                        <?php } ?>
						   
						     <!-------        Missed Attendance data will display here                 -------------------->
						   <?php if(!empty($norecorsd)){  echo '<h5 style="color:red;text-align:center;">'.$norecorsd.'</h5>'; }   ?>
						   	  
                            <?php if(!empty($missedAttendance)){  ?>
							<h5 style="color:red;text-align:center;"><?= lang('MissedOut_Attendance') ?></h5>
                            <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                                <thead ><!-- Table head -->
                                <tr>
                                    <th><?= lang('Attendancedate') ?></th>
                                    <th><?= lang('employee_name') ?></th>
									<th><?= lang('Shiftname') ?></th>
									<th><?= lang('Attendance_status') ?></th>
                                
                                    
                                </tr>
                                </thead><!-- / Table head -->
                                <tbody><!-- / Table body -->
                               <?php foreach ($missedAttendance as $item) : ?>
									<tr class="custom-tr">
                                        <td class="vertical-td"><?php echo $item['Attendacedate'] ?></td>
                                        <td class="vertical-td"><?php echo $item['employeename'] ?></td>
										<td class="vertical-td"><?php echo !empty($item['Shiftname'])? $item['Shiftname'] : ''; ?></td>
										<td class="vertical-td"><?php echo $item['Attendance_status'] ?></td>

                                      
                                    </tr>
                                  
									 <?php endforeach;  ?><!--get all sub category if not this empty-->
                                </tbody><!-- / Table body -->
                            </table> <!-- / Table -->

                        <?php } ?>
						   
						   
                            <?php if(!empty($payroll_list)){ ?>
                            <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                                <thead ><!-- Table head -->
                                <tr>
                                    <th><?= lang('employee_id') ?></th>
                                    <th><?= lang('employee_name') ?></th>
                                    <th><?= lang('job_title') ?></th>
                                    <th><?= lang('gross_salary') ?></th>
                                    <th><?= lang('payment_amount') ?></th>
                                    <th><?= lang('month') ?></th>
                                    <th style="width:125px;"><?= lang('actions') ?></th>
                                </tr>
                                </thead><!-- / Table head -->
                                <tbody><!-- / Table body -->

                                <?php foreach ($payroll_list as $item) : ?>
                                    <tr class="custom-tr">
                                        <td class="vertical-td"><?php echo $item->termination == 0 ? '<span class="label bg-red">'.$item->employee_id .'</span>':$item->employee_id ?></td>
                                        <td class="vertical-td"><?php echo $item->first_name. $item->last_name ?></td>

                                        <td class="vertical-td"><?php echo $item->job_title ?></td>
                                        <td class="vertical-td"><?php echo $this->localization->currencyFormat($item->gross_salary) ?></td>

                                        <td class="vertical-td"><?php echo $this->localization->currencyFormat($item->Payment_amount) ?></td>
                                        <td class="vertical-td"><?php echo date("F, Y", strtotime($item->month));  ?></td>

                                        <td class="vertical-td">
                                            <div class="btn-group">
                                                <a href="<?php echo base_url().'admin/payroll/employeePaySlip/'. str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($item->id)) ?>" class="btn btn-xs btn-default" ><i class="fa fa-search" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;  ?><!--get all sub category if not this empty-->
                                </tbody><!-- / Table body -->
                            </table> <!-- / Table -->

                        <?php } ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script>
	$('#month').on('changeDate',function(){
     $(this).datepicker('hide');
	});
 </script>
<script>
	$('form').attr('autocomplete', 'off');
</script>
