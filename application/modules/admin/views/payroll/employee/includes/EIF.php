
<head>
<style>
    /*=============*/
    /*table*/

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    ul {
        list-style: none;
    }

    .sidebar-menu > li {
        line-height:20px;
    } 
	
	.table_content ul li { line-height:40px; }
	
    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .frh {
        text-align: center;
    }

    table input[type="text"] {
        width: 100%;
        border: honeydew;
        outline: none;
        background-color: transparent;
    }

    .area {
        overflow: auto;
        resize: vertical;
        width: 100%;
        min-height: 56px;
        border: 0px;
        outline: none;
        border-right: 1px solid #0000001a;
        border-bottom: 1px solid #0000001a;
    }

    h3.note {
        padding-top: 8px !important;
        padding: 15px;
        border-bottom: 1px solid #0000001a;
        border-left: 1px solid #0000001a;
    }

    .text_area .col-sm-10 {
        padding: 0px;
        padding-right: 15px;
    }

    .text_area .col-sm-2 {
        padding: 0px;
        padding-left: 15px;
    }

    .table_two {
        width: 100%;

    }

    .areas {
        margin-bottom: 50px;
    }

    .form_table {
        width: 100%;
        display: inline-block;

    }

    .form_table input {
        width: 100%;
        border: 0px;
        border-bottom: 1px solid #0000001a;
        outline: none;
    }

    .im {
        margin-bottom: 20px;
    }

    .title {
        text-align: center;
        padding: 30px 0px;
    }

    .org {
        font-style: italic;
    }

    input[type=checkbox],
    input[type=radio] {
        zoom: 1.5;
    }
    ul.imp_one input[type="checkbox"] {
        position: relative;
        top: 4px;
        left: -5px;
    }

    ul.imp_two li {
        position: relative;
    }

    ul.imp_two li:before {
        position: absolute;
        content: "*";
        display: block;
        font-size: 35px;
        line-height: 57px;
        left: -28px;
    }

    ul.imp_three li {
        width: 100%;
        text-align: center;
        /* transform: translateX(-19%); */
    }

    ul.imp_three {
        padding: 0px;
    }
    .information {
        display: block;
        width: 100%;
        text-align: center;
        margin-bottom: 50px;
    }
    
    </style>
</head>

<body>

<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!-- general form elements -->


