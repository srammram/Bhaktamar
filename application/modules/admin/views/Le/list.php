<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<style>
.pagination_sec{position:relative;float:left;width:100%;}
.pagination_sec a,.pagination_sec strong{
	position: relative;
    float: left;
    background-color: #337ab7;
    text-align: center;
    color: #fff;
    padding: 6px 12px;
	margin-left:2px;
	}
	#pagination{
margin: 40 40 0;
}
.input_text {
display: inline;
margin: 100px;
}
.input_name {
display: inline;
margin: 65px;
}
.input_email {
display: inline;
margin-left: 73px;
}
.input_num {
display: inline;
margin: 36px;
}
.input_country {
display: inline;
margin: 53px;
}
ul.tsc_pagination li a
{
border:solid 1px;
border-radius:3px;
-moz-border-radius:3px;
-webkit-border-radius:3px;
padding:6px 9px 6px 9px;
}
ul.tsc_pagination li
{
padding-bottom:1px;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
color:#FFFFFF;
box-shadow:0px 1px #EDEDED;
-moz-box-shadow:0px 1px #EDEDED;
-webkit-box-shadow:0px 1px #EDEDED;
}
ul.tsc_pagination
{
margin:4px 0;
padding:0px;
height:100%;
overflow:hidden;
font:12px 'Tahoma';
list-style-type:none;
}
ul.tsc_pagination li
{
float:left;
margin:0px;
padding:0px;
margin-left:5px;
}
ul.tsc_pagination li a
{
color:black;
display:block;
text-decoration:none;
padding:7px 10px 7px 10px;
}
ul.tsc_pagination li a img
{
border:none;
}
ul.tsc_pagination li a
{
color:#0A7EC5;
border-color:#8DC5E6;
background:#F8FCFF;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
text-shadow:0px 1px #388DBE;
border-color:#3390CA;
background:#58B0E7;
background:-moz-linear-gradient(top, #B4F6FF 1px, #63D0FE 1px, #58B0E7);
background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #B4F6FF), color-stop(0.02, #63D0FE), color-stop(1, #58B0E7));
}
</style>

<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/Leaseowner') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('Lease_Owner'); ?></li>
          </ol>
</section>


<section class="content">
         <div class="row">
		 	<div class="col-md-12" style="padding-bottom:10px;">
				<div class="btn-group pull-right">
					<a class="btn btn-success" href="<?php echo site_url('admin/Leaseowner/form'); ?>"><i class="fa fa-plus"></i> Add </a>
				</div>

			</div>
		 </div>
	
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo lang('Lease_Owner'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
						<table class="table table-striped" id="example1">
							<thead >
								<tr>
									<th>#</th>
									<th><?php echo lang('name'); ?></th>
									
									<th><?php echo lang('email'); ?></th>
									<th><?php echo lang('mobile'); ?></th>
									<th class="text-center"><?php echo lang('action'); ?></th>
								</tr>
							</thead>
							
							<tbody >
						<?php if($LeaseOwner):?>		
						<?php $i=1;foreach ($LeaseOwner as $new):?>
								<tr>
									<td><?php echo $i;?></td>
									<td class="gc_cell_left" ><?php echo  $new->firstname; ?> <?php echo  $new->lastname; ?></td>
									
									<td><?php echo  $new->email; ?></td>
									<td><?php echo  $new->mobile; ?></td>
									<td>
										<div class="btn-group" style="float:right">
											
											<a class="btn btn-default" href="<?php echo site_url('admin/Leaseowner/view/'.$new->id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
											<a class="btn btn-primary" href="<?php echo site_url('admin/Leaseowner/form/'.$new->id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>
											
											
											<a class="btn btn-danger" href="<?php echo site_url('admin/Leaseowner/delete/'.$new->id); ?>" onclick="return areyousure(this);"><i class="fa fa-trash"></i> <?php echo lang('delete')?></a>
										</div>
									</td>
								</tr>
						<?php $i++; endforeach;?>
						<?php endif ?>
							</tbody>
							
						</table>
 <p class="pagination_sec"><?php echo $links; ?></p>
				 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>


<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
