<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>
<link href='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.css' rel='stylesheet'media='screen'>
<link href='<?php echo base_url('assets/admin')?>/plugins/select2/select2.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/daterangepicker/daterangepicker-bs3.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/datepicker/datepicker3.css' rel='stylesheet' media='screen'>
<link href='<?php echo base_url()?>assets/assets/plugin/timepicker/bootstrap-timepicker.min.css' rel='stylesheet' media='screen'>
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/payroll/office/Shift_roster') ?>"> <?= lang('add_Shift_roster') ?> </a>
        </li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>
<div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
    <div class="box">
        <div class="box-header">
            <h2 class="blue"><?= lang('add_Shift_roster') ?></h2>
        </div>
        <div class="box-content">
            <?php echo form_open('admin/payroll/Office/Shift_roster_save', array('class' =>'form-horizontal','id'=>'myform')) ?>
            <div class="panel-body">
                <div class="panel_controls">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?= lang('department') ?> <span
                                class="required">*</span></label>
                        <div class="col-sm-5">
                            <select name="department_id" id="department" class="form-control"
                                onchange="get_employee(this.value)">
                                <option value=""><?= lang('select_department') ?>...</option>
                                <?php foreach ($department as $v_department) : ?>
                                <option value="<?php echo $v_department->id ?>">
                                    <?php echo $v_department->department ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?= lang('Employee_id') ?> <span
                                class="required">*</span></label>
                        <div class="col-sm-5">
                            <select class="select2 form-control" multiple="multiple" style="width: 100%;"
                                name="employee_id[]" id="employee">
                                <option value=""><?= lang('please_select') ?>...</option>
                                <?php foreach ($all_department as $v_department) : ?>
                                <option value="<?php echo $v_department->id ?>" <?php
                                 if (!empty($department_id)) {
                                     echo $v_department->id == $department_id ? 'selected' : '';
                                 }  
                                 ?>>
                                    <?php echo $v_department->department ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?= lang('Shift_name') ?> <span
                                class="required">*</span></label>
                        <div class="col-sm-5">
                            <select name="Shiftname[]" class="form-control select2" multiple="multiple">

                                <option value=""><?= lang('please_select') ?></option>
                                <?php foreach($work_shift as $item){ ?>
                                <option value="<?php echo $item->id ?>">
                                    <?php echo  $item->shift_name; ?>
                                </option>
                                <?php } ?>

                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?= lang('date') ?></label>
                        <div class="input-group col-sm-6">
                            <input type="text" class="form-control datepicker" id="startdate" placeholder="From " name="from"
                                data-date-format="yyyy/mm/dd" onkeydown="return false" >
                            <div class="input-group-addon">
                                <i class="fa fa-calendar-o"></i>
                            </div>

                            <input type="text" class="form-control datepicker" id="enddate" placeholder="To " name="to"
                                data-date-format="yyyy/mm/dd" required onkeydown="return false" > 
                            <div class="input-group-addon">
                                <i class="fa fa-calendar-o"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" id="sbtn" name="sbtn" value="1"
                                class="btn bg-olive btn-flat btn-md"><?= lang('go') ?></button>
                        </div>
                    </div>
                </div>

            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.js'></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/select2/select2.full.min.js'></script>

<script>
$(".select2").select2();
</script>
<script>
$("#sbtn").click(function() {
    $("#myform").validate({
        excluded: ':disabled',
        rules: {
            to: {
                greaterThan: "#startdate"
            },
            from: {
                required: true
            },
            department_id: {
                required: true
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