<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
<script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<style>
.wizard {
    margin: 20px auto;
    background: #fff;
}
.wizard .nav-tabs {
    position: relative;
    margin: 20px auto;
    margin-bottom: 0;
    border-bottom-color: #e0e0e0;
}
.wizard .tab-content{
	padding: 15px 15px;}
.wizard > div.wizard-inner {
    position: relative;
}
.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width:69%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 30px;
    height: 30px;
    line-height: 30px;
    display: inline-block;
    border-radius: 0px;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
	background: #ccc;
	border-radius: 50px;
}
	small{
	position: absolute;
    top: 30px;
    width: 200px;
    color: #333;
    left: -18px;
    right: 0;
    font-weight: bold;
}
.wizard li.active span.round-tab {
    background: #2c3542;
    border: 2px solid #999;
    color: #fff;
}
.wizard li.active span.round-tab i{
    color: #337ab7;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 33.33%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 47%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #ccc;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 47%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #2c3542;
}

.wizard .nav-tabs > li a {
    width: 30px;
    height: 30px;
    margin: 20px auto 30px;
    border-radius: 0px;
    padding: 0;
}

.wizard .nav-tabs > li a:hover {
    background: transparent;
}
.wizard .tab-pane {
    position: relative;
    padding-top: 20px;
}
.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {
    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }
    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
</style>
<section class="content-header">
          <h1>
          <?php echo lang('tenant_form')?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Tenant') ?>"><?php echo lang('tenant_form')?></a></li>
          </ol>
