<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css"><style>
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
	.form-horizontal .form-group{ margin-left:-10px!important;margin-top:2px!important;}
	.costing_worksheet_s tbody tr td{border:none;padding:3px;}
	.costing_worksheet_s.table-bordered {border:none!important;}
	.costing_worksheet_s thead tr th{  background-color: #2c3542!important;color:#fff;border:1px solid #ddd;}
	
</style>
 <section class="content-header">
  <h1>Costing</h1>
  	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Costing</li>
  	</ol>
</section>
<section class="content">
	 <div class="row">
		<div class="col-md-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title"> View Costing</h3>
				</div>
				<div class="box-content">
					<fieldset col-sm-12>
                  	<legend>Costing Details</legend>
                  	<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Project')?></label>
						<div class="col-sm-8">
						<?php  if(!empty($costing_details->project)){ echo $costing_details->project ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('project_stage')?></label>
						<div class="col-sm-8">
							<?php  if(!empty($costing_details->stage)){ echo $costing_details->stage ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('task_name')?></label>
						<div class="col-sm-8">
							<?php  if(!empty($costing_details->taskName)){ echo $costing_details->taskName ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('RefNO')?></label>
						<div class="col-sm-8">
								<?php  if(!empty($costing_details->refno)){ echo $costing_details->refno ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Remark')?></label>
						<div class="col-sm-8">
								<?php  if(!empty($costing_details->remarks)){ echo $costing_details->remarks ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('date')?></label>
						<div class="col-sm-8">
							<?php  if(!empty($costing_details->date)){ echo $costing_details->date ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('Status')?></label>
						<div class="col-sm-8">
								<?php  if(!empty($costing_details->status)){ echo $costing_details->status ;  } ?>
						</div>
					</div>
					
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('approved_remark')?></label>
						<div class="col-sm-8">
								<?php  if(!empty($costing_details->approved_remarks)){ echo $costing_details->approved_remarks ;  } ?>
						</div>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label col-sm-4"><?php echo lang('approved_date')?></label>
						<div class="col-sm-8">
								<?php  if(!empty($costing_details->approved_date)){ echo $costing_details->approved_date ;  } ?>
						</div>
					</div>
					<?php  if($costing_details->status =='Approved'){  ?><img src="<?php echo base_url('/assets/admin/images/approved.jpg');  ?>" alt="approved" >  <?php   }   ?>
					<?php  if($costing_details->status =='Decline'){  ?><img src="<?php echo base_url('/assets/admin/images/decline.jpg');  ?>" alt="approved" >  <?php   }   ?>
                  </fieldset>
                  <fieldset col-sm-12>
                  	<legend>Costing Worksheet</legend>
                   <table class="table costing_worksheet_s">
						<thead>
							<tr>
								<th>Masters</th>
								<th>Unit</th>
								<th>UOM</th>
								<th>Price</th>
								<th>Actual Unit</th>
								<th>Actual Price</th>
							</tr>
						</thead>
                  		<tbody>
						<tr>
						<table class="table">
						<?php  if(!empty($costing_worksheet)){foreach($costing_worksheet as $item){    
							?><tr>
						   <td><?php  if(!empty($item->material_id)) { ?>
						  <?php   if(isset($material)){  foreach($material as $row){  ?>
						  <?php if(!empty($item->material_id)){ echo ($item->material_id==$row->id)? $row->Name:"";  } ?>
					   	  <?php   } } ?>
						  <?php   }else{   ?>
						  <?php   echo $item->Name ;  ?>
						  <?php  } ?>
						  </td>
						  <td><?php if(!empty($item->unit)){ echo $item->unit ; }  ?></td>
						  <td><?php   if(isset($uom)){  foreach($uom as $row){  ?>
							<?php if(!empty($item->uom)){ echo ($item->uom==$row->id)?$row->Name:"";  } ?>
							<?php   } } ?>
							</td>
							<td><?php if(!empty($item->cost)){ echo $this->sma->formatMoney($item->cost) ; }  ?></td>
							<td><?php if(!empty($item->d_unit)){ echo $item->d_unit ; }  ?></td>
							<td><?php if(!empty($item->d_price)){ echo $this->sma->formatMoney($item->d_price) ; }  ?></td></tr>
								</tr><?php  } }  ?></tr>
							<tr>
							<td colspan="4"></td>
							<td><b>Total Estimate Amount</b></td>
							<td><b><?php if(!empty($costing_details->total_estimate_cost)){ echo $this->sma->formatMoney($costing_details->total_estimate_cost);  }else{ echo 0; }   ?>	</b></td>
						</tr>
						<tr>
							<td colspan="4"></td>
							<td><b>Total  Costing Amount</b></td>
							<td ><b class="amount"><?php if(!empty($costing_details->total_costing_cost)){ echo $this->sma->formatMoney($costing_details->total_costing_cost);  }else{ echo 0; }   ?></b>
							</td>
						</tr>
                  		</tbody>
                  	</table>
                  </fieldset>
				</div>
	 		</div>
		 </div>
	 </div>
</section>