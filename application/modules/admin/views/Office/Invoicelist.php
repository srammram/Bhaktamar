<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />

<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('Invoice'); ?></li>
          </ol>
</section>
<section class="content">
         <div class="row">
		 	<div class="col-md-12">
				
			</div>
		 </div>
		 
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo lang('Invoice'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
						<table class="table table-striped" id="example1">
	    <thead >
	    	<tr>
			
			<th><?php echo lang('InvoiceNumber'); ?></th>
			<th><?php echo lang('Billfor'); ?></th>
			<th><?php echo lang('Bill_Date'); ?></th>
		    <th><?php echo lang('Total_amount'); ?></th>
			<th><?php echo lang('BookedGroup'); ?></th>
			
			
			<th class="text-center"><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	
	<tbody >
<?php if($invoiceguest):?>		
<?php $i=1;foreach ($invoiceguest as $new):?>
		<tr>
		
			
			<td class="gc_cell_left" ><?php echo  $new->reservation_number; ?></td>
			<td><?php echo  $new->firstname; ?></td>
			<td><?php   echo  $new->check_out; ?></td>
			<td><?php   echo  $new->TotalPayable; ?></td>
			<td><?php   echo 'Hotel Unit'; ?></td>
			
			<td>
								<div class="btn-group" style="float:right">
				<a class="btn btn-default" href=<?php echo site_url('admin/Office/invoiceview/'.$new->id); ?>><i class="fa fa-eye"></i>Invoice</a>
					
				
				</div>
			</td>
		</tr>
<?php $i++; endforeach;?>
<?php endif?>
<?php if($invoiceleaseowner):?>		
<?php $i=1;foreach ($invoiceleaseowner as $new):?>
		<tr>
			
			
			<td class="gc_cell_left" ><?php echo  $new->reservation_number; ?></td>
			<td><?php echo  $new->firstname; ?></td>
			<td><?php   echo  $new->check_out; ?></td>
			<td><?php   echo  $new->TotalPayable; ?></td>
			<td><?php   echo 'LeaseOwner Unit'; ?></td>
			<td>
				<div class="btn-group" style="float:right">
				<a class="btn btn-default" href=<?php echo site_url('admin/Office/invoiceview1/'.$new->id); ?>><i class="fa fa-eye"></i>Invoice</a>
					
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
