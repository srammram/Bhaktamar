
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
<script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/vendor/unitType') ?>"> <?php echo lang('unit_type')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/settings/custom_plan_form/'.$id); ?>"
                        enctype="multipart/form-data"  id="service_providerform">
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="Amenities"><?php echo lang('name')?></label><span
                                    class="errorStar">*</span></label><br>
                                <input type="text" class="form-control " name="name"
                                    value="<?php  if(isset($name)){ echo $name ;  } ?>"
                                    autocomplete="off" required>
                            </div>
							
                            <div class="form-group col-md-12">
                                <label for="percentage"><?php echo lang('percentage')?></label>
                                <input type="text" name="percentage"
                                    value="<?php  if(!empty($percentage)){ echo $percentage ;  } ?>"
                                    class="form-control allowdecimalpoint" autocomplete="off" />
                            </div>
                      
                            <div class="box-footer">
                                <input type="hidden" name="id"
                                    value="<?php   if(isset($id)){  echo   $id ; } ?>"
                                    autocomplete="off">
                                <input class="btn btn-primary" id="status_id" type="submit" value="Save" style="float:left;" />
                            </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>