</section>
<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
					<div class="booking_add">
							<div class="col-sm-12 col-xs-12">
							<div class="wizard">
            					<div class="wizard-inner">
                				<div class="connecting-line"></div>
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step1">
												<span class="round-tab">
												</span>
												<small>
													Unit Information
												</small>
											</a>
										</li>
										<li role="presentation" class="disabled">
											<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step2">
												<span class="round-tab">
												</span>
												<small>
													Personal Information
												</small>
											</a>
										</li>
										<li role="presentation" class="disabled">
											<a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
												<span class="round-tab">
												</span>
												<small>Family & Register</small>
											</a>
										</li>
									</ul>
            					</div>
					<form method="post" action="<?php echo site_url('admin/tenant/tenant_form/'.$id); ?>" enctype="multipart/form-data" id="tenantform">
					<div class="tab-content">
				     	<div class="tab-pane active" role="tabpanel" id="step1">
						 <div class="form-group col-md-6">
                            <label for="assigned_project"><?php echo lang('lease_unit_type')?>:</label>
                            <select name="lease_unit_type" id="lease_unit_type"  class="form-control chosen">
                                <option><?php echo lang('select')?></option>
                                
                                <option value="<?php echo lang('Owner_unit')?>"<?php echo set_select('lease_unit_type',lang('Owner_unit'), ( !empty($leaseunit_type) && $leaseunit_type == lang('Owner_unit') ? TRUE : FALSE )); ?>
                                    >
                                    <?php echo lang('Owner_unit')?></option>
                                <option value="<?php echo lang('Lease_unit')?>"<?php echo set_select('lease_unit_type',lang('Lease_unit'), ( !empty($leaseunit_type) && $leaseunit_type == lang('Lease_unit') ? TRUE : FALSE )); ?>
                                    >
                                    <?php echo lang('Lease_unit')?></option>
                            </select>
                        </div>
						 <div class="form-group col-md-6">
                            <label for="assigned_project"><?php echo lang('assigned_project')?>:</label>
                            <select name="assigned_project" id="project" class="form-control chosen"
                                onchange="get_building(this.value)">
                                <option><?php echo lang('select')?></option>
                                <?php if(isset($project)){ foreach($project as $item) {		 ?>
                                <option value="<?php  echo $item->id ?>"
                                    <?php  if(isset($project_id)){ echo $project_id == $item->id ?'selected':'' ;  } ?>>
                                    <?php echo $item->Name  ?></option>
                                <?php } }    ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="building"><?php echo lang('building')?>:</label>
                            <select name="building_id"  class="form-control " id="building"
                                onchange="get_lease_units(this.value)">
                                <option><?php echo lang('select')?></option>
                                <?php if(isset($buildings)){ foreach($buildings as $item) {		 ?>
                                <option value="<?php  echo $item->bldid ?>"
                                    <?php  if(isset($building_id)){ echo $building_id == $item->bldid ?'selected':'' ;  } ?>>
                                    <?php echo $item->name  ?></option>
                                <?php } }    ?>
                            </select>
                        </div>
						<div class="form-group col-md-6">
                            <label for="unit"><?php echo lang('unit')?>:</label>
                            <select name="unit" id="unit" class="form-control ">
                                <option><?php echo lang('select')?></option>
								<?php if(isset($leasesunits)){ foreach($leasesunits as $item) {		 ?>
                                <option value="<?php  echo $item->uid ?>"
                                    <?php  if(isset($assigned_unit)){ echo $assigned_unit == $item->uid ?'selected':'' ;  } ?>>
                                    <?php echo $item->unit_name  ?></option>
                                <?php } }    ?>
                               
                            </select>
                        </div>
                        	<div class="row"  style="margin: 0px;">
							<div class="form-group col-md-6">
								<label for="type"><?php echo lang('type')?>:</label>
								<select name="type"  class="form-control chosen" id="test">
									<option value="select"><?php echo lang('select')?></option>
									<option value="<?php echo lang('Rent')?>"
										<?php  if(isset($type)){ echo $type == lang('Rent')  ?'selected':'' ;  } ?>>
										<?php echo lang('Rent')?></option>
										 <option value="<?php echo lang('Lease')?>"
										<?php  if(isset($type)){ echo $type == lang('Lease')  ?'selected':'' ;  } ?>>
										<?php echo lang('Lease')?></option>
								</select>
							</div>
							</div>
							<div class="row" id="rent_se" style="display: none;margin: 0px;">
								<div class="form-group col-md-6">
									<label class="control-label">
										Amount
									</label>
									<input type="text" name="amount" class="form-control">
								</div>
								<div class="form-group col-md-6">
									<label class="control-label">
										Period
									</label>
									<select name="tenure_type" class="form-control" id="tenuretype">
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
							<div class="row" id="lease_se" style="display: none;margin: 0px;">
								<div class="form-group col-md-6">
									<label class="control-label">
										Amount
									</label>
									<input type="text" name="lease_amount"class="form-control">
								</div>
								
							</div>
						<div class="form-group col-md-6">
                            <label for="Start_date">
                                <?php echo lang('Start_date')?>:</label>
                            <input type="text" name="Start_date" id="Start_date" value=" <?php if(!empty($start_date) && $start_date!='0000-00-00'){ echo $start_date ; } ?>"
                                class="form-control datepicker " />
                        </div>
						<div class="form-group col-md-6">
                            <label for="End_date">
                                <?php echo lang('End_date')?>:</label>
                            <input type="text" name="End_date" id="End_date" value=" <?php if(isset($end_date) && $end_date!='0000-00-00'){ echo $end_date ; } ?>"
                                class="form-control datepicker" />
                        </div>
						<div class="form-group col-md-6">
                            <label><?php echo lang('attachment') ?></label>
                            <div data-role="dynamic-fields">
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="file" name="attachment[]" multiple class="form-control" />
                                    </div>
                                    <button class="btn btn-danger btn-sm" data-role="remove">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-role="add">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </div>
                            </div>
							 <?php  if(!empty($attachments)){ foreach(json_decode($attachments) as $doc){ 
                                                  if(!empty($doc)){  	?>
                            <!-- <a href="<?php echo  site_url('admin/Owner/download_attachment/'.$doc) ?> "
													 class="btn btn-default col-md-offset-1"><?php echo $doc ; ?></a> -->
                            <a style="margin-left:12px;"
                                href="<?php   echo  site_url('admin/Project/download_otherdoc/'.$doc)  ?>"
                                class="btn btn-xs btn-danger">
                                <i class="glyphicon glyphicon-download-alt"></i><?php    echo $doc; ?></a>
                            <span class="glyphicon glyphicon-remove"
                                onclick="delete_file('<?php echo $doc ; ?>')"></span><br>
                            <?php    } } } ?>
							</div>			<div class="col-sm-12">
												<ul class="list-inline pull-right">
													<li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
												</ul>
											</div>
										</div>
										<div class="tab-pane" role="tabpanel" id="step2">
                       
                        <div class="form-group col-md-6">
                            <label for="salutation"><?php echo lang('Salutation')?> <span class="errorStar">*</span>
                                :</label>
                            <select class="form-control select2" name="salutation">
                                <option value="">select</option>
                                <option value="<?php echo lang('Mr')?>"
                                    <?php  if(isset($salutation)){ echo $salutation == lang('Mr')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Mr')?></option>
                                <option value="<?php echo lang('Ms')?>"
                                    <?php  if(isset($salutation)){ echo $salutation == lang('Ms')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Ms')?></option>
                                <option value="<?php echo lang('Mrs')?>"
                                    <?php  if(isset($salutation)){ echo $salutation == lang('Mrs')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Mrs')?></option>
                                <option value="<?php echo lang('Dr')?>"
                                    <?php  if(isset($salutation)){ echo $salutation == lang('Dr')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Dr')?></option>
                            </select>
                        </div>
						
                        <div class="form-group col-md-6">
                            <label for="surname"><?php echo lang('surname')?>
                                :</label>
                            <input type="text" name="surname" value="<?php if(isset($surname)){ echo $surname ; } ?>"
                                id="surname" class="form-control" autocomplete="off" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname"><?php echo lang('firstname')?>:</label>
                            <input type="text" name="firstname"
                                value=" <?php if(isset($firstname)){ echo $firstname ; } ?>" id="firstname"
                                class="form-control" autocomplete="off" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nationality"><?php echo lang('Nationality')?>
                                :</label>
                                <select class="form-control  " name="nationality">
                                <option>Select </option>
                                <?php  foreach($nationalitylist as $item){ ?>
                                <option value="<?php echo $item->NationalityID ?>"
                                    <?php if(!empty($nationality)) echo $nationality == $item->NationalityID ?'selected':''  ?>>
                                    <?php echo $item->Nationality ?></option>
                                <?php }				?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">
                                <?php echo lang('DOB')?>:</label>
                            <input type="text" name="dob" id="dob" value=" <?php if(isset($dob)){ echo $dob ; } ?>"
                                class="form-control datepicker" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sex"><?php echo lang('Sex')?>:</label>
                            <select class="form-control " name="sex">
                                <option value="">select</option>
                                <option value="<?php echo lang('Male')?>"
                                    <?php  if(isset($sex)){ echo $sex == lang('Male')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Male')?></option>
                                <option value="<?php echo lang('Female')?>"
                                    <?php  if(isset($sex)){ echo $sex == lang('Female')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('Female')?></option>
                                <option value="<?php echo lang('transgender')?>"
                                    <?php  if(isset($sex)){ echo $sex == lang('transgender')  ?'selected':'' ;  } ?>>
                                    <?php echo lang('transgender')?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idtype"><?php echo lang('Id_type')?>:</label>
                            <select class="form-control " name="idtype">
                                <option>Select </option>
                                <?php  foreach($idtype as $item){ ?>
                                <option value="<?php echo $item->id ?>"
                                    <?php if(!empty($id_type)) echo $id_type == $item->id ?'selected':''  ?>>
                                    <?php echo $item->id_type_name ?></option>
                                <?php }				?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idno"><?php echo lang('Id_no')?>:</label>
                            <div>
                                <input type="text" name="id_no" id="id_no"
                                    value=" <?php if(isset($id_no)){ echo $id_no ; } ?>" class="form-control "
                                    autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="primary_phone"><?php echo lang('Primary_phone')?>:</label>
                            <input type="text" name="primary_phone" id="primary_phone"
                                value=" <?php if(isset($primary_phone)){ echo $primary_phone ; } ?>"
                                class="form-control " />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="handphone"><?php echo lang('handphone')?>:</label><span
                                    class="errorStar">*</span>
                            <input type="text" name="handphone"
                                value="<?php if(isset($handphone)){ echo $handphone ; } ?>" id="handphone"
                                class="form-control" autocomplete="off" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-12"
                                style="padding-left:0px;"><?php echo lang('add_communication_app') ?></label>
								<div data-role="dynamic-fields">
                                <?php  if(!empty($app_communication_details)){
								foreach ($app_communication_details as $item) {  ?>
                                <div class="form-inline">
                                    <div class="form-group col-md-5"
                                        style="padding-left:0px;padding-right:5px;margin-bottom:5px;">
                                        <input type="text" name="Appname[]" class="form-control"
                                            value="<?php echo $item->Appname;   ?>" placeholder="App name" />
                                    </div>
                                    <div class="form-group col-md-5"
                                        style="padding-left:0px;padding-right:15px;margin-bottom:5px;">
                                        <input type="text" name="Appid[]" class="form-control"
                                            value="<?php echo $item->Appid;   ?>" placeholder="App id" />
                                    </div>
                                    <button class="btn btn-danger btn_dan btn-sm" data-role="remove">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </div>
                                <?php   }
							}		?>

                            </div>
                            <div data-role="dynamic-fields">
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="text" name="Appname[]" class="form-control"
                                            placeholder="App name" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="Appid[]" class="form-control" placeholder="App id" />
                                    </div>
                                    <button class="btn btn-danger btn-sm" data-role="remove">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-role="add">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="permanent_address"><?php echo lang('permanent_address')?>:</label>
                            <input type="text" name="permanent_address"
                                value="<?php if(isset($permanent_address)){ echo $permanent_address ; } ?>"
                                id="permanent_address" class="form-control" autocomplete="off" />
                             </div>		
												<div class="col-sm-12">
													<ul class="list-inline pull-right">
														<li><button type="button" class="btn btn-default prev-step">Previous</button></li>

														<li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
													</ul>
												</div>
										</div>
										<div class="tab-pane" role="tabpanel" id="complete">
										 <div class="form-group col-md-6">
                            <label for="fullname"><?php echo lang('fullname')?> <span
                                    class="errorStar">*</span>:</label>
                            <input type="text" name="fullname"
                                value="<?php if(isset($full_name)){ echo $full_name ; } ?>" id="fullname"
                                class="form-control" autocomplete="off" />
                        </div>
										  <div class="form-group col-md-6">
                                         <label for="password"><?php echo lang('password')?>:</label>
                                           <input type="password" name="password" 
                                              id="password" class="form-control" />
                                               </div>
											    <div class="form-group col-md-6">
                                         <label for="confirm_password"><?php echo lang('confirm_password')?>:</label>
                                           <input type="password" name="confirm_password" 
                                              id="confirm_password" class="form-control" />
                                               </div>
												<div class="form-group col-md-12">
												<div data-role="dynamic-fields">
								<?php  if(!empty($family_members)){ foreach($family_members as $members){ 
								?>
								
                                  <div class="form-inline">
                                  <fieldset class="col-md-12 resident_sec">
									<legend>Family  Members</legend>
                                   <div class="row">
                                   	<div class="form-group col-sm-4">
                                       	<label class="control-label col-sm-12">Name</label>
                                       	<div class="col-sm-12">
                                       		 <input type="text" name="resident_name[]" class="form-control"  value="<?php echo $members->name  ;?>" />
                                       	</div>
                                    </div>
                                     <div class="form-group col-sm-4">
										   <label class="control-label col-sm-12">Gender</label>
											<div class="col-sm-12" style="margin-top: 7px;">
												<label class="radio-inline">
												  <input type="radio" name="optradio[]" value="1"
												  <?php if(!empty($members->name) && $members->name==1){ echo 'checked' ; } ?>
												  >Male
												</label>
												<label class="radio-inline">
												  <input type="radio" name="optradio[]" value="2"
												  <?php if(!empty($members->name) && $members->name==2){ echo 'checked' ; } ?>
												  >Female
												</label>
											 </div>
										</div>
                                  <div class="form-group col-sm-4">
											<label class="control-label col-sm-12">DOB</label>
											<div class="col-sm-12">
												 <input type="text" name="resident_dob[]" class="form-control datepicker" width="100%" value="<?php echo $members->dob  ;?>" />
											</div>
										</div>
                                   </div>
                                   <div class="row">
										<div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Age</label>
											<div class="col-sm-12">
												 <input type="text" name="resident_age[]" class="form-control" width="100%" value="<?php echo $members->age  ;?>" />
											</div>
										</div>
										<div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Id Number</label>
											<div class="col-sm-12">
												 <input type="text" name="resident_no[]" class="form-control" width="100%" value="<?php echo $members->id_no  ;?>" />
											</div>
										</div>
									<div class="form-group col-sm-4">
                                       <label class="control-label col-sm-12">Photo</label>
                                       <div class="col-sm-12">
                                        	<input type="file" name="memberPhoto[]" multiple class="form-control" />
										</div>
                                    </div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12" style="margin-bottom: 10px;">
											<label class="control-label col-sm-12">Relationship</label>
											<div class="col-sm-12">
												 <input type="text" class="form-control" name="relationship[]" value="<?php echo $members->relationship  ;?>">
											</div>
										</div>
										<div class="form-group col-sm-12">
                                 		 <button class="btn btn-danger btn-sm pull-right" data-role="remove">
											<span class="glyphicon glyphicon-remove"></span>
										</button>
										
                                 	</div>
									</div>
                                 	
                                   </fieldset>
									</div>
								<?php   } }  ?>
								<div data-role="dynamic-fields">
								
								 <div class="form-inline">
                                  <fieldset class="col-md-12 resident_sec">
									<legend>Family  Members</legend>
                                   <div class="row">
                                   	<div class="form-group col-sm-4">
                                       	<label class="control-label col-sm-12">Name</label>
                                       	<div class="col-sm-12">
                                       		 <input type="text" name="resident_name[]" class="form-control" />
                                       	</div>
                                    </div>
                                     <div class="form-group col-sm-4">
										   <label class="control-label col-sm-12">Gender</label>
											<div class="col-sm-12" style="margin-top: 7px;">
												<label class="radio-inline">
												  <input type="radio" name="optradio[]" value="1"
												  >Male
												</label>
												<label class="radio-inline">
												  <input type="radio" name="optradio[]" value="2">Female
												</label>
											 </div>
										</div>
                                  <div class="form-group col-sm-4">
											<label class="control-label col-sm-12">DOB</label>
											<div class="col-sm-12">
												 <input type="text" name="resident_dob[]" class="form-control datepicker" width="100%" />
											</div>
										</div>
                                   </div>
                                   <div class="row">
										<div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Age</label>
											<div class="col-sm-12">
												 <input type="text" name="resident_age[]" class="form-control" width="100%" />
											</div>
										</div>
										<div class="form-group col-sm-4">
											<label class="control-label col-sm-12">Id Number</label>
											<div class="col-sm-12">
												 <input type="text" name="resident_no[]" class="form-control" width="100%" />
											</div>
										</div>
									<div class="form-group col-sm-4">
                                       <label class="control-label col-sm-12">Photo</label>
                                       <div class="col-sm-12">
                                        	<input type="file" name="memberPhoto[]" multiple class="form-control" />
										</div>
                                    </div>
									</div>
									<div class="row">
										<div class="form-group col-sm-12" style="margin-bottom: 10px;">
											<label class="control-label col-sm-12">Relationship</label>
											<div class="col-sm-12">
												 <input type="text" class="form-control" name="relationship[]">
											</div>
										</div>
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
											<div class="col-sm-12 text-center">
												<ul class="list-inline">
												<input type="hidden" name="tentant_id" value="<?php if(!empty($tentant_id)){ echo $tentant_id; }  ?>">
													<li><button type="button" class="btn btn-default prev-step">Previous</button></li>
													<li><button type="submit" class="btn btn-primary next-step tenantformpost">Save </button></li>
												</ul>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
        					</div>
							</div>
			             	</div>
				    </form>
     			 </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
		
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
<script>
$(document).ready(function () {
//Wizard
$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
	var $target = $(e.target);
	if ($target.parent().hasClass('disabled')) {
		return false;
	}
});

$(".next-step").click(function (e) {
	var $active = $('.wizard .nav-tabs li.active');
	$active.next().removeClass('disabled');
	nextTab($active);

});
$(".prev-step").click(function (e) {
	var $active = $('.wizard .nav-tabs li.active');
	prevTab($active);

});
});

function nextTab(elem) {
$(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
$(elem).prev().find('a[data-toggle="tab"]').click();
}
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
<script>

$(".tenantformpost").click(function ()  {
    $("#tenantform").validate({
        excluded: ':disabled',
        rules: {
			fullname: {
                required: true,
            },
			salutation: {
                required: true,
            },
            unit: {
                required: true,
            },
           password : {
                    minlength : 5
                },
                confirm_password : {
                    minlength : 5,
                    equalTo : "#password"
                }
			
        },

        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block animated fadeInDown',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
});

</script>
<script>
	$('#test').on('change', function() {
  //  alert( this.value ); // or $(this).val()
  if(this.value == "Rent") {
    $('#rent_se').show();
    $('#lease_se').hide();
  } 
	else if(this.value=="Lease"){
	  	$('#rent_se').hide();
    	$('#lease_se').show();
		}
	else{
		$('#rent_se').hide();
    	$('#lease_se').hide();
	}
	
});
	</script>