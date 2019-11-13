  
  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Settings/Amenties') ?>"> <?php echo lang('Amenties')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>
     <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
			<form method="post" action="<?php echo site_url('admin/Settings/Amenitiesform/'.$id); ?>" enctype="multipart/form-data">	
			<div class="box-body">
			<div class="form-group">
            <label for="Name"><?php echo lang('Name')?><span class="errorStar">*</span></label>
            <input type="text" name="Name" value="<?php  if(isset($Name)){ echo $Name ;  } ?>" id="Name" class="form-control" />
          </div>
            <div class="form-group">
            <label for="Perperty_type"><?php echo lang('PropertyType')?></label><span class="errorStar">*</span></label>
            <select name="Perperty_type" id="Perperty_type" class="form-control">
              <option ><?php echo lang('select')?></option>
             <?php if(isset($propertytypes))
			 { foreach($propertytypes as $item) {		 ?>
				 <option value="<?php  echo $item->id ?>"<?php  if(isset($Perperty_type)){ echo $Perperty_type == $item->id ?'selected':'' ;  } ?> ><?php echo $item->ProjectType ?></option>
				 <?php
				 }
			 }    
				 ?>
            </select>
          </div>
		  <div class="form-group">
            <label for="AmenitiesType"><?php echo lang('AmenitiesType')?></label><span class="errorStar">*</span></label>
            <select name="AmenitiesType" id="AmenitiesType" class="form-control">
              <option ><?php echo lang('select')?></option>
            <option value="<?php echo lang('Indoor')  ?>"<?php  if(isset($AmenitiesType)){ echo $AmenitiesType == lang('Indoor')  ?'selected':'' ;  } ?>><?php echo lang('Indoor')  ?></option>
			     <option value="<?php echo lang('Outdoor')  ?>"<?php  if(isset($AmenitiesType)){ echo $AmenitiesType == lang('Outdoor')  ?'selected':'' ;  } ?>><?php echo lang('Outdoor')  ?></option>
            </select>
          </div>
		    <div class="form-group">
            <label for="AmenitiesPrice"><?php echo lang('AmenitiesPrice')?><span class="errorStar"></span></label>
            <input type="text" name="AmenitiesPrice" value="<?php  if(isset($AmenitiesPrice)){ echo $AmenitiesPrice ;  } ?>" id="AmenitiesPrice" class="form-control allowdecimalpoint" />
            </div>
		   <div class="form-group">
            <label for="Description"><?php echo lang('description')?><span class="errorStar">*</span></label>
            <input type="text" name="Description" value="<?php  if(isset($Description)){ echo $Description ;  } ?>" id="Description" class="form-control" />
			  <input type="hidden" name="ids" value="<?php  if(isset($id)){ echo $id ;  } ?>" class="form-control" />
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
<script>/* 
$(document).keypress(".digits",function (e) {
	  
     if (e.which != 8 && e.which != 46  && e.which != 0 && (e.which < 48 || e.which > 57) ) {
               return false;
    }
});
 */</script>