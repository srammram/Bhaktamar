<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Ex_staff') ?>"><?php echo lang('External_staff')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('External_staff')?></li>
          </ol>
</section>
<section class="content">
		  <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  <div class="box-body">
		 <div class="form-group col-md-6">
                            <label for="resident_relationship"><?php echo lang('resident_relationship')?>
                                :</label>
                       
                                    <?php  if(isset($External_staff->relatiotype)){ echo $External_staff->relatiotype == lang('family_member')  ?lang('family_member'):'' ;  } ?>
                                    <?php  if(isset($External_staff->relatiotype)){ echo $External_staff->relatiotype == lang('tenant')  ?lang('tenant'):'' ;  } ?>
                                    <?php  if(isset($External_staff->relatiotype)){ echo $External_staff->relatiotype == lang('assitant')  ? lang('assitant'):'' ;  } ?>
                                  
                            </select>
                        </div>
						 <div class="form-group col-md-6">
                            <label for="Occupancy_status"><?php echo lang('Occupancy_status')?>
                                :</label>
                                    <?php  if(isset($External_staff->occupy_status)){ echo $External_staff->occupy_status == lang('active')  ? lang('active'):'' ;  } ?>
                                    <?php  if(isset($External_staff->occupy_status)){ echo $External_staff->occupy_status == lang('inactive')  ?lang('inactive'):'' ;  } ?>
                          
                        </div>
						<div class="form-group col-md-6">
                            <label for="job_title">
                                <?php echo lang('job_title')?>:</label>
                   <?php if(isset($External_staff->job_title)){ echo $External_staff->job_title ; } ?>
                                
                        </div>
						<div class="form-group col-md-6">
                            <label for="company_name">
                                <?php echo lang('company_name')?>:</label>
                        <?php if(isset($External_staff->company_name)){ echo $External_staff->company_name ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fullname"><?php echo lang('fullname')?>:</label>
                   <?php if(isset($External_staff->full_name)){ echo $External_staff->full_name ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="salutation"><?php echo lang('Salutation')?> 
                                :</label>
                                    <?php  if(isset($External_staff->salutation)){ echo $External_staff->salutation == lang('Mr')  ?lang('Mr'):'' ;  } ?>
                                    <?php  if(isset($External_staff->salutation)){ echo $External_staff->salutation == lang('Ms')  ?lang('Ms'):'' ;  } ?>
                                    <?php  if(isset($External_staff->salutation)){ echo $External_staff->salutation == lang('Mrs')  ?lang('Mrs'):'' ;  } ?>
                                    <?php  if(isset($External_staff->salutation)){ echo $External_staff->salutation == lang('Dr')  ?lang('Dr'):'' ;  } ?>
                        </div>
						
                        <div class="form-group col-md-6">
                            <label for="surname"><?php echo lang('surname')?>
                                :</label>
                            <?php if(isset($External_staff->surname)){ echo $External_staff->surname ; } ?>
                     
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname"><?php echo lang('firstname')?>:</label>
                             <?php if(isset($External_staff->firstname)){ echo $External_staff->firstname ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nationality"><?php echo lang('Nationality')?>
                                :</label>
                        
                        <?php  foreach($nationalitylist as $item){ ?>
                                
                                <?php if(!empty($External_staff->nationality)) echo $External_staff->nationality == $item->NationalityID ? $item->Nationality:''  ?>
                                
                            <?php }				?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">
                                <?php echo lang('DOB')?>:</label>
                        <?php if(isset($External_staff->dob)){ echo $External_staff->dob ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sex"><?php echo lang('Sex')?>:</label>
                                    <?php  if(isset($External_staff->sex)){ echo $External_staff->sex == lang('Male')  ?lang('Male'):'' ;  } ?>
                                    <?php  if(isset($External_staff->sex)){ echo $External_staff->sex == lang('Female')  ?lang('Female'):'' ;  } ?>
                                    <?php  if(isset($External_staff->sex)){ echo $External_staff->sex == lang('transgender')  ? lang('transgender'):'' ;  } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idtype"><?php echo lang('Id_type')?>:</label>
                        
                                <?php  foreach($idtype as $item){ ?>
                                    <?php if(!empty($External_staff->id_type)) echo $External_staff->id_type == $item->id ?$item->id_type_name:''  ?>
                                <?php }				?>
                          
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idno"><?php echo lang('Id_no')?>:</label>
                            <div>
                          <?php if(isset($External_staff->id_no)){ echo $External_staff->id_no ; } ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="primary_phone"><?php echo lang('Primary_phone')?>:</label>
                         <?php if(isset($External_staff->primary_phone)){ echo $External_staff->primary_phone ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="handphone"><?php echo lang('handphone')?>:</label>
                      <?php if(isset($External_staff->handphone)){ echo $External_staff->handphone ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-12"
                                style="padding-left:0px;"><?php echo lang('add_communication_app') ?></label>
                            <div data-role="dynamic-fields">
                                <?php  if(!empty($External_staff->app_communication_details)){
								foreach (json_decode($External_staff->app_communication_details) as $item) {  ?>
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
                       <?php if(isset($External_staff->permanent_address)){ echo $External_staff->permanent_address ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="assigned_project"><?php echo lang('assigned_project')?>:</label>
                                <?php if(isset($project)){ foreach($project as $item) {		 ?>
                                    <?php  if(isset($External_staff->project_id)){ echo $External_staff->project_id == $item->id ?$item->Name:'' ;  } ?>
                                <?php } }    ?>
                         
                        </div>
                        <div class="form-group col-md-6">
                            <label for="assigned_unit"><?php echo lang('assigned_unit')?>:</label>
                         
							<?php if(!empty($projectunits)){ foreach($projectunits as $item){ $selected = in_array( $item->uid, json_decode($External_staff->units) ) ? ' selected="selected" ' : '';     ?>  
								<option value="<?php  echo $item->uid ?>" <?php echo $selected; ?>>
                                     <?php echo $item->unit_name  ?></option>
								<?php  }  } ?>
                         
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email"><?php echo lang('email')?>:</label>
                       <?php if(isset($External_staff->email)){ echo $External_staff->email ; } ?>
                        </div>
                      
                        <div class="form-group col-md-6">
                            <label><?php echo lang('attachment') ?></label>
                         
                            <?php  if(!empty($External_staff->attachments)){ foreach(json_decode($External_staff->attachments) as $doc){ 
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
                        </div>
                        <div class="col-md-6">
                            <label>VIP</label>
                            <input type="checkbox" name="vip" value="1"
                                <?php if(!empty($External_staff->vip) && $External_staff->vip==1){ echo 'checked' ; } ?> disabled>
                        </div>

                        
                </div><!-- /.box -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
