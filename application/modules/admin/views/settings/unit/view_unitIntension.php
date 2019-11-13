<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/settings/unitIntension') ?>"> <?php echo lang('unit_intension')?> </a></li>
        <li class="active"><?php echo lang('view') ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                   <div class="box-body">
                            <div class="form-group col-md-12">
                                <label for="Amenities"><?php echo lang('name')?></label></label>
                               <?php  if(isset($unitintension->name)){ echo $unitintension->name ;  } ?>
                            </div>
							
                            <div class="form-group col-md-12">
                                <label for="description"><?php echo lang('Description')?></label>
                            <?php  if(!empty($unitintension->description)){ echo $unitintension->description ;  } ?>
                            </div>
                      
                          
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>
      