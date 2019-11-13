<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>
<link href='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.css' rel='stylesheet' media='screen'>

<script>
$(document).ready(function() {
    oTable = $('#workshifttable').dataTable({
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
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/payroll/office/get_workshift',
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
        }, null, null,null, {
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
        <li><a href="<?php echo site_url('admin/payroll/office/workShift') ?>"> <?= lang('work_shift') ?> </a></li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>

    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><?= lang('work_shift') ?></h2>
                <div class="box-icon">
                    <a style="margin:4px;" class="btn btn-default btn-sm btn-flat" onclick="add()"><i
                     class="fa fa-fw fa-plus"></i><?= lang('add_work_shift') ?></a>

                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?= lang('list_results'); ?></p>
                        <div class="table-responsive col-sm-12">
                            <table id="workshifttable" class="table table-bordered table-hover table-striped reports-table">
                                <thead>
                                    <tr>
                                        <th><?= lang("id"); ?></th>
                                         <th><?= lang('shift_name') ?></th>
                                    <th style="width:125px;"><?= lang('shift_form') ?></th>
                                    <th style="width:125px;"><?= lang('shift_to') ?></th>
                                    <th style="width:125px;"><?= lang('actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="dataTables_empty">
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
   <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>
<script src='<?php echo base_url('assets/admin')?>/plugins/timepicker/bootstrap-timepicker.min.js'></script>
<script>
    var save_method; //for save method string
    var table;
    var list        = 'admin/payroll/office/work_shift_list'; //list view
    var saveRow     = 'admin/payroll/office/add_work_shift';
    var edit        = 'admin/payroll/office/update_work_shift';
    var deleteRow   = 'admin/payroll/office/delete_work_shift/';
    var saveSuccess = "<?php echo $this->message->success_msg() ?>" ;
    var deleteSuccess = "<?php echo $this->message->delete_msg() ?>" ;
    var deleteError = "<?php echo lang('record_has_been_used'); ?>" ;
    function edit_title(id){

        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/payroll/office/edit_work_shift/')?>/" + id,
            type: "GET",
            data : {'csrf_test_name' : getCookie('csrf_cookie_name')},
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.id);
                $('[name="shift_name"]').val(data.shift_name);
                $('[name="shift_form"]').val(data.shift_form);
                $('[name="shift_to"]').val(data.shift_to);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('<?= lang('edit_work_shift') ?>'); // Set title to Bootstrap modal title

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

</script>





<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= lang('add_work_shift') ?></h4>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('shift_name') ?></label>
                            <div class="col-md-9">
                                <input name="shift_name"  class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="control-label col-md-3"><?= lang('shift_form') ?></label>
                       
                                        <div class="input-group bootstrap-timepicker timepicker" >
                                            <input style="margin-left:16px;" id="timepicker1" name="shift_form" class="form-control" data-provide="timepicker" value="<?= date("h:i A"); ?>"  data-date-format="HH:ii p" type="text"/>
                                        <span class="help-block"></span>

                                </div>
                            </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('shift_to') ?></label>
                           
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input id="timepicker2" style="margin-left:16px;" name="shift_to" class="form-control" data-provide="timepicker"  value="<?= date("h:i A"); ?>" data-date-format="HH:ii p" type="text"/>
                                </div>
                                <span class="help-block"></span>
                            
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
<!-- End Bootstrap modal -->

<script>
    $(document).ready(function() {
        $("#timepicker1").timepicker({
            showInputs: false,
            defaultTime: 'current',

        });

        $("#timepicker2").timepicker({
            showInputs: false,
            defaultTime: 'current',
        });
    })
</script>
<script>
	$('form').attr('autocomplete', 'off');
	</script>
