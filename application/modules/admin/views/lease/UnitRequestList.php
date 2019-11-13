<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet"
    type="text/css" />
<style>
</style>
<section class="content-header">
    <h1><?php echo $page_title; ?>
        <small><?php echo lang('list'); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('request_form') ?>"> <?php echo lang('request')." ".lang('list') ?> </a></li>
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
                                <th><?php echo lang('project'); ?></th>
                                <th><?php echo lang('building'); ?></th>
                                <th><?php echo lang('Floors'); ?></th>
                                <th><?php echo lang('unit'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('title'); ?></th>
                                <th><?php echo lang('action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($request):?>
                            <?php $i=1;foreach ($request as $new):?>
                            <tr>
                                <td><?php echo  $new->project; ?></td>
                                <td><?php echo  $new->building; ?></td>
                                <td><?php echo  $new->floors; ?></td>
                                <td><?php echo  $new->unit_name; ?></td>
                                <td><?php echo  $new->requesteddate; ?></td>
                                <td><?php echo  $new->title; ?> </td>
                                <td>
                                    <div class="btn-group" style="float:right">
                                        <a class="btn btn-default"
                                            href="<?php echo site_url('owner/Myunits/unit_request_view/'.$new->id); ?>"><i
                                                class="fa fa-eye"></i> <?php echo lang('view')?></a>
												<?php   if( $new->request_status ==lang('Completed')){  ?>
                                        <a class="btn btn-primary"
                                            href="<?php echo site_url('owner/Myunits/unit_request_form/'.$new->request_type.'/'.$new->owner_realtion_unitid.'/'.$new->id); ?>"><i
                                                class="fa fa-edit"></i> <?php echo lang('edit')?></a>
                                      <!-- <a class="btn btn-danger"
                                            href="<?php echo site_url('owner/request/requestDelete/'.$new->id); ?>"
                                            onclick="return areyousure(this);"><i class="fa fa-trash"></i>
                                            <?php echo lang('delete')?></a>-->
												<?php   }   ?>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; endforeach;?>
                            <?php endif?>
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