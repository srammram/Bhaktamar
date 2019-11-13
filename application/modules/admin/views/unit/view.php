<style>
	.tab-content>.tab-pane{margin-bottom: 20px;}
</style>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Unit') ?>"><?php echo lang('Units')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('Units')?></li>
          </ol>
</section>
<section class="content">
    	 
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                <div class="col-sm-12 col-xs-12">
							<div class="wizard">
            					<div class="wizard-inner">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step1">
												<span class="round-tab">Unit Details
												</span>
											</a>
										</li>
										<li role="presentation">
											<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step2">
												<span class="round-tab">
												Amenities Details
												</span>
											</a>
										</li>
									<!--	<li role="presentation" >
											<a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
												<span class="round-tab">
													Billing Details
												</span>
											</a>
										</li>-->
									</ul>
            					</div>
								<div class="tab-content" style="margin-bottom: 20px;">
									<div class="tab-pane active" role="tabpanel" id="step1">
										<div class="col-sm-12">
												<div class="form-group col-md-6">
													 <label for="Project"><?php echo lang('ProjectsName')?></label></label>
													 <?php if(isset($Project)){ foreach($Project as $item) {		 ?>
														<?php  if(isset($unit->Project_id)){ echo $unit->Project_id == $item->id ?$item->Name:'' ;  } ?>
														 <?php } }    ?>

												 </div>
												 <div class="form-group col-md-6">
													 <label for="Project"><?php echo lang('ProjectsName')?></label>
													<?php  if(!empty($buildings)){ foreach($buildings  as $building){  ?>
						                        	 <?php if(!empty($unit->building_id)) echo $unit->building_id == $building->bldid ?$building->name:''  ?>
						                   		<?php  } }  ?>
												 </div>
												 <div class="form-group col-md-6">
													 <label for="UnitType"><?php echo lang('unit_group_type')?></label></label>

														 <?php foreach($UnitGroupType as $item){  ?>

															 <?php if(!empty($unit->Unit_groupType)) echo $unit->Unit_groupType == $item->id ?$item->unit_group_type:''  ?>

														 <?php  }				?>
													 </select>
												 </div>
												 <div class="form-group col-md-6">
													 <label for="soc"><?php echo lang('Unit_soc')?></label></label>
														  <?php if(isset($soc)){ foreach($soc as $item) {		 ?>
												<?php  if(isset($unit->Soc)){ echo $unit->Soc == $item->id ? $item->NAME:'' ;  } ?>
																  <?php  } }     ?>
													 </select>
												 </div>
												 <div class="form-group col-md-6">
													 <label for="UnitType"><?php echo lang('unit_type')?></label></label>
														 <?php if(isset($Unit_type)){ foreach($Unit_type as $item){ ?>
															 <?php  if(isset($unit->Unit_type)){ echo $unit->Unit_type == $item->id ? $item->unitType_name:'' ;  } ?>
															 <?php } }    ?>

												 </div>
												 <div class="form-group col-md-6">
													 <label for="status"><?php echo lang('Status')?></label></label>
														 <?php if(isset($status)){ foreach($status as $item){		 ?>
															 <?php  if(isset($unit->status)){ echo $unit->status == $item->status_id ? $item->status_name:'' ;  } ?>
														 <?php } }    ?>
													 </select>
												 </div>
												 <div class="form-group col-md-6">
													 <label for="intension"><?php echo lang('Intension')?></label></label>
														 <?php if(isset($intension)){ foreach($intension as $item){ ?>
															 <?php  if(isset($unit->intention)){ echo $unit->intention == $item->intension_id ? $item->name:'' ;  } ?>
														 <?php } }    ?>
													 </select>
												 </div>

												 <div class="form-group col-md-6">
													 <label for="unitname"><?php echo lang('unit_name')?></label>
												   <?php  if(isset($unit->unit_name)){ echo $unit->unit_name ;  } ?>
												 </div>
												 <div class="form-group col-md-6">
													 <label for="Floor"><?php echo lang('floor')?></label></label>
														 <?php if(isset($floor)){ foreach($floor as $item){		 ?>
															 <?php  if(isset($unit->floor_no)){ echo $unit->floor_no == $item->id ? $item->name:'' ;  } ?>
														 <?php  } }    ?>
													 </select>
												 </div>
												 <div class="form-group col-md-6">
													 <label for="unit"><?php echo lang('unit_no')?></label>
													 <?php  if(isset($unit->unit_no)){ echo $unit->unit_no ;  } ?>
												 </div>
												 <div class="form-group col-md-6">
													 <label for="size"><?php echo lang('House_details')?></label>
													 <?php  if(isset($unit->size)){ echo $unit->size ;  } ?>
												 </div>
												 <div class="form-group col-md-6">
													 <label for="desc"><?php echo lang('address')?></label>
													 <?php  if(isset($unit->address)){ echo $unit->address ;  } ?>
												 </div>
												 <div class="form-group col-md-6">
													 <label for="insidearea"><?php echo lang('House_length')?>
														</label>
													 <?php  if(isset($unit->insideunit)){ echo $unit->insideunit ;  } ?>
												 </div>
												  <div class="form-group col-md-6">
													 <label for="unitPrice"><?php echo lang('price')?></label>
													 <?php  if(isset($unit->unitPrice)){ echo $this->sma->formatMoney( $unit->unitPrice)  ; } ?>                             </div>
												 <div class="form-group col-md-6">
													 <label for="note"><?php echo lang('Note')?></label>
													 <?php  if(isset($unit->note)){ echo $unit->note ;  } ?>                             </div>
												 <div class="col-md-6">
													
													 <?php  if(!empty($unit->attachment)){   ?>  <label><?php echo lang('attachment') ?></label><?php foreach(json_decode($unit->attachment) as $doc){ 
																	  if(!empty($doc)){  	?>
													 <a style="margin-left:12px;"
														 href="<?php   echo  site_url('admin/unit/download_otherdoc/'.$doc)  ?>"
														 class="btn btn-xs btn-danger">
														 <i class="glyphicon glyphicon-download-alt"></i><?php    echo $doc; ?></a>
													 <br>
													 <?php    } } } ?>
												 </div>

											 <div class="form-group col-md-6">
												

													 <?php  if(!empty($unit->contract)){  ?>
													  <label for="contract"><?php echo lang('contract')?></label>
													  <a style="margin-left:12px;"
														 href="<?php   echo  site_url('admin/unit/download_contract/'.$unit->contract)  ?>"
														 class="btn btn-xs btn-danger">
														 <i class="glyphicon glyphicon-download-alt"></i><?php    echo $unit->contract; ?></a>
													 <?php   } ?>
											 </div>
											 <div class="form-group col-md-6">
												 <label for="Amenities"><?php echo lang('Interiors_neccessacity')?></label></label><br>
													 <?php if(isset($Amenities_ids)){ foreach($Amenities_ids as $item){
															$selected = in_array( $item->id, $unit->Amenities ) ?  $item->NAME : '';    ?>
																					  <?php  }  }    ?>
												 </select>
											 </div>
											<!--  <div class="form-group col-md-6">
												 <label for="owner"><?php echo lang('Owner')?></label></label>
													 <?php foreach($UnitGroupType as $item){  ?>
														 <?php if(!empty($unit->owner_id)) echo $unit->owner_id == $item->id ?$item->name:''  ?>
														 <?php  }				?>

											 </div> -->
										</div>
									</div>

									<div class="tab-pane" role="tabpanel" id="step2">
										<div class="col-sm-12">
										  <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                      
                        <div class="table-responsive col-sm-12">
                            <table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
                                <thead>
                                    <tr>
                                        
                                        <th>Amenities Name</th>
                                        <th>Description</th>
                                        <th>AmenitiesType</th>
                                        <th>AmenitiesPrice</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php  if(!empty($used_Amenities)){  foreach($used_Amenities as $item){  ?>
								   <tr><td><?php   echo $item->Name  ;   ?></td>
								   <td><?php   echo $item->Description  ;   ?></td>
								   <td><?php   echo $item->AmenitiesType  ;   ?></td>
								   <td><?php   echo $item->AmenitiesPrice  ;   ?></td>
								    <td>Active</td></tr>
								  
								   
								   <?php   } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
										</div>
									</div>
									<div class="tab-pane" role="tabpanel" id="complete">
										<div class="col-sm-12">
  <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                      
                        <div class="table-responsive col-sm-12">
                            <table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
                                <thead>
                                    <tr>
                                        <th><?= lang("id"); ?></th>
                                        <th>Bill No</th>
                                        <th>Bill Date</th>
                                        <th>Bill Raised By</th>
                                        <th>Bill Date</th>
                                        <th>Bill Am0unt</th>
                                        <th>Paid Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="8" class="dataTables_empty">
                                          No Data Found
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
        					</div>
							</div>
					 		
                 </div>
                 
					
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
