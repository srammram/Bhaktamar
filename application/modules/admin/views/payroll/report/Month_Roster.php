 <script src="<?php  echo base_url('assets/'); ?>/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="<?php  echo base_url('assets'); ?>/css/bootstrap-multiselect.css" />
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
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<script>
$(document).ready(function(){
 $('.framework').multiselect({
  nonSelectedText: 'Select Framework',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'200px'
 });});
</script>
<div class="row">
   <div class="col-sm-12">
      <div class="wrap-fpanel">
         <div class="box box-primary" data-collapsed="0">
            <div class="box-header with-border bg-primary-dark">
               <h3 class="box-title"><?= lang('MonthRoster') ?></h3>
            </div>
		<?php echo form_open('admin/reports/Monthroster', array('class' =>'form-horizontal')) ?>
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
                              ?>" >
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                        </div>
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
      </div>
   </div>
</div>
<br/>
<br/>
<?php if (!empty($attendance)){ ?>
  <div id="msgs"></div>
<div class="row">
<div id="msgs"></div>
   <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
         <div class="box-header with-border bg-primary-dark">
                         <h3 class="box-title"><?= lang('MonthRoster') ?></h3>
         </div>
         <div class="box-header">
            <h3 class="box-title"> <?php  if(isset($date)){ echo date("M  Y", strtotime($date)); } ?></h3>
          
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="hidden" value="<?php  if(isset($date)){ echo $date; } ?>" name="dates">
                
                  <div class="table-responsive">
                     <table class="table table-bordered"id="Monthroster" width="100%">
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
                              
                            
                                <?php foreach ($v_employee as $v_result):  ?>
								
                              <?php foreach ($v_result as $emp_attendance){    ?>
							    <td>
							<?php  switch($emp_attendance->Shift_id){
							
							case 'PH':
							echo '<p style="background-color:green;color:black;">'.$emp_attendance->Shift_id.'</p>' ; 
							break;
							case 'O';
							echo '<p style="background-color:#fff;color:black;">'.$emp_attendance->Shift_id.'</p>' ; 
							break;
							case 'W';
							echo '<p style="background-color:Red;color:black;">'.$emp_attendance->Shift_id.'</p>' ; 
							break;
							case 'OT';
							echo '<p style="background-color:yellow;color:black;">'.$emp_attendance->Shift_id.'</p>' ; 
							break;
							case 'HP';
							echo '<p style="background-color:yellow;color:black;">'.$emp_attendance->Shift_id.'</p>' ; 
							break;
							default:
							echo '<p style="font-size:10px;color:black;">'.$emp_attendance->Shift_id.'</p>' ; 
							break;
							}
							 ?>
								
							  </td><?php  }
							  ?>
                             
                              
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

<?php }else{ if(isset($date)){echo '<p style="color:red;font-weight:bold;">No Data Found.</p>' ; } } ?>
<script>
$(document).ready(function() {
	var fullDate = new Date()
    var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) :(fullDate.getMonth()+1);
    var currentDate = fullDate.getDate() + "-" + twoDigitMonth + "-" + fullDate.getFullYear();

    $('#Monthroster').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Monthroster' + currentDate
            },
            {
				  extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                title: 'Monthroster' + currentDate,
				
				
            }
        ]
    } );
} );
</script>
<script>
	$('#month').on('changeDate',function(){
     $(this).datepicker('hide');
	});
</script>
<script>
	$('form').attr('autocomplete', 'off');
	</script>
	