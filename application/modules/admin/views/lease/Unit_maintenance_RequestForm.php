<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-3.3.2.min.js" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap_search_select.min.css">
<script src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap_select.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
.error {
    color: #FF0000;
}
</style>
  <script type="text/javascript">
        $(document).ready(function() {
            $('.boot-multiselect-demo').multiselect({
            includeSelectAllOption: true,
            buttonWidth: 250,
            enableFiltering: true
        });
        });
    </script>
<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/lease/unit_maintenance_request_form') ?>"> <?php echo lang('unit_maintenace_request')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<br>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('unit_maintenace_request'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/lease/unit_maintenance_request_form/'.$requesttypid.'/'.$unitid.'/'.$id); ?>"
                        enctype="multipart/form-data" id="requestform">
							<div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('type') ?></label>
                                </div>
                                <div class="col-md-3 ">
                                       <?php if(isset($requesttype)){ echo $requesttype;  }   ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('unit_details') ?></label>
                                </div>
                                <div class="col-md-3 ">
                                    <?php if(isset($reqequestunit->unit_name)){ echo $reqequestunit->unit_name .'('.$reqequestunit->building .')';  }   ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('title') ?></label>
                                </div>
                                <div class="col-md-3 title">
                                    <input type="text" name="title" class="form-control " autocomplete='off'
                                        value="<?php if(isset($title)){ echo $title;  } else{ echo set_value('title') ; }  ?>">
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('date') ?></label>
                                </div>
                                <div class="col-md-3 date">
                                    <input type="text" name="date" class="form-control datepicker" autocomplete='off'
                                        value="<?php if(isset($date)){ echo $date;  }else{ echo set_value('date') ; }   ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('tenure') ?></label>
                                </div>
                                <div class="col-md-3">
                                     <input type="text" name="tenure" class="form-control " autocomplete='off'
                                        value="<?php if(isset($tenure)){ echo $tenure;  }else{ echo set_value('tenure') ; }   ?>">
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('tenure_type') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <select name="tenure_type" class="form-control" id="tenuretype"
                                      >
                                        <option value="">select</option>
                                <option value="<?php echo lang('month')?>"<?php echo set_select('tenure_type',lang('month'), ( !empty($tenuretype) && $tenuretype == lang('month') ? TRUE : FALSE )); ?>
                                    >
                                    <?php echo lang('month')?></option>
                                <option value="<?php echo lang('year')?>"<?php echo set_select('tenure_type',lang('year'), ( !empty($tenuretype) && $tenuretype == lang('year') ? TRUE : FALSE )); ?>
                                    >
                                    <?php echo lang('year')?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                              <!--  <div class="col-md-2">
                                    <label><?php echo lang('expect_amount') ?></label><span style="color:red"> *</span>
                                </div>
                                <div class="col-md-3">
                                   <input type="text" name="expectAmount" class="form-control " autocomplete='off'
                                        value="<?php if(isset($expectAmount)){ echo $expectAmount;  }else{ echo set_value('expectAmount') ; }    ?>">
                                </div>-->
                                <div class="col-md-2">
                                    <label><?php echo lang('description') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <textarea name="description" autocomplete="off"
                                        class="form-control"><?php if(isset($description)){ echo $description;  }else{ echo set_value('description') ; }   ?></textarea>
                                </div>
								 <div class="col-md-2">
                                    <label><?php echo lang('Pmc_description') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <textarea name="Pmc_description" autocomplete="off"
                                        class="form-control"><?php if(isset($Pmc_description)){ echo $Pmc_description;  }else{ echo set_value('Pmc_description') ; }   ?></textarea>
                                </div>
                            </div>
							</div>
							<div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('maintenance_Amount') ?></label><span style="color:red"> *</span>
                                </div>
                                <div class="col-md-3">
                                   <input type="text" name="maintenance_Amount" class="form-control " autocomplete='off'
                                        value="<?php if(isset($maintenance_amount)){ echo $maintenance_amount;  }else{ echo set_value('maintenance_Amount') ; }    ?>">
                                </div>
								 <div class="col-md-2">
                                    <label><?php echo lang('period') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <select name="m_period" class="form-control" id="tenuretype"
                                      >
                                        <option value="">select</option>
                                <option value="<?php echo lang('month')?>"<?php echo set_select('tenure_type',lang('month'), ( !empty($period) && $period == lang('month') ? TRUE : FALSE )); ?>
                                    >
                                    <?php echo lang('month')?></option>
                                <option value="<?php echo lang('year')?>"<?php echo set_select('tenure_type',lang('year'), ( !empty($period) && $period == lang('year') ? TRUE : FALSE )); ?>
                                    >
                                    <?php echo lang('year')?></option>
                                    </select>
                                </div>
                              
                            </div>
							
							</div>
							 <div class="form-group">
                            <div class="row">
                              <!--  <div class="col-md-2">
                                    <label><?php echo lang('expect_amount') ?></label><span style="color:red"> *</span>
                                </div>
                                <div class="col-md-3">
                                   <input type="text" name="expectAmount" class="form-control " autocomplete='off'
                                        value="<?php if(isset($expectAmount)){ echo $expectAmount;  }else{ echo set_value('expectAmount') ; }    ?>">
                                </div>-->
                                <div class="col-md-2">
                                    <label><?php echo lang('maintenance_services') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <select id="boot-multiselect-demo" class="boot-multiselect-demo" multiple="multiple" name="maintenance_services[]">
          <?php  if(!empty($maintenanceservices)){ foreach($maintenanceservices as $item){  ?>
		  <?php     $selected = in_array( $item->id, $ms ) ? ' selected="selected" ' : '';     ?>
                                <option value="<?php  echo $item->id ?>" <?php echo $selected; ?>>
                                    <?php echo $item->Name  ?></option>
		  <?php   }  }  ?>
    </select>
                                </div>
								 <div class="col-md-2">
                                    <label><?php echo lang('Other_services') ?></label>
									
                                </div>
                                <div class="col-md-3">
                                     <select id="boot-multiselect-demo" class="boot-multiselect-demo" multiple="multiple" name="services[]">
          <?php  if(!empty($services_list)){ foreach($services_list as $item){  ?>
		  <?php     $selected = in_array( $item->id, $services ) ? ' selected="selected" ' : '';     ?>
                                <option value="<?php  echo $item->id ?>" <?php echo $selected; ?>>
                                    <?php echo $item->Service_name  ?></option>
		  <?php   }  }  ?>
    </select>
                                </div>
                            </div>
							</div>
                            <div class="box-footer">
							<input type="hidden" name="id" value="<?php if(!empty($id)){ echo $id;  }   ?>">
                                <input class="btn btn-primary" type="submit" id="request" value="Save" />
                            </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>
<script src="<?php echo base_url('assets/plugin/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>
<script>
$(function() {
    $('.datepicker').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd',
    });

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#my-select').multiselect();
});
</script>