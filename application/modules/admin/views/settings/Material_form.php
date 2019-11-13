  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Settings/Material') ?>"> <?php echo lang('Material')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
 </section>
     <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/Settings/Material_form/'.$id); ?>" enctype="multipart/form-data">	
					<div class="box-body">
          <div class="form-group">
            <label for="Material_name"><?php echo lang('Material_name')?></label><span class="errorStar">*</span></label>
        <input type="text" name="Material_name" value="<?php  if(isset($Material_name)){ echo $Material_name ;  } ?>" id="Name" class="form-control" />
          </div>
          <div class="form-group">
            <label for="Material_Description"><?php echo lang('Material_Description')?><span class="errorStar">*</span></label>
            <input type="text" name="Material_Description" value="<?php  if(isset($Material_Description)){ echo $Material_Description ;  } ?>" id="Material_Description" class="form-control" />
          </div>
		              <div class="box-footer">
					     <input class="btn btn-primary" type="submit" value="Save"/>
					</div>
					</form>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
