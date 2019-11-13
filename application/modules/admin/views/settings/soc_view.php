<section class="content-header">
       <h1>  <?php echo $page_title; ?></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Settings/') ?>"><?php echo lang('Soc')?></a></li>
            <li class="active"><?php echo lang('Soc_')?> <?php echo lang('Soc')?></li>
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
                      		<label><?php echo lang('Soc_Name')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $soc->Name ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Soc_Percentage')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $soc->Percentage ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Soc_Form')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $soc->Description ?>
						</div>	
					  </div>		
                    </div>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
