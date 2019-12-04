<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
.table>thead>tr>th { border:none; }
	.modal{z-index: 99999999999999;}
.modal-backdrop.in{opacity: 0;}
.modal-body .table tr th{background-color: #ccc;border: 1px solid #efefef;}
.modal-body .table tr td{border: none;}
.modal-backdrop{opacity:0;z-index:-1;}
.booking_view_list li a{border:1px solid #333;}
.booking_view_list .active a{border:1px solid #333;}
</style>
		<section class="view_booking">
			<div class="row">
				<div class="col-sm-12  col-xs-12 view_bk">
					<h3>View Booking</h3>
				</div>
				<div class="col-sm-12  col-xs-12 view_bk">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Client Details</legend>
						<table class="table">
							<tbody>
								<tr>
									<td>Name</td>
									<td><?php echo $result->customer_name; ?></td>
									<td>Mobile</td>
									<td><?php echo $result->contact_number; ?></td>
								</tr>
								<tr>
									<td>Occupation</td>
									<td><?php echo $result->occupation; ?></td>
									<td>DOB</td>
									<td>
									<?php   if($result->dob !='0000-00-00'){ echo $result->dob ; } ?>
									
									
								</tr>
								<tr>
									<td>Email</td>
									<td><?php echo $result->email; ?></td>
								</tr>
							</tbody>
						</table>
					</fieldset>
				</div>
				<div class="col-sm-12 col-xs-12 view_bk" style="padding: 0px;">
					<div class="col-sm-8 col-xs-12 ">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Booking Details</legend>
							<table class="table">
								<tbody>
									<tr>
										<td>Booking Id</td>
										<td><?php echo $result->id; ?></td>
										<td>Booking Date</td>
										<td><?php echo $result->booking_date; ?></td>
										
									</tr>
									<tr>
									    <td>Floor no</td>
										<td><?php echo $result->floorname; ?></td>
										<td>House No</td>
										<td><?php echo $result->unit_no; ?></td>
									</tr>
									<tr>
										<td><?php echo lang('refno'); ?></td>
										<td><?php echo  $result->ref_no; ?></td>
										<td>Sales By</td>
										<td><?php if(!empty($salepersonName->Name)){echo $salepersonName->Name; }?></td>
									</tr>
									
								</tbody>
							</table>
						</fieldset>
						
						<?php  if($payment_type ==2  && $result->balance>0 ) { ?>
						<button type="button" onclick="showaddpayment()" class="btn btn-warning col-md-offset-10" data-toggle="modal" data-target="#addpayment">Add Payment</button>
						<?php    }  ?>
						<?php  if($payment_type ==2 ) { ?>
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Payment Details</legend>
						<div class="table-responsive">
						<table class="table">
								<thead>
									<tr>
										<th>Sno</th>
										<th> Paid Date</th>
										<th>Amount</th>
										<th>Status </th>
										<th>Action</th>
									</tr><tr>
								</tr></thead>
								<tbody>
									<?php
								    $i = 1;
									foreach($payment as $item) { ?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $item->payment_date; ?></td>
										<td><?php        
										echo $this->sma->formatMoney($item->paid_amount)  ;
										
										?></td>
										<td><?php echo $item->type ; ?></td>
										<td><a href="#addpayment" data-id="<?php echo $item->id ?>" data-amt="<?php echo $item->paid_amount ?>" 
										data-paymentdate="<?php echo $item->payment_date ?>" data-note="<?php echo $item->note ?>"data-paid_by="<?php echo $item->paid_by ?>"data-cc_no="<?php echo $item->cc_no ?>"data-cc_holder="<?php echo $item->cc_holder ?>" data-cc_month="<?php echo $item->cc_month ?>" data-cc_year="<?php echo $item->cc_year ?>"class="editpayment">Edit</a>
										<!--  | <a href="#myModal" data-toggle="modal">Edit</a>  --> | <a href="<?php echo site_url('admin/sales/Sales/Invoice/'.$item->id.'/2'); ?>">Receipt</a>| <a href="<?php echo site_url('admin/sales/Sales/paymentdelete/'.$item->id); ?>">Delete</a></td>
									</tr>
									<?php
									$i++;
									} ?>
																
								</tbody>
							</table>
							</div>
						</fieldset>
						
						<?php    }elseif($payment_type ==1){  ?> 
						
						 <?php   if(!empty($result->emi_period)) :   ?>
								<a href="<?php echo site_url('admin/sales/Sales/paymentSchedule/'.$result->id .'/2') ?>" ><input type="button"  class="btn bg-olive btn-flat" value="<?php  echo $result->emi_period;  ?> Months Payment Schedule"/></a>
							<?php  endif;  ?>
							<?php   if(!empty($result->moratorium)&& $result->moratorium !=0.00) :   ?>
							<a href="<?php echo site_url('admin/sales/Sales/paymentSchedule/'.$result->id .'/1') ?>" ><input type="button"  class="btn bg-olive btn-flat" value="<?php  echo round(($result->moratorium),1);  ?> Months Payment Schedule"/></a>
							<?php  endif;  ?>
						
						<?php    }  ?>
						<ul class="nav nav-pills booking_view_list" style="margin:15px 0px;">
					    <?php   if(!empty($result->emi_period)) :   ?>
							<li class="active">
								<a href="#1a" data-toggle="tab">Loan <?php  echo $result->emi_period;  ?> Months</a>
							</li>
							<?php  endif;  ?>
							<?php   if(!empty($result->moratorium)&& $result->moratorium !=0.00) :   ?>
							<li class="<?php   echo (empty($result->emi_period))? 'active' :0; ?>">
								<a href="#2a" data-toggle="tab">Loan <?php  echo round(($result->moratorium),1);  ?> Months</a>
							</li>
							<?php  endif;  ?>
						</ul>
						<div class="tab-content clearfix">
							<div class="tab-pane <?php   echo (!empty($result->emi_period))? 'active' :0; ?>" id="1a">
								<fieldset class="scheduler-border">
							<legend class="scheduler-border">Payment Details</legend>
						<div class="table-responsive">
						<?php  if($payment_type ==1) { ?>
							<table class="table">
								<thead>
									<tr>
										<th>Sno</th>
										<!-- <th>Type</th> -->
										<th> Date</th>
										<th>Beginning_Balance</th>
										<th>Amount</th>
										<th>Principle</th>
										<th>Interest</th>
										<th>Ending_Balance</th>
										<th>Status </th>
										<th>Action</th>
									<tr>
								</thead>
								<tbody>
									<?php 
									$i = 1;
									foreach($result_emi as $row_emi) { ?>
									<tr>
										<td><?php echo $i; ?></td>
									
										<td><?php echo $row_emi->emi_duedate; ?></td>
									<td><?php  echo $this->sma->formatMoney($row_emi->Beginning_Balance)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->emi_amount)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Principal)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Interest)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Ending_Balance)                         ; ?></td>
										<td><?php if($row_emi->emi_status == 1) { echo 'paid'; }else{ echo 'unpaid'; } ?></td>
										<td><a href="#myModal" data-id="<?php echo $row_emi->id ?>" data-amt="<?php echo $row_emi->emi_amount ?>" 
										data-duedate="<?php echo $row_emi->emi_duedate ?>"  data-status="<?php if($row_emi->emi_status == 1) { echo 'Paid'; }else{ echo 'Unpaid'; }  ?>"class="pay_now"><?php if($row_emi->emi_status == 1) { echo 'Undo'; }else{ echo 'Pay'; }  ?></a>
										<?php if($row_emi->emi_status == 1) { ?>  | <a href="<?php echo site_url('admin/sales/Sales/Invoice/'.$row_emi->id.'/1'); ?>">Receipt</a>   <?php }?>
									</td>
									</tr>
									<?php
									$i++;
									} ?>
							
								</tbody>
							</table>
							<?php  }  ?>
							</div>
						</fieldset>
						
							</div>
							<div class="tab-pane <?php   echo (empty($result->emi_period))? 'active' :0; ?>" id="2a">
							
							<div class="table-responsive">
							<?php  if($payment_type ==1) { ?>
							<table class="table">
								<thead>
									<tr>
										<th>Sno</th>
										<!-- <th>Type</th> -->
										<th> Date</th>
										<th>Beginning_Balance</th>
										<th>Amount</th>
										<th>Principle</th>
										<th>Interest</th>
										<th>Ending_Balance</th>
										<th>Status </th>
										<th>Action</th>
									<tr>
								</thead>
								<tbody>
									<?php 
								 	
									$i = 1;
									foreach($result_emi2 as $row_emi) { ?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $row_emi->emi_duedate; ?></td>
									    <td><?php  echo $this->sma->formatMoney($row_emi->Beginning_Balance)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->emi_amount)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Principal)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Interest)                         ; ?></td>
										<td><?php  echo $this->sma->formatMoney($row_emi->Ending_Balance)                         ; ?></td>
										<td><?php if($row_emi->emi_status == 1) { echo 'paid'; }else{ echo 'unpaid'; } ?></td>
										<td><a href="#myModal" data-id="<?php echo $row_emi->id ?>" data-amt="<?php echo $row_emi->emi_amount ?>" 
										data-duedate="<?php echo $row_emi->emi_duedate ?>"  data-status="<?php if($row_emi->emi_status == 1) { echo 'Paid'; }else{ echo 'Unpaid'; }  ?>"class="pay_now"><?php if($row_emi->emi_status == 1) { echo 'Undo'; }else{ echo 'Pay'; }  ?></a>
										<?php if($row_emi->emi_status == 1) { ?>  | <a href="<?php echo site_url('admin/sales/Sales/Invoice/'.$row_emi->id.'/1'); ?>">Receipt</a>   <?php }?>
									</td>
									</tr>
									<?php
									$i++;
									} ?>
							
								</tbody>
							</table>
							<?php  } ?>
							</div>
						</fieldset>
							</div>
							</div>
							
					<div class="clearfix"></div>
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">Contract Form List</legend>
									<table class="table">
										<thead>
											<tr>
												<th>Sno</th>
												<th>Contract form</th>
												<th>Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php  if(isset($contractform)){ $i=1; foreach($contractform as $row){  ?>
											<tr>
												<td><?php  echo $i;  ?></td>
												<td><?php   switch($row->contact_id){ case 1:
												echo 'Contract';

break;
case 2:
echo 'View Contract 30%';
break ;
case 3:
echo 'View Contract 30% & 70%';
break;
case 4;
echo 'View Contract 24 Months';
break;
case 5:
echo 'View Contract 12 Months';
break;
												}  ?></td>
												<td><?php  echo date('d - m - Y',strtotime($row->created_on)); ?></td>
												<td>
													<span><a href="#"><i class="fa fa-eye"></i></a></span>&nbsp;
													<span><a href="<?php echo base_url('uploads/contract/'.$row->docpath)?>" class="btn btn-default" download><i class="fa fa-cloud-download"></i></a></span>
												</td>
											</tr>		
										<?php   $i++; }  }  ?>											
										</tbody>
									</table>
						</fieldset>
						</div>
					<div class="col-sm-4 col-xs-12">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Pricing Details</legend>
							<table class="table" style="table-layout: fixed;">
							<colgroup>
								<col width="45%">
								<col width="5%">
								<col width="45%">
							</colgroup>
								<tbody>
									<tr>
										<td>Total Amount </td>
										<td>:</td>
										<td><?php echo $this->sma->formatMoney($result->total_cost)  ; ?></td>
									</tr>
									<tr>
										<td>Initial Amount</td>
										<td>:</td>
										<td><?php echo $this->sma->formatMoney($result->initialAmount)   ; ?></td>
									</tr>
									<tr>
										<td>Advance Amount</td>
										<td>:</td>
										<td><?php echo $this->sma->formatMoney( $result->advance_amt)  ; ?>  <?php   if($result->advance_amt>0): ?> <a href="<?php echo site_url('admin/sales/Sales/advance_receipt/'.$result->id); ?>">Receipt</a> <?php  endif; ?></td>
									</tr>
									
									<tr>
										<td>Discount Amount</td>
										<td>:</td>
										<td><?php echo $this->sma->formatMoney($result->discount_amt)  ;  ?></td>
									</tr>
									
									<?php if(!empty($result->moratorium) && $result->moratorium !=0):  ?>
									<tr>
										<td>Moratorium Period</td>
										<td> :</td>
										<td><?php echo round(($result->moratorium),1)  ; ?> Months</td>
									</tr>
									<?php  endif; ?>
									<?php if(!empty($result->moratorium_amt) && $result->moratorium_amt !=0):  ?>
									<tr>
										<td>Moratorium Amount</td>
										<td> :</td>
										<td><?php echo $this->sma->formatMoney($result->moratorium_amt)  ; $period=($result->moratorium_amt !=0)? $result->moratorium:1; ?></td>
									</tr>
									<?php  endif; ?>
									<?php if(!empty($result->moratorium_amt) && $result->moratorium_amt !=0  && $result->moratorium_per<100):  ?>
									<tr>
										<td>Moratorium Monthly Payment</td>
										<td> :</td>
										<td><?php echo $this->sma->formatMoney($result->moratorium_amt/$period)  ; ?></td>
									</tr>
									<?php  endif; ?>
									<?php if(!empty($result->moratorium_amt) && $result->moratorium_amt !=0  && $result->moratorium_per<100):  ?>
									<tr>
										<td>Moratorium Balance </td>
										<td> :</td>
										<td><?php   echo ($result->moratorium_balance)?  $this->sma->formatMoney($result->moratorium_balance):  $this->sma->formatMoney(0) ; ?></td>
									</tr>
									<?php  endif; ?>
									<tr>
										<td>EMI Period</td>
										<td> :</td>
										<td><?php echo $result->emi_period; ?> Months</td>
									</tr>
									<tr>
										<td>Loan Amount</td>
										<td>:</td>
										<td><?php   
										echo $this->sma->formatMoney($result->total_loan_Amount -$result->total_loan_interest); 
										?></td>
										</tr>
										<tr>
											<td>Monthly payment</td>
											<td>:</td>
										<td><?php        
										echo $this->sma->formatMoney($emi['emi'])  ;
										?></td>
									</tr>
									<tr>
											<td>Loan Balance</td>
											<td>:</td>
										<td><?php        
										echo ($result->loan_balance >0) ?$this->sma->formatMoney($result->loan_balance) :$this->sma->formatMoney(0);
										?></td>
									</tr>
										<tr>
											<td>Total Interest  </td>
											<td>:</td>
										<td><?php        
										echo $this->sma->formatMoney($result->total_loan_interest)  ;
										?></td>
									</tr>
									<tr>
									<td>Total loan Amount</td>
									<td>:</td>
										
										<td>
										<?php      
										echo $this->sma->formatMoney(($result->total_loan_Amount )) ;
										?>
										
										</td>
										</tr>
										<?php  if($result->payment_type ==1)  {  ?>
									<tr>
										<td>Balance Amount</td>
										<td> :</td>
										<td><?php echo $this->sma->formatMoney($result->loan_balance + $result->moratorium_balance)  ; ?></td>
									</tr>
										<?php   }else{   ?>
									<tr>
										<td>Balance Amount</td>
										<td> :</td>
										<td><?php echo $this->sma->formatMoney($result->balance)  ; ?></td>
									</tr>
									
										
										<?php  } ?>
									<!--<tr>
										<td>Rate Per Sq meters</td>
										<td> :</td>
										<td><?php     echo $this->sma->formatMoney($result->rate_per_sqft)  ; ?> </td>
									</tr>
									<tr>
										<td>Total Area </td>
										<td> :</td>
										<td><?php echo $result->area_sqft; ?> in Sq meters </td>
									</tr>-->
									<tr>
										<td><a href="<?php echo site_url('admin/sales/Sales/contract/'.$result->id .'/1') ?>"> <input type="button"  class="btn bg-olive btn-flat" value="View Contract "/></a></td>
										<td><a href="<?php echo site_url('admin/sales/Sales/contract/'.$result->id .'/2') ?>"> <input type="button"  class=" btn bg-olive btn-flat" value="View Contract 30%"/></a></td>
									</tr>
									<tr>
										<td colspan="3"><a href="<?php echo site_url('admin/sales/Sales/contract/'.$result->id .'/3') ?>"> <input type="button"  class="btn bg-olive btn-flat" value="View Contract 30% & 70%"/></a></td>
										
									</tr>
									<tr >
										<td colspan="3"><a href="<?php echo site_url('admin/sales/Sales/contract/'.$result->id .'/4') ?>"> <input type="button"  class=" btn bg-olive btn-flat" value="View Contract 24 Months"/></a></td>
									</tr>
									<tr>
										<td colspan="3"><a href="<?php echo site_url('admin/sales/Sales/contract/'.$result->id .'/5') ?>"> <input type="button"  class="btn bg-olive btn-flat" value="View Contract 12 Months"/></a></td>
										
									</tr>
									
										
									
								</tbody>
							</table>
							
							<hr>
							
						</fieldset>
					</div>
					
					</div>
				</div>
			</div>
			 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title text-center">Pay Now</h4>
        </div>
        <div class="modal-body">
		<form method="post" action="<?php echo site_url('admin/sales/Sales/payment/'.$result->id); ?>" >
		<input type="hidden" class="form-control" name="emi_no" id="emi_no">
          <table class="table">
          <colgroup>
          	<col width="30%">
          	<col width="70%">
          </colgroup>
			<tbody>
				<tr>
					<td>Due Date</td>
					<td>
						<input type="text" name="due_date" id="due_date" class="form-control" readonly>
					</td>
				</tr>
				<tr>
					<td>Paid Date</td>
					<td>
						<input type="text" name="paiddate" id="paiddate" class="form-control datepicker" autocomplete="off" >
					</td>
				</tr>
				<tr>
					<td>Amount</td>
					<td>
						<input type="text"  value="" name="emi_amount" id="emi_amount" class="form-control" readonly>
						<input type="hidden"  name="status" id="status" class="form-control" readonly>
					</td>
				</tr>
				<tr>
					<td colspan="2"><button type="submit" class="btn btn-primary center-block">Submit</button></td>
				</tr>
			</tbody>
		</table>
		</form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>
