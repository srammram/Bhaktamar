 <!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo $page_title;  ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard')?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
       
        <li class="active"><?php echo $page_title; ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
					<?php echo $page_title;  ?>
                    </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				<form method="post" action="<?php echo site_url('admin/Parking/form/'.$id); ?>" enctype="multipart/form-data">	
                    <div class="box-body">
                       <div class="form-group">
					  <div class="row">
						<div class="col-md-6">
                      		<label><?php echo lang('Slot_no')?></label>
                      		 <input type="text" name="slotno" value="<?php  if(isset($Slot_No)){ echo $Slot_No ;  } ?>"  class="form-control " />
						</div>	
					  	<div class="col-md-6">
                      		<label><?php echo lang('project')?></label>
                      	<select name="project_id" id="projectid" class="form-control "
                         onchange="get_buildings(this.value)" style="width:100%;">
                              <option value="">Please Select </option>
                                       <?php if(isset($project)){ foreach($project as $item) {		 ?>
                                       <option value="<?php  echo $item->id ?>"
                                        <?php echo set_select('project_id',$item->id, ( !empty($project_id) && $project_id == $item->id ? TRUE : FALSE )); ?>><?php echo $item->Name  ?></option>
                                         <?php } }    ?>
                                    </select>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-6">
                      		<label><?php echo lang('building')?></label>
							    <select name="building_id" class="form-control" id="building"
                                    onchange="get_buildingfloors(this.value)">
                                    <option value="">Please Select </option>
                                    <?php if(isset($building)){ foreach($building as $item) {		 ?>
                                    <option value="<?php  echo $item->bldid ?>"
                                        <?php  if(isset($building_id)){ echo $building_id == $item->bldid ?'selected':'' ;  } ?>>
                                        <?php echo $item->name  ?></option>
                                    <?php } }    ?>
                                </select>
                      	
						</div>
						<div class="col-md-6">
                      		<label><?php echo lang('floors')?></label>
                      	  <select name="floorid" class="form-control" id="floor"
                                    onchange="get_floorunit(this.value)">
                                    <option value="">Please Select </option>
                                    <?php if(isset($floor)){ foreach($floor as $item) {		 ?>
                                    <option value="<?php  echo $item->id ?>"
                                        <?php  if(isset($floor_id)){ echo $floor_id == $item->id ?'selected':'' ;  } ?>>
                                        <?php echo $item->name  ?></option>
                                    <?php } }    ?>
                                </select>
						</div>		
					  </div>		
                    </div>
						
					<div class="form-group">
					  <div class="row">
						<div class="col-md-6">
                      		<label><?php echo lang('unit')?></label>
                      		 <select name="unitid" class="form-control" id="units">
                                    <option value="">Please Select </option>
                                    <?php if(isset($units)){ foreach($units as $item) {		 ?>
                                    <option value="<?php  echo $item->uid ?>"
                                        <?php  if(isset($unit_id)){ echo $unit_id == $item->uid ?'selected':'' ;  } ?>>
                                        <?php echo $item->unit_name  ?></option>
                                    <?php } }    ?>
                                </select>
						</div>
						<div class="col-md-6">
                      		<label><?php echo lang('size') ?></label>
                      		 <input type="text" name="size" value="<?php  if(isset($size)){ echo $size ;  } ?>"  class="form-control " />
						</div>		
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-6">
					   	<label><?php echo lang('description') ?></label>
                         <input type="text" name="description" value="<?php  if(isset($description)){ echo $description ;  } ?>"  class="form-control " />
						</div>
					  </div>		
                    </div>
				
                    </div><!-- /.box-body -->
    				 <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
             <?php form_close()?>
            </div><!-- /.box -->
        </div>
     </div>
</section>  