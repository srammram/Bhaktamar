  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Settings/Labour') ?>"> <?php echo lang('Labour')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
 </section>
     <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/Settings/Labour_form/'.$id); ?>" enctype="multipart/form-data">	
					<div class="box-body">
          <div class="form-group">
            <label for="LabourType_name"><?php echo lang('LabourType_name')?></label><span class="errorStar">*</span></label>
        <input type="text" name="LabourType_name" value="<?php  if(isset($LabourType_name)){ echo $LabourType_name ;  } ?>" id="Name" class="form-control" />
          </div>
          <div class="form-group">
            <label for="Type_description"><?php echo lang('Type_description')?><span class="errorStar">*</span></label>
            <input type="text" name="Type_description" value="<?php  if(isset($Type_description)){ echo $Type_description ;  } ?>" id="Type_description" class="form-control" />
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
