<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/floors') ?>"><?php echo lang('floors')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('Complaint')?></li>
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
                      		<label><?php echo lang('Complaint_title')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Complaint->c_title; ?>
						</div>	
					  </div>		
                    </div>
					
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Complaint_by')?></label>
                      	</div>
						<div class="col-md-6">
							<?php  echo $Complaint->unit_no;   ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Complaint_desc')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Complaint->c_description ;  ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('Complaint_date')?></label>
                      	</div>
						<div class="col-md-6">
							<?php echo $Complaint->c_date  ; ?>
						</div>	
					  </div>		
                    </div>
					<div class="form-group">
					  <div class="row">
						<div class="col-md-2">
                      		<label><?php echo lang('complaint_status')?></label>
                      	</div>
						<div class="col-md-6">
							
							
							<?php if(isset($Complaint->Complaint_status) ){ 
							   switch($Complaint->Complaint_status){
								   case lang('Inprogress'):
								   echo '<span style="padding:6px;color:#fff;background-color:#d73925;margin:0 auto;">'.$Complaint->Complaint_status.'</span>' ;
								   break;
								    case lang('Accepted'):
								   echo '<span style="padding:6px 12px;color:#fff;background-color:#242582;margin:0 auto;">'.$Complaint->Complaint_status.'</span>' ;
								   break;
								    case lang('Inprogress'):
								   echo '<span style="padding:6px;color:#fff;background-color:green;margin:0 auto;">'.$Complaint->Complaint_status.'</span>' ;
								   break;
								    case lang('ReInitiated'):
								   echo '<span style="padding:6px;color:#fff;background-color:green;margin:0 auto;">'.$Complaint->Complaint_status.'</span>' ;
								   break;
								    case lang('Completed'):
								   echo '<span style="padding:6px;color:#fff;background-color:green;margin:0 auto;">'.$Complaint->Complaint_status.'</span>' ;
								   break;
								      case lang('Initiated'):
								   echo '<span style="padding:6px 14px;color:#fff;background-color:#99738E;margin:0 auto;">'.$Complaint->Complaint_status.'</span>' ;
								   break;
							   }
							 } ?>
						</div>	
					  </div>		
                    </div>
					
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
