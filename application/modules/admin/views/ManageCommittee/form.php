 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js"></script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
 <script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
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
        <section class="content-header">
          <h1>
        <?php echo lang('Management_committee')?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/ManageCommittee') ?>"> <?php echo lang('Management_committee')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
    </section>
	<br>
     <section class="content">
		  <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
					<?php echo lang('Add_Management_committee')?>
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				<form method="post" action="<?php echo site_url('admin/ManageCommittee/form/'.$id); ?>" enctype="multipart/form-data">	
					 <div class="box-body">
          <div class="form-group col-md-6">
            <label for="committee_name"><span class="errorStar">*</span><?php echo lang('Committe_name')?>:</label>
            <input type="text" name="Committe_name" value="<?php if(isset($mc_name)){ echo $mc_name ; } ?>" id="Committe_name" class="form-control" />
          </div>
		    <div class="form-group col-md-6">
            <label for="member"> <span style="color:red;">*</span><?php echo lang('Committe_Members'); ?> :</label><br>
            <select class="form-control my-select" multiple="multiple"     name="Members[]">
					<?php  
					if(isset($Owners)){
						 foreach($Owners as $Owner){  
						 $selected = in_array( $Owner->ownid, $mc_members ) ? ' selected="selected" ' : '';  
						 ?>
						 <option value="<?php  echo $Owner->ownid;  ?>"  <?php echo $selected; ?>><?php  echo $Owner->full_name;  ?></option>
						 <?php } } ?>
					<Option value="Others">Others</option>
                 </select>
          </div>
          <div class="form-group col-md-6">
            <label for="leader"><span class="errorStar">*</span><?php echo lang('Committe_Leader')?> :</label>
			 <select class="form-control"     name="Leader">
			 <option>Select ..</option>
					<?php  if(isset($Owners)){ foreach($Owners as $Owner){  ?>
						 <option value="<?php  echo $Owner->ownid;  ?> "<?php if(!empty($mc_Leader)) echo $mc_Leader == $Owner->ownid ? 'selected':''  ?>><?php  echo $Owner->full_name;  ?></option>
						 <?php } }  ?>
					<Option value="Others">Others</option>
                 </select>
           
          </div>
          <div class="form-group col-md-6">
            <label for="startdate"><span class="errorStar">*</span><?php echo lang('Committe_StartDate')?> :</label>
            <input type="text" name="startdate" value="<?php  if(isset($mc_start_date)){ echo $mc_start_date ;  } ?>"  class="form-control datepicker" onkeydown="return false"  />
          </div>
        
          <div class="form-group col-md-6">
            <label for="Rules"><span class="errorStar">*</span><?php echo lang('Committe_Rules')?> :</label>
            <textarea name="Rules" id="Rules" class="form-control"><?php  if(isset($mc_Rules)){ echo $mc_Rules ;  } ?></textarea>
          </div>
          </div>
			<div class="box-footer">
			 <input type="hidden" name="ids" value="<?php  if(isset($mc_id)){ echo $mc_id ;  } ?>" class="form-control" />
			<input class="btn btn-primary" type="submit" value="Save"/>
		     </div>
			 
					</form>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
 <script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
 <script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
 <script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>
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