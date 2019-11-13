<script src="<?php echo site_url('assets/admin/dist/js/Planner.js') ?>"></script>
<script src='<?php echo site_url('assets/admin/dist/js') ?>/moment.min.js'></script>
<script src='<?php echo site_url('assets/plugin/') ?>/fullcalendar/fullcalendar.min.js'></script>
<script src="<?php echo site_url('assets/admin/dist/js') ?>/jquery-ui.js"></script>
<script src='<?php echo site_url('assets/plugin/') ?>/fullcalendar/moment.min.js'></script>
<link href='<?php echo site_url('assets/plugin/') ?>/fullcalendar/fullcalendar.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo site_url('assets/plugin/') ?>/daterangepicker/daterangepicker-bs3.css' rel='stylesheet' media='screen'>
<link href='<?php echo site_url('assets/plugin/') ?>/datepicker/datepicker3.css' rel='stylesheet' media='screen'>
<link href='<?php echo site_url('assets/plugin/') ?>/daterangepicker/daterangepicker-bs3.css' rel='stylesheet' media='screen'>
<link href='<?php echo site_url('assets/plugin/') ?>/timepicker/bootstrap-timepicker.min.css' rel='stylesheet' media='screen'>
<link href='<?php echo site_url('assets/plugin/') ?>/fullcalendar/fullcalendar.min.css' rel='stylesheet' media='screen'>

