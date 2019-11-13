<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
<script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
<style>
.form-inline {margin-bottom: 5px;}
	 .form-inline .form-control{width: 100%;}
</style>
<?php  $seg= $this->uri->segment(4);?>
<section class="content-header">
    <h1><?php echo $page_title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/vendor/utility_service_form') ?>"> <?php echo lang('utility_services')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
					<?php echo lang('utility_services')?>
                    </h3>
                </div>
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/Facility/utility_service_form/'.$services_id); ?>"
                        enctype="multipart/form-data" id="services_form">
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="servicename"><?php echo lang('service_name')?></label><span
                                    class="errorStar">*</span></label><br>
                                <input type="text" class="form-control " name="servicename"
                                    value="<?php  if(isset($servicename)){ echo $servicename ;  } ?>"
                                    autocomplete="off">
                            </div>
                           
                            <div class="form-group col-md-6"> 
                       <label for="servicesperiod"><?php echo lang('Service_period')?></label>
                                <select class="chosen form-control" name="period" style="width:500px;" class="form-control">
                                    <option value="">Select</option>
                                    <option value="<?php  echo lang('Days') ?>"
                                        <?php if(!empty($period)) echo $period == lang('Days') ?'selected':''  ?>>
                                        <?php    echo lang('Days')  ?></option>
                                    <option value="<?php echo lang('Hrs')  ?>"
                                        <?php if(!empty($period)) echo $period == lang('Hrs') ?'selected':''  ?>>
                                        <?php    echo lang('Hrs')  ?>
                                    </option>
									<option value="<?php echo lang('Monthly')  ?>"
                                        <?php if(!empty($period)) echo $period == lang('Monthly') ?'selected':''  ?>>
                                        <?php    echo lang('Monthly')  ?>
                                    </option>
									<option value="<?php echo lang('YEAR')  ?>"
                                        <?php if(!empty($period)) echo $period == lang('YEAR') ?'selected':''  ?>>
                                        <?php    echo lang('YEAR')  ?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="servicestype"><?php echo lang('services_type')?></label>
                                <select class="chosen form-control" name="servicestype" style="width:500px;" class="form-control">
                                    <option value="">Select</option>
                                    <option value="<?php  echo lang('Paid') ?>"
                                        <?php if(!empty($servicestype)) echo $servicestype == lang('Paid') ?'selected':''  ?>>
                                        <?php    echo lang('Paid')  ?></option>
                                    <option value="<?php echo lang('unpaid')  ?>"
                                        <?php if(!empty($servicestype)) echo $servicestype == lang('unpaid') ?'selected':''  ?>>
                                        <?php    echo lang('unpaid')  ?>
                                    </option>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="contactperson"><?php echo lang('contact_person_name')?></label>
                                <input type="text" name="contact_person"
                                    value="<?php  if(isset($contact_person)){ echo $contact_person ;  } ?>"
                                    class="form-control" autocomplete="off" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contactnumber"><?php echo lang('Contact_number')?></label>
                                <input type="text" name="Contact_number"
                                    value="<?php  if(isset($Contact_number)){ echo $Contact_number ;  } ?>"
                                    class="form-control allownumber" autocomplete="off" />
                            </div>
                           </div>
                            <div class="box-footer">
                                <input type="hidden" name="services_id" id="services_id"
                                    value="<?php   if(isset($services_id)){  echo   $services_id ; } ?>"
                                    autocomplete="off">
                                <input class="btn btn-primary" id="servicesprovider_form_submit" type="submit"
                                    value="Save" style="float:left;" />
                            </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section>
<script>
$(function() {
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
        function(e) {
            e.preventDefault();
            $(this).closest('.form-inline').remove();
        }
    );
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
        function(e) {
            e.preventDefault();
            var container = $(this).closest('[data-role="dynamic-fields"]');
            new_field_group = container.children().filter('.form-inline:first-child').clone();
            new_field_group.find('input').each(function() {
                $(this).val('');
            });
            container.append(new_field_group);
        }
    );
});
</script>
<script>
function delete_file(str) {
    var service_id = $('#services_id').val();
    var postUrl = getBaseURL() + 'admin/vendor/doc_delete';
    $.ajax({
        type: "POST",
        url: postUrl,
        data: {
            doc: str,
            service_id: service_id
        },
        cache: false,
        success: function(result) {
            location.reload(true);
        }
    });
}
</script>