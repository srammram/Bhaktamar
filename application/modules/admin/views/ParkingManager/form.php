  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/ParkingManager') ?>"> <?php echo lang('Parking_Manager')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>


    <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/ParkingManager/form/'.$id); ?>" enctype="multipart/form-data">	
		       <div class="form-group">
		
               <label for="Slotno"><span class="errorStar">*</span><?php echo lang('Slot_no')?> :</label>
                <select class="form-control"     name="Slotno">
			    <option>Select ..</option>
				<?php    if(isset($Slots) || empty($Slots)){
					foreach($Slots as $new){
				?>
				<option value="<?php echo $new->id ;  ?>"<?php  if(isset($Slot_No)){ echo $Slot_No ==  $new->id ?'selected':'' ;  } ?>><?php echo $new->Slot_No ;  ?></option>
				<?php
					}
					}
					else
					{
						
						echo '<option>Slot Not Available</option>';
					}
				?>			
                				
                 </select>      
              </div>
			<div class="form-group">
                <label for="Owner"><span class="errorStar">*</span><?php echo lang('Owners')?> :</label>
				
			 <select class="form-control"     name="Owner">
			    <option>Select ..</option>
				<?php    if(isset($Owner)){
					foreach($Owner as $new){
				?>
				<option value="<?php echo $new->ownid ;  ?>"<?php  if(isset($OwnerName)){ echo $OwnerName ==  $new->ownid ?'selected':'' ;  } ?>><?php echo $new->full_name ;  ?></option>
				<?php
					}
					}
				?>			
                  <option value="<?php echo lang('Others');  ?>"><?php echo lang('Others');  ?></option>				
                 </select>      
				 </div>
          <div class="form-group">
            <label for="Vechilenumber"><span class="errorStar">*</span><?php echo lang('Vechile_number')?> :</label>
            <input type="text" name="Vechile_number" value="<?php  if(isset($Vechile_number)){ echo $Vechile_number ;  } ?>"  class="form-control " />
          </div>
		  	<div class="form-group">
                <label for="AssignStatus"><span class="errorStar">*</span><?php echo lang('Assign_status')?> :</label>
			 <select class="form-control"     name="AssignStatus">
			    <option>Select ..</option>
				<option value="<?php echo lang('P_permanent')   ?>"<?php  if(isset($Assign_status)){ echo $Assign_status ==  lang('P_permanent') ?'selected':'' ;  } ?>><?php echo  lang('P_permanent')   ?></option>
				<option value="<?php echo lang('P_temporary')   ?>"<?php  if(isset($Assign_status)){ echo $Assign_status ==  lang('P_temporary') ?'selected':'' ;  } ?>><?php echo lang('P_temporary')   ?></option>
				<option value="<?php echo lang('Others')   ?>"<?php  if(isset($Assign_status)){ echo $Assign_status ==  lang('Others') ?'selected':'' ;  } ?>><?php echo lang('Others')   ?></option>        
				</select>      
				 </div>
				 	<div class="form-group">
                <label for="Vechile_status"><span class="errorStar">*</span><?php echo lang('Vechile_Status')?> :</label>
			
			 <select class="form-control"     name="Vechile_status">
			    <option>Select ..</option>
				<option value="<?php echo lang('P_Available')   ?>"<?php  if(isset($Status)){ echo $Status ==  lang('P_Available') ?'selected':'' ;  } ?>><?php echo  lang('P_Available')   ?></option>
				<option value="<?php echo lang('P_Not_avaialable')   ?>"<?php  if(isset($Status)){ echo $Status ==  lang('P_Not_avaialable') ?'selected':'' ;  } ?>><?php echo lang('P_Not_avaialable')   ?></option>
				<option value="<?php echo lang('Others')   ?>"<?php  if(isset($Status)){ echo $Status ==  lang('Others') ?'selected':'' ;  } ?>><?php echo lang('Others')   ?></option>				
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
