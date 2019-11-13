
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
			<li><a href="<?php echo site_url('admin/crm/Crm/Enquiry') ?>"> <?php echo lang('Enquiry')." ".lang('list') ?> </a></li>
          </ol>
</section>
      <section class="content">
         <div class="row">
		 	<div class="col-md-12">
				<div class="btn-group pull-right">
					<a class="btn btn-success" href="<?php echo site_url('admin/crm/Crm/enquiryform'); ?>"><i class="fa fa-plus" ></i> Add </a>
				</div>
			</div>
		 </div>
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo  lang('Enquiry')." ".lang('list'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<table class="table table-striped" id="example1">
	     <thead >
		<tr>
			<th><?php echo lang('Enquiry_id'); ?></th>
			<th><?php echo lang('Customer_name'); ?></th>
			<th><?php echo lang('Enquiry_date'); ?></th>
			<th><?php echo lang('Project'); ?></th>
		<!--	<th><?php echo lang('Source_of_enquiry'); ?></th>-->
			<th><?php echo lang('email'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	
	<tbody >
<?php if($enquiry):?>		
<?php $i=1;foreach ($enquiry as $new):?>
		<tr>
			<td><?php echo  $new->enquiry_id; ?></td>
			<td><?php echo  $new->Customer_name; ?></td>
			<td><?php echo  $new->enquiry_date; ?></td>
			<td><?php echo  $new->projectname; ?></td>
	<!--		<td><?php echo  $new->soename; ?> </td>-->
			<td><?php echo  $new->email; ?></td>
			
			<td style="width:30%">
				<div class="btn-group" style="float:right">
					<a class="btn btn-default" href="<?php echo site_url('admin/crm/Crm/EnquiryView/'.$new->enquiry_id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
					<a class="btn btn-primary" href="<?php echo site_url('admin/crm/Crm/Enquiryform/'.$new->enquiry_id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
					<a class="btn btn-danger" href="<?php echo site_url('admin/crm/Crm/Enquirydelete/'.$new->enquiry_id); ?>" onclick="return areyousure(this);"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
				</div>
			</td>
		</tr>
<?php $i++; endforeach;?>
<?php endif?>
	</tbody>
</table>
<!--<p class="pagination_sec"><?php echo $links; ?></p>-->
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
		"paging":   true,
	});
	
});

</script>
