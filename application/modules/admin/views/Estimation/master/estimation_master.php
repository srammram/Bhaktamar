<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/ajax.js"></script>
<script>
$(document).ready(function() {
	 function img_hl(x) {
		 if(x ==1){
			 var actions = '<div class=\"text-center\">';
            actions += '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' +x+ ')"><i class="fa fa-pencil"></i></a>';
        actions += '</div>';
		 }else{
			 var actions = '<div class=\"text-center\">';
            actions += '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' +x+ ')"><i class="fa fa-pencil"></i></a>';
      actions +=  '<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' +x+ ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        actions += '</div>';
		 }
    return actions;
}
    oTable = $('#UnitTable').dataTable({
        "aaSorting": [
            [0, "desc"]
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "<?= lang('all') ?>"]
        ],
        "iDisplayLength": 10,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/Estimation/get_estimation_master',
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
        }, null, null, {
        "mData": "id",
        "sClass": "center",
        "mRender": function (data, type, full) {
			if(full[3] ==1){
			 var actions = '<div class=\"text-center\">';
            actions += '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' +full[0]+ ')"><i class="fa fa-pencil"></i></a>';
        actions += '</div>';
		 }else{
			 var actions = '<div class=\"text-center\">';
            actions += '<div class="btn-group"><a style="padding:6px;" class="btn btn-xs btn-default" href="javascript:void(0)" onclick="edit_title(' +full[0]+ ')"><i class="fa fa-pencil"></i></a>';
      actions +=  '<a class="btn btn-xs btn-danger" style="margin-left:6px;padding:6px;" href="javascript:void(0)"  onclick="deleteItem(' +full[0]+ ')"><i class="glyphicon glyphicon-trash"></i></a></div>';
        actions += '</div>';
		 }
    return actions;
        },}]
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
        <li><a href="<?php echo site_url('admin/Estimation/estimation_master') ?>"> <?= lang('estimation_master') ?> </a></li>
    </ol>
</section>
<div id="msg" class="col-md-8" style="margin:0 auto;"></div>
    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><?= lang('estimation_master').' '.('list') ?></h2>
                <div class="box-icon">
                    <a style="margin:4px;" class="btn btn-default btn-sm btn-flat" onclick="add()"><i
                     class="fa fa-fw fa-plus"></i><?= lang('add') ?></a>
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
                                        <th><?= lang("name"); ?></th>

                                        <th><?= lang("description"); ?></th>
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
                <h4 class="modal-title"><?= lang('add') ?></h4>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?= lang('Name') ?></label>
                            <div class="col-md-9">
                                <input name="name" class="form-control" type="text">
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
var saveRow = 'admin/Estimation/add_estimation_master';
var edit = 'admin/Estimation/update_estimation_master';
var deleteRow = 'admin/Estimation/delete_estimation_master/';
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
        url: "<?php echo site_url('admin/Estimation/edit_estimation_master/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.Name);
            $('[name="description"]').val(data.description);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit '); // Set title to Bootstrap modal title

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}
</script>