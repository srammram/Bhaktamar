<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>
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
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/payroll/employee/get_employee',
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
        <li><a href="<?php echo site_url('admin/payroll/employee/employeeList') ?>"> <?= lang('employee_list') ?> </a>
        </li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>
<div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
    <div class="box">
        <div class="box-header">
            <h2 class="blue"><?= lang('employee_list') ?></h2>

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
                                    <th><?= lang('department') ?></th>
                                    <th><?= lang('job_title') ?></th>
                                    <th><?= lang('employment_status') ?></th>
                                    <th><?= lang('shift') ?></th>
                                    <th style="width:100px;"><?= lang("actions"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8" class="dataTables_empty">
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
                <h4 class="modal-title"><?= lang('add_department') ?></h4>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('department') ?></label>
                            <div class="col-md-9">
                                <input name="department" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('description') ?></label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control"></textarea>
                                <span class="help-block"></span>
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

<script>
var save_method; //for save method string
var table;
var saveRow = 'admin/payroll/office/add_department';
var edit = 'admin/payroll/office/update_department';
var deleteRow = 'admin/payroll/office/delete_department/';
var saveSuccess = "<?php echo $this->message->success_msg() ?>";
var deleteSuccess = "<?php echo $this->message->delete_msg() ?>";
var deleteError = "<?php echo lang('record_has_been_used'); ?>";

function edit_title(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo site_url('admin/payroll/office/edit_department/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="department"]').val(data.department);
            $('[name="description"]').val(data.description);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Department'); // Set title to Bootstrap modal title

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}
</script>