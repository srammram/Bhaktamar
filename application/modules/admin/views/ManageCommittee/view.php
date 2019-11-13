        <section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/ManageCommittee') ?>"><?php echo lang('ManageCommittee')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('ManageCommittee')?></li>
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
                      		<label><?php echo lang('Committe_name')?></label>
                      	</div>
						<div class="col-md-6">
							<?php if(isset($ManageCommittee->mc_name)){echo $ManageCommittee->mc_name;}  ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Committe_Members')?> </label>
                      	</div>
						<div class="col-md-6">
							<?php if(isset($Ownerss)){
								foreach($Ownerss as $Owners)
								{
									echo $Owners->full_name.'<br>';
								}							
								
							}  ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Committe_Leader')?></label>
                      	</div>
						<div class="col-md-6">
							<?php if(isset($ManageCommittee->full_name)){echo $ManageCommittee->full_name;}  ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Committe_StartDate')?></label>
                      	</div>
						<div class="col-md-6">
							<?php if(isset($ManageCommittee->mc_start_date)){echo $ManageCommittee->mc_start_date;}  ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Committe_Rules')?></label>
                      	</div>
						<div class="col-md-6">
		        	<?php if(isset($ManageCommittee->mc_Rules)){echo nl2br($ManageCommittee->mc_Rules);}  ?>
						</div>	
					  </div>		
                    </div>					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
