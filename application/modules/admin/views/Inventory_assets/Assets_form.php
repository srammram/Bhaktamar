<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js"></script>
<script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-select.min.js"></script>

 <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Inventory/Assets_Form') ?>"> <?php echo lang('Assets')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>
<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/Inventory/Assets_Form/'.$id); ?>" enctype="multipart/form-data">	
				 <div class="form-group">
               <label for="Assets_no"><span class="errorStar">*</span><?php echo lang('Assets_no')?> :</label>
                 <input type="text" name="Assets_no" value="<?php  if(isset($Assets_no)){ echo $Assets_no ;  } ?>"  class="form-control allownumber" />
              </div>
				 <div class="form-group">
            <label for="Assets_name"><span class="errorStar">*</span><?php echo lang('Assets_name')?> :</label>
            <input type="text" name="Assets_name" value="<?php   if(isset($Assets_name)){ echo $Assets_name ;  } ?>"  class="form-control " />
          </div>
			<div class="form-group">
        <label for="Facility_Name"><span class="errorStar">*</span><?php echo lang('Facility_Name')?> :</label>
			 <select class="form-control chosen"     name="Facility_Name">
			    <option>Select ..</option>
				<?php     if(isset($Get_Facility)){ foreach($Get_Facility as $new){ ?>
				<option value="<?php echo $new->Fac_id  ; ?>"<?php  if(isset($Facility_name)){ echo $Facility_name ==  $new->Fac_id  ?'selected':'' ;  } ?>><?php  echo $new->Facility_name ;  ?></option>
				<?php }  }					   ?>
			
        </select>      
				 </div>
          <div class="form-group">
            <label for="Assets_category"><span class="errorStar">*</span><?php echo lang('Assets_category')?> :</label>
            <input type="text" name="Assets_category" value="<?php  if(isset($Assets_category)){ echo $Assets_category ;  } ?>"  class="form-control " />
          </div>
		 <div class="form-group">
            <label for="Assets_date"><span class="errorStar">*</span><?php echo lang('Assets_date')?> :</label>
            <input type="text" name="Assets_date" value="<?php  if(isset($Assets_date)){ echo $Assets_date ;  } ?>"  class="form-control datepicker" onkeydown="return false" />
          </div>
		  <div class="form-group">
            <label for="Assest_cost"><span class="errorStar">*</span><?php echo lang('Assest_cost')?> :</label>
            <input type="text" name="Assest_cost" value="<?php   if(isset($Assest_cost)){ echo $Assest_cost ;  } ?>"  class="form-control allowdecimalpoint" />
          </div>
		 <div class="form-group">
        <label for="employee"><span class="errorStar">*</span><?php echo lang('employee')?> :</label>
			 <select class="form-control chosen"     name="employee">
			    <option>Select ..</option>
				<?php     if(isset($employee)){ foreach($employee as $new){ ?>
				<option value="<?php echo $new->id  ; ?>"<?php  if(isset($employee_id)){ echo $employee_id ==  $new->id  ?'selected':'' ;  } ?>><?php  echo $new->first_name ;  ?></option>
				<?php }  }					   ?>
				
        </select>      
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
	
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>