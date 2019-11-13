<link   rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
<link   rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<link   rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-select.min.css">
<link   rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-select.min.js"></script>
<style>
.error {
    color: #FF0000;
}
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
}
</style>
<?php   $seg= $this->uri->segment(5);?>
<section class="content-header">
    <h1><?php echo $page_title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i><?php echo lang('dashboard')?></a></li>
        <li><a href="#"> <?php echo $page_title; ?> </a></li>
    </ol>
</section>
<br>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> <?php echo $page_title; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
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
                                 <?php if(isset($request->title)){ echo $request->title;  }  ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('date') ?></label>
                                </div>
                                <div class="col-md-3 date">
                                   <?php if(isset($request->requesteddate)){ echo $request->requesteddate;  }   ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('tenure') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <?php if(isset($request->tenure)){ echo $request->tenure;  }   ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('tenure_type') ?></label>
                                </div>
                                <div class="col-md-3">
                                        <?php echo  !empty($request->tenure_type) && $request->tenure_type == lang('month') ? lang('month') : FALSE ; ?>
                                       <?php echo  !empty($request->tenure_type) && $request->tenure_type == lang('year') ? lang('year') : FALSE ; ?>
                                </div>
                            </div>
                        </div>
						<?php    if(isset($request->request_status) && $request->request_status != lang('pending')){ ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('expect_amount') ?></label><span style="color:red"> *</span>
                                </div>
                                <div class="col-md-3">
                                  <?php if(isset($request->expect_amount)){ echo $request->expect_amount;  }    ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('description') ?></label>
                                </div>
                                <div class="col-md-3">
                                   <?php if(isset($request->owner_description)){ echo $request->owner_description;  }   ?>
                                </div>
                            </div>
							</div>
							 <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('pmc_suggested_amount') ?></label>
                                </div>
                                <div class="col-md-3">
                                  <?php if(isset($request->pmc_suggest_amount)){ echo $request->pmc_suggest_amount;  }    ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('PMC_description') ?></label>
                                </div>
                                <div class="col-md-3">
                                   <?php if(isset($request->pmc_description)){ echo $request->pmc_description;  }   ?>
                                </div>
                            </div>
							 <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('commission_type') ?></label>
                                </div>
                                <div class="col-md-3">
                                  <?php if(isset($request->commission_type)){ echo $request->commission_type;  }    ?>
                                </div>
                                <div class="col-md-2">
                                    <label><?php echo lang('commission') ?></label>
                                </div>
                                <div class="col-md-3">
                                   <?php if(isset($request->commission)){ echo $request->commission;  }   ?>
                                </div>
                            </div>
						<?php  }  ?>
						<br>
						<br>
						<?php   if(($request->request_status ==lang('pending')) && $request->pmc_approved ==0) { ?>
						<fieldset class="scheduler-border">
              <legend class="scheduler-border">Alert</legend>
              <div class="control-group">
                 <label class="control-label input-label" for="startTime">do you want to continue processing</label>
                <div class="controls bootstrap-timepicker">
              <p style="margin-bottom: 0px;"><span class="pull-left"><a href="<?php echo base_url('admin/lease/request_acceptByPMC').'/'.$request->id ?>"><button type="button" class="btn btn-success btn-xs">Accept</button></a></span>
			<span class="pull-right"><a href="<?php echo base_url('admin/lease/request_rejectByPMC').'/'.$request->id ?>"><button type="button" class="btn btn-danger btn-xs">Decline</button></a></span></p>
        </div>
    </div>
</fieldset>
<?php   }   ?>

<div class="form-group">
<?php    if(!empty($request->owner_approved) && $request->owner_approved !=0 ){ ?>
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('owner_approval') ?></label>
                                </div>
                                <div class="col-md-3">
                                  <?php if($request->owner_approved  ==1){ echo'<button type="button" class="btn btn-success btn-xs">Accepted</button>' ;  }else{  echo '<button type="button" class="btn btn-danger btn-xs">Decline</button>';  }   ?>
                                </div>
                               <?php   }   ?>
							   <?php     if(isset($request->pmc_approved) ){?>
							   
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('Pmc_approval') ?></label>
                                </div>
                                <div class="col-md-3">
								<?php   
								switch($request->pmc_approved){
									case 0:
									echo '<button type="button" class="btn btn-warning btn-xs">Pending</button>';
									break;
									case 1:
									echo '<button type="button" class="btn btn-success btn-xs">Accepted</button>';
									break;
									case 2:
									echo '<button type="button" class="btn btn-danger btn-xs">Decline</button>';
									break;
								}
								?>
                                </div>
                               <?php   }   ?>
                            </div>
								</div>
							<br>
							<div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Request Status</label>
                                </div>
                                <div class="col-md-3">
                                  <?php if(isset($request->request_status)){ echo $request->request_status;  }    ?>
                                </div>
                            </div>
							</div>
						<br>
							<br>
								
							<div class="form-group col-md-12">
								<div data-role="dynamic-fields">
								<?php  if(!empty($request->enquiry)){ foreach(json_decode($request->enquiry) as $members){ 
								?>
                                  <div class="form-inline">
                                  <fieldset class="col-md-12 resident_sec">
									<legend>Enquiry Details</legend>
                                   <div class="row">
                                   	<div class="form-group col-sm-4">
                                       	<label class="control-label col-sm-12">Name</label>
                                       	<div class="col-sm-12">
                                       		 <?php  echo $members->name; ?>
                                       	</div>
                                    </div>
                                        <div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Enquiry Date</label>
											<div class="col-sm-12">
											<?php  echo $members->enquirydate; ?>
											</div>
										</div>
										<div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Phone Number</label>
											<div class="col-sm-12">
											<?php  echo $members->phone; ?>
											</div>
										</div>
                                   </div>
                                   <div class="row">
										<div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Mobile </label>
											<div class="col-sm-12">
											<?php  echo $members->mobile; ?>
											</div>
										</div>
									<div class="form-group col-sm-4">
                                       <label class="control-label col-sm-12">Email</label>
                                       <div class="col-sm-12">
                                        		<?php  echo $members->email; ?>
										</div>
                                    </div>
									<div class="form-group col-sm-4">
                                       <label class="control-label col-sm-12">Address</label>
                                       <div class="col-sm-12">
                                        		<?php  echo $members->address; ?>
										</div>
                                    </div>
									</div>
									<br>
									<div class="row">
									<?php  if(!empty($members->message)){ ?>
									<div class="form-group col-sm-4">
                                       <label class="control-label col-sm-12">Message</label>
                                       <div class="col-sm-12">
									   <?php if(!empty($members->message)){ echo $members->message; }    ?>
                                        		<input type="hidden" class="form-control col-md-12" name="message[]"  value="<?php  if(!empty($members->message)){ echo $members->message; }  ?>">
										</div>
                                    </div>
									<div class="form-group col-sm-4">
                                       <label class="control-label col-sm-12">Status</label>
                                       <div class="col-sm-12">
									
									   <?php echo ($members->enquirystatus == 1) ?  "Accept" : "" ;  ?>
									   <?php echo ($members->enquirystatus == 2) ?  "Reject" : "" ;  ?>
									  <?php echo ($members->enquirystatus == 0) ?  "Close Request" : "" ;  ?>
									  <input type="hidden" name="enquirystatus[]" value=" <?php echo !empty($members->enquirystatus) ?  $members->enquirystatus: "" ;  ?>"  >
										</div>
                                    </div>
									<?php   }   ?>
                                   </fieldset>
									</div>
								<?php   } }  ?>
                            </div>
						</div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>
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