<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
label{
	font-weigth:bold;
}
	fieldset 
	{
		border: 1px solid #ddd !important;
		margin: 0;
		min-width: 0;
		padding: 10px;       
		position: relative;
		border-radius:4px;
		background-color:#fff;
		padding-left:10px!important;margin: 15px;
	}	
	
		legend
		{
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
</style>
 <section class="content-header">
  <h1>Rental  Details</h1>
  	<ol class="breadcrumb">
		<li><a href="http://localhost/rems1/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Rental  Details</li>
  	</ol>
</section>
<section class="content">
  <?php echo form_open('admin/accounts/rental_save', array('class' => 'form-horizontal rentalform')) ?>
	 <div class="row">
		<div class="col-md-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Rental  Details</h3>
				</div>
				<div class="box-content">
					<fieldset col-sm-12>
                  	<legend>Rental Details</legend>
                  	
                  	<table class="table" style="table-layout: fixed;">
                  		<tbody>
                  			<tr>
                  				<td>
                  					<div class="form-group">
                  						<label>Project Name :</label>
                  						<label><?php   if(!empty($project_name->id)){ echo $project_name->Name  ; } ?></label>
										<input type="hidden" name="projectid" value="<?php   if(!empty($project_name->id)){ echo $project_name->id ;  } ?>">
                  					</div>
                  				</td>
                  				<td>
                  					<div class="form-group">
                  						<label>Builder Name :</label>
                  						<label><?php   if(!empty($building->bldid)){ echo $building->name ; } ?></label>
										<input type="hidden" name="buildingid" value="<?php   if(!empty($building->bldid)){ echo $building->bldid ; } ?>">
                  					</div>
                  				</td>
                  				<td>
                  					<div class="form-group">
                  						<label>floor Name :</label>
                  						
                  					</div>
                  				</td>
                  			</tr>
                  			<tr>
                  				<td>
                  					<div class="form-group">
                  						<label>Unit :</label>
                  						<label><?php   if(!empty($unit->uid)){ echo $unit->unit_name ; } ?></label>
										<input type="hidden" name="unitid" value="<?php   if(!empty($unit->uid)){ echo$unit->uid ; } ?>">
                  					</div>
                  				</td>
                  				<td>
                  					<div class="form-group">
                  						<label>Tenant :</label>
                  						<label><?php   if(!empty($tenant->tentant_id)){ echo $tenant->full_name ; } ?></label>
										<input type="hidden" name="tenantid" value="<?php   if(!empty($tenant->tentant_id)){ echo  $tenant->tentant_id ; } ?>">
                  					</div>
                  				</td>
                  				<td>
                  					<div class="form-group">
                  						<label>Rental Amount :</label>
                  					<label><?php   if(!empty($rental_amount['rentalamount'])){ echo $this->sma->formatMoney($rental_amount['rentalamount']) ; } ?></label>
									<input type="hidden" name="rental_amount" value="<?php   if(!empty($rental_amount['rentalamount'])){ echo $rental_amount['rentalamount'] ; } ?>">
									<input type="hidden" name="revenue_amount" value="<?php   if(!empty($rental_amount['revenueAmount'])){ echo $rental_amount['revenueAmount'] ; } ?>">
									<input type="hidden" name="revenue_percentage" value="<?php   if(!empty($rental_amount['revenue_percentage'])){ echo $rental_amount['revenue_percentage'] ; } ?>">
                  					</div>
                  				</td>
                  			</tr>
                  			<tr>
							<td>
                  					<div class="form-group">
                  						<label>Month :</label>
                  						<label><?php   if(!empty($month)){ echo $month ; } ?></label>
										<input type="hidden" name="month" value="<?php   if(!empty($month)){ echo $month;  } ?>">
                  					</div>
                  				</td>
                  				<td>
                  					<div class="form-group">
                  						<label class="col-sm-4">Due Date :</label>
                  						<div class="col-sm-8">
                  							<input type="text" class="datepicker form-control" name="due_date">
                  						</div>
                  					</div>
                  				</td>
                  			</tr>
                  		</tbody>
                  	</table>
                  </fieldset>
                  <fieldset col-sm-12>
                  	<legend>Bill Details</legend>
                  	
                  	<table class="table table-bordered">
						<thead>
							<tr>
								<th>S.no</th>
								<th>Bill Name</th>
								<th>bill number</th>
								<th>Issue Date</th>
								<th>Amount </th>
								
							</tr>
						</thead>
                  		<tbody>
						<?php $i=1; $billamount=0; if(!empty($bill_details)){  foreach($bill_details as $row){ ?>
                  			<tr>
                  				<td><?php  echo $i; ?></td>
                  				<td><?php  echo $row->bill_details  ;  ?></td>
                  					<td><?php  echo 'BILLNO'.$row->bill_id  ;  ?></td>
                  					
                  					<td><?php  echo $row->bill_date  ;  ?></td>
									<td><?php  echo $this->sma->formatMoney($row->total_amount)  ;  ?></td>
								<input type="hidden" name="bill_details[]" value="<?php  echo $row->bill_id;    ?>">
                  			</tr>
       
						<?php  $billamount+=$row->total_amount; $i++; }  } ?>
						<tr>
						<td colspan="4" style="font-weight:bold;">Total Amount</td>
						<td style="font-weight:bold;"><?php echo $this->sma->formatMoney($billamount);     ?></td>
						</tr>
						<tr>
						<td style="font-weight:bold;"colspan="4">Total Rental Amount</td>
						<td style="font-weight:bold;"><?php echo $this->sma->formatMoney($billamount+$rental_amount['rentalamount']);     ?></td>
						</tr>
                  		</tbody>
                  	</table>
					<input type="hidden" name="total_rental_amount" value="<?php echo $billamount+$rental_amount['rentalamount'];     ?>">
						<button type="submit" style="float:right;" class="btn btn-primary next-step tenantformpost">Save </button>
                  </fieldset>
				  
				</div>
			
	 		</div>
		 </div>
	 </div>
	 </form>
</section>