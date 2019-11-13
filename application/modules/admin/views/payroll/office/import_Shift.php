<style>
<style>
.file-upload {
		position: relative;
		display: inline-block;
		background-color: #efefef;
		padding: 25px 0px;
		margin-bottom: 60px;
		}

.file-upload__label {
	display: block;
	padding: 10px;
	color: #fff;
	background: #286090;
	border-radius: .4em;
	transition: background .3s;
	width: 15%;
	margin: 0 auto;
}
.file-upload__label:hover {
  cursor: pointer;
  background: #31708f;
}

.file-upload__input {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  width: 0;
  height: 100%;
  opacity: 0;
}
	.file-upload p{color: #ccc;font-size: 12px;}
	.file-upload h3{color: #222;font-size: 18px;}
	.file-upload .fa{color:#286090;font-size: 18px;	}
	.file_table_sec .table thead tr th{background-color: #f3f0f0;}
	.file_table_sec{padding: 0px;}
</style>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?= lang('Import_shift') ?>
                    </h3>
                    <!-- /.box-tools -->
                <a href="<?php echo site_url('admin/Office/downloadShiftSample')?>" style="float:right;color:#fff;"><i class="fa fa-download" aria-hidden="true"></i> Sample  File</a>
                </div>
                <!-- /.box-header -->
            <div class="box-body">
                    <!-- View massage -->
              <?php echo $form->messages(); ?>
                    <!-- View massage -->
              <?php echo message_box('success'); ?>
              <?php echo message_box('error'); ?>
             <div class="row">
  <div class="col-sm-12">
  <div class="row">
   <?php echo $form->open(); ?>
   	<div class="col-sm-12 file-upload text-center">
   		<i class="fa fa-upload" aria-hidden="true"></i>
   		<h3>Choose the file to be imported</h3>
   		<p>[only xls and csv formats are supported]<br>maximum upload file size is 2 MB</p>
		<label for="upload" class="file-upload__label">Import File</label>
		<input id="upload" class="file-upload__input" type="file"name="import">
	</div>
	 <input class="btn bg-navy" style="float:right;"name="submit" type="submit" value="<?= lang('import') ?>">
	
  	<div class="col-sm-12 table-responsive file_table_sec">
	  <?php echo $form->close(); ?>
  	<h4>Example:</h4>
  		<table class="table">
  			<thead>
  				<tr>
  					<th></th>
  					<th>A</th>
  					<th>B</th>
  					<th>C</th>	
  					<th>D</th>
  				</tr>
  			</thead>
  			<tbody>
  				<tr>
  					<td>#</td>
  					<td>Shift Name</td>
  					<td>From</td>
  					<td>To</td>
  					<td>Employee ID</td>
  				</tr>
  				<tr>
  					<td>1</td>
  					<td>General</td>
  					<td>01/11/2019</td>
  					<td>07/11/2019</td>
  					<td>1001</td>
  				</tr>
  				<tr>
  					<td>2</td>
  					<td>General</td>
  					<td>01/11/2019</td>
  					<td>07/11/2019</td>
  					<td>1002</td>
  				</tr>
  				<tr>
  					<td>3</td>
  					<td>General</td>
  					<td>01/11/2019</td>
  					<td>07/11/2019</td>
  					<td>1003</td>
  				</tr>
  			</tbody>
  		</table>
  	</div>
   </div>
   </div>	   
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>
                <?php echo $form->close(); ?>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= lang('view_instructions') ?></h4></a>
            </div>
            <div class="modal-body form">
				<p> <i class="fa fa-check"></i>   First Name Require</p>
				 <p><i class="fa fa-check"></i>   First Name Not Only Number</p>
				 <p> <i class="fa fa-check"></i>  Last Name also have above two Line</p>
				 <p> <i class="fa fa-check"></i>  Location ID Require</p>
            </div>		
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php  if(isset($table)){ 
?>
 <div class="row">
<div class="col-md-12">
<div class="container">
 <?php echo form_open('admin/employee/EmployeeSheet_save', array('class' => 'form-horizontal employeesheet','id'=>'employeesheet')) ?>
<?php  echo $table; ?>
<button type="submit" class="btn bg-navy btn-flat" id="Addsheet"> Save Sheet</button>
  <?php echo form_close() ?>
</div>
</div>
</div>
<?php
}
?>
<script>
$(function() {
 $('.datepicker').datepicker({
     format: "yyyy-mm-dd",
     autoclose: true,}).on('changeDate', function (ev)
	 {
     $(this).datepicker('hide');
});
});
    </script>
	<script>
	$(document).ready(function()
	{
		$('.incorrect').on('change',function()
		{
			$(this).css({"border-color": "#fff", 
             "border-width":"1px", 
             "border-style":"solid","color":"#777"})
		});
		
	});
	</script>
	<script>
	$('form').attr('autocomplete', 'off');
	</script>