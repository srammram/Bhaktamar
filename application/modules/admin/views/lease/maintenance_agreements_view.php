<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-3.3.2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery-2.1.3.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-3.3.2.min.js" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap_search_select.min.css">
<script src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap_select.min.js"></script>
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
        <li><a href="#"> <?php echo $page_title; ?> </a></li>
        
    </ol>
</section>
<br>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('Unit_maintenance_RequestView'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php   
				if(!empty($request->request_status) && $request->request_status !=lang('completed')){
				?>
                  <a href="<?php  echo base_url("admin/Lease/generate_Maintenance_Agreements/".$request->id) ?>" class="tip po" onclick="return genrateMaintenance(this)" style="float:right;">	<button type="button" class="btn btn-primary">Generate Agreements
							
								</button></a><br><br><br>
			<?php   	}  ?>
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
                                    <?php if(isset($request->date)){ echo $request->date;  } ?>
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
                               <?php echo !empty($request->tenure_type) && $request->tenure_type == lang('month') ? lang('month') : FALSE ; ?>
                               <?php echo  !empty($request->tenure_type) && $request->tenure_type == lang('year') ? lang('year') : FALSE ; ?>
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
                                        value="<?php if(isset($request->expectAmount)){ echo $request->expectAmount;  }else{ echo set_value('expectAmount') ; }    ?>">
                                </div>-->
                                <div class="col-md-2">
                                    <label><?php echo lang('description') ?></label>
                                </div>
                                <div class="col-md-3">
                                    <?php if(isset($request->owner_description)){ echo $request->owner_description;  }else{ echo set_value('description') ; }   ?>
                                </div>
								 <div class="col-md-2">
                                    <label><?php echo lang('Pmc_description') ?></label>
                                </div>
                                <div class="col-md-3">
                                 <?php if(isset($request->pmc_description)){ echo $request->pmc_description;  }   ?>
                                </div>
                            </div>
							</div>
							<div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo lang('maintenance_Amount') ?></label>
                                </div>
                                <div class="col-md-3">
                                 
                                      <?php if(isset($request->maintenance_amount)){ echo $request->maintenance_amount;  }    ?>
                                </div>
								 <div class="col-md-2">
                                    <label><?php echo lang('period') ?></label>
                                </div>
                                <div class="col-md-3">
                                  
                                <?php echo !empty($request->period) && $request->period == lang('month') ? lang('month') : FALSE ; ?>
                                    
                                   
                                <?php echo !empty($request->period) && $request->period == lang('year') ? lang('year') : FALSE ; ?>
                                    
                                
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
                                        value="<?php if(isset($request->expectAmount)){ echo $request->expectAmount;  }else{ echo set_value('expectAmount') ; }    ?>">
                                </div>-->
                                <div class="col-md-2">
                                    <label><?php echo lang('maintenance_services') ?></label>
                                </div>
                                <div class="col-md-3">
                                
          <?php  if(!empty($maintenanceservices)){ foreach($maintenanceservices as $item){  ?>
		  <?php     $selected = in_array( $item->id, json_decode($request->maintenance_services) ) ? $item->Name : '';     ?>
                               <?php echo $selected; ?><br>
		  <?php   }  }  ?>
                                </div>
								 <div class="col-md-2">
                                    <label><?php echo lang('Other_services') ?></label><?php  json_decode($request->services); ?>
                                </div>
                                <div class="col-md-3">
								<?php  if(!empty($services_list)){ foreach($services_list as $item){  ?>
		  <?php     $selected = in_array( $item->id, json_decode($request->services) ) ? $item->Service_name : '';     ?>
                               <?php echo $selected; ?><br>
		  <?php   }  }  ?>
                 
                                </div>
                            </div>
							</div>
						
                            
<div class="form-group">
<?php   if(!empty($request->owner_approved) && $request->owner_approved !=0 ){ ?>
                            <div >
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
							<div class="col-lg-12 well well-sm">
								<legend style="font-weight:bold;">Payment Details</legend>
								<div class="table-responsive col-sm-12">
									<table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
										<thead>
											<tr>
												<th>Date</th>
												<th>Amount</th>
												<th>Note</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
							</div>
            		</div>
               				<div class="col-lg-12 well well-sm">
								<legend style="font-weight:bold;">Agreement Details</legend>
								<table class="table">
									<tbody>
										<tr>
											<td>
												<table class="table">
													<colgroup>
														<col width="49%">
														<col width="1%">
														<col width="50%">
													</colgroup>
													<tbody>
														<tr>
															<td>Start Date</td>
															<td>:</td>
															<td><?php  if(!empty($agreements->start_date)){ echo  $agreements->start_date  ;}  ?></td>
														</tr>
														<tr>
															<td>Agreement Documents</td>
															<td>:</td>
															<td></td>
														</tr>
													</tbody>
												</table>
											</td>
											<td>
												<table class="table">
													<colgroup>
														<col width="49%">
														<col width="1%">
														<col width="50%">
													</colgroup>
													<tbody>
														<tr>
															<td>End Date</td>
															<td>:</td>
															<td><?php  if(!empty($agreements->end_date)){ echo  $agreements->end_date; }  ?></td>
														</tr>
														<tr>
															<td>Day Left</td>
															<td>:</td>
															<td>0</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<button type="button" style="float:right;"class="btn btn-warning" disabled>ReNew</button>
									</tbody>
								</table>
							</div>
                    
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