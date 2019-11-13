  
  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Settings/ProjectType') ?>"> <?php echo lang('ProjectType')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
    </section>
     <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/Settings/ProjectTypeform/'.$id); ?>" enctype="multipart/form-data">	
					<div class="box-body">
          <div class="form-group">
            <label for="ProjectType"><?php echo lang('ProjectType')?></label><span class="errorStar">*</span></label>
             <input type="text" name="ProjectType" value="<?php  if(isset($ProjectType)){ echo $ProjectType ;  } ?>"  class="form-control" />
          </div>
          <div class="form-group">
            <label for=""><?php echo lang('Descriptin')?><span class="errorStar">*</span></label>
            <input type="text" name="Description" value="<?php  if(isset($Description)){ echo $Description ;  } ?>"  class="form-control" />
			  <input type="hidden" name="ids" value="<?php  if(isset($id)){ echo $id ;  } ?>" class="form-control" />
          </div>
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
