
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
        <li><a href="<?php echo site_url('admin/vendor/service_provider_view') ?>"> <?php echo lang('pmc')?> </a></li>
        <li class="active"><?php echo lang('view') ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="Amenities"><?php echo lang('name')?></label></label>
                                <?php  if(isset($pmc->name)){ echo $pmc->name ;  } ?>
                                   
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contractdate"><?php echo lang('service_provider_contract_date')?></label>
                                <?php  if(!empty($pmc->contract_date)){ echo $pmc->contract_date ;  } ?>
                            </div>
                            <br>
                            <div class="form-group col-md-6">
                                <label for="contactnumber"><?php echo lang('Contact_number')?></label>
                              <?php  if(isset($pmc->contact_number)){ echo $pmc->contact_number ;  } ?>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"><?php echo lang('email')?></label>
                             <?php  if(isset($pmc->email)){ echo $pmc->email ;  } ?>

                            </div>
                            <br>
                            <div class="form-group col-md-6">
                                <label for="address"><?php echo lang('address')?></label>
                              <?php   if(isset($pmc->address)){  echo  $pmc-> address ; } ?>
                            </div>
                                            </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>