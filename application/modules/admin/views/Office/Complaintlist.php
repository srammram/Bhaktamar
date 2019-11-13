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
#exTab1 .tab-content {
  color : #333;
  padding : 5px 0px;margin-top: 30px;
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
</style>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('Complaint'); ?></li>
          </ol>
</section>
<section class="content">
         <div class="row">
		 	<div class="col-sm-12 col-xs-12" id="exTab1">	
				<ul  class="nav nav-pills">
					<li class="active">
						<a  href="#1a" data-toggle="tab"><?php echo lang('YetToAssign');  ?></a>
					</li>
					<li>
						<a href="#2a" data-toggle="tab"><?php echo lang('Assigned');  ?></a>
					</li>
					<li>
						<a href="#3a" data-toggle="tab"><?php echo lang('Complete');  ?></a>
					</li>

				</ul>

				<div class="tab-content clearfix">
					<div class="tab-pane active" id="1a">
						<div class="row">
							<div class="col-xs-12">
							  <div class="box">
								<div class="box-header">
								  <h3 class="box-title"><?php echo lang('Complaint'); ?></h3>
								</div><!-- /.box-header -->
								<div class="box-body">
									<table class="table table-striped" id="example1">
										<thead>
											<tr>
												<th>#</th>
												<th><?php echo lang('Complaint_date'); ?></th>
												<th><?php echo lang('Unitno'); ?></th>
												<th><?php echo lang('Complaint_title'); ?></th>
												<th><?php echo lang('Complaint_desc'); ?></th>
												<th><?php echo lang('complaint_status'); ?></th>
												<th class="text-center"><?php echo lang('action'); ?></th>
											</tr>
										</thead>
									<tbody >
									<?php if($Yettoassign):?>		
									<?php $i=1;foreach ($Yettoassign as $new):?>
									<tr>
										<td><?php echo $i;?></td>
										<td class="gc_cell_left" ><?php echo  $new->c_date; ?></td>
										<td class="gc_cell_left" ><?php echo  $new->unit_no; ?></td>
										<td><?php echo  $new->c_title; ?></td>
										<td><?php echo  $new->c_description;  ?></td>
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
												<a class="btn btn-default" href="<?php echo site_url('admin/Complaint/view/'.$new->complain_id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
												<a class="btn btn-primary" href="<?php echo site_url('admin/Complaint/form/'.$new->complain_id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>

											</div>
										</td>
									</tr>
									<?php $i++; endforeach;?>
									<?php endif?>
									</tbody>
									<p class="pagination_sec"><?php echo $links; ?></p>
									</table>
								 </div><!-- /.box-body -->
							  </div><!-- /.box -->
            				</div>
						</div>
					</div>

					<div class="tab-pane" id="2a">
						<div class="row">
							<div class="col-xs-12">
							  <div class="box">
								<div class="box-header">
								  <h3 class="box-title"><?php echo lang('Complaint'); ?></h3>
								</div><!-- /.box-header -->
								<div class="box-body">
									<table class="table table-striped" id="example1">
										<thead>
											<tr>
												<th>#</th>
												<th><?php echo lang('Complaint_date'); ?></th>
												<th><?php echo lang('Unitno'); ?></th>
												<th><?php echo lang('Complaint_title'); ?></th>
												<th><?php echo lang('Complaint_desc'); ?></th>
												<th><?php echo lang('complaint_status'); ?></th>
												<th class="text-center"><?php echo lang('action'); ?></th>
											</tr>
										</thead>
									<tbody >
									<?php if($assign):?>		
									<?php $i=1;foreach ($assign as $new):?>
									<tr>
										<td><?php echo $i;?></td>
										<td class="gc_cell_left" ><?php echo  $new->c_date; ?></td>
										<td class="gc_cell_left" ><?php echo  $new->unit_no; ?></td>
										<td><?php echo  $new->c_title; ?></td>
										<td><?php echo  $new->c_description;  ?></td>
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
												<a class="btn btn-default" href="<?php echo site_url('admin/Complaint/view/'.$new->complain_id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
												<a class="btn btn-primary" href="<?php echo site_url('admin/Complaint/form/'.$new->complain_id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>

											</div>
										</td>
									</tr>
									<?php $i++; endforeach;?>
									<?php endif?>
									</tbody>
									<p class="pagination_sec"><?php echo $links; ?></p>
									</table>
								 </div><!-- /.box-body -->
							  </div><!-- /.box -->
            				</div>
						</div>
					</div>
					<div class="tab-pane" id="3a">
						<div class="row">
							<div class="col-xs-12">
							  <div class="box">
								<div class="box-header">
								  <h3 class="box-title"><?php echo lang('Complaint'); ?></h3>
								</div><!-- /.box-header -->
								<div class="box-body">
									<table class="table table-striped" id="example1">
										<thead>
											<tr>
												<th>#</th>
												<th><?php echo lang('Complaint_date'); ?></th>
												<th><?php echo lang('Unitno'); ?></th>
												<th><?php echo lang('Complaint_title'); ?></th>
												<th><?php echo lang('Complaint_desc'); ?></th>
												<th><?php echo lang('complaint_status'); ?></th>
												<th class="text-center"><?php echo lang('action'); ?></th>
											</tr>
										</thead>
									<tbody >
									<?php if($Complete):?>		
									<?php $i=1;foreach ($Complete as $new):?>
									<tr>
										<td><?php echo $i;?></td>
										<td class="gc_cell_left" ><?php echo  $new->c_date; ?></td>
										<td class="gc_cell_left" ><?php echo  $new->unit_no; ?></td>
										<td><?php echo  $new->c_title; ?></td>
										<td><?php echo  $new->c_description;  ?></td>
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
												<a class="btn btn-default" href="<?php echo site_url('admin/Complaint/view/'.$new->complain_id); ?>"><i class="fa fa-eye"></i> <?php echo lang('view')?></a>
												<a class="btn btn-primary" href="<?php echo site_url('admin/Complaint/form/'.$new->complain_id); ?>"><i class="fa fa-edit"></i> <?php echo lang('edit')?></a>

											</div>
										</td>
									</tr>
									<?php $i++; endforeach;?>
									<?php endif?>
									</tbody>
									<p class="pagination_sec"><?php echo $links; ?></p>
									</table>
								 </div><!-- /.box-body -->
							  </div><!-- /.box -->
            				</div>
						</div>
					</div>

				</div>
			</div>
		 </div>
		 
		  <div class="row">
            <!-- /.col -->
          </div><!-- /.row -->
        </section>
        
        
        

<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>

