<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/floors') ?>"><?php echo lang('floors')?></a></li>
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
                      		<label><?php echo lang('name')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $floor->name ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Project')?></label>
                      	</div>
						<div class="col-md-6">
						<?php if(!empty($project)){  foreach($project as $row){  ?>
							  <?php  if(isset($floor->projectid)){ echo $floor->projectid == $row->id  ?  $row->Name:'' ;  } ?>
						<?php  }  }  ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('building')?></label>
                      	</div>
						<div class="col-md-6">
						<?php  if(!empty($buildings)){ foreach($buildings  as $building){  ?>
							 <?php if(!empty( $floor->building_id)) echo  $floor->building_id == $building->bldid ?$building->name:''  ?>
						<?php  }  }  ?>							 
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('floor_number')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $floor->floor_no ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('description')?></label></div>
						<div class="col-md-6">
							<?php echo $floor->description  ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('area') ?>(SFT)</label></div>
							<div class="col-md-6">
                      		<?php
							echo $floor->gross_area;
								 ?>
								 </div>
						</div>	
					  </div>		
                   
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('shared_public_area') ?>(SFT)</label></div>
									<div class="col-md-4">
                      		<?php
							echo $floor->shared_area;
								   ?>
								   </div>	
						</div>	
					  </div>		
                  
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('active')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo ($floor->active==1)?lang('yes'):lang('no');?> 
						</div>	
					  </div>		
                    </div>
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
