<style>
.incorrect
{
	border:1px solid red;
	color:#a80505;
}
.correct
{
	background-color:#fff;border:1px solid #fff
}
.table-responsiveygy tr td input{border:none;background-color:transparent;width:100%;overflow-x:scroll;}
.table-responsiveygy tr td input:focus{border:none;outline:none;box-shadow:none;}
.table-responsiveygy tr td{border:1px solid #ddd;padding-left:8px;}
.table-responsiveygy tr th{background-color:#29648a;border:1px solid;padding:5px 5px 5px 8px;color:#fff;}
</style>
<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?= lang('import_employee') ?>
                    </h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->

                <?php echo $form->open(); ?>
                <div class="box-body">
                    <!-- View massage -->
                    <?php echo $form->messages(); ?>
                    <!-- View massage -->
                    <?php echo message_box('success'); ?>
                    <?php echo message_box('error'); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="msg"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?= lang('import_employee') ?></label>
                                                <input type="file" name="import" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input class="btn bg-navy" name="submit" type="submit" value="<?= lang('import') ?>">
                        </div>
                        <div class="col-md-6">
                            <strong><?= lang('download_sample_csv_file') ?></strong><br/>
                            <a href="<?php echo site_url('admin/employee/downloadEmployeeSample')?>"><i class="fa fa-download" aria-hidden="true"></i> <?= lang('sample_csv_file') ?></a><br>
							<br>
							<a href="javascript:void(0);"><i class="fa fa-eye" aria-hidden="true" data-toggle="modal" data-target="#modal_form"> <?= lang('view_instructions') ?></i></a>
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
<!-- Bootstrap modal -->
<!-- Bootstrap modal -->
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
            </div>		
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php  if(isset($table))
{ 
?>
<div class="row">
	<div class="col-md-12">
		<div class="container" style="width:100%">
			<div class="table-responsiveygy">
				<?php echo form_open('admin/employee/EmployeeSheet_save', array('class' => 'form-horizontal employeesheet','id'=>'employeesheet')) ?>
				<?php  echo $table; ?>
				<button type="submit" class="btn bg-navy btn-flat" id="Addsheet"> Save Sheet</button>
				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>
<?php
}
?>

  <script type="text/javascript">
   $(document).ready(function() {
	   
     jQuery.validator.addMethod("accept", function(value, element, param) {
  return value.match(new RegExp("." + param + "$"));
},'Charater Only');
     jQuery.validator.addMethod("minAge", function(value, element, min) {
    var today = new Date();
	//var match = /(\d+)\/(\d+)\/(\d+)/.exec(value)
//var birthDate = new Date(match[3], match[2], match[1]);
    var birthDate = new Date(value);
    var age = today.getFullYear() - birthDate.getFullYear();
//console.log(birthDate);
    if (age > min+1) {
        return true;
    }
 
    var m = today.getMonth() - birthDate.getMonth();
 
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
 
    return age >= min;
}, "You are not old enough(18<)!");
        $('form.employeesheet').on('submit', function(event) {

            // adding rules for inputs with class 'comment'
            $('input.names').each(function() {
                $(this).rules("add", 
                    {
                        required: true,
						// accept: "[a-zA-Z]+"
						
                    })
            });  
              $('input.marital').each(function() {
                $(this).rules("add", 
                    {
                        required: true,
						// accept: "[a-zA-Z]+"
                    })
            });  
               $('input.gender').each(function() {
                $(this).rules("add", 
                    {
                        required: true,
						// accept: "[a-zA-Z]+"
                    })
            });  			

            /* $('input.dob').each(function() {
                $(this).rules("add", 
                    {
                        required: true,
						// minAge:18
                    })
            });  */
            // prevent default submit action         
          //  event.preventDefault();

            // test if form is valid 
            if($('form.employeesheet').validate().form()) {
                console.log("validates");
            } else {
                console.log("does not validate");
				 event.preventDefault();
            }
        })
        // initialize the validator
        $('form.employeesheet').validate();

   });
</script>
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