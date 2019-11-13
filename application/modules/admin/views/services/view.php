<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Services') ?>"><?php echo lang('Services')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('Services')?></li>
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
                      		<label><?php echo lang('Services_name')?></label>
                      	</div>
						<div class="col-md-6">
					  <?php echo $Services->Service_name ; ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Serv_Period')?></label>
                      	</div>
						<div class="col-md-6">
					  <?php echo $Services->Services_duration ; ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Service_type')?></label>
                      	</div>
						<div class="col-md-6">
					  <?php echo $Services->SeviceType ; ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Services_provider')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Services->Service_provider ; ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Contact_number')?></label>
                      	</div>
						<div class="col-md-6">
						<?php echo $Services->Contact_number ; ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Mobile')?></label>
                      	</div>
						<div class="col-md-6">
		                    <?php echo $Services->Mobile_number ; ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Email')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Services->Email ; ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Address')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Services->Address ; ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('C_person_name')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Services->Contact_person_name ; ?>
						</div>	
					  </div>		
                    </div>
					
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
