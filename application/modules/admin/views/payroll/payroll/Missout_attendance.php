<script type="text/javascript" src="<?php echo base_url()?>assets/js/attendance.js"></script>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<p class="error" style="padding:21px;"></p>
<style>
    div[id="l_category"]{
        display: none;

    }
    input[class="child_absent"]:checked ~ div[id="l_category"]{
        display:block;
    }
    .child_absent{
        float: left;
    }


    div[id="check_in"]{
        display: none;
    }
    input[class="child_present"]:checked ~ div[id="check_in"]{
        display:block;
    }
    .child_present{
        float: left;
    }

</style>

<div class="row">
    <div class="col-sm-12">

        <div class="row">
            <div class="col-sm-12" data-offset="0">
                <div class="wrap-fpanel">
                    <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h3 class="box-title"><?= lang('MIssedOutPunching') ?></h3>
                        </div>
                        <div class="panel-body">


                            <?php if (!empty($attendance)): ?>

                            <?php echo form_open('admin/Payroll/SaveMissedOut_attendance')?>

                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="active"><?= lang('date') ?></th>
                                        <th class="active"><?= lang('employee') ?></th>
                                        <th class="active"><?= lang('job_title') ?></th>
                                        <th class="active">
                                            <label class="css-input css-checkbox css-checkbox-success">
                                                <input type="checkbox" class="checkbox-inline select_one" id="parent_present"><span></span> <?= lang('attendance') ?>
                                            </label>
                                        </th>
                                        <th class="active">
                                            <label class="css-input css-checkbox css-checkbox-danger">
                                                <input type="checkbox" class="checkbox-inline select_one" id="parent_absent"><span></span> <?= lang('leave_category') ?>
                                            </label>
                                        </th>
										<th class="active">
										 <label class="css-input css-checkbox css-checkbox-danger">
                                                <input type="checkbox" class="checkbox-inline select_one" id="Allows"><span></span> <?= lang('Allow') ?>
                                            </label>
										
										</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php  foreach ($attendance as $v_employee) { ?>
                                        <tr>

                                            <td> <?php echo $v_employee->DATE ?> </td>

                                            <td>
                                                <input type="hidden" name="date" value="<?php echo $v_employee->DATE ?>">
                                                <input type="hidden" name="attendance_id[]" value="<?php if ($v_employee) echo $v_employee->attendance_id ?>">
                                                 <input type="hidden" name="employee_id[]"  class="employee_ids" value="<?php echo  $v_employee->id ?>"> <?php echo $v_employee->first_name  ?>
											</td>
					                      <td><?php echo $v_employee->job_title ?></td>
											<td>

                                                <input  name="attendance[]"
                                                    <?php
                                                       echo $v_employee->attendance_status == 1 ? 'checked ' : '';
                                                         ?> id="<?php echo $v_employee->attendance_id ?>" value="<?php echo $v_employee->attendance_status ?>" type="checkbox" class="child_present">

                                                   <div id="check_in" class="col-sm-8">
                                                    <?php
                                                  
                                                               $inTime = date("h:i A", strtotime($v_employee->in_time));
                                                               $out_time = date("h:i A", strtotime($v_employee->out_time));
                                                      
                                                    ?>
                                                        <div class="form-group row">
                                                            <label class="col-md-1 control-label">In</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group bootstrap-timepicker timepicker">
                                                                    <input type="text" class="form-control timepicker" name="in[]" value="<?php if(!empty($inTime)){ echo $inTime; }else{ echo '10:00 AM'; }?>">
                                                                </div>
                                                            </div>
                                                            <label for="inputValue" class="col-md-1 control-label">Out</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group bootstrap-timepicker timepicker">
                                                                    <input type="text" class="form-control timepicker" name="out[]" value="<?php if(!empty($out_time)){ echo $out_time; }else{ echo '06:00 PM'; }?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </td>
											 <td style="width: 28%">

                                                <input id="<?php echo $v_employee->attendance_id ?>" type="checkbox"
                                                    <?php
                                                   echo $v_employee->leave_category_id ? 'checked ' : '';
                                                         ?>
                                                       value="<?php echo $v_employee->id ?>" class="child_absent" >

                                                <div id="l_category" class="col-sm-9">
                                                    <select name="leave_category_id[]" class="form-control leaves" >
                                                        <option value="" ><?= lang('select_leave_category') ?>...</option>
                                                        <?php foreach ($all_leave_category_info as $v_L_category) : ?>
                                                            <option value="<?php echo $v_L_category->id ?>"
                                                                <?php
                                                                  echo $v_L_category->id == $v_employee->leave_category_id ? 'selected ' : '';
                                                                    ?> >
                                                                <?php echo $v_L_category->leave_category ?></option>;
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
												</td>
											<td>
											<input type="checkbox" name="allows[]" value="1" class="childallow">
											</td>
                                        </tr>
                                    <?php }
                                    ?>
                                    </tbody>
                                </table>
                                <button type="submit" id="sbtn" class="btn bg-navy btn-md btn-flat">
                                    <i class="fa fa-plus"></i> <?= lang('update') ?> </button>
                                   </div>
<input type="hidden" name="department_id" value="<?php echo $v_employee->department_id ?>">
						<?php echo form_close() ?>
                        <?php endif; ?>

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

$(document).ready(function()
{
	$('.leaves').on('change',function()
	{
		var leave_id=$(this).val();
		var employee_id= $(this).closest('tr').find(".employee_ids").val();
		
    var postUrl     = getBaseURL() + 'admin/office/Allowed_leave_For_employee/';
    var csrftoken = getCookie('csrf_cookie_name');
	
	var element = this;
    // now upload the file using $.ajax
    $.ajax({
        url: postUrl,
        type: "POST",
        data: { leave_id : leave_id,employee_id:employee_id ,'csrf_test_name': csrftoken },
        cache: false,
		context: this,
        success: function(response) {
			console.log(response);
			if(response== 1)
			{
				
				
			}else{
				  $(".error").addClass("alert-danger");
				$('.alert-danger').text('Employee Reached Leave Limit Or This Leave Type Not For This Employee');
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