  
  <?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/floors') ?>"> <?php echo lang('floors')?> </a></li>
            <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
          </ol>
</section>
     <section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form method="post" action="<?php echo site_url('admin/Settings/Socform/'.$id); ?>" enctype="multipart/form-data">	
					<div class="box-body">
          <div class="form-group">
            <label for="Name"><?php echo lang('Soc_Name')?></label><span class="errorStar">*</span></label>
        <input type="text" name="Name" value="<?php  if(isset($Name)){ echo $Name ;  } ?>" id="Name" class="form-control" />
          </div>
          <div class="form-group">
            <label for="Percentage"><?php echo lang('Soc_Percentage')?><span class="errorStar">*</span></label>
            <input type="text" name="Percentage" value="<?php  if(isset($Percentage)){ echo $Percentage ;  } ?>" id="Percentage" class="form-control allowdecimalpoint" />
		
          </div>
 
		<div class="form-group">
            <label for="Description"><?php echo lang('Soc_Description')?><span class="errorStar">*</span></label>
            <input type="text" name="description" value="<?php  if(isset($Description)){ echo $Description ;  } ?>" id="description" class="form-control" />
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
