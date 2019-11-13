
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12" data-offset="0">
                <div class="wrap-fpanel">
                    <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h3 class="box-title"><?= lang('Generate_Payment') ?></h3>
                        </div>
                        <div class="panel-body">
                                <?php echo form_open('admin/payroll/savePayroll', array('class' => 'form-horizontal')) ?>
                                <div class="panel_controls">
                                 
									 <div class="form-group">
                                        <label for="field-1" class="col-sm-2 control-label"><?= lang('month') ?></label>
                                        <div class="col-sm-2" style="padding-top: 5px">
                                           <span class="label label-success" style="font-size: 15px"><?php echo date('F Y',strtotime($month)); ?></span>
                                        </div>
                                        <label class="col-sm-1 control-label" style="text-align: right"><?= lang('currency') ?> </label>
                                        <div class="col-sm-3" style="padding-top: 5px">
                                             <select class="form-control select2 currency" name="Currency">
                                                <option value=""><?= lang('please_select') ?>...</option>
                                                <?php
												  if(isset($Currency))
												  {
													  foreach($Currency as $item)
													  {
												?>
												<option value="<?php echo $item->id;  ?>" <?php  echo get_option('default_currency')== $item->Currency_code ?'selected':''?>><?php echo $item->Currency_code;  ?> - <?php echo $item->Country;  ?>
												</option>
												<?php
													  }
												  }
												?>
                                            </select>
										
										  <input type="hidden" id="Exchangerate"  value="<?php echo get_option('Exchanage_rates'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="field-1" class="col-sm-2 control-label"><?= lang('employee') ?></label>
                                        <div class="col-sm-2" style="padding-top: 5px">
                                            <?php echo $employee->first_name.' '.$employee->last_name ?>
                                        </div>
                                        <label class="col-sm-1 control-label" style="text-align: right"><?= lang('employee_id') ?> </label>
                                        <div class="col-sm-2" style="padding-top: 5px">
                                            <?php echo $employee->employee_id ?>
                                        </div>
                                         <label class="col-sm-1 control-label" style="text-align: right"><?= lang('LOP') ?> </label>
                                        <div class="col-sm-2" style="padding-top: 5px">
                                               <!-- <?php if(isset($absent_Based_on_time_sheet)){ echo $absent_Based_on_time_sheet ; }else{ echo 0 ; } ?>-->
											  <input type="text" value=" <?php if(isset($absent_Based_on_time_sheet)){ echo $absent_Based_on_time_sheet ; }else{ echo 0 ; } ?>" class="form-control lops" name="lops">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="field-1" class="col-sm-2 control-label"><?= lang('department') ?></label>
                                        <div class="col-sm-2" style="padding-top: 5px">
                                            <?php echo $department->department ?>
                                        </div>
                                        <label class="col-sm-1 control-label" style="text-align: right"><?= lang('job_title') ?> </label>
                                        <div class="col-sm-2" style="padding-top: 5px">
                                            <?php echo $employee->job_title ?>
                                        </div>
										 <label class="col-sm-1 control-label" style="text-align: right"><?= lang('Late_Minutes') ?> </label>
                                        <div class="col-sm-2" style="padding-top: 5px">
										  <input type="text" value=" <?php if(isset($total_lateminute)){ echo $total_lateminute ; }else{ echo 0 ; } ?>" class="form-control lateminute" name="Late_Minutes" >
                                             <label style="font-size:12px;" ><?= lang('Per_min') ?> </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="field-1" class="col-sm-2 control-label"><?= lang('gross_salary') ?></label>
                                        <div class="col-sm-2" style="padding-top: 5px">
                                            <input type="text" value=" <?php echo ($salary->Current_total_payable + $salary->Current_total_deduction) ?>" class="form-control rates" disabled>
											 <input type="hidden" value=" <?php echo ($salary->Current_total_payable + $salary->Current_total_deduction) ?>" class="rate" >
                                        </div>
                                        <label class="col-sm-1 control-label" style="text-align: right"><?= lang('deduction') ?> </label>
                                        <div class="col-sm-2" style="padding-top: 5px">
                                            <input type="text" value=" <?php echo ($salary->Current_total_deduction) ?>" class="form-control rates" disabled>
											 <input type="hidden" value=" <?php echo ($salary->Current_total_deduction) ?>" class="rate" disabled>
                                        </div>
                                  <label class="col-sm-1 control-label" style="text-align: right"><?= lang('Late_fine') ?> </label>
                                        <div class="col-sm-2" style="padding-top: 5px">
                                            <input type="text" value="<?php if(isset($fine_amount)){ echo $fine_amount ; }else{ echo 0 ; } ?>" class="form-control latefine rates"  name="Late_fine">
											 <input type="hidden" value="<?php if(isset($fine_amount)){ echo $fine_amount ; }else{ echo 0 ; } ?>" class="rate"  >
                                        </div>
                                    </div>

                                    <div class="form-group margin">
                                        <label class="col-sm-2 control-label"><?= lang('net_salary') ?> </label>
                                        <div class="col-sm-5">
                                            <input type="text" value=" <?php echo $salary->Current_total_payable ?>" class="form-control rates"  disabled>
											 <input type="hidden" value=" <?php echo $salary->Current_total_payable ?>" class="form-control rate"  disabled>
                                        </div>
										  <label class="col-sm-1 control-label" style="text-align: right"><?= lang('Late_Amount') ?> </label
