<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/PropertyDashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('Property_dashboard')?></a></li>
            <li class="active"><?php echo lang('Owner'); ?></li>
          </ol>
</section>


<section class="content">
         <div class="row">
		 	<div class="col-md-12">
				<div class="btn-group pull-right">
				<!--	<a class="btn btn-success" href="<?php echo site_url('admin/Owner/form'); ?>"><i class="fa fa-plus"></i> Add </a>-->
				<br>
				<br>
				<br>
				<br>
				</div>
			</div>
		 </div>
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $Table_title; ?> List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
						<table class="table table-striped" id="example1">
	<thead >
		<tr>
			<th>#</th>
			<th><?php echo lang('ProjectsName'); ?></th>
			<th><?php echo lang('Unit_name'); ?></th>
			<th><?php echo lang('status'); ?></th>
			<th><?php echo lang('status'); ?></th>
			<th><?php echo lang('description'); ?></th>
			<th><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	
	<tbody >
<?php if($tables):?>		
<?php $i=1;foreach ($tables as $new):?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo  $new->Name; ?></td>
			<td><?php echo  $new->unit_no; ?></td>
			<td>
			<!---->
			<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo  $new->Percentage; ?>"
  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo  $new->Percentage; ?>%">
    <span class="sr-only"><?php echo  $new->Percentage; ?></span>
  </div>
</div></td>
			<td><?php echo  $new->socs; ?></td>
			<td><?php echo  $new->Description; ?></td>
			<td>
				<div class="btn-group" style="float:right">
					<a class="btn btn-default" href="<?php echo site_url('admin/unit/view/'.$new->uid); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
					
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
