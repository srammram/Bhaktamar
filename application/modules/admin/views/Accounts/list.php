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
				<div class="btn-group pull-right">
					<a class="btn btn-success" href="<?php echo site_url('admin/Accounts/form'); ?>"><i class="fa fa-plus"></i> Add </a>
				</div>
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
			<th>#</th>
			<th><?php echo lang('Billtype'); ?></th>
			<th><?php echo lang('Billtype_cat'); ?></th>
			<th><?php echo lang('Billfor'); ?></th>
		    <th><?php echo lang('Bill_Date'); ?></th>
			<th><?php echo lang('Total_amount'); ?></th>
				<th><?php echo lang('Paid_status'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	
	<tbody >
<?php if($Accounts):?>		
<?php $i=1;foreach ($Accounts as $new):?>
		<tr>
			<td><?php echo $i;?></td>
			<td>
			<?php if(isset($new->bill_type)){ 
			
                   switch($new->bill_type)
				   {
					      Case 1;
					     echo lang('Facility_type');
					     break;
					     Case 2;
						 echo lang('Services_type');
					   break; 
                       Case 3;
						 echo lang('Other_type');
					   break; 					   
				   }

			} ?> </td>
			<td class="gc_cell_left" ><?php echo  $new->Billtype_cat; ?></td>
			<td><?php echo  $new->o_name; ?></td>
			<td><?php   echo  $new->bill_date; ?></td>
			<td><?php   echo  $new->total_amount; ?></td>
			<th>
			<?php if(isset($new->Paid_Status)){ 
			
                   switch($new->Paid_Status)
				   {
					    Case 'Paid';
					    echo '<span style="padding:6px 18px 6px 18px;color:#fff;background-color:rgb(15,48,125);margin:0 auto;">'.$new->Paid_Status.'<span>';
					   break;
					     Case 'UnPaid';
						 echo '<span style="padding:6px;color:#fff;background-color:#c0392b;margin:0 auto;">'.$new->Paid_Status.'<span>';
					   break;  
					     Case 'Hold';
						 echo '<span style="padding:6px;color:#fff;background-color:#c0392b;margin:0 auto;">'.$new->Paid_Status.'<span>';
					   break;
				   }

			} ?> 
			</th>
			<td>
				<div class="btn-group" style="float:right">
				<?php 
                  if(isset($new->Paid_Status)){ 
			
                   switch($new->Paid_Status)
				   {
					    Case 'Paid';
			
					echo	'<a class="btn btn-default" href="'.site_url('admin/Accounts/view/'.$new->bill_id) .'"><i class="fa fa-eye"></i>Invoice</a>';
					   break;
				   }
			}
				?>
					<a class="btn btn-primary" href="<?php echo site_url('admin/Accounts/form/'.$new->bill_id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
					<a class="btn btn-danger" href="<?php echo site_url('admin/Accounts/delete/'.$new->bill_id); ?>" onclick="return areyousure(this);"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
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
