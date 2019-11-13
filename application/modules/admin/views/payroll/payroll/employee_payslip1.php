
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<style>
	.bottom_table_salary{border: none;}
	.bottom_table_salary tbody tr td{border: none;}
	.bottom_table_salary tbody tr td:nth-child(even){border-bottom: 1px solid #ccc;}
	.bottom_table_salary tbody tr td:nth-child(odd){text-align: right;padding-bottom: 0px;}
	.bottom_table_salary tbody tr td:first-child{text-align: left;}
	.middle_salary_slip tbody tr td:nth-child(even){text-align: right;}
	.right_side_ded tbody tr td:nth-child(odd){text-align: left;}
	.net_salary_tab tbody tr td:nth-child(even){text-align: right;}
	</style>
	<script src="<?php echo base_url();  ?>assets/js/jquery-printme.js"></script> 
	  <script src="<?php echo base_url();  ?>assets/js/jquery-printme.min.js"></script> 

	


<div class="row">
<div class="col-sm-12">
   <div class="row">
      <div class="col-sm-12" data-offset="0">
         <div class="wrap-fpanel">
            <div class="box box-primary" data-collapsed="0">
               <div class="box-header with-border bg-primary-dark">
                  <h3 class="box-title"><?= lang('employee_payroll_list') ?></h3>
                  <div class="box-tools" style="padding-top: 5px">
                     <div class="input-group input-group-sm" >
                        <a class="btn" style="color: #FFF" id="printButton">
                        <i class="fa fa-print fa-2x" aria-hidden="true"></i>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="panel-body">
                  <div class="employee_salary_slip" >
                   
                        <div class="row">
						 <?php $company_logo = get_option('company_logo') ?>
						  <img height="180" width="180" src="<?php echo site_url(UPLOAD_LOGO.$company_logo)?>" class="img img-responsive center" >
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <h2 class="text-center"><?= lang('salary_payslip') ?></h2>
                              <div class="clearfix"></div>
                              <table class="table table-bordered">
                                 <colgroup>
                                    <col width="20%">
                                    <col width="50%">
                                 </colgroup>
                                 <thead>
                                    <tr>
                                       <th>Company Name</th>
                                      <th><?php  echo get_option('company_name') ?></th>
                                    </tr>
                                    <tr>
                                       <th><?= lang('employee') ?></th>
                                       <th><?php echo $employee->first_name.' '.$employee->last_name ?></th>
                                    </tr>
                                    <tr>
                                       <th><?= lang('department') ?></th>
                                       <th><?php echo $employee->department ?></th>
                                    </tr>
                                    <tr>
                                       <th><?= lang('salary_month') ?> </th>
                                       <th> <?php echo date("F, Y", strtotime($pay_slip->month));  ?></th>
                                    </tr>
                                    <tr>
                                       <th>LOP </th>
                                       <th> <?php echo $pay_slip->Lop ?></th>
                                    </tr>
                                 </thead>
                              </table>
                              <div class="clearfix"></div>
							  <table class="table middle_salary_slip" style="margin-bottom: 0px;">
					<tbody>
						<colgroup>
							<col width="50%">
							<col width="50%">
						</colgroup>
						<tr>
							<td style="padding: 0px;">
								<table class="table table-bordered" style="margin-bottom: 0px;">
								<colgroup>
									<col width="50%">
									<col width="50%">
								</colgroup>
									<thead>
										<th>Earnings</th>
										<th></th>
									</thead>
									<tbody>
										<?php foreach($salaryEarningList as $earning){ ?>
<?php
$salary = '';
if(!empty($empSalaryDetails)) {
foreach ($empSalaryDetails as $key => $details) {
if ($earning->id == $key) {
$salary = $details;
$data['total_earning'][]=$details;
?>
<tr><td><?php echo $earning->component_name?></td>
<td><?php if(!empty($salary)){ echo $Currency_code.'&nbsp'. round(($salary*$Currency->Exchange_rate),$round_off) ;} ?></td></tr>

<?php  
}
}
}
}
?>
					  <tr>
                             <td>Bonus</td>
                              <td>
                                <?php echo $Currency_code.'&nbsp'. round(($pay_slip->bonus),$round_off); ?>
                                     </td>
                                        </tr>
										<tr>
											<td>Total Addition</td>
											 <td><?php  if(isset($data['total_earning'])){echo $Currency_code.'&nbsp'. round(((array_sum($data['total_earning']))*$Currency->Exchange_rate+$pay_slip->bonus),$round_off); }else{  echo 0; } ?></td>
										</tr>
									</tbody>
								</table>
							</td>
							<td style="padding: 0px;">
								<table class="table table-bordered right_side_ded" style="margin-bottom: 0px;">
								<colgroup>
									<col width="50%">
									<col width="50%">
								</colgroup>
									<thead>
										<th>Deductions</th>
                                        <th></th>
									</thead>
									<tbody>
										
						
<?php foreach($salaryDeductionList as $deduction){ ?>
<?php
$salary = '';
if(!empty($empSalaryDetails)) {
foreach ($empSalaryDetails as $key => $details) {
if ($deduction->id == $key) {
$salary = $details;
$data['total_Deduction'][]=$details;
?>
<tr><td><?php echo $deduction->component_name?></td>
<td><?php if(!empty($salary)){ echo $Currency_code.'&nbsp'.round(($salary*$Currency->Exchange_rate),$round_off) ;} ?></td></tr>


<?php  
}
}
}
							}
?>
<tr>
<td>Late Fine</td>
<td>
<?php echo $Currency_code.'&nbsp'. $pay_slip->Late_amount ?>
</td>
<tr>


<tr>
<td>Tax</td>
<td>
<?php echo $Currency_code.'&nbsp'.$pay_slip->Monthly_tax ?>
</td>
</tr>
<tr>
<td>LOP</td>
<td>
<?php echo $Currency_code.'&nbsp'. round(((($pay_slip->net_salary/$TotalWorkingday)*$pay_slip->Lop)*$Currency->Exchange_rate),$round_off); ?>
</td>
</tr>
										 <tr>
										    <td>Penalty</td>
                              <td>
                                <?php echo $Currency_code.'&nbsp'. round(($pay_slip->Penalty),$round_off); ?>
                                     </td>
                                        </tr>
                                            <td>Total  Deductions</td>
                                            <td><?php   
                                                   if(isset($data['total_Deduction']))
                                                   {
                                                      $total_dec= array_sum($data['total_Deduction']);
                                                   }else
                                                   {
                                                       $total_dec=0;
                                                   }
 
                                            echo $Currency_code.'&nbsp'. round((($pay_slip->Penalty+$total_dec+ $pay_slip->Late_amount+$pay_slip->Monthly_tax+round((($pay_slip->net_salary/$TotalWorkingday)*$pay_slip->Lop),2))*$Currency->Exchange_rate),$round_off); ?></td>
                                        </tr>
									</tbody>
								</table>
							</td>
							
						</tr>
					</tbody>
				</table>
                  <table class="table table-bordered net_salary_tab">
					<colgroup>
						<col width="25%">
						<col width="25%">
						<col width="25%">
						<col width="25%">
					</colgroup>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td><strong>NET Salary</strong></td>
							<td><strong><?php echo $Currency_code.'&nbsp'. round($pay_slip->Payment_amount,$round_off) ?></strong></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered net_salary_tab">
                    <colgroup>
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong><?php if(isset($precisionvalue_currency)){ echo $precisionvalue_currency ;  }else{ echo get_option('default_currency'); }  ?>(Round off)</strong></td>
                            <td><strong><?php if(isset($precisionvalue_currency)){ echo $precisionvalue_currency ; }else{ echo get_option('default_currency'); }  ?>&nbsp;<?php if(isset($precisionvalue)){ echo round(($precisionvalue/$min_value),1) ; }else{ echo 0.00 ; } ?></strong></td>
                        
                        </tr>
						</tr>
					</tbody>
				</table>
				       <table class="table table-bordered bottom_table_salary">
					<colgroup>
						<col width="25%">
						<col width="25%">
						<col width="25%">
						<col width="25%">
					</colgroup>
					<tbody>
					<?php 
					
					if($pay_slip->payment_method=='Electronic Transfer')
					{
					if(isset($employee->deposit))
					{
						$deposite=json_decode($employee->deposit);
						
						?>
						<tr style="border: none;">
							<td  style="border: none;">Name of Bank: </td>
							<td style="border-bottom: 1px solid #FFF;border-top:1px solid #fff;">
							<p><?php  if(isset($deposite->account_name)){ echo   $deposite->account_name;  }  ?><p>
							<p><?php  if(isset($deposite->account_number)){ echo  $deposite->account_number ;   }  ?><p>
							<p><?php  if(isset($deposite->bank_name)){ echo  $deposite->bank_name;   }  ?><p>
							</td>
						</tr>
						<?php
					}
					
					}
						?>
						<tr style="border: none;">
							<td style="border: none;">Date: </td>
							<td style="border-bottom: 1px solid #ccc;"></td>
						</tr>
						<tr style="border: none;">
							<td class="nones" style="border: none;border-right:1px solid #fff;">Signature of the Employee: </td>
							<td class="nones" style="border-bottom: 1px solid #ccc;border-right:1px solid #fff;"></td>
							<td class="nones" style="border: none;">Director:</td>
							<td class="nones" style="border-bottom: 1px solid #ccc;border-top:1px solid #fff;"></td>
						</tr>
					</tbody>
				</table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        
      </div>
   </div>
</div>
    <script>
   
		$("#printButton").click(function(){
			$("div.panel-body").printMe({
				"path" : ["<?php echo  base_url().'assets/css/example.css';?>"],
			});
		});

    </script>
	<script>
	$('form').attr('autocomplete', 'off');
	</script>