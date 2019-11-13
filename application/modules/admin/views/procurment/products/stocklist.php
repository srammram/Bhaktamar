<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link href="<?php echo base_url('assets/procurement/css/theme.css')?>" rel="stylesheet"/>
<link href="<?php echo base_url('assets/procurement/css/style.css')?>" rel="stylesheet"/>

<script>
     $(document).ready(function () {
		 function img_hl(x) {
    var image_link = (x == null || x == '') ? 'no_image.png' : x;
    return '<div class="text-center"><a href="'+'<?php echo base_url()   ?>/assets/product/' + image_link + '" data-toggle="lightbox"><img src="'+'<?php echo base_url()   ?>assets/product/thumbs/' + image_link + '" alt="" style="width:30px; height:30px;" /></a></div>';
}
        oTable = $('#producttable').dataTable({
            "aaSorting": [[1, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": 10,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': "<?php echo  base_url()  ?>"+'admin/procurment/products/get_stocklist',
            'fnServerData': function (sSource, aoData, fnCallback) {
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{"bSortable": false}, {"bSortable": false, "mRender": img_hl},null,null,null,null,null,null, {"bSortable": false}]
        });
    }); 
</script>
<style>
	.dataTables_length{float: left;}
	.dataTables_filter{float: right;}
	.dataTables_info{float: left;}
	.dataTables_paginate {float: right;}
	.dataTables_filter input{height: 30px;padding: 0px;}
	.dataTables_length select{height: 30px;padding: 0px;}
	.box{padding-bottom: 15px;}
</style>
  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>&nbsp;
           
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/procurment/products') ?>"> <?php echo lang('stock')?> </a></li>
          </ol>
</section>
<form action="#" method="post" enctype="multipart/form-data">
<div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
	<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-folder-open"></i><?= lang('stock').' '.lang('list'); ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?php echo base_url('admin/procurment/products/add'); ?>" >
                                <i class="fa fa-plus"></i> <?= lang('add_product') ?>
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
                    <table id="producttable" class="table table-bordered ">
                        <thead>
                            <tr>
                            <th><?= lang("id"); ?></th>
                            <th><?= lang("image") ?></th>
							 <th><?= lang("code") ?></th>
                            <th><?= lang("barcode") ?></th>
                            <th><?= lang("name") ?></th>
							<th><?= lang("category") ?></th>
                            <th><?= lang("brand") ?></th>
                            <th><?= lang("alert_quantity") ?></th>
                                <th style="width:100px;"><?= lang("stock"); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="9" class="dataTables_empty">
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
<script type="text/javascript" src="<?php echo base_url('assets/procurement/js/bootstrap.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>