 <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js">
 </script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
 <script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
 <style>
.btn-group {
    width: 100%;
}

.multiselect {
    width: 100%;
}

.multiselect-container {
    width: 100%;
}
.error {
    color: #FF0000;
}

 </style>
 <?php  $seg= $this->uri->segment(4);?>
 <section class="content-header">
     <h1>
         <?php echo $page_title; ?>
     </h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard')?></a></li>
         <li><a href="<?php echo site_url('admin/Project') ?>"> <?php echo lang('Project')?> </a></li>
         <li class="active"><?php echo (empty($seg))?lang('add'):lang('edit');?></li>
     </ol>
 </section>
 <section class="content">
     <div class="row">
         <div class="col-xs-12">
             <div id="exTab1">
                 <div class="tab-content clearfix">
                     <div class="tab-pane active" id="1a">
                         <div class="box">
                             <div class="box-header">
                                 <h3 class="box-title"><?php echo lang('Project'); ?></h3>
                             </div><!-- /.box-header -->
                             <div class="box-body">
                                 <form method="post" action="<?php echo site_url('admin/Project/form/'.$id); ?>"
                                     enctype="multipart/form-data" id="projectform">
                                     <div class="form-group">
                                         <div class="row">
                                             <div class="col-md-5">
                                                 <label><?php echo lang('Name') ?> <span
                                                         class="errorspan">*</span></label>
                                                 <input type="text" name="Name" class="form-control"
                                                     value="<?php if(isset($Name)){ echo $Name;  }   ?>"
                                                     autocomplete="off">
                                            </div>
                                             <div class="col-md-5">
                                                 <label><?php echo lang('developer') ?></label>
                                                 <input type="text" name="developer" class="form-control"
                                                     value="<?php if(!empty($developer)){ echo $developer;  }   ?>"
                                                     autocomplete="off">
                                             </div>
                                         </div>
                                     </div>

                                     <div class="form-group">
                                         <div class="row">
                                             <div class="col-md-5">
                                                 <label><?php echo lang('ProjectType') ?><span
                                                         class="errorspan">*</span></label>
                                                 <select name="projecttype[]" class="form-control my-select" multiple="multiple">
                                                     <option value="">Select</option>
                                                     <?php if(!empty($projecttype)){ foreach($projecttype as $propertytypes){ 
													 	$selected = in_array( $propertytypes->id, $project_type ) ? ' selected="selected" ' : '';    ?>
                                                     <option value="<?php  echo $propertytypes->id   ?>"
                                                        <?php echo $selected; ?>>
                                                         <?php  echo $propertytypes->ProjectType  ?></option>
                                                     <?php } } ?>
                                                 </select>
                                             </div>
                                             <div class="col-md-5">
                                                 <label><?php echo lang('Start_date') ?> <span
                                                         class="errorspan">*</span></label>
                                                 <input type="text" name="Start_date" id="start_date"
                                                     class="form-control datepicker" autocomplete='off'
                                                     value="<?php if(!empty($start_date)){ echo $start_date;  }   ?>">
                                             </div>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">
                                             <div class="col-md-5">
                                                 <label><?php echo lang('complete_date') ?></label>
                                                 <input type="text" name="complete_date" id="end_date"
                                                     class="form-control datepicker" autocomplete='off'
                                                     value="<?php if(!empty($project_completion_date)){ echo $project_completion_date;  }   ?>">
                                             </div>
                                             <div class="col-md-5">
                                                 <label><?php echo lang('Project_area') ?> (Sqm) <span
                                                         class="errorspan">*</span></label>
                                                 <input type="text" name="Project_area"
                                                     class="form-control allowdecimalpoint"
                                                     value="<?php if(!empty($Project_area)){ echo $Project_area;  }   ?>"
                                                     autocomplete="off">
                                             </div>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">
                                             <div class="col-md-5">
                                                 <label><?php echo lang('shared_public_area') ?> (Sqm)</label>
                                                 <input type="text" name="shared_public_area"
                                                     class="form-control allowdecimalpoint"
                                                     value="<?php if(!empty($shared_public_area)){ echo $shared_public_area;  }   ?>"
                                                     autocomplete="off">
                                             </div>
											  <div class="col-md-5">
                                                 <label><?php echo lang('Planned_building') ?> <span
                                                         class="errorspan">*</span></label>
                                                 <input type="text" name="Planned_building"
                                                     class="form-control allownumber"
                                                     value="<?php if(!empty($Planned_building)){ echo $Planned_building;  }   ?>">
                                             </div>
                                           
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">
										   <div class="col-md-5">
                                                 <label><?php echo lang('Planned_floors') ?> <span
                                                         class="errorspan">*</span></label>
                                                 <input type="text" name="Planned_floors"
                                                     class="form-control allownumber"
                                                     value="<?php if(!empty($planned_floors)){ echo $planned_floors;  }   ?>">
                                             </div>
                                             <div class="col-md-5">
                                                 <label><?php echo lang('Planned_unit') ?> <span
                                                         class="errorspan">*</span></label>
                                                 <input type="text" name="Planned_unit" class="form-control allownumber"
                                                     value="<?php if(isset($planned_units)){ echo $planned_units;  }   ?>">
                                             </div>
											  
                                            
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">
										 <div class="col-md-5">
                                                 <label><?php echo lang('Current_status') ?></label>
                                                 <select name="projectstatus" class="form-control" id="gender">
                                                     <option>Select</option>
                                                     <option value="<?php echo lang('Yet')  ?>"
                                                         <?php  if(isset($project_status)){ echo $project_status == lang('Yet')  ?'selected':'' ;  } ?>>
                                                         <?php echo lang('Yet')  ?></option>
                                                     <option value="<?php echo lang('Ongoing')  ?>"
                                                         <?php  if(isset($project_status)){ echo $project_status == lang('Ongoing') ?'selected':'' ;  } ?>>
                                                         <?php echo lang('Ongoing')  ?></option>
                                                     <option value="<?php echo lang('Completed')  ?>"
                                                         <?php  if(isset($project_status)){ echo $project_status == lang('Completed') ?'selected':'' ;  } ?>>
                                                         <?php echo lang('Completed')  ?></option>
                                                     <option value="<?php echo lang('OnHold')  ?>"
                                                         <?php  if(isset($project_status)){ echo $project_status == lang('OnHold') ?'selected':'' ;  } ?>>
                                                         <?php echo lang('OnHold')  ?></option>
                                                 </select>
                                             </div>
                                              <div class="col-md-5">
                                                 <label><?php echo lang('Legal_description') ?></label>
                                                 <textarea name="legaldescription"
                                                     class="form-control"><?php if(!empty($legal_descrioption)){ echo $legal_descrioption;  }   ?></textarea>
                                             </div>
                                           
                                         </div>

                                     </div>
                                     <div class="form-group">
                                         <div class="row">
										   <div class="col-md-5">
                                                 <label><?php echo lang('emergency_contact') ?></label>
                                                 <input type="text" name="emergency_contact" class="form-control"
                                                     value="<?php if(isset($emergency_contact)){ echo $emergency_contact;  }   ?>">
                                             </div>
                                             <div class="col-md-5">
                                                 <label><?php echo lang('facilities') ?></label><br>
                                                 <select name="facilities[]" class="form-control "
                                                    >
													<option value="">Select</option>
                                                     <?php if(!empty($facilities)) { foreach($facilities as $item){
													
													$selected = in_array( $item->Fac_id, $facilites ) ? ' selected="selected" ' : ''; 	 ?>
                                                     <option value="<?php  echo $item->Fac_id ?>"
                                                         <?php echo $selected; ?>>
                                                         <?php echo $item->Facility_name  ?></option>
                                                     <?php } }     ?>
                                                 </select>
                                             </div>
                                            
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">
										  <div class="col-md-5">
                                                 <label><?php echo lang('add_contractors') ?></label><br>
                                                 <select name="contractors[]" class="form-control"
                                                    >
													<option value="">Select</option>
                                                     <?php if(!empty($contractor)) { foreach($contractor as $item)
				                                          {	  $selected = in_array( $item->contractor_id, $contractors ) ? ' selected="selected" ' : ''; 	 ?>
                                                     <option value="<?php  echo $item->contractor_id ?>"
                                                         <?php echo $selected; ?>>
                                                         <?php echo $item->con_Name  ?></option>
                                                     <?php } }    ?>
                                                 </select>
                                             </div>
                                             <div class="col-md-5">
                                                 <label><?php echo lang('Project_start_date') ?></label>
                                                 <input type="text" name="project_start_date"
                                                     class="form-control datepicker"
                                                     value="<?php if(isset($pm_contract_start_date)){ echo $pm_contract_start_date;  }   ?>">
                                              </div>
                                             
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">
										 <div class="col-md-5">
                                                 <label><?php echo lang('pm_contract_duration') ?></label>
                                                 <input type="text" name="contract_duration"
                                                     class="form-control allowdecimalpoint"
                                                     value="<?php if(isset($pm_contract_duration)){ echo $pm_contract_duration;  }   ?>"
                                                     autocomplete="off">
                                             </div>
                                             <div class="col-md-5">
                                                 <label><?php echo lang('vendor_Name') ?></label><br>
                                                 <select name="vendor[]" class="form-control ">
												   <option value="">Select</option>
                                                     <?php if(!empty($vendors)) { foreach($vendors as $item) {	  $selected = in_array( $item->service_provider_id, $vendor) ? ' selected="selected" ' : ''; 	 ?>
                                                     <option value="<?php  echo $item->service_provider_id ?>"
                                                         <?php echo $selected; ?>>
                                                         <?php echo $item->sp_name  ?></option>
                                                     <?php } }     ?>
                                                 </select>
                                             </div>
                                            
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">
										  <div class="col-md-5">
                                                 <label><?php echo lang('address') ?></label>
                                                 <textarea name="address"
                                                     class="form-control"><?php if(isset($address)){ echo $address;  }   ?></textarea>
                                             </div>
                                             <div class="col-md-5">
                                                 <label><?php echo lang('PM_information') ?></label>
                                                 <textarea name="pm_information"
                                                     class="form-control"><?php if(isset($pm_information)){ echo $pm_information;  }   ?></textarea>
                                               </div>
                                               
                                           </div>
                                           </div>
										    <div class="form-group">
                                                 <div class="row">
												   <div class="col-md-5">
                                                 <label><?php echo lang('HandBook') ?></label>
                                                  <input type="file" name="handbook" class="form-control">
						                               <?php    if(!empty($attachment)){ ?><a style="margin-left:12px;" href="<?php   echo  site_url('admin/Project/download_Attachment/'.$attachment)  ?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-download-alt"></i><?php    echo $attachment; ?></a>  <?php   }?>
                                             </div>
										       <div class=" col-md-5">
                                                 <label for="soc">Project Stages</label><span
                                          class="errorStar">*</span></label><br>
                                           <select name="soc[]" class="form-control my-select" multiple="multiple">
                                               <?php if(isset($soc)){ foreach($soc as $item){
							 			$selected = in_array( $item->id, $soc_id ) ? ' selected="selected" ' : '';    ?>
                                         <option value="<?php  echo $item->id ?>" <?php echo $selected; ?>>
                                      <?php echo $item->Name  ?></option>
                                         <?php  }  }    ?>
                                           </select>
                                                </div>
												</div>
												</div>
						    <div class="form-group">
                                                 <div class="row">
										 <div class="col-md-5">
                                                 <label><?php echo lang('legal_document') ?></label>
                                                 <div data-role="dynamic-fields">
                                                     <div class="form-inline">
                                                         <div class="form-group">
                                                             <input type="file" name="legal_doc[]" multiple
                                                                 class="form-control" />
                                                         </div>
                                                         <button class="btn btn-danger btn-sm" data-role="remove">
                                                             <span class="glyphicon glyphicon-remove"></span>
                                                         </button>
                                                         <button class="btn btn-primary btn-sm" data-role="add">
                                                             <span class="glyphicon glyphicon-plus"></span>
                                                         </button>
                                                     </div>
                                                 </div>
                                                 <?php  if(!empty($legal_document)){ foreach($legal_document as $doc){ 
                                                  if(!empty($doc)){  	?>
                                                <!-- <a href="<?php echo  site_url('admin/Project/download_otherdoc/'.$doc) ?> "
													 class="btn btn-default col-md-offset-1"><?php echo $doc ; ?></a> -->
													<a style="margin-left:12px;" href="<?php   echo  site_url('admin/Project/download_otherdoc/'.$doc)  ?>" class="btn btn-xs btn-danger">
													<i class="glyphicon glyphicon-download-alt"></i><?php    echo $doc; ?></a> 
                                                 <span class="glyphicon glyphicon-remove"
                                                     onclick="delete_file('<?php echo $doc ; ?>')"></span><br>
                                                 <?php    } } } ?>
                                                </div>
                                            </div>  
											
										 
							   </div>
                                    
										 
                                     <div class="box-footer">
                                         <input type="hidden" name="id"  id="projectid"value="<?php   echo $id; ?>">
                                         <input class="btn btn-primary" type="submit" id="project_form_submit"
                                             value="Save" />
                                     </div>
                                 </form>
                             </div><!-- /.box-body -->
                         </div><!-- /.box -->
                       
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div><!-- /.col -->
                     </div><!-- /.row -->
 </section>
 <script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>
 <script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>
 <script src="<?php echo base_url('assets/admin/') ?>/plugins/datepicker/bootstrap-datepicker.js"></script>
 <script src="<?php echo base_url('assets/admin/plugins')?>/jquery-validation/jquery.validate.min.js"></script>
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
function delete_file(str) {
    var projectid = $('#projectid').val();
    var postUrl = getBaseURL() + 'admin/Project/doc_delete';
    $.ajax({
        type: "POST",
        url: postUrl,
        data: {
            doc: str,
            projectid: projectid
        },
        cache: false,
        success: function(result) {
            location.reload(true);
        }
    });
}
</script>
 
 