<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Facility') ?>"><?php echo lang('Facility')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('Facility')?></li>
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
                      		<label><?php echo lang('Facility_name')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Facility->Facility_name; ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Charges')?></label>
                      	</div>
						<div class="col-md-6">
							<?php  echo $Facility->Charges;   ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Charges_per')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Facility->Charges_per ;  ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Status')?></label>
                      	</div>
						<div class="col-md-6">
							<?php if(isset($Facility->Status)){ 
			
                   switch($Facility->Status)
				   {
					 	   Case 'Available';
					    echo '<span style="padding:6px 18px 6px 18px;color:#fff;background-color:rgb(15,48,125);margin:0 auto;">'.$Facility->Status.'<span>';
					   break;
					     Case 'Open Shortly';
						 echo '<span style="padding:6px;color:#fff;background-color:#8e44ad;margin:0 auto;">'.$Facility->Status.'<span>';
					   break; 
					   Case 'Temporary Closed';
					   echo '<span style="padding:6px;color:#fff;background-color:#4B4E6D;margin:0 auto;">'.$Facility->Status.'<span>';
					   break;
					   Case 'Permanently Closed';
					   echo '<span style="padding:6px;color:#fff;background-color:#c0392b;margin:0 auto;">'.$Facility->Status.'<span>';
					   break;
					
				   }

			} ?>
						</div>	
					  </div>		
                    </div>
					
						<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Booking_status')?></label>
                      	</div>
						<div class="col-md-6">
							<?php if(isset($Facility->Booking_status)){ 
			
                   switch($Facility->Booking_status)
				   {
					   
					   
					      Case 'Available';
					    echo '<span style="padding:6px 18px 6px 18px;color:#fff;background-color:rgb(15,48,125);margin:0 auto;">'.$Facility->Booking_status.'<span>';
					   break;
					     Case 'Not Available';
						 echo '<span style="padding:6px;color:#fff;background-color:#c0392b;margin:0 auto;">'.$Facility->Booking_status.'<span>';
					   break;   
					   
					   
				
					   
				   }

			} ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Contact_details')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Facility->Contact  ; ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Comments')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Facility->Comments  ; ?>
						</div>	
					  </div>		
                    </div>
					
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
