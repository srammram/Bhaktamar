<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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
          <h1>
           &nbsp;
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/settings/unitIntension') ?>"> <?php echo lang('unit_intension')?> </a></li>
          </ol>
</section>
<form action="#" method="post" enctype="multipart/form-data">
<div class="col-sm-12 col-xs-12" style="margin-top: 15px;">
	<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-folder-open"></i><?= lang('unit_intension').''.lang('list'); ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?php echo base_url('admin/settings/unitIntensionForm'); ?>" >
                                <i class="fa fa-plus"></i> <?= lang('add_unit_intension') ?>
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
                                <th><?= lang("name"); ?></th>
                                <th><?= lang("description"); ?></th>
                                <th style="width:100px;"><?= lang("actions"); ?></th>
                            </tr>
                        </thead>
                        <tbody>
						<?php   if(!empty($intension)){ $i=1; foreach($intension as $row){  ?>
                            <tr>
						     	<td ><?php  echo $i  ; ?></td>
                                <td ><?php  echo $row->name  ; ?></td>
								<td ><?php  echo $row->description  ; ?></td>
								<td >
								<div class="text-center"><a href="<?php  echo base_url('admin/vendor/pmc_view/'.$row->intension_id);  ?>" class="tip"><i class="fa fa-eye"></i></a> <a href="<?php  echo base_url('admin/vendor/pmc_form/'.$row->intension_id);  ?>" class="tip"><i class="fa fa-edit"></i></a> 
								<?php if($row->flag !=1){ ?>
								<a href="<?php  echo base_url('admin/vendor/pmc_delete/'.$row->intension_id);  ?>" class="tip po" onclick="return areyousure(this)"><i class="fa fa-trash-o"></i></a>
								<?php   }  ?>
								</div>
								</td>
                            </tr>
						<?php $i++;  } }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div style="display: none;">
    <input type="hidden" name="form_action" value="" id="form_action"/>
<input type="submit">
</div>
  </form>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.dataTables.dtFilter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/customdatatable.js"></script>
