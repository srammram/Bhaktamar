<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>
      <?= lang('Import_unit') ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li class="active"><?php echo lang('Import_unit'); ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?= lang('Import_unit') ?>
                    </h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->

                <?php echo form_open() ?>
                <div class="box-body">
                    <!-- View massage -->
                    
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
                                                <label><?= lang('Import_unit') ?></label>
                                                <input type="file" name="import" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input class="btn bg-navy" name="submit" type="submit" value="<?= lang('import') ?>">
                        </div>
                        <div class="col-md-6">
                            <strong><?= lang('download_sample_file') ?></strong><br/>
                            <a href="<?php echo site_url('admin/unit/downloadUnitsSample')?>"><i class="fa fa-download" aria-hidden="true"></i> <?= lang('download_sample_file') ?></a><br>
							<br>
							
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

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