<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<style>
.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 24px;
}

th {
    background-color: #fff;
}
</style>
<script src="<?php echo base_url();  ?>assets/assets/js/jquery-printme.js"></script>
<script src="<?php echo base_url();  ?>assets/assets/js/jquery-printme.min.js"></script>

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12" data-offset="0">
                <div class="wrap-fpanel">
                    <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h3 class="box-title"><?= lang('employee_payroll_list') ?></h3>
                            <div class="box-tools" style="padding-top: 5px">
                                <div class="input-group input-group-sm">
                                    <a class="btn" style="color: #FFF" id="printButton">
                                        <i class="fa fa-print fa-2x" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="employee_salary_slip">
                                <div class="row">
                                    <?php $company_logo = get_option('company_logo') ?>
                                    <!--  <img height="180" width="180" src="<?php echo site_url(UPLOAD_LOGO.$company_logo)?>" class="img img-responsive center" >-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <h2 class="text-center Languagess"><?= lang('salary_payslip') ?></h2>
                                        <div class="clearfix"></div>
                                        <table class="table ">
                                            <colgroup>
                                                <col width="20%">
                                                <col width="50%">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th style="background-color:#fff;color:black;">
                                                        <?= lang('Language') ?></th>
                                                    <th style="background-color:#fff;color:black;">
                                                        <select class="form-control languagess">
                                                            <option value="1"><?= lang('English') ?></option>
                                                            <option value="2"><?= lang('Thai') ?></option>
                                                        </select>
                                                        <!--<div class="checkbox disabled">
                                        <label><input type="checkbox" value="1" ><?= lang('English') ?></label> <label><input type="checkbox" value="2" ><?= lang('Thai') ?></label>-->
                                    </div>
                                    </th>
                                    </tr>

                                    <tr>
                                        <th style="background-color:#fff;color:black;"><?= lang('employee') ?></th>
                                        <th style="background-color:#fff;color:black;">
                                            <?php echo $employee->first_name.' '.$employee->last_name ?></th>
                                    </tr>
                                    <tr>
                                        <th style="background-color:#fff;color:black;"><?= lang('department') ?></th>
                                        <th style="background-color:#fff;color:black;">
                                            <?php echo $employee->department ?></th>
                                    </tr>
                                    <tr>
                                        <th style="background-color:#fff;color:black;"><?= lang('salary_month') ?> </th>
                                        <th style="background-color:#fff;color:black;">
                                            <?php echo date("F, Y", strtotime($pay_slip->month));  ?></th>
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
                                                <th><?= lang('Earnings') ?></th>
                                                <th></th>
                                                </thead>
                                        <tbody>
                                            <?php
										foreach($salaryEarningList as $earning){ ?>
                                            <?php
								    	$salary = '';
									   if(!empty($empSalaryDetails)) {
									   foreach ($empSalaryDetails as $key => $details) {
									   if ($earning->id.'s' == $key) {
													 	$salary = $details;
														$data['total_earning'][]=$details;
											?>
                                            <tr>
                                                <td><?php echo $earning->component_name?></td>
                                                <td><?php if(!empty($salary)){ echo $Currency_code.'&nbsp'. round(($salary*$Currency->Exchange_rate),$round_off) ;} ?>
                                                </td>
                                            </tr>
                                            <?php  
																						}
																						}
																						}
																						}
																							?>
                                            <tr>
                                            <tr>
                                                <td><?= lang('Bonus') ?></td>
                                                <td>
                                                    <?php echo $Currency_code.'&nbsp'. round(($pay_slip->bonus),$round_off); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= lang('OverTime') ?></td>
                                                <td>
                                                    <?php echo $Currency_code.'&nbsp'. round(($pay_slip->OverTimeAmount),$round_off); ?>
                                                </td>

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
                                    <th><?= lang('Deductions') ?></th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($salaryDeductionList as $deduction){ ?>
                                        <?php
                     $salary = '';
                      if(!empty($empSalaryDetails)) {
                            foreach ($empSalaryDetails as $key => $details) {
                               if ($deduction->id.'s' == $key) {
                                                 $salary = $details;
                                                   $data['total_Deduction'][]=$details;
                                                ?>
                                        <tr>
                                            <td><?php echo $deduction->component_name?></td>
                                            <td><?php if(!empty($salary)){ echo $Currency_code.'&nbsp'.round(($salary*$Currency->Exchange_rate),$round_off) ;} ?>
                                            </td>
                                        </tr>
                                        <?php  }  } }
							                        }
                                                 ?>
                                        <tr>
                                            <td><?= lang('Late_Fine') ?></td>
                                            <td>
                                                <?php echo $Currency_code.'&nbsp'. round(($pay_slip->Late_amount),$round_off) ; ?>
                                            </td>
                                        <tr>
                                        <tr>
                                            <td><?= lang('Tax') ?></td>
                                            <td>
                                                <?php echo $Currency_code.'&nbsp'.round(($pay_slip->Monthly_tax),$round_off) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang('LOP') ?></td>
                                            <td>
                                                <?php echo $Currency_code.'&nbsp'. round(((($pay_slip->net_salary/$TotalWorkingday)*$pay_slip->Lop)*$Currency->Exchange_rate),$round_off); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang('Penalty') ?></td>
                                            <td>
                                                <?php echo $Currency_code.'&nbsp'. round(($pay_slip->Penalty),$round_off); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= lang('Advance') ?></td>
                                            <td>
                                                <?php echo $Currency_code.'&nbsp'. round(($pay_slip->Advance_Amount),$round_off); ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                    </table>
                                    </td>
                                    </tr>
                                    </tbody>
                                    </table>
                                    <style>
                                    .net_salary_tab_s tbody tr td {
                                        border: none;
                                    }

                                    .net_salary_tab tbody tr .br_cl {
                                        border: none !important;
                                    }

                                    .net_salary_tab {
                                        border: none !important;
                                    }

                                    @media print {
                                        .net_salary_tab_s tbody tr td {
                                            border: none !important;
                                        }

                                        .bottom_table_salary tbody tr td {
                                            border: none !important;
                                        }

                                        .net_salary_tab tbody tr .br_cl {
                                            border: none !important;
                                        }

                                        .net_salary_tab {
                                            border: none !important;
                                        }

                                        .language {
                                            border: none;
                                        }

                                        selectdiv:after {
                                            border: none;
                                        }

                                        .go_back_se a {
                                            display: none;
                                        }
                                    }
                                    </style>



                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered" style="table-layout: fixed;">
                                                <tbody>
                                                    <tr>

                                                        <td><?= lang('Total_Addition') ?></td>
                                                        <td><?php  if(isset($data['total_earning'])){echo $Currency_code.'&nbsp'. round(((array_sum($data['total_earning']))*$Currency->Exchange_rate +$pay_slip->bonus+$pay_slip->OverTimeAmount),$round_off); }else{  echo 0; } ?>
                                                        </td>
                                                        <td rowspan="3">
                                                            Note:<?php   if(isset($pay_slip->note)){ echo $pay_slip->note; }  ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= lang('Total_Deductions') ?></td>
                                                        <td><?php   
                                                   if(isset($data['total_Deduction'])){
													  $total_dec= array_sum($data['total_Deduction']);
												   }else{
													   $total_dec=0;
												   }
                                             echo $Currency_code.'&nbsp'. round((($pay_slip->Advance_Amount+$pay_slip->Penalty+$total_dec+ $pay_slip->Late_amount+$pay_slip->Monthly_tax+round((($pay_slip->net_salary/$TotalWorkingday)*$pay_slip->Lop),$round_off))*$Currency->Exchange_rate),$round_off); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Amount Received</td>
                                                        <td><strong><?php echo $Currency_code.'&nbsp'. round($pay_slip->Payment_amount,$round_off) ?></strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <script>
                        $("#printButton").click(function() {
                            $("div.panel-body").printMe({
                                "path": [<?php echo  base_url().'assets/assets/css/example.css';?>],
                            });
                        });
                        $("#printButton1").click(function() {
                            $("div.panel-body").printMe({
                                "path": [<?php echo  base_url().'assets/assets/css/example.css';?>],
                            });
                        });
                        </script>

                        <script>
                        $('form').attr('autocomplete', 'off');
                        </script>
                        <script>
                        $(document).ready(function() {
                            $('input:checkbox').click(function() {
                                $('input:checkbox').not(this).prop('checked', false);
                            });
                        });
                        </script>

                        <script type="text/javascript">
                        $(document).ready(function() {
                            $('.languagess').change(function() {
                                if ($(this).val() == 2) {
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Language', 'ภาษา'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Company Name', 'ชื่อ บริษัท'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Earnings', 'รายได้'));
                                    $('div.panel-body').html($('div.panel-body').html().replace('Bonus',
                                        'โบนัส'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'OverTime', 'ล่วงเวลา'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Total Addition', 'รวมทั้งหมด'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Deductions', 'หัก'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Late Fine', 'สายดี'));
                                    $('div.panel-body').html($('div.panel-body').html().replace('Tax',
                                        'ภาษี'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Penalty', 'การลงโทษ'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Advance', 'ความก้าวหน้า'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Total  Deductions', 'การหักเงินโดยรวม'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'NET_Salary', 'เงินเดือนสุทธิ'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Bonus Remarks', 'ข้อสังเกตโบนัส'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Deductions Remarks', 'หมายเหตุการหักเงิน'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Name of Bank', 'ชื่อธนาคาร'));
                                    $('div.panel-body').html($('div.panel-body').html().replace('Date',
                                        'วันที่'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Signature of the Employee', 'ลายเซ็นของพนักงาน'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Director', 'ผู้อำนวยการ'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Go Back', 'ย้อนกลับ'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Salary Month', 'เดือนเงินเดือน'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Department', 'แผนก'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Employee', 'ลูกจ้าง'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Total_Deductions', 'ចំនួនសរុប'));
                                    $('div.panel-body').html($('div.panel-body').html().replace(
                                        'Amount Received', 'ចំនួនទឹកប្រាក់ដែលបានទទួល'));
                                    $('div.panel-body').html($('div.panel-body').html().replace('Basic',
                                        'មូលដ្ឋាន'));
                                } else {

                                    location.reload();
                                }

                            });
                        });
                        </script>