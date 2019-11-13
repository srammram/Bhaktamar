<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/ParkingManager/Slot_list') ?>"><?php echo lang('Slot')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('floor')?></li>
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
                      		<label><?php echo lang('Assets_no')?></label>
                      	</div>
						<div class="col-md-6">
					
							<?php echo $assets->Assets_no ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Assets_name')?></label>
                      	</div>
						<div class="col-md-6">
							
							<?php  echo $assets->Assets_name ; ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Facility_Name')?></label>
                      	 </div>
						<div class="col-md-6">
							<?php echo $assets->Facility_name?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Assets_category')?></label>
                      	 </div>
						<div class="col-md-6">
							<?php echo $assets->Assets_category?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Assets_date')?></label>
                      	 </div>
						<div class="col-md-6">
							<?php echo $assets->Assets_date?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Assest_cost')?></label>
                      	 </div>
						<div class="col-md-6">
							<?php echo $assets->Assest_cost?>
						</div>	
					  </div>		
                    </div>
					
					     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
