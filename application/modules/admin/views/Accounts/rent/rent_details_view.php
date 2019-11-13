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
	.form-horizontal .form-group{
		margin:0px !important;
	}
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
                  						<label><?php   if(!empty($rental_details->project)){ echo $rental_details->project  ; } ?></label>
										
                  					</div>
                  				</td>
                  				<td>
                  					<div class="form-group">
                  						<label>Builder Name :</label>
                  						<label><?php   if(!empty($rental_details->name)){ echo $rental_details->name ; } ?></label>
										
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
                  						<label><?php   if(!empty($rental_details->unit_name)){ echo $rental_details->unit_name ; } ?></label>
										
                  					</div>
                  				</td>
                  				<td>
                  					<div class="form-group">
                  						<label>Tenant :</label>
                  						<label><?php   if(!empty($rental_details->full_name)){ echo $rental_details->full_name ; } ?></label>
										
                  					</div>
                  				</td>
                  				<td>
                  					<div class="form-group">
                  						<label>Rental Amount :</label>
                  					<label><?php   if(!empty($rental_details->rental_amount)){ echo $this->sma->formatMoney($rental_details->rental_amount) ; } ?></label>
								
                  					</div>
                  				</td>
                  			</tr>
                  			<tr>
							<td>
                  					<div class="form-group">
                  						<label>Month :</label>
                  						<label><?php   if(!empty($rental_details->month)){ echo $rental_details->month ; } ?></label>
										
                  					</div>
                  				</td>
                  				<td>
                  					<div class="form-group">
                  						<label class="col-sm-4">Due Date :</label>
                  						<?php   if(!empty($rental_details->due_date)){ echo $rental_details->due_date;  } ?>
                  						
                  					</div>
                  				</td>
								<td>
                  					<div class="form-group">
                  						<label class="col-sm-4">Total Amount :</label>
                  						<?php   if(!empty($rental_details->total_rental_amount)){ echo $this->sma->formatMoney($rental_details->total_rental_amount);  } ?>
                  						
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
						<td style="font-weight:bold;"><?php echo $this->sma->formatMoney($rental_details->total_rental_amount -$rental_details->rental_amount);     ?></td>
						</tr>
						<tr>
						<td style="font-weight:bold;"colspan="4">Total Rental Amount</td>
						<td style="font-weight:bold;"><?php echo $this->sma->formatMoney($rental_details->total_rental_amount);     ?></td>
						</tr>
                  		</tbody>
                  	</table>
					                  </fieldset>
				  
				</div>
			
	 		</div>
		 </div>
	 </div>
	 </form>
</section>