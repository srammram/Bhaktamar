<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Fund') ?>"><?php echo lang('Fund')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('Fund')?></li>
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
                      		<label><?php echo lang('Owner_Name')?></label>
                      	</div>
						<div class="col-md-6">
					  <?php echo $Fund->o_name ; ?>
						</div>	
					  </div>		
                    </div>
					
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Month')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Fund->For_Month ; ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Fund_date')?></label>
                      	</div>
						<div class="col-md-6">
						<?php echo $Fund->f_date ; ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Total_amount')?></label>
                      	</div>
						<div class="col-md-6">
		                    <?php echo $Fund->total_amount ; ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Fund_purpose')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Fund->purpose ; ?>
							
					
						</div>	
					  </div>		
                    </div>
					
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
