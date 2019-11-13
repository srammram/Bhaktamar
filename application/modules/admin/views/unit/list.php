<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
$(document).ready(function() {
    oTable = $('#UnitTable').dataTable({
        "aaSorting": [
            [0, "asc"]
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "<?= lang('all') ?>"]
        ],
        "iDisplayLength": 10,
        'bProcessing': true,
        'bServerSide': true,
        'sAjaxSource': "<?php echo  base_url()  ?>" + 'admin/unit/get_units',
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
        }, null, null, null, null, null,null, {
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
      <?= lang('Units')  ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li class="active"><?php echo lang('Units'); ?></li>
    </ol>
</section>
<form action="#" method="post" enctype="multipart/form-data">
    <div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-folder-open"></i><?= lang('Units').' '.lang('list'); ?></h2>
                <div class="box-icon">
                    <ul class="btn-tasks">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon fa fa-tasks tip" data-placement="left"
                                    title="<?= lang("actions") ?>"></i>
                            </a>
                            <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                                <li>
                                    <a href="<?php echo base_url('admin/unit/form'); ?>">
                                        <i class="fa fa-plus"></i> <?= lang('Add_Unit') ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
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
                                        <th><?php echo lang('Unit_no'); ?></th>
                                        <th><?php echo lang('floor'); ?></th>
										 <th><?php echo lang('building'); ?></th>
                                        <th><?php echo lang('Project'); ?></th>
                                        <th><?php echo lang('House_details'); ?></th>
                                        <th><?php echo lang('status'); ?></th>
                                        <th><?php echo lang('action'); ?></th>
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
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action" />
        <input type="submit">
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js">
</script>