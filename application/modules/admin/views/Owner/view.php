<style>
fieldset{background-color:transparent;border-color: #ccc;padding:0px!important;border-radius: 0px;}
	.input-group {margin-bottom: 10px;float: left!important;position: relative;padding: 0px 15px 0px!important;}
	.pull-right{    float: right!important;}
	.input-group-addon{border: none;}
	.input-group .form-control{border: none;}
	fieldset div{padding: 0px!important;}
	.nav-pills>li>a {
    	border-radius: 0;
    	color: #444;
    	background-color: #fff;
   	 	border: 1px solid #0c0d0e;
    	border-top: 3px solid #0c0d0e;
	}
	.nav-pills>li.active>a{
			border: 1px solid #3c8dbc;
		    border-top: 3px solid #035280;
			color: #fff;
	}
</style>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Owner') ?>"><?php echo lang('Owner')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('Owner')?></li>
          </ol>
</section>
<section>
	<div class="col-sm-12">
	
</div>
</section>
<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  <div class="box-body">
                   <div id="exTab1">
						<ul class="nav nav-pills well well-sm">
							<li class="active"><a href="#1a" data-toggle="tab" aria-expanded="false">Owner View</a></li>
							<li><a href="#2a" data-toggle="tab" aria-expanded="false">Units Details</a></li>
						</ul>
						<div class="tab-content clearfix well well-sm">
							<div class="tab-pane active" id="1a">
									<div class="col-sm-12 well well-sm" style="background-color: #fff;">
									<div class="form-group col-md-6">
											<label for="fullname"><?php echo lang('fullname')?> :</label>
										 <?php if(isset($Owner->full_name)){ echo $Owner->full_name ; } ?>
										</div>
										<div class="form-group col-md-6">
											<label for="salutation"><?php echo lang('Salutation')?> 
												:</label>
													<?php  if(isset($Owner->salutation)){ echo $Owner->salutation == lang('Mr')  ? lang('Mr'):'' ;  } ?>


													<?php  if(isset($Owner->salutation)){ echo $Owner->salutation == lang('Ms')  ?lang('Ms'):'' ;  } ?>


													<?php  if(isset($Owner->salutation)){ echo $Owner->salutation == lang('Mrs')  ? lang('Mrs'):'' ;  } ?>


													<?php  if(isset($Owner->salutation)){ echo $Owner->salutation == lang('Dr')  ? lang('Dr'):'' ;  } ?>

											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="surname"><?php echo lang('surname')?>
												:</label>
										 <?php if(isset($Owner->surname)){ echo $Owner->surname ; } ?>
										</div>
										<div class="form-group col-md-6">
											<label for="firstname"><?php echo lang('firstname')?>:</label>
										   <?php if(isset($Owner->firstname)){ echo $Owner->firstname ; } ?>
										</div>
										<div class="form-group col-md-6">
											<label for="nationality"><?php echo lang('Nationality')?>
											:</label>
												<?php  foreach($nationalitylist as $item){ ?>
													<?php if(!empty($Owner->nationality)) echo $Owner->nationality == $item->NationalityID ? $item->Nationality:''  ?>
												<?php }				?>
										</div>
										<div class="form-group col-md-6">
											<label for="dob">
												<?php echo lang('DOB')?>:</label>
										   <?php if(isset($Owner->dob)){ echo $Owner->dob ; } ?>

										</div>
										<div class="form-group col-md-6">
											<label for="sex"><?php echo lang('gender')?>:</label>
													<?php  if(isset($Owner->sex)){ echo $Owner->sex == lang('Male')  ? lang('Male'):'' ;  } ?>
													<?php  if(isset($Owner->sex)){ echo $Owner->sex == lang('Female')  ? lang('Female'):'' ;  } ?>
													<?php  if(isset($Owner->sex)){ echo $Owner->sex == lang('transgender')  ? lang('transgender'):'' ;  } ?> 

										</div>
										<div class="form-group col-md-6">
											<label for="idtype"><?php echo lang('Id_type')?>:</label>
												<?php  foreach($idtype as $item){ ?>
													<?php if(!empty($Owner->id_type)) echo $Owner->id_type == $item->id ? $item->id_type_name:''  ?>
												<?php }				?>
										</div>
										<div class="form-group col-md-6">
											<label for="idno"><?php echo lang('Id_no')?>:</label>
											<div>
											   <?php if(isset($Owner->id_no)){ echo $Owner->id_no ; } ?>
											</div>
										</div>
										<div class="form-group col-md-6">
											<label for="primary_phone"><?php echo lang('Primary_phone')?>:</label>
										<?php if(isset($Owner->primary_phone)){ echo $Owner->primary_phone ; } ?>
										</div>
										<div class="form-group col-md-6">
											<label for="handphone"><?php echo lang('handphone')?>:</label>
										 <?php if(isset($Owner->handphone)){ echo $Owner->handphone ; } ?>
										</div>
										<div class="form-group col-md-6">
											<label class="col-sm-12"
												style="padding-left:0px;"><?php echo lang('add_communication_app') ?></label>
											<!--<div class="col-sm-12" style="padding-left:0px;">-->
											<div data-role="dynamic-fields">

												<?php  if(!empty(json_decode($Owner->app_communication_details))){
												foreach (json_decode($Owner->app_communication_details) as $item) {  ?>
												<div class="form-inline">
													<div class="form-group col-md-5"
														style="padding-left:0px;padding-right:5px;margin-bottom:5px;">
													   <?php echo $item->Appname;   ?>
													</div>
													<div class="form-group col-md-5"
														style="padding-left:0px;padding-right:15px;margin-bottom:5px;">
														<?php echo $item->Appid;   ?>
													</div>

												</div>
												<?php   }
											}		?>
											</div>
										</div>

										<div class="form-group col-md-6">
											<label for="permanent_address"><?php echo lang('permanent_address')?>:</label>
										<?php if(isset($Owner->permanent_address)){ echo $Owner->permanent_address ; } ?>
										</div>
										<div class="form-group col-md-6">
											<label for="assigned_project"><?php echo lang('assigned_project')?>:</label>
												<?php if(isset($project)){ foreach($project as $item) {		 ?>

													<?php  if(isset($Owner->project_id)){ echo $Owner->project_id == $item->id ? $item->Name:'' ;  } ?>

												<?php } }    ?>

										</div>
										<div class="form-group col-md-6">

											<label for="assigned_unit"><?php echo lang('assigned_unit')?>:</label>
											<!--<select class="selectpicker show-menu-arrow form-control assigned_unit" name="assigned_unit[]" id="assigned_unit" data-style="form-control" data-live-search="true" title="-- Select Assigned unit --" multiple="multiple">-->

											<?php if(!empty($projectunits)){ foreach($projectunits as $item){ echo $selected = in_array( $item->uid, json_decode($Owner->units) ) ? $item->unit_name : '';     ?>  

												<?php  }  } ?>
											</select>
										</div>

										<div class="form-group col-md-6">
											<label for="email"><?php echo lang('email')?>:</label>
									   <?php if(isset($Owner->email)){ echo $Owner->email ; } ?>
										</div>

										<div class="form-group col-md-6">
											<?php  if(!empty($Owner->attachments)){ ?>  <label><?php echo lang('attachment') ?></label> <?php foreach(json_decode($Owner->attachments) as $doc){ 
																  if(!empty($doc)){  	?>
											<!-- <a href="<?php echo  site_url('admin/Owner/download_attachment/'.$doc) ?> "
																	 class="btn btn-default col-md-offset-1"><?php echo $doc ; ?></a> -->
											<a style="margin-left:12px;"
												href="<?php   echo  site_url('admin/Project/download_otherdoc/'.$doc)  ?>"
												class="btn btn-xs btn-danger">
												<i class="glyphicon glyphicon-download-alt"></i><?php    echo $doc; ?></a>
										   <br>
											<?php    } } } ?>
										</div>

										<div class="col-md-6">
											<label>VIP</label>
											<input type="checkbox" name="vip" value="1"
												<?php if(!empty($Owner->vip) && $Owner->vip==1){ echo 'checked' ; } ?> disabled>
										</div>
										<div class="form-group col-md-6">
											<label class="col-sm-12"
												style="padding-left:0px;"><?php echo lang('card_details') ?></label>
											<!--<div class="col-sm-12" style="padding-left:0px;">-->
										 <fieldset class="col-sm-12">
											<div data-role="dynamic-fields">
											 <?php   if(!empty($Owner->card_details)){  foreach(json_decode($Owner->card_details) as $row){ ?>
												<div class="form-inline col-sm-12 col-xs-12">
												 <div class="row">
													 <div class="input-group col-sm-6 col-xs-12">
														<?php echo $row->cardholdername  ;   ?>
													</div>
													<div class="input-group col-sm-6 col-xs-12">
														<?php echo $row->cardnumber  ;   ?>
													</div>
													<div class="input-group col-sm-6 col-xs-12">
														<?php echo $row->expired  ;   ?>
													</div>
													<div class="input-group col-sm-6 col-xs-12">
														<?php echo $row->cvv  ;   ?>
													</div>
													<div class="input-group col-sm-12 col-xs-12 " style="margin: 0px 0px 5px;">
													</div>
											   </div>
											 </div>
											 <?php   }   } ?>
											</div>
										 </fieldset>

										</div>
								</div>
							</div>
							<div class="tab-pane" id="2a">
									<div class="table-responsive col-sm-12">
                            <table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
                                <thead>
                                    <tr>
                                        <th><?= lang("id"); ?></th>
                                        <th><?php echo lang('project'); ?></th>
                                        <th><?php echo lang('building'); ?></th>
                                        <th><?php echo lang('floor'); ?></th>
                                        <th><?php echo lang('unit'); ?></th>
                                        <th><?php echo lang('Intension'); ?></th>
                                        <th><?php echo lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php   if(!empty($activeunits)){ $i=0; foreach($activeunits as $row){ $i++; ?>
                                    <tr>
									<td ><?php   echo $i; ?></td>
                                        <td ><?php  echo $row->project  ;  ?></td>
										<td ><?php  echo $row->building  ;  ?></td>
										<td ><?php  echo $row->floors  ;  ?></td>
										<td ><?php  echo $row->unit_name  ;  ?></td>
										
										<td ></td>
										<td ></td>
                                    </tr>
								<?php  }  }  ?>
                                </tbody>
                            </table>
                        </div>
							</div>
							
						</div>
					</div>     
                </div><!-- /.box -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
