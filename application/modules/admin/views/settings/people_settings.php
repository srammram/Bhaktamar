
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
        <li><a href="<?php echo site_url('admin/settings/idtype_form') ?>"> <?php echo lang('id_type')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/settings/people_settings/'); ?>"
                        enctype="multipart/form-data"  id="service_providerform">
                        <div class="box-body">
						 <fieldset style="border:1px solid silver;">
                        <legend>Resident:</legend>
                            <div class="form-group col-md-8">
                                <label for="resident_tenure_limit"><?php echo lang('resident_tenure_limit')?></label>
                                <input type="text" name="resident_tenure_limit"
                                    value="<?php  if(!empty($rent_max_tenure)){ echo $rent_max_tenure ;  } ?>"
                                    class="form-control " autocomplete="off" />
                            </div>
							<div class="form-group col-md-8">
                                <label for="tenure_type"><?php echo lang('tenure_type')?></label>
                               <select class="form-control col-md-6" name="tenure_type">
							     <option value="<?php echo lang('days')  ?>"  <?php  if(isset($occupy_status)){ echo $tenure_type == lang('days')  ?'selected':'' ;  } ?>> <?php echo lang('days')  ?></option>
							     <option value="<?php echo lang('Months')  ?>"   <?php  if(isset($occupy_status)){ echo $tenure_type == lang('Months')  ?'selected':'' ;  } ?>><?php echo lang('Months')  ?></option>
								 <option value="<?php echo lang('Years')  ?>"   <?php  if(isset($occupy_status)){ echo $tenure_type == lang('Years')  ?'selected':'' ;  } ?>><?php echo lang('Years')  ?></option>
							    </select>
                            </div>
								<div class="form-group col-md-6">
                                <label for="tenure_type"><?php echo lang('tenure_limi_active')?></label>
                              <input type="checkbox"  name="active" value="1"    <?php if(!empty($tenture_period_active) && $tenture_period_active==1){ echo 'checked' ; } ?>> 
                            </div>
							</fieldset>
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
