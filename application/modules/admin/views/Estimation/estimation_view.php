<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
label{
	font-weight:bold;
}
fieldset {
		border: 1px solid #ddd !important;
		margin: 0;
		min-width: 0;
		padding: 10px;       
		position: relative;
		border-radius:4px;
		background-color:#fff;
		padding-left:10px!important;margin: 15px;
	}	
legend{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px; 
			width: auto; 
			border: 1px solid #ddd;
			border-radius: 4px; 
			padding: 5px 5px 5px 10px; 
			background-color: #ffffff;
		}
	fieldset .form-group label{font-weight: normal;}
	fieldset .table tr td{border: none;}
	fieldset .table-bordered tr td{border: 1px solid #efefef;;}
	.form-inline .form-control{width:100%;}
	.form-horizontal .form-group{ margin-left:-10px!important;margin-top:2px!important;
</style>
 <section class="content-header">
  <h1>Estimation</h1>
  	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Estimation</li>
  	</ol>
</section>
<section class="content">
	 <div class="row">
		<div class="col-md-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo $page_title  ; ?></h3>
				</div>
				<div class="box-content">
					<fieldset col-sm-12>
                  	<legend>Estimation Details</legend>
                  	<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Project')?></label>
						<div class="col-sm-8">
						<?php  if(!empty($estimation_details->project)){ echo $estimation_details->project ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('project_stage')?></label>
						<div class="col-sm-8">
							<?php  if(!empty($estimation_details->stage)){ echo $estimation_details->stage ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('task_name')?></label>
						<div class="col-sm-8">
							<?php  if(!empty($estimation_details->taskName)){ echo $estimation_details->taskName ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('RefNO')?></label>
						<div class="col-sm-8">
								<?php  if(!empty($estimation_details->refno)){ echo $estimation_details->refno ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Remark')?></label>
						<div class="col-sm-8">
								<?php  if(!empty($estimation_details->remarks)){ echo $estimation_details->remarks ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('date')?></label>
						<div class="col-sm-8">
							<?php  if(!empty($estimation_details->date)){ echo $estimation_details->date ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Status')?></label>
						<div class="col-sm-8">
								<?php  if(!empty($estimation_details->status)){ echo $estimation_details->status ;  } ?>
						</div>
					</div>
					
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('approved_remark')?></label>
						<div class="col-sm-8">
								<?php  if(!empty($estimation_details->approved_remarks)){ echo $estimation_details->approved_remarks ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('approved_date')?></label>
						<div class="col-sm-8">
								<?php  if(!empty($estimation_details->approved_date)){ echo $estimation_details->approved_date ;  } ?>
						</div>
					</div>
					<?php  if($estimation_details->status =='Approved'){  ?><img src="<?php echo base_url('/assets/admin/images/approved.jpg');  ?>" alt="approved" >  <?php   }   ?>
					<?php  if($estimation_details->status =='Decline'){  ?><img src="<?php echo base_url('/assets/admin/images/decline.jpg');  ?>" alt="approved" >  <?php   }   ?>
                  </fieldset>
                  <fieldset col-sm-12>
                  	<legend>Estimate Worksheet</legend>
                  	<table class="table table-bordered">
						<thead>
							<tr>
								<th class="col-sm-2">Masters</th>
								<th class="col-sm-2">Unit</th>
								<th class="col-sm-2">UOM</th>
								<th class="col-sm-2">Price</th>
								
							</tr>
						</thead>
                  		<tbody>
						<tr>
						 
							<table class="table">
							<?php  if(!empty($estimation_worksheet)){foreach($estimation_worksheet as $item){    

							?>
							<tr>
									<div data-role="dynamic-fields" style="position: relative;float: left;width: 100%;display: block;">
										<div class="form-inline" style="position: relative;float: left;width: 100%;display: block;">
										<?php  if(!empty($item->material_id)) { ?>
											<div class="form-group col-sm-2" style="width:25%;margin-top:2px;">
											  
												<?php   if(isset($material)){  foreach($material as $row){  ?>
												 <?php if(!empty($item->material_id)){ echo ($item->material_id==$row->id)?$row->Name:"";  } ?>
												<?php   } } ?>
												
											</div>
										<?php   }else{   ?>
										<div class="form-group col-sm-2" style="width:25%;margin-top:2px;">
											 <?php   echo $item->Name ;  ?>
											 
											</div>
										<?php  } ?>
											<div class="form-group col-sm-2" style="width:25%">
												<?php if(!empty($item->unit)){ echo $item->unit ; }  ?>
											</div>
											<div class="form-group col-sm-2" style="width:25%">
												<?php   if(isset($uom)){  foreach($uom as $row){  ?>
												 <?php if(!empty($item->uom)){ echo ($item->uom==$row->id)?$row->Name:"";  } ?>
												<?php   } } ?>
											</div>
												<div class="form-group col-sm-2" style="width:25%">
													<?php if(!empty($item->cost)){ echo $this->sma->formatMoney($item->cost) ; }  ?>
												</div>
												
										</div>
									</div>
								</tr>
							<?php  } }  ?>
								
					
				</tr>
				<tr>
				<td colspan="5" style="font-weight:bold;">Total Amount</td>
				<td style="font-weight:bold;" class="amount"><?php if(!empty($estimation_details->total_estimate_cost)){ echo  $this->sma->formatMoney($estimation_details->total_estimate_cost);  }else{ echo 0; }   ?>	</td>
				</tr>
                  		</tbody>
                  	</table>
				
                  </fieldset>
				</div>
	 		</div>
		 </div>
	 </div>
	 
	
	

</section>
</section>