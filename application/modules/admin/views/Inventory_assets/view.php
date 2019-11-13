<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Inventory') ?>"><?php echo lang('Inventory')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('Inventory')?></li>
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
                      		<label><?php echo lang('Inv_name')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Inventory->Name ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Quantity')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Inventory->Quantity ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Unit')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Inventory->unit?>
						</div>	
					  </div>		
                    </div>
						<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Current_status')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Inventory->Current_status?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Inventory_date')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Inventory->Date?>
						</div>	
					  </div>		
                    </div>
					
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
