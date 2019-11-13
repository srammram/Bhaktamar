<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">  <?php  $seg= $this->uri->segment(4);?>
	
	<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
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
  }
  </style>
  <?php  $seg= $this->uri->segment(4);?>
   <section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Accounts') ?>"> <?php echo lang('Accounts')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
	</section>
       <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/Accounts/form/'.$id); ?>" enctype="multipart/form-data">	
		  <div class="box-body">
		  
          <div class="form-group">
            <label for="Billtype"> <span style="color:red;">*</span><?php echo lang('Billtype'); ?> :</label>
            <select class="form-control Billtype" name="Billtype">
		     <option ><?php echo lang('select');  ?></option>
			 <option value="1" <?php if(!empty($bill_type)) echo $bill_type == 1 ? 'selected':''   ?>><?php echo lang('Facility_type');  ?></option>
			 <option value="2" <?php if(!empty($bill_type)) echo $bill_type == 2 ? 'selected':''   ?>><?php echo lang('Services_type');  ?></option>
		     <option value="3" <?php if(!empty($bill_type)) echo $bill_type == 3 ? 'selected':''   ?>><?php echo lang('Other_type');  ?></option>
		  
		   </select>
          </div>
          <div class="form-group">
            <label for="Billtype_cat"> <span style="color:red;">*</span><?php echo lang('Billtype_cat'); ?> :</label>
            <select class="form-control Billtype_cat" name="Billtype_cat" value="">
		
		   </select>
          </div>
		  <div class="form-group">
            <label for="Billfor"> <span style="color:red;">*</span><?php echo lang('Billfor'); ?> :</label>
	
            <select class="form-control" name="Billfor">
			<option>Please Select </option>
		   <?php  if(isset($Owners))
		   {
			   foreach($Owners as $Owner)
			   {
				   ?>
				   <option value="<?php echo $Owner->ownid;  ?>" <?php if(!empty($Owner_id)) echo $Owner_id == $Owner->ownid ? 'selected':''   ?>><?php echo $Owner->o_name;  ?></option>
				   <?php
			   }
		   }
		?>
		   </select>
          </div>
		   <div class="form-group">
            <label for="Issue_date"> <span style="color:red;">*</span><?php echo lang('Issue_date'); ?> :</label>
         <input type="date" name="Issue_date" class="form-control datepicker" value="<?php if(isset($Issued_date)){ echo $Issued_date; } ?>">
          </div>
		  <div class="form-group">
            <label for="Bill_Date"> <span style="color:red;">*</span><?php echo lang('Bill_Date'); ?> :</label>
         <input type="date" name="Bill_Date"class="form-control datepicker" value="<?php if(isset($bill_date)){ echo $bill_date; } ?>">
          </div>
		  
		  
		  <div class="form-group">
            <label for="Total_amount"> <span style="color:red;">*</span><?php echo lang('Total_amount'); ?> :</label>
           <input type="text" class="form-control" name="Total_amount" value="<?php if(isset($total_amount)){ echo $total_amount; } ?>">
          </div>
		  
		    <div class="form-group">
            <label for="Details"> <span style="color:red;">*</span><?php echo lang('Details'); ?> :</label>
            <textarea name="Details"  class="form-control"><?php if(isset($bill_details)){ echo $bill_details; } ?></textarea>
          </div>
		    <div class="form-group">
		
            <label for="Paid_status"> <span style="color:red;">*</span><?php echo lang('Paid_status'); ?> :</label>
            <select class="form-control" name="Paid_status">
			<option>Please Select </option>
		 
				   <option value="<?php echo lang('Paid_paid');  ?>" <?php if(!empty($Paid_Status)) echo $Paid_Status ==    lang('Paid_paid') ? 'selected':''   ?>><?php echo lang('Paid_paid');  ?></option>
				    <option value="<?php echo lang('Paid_Unpaid');  ?>" <?php if(!empty($Paid_Status)) echo $Paid_Status ==    lang('Paid_Unpaid') ? 'selected':''   ?>><?php echo lang('Paid_Unpaid');  ?></option>
					 <option value="<?php echo lang('Paid_Hold');  ?>" <?php if(!empty($Paid_Status)) echo $Paid_Status ==    lang('Paid_Hold') ? 'selected':''   ?>><?php echo lang('Paid_Hold');  ?></option>
				   
				
		   </select>
          </div>
           </div>			
			<div class="box-footer">
			<input type="hidden" name="ids" value="<?php if(isset($bill_id)){ echo $bill_id; } ?>"  >
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
 $('.Billtype').change(function(){
	  var c_id	=	$(this).val();
	  if(c_id){
		
		  $.ajax({
			url: '<?php echo site_url('admin/Accounts/getbilltype') ?>',
			type:'POST',
			data:{type:c_id},
			success:function(result){
				
				$('.Billtype_cat').html(result);
				
			 }
		  });
	  }  
	});
 </script>
 