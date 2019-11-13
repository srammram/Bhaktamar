<link href="<?php echo base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/booking_form.css">
<style>
	.content-wrapper, .right-side{background-color: #ecf0f5;}
	select {
    -moz-appearance:none; /* Firefox */
    -webkit-appearance:none; /* Safari and Chrome */
    appearance:none;
	background:none;
	border:none;
}
select option{display:none;border:none;line-height:0px;}
	.form-control{border: none;}
	
	
/*	media quries*/
	@media (max-width: 1366px) and (min-width: 1362px){
		figure img{width: 120px;height: 120px;}
		.number_notify{right: 13%;}
	}
	.table tbody tr td{cursor: pointer;vertical-align: middle;}
	.table-bordered>tbody>tr>td{border: 1px solid #ddd;}
	.table thead tr th{background-color: #ddd;}
	   
	
</style>

<section class="content">
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">List Level</h3>
				</div>
				<div class="box-body">
					<table class="table table-bordered table-striped">
					  <thead>
						<tr>
						  <th>Reservation No</th>
						  <th>Guest Name</th>
						  <th>Booking Type</th>
						  <th>Number of units</th>
						  <th class="text-center">Action</th>
						</tr>
					  </thead>
					  <tbody id="accordion1">
					  <?php  if(!empty($BookedDetails))
					  { 
				   
				  foreach($BookedDetails as $item){   ?>
						<tr class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" data-target="#one">
						  <td><?php if(!empty($item->reservation_number)){ echo $item->reservation_number ; } ?></td>
						  <td><?php if(!empty($item->firstname)){ echo $item->firstname ; } ?></td>
						  <td><?php if(!empty($item->reservation_type)){ echo $item->reservation_type ; } ?></td>
						  <td>	<?php if(!empty($item->number_of_rooms)){ echo $item->number_of_rooms ; } ?></td>
						  <td><a class="btn btn-default" href="#"><i class="fa fa-eye"></i> View</a></td>
						</tr>
						<tr class="accordion-body collapse" id="one">
						  <td colspan="5" >
							<fieldset>
								<legend><?php echo lang('Booking_details');?></legend>
								<div class="col-md-4">
									<div class="form-group">
										<label for="Booking_type"><?php echo lang('Booking_Type');?></label>                                        
										<select name="Booking_type" class="form-control" id="Booking_type"  tabindex="-1" title="Booking type">
											<option ><?php if(!empty($item->reservation_type)){ echo $item->reservation_type ; } ?></option>
											
										</select>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-md-5">
									<div class="form-group all row">
										<div class="col-md-6"><label for="check_in"><?php echo lang('Check_in');?></label></div>
										<div class="col-md-3"><label for="hour"><?php echo lang('Hrs');?></label></div>
										<div class="col-md-3">
											<label for="minutes"><?php echo lang('Mins');?></label>
										</div>
										<div class="col-md-6">
											<input name="check_in_date" value="<?php if(!empty($item->check_in)){ echo date('Y-m-d', strtotime($item->check_in)) ; }   ?>" class="form-control  datepicker" id="check_in_date" placeholder="YYYY-MM-DD"  >
										</div>
										<div class="col-md-3">
											<select name="check_in_hour" class="form-control" id="check_in_hour" tabindex="-1" title="">
												<option value="0" selected="selected"><?php if(!empty($item->check_in)){ echo date('H', strtotime($item->check_in)) ; }   ?></option>
												
											</select>
										</div>
										<div class="col-md-3">
											<select name="check_in_min" class="form-control" id="check_in_min" tabindex="-1" title="" >
												<option value="0" selected="selected"><?php if(!empty($item->check_in)){ echo date('i', strtotime($item->check_in)) ; }   ?></option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group all row">
										<div class="col-md-6">
											<label for="check_out"><?php echo lang('Check_Out');?></label>
										</div>
										<div class="col-md-3">
											<label for="hour"><?php echo lang('Hrs');?></label>                                            
										</div>
										<div class="col-md-3">
											<label for="minutes"><?php echo lang('Mins');?></label>                                            
										</div>
										<div class="col-md-6">
											<input name="check_out_date" value="<?php if(!empty($item->check_out)){ echo date('Y-m-d', strtotime($item->check_out)) ; }  ?>" class="form-control  datepicker" id="checkoutDate" placeholder="YYYY-MM-DD" >
										</div>
										<div class="col-md-3">
											<select name="check_out_hour" class="form-control" id="check_out_hour" tabindex="-1" title="">
												<option value="0" selected="selected"><?php if(!empty($item->check_out)){ echo date('H', strtotime($item->check_out)) ; }   ?></option>
												
											</select>
										</div>
										<div class="col-md-3">
											<select name="check_out_min" class="form-control" id="check_out_min" tabindex="-1" title="">
												<option value="0" selected="selected"><?php if(!empty($item->check_out)){ echo date('i', strtotime($item->check_out)) ; }   ?></option>
												
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group all">
										<label for="grace_time"><?php echo lang('Grace_time');?></label>
										
										<select name="grace_time" class="form-control" id="grace_time" tabindex="-1" title="grace time" >
											<option value="00:00" ><?php if(!empty($item->grace_time)){ echo $item->grace_time ; } ?></option>
											
										</select>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-md-4">
									<div class="form-group all">
										<label for="night"><?php echo lang('Nights');?> *</label>
										<input name="night" value="<?php if(!empty($item->night)){ echo $item->night ; } ?>" class="form-control" id="night"  maxlength="2" minlength="1" >
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group all">
										<label for="number_of_adult"><?php echo lang('Number_Of_Adults');?> *</label>
									<select name="number_of_adult" class="form-control adult" id="number_of_adult"  tabindex="-1" title="number of adult">
									
										<option value="1" ><?php if(!empty($item->number_of_adult)){ echo $item->number_of_adult ; } ?></option>
										
									</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group all">
										<label for="number_of_child"><?php echo lang('Number_Of_Child');?></label>
										<select name="number_of_child" class="form-control" id="number_of_child" tabindex="-1" title="number of child" >
											<option value="0"><?php if(!empty($item->number_of_child)){ echo $item->number_of_child ; } ?></option>
											
										</select>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-md-4">
									<div class="form-group all">
										<label for="number_of_Units"><?php echo lang('Number_Of_Units');?>*</label>
										<select name="number_of_Units" class="form-control units" id="number_of_Units"  tabindex="-1" title="number of Units" >
											<option value="" selected="selected"><?php if(!empty($item->number_of_rooms)){ echo $item->number_of_rooms ; } ?></option>
											
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group all">
										<label for="Booking_status"><?php echo lang('Booking_status');?>*</label>
										<select name="Booking_status" class="form-control" id="Booking_status"  tabindex="-1" title="Booking status" >
											<option value="o"><?php if(!empty($item->reservation_status)){ echo $item->reservation_status ; } ?></option>
											
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group all">
										<label for="Booking_reason"><?php echo lang('Booking_reason');?></label>
										<input name="Booking_reason" value="<?php if(!empty($item->reservation_reason)) echo $item->reservation_reason ;  ?>" class="form-control " id="Booking_reason">
									</div>
								</div>
								<div class="clearfix"></div>
							</fieldset>
					  <div class="table_sec1">
							<table class="table table-bordered" style="margin-bottom: 0;">
								<tbody>
									<tr>
										<td>
										Total Payable
										</td>
										<td class="text-right">
										$<?php if(!empty($item->TotalPayable)){ echo round($item->TotalPayable,2) ; } ?>

										</td>
										<td>
										Advance traiff 
										</td>
										<td class="text-right">
									$<?php if(!empty($item->Advance_traiff)){ echo round($item->Advance_traiff,2) ; } ?>
										</td>
									</tr>
								<tr>
									<td>Total Paying</td>
									<td class="text-right"><span id="total_paying1">$<?php if(!empty($item->Totalpaying)){ echo round($item->Totalpaying,2) ; } ?><input type="hidden" name="total_paying" class="total_paying" value="1000"></span></td>
									<td>Balance</td>
									<td class="text-right"><span id="balance_BASE1">$<?php if(!empty($item->Balance)){ echo round($item->Balance,2) ; } ?><input type="hidden" name="balance" class="balance_BASE" value="0"></span>
								</td>
								</tr>
								</tbody>
							</table>
							<div class="clearfix"></div>
						<br>
					</div>
						  </td>
						</tr>
						
						<?php
					  }
					  }
						
						
						?>					  </tbody>
					</table>
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