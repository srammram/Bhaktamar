<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!-- general form elements -->
	 <script src="<?php echo base_url();  ?>assets/js/jquery-printme.js"></script> 
	  <script src="<?php echo base_url();  ?>assets/js/jquery-printme.min.js"></script> 
<div class="box box-primary" xmlns="http://www.w3.org/1999/html">
    <div class="box-header with-border bg-primary-dark">
        <h3 class="box-title"><?= lang('termination_note') ?></h3>
		 <div class="box-tools" style="padding-top: 5px">
                     <div class="input-group input-group-sm" >
                        <a class="btn" style="color: #FFF" id="printButton">
                        <i class="fa fa-print fa-2x" aria-hidden="true"></i>
                        </a>
                     </div>
                  </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
 <?php
        if(!empty($employee->termination_note)){
            $termination =  json_decode($employee->termination_note);
			 $contact_details =  json_decode($employee->contact_details);
        }
        ?>
    <div class="box-body">
   		<div class="row">
   			<div class="col-sm-12 col-xs-12 text-center">
				<!-- 	<h3 style="text-align: center;font-weight:bold;">Termination Letter</h3> -->
				 <?php $company_logo = get_option('company_logo') ?>
			 <img height="180" width="180" src="<?php echo site_url(UPLOAD_LOGO.$company_logo)?>" class="img img-responsive center" style=" display: block;margin-left: auto;margin-right: auto;margin-top:24px;" >
   			</div>
   		     	<div class="col-sm-12 col-xs-12 company_address">
   				<h3 style="text-align: right;margin:0 0 0px;"><?php echo get_option('company_name'); ?></h3>
   				<p style="text-align: right;margin:0 0 0px;"><?php echo get_option('address'); ?></p>
   				<p style="text-align: right;margin:0 0 0px;"><?php echo get_option('city'); ?>-<?php echo get_option('postal_code'); ?></p>
   				<p style="text-align: right;margin:0 0 0px;"><i class="glyphicon glyphicon-envelope"></i>&nbsp;&nbsp;&nbsp;<?php echo get_option('email'); ?></p>
   				<p style="text-align: right;margin:0 0 0px;"><i class="glyphicon glyphicon-earphone"></i>&nbsp;&nbsp;&nbsp;<?php echo get_option('phone'); ?></p>
   				
   				<h5 style="text-align: right;"> <?php if(!empty($termination->termination_date)) echo  $termination->termination_date ; ?></h5>
   				<h3 style="text-align: left;"><?php if(!empty($employee_details->first_name)){ echo($employee_details->first_name); }?>&nbsp;<?php if(!empty($employee_details->last_name)){ echo($employee_details->last_name); }?></h3>
   				<p style="text-align: left;margin:0 0 0px;"><?php if(!empty($contact_details->city)){ echo($contact_details->city); }?></p>
				<p style="text-align: left;margin:0 0 0px;"><?php if(!empty($contact_details->state)){ echo($contact_details->state); }?></p>
   				<p style="text-align: left;margin:0 0 0px;"><?php if(!empty($employee_details->country)){ echo($employee_details->country); }?></p>
   				<h4 style="text-align: left;">Employee ID: <?php if(!empty($employee_details->employee_id)){ echo ($employee_details->employee_id); }?></h4>
   				
   				<h4 style="text-align: left;margin-top: 40px;">Dear <?php if(!empty($employee_details->first_name)){ echo($employee_details->first_name); }?>,</h4>
   				<p style="  text-indent: 50px;text-align: justify;"> <?php if(!empty($termination->termination_note)){ echo ($termination->termination_note); }?></p>
   				<h4 style="text-align: left;margin: 40px 0px;">Yours sincerely,</h4>
   				<h4 style="text-align: left;">Authorised Signatory</h4>
   				<h4 style="text-align: left;">HR Dept.</h4>
   				
   				
   			</div>
   		</div>
   	</div>
   </div>
  <br/>
  <br/>
  </div>
    <!-- /.box-body -->
    <div class="box-footer">
            <a  data-target="#modalSmall" data-placement="top" data-toggle="modal"
                href="<?php echo base_url()?>admin/employee/termination/<?php echo str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encrypt->encode($employee->id))?>" class="btn bg-olive btn-flat">
                <?= lang('edit') ?>
            </a>
    </div>
</div>
<!-- /.box -->
<script>   
$("#printButton").click(function(){
	$("div.box-body").printMe({
		"path" : ["<?php echo  base_url().'assets/css/example.css';?>"],			});
});

</script>
<script>
$('form').attr('autocomplete', 'off');
</script>