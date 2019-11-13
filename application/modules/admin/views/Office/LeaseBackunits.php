 
        <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
   
        <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
		<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">
<style>
  .btn-group
  {
	  width:100%;
  }
  .multiselect
    {
	  width:100%;
	  
  }
  .multiselect-container
  {
	width:100%;  
	height:100%;
	min-height:300px;
	overflow-y:scroll;
  }
  </style>
 <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Office') ?>"> <?php echo lang('LeaseOwner')?> </a></li>
            <li class="active">Book</li>
          </ol>
    </section>
     <section class="content">
    	 
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
					
				<form method="post" action="<?php echo site_url('admin/Office/bookingleaseunits/'.$id); ?>" enctype="multipart/form-data">	
					 <div class="box-body">
            <div class="form-group">
		  <label for="LeaseOwner"><span class="errorStar">*</span><?php echo lang('LeaseOwner')?>:</label>
             <select class="form-control "     name="LeaseOwner">
			 <option>Select </option>
		     			 <?php
						  foreach($leaseowner as $item){ 
						 ?>
						<option value="<?php echo $item->id ?>"<?php if(!empty($LeaseOwner_id)) echo $LeaseOwner_id == $item->id ?'selected':''  ?> ><?php echo $item->firstname ?></option>
					<?php 
						 }				
						 ?>
                 </select>
		  
		    </div>
           <div class="form-group">
	
		  <label for="Leaseunit"><span class="errorStar">*</span><?php echo lang('Unit')?>:</label>
             <select class="form-control "     name="Leaseunit">
			 <option>Select </option>
		     			 <?php
						  foreach($leaseunits as $item){ 
						 ?>
						<option value="<?php echo $item->uid ?>"<?php if(!empty($Unit_id)) echo $Unit_id == $item->uid ?'selected':''  ?> ><?php echo $item->unit_no ?></option>
					<?php 
						 }				
						 ?>
                 </select>
		  
		    </div>
			  <div class="form-group">
		  <label for="Leasetype"><span class="errorStar">*</span><?php echo lang('LeaseType')?>:</label>
             <select class="form-control "     name="Leasetype">
			 <option>Select </option>
		     		
						<option value="<?php echo lang('short_term')?>" <?php if(!empty($LeaseType)) echo $LeaseType == lang('short_term') ?'selected':''  ?>><?php echo lang('short_term')?></option>
						<option value="<?php echo lang('Long_term')?>" <?php if(!empty($LeaseType)) echo $LeaseType == lang('Long_term') ?'selected':''  ?>><?php echo lang('Long_term')?></option>
					
                 </select>
		  
		    </div>
        
          <div class="form-group">
            <label for="Startdate"><span class="errorStar">*</span><?php echo lang('StartDate')?>:</label>
            <input type="text" name="Startdate" value=" <?php if(isset($Startdate)){ echo $Startdate ; } ?>"  class="form-control datepicker" />
          </div>
          <div class="form-group">
            <label for="Enddate"><span class="errorStar">*</span><?php echo lang('EndDate')?> :</label>
             <input type="text" name="Enddate" value=" <?php if(isset($Enddate)){ echo $Enddate ; } ?>"  class="form-control datepicker" />
          </div>
 
          <div class="form-group">
            <label for="Comments"><span class="errorStar">*</span> <?php echo lang('Comments')?>:</label>
            <textarea name="Comments"  class="form-control"><?php if(isset($Comments)){ echo $Comments ; } ?></textarea>
          </div>
          <div class="form-group">
            <label for="leaseamount"><span class="errorStar">*</span><?php echo lang('Lease_amount')?>:</label>
            <input type="text" name="leaseamount" value="<?php if(isset($Advance_Amount)){ echo round($Advance_Amount,2) ; } ?>"  class="form-control" />
          </div>
		  <div class="form-group">
		  <label for="advance"><span class="errorStar">*</span><?php echo lang('LeaseAdvance')?>:</label>
      
            <input type="text" name="advance" value="<?php if(isset($Lease_amount)){ echo round( $Lease_amount,2) ; } ?>"  class="form-control" />
		  
		    </div>
		  
          </div>
       
			<div class="box-footer">
			
			<input class="btn btn-primary" type="submit" value="Save"/>
		     </div>
					</form>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
		<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
    $('#my-select').multiselect();
  });
 </script>
 

  <script>
	$('form').attr('autocomplete', 'off');
	</script>
<script>
	$(function() {
	$('.datepicker').datepicker({
	todayHighlight: true,
	autoclose: true,
	format: 'yyyy-mm-dd',
	});
	});
</script>
