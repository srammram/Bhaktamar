<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/accounts/get_due_payment_list/',
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
        }, null, null, null, null, null,null,null,{
            "bSortable": false
        }]
    });
});
</script>
<style>
.dataTables_length {
    float: left;
}

.dataTables_filter {
    float: right;
}

.dataTables_info {
    float: left;
}

.dataTables_paginate {
    float: right;
}

.dataTables_filter input {
    height: 30px;
    padding: 0px;
}

.dataTables_length select {
    height: 30px;
    padding: 0px;
}

.box {
    padding-bottom: 15px;
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
        <li><a href="<?php echo site_url('admin/accounts/due_payment') ?>"> Due Payment List </a></li>
    </ol>
</section>
<form action="#" method="post" enctype="multipart/form-data">
    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-folder-open"></i> Due Payment List </h2>
                <div class="box-icon">
                    <ul class="btn-tasks">
                     
                    </ul>
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
										<th>Applicant Name</th>
                                        <th>Payment Plan Stage</th>
                                        <th>Percentage</th>
										<th>Total Amount</th>
										<th>Balance</th>
                                        <th>Due Amount</th>
                                        <th>Due Date</th>
                                       
                                        <th><?php echo lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="7" class="dataTables_empty">
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
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action" />
        <input type="submit">
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>