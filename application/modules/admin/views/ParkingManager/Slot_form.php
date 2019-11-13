  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/ParkingManager') ?>"> <?php echo lang('Slot')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>


<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/ParkingManager/Slot_Form/'.$id); ?>" enctype="multipart/form-data">	
				 <div class="form-group">
               <label for="Slotno"><span class="errorStar">*</span><?php echo lang('Slot_no')?> :</label>
                 <input type="text" name="Slotno" value="<?php  if(isset($Slot_No)){ echo $Slot_No ;  } ?>"  class="form-control allownumber" />
              </div>
				
			<div class="form-group">
                <label for="type"><span class="errorStar">*</span><?php echo lang('Slot_type')?> :</label>
			 <select class="form-control"     name="Type">
			    <option>Select ..</option>
				<option value="<?php echo lang('Visitor')   ?> "<?php  if(isset($Slot_Type)){ echo $Slot_Type ==  lang('Visitor') ?'selected':'' ;  } ?>><?php echo  lang('Visitor')   ?></option>
				<option value="<?php echo lang('Owners')   ?> "<?php  if(isset($Slot_Type)){ echo $Slot_Type ==  lang('Owners') ?'selected':'' ;  } ?>><?php echo lang('Owners')   ?></option>
				<option value="<?php echo lang('Others')   ?> "<?php  if(isset($Slot_Type)){ echo $Slot_Type ==  lang('Others') ?'selected':'' ;  } ?>><?php echo lang('Others')   ?></option>
				
                 </select>      
				 </div>
          <div class="form-group">
            <label for="Comments"><span class="errorStar">*</span><?php echo lang('Comments')?> :</label>
            <input type="text" name="Comments" value="<?php  if(isset($Comments)){ echo $Comments ;  } ?>"  class="form-control " />
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
