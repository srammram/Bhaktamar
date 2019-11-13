<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link href="<?php echo base_url('assets/procurement/css/theme.css')?>" rel="stylesheet"/>
<link href="<?php echo base_url('assets/procurement/css/style.css')?>" rel="stylesheet"/>
<script>
	$(window).load(function(e) {
        localStorage.clear();
    });
    $(document).ready(function () {
        oTable = $('#purchase_invoicesTable').dataTable({
            "aaSorting": [[1, "desc"], [2, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=lang('all')?>"]],
            "iDisplayLength": 10,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?=base_url('admin/procurment/purchase_invoices/getPurchase_invoices')?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
               
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
           "aoColumns": [{"bSortable": false}, null,null,null,null,null,null,null,null,null,null,null, {"bSortable": false}]

       
    });
	 });

</script>

<section class="content-header">
          <h2>
          <?php echo lang('purchase_invoices')?>
           </h2>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/procurment/products') ?>"> <?php echo lang('purchase_invoices')?> </a></li>
          </ol>
</section>
<div class="col-sm-12 col-xs-12 table_sec" style="margin-top: 15px;" >
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-star"></i><?=lang('purchase_invoices') ;?>
        </h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip" data-placement="left" title="<?=lang("actions")?>"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?=base_url('admin/procurment/purchase_invoices/add')?>">
                                <i class="fa fa-plus-circle"></i> <?=lang('add_purchase_invoices')?>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> <?=lang('export_to_excel')?>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="combine" data-action="combine">
                                <i class="fa fa-file-pdf-o"></i> <?=lang('combine_to_pdf')?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="bpo" title="<b><?=lang("delete_purchase_invoices")?></b>"
                                data-content="<p><?=lang('r_u_sure')?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?=lang('i_m_sure')?></a> <button class='btn bpo-close'><?=lang('no')?></button>"
                                data-html="true" data-placement="left">
                                <i class="fa fa-trash-o"></i> <?=lang('delete_purchase_invoices')?>
                            </a>
                        </li> -->
                    </ul>
                </li>
                <?php if (!empty($warehouses)) {
                    ?>
                    <!--<li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip" data-placement="left" title="<?=lang("warehouses")?>"></i></a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?=admin_url('procurment/purchase_invoices')?>"><i class="fa fa-building-o"></i> <?=lang('all_warehouses')?></a></li>
                            <li class="divider"></li>
                            <?php
                            	foreach ($warehouses as $warehouse) {
                            	        echo '<li ' . ($warehouse_id && $warehouse_id == $warehouse->id ? 'class="active"' : '') . '><a href="' . base_url('procurment/purchase_invoices/' . $warehouse->id) . '"><i class="fa fa-building"></i>' . $warehouse->name . '</a></li>';
                            	    }
                                ?>
                        </ul>
                    </li>-->
                <?php }
                ?>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?=lang('list_results');?></p>

                <div class="table-responsive">
                    <table id="purchase_invoicesTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered ">
                        <thead>
                        <tr class="active">
                                <th><?= lang("id"); ?></th>
                            <th><?= lang("date"); ?></th>
                            <th><?= lang("pi_no"); ?></th>
						<!--	<th><?= lang("po_no"); ?></th> -->
                            <th><?= lang("invoice_no"); ?></th>
                            <th><?= lang("supplier"); ?></th>
                            <th><?= lang("gross_total"); ?></th>
                            <th><?= lang("total_discount"); ?></th>
                            <th><?= lang("total_tax"); ?></th>
							<th><?= lang("other_charges"); ?></th>
                            <th><?= lang("round_off"); ?></th>
                            <th><?= lang("net_amt"); ?></th>        
                            <th><?= lang("status")?></th>
						<!--	<th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th> -->
                            <th style="width:100px;"><?= lang("actions"); ?></th> 
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="11" class="dataTables_empty"><?=lang('no data found');?></td>
                        </tr>
                        </tbody>
                        <tfoot class="dtFilter" style="display: none">
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?= lang("total"); ?></th>                           
                            <th><?= lang("total_discount"); ?></th>
                            <th><?= lang("total_tax"); ?></th>
                            <th><?= lang("grand_total"); ?></th>
                            <th></th>
                            <th></th>
			    <th></th>
                            <th style="width:100px; text-align: center;"><?= lang("actions"); ?></th>
                        </tr>
                        </tfoot>
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