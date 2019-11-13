
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
        <li><a href="<?php echo site_url('admin/vendor/serviceProvider_form') ?>"> <?php echo lang('service_provider')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/vendor/serviceProvider_form/'.$service_provider_id); ?>"
                        enctype="multipart/form-data"  id="service_providerform">
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="Amenities"><?php echo lang('service_provider_name')?></label><span
                                    class="errorStar">*</span></label><br>
                                <input type="text" class="form-control " name="providername"
                                    value="<?php  if(isset($sp_name)){ echo $sp_name ;  } ?>"
                                    autocomplete="off">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contractdate"><?php echo lang('service_provider_contract_date')?><span
                                        class="errorStar">*</span></label>
                                <input type="text" name="contractdate"
                                    value="<?php  if(!empty($sp_contract_date)){ echo $sp_contract_date ;  } ?>"
                                    class="form-control datepicker" autocomplete="off" onkeydown="return false"  />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contactnumber"><?php echo lang('Contact_number')?></label>
                                <input type="text" name="contact_number"
                                    value="<?php  if(isset($sp_contact_number)){ echo $sp_contact_number ;  } ?>"
                                    class="form-control allownumber" autocomplete="off" />

                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"><?php echo lang('email')?></label>
                                <input type="email" name="email" value="<?php  if(isset($sp_email)){ echo $sp_email ;  } ?>"
                                    class="form-control" autocomplete="off" />

                            </div>
                            <div class="form-group col-md-6">
                                <label for="address"><?php echo lang('address')?></label>
                                <textarea class="form-control" name="address"
                                    autocomplete="off"><?php   if(isset($sp_address)){  echo   $sp_address ; } ?></textarea>
                            </div>
                            <div class="box-footer col-md-12">
                                <input type="hidden" name="id"
                                    value="<?php   if(isset($service_provider_id)){  echo   $service_provider_id ; } ?>"
                                    autocomplete="off">
                                <input class="btn btn-primary" id="servicesprovider_form_submit" type="submit" value="Save" style="float:left;" />
                            </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>
