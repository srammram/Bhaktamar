
<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<style>
</style>
<section class="content-header">
         <h1>
            <?php echo $page_title; ?>
			 <small><?php echo lang('list'); ?></small>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/sales/Sales/Agentlist') ?>"> <?php echo lang('agent_list')." ".lang('list') ?> </a></li>
          </ol>
</section>
      <section class="content">
         <div class="row">
		 	<div class="col-md-12">
				<div class="btn-group pull-right">
					<a class="btn btn-success" href="<?php echo site_url('admin/sales/Sales/AgentForm'); ?>"><i class="fa fa-plus"></i> Add </a>
				</div>

			</div>
		 </div>
		 <!-- <div class="tab-content clearfix"> -->
		 <!--  Agent List Start tab-pane active-->
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo lang('agent_list'); ?> </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table class="table table-striped" id="example1">
					   <thead >
						<tr>
							<th><?php echo lang('no'); ?></th>
								<th><?php echo lang('name'); ?></th>
							<th><?php echo lang('agent_type'); ?></th>
							<th><?php echo lang('job_position'); ?></th>
							<th><?php echo lang('mobile'); ?></th>									
							<th><?php echo lang('action'); ?></th>
						 </tr>
					   </thead>
						<tbody >
						<?php if($agent_list):?>		
						<?php $i=1;foreach ($agent_list as $agent):?>
						<tr>
							<td><?php echo  $i; ?></td>
								<td><?php echo  $agent->name; ?></td>
							<td><?php echo  $agent->agenttype; ?></td>
							<td><?php echo  $agent->position; ?></td>
							<td><?php echo  $agent->mobile; ?></td>							
							<td>
								<div class="btn-group" style="float:right">
								<!--	<a class="btn btn-default" href="<?php echo site_url('admin/sales/Sales/AgentView/'.$agent->agentid); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>		-->							

									<a class="btn btn-primary" href="<?php echo site_url('admin/sales/Sales/Agentform/'.$agent->agentid); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
									
									<a class="btn btn-danger" href="<?php echo site_url('admin/sales/Sales/Agentdelete/'.$agent->agentid); ?>" onclick="return areyousure(this);"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
								</div>
							</td>
						</tr>
						<?php $i++; endforeach;?>
						<?php endif?>
						</tbody>
				</table>

				 </div>
              </div>

            </div>
          </div>
		  <!--  Agent List End-->

		 
		  
		 
<!-- </div> -->
            </div><!-- /.col -->
          </div><!-- /.row -->
		  
        </section>

<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('#example1').dataTable({
		"paging":   false,
	});
});

</script>
