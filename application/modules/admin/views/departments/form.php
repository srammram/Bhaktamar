  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/departments') ?>"> <?php echo lang('departments')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>


<section class="content">
    	 
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
					
				<form method="post" action="<?php echo site_url('admin/departments/form/'.$id); ?>" enctype="multipart/form-data">	
					<div class="form-group">
					  <div class="row">
						<div class="col-md-4">
                      		<label><?php echo lang('name') ?></label>
                      		<?php
								$data	= array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control');
								echo form_input($data); ?>
						</div>	
					  </div>		
                    </div>
					
					<div class="class="box-footer"">
							<input class="btn btn-primary" type="submit" value="Save"/>
					</div>
					</form>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