>                                        <div class="col-sm-2" style="padding-top: 5px">
                                            <input type="text" value="<?php if(isset($fine_amount)){ echo $fine_amount*$total_lateminute ; }else{ echo 0 ; } ?>" class="form-control Late_Amount rates" name="Late_Amount">
											<input type="hidden" value="<?php if(isset($fine_amount)){ echo $fine_amount*$total_lateminute ; }else{ echo 0 ; } ?>" class="rate" >
                                        </div>
                                    </div>
                                    <?php if(!empty($award)): $totalAward = 0; foreach($award as $item ): ?>
                                        <?php if ($item->award_amount == '0.00') { // skip even members
                                            continue;
                                        } ?>
                                        <div class="form-group margin">
                                            <label class="col-sm-2 control-label"><?= lang('award') ?> </label>
                                            <div class="col-sm-5">
                                                <input type="text" value=" <?php echo $this->localization->currencyFormat($item->award_amount) ?>" class="form-control" disabled>
                                                <span style="font-size: small"><?= $item->award_name ?></span>
                                            </div>
                                        </div>
                                        <?php $totalAward += $item->award_amount ?>
                                    <?php endforeach; endif ?>
                                    <?php
                                    if(!empty($totalAward)){
                                        $totalPayable =  $totalAward + $salary->Current_total_payable;
                                    }else{
                                        $totalPayable = $salary->Current_total_payable;
                                    }
                                    ?>
                                    <input type="hidden" value=" <?php echo $totalPayable ?>" class="rates" id="net_salary">
									

                                    <div class="form-group margin">
                                        <label class="col-sm-2 control-label"><?= lang('fine_deduction') ?> </label>

                                        <div class="col-sm-5">
                                            <input type="text" value="<?php if(!empty($payroll)) echo $this->localization->currencyFormat($payroll->fine_deduction) ?>" class="form-control rates" name="fine_deduction" id="fine_deduction">
											<input type="hidden" value="<?php if(!empty($payroll)) echo $this->localization->currencyFormat($payroll->fine_deduction) ?>" class="form-control rate" >
                                        </div>
                                    </div>

                                    <div class="form-group margin">
                                        <label class="col-sm-2 control-label"><?= lang('bonus') ?> </label>

                                        <div class="col-sm-5">
                                            <input type="text" value="<?php if(!empty($payroll)) echo $this->localization->currencyFormat($payroll->bonus) ?>" class="form-control rates" name="bonus" id="bonus">
											<input type="hidden" value="<?php if(!empty($payroll)) echo $this->localization->currencyFormat($payroll->bonus) ?>" class="form-control rate" >
                                        </div>
                                    </div>
                                     <div class="form-group margin">
                                        <label class="col-sm-2 control-label"><?= lang('TAx_deduction') ?> </label>

                                        <div class="col-sm-3">
										 <label for="name" class="control-label"><?= lang('Tax_slab') ?></label>
                                            <input  style="background-color:#fff;border:1px solid #fff;"type="text" value="<?php if(isset($taxs['tax']->Start_range)){echo $taxs['tax']->Start_range; }else { echo 0; }?> To <?php if(isset($taxs['tax']->End_range)){echo $taxs['tax']->End_range; }else { echo 0; }?>" class="form-control" id="" name=""   readonly >
											
                                        </div>
										<div class="col-sm-2">
										 <label for="name" class="control-label"><?= lang('Tax_Per') ?></label>
                                            <input type="text" value="<?php  if(!empty($taxs['tax']->Tax_percentage)){  echo $taxs['tax']->Tax_percentage;}else{ echo 0;} ?>" class="form-control tax_cal" id="tax_perc" name="tax_percentage"   >
                                        </div>
										<div class="col-sm-2">
										 <label for="name" class="control-label"><?= lang('Annual_salary') ?></label>
                                            <input type="text" value="<?php   if(isset($taxs['YearSalary'])){echo $taxs['YearSalary']; }else { echo 0; }  ?>" class="form-control tax_cal rates" id="annualsalary" name="annualsalary"   >
											  <input type="hidden" value="<?php   if(isset($taxs['YearSalary'])){echo $taxs['YearSalary']; }else { echo 0; }  ?>" class="tax_cal rate"    >
                                        </div>
										  <div class="col-sm-2">
										   <label for="name" class="control-label"><?= lang('Annual_tax') ?></label>
                                            <input type="text" value="<?php
										if(isset( $taxs['YearSalary'])&&(isset($taxs['tax']->Tax_percentage)&&(($taxs['tax']->Tax_percentage))>0)){echo( $taxs['YearSalary']/($taxs['tax']->Tax_percentage))-$taxs['tax']->Allow_Benefits;  }else { echo 0; }  ?>" class="form-control rates" id="Annualtax" name="Annualtax"   readonly>
										 <input type="hidden" value="<?php
										if(isset( $taxs['YearSalary'])&&(isset($taxs['tax']->Tax_percentage)&&(($taxs['tax']->Tax_percentage))>0)){echo( $taxs['YearSalary']/($taxs['tax']->Tax_percentage))-$taxs['tax']->Allow_Benefits;  }else { echo 0; }  ?>" class="rate"   readonly>
                                          </div>
											  <div class="col-sm-2">
										<label for="name" class="control-label"></label>
                                    </div>
										  <div class="col-sm-2">
										<label for="name" class="control-label"><?= lang('Monthly_Tax') ?></label>
                                     <input type="text" value="<?php 
									 
									  if(isset( $taxs['YearSalary'])&&(isset($taxs['tax']->Tax_percentage)&&(($taxs['tax']->Tax_percentage))>0)){echo round(((( $taxs['YearSalary']/($taxs['tax']->Tax_percentage))-$taxs['tax']->Allow_Benefits)/12),2);  }else { echo 0; }  
                                           
											 ?>" class="form-control rates" id="Monthly_tax" name="Monthly_tax"  readonly >
											  <input type="hidden" value="<?php 
									 if(isset( $taxs['YearSalary'])&&(isset($taxs['tax']->Tax_percentage)&&(($taxs['tax']->Tax_percentage))>0)){echo round(((( $taxs['YearSalary']/($taxs['tax']->Tax_percentage))-$taxs['tax']->Allow_Benefits)/12),2);  }else { echo 0; }  
									 
											 ?>" class="form-control rate"  readonly >
                                        </div>
			                        </div>
                                    <div class="form-group margin">
                                        <label class="col-sm-2 control-label"><?= lang('payment_amount') ?> </label>

                                        <div class="col-sm-5">
                                            <input type="text" value="
											<?php 
											if(!empty($payroll)){ 
											echo round(((($payroll->net_payment/30)*(30-$absent_Based_on_time_sheet))-($fine_amount*$total_lateminute)),2) ;
											}else{ 
											echo round( ((($totalPayable/30)*(30-$absent_Based_on_time_sheet))-($fine_amount*$total_lateminute)),2); 
											}  
											?>  
											
											
											" class="form-control rates   payment_amount"  name="PayAmounts"   readonly>
											 <input type="hidden" value="
											<?php 
											if(!empty($payroll)){ 
											echo round(((($payroll->net_payment/30)*(30-$absent_Based_on_time_sheet))-($fine_amount*$total_lateminute)),2) ;
											}else{ 
											echo round( ((($totalPayable/30)*(30-$absent_Based_on_time_sheet))-($fine_amount*$total_lateminute)),2); 
											}  
											?> 
											
											
											" class="form-control rate payment_amount"    readonly>
                                        </div>
                                    </div>
                                <div class="form-group margin">
                                        <label class="col-sm-2 control-label"><?= lang('payment_method') ?> </label>

                                        <div class="col-sm-5">
                                            <select class="form-control select2 paymethod" name="payment_method" id="paymethod">
                                              
                                                <option value="<?= lang('cash') ?>"><?= lang('cash') ?></option>
                                                <option value="<?= lang('check') ?>"><?= lang('check') ?></option>
                                                <option value="<?= lang('electronic_transfer') ?>"><?= lang('electronic_transfer') ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group margin">
                                        <label class="col-sm-2 control-label"><?= lang('comment') ?> </label>

                                        <div class="col-sm-5">
                                            <input type="text" value="<?php if(!empty($payroll)) echo $payroll->note ?>" name="note" class="form-control">
                                        </div>
                                    </div>

                                    <input type="hidden" name="employee_id" value="<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id)) ?>" >
                                    <input type="hidden" name="month" value="<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($month)) ?>">

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-5">
                                            <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('save') ?></button>
                                        </div>
                                    </div>
                                </div>
                           <?php echo form_close() ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#date').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
        });
    });
