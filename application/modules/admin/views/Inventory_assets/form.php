<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/datepicker3.css">     
  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Inventory') ?>"> <?php echo lang('Inventory')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>


    <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/Inventory/form/'.$id); ?>" enctype="multipart/form-data">	
				<div class="form-group">
            <label for="Inv_name"><span class="errorStar">*</span><?php echo lang('Inv_name')?> :</label>
            <input type="text" name="Inv_name" value="<?php  if(isset($Name)){ echo $Name ;  } ?>"  class="form-control " />
          </div>
		  <div class="form-group">
            <label for="Quantity"><span class="errorStar">*</span><?php echo lang('Quantity')?> :</label>
            <input type="text" name="Quantity" value="<?php  if(isset($Quantity)){ echo $Quantity ;  } ?>"  class="form-control allownumber" />
          </div>
		  <div class="form-group">
            <label for="Unit"><span class="errorStar">*</span>unit:</label>
            <input type="text" name="Unit" value="<?php  if(isset($unit)){ echo $unit ;  } ?>"  class="form-control " />
          </div>
		  	<div class="form-group">
                <label for="Current_status"><span class="errorStar">*</span>Status :</label>
			 <select class="form-control"     name="Current_status">
			    <option>Select ..</option>
				<option value="<?php echo lang('IN_use')   ?>"<?php  if(isset($Current_status)){ echo $Current_status ==  lang('IN_use') ?'selected':'' ;  } ?>><?php echo  lang('IN_use')   ?></option>
				
				<option value="<?php echo lang('damaged')   ?>"<?php  if(isset($Current_status)){ echo $Current_status ==  lang('damaged') ?'selected':'' ;  } ?>><?php echo lang('damaged')   ?></option>
				
					<option value="<?php echo lang('Not_Available')   ?>"<?php  if(isset($Current_status)){ echo $Current_status ==  lang('Not_Available') ?'selected':'' ;  } ?>><?php echo lang('Not_Available')   ?></option>
					
						<option value="<?php echo lang('Not_use')   ?>"<?php  if(isset($Current_status)){ echo $Current_status ==  lang('Not_use') ?'selected':'' ;  } ?>><?php echo lang('Not_use')   ?></option>
				<option value="<?php echo lang('Others')   ?>"<?php  if(isset($Current_status)){ echo $Current_status ==  lang('Others') ?'selected':'' ;  } ?>><?php echo lang('Others')   ?></option>        
				</select>      
				 </div>
				  <div class="form-group">
            <label for="Inventory_date"><span class="errorStar">*</span><?php echo lang('Inventory_date')?> :</label>
            <input type="text" name="Inventory_date" value="<?php  if(isset($Inventory_date)){ echo $Inventory_date ;  } ?>"  class="form-control datepicker" onkeydown="return false"  />
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
		
		
		
 <script>
 $(function() {
 $('.datepicker').datepicker({
      	todayHighlight: true,
		autoclose: true,
	   format: 'yyyy-mm-dd',
    });
 
	      });
 </script>