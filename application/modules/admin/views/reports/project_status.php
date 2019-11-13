<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
#weekchart{
  width: 100%;
  height: 500px;
}
#monthchart{
  width: 100%;
  height: 500px;
}
#yearchart{
  width: 100%;
  height: 500px;
}
#customchart{
  width: 100%;
  height: 500px;
}
.amcharts-export-menu-top-right {
  top: 10px;
  right: 0;
}
.amcharts-chart-div a{display:none !important}
</style>
<section class="content">
<div class="col-sm-12">
<div class="box">
   <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i><?php  echo $page_title;    ?>      </h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="javascript:void(0);" id="xls" class="excel_report" title="Download as XLS">
                        <i class="icon fa fa-file-excel-o"></i>
                    </a>
                </li>
             <!--   <li class="dropdown">
                    <a href="#" id="image" class="tip" title="Save as Image" data-original-title="Save as Image">
                        <i class="icon fa fa-file-picture-o"></i>
                    </a>
                </li>-->
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
           <div class="col-sm-12" >
		      <form method="post" action="<?php echo site_url('admin/Reports/projectStatus_report'); ?>"  >
                <p class="introtext">Please customize the report below</p>
                <div id="form" style="">
						<div class="col-md-2">
                            <div class="form-group">
                                <label for="project_status"><?php echo lang('project_status')?></label>
								<select name="project_status" class="form-control" data-placeholder="Select project_status" id="project_status">
								<option value="<?php echo lang('all')  ?>">
                                <?php echo lang('all')  ?></option>
								<option value="<?php echo lang('Yet')  ?>">
                                <?php echo lang('Yet')  ?></option>
                               <option value="<?php echo lang('Ongoing')  ?>">
                               <?php echo lang('Ongoing')  ?></option>
                               <option value="<?php echo lang('Completed')  ?>">
                               <?php echo lang('Completed')  ?></option>
                               <option value="<?php echo lang('OnHold')  ?>">
                               <?php echo lang('OnHold')  ?></option>
								</select>
                            </div>
                        </div>
                        
                    <div class="form-group col-sm-12">
                        <div class="controls"> <input type="submit" name="submit_report" value="Submit" class="btn btn-primary bill_details">
 
                        </div>
                    </div>
                </div>
				</form>
                    <!-- </form> -->
                <div class="clearfix"></div>
                <div class="col-sm-12 table-responsive">
                    	<table class="table" cellpadding="0" cellspacing="0">
					<tr>
						<td style="border: none;">
							<table class="table table-bordered" cellpadding="0" cellspacing="0">
							<?php  if(!empty($projects)){ foreach($projects as $project) {
									{
								
								 ?>
								<tr>
								
									<td style="vertical-align: middle;padding: 0px;">
										<?php  echo $project->Name ;  ?>
									</td>
									<td style="padding: 0px;">
									<?php  $buildingquery=$this->db->get_where('building_info',array('project_id'=>$project->id,'soft_delete'=>0));
                                             if($buildingquery->num_nows()>0){
												$buildings= $buildingquery->result();
											 }
									?>
										<table class="table" cellpadding="0" cellspacing="0" width="100%">
										<?php  if(!empty($buildings)){ foreach($buildings as $building){   ?>
											<tr>
												<td><?php  $building->  ?></td>
											</tr>
											
										</table>
									</td>
									<td style="padding: 0px;">
										<table class="table " cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td>milestone</td>
											</tr>
											<tr>
												<td>milestone</td>
											</tr>
											<tr>
												<td>milestone</td>
											</tr>
										</table>
									</td>
									<td style="padding: 0px;">
										<table class="table" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td>Task</td>
											</tr>
											<tr>
												<td>Task</td>
											</tr>
											<tr>
												<td>Task</td>
											</tr>
											<tr>
												<td>Task</td>
											</tr>

										</table>
									</td>
								</tr>
							</table>
				  		</td>
					</tr>
							<?php  } } ?>
					<tr>
						<td style="border: none;">
							<table class="table table-bordered" cellpadding="0" cellspacing="0">
								<tr>
									<td style="vertical-align: middle;padding: 0px;">
										project
									</td>
									<td style="padding: 0px;">
										<table class="table" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td>Arena</td>
											</tr>
										</table>
									</td>
									<td style="padding: 0px;">
										<table class="table " cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td>content</td>
											</tr>
											<tr>
												<td>content</td>
											</tr>

										</table>
									</td>
									<td style="padding: 0px;">
										<table class="table" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td>content</td>
											</tr>
											<tr>
												<td>content</td>
											</tr>
											<tr>
												<td>content</td>
											</tr>
											<tr>
												<td>content</td>
											</tr>

										</table>
									</td>
								</tr>
							</table>
				  		</td>
					</tr>
			  	</table>
                    <div class="col-md-6 text-right" style="float:right">
                        <div class="dataTables_paginate paging_bootstrap"></div>
                    </div>
                </div>
           </div>
        </div>
    </div>
</div>

</div>
</section>
<script src="<?php echo base_url('assets/admin/dist/js/jquery.table2excel.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/jquery.dataTables.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>