</script>
<script type="text/javascript">
        $(document).on("change", function() {

		var fine = 0;
            var bonus = 0;
			var monthday=30;
			var lop=!isNaN($('.lops').val())? $('.lops').val(): 0;                                    
			var lateminute=$('.lateminute').val();
			var latefine=$('.latefine').val();
			var tax=$('#Monthly_tax').val();
			var total_late_fine=(lateminute*latefine);
            fine = $("#fine_deduction").val();
            bonus = $("#bonus").val();
            var net_salary = $("#net_salary").val();
			var totals=(net_salary/monthday)*(monthday-lop);
			var total_net=(totals-total_late_fine);
            var total =  total_net - fine + + bonus;
			var with_tax=(total-tax);
		   $('.Late_Amount').val(total_late_fine);	
            $(".payment_amount").val(with_tax.toFixed(2));

           });
    </script>
	<script>
	$(document).ready(function() {
	    var tax=!isNaN($('#Monthly_tax').val())? $('#Monthly_tax').val(): 0;
		  var Amount=!isNaN($('.payment_amount').val())? $('.payment_amount').val(): 0;                                  
		  var Totalamount=Amount-tax;
		  $('.payment_amount').val(Totalamount.toFixed(2));
		 });
	</script>
	<script>
	   $(document).on("change",'.tax_cal',function() {
		   
         var tax_per=!isNaN($('#tax_perc').val())? $('#tax_perc').val(): 0;
		  var Amount=!isNaN($('.payment_amount').val())? $('.payment_amount').val(): 0;           
		  var Annual_salary=!isNaN($('#annualsalary').val())? $('#annualsalary').val(): 0;    
          var totaltax=((Annual_salary/100)*tax_per);
             var anualtax= totaltax*12;   		  
		  var Totalamount=Amount-totaltax;
		  $('.payment_amount').val(Totalamount.toFixed(2));
		   $('#Annualtax').val(anualtaxtoFixed(2));
		    $('#Monthly_tax').val(totaltaxtoFixed(2));
		  
           });
	</script>
	<script>
	$(document).ready(function()
	{
      function calculate(Exchange_rate,Round_of)
	  {
		 var total=0;
		 $('.rate').each(function() {
	     total = isNaN(parseFloat($(this).val()) * parseFloat(Exchange_rate))?0:parseFloat($(this).val()) * parseFloat(Exchange_rate);
	    $(this).siblings('.rates').val(total.toFixed(2));
    })
		 
	  }
   $('.currency').on('change',function()
    {
         var Currency_id=$(this).val();
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/Payroll/currency_load/')?>/" + Currency_id,
            type: "GET",
            data : {'csrf_test_name' : getCookie('csrf_cookie_name')},
            dataType: "JSON",
            success: function(data)
            {
                $('#Exchangerate').val(parseFloat(data.Exchange_rate,6));
				calculate(parseFloat(data.Exchange_rate),data.Round_of);
            }
        });
    });
	});
	</script>
	<script>
	$('form').attr('autocomplete', 'off');
	</script>
	