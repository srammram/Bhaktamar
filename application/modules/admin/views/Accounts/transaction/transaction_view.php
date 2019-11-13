<script src="<?php echo site_url('assets/assets/js/dataTableAjax.js') ?>"></script>
<link href="<?php echo site_url('assets/assets/')   ?>/plugin/datatables/jquery.dataTables.min.css" rel='stylesheet' media='screen'>
<link href="<?php echo site_url('assets/assets/')   ?>plugin/datatables/buttons.bootstrap.min.css" rel='stylesheet' media='screen'>
<link href="<?php echo site_url('assets/assets/')   ?>plugin/datatables/fixedHeader.bootstrap.min.css" rel='stylesheet' media='screen'>
<link href="<?php echo site_url('assets/assets/')   ?>plugin/datatables/responsive.bootstrap.min.css" rel='stylesheet' media='screen'>
<link href="<?php echo site_url('assets/assets/')   ?>plugin/datatables/scroller.bootstrap.min.css" rel='stylesheet' media='screen'>
<section class="content-header">
    <h1>
        <?php echo $page_title;   ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/accounts/view') ?>"> <?php echo lang('view_transaction')?> </a></li>
       
    </ol>
</section>
<section class="content">
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border bg-primary-dark">
                <h3 class="box-title"><?php echo $title ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">

                <!-- View massage -->
                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div id="msg"></div>
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th><?= lang('trns_id') ?></th>
                                <?php if($column != 'account_id'){ ?>
                                <th><?= lang('account') ?></th>
                                <?php } ?>
                                <?php if($column != 'transaction_type_id'){ ?>
                                <th><?= lang('type') ?></th>
                                <?php } ?>
                                <?php if($column != 'category_id'){ ?>
                                    <th><?= lang('category') ?></th>
                                <?php } ?>
                                <th><?= lang('dr') ?>.</th>
                                <th><?= lang('cr') ?>.</th>
                                <th><?= lang('balance') ?></th>
                                <th><?= lang('date') ?></th>
                                <th style="width:25px;"><?= lang('actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
</div>
<script src="<?php echo site_url('assets/assets/')   ?>/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/buttons.bootstrap.min.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/jszip.min.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/pdfmake.min.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/vfs_fonts.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/buttons.html5.min.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/buttons.print.min.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/dataTables.keyTable.min.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo site_url('assets/assets/')   ?>plugin/datatables/responsive.bootstrap.min.js"></script>
<script src="plugin/datatables/dataTables.scroller.min.js"></script>
<script>
    //var table;
    var list       = '<?php echo base_url();  ?>admin/accounts/transaction_view/'+'<?php echo $column.'-'.$id ?>';
</script>