<section class="content-header">
          <h1>
            <?php echo $page_title; ?>
            <small><?php echo lang('list'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> <?php echo lang('dashboard')?></a></li>
            <li class="active"><?php echo lang('Project'); ?></li>
			<li class="active"><?php echo lang('Project_Progress_planner'); ?></li>
          </ol>
</section>
<section class="content">
<div class="row">
    <div class="col-md-12">
        <!-- Calender Start from Here -->
        <div class="box"><!-- /primary heading -->
            <div id="portlet2" class="panel-collapse collapse in">
                <div class="box-body" style="">
                    <div id="calendar" class="col-centered"></div>
                    <!-- Modal -->
                    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<input type="hidden" id="projectstage" value="<?php  echo $Projectstageid;  ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
               <form class="addEvent form-horizontal" id="addEventForm">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo lang('Add_Task'); ?></h4>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="title" class="col-sm-2 control-label"><?php echo lang('Title'); ?></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="Task" class="col-sm-2 control-label"><?php echo lang('Task_list'); ?></label>
                                            <div class="col-sm-10">
                                                 <select name="Tasklist" class="form-control" id="Task">
												 <option value="">Choose</option>
												 <?php  if(isset($tasklist)){ foreach($tasklist as $list){  ?>
                                                    <option  value="<?php echo $list->id;    ?>"><?php  echo $list->TaskName;     ?></option>
												 <?php  } }   ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="color" class="col-sm-2 control-label"><?php echo lang('Color'); ?></label>
                                            <div class="col-sm-10">
                                                <select name="color" class="form-control" id="color">
                                                    <option value="">Choose</option>
                                                    <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                                    <option style="color:#008000;" value="#008000">&#9724; Green</option>
                                                    <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                                    <option style="color:#000;" value="#000">&#9724; Black</option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="start" class="col-sm-2 control-label"><?php echo lang('StartDate'); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text"  name="start" class="form-control" id="start" data-date-format="yyyy-mm-dd">
                                            </div>

                                            <label for="start" class="col-sm-2 control-label"><?php echo lang('Time'); ?></label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-timepicker timepicker">
                                                    <input type="text" value="18:30:15"  name="startTime" class="form-control" id="startTime" data-date-format="HH:mm:ss">
                                                </div>
                                            </div>
                                        </div>
										

                                        <div class="form-group">
                                            <label for="end" class="col-sm-2 control-label"><?php echo lang('EndDate'); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="end" class="form-control" id="end" data-date-format="yyyy-mm-dd" >
                                            </div>

                                            <label for="start" class="col-sm-2 control-label"><?php echo lang('Time'); ?></label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-timepicker timepicker">
                                                    <input type="text"  value="18:30:15" name="endTime" class="form-control" id="endTime" data-date-format="HH:mm:ss">
                                                </div>
                                            </div>
                                        </div>
										
										
										<div class="form-group">
                                            <label for="cost" class="col-sm-2 control-label"><?php echo lang('Actual_cost'); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="Cost" class="form-control" id="Cost"  >
                                            </div>

                                            <label for="labour" class="col-sm-2 control-label"><?php echo lang('Actual_Labour'); ?></label>
                                            <div class="col-sm-4">
                                                <div class="input-group  ">
                                                    <input type="text"  name="labour" class="form-control" id="labour">
                                                </div>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="Timeline" class="col-sm-2 control-label"><?php echo lang('Actual_Time'); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="Timeline" class="form-control" id="Timeline"  >
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="input-group ">
												 <select name="Timelinetype" class="form-control" id="Timelinetype">
                                                        <option value="<?php  echo lang('Days')   ?>" <?php  if(isset($TaskwiseLabourlist->PaymentPeriod)){ echo $TaskwiseLabourlist->PaymentPeriod == lang('Days')  ?'selected':'' ;  } ?>>
                                                 <?php  echo lang('Days')   ?>
                                                      </option>
                                                  <option value="<?php  echo lang('Week')   ?>" <?php  if(isset($TaskwiseLabourlist->PaymentPeriod)){ echo $TaskwiseLabourlist->PaymentPeriod == lang('Week')  ?'selected':'' ;  } ?>>
                                                 <?php  echo lang('Week')   ?>
                                                            </option>
                                                              <option value="<?php  echo lang('Month')   ?>" <?php  if(isset($TaskwiseLabourlist->PaymentPeriod)){ echo $TaskwiseLabourlist->PaymentPeriod == lang('Month')  ?'selected':'' ;  } ?>>
                                                       <?php  echo lang('Month')   ?>
								                          </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<input type="hidden" name="add" value="add">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('Close'); ?></button>
                                        <button type="submit" id="addEvent" class="btn btn-primary"><?php echo lang('Save'); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form class="editEvent form-horizontal">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo lang('Edit_task'); ?></h4>
                                    </div>
                                    <div class="modal-body">
<div class="form-group">
                                            <label for="title" class="col-sm-2 control-label"><?php echo lang('Title'); ?></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="Task" class="col-sm-2 control-label"><?php echo lang('Task_list'); ?></label>
                                            <div class="col-sm-10">
                                                 <select name="Tasklist" class="form-control" id="Task">
												 <option value="">Choose</option>
												 <?php  if(isset($tasklist)){ foreach($tasklist as $list){  ?>
                                                    <option  value="<?php echo $list->id;    ?>"><?php  echo $list->TaskName;     ?></option>
												 <?php  } }   ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="color" class="col-sm-2 control-label"><?php echo lang('Color'); ?></label>
                                            <div class="col-sm-10">
                                                <select name="color" class="form-control" id="color">
                                                    <option value="">Choose</option>
                                                    <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                                    <option style="color:#008000;" value="#008000">&#9724; Green</option>
                                                    <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                                    <option style="color:#000;" value="#000">&#9724; Black</option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="start" class="col-sm-2 control-label"><?php echo lang('StartDate'); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text"  name="start" class="form-control" id="start" data-date-format="yyyy-mm-dd">
                                            </div>

                                            <label for="start" class="col-sm-2 control-label"><?php echo lang('Time'); ?></label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-timepicker timepicker">
                                                    <input type="text"  name="startTime" class="form-control" id="startTime" data-date-format="HH:mm:ss">
                                                </div>
                                            </div>
                                        </div>
										

                                        <div class="form-group">
                                            <label for="end" class="col-sm-2 control-label"><?php echo lang('EndDate'); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="end" class="form-control" id="end" data-date-format="yyyy-mm-dd" >
                                            </div>

                                            <label for="start" class="col-sm-2 control-label"><?php echo lang('Time'); ?></label>
                                            <div class="col-sm-4">
                                                <div class="input-group bootstrap-timepicker timepicker">
                                                    <input type="text"  name="endTime" class="form-control" id="endTime" data-date-format="HH:mm:ss">
                                                </div>
                                            </div>
                                        </div>
										
										
										<div class="form-group">
                                            <label for="cost" class="col-sm-2 control-label"><?php echo lang('Actual_cost'); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="Cost" class="form-control" id="Cost"  >
                                            </div>

                                            <label for="labour" class="col-sm-2 control-label"><?php echo lang('Actual_Labour'); ?></label>
                                            <div class="col-sm-4">
                                                <div class="input-group  ">
                                                    <input type="text"  name="labour" class="form-control" id="labour">
                                                </div>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="Timeline" class="col-sm-2 control-label"><?php echo lang('Actual_Time'); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="Timeline" class="form-control" id="Timeline"  >
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="input-group ">
												 <select name="Timelinetype" class="form-control" id="Timelinetype">
                                                        <option value="<?php  echo lang('Days')   ?>" <?php  if(isset($TaskwiseLabourlist->PaymentPeriod)){ echo $TaskwiseLabourlist->PaymentPeriod == lang('Days')  ?'selected':'' ;  } ?>>
                                                 <?php  echo lang('Days')   ?>
                                                      </option>
                                                  <option value="<?php  echo lang('Week')   ?>" <?php  if(isset($TaskwiseLabourlist->PaymentPeriod)){ echo $TaskwiseLabourlist->PaymentPeriod == lang('Week')  ?'selected':'' ;  } ?>>
                                                 <?php  echo lang('Week')   ?>
                                                            </option>
                                                              <option value="<?php  echo lang('Month')   ?>" <?php  if(isset($TaskwiseLabourlist->PaymentPeriod)){ echo $TaskwiseLabourlist->PaymentPeriod == lang('Month')  ?'selected':'' ;  } ?>>
                                                       <?php  echo lang('Month')   ?>
								                          </select>
                                                </div>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" class="form-control" id="id">
										


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('Close'); ?></button>
                                        <button type="submit" id="editEvent" class="btn btn-primary"><?php echo lang('Save'); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</div>
</section>
<script src='<?php echo site_url('assets/plugin/') ?>/daterangepicker/moment.min.js'></script>
<script src='<?php echo site_url('assets/plugin/') ?>/daterangepicker/daterangepicker.js'></script>
<script src='<?php echo site_url('assets/plugin/') ?>/datepicker/bootstrap-datepicker.js'></script>
<script src='<?php echo site_url('assets/plugin/') ?>/timepicker/bootstrap-timepicker.min.js'></script>
<script src='<?php echo site_url('assets/plugin/') ?>/fullcalendar/fullcalendar.min.js'></script>
<script>
	$('form').attr('autocomplete', 'off');
	</script>
	<script>
	/* $(document).keypress(".digits",function (e) {
	  
     if (e.which != 8 && e.which != 46  && e.which != 0 && (e.which < 48 || e.which > 57) ) {
               return false;
    }
}); */
	
	</script>