<div class="box box-primary">
    <div class="box-header with-border bg-primary-dark">
        <h3 class="box-title"><?= lang('view/edit_eif') ?></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
	<?php
	/* echo '<pre>';
	print_r($employee_eif); 
	die;  */
	?>
	<?php echo form_open('admin/employee/save_employeeEIF', $attribute= array('id' => 'ContactForm', 'class' => 'ContactForm') ) ?>
	<input type="hidden" name="employee_id" value="<?php echo $employee->id ?>" >
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
         <section id="print-content" >
            <div class="title">
                <h3>EXIT INTERVIEW FORM (EIF)</h3>
            </div>
            <div class="form_table">
                <div class="row im">
                    <div class="col-sm-2"><h5>Employee Name: </h5>
                    </div>
                    <div class="col-sm-4"> <input type="text" name="emp_name" value="<?php echo $employee->first_name ?>"></div>
                    <!-- <div class="col-sm-1"> <h5>Date :     </h5>
                    </div>
                    <div class="col-sm-5"> <input type="date" name="date"></div> -->
                </div>
                <div class="row im">
                    <div class="col-sm-1"><h5>Position:  </h5>
                    </div>
                    <div class="col-sm-10"> <input type="text" name="position" value="<?php if($employee->title == '1'){ echo 'Development'; } ?>"></div>
                </div>
            </div>
            <div class="corporate">
                <b class="org">What are the reasons for leaving? </b><br>
                <p class="undstand">Select one or more : </p>
            </div>
            <div class="table_content">
				<table>
                    <tr>
                        <th>
                            <ul class="imp_one"> 
								<?php if(!empty($leaving_reason_array)) { 
									$leaving_reason_array = explode(',', $employee_eif->leaving_reason);
								} ?>
                                <li><input type="checkbox" name="leaving_reason[]" value="1" <?php if(!empty($leaving_reason_array)) {  if(in_array("1", $leaving_reason_array)) { echo 'checked'; } } ?> >Higher pay </li>
                                <li><input type="checkbox" name="leaving_reason[]" value="2" <?php if(!empty($leaving_reason_array)) {  if(in_array("2", $leaving_reason_array)) { echo 'checked'; } } ?> >Improved work life balance</li>
                                <li><input type="checkbox" name="leaving_reason[]" value="3" <?php if(!empty($leaving_reason_array)) {  if(in_array("3", $leaving_reason_array)) { echo 'checked'; } } ?> >Conflict with other employees</li>
                                <li><input type="checkbox" name="leaving_reason[]" value="4" <?php if(!empty($leaving_reason_array)) {  if(in_array("4", $leaving_reason_array)) { echo 'checked'; } } ?> >Company instability</li>
                            </ul>
                        </th>
                        <th>
                            <ul class="imp_one">
                                <li><input type="checkbox" name="leaving_reason[]" value="5" <?php if(!empty($leaving_reason_array)) { if(in_array("5", $leaving_reason_array)) { echo 'checked'; } } ?> >Better benefits</li>
                                <li><input type="checkbox" name="leaving_reason[]" value="6" <?php if(!empty($leaving_reason_array)) { if(in_array("6", $leaving_reason_array)) { echo 'checked'; } } ?> >Career change</li>
                                <li><input type="checkbox" name="leaving_reason[]" value="7" <?php if(!empty($leaving_reason_array)) { if(in_array("7", $leaving_reason_array)) { echo 'checked'; } } ?> >Conflict with managers</li>
                                <li><input type="checkbox" name="leaving_reason[]" value="8" <?php if(!empty($leaving_reason_array)) { if(in_array("8", $leaving_reason_array)) { echo 'checked'; } } ?> >Other</li>
                            </ul>
                        </th>
                        <th>
                            <ul class="imp_one">
                                <li><input type="checkbox" name="leaving_reason[]" value="9" <?php if(!empty($leaving_reason_array)) { if(in_array("9", $leaving_reason_array)) { echo 'checked'; } } ?> >Better career opportunity</li>
                                <li><input type="checkbox" name="leaving_reason[]" value="10" <?php if(!empty($leaving_reason_array)) { if(in_array("10", $leaving_reason_array)) { echo 'checked'; } } ?> >Closer to home</li>
                                <li><input type="checkbox" name="leaving_reason[]" value="11" <?php if(!empty($leaving_reason_array)) { if(in_array("11", $leaving_reason_array)) { echo 'checked'; } } ?> >Family and/or personal reasons</li>
                            </ul>
                        </th>
                    </tr>
                </table> 
            </div>
            <hr>
            <div class="table_content">
                <table>
                    <tr class="">
                        <th class="org">Job Itself. Please rank the following : </th>
                        <th>Strongly Disagree </th>
                        <th>Disagree</th>
                        <th>Agree</th>
                        <th>Strongly Agree</th>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td>
                            <ul class="imp_two">
                                <li>Job was challenging</li>
                                <li>There were sufficient opportunities for advancement </li>
                                <li>Workload was manageable</li>
                                <li>Sufficient resources and staff were available</li>
                                <li>Your colleagues listened and appreciated your suggestions </li>
                                <li>Your skills were effectively used</li>
                                <li>You had access to adequate training and development programs </li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three"> <?php // echo $employee_eif->challenging;  ?>
                                <li><input type="radio" name="challenging" value="1" <?php if(!empty($employee_eif->challenging)) echo $employee_eif->challenging == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="sufficient" value="1" <?php if(!empty($employee_eif->sufficient)) echo $employee_eif->sufficient == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="manageable" value="1" <?php if(!empty($employee_eif->manageable)) echo $employee_eif->manageable == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="available" value="1" <?php if(!empty($employee_eif->available)) echo $employee_eif->available == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="colleagues" value="1" <?php if(!empty($employee_eif->colleagues)) echo $employee_eif->colleagues == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="skills" value="1" <?php if(!empty($employee_eif->skills)) echo $employee_eif->skills == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="training" value="1" <?php if(!empty($employee_eif->training)) echo $employee_eif->training == '1'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three">
                                <li><input type="radio" name="challenging" value="2" <?php if(!empty($employee_eif->challenging)) echo $employee_eif->challenging == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="sufficient" value="2" <?php if(!empty($employee_eif->sufficient)) echo $employee_eif->sufficient == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="manageable" value="2" <?php if(!empty($employee_eif->manageable)) echo $employee_eif->manageable == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="available" value="2" <?php if(!empty($employee_eif->available)) echo $employee_eif->available == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="colleagues" value="2" <?php if(!empty($employee_eif->colleagues)) echo $employee_eif->colleagues == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="skills" value="2" <?php if(!empty($employee_eif->skills)) echo $employee_eif->skills == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="training" value="2" <?php if(!empty($employee_eif->training)) echo $employee_eif->training == '2'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three">
                                <li><input type="radio" name="challenging" value="3" <?php if(!empty($employee_eif->challenging)) echo $employee_eif->challenging == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="sufficient" value="3" <?php if(!empty($employee_eif->sufficient)) echo $employee_eif->sufficient == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="manageable" value="3" <?php if(!empty($employee_eif->manageable)) echo $employee_eif->manageable == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="available" value="3" <?php if(!empty($employee_eif->available)) echo $employee_eif->available == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="colleagues" value="3" <?php if(!empty($employee_eif->colleagues)) echo $employee_eif->colleagues == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="skills" value="3" <?php if(!empty($employee_eif->skills)) echo $employee_eif->skills == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="training" value="3" <?php if(!empty($employee_eif->training)) echo $employee_eif->training == '3'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three"> 
                                <li><input type="radio" name="challenging" value="4" <?php if(!empty($employee_eif->challenging)) echo $employee_eif->challenging == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="sufficient" value="4" <?php if(!empty($employee_eif->sufficient)) echo $employee_eif->sufficient == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="manageable" value="4" <?php if(!empty($employee_eif->manageable)) echo $employee_eif->manageable == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="available" value="4" <?php if(!empty($employee_eif->available)) echo $employee_eif->available == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="colleagues" value="4" <?php if(!empty($employee_eif->colleagues)) echo $employee_eif->colleagues == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="skills" value="4" <?php if(!empty($employee_eif->skills)) echo $employee_eif->skills == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="training" value="4" <?php if(!empty($employee_eif->training)) echo $employee_eif->training == '4'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
            <table class="table-responsive">
                <tr>
                </tr>
                <tr>
                    <td> What do you think can be improved about the job? : </td>
                </tr>
            </table>
            <textarea name="improve_job_comments" class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_eif->improve_job_comments)) { echo $employee_eif->improve_job_comments; } ?></textarea>
            <div class="table_content areas">
                <table>
                    <tr class="">
                        <th class="org">Remuneration & Benefits </th>
                        <th>Strongly Disagree</th>
                        <th>Disagree</th>
                        <th>Agree</th>
                        <th>Strongly Agree</th>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td>
                            <ul class="imp_two">
                                <li>The salary was adequate in relation to responsibilities</li>
                                <li>Wages were paid on time</li>
                                <li>Other benefits were good </li>
                                <li>Work-life balance was promoted and practiced</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three">
                                <li><input type="radio" name="salary_adequate" value="1"  <?php if(!empty($employee_eif->salary_adequate)) echo $employee_eif->salary_adequate == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="wages_paid" value="1"  <?php if(!empty($employee_eif->wages_paid)) echo $employee_eif->wages_paid == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="other_benefits" value="1"  <?php if(!empty($employee_eif->other_benefits)) echo $employee_eif->other_benefits == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="work_life_balance" value="1"  <?php if(!empty($employee_eif->work_life_balance)) echo $employee_eif->work_life_balance == '1'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three">
                                <li><input type="radio" name="salary_adequate" value="2"  <?php if(!empty($employee_eif->salary_adequate)) echo $employee_eif->salary_adequate == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="wages_paid" value="2"  <?php if(!empty($employee_eif->wages_paid)) echo $employee_eif->wages_paid == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="other_benefits" value="2"  <?php if(!empty($employee_eif->other_benefits)) echo $employee_eif->other_benefits == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="work_life_balance" value="2"  <?php if(!empty($employee_eif->work_life_balance)) echo $employee_eif->work_life_balance == '2'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three">
                                <li><input type="radio" name="salary_adequate" value="3"  <?php if(!empty($employee_eif->salary_adequate)) echo $employee_eif->salary_adequate == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="wages_paid" value="3"  <?php if(!empty($employee_eif->wages_paid)) echo $employee_eif->wages_paid == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="other_benefits" value="3"  <?php if(!empty($employee_eif->other_benefits)) echo $employee_eif->other_benefits == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="work_life_balance" value="3"  <?php if(!empty($employee_eif->work_life_balance)) echo $employee_eif->work_life_balance == '3'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three">
                                <li><input type="radio" name="salary_adequate" value="4"  <?php if(!empty($employee_eif->salary_adequate)) echo $employee_eif->salary_adequate == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="wages_paid" value="4"  <?php if(!empty($employee_eif->wages_paid)) echo $employee_eif->wages_paid == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="other_benefits" value="4"  <?php if(!empty($employee_eif->other_benefits)) echo $employee_eif->other_benefits == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="work_life_balance" value="4"  <?php if(!empty($employee_eif->work_life_balance)) echo $employee_eif->work_life_balance == '4'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="table_content areas">
                <table>
                    <tr class="">
                        <th class="org">Management/Supervisor</th>
                        <th>Strongly Disagree </th>
                        <th>Disagree</th>
                        <th>Agree</th>
                        <th>Strongly Agree</th>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td>
                            <ul class="imp_two">
                                <li>Gave fair and equal treatment</li>
                                <li>Was available to discuss job related issues</li>
                                <li>Encouraged feedback and suggestions</li>
                                <li>Maintained consistent policies and practices</li>
                                <li>Provided recognition for achievements</li>
                                <li>Gave opportunities to develop </li>
                                <li>Provided constructive feedback </li>
                                <li>Clearly communicated decisions and how they would affect your work</li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three">
                                <li><input type="radio" name="equal_treatment" value="1" <?php if(!empty($employee_eif->equal_treatment)) echo $employee_eif->equal_treatment == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="job_related_issues" value="1" <?php if(!empty($employee_eif->job_related_issues)) echo $employee_eif->job_related_issues == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="encouraged_feedback" value="1" <?php if(!empty($employee_eif->encouraged_feedback)) echo $employee_eif->encouraged_feedback == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="consistent_policies" value="1" <?php if(!empty($employee_eif->consistent_policies)) echo $employee_eif->consistent_policies == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="achievements" value="1" <?php if(!empty($employee_eif->achievements)) echo $employee_eif->achievements == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="opportunities" value="1" <?php if(!empty($employee_eif->opportunities)) echo $employee_eif->opportunities == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="constructive_feedback" value="1" <?php if(!empty($employee_eif->constructive_feedback)) echo $employee_eif->constructive_feedback == '1'?'checked':'' ?> ></li>
                                <li><input type="radio" name="communicated_decisions" value="1" <?php if(!empty($employee_eif->communicated_decisions)) echo $employee_eif->communicated_decisions == '1'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three">
                                <li><input type="radio" name="equal_treatment" value="2" <?php if(!empty($employee_eif->equal_treatment)) echo $employee_eif->equal_treatment == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="job_related_issues" value="2" <?php if(!empty($employee_eif->job_related_issues)) echo $employee_eif->job_related_issues == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="encouraged_feedback" value="2" <?php if(!empty($employee_eif->encouraged_feedback)) echo $employee_eif->encouraged_feedback == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="consistent_policies" value="2" <?php if(!empty($employee_eif->consistent_policies)) echo $employee_eif->consistent_policies == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="achievements" value="2" <?php if(!empty($employee_eif->achievements)) echo $employee_eif->achievements == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="opportunities" value="2" <?php if(!empty($employee_eif->opportunities)) echo $employee_eif->opportunities == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="constructive_feedback" value="2" <?php if(!empty($employee_eif->constructive_feedback)) echo $employee_eif->constructive_feedback == '2'?'checked':'' ?> ></li>
                                <li><input type="radio" name="communicated_decisions" value="2" <?php if(!empty($employee_eif->communicated_decisions)) echo $employee_eif->communicated_decisions == '2'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three"> 
                                <li><input type="radio" name="equal_treatment" value="3" <?php if(!empty($employee_eif->equal_treatment)) echo $employee_eif->equal_treatment == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="job_related_issues" value="3" <?php if(!empty($employee_eif->job_related_issues)) echo $employee_eif->job_related_issues == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="encouraged_feedback" value="3" <?php if(!empty($employee_eif->encouraged_feedback)) echo $employee_eif->encouraged_feedback == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="consistent_policies" value="3" <?php if(!empty($employee_eif->consistent_policies)) echo $employee_eif->consistent_policies == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="achievements" value="3" <?php if(!empty($employee_eif->achievements)) echo $employee_eif->achievements == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="opportunities" value="3" <?php if(!empty($employee_eif->opportunities)) echo $employee_eif->opportunities == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="constructive_feedback" value="3" <?php if(!empty($employee_eif->constructive_feedback)) echo $employee_eif->constructive_feedback == '3'?'checked':'' ?> ></li>
                                <li><input type="radio" name="communicated_decisions" value="3" <?php if(!empty($employee_eif->communicated_decisions)) echo $employee_eif->communicated_decisions == '3'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                        <td>
                            <ul class="imp_three">
                                <li><input type="radio" name="equal_treatment" value="4" <?php if(!empty($employee_eif->equal_treatment)) echo $employee_eif->equal_treatment == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="job_related_issues" value="4" <?php if(!empty($employee_eif->job_related_issues)) echo $employee_eif->job_related_issues == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="encouraged_feedback" value="4" <?php if(!empty($employee_eif->encouraged_feedback)) echo $employee_eif->encouraged_feedback == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="consistent_policies" value="4" <?php if(!empty($employee_eif->consistent_policies)) echo $employee_eif->consistent_policies == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="achievements" value="4" <?php if(!empty($employee_eif->achievements)) echo $employee_eif->achievements == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="opportunities" value="4" <?php if(!empty($employee_eif->opportunities)) echo $employee_eif->opportunities == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="constructive_feedback" value="4" <?php if(!empty($employee_eif->constructive_feedback)) echo $employee_eif->constructive_feedback == '4'?'checked':'' ?> ></li>
                                <li><input type="radio" name="communicated_decisions" value="4" <?php if(!empty($employee_eif->communicated_decisions)) echo $employee_eif->communicated_decisions == '4'?'checked':'' ?> ></li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
			
			  <span class="required">All fields are mandatory</span> <?php // echo lang('required_field') ?>

        <input type="hidden" name="id" value="<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id)) ?>" >
        <?php if(!empty($login->id)): ?>
            <input type="hidden" name="login_id" value="<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($login->id)) ?>" >
        <?php endif ?>
		
		<input type="hidden" name="btn_type" value="edit" />
			
		<div class="box-footer">
			<button id="saveSalary" type="submit" class="btn bg-olive btn-flat"  >
		   <?php  echo lang('update'); ?>
			</button>
			<input type="button" onclick="printDiv('print-content')"  class="btn bg-olive btn-flat" value="Print"/>
		</div>
            <div class="information">
                <p>Thank you for completing this information. Your responses will be treated with total confidence. </p>
            </div>
    </section>
 <?php echo form_close()?>
<script>
	$('form').attr('autocomplete', 'off');
	</script>
 
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        w=window.open();
        w.document.write(printContents);
        w.print();
        w.close();
    }
</script>
<script> 
  $(function(){
   $('.skin-purple').addClass('sidebar-collapse');
    }); 
  </script>
</body>

</html>