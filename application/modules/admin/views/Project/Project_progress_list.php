<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />

<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('Project'); ?></li>
			<li class="active"><?php echo lang('Project_planner'); ?></li>
          </ol>
</section>
<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo lang('Project_planner'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
						<table class="table table-striped" id="example1">
	<thead >
		<tr>
			<th>#</th>
			<th><?php echo lang('Project'); ?></th>
			<th><?php echo lang('TotalStages'); ?></th>
			<th><?php echo lang('ProjectStatus'); ?></th>
			<th><?php echo lang('Total_cost'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	
	<tbody >
<?php if($Project):?>		
<?php $i=1;foreach ($Project as $new):?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo  $new->Name; ?></td>
			<td><?php echo  count (json_decode($new->Project_stages)); ?></td>
			<td><?php echo  $new->project_status; ?></td>
			<td><?php echo  $new->Project_cost; ?></td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-default" href="<?php echo site_url('admin/Project/ProjectProgressView/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
					
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
        </section>

<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('#example1').dataTable({
	});
	
});

</script>
