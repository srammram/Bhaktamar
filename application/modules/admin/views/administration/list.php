<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
	<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('request'); ?></li>
          </ol>
	</section>
		<section class="content">
         <div class="row">
		 	<div class="col-md-12">
				<div class="btn-group pull-right">
				
				</div>
			</div>
		 </div>
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo lang('request'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			<table class="table table-striped" id="example1">
	       <thead >
		     <tr>
			 <th>#</th>
			<th><?php echo lang('Complaint_date'); ?></th>
			<th><?php echo lang('Complaint_title'); ?></th>
			<th><?php echo lang('Complaint_desc'); ?></th>
			<th><?php echo lang('complaint_status'); ?></th>
			<th><?php echo lang('action'); ?></th>
		    </tr>
     	</thead>
	<tbody >
<?php if($Complaint):?>		
<?php $i=1;foreach ($Complaint as $new):?>
		<tr>
			<td><?php echo $i;?></td>
			<td class="gc_cell_left" ><?php echo  $new->c_date; ?></td>
			<td><?php echo  $new->title; ?></td>
			<td><?php echo  $new->request_description;  ?></td>
			<td><?php if(isset($new->Complaint_status)){ 
							   switch($new->Complaint_status){
								   case lang('Inprogress'):
								   echo '<span style="padding:6px;color:#fff;background-color:#d73925;margin:0 auto;">'.$new->Complaint_status.'</span>' ;
								   break;
								    case lang('Accepted'):
								   echo '<span style="padding:6px 12px;color:#fff;background-color:#242582;margin:0 auto;">'.$new->Complaint_status.'</span>' ;
								   break;
								    case lang('Inprogress'):
								   echo '<span style="padding:6px;color:#fff;background-color:green;margin:0 auto;">'.$new->Complaint_status.'</span>' ;
								   break;
								    case lang('ReInitiated'):
								   echo '<span style="padding:6px;color:#fff;background-color:green;margin:0 auto;">'.$new->Complaint_status.'</span>' ;
								   break;
								    case lang('Completed'):
								   echo '<span style="padding:6px;color:#fff;background-color:green;margin:0 auto;">'.$new->Complaint_status.'</span>' ;
								   break;
								      case lang('Initiated'):
								   echo '<span style="padding:6px 14px;color:#fff;background-color:#99738E;margin:0 auto;">'.$new->Complaint_status.'</span>' ;
								   break;
							   }
							 } ?></td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-default" href="<?php echo site_url('admin/administration/Administration/view/'.$new->request_id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
					<a class="btn btn-primary" href="<?php echo site_url('admin/administration/Administration/form/'.$new->request_id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
					
					<a class="btn btn-danger" href="<?php echo site_url('admin/administration/Administration/delete/'.$new->request_id); ?>" onclick="return areyousure(this);"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
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
