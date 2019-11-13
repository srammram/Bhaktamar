<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-3.3.2.min.js" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
.error {
    color: #FF0000;
}
</style>
<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
    <h1>
        <?php echo $page_title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                <?php echo lang('dashboard')?></a></li>
        <li><a href="<?php echo site_url('admin/lease/unit_selfLease_request_form') ?>"> <?php echo lang('self_lease_request')?> </a></li>
        <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
    </ol>
</section>
<br>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('self_lease_request'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="<?php echo site_url('admin/lease/unit_selfLease_request_form/'.$requesttypid.'/'.$unitid.'/'.$id); ?>"
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
                                <div class="col-md-2">
                                    <label><?php echo lang('expect_amount') ?></label><span style="color:red"> *</span>
                                </div>
                                <div class="col-md-3">
                                   <input type="text" name="expectAmount" class="form-control " autocomplete='off'
                                        value="<?php if(isset($expectAmount)){ echo $expectAmount;  }else{ echo set_value('expectAmount') ; }    ?>">
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('description') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <textarea name="description" autocomplete="off"
                                        class="form-control"><?php if(isset($description)){ echo $description;  }else{ echo set_value('description') ; }   ?></textarea>
                                </div>
                            </div>
							</div>
							<div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('Suggested_amount') ?></label><span style="color:red"> *</span>
                                </div>
                                <div class="col-md-3">
                                   <input type="text" name="Suggested_amount" class="form-control " autocomplete='off'
                                        value="<?php if(isset($Suggested_amount)){ echo $Suggested_amount;  }else{ echo set_value('Suggested_amount') ; }    ?>">
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
                                    <label><?php echo lang('commission_type') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <select name="commission_type" class="form-control" id="commission_type"
                                      >
                                        <option value="">select</option>
                                <option value="<?php echo lang('amount')?>"<?php echo set_select('commission_type',lang('amount'), ( !empty($commission_type) && $commission_type == lang('amount') ? TRUE : FALSE )); ?>
                                    >
                                    <?php echo lang('amount')?></option>
                                <option value="<?php echo lang('percentage')?>"<?php echo set_select('commission_type',lang('percentage'), ( !empty($commission_type) && $commission_type == lang('percentage') ? TRUE : FALSE )); ?>
                                    >
                                    <?php echo lang('percentage')?></option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('Commission') ?></label>
                                </div>
                                <div class="col-md-3">
                                     <input type="text" name="Commission" class="form-control " autocomplete='off'
                                        value="<?php if(isset($Commission)){ echo $Commission;  }else{ echo set_value('Commission') ; }   ?>">
                                </div>
                            </div>
							</div>
							<?php  if(!empty($pmc_approved) && !empty($owner_approved) && $owner_approved ==1 && $pmc_approved==1 ){
								?>
							 <div class="form-group">
                            <div class="row">
							<div class="col-md-2">
                                </div>
                                <div class="col-md-3">
                                    <label><input type="checkbox" name="Isclosed" value="1"  <?php echo ($is_closed==1)?'checked="checked"':'';?>>  <?php echo lang('Close_request') ?></label>
                                </div>
                            </div>
							  </div>
							<?php   }  ?>
							
									<?php  if(!empty($pmc_approved) && !empty($owner_approved) && $owner_approved ==1 && $pmc_approved==1 ){
								?>
							<div class="form-group col-md-12">
								<div data-role="dynamic-fields">
								<?php  if(!empty($enquiry)){ foreach($enquiry as $members){ 
								?>
                                  <div class="form-inline">
                                  <fieldset class="col-md-12 resident_sec">
									<legend>Enquiry Details</legend>
                                   <div class="row">
                                   	<div class="form-group col-sm-4">
                                       	<label class="control-label col-sm-12">Name</label>
                                       	<div class="col-sm-12">
                                       		 <input type="text" name="name[]" class="form-control" value="<?php  echo $members->name; ?>" />
                                       	</div>
                                    </div>
                                    
                                        <div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Enquiry Date</label>
											<div class="col-sm-12">
												 <input type="text" name="enquiryDate[]" class="form-control datepicker" width="100%" value="<?php  echo $members->enquirydate; ?>" />
											</div>
										</div>
										<div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Phone Number</label>
											<div class="col-sm-12">
												 <input type="text" name="phone[]" class="form-control" width="100%" value="<?php  echo $members->phone; ?>" />
											</div>
										</div>
                                   </div>
                                   <div class="row">
										
										<div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Mobile </label>
											<div class="col-sm-12">
												 <input type="text" name="mobile[]" class="form-control" width="100%" value="<?php  echo $members->mobile; ?>" />
											</div>
										</div>
									<div class="form-group col-sm-4">
                                       <label class="control-label col-sm-12">Email</label>
                                       <div class="col-sm-12">
                                        			 <input type="text" name="email[]" class="form-control" width="100%" value="<?php  echo $members->email; ?>" />
										</div>
                                    </div>
									<div class="form-group col-sm-4">
                                       <label class="control-label col-sm-12">Address</label>
                                       <div class="col-sm-12">
                                        <input type="text" name="address[]" class="form-control" width="100%" value="<?php  echo $members->address; ?>" />
										<input type="hidden" name="message[]" class="form-control" width="100%" value="<?php  echo $members->message; ?>" />
										<input type="hidden" name="enquirystatus[]" class="form-control" width="100%" value="<?php  echo $members->enquirystatus; ?>" />
										</div>
                                    </div>
									</div>
									<div class="row">
										
										<div class="form-group col-sm-12">
                                 		 <button class="btn btn-danger btn-sm pull-right" data-role="remove">
											<span class="glyphicon glyphicon-remove"></span>
										</button>
										<button class="btn btn-primary btn-sm pull-right" data-role="add" style="margin-right: 5px;">
											<span class="glyphicon glyphicon-plus"></span>
										</button>
                                 	</div>
									</div>
                                 	
                                   </fieldset>
									</div>
								<?php   } }  ?>
								
								 <div class="form-inline">
                                  <fieldset class="col-md-12 resident_sec">
									<legend>Enquiry Details</legend>
                                   <div class="row">
                                   	<div class="form-group col-sm-4">
                                       	<label class="control-label col-sm-12">Name</label>
                                       	<div class="col-sm-12">
                                       		 <input type="text" name="name[]" class="form-control" />
                                       	</div>
                                    </div>
                                    
                                        <div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Enquiry Date</label>
											<div class="col-sm-12">
												 <input type="text" name="enquiryDate[]" class="form-control datepicker" width="100%" />
											</div>
										</div>
										<div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Phone Number</label>
											<div class="col-sm-12">
												 <input type="text" name="phone[]" class="form-control" width="100%" />
											</div>
										</div>
                                   </div>
                                   <div class="row">
										
										<div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Mobile </label>
											<div class="col-sm-12">
												 <input type="text" name="mobile[]" class="form-control" width="100%" />
											</div>
										</div>
									<div class="form-group col-sm-4">
                                       <label class="control-label col-sm-12">Email</label>
                                       <div class="col-sm-12">
                                        			 <input type="text" name="email[]" class="form-control" width="100%" />
										</div>
                                    </div>
									<div class="form-group col-sm-4">
                                       <label class="control-label col-sm-12">Address</label>
                                       <div class="col-sm-12">
                                        			 <input type="text" name="address[]" class="form-control" width="100%" />
										</div>
                                    </div>
									</div>
									<div class="row">
										
										<div class="form-group col-sm-12">
                                 		 <button class="btn btn-danger btn-sm pull-right" data-role="remove">
											<span class="glyphicon glyphicon-remove"></span>
										</button>
										<button class="btn btn-primary btn-sm pull-right" data-role="add" style="margin-right: 5px;">
											<span class="glyphicon glyphicon-plus"></span>
										</button>
                                 	</div>
									</div>
                                 	
                                   </fieldset>
									</div>
                            </div>
						</div>
							
									<?php  } ?>
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