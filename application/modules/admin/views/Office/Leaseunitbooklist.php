<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<section class="content-header">
  <h1><?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('Bookinglist'); ?></li>
          </ol>
</section>
<section class="content">
         <div class="row">
		 	<div class="col-md-12">
				<div class="btn-group pull-right">
					<a class="btn btn-success" href="<?php echo site_url('admin/Office/Booking'); ?>"><i class="fa fa-plus"></i> Book </a>
				</div>
			</div>
		 </div>
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo lang('Bookinglist'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
						<table class="table table-striped" id="example1">
	<thead >
		<tr>
			<th>#</th>
			<th><?php echo lang('Reservationno'); ?></th>
			<th><?php echo lang('Owner'); ?></th>
			<th><?php echo lang('status'); ?></th>
			<th><?php echo lang('Booking_type'); ?></th>
			<th><?php echo lang('Check_in'); ?></th>
			<th class="text-center"><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	
	<tbody >
<?php if($table):?>		
<?php $i=1;foreach ($table as $new):?>
		<tr>
			<td><?php echo $i;?></td>
			<td class="gc_cell_left" ><?php echo  $new->reservation_number; ?></td>
			<td><?php echo  $new->firstname; ?></td>
			<td><?php echo  $new->reservation_type; ?></td>
			<td><?php echo  $new->Booking_mode; ?></td>
			<td><?php echo  $new->check_in; ?></td>
			<td>
				<div class="btn-group" style="float:right">
				
					<a class="btn btn-primary" href="<?php echo site_url('admin/Office/leaseunitEdit/'.$new->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
					
					<a class="btn btn-danger" href="<?php echo site_url('admin/Office/leaseownerBook_delete/'.$new->id); ?>" onclick="return areyousure(this);"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
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
