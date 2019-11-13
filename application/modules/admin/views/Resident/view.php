<style>
.table-bordered>thead>tr>th{
	    background-color: #FFF !important;
		color: black !important;
}
</style>
<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
           </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
			<li><a href="<?php echo site_url('admin/Resident') ?>"><?php echo lang('resident')?></a></li>
            <li class="active"><?php echo lang('view')?> <?php echo lang('resident')?></li>
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
                                    <?php  if(isset($resident->relatiotype)){ echo $resident->relatiotype == lang('family_member')  ?lang('family_member'):'' ;  } ?>
                                    <?php  if(isset($resident->relatiotype)){ echo $resident->relatiotype == lang('tenant')  ?lang('tenant'):'' ;  } ?>
                                    <?php  if(isset($resident->relatiotype)){ echo $resident->relatiotype == lang('assitant')  ?lang('assitant'):'' ;  } ?>
                        </div>
						 <div class="form-group col-md-6">
                            <label for="Occupancy_status"><?php echo lang('Occupancy_status')?> 
                                :</label>
                                    <?php  if(isset($resident->occupy_status)){ echo $resident->occupy_status == lang('temporary')  ?lang('temporary'):'' ;  } ?>
                                    <?php  if(isset($resident->occupy_status)){ echo $resident->occupy_status == lang('permanent')  ?lang('permanent'):'' ;  } ?>
                                    <?php  if(isset($resident->occupy_status)){ echo $resident->occupy_status == lang('inactive')  ?lang('inactive'):'' ;  } ?>
                                    
                          
                        </div>
						<div class="form-group col-md-6">
                            <label for="Start_date">
                                <?php echo lang('Start_date')?>:</label>
                            <?php if(!empty($resident->start_date) && $resident->start_date!='0000-00-00'){ echo $resident->start_date ; } ?>
                        </div>
						<div class="form-group col-md-6">
                            <label for="End_date">
                                <?php echo lang('End_date')?>:</label>
                            <?php if(isset($resident->end_date) && $resident->end_date!='0000-00-00'){ echo $resident->end_date ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fullname"><?php echo lang('fullname')?> :</label>
                           <?php if(isset($resident->full_name)){ echo $resident->full_name ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="salutation"><?php echo lang('Salutation')?> 
                                :</label>
                     
                                    <?php  if(isset($resident->salutation)){ echo $resident->salutation == lang('Mr')  ?lang('Mr'):'' ;  } ?>
                                    <?php  if(isset($resident->salutation)){ echo $resident->salutation == lang('Ms')  ?lang('Ms'):'' ;  } ?>
                                    <?php  if(isset($resident->salutation)){ echo $resident->salutation == lang('Mrs')  ?lang('Mrs'):'' ;  } ?>
                                    <?php  if(isset($resident->salutation)){ echo $resident->salutation == lang('Dr')  ?lang('Dr'):'' ;  } ?>
                                    
                            </select>
                        </div>
						
                        <div class="form-group col-md-6">
                            <label for="surname"><?php echo lang('surname')?>
                                :</label>
                          <?php if(isset($resident->surname)){ echo $resident->surname ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname"><?php echo lang('firstname')?>:</label>
                         <?php if(isset($resident->firstname)){ echo $resident->firstname ; } ?>
                        </div>

                        <?php  print_r($resident->nationality)  ?>
                        <div class="form-group col-md-6">
                            <label for="nationality"><?php echo lang('Nationality')?>
                                :</label>
                                <?php  foreach($nationalitylist as $item){ ?>
                                <?php if(!empty($resident->nationality)) echo $resident->nationality == $item->NationalityID ? $item->Nationality:''  ?>
                            <?php }				?>
                          
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">
                                <?php echo lang('DOB')?>:</label>
                            <?php if(isset($resident->dob)){ echo $resident->dob ; } ?>
                        </div>
                        <div class="form-group col-md-6">
						<?php print_r($resident->sex);  ?>
                            <label for="sex"><?php echo lang('Sex')?>:</label>
                        <?php  if(isset($resident->sex)){ echo $resident->sex == lang('Male')  ?lang('Male'):'' ;  } ?>
                           <?php  if(isset($resident->sex)){ echo $resident->sex == lang('Female')  ?lang('Female'):'' ;  } ?>
                              <?php  if(isset($resident->sex)){ echo $resident->sex == lang('transgender')  ?lang('transgender'):'' ;  } ?>
                            
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idtype"><?php echo lang('Id_type')?>:</label>
                                <?php  foreach($idtype as $item){ ?>
                                    <?php if(!empty($resident->id_type)) echo $resident->id_type == $item->id ?$item->id_type_name:''  ?>
                                <?php }				?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="idno"><?php echo lang('Id_no')?>:</label>
                            <div>
                                 <?php if(isset($resident->id_no)){ echo $resident->id_no ; } ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="primary_phone"><?php echo lang('Primary_phone')?>:</label>
                     <?php if(isset($resident->primary_phone)){ echo $resident->primary_phone ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="handphone"><?php echo lang('handphone')?>:</label>
                        <?php if(isset($resident->handphone)){ echo $resident->handphone ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-12"
                                style="padding-left:0px;"><?php echo lang('add_communication_app') ?></label>
                            <div data-role="dynamic-fields">
                                <?php  if(!empty($resident->app_communication_details)){
								foreach (json_decode($resident->app_communication_details) as $item) {  ?>
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
                          <?php if(isset($resident->permanent_address)){ echo $resident->permanent_address ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="assigned_project"><?php echo lang('assigned_project')?>:</label>

                                <?php if(isset($project)){ foreach($project as $item) {		 ?>
                                    <?php  if(isset($resident->project_id)){ echo $resident->project_id == $item->id ?$item->Name:'' ;  } ?>
                                   
                                <?php } }    ?>
                           
                        </div>
                        <div class="form-group col-md-6">
                            <label for="assigned_unit"><?php echo lang('assigned_unit')?>:</label>
                       
							<?php if(!empty($projectunits)){ foreach($projectunits as $item){ 
						//	$selected = in_array( $item->uid, json_decode($resident->units) ) ? ' selected="selected" ' : ''; 
if(isset($resident->units)){ echo $resident->units == $item->uid ?$item->unit_no:'' ;  }						
							?>  
								
								<?php  }  } ?>
                            
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email"><?php echo lang('email')?>:</label>
                    <?php if(isset($resident->email)){ echo $resident->email ; } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label><?php echo lang('attachment') ?></label>
                            <?php  if(!empty($resident->attachments)){ foreach(json_decode($resident->attachments) as $doc){ 
                                                  if(!empty($doc)){  	?>
                            <a style="margin-left:12px;"
                                href="<?php   echo  site_url('admin/Resident/download_otherdoc/'.$doc)  ?>"
                                class="btn btn-xs btn-danger">
                                <i class="glyphicon glyphicon-download-alt"></i><?php    echo $doc; ?></a>
                           <br>
                            <?php    } } } ?>
                        </div>
                        <div class="col-md-6">
                            <label>VIP</label>
                            <input type="checkbox" disabled name="vip" value="1"
                                <?php if(!empty($resident->vip) && $resident->vip==1){ echo 'checked' ; } ?>>
                        </div>
						 <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
					<h4 style="margin-left:12px;font-weight:bold;">Family Members</h4>
                        <div class="table-responsive col-sm-12">
                            <table id="UnitTable" class="table table-bordered table-hover table-striped reports-table">
                                <thead>
                                    <tr>
                                        <th><?= lang("id"); ?></th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Relationship</th>
                                        <th>ID NO</th>
                                        <th>DOB</th>
										<th>Photo</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php  if(!empty($resident->family_members)){ $i=1;foreach(json_decode($resident->family_members) as $row){  ?>
								<tr>
								<td><?php echo $i   ; ?></td>
								<td><?php echo $row->name   ; ?></td>
								<td><?php echo $row->gender   ; ?></td>
								<td><?php echo $row->age   ; ?></td>
								<td><?php echo $row->relationship   ; ?></td>
								<td><?php echo $row->id_no   ; ?></td>
								<td><?php echo $row->dob   ; ?></td>
								<td>
								<?php if(!empty($row->photo)){  ?>
								<img src="<?php echo base_url('uploads/resident/familymembers/'.$row->photo)?>"  height="60" width="60" alt="User Image"/>
								<?php   }else{ ?>
								<img src="<?php echo base_url('uploads/resident/familymembers/noimage.jpg')?>"  height="32" width="60" alt="User Image"/>
								<?php  }  ?>
								</td>
								</tr>
								<?php  $i++; } }else{  ?>
                                    <tr>
                                        <td colspan="8" class="dataTables_empty">
                                          No Data Found
                                        </td>
                                    </tr>
									
								<?php  } ?>
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
