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
                    <h3 class="box-title"><?= lang('generate_attendance_report') ?></h3>
                </div>

                <div class="panel-body">

                        <?php echo form_open('admin/employee/report', array('class' =>'form-horizontal','id' => 'Reports')) ?>
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
                                            <?php echo $v_department->department ?></option>
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
                   <?php echo form_close() ?>
                </div>
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
                <h3 class="box-title"><?= lang('generate_attendance_report') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">


                        <table class="table table-bordered" id="Attedancereport" width="100%">
                            <thead style="display: none">
                            <tr>
                                <th class="active">Name</th>
                                <?php foreach ($dateSl as $edate) : ?>
                                    <th class="active"><?php echo $edate ?></th>
                                <?php endforeach; ?>
								<th>A</th>
								<th>L</th>
								<th>P</th>	
								<th>H</th>
								<th>HP</th>
								<th>WO</th>
								<th>WOP</th>
								<th>LOP</th>
								</tr>
                            </thead>
                            <tbody style="display: none">

                            <?php 
						
							
							foreach ($attendance as $key => $v_employee): ?>
							<?php  
							$a=0;
							$l=0;
							$p=0;
							$h=0;
							$hp=0;
							$wp=0;
							$wop=0;
							$lop=0;
							?>
                                <tr>

                                    <td ><?php echo $employee[$key]->first_name . ' ' . $employee[$key]->last_name ?></td>
                                    <?php foreach ($v_employee as $v_result): ?>
                                        <?php foreach ($v_result as $emp_attendance): ?>
                                            <td>
                                                <?php
												
                                                if ($emp_attendance->attendance_status == 1) {
													$p++;
                                                    echo '<small class="label bg-olive">P</small>';
                                                }if ($emp_attendance->attendance_status == '0') {
													$a++;
                                                    echo '<small class="label bg-red">A</small>';
                                                }if($emp_attendance->attendance_status == '3'){
													$l++;
                                                    echo '<small class="label bg-yellow">L</small>';
                                                }if ($emp_attendance->attendance_status == 'H') {
													$h++;
                                                    echo '<small class="label btn-default">H</small>';
                                                }
                                                ?>
                                            </td>
                                        <?php endforeach; ?>


                                    <?php endforeach; ?>
									<td class="active"><?php  echo $a ; ?></td>
									<td class="active"><?php  echo $l ; ?></td>
									<td class="active"><?php  echo $p ; ?></td>
									<td class="active"><?php  echo $h ; ?></td>
									<td class="active"><?php  echo $hp ; ?></td>
									<td class="active"><?php  echo $wp ; ?></td>
									<td class="active"><?php  echo $wop ; ?></td>
									<td class="active"><?php  echo $a ; ?></td>
									
									
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>

                        <div class="table-responsive">
                        <table class="table table-bordered" width="100%">
                            <thead>
                            <tr>
                                <th class="active"><?= lang('name') ?></th>

                                <?php foreach ($dateSl as $edate) : ?>
                                    <th class="active"><?php echo $edate ?></th>
                                <?php endforeach; ?>
                                 <th>A</th>
								<th>L</th>
								<th>P</th>	
								<th>H</th>
								<th>HP</th>
								<th>WO</th>
								<th>WOP</th>
								<th>LOP</th>
                            </tr>

                            </thead>

                            <tbody>

                            <?php foreach ($attendance as $key => $v_employee): ?>
							<?php  
							$a=0;
							$l=0;
							$p=0;
							$h=0;
							$hp=0;
							$wp=0;
							$wop=0;
							$lop=0;
							?>
                                <tr>

                                    <td ><?php echo $employee[$key]->first_name . ' ' . $employee[$key]->last_name ?></td>
                                    <?php foreach ($v_employee as $v_result): ?>
                                        <?php foreach ($v_result as $emp_attendance): ?>
                                            <td>
                                                 <?php
												
                                                if ($emp_attendance->attendance_status == 1) {
													$p++;
                                                    echo '<small class="label bg-olive">P</small>';
                                                }if ($emp_attendance->attendance_status == '0') {
													$a++;
                                                    echo '<small class="label bg-red">A</small>';
                                                }if($emp_attendance->attendance_status == '3'){
													$l++;
                                                    echo '<small class="label bg-yellow">L</small>';
                                                }if ($emp_attendance->attendance_status == 'H') {
													$h++;
                                                    echo '<small class="label btn-default">H</small>';
                                                }
                                                ?>
                                            </td>
                                        <?php endforeach; ?>


                                    <?php endforeach; ?>
									<td class="active"><?php  echo $a ; ?></td>
									<td class="active"><?php  echo $l ; ?></td>
									<td class="active"><?php  echo $p ; ?></td>
									<td class="active"><?php  echo $h ; ?></td>
									<td class="active"><?php  echo $hp ; ?></td>
									<td class="active"><?php  echo $wp ; ?></td>
									<td class="active"><?php  echo $wop ; ?></td>
									<td class="active"><?php  echo $a ; ?></td>
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
/*   $(function() {
  $('.monthyear').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
}).on('changeDate', function (ev) {
     $(this).datepicker('hide');
});
 });
 */
  $('.monthyear').on('changeDate', function (ev) {
     $(this).datepicker('hide');
});
    </script>
    </script>
	
	
	<script>
$(document).ready(function() {
	var fullDate = new Date()
    var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) :(fullDate.getMonth()+1);
    var currentDate = fullDate.getDate() + "-" + twoDigitMonth + "-" + fullDate.getFullYear();

    $('#Attedancereport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Attedance report - '    + '<?php echo $month; ?>',
				
            },
            {
                extend: 'pdfHtml5',
				orientation: 'landscape',
                title: 'Attedance report - '     +  '<?php echo $month; ?>',
			//  title:'<img height="180" width="180" src="<?php   $company_logo = get_option('company_logo');   echo site_url(UPLOAD_LOGO.$company_logo)?>" class="img img-responsive center" >'
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

</script>


