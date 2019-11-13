<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>

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


<script>
$(document).ready(function() {
    oTable = $('#UnitTable').dataTable({
        "aaSorting": [
            [1, "asc"]
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "<?= lang('all') ?>"]
        ],
        "iDisplayLength": 10,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/payroll/employee/get_adavancelist',
        'fnServerData': function(sSource, aoData, fnCallback) {
            $.ajax({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback
            });
        },
        "aoColumns": [{
            "bSortable": false
        }, null, null, null, null, null, null, {
            "bSortable": false
        }]
    });
});
</script>
<style>
.modal-header {
    background-color: #0083ad !important;
    color: #fff;
}
</style>
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/payroll/employee/AdvanceList') ?>"> <?= lang('Advance_payment_list') ?>
            </a></li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>
<div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
    <div class="box">
        <div class="box-header">
            <h2 class="blue"><?= lang('Advance_payment_list') ?></h2>
            <div class="box-icon">
                <a style="margin:4px;" class="btn btn-default btn-sm btn-flat" onclick="add()"><i
                        class="fa fa-fw fa-plus"></i><?= lang('Add_advance') ?></a>
            </div>
        </div>
        <div class="box-content">
            <div class="row">
                <div class="col-lg-12">
                    <p class="introtext"><?= lang('list_results'); ?></p>
                    <div class="table-responsive col-sm-12">
                        <table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
                            <thead>
                                <tr>
                                    <th><?= lang("id"); ?></th>
                                    <th><?= lang('employee_id') ?></th>
                                    <th><?= lang('employee_name') ?></th>
                                    <th><?= lang('Advance_Date') ?></th>
                                    <th><?= lang('Advance_amount') ?></th>
                                    <th><?= lang('Advance_purpose') ?></th>
                                    <th><?= lang('status') ?></th>
                                    <th style="width:100px;"><?= lang("actions"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" class="dataTables_empty">
                                        <?= lang('loading_data_from_server') ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= lang('Add_advance') ?></h4>
            </div>
            <div class="modal-body form" style="position: relative;padding: 21px;">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label><?= lang('department') ?><span class="required">*</span></label>
                            <select class="form-control select2" name="department_id" id="department"
                                onchange="get_employee(this.value)">
                                <option value=""><?= lang('please_select') ?></option>
                                <?php foreach($department as $item){ ?>
                                <option value="<?php echo $item->id ?>">
                                    <?php echo $item->department ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('employee') ?><span class="required">*</span></label>
                            <select class="form-control select2" name="employee_id" id="employee">
                                <option value=""><?= lang('please_select') ?></option>
                                <?php foreach($employee as $item){ ?>
                                <option value="<?php echo $item->id ?>">
                                    <?php echo  $item->first_name.' '.$item->last_name ?>
                                </option>
                                <?php } ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label><?= lang('Advance_purpose') ?><span class="required">*</span></label>
                            <input type="text" class="form-control" name="purpose">
                        </div>

                        <div class="form-group">
                            <label><?= lang('amount') ?></label>
                            <input type="text" class="form-control allowdecimalpoint" name="Amounts">
                        </div>
                        <!--
    <div class="form-group">
        <label><?= lang('Tenure') ?></label>
        <input type="text" class="form-control digits" name="tenure" value="<?php if(!empty($advance->Tenture)) echo $advance->Tenture ?>">
    </div>
-->
                        <div class="form-group">
                            <label><?= lang('Advance_Date') ?></label>
                            <div class="input-group">
                                <input type="text" name="advancedatte" id="date" class="form-control datepicker" onkeydown="return false">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
            </div>


            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><?= lang('save') ?></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?= lang('cancel') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>

<script src='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.js'></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/select2/select2.full.min.js'></script>

<script>
$('#month').on('changeDate', function() {
    $(this).datepicker('hide');
});
</script>
<script>
$('form').attr('autocomplete', 'off');
</script>

<script>
var save_method; //for save method string
var table;
var saveRow = 'admin/payroll/employee/add_advance';
var edit = 'admin/payroll/employee/update_advance';
var deleteRow = 'admin/payroll/employee/delete_advance/';

var saveSuccess = "<?php echo $this->message->success_msg() ?>";
var deleteSuccess = "<?php echo $this->message->delete_msg() ?>";
var deleteError = " <?php echo lang('record_has_been_used'); ?>";

function edit_title(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo site_url('admin/payroll/employee/edit_advance/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            console.log(data);
            $('[name="id"]').val(data.id);
            //$('#department').val(data.department_id).trigger('change');
            $('#department').val(data.department_id);
            $('#employee').append(data.scalar).trigger('change');
            //$('#employee').val(data.employee_id).trigger('change');

            $('[name="employee_id"]').val(data.employee_id);
            $('[name="purpose"]').val(data.Purpose);
            $('[name="Amounts"]').val(data.Amount_amount);
            $('[name="advancedatte"]').val(data.Advance_date);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Department'); // Set title to Bootstrap modal title

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}
</script>