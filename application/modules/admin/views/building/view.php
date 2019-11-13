 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js">
 </script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
 <script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
 <section class="content-header">
     <h1>
         <?php echo $page_title; ?>
     </h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard')?></a></li>
         <li><a href="<?php echo site_url('admin/building') ?>"><?php echo lang('building')?></a></li>
         <li class="active"><?php echo lang('view')?> <?php echo lang('building')?></li>
     </ol>
 </section>
 <section class="content">
     <div class="row">
         <div class="col-xs-12">
             <div class="box">
                 <div class="box-body">

                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-2">
                                 <label><?php echo lang('Name') ?> </label>
                             </div>
                             <div class="col-md-3">
                                 <?php  if(!empty($building->name)) {   echo $building->name; }  ?>
                             </div>
                             <div class="col-md-2">
                                 <label><?php echo lang('developer') ?></label>
                             </div>
                             <div class="col-md-3">
                                 <?php  if(!empty($building->developer_name)) {   echo $building->developer_name; }  ?>
                             </div>
                         </div>
                     </div>

                     <div class="form-group">
                         <div class="row">
                             
                             <div class="col-md-2">
                                 <label><?php echo lang('Start_date') ?> </label>
                             </div>
                             <div class="col-md-3">
                                 <?php  if(!empty($building->start_date)) {   echo $building->start_date; }  ?>
                             </div>
                             <div class="col-md-2">
                                 <label><?php echo lang('complete_date') ?></label>
                             </div>
                             <div class="col-md-3">
                                 <?php  if(!empty($building->planned_completion_date)) {   echo $building->planned_completion_date; }  ?>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="row">
                         
                             <div class="col-md-2">
                                 <label><?php echo lang('area') ?> (Sqm) </label>
                             </div>
                             <div class="col-md-3">
                                 <?php  if(!empty($building->total_area)) {   echo $building->total_area; }  ?>
                             </div>
                             <div class="col-md-2">
                                 <label><?php echo lang('shared_public_area') ?> (Sqm)</label>
                             </div>
                             <div class="col-md-3">
                                 <?php  if(!empty($building->shared_public_area)) {   echo $building->shared_public_area; }  ?>
                             </div>
                         </div>
                     </div>

                     <div class="form-group">
                         <div class="row">
                          
                             <div class="col-md-2">
                                 <label><?php echo lang('Planned_floors') ?></label>
                             </div>
                             <div class="col-md-3">
                                 <?php  if(!empty($building->planned_floors)) {   echo $building->planned_floors; }  ?>
                             </div>
                             <div class="col-md-2">
                                 <label><?php echo lang('Planned_unit') ?></label>
                             </div>
                             <div class="col-md-3">
                                 <?php  if(!empty($building->planned_units)) {   echo $building->planned_units; }  ?>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="row">
                            
                             <div class="col-md-2">
                                 <label><?php echo lang('Legal_description') ?></label>
                             </div>
                             <div class="col-md-3">
                                 <?php if(!empty($building->legal_description)){ echo $building->legal_description;  }   ?>
                             </div>
                             <div class="col-md-2">
                                 <label><?php echo lang('legal_document') ?></label>
                             </div>
                             <div class="col-md-3">
                                 <?php  if(!empty($building->legal_document)){ foreach(json_decode($building->legal_document) as $doc){ 
if(!empty($doc)){  	?>
                                 <!-- <a href="<?php echo  site_url('admin/building/download_otherdoc/'.$doc) ?> "
class="btn btn-default col-md-offset-1"><?php echo $doc ; ?></a> -->
                                 <a style="margin-left:12px;"
                                     href="<?php   echo  site_url('admin/building/download_otherdoc/'.$doc)  ?>"
                                     class="btn btn-xs btn-danger">
                                     <i class="glyphicon glyphicon-download-alt"></i><?php    echo $doc; ?></a>
                                 <br>
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
                                 <?php  if(isset($building->status)){ echo $building->status == lang('Yet')  ? lang('Yet'):'' ;  } ?>
                                 <?php  if(isset($building->status)){ echo $building->status == lang('Ongoing') ? lang('Ongoing'):'' ;  } ?>
                                 <?php  if(isset($building->status)){ echo $building->status == lang('Completed') ? lang('Completed'):'' ;  } ?>
                                 <?php  if(isset($building->status)){ echo $building->status == lang('OnHold') ? lang('OnHold'):'' ;  } ?>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="row">
                            
                             <div class="col-md-2">
                                 <label><?php echo lang('add_contractors') ?></label>
                             </div>
                             <div class="col-md-3">

                                 <?php if(!empty($building->contractors)) { foreach($contractor as $item)
{	  $selected = in_array( $item->contractor_id, json_decode($building->contractors) ) ? ' selected="selected" ' : ''; 	 ?>
                                 <option value="<?php  echo $item->contractor_id ?>" <?php echo $selected; ?>>
                                     <?php echo $item->con_Name  ?></option>
                                 <?php } }    ?>

                             </div>
                             <div class="col-md-2">
                                 <label><?php echo lang('Project_start_date') ?></label>
                             </div>
                             <div class="col-md-3">

                                 <?php if(!empty($building->contractor_start_date)){ echo $building->contractor_start_date;  }   ?>

                             </div>
                             
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="row">
                             
                         <div class="col-md-2">
                                 <label><?php echo lang('pm_contract_duration') ?></label>
                             </div>
                             <div class="col-md-3">
                                 <?php if(!empty($building->contarctor_duration)){ echo $building->contarctor_duration;  }   ?>
                             </div>
                             <div class="col-md-2">
                                 <label><?php echo lang('address') ?></label>
                             </div>
                             <div class="col-md-3">
                                 <?php if(!empty($building->address)){ echo $building->address;  }   ?>

                             </div>
                         </div>
                     </div>
                    
                     <div class="form-group">
                         <div class="row">
                             <div class="col-md-2">
                                 <label><?php echo lang('emergency_contact') ?></label>
                             </div>
                             <div class="col-md-3">
                                 <?php if(!empty($building->emergency_contact)){ echo $building->emergency_contact;  }   ?>
                             </div>
                             <div class="col-md-2">
                                 <label><?php echo lang('HandBook') ?></label>
                             </div>


                             <div class="col-md-3">
                                 <?php    if(!empty($building->attachment)){ ?><a style="margin-left:12px;"
                                     href="<?php   echo  site_url('admin/building/download_Attachment/'.$building->attachment)  ?>"
                                     class="btn btn-xs btn-danger"><i
                                         class="glyphicon glyphicon-download-alt"></i><?php    echo $building->attachment; ?></a>
                                 <?php   }?>
                             </div>
                         </div>
                     </div>
                    
                     <div class="box-footer">

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