
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

    th {
        text-align: center;
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

    .edu {
        text-align: center;
    }


    .title {
        text-align: center;
        padding: 30px 0px;
    }
	
	.remove_gray tr:nth-child(even){background-color:transparent;}
	.remove_gray tr th{background-color:#ccc;}
	
    </style>
</head>
<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!-- general form elements -->



<div class="box box-primary">
    <div class="box-header with-border bg-primary-dark">
        <h3 class="box-title"><?= lang('add_interview_assessment') ?></h3>
    </div>
    <!-- /.box-header -->
	
    <!-- form start -->
	<?php echo form_open('admin/employee/save_employeeInterviewAssessment', $attribute= array('id' => 'ContactForm', 'class' => 'ContactForm') ) ?>
    <div class="box-body" id="print-content">
        <div class="row">
            <div class="col-md-12">
         <section>
            <div class="title">
                <h3>Candidate Interview Assessment & Evaluation Form</h3>
            </div>
			 
            <div class="table_content">
                <div class="table">
                    <table>
                        <tr></tr>
                        <tr>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Sex</th>
                            <th>Position Applied</th>
                        </tr>
						<?php /*  echo '<pre>';
						print_r($employee);
						die; */
						?>
						
                        <tr>
                            <td><input type="text" name="name" value="<?php echo $employee->first_name ?>"></td>
                            <td><input type="text" name="age" value="<?php echo $employee->date_of_birth ?>"></td>
                            <td><!-- <input type="text" name="sex" value=""> -->
							<input type="radio" name="gender" value="m" <?php if($employee->gender == 'Male') { ?> checked <?php } ?> >Male
							<input type="radio" name="gender" value="f" <?php if($employee->gender == 'Female') { ?> checked <?php } ?> >Female</td>
                            <td><input type="text" name="position_applied" value="<?php if($employee->title == '1'){ echo 'Development'; } ?>"></td>
                        </tr>
                    </table>
                    <h3 class="edu">Educational Background:</h3>
                    <table>
                        <tr></tr>
                        <tr>
                            <th>Descriptions</th>
                            <th>Course/Major</th>
                            <th>College/University</th>
                            <th>Percentage/Grade</th>
                        </tr>
                        <tr>
						<?php
						foreach($education_master as $row) {
						?>
                            <td><?php echo $row['name']; ?></td>
                            <td><input type="text" name="major[]" value=""></td>
                            <td><input type="text" name="college[]" value=""></td>
                            <td><input type="text" name="percentage[]" value=""></td>
                        </tr>
                        <tr></tr>
						<?php } ?>
                    </table>
                    <h3 class="edu">Work Experience:</h3>
                    <table class="add_new_row remove_gray">
                        <tr></tr>
                        <tr><th></th>
                            <th>Company Names </th>
                            <th>Titles</th>
                            <th>Duration<input  type="button" class="add-row" value="+">
										<input  type="button" class="delete-row" value="-"></th>
                        </tr>
						<?php for($i=1; $i<=3; $i++) {  ?>
                        <tr><td><input type="checkbox" name="record"></td>
                            <td><input type="text" name="company_name[]"></td>
                            <td><input type="text" name="title[]"></td>
                            <td><input type="text" name="duration[]"></td>
                        </tr>
						<?php } ?>
                    </table>
                    <h3 class="edu">Skills:</h3>
                    <table>
                        <tr></tr>
                        <tr>
                            <th>Descriptions </th>
                            <th>Very Satisfactory</th>
                            <th>Satisfactory</th>
                            <th>Not Satisfactory</th>
                            <th>Not Applicable</th>
                        </tr>
						<?php
						$i= 1;
						foreach($skills_master as $row) {
						?>
						
						<tr class="tie">
                            <td><input type="text" name="skill_name[]" value="<?php echo  $row['name'] ?>"></td>
							
							<?php for($j=1; $j<= 4; $j++) { ?>
								<td><input type="radio" name="result[]<?php echo  $i ?>" value="<?php echo $j ?>"  ><?php // echo  $j ?><?php // echo  $row['name'] ?></td>
							<?php } ?>
						<?php
							$i++;	
						} ?>
					</table>
					
					<h3 class="edu">Language Skills:</h3>
                    <table class="table">
					
					 <colgroup>
						<col style="width:20%">
						<col style="width:20%">
						<col style="width:20%">
						<col style="width:20%">
						<col style="width:20%">
					</colgroup>
                        <tr></tr>
                        <tr>
                            <th>Descriptions </th>
                            <th>Very Good</th>
                            <th>Good</th>
                            <th>Average</th>
                            <th>Bad</th>
                        </tr>
                        
                        <tr>
                            <td>English</td>
                            <td><input type="radio" name="lang1" value="1"></td>
                            <td><input type="radio" name="lang1" value="2"></td>
                            <td><input type="radio" name="lang1" value="3"></td>
                            <td><input type="radio" name="lang1" value="4"></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td>Chinese</td>
                            <td><input type="radio" name="lang2" value="1"></td>
                            <td><input type="radio" name="lang2" value="2"></td>
                            <td><input type="radio" name="lang2" value="3"></td>
                            <td><input type="radio" name="lang2" value="4"></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <th> </th>
                            <th>Appearance/Personality</th>
                            <th></th>
                            <th>Commitment</th>
                            <th></th>
                        </tr>
                    </table>
					
                    <table class="table">
                        <tr></tr>
                        <tr>
                            <th>Descriptions</th>
                            <th>Yes/No</th>
							<th></th>
                            <th>Descriptions</th>
                            <th>Yes/No</th>
                        </tr>
                        <tr>
                            <td> Professional</td>
                            <td><input type="text" name="prof"></td>
							<td></td>
                            <td>Enthusiastic</td>
							 <td><input type="text" name="enthu"></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td>Neatly</td>
                            <td><input type="text" name="neat"></td>
							<td></td>
                            <td>Energetics</td>
							 <td><input type="text" name="energy"></td>
                           
                        </tr>
                        <tr></tr>
                        <tr>
                            <td> Respectful</td>
                            <td><input type="text" name="respect"></td>
							<td></td>
                            <td>Willingness</td>
							 <td><input type="text" name="willing"></td>
                        </tr>
                        <tr>
                            <th>Current Salary:</th>
                            <th><input type="text" name="current_salary"></th>
                            <th></th>
                            <th>Expected Salary:</th>
                            <th><input type="text" name="expected_salary"></th>
                        </tr>
                    </table>
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
                    </table>
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