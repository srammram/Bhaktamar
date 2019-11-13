<section class="content-header">
       <h1>  <?php echo $page_title; ?></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Settings/soe') ?>"><?php echo lang('source_of_enquiry')?></a></li>
            <li class="active"><?php echo lang('source_of_enquiry')?> <?php echo lang('view')?></li>
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
                      		<label><?php echo lang('Name')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $soe->Name ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('description')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $soe->Description ?>
						</div>	
					  </div>		
                    </div>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
