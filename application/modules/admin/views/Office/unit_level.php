<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<style>
	.content-wrapper, .right-side{background-color: #d2d6de;}
	
	figure{
	border: 1.5px solid #2c3542;
    padding: 20px;
    margin: 40px;
    border-radius: 50px;
	}
	figure figcaption h3{font-size: 24px;color: #2c3542;font-weight: 600;}
	.number_notify{position: absolute;right: 10%;background-color: red;color: #fff;width: 50px;height: 50px;top: 10%;line-height: 50px;border-radius: 50px;font-size: 16px;}
	
#exTab1 .tab-content {
  color : #333;
  background-color:#fff;
  padding : 5px 15px;margin-top: 30px;
}
#exTab2 h3 {
  color : white;
  background-color: #428bca;
  padding : 5px 15px;
}
#exTab1 .nav-pills > li > a {
  border-radius: 0;border: 1px solid #2c3542; font-size: 18px;
}
#exTab1 .nav-pills > li+li{margin-left: 0px;}
#exTab1 .nav-pills>li.active>a, #exTab1 .nav-pills>li.active>a:focus, #exTab1 .nav-pills>li.active>a:hover{    background-color: #2c3542;}
#exTab1 .tab-content>.active{transition:all 5s ease-in;}
	
/*	media quries*/
	@media (max-width: 1366px) and (min-width: 1362px){
		figure img{width: 120px;height: 120px;}
		.number_notify{right: 13%;}
	}
	
</style>

<section class="content">
<div class="row">
<div class="col-sm-12 col-xs-12" id="exTab1">	
	<ul class="nav nav-pills">
		<li class="active">
			<a  href="#owners" data-toggle="tab">Owner Units</a>
		</li>
		<li>
			<a href="#hotels" data-toggle="tab">Hotel Units</a>
		</li>
		<li>
			<a href="#lease_block" data-toggle="tab">Lease Back Units</a>
		</li>
	</ul>
<div class="tab-content clearfix">
	<div class="tab-pane active" id="owners">
		<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
        <h3 class="box-title"><?php echo lang('Unit_level'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table class="table table-striped" id="example1">
						<thead >
							<tr>
								<th>#</th>
								<th><?php echo lang('UnitName'); ?></th>
								<th><?php echo lang('Unit_Status'); ?></th>
								<th><?php echo lang('Description'); ?></th>
								<th><?php echo lang('UnitType'); ?></th>
								<th><?php echo lang('Book_status'); ?></th>
								<th class="text-center"><?php echo lang('action'); ?></th>
							</tr>
						</thead>
	
						<tbody >
							<?php if ($ownerunitlevel):?>		
							<?php $i=1;foreach ($ownerunitlevel as $new):?>
							<tr>
								<td><?php echo $i;?></td>
								
								<td><?php echo  $new->unit_no; ?></td>
								<td><?php echo  $new->NAME; ?></td>
								<td><?php echo  $new->Description; ?></td>
								<td><?php echo  $new->OwnerType; ?></td>
								<td><?php echo  $new->book_status; ?></td>

								
								<td>
									<div class="btn-group" style="float:right">
										<a class="btn btn-default" href="<?php echo site_url('admin/Unit/view/'.$new->uid); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
									


										
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
            
          </div>
	</div>
	<div class="tab-pane" id="hotels">
		<div class="row">
		     <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
<h3 class="box-title"><?php echo lang('Unit_level'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			<table class="table table-striped" id="example2">
						<thead >
							<tr>
								<th>#</th>
								<th><?php echo lang('UnitName'); ?></th>
								<th><?php echo lang('Unit_Status'); ?></th>
								<th><?php echo lang('Description'); ?></th>
								<th><?php echo lang('UnitType'); ?></th>
								<th><?php echo lang('Book_status'); ?></th>
								
								<th><?php echo lang('action'); ?></th>
							</tr>
						</thead>
	
						<tbody >
							<?php if ($Hotelunitlevel):?>		
							<?php $i=1;foreach ($Hotelunitlevel as $new):?>
							<tr>
								<td><?php echo $i;?></td>
								
								<td><?php echo  $new->unit_no; ?></td>
								<td><?php echo  $new->NAME; ?></td>
								<td><?php echo  $new->Description; ?></td>
								<td><?php echo  $new->OwnerType; ?></td>
								<td><?php echo  $new->book_status; ?></td>

								
								<td>
									<div class="btn-group" style="float:right">
										<a class="btn btn-default" href="<?php echo site_url('admin/Unit/view/'.$new->uid); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
										

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
	</div>
	<div class="tab-pane" id="lease_block">
		<div class="row">
		  <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
<h3 class="box-title"><?php echo lang('Unit_level'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
		<table class="table table-striped" id="example3">
						<thead >
							<tr>
								<th>#</th>
								<th><?php echo lang('UnitName'); ?></th>
								<th><?php echo lang('Unit_Status'); ?></th>
								<th><?php echo lang('Description'); ?></th>
								<th><?php echo lang('UnitType'); ?></th>
								<th><?php echo lang('Book_status'); ?></th>
								
								<th><?php echo lang('action'); ?></th>
							</tr>
						</thead>
	
						<tbody >
							<?php if ($Leaseunitlevel):?>		
							<?php $i=1;foreach ($Leaseunitlevel as $new):?>
							<tr>
								<td><?php echo $i;?></td>
								
								<td><?php echo  $new->unit_no; ?></td>
								<td><?php echo  $new->NAME; ?></td>
								<td><?php echo  $new->Description; ?></td>
								<td><?php echo  $new->OwnerType; ?></td>
								<td><?php echo  $new->book_status; ?></td>

								
								<td>
									<div class="btn-group" style="float:right">
										<a class="btn btn-default" href="<?php echo site_url('admin/Unit/view/'.$new->uid); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
									

										
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
	

</div>
</div>
</div>


</section>
<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('#example2').dataTable({
	});
	
});

</script>
<script type="text/javascript">
$(function() {
	$('#example1').dataTable({
	});
	
});

</script>
<script type="text/javascript">
$(function() {
	$('#example3').dataTable({
	});
	
});

</script>