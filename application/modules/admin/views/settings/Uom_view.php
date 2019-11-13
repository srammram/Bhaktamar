<section class="content-header">
       <h1>  <?php echo $page_title; ?></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Settings/UOM') ?>"><?php echo lang('UOM')?></a></li>
            <li class="active"><?php echo lang('Settings')?> <?php echo lang('UOM')?></li>
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
                      		<label><?php echo lang('UOM_name')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $uom->Name ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('UOM_Description')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $uom->description ?>
						</div>	
					  </div>		
                    </div>
					 <div class="form-group">
					 <div class="row">
						<div class="col-md-2">
                                  <label><?php echo lang('convert_rate')?></label>
								  </div>
								  <div class="col-md-6">
                                  <?php  if(!empty($uom->convert_rate)){ echo $uom->convert_rate; }   ?>
                              </div>
							  </div>
							  </div>
                              <div class="form-group">
							   <div class="row">
						      <div class="col-md-2">
                                  <label><?php echo lang('default_uom')?></label>
								    </div>
									  <div class="col-md-6">
                                          <?php foreach($uomlist as $item){ ?>
                                              <?php if(!empty( $uom->default_uom)) echo $item->id ===  $uom->default_uom? $item->Name:''?>
										  <?php   }   ?>
                                     </select>
									  </div>
							  </div>
                              </div>
                          </div>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
