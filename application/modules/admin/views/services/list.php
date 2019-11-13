<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />

<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('Services'); ?></li>
          </ol>
    </section>
      <section class="content">
         <div class="row">
		 	<div class="col-md-12">
				<div class="btn-group pull-right">
					<a class="btn btn-success" href="<?php echo site_url('admin/Services/form'); ?>"><i class="fa fa-plus"></i> Add </a>
				</div>
			</div>
		 </div>
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo lang('Services'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			<table class="table table-striped" id="example1">
	    <thead >
		<tr>
			<th>#</th>
			<th><?php echo lang('Services_name'); ?></th>
			<th><?php echo lang('Services_provider'); ?></th>
			<th><?php echo lang('Contact_number'); ?></th>
			<th><?php echo lang('Mobile'); ?></th>
			<th><?php echo lang('Email'); ?></th>
			<th><?php echo lang('Address'); ?></th>
			<th><?php echo lang('C_person_name'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	
	<tbody >
<?php if($Services):?>		
<?php $i=1;foreach ($Services as $new):?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $new->Service_name;?>	</td>
			<td><?php echo $new->Service_provider;?></td>
			<td class="gc_cell_left" ><?php echo  $new->Contact_number; ?></td>
			<td><?php echo  $new->Mobile_number; ?></td>
			<td><?php echo  $new->Email;  ?></td>
			<td><?php echo  $new->Address;  ?></td>
			<td><?php echo  $new->Contact_person_name;  ?></td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-default" href="<?php echo site_url('admin/Services/view/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
					<a class="btn btn-primary" href="<?php echo site_url('admin/Services/form/'.$new->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
					<a class="btn btn-danger" href="<?php echo site_url('admin/Services/delete/'.$new->id); ?>" onclick="return areyousure(this);"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
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
