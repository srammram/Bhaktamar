
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

    tr th {
        background-color: #dddddd;
    }
	.total_sec td{
        background-color: #efefef;
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

    p {
        line-height: 24px;
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
    }

    .title {
        text-align: center;
        padding: 30px 0px;
    }

    .undstand {
        max-width: 350px;
        width: 100%;
        display: inline-block;
    }

    .org {
        font-style: italic;
    }

    .areas {
        outline: none;
    }

    input.apra {
        width: 35%;
        border: 0px;
        border-bottom: 1px solid #ddd;
        outline: none;
    }
    .uoi {
    display: inline-block;
    width: 100%;
    border: 1px solid #ddd;
    padding: 20px;
    }
    .performance li {
    padding: 6px 0px;
    }
    ol.alway {
    list-style: none;
    }
    .performance {
    line-height: 22px;
	margin-top:20px;
    }
    </style>
	
	
</head>
<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!-- general form elements -->



<div class="box box-primary">
    <div class="box-header with-border bg-primary-dark">
        <h3 class="box-title"><?= lang('add_performance_appraisal') ?></h3>
    </div>
    <!-- /.box-header -->
	
    <!-- form start -->
	<?php echo form_open('admin/employee/save_employeeAppraisal', $attribute= array('id' => 'ContactForm', 'class' => 'ContactForm') ) ?>
    <div class="box-body" id="print-content">
        <div class="row">
            <div class="col-md-12">
         <section>
            <div class="title">
                <h3>PERFORMANCE APPRAISAL</h3>
            </div>
			 <input type="hidden" name="employee_id" value="<?php echo $employee->id ?>" >
            <div class="table_content">
                <div class="table">
                    <table>
                        <tr></tr>
                        <tr>
                            <th>Name</th>
                            <th>Hire Date</th>
                            <th>Location</th>
                            <th>Position Applied</th>
                        </tr>
						<?php /*  echo '<pre>';
						print_r($employee);
						die; */
						?>
						
                        <tr>
                            <td><input type="text" name="name" value="<?php echo $employee->first_name ?>"></td>
                            <td><input type="text" name="joined_date" value="<?php echo $employee->joined_date ?>"></td>
                            <td><input type="text" name="location" value="<?php echo $employee->country ?>"></td>
                            <td><input type="text" name="position_applied" value="<?php if($employee->title == '1'){ echo 'Development'; } ?>"></td>
                        </tr>
                    </table>
					<br />
					 <h4 class="det">Review Period From:</h4>
					<table>
                       
						
                        <tr>
                            <td>From</td>
                            <td><input type="text" name="review_from"  value="<?php echo $employee->joined_date ?>"></td>
                            <td>To</td>
                            <td><input type="text" name="review_to"  value="<?php echo $employee->probation_end_date ?>"></td>
                        </tr>
                    </table>
					
			<div class="row">
                <div class="col-sm-12 performance">
                    <h4>Instructions:</h4>
                    <ul>
                        <li>For each <b>performance </b> indicator, select the rating that most accurately describes the employee’s performance during the review period. <b> You may select 1, 2, 3, 4 or 5 only.</b> You may not assign a fraction (e.g. 3.2, 4.3 etc.) for the specific performance indicators.</li>
                        <li>Average the performance indicator in each performance section to get the overall performance section rating.</li>
                        <li>Cite specific examples to support your rating.</li>
                        <li>Sections 1 should be filled out <b>by</b> all employees. And Sections 2 should be completed if the employees <b> have supervisory roles.</b> You may increase the “comments” sections by hitting enter on your keyboard.</li>
                        <li>The annual performance rating is determined by averaging the total from each of the rated sections.</li>
                        <li>A rating of “Outstanding” requires written justification and the Chairman/CEO’s prior written appraisal</li>
                        <li>Employee and supervisor must sign the appraisal form.</li>
                    </ul>
                    <b>Note: Please contact Human Resources if you have questions.</b>
                    <h4>RATING SYSTEM:</h4>
                    <ol class="alway">
                        <li>
                            <b>(5) Outstanding (always exceeds a standard):</b> Performance significantly exceeds requirements and expectations. This employee always accomplishes results for beyond what is required. This employee is extremely knowledgeable and contributes in significant way to KFA’s corporate business.
                        </li>
                        <li><b>(4) Excellent (exceeds a standard):</b> Performance frequently exceeds standards for the job. This employee fully understands the position and outputs and initiatives are consistently of high quality.</li>
                        <li>
                            <b>(3) Good (meets standards):</b> Performance meets the requirements of the job. This employee is familiar with all the aspects of the position and performs these in a competent and satisfactory manner.
                        </li>
                        <li>
                            <b>(2) Fair (occasionally meets standards):</b> Performance occasionally meets the standard requirement for the job. Performance is below organizational expectations and is expected to improve. Performance plan required. Probation may be recommended.
                        </li>
                        <li>
                            <b>(1) Unsatisfactory (usually falls below standard): </b> Performance is considered below requirements for the job. The employee needs to improve. Probation or termination will be recommended.
                        </li>
                    </ol>
                </div>
            </div>
				<div class="table_work">
					<div class="table">

					<table class="table-responsive">
                        <div class="title">
                            <h3>SECTION 1</h3>
                        </div>
						<h4>FOR ALL EMPLOYEES</h4>
                        

                        <tr>
                            <th>Job Skills</th>
                            <th>Score</th>
                            <th>Comments</th>
                        </tr>
                        <tr>
                            <td><b class="org">Knowledge of Work: </b><br>
								<p class="undstand">Demonstrates understanding of KFA’s corporate business, job, and work procedures. Demonstrates knowledge and practical know-how as needed for position.</p>
							</td>
                            <td><input type="text" name="knowledge_score" ></td>
							<td><input type="text" name="knowledge_comments" ></td>
                        </tr>
						<tr></tr>
						 <tr>
                           <td><b class="org"> Ability to Organize: </b><br>
								<p class="undstand">Arranges workload, plans, and establishes priorities; follows jobs through to completion.</p>
						   </td>
                            <td><input type="text" name="ability_score"></td>
							<td><input type="text" name="ability_comments"></td>
                        </tr>
						<tr></tr>
						 <tr>
                           <td><b class="org"> Quality of Work:</b><br>
								<p class="undstand">Performs responsibilities effectively and efficiently; demonstrates accuracy, precision, neatness and completeness.</p>
						   </td>
                            <td><input type="text" name="quality"></td>
							<td><input type="text" name="quality_comments"></td>
                        </tr>
						<tr></tr>
						<tr>
                           <td><b class="org"> Quantity of Work:</b><br>
								<p class="undstand">Volume of quantity work achieved; industrious; energetic; productive.</p>
						   </td>
                            <td><input type="text" name="quantity"></td>
							<td><input type="text" name="quantity_comments"></td>
                        </tr>
						<tr></tr>
						<tr>
                           <td><b class="org"> Communication: </b><br>
								<p class="undstand">Proven good customer service and contributes in a variety of settings; demonstrates good writing and listening skills.</p>
						   </td> 
                            <td><input type="text" name="communication"></td>
							<td><input type="text" name="communication_comments"></td>
                        </tr>
						<tr></tr>
						<tr>
                           <td><b class="org"> Teamwork:</b><br>
								<p class="undstand">Participates, listens, and contributes in a team environment, understands individual role. Actively promotes new business development for KFA.</p>
						   </td>
                            <td><input type="text" name="teamwork"></td>
							<td><input type="text" name="teamwork_comments"></td>
                        </tr>
						<tr></tr>
						<tr>
                           <td><b class="org"> Meet Deadlines:</b><br>
								<p class="undstand">Works effectively and efficiently to meet deadlines. Meets work commitments with a minimum amount of supervision.</p>
						   </td>
                            <td><input type="text" name="meet_deadlines"></td>
							<td><input type="text" name="meet_deadlines_comments"></td>
                        </tr>
						<tr></tr>
						<tr>
                           <td><b class="org"> Decision Making/Problem Analysis: </b><br>
								<p class="undstand">Identifies, communicates, and resolves real or potential problems.</p>
						   </td>
                            <td><input type="text" name="decision"></td>
							<td><input type="text" name="decision_comments"></td>
                        </tr>
						<tr></tr>
						<tr>
                           <td><b class="org"> Professionalism:</b><br>
								<p class="undstand">Appropriate presentation and conduct; respectful; tactful; work well with colleagues.</p>
						   </td>
                            <td><input type="text" name="professionalism"></td>
							<td><input type="text" name="professionalism_comments"></td>
                        </tr>
						<tr class="total_sec">
						
                           <td><b class="org"> TOTAL SCORES FOR SECTION 1:</td>
                            <td><input type="text" name="section1_total_score"></td>
							<td><input type="text" name="section1_comments"></td>
                        </tr>
						<tr class="total_sec">
                           <td><b class="org"> OVERALL SCORES FOR SECTION 1 (TOTAL SECTION 1 DIVIDE BY 9)</td>
                            <td><input type="text" name="section1_overall_score"></td>
							<td><input type="text" name="section1_overall_comments"></td>
                        </tr>
                        <tr></tr>
       
                    </table>
					</div>
					</div>
					
					<div class="table_work">
                <div class="table">
                    <table class="table-responsive">
                        <div class="title">
                            <h3>SECTION 2</h3>
							
                        </div>
                        <h4>FOR SUPERVISORS ONLY</h4>
                        <tr>
                            <th>JOB SKILLS</th>
                            <th>SCORE</th>
                            <th>COMMENTS</th>
                        </tr>
                        <tr>
                            <td>
                                <b class="org">Management/Leadership: </b><br>
                                <p class="undstand">The extent to which this employee promotes open communication, provides recognition when warranted, encourages risk taking, resolves personnel related issues in timely, effective and sensitive manner, follow up with supportive documentation; maintains appropriate standards of performance; develops staff to fullest potential; leads by example and creates and communicates a clear vision and high performance work environment evidenced by successful operations.</p>
                            </td>
                            <td><input type="text" name="mgt"></td>
                            <td><input type="text" name="mgt_cmts"></td>
                        </tr>
                        <tr>
                            <td>
                                <b class="org">Flow of Information: </b><br>
                                <p class="undstand">Ensures and provides timely information to supervisees; understands and conveys KFA’s key priorities, policies, and procedures.</p>
                            </td>
                            <td><input type="text" name="info"></td>
                            <td><input type="text" name="info_cmts"></td>
                        </tr>
                        <tr>
                            <td>
                                <b class="org">Resource Management: </b><br>
                                <p class="undstand">Develops and manages resources (i.e. budget, staff, operation, IMS function). Effectively delegates assignments by giving employees appropriate levels of authority and responsibility.</p>
                            </td>
                            <td><input type="text" name="resource"></td>
                            <td><input type="text" name="resource_cmts"></td>
                        </tr>
                        <tr>
                            <td>
                                <b class="org">Staff Development/Employee Motivation:  </b><br>
                                <p class="undstand">Provides help to staff; gives candid and regular feedback on performance; gives staff support to succeed and provides opportunities for staff to realize full professional potential; takes responsibility for developing and improving the contribution of each staff member.</p>
                            </td>
                            <td><input type="text" name="motive"></td>
                            <td><input type="text" name="motive_cmts"></td>
                        </tr>
                        <tr>
                            <td>
                                <b class="org">New Business Development:  </b><br>
                                <p class="undstand">Provides new business opportunities to KFA and cultivates existing business.</p>
                            </td>
                            <td><input type="text" name="business_dev"></td>
                            <td><input type="text" name="business_dev_cmts"></td>
                        </tr>
                        <tr class="total_sec">
                            <td>
                                <b class="org">TOTAL SCORES FOR SECTION 2:</b>
                            </td>
                            <td><input type="text" name="section2_total_score"></td>
                            <td><input type="text" name="section2_cmts"></td>
                        </tr>
                        <tr class="total_sec">
                            <td>
                                <b class="org">OVERALL SCORES FOR SECTION 2 (TOTAL SECTION 2 DIVIDE BY 5)</b>
                            </td>
                            <td><input type="text" name="section2_overall_score"></td>
                            <td><input type="text" name="section2_overall_comments"></td>
                        </tr>
                        <tr class="total_sec">
                            <td>
                                <b class="org">OVERALL SCORES FOR THIS REVIEW PERIOD (Overall scores divided by # of sections evaluated):</b>
                            </td>
                            <td><input type="text" name="section2_overall_review_score"></td>
                            <td><input type="text" name="section2_overall_review_comments"></td>
                        </tr>
                    </table>
                </div>
            </div>
			
			<div class="table_work_for">
                <div class="title">
                    <h3 class="org">FOR ALL EMPLOYEES </h3>
                </div>
                <div class="table">
                    <table class="table-responsive">
                        <tr>
                            <td><h4>ACCOMPLISHMENTS: </h4></td>
                            <td><input type="text" name="accomplish"></td>
                        </tr>
                        <tr>
                            <td>AS STATED IN THE JOB DESCRIPTION AND OTHER ADDITIONAL WORKS REQUIRED BY SUPERVISOR.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><b>EVALUATOR’S COMMENTS:</b>(Please describe areas for improvement)</td>
                            <td></td>
                        </tr>
                    </table>
                    <textarea name="eval_cmts" class="areas col-md-12 col-lg-12 col-sm-12"></textarea>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>EMPLOYEE’S COMMENTS:</td>
                        </tr>
                    </table>
                    <textarea name="emp_cmts" class="areas col-md-12 col-lg-12 col-sm-12"></textarea>
                    <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td class="org">EMPLOYEE GOALS FOR NEXT REVIEW PERIOD:</td>
                            <td>PRIORITY (A, B, C)</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="goal1"></td>
                            <td><input type="text" name="priority_a"></td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                            <td><input type="text" name="goal2"></td>
                            <td><input type="text" name="priority_b"></td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                            <td><input type="text" name="goal3"></td>
                            <td><input type="text" name="priority_c"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div>
            </div>


					<!--
                    <h3 class="edu">Recommendation of the Panel of the Interview</h3>
                    <table>
					 <colgroup>
						<col style="width:25%">
						<col style="width:25%">
						<col style="width:25%">
						<col style="width:25%">
					</colgroup>
					 <tr></tr>
                      <tr><th>Description </th>
                            <th>Hire </th>
                            <th>Not Hire</th>
                            <th>Pending</th>
                        </tr>
						
                        <tr><td>Interviewer Status</td>
                            <td><input type="radio" name="int_status" value="1"></td>
                            <td><input type="radio" name="int_status" value="2"></td>
                            <td><input type="radio" name="int_status" value="3"></td>
                        </tr>
                    </table> -->
                </div>
            </div>
       
    </section>
				
            </div>
        </div>
        <br/>
        <br/>
        <span class="required">*</span> <?= lang('required_field') ?>

        <input type="hidden" name="id" value="<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id)) ?>" >
        <?php if(!empty($login->id)): ?>
            <input type="hidden" name="login_id" value="<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($login->id)) ?>" >
        <?php endif ?>
    </div>
    <!-- /.box-body -->
	
	<input type="hidden" name="btn_type" value="add" />

    <div class="box-footer">
	
        <button id="saveSalary" type="submit" class="btn bg-olive btn-flat"  >
       <?php  echo lang('save'); ?>
        </button>
		<input type="button" onclick="printDiv('print-content')"  class="btn bg-olive btn-flat" value="Print"/>

    </div>

</div>
<!-- /.box -->


<?php echo form_close()?>

<script type="text/javascript">
    $(document).ready(function(){
        $(".add-row").click(function(){
			//alert();
            // var issue          = $("#issue").val();
            // var action 		   = $("#action").val();
			//var responsibility = $("#responsibility").val();
			//var due_date       = $("#due_date").val();
			//var status 		   = $("#status").val();
			
            var markup = "<tr><td><input type='checkbox' name='record'></td><td><input type='text' name='company_name1[]'></td><td><input type='text' name='title1[]'></td><td><input type='text' name='duration1[]'></td></tr>";
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
  <script>
  $(function(){
   $('.skin-purple').addClass('sidebar-collapse');
    });
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