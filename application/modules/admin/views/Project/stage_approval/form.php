 <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/jquery.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/admin')?>/dist/js/bootstrap-multiselect.min.js">
 </script>
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
 <link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/chosen.min.css">
 <script src="<?php echo base_url('assets/admin')?>/dist/js/chosen.jquery.min.js"></script>
 <style>

 </style>
 <?php  $seg= $this->uri->segment(4);?>
 <section class="content-header">
     <h1><?php echo $page_title; ?></h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard')?></a></li>
         <li><a href="<?php echo site_url('admin/Project/stage_approval') ?>"> <?php echo lang('stage_approval')?> </a>
         </li>
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
                                 <form method="post" action="<?php echo site_url('admin/Project/approvedform/'.$id); ?>"
                                     enctype="multipart/form-data" id="projectform">
                                     <div class="form-group">
                                         <div class="row">
                                             <div class="col-md-5">
                                                 <label><?php echo lang('Name') ?> </label><br>
                                                 <?php if(isset($project->Name)){ echo $project->Name;  }   ?>
                                             </div>
                                             <div class="col-md-5">
                                                 <label><?php echo lang('developer') ?></label><br>
                                                 <?php if(!empty($project->developer)){ echo $project->developer;  }   ?>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="box approved_sec">
                                         <div class="box-header">
                                             <h3 class="box-title"><?php echo lang('ApprovedStages'); ?></h3>
                                         </div><!-- /.box-header -->
                                         <div class="box-body">
                                             <div class="wel col-sm-12">
                                                 <div class="table_">
                                                     <?php   if(isset($projectStages)){ foreach($projectStages as $item){    ?>
                                                     <h4><?php  echo  $item->Name;   ?></h4>
                                                     <table class="table table-bordered approved_se">
                                                         <thead>
                                                             <tr>
                                                                 <th><?php echo lang('Approved_stages'); ?></th>
                                                                 <th><?php echo lang('Approved_Date'); ?></th>
                                                                 <th><?php echo lang('Approved_Expired_date'); ?></th>
                                                                 <th><?php echo lang('Approved_Description'); ?></th>
                                                                 <th><?php echo lang('Approved_Document'); ?></th>
                                                             </tr>
                                                         </thead>
                                                         <tbody>
                                                             <?php  if(!empty($activestage)){ foreach($activestage as $stage){  if($stage->stage_id ==$item->id){ ?>
                                                             <tr>
                                                                 <td><label>
                                                                         <input type="hidden" name="projectstages[]"
                                                                             value="<?php  echo $item->id;  ?>">
                                                                         <input class="checkbox_s" value=""
                                                                             name="isApproved[]" value="1" type="checkbox" <?php  if(isset($stage->is_approved)){ echo ($stage->is_approved ==1)? 'checked': '';
						                                              	 
						                                        }  ?> />
                                                                         <?php echo $item->Name;   ?></label></td>
                                                                 <td><input type="text" name="approveddate[]"
                                                                         class="form-control datepicker" value="<?php  if(isset($stage)){
						                                                 	echo $stage->approved_date;
						                                       }  ?>" id="datepicker"></td>
                                                                 <td><input type="text" name="expireddate[]"
                                                                         class="form-control datepicker" value="<?php  if(isset($stage)){
						                                                 	echo $stage->expired_date;
						                                         }  ?>" id="datepicker1"></td>
                                                                 <td><textarea rows="2" name="description[]"
                                                                         style="width: 100%;height: 34px;"><?php  if(isset($stage)){
						                                                   	echo $stage->description;
						                                               }  ?> 
																	   </textarea></td>
                                                                 <td><input type="file" name="document[]"
                                                                         class="form-control"><?php  if(isset($stage)){
							                                                   if(isset( $stage->document_path)){  ?> <a
                                                                         href="<?php echo site_url('admin/Project/downloadDocument/'.$id)?>"><i
                                                                             class="glyphicon glyphicon-download-alt"
                                                                             aria-hidden="true"></i></a><br> <?php }
						                                                    }  ?></td>
                                                             </tr>
                                                             <?php    }else{ ?>


 <tr>
                                                                 <td><label>
                                                                         <input type="hidden" name="projectstages[]"
                                                                             value="<?php  echo $item->id;  ?>">
                                                                         <input class="checkbox_s" value="1"
                                                                             name="isApproved[]" type="checkbox" <?php  if(isset($query)){
						                                              	echo 'checked';
						                                        }  ?> /><?php echo $item->Name;   ?></label></td>
                                                                 <td><input type="text" name="approveddate[]"
                                                                         class="form-control datepicker" value="<?php  if(isset($query)){
						                                                 	echo $query->Approved_date;
						                                       }  ?>" id="datepicker"></td>
                                                                 <td><input type="text" name="expireddate[]"
                                                                         class="form-control datepicker" value="<?php  if(isset($query)){
						                                                 	echo $query->Expired_date;
						                                         }  ?>" id="datepicker1"></td>
                                                                 <td><textarea rows="2" name="description[]"
                                                                         style="width: 100%;height: 34px;"><?php  if(isset($query)){
						                                                   	echo $query->Description;
						                                               }  ?> </textarea></td>
                                                                 <td><input type="file" name="document[]"
                                                                         class="form-control"><?php  if(isset($query)){
							                                       if(isset( $query->Document_path)){  ?> <a
                                                                         href="<?php echo site_url('admin/Project/downloadDocument/'.$id)?>"><i
                                                                             class="glyphicon glyphicon-download-alt"
                                                                             aria-hidden="true"></i></a><br> <?php }
						                                                    }  ?></td>
                                                             </tr>







															 <?php   }}   }else{   ?>
                                                             <tr>
                                                                 <td><label>
                                                                         <input type="hidden" name="projectstages[]"
                                                                             value="<?php  echo $item->id;  ?>">
                                                                         <input class="checkbox_s" value="1"
                                                                             name="isApproved[]" type="checkbox" <?php  if(isset($query)){
						                                              	echo 'checked';
						                                        }  ?> /><?php echo $item->Name;   ?></label></td>
                                                                 <td><input type="text" name="approveddate[]"
                                                                         class="form-control datepicker" value="<?php  if(isset($query)){
						                                                 	echo $query->Approved_date;
						                                       }  ?>" id="datepicker"></td>
                                                                 <td><input type="text" name="expireddate[]"
                                                                         class="form-control datepicker" value="<?php  if(isset($query)){
						                                                 	echo $query->Expired_date;
						                                         }  ?>" id="datepicker1"></td>
                                                                 <td><textarea rows="2" name="description[]"
                                                                         style="width: 100%;height: 34px;"><?php  if(isset($query)){
						                                                   	echo $query->Description;
						                                               }  ?> </textarea></td>
                                                                 <td><input type="file" name="document[]"
                                                                         class="form-control"><?php  if(isset($query)){
							                                       if(isset( $query->Document_path)){  ?> <a
                                                                         href="<?php echo site_url('admin/Project/downloadDocument/'.$id)?>"><i
                                                                             class="glyphicon glyphicon-download-alt"
                                                                             aria-hidden="true"></i></a><br> <?php }
						                                                    }  ?></td>
                                                             </tr>
                                                             <?php  }  ?>
                                                         </tbody>
                                                     </table>
                                                     <?php  } } ?>
                                                 </div>
                                                 <div class="box-footer">
                                                     <input type="hidden" name="id" id="projectid"
                                                         value="<?php   echo $id; ?>">
                                                     <input class="btn btn-primary" type="submit"
                                                         id="project_form_submit" value="Save" />
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
$('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
});
 </script>