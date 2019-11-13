
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<style>
.table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    border: 1px solid #DDD;
}

</style>

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12" data-offset="0">
                <div class="wrap-fpanel">
                    <div class="box box-primary" data-collapsed="0">
                        <div class="box-header with-border bg-primary-dark">
                            <h3 class="box-title"><?= lang('make_payment') ?></h3>
                        </div>
                        <div class="panel-body">
                                <?php echo form_open('admin/payroll/Official_setEmployeePayment', array('class' => 'form-horizontal')) ?>
                                <div class="panel_controls">
                                    <div class="form-group">
                                        <label for="field-1" class="col-sm-3 control-label"><?= lang('department') ?> <span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select class="form-control select2" name="department_id" id="department" onchange="get_employees(this.value)">
                                                <option value="" ><?= lang('select_department') ?>...</option>
                                                <?php foreach ($department as $v_department) : ?>
                                                    <option value="<?php echo $v_department->id ?>" >
                                                        <?php echo $v_department->department ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="field-1" class="col-sm-3 control-label"><?= lang('employee') ?> <span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select class="form-control select2" name="employee_id" id="employee" >
                                                <option value=""><?= lang('please_select') ?></option>
                                                <?php foreach($employee as $item){ ?>
                                                    <option value="<?php echo $item->id ?>" >
                                                        <?php echo  $item->first_name.' '.$item->last_name ?>
                                                    </option>
                                                <?php } ?>
                                         <option value="ALL">ALL</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group margin">
                                        <label class="col-sm-3 control-label"><?= lang('month') ?> <span class="required">*</span></label>

                                        <div class="col-sm-5">
                                            <div class="input-group">
                                                <input type="text" name="month" id="month" class="form-control monthyear" value="<?php
                                                if (!empty($date)) {
                                                    echo date('Y-n', strtotime($date));
                                                }
                                                ?>" >
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-5">
                                            <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('go') ?></button>
                                        </div>
                                    </div>
                                </div>
                           <?php echo form_close() ?>
 <?php if(!empty($monthsalary)){      ?>
 <?php echo form_open('admin/payroll/saveOfficialsalary', array('class' => 'form-horizontal')) ?>
							<h5 style="color:red;text-align:center;">Month Salary</h5>
                            <table id="datatable" class="table table-bordered datatable-buttons">
                                <thead ><!-- Table head -->
                                <tr>
                                    <th><?= lang('salarymont') ?></th>
                                    <th><?= lang('employee_name') ?></th>
									<th><?= lang('employeeid') ?></th>
									<th><?= lang('department') ?></th>
                                    <th><?= lang('lop') ?></th>
									  <th><?= lang('OverTime') ?></th>
									<th><?= lang('latemin') ?></th>
									<th><?= lang('grosssalary') ?></th>
                                    <th><?= lang('deduction') ?></th>
									<th><?= lang('latefineamount') ?></th>
									<th><?= lang('netsalary') ?></th>
                                    <th><?= lang('lateamount') ?></th>
									<th><?= lang('pendeduction') ?></th>
									<th><?= lang('bonus') ?></th>
							<!--	<th><?= lang('taxslab') ?></th>
								//	<th><?= lang('Tax_per') ?></th>-->
									<th><?= lang('annualtax') ?></th>
									<th><?= lang('monthlytax') ?></th>
									<th><?= lang('paymentamount') ?></th>
                                
                                    
                                </tr>
                                </thead><!-- / Table head -->
                                <tbody><!-- / Table body -->
                               <?php foreach ($monthsalary as $item) : ?>
                               
                                 
									<tr class="custom-tr">
						<td class="vertical-td"><?php  echo date('F Y',strtotime($item['salarymont']));  ?><input type="hidden" value="<?php  echo $item['salarymont'];  ?>" name="salarymonth[]"></td>
						<td class="vertical-td"><?php echo $item['employeename'] ?><input type="hidden" value="<?php echo $item['employeename'] ?>" name="employeename[]"></td>
						<td class="vertical-td"><?php echo $item['employeeid'] ?><input type="hidden" value="<?php echo $item['employeeid'] ?>" name="employeeid[]"></td>
					    <td class="vertical-td"><?php echo $item['department'] ?><input type="hidden" value="<?php echo $item['department'] ?>" name="department[]"></td>
					 	<td class="vertical-td"><?php echo $item['lop'] ?><input type="hidden" value="<?php echo $item['lop'] ?>" name="lop[]"></td>
						<td class="vertical-td"><?php echo $item['OverTime'] ?><input type="hidden" value="<?php echo $item['OverTime'] ?>" name="OverTime[]"></td>
						<td class="vertical-td"><?php echo $item['latemin'] ?><input type="hidden" value="<?php echo $item['latemin'] ?>" name="latemin[]"></td>   
						<td class="vertical-td"><?php echo $item['grosssalary'] ?><input type="hidden" value="<?php echo $item['grosssalary'] ?>" name="grosssalary[]"></td>
						<td class="vertical-td"><?php echo $item['deduction'] ?><input type="hidden" value="<?php echo $item['deduction'] ?>" name="deduction[]"></td>
						<td class="vertical-td"><?php echo $item['latefineamount'] ?><input type="hidden" value="<?php echo $item['latefineamount'] ?>" name="latefineamount[]"></td>
						<td class="vertical-td"><?php echo $item['netsalary'] ?><input type="hidden" value="<?php echo $item['netsalary'] ?>" name="netsalary[]"></td>      <td class="vertical-td"><?php echo $item['lateamount'] ?><input type="hidden" value="<?php echo $item['lateamount'] ?>" name="lateamount[]"></td>
						<td class="vertical-td"><?php echo $item['pendeduction'] ?><input type="hidden" value="<?php echo $item['pendeduction'] ?>" name="pendeduction[]"></td>
						<td class="vertical-td"><?php echo $item['bonus'] ?><input type="hidden" value="<?php echo $item['bonus'] ?>" name="bonus[]"></td>
						<!--<td class="vertical-td"><?php echo $item['taxslab'] ?></td>
						<td class="vertical-td"><?php echo $item['Taxper'] ?></td>-->
						<td class="vertical-td"><?php echo $item['annualtax'] ?><input type="hidden" value="<?php echo $item['annualtax'] ?>" name="annualtax[]"></td>
						<td class="vertical-td"><?php echo $item['monthlytax'] ?><input type="hidden" value="<?php echo $item['monthlytax'] ?>" name="monthtax[]"></td>
						<td class="vertical-td"><?php echo $item['paymentamount'] ?><input type="hidden" value="<?php echo $item['paymentamount'] ?>" name="payamount[]"><input type="hidden" value="<?php echo $item['year_salary'] ?>" name="year_salary[]"></td>
					  
					</tr>
                                  
									 <?php endforeach;  ?><!--get all sub category if not this empty-->
                                </tbody><!-- / Table body -->
                            </table> <!-- / Table -->
							                      </table> <!-- / Table -->
 <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-5">
                                            <button type="submit" id="sbtn" name="sbtn" value="1" class="btn bg-olive btn-md btn-flat"><?= lang('save') ?></button>
                                        </div>
                                    </div>
<?php echo form_close() ?>
                        <?php } ?>
						   
						   <!-----------------                     ------------------->
						    <?php if(!empty($salaryconfigcheck)){      ?>
							<h5 style="color:red;text-align:center;">Salary Conflict</h5>
                            <table id="datatable" class="table table-bordered datatable-buttons">
                                <thead ><!-- Table head -->
                                <tr>
                                   
                                    <th><?= lang('employee_name') ?></th>
									<th><?= lang('status') ?></th>
									
                                </tr>
                                </thead><!-- / Table head -->
                                <tbody><!-- / Table body -->
                               <?php foreach ($salaryconfigcheck as $item) : ?>
                               
                                 
									<tr class="custom-tr">
                                     
                                        <td class="vertical-td"><?php echo $item['employeename'] ?></td>
										<td class="vertical-td"><?php echo $item['status'] ?></td>
										
                                      
                                    </tr>
                                  
									 <?php endforeach;  ?><!--get all sub category if not this empty-->
                                </tbody><!-- / Table body -->
                            </table> <!-- / Table -->

                        <?php } ?>
						   
						   
						   
						   
						   
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
 <script>

	$('#month').on('changeDate',function(){
     $(this).datepicker('hide');
	});
       
    </script>
	<script>
	$('form').attr('autocomplete', 'off');
	</script>
	