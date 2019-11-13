<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
<script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1><?php echo $page_title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/vendor/service_form') ?>"> <?php echo lang('utility_services')?> </a></li>
        <li class="active"><?php echo lang('view') ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
					<?php echo lang('utility_services').' '.('View')?>
                    </h3>
                </div>
                      <div class="box-body">
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="servicename"><?php echo lang('service_name')?></label><span
                                    class="errorStar">*</span></label><br>
                                <?php  if(isset($service->Service_name)){ echo $service->Service_name ;  } ?>
                            </div>
                           
                            <div class="form-group col-md-6"> 
                       <label for="servicesperiod"><?php echo lang('Service_period')?></label>
					   <br>
                                        <?php if(!empty($service->Services_duration)) echo $service->Services_duration == lang('Days') ?lang('Days'):''  ?>
                                        <?php if(!empty($service->Services_duration)) echo $service->Services_duration == lang('Hrs') ? lang('Hrs'):''  ?>
                                        <?php if(!empty($service->Services_duration)) echo $service->Services_duration == lang('Monthly') ?lang('Monthly'):''  ?>
                                        <?php if(!empty($service->Services_duration)) echo $service->Services_duration == lang('YEAR')    ? lang('YEAR'):''  ?>
                                    </option>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="servicestype"><?php echo lang('services_type')?></label><br>
                                        <?php if(!empty($service->SeviceType)) echo $service->SeviceType == lang('Paid') ?lang('Paid'):''  ?>
                                        <?php if(!empty($service->SeviceType)) echo $service->SeviceType == lang('unpaid') ?lang('unpaid'):''  ?>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="contactperson"><?php echo lang('contact_person_name')?></label><br>
                              <?php  if(isset($service->Contact_person_name)){ echo $service->Contact_person_name ;  } ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contactnumber"><?php echo lang('Contact_number')?></label>
								<br>
                                <?php  if(isset($service->Contact_number)){ echo $service->Contact_number ;  } ?>
                            </div>
                           </div>
                            <div class="box-footer">
                            
                            </div>
                    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section>