<form  data-toggle="validator" role="form" action="<?php echo site_url('admin/sales/Sales/add_payment/'.$result->id); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="bv-form">
		<div class="modal" id="addpayment">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title" id="myModalLabel"><?php echo lang('Add_payment')?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <div class="modal-body">
                <div class="modal-body">
                    <p><?php echo lang('please_fill')?></p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="date"><?php echo lang('date')?> </label>
                                <input type="text" name="date"  id="paymentdate" class="form-control datepicker"  required="required" ><i class="form-control-feedback"></i>
                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="date" data-bv-result="NOT_VALIDATED" style="display: none;"><?php echo lang('Ple_enter')?></small></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reference_no"><?php echo lang('Reference_no')?></label>
                                <input type="text" name="reference_no" value="" class="form-control tip" id="reference_no">
                            </div>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
	                         <div id="payments">
                        <div class="well well-sm well_1">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="payment">
                                            <div class="form-group has-feedback">
                                                <label for="amount_1"><?php echo lang('Amount')?></label>
                                                <input name="amount-paid" type="text" id="amount_1"  class="pa form-control kb-pad amount" required="required" data-bv-field="amount-paid"><i class="form-control-feedback" data-bv-icon-for="amount-paid" style="display: none;"></i>
                                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="amount-paid" data-bv-result="NOT_VALIDATED" style="display: none;"><?php echo lang('Ple_enter')?></small></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group has-feedback">
                                            <label for="paid_by_1"><?php echo lang('Paying_by')?> *</label>
                                            <select class="form-control payingtype" name="paid_by" id="paid_by">
                                                <option><?php echo lang('Cash'); ?></option>
                                                <option><?php echo lang('Credit_Card'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="pcc_1" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="pcc_no" type="text" id="pcc_no_1" class="form-control" placeholder="Credit Card No">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input name="pcc_holder" type="text" id="pcc_holder_1" class="form-control" placeholder="Holder Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                  <select name="pcc_type"  class="form-control " placeholder="Card Type" id="cardtype" >
                                                    <option value="<?php echo lang('Visa'); ?>"><?php echo lang('Visa'); ?></option>
                                                    <option value="<?php echo lang('Mastercard'); ?>"><?php echo lang('Mastercard'); ?></option>
                                                    <option value="<?php echo lang('Amex'); ?>"><?php echo lang('Amex'); ?></option>
                                                    <option value="<?php echo lang('Discover'); ?>"><?php echo lang('Discover'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input name="pcc_month" type="text" id="pcc_month_1" class="form-control" placeholder="Month">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input name="pcc_year" type="text" id="pcc_year_1" class="form-control" placeholder="Year">
                                            </div>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
	                       <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                <label for="date"><?php echo lang('Note'); ?> *</label><br>
								<textarea class="form-control" id="paymentnote">  </textarea>
                                </div>
                        </div>
                    </div>
	  </div>
      </div>
      <div class="modal-footer">
	  <input type="hidden"  id="paymentid" name="paymentid">
	   <input type="submit" name="add_payment" value="Add Payment"  id="paymentbutton"class="btn btn-primary">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close'); ?></button>
      </div>
	  
    </div>
  </div>
</div>
</div></div>
 </form>
	</section>
	<!-- Modal -->
<script>
$('.pay_now').click(function(){
    var id=$(this).data('id');
	var amt=$(this).data('amt');
	var due_date=$(this).data('duedate');
	$("#emi_no").val(id);
	$("#status").val($(this).data('status'));
	$("#due_date").val(due_date);
	$("#emi_amount").val(amt);
    $('#myModal').modal('show');
})
</script>
<script>
$('.editpayment').click(function(){
	if($(this).data('paid_by') !='Cash'){
		$('.pcc_1').css('display','block');
	}
	$("#paymentid").val($(this).data('id'));
	$("#paymentdate").val($(this).data('paymentdate'));
	$("#reference_no").val(0);
	$("#amount_1").val($(this).data('amt'));
	$("#paid_by").val($(this).data('paid_by'));
	$("#pcc_no_1").val($(this).data('cc_no'));
	$("#pcc_holder_1").val($(this).data('cc_holder'));
	$("#pcc_month_1").val($(this).data('cc_month'));
	$("#pcc_year_1").val($(this).data('cc_year'));
	$("#paymentnote").val($(this).data('note'));
	$('#myModalLabel').text('Edit Payment');
	$('#paymentbutton').val('Edit Payment');
    $('#addpayment').modal('show');
})
</script>
<script>
 $(function() {
 $('.datepicker').datepicker({
		autoclose: true,
		todayHighlight: true,
	   format: 'yyyy-mm-dd',
    });
 
	      });
</script>
<script>
$('.payingtype').on('change', function() {
  if(this.value == '<?php echo lang('Credit_Card'); ?>'){
	  $('.pcc_1').css('display','block');
  }else{
	$('.pcc_1').css('display','none');
  }
});

</script>