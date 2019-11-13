<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
       <h4 class="modal-title" id="myModalLabel"><?php echo lang('Add_payment')?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
	     <form action="#" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate" class="bv-form">
                <div class="modal-body">
                    <p><?php echo lang('please_fill')?></p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="date"><?php echo lang('date')?> </label>
                                <input type="text" name="date" value="" class="form-control datepicker"  required="required" ><i class="form-control-feedback"></i>
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
                                            <select class="form-control payingtype">
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
                                                  <select name="pcc_type"  class="form-control " placeholder="Card Type" >
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
								<textarea class="form-control">  </textarea>
                                </div>
                        </div>
                    </div>
	  </div>
	  </form>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
	   <input type="submit" name="add_payment" value="Add Payment" class="btn btn-primary">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo lang('close'); ?></button>
      </div>
    </div>
  </div>
</div>

