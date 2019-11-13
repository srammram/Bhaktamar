
<head>
    <style type="text/css">
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

    .per {
        max-width: 400px;
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
        display: inline-block;
        width: 100%;
    }

    .title {
        text-align: center;
        padding: 30px 0px;
    }

    input[type=checkbox],
    input[type=radio] {
        zoom: 1.7;
    }

    .det {
        display: inline-block;
        margin-top: 20px;
        width: 100%;
    }

    .ando {
        font-size: 15px;
        display: inline-block;
        margin-left: 21px;
        line-height: 15px;
        position: relative;
        top: -7px;
    }

    ul.uni li {
        line-height: 28px;
    }

    ul.meet {
        list-style: none;
        padding: 4px;
    }

    ul.meet input[type="radio"] {
        padding: 0px;
        margin: 5px;
    }
    .form_table {
        display: inline-block;
        width: 100%;
        margin-top: 30px;
    }
	
	.remove_gray tr:nth-child(even){background-color:transparent;}
	.remove_gray tr th{background-color:#ccc;}
    </style>
</head>
<!-- View massa
ge -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!-- general form elements -->
<body>

<div class="box box-primary">
    <div class="box-header with-border bg-primary-dark">
        <h3 class="box-title"><?= lang('view/edit_probationary_performance') ?></h3>
    </div>
    <!-- /.box-header -->
	<?php
 		/* echo '<pre>'; 
		print_r($employee_pro_performance);
		print_r($employee_per_plan);
		//die; */
 	?>
    <!-- form start -->
	<?php echo form_open('admin/employee/save_employeeProbationaryPerformance', $attribute= array('id' => 'ContactForm', 'class' => 'ContactForm') ) ?>
	<input type="hidden" name="employee_id" value="<?php echo $employee->id ?>" >
	
    <div class="box-body" id="print-content">
        <div class="row">
            <div class="col-md-12">
         <section>
            <div class="title">
                <h3>PROBATIONARY PERFORMANCE REVIEW FORM</h3>
            </div>
            <h4>Employee Details:</h4>
            <div class="table_content">
                <div class="table">
                    <table>
                        <tr>
                            <th>Name</th>
                            <td><input type="text" name="emp_name" value="<?php echo $employee->first_name ?>" ></td>
                            <th>Position</th>
                            <td><input type="text" name="position" value="<?php if($employee->title == '1'){ echo 'Development'; } ?>"></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td>Commencement Date</td>
                            <td><input type="date" name="start_date" value="<?php echo $employee->joined_date ?>"></td>
                            <td>Probation end date</td>
                            <td><input type="date" name="end_date" value="<?php echo $employee->probation_end_date ?>"></td>
							
                        </tr>
                    </table>
                    <table>
                        <h4 class="det">Reviewer’s Details:</h4>
                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="reviewer_name" value="<?php if(!empty($employee_pro_performance->reviewer_name)) { echo $employee_pro_performance->reviewer_name; }?>" ></td>
                            <td>Position</td>
                            <td><input type="text" name="reviewer_position" value="<?php if(!empty($employee_pro_performance->reviewer_position)) { echo $employee_pro_performance->reviewer_position; }?>" ></td>
                        </tr>
                    </table>
                    <table>
                        <h4 class="det">Review Period:</h4>
                        <tr>
                            <td><input type="radio" name="period" value="3" <?php if(!empty($employee_pro_performance->period)) echo $employee_pro_performance->period == '3'?'checked':'' ?>><span class="badge ando">3 months </span></td>
                            <td><input type="radio" name="period" value="6" <?php if(!empty($employee_pro_performance->period)) echo $employee_pro_performance->period == '6'?'checked':'' ?>><span class="badge ando">6 months </span></td>
                            <td><input type="radio" name="period" value="9" <?php if(!empty($employee_pro_performance->period)) echo $employee_pro_performance->period == '9'?'checked':'' ?>><span class="badge ando">9 months </span></td>
                        </tr>
                    </table>
                    <table>
                        <h4 class="det">Rating Definitions:</h4>
                        <tr></tr>
                        <tr>
                            <td>Rating</td>
                            <td>Definition</td>
                        </tr>
                        <tr>
                            <td>Excellent </td>
                            <td>Above target in all areas</td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td>Good </td>
                            <td>Above expectations in some areas and met expectations in rest</td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td>Satisfactory </td>
                            <td>Met expectations in most areas, some improvement needed</td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td>Unsatisfactory </td>
                            <td>Performance/conduct does not meet the essential requirements of the job</td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td>Excellent </td>
                            <td>Above target in all areas</td>
                        </tr>
                    </table>
                    <table>
                        <h4 class="det">Employee Performance Measurement:</h4>
                        <tr></tr>
                        <tr>
                            <th>Use the following criteria to measure the employee’s performance.</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td><b>Dependability:</b></td>
                            <td> <b>Rating:</b></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td>
                                <ul class="uni">
                                    <li>Meets commitments</li>
                                    <li>Works independently</li>
                                    <li>Accepts accountability</li>
                                    <li>Handles change in a positive manner</li>
                                    <li>Stays focused under pressure</li>
                                    <li>Meets attendance requirements</li>
                                </ul>
                            </td>
                            <td>
                                <ul class="meet">
                                    <li><input type="radio" name="dependability" value="1" <?php if(!empty($employee_pro_performance->dependability)) echo $employee_pro_performance->dependability == '1'?'checked':'' ?>><span class=" ando">Excellent </span></li>
                                    <li><input type="radio" name="dependability" value="2" <?php if(!empty($employee_pro_performance->dependability)) echo $employee_pro_performance->dependability == '2'?'checked':'' ?>><span class=" ando">Good </span></li>
                                    <li><input type="radio" name="dependability" value="3" <?php if(!empty($employee_pro_performance->dependability)) echo $employee_pro_performance->dependability == '3'?'checked':'' ?>><span class=" ando">Satisfactory </span></li>
                                    <li><input type="radio" name="dependability" value="4" <?php if(!empty($employee_pro_performance->dependability)) echo $employee_pro_performance->dependability == '4'?'checked':'' ?>><span class=" ando">Unsatisfactory </span></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                        </tr>
                    </table>
                    <textarea name="dependability_comments" class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_pro_performance->dependability_comments)) { echo $employee_pro_performance->dependability_comments; }?></textarea>
                    <table>
                        <tr></tr>
                        <tr>
                            <td><b>Communication:</b></td>
                            <td> <b>Rating:</b></td>
                        </tr>
                        <tr>
                            <td>
                                <ul class="uni">
                                    <li>Listens effectively</li>
                                    <li>Responds clearly and directly</li>
                                    <li>Seeks to clarify and confirm the accuracy of their understanding of unfamiliar or vague terms</li>
                                    <li>Oral and written communication clear and easy to understand</li>
                                </ul>
                            </td>
                            <td>
                                <ul class="meet">
                                    <li><input type="radio" name="communication" value="1" <?php if(!empty($employee_pro_performance->communication)) echo $employee_pro_performance->communication == '1'?'checked':'' ?>><span class=" ando">Excellent </span></li>
                                    <li><input type="radio" name="communication" value="2" <?php if(!empty($employee_pro_performance->communication)) echo $employee_pro_performance->communication == '2'?'checked':'' ?>><span class=" ando">Good </span></li>
                                    <li><input type="radio" name="communication" value="3" <?php if(!empty($employee_pro_performance->communication)) echo $employee_pro_performance->communication == '3'?'checked':'' ?>><span class=" ando">Satisfactory </span></li>
                                    <li><input type="radio" name="communication" value="4" <?php if(!empty($employee_pro_performance->communication)) echo $employee_pro_performance->communication == '4'?'checked':'' ?>><span class=" ando">Unsatisfactory </span></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                        </tr>
                    </table>
                    <textarea name="comm_comments" class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_pro_performance->comm_comments)) { echo $employee_pro_performance->comm_comments; }?></textarea>
                    <table>
                        <tr></tr>
                        <tr>
                            <td><b>Job knowledge:</b></td>
                            <td> <b>Rating:</b></td>
                        </tr>
                        <tr>
                            <td>
                                <ul class="uni">
                                    <li>Understands job duties and responsibilities</li>
                                    <li>Has necessary job skills and knowledge</li>
                                    <li>Has technical skills, knowledge</li>
                                    <li>Understands, operates equipment</li>
                                    <li>Understands and promotes MRH missions and values</li>
                                    <li>Keeps current with new developments</li>
                                </ul>
                            </td>
                            <td>
                                <ul class="meet">
                                    <li><input type="radio" name="job_knowledge" value="1" <?php if(!empty($employee_pro_performance->job_knowledge)) echo $employee_pro_performance->job_knowledge == '1'?'checked':'' ?>><span class=" ando">Excellent </span></li>
                                    <li><input type="radio" name="job_knowledge" value="2" <?php if(!empty($employee_pro_performance->job_knowledge)) echo $employee_pro_performance->job_knowledge == '2'?'checked':'' ?>><span class=" ando">Good </span></li>
                                    <li><input type="radio" name="job_knowledge" value="3" <?php if(!empty($employee_pro_performance->job_knowledge)) echo $employee_pro_performance->job_knowledge == '3'?'checked':'' ?>><span class=" ando">Satisfactory </span></li>
                                    <li><input type="radio" name="job_knowledge" value="4" <?php if(!empty($employee_pro_performance->job_knowledge)) echo $employee_pro_performance->job_knowledge == '4'?'checked':'' ?>><span class=" ando">Unsatisfactory </span></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                        </tr>
                    </table>
                    <textarea name="job_knowledge_comments" class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_pro_performance->job_knowledge_comments)) { echo $employee_pro_performance->job_knowledge_comments; }?></textarea>
                    <table>
                        <tr></tr>
                        <tr>
                            <td><b>Problem solving:</b></td>
                            <td> <b>Rating:</b></td>
                        </tr>
                        <tr>
                            <td>
                                <ul class="uni">
                                    <li>Anticipates and prevents problems</li>
                                    <li>Defines problems, identifies root cause</li>
                                    <li>Overcomes obstacles</li>
                                    <li>Generates alternate solutions</li>
                                    <li>Helps solve team problems</li>
                                </ul>
                            </td>
                            <td>
                                <ul class="meet">
                                    <li><input type="radio" name="problem_solving" value="1" <?php if(!empty($employee_pro_performance->problem_solving)) echo $employee_pro_performance->problem_solving == '1'?'checked':'' ?>><span class=" ando">Excellent </span></li>
                                    <li><input type="radio" name="problem_solving" value="2" <?php if(!empty($employee_pro_performance->problem_solving)) echo $employee_pro_performance->problem_solving == '2'?'checked':'' ?>><span class=" ando">Good </span></li>
                                    <li><input type="radio" name="problem_solving" value="3" <?php if(!empty($employee_pro_performance->problem_solving)) echo $employee_pro_performance->problem_solving == '3'?'checked':'' ?>><span class=" ando">Satisfactory </span></li>
                                    <li><input type="radio" name="problem_solving" value="4" <?php if(!empty($employee_pro_performance->problem_solving)) echo $employee_pro_performance->problem_solving == '4'?'checked':'' ?>><span class=" ando">Unsatisfactory </span></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                        </tr>
                    </table>
                    <textarea name="problem_solving_comments" class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_pro_performance->problem_solving_comments)) { echo $employee_pro_performance->problem_solving_comments; }?></textarea>
                    <table>
                        <tr></tr>
                        <tr>
                            <td><b>Productivity:</b></td>
                            <td> <b>Rating:</b></td>
                        </tr>
                        <tr>
                            <td>
                                <ul class="uni">
                                    <li>Manages a fair work load</li>
                                    <li>Takes on additional responsibilities as needed</li>
                                    <li>Manages priorities</li>
                                    <li>Develops and follows work procedures</li>
                                    <li>Manages time well</li>
                                    <li>Handles information flow</li>
                                </ul>
                            </td>
                            <td>
                                <ul class="meet">
                                    <li><input type="radio" name="productivity" value="1" <?php if(!empty($employee_pro_performance->productivity)) echo $employee_pro_performance->productivity == '1'?'checked':'' ?>><span class=" ando">Excellent </span></li>
                                    <li><input type="radio" name="productivity" value="2" <?php if(!empty($employee_pro_performance->productivity)) echo $employee_pro_performance->productivity == '2'?'checked':'' ?>><span class=" ando">Good </span></li>
                                    <li><input type="radio" name="productivity" value="3" <?php if(!empty($employee_pro_performance->productivity)) echo $employee_pro_performance->productivity == '3'?'checked':'' ?>><span class=" ando">Satisfactory </span></li>
                                    <li><input type="radio" name="productivity" value="4" <?php if(!empty($employee_pro_performance->productivity)) echo $employee_pro_performance->productivity == '4'?'checked':'' ?>><span class=" ando">Unsatisfactory </span></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                        </tr>
                    </table>
                    <textarea name="productivity_comments" class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_pro_performance->productivity_comments)) { echo $employee_pro_performance->productivity_comments; }?></textarea>
                    <table>
                        <tr></tr>
                        <tr>
                            <td><b>Quality:</b></td>
                            <td> <b>Rating:</b></td>
                        </tr>
                        <tr>
                            <td>
                                <ul class="uni">
                                    <li>Is attentive to detail and accuracy</li>
                                    <li>Actively supports quality standards</li>
                                    <li>Makes continuous improvements</li>
                                    <li>Monitors quality levels</li>
                                    <li>Owns and acts on quality problems</li>
                                </ul>
                            </td>
                            <td>
                                <ul class="meet">
                                    <li><input type="radio" name="quality" value="1" <?php if(!empty($employee_pro_performance->quality)) echo $employee_pro_performance->quality == '1'?'checked':'' ?>><span class=" ando">Excellent </span></li>
                                    <li><input type="radio" name="quality" value="2" <?php if(!empty($employee_pro_performance->quality)) echo $employee_pro_performance->quality == '2'?'checked':'' ?>><span class=" ando">Good </span></li>
                                    <li><input type="radio" name="quality" value="3" <?php if(!empty($employee_pro_performance->quality)) echo $employee_pro_performance->quality == '3'?'checked':'' ?>><span class=" ando">Satisfactory </span></li>
                                    <li><input type="radio" name="quality" value="4" <?php if(!empty($employee_pro_performance->quality)) echo $employee_pro_performance->quality == '4'?'checked':'' ?>><span class=" ando">Unsatisfactory </span></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                        </tr>
                    </table>
                    <textarea name="quality_comments" class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_pro_performance->quality_comments)) { echo $employee_pro_performance->quality_comments; }?></textarea>
                    <table>
                        <tr></tr>
                        <tr>
                            <td><b>Teamwork:</b></td>
                            <td> <b>Rating:</b></td>
                        </tr>
                        <tr>
                            <td>
                                <ul class="uni">
                                    <li>Contributes to team performance</li>
                                    <li>Exchanges ideas, opinions</li>
                                    <li>Helps prevent, resolve conflicts</li>
                                    <li>Works with other areas</li>
                                    <li>Develops positive working relationships</li>
                                    <li>Is flexible and open-minded</li>
                                    <li>Promotes mutual respect</li>
                                </ul>
                            </td>
                            <td>
                                <ul class="meet">
                                    <li><input type="radio" name="teamwork" value="1" <?php if(!empty($employee_pro_performance->teamwork)) echo $employee_pro_performance->teamwork == '1'?'checked':'' ?>><span class=" ando">Excellent </span></li>
                                    <li><input type="radio" name="teamwork" value="2" <?php if(!empty($employee_pro_performance->teamwork)) echo $employee_pro_performance->teamwork == '2'?'checked':'' ?>><span class=" ando">Good </span></li>
                                    <li><input type="radio" name="teamwork" value="3" <?php if(!empty($employee_pro_performance->teamwork)) echo $employee_pro_performance->teamwork == '3'?'checked':'' ?>><span class=" ando">Satisfactory </span></li>
                                    <li><input type="radio" name="teamwork" value="4" <?php if(!empty($employee_pro_performance->teamwork)) echo $employee_pro_performance->teamwork == '4'?'checked':'' ?>><span class=" ando">Unsatisfactory </span></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                        </tr>
                    </table>
                    <textarea name="teamwork_comments" class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_pro_performance->teamwork_comments)) { echo $employee_pro_performance->teamwork_comments; }?></textarea>
                    <table>
                        <tr></tr>
                        <tr>
                            <td><b>Planning and Organisational skills:</b></td>
                            <td> <b>Rating:</b></td>
                        </tr>
                        <tr>
                            <td>
                                <ul class="uni">
                                    <li>Develops realistic plans</li>
                                    <li>Balances short and long-term goals</li>
                                    <li>Aligns plans with MRH goals</li>
                                    <li>Plans for and manages resources</li>
                                    <li>Creates contingency plans</li>
                                    <li>Coordinates and cooperates with others</li>
                                </ul>
                            </td>
                            <td>
                                <ul class="meet">
                                    <li><input type="radio" name="planning" value="1" <?php if(!empty($employee_pro_performance->planning)) echo $employee_pro_performance->planning == '1'?'checked':'' ?>><span class=" ando">Excellent </span></li>
                                    <li><input type="radio" name="planning" value="2" <?php if(!empty($employee_pro_performance->planning)) echo $employee_pro_performance->planning == '2'?'checked':'' ?>><span class=" ando">Good </span></li>
                                    <li><input type="radio" name="planning" value="3" <?php if(!empty($employee_pro_performance->planning)) echo $employee_pro_performance->planning == '3'?'checked':'' ?>><span class=" ando">Satisfactory </span></li>
                                    <li><input type="radio" name="planning" value="4" <?php if(!empty($employee_pro_performance->planning)) echo $employee_pro_performance->planning == '4'?'checked':'' ?>><span class=" ando">Unsatisfactory </span></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                        </tr>
                    </table>
                    <textarea name="planning_comments" class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_pro_performance->planning_comments)) { echo $employee_pro_performance->planning_comments; }?></textarea>
                    <table>
                        <tr></tr>
                        <tr>
                            <td><b>Performance Summary:</b></td>
                            <td> <b>Overall Rating:</b></td>
                        </tr>
                        <tr>
                            <td>
                                <ul class="per">
                                    <li>
                                        <p>When providing comments consider the employee’s performance against objectives, key factors from the Employee Performance section above, and strengths/potential improvements</p>
                                </ul>
                            </td>
                            <td>
                                <ul class="meet">
                                    <li><input type="radio" name="performance" value="1" <?php if(!empty($employee_pro_performance->performance)) echo $employee_pro_performance->performance == '1'?'checked':'' ?>><span class=" ando">Excellent </span></li>
                                    <li><input type="radio" name="performance" value="2" <?php if(!empty($employee_pro_performance->performance)) echo $employee_pro_performance->performance == '2'?'checked':'' ?>><span class=" ando">Good </span></li>
                                    <li><input type="radio" name="performance" value="3" <?php if(!empty($employee_pro_performance->performance)) echo $employee_pro_performance->performance == '3'?'checked':'' ?>><span class=" ando">Satisfactory </span></li>
                                    <li><input type="radio" name="performance" value="4" <?php if(!empty($employee_pro_performance->performance)) echo $employee_pro_performance->performance == '4'?'checked':'' ?>><span class=" ando">Unsatisfactory </span></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                        </tr>
                    </table>
                    <textarea name="performance_comments" class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_pro_performance->performance_comments)) { echo $employee_pro_performance->performance_comments; }?></textarea>
                    <table>
                        <h4 class="det">Employee’s Comments:</h4>
                        <tr></tr>
                        <tr>
                        </tr>
                        <tr>
                            <td>
                                <p>Use the comments space below to make any comments regarding the above appraisal or the performance plan.</p>
                            </td>
                        </tr>
                    </table>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                        </tr>
                    </table>
                    <textarea name="employee_comments" class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_pro_performance->employee_comments)) { echo $employee_pro_performance->employee_comments; }?></textarea>
					
                    <table>
                        <h4 class="det">Performance Plan:</h4>
                        <tr></tr>
                        <tr>
                        </tr>
                        <tr>
                            <td>
                                <p>Identify specific actions/behaviours the employee needs to start doing, stop doing, and/or continue doing in the upcoming performance period. Include the indicators of success. Also include any development activities (training, etc) that the employee will need to complete in order to achieve goals and make expected changes.</p>
                            </td>
                        </tr>
                    </table>
                    <table class="add_new_row remove_gray">
					<tbody>
                        <tr></tr>
                        <tr><th></th>
                            <th>Issue</th>
                            <th>Action</th>
                            <th>Responsibility</th>
                            <th>Due Date</th>
                            <th>Status  <input  type="button" class="add-row" value="+">
										<input  type="button" class="delete-row" value="-">
							</th>
							
                        </tr>
						<?php foreach($employee_per_plan_arr as $employee_per_plan) {
						// for($i=1; $i<=2; $i++) {  ?>
						
                        <tr>
							<td><input type="checkbox" name="record"></td>
                            <td><input type="text" name="issue[]" value="<?php if(!empty($employee_per_plan['issue'])) { echo $employee_per_plan['issue']; }?>" id="issue"></td>
                            <td><input type="text" name="action[]" value="<?php if(!empty($employee_per_plan['action'])) { echo $employee_per_plan['action']; }?>" id="action"></td>
						<td><input type="text" name="responsibility[]" value="<?php if(!empty($employee_per_plan['responsibility'])) { echo $employee_per_plan['responsibility']; }?>" id="responsibility"></td>
                            <td><input type="date" name="due_date[]" value="<?php if(!empty($employee_per_plan['due_date'])) { echo $employee_per_plan['due_date']; }?>" id="due_date"></td>
                            <td><input type="text" name="status[]" value="<?php if(!empty($employee_per_plan['status'])) { echo $employee_per_plan['status']; }?>" id="status"></td>
							
                        </tr>
                        <tr></tr>
						<?php  } ?>
                      <!--  <tr>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                            <td><input type="text" name="leave"></td>
                        </tr> -->
						</tbody>
                    </table>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Success Indicators:</td>
                        </tr>
                    </table>
                    <textarea name="success_indicators"  class="areas col-md-12 col-lg-12 col-sm-12"><?php if(!empty($employee_pro_performance->success_indicators)) { echo $employee_pro_performance->success_indicators; }?></textarea>
                </div> 
				<!--
                <div class="form_table">
                     <div class="row im">
                        <div class="col-sm-3"><h5>Employee Signature:</h5>
                        </div>
                        <div class="col-sm-5"> <input type="text" name="signature"></div>
                        <div class="col-sm-1"> <h5>Date:</h5>
                        </div>
                        <div class="col-sm-3"> <input type="date" name="date"></div>
                    </div>
                    <div class="row im">
                        <table>
                            <tr>
                                <td style="border: 0px; border-bottom: 1px solid #dddddd;">The employee signature does not necessarily signify agreement with the appraisal. It is simply an acknowledgement the process has been undertaken.</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row im">
                        <div class="col-sm-1"><h5>Reviewer</h5>
                        </div>
                        <div class="col-sm-7"> <input type="text" name="signature"></div>
                       <div class="col-sm-1"> <h5>Date:</h5>
                        </div>
                        <div class="col-sm-3"> <input type="date" name="date"></div>
                    </div>
                    <div class="row im">
                        <div class="col-sm-1"><h5>HR</h5>
                        </div>
                        <div class="col-sm-7"> <input type="text" name="signature"></div>
                      <div class="col-sm-1"> <h5>Date:</h5>
                        </div>
                        <div class="col-sm-3"> <input type="date" name="date"></div>
                    </div>
                </div> -->
				
				<span class="required">All fields are mandatory</span> 

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
			

            </div>
			
			
			
			
    </section>
	
	<script type="text/javascript">
    $(document).ready(function(){
        $(".add-row").click(function(){
           // var issue          = $("#issue").val();
           // var action 		   = $("#action").val();
			//var responsibility = $("#responsibility").val();
			//var due_date       = $("#due_date").val();
			//var status 		   = $("#status").val();
			
            var markup = "<tr><td><input type='checkbox' name='record'></td><td><input type='text' name='issue1[]'></td><td><input type='text' name='action1[]'></td><td><input type='text' name='responsibility1[]'></td><td><input type='date' name='due_date1[]'></td><td><input type='text' name='status1[]'></td></tr>";
            $(".add_new_row").append(markup);
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
    });    
</script>
 
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