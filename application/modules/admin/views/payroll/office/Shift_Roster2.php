
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
               <h3 class="box-title"><?= lang('Edit_Shift_roster') ?></h3>
            </div>
		<?php echo form_open('admin/Office/Shift_calender', array('class' =>'form-horizontal')) ?>
            <div class="panel-body">
               
               <div class="panel_controls">
                  <div class="form-group margin">
                     <label class="col-sm-3 control-label"><?= lang('date') ?><span class="required">*</span></label>
                     <div class="col-sm-5">
                        <div class="input-group">
                           <input type="text" name="date"  id="month"  class="form-control monthyear" value="<?php
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
                                            <?php foreach($employee as $item){ ?>
                                                <option value="<?php echo $item->id ?>" >
                                                    <?php echo  $item->first_name.' '.$item->last_name ?>
                                                </option>
                                            <?php } ?>

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
  <div id="msgs"></div>
<div class="row">
<div id="msgs"></div>
   <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
         <div class="box-header with-border bg-primary-dark">
                         <h3 class="box-title"><?= lang('Edit_Shift_roster') ?></h3>
         </div>
         <div class="box-header">
            <h3 class="box-title"> <?php  if(isset($date)){ echo date("M  Y", strtotime($date)); } ?></h3>
            <span style="float:right;">
            <?php 
               if(isset($ShiftType)){
               foreach($ShiftType as $Type)
               			{
               	echo' <small style="color:red;font-size:16px;">'.$Type->shift_name.'</small>'.':-'.$Type->shift_form . '-' .$Type-> shift_to.'&nbsp;&nbsp;';
               		}
               		}
               ?></span>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="hidden" value="<?php  if(isset($date)){ echo $date; } ?>" name="dates">
                  <input type="hidden" name="departmentid" id="department_id"value="<?php echo $department_id; ?>">
                
                  <div class="table-responsive">
                     <table class="table table-bordered"id="plannertable" width="100%">
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
                              <?php foreach ($v_employee as $v_result): $shift=array(); ?>
                              <?php foreach ($v_result as $emp_attendance){ 
							    $shift[]=$emp_attendance->Shift_id;
							  }
							  ?>
                              <td>
							
                                 <?php
								
                                    if (in_array('H',$shift) || in_array(0,$shift)) {
                                    	?>
                                 <select name="shifttype[]" class="statuschange js-example-basic-multiple-limit" multiple="multiple">
                                    <option value="0" style="color:red;" selected>H</option>
									   <?php
									  foreach($ShiftType as $Type){ 
									  $selected = in_array( $Type->id, $shift ) ? ' selected="selected" ' : '';   
									 ?>
									<option value="<?php echo $item->id ?>"  <?php echo $selected; ?> ><?php echo $Type->shift_name ?></option>
								<?php 
									 }				
									 ?>
                                 </select>
                                 <?php  
                                    }else
                                    {
										if(!empty($shift))
										{
                                    	?>
                                 <select name="shifttype[]"  class="statuschange js-example-basic-multiple-limit" multiple="multiple">
                                
									    <?php
									  foreach($ShiftType as $Type){ 
									  $selected = in_array( $Type->id, $shift ) ? ' selected="selected" ' : '';   
									 ?>
									<option value="<?php echo $item->id ?>"  <?php echo $selected; ?> ><?php echo $Type->shift_name ?></option>
								<?php 
									 }				
									 ?>
									    <option value="0" style="color:red;">H</option>
                                     </select>
                                 <?php
                                    }
									else{
										?>
										<select name="shifttype[]"  class="statuschange js-example-basic-multiple-limit" multiple="multiple">
										 <option value="" style="color:red;" selected>NS</option>
                                 
									    <?php
									  foreach($ShiftType as $Type){ 
									  $selected = in_array( $Type->id, $shift ) ? ' selected="selected" ' : '';   
									 ?>
									<option value="<?php echo $item->id ?>"  <?php echo $selected; ?> ><?php echo $Type->shift_name ?></option>
								<?php 
									 }				
									 ?>
									    <option value="0" style="color:red;">H</option>
                                 </select>
										<?php
									}
									}
                                    ?>
                              </td>
                              
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
$(document).ready(function()
{
	$('.statuschange').on('change',function()
	{
          var postUrl= getBaseURL() + 'admin/office/Shift_update_ajax';
          var employee_id=$(this).closest('td').siblings().find('.names').val();
		  var csrftoken = getCookie('csrf_cookie_name');
		  var month=$('.monthyear').val();
		  var Department_id=$('#department_id').val();
		  var shift_date=$(this).parent().index();
		  var Shift_id=$(this).val();
	   $.ajax({
        url: postUrl,
        type: "POST",
        data: { Employee : employee_id, shift_date : shift_date,  Shift_id : Shift_id,'csrf_test_name': csrftoken,month:month,Department_id:Department_id},
        cache: false,
        success: function(response) {
           if(response==1)
		   {
			  // alert("Shift Update SuccessFully");
			 
			  $('#msgs').html("<div class='alert alert-success'>Shift Update SuccessFully</div>").fadeIn(1000);
			     $('#msgs').html("<div class='alert alert-success'>Shift Update SuccessFully</div>").fadeOut(1000);
		
		   }else{
			  // alert("Shift Update Failed");
			  $('#msgs').html("<div class='alert alert-danger'>Shift Update Failed</div>").fadeIn(1000);
			  $('#msgs').html("<div class='alert alert-danger'>Shift Update Failed</div>").fadeOut(1000);

			  
		   }
        }
    });
	


});
	
});
</script>

<script>
	$('#month').on('changeDate',function(){
     $(this).datepicker('hide');
	});
</script>
<script>
	$('form').attr('autocomplete', 'off');
	</script>
