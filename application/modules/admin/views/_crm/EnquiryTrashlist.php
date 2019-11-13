<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script src="<?php echo base_url('assets/admin')?>/dist/js/jquery1.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/admin')?>/dist/js/dataTables.bootstrap.min.js" charset="utf-8"></script>

<script>
     $(document).ready(function () {
        oTable = $('#UnitTable').dataTable({
            "aaSorting": [[1, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": 10,
            'bProcessing': true, 'bServerSide': true,
          'sAjaxSource': "<?php echo  base_url()  ?>"+'admin/crm/Crm/get_enquirys_trash',
            'fnServerData': function (sSource, aoData, fnCallback) {
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{"bSortable": false},null,null,null,null, {"bSortable": false}]
        });
    }); 
</script>
<style>
	.dataTables_length{float: left;}
	.dataTables_filter{float: right;}
	.dataTables_info{float: left;}
	.dataTables_filter input{height: 30px;padding: 0px;}
	.dataTables_length select{height: 30px;padding: 0px;}
	.box{padding-bottom: 15px;}
</style>
  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
              <h1 style="font-size:18px;font-weigh:bold;">
            <?php echo $page_title; ?>
			 <small><?php echo lang('list'); ?></small>
           </h1> 
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/crm/Crm/Enquiry') ?>"> <?php echo lang('enquiry_trash')." ".lang('list') ?> </a></li>
          </ol>
</section>

<div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
	<div class="box">
    <div class="box-header">
       <h2 class="blue"><i class="fa-fw fa fa-folder-open"></i><?php echo  lang('enquiry_trash')." ".lang('list'); ?></h2>
        <div class="box-icon">
           
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
                           
                               <th><?php echo lang('Enquiry_id'); ?></th>
								<th><?php echo lang('Customer_name'); ?></th>
							<th><?php echo lang('Enquiry_date'); ?></th>
			<th><?php echo lang('Project'); ?></th>
		<!--	<th><?php echo lang('Source_of_enquiry'); ?></th>-->
			<th><?php echo lang('email'); ?></th>
			
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

<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>
<script src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap3.3.min.js"></script>
