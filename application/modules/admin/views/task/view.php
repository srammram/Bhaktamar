 <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link href="<?php echo base_url('assets/admin/plugins/iCheck/all.css')?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('assets/admin')?>/dist/css/bootstrap-datepicker.min.css">
<link href="<?php echo base_url('assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.css')?>" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?php echo base_url('assets/admin/plugins/redactor/redactor.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/admin/plugins/clockpicker/bootstrap-clockpicker.min.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/multiselect/css/multi-select.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/responsivetabs/responsive-tabs.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/admin/plugins/responsivetabs/style.css')?>" rel="stylesheet" type="text/css" />
 <?php  $seg= $this->uri->segment(4);?>
 <section class="content-header">
     <h1>
         <?php echo $page_title; ?>
     </h1>
     <ol class="breadcrumb">
         <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i>
                 <?php echo lang('dashboard')?></a></li>
         <li><a href="<?php echo site_url('admin/Task') ?>"> <?php echo lang('Task')?> </a></li>
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
                                 <h3 class="box-title"><?php echo lang('Task'); ?></h3>
                             </div><!-- /.box-header -->
                             <div class="box-body">
                                                <div class=" show" id="new-task-panel" >
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Task Name</label><br>
                                                                <?php if(!empty($task->taskName)){ echo $task->taskName;  } ?>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
														<div class="col-md-6">
                                                            <label class="control-label">Parent Task</label>
                                                            <div class="form-group">
                                                                  <?php if(!empty($task->taskName)){ echo $task->taskName;  } ?>
                                                            </div>
                                                        </div>
														<div class="col-md-6">
                                                            <label class="control-label">Project</label>
                                                            <div class="form-group">
                                                                 <?php if(!empty($task->project)){ echo $task->project;  } ?>
                                                            </div>
                                                        </div>
														<div class="col-md-6">
                                                            <label class="control-label">Project Stage</label>
                                                            <div class="form-group">
                                                                 <?php if(!empty($task->stage)){ echo $task->stage;  } ?>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Start Date</label><br>
                                                               <?php if(!empty($task->start_date)){ echo $task->start_date;  } ?>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Due Date</label><br>
                                                                <?php if(!empty($task->due_date)){ echo $task->due_date;  } ?>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        
                                                        <div class="col-md-6">
                                                            <label class="control-label">Assigned To</label>
                                                            <div class="form-group">
                                                                 <?php if(!empty($task->first_name)){ echo $task->first_name;  } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 Taskstatus" >
                                                            <label class="control-label">Status</label>
                                                            <div class="form-group">
                                                                  <?php if(!empty($task->status)){ echo $task->status;  } ?>
                                                            </div>
                                                        </div>

                                                        <!--/span-->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Priority</label>
                                                              <?php if(!empty($task->priority)){ echo $task->priority;  } ?>
                                                            </div>
                                                        </div>
														 <div class="col-md-12">
														<b> <?php echo lang('content_section');?> <?php echo lang('description');?></b>
														<div class="form-group">
										  <?php if(!empty($task->comments)){ echo $task->comments;  } ?>
									</div>	
								  </div>		
								</div>
                                  </div>		
								</div>        
                                </div>
                            </div>
                        </div>
                                   
                             </div><!-- /.box-body -->
                         </div>
                     </div><!-- /.row -->
 </section>
<script src="<?php echo base_url('assets/admin/plugins/iCheck/icheck.min.js')?>" type="text/javascript"></script>		
<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.js');?>"></script>		
<script type="text/javascript" src="<?php echo base_url('assets/admin/plugins/redactor/redactor.min.js');?>"></script>		
<script src="<?php echo base_url('assets/admin/plugins/clockpicker/bootstrap-clockpicker.min.js')?>" type="text/javascript"></script>		
<script src="<?php echo base_url('assets/admin/plugins/multiselect/js/jquery.multi-select.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/multiselect/js/jquery.quicksearch.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/responsivetabs/jquery.responsiveTabs.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js')?>"></script>