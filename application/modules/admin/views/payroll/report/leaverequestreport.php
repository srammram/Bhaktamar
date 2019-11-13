<style>
    .dataTables_filter {
        display: none;
    }
    .dataTables_info{
        display: none;
    }
</style>
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12" data-offset="0">
                <div class="wrap-fpanel">
                    <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h3 class="box-title"><?= lang('MonthWiseLeaveReport') ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php echo form_open('admin/reports/leaveReport', array('class' => 'form-horizontal','id' => 'myform')) ?>
                            <div class="panel_controls">

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?= lang('department') ?> <span class="required">*</span></label>

                                    <div class="col-sm-5">
                                       <select name="department_id" id="department" class="form-control" onchange="get_employee(this.value)">
                           <option value="" ><?= lang('select_department') ?>...</option>
                           <?php foreach ($department as $v_department) : ?>
                           <option value="<?php echo $v_department->id ?>">
                              <?php echo $v_department->department ?>
                           </option>
                           <?php endforeach; ?>
                        </select>
                                    </div>
                                </div>
								
                            <div class="form-group">
                     <label for="field-1" class="col-sm-3 control-label"><?= lang('date') ?></label>
                     <div class="input-group col-sm-6" >
					  <input type="text"  class="form-control " id="datepicker" placeholder="From " name="from" data-date-format="yyyy/mm/dd">
                           <div class="input-group-addon">
                                <i class="fa fa-calendar-o"></i>
                             </div>
							 
                         
						  <input type="text" class="form-control " id="datepicker1" placeholder="To " name="to" data-date-format="yyyy/mm/dd" required>
                           <div class="input-group-addon">
                                <i class="fa fa-calendar-o"></i>
                             </div>
                          </div>
						   </div>
                        </div>
						
								<br>
								<br>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-5">
                                        <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('submit') ?></button>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="flag" value="1">
                            <?php echo form_close() ?>
                            <table class="table table-striped table-bordered " id="Punchmonitoring" cellspacing="0" id="tables" width="100%">

                                <thead>
                                <tr>
                                    <th><?= lang('name') ?></th>
                                    <th><?= lang('department') ?></th>
									 <th><?= lang('leave_category') ?></th>
									<th><?= lang('Leave_request_date') ?></th>
                                    <th><?= lang('leave_date') ?></th>
									 <th><?= lang('Leave_Reason') ?></th>
									 <th><?= lang('LeaveStatus') ?></th>
								
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($leavedata)){ foreach ($leavedata as $item){  
								?>
                              <tr>
                                        <td><?php echo $item->first_name .'&nbsp;'.$item->last_name ; ?></td>
                                        <td><?php echo $item->department ; ?></td>
							            <td><?php echo $item->leave_category ; ?></td>
                                        <td><?php echo $item->application_date ; ?></td>
										<td><?php echo $item->start_date ?>
										<?php isset($item->end_date) ? ' to '.$item->end_date :''; ?></td>
										  <td><?php echo $item->reason; ?></td>
                                        <td>
										 <?php
                                                if ($item->STATUS == 'pending') {
                                                   echo '<small class="label bg-yellow">'. $item->STATUS  .'</small>';
                                                }if ($item->STATUS == 'Accepted') {
                                                    echo '<small class="label  label-success ">'. $item->STATUS  .'</small>';
                                                }if($item->STATUS == 'Rejected'){
                                                     echo '<small class="label bg-red">'. $item->STATUS  .'</small>';
                                                }
                                                ?>
										</td>
                                    </tr>

                                <?php }   }  ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
$("#sbtn").click(function ()  {

    $("#myform").validate({
        excluded: ':disabled',
        rules: {
              to: { greaterThan: "#datepicker" },
            from: {
                required: true
            },
            department_id: {
                required: true
            },
        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});

</script>
 <script>
        $(function() {
         
			$('#datepicker').datepicker({
     format: "yyyy-mm-dd",
     autoclose: true,
}).on('changeDate', function (ev) {
     $(this).datepicker('hide');
});

      
        });
    </script>
	 <script>
        $(function() {
         
			$('#datepicker1').datepicker({
     format: "yyyy-mm-dd",
     autoclose: true,
}).on('changeDate', function (ev) {
     $(this).datepicker('hide');
});

      
        });
    </script>
	<script>
	$('form').attr('autocomplete', 'off');
	</script>
	
<script>
$(document).ready(function() {
	var fullDate = new Date()
    var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) :(fullDate.getMonth()+1);
    var currentDate = fullDate.getDate() + "-" + twoDigitMonth + "-" + fullDate.getFullYear();
    $('#Punchmonitoring').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'PunchMonitoring' + currentDate
            },
            {
                extend: 'pdfHtml5',
                title: 'PunchMonitoring' + currentDate
            }
        ]
    } );
} );
</script>