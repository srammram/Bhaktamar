<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!-- general form elements -->


<form id="SalaryForm" action="<?php echo site_url('admin/payroll/employee/save_salary')?>" method="post"  >
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="token">
<div class="box box-primary">
    <div class="box-header with-border bg-primary-dark">
        <h3 class="box-title"><?= lang('employee_salary_details') ?></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-8">
            <!--    <div class="form-group">
                    <label><?= lang('pay_grade') ?><span class="required">*</span></label>
                    <select class="form-control" name="grade_id" onchange="get_salaryRange(this.value)" id="salaryGrade" >
                        <option value="" ><?= lang('please_select') ?></option>
                        <?php foreach($gradeList as $item):?>
                            <option value="<?php echo $item->id ?>" <?php if(!empty($empSalary->grade_id)) echo $item->id == $empSalary->grade_id ?'selected':'' ?> >
                                <?php echo $item->grade_name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span id="resultSalaryRange"></span>
                    <input type="hidden" id="min_salary">
                    <input type="hidden" id="max_salary">
                </div>-->

                <div class="form-group">
                    <label><?= lang('comment') ?></label>
                    <textarea class="form-control" name="comment"><?php if(!empty($empSalary->comment)) echo $empSalary->comment ?></textarea>
                </div>
            </div>
        </div>
        <!--All Earning-------------------------------------------------------------------------------------------->
        <br/>
        <br/>
		<div class="col-md-12">
       <h4><?= lang('salary_all_earnings') ?></h4><div class="col-md-4"></div><div class="col-md-4"><h6 style="margin-bottom:8px;"><?= lang('Current_salary') ?></h6></div><div class="col-md-4"><h6 style="margin-bottom:8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= lang('Official_salary') ?></h6></div>
		</div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <?php if(count($salaryEarningList)): foreach($salaryEarningList as $earning):?>
                        <?php
                            $salary = '';
                            if(!empty($empSalaryDetails)) {
                                foreach ($empSalaryDetails as $key => $details) {
                                    if ($earning->id == $key) {
                                        $salary = $details;
                                    }
                                }
                            }
							 $salarys = '';
                            if(!empty($empSalaryDetailss)) {
                                foreach ($empSalaryDetailss as $key => $detailss) {
                                    if ($earning->id.'s' == $key) {
                                        $salarys = $detailss;
										
                                    }
                                }
                            }
                        ?>
                    <div class="row">
                        <div class="col-sm-4"><?php echo $earning->component_name ?><strong>(<?php echo $earning->value_type ==1 ? lang('amount'): lang('percentage') ?>)</strong></div>
					
						 <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="<?php echo $earning->id ?>s" class="form-control currentsalary earning" id="<?php echo 'currentearns'.$earning->id ?>"
                                       value="<?php if(!empty($salarys)){ echo $salarys ;}?>" >
                                <span class="required" id="errorSalaryRange"></span>
                            </div>
                            <input type="hidden" value="<?php echo $earning->type?>" id="<?php echo 'types'.$earning->id?>">
                            <input type="hidden" value="<?php echo $earning->total_payable?>" id="<?php echo 'pays'.$earning->id ?>">
                            <input type="hidden" value="<?php echo $earning->cost_company?>" id="<?php echo 'costs'.$earning->id ?>">
                            <input type="hidden" value="<?php echo $earning->flag?>" id="<?php echo 'flags'.$earning->id ?>">
                            <input type="hidden" value="<?php echo $earning->value_type?>" id="<?php echo 'valueTypes'.$earning->id ?>">
                            <input type="hidden" name="earns[]" value="<?php echo $earning->id ?>s">
                        </div>
						
                        <div class="col-sm-4"> 
                            <div class="form-group">
                                <input type="text" name="<?php echo $earning->id ?>" class="form-control key docal earning" id="<?php echo 'earn'.$earning->id ?>" value="<?php if(!empty($salary)){ echo $salary ;}?>" >
                                <span class="required" id="errorSalaryRange"></span>
                            </div>
                            <input type="hidden" value="<?php echo $earning->type?>" id="<?php echo 'type'.$earning->id ?>">
                            <input type="hidden" value="<?php echo $earning->total_payable?>" id="<?php echo 'pay'.$earning->id ?>">
                            <input type="hidden" value="<?php echo $earning->cost_company?>" id="<?php echo 'cost'.$earning->id ?>">
                            <input type="hidden" value="<?php echo $earning->flag?>" id="<?php echo 'flag'.$earning->id ?>">
                            <input type="hidden" value="<?php echo $earning->value_type?>" id="<?php echo 'valueType'.$earning->id ?>">
                            <input type="hidden" name="earn[]" value="<?php echo $earning->id ?>">

                        </div>
                    </div>
                <?php endforeach; endif ?>
            </div>
        </div>
        <!--All Deduction-------------------------------------------------------------------------------------------->
        <br/>
        <br/>
        <h4 style="margin-left:12px;"><?= lang('salary_all_deductions') ?></h4>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <?php if(count($salaryDeductionList)): foreach($salaryDeductionList as $deduction):?>
                    <?php
                    $salary = '';
                    if(!empty($empSalaryDetails)) {
                        foreach ($empSalaryDetails as $key => $details) {
                            if ($deduction->id == $key) {
                                $salary = $details;
                            }
                        }
                    }
					$salarys = '';
                    if(!empty($empSalaryDetailss)) {
                        foreach ($empSalaryDetailss as $key => $detailss) {
                            if ($deduction->id.'s' == $key) {
                                $salarys = $detailss;
                            }
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-4"><?php echo $deduction->component_name?> <strong>(<?php echo $deduction->value_type ==1 ? lang('amount'): lang('percentage') ?>)</strong></div>
                      
						 <div class="col-sm-4">
                            <div class="form-group" >

                                    <input type="text"  name="<?php echo $deduction->id ?>s" class="form-control currentsalary deduction" id="<?php echo 'currentearns'.$deduction->id ?>"
                                           value="<?php if(!empty($salarys)){ echo $salarys ;} ?>">
                            </div>
                            <input type="hidden" value="<?php echo $deduction->type?>" id="<?php echo 'types'.$deduction->id ?>">
                            <input type="hidden" value="<?php echo $deduction->total_payable?>" id="<?php echo 'pays'.$deduction->id ?>">
                            <input type="hidden" value="<?php echo $deduction->cost_company?>" id="<?php echo 'costs'.$deduction->id ?>">
                            <input type="hidden" value="<?php echo $deduction->flag?>" id="<?php echo 'flags'.$deduction->id ?>">
                            <input type="hidden" value="<?php echo $deduction->value_type?>" id="<?php echo 'valueTypes'.$deduction->id ?>">
                            <input type="hidden" name="deductions[]" value="<?php echo $deduction->id ?>s">

                        </div>
						  <div class="col-sm-4">
                            <div class="form-group" >

                                    <input type="text"  name="<?php echo $deduction->id ?>" class="form-control key docal deduction" id="<?php echo 'earn'.$deduction->id ?>"
                                           value="<?php if(!empty($salary)){ echo $salary ;} ?>">

                            </div>

                            <input type="hidden" value="<?php echo $deduction->type?>" id="<?php echo 'type'.$deduction->id ?>">
                            <input type="hidden" value="<?php echo $deduction->total_payable?>" id="<?php echo 'pay'.$deduction->id ?>">
                            <input type="hidden" value="<?php echo $deduction->cost_company?>" id="<?php echo 'cost'.$deduction->id ?>">
                            <input type="hidden" value="<?php echo $deduction->flag?>" id="<?php echo 'flag'.$deduction->id ?>">
                            <input type="hidden" value="<?php echo $deduction->value_type?>" id="<?php echo 'valueType'.$deduction->id ?>">
							 <input type="hidden" value="<?php echo $deduction->Of_what_id?>" id="<?php echo 'Of_what'.$deduction->id ?>">
							  <input type="hidden" value="<?php echo $deduction->Of_what_value_type?>" id="<?php echo 'Of_what_value_type'.$deduction->id ?>">
                            <input type="hidden" name="deduction[]" value="<?php echo $deduction->id ?>">
                        </div>
                    </div>
                <?php endforeach; endif ?>

            </div>
        </div>
        <!--All Earning-------------------------------------------------------------------------------------------->
        <br/>
        <br/>
        <h4 style="margin-left:12px;"><?= lang('salary_summary') ?></h4>
        <hr/>
        <div class="well well-sm">
            <div class="row">
                <div class="col-md-12">

                    <div class="row" style="padding-bottom: 15px">
                        <div class="col-sm-4"><?= lang('total_deductions') ?> :</div>
                    
						
						<div class="col-sm-4" id="resultTotalDeductions"><strong>
						<?php if(!empty($empSalarys->Current_total_deduction)){ echo get_option('default_currency').' '.$empSalarys->Current_total_deduction ; }else{ echo get_option('default_currency').' '.'00' ;} ?></strong></div>
						    <div class="col-sm-4" id="resultTotalDeduction"><strong>
						<?php if(!empty($empSalary->total_deduction)){ echo get_option('default_currency').' '.$empSalary->total_deduction ; }else{ echo get_option('default_currency').' '.'00' ;} ?></strong></div>
						
						<input type="hidden" name="total_deductions" id="totalDeductions" value="<?php if(!empty($empSalarys->Current_total_deduction)){ echo $empSalarys->Current_total_deduction ; }else{ echo '0' ;} ?>">
						
                        <input type="hidden" name="total_deduction" id="totalDeduction" value="<?php if(!empty($empSalary->total_deduction)){ echo $empSalary->total_deduction ; }else{ echo '0' ;} ?>">
                    </div>
                    <div class="row" style="padding-bottom: 15px">
                        <div class="col-sm-4"><?= lang('total_payable') ?> :</div>
                      
						<div class="col-sm-4" id="resultTotalPayables"><strong>
						
						<?php if(!empty($empSalarys->Current_total_payable)){ echo get_option('default_currency').' '.$empSalarys->Current_total_payable ; }else{ echo get_option('default_currency').' '.'00' ;} ?></strong></div>
						  <div class="col-sm-4" id="resultTotalPayable"><strong>
						<?php if(!empty($empSalary->total_payable)){ echo get_option('default_currency').' '.$empSalary->total_payable ; }else{ echo get_option('default_currency').' '.'00' ;} ?></strong></div>
						
                 
						
						<input type="hidden" name="total_payables" id="totalPayables" value="<?php if(!empty($empSalarys->Current_total_payable)){ echo $empSalarys->Current_total_payable ; }else{ echo '0' ;} ?>">
						       <input type="hidden" name="total_payable" id="totalPayable" value="<?php if(!empty($empSalary->total_payable)){ echo $empSalary->total_payable ; }else{ echo '0' ;} ?>">
                    </div>

                    <div class="row" style="padding-bottom: 15px">
                        <div class="col-sm-4"><?= lang('cost_to_the_company') ?> :</div>
                     
						 <div class="col-sm-4" id="resultCostToCompanys"><strong>
						 <?php if(!empty($empSalarys->Current_total_cost_company)){ echo get_option('default_currency').' '. $empSalarys->Current_total_cost_company ; }else{ echo get_option('default_currency').' '.'00' ;} ?></strong></div>
						    <div class="col-sm-4" id="resultCostToCompany"><strong>
						<?php if(!empty($empSalary->total_cost_company)){ echo get_option('default_currency').' '. $empSalary->total_cost_company ; }else{ echo get_option('default_currency').' '.'00' ;} ?></strong></div>
						 
						 <input type="hidden" name="total_cost_companys" id="totalCostCompanys" value="<?php if(!empty($empSalarys->Current_total_cost_company)){ echo $empSalarys->total_cost_company ; }else{ echo '0' ;} ?>">
						 
                        <input type="hidden" name="total_cost_company" id="totalCostCompany" value="<?php if(!empty($empSalary->total_cost_company)){ echo $empSalary->total_cost_company ; }else{ echo '0' ;} ?>">
                    </div>
					</div>
            </div>
        </div>
     
      
		   <input type="hidden" id="field" value="0">
        <input type="hidden" id="tempDeduction">
        <input type="hidden" id="tempPayable">
        <input type="hidden" id="tempCostCompany">

		<br/>
        <br/>
        <span class="required">*</span> <?= lang('required_field') ?>
        <input type="hidden" name="id" value="<?php echo $employee->id ?>" >
        <input type="hidden" name="salary_id" value="<?php if(!empty($empSalary->id))echo $empSalary->id ?>" >

    </div>
    <!-- /.box-body -->
 <div class="box-footer">
     <div class="box-footer">
        <a class="btn bg-navy btn-flat btn-md" id="editPersonal" ><i class="fa fa-pencil-square-o"></i> Edit</a>
        <button id="savePersonal" type="submit" class="btn bg-olive btn-flat" style="display: none;">Save</button>&nbsp;&nbsp;&nbsp;
        <a  class="btn bg-maroon btn-flat" id="cancelPersonal" style="display: none;" >Cancel</a>
    </div>
</div>
</div>
<!-- /.box -->

</form>
<script>
    $(document).ready(function() {
       function  calculate(valueType, salary, basicSalary ){
            if(valueType == 2 && salary != 0) {// deduction %
		
                var tmp  = salary / 100;
				//	console.log(resultDeductionAmount = tmp * basicSalary);
                return resultDeductionAmount = tmp * basicSalary;
			
				}else if(salary != 0){
				//	console.log(salary);
                return resultDeductionAmount = salary;
				
            }else{
			//	console.log(3);
                return resultDeductionAmount = 0;
			
            }
        }
        //key press
           $(".key").change(function() {
			    var allID = [];

            $('div input[name][id][value]').each(function(){
                allID.push($(this).attr('id'));
            });
               //console.log(allID);
            var totalPayable = 0 ;
            var totalCostCompany = 0;
            var totalPayableDeduction = 0;
            var totalCompanyDeduction = 0;
            var resultDeduction = 0;
            arrayLength = allID.length;
                for (var i = 0; i < arrayLength; i++) {
                 var fieldId = allID[i].slice(4);
                 var type = $( "#type"+fieldId ).val();
                 var payable = $( "#pay"+fieldId ).val();
                 var company = $( "#cost"+fieldId ).val();
                 var flag = $( "#flag"+fieldId ).val();
                 var valueType = $( "#valueType"+fieldId ).val();// amount or percentage
			//	 var Of_what_id = $( "#Of_what"+fieldId ).val();
			//	 var of_what_value_type = $( "#Of_what_value_type"+fieldId ).val();
                 var salary = ($.trim($("#earn" + fieldId).val()) != "" && !isNaN($("#earn" + fieldId).val())) ? parseInt($("#earn" + fieldId).val()) : 0;
                 var basicSalary = ($.trim($("#earn1").val()) != "" && !isNaN($("#earn1").val())) ? parseInt($("#earn1").val()) : 0;
                if(flag==1)//get Salary Range
                {
                    $('#errorSalaryRange').empty();
                    var min_salary = parseInt($.trim($( "#min_salary" ).val()));
                    var max_salary = parseInt($.trim($( "#max_salary" ).val()));
                    if(salary < min_salary || salary > max_salary  ){
						$("#errorSalaryRange").append('Salary Range: ' + min_salary + ' - ' + max_salary);
                    }

                }
                if(type == 1){//salary
                    //total payable
                    if(payable == 1){
                        totalPayable  += calculate(valueType, salary, basicSalary );
                    }
                    //Cost to company
                    if(company == 1){
                        totalCostCompany += calculate(valueType, salary, basicSalary );
						//console.log(valueType);
					//	console.log(salary);
						console.log(basicSalary);
                    }
                }else{ //Deduction

                    if(payable == 1 && company == 1 ){
                        var resultDeductionAmount = calculate(valueType, salary, basicSalary );
                        resultDeduction +=resultDeductionAmount ;
						
                    }else if(payable == 1){
                        var resultDeductionAmount = calculate(valueType, salary, basicSalary );
                        resultDeduction +=resultDeductionAmount ;
					
                    }else{
                        var resultDeductionAmount = calculate(valueType, salary, basicSalary );
                        resultDeduction +=resultDeductionAmount ;
						
                    }

                    if(payable == 1){//payable
                        var resultDeductionAmount = calculate(valueType, salary, basicSalary );
                        totalPayableDeduction +=resultDeductionAmount ;
					
                    }

                    if(company == 1){//cost to company
                        var resultDeductionAmount = calculate(valueType, salary, basicSalary );
                        totalCompanyDeduction +=resultDeductionAmount ;
						
                    }
                }
            }

            var myCurrency =  '<?php echo get_option('default_currency')?>';
            // salary payable
            var resultSalaryPayable = totalPayable - totalPayableDeduction
            $('#resultTotalPayable').empty();
            $("#resultTotalPayable").append('<strong>'+ myCurrency +' '+ resultSalaryPayable  +'</strong>');
            $('#totalPayable').val(resultSalaryPayable);

            //salary cost to company
            var resultSalaryCostToCompany = totalCostCompany + totalCompanyDeduction;
			//console.log(resultSalaryCostToCompany);
            $('#resultCostToCompany').empty();
            $("#resultCostToCompany").append('<strong>'+ myCurrency +' '+ resultSalaryCostToCompany  +'</strong>');
            $('#totalCostCompany').val(resultSalaryCostToCompany);

            $('#resultTotalDeduction').empty();
            $("#resultTotalDeduction").append('<strong>'+ myCurrency +' '+ resultDeduction  +'</strong>');
            $('#totalDeduction').val(resultDeduction);

        });
    });
  /*  $(document).ready(function() {
        var str = $("#salaryGrade").val();
        $('#resultSalaryRange').empty();
        var link = getBaseURL();
        $.ajax({
            type: "POST",
            url: link + 'admin/employee/get_salaryRange_by_id',
            data: { grade_id : str },
            cache: false,
            success: function(result){
                var result = $.parseJSON(result)
                $("#resultSalaryRange").append('Min: ' +result[0] + ' Max: ' + result[1]);
                $('#min_salary').val(result[0]);
                $('#max_salary').val(result[1]);
            }
        });
    });*/
    function get_Cookie(name) {
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        $('#token').val(cookieValue);
    }
</script>
<script>
 $(document).ready(function() {
     function  calculates(valueType, salary, basicSalary ){
            if(valueType == 2 && salary != 0) {// deduction %
		
                var tmp  = salary / 100;
				//	console.log(resultDeductionAmount = tmp * basicSalary);
                return resultDeductionAmount = tmp * basicSalary;
			
				}else if(salary != 0){
				//	console.log(salary);
                return resultDeductionAmount = salary;
				
            }else{
				//console.log(3);
                return resultDeductionAmount = 0;
			
            }
        }
		   $(".currentsalary").change(function() {
			var allID = [];
			$('div input[name][id][value]').each(function(){
                allID.push($(this).attr('id'));
            });
            var totalPayable = 0 ;
            var totalCostCompany = 0;
            var totalPayableDeduction = 0;
            var totalCompanyDeduction = 0;
            var resultDeduction = 0;
            arrayLength = allID.length;
            for (var i = 0; i < arrayLength; i++) {
                var fieldId = allID[i].slice(4);
			//	console.log(fieldId);
                var type = $( "#types"+fieldId ).val();
                var payable = $( "#pays"+fieldId ).val();
                var company = $( "#costs"+fieldId ).val();
                var flag = $( "#flags"+fieldId ).val();
                var valueType = $( "#valueTypes"+fieldId ).val();// amount or percentage
                var salary = ($.trim($("#currentearns" + fieldId).val()) != "" && !isNaN($("#currentearns" + fieldId).val())) ? parseInt($("#currentearns" + fieldId).val()) : 0;
                   var basicSalary = ($.trim($("#currentearns1").val()) != "" && !isNaN($("#currentearns1").val())) ? parseInt($("#currentearns1").val()) : 0;
                if(flag==1)//get Salary Range
                {
                    $('#errorSalaryRange').empty();
                    var min_salary = parseInt($.trim($( "#min_salary" ).val()));
                    var max_salary = parseInt($.trim($( "#max_salary" ).val()));
                    if(salary < min_salary || salary > max_salary  ){

                        $("#errorSalaryRange").append('Salary Range: ' + min_salary + ' - ' + max_salary);
                    }

                }
                if(type == 1){//salary
                    //total payable
                      if(payable == 1){
                        totalPayable  += calculates(valueType, salary, basicSalary );
                      }
                    //Cost to company
                    if(company == 1){
                        totalCostCompany += calculates(valueType, salary, basicSalary );
					//console.log(totalCostCompany);
					  //console.log(valueType);
						//console.log(salary);
						console.log(basicSalary);
                    }
                }else{ //Deduction

                    if(payable == 1 && company == 1 ){
                        var resultDeductionAmount = calculates(valueType, salary, basicSalary );
                        resultDeduction +=resultDeductionAmount ;
						
                    }else if(payable == 1){
                        var resultDeductionAmount = calculates(valueType, salary, basicSalary );
                        resultDeduction +=resultDeductionAmount ;
							
                    }else{
                        var resultDeductionAmount = calculates(valueType, salary, basicSalary );
                        resultDeduction +=resultDeductionAmount ;
							
                    }

                    if(payable == 1){//payable
                        var resultDeductionAmount = calculates(valueType, salary, basicSalary );
                        totalPayableDeduction +=resultDeductionAmount ;
                    }

                    if(company == 1){//cost to company
                        var resultDeductionAmount = calculates(valueType, salary, basicSalary );
                        totalCompanyDeduction +=resultDeductionAmount ;
                    }
                }
            }
            var myCurrency =  '<?php echo get_option('default_currency')?>';
            // salary payable
            var resultSalaryPayable = totalPayable - totalPayableDeduction
            $('#resultTotalPayables').empty();
            $("#resultTotalPayables").append('<strong>'+ myCurrency +' '+ resultSalaryPayable  +'</strong>');
            $('#totalPayables').val(resultSalaryPayable);
            //salary cost to company
            var resultSalaryCostToCompany = totalCostCompany + totalCompanyDeduction;
				//console.log(resultSalaryCostToCompany);
            $('#resultCostToCompanys').empty();
            $("#resultCostToCompanys").append('<strong>'+ myCurrency +' '+ resultSalaryCostToCompany  +'</strong>');
            $('#totalCostCompanys').val(resultSalaryCostToCompany);
            $('#resultTotalDeductions').empty();
            $("#resultTotalDeductions").append('<strong>'+ myCurrency +' '+ resultDeduction  +'</strong>');
            $('#totalDeductions').val(resultDeduction);
        });
    });

</script>


<script>
    var personalForm = $("#SalaryForm");
    $("#SalaryForm :input").attr("disabled", true);
    $('#editPersonal').click(function(event) {
        //event.preventDefault();
        personalForm.find(':disabled').each(function() {
            $(this).removeAttr('disabled');
            $('#cancelPersonal').show();
            $('#savePersonal').show();
            $('#editPersonal').hide();
        });
    });

    $('#cancelPersonal').click(function(event) {
        //event.preventDefault();
        personalForm.find(':enabled').each(function() {
            $(this).attr("disabled", "disabled");
            $('#cancelPersonal').hide();
            $('#savePersonal').hide();
            $('#editPersonal').show();
        });
    });
</script>

<script>
	$('form').attr('autocomplete', 'off');
	</script>