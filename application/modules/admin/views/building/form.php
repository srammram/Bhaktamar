 <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js">
 </script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
 <script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
 <style>
.multiselect {
    width: 240px;
    border-radius: 0px;
}

.error {
    color: #FF0000;
}

#gender-error {
    width: 200px;
    padding-top: 15px;
}

.approved_se tbody tr td label {
    color: #666;
    font-size: 14px;
    font-weight: normal;
}

.approved_se {
    margin-top: 40px;
    table-layout: fixed;
}

.approved_se thead tr th {
    background-color: #eee;
}

.approved_se:first-child {
    margin-top: 0px;
}

.approved_sec label {
    display: block;
    padding-left: 15px;
    text-indent: -15px;
}

.approved_sec .checkbox_s {
    width: 13px;
    height: 13px;
    padding: 0;
    margin: 0;
    vertical-align: bottom;
    position: relative;
    top: -1px;
    *overflow: hidden;
}

.ui-draggable,
.ui-droppable {
    background-position: top;
}

.approved_sec .form-control {
    border-radius: 0px;
}

.icheckbox_square-blue {
    margin-right: 5px;
}

.multiselect-container {
    height: 200px;
    overflow-y: scroll;
}

.form-inline {
    margin-bottom: 5px;
}

.form-inline .form-control {
    width: 100%;
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
         <li><a href="<?php echo site_url('admin/building') ?>"> <?php echo lang('building')?> </a></li>
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
                                 <h3 class="box-title"><?php echo lang('building'); ?></h3>
                             </div><!-- /.box-header -->
                             <div class="box-body">
                                 <form method="post" action="<?php echo site_url('admin/building/form/'.$id); ?>"
                                     enctype="multipart/form-data" id="buildingform">
                                     <div class="form-group">
                                         <div class="row">
                                             <div class="col-md-2">
                                                 <label><?php echo lang('Name') ?> <span
                                                         class="errorspan">*</span></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <input type="text" name="Name" class="form-control"
                                                     value="<?php if(isset($Name)){ echo $Name;  }   ?>"
                                                     autocomplete="off">
                                             </div>
                                             <div class="col-md-2">
                                                 <label><?php echo lang('project') ?></label>
                                             </div>
                                             <div class="col-md-3">

                                             <select class="form-control  chosen" name="project_id">
                                                 <option value="">Select</option>
                                                <?php  if(!empty($project)){ foreach($project  as $row){  ?>
                                                 <option value="<?php echo $row->id  ;  ?>" <?php  if(isset($project_id)){ echo $project_id == $row->id ?'selected':'' ;  } ?>><?php  echo $row->Name;     ?></option>
                                                <?php     } } ?>
                                             </select>
                                                
                                             </div>
                                         </div>
                                     </div>

                                     <div class="form-group">
                                         <div class="row">

                                             <div class="col-md-2">
                                                 <label><?php echo lang('Start_date') ?> <span
                                                         class="errorspan">*</span></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <input type="text" name="Start_date" id="start_date"
                                                     class="form-control datepicker" autocomplete='off'
                                                     value="<?php if(!empty($start_date)){ echo $start_date;  }   ?>" onkeydown="return false" >
                                             </div>
                                             <div class="col-md-2">
                                                 <label><?php echo lang('complete_date') ?></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <input type="text" name="complete_date" id="end_date"
                                                     class="form-control datepicker" autocomplete='off'
                                                     value="<?php if(!empty($project_completion_date)){ echo $project_completion_date;  }   ?>" onkeydown="return false">
                                             </div>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">

                                             <div class="col-md-2">
                                                 <label><?php echo lang('area') ?> (Sqm) <span
                                                         class="errorspan">*</span></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <input type="text" name="area" class="form-control allowdecimalpoint"
                                                     value="<?php if(!empty($Project_area)){ echo $Project_area;  }   ?>"
                                                     autocomplete="off">
                                             </div>
                                             <div class="col-md-2">
                                                 <label><?php echo lang('shared_public_area') ?> (Sqm)</label>
                                             </div>
                                             <div class="col-md-3">
                                                 <input type="text" name="shared_public_area"
                                                     class="form-control allowdecimalpoint"
                                                     value="<?php if(!empty($shared_public_area)){ echo $shared_public_area;  }   ?>"
                                                     autocomplete="off">
                                             </div>
                                         </div>
                                     </div>

                                     <div class="form-group">
                                         <div class="row">

                                             <div class="col-md-2">
                                                 <label><?php echo lang('Planned_floors') ?> <span
                                                         class="errorspan">*</span></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <input type="text" name="Planned_floors"
                                                     class="form-control allownumber"
                                                     value="<?php if(!empty($planned_floors)){ echo $planned_floors;  }   ?>">
                                             </div>
                                             <div class="col-md-2">
                                                 <label><?php echo lang('Planned_unit') ?> <span
                                                         class="errorspan">*</span></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <input type="text" name="Planned_unit" class="form-control allownumber"
                                                     value="<?php if(isset($planned_units)){ echo $planned_units;  }   ?>">
                                             </div>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">

                                             <div class="col-md-2">
                                                 <label><?php echo lang('Legal_description') ?></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <textarea name="legaldescription"
                                                     class="form-control"><?php if(!empty($legal_descrioption)){ echo $legal_descrioption;  }   ?></textarea>
                                             </div>
                                             <div class="col-md-2">
                                                 <label><?php echo lang('legal_document') ?></label>
                                             </div>
                                             <div class="col-md-3">
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
                                                 <a style="margin-left:12px;"
                                                     href="<?php   echo  site_url('admin/Project/download_otherdoc/'.$doc)  ?>"
                                                     class="btn btn-xs btn-danger">
                                                     <i
                                                         class="glyphicon glyphicon-download-alt"></i><?php    echo $doc; ?></a>
                                                 <span class="glyphicon glyphicon-remove"
                                                     onclick="delete_file('<?php echo $doc ; ?>')"></span><br>
                                                 <?php    } } } ?>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">

                                             <div class="col-md-2">
                                                 <label><?php echo lang('status') ?></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <select name="projectstatus" class="form-control  chosen">
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
                                             <div class="col-md-2">
                                                 <label><?php echo lang('add_contractors') ?></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <select name="contractors[]" class="form-control my-select"
                                                     multiple="multiple">
                                                     <?php if(!empty($contractor)) { foreach($contractor as $item)
				                                          {	  $selected = in_array( $item->contractor_id, $contractors ) ? ' selected="selected" ' : ''; 	 ?>
                                                     <option value="<?php  echo $item->contractor_id ?>"
                                                         <?php echo $selected; ?>>
                                                         <?php echo $item->con_Name  ?></option>
                                                     <?php } }    ?>
                                                 </select>
                                             </div>
                                         </div>

                                     </div>
                                     <div class="form-group">
                                         <div class="row">
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">
                                             <div class="col-md-2">
                                                 <label><?php echo lang('Project_start_date') ?></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <input type="text" name="contract_start_date"
                                                     class="form-control datepicker"
                                                     value="<?php if(isset($pm_contract_start_date)){ echo $pm_contract_start_date;  }   ?>" onkeydown="return false">
                                             </div>
                                             <div class="col-md-2">
                                                 <label><?php echo lang('pm_contract_duration') ?></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <input type="text" name="contract_duration"
                                                     class="form-control allowdecimalpoint"
                                                     value="<?php if(isset($pm_contract_duration)){ echo $pm_contract_duration;  }   ?>"
                                                     autocomplete="off">
                                             </div>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">
                                             <div class="col-md-2">
                                                 <label><?php echo lang('address') ?></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <textarea name="address"
                                                     class="form-control"><?php if(isset($address)){ echo $address;  }   ?></textarea>
                                             </div>
                                             <div class="col-md-2">
                                                 <label><?php echo lang('emergency_contact') ?></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <input type="text" name="emergency_contact" class="form-control allownumber"
                                                     value="<?php if(isset($emergency_contact)){ echo $emergency_contact;  }   ?>">
                                             </div>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">

                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <div class="row">
                                             <div class="col-md-2">
                                                 <label><?php echo lang('HandBook') ?></label>
                                             </div>
                                             <div class="col-md-3">
                                                 <input type="file" name="handbook" class="form-control">
                                                 <?php    if(!empty($attachment)){ ?><a style="margin-left:12px;"
                                                     href="<?php   echo  site_url('admin/Project/download_Attachment/'.$attachment)  ?>"
                                                     class="btn btn-xs btn-danger"><i
                                                         class="glyphicon glyphicon-download-alt"></i><?php    echo $attachment; ?></a>
                                                 <?php   }?>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="box-footer">
                                         <input type="hidden" name="id" id="projectid" value="<?php   echo $id; ?>">
                                         <input class="btn btn-primary" type="submit" id="project_form_submit"
                                             value="Save" />
                                     </div>
                                 </form>
                             </div><!-- /.box-body -->
                         </div><!-- /.box -->

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