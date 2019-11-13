<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">  <?php  $seg= $this->uri->segment(4);?>
	
	<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
   
        <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
        <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
  <style>

  </style>
  <?php  $seg= $this->uri->segment(4);?>
   <section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Fund') ?>"> <?php echo lang('Fund')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
	</section>
      <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/Fund/form/'.$id); ?>" enctype="multipart/form-data">	
		  <div class="box-body">
          <div class="form-group">
            <label for="ddlOwnerName"><?php echo lang('Owner_Name')?> :</label>
            <select name="ddlOwnerName" id="ddlOwnerName" class="form-control">
              <option value=""><?php echo lang('select');  ?></option>
			  <?php  
			  if(isset($Owners)){ foreach($Owners as $Owner)
				  {
			  ?>
			  <option value="<?php echo $Owner->ownid ; ?>" <?php if(!empty($owner_id)) echo $owner_id == $Owner->ownid ?'selected':''  ?> ><?php echo $Owner->full_name ; ?></option>
			  
			  <?php
				  }
			  }
			  ?>
            </select>
          </div>
          <div class="form-group">
            <label for="ddlMonth"><?php echo lang('Month')?>:</label>
               <input type="text" name="month" value="<?php if(isset($For_Months)){ echo date('Y-m',strtotime($For_Months)); } ?>" id="txtCDate" class="form-control datepicker1" />
          </div>
          <div class="form-group">
            <label for="txtDate"><?php echo lang('Fund_date')?>:</label>
            <input type="text" name="txtDate" value="<?php if(isset($f_date)){ echo $f_date; } ?>" id="txtDate" class="form-control datepicker"/>
          </div>
          <div class="form-group">
            <label for="txtTotalAmount"> <?php echo lang('Total_amount')?>:</label>
            <div class="input-group">
              <input type="text" name="txtTotalAmount" value="<?php if(isset($total_amount)){ echo $total_amount; } ?>" id="txtTotalAmount" class="form-control" />
              <div class="input-group-addon"> </div>
            </div>
          </div>
          <div class="form-group">
            <label for="txtPurpose"><?php echo lang('Fund_purpose')?>:</label>
            <textarea name="txtPurpose" id="txtPurpose" class="form-control"><?php if(isset($purpose)){ echo $purpose; } ?></textarea>
			<input type="hidden" name="ids" value="<?php if(isset($fund_id)){ echo $fund_id; } ?>">
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
	$('.datepicker1').datepicker({
      	todayHighlight: true,
		autoclose: true,
	   format: 'yyyy-mm',
    });
 	$('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
     });
	      });
 </script>
