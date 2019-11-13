<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet"type="text/css" />
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
        <small><?php echo lang('list'); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('tenant') ?>"> <?php echo lang('tenant')." ".lang('list') ?> </a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group pull-right">
                <h1></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> <?php echo $page_title; ?>
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped" id="example1">
                       <thead>
                                    <tr>
                                        <th><?= lang("id"); ?></th>
										<th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('project'); ?></th>
                                        <th><?php echo lang('building'); ?></th>
                                        <th><?php echo lang('Floors'); ?></th>
                                        <th><?php echo lang('unit'); ?></th>
                                        <th><?php echo lang('Intension'); ?></th>
                                        <th><?php echo lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php   if(!empty($tenant)){ $i=0; foreach($tenant as $row){ $i++; ?>
                                    <tr>
									<td ><?php   echo $i; ?></td>
									  <td ><?php  echo $row->full_name  ;  ?></td>
                                        <td ><?php  echo $row->project  ;  ?></td>
										<td ><?php  echo $row->building  ;  ?></td>
										<td ><?php  echo $row->floors  ;  ?></td>
										<td ><?php  echo $row->unit_name  ;  ?></td>
										
										<td ></td>
										<td ><div class="text-center"><a href="<?php echo site_url('owner/Tenant/view/'.$row->tentant_id); ?>" class="tip"><i class="fa fa-eye"></i></a> <a href="<?php echo site_url('owner/Tenant/tenant_form/'.$row->tentant_id); ?>" class="tip"><i class="fa fa-edit"></i></a> <!--<a href="<?php echo site_url('admin/Resident/form/'.$id); ?>" class="tip po" onclick="return areyousure(this)"><i class="fa fa-trash-o"></i></a>--></div></td>
                                    </tr>
								<?php  }  }  ?>
                                </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->

    </div><!-- /.col -->
    </div><!-- /.row -->

</section>

<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript">
</script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript">
</script>
<script type="text/javascript">
$(function() {
    $('#example1').dataTable({
        "paging": true,
    });
});
</script>