
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
        margin-top: 20px;
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

    input[type=checkbox],
    input[type=radio] {
        zoom: 1.7;
    }


    .ando {
        font-size: 15px;
        display: inline-block;
        margin-left: 21px;
        line-height: 15px;
        position: relative;
        top: -7px;
    }

    tr.tie td {
        border: 0px;
    }

    .border_bottom {
        display: inline-block;
        border-bottom: 1px solid #ddd !important;
    }
    </style>
</head>
<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!-- general form elements -->



<div class="box box-primary">
    <div class="box-header with-border bg-primary-dark">
        <h3 class="box-title"><?= lang('add_srrf') ?></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
	
	<?php
	/* echo '<pre>';
	print_r($employee_srrf);
	die; */
	?>

<?php echo form_open('admin/employee/save_employeeSRRF', $attribute= array('id' => 'ContactForm', 'class' => 'ContactForm') ) ?>
<input type="hidden" name="employee_id" value="<?php echo $employee->id ?>" >
    <div class="box-body" id="print-content">

        <div class="row">
            <div class="col-md-12">
		<section>
            <div class="title">
                <h3>STAFF RECRUITMENT REQUISITION FORM (SRRF)</h3>
            </div>
            <div class="candi">
                <h4>Instructions/Hiring Information :</h4>
                <p>Use this form to initiate the recruitment process for all new and existing staff. Please complete all applicable sections of this form. Contact Human Resource Person if you need any assistance. <b>NO OFFERS  should be made, either verbally or in written form, before all approvals on the form are completed.</b></p>
            </div>
            <hr>
            <h4>Position Requested</h4>
            <br>
            <div class="form_table">
                <div class="row im">
                    <div class="col-sm-2"><h4>Job Title : </h4>
                    </div>
                    <div class="col-sm-10"> <input type="text" name="job_title" value="<?php if($employee->title == '1'){ echo 'Development'; } ?>" ></div>
                </div>
            </div>
            <table>
                <tr class="tie">
                    <td><input type="radio" name="job_time" value="full_time"><span class=" ando">Full Time</span></td>
                    <td><input type="radio" name="job_time" value="part_time"><span class=" ando">Part Time </span></td>
                    <td><input type="radio" name="job_time" value="temp"><span class=" ando"> Temporary </span></td>
                    <td><input type="radio" name="job_time" value="other"><span class=" ando">Other </span></td>
                    <td><input class="border_bottom" type="text" name="other_job_time"></td>
                </tr>
            </table>
            <div class="form_table">
                <div class="row im">
                    <div class="col-sm-3"><h4>Anticipated Start Date: </h4>
                    </div>
                    <div class="col-sm-9"> <input type="date" name="anti_start_date"></div>
                </div>
            </div>
            <table>
                <tr class="tie">
                    <td><input type="radio" name="position" value="1"><span class=" ando">New Position</span></td>
                    <td><input type="radio" name="position" value="2"><span class=" ando">Replacement</span></td>
                    <td><input type="radio" name="position" value="3"><span class=" ando">Reorganization</span></td>
                </tr>
                <tr></tr>
                <tr class="tie">
                    <td><input type="radio" name="position" value="4"><span class=" ando">Internal Candidates</span></td>
                    <td><input type="radio" name="position" value="5"><span class=" ando">External Candidates</span></td>
                    <td><input type="radio" name="position" value="6"><span class=" ando">Internal and External Candidates </span></td>
                </tr>
            </table>
            <hr>
            <h4>Salary Information/Approval</h4>
            <div class="form_table">
                <div class="row im">
                    <div class="col-sm-3"><h5>Proposed Salary Range : </h5>
                    </div>
                    <div class="col-sm-9"> <input type="text" name="proposed_salary"></div>
                </div>
                <div class="row im">
                    <div class="col-sm-3"><h5>Manager Name </h5>
                    </div>
                    <div class="col-sm-9"> <input type="text" name="manager_submitting_request"></div>
                </div>
                <div class="row im">
                    <div class="col-sm-1"><h5>Phone:  </h5>
                    </div>
                    <div class="col-sm-5"> <input type="number" name="phone"></div>
                    <div class="col-sm-1"> <h5>Email :    </h5>
                    </div>
                    <div class="col-sm-5"> <input type="email" name="email"></div>
                </div>
				<!--
                <div class="row im">
                    <div class="col-sm-2"><h5>Manager's Signature   </h5>
                    </div>
                    <div class="col-sm-4"> <input type="text" name="manager_signature"></div>
                    <div class="col-sm-1"> <h5>Date :   </h5>
                    </div>
                    <div class="col-sm-5"> <input type="date" name="manager_signature_date"></div>
                </div>
                <div class="row im">
                    <div class="col-sm-1"><h5>Chairman/CEO   </h5>
                    </div>
                    <div class="col-sm-5"> <input type="text" name="ceo_signature"></div>
                    <div class="col-sm-1"> <h5>Date :   </h5>
                    </div>
                    <div class="col-sm-5"> <input type="date" name="ceo_signature_date"></div>
                </div> -->

            </div>
                <table>
                <tr class="tie">
                    <td>The request is :</td>
                    <td><input type="radio" name="request" value="1"><span class=" ando">APPROVED</span></td>
                    <td><input type="radio" name="request" value="2"><span class=" ando">NOT APPROVED </span></td>                
                    
                </tr>
            </table>
            <table class="table-responsive">
                        <tr>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                        </tr>
                    </table>
                    <textarea class="areas col-md-12 col-lg-12 col-sm-12" name="comments"></textarea>
					<!--
					
            <div class="table_content">
     
                <div class="form_table">
                    <div class="row im">
                        <div class="col-sm-3"><h5>Signature of Human Resources Person: </h5>
                        </div>
                        <div class="col-sm-5"> <input type="text" name="hr_signature"></div>
                        <div class="col-sm-1"> <h5>Date:</h5>
                        </div>
                        <div class="col-sm-3"> <input type="date" name="hr_signature_date"></div>
                    </div>
                   
                </div>
            </div> -->
			
			  <span class="required">All fields are mandatory</span> <?php // echo lang('required_field') ?>

        <input type="hidden" name="id" value="<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id)) ?>" >
        <?php if(!empty($login->id)): ?>
            <input type="hidden" name="login_id" value="<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($login->id)) ?>" >
        <?php endif ?>
		
		<input type="hidden" name="btn_type" value="add" />
			
			<div class="box-footer">
			
			 <!-- <a class="btn bg-navy btn-flat btn-md" id="editPersonal" ><i class="fa fa-pencil-square-o"></i> Edit</a>
			
        <button id="savePersonal" type="submit" class="btn bg-olive btn-flat" style="display: none;">Save</button>&nbsp;&nbsp;&nbsp;
        <a  class="btn bg-maroon btn-flat" id="cancelPersonal" style="display: none;" >Cancel</a> -->

        <button id="saveSalary" type="submit" class="btn bg-olive btn-flat"  > 
       <?php echo lang('save'); ?>
        </button>
		<input type="button" onclick="printDiv('print-content')"  class="btn bg-olive btn-flat" value="Print"/>

    </div>

    </section>
    </div>
            </div>
        </div>
		
	<?php echo form_close()?>	
		  </div>
            </div>
        </div>
</body>

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
</html>