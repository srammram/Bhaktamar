
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
      <div class="wrap-fpanel">
         <div class="box box-primary" data-collapsed="0">
            <div class="box-header with-border bg-primary-dark">
               <h3 class="box-title"><?= lang('Punch_variant_report') ?></h3>
            </div>
		<?php echo form_open('admin/Reports/PunchVariant_Report', array('class' =>'form-horizontal','id' => 'Reports')) ?>
            <div class="panel-body">
               
               <div class="panel_controls">
                  <div class="form-group margin">
                     <label class="col-sm-3 control-label"><?= lang('date') ?><span class="required">*</span></label>
                     <div class="col-sm-5">
                        <div class="input-group">
                           <input type="text" name="date"   class="form-control monthyear" value="<?php
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
                     <label for="field-1" class="col-sm-3 control-label"><?= lang('department') ?> <span class="required">*</span></label>
                     <div class="col-sm-5">
                        <select name="department_id" id="department" class="form-control">
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
                  </div>
                  <div class="form-group">
                     <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-flat btn-md"><?= lang('go') ?></button>
                     </div>
                  </div>
               </div>
              
            </div>
	  <?php echo form_close() ?>
         </div>
      </div>
   </div>
</div>
<br/>
<br/>
<?php if (!empty($attendance)): ?>
  
<div class="row">

   <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
         <div class="box-header with-border bg-primary-dark">
            <h3 class="box-title"><?= lang('Punch_variant_report') ?></h3>
         </div>
         <div class="box-header">
            <h3 class="box-title"> <?php  if(isset($date)){ echo date("M  Y", strtotime($date)); } ?></h3>
            <span style="float:right;font-weight:bold;">InTime - OutTime
           </span>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="hidden" value="<?php  if(isset($date)){ echo $date; } ?>" name="dates">
                  <input type="hidden" name="departmentid" id="department_id"value="<?php echo $department_id; ?>">
                
                  <div class="table-responsive">
                      <table class="table table-striped table-bordered " id="shift_roster">
                        <thead>
                           <tr>
                              <th class="active"><?= lang('name') ?></th>
                              <?php foreach ($dateSl as $edate) : ?>
                              <th class="active shift_dates"><?php echo $edate ?></th>
                              <?php endforeach; ?>
                           </tr>
                        </thead>
                        <tbody>
						
                           <?php foreach ($attendance as $key => $v_employee): ?>
                           <tr>
                              <td class="names"><?php echo $employee[$key]->first_name . ' ' . $employee[$key]->last_name ?><input type="hidden"class="names" name="emp_id[]" value="<?php echo $employee[$key]->id ; ?>"></td>
                              <?php foreach ($v_employee as $v_result): ?>
                              <?php foreach ($v_result as $emp_attendance): ?>
                              <td>
                                 <?php
                                    if ($emp_attendance->Shift_id == 'H') {
                                    	echo '<p style="color:#fff;background-color:#29648A;text-align:center;">H</p>';
                                    }else
                                    {
										if(!empty($emp_attendance->Shift_id))
										{
                                    	
                                              if(isset($ShiftType))
										      {
                                                    foreach($ShiftType as $Type)
                                                  {
										            if($emp_attendance->Shift_id == $Type->id)
											         {
												            echo '<p style="color:#fff;background-color:#3d9970;text-align:center;">'.$Type->shift_name.'</p>';
											         }
											            
											      }
											 
										       }
										   }else
										   {
		                                             echo '<p style="color:#fff;background-color:#a80505;text-align:center;">NS</p>';
											           
										   }
									}
                                       ?>
                              </td>
                              <?php endforeach; ?>
                              <?php endforeach; ?>
                           </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
        </div>
   </div>
  
</div>
<?php endif ?>
<script>
$(document).ready(function () {
	 $('.shifts').find('option:not(:first)').remove();
})  

</script>
<script>
  $('.monthyear').on('changeDate', function (ev) {
     $(this).datepicker('hide');
});
    </script>
	
<script>
$(document).ready(function() {
	var fullDate = new Date()
    var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) :(fullDate.getMonth()+1);
    var currentDate = fullDate.getDate() + "-" + twoDigitMonth + "-" + fullDate.getFullYear();

    $('#shift_roster').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Shift roster -'   +  '<?php echo $month; ?>'
            },
            {
                extend: 'pdfHtml5',
				orientation: 'landscape',
                title: 'Shift roster -'    +  '<?php echo $month; ?>'
            }
        ]
    } );
} );
</script>
<script>
	$('form').attr('autocomplete', 'off');
</script>
<script>
$("#sbtn").click(function ()  {

    $("#Reports").validate({
        excluded: ':disabled',
         rules: {
            date: {
                required: true,
            },
            department_id: {
                required: true,
            },
        },
messages: {
        dob: {
            required: "Please enter you date of birth.",
            minAge: "You are not old enough(18<)!"
        } 
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
