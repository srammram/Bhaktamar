<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
       <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-3.3.2.min.js" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<style>
.error{
    color: #FF0000;
}
.content-header .breadcrumb{ margin-bottom: 0px;background-color: transparent;}
	.content-header h3{margin: 0px;}
	fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
		border: 1px solid;
    }
</style>    
  <?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
	 <div class="row">
		<div class="col-md-6">
<!--			<h3>Application | Booking Form</h3>-->
		</div>
		<div class="col-md-6">
		  <ol class="breadcrumb pull-right">
			<li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/sales/Sales/Agentform') ?>"> <?php echo lang('Agent')?> </a></li>
			<li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
		  </ol>
		</div>
	 </div>
</section>
	<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  	 <div class="box-header">
                  <h3 class="box-title">Application | Booking Form</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	<form method="post" action="<?php echo site_url('admin/sales/Sales/Agentform/'.$agentid); ?>" enctype="multipart/form-data" id="enquiryform">	
                	
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">Form</legend>
					<div class="row">
                		<div class="form-group col-md-4">
							<label>Date</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group col-md-4 col-md-offset-4">
							<label>Serial No</label>
							<input type="text" class="form-control">
						</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Applicant Name</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Address</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Pincode</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Contact No</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Whats app</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Email id</label>
                			<input type="email" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Occupation</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Organization</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Desigantion</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>D.O.B (Age)</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Anniversary</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Pan No</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Aadhar No</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
					</fieldset>
				<fieldset class="scheduler-border" style="padding-top:1.4em !important">
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Co-Applicant's Name</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Relationship</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Contact No</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Email id</label>
                			<input type="email" class="form-control">
                		</div>
                		
                	</div>
                	
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Occupation</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Organization</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Desigantion</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>D.O.B (Age)</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Anniversary</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Pan No</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Aadhar No</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
					</fieldset>
					<fieldset class="scheduler-border">
					<legend class="scheduler-border">Booking Details(For office use only</legend>
					<div class="row">
                		<div class="form-group col-md-3">
							<label>Wing No</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group col-md-3">
							<label>Floor</label>
							<input type="text" class="form-control">
						</div>
               			<div class="form-group col-md-6">
							<label>Shop/Flat No</label>
							<input type="text" class="form-control">
						</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Applicant Name</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Address</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Pincode</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Contact No</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Whats app</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Email id</label>
                			<input type="email" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Occupation</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Organization</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Desigantion</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>D.O.B (Age)</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Anniversary</label>
                			<input type="text" class="form-control">
                		</div>
                		<div class="form-group col-md-6">
                			<label>Pan No</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
                	<div class="row">
                		<div class="form-group col-md-6">
                			<label>Aadhar No</label>
                			<input type="text" class="form-control">
                		</div>
                	</div>
					</fieldset>
					</form>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        <script src="<?php echo base_url('assets/plugin/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>				
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>
<script>

 $(function() {
 $('.datepicker').datepicker({
      	todayHighlight: true,
		autoclose: true,
	   format: 'yyyy-mm-dd',
    });
 	$('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
     });
	      });
</script>
<script>

$('input[type="checkbox"]').on('change', function() {
   $('input[type="checkbox"]').not(this).prop('checked', false);
});
</script>
<script type="text/javascript">
 $(document).ready(function() {
    $('#my-select').multiselect();
  });
 </script>