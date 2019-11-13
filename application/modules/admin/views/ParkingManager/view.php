<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/ParkingManager') ?>"><?php echo lang('Parking_Manager')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('Parking_Manager')?></li>
          </ol>
</section>
<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Slot_no')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Parkmanager->Slot_No ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Slot_type')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Parkmanager->Slot_Type ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('SlotOwnerName')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Parkmanager->full_name?>
						</div>	
					  </div>		
                    </div>
						<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Vechile_number')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Parkmanager->Vechile_number?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Assign_status')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Parkmanager->Assign_status?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Vechile_Status')?></label>
                      	</div>
						<div class="col-md-6">
						<?php echo $Parkmanager->STATUS?>
						</div>	
					  </div>		
                    </div>
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
