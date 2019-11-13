  <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
.table-bordered>thead>tr>th{
	    background-color: #FFF !important;
		color: black !important;
}
</style>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			
            <li class="active">Resale Commission Details</li>
          </ol>
</section>
<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  	<div class="box-body">
				 	<div class="box-content">
							<div class="col-lg-12 well well-sm">
								<legend style="font-weight:bold;">Resale Commission Details</legend>
								<table class="table">
									<tbody>
										<tr>
											<td>
												<table class="table">
													<colgroup>
														<col width="49%">
														<col width="1%">
														<col width="50%">
													</colgroup>
													<tbody>
													<tr>
															<td>Owner Name</td>
															<td>:</td>
															<td> <?php  if(isset($commission_details->owner)){ echo $commission_details->owner ;  } ?></td>
														</tr>
														<tr>
															<td>Project Name</td>
															<td>:</td>
															<td> <?php  if(isset($commission_details->project)){ echo $commission_details->project ;  } ?></td>
														</tr>
														<tr>
															<td>Floor</td>
															<td>:</td>
															<td> <?php  if(isset($commission_details->floors)){ echo $commission_details->floors ;  } ?></td>
                                             
														</tr>
														<tr>
															<td> Date</td>
															<td>:</td>
															<td> <?php  if(isset($commission_details->date)){ echo $commission_details->date ;  } ?></td>
                                             
														</tr>
														<tr>
															<td>Commission Amount</td>
															<td>:</td>
															<td style=""> <?php  if(isset($commission_details->commission_amount)){ echo $this->sma->formatMoney( $commission_details->commission_amount) ;  } ?></td>     
                                             
														</tr>
														
													</tbody>
													
												</table>
											</td>
											<td>
												<table class="table">
													<colgroup>
														<col width="49%">
														<col width="1%">
														<col width="50%">
													</colgroup>
													<tbody>
													<tr>
															<td> Reference Number</td>
															<td>:</td>
															<td>	 <?php  if(isset($commission_details->reference_number)){ echo $commission_details->reference_number ;  } ?></td>
														</tr>
														<tr>
															<td> Building</td>
															<td>:</td>
															<td>	 <?php  if(isset($commission_details->building)){ echo $commission_details->building ;  } ?></td>
														</tr>
														<tr>
															<td>Unit</td>
															<td>:</td>
														<td> <?php  if(isset($commission_details->unit)){ echo $commission_details->unit ;  } ?></td>
														</tr>
														<tr>
															<td>Created Date</td>
															<td>:</td>
														<td> <?php  if(isset($commission_details->created_on)){ echo $commission_details->created_on ;  } ?></td>
														</tr>
														<tr>
															<td>Balance</td>
															<td>:</td>
															<td> <?php  if(isset($commission_details->balance)){ echo $this->sma->formatMoney( $commission_details->balance );  } ?></td>
                                             
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
									
								</table>
							
							</div>
							<div class="col-lg-12 well well-sm">
								<legend style="font-weight:bold;">Payment Details</legend><button style="float:right;background-color:#E27D60:color:#fff;"type="button" onclick="showaddpayment()" class="btn ">Add Payment</button>
								<div class="table-responsive col-sm-12">
								<br>
									<table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
										<thead>
											<tr>
										     <th>S.No</th>
												<th>Date</th>
												<th>Amount</th>
												<th>Balance</th>
												<th>Paid Type</th>
												<th>Note</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										
										<?php if($paymentdetails){ $i=1; foreach($paymentdetails as $row){  ?>
										<tr>
										<td><?php  echo $i ;  ?></td>
										<td><?php  echo $row->payment_date ;  ?></td>
										<td><?php  echo $this->sma->formatMoney( $row->paid_amount) ;  ?></td>
										<td><?php  echo $this->sma->formatMoney( $row->balance_amount) ;  ?></td>
										<td><?php  echo $row->paid_by ;  ?></td>
										<td><?php  echo $row->note ;  ?></td>
										<td><a href="#addpayment" data-id="<?php echo $row->id ?>" data-amt="<?php echo $row->paid_amount ?>" 
										data-paymentdate="<?php echo $row->payment_date ?>" data-note="<?php echo $row->note ?>"data-paid_by="<?php echo $row->paid_by ?>"data-cc_no="<?php echo $row->cc_no ?>"data-cc_holder="<?php echo $row->cc_holder ?>" data-cc_month="<?php echo $row->cc_month ?>" data-cc_year="<?php echo $row->cc_year ?>"class="editpayment">Edit</a>
										<!--  | <a href="#myModal" data-toggle="modal">Edit</a>  --> | 
										<!--<a href="#">Receipt</a>|--> <a href="<?php echo site_url('admin/accounts/resale_commission_paymentdelete/'.$row->id); ?>">Delete</a></td>
											</tr>
										<?php   $i++; }   }   ?>
										
										</tbody>
									</table>
							</div>
            		</div>
               				
							</div><!-- /.box -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
		  <form  data-toggle="validator" role="form" action="<?php echo site_url('admin/accounts/add_resale_commissionPayment/'.$commission_details->id); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="bv-form">
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
                                <input type="text" name="date"  id="paymentdate" class="form-control datepicker"  required="required" ><i class="form-control-feedback" onkeydown="return false" ></i>
                                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="date" data-bv-result="NOT_VALIDATED" style="display: none;"><?php echo lang('Ple_enter')?></small></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reference_no"><?php echo lang('balance')?></label>
                                <input type="text"  value="<?php  if(isset($commission_details->balance)){ echo $commission_details->balance ;  } ?>" class="form-control tip"  NAME="balanceamount" readonly>
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
                                                <input name="amount-paid" type="text" id="amount_1"  class="pa form-control kb-pad amount allowdecimalpoint" required="required" data-bv-field="amount-paid"><i class="form-control-feedback" data-bv-icon-for="amount-paid" style="display: none;"></i>
                                               </div>
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
		
<script>
$('.payingtype').on('change', function() {
  if(this.value == '<?php echo lang('Credit_Card'); ?>'){
	  $('.pcc_1').css('display','block');
  }else{
	$('.pcc_1').css('display','none');
  }
});


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
