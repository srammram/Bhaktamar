<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link href='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.css' rel='stylesheet'
    media='screen'>
<link href='<?php echo base_url('assets/admin')?>/plugins/select2/select2.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url('assets/admin')?>/plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet'
    media='screen'>
<link href='<?php echo base_url()?>assets/assets/css/custom.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/daterangepicker/daterangepicker-bs3.css' rel='stylesheet'
    media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/datepicker/datepicker3.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/timepicker/bootstrap-timepicker.min.css' rel='stylesheet'
    media='screen'>
<style>
.btn-group {
    width: 100%;
}

.multiselect {
    width: 100%;
}

.multiselect-container {
    width: 100%;
}
</style>
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>
        &nbsp;
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/payroll/employee/addEmployee') ?>"> <?php echo lang('add_employee')?>
            </a></li>

    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="<?php echo site_url('admin') ?>/payroll/employee/saveEmployee" id="create_employee"
                        class="create_employee" enctype="multipart/form-data" method="post" accept-charset="utf-8"
                        autocomplete="off">



                        <div class="row">
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= lang('first_name') ?><span class="required"
                                                    aria-required="true">*</span></label>
                                            <input type="text" name="first_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= lang('last_name') ?><span class="required"
                                                    aria-required="true">*</span></label>
                                            <input type="text" name="last_name" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-6">

                                        <!-- /.Start Date -->
                                        <div class="form-group form-group-bottom">
                                            <label><?= lang('date_of_birth') ?><span class="required"
                                                    aria-required="true">*</span></label>

                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" id="datepicker"
                                                    name="date_of_birth" data-date-format="yyyy/mm/dd" onkeydown="return false" >
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar-o"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= lang('marital_status') ?></label>
                                            <select class="form-control" name="marital_status">
                                                <option value=""><?= lang('please_select') ?>..</option>
                                                <option value="Single"><?= lang('singel') ?></option>
                                                <option value="Married"><?= lang('married') ?></option>
                                                <option value="Widowed"><?= lang('Widowed') ?></option>
                                                <option value="Divorced"><?= lang('Divorced') ?></option>
                                                <option value="Separated"><?= lang('Separated') ?></option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= lang('country') ?></label>
                                            <select class="form-control select2" name="country">
                                                <option value=""><?= lang('please_select') ?>..</option>
                                                <?php foreach($countries as $item){ ?>
                                                <option value="<?php echo $item->country ?>">
                                                    <?php echo $item->country ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= lang('Employee_type') ?></label>
                                            <select class="form-control select2" name="EmployeeType_id">
                                                <option value=""><?= lang('please_select') ?>..</option>
                                                <?php foreach($employee_type as $item){ ?>
                                                <option value="<?php echo $item->Employee_Type_id ?>">
                                                    <?php echo $item->Name ?></option>
                                                <?php } ?>

                                            </select>

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= lang('Category_type') ?></label>
                                            <select class="form-control select2" name="Category_id">
                                                <option value=""><?= lang('please_select') ?>..</option>
                                                <?php foreach($category_settings as $item){ ?>
                                                <option value="<?php echo $item->id ?>">
                                                    <?php echo $item->Categoryname ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?= lang('blood_group') ?></label>
                                            <select class="form-control select2" name="blood_group">
                                                <option value=""><?= lang('please_select') ?>..</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                                <option value="O-positive">O-positive</option>
                                                <option value="O-negative">O-negative</option>
                                                <option value=" A-positive"> A-positive</option>
                                                <option value="A-negative">A-negative</option>
                                                <option value="B-positive">B-positive</option>
                                                <option value="B-negative">B-negative</option>
                                                <option value="AB-positive">AB-positive</option>
                                                <option value="AB-negative">AB-negative</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label><?= lang('id_number') ?></label>
                                    <input type="text" name="id_number" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label><?= lang('religious') ?> </label>
                                    <select class="form-control select2" name="religious">
                                        <option value=""><?= lang('please_select') ?>..</option>
                                        <option value="Christians">Christians</option>
                                        <option value="Muslims">Muslims</option>
                                        <option value="Hindus">Hindus</option>
                                        <option value="Buddhists">Buddhists</option>
                                        <option value="Jews">Jews</option>
                                    </select>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?= lang('gender') ?></label>
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="gender" value="Male" checked
                                                    type="radio"><span></span><?= lang('male') ?>
                                            </label>
                                            <label class="css-input css-radio css-radio-success push-10-r">
                                                <input name="gender" value="Female"
                                                    type="radio"><span></span><?= lang('female') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>



                                <!-- /.Employee Image -->
                                <div class="form-group">
                                    <label><?= lang('Photograph') ?></label>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="employee_photo" id="file-1" class="inputfile inputfile-1 "
                                        style="display:none;" data-multiple-caption="{count} files selected" />
                                    <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                            viewBox="0 0 20 17">
                                            <path
                                                d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                            </svg> <span>Choose a file&hellip;</span></label>

                                </div>
                                <!-- /.Employee Image -->
                                <p class="text-muted">Accepts jpg, .png, .gif up to 1MB. Recommended dimensions: 200px X
                                    200px</p>
                                <p class="text-muted"><span class="required"
                                        aria-required="true">*</span><?= lang('required_field') ?></p>

                            </div>

                        </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">

                    <button type="submit" class="btn bg-navy btn-flat" id="addemployee">
                        <?= lang('save_employee')?></button>
                    <a style="padding:6px;background-color:#d81b60 !important;color:#fff;margin-left:21px;"
                        href="<?php echo base_url();  ?>/admin/employee/employeeList" class="button">Cancel</a>
                </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </div><!-- /.col -->
    </div><!-- /.row -->
</section>

</section>

<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.js'></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/select2/select2.full.min.js'></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/fullcalendar/fullcalendar.min.js'></script>
<script type="text/javascript" src="<?php echo base_url('assets/assets')?>/js/forms_validation.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#my-select').multiselect();
});
</script>
<script>
$(function() {
    $('.datepicker').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd',
    });
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
</script>

<script>
$('#month').data("DateTimePicker").hide();
</script>