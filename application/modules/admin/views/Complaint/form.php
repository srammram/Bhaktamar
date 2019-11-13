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
			<li><a href="<?php echo site_url('admin/Complaint') ?>"> <?php echo lang('Complaint')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
	</section>
      <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/Complaint/form/'.$id); ?>" enctype="multipart/form-data">	
		  <div class="box-body">
          <div class="form-group">
            <label for="txtCTitle"> <span style="color:red;">*</span><?php echo lang('Complaint_title'); ?> :</label>
            <input type="text" name="txtCTitle" value="<?php if(isset($c_title)){ echo $c_title; } ?>" id="txtCTitle" class="form-control" />
          </div>
		  <div class="form-group">
            <label for="types"> <span style="color:red;">*</span><?php echo lang('Complaint_type'); ?> :</label>
           <select class="form-control complainttypes" name="types">
		     <option ><?php echo lang('select');  ?></option>
		   <option value="1" <?php if(!empty($Complaint_type)) echo $Complaint_type == 1 ? 'selected':''   ?>><?php echo lang('Drop_amenities');  ?></option>
		     <option value="2" <?php if(!empty($Complaint_type)) echo $Complaint_type == 2 ?'selected':''  ?>><?php echo lang('Drop_Services'); ?></option>
			   <option value="3" <?php if(!empty($Complaint_type)) echo $Complaint_type == 3 ? 'selected':''   ?>><?php echo lang('Drop_Others');  ?></option>
		   </select>
          </div>
       
		<div class="form-group">
            <label for="category"> <span style="color:red;">*</span><?php echo lang('Category_type'); ?> :</label>
           <select class="form-control category" name="category">
		   <?php   
		   if(isset($Type_categorysDrop)){
			   foreach($Type_categorysDrop as $item){
				  ?> 
				  <option value="<?php echo $item->id ?>"<?php if(!empty($Complaint_type)) echo $Complaint_type == 1 ? 'selected':''   ?>><?php echo $item->Name  ?></option>
				  
		   <?php		   
			   }
		   }			   
		   ?>
		   </select>
          </div>
        
		  <div class="form-group">
            <label for="txtCDescription"> <span style="color:red;">*</span><?php echo lang('Complaint_by'); ?> :</label><br>
            <select class="form-control"  id="my-select"    name="Complaintby">
					<?php  
					if(isset($Units))
					{
						 foreach($Units as $Unit){ 
						// $selected = in_array($Unit->uid, $Owner_ids ) ? ' selected="selected" ' : ''; 
						 ?>
						 <option value="<?php  echo $Unit->uid;  ?>"<?php if(!empty($Unit_id)) echo $Unit_id == $Unit->uid ? 'selected':''   ?>><?php  echo $Unit->unit_no;  ?></option>
						 <?php
					}  
					}
					?>
					<Option value="Others">Others</option>
                 </select>
          </div>
		  
          <div class="form-group">
            <label for="txtCDescription"> <span style="color:red;">*</span><?php echo lang('Complaint_desc'); ?> :</label>
            <textarea name="txtCDescription" id="txtCDescription" class="form-control"><?php if(isset($c_description)){ echo $c_description; } ?></textarea>
          </div>
          <div class="form-group">
            <label for="txtCDate"> <span style="color:red;">*</span><?php echo lang('Complaint_date'); ?> :</label>
            <input type="text" name="txtCDate" value="<?php if(isset($c_date)){ echo $c_date; } ?>" id="txtCDate" class="form-control datepicker"/>
			
          </div>
		   <div class="form-group">
            <label for="txtCDate"> <span style="color:red;">*</span><?php echo lang('complaint_status'); ?> :</label>
           <select class="form-control" name="status">
		     <option ><?php echo lang('select');  ?></option>
		   <option value="<?php echo lang('Initiated'); ?>" <?php if(!empty($Complaint_status)) echo $Complaint_status ==    lang('Initiated') ? 'selected':''   ?>><?php echo lang('Initiated');  ?></option>
		     <option value="<?php echo lang('Inprogress'); ?>" <?php if(!empty($Complaint_status)) echo $Complaint_status == lang('Inprogress') ?'selected':''  ?>><?php echo lang('Inprogress'); ?></option>
			  <option value="<?php echo lang('Accepted'); ?>" <?php if(!empty($Complaint_status)) echo $Complaint_status == lang('Accepted') ?'selected':''  ?>><?php echo lang('Accepted'); ?></option>
			   <option value="<?php echo lang('ReInitiated'); ?>" <?php if(!empty($Complaint_status)) echo $Complaint_status == lang('ReInitiated') ?'selected':''  ?>><?php echo lang('ReInitiated'); ?></option>
			    <option value="<?php echo lang('Completed'); ?>" <?php if(!empty($Complaint_status)) echo $Complaint_status == lang('Completed') ?'selected':''  ?>><?php echo lang('Completed'); ?></option>
		   </select>
		   <input type="hidden" name="ids" value="<?php if(isset($complain_id)){ echo $complain_id; }  ?>">
          </div>
		   <div class="form-group">
            <label for="txtCDate"> <span style="color:red;">*</span><?php echo lang('AssignedTo'); ?> :</label>
           <select class="form-control" name="Assignto">
		     <option ><?php echo lang('select');  ?></option>
			 <?php if(isset($employes)){
				 foreach($employes as $employee){   
			 ?>
			 <option value="<?php echo $employee->id; ?>"
			 <?php if(!empty($Assign_to)) 
				 echo $Assign_to == $employee->id ?'selected':''  ?>><?php echo $employee->firstname;  ?></option>
			 <?php
			 }
			 }
			 ?>
		   </select>
		  
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
 $(".complainttypes").on('change',function() {   
 
    var val = $(this).val();
     if(val){
	 	$.ajax({
		url: '<?php echo site_url('admin/Complaint/Get_types') ?>',
		type:'POST',
		data:{id:val},
		success:function(result){
		  $('.category').html(result);
		}
	  });
	 }     
}); 
	
 </script>
