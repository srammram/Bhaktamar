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
                            <h3 class="box-title"><?= lang('Punch_monitoring_report') ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php echo form_open('admin/reports/PunchMonitor', array('class' => 'form-horizontal','id' => 'Reports')) ?>
                            <div class="panel_controls">

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?= lang('department') ?> <span class="required">*</span></label>

                                    <div class="col-sm-5">
                                        <select name="department_id" id="department" class="form-control">
                                            <option value="" ><?= lang('select_department') ?>...</option>
                                            <?php foreach ($all_department as $v_department) : ?>
                                                <option value="<?php echo $v_department->id ?>"
												 <?php
                                 if (!empty($Department)) {
                                     echo $v_department->id == $Department ? 'selected' : '';
                                 }
                                 ?>		>      <?php echo $v_department->department ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>
								<div class="form-group margin">
                            <label class="col-sm-3 control-label"><?= lang('date') ?><span class="required">*</span></label>

                            <div class="col-sm-5">
                                <div class="input-group">
                                  <input class="form-control" id="datepicker" name="dates" data-date-format="yyyy/mm/dd" type="text" value="<?php
                              if (!empty($Date)) {
                                  echo date('Y-m-d', strtotime($Date));
                              }
                              ?>">
                                    <div class="input-group-addon">
                                       <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
						
								
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
                                    <th><?= lang('Attendance_date') ?></th>
									 <th><?= lang('ShiftName') ?></th>
									 <th><?= lang('OndutyTime') ?></th>
									 <th><?= lang('OFFdutyTime') ?></th>
                                    <th><?= lang('In_time') ?></th>
                                    <th><?= lang('Out_time') ?></th>
                                     
									<th><?= lang('Attendance_status') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($attendanceData)){ foreach ($attendanceData as $item){  
								?>
                              <tr>
                                        <td><?php echo $item->EmployeeName ; ?></td>
                                        <td><?php echo $item->Department ; ?></td>
                                        <td><?php echo $item->Attendancedate ; ?></td>
										  <td><?php echo $item->Shift_name; ?></td>
                                        <td><?php echo $item->Onduty_time ; ?></td>
                                        <td><?php echo $item->Offduty_time ; ?></td>
                                       <td><?php    echo $item->Clock_in ;  ?></td>
                                        <td><?php    echo $item->Clock_out ; ?></td>
										<td><?php

  if (isset($item->Absent)) {
                            echo '<small class="label bg-red">Absent</small>';                    
  }
                                                ?></td>
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

<script>
$("#sbtn").click(function ()  {
    $("#Reports").validate({
        excluded: ':disabled',
         rules: {
            dates: {
                required: true,
			

            },
            department_id: {
                required: true,
			
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
	$('form').attr('autocomplete', 'off');
</script>

