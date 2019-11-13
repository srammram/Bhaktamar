<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link href='<?php echo base_url('assets/assets/css/custom.css')?>' rel='stylesheet' media='screen'>

<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/payroll/office/workingDays') ?>"> <?= lang('set_working_days') ?> </a></li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>

    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><?= lang('set_working_days') ?></h2>
				<br>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open('admin/payroll/office/save_working_days'); ?>

            <div class="box-body">

                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12 col-md-offset-2" style="padding-top: 40px; padding-bottom: 40px">
                        <div class="row">
                                <?php foreach($workingDays as $days): ?>
                                <label class="css-input css-checkbox css-checkbox-success">

                                    <input type="checkbox" name="working_days[]" value="<?php echo $days->id ?>"
                                        <?php echo $days->flag == 1? 'checked':'' ?>><span></span> <?php echo $days->days ?>

                                    <input type="hidden" name="days[]" value="<?php echo $days->id ?>">
                                </label>
                                <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer ">
                    <button id="saveSalary" type="submit" class="btn bg-olive btn-flat col-md-offset-2"><?= lang('save') ?></button>
                </div>
            </div>
            <!-- /.box -->
            <?php echo form_close() ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
   

