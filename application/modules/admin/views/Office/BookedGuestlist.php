<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />

<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('guests'); ?></li>
          </ol>
</section>


<section class="content" >
         <div class="row">
		 	<div class="col-md-12" style="padding-bottom:10px;">
				<div class="btn-group pull-right">
					<a class="btn btn-success" href="<?php echo site_url('admin/guests/form'); ?>"><i class="fa fa-plus"></i> Add </a>
				</div>

			</div>
		 </div>
		 
		 
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo lang('guests'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
						<table class="table table-striped" id="example1">
							<thead >
								<tr>
									<th>#</th>
									<th><?php echo lang('name'); ?></th>
									<th><?php echo lang('country'); ?></th>
									<th><?php echo lang('email'); ?></th>
									<th><?php echo lang('mobile'); ?></th>
									<th class="text-center"><?php echo lang('action'); ?></th>
								</tr>
							</thead>
							
							<tbody >
						<?php if($guests):?>		
						<?php $i=1;foreach ($guests as $new):?>
								<tr>
									<td><?php echo $i;?></td>
									<td class="gc_cell_left" ><?php echo  $new->firstname; ?> <?php echo  $new->lastname; ?></td>
									<td><?php echo  $new->country; ?></td>
									<td><?php echo  $new->email; ?></td>
									<td><?php echo  $new->mobile; ?></td>
									<td>
										<div class="btn-group" style="float:right">
										
											<a class="btn btn-default" href="<?php echo site_url('admin/Office/list_level/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
											
										</div>
									</td>
								</tr>
						<?php $i++; endforeach;?>
						<?php endif ?>
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