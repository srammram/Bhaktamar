<section class="content-header">
       <h1>  <?php echo $page_title; ?></h1>
          <ol class="breadcrumb">
              <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Settings/Approved') ?>"> <?php echo lang('Approved_stage')?> </a></li>
            
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
                      		<label><?php echo lang('Project_Stage')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Approved_stage->socname ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Approved_Name')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Approved_stage->Name ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Approved_Description')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Approved_stage->description ?>
						</div>	
					  </div>		
                    </div>
